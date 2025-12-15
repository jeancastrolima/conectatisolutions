<?php
// Inclua o arquivo de conexão PDO
include 'conexao.php'; 

$mensagem_sucesso = "";
$mensagem_erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $nova_senha = $_POST['nova_senha'];
    
    // 1. GERAÇÃO DO HASH SEGURO
    // password_hash() gera o hash de forma segura
    $hash_seguro = password_hash($nova_senha, PASSWORD_DEFAULT);

    try {
        // 2. BUSCAR E VERIFICAR SE O USUÁRIO EXISTE
        $sql_check = $pdo->prepare("SELECT id_aluno FROM usuarios WHERE email = ? LIMIT 1");
        $sql_check->execute([$email]);
        $user = $sql_check->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // 3. ATUALIZAÇÃO DA SENHA NO BANCO DE DADOS
            $sql_update = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
            $sql_update->execute([$hash_seguro, $email]);

            $mensagem_sucesso = "🎉 Senha atualizada com sucesso! Você pode usar a nova senha para logar.";
        } else {
            $mensagem_erro = "❌ Erro: E-mail não encontrado no banco de dados.";
        }

    } catch (PDOException $e) {
        $mensagem_erro = "❌ Erro ao atualizar o banco de dados: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Nova Senha (Ferramenta Administrativa)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%;">
        <h3 class="text-center mb-4">🔐 Ferramenta de Cadastro de Senha (Admin)</h3>

        <?php if (!empty($mensagem_sucesso)) { ?>
            <div class="alert alert-success"><?= $mensagem_sucesso ?></div>
        <?php } ?>

        <?php if (!empty($mensagem_erro)) { ?>
            <div class="alert alert-danger"><?= $mensagem_erro ?></div>
        <?php } ?>

        <p class="text-muted text-center small">Use esta ferramenta para redefinir a senha de um usuário existente, garantindo o hash correto.</p>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">E-mail do Usuário</label>
                <input type="email" name="email" class="form-control" value="tecnico@empresa.com" required>
                <div class="form-text">Deve ser um e-mail já cadastrado no banco.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nova Senha (Texto Simples)</label>
                <input type="password" name="nova_senha" class="form-control" required>
                <div class="form-text">Esta será a senha que você usará no login.</div>
            </div>

            <button class="btn btn-warning w-100">Gerar Hash e Atualizar Senha</button>
        </form>
        
        <hr>
        <div class="text-center">
            <a href="login.php" class="btn btn-outline-primary btn-sm">Ir para a Tela de Login</a>
        </div>
    </div>
</div>

</body>
</html>