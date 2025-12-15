<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer via Composer

// Verifica campos obrigatórios
if (!isset($_POST['nome'], $_POST['email'], $_POST['assunto'], $_POST['mensagem'])) {
    header("Location: contact?error=1");
    exit;
}

// Dados do formulário
$nome     = $_POST['nome'];
$email    = $_POST['email'];
$telefone = $_POST['telefone'];
$assunto  = $_POST['assunto'];
$mensagem = $_POST['mensagem'];

$mail = new PHPMailer(true);

try {

    // CONFIG SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'jeanmouralima2015@gmail.com'; // ALTERAR
    $mail->Password   = 'nxtn wfnw nwmc xtih'; // ALTERAR
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // UTF-8 PERFEITO
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    // REMETENTE / DESTINATÁRIO
    $mail->setFrom('jeanmouralima2015@gmail.com', 'ConectaTI Solutions');
    $mail->addAddress('ti@unax.com.br'); // PARA ONDE VAI A MENSAGEM

    // HTML
    $mail->isHTML(true);
    $mail->Subject = "Contato via site - " . $assunto;

    // CORPO HTML ESTILIZADO
    $mail->Body = '
    <div style="font-family: Arial, sans-serif; background: #f8f9fa; padding: 20px;">
        <div style="
            max-width: 600px; 
            margin: auto; 
            background: #ffffff; 
            border-radius: 8px; 
            padding: 25px; 
            border: 1px solid #e1e1e1; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        ">
            
            <h2 style="
                color: #0d6efd; 
                border-left: 4px solid #0d6efd; 
                padding-left: 10px;
            ">Nova mensagem recebida</h2>

            <p style="font-size: 15px; color: #555;">
                Você recebeu uma nova mensagem enviada pelo formulário do site.
            </p>

            <hr style="border: none; border-top: 1px solid #dee2e6; margin: 20px 0;">

            <div style="margin-bottom: 15px;">
                <strong>Nome:</strong><br>
                <span>' . nl2br($nome) . '</span>
            </div>

            <div style="margin-bottom: 15px;">
                <strong>E-mail:</strong><br>
                <span>' . nl2br($email) . '</span>
            </div>

            <div style="margin-bottom: 15px;">
                <strong>Telefone:</strong><br>
                <span>' . nl2br($telefone) . '</span>
            </div>

            <div style="margin-bottom: 15px;">
                <strong>Assunto:</strong><br>
                <span>' . nl2br($assunto) . '</span>
            </div>

            <div style="margin-bottom: 15px;">
                <strong>Mensagem:</strong><br>
                <div style="
                    margin-top: 8px; 
                    background: #f1f3f5; 
                    padding: 12px; 
                    border-radius: 6px; 
                    border: 1px solid #dee2e6;
                    white-space: pre-line;
                ">
                    ' . nl2br($mensagem) . '
                </div>
            </div>

            <hr style="border: none; border-top: 1px solid #dee2e6; margin: 25px 0;">

            <p style="font-size: 13px; color: #6c757d; text-align: center;">
                Enviado automaticamente pelo site da <strong>ConectaTI Solutions</strong>
            </p>

        </div>
    </div>';

    // Envia o e-mail
    $mail->send();

    header("Location: contact?success=1");
    exit;

} catch (Exception $e) {

    // Para debug (opcional):
    // echo "Erro ao enviar: {$mail->ErrorInfo}";

    header("Location: contact?error=1");
    exit;
}

