<?php
namespace Models\Users;

use Models\Table as Table;

class Student extends Table implements Person {
    
    use DigitalUser;
    
    const TABLE_NAME = "student";
    
    protected $name;
    protected $age;
    protected $courses = array();
    
    public function __construct($name="", $age="", $email="", $courses=[]){
        
        parent::init($this);
        
        $this->name=$name;
        $this->age=$age;
        $this->email=$email;
        $this->courses=$courses;
    }
    
    static function getBindings(){
        return [
            "id"=>"id",
            "name"=>"name",
            "age"=>"age",
            "email"=>"email",
        ];
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
