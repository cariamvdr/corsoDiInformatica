<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($class_name) {
    require_once $class_name.".php";
});

use Models\Users\Student as Student;
use Models\Users\Course as Course;
use Models\Users\Teacher as Teacher;
use Models\Users\School as School;

$gianni = new Student ( "Gianni" , 14 , "gianni@gianni.it" ) ;
$pippo = new Student ( "Pippo" , 16 , "pippo@pippo.com" );
$renzo = new Student ( "Renzo" , 18 , "renzo@renzo.org");

$renzo->loadFromDb(3);

die($renzo);

//echo $gianni."<br>".$renzo."<br>".$pippo."<br>";

$fisica = new Course ( "fisica" , 230 );
$analisi_matematica = new Course ( "analisi matematica" , 300 );

//echo "<br>".$fisica."<br>".$analisi_matematica."<br>";

$gianni->addCourse($fisica);
$gianni->addCourse($analisi_matematica);

$pippo->addCourse($fisica);

$renzo->addCourse($analisi_matematica);

//echo "<br>".$gianni."<br>".$renzo."<br>".$pippo."<br>";

$vdr = new School ("Villaggio del Ragazzo");
$vdr->addStudent($gianni);
$vdr->addStudent($pippo);
$vdr->addStudent($renzo);

$informatica = new Course ( "informatica" , 160 );
$fabio_fazio = new Teacher ( "Fabio Fazio" , 35 , "fabio.fazio@villaggio.org" , $informatica, $vdr);
$renzo->addCourse($informatica);
//echo $vdr;
echo $fabio_fazio;
//foreach ($gianni as $f){echo $f;} 



