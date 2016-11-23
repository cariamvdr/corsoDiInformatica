<?php

namespace Models\Users;

class School implements \Iterator{
    private $name;
    private $students = array();
    private $position = 0;
    
        public function __construct($name){
            $this->name=$name;
        }
        
        public function __toString(){
            $stringa="";
            foreach ($this->students as $student){
                $stringa.="<br>".$student;
            }
            return "scuola: $this->name<br>studenti:$stringa";
        }
        
            public function addStudent(Student $student){
                array_push ($this->students, $student);
            }
            
            public function getStudents(){
                return $this->students;
            }

            public function current(){
                    return $this->students[$this->position];
                }

            public function next(){
                    $this->position++;
                }

            public function rewind(){
                    $this->position = 0;
                }

            public function key(){
                    return $this->position;
                }

            public function valid(){
                    return isset($this->students[$this->position]) || array_key_exists($this->position, $this->students);
                }
}
