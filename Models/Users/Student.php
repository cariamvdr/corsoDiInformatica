<?php
namespace Models\Users;

use Models\Table as Table;

class Student extends Table implements Person {
    
    use DigitalUser;
    
    private $name;
    private $age;
    private $courses = array();
    
    public static function getInstanceFromDb($id){
        
    }
    
    public function __construct($name, $age, $email, $courses=[]){
        parent::__construct("student");
        
        $this->name=$name;
        $this->age=$age;
        $this->email=$email;
        $this->courses=$courses;
    }
    
    function loadFromDb($id){
        $instance = $this->get($id);
        if($instance){
            foreach($instance as $key => $value){
                if(strpos($key, "_") === false)
                    $this->$key = $value;
            }
        }
    }

    public function __toString(){
        $courses="";
        foreach ($this->courses as $course){
            $courses.="<br>".$course;
        }
        return "nome: ".$this->name."<br>"."eta': ".$this->age."<br>"."email: ".$this->email."<br>"."corsi: ".$courses."<br>"; 
    }

    public function getCourses(){
        return $this->courses;
    }

    public function addCourse(Course $course){
        array_push($this->courses, $course);
    }

    public function resetCourses(){
        $this->courses=array();
    }

//--------------------------------------------------------------------------

    function getName(){
        return $this->name;
    }

    function setName($name){
        $this->name=$name;
    }

    function getAge(){
        return $this->age;
    }

    function setAge($age){
        $this->age=$age;
    }
}
