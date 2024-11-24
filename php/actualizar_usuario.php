<?php
include 'conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefono'];
$sangre = $_POST['sangre'];
$edad = $_POST['edad'];
$genero = $_POST['genero'];

$sql = "UPDATE usuarios SET nombre='$nombre', email='$email', carrera='$carrera', telefono='$telefono', sangre='$sangre', edad='$edad', genero='$genero' WHERE id=$id";

if ($conexion->query($sql) === TRUE) {
    echo "<script>alert('Usuario actualizado con éxito');window.location='../usuarios.html';</script>";
} else {
    echo "Error: " . $conexion->error;
}
?>
