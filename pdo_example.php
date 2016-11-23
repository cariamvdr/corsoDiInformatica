<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($class_name) {
    require_once $class_name.".php";
});


try{
$connessione = 
    new PDO(
        "mysql:dbname=corso_informatica;host=127.0.0.1",
        "admin","admin");
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
$connessione->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
//    PDO::FETCH_BOTH);
    PDO::FETCH_ASSOC);
$result = $connessione->query("SELECT * FROM student");

echo "<h3>Esempio di semplice query PDO</h3>";

foreach($result as $riga){
    foreach ($riga as $key => $value){
        echo "$key : $value<br>";
    }
}

echo "<hr><h3>Esempio di query con prepared statement filtrando per due valori in WHERE</h3>";

// Eseguire una query filtrando per ID = 1
// pescato da una variabile e appggiandosi
// ad prepared statement

$result = $connessione->prepare("SELECT * FROM student WHERE age > :age AND email LIKE :email");
$age = 50;
$email = "%@usa%";
$result->execute(array(
	":age" => $age,
        ":email" => $email,
));
foreach($result as $riga){
    foreach ($riga as $key => $value){
        echo "$key : $value<br>";
    }
}
