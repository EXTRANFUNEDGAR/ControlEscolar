<?php
include 'conexion.php';

$id_materia = $_POST['id_materia'];
$id_estudiante = $_POST['id_estudiante'];
$calificacion = $_POST['calificacion'];

$sql = "INSERT INTO calificaciones (id_materia, id_estudiante, calificacion) VALUES ('$id_materia', '$id_estudiante', '$calificacion')";

if ($conexion->query($sql) === TRUE) {
    echo "<script>alert('Calificación guardada exitosamente');window.location='../subir_calificaciones.html';</script>";
} else {
    echo "Error: " . $conexion->error;
}
?>
