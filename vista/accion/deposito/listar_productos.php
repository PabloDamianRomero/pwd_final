<?php
include_once("../../../configuracion.php");
$data=data_submitted();
$objControl=new abmProducto();
$list=$objControl->buscar($data);
$arreglo_salida=array();
foreach($list as $elem){
    $nuevoElem['idproducto']=$elem->getIdproducto();
    $nuevoElem['pronombre']=$elem->getPronombre();
    $nuevoElem['prodetalle']=$elem->getProdetalle();
    $nuevoElem['proprecio']=$elem->getProprecio();
    $nuevoElem['procantstock']=$elem->getProcantstock();
    $nuevoElem['prodeshabilitado']=$elem->getProdeshabilitado();
    $rutaImagen = $GLOBALS['ROOT']."/vista/archivos/productos/img/".$elem->getProdetalle().".jpg";
    if (file_exists($rutaImagen)) {
        $nuevoElem['proImg']= '<a href="archivos/productos/img/'.$elem->getProdetalle().'.jpg"><img width="35" src="archivos/productos/img/'.$elem->getProdetalle().'.jpg"></a>';
    }else{
        $nuevoElem['proImg']= 'Sin imagen';
    }
    array_push($arreglo_salida,$nuevoElem);
}
echo json_encode($arreglo_salida);
?>