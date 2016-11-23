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

echo "<hr><h3>Elenco studenti:</h3>".$gianni."<br>".$renzo."<br>".$pippo."<br>";

$id = $renzo->save();

echo "<hr><b>Renzo dal db con ID = $id:</b> ".Student::load($id)."<br>";

$renzo->setAge(55);
$renzo->save();

echo "<br><b>Renzo dal db appena aggiornato:</b> ".Student::load($id)."<br>";

$renzo->remove();

echo "<br><b>Renzo è stato rimosso dal DB</p><br>";

$fisica = new Course ( "Fisica" , 230 );
$analisi_matematica = new Course ( "Analisi Matematica" , 300 );

echo "<h3>Due nuovi Corsi:</h3>".$fisica."<br>".$analisi_matematica."<br>";

$gianni->addCourse($fisica);
$gianni->addCourse($analisi_matematica);

$pippo->addCourse($fisica);
$renzo->addCourse($analisi_matematica);

echo "<h3>I tre studenti ora studiano e gianni è il secchione:</h3>".$gianni."<br>".$renzo."<br>".$pippo."<br>";

$vdr = new School ("Villaggio del Ragazzo");
$vdr->addStudent($gianni);
$vdr->addStudent($pippo);
$vdr->addStudent($renzo);

$informatica = new Course ( "informatica" , 160 );
$fabio_fazio = new Teacher ( "Fabio Fazio" , 35 , "fabio.fazio@villaggio.org" , $informatica, $vdr, "mainsim");
$renzo->addCourse($informatica);
//echo $vdr;
echo $fabio_fazio;
//foreach ($gianni as $f){echo $f;} 

$id = $fabio_fazio->save();

echo "<hr><b>fabio_fazio dal db con ID = $id:</b> ".Teacher::load($id)."<br>";

$fabio_fazio->setAge(55);
$fabio_fazio->save();

echo "<br><b>fabio_fazio dal db appena aggiornato:</b> ".Teacher::load($id)."<br>";

$fabio_fazio->remove();

echo "<br><b>fabio_fazio è stato rimosso dal DB</p><br>";



