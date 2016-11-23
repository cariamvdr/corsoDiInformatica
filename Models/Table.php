<?php
namespace Models;

use Configs\Database as Database;
use \PDO as PDO;
/**
 * Table is class to be extended by models defined database
 */
abstract class Table {
    
    protected $table = '';
    
    private static $db = null;
    
    protected $id = 0;
    
    abstract static function getBindings();
    
    static function init(&$obj, $id=null){
        $class = get_called_class();
        $obj->table = $class::TABLE_NAME;
        self::$db = new PDO (Database::CONNECT, Database::USERNAME, Database::PASSWORD);
        self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        
        if($id){
            $obj->loadFromDb($id);
        }
        return $obj;
    }
    
    public static function load($id){
        $obj = new static();
        $obj->loadFromDb($id);
        return $obj;
    }

    private function get($id){
        $stmt = self::$db->prepare("SELECT * FROM $this->table WHERE id = :id LIMIT 1");
        if($stmt->execute([":id"=>$id])){
            if ($result = $stmt->fetch()){
                return $result;
            } else {
                return null;
            }
        }
    }
    
    /**
     * Load an item with ID from DB
     * @param type $id database primary key
     */
    private function loadFromDb ($id){
        $instance = $this->get($id);
        $bindings = $this::getBindings();
        if($instance){
            foreach($instance as $key => $value){
                if(in_array($key, array_keys($bindings))){
                    $property = $bindings[$key];
                    $this->$property = $value;
                }
            }
        }
    }

    /**
     * Remove an item with ID from DB
     * @param type $id database primary key
     */
    public function save (){
        // abbiamo preso ad ispirazione http://ginho.it/articolo/guida-completa-a-pdo
        $bindings = $this::getBindings();
        $id = 0;
        unset($bindings['id']); 
        if(!$this->id){
            $cols = join(", ", $bindings);
            $data = [];
            foreach($bindings as $key){
                $data[] = self::$db->quote($this->$key);
            }
            $vals = join(", ", $data);
            $query = "INSERT INTO ".$this->table." ($cols) VALUES ($vals)";
            if(self::$db->exec($query)) $id = self::$db->lastInsertId();
            $this->id = $id;
        }else{
            $data = [];
            foreach($bindings as $key=>$value){
                $data[] = "$key = ".self::$db->quote($this->$value);
            }
            $assign = join(", ", $data);
            if(self::$db->exec("UPDATE ".$this->table." SET $assign WHERE id = $this->id"))
                $id = $this->id;
        }
        
        return $id;
    }
    
    /**
     * Remove an item with ID from DB
     * @param type $id database primary key
     */
    public function remove (){
        // abbiamo preso ad ispirazione http://ginho.it/articolo/guida-completa-a-pdo
        $number = 0;
        if($this->id){
            self::$db->exec("DELETE FROM ".$this->table." WHERE id = ".$this->id);
            $this->id = 0;
        }		
        return $number;
    }
}
