<?php
class abmCompra
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto
     * Devuelve un objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idcompra', $param) and array_key_exists('cofecha', $param)
            and array_key_exists('idusuario', $param) and array_key_exists('metodo', $param)) {

            //creo objeto estadotipos
            $objUsuario = new Usuario();
            $objUsuario->setIdUsuario($param['idusuario']);
            $objUsuario->cargar();

            //agregarle los otros objetos
            $obj = new Compra();
            $obj->setear($param['idcompra'], $param['cofecha'], $objUsuario, $param['metodo']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompra'])) {
            $obj = new Compra();
            $obj->setIdcompra($param['idcompra']);
            $obj->cargar();
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idcompra'])) {
            $resp = true;
        }

        return $resp;
    }

    /**
     * Carga un objeto con los datos pasados por parámetro y lo
     * Inserta en la base de datos
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $retorno['respuesta'] = false;
        $param['idcompra'] = null;
        // date_default_timezone_set('America/Argentina/Buenos_Aires');
        $date = date('Y-m-d H:i:s');
        $param['cofecha']=$date;
        $elObjtArchivoE = $this->cargarObjeto($param);
        if ($elObjtArchivoE != null and $elObjtArchivoE->insertar()) {
            $retorno['respuesta'] = true;
            $retorno['idcompra']=$elObjtArchivoE->getIdcompra();

        }
        return $retorno;
    }

    /**
     *
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtCompra = $this->cargarObjetoConClave($param);
            if ($elObjtCompra!=null){
                if ($elObjtCompra->eliminar()){
                    $resp = true;
                }
            }
        }
        return $resp;
    }

    /**
     * Carga un obj con los datos pasados por parámetro y lo modifica en base de datos (update)
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtArchivoE = $this->cargarObjeto($param);
            if ($elObjtArchivoE != null and $elObjtArchivoE->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompra'])) {
                $where .= " and idcompra =" . $param['idcompra'];
            }

            if (isset($param['cofecha'])) {
                $where .= " and cofecha ='" . $param['cofecha'] . "'";
            }

            if (isset($param['idusuario'])) {
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
            }
            if (isset($param['metodo'])) {
                $where .= " and metodo ='" . $param['metodo'] . "'";
            }

        }
        $arreglo = Compra::listar($where);
        return $arreglo;
    }

    public function bajaCarrito(){
        $sesion=new Session();
        $objUsuario=$sesion->getUsuario();
        $idusuario=$objUsuario->getIdusuario();
        $comprasUs=$this->buscar(['idusuario'=>$idusuario,'metodo'=>'carrito']);
        if (count($comprasUs)==1){
            $abmItems=new abmCompraitem();
            $items=$abmItems->buscar(['idcompra'=>$comprasUs[0]->getIdcompra()]);
            if (!empty($items)){
                foreach($items as $item){
                    $abmItems->baja(['idcompraitem'=>$item->getIdcompraitem()]);
                }
                $this->baja(['idcompra'=>$comprasUs[0]->getIdcompra()]);
            }
        }
    }


    //  Recibe como parametro 'idcompra'
    //  La funcion debe dar de alta la compra en carrito
    //  Se retorna un string con el enlace que llevara el header
    public function compraCarrito($param){
        //Chequeo si hay stock disponible
        $compra=$this->buscar(['idcompra'=>$param['idcompra']]);
        $abmItems=new abmCompraitem();
        $items=$abmItems->buscar(['idcompra']);
        $abmProd=new abmProducto();
        $sinStock=false;
        foreach($items as $item){
            $producto=$item->getObjProducto();
            $cantidad=($producto->getProcantstock())-($item->getCicantidad());
            if ($cantidad < 0){
                $sinStock=true;
                //Elimino el producto sin stock del carrito
                $abmItems->baja(['idcompraitem'=>$item->getIdcompraitem()]);
            }
        }
        if (!$sinStock){
            //Cambio el metodo de compra de 'carrito' a 'normal' para que no se cargue en la tabla de carrito.
            $this->modificacion(['idcompra'=>$param['idcompra'],'cofecha'=>$compra[0]->getCofecha(),'idusuario'=>$compra[0]->getObjUsuario()->getIdusuario(),'metodo'=>'normal']);
            //Pongo la compra en estado 'iniciada'
            $abmEstado=new abmCompraestado();
            $resp=$abmEstado->alta(['idcompra'=>$param['idcompra'],'idcompraestadotipo'=>1,'cefechaini'=>date('Y-m-d H:i:s')]);
            if ($resp){
                //Resto los items comprados del stock
                foreach($items as $item){
                    $producto=$item->getObjProducto();
                    $cantidad=($producto->getProcantstock())-($item->getCicantidad());
                    $abmProd->modificacion(['idproducto'=>$producto->getIdproducto(),'pronombre'=>$producto->getPronombre(),'prodetalle'=>$producto->getProdetalle(),'proprecio'=>$producto->getProprecio(),'prodeshabilitado'=>$producto->getProdeshabilitado(),'procantstock'=>$cantidad]);
                }
                $header="Location:../../retornoCompra.php?resp=exito";
            }else{
                $header="Location:../../retornoCompra.php?resp=fallo";
            }
        }else{
            $header="Location:../../retornoCompra.php?resp=stock";
        }
        
        return $header;
    }

    //  Recibe como parametro 'idproducto' e 'idcantidad'
    //  La funcion debe dar de alta la compra individual
    //  Se retorna un string con el enlace que llevara el header
    public function compraDirecta($param){
        //Chequeo si hay stock disponible
        $sinStock=false;
        $abmProd=new abmProducto();
        $producto=$abmProd->buscar(['idproducto'=>$param['idproducto']]);
        if (count($producto)==1){
            if ($producto[0]->getProcantstock()<$param['cicantidad']){
                $sinStock=true;
            }
        }else{
            $header='Location:../../retornoCompra.php?resp=fallo';
        }
        if (!$sinStock){
            $sesion=new Session();
            $objUsuario=$sesion->getUsuario();
            $idusuario=$objUsuario->getIdusuario();
            //Doy de alta la compra
            $resp=$this->alta(['idusuario'=>$idusuario, 'metodo'=>'normal']);
            if ($resp['respuesta']){
                //Doy de alta a la compra de items
                $abmCompItem=new abmCompraitem();
                $respItem=$abmCompItem->alta(["idproducto"=>$param['idproducto'],"idcompra"=>$resp['idcompra'],"cicantidad"=>$param['cicantidad']]);            
                if ($respItem){
                    //Pongo la compra en estado 'iniciada'
                    $abmEstado=new abmCompraestado();
                    $respEst=$abmEstado->alta(['idcompra'=>$resp['idcompra'],'idcompraestadotipo'=>1,'cefechaini'=>date('Y-m-d H:i:s')]);
                    if ($respEst){
                        //Resto los items comprados del stock
                        if (count($producto)==1){
                            $cantidad=($producto[0]->getProcantstock())-($param['cicantidad']);
                            $respProd=$abmProd->modificacion(['idproducto'=>$producto[0]->getIdproducto(),'pronombre'=>$producto[0]->getPronombre(),'prodetalle'=>$producto[0]->getProdetalle(),'proprecio'=>$producto[0]->getProprecio(),'prodeshabilitado'=>$producto[0]->getProdeshabilitado(),'procantstock'=>$cantidad]);
                            if ($respProd){
                                $header='Location:../../retornoCompra.php?resp=exito';
                            }else{
                                $header='Location:../../retornoCompra.php?resp=fallo';
                            }
                        }
                    }else{
                        $header='Location:../../retornoCompra.php?resp=fallo';
                    }
                }else{
                    $header='Location:../../retornoCompra.php?resp=fallo';
                }
                
            }else{
                $header='Location:../../retornoCompra.php?resp=fallo';
            }
        }else{
            $header='Location:../../retornoCompra.php?resp=stock';
        }
        
        return $header;
    }



    //  Realiza la orden o encargo de la compra del producto
    //  Retorna el enlace del header dependiendo de si se tuvo exito o no. En caso de tener exito tambien varia si la compra es individual o en carrito
    public function ordenCompra($param){
        if (isset($param['orden'])){
            $sesion=new Session();
            $objUsuario=$sesion->getUsuario();
            $idusuario=$objUsuario->getIdusuario();
            //Busco compras agregadas al carrito por el usuario activo
            $comprasUs=$this->buscar(['idusuario'=>$idusuario,'metodo'=>'carrito']);
            if (!empty($comprasUs)){
                if (count($comprasUs)==1){  //Solo puede haber 1 carrito activo
                    $abmCompItem=new abmCompraitem();
                    //Chequeo si en la compra ya se habia encargado el mismo producto
                    $itemsPrevios=$abmCompItem->buscar(['idcompra'=>$comprasUs[0]->getIdcompra()]);
                    $encontrado=false;
                    if (!empty($itemsPrevios)){
                        foreach($itemsPrevios as $item){
                            if ($item->getObjProducto()->getIdproducto()==$param['idproducto']){
                                $encontrado=true;
                                //Controlo stock
                                $cantidad=($item->getCicantidad())+($param['cantidad']);
                                if ($cantidad<=($item->getObjProducto()->getProcantstock())){
                                    $abmCompItem=new abmCompraitem();
                                    $respCant=$abmCompItem->modificacion(['idcompraitem'=>$item->getIdcompraitem(),'idproducto'=>$param['idproducto'],'idcompra'=>$comprasUs[0]->getIdcompra(),'cicantidad'=>$cantidad]);
                                    if ($respCant){
                                        $header='Location:../../carrito.php';
                                    }else{
                                        $header="Location:../../productos.php?idproducto=".$param['idproducto']."&error=1";
                                    }
                                }else{
                                    $header="Location:../../productos.php?idproducto=".$param['idproducto']."&error=2";
                                }
                            }
                        }
                    }
                    if (!$encontrado){
                        $respItem=$abmCompItem->alta(['idproducto'=>$param['idproducto'],'idcompra'=>$comprasUs[0]->getIdcompra(),'cicantidad'=>$param['cantidad']]);
                        if ($respItem){
                            $header='Location:../../carrito.php';
                        }else{
                            $header="Location:../../productos.php?idproducto=".$param['idproducto']."&error=1";
                        }
                    }
                    
                }else{
                    $header="Location:../../productos.php?idproducto=".$param['idproducto']."&error=1";
                }
            }else{  //Si no hay carritos activos inicio uno.
                $resp=$this->alta(['idusuario'=>$idusuario,'metodo'=>'carrito']);
                if ($resp['respuesta']){
                    $abmCompItem=new abmCompraitem();
                    $respItem=$abmCompItem->alta(['idproducto'=>$param['idproducto'],'idcompra'=>$resp['idcompra'],'cicantidad'=>$param['cantidad']]);
                    if ($respItem){
                        $header='Location:../../carrito.php';
                    }else{
                        $header="Location:../../productos.php?idproducto=".$param['idproducto']."&error=1";
                    }
                }else{
                    $header="Location:../../productos.php?idproducto=".$param['idproducto']."&error=1";
                }
            }

        }elseif (isset($param['compra'])){
            $header='Location:../../tiendaCompra.php?metodo=directa&idproducto='.$param['idproducto'].'&cantidad='.$param['cantidad'].'&maxStock='.$param['maxStock'];

        }

        return $header;
    }
}
