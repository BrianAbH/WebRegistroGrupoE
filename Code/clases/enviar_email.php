<?php
/*
use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'mail.post.000webhost.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'ba749491@gmail.com';                     
    $mail->Password   = 'Bryan_2003';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom('noreply@ba749491.com', 'DigitalLocal');
    $mail->addAddress('contacto@ba749491.com', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
   

    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Detalles de su compra';
    
    $cuerpo = '<h4>Gracias por su compra</h4>';
    $cuerpo .= '<p>El id de su compra es <b>' . $id_transaccion . ' </b></p>';

    $mail->Body    = utf8_decode($cuerpo);
    $mail->AltBody = 'Le enviamos los detalles de su compra.';

    $mail -> setLanguage('es','../phpmailer/language/phpmailer.lang-es.php');

    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
    exit;
}

?>