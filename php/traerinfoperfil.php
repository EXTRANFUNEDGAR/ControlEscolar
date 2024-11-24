<?php
session_start();  // Iniciar la sesión para acceder a $_SESSION

// Verificar si la sesión tiene el ID del usuario
if (!isset($_SESSION['usuario']['id'])) {
    // Si no está autenticado, redirigir al login
    echo "<script>alert('No estás autenticado. Por favor, inicia sesión.'); window.location='../index.html';</script>";
    exit; // Detener el script si el usuario no está autenticado
}

// Obtener el ID del usuario desde la sesión
$student_id = $_SESSION['usuario']['id'];  // El ID se guarda en la sesión

// Verificar la conexión a la base de datos
include('conexion.php');  // Incluir el archivo de conexión

// Verificar que la conexión se haya establecido correctamente
if (!$conexion) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener los datos del estudiante
$student_query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$student_query->bind_param('i', $student_id);
$student_query->execute();
$student_result = $student_query->get_result();

// Verificar si la consulta devuelve resultados
if ($student_result->num_rows > 0) {
    $student = $student_result->fetch_assoc();
    // Eliminar posibles saltos de línea o espacios adicionales de la contraseña
    $student['password'] = trim($student['password']);
} else {
    $student = null; // Si no se encuentra el estudiante
}

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

// Obtener las calificaciones
$grades = [];
while ($row = $grades_result->fetch_assoc()) {
    // Limpiar posibles espacios o tabulaciones en las materias
    $row['materia'] = trim($row['materia']);
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

