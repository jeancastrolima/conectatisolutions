<?php
// CONFIGURAÇÕES DO BANCO DE DADOS
$host = "localhost";          // normalmente localhost no XAMPP
$banco = "helpdesk_empresa";         // coloque aqui o nome do seu banco
$usuario = "root";            // usuário padrão do XAMPP
$senha = "";                  // senha padrão do XAMPP é vazia

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    
    // HABILITA ERROS DO PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("<strong>Erro ao conectar ao banco de dados:</strong> " . $e->getMessage());
}
?>
