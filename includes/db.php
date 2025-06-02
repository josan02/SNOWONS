<?php
$servidor = "localhost";
$usuario = "root"; 
$clave = "";       
$bbdd = "snowons";
$puerto = 3306;    

try {
    $pdo = new PDO("mysql:host=$servidor;port=$puerto;dbname=$bbdd;charset=utf8", $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
