<?php
    $titulo = "Gestionar Compras";
    $estructuraAMostrar = "desdeVista";
    $seguro = true;
    include_once "estructura/cabecera.php";

    // ---------------------- Verificar si el sub-enlace del menú está habilitado -------------------------------
    $i = 0;
    $existeSubEnlace = false;
    if(isset($arrSubMenu)){
        while(($i < count($arrSubMenu)) && (!$existeSubEnlace)){
            $subMenuActual = $arrSubMenu[$i];
            if(($subMenuActual->getMedeshabilitado() != "0000-00-00 00:00:00") && ($subMenuActual->getMedescripcion() == "cliente_compras")){
                $existeSubEnlace = true;
            }
            $i++;
        }
    }
    // ----------------------------------------------------------------------------------------------------------

    // ---------------------- Si el usuario actual no tiene permisos  -------------------------------
    $permiso=false;
    foreach ($arrMenu as $menu){
        if (($menu->getObjMenu()->getMedescripcion()=="cliente_compras") && ($menu->getObjMenu()->getMedeshabilitado()=="0000-00-00 00:00:00")){
            $permiso=true;
        }
    }
    if(!$permiso){?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    No puede gestionar Compras (No tiene permisos de Rol o la página está deshabilitada).
            </div>
        </div>
    </div>
<?php
// ----------------------------------------------------------------------------------------------------------


// ---------------------- Si es cliente pero el enlace-menu(padre) no está disponible  -------------------------------
}else if(($rolActivo->getIdrol() == 3) && (!isset($arrMenuPadre))){
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

// ---------------------- Si es admin y existe el enlace-menu (padre e hijo)  ------------------------------- 
?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;margin-bottom: 50px;">
            <div class="container">
                <h1 class="display-6 fuente-monts">Gestión de Compras</h1>
                <p class="lead">En esta página el cliente puede gestionar el estado de la compra.</p>
            </div>
        </div>
    

        <table id="dg" title="Compras" class="easyui-datagrid" style="width:800px;height:400px"
                url="accion/cliente/listar_compras.php"
                toolbar="#toolbar" pagination="true"
                rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idcompraestado" width="30">ID Estado</th>
                    <th field="idcompra" width="30">ID Compra</th>
                    <th field="idcompraestadotipo" width="30">ID EstTipo</th>
                    <th field="cetdescripcion" width="30">Estado</th>
                    <th field="cefechaini" width="60">Fecha Inicio</th>
                    <th field="cefechafin" width="60">Fecha Fin</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="cancelarCompraCl()">Cancelar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="detallesCompraCl()">Detalles</a>
        </div>
        
        <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion Compra</h3>
                <div style="margin-bottom:10px">
                    <input name="idcompraestado" value="idcompraestado" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="idcompra" value="idcompra" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="idcompraestadotipo" value="idcompraestadotipo" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="cetdescripcion" value="cetdescripcion" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="cefechaini" value="cefechaini" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="cefechafin" value="cefechafin" class="easyui-textbox" style="width:100%">
                </div>
            </form>
        </div>
    </div>


<?php
}
include_once "estructura/pie.php";
?>