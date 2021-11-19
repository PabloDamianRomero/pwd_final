</main>
    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container">
            <h5 class="text-light">PWD2021 - TPFinal</h5>
            <strong class="text-light">Integrantes: Peralta & Romero</strong>
        </div>
        <div class="container d-flex justify-content-center">
        <?php if(isset($roles)){
                $valorIdRol = $roles[0]->getObjRol()->getIdrol();?>
                <div class="p-2"><a href="aboutUs.php?idrol=<?php $valorIdRol;?>" style="color:#fff;">Sobre nosotros</a></div>
                <?php
            }else{?>
                <div class="p-2"><a href="aboutUs.php" style="color:#fff;">Sobre nosotros</a></div>
                <?php
            }?>
            
            <?php if(isset($roles)){
                $valorIdRol = $roles[0]->getObjRol()->getIdrol();?>
                <div class="p-2"><a href="contacto.php?idrol=<?php $valorIdRol;?>" style="color:#fff;">Contacto</a></div>
                <?php
            }else{
                ?>
                <div class="p-2"><a href="contacto.php" style="color:#fff;">Contacto</a></div>
                <?php
            }
            ?>
            
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