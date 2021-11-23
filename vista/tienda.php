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
echo '<div class="row text-center">';
        foreach ($arreglo as $obj){
            if ($obj->getProdeshabilitado()=="0000-00-00 00:00:00"){
                echo '<div class="col-3" style="background-color: #cae3e9; margin:20px 10px;">';
                $enlace="archivos/productos/detalle/".$obj->getProdetalle().".txt";
                if (file_exists($enlace)) {
                    echo '<a href="productos.php?idproducto='.$obj->getIdproducto().'">
                    <img style="width:300px; margin-top:20px;" src="archivos/productos/img/'.$obj->getProdetalle().'.jpg?t='.time().'">
                    </a>';
                }else{
                    echo '<a href="#">
                    <img style="width:300px; margin-top:20px;" src="archivos/productos/img/'.$obj->getProdetalle().'.jpg?t='.time().'">
                    </a>';
                    echo '<p>No disponible. Falta información.</p>';
                }
                echo '<div><p>'.$obj->getPronombre().'</p></div>';
                echo '<div><p class="negrita">$'.$obj->getProprecio().'</p></div></div>';
            }
        }
echo '</div>';
}
include_once("estructura/pie.php");

?>