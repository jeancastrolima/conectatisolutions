<?php
// enviar_contato.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

// RETORNAR SEMPRE JSON
header('Content-Type: application/json; charset=utf-8');

// ---------- CONFIGURAÇÕES ----------
$smtpHost = 'smtp.gmail.com';
$smtpPort = 587;
$smtpUser = 'jeanmouralima2015@gmail.com';
$smtpPass = 'nxtn wfnw nwmc xtih';
$fromEmail = 'jeanmouralima2015@gmail.com';
$fromName = 'ConectaTI Solutions';
$toEmail = 'ti@unax.com.br';
// -----------------------------------

function clean($v){
    return trim(htmlspecialchars($v, ENT_NOQUOTES, 'UTF-8'));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Método não permitido"]);
    exit;
}

$nome      = clean($_POST['nome'] ?? '');
$email     = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$telefone  = clean($_POST['telefone'] ?? '');
$servico   = clean($_POST['servico'] ?? '');
$mensagem  = clean($_POST['mensagem'] ?? '');

$errors = [];
if (!$nome) $errors[] = "Informe seu nome.";
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "E-mail inválido.";
if (!$mensagem) $errors[] = "A mensagem não pode ficar vazia.";

if ($errors) {
    echo json_encode(["status" => "error", "message" => implode(" ", $errors)]);
    exit;
}


// ========== TEMPLATE PREMIUM DO E-MAIL ==========
$body = '
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f2f5f9;padding:40px 0;font-family:Arial, sans-serif;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 5px 18px rgba(0,0,0,0.10);">
        
        <!-- Header -->
        <tr>
          <td style="background:#0d6efd;padding:30px;text-align:center;color:white;">
            <h1 style="margin:0;font-size:28px;font-weight:bold;">ConectaTI Solutions</h1>
            <p style="margin:6px 0 0;font-size:15px;opacity:0.9;">Nova Solicitação de Atendimento</p>
          </td>
        </tr>

        <!-- Corpo -->
        <tr>
          <td style="padding:30px 40px;color:#333;">

            <p style="font-size:16px;margin-top:0;">
              Você recebeu uma nova solicitação de atendimento.<br>
              Confira abaixo os detalhes enviados:
            </p>

            <table width="100%" style="margin:20px 0;background:#f8f9fa;border-radius:10px;border:1px solid #e2e6ea;padding:15px;">
              <tr><td style="padding:6px 0;"><strong>Nome:</strong> '.$nome.'</td></tr>
              <tr><td style="padding:6px 0;"><strong>E-mail:</strong> '.$email.'</td></tr>
              <tr><td style="padding:6px 0;"><strong>Telefone:</strong> '.$telefone.'</td></tr>
              <tr><td style="padding:6px 0;"><strong>Serviço:</strong> '.$servico.'</td></tr>
            </table>

            <div style="background:#eef4ff;border-left:5px solid #0d6efd;padding:15px;border-radius:8px;margin-bottom:20px;">
              <p style="margin:0;font-size:15px;line-height:1.6;">'.nl2br($mensagem).'</p>
            </div>

            <p style="font-size:14px;color:#666;"><em>Enviado em: '.date("d/m/Y H:i:s").'</em></p>

          </td>
        </tr>

        <!-- Rodapé -->
        <tr>
          <td style="background:#0d6efd;text-align:center;padding:15px;color:white;font-size:13px;">
            © '.date("Y").' ConectaTI Solutions — Atendimento e Soluções em Tecnologia
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
';


// ========== ENVIO ==========
$mail = new PHPMailer(true);

// Correção UTF-8
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

try {

    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtpPort;

    $mail->setFrom($fromEmail, $fromName);
    $mail->addReplyTo($email, $nome);
    $mail->addAddress($toEmail);

    $mail->isHTML(true);
    $mail->Subject = "Novo atendimento: {$servico} - {$nome}";
    $mail->Body    = $body;

    $mail->send();

    echo json_encode([
        "status" => "success",
        "message" => "Contato enviado com sucesso! Nossa equipe retornará em breve."
    ]);
    exit;

} catch (Exception $e) {

    error_log("Erro no envio: " . $mail->ErrorInfo);

    echo json_encode([
        "status" => "error",
        "message" => "Erro ao enviar sua mensagem. Tente novamente."
    ]);
    exit;
}

