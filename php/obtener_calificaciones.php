<?php
include 'conexion.php';
session_start();

$id_estudiante = $_SESSION['usuario']['id'];

$sql = "SELECT materias.nombre AS materia, calificaciones.calificacion
        FROM calificaciones
        INNER JOIN materias ON calificaciones.id_materia = materias.id
        WHERE calificaciones.id_estudiante = '$id_estudiante'";

$result = $conexion->query($sql);
$calificaciones = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $calificaciones[] = $row;
    }
}

echo json_encode($calificaciones);
?>
