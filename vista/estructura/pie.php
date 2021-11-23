</main>
    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container">
            <h5 class="text-light">PWD2021 - TPFinal</h5>
            <strong class="text-light">Integrantes: Peralta & Romero</strong>
        </div>
        <div class="container d-flex justify-content-center">
        <?php 
            if ($estructuraAMostrar != "desdeSubAccion") {
                if(isset($roles)){
                    $valorIdRol = $roles[0]->getObjRol()->getIdrol();?>
                    <div class="p-2"><a href="aboutUs.php?idrol=<?php $valorIdRol;?>" class="enlace-footer">Sobre nosotros</a></div>
                    <?php
                }else{?>
                    <div class="p-2"><a href="aboutUs.php" class="enlace-footer">Sobre nosotros</a></div>
                    <?php
                }?>
                
                <?php if(isset($roles)){
                    $valorIdRol = $roles[0]->getObjRol()->getIdrol();?>
                    <div class="p-2"><a href="contacto.php?idrol=<?php $valorIdRol;?>" class="enlace-footer">Contacto</a></div>
                    <?php
                }else{
                    ?>
                    <div class="p-2"><a href="contacto.php" class="enlace-footer">Contacto</a></div>
                    <?php
                }
                ?>
                <?php if(isset($roles)){
                    $valorIdRol = $roles[0]->getObjRol()->getIdrol();?>
                    <div class="p-2"><a href="info.php?idrol=<?php $valorIdRol;?>" class="enlace-footer">Información</a></div>
                <?php
                }else{
                    ?>
                    <div class="p-2"><a href="info.php" class="enlace-footer">Información</a></div>
                    <?php
                }

            }else{ // desdeSubAccion
                if(isset($roles)){
                    $valorIdRol = $roles[0]->getObjRol()->getIdrol();?>
                    <div class="p-2"><a href="../../aboutUs.php?idrol=<?php $valorIdRol;?>" class="enlace-footer">Sobre nosotros</a></div>
                    <?php
                }else{?>
                    <div class="p-2"><a href="../../aboutUs.php" class="enlace-footer">Sobre nosotros</a></div>
                    <?php
                }?>
                
                <?php if(isset($roles)){
                    $valorIdRol = $roles[0]->getObjRol()->getIdrol();?>
                    <div class="p-2"><a href="../../contacto.php?idrol=<?php $valorIdRol;?>" class="enlace-footer">Contacto</a></div>
                    <?php
                }else{
                    ?>
                    <div class="p-2"><a href="../../contacto.php" class="enlace-footer">Contacto</a></div>
                    <?php
                }
                ?>
                <?php if(isset($roles)){
                    $valorIdRol = $roles[0]->getObjRol()->getIdrol();?>
                    <div class="p-2"><a href="../../info.php?idrol=<?php $valorIdRol;?>" class="enlace-footer">Información</a></div>
                <?php
                }else{
                    ?>
                    <div class="p-2"><a href="../../info.php" class="enlace-footer">Información</a></div>
                    <?php
                }

            }

            ?>
        </div>

    </footer>
    <?php 
        if ($estructuraAMostrar == "desdeVista") {?>
            <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
            <script src="js/validacion.js"></script>
            <script src="js/validarDatos.js"></script>
            <?php
        }
        if ($estructuraAMostrar == "desdeAccion") {?>
            <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
            <script src="../js/validacion.js"></script>
            <script src="../js/validarDatos.js"></script>
            <?php
        }?>
</body>
</html>