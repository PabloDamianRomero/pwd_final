<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();
    $resp=false;
    if (isset($datos['idcompraestado']) && isset($datos['cetdescripcion']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin'])){
        $abmEstado=new abmCompraestado();
        $colEstados=$abmEstado->buscar(['idcompra'=>$datos['idcompra']]);
        if (count($colEstados)==$datos['idcompraestadotipo']){
            if ($datos['cetdescripcion']=="iniciada" || $datos['cetdescripcion']=="aceptada"){
                //Le doy fin al estado actual
                $resp=$abmEstado->modificacion(['idcompra'=>$datos['idcompra'],'idcompraestado'=>$datos['idcompraestado'],'idcompraestadotipo'=>$datos['idcompraestadotipo'],'cefechaini'=>$datos['cefechaini'],'cefechafin'=>date('Y-m-d H:i:s')]);
                if ($resp){
                    //Inicio un nuevo estado
                    if ($datos['cetdescripcion']=="iniciada"){
                        $resp=$abmEstado->alta(['idcompra'=>$datos['idcompra'],'idcompraestadotipo'=>2,'cefechaini'=>date('Y-m-d H:i:s')]);
                    }elseif($datos['cetdescripcion']=="aceptada"){
                        $resp=$abmEstado->alta(['idcompra'=>$datos['idcompra'],'idcompraestadotipo'=>3,'cefechaini'=>date('Y-m-d H:i:s')]);
                    }
                    if (!$resp){
                        $retorno['errorMsg']="Hubo un problema en la creacion del nuevo estado.";
                    }
                    
                }else{
                    $retorno['errorMsg']="Hubo un problema en la modificacion del estado.";
                }
            }else{
                $retorno['errorMsg']="Solo puede actualizarse el estado si es 'iniciada' o 'aceptada'.";
            }
        }else{
            $retorno['errorMsg']="La compra ya se encuentra en un estado mas avanzado.";
        }
    }else{
        $retorno['errorMsg']="Faltan parametros.";
    }
    $retorno['respuesta']=$resp;
    echo json_encode($retorno);
?>