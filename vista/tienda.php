<?php
    $titulo="Tienda";
    $estructuraAMostrar = "desdeVista";
    $seguro=true;
    include_once("estructura/cabecera.php");
    // ---------------------- Verificar si el sub-enlace del menú está habilitado -------------------------------
$i = 0;
$existeSubEnlace = false;
if(isset($arrSubMenu)){
    while(($i < count($arrSubMenu)) && (!$existeSubEnlace)){
        $subMenuActual = $arrSubMenu[$i];
        if(($subMenuActual->getMedeshabilitado() != "0000-00-00 00:00:00") && ($subMenuActual->getMedescripcion() == "tienda")){
            $existeSubEnlace = true;
        }
        $i++;
    }
}
// ----------------------------------------------------------------------------------------------------------

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
// ---------------------- Si es Cliente pero el enlace-menu(padre) no está disponible  -------------------------------
}else if(($rolActivo->getIdrol() == 3) && (!isset($arrMenuPadre))){ // si es cliente pero el enlace-menu(padre) no está disponible
    ?>
        <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <span style="font-weight: bold;">Este apartado no se encuentra disponible.</span>
            </div>
        </div>
    </div>
    <?php
// ----------------------------------------------------------------------------------------------------------

// ---------------------- Si es Cliente pero el enlace-menu(sub menú o padre) no está disponible  -------------------------------
// ---------------------- Esto es para no acceder por url a la página si el enlace-menú esta deshabilitado  -------------------------------
 }else if(($rolActivo->getIdrol() == 3) && (isset($arrMenuPadre)) && ($existeSubEnlace) || $arrMenuPadre[0]->getMedeshabilitado() != "0000-00-00 00:00:00"){
    ?>
        <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <span style="font-weight: bold;">Este apartado no se encuentra disponible.</span>
            </div>
        </div>
        </div>
    <?php
}else{
    // ----------------------------------------------------------------------------------------------------------    

// ---------------------- Si es Cliente y existe el enlace-menu (padre e hijo)  ------------------------------- 
    $abmProd=new abmProducto();
    $arreglo=$abmProd->buscar(null);
echo '<div class="row text-center mb-5">';
        foreach ($arreglo as $obj){
            if ($obj->getProdeshabilitado()=="0000-00-00 00:00:00"){
                echo '<div class="col-3 mt-5" style="height:350px">';
                echo '<div style="background-color:#cae3e9; padding:5px; height:350px">';
                echo '<div id="img" style="height:250px"><a href="productos.php?idproducto='.$obj->getIdproducto().'"><img style="max-height:230px; max-width:230px; margin-top:20px;" src="archivos/productos/img/'.$obj->getProdetalle().'.jpg?t='.time().'">
                    </a></div>';
                echo '<div id="nombre" style="height:60px"><p>'.$obj->getPronombre().'</p></div>';
                echo '<div><p class="negrita">$'.$obj->getProprecio().'</p></div></div></div>';
            }
        }
echo '</div>';
}
include_once("estructura/pie.php");

?>