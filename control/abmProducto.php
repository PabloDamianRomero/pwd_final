<?php
class abmProducto{
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idproducto']))
                $where.=" and idproducto =".$param['idproducto'];
            if  (isset($param['pronombre']))
                 $where.=" and pronombre ='".$param['pronombre']."'";
            if  (isset($param['prodetalle']))
            $where.=" and prodetalle ='".$param['prodetalle']."'";
            if  (isset($param['cantstock']))
            $where.=" and cantstock ='".$param['cantstock']."'";
        }
        $arreglo = Producto::listar($where);  
        return $arreglo;
    }
}
?>