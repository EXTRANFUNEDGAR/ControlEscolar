<?php
session_start();
$_SESSION['test'] = 'Sesión activa';

if (isset($_SESSION['test'])) {
    echo "Sesión funcionando: " . $_SESSION['test'];
} else {
    echo "Error: La sesión no funciona.";
}
?>
