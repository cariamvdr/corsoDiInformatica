<?php
namespace Models\Users;

trait DigitalUser{
    private $email;
    
        public function getEmail(){
            return $this->email;
        }
        
        public function setEmail($email){
            $this->email=$email;
        }
}
