<?php
// Iniciar sesión
session_start();

// Verificar si los datos del estudiante existen en la sesión
if (!isset($_SESSION['student']) || !isset($_SESSION['grades'])) {
    die("No se ha recibido información del perfil. Asegúrate de haber pasado el ID correctamente.");
}

$student = $_SESSION['student'];
$grades = $_SESSION['grades'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Alumno</title>
    <link rel="stylesheet" href="asset/style/stylesofperfil.css">
    <link rel="manifest" href="./public/manifest.json">
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
                    <!-- Foto estatica para pruebas  
                <div class="profile-photo">
                    <img src="asset/img/Captura de pantalla 2024-05-21 230527.png" alt="Foto de perfil">
                </div>-->
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
