<?php
include_once("../../../configuracion.php");
$sesion = new Session();
$abmUsuario = new abmUsuario();
$usuario = $abmUsuario->buscar(["usnombre" => $sesion->getUsuarioActual()], ["uspass" => $sesion->getPass()]);
$arreglo_salida=array();
if (count($usuario)==1){
    $idusuario=$usuario[0]->getIdusuario();
    $objControl=new abmCompraestado();
    $list=$objControl->buscar(null);
    foreach($list as $elem){
        $idElem=$elem->getObjCompra()->getObjUsuario()->getIdusuario();
        //Debe coincidir el id guardado en el objeto con el del usuario actual
        if ($idElem==$idusuario){
            $nuevoElem['idcompraestado']=$elem->getIdcompraestado();
            $nuevoElem['idcompra']=$elem->getObjCompra()->getIdcompra();
            $nuevoElem['idcompraestadotipo']=$elem->getObjCompraestadotipo()->getIdcompraestadotipo();
            $nuevoElem['cetdescripcion']=$elem->getObjCompraestadotipo()->getCetdescripcion();
            $nuevoElem['cefechaini']=$elem->getCefechaini();
            $nuevoElem['cefechafin']=$elem->getCefechafin();
            array_push($arreglo_salida,$nuevoElem);
        }
    }
}

echo json_encode($arreglo_salida);
?>