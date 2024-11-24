<?php
include 'conexion.php';
$sql = "SELECT id, nombre, email, carrera, telefono, sangre, edad, genero, rol FROM usuarios";
$result = $conexion->query($sql);
$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

echo json_encode($usuarios);
?>
