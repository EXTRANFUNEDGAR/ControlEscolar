<?php
include 'conexion.php';

$sql = "SELECT id, nombre FROM usuarios WHERE rol = 'estudiante'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $estudiantes = [];
    while ($row = $result->fetch_assoc()) {
        $estudiantes[] = $row;
    }
    echo json_encode($estudiantes);
} else {
    echo json_encode([]); // Si no hay estudiantes, devolver un array vacío
}
?>
