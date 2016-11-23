<?php

namespace Models\Users;
use \Iterator as It;

class Teacher extends Worker implements It {

    use DigitalUser;
    
    const TABLE_NAME = "teacher";

    protected $name;
    protected $age;
    protected $course;
    protected $school;
    protected $position = 0;

    public function __construct($name = "", $age = null, $email = "", Course $course = null, School $school = null, $company = null) {
        
        parent::init($this);
        
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
        $this->course = $course;
        $this->school = $school;
        $this->company = $company;
    }
    
    static function getBindings(){
        return [
            "id"=>"id",
            "name"=>"name",
            "age"=>"age",
            "email"=>"email",
            //"course"=>"course",
            //"school"=>"school",
            "company"=>"company",
        ];
    }

    public function current() {
        return $this->getStudents()[$this->position];
    }

    public function next() {
        $this->position++;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function key() {
        return $this->position;
    }

    public function valid() {
        return isset($this->getStudents()[$this->position]) || array_key_exists($this->position, $this->getStudents());
    }

    public function __toString() {
        $stringa = "";
        foreach ($this as $student) {
            $stringa.="<br>" . $student;
        }

        return "nome: " . $this->name . "<br>" . "eta': " . $this->age . "<br>" .
                "email: " . $this->email . "<br>" . "corso: "
                . $this->course . "<br>" . "studenti: " . $stringa . "<br>";
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getAge() {
        return $this->age;
    }

    function setAge($age) {
        $this->age = $age;
    }

    public function getCourse() {
        return $this->course;
    }

    public function setCourse(Course $course) {
        $this->course = $course;
    }

    public function getSchool() {
        return $this->school;
    }

    public function setSchool(School $school) {
        $this->school = $school;
    }

    public function getStudents() {
        $studs = [];
        foreach ($this->school as $student) {
            foreach ($student as $course) {
                if ($course === $this->course) {
                    array_push($studs, $student);
                }
            }
        }
        RETURN $studs;
    }

}
