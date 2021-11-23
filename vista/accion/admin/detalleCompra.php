<?php
$titulo = "Estado de la compra";
$estructuraAMostrar = "desdeSubAccion";
$seguro=true;
include_once("../../estructura/cabecera.php");
$datos=data_submitted();
if (isset($datos['idcompra'])){?>
    <table class="table table-striped table-primary mt-5">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Producto</th>
            <th scope="col">Imagen</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Individual</th>
            <th scope="col">Precio Total</th>
            </tr>
        </thead>
        <tbody>
    <?php
        $abmItems=new abmCompraitem();
        $items=$abmItems->buscar(['idcompra'=>$datos['idcompra']]);
        if (!empty($items)){
            $i=1;
            $totalCant=0;
            $total=0;
            foreach ($items as $item){
                $enlaceImg='../../archivos/productos/img/'.$item->getObjProducto()->getProdetalle().'.jpg';
                $precio=($item->getObjProducto()->getProprecio())*($item->getCicantidad());
                echo '<tr><th>'.$i.'</th>';
                echo '<th>'.$item->getObjProducto()->getPronombre().'</th>';
                echo '<th><img width="40" src="'.$enlaceImg.'"></th>';
                echo '<th>'.$item->getCicantidad().'</th>';
                echo '<th>'.$item->getObjProducto()->getProprecio().'</th>';
                echo '<th>'.$precio.'</th></tr>';
                $i++;
                $total+=$precio;
            }
            echo '<tr><th></th><th></th><th></th><th></th><th>Total Compra:</th><th>'.$total.'</th></tr>';
        }
        echo '</tbody></table>';
    
    echo '<a class="btn btn-primary" href="../../admin_compras.php">Volver</a>';
    
}


include_once("../../estructura/pie.php");
?>