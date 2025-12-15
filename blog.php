<?php include '_header.php'; ?>
<?php include '_navbar.php'; ?>

<?php
$blog_posts_fakes = [
    [
        'titulo' => 'A Revolução da IA no Atendimento ao Cliente',
        'resumo' => 'Como a Inteligência Artificial está redefinindo o suporte e a satisfação dos usuários em 2025.',
        'imagem' => 'img/service-1.jpg', // Caminho da imagem de exemplo
        'slug' => 'a-revolucao-da-ia-no-atendimento-ao-cliente',
    ],
    [
        'titulo' => 'Segurança Cibernética: Os 5 Pilares Essenciais para PMEs',
        'resumo' => 'Um guia prático com as medidas mais importantes para proteger sua pequena ou média empresa contra ataques digitais.',
        'imagem' => 'img/service-2.jpg', // Caminho da imagem de exemplo
        'slug' => 'seguranca-cibernetica-pilares-pme',
    ],
    [
        'titulo' => 'Migração para Nuvem: Vantagens e Desafios Práticos',
        'resumo' => 'Analisamos o processo de levar a infraestrutura para a nuvem, focando em custos, escalabilidade e performance.',
        'imagem' => 'img/service-3.jpg', // Caminho da imagem de exemplo
        'slug' => 'migracao-para-nuvem-vantagens-desafios',
    ],
    [
        'titulo' => 'O Futuro do Trabalho Híbrido e a Tecnologia',
        'resumo' => 'Ferramentas de colaboração e gerenciamento que se tornaram cruciais para manter a produtividade em equipes distribuídas.',
        'imagem' => 'img/service-4.jpg', // Caminho da imagem de exemplo
        'slug' => 'o-futuro-do-trabalho-hibrido',
    ],
    [
        'titulo' => 'Blockchain Além das Criptomoedas',
        'resumo' => 'Explorando casos de uso da tecnologia de registro distribuído em logística, saúde e votação eletrônica.',
        'imagem' => 'img/service-5.jpg', // Caminho da imagem de exemplo
        'slug' => 'blockchain-alem-das-criptomoedas',
    ],
];
?>

<div class="container-xxl py-5">
    <div class="container">

        <div class="row g-5 align-items-end mb-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="border-start border-5 border-primary ps-4">
                    <h6 class="text-body text-uppercase mb-2">Nosso Blog</h6>
                    <h1 class="display-6 mb-0">
                        Artigos e Notícias sobre Tecnologia e Negócios
                    </h1>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end wow fadeInUp" data-wow-delay="0.3s">
                <a class="btn btn-primary py-3 px-5" href="blog">Ver Todos os Posts</a>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php foreach ($blog_posts_fakes as $post): ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-light overflow-hidden h-100">
                    <img class="img-fluid" src="<?= $post['imagem']; ?>" alt="<?= htmlspecialchars($post['titulo']); ?>" />
                    <div class="service-text position-relative text-center h-100 p-4">
                        <h5 class="mb-3"><?= $post['titulo']; ?></h5>
                        <p><?= $post['resumo']; ?></p>
                        <a class="small" href="blog-post.php?slug=<?= $post['slug']; ?>">
                            LEIA MAIS<i class="fa fa-arrow-right ms-3"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<?php include '_footer.php'; ?>
<?php include '_backtop.php'; ?>
</body>
</html>