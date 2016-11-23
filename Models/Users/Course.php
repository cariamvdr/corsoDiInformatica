<?php
namespace Models\Users;

use Models\Table as Table;

class Course extends Table {
    
    const TABLE_NAME = "course";
    
    protected $name;
    protected $hours;
    
        public function __construct ($name,$hours){
            
            parent::init($this);
            
            $this->name=$name;
            $this->hours=$hours;
        }
        
        static function getBindings(){
        return [
            "id"=>"id",
            "name"=>"name",
            "hours"=>"hours",
        ];
    }
        
        public function __toString (){
            return "<br>"."- nome corso: ".$this->name."<br>"."ore: ".$this->hours;
        }
}
