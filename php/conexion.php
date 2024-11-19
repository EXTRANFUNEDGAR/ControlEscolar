<?php
$host = 'localhost';
$db = 'control_escolar';
$user = 'root';
$password = '';

$conexion = new mysqli($host, $user, $password, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
