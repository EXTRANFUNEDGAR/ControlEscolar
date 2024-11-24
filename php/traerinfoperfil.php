<?php
// Iniciar la sesión
session_start();
include('conexion.php');  

// Limpiar y reiniciar la sesión
session_unset();
session_destroy();
session_start();

// Si no hay sesión activa, asignamos un ID estático para pruebas (ID = 8)
if (!isset($_SESSION['usuario']['id'])) {
    $_SESSION['usuario'] = [
        'id' => 8,  // ID de usuario predeterminado para pruebas
        'nombre' => 'Estudiante de Prueba',
        'email' => 'prueba@escolar.com',
        'rol' => 'estudiante'
    ];
}

// Verificar que la conexión esté establecida correctamente
if (!isset($conexion)) {
    die("Error: No se pudo establecer la conexión a la base de datos.");
}

// Obtener el ID del estudiante desde la sesión
$student_id = $_SESSION['usuario']['id'];

// Verificar la conexión antes de continuar
if (!$conexion) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener información del estudiante
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
