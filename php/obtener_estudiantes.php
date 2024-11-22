<?php
include 'conexion.php';

$sql = "SELECT id, nombre FROM usuarios WHERE rol = 'estudiante'";
$result = $conexion->query($sql);
$estudiantes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $estudiantes[] = $row;
    }
}

echo json_encode($estudiantes);
?>
