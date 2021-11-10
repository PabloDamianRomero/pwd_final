<?php
class UsuarioRol
{
    private $objUsuario;
    private $objRol;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->objUsuario = null;
        $this->objRol = null;
        $this->mensajeoperacion = "";
    }

    public function setear($objUsuario, $objRol)
    {
        $this->objUsuario = $objUsuario;
        $this->objRol = $objRol;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol WHERE idusuario = " . $this->getObjUsuario()->getIdUsuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idusuario'], $row['idrol']);
                }
            }
        } else {
            $this->setmensajeoperacion("usuariorol->cargar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuariorol(idusuario,idrol)  VALUES('" . $this->getObjUsuario()->getIdusuario() . "','" . $this->getObjRol()->getIdrol() . "');";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuariorol->insertar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuariorol->insertar-2: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuariorol SET idrol='" . $this->getObjRol()->getIdrol() . "' WHERE idusuario=" . $this->getObjUsuario()->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuariorol->modificar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuariorol->modificar-2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuariorol WHERE idusuario=" . $this->getObjUsuario()->getIdUsuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("usuariorol->eliminar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuariorol->eliminar-2: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $objRel = new Usuariorol();
                    $objUs=new Usuario();
                    $objUs->setIdusuario($row['idusuario']);
                    $objUs->cargar();
                    $objRol=new Rol();
                    $objRol->setIdrol($row['idrol']);
                    $objRol->cargar();
                    $objRel->setear($objUs,$objRol);
                    array_push($arreglo, $objRel);
                }
            }
        } else {
            $this->setmensajeoperacion("usuariorol->listar: " . $base->getError());
        }
        return $arreglo;
    }

    public function getObjUsuario()
    {
        return $this->objUsuario;
    }

    public function setObjUsuario($objUsuario)
    {
        $this->objUsuario = $objUsuario;
    }

    public function getObjRol()
    {
        return $this->objRol;
    }

    public function setObjRol($objRol)
    {
        $this->objRol = $objRol;
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
