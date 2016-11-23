<?php
namespace Models;

use Configs\Database as Database;
use \PDO;
/**
 * Table is class to be extended by models defined database
 */
abstract class Table {
    
    private $conn = '';
    private $user = '';
    private $password = '';
    
    private static $instance = null;
    
    protected $id = 0;
    
    /**
     * Initialize all paramerets required to connect database 
     * and retrive / manipulate info from/to table
     * @param type $conn
     * @param type $database
     * @param type $user
     * @param type $password
     * @param type $table
     */
    function __construct($table){
        
        $this->conn = Database::CONNECT;
        $this->user = Database::USERNAME;
        $this->password = Database::PASSWORD;
        $this->table = $table;
    }

    function get($id){
        self::$instance = new PDO ($this->conn, $this->user, $this->password);
        self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $stmt = self::$instance->prepare("SELECT * FROM $this->table WHERE id = :id LIMIT 1");
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
    abstract function loadFromDb ($id);
    
    /**
     * Remove an item with ID from DB
     * @param type $id database primary key
     */
    function removeFromDb ($id){
        // attivo una connessione e eseguo una cancellazione dell elemento
        // della tabella che ha per ID il valore richiesto!
        // prendere ad ispirazione http://ginho.it/articolo/guida-completa-a-pdo
    }
}
