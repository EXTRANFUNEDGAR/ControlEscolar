<?php
include 'conexion.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
if (isset($input['id'])) {
    $id = intval($input['id']);

    $sql = "UPDATE usuarios SET estatus = 0 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuario eliminado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el usuario.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID de usuario no proporcionado.']);
}
?>
