<?php
session_start();
include 'conexao.php'; // conexão PDO

$erro = ""; // evita erro de variável não definida

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Buscar usuário pelo email
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
    $sql->execute([$email]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    // Validar login com password_verify (HASH)
    if ($user && password_verify($senha, $user['senha'])) {

        // CRIA SESSÕES
        $_SESSION['usuario_id'] = $user['id_aluno'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

        header("Location: index");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Login Técnico</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    :root {
        --primary: #00AEEF;
        --secondary: #7A4FFF;
        --accent: #00B3A4;
        --light: #F8F9FA;
        --dark: #1A1A1A;
    }

    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .login-container {
        width: 100%;
        max-width: 450px;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 25px;
        padding: 50px 30px;
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        animation: fadeIn 0.6s ease-out;
        position: relative;
        overflow: hidden;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .login-card::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: rgba(255, 255, 255, 0.03);
        top: -50%;
        left: -50%;
        transform: rotate(45deg);
        pointer-events: none;
    }

    .logo-area {
        display: flex;
        justify-content: center;
        margin-bottom: 25px;
    }

    .logo-area img {
        max-width: 140px;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
    }

    .login-title {
        text-align: center;
        font-size: 28px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 25px;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
    }

    label {
        color: #eee;
        font-weight: 500;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 12px;
        color: #fff;
        padding: 12px 15px;
        font-size: 16px;
        transition: 0.3s;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.7);
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.35);
        box-shadow: 0 0 0 3px var(--accent);
        color: #fff;
    }

    .btn-primary {
        background: var(--accent);
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 500;
        padding: 12px;
        width: 100%;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: var(--primary);
    }

    .alert-custom {
        background: rgba(255, 0, 0, 0.15);
        color: #fff;
        border: 1px solid rgba(255,0,0,0.3);
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 15px;
        text-align: center;
        font-weight: 500;
    }

    @media (max-width: 576px) {
        .login-card {
            padding: 35px 20px;
        }
        .login-title {
            font-size: 24px;
        }
    }
</style>
</head>

<body>

<div class="login-container">
    <div class="login-card">

        <!-- LOGO -->
        <div class="logo-area">
            <img src="http://unaxoffshore-001-site15.jtempurl.com/img/logo.png" alt="Logo da Empresa">
        </div>

        <!-- TÍTULO -->
        <div class="login-title">Área Técnica • Acesso Restrito</div>

        <!-- ALERTA DE ERRO -->
        <?php if (!empty($erro)) { ?>
            <div class="alert-custom">
                <?= $erro ?>
            </div>
        <?php } ?>

        <!-- FORMULÁRIO -->
        <form method="POST">
            <div class="mb-3">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
            </div>

            <div class="mb-4">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt me-2"></i> Entrar</button>
        </form>

    </div>
</div>

</body>
</html>
