<?php
include 'conexion.php';
session_start();

$id_profesor = $_SESSION['usuario']['id'];

$sql = "SELECT id, nombre FROM materias WHERE id_profesor = '$id_profesor'";
$result = $conexion->query($sql);
$materias = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $materias[] = $row;
    }
}

echo json_encode($materias);
?>
