<!DOCTYPE html>
<html lang="pt-BR">

<?php include '_header.php'; ?>
<?php include '_navbar.php'; ?>

<!-- PAGE CONTENT START -->
<div class="container-xxl py-5">
    <div class="container">

        <!-- Título -->
        <div class="row mb-5">
            <div class="col-lg-10">
                <div class="border-start border-5 border-primary ps-4">
                    <h6 class="text-body text-uppercase mb-2">Contato</h6>
                    <h1 class="display-6 mb-0">Fale com a ConectaTI Solutions</h1>
                </div>
                <p class="lead mt-3">
                    Preencha o formulário abaixo e nossa equipe retornará o mais rápido possível.  
                    Estamos prontos para ajudar a transformar sua empresa com tecnologia profissional.
                </p>
            </div>
        </div>

        <div class="row g-5">

            <!-- Coluna: Contatos -->
            <div class="col-lg-4">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100">

                    <h4 class="mb-4">Informações de Contato</h4>

                    <div class="d-flex mb-3">
                        <i class="fa fa-envelope text-primary me-3 fa-2x"></i>
                        <div>
                            <h6 class="mb-1">E-mail</h6>
                            <small>contato@conectati.com</small>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <i class="fa fa-phone text-primary me-3 fa-2x"></i>
                        <div>
                            <h6 class="mb-1">Telefone</h6>
                            <small>(00) 00000-0000</small>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <i class="fa fa-map-marker-alt text-primary me-3 fa-2x"></i>
                        <div>
                            <h6 class="mb-1">Localização</h6>
                            <small>Macaé - Rio de Janeiro</small>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-2">Horário de Atendimento</h5>
                    <p class="mb-1"><strong>Seg - Sex:</strong> 09h às 18h</p>
                    <p><strong>Sábado:</strong> 09h às 13h</p>

                </div>
            </div>

            <!-- Coluna: Formulário -->
            <div class="col-lg-8">
                <div class="p-4 bg-light rounded-3 shadow-sm">

                    <!-- Alertas -->
                    <?php if(isset($_GET['success'])): ?>
                        <div class="alert alert-success">Mensagem enviada com sucesso! Nossa equipe responderá em breve.</div>
                    <?php elseif(isset($_GET['error'])): ?>
                        <div class="alert alert-danger">Não foi possível enviar sua mensagem. Tente novamente.</div>
                    <?php endif; ?>

                    <!-- Formulário -->
                    <h4 class="mb-4">Envie sua mensagem</h4>

                    <form action="send_contact.php" method="POST">

                        <!-- Linha 1 -->
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Nome completo</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <!-- Linha 2 -->
                        <div class="row g-4 mt-1">
                            <div class="col-md-6">
                                <label class="form-label">Telefone</label>
                                <input type="text" name="telefone" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Assunto</label>
                                <input type="text" name="assunto" class="form-control" required>
                            </div>
                        </div>

                        <!-- Mensagem -->
                        <div class="mt-4">
                            <label class="form-label">Mensagem</label>
                            <textarea name="mensagem" rows="6" class="form-control" required></textarea>
                        </div>

                        <!-- Botão -->
                        <div class="mt-4">
                            <button class="btn btn-primary px-4 py-2 fw-bold">
                                Enviar Mensagem
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
<!-- PAGE CONTENT END -->

<?php include '_footer.php'; ?>
<?php include '_backtop.php'; ?>

</body>
</html>
