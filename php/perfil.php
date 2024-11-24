<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=control_escolar', 'root', '');

// Verificar si el ID del estudiante está disponible en la sesión
if (isset($_SESSION['student_id'])) {
    // Si el ID está en la sesión, asignarlo a la variable $studentId
    $studentId = $_SESSION['student_id'];
} else {
    // Si no hay ID en la sesión, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Consultar los datos del estudiante desde la base de datos
$query = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$query->execute(['id' => $studentId]);
$student = $query->fetch(PDO::FETCH_ASSOC);

// Si el estudiante no existe en la base de datos
if (!$student) {
    die('Estudiante no encontrado');
}

// Consultar las calificaciones del estudiante
$query = $pdo->prepare("SELECT c.calificacion, m.nombre AS materia FROM calificaciones c 
                        JOIN materias m ON c.id_materia = m.id 
                        WHERE c.id_estudiante = :id_estudiante");
$query->execute(['id_estudiante' => $studentId]);
$grades = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Alumno</title>
    <link rel="stylesheet" href="asset/style/stylesofperfil.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Perfil del Alumno</h1>
        </div>
    </header>

    <main>
        <div class="profile-container">
            <!-- Foto y detalles personales -->
            <div class="profile-header">
                <div class="profile-photo">
                    <!-- Obtener la imagen desde la base de datos -->
                    <img src="<?php echo htmlspecialchars($student['imagen']); ?>" alt="Foto de perfil">
                </div>

                <div class="profile-info">
                    <h2>Instituto Tecnológico Superior de Guanajuato</h2>
                    <p><strong>Nombre del Alumno:</strong> <?php echo htmlspecialchars($student['nombre']); ?></p>
                    <p><strong>Carrera:</strong> <?php echo htmlspecialchars($student['carrera']); ?></p>
                    <p><strong>Control Escolar:</strong> <?php echo htmlspecialchars($student['id']); ?></p>
                    <p><strong>Teléfono Cel:</strong> <?php echo htmlspecialchars($student['telefono']); ?></p>
                    <p><strong>Tipo Sanguíneo:</strong> <?php echo htmlspecialchars($student['sangre']); ?></p>
                    <p><strong>Edad:</strong> <?php echo htmlspecialchars($student['edad']); ?> años</p>
                    <p><strong>Género:</strong> <?php echo htmlspecialchars($student['genero']); ?></p>
                </div>
            </div>

            <!-- Kardex -->
            <div class="kardex-section">
                <h3>Kardex Académico</h3>
                <p>Las calificaciones del estudiante:</p>

                <?php if (count($grades) > 0): ?>
                    <table>
                        <tbody>
                            <?php foreach ($grades as $grade): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($grade['materia']); ?></td>
                                    <th><?php echo htmlspecialchars($grade['calificacion']); ?></th>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No se encontraron calificaciones para este estudiante.</p>
                <?php endif; ?>

            </div>
        </div>
    </main>

    <footer>
    </footer>
</body>
</html>
