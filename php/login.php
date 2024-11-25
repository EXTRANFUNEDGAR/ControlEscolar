<?php
session_start();
include 'conexion.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("../PHPMailer/PHPMailer/src/PHPMailer.php");
include("../PHPMailer/PHPMailer/src/SMTP.php");
include("../PHPMailer/PHPMailer/src/Exception.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    
    if (password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'email' => $usuario['email'],
            'rol' => $usuario['rol']
        ];

        $nombre_usuario = $usuario['nombre'];
        $fecha_inicio_sesion = date('Y-m-d H:i:s'); 

        ob_start();
        include('../plantillaejemplo.php'); 
        $contenido = ob_get_clean();

        try {
            $correo = htmlspecialchars($_POST['email']); 

            $mail = new PHPMailer(true);
 
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'elmascasergiocapito@gmail.com';
            $mail->Password = 'erpt cjap xdhj ndxe'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('elmascasergiocapito@gmail.com', 'Sergio');
            $mail->addAddress($correo); 
            $mail->isHTML(true);
            $mail->Subject = 'Inicio de sesión ';
            $mail->Body = $contenido;
            $mail->send();

            header('Location: ../dashboard.html');
        } catch (Exception $e) {
            echo 'No se pudo enviar el correo. Error: ' . $mail->ErrorInfo;
        }
        
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location='../index.html';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.location='../index.html';</script>";
}

?>