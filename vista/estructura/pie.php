</main>
    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container font-montserrat">
            <h5 class="text-light">Programación Web Dinámica - TPFinal</h5>
            <strong class="text-light">Grupo 2: Peralta-Romero</strong>
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