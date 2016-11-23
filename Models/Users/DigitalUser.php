<?php
namespace Models\Users;

trait DigitalUser{
    protected $email;
    
        public function getEmail(){
            return $this->email;
        }
        
        public function setEmail($email){
            $this->email=$email;
        }
}
