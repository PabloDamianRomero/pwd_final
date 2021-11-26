<?php
$titulo = "Estado de la compra";
    $estructuraAMostrar = "desdeVista";
    $seguro=true;
    include_once("estructura/cabecera.php");
    $datos=data_submitted();
    if ($datos['resp']=="exito"){?>
        <div class="alert alert-success text-center" role="alert" style="margin-top: 10%;">
            Operación exitosa. Se esta revisando su compra.
        </div>
        <div class="text-center">
            <a href="tienda.php?idrol="<?php $rolActivo->getIdrol(); ?>>Volver a la tienda</a>
        </div>
    <?php
    }elseif($datos['resp']=="fallo"){?>
        <div class="alert alert-danger text-center" role="alert" style="margin-top: 10%;">
            Hubo un error con la compra.
        </div>
    <?php
    }elseif($datos['resp']=="stock"){?>
        <div class="alert alert-danger text-center" role="alert" style="margin-top: 10%;">
            Uno de los productos no tiene stock suficiente.
        </div>
    <?php
    }
    include_once("estructura/pie.php");
?>