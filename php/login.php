<?php
session_start();
include 'conexion.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../dashboard.html");
    } else {
        echo "<script>alert('Contraseña incorrecta');window.location='../login.html';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado');window.location='../login.html';</script>";
}
?>
