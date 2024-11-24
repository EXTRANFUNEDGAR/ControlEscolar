<?php
$servername = "localhost";
$username = "root";  // Usuario predeterminado en XAMPP
$password = "";      // No se necesita contraseña por defecto
$dbname = "control_escolar"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
