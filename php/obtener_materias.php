<?php
include 'conexion.php';

$sql = "SELECT id, nombre FROM materias";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $materias = [];
    while ($row = $result->fetch_assoc()) {
        $materias[] = $row; // Añade cada materia al array
    }
    echo json_encode($materias); // Devuelve el array en formato JSON
} else {
    echo json_encode([]); // Si no hay materias, devuelve un array vacío
}
?>
