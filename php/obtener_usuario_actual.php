<?php
session_start();

// Verificar si existe un usuario autenticado
if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['rol'])) {
    echo json_encode($_SESSION['usuario']);
} else {
    http_response_code(401); // Respuesta de error
    echo json_encode(['error' => 'No se pudo determinar el rol del usuario. Por favor, inicia sesión nuevamente.']);
}
?>
