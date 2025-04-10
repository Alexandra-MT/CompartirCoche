<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '00f4e1a89bdb69';
        $mail->Password = '45432dbf07372d';

        $mail->setFrom('registro@compartircoche.org', 'CompartirCoche.org');
        $mail->addAddress($this->email);
        $mail->Subject = 'Confirma tu cuenta';

        //HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido .= "<p><strong>¡Hola, ". $this->nombre ."!</strong></p>";
        $contenido .= "<p>Has creado tu cuenta en CompartirCoche, solo debes confirmarla presionando el siguiente enlace: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token ."'>Confirmar Cuenta.</a></p>";
        $contenido .= "<p>Si tu no solicitaste está cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '00f4e1a89bdb69';
        $mail->Password = '45432dbf07372d';

        $mail->setFrom('registro@compartircoche.org', 'CompartirCoche.org');
        $mail->addAddress($this->email);
        $mail->Subject = 'Restablece tu Contraseña';

        //HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido .= "<p><strong>¡Hola, ". $this->nombre ."!</strong></p>";
        $contenido .= "<p>Parece que has olvidado tu contraseña, sigue el siguiente enlace para recuperarla: <a href='http://localhost:3000/restablecer?token=". $this->token ."'>Restablecer Contraseña</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }
}

