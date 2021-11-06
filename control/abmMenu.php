<?php
class abmMenu{
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idmenu']))
                $where.=" and idmenu =".$param['idmenu'];
            if  (isset($param['menombre']))
                 $where.=" and menombre ='".$param['menombre']."'";
            if  (isset($param['medescripcion']))
                 $where.=" and medescripcion ='".$param['medescripcion']."'";     
            if  (isset($param['idpadre']))
            $where.=" and idpadre ='".$param['idpadre']."'";
            if  (isset($param['medeshabilitado']))
            $where.=" and medeshabilitado ='".$param['medeshabilitado']."'";
        }
        $arreglo = Menu::listar($where);  
        return $arreglo;
    }
}
?>