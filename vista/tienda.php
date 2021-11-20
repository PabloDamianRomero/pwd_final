<?php
    $titulo="Tienda";
    $estructuraAMostrar = "desdeVista";
    $seguro=true;
    include_once("estructura/cabecera.php");
// ---------------------- Si el usuario actual no es cliente  -------------------------------
if($rolActivo->getIdrol() != 3){?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    No puede visualizar esta pagina (No está con el rol <span style='font-weight: bold; font-style: italic;'>Cliente</span>).
            </div>
        </div>
    </div>
<?php
}else{
    $abmProd=new abmProducto();
    $arreglo=$abmProd->buscar(null);
echo '<div class="row">';
        foreach ($arreglo as $obj){
            if ($obj->getProdeshabilitado()=="0000-00-00 00:00:00"){
                echo '<div class="col-3"> <a href="productos.php?idproducto='.$obj->getIdproducto().'"><img style="width:300px" src="archivos/productos/img/'.$obj->getProdetalle().'.jpg"></a>';
                $enlace="archivos/productos/detalle/".$obj->getProdetalle().".txt";
                echo '<div><p>'.$obj->getPronombre().'</p></div>';
                echo '<div><p>$'.$obj->getProprecio().'</p></div></div>';
            }
        }
echo '</div>';
}
include_once("estructura/pie.php");

?>