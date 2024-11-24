<?php
session_start();
include('conexion.php');  // Asegúrate de que la ruta de este archivo sea correcta

// Si no hay sesión activa, asignamos un ID estático para pruebas (ID = 9)
if (!isset($_SESSION['usuario']['id'])) {
    $_SESSION['usuario'] = [
        'id' => 9,  // ID de usuario predeterminado para pruebas
        'nombre' => 'Estudiante de Prueba',
        'email' => 'prueba@escolar.com',
        'rol' => 'estudiante'
    ];
}

// Obtener el ID del estudiante desde la sesión
$student_id = $_SESSION['usuario']['id'];

// Consulta para obtener información del estudiante
$student_query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$student_query->bind_param('i', $student_id);
$student_query->execute();
$student_result = $student_query->get_result();
$student = $student_result->fetch_assoc();

// Consulta para obtener las calificaciones del estudiante
$grades_query = $conexion->prepare("
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
exit;
?>
