<?php
// Iniciar sesión
session_start();

// Conectar a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=control_escolar', 'root', '');

// Obtener el ID del estudiante 
$studentId = isset($_GET['id']) ? $_GET['id'] : 8; //  valor por defecto para las pruebas 

// Consultar los datos del estudiante
$query = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$query->execute(['id' => $studentId]);
$student = $query->fetch(PDO::FETCH_ASSOC);

// Consultar las calificaciones del estudiante
$query = $pdo->prepare("SELECT c.calificacion, m.nombre AS materia 
                        FROM calificaciones c 
                        JOIN materias m ON c.id_materia = m.id 
                        WHERE c.id_estudiante = :id_estudiante");
$query->execute(['id_estudiante' => $studentId]);
$grades = $query->fetchAll(PDO::FETCH_ASSOC);

// Verificar si los datos del estudiante existen
if ($student) {
    // Almacenar los datos en la sesión
    $_SESSION['student'] = $student;
    $_SESSION['grades'] = $grades;
    

    header("Location: perfilvista.php");
    exit();
} else {
    // Si no se encuentra el estudiante, redirigir a una página de error o mostrar mensaje
    echo "Estudiante no encontrado.";
    exit();
}
?>

