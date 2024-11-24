<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$carrera = $_POST['carrera'];
$telefono = $_POST['telefono'];
$sangre = $_POST['sangre'];
$edad = $_POST['edad'];
$genero = $_POST['genero'];
$rol = $_POST['rol'];

$sql = "INSERT INTO usuarios (nombre, email, password, rol, carrera, telefono, sangre, edad, genero) VALUES ('$nombre', '$email', '$password', '$rol', '$carrera', '$telefono', '$sangre', '$edad', '$genero')";

if ($conexion->query($sql) === TRUE) {
    echo "<script>alert('Usuario registrado con éxito');window.location='../usuarios.html';</script>";
} else {
    echo "Error: " . $conexion->error;
}
?>
