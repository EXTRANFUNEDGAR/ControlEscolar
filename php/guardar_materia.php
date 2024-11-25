<?php
// Incluir el archivo de conexión a la base de datos
include_once('conexion.php');

// Verificar si el formulario ha sido enviado y si se recibió el nombre de la materia y el id del profesor
if (isset($_POST['materia']) && isset($_POST['id_profesor'])) {
    $materia = $_POST['materia'];
    $id_profesor = $_POST['id_profesor']; // Obtener el id del profesor

    // Validar que el campo no esté vacío
    if (empty($materia) || empty($id_profesor)) {
        echo json_encode(["success" => false, "message" => "El nombre de la materia y el id del profesor no pueden estar vacíos."]);
        exit;
    }

    // Verificar que el id_profesor exista en la tabla usuarios
    $checkProfesorQuery = "SELECT id FROM usuarios WHERE id = ?";
    if ($stmt = $conexion->prepare($checkProfesorQuery)) {
        $stmt->bind_param("i", $id_profesor); // Vincula el parámetro
        $stmt->execute();
        $stmt->store_result();

        // Si no se encuentra el profesor
        if ($stmt->num_rows == 0) {
            echo json_encode(["success" => false, "message" => "El profesor con ID $id_profesor no existe en la base de datos."]);
            exit;
        }

        // Preparar la consulta SQL para insertar la nueva materia
        $query = "INSERT INTO materias (nombre, id_profesor) VALUES (?, ?)";
        if ($stmt = $conexion->prepare($query)) {
            // Asociar los parámetros
            $stmt->bind_param("si", $materia, $id_profesor);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Materia creada exitosamente."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al crear la materia: " . $stmt->error]);
            }

            // Cerrar la sentencia preparada
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conexion->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error al verificar el profesor: " . $conexion->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No se recibió el nombre de la materia o el id del profesor."]);
}
?>
