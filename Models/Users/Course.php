<?php
namespace Models\Users;

class Course {
    private $name;
    private $hours;
    
        public function __construct ($name,$hours){
            $this->name=$name;
            $this->hours=$hours;
        }
        
        public function __toString (){
            return "<br>"."- nome corso: ".$this->name."<br>"."ore: ".$this->hours;
        }
}
