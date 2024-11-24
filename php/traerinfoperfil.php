<?php
include('conexion.php');

// Obtener el ID del estudiante (puede venir de una sesión )
$student_id = 8; // Cambiar al valor dinámico

// Consulta para obtener información del estudiante
$student_query = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$student_query->bind_param('i', $student_id);
$student_query->execute();
$student_result = $student_query->get_result();
$student = $student_result->fetch_assoc();

// Consulta para obtener las calificaciones del estudiante
$grades_query = $conn->prepare("
    SELECT materias.nombre AS materia, calificaciones.calificacion 
    FROM calificaciones
    JOIN materias ON calificaciones.id_materia = materias.id
    WHERE calificaciones.id_estudiante = ?
");
$grades_query->bind_param('i', $student_id);
$grades_query->execute();
$grades_result = $grades_query->get_result();

$grades = [];
while ($row = $grades_result->fetch_assoc()) {
    $grades[] = $row;
}

// Crear un arreglo para devolver al frontend
$response = [
    'student' => $student,
    'grades' => $grades
];

// Enviar los datos como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
