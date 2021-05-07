<?php

require_once "../controladores/obras.controlador.php";
require_once "../modelos/obras.modelo.php";

class AjaxObras{
	/*========================================
	=            EDITAR OBRA            =
	========================================*/
	
	public $idObra;
	public $obraConteo;
	public $idCliente;

	public function ajaxEditarObra(){
		$item = "id_obra";
		$valor = $this->idObra;
		$respuesta = ControladorObras::ctrMostrarObrasTodas($item, $valor);
		echo json_encode($respuesta);
	}
	
	/*=====  End of EDITAR OBRA  ======*/
	public function ajaxEliminarObra(){
		$item = "id_obra";
		$valor = $this->idObra;
		$respuesta = ControladorObras::ctrEliminarObras($item, $valor);
		echo $respuesta;		
	}	

	public function ajaxObraSesion(){
		$obraConteo = $this->obraConteo;		
		$respuesta = ControladorObras::ctrEstablecerObraConteo($obraConteo);
		echo $respuesta;
	}

	public function ajaxObrasCliente(){

		$item = "id_cliente";
		$valor = $this->idCliente;		
		$respuesta = ControladorObras::ctrMostrarObrasCliente($item, $valor);
		echo json_encode($respuesta);
	}
	
}

if(isset($_POST["idObra"])){
	$Obra = new AjaxObras();
	$Obra -> idObra = $_POST["idObra"];
	$Obra -> ajaxEditarObra();
}

if(isset($_POST["idObrad"])){
	$Obra = new AjaxObras();
	$Obra -> idObra = $_POST["idObrad"];
	$Obra -> ajaxEliminarObra();
}

if(isset($_POST["obraConteo"])){
	$Obra = new AjaxObras();
	$Obra -> obraConteo = $_POST["obraConteo"];
	$Obra -> ajaxObraSesion();
}

if(isset($_POST["idCliente"])){
	$ObrasCliente = new AjaxObras();
	$ObrasCliente -> idCliente = $_POST["idCliente"];
	$ObrasCliente -> ajaxObrasCliente();
}