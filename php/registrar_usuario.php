<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$rol = $_POST['rol'];

$sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES ('$nombre', '$email', '$password', '$rol')";

if ($conexion->query($sql) === TRUE) {
    echo "<script>alert('Usuario registrado con éxito');window.location='../usuarios.html';</script>";
} else {
    echo "Error: " . $conexion->error;
}
?>
