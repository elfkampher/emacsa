<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{
	/*========================================
	=            EDITAR OBRA            =
	========================================*/
	
	public $idCliente;

	public function ajaxEditarCliente(){
		$item = "id_cliente";
		$valor = $this->idCliente;
		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);
		echo json_encode($respuesta);
	}
	
	/*=====  End of EDITAR OBRA  ======*/
	public function ajaxEliminarCliente(){
		$item = "id_cliente";
		$valor = $this->idCliente;
		$respuesta = ControladorClientes::ctrEliminarCliente($item, $valor);
		echo $respuesta;		
	}	
	
}

if(isset($_POST["idCliente"])){
	$Cliente = new AjaxClientes();
	$Cliente -> idCliente = $_POST["idCliente"];
	$Cliente -> ajaxEditarCliente();
}

if(isset($_POST["idCliented"])){
	$Cliente = new AjaxClientes();
	$Cliente -> idCliente = $_POST["idCliented"];
	$Cliente -> ajaxEliminarCliente();
}