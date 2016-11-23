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
//    PDO::FETCH_NUM);
    PDO::FETCH_ASSOC);
$result = $connessione->query("SELECT * FROM student");
//echo json_encode($result->fetchAll());

// Eseguire una query filtrando per ID = 1
// pescato da una variabile e appggiandosi
// ad prepared statement

$result = $connessione->prepare("SELECT * FROM student WHERE id = :id LIMIT 1");
$id = 1;
$result->execute(array(
	":id" => $id
));
echo json_encode($result->fetch());
