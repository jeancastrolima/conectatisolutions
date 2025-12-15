<?php
session_start();

// VERIFICA LOGIN E TIPO
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'funcionario') {
    header("Location: login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Área Técnica - HelpDesk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    :root {
        --primary: #00AEEF;
        --secondary: #7A4FFF;
        --accent: #00B3A4;
        --light: #F8F9FA;
        --dark: #1A1A1A;
        --card-shadow: rgba(0,0,0,0.15);
    }

    body {
        background: #f0f2f5;
        min-height: 100vh;
        font-family: 'Roboto', sans-serif;
    }

    .navbar-dashboard {
        background: var(--primary);
        padding: 1rem 2rem;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .navbar-dashboard h1 {
        font-size: 1.8rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-logout {
        background: #ff4d4f;
        border: none;
        color: #fff;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-logout:hover {
        background: #e63946;
        color: #fff;
    }

    .dashboard-container {
        padding: 40px 20px;
        display: flex;
        justify-content: center;
    }

    .card-tech {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        width: 100%;
        max-width: 900px;
        box-shadow: 0 10px 25px var(--card-shadow);
    }

    .card-tech h2 {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
    }

    .list-group-item {
        border-radius: 12px;
        margin-bottom: 10px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: #fff;
    }

    .list-group-item:hover {
        background: var(--accent);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .list-group-item i {
        font-size: 1.2rem;
    }

    .list-group-item:hover i {
        color: #fff !important;
    }

    .badge-download {
        background: var(--primary);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        transition: 0.3s;
    }

    .list-group-item:hover .badge-download {
        background: #fff;
        color: var(--accent);
    }

    .info-text {
        margin-top: 20px;
        font-size: 0.9rem;
        color: #666;
    }

    @media (max-width: 576px) {
        .card-tech {
            padding: 20px;
        }
        .list-group-item {
            flex-direction: column;
            align-items: flex-start;
        }
        .badge-download {
            margin-top: 10px;
        }
    }
</style>
</head>
<body>

<div class="navbar-dashboard">
    <h1><i class="fa fa-toolbox"></i> HelpDesk Técnico</h1>
    <a href="logout" class="btn btn-logout"><i class="fa fa-sign-out-alt me-1"></i> Sair</a>
</div>

<div class="dashboard-container">
    <div class="card-tech">
        <h2 class="text-primary mb-3"><i class="fa fa-download"></i> Downloads Disponíveis</h2>
        <p class="text-muted mb-4">Acesse os arquivos exclusivos para técnicos autorizados.</p>

        <div class="list-group">
            <?php
            $pasta = __DIR__ . "/downloads";
            $urlBase = "downloads";

            if (is_dir($pasta)) {
                $arquivos = scandir($pasta);

                foreach ($arquivos as $arquivo) {
                    if ($arquivo != "." && $arquivo != ".." && !is_dir("$pasta/$arquivo")) {
                        
                        $ext = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
                        $icone = "fa-file";

                        switch ($ext) {
                            case "pdf": $icone = "fa-file-pdf text-danger"; break;
                            case "zip":
                            case "rar": $icone = "fa-file-archive text-warning"; break;
                            case "exe":
                            case "msi": $icone = "fa-file-code text-primary"; break;
                            case "jpg":
                            case "jpeg":
                            case "png": $icone = "fa-file-image text-info"; break;
                            case "txt": $icone = "fa-file-lines text-secondary"; break;
                        }

                        echo '
                        <a href="'.$urlBase.'/'.$arquivo.'" download 
                            class="list-group-item list-group-item-action">
                            
                            <div><i class="fa '.$icone.' me-2"></i>'.$arquivo.'</div>

                            <span class="badge badge-download">Baixar</span>
                        </a>';
                    }
                }
            } else {
                echo "<p class='text-danger'>A pasta /downloads não existe!</p>";
            }
            ?>
        </div>

        <p class="info-text">
            Para adicionar novos arquivos, coloque-os na pasta: <strong>/downloads/</strong>
        </p>
    </div>
</div>

</body>
</html>
