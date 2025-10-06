<?php
require '../Libraries/PHPMailer/src/Exception.php';
require '../Libraries/PHPMailer/src/PHPMailer.php';
require '../Libraries/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreo($asunto, $contenido, $destinatario) {
    $correoSalida = "sys.sangabriel@gmail.com";
    $contrasennaSalida = "gxbc bkka mauy qibg";

    $mail = new PHPMailer(true);
    $mail->Charset = 'UTF-8';

    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $correoSalida;
        $mail->Password = $contrasennaSalida;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($correoSalida, 'Asociación San Gabriel');
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $contenido;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
        return false;
    }
}
?>
