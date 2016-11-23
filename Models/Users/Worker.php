<?php
namespace Models\Users;
use Models\Table as Table;

abstract class Worker extends Table implements Person{
    protected $company;
    
    public function getCompany(){
        return $this->company;
    }
    
    protected function setCompany($company){
        $this->company=$company;
    }
} 

