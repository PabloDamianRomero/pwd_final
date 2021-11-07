<?php
class Compra
{
    private $idcompra;
    private $cofecha;
    private $objUsuario;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idcompra = "";
        $this->cofecha = "";
        $this->objUsuario = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idcompra, $cofecha, $objUsuario)
    {
        $this->idcompra = $idcompra;
        $this->cofecha = $cofecha;
        $this->objUsuario = $objUsuario;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra WHERE idcompra = " . $this->getIdcompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $abmUsuario = new abmUsuario();
                    $objUsuario = $abmUsuario->buscar(['idusuario' => $row['idusuario']]);
                    if (empty($objUsuario)) {
                        $objUsuario = null;
                    } else {
                        $objUsuario = $objUsuario[0];
                    }
                    $this->setear($row['idcompra'], $row['cofecha'], $objUsuario);
                }
            }
        } else {
            $this->setmensajeoperacion("Compra->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compra(cofecha,idusuario)  VALUES('" . $this->getCofecha() . "','" . $this->getObjUsuario()->getIdusuario() . "');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompra($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->insertar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->insertar-2: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compra SET cofecha='" . $this->getCofecha() . "', idusuario= '" . $this->getObjUsuario()->getIdusuario() . "' WHERE idcompra=" . $this->getIdcompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->modificar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->modificar-2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compra WHERE idcompra=" . $this->getIdcompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Compra->eliminar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->eliminar-2: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Compra();
                    $abmUsuario = new abmUsuario();
                    $objUsuario = $abmUsuario->buscar(['idusuario' => $row['idusuario']]);
                    if (empty($objUsuario)) {
                        $objUsuario = null;
                    } else {
                        $objUsuario = $objUsuario[0];
                    }
                    $obj->setear($row['idcompra'], $row['cofecha'], $objUsuario);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("Compra->listar: " . $base->getError());
        }
        return $arreglo;
    }

    public function getIdcompra()
    {
        return $this->idcompra;
    }

    public function setIdcompra($idcompra)
    {
        $this->idcompra = $idcompra;
    }

    public function getCofecha()
    {
        return $this->cofecha;
    }

    public function setCofecha($cofecha)
    {
        $this->cofecha = $cofecha;
    }

    public function getObjUsuario()
    {
        return $this->objUsuario;
    }

    public function setObjUsuario($objUsuario)
    {
        $this->objUsuario = $objUsuario;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }
}
