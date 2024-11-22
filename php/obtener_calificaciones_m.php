<?php
include 'conexion.php'; // Asegúrate de incluir la conexión correctamente

// Consulta para obtener las calificaciones con los nombres de los estudiantes y las materias
$sql = "SELECT usuarios.nombre AS estudiante, 
               materias.nombre AS materia, 
               calificaciones.calificacion
        FROM calificaciones
        JOIN usuarios ON calificaciones.id_estudiante = usuarios.id
        JOIN materias ON calificaciones.id_materia = materias.id";

$result = $conexion->query($sql);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    $calificaciones = [];
    while ($row = $result->fetch_assoc()) {
        $calificaciones[] = $row;
    }
    // Devuelve los resultados en formato JSON
    echo json_encode($calificaciones);
} else {
    // Si no hay calificaciones, devuelve un array vacío
    echo json_encode([]);
}
?>
