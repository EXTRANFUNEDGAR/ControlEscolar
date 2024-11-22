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
        // Guardar datos del usuario en la sesión
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'email' => $usuario['email'],
            'rol' => $usuario['rol']
        ];
        header('Location: ../dashboard.html');
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location='../index.html';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.location='../index.html';</script>";
}
?>
