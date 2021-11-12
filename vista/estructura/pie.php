</main>
    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container">
            <h5 class="text-light">PWD2021 - TPFinal</h5>
            <strong class="text-light">Integrantes: Peralta & Romero</strong>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="p-2"><a href="#" style="color:#fff;">Sobre nosotros</a></div>
            <div class="p-2"><a href="#" style="color:#fff;">Contacto</a></div>
            <div class="p-2"><a href="#" style="color:#fff;">Información</a></div>
        </div>

    </footer>
    <?php 
        if ($estructuraAMostrar == "desdeVista") {?>
            <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
            <script src="js/validacion.js"></script>
            <?php
        }
        if ($estructuraAMostrar == "desdeAccion") {?>
            <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
            <script src="../js/validacion.js"></script>
            <?php
        }?>
</body>
</html>