<?php
// Incluir el archivo de conexión
include_once('conexion.php');

// Consulta para obtener los profesores
$query = "SELECT id, nombre FROM usuarios WHERE rol = 'profesor'";
$result = $conexion->query($query);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    $profesores = [];
    while ($row = $result->fetch_assoc()) {
        $profesores[] = $row;
    }
    // Convertir el resultado en formato JSON
    echo json_encode($profesores);
} else {
    echo json_encode([]);
}
?>
