 <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
document.getElementById("form-contato").addEventListener("submit", async function(e){
    e.preventDefault();

    const form = this;
    const data = new FormData(form);
    const box = document.getElementById("retorno-contato");

    box.innerHTML = `
        <div class="alert alert-info text-center">Enviando...</div>
    `;

    try {
        const request = await fetch("enviar_contato.php", {
            method: "POST",
            body: data
        });

        const resposta = await request.json();

        if (resposta.status === "success") {
            box.innerHTML = `
                <div class="alert alert-success text-center">
                    ✔ ${resposta.message}
                </div>
            `;
            form.reset();
        } else {
            box.innerHTML = `
                <div class="alert alert-danger text-center">
                    ⚠ ${resposta.message}
                </div>
            `;
        }

    } catch (error) {
        box.innerHTML = `
            <div class="alert alert-danger text-center">
                Erro inesperado. Tente novamente.
            </div>
        `;
    }
});
</script>
