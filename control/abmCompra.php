<?php
class abmCompra{
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idcompra']))
                $where.=" and idcompra =".$param['idcompra'];
            if  (isset($param['cofecha']))
                 $where.=" and cofecha ='".$param['cofecha']."'";
            if  (isset($param['idusuario']))
            $where.=" and idusuario ='".$param['idusuario']."'";
        }
        $arreglo = Compra::listar($where);  
        return $arreglo;
    }
}
?>