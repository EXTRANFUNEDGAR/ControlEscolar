<?php
include 'conexion.php';

// Recibir los datos del formulario
$id_materia = $_POST['id_materia'];
$id_estudiante = $_POST['id_estudiante'];
$calificacion = $_POST['calificacion'];

// Comprobar que los campos no están vacíos
if (!empty($id_materia) && !empty($id_estudiante) && !empty($calificacion)) {
    // Preparar la consulta para insertar la calificación
    $sql = "INSERT INTO calificaciones (id_materia, id_estudiante, calificacion)
            VALUES ('$id_materia', '$id_estudiante', '$calificacion')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Calificación guardada correctamente.'); window.location='../subir_calificaciones.html';</script>";
    } else {
        echo "<script>alert('Error al guardar la calificación: " . $conexion->error . "'); window.location='../subir_calificaciones.html';</script>";
    }
} else {
    echo "<script>alert('Todos los campos son obligatorios.'); window.location='../subir_calificaciones.html';</script>";
}
?>
