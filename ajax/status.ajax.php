<?php

require_once "../controladores/status.controlador.php";
require_once "../modelos/status.modelo.php";

class AjaxStatus{
	public $idStatus;

	public function ajaxEditarStatus(){
		$item = "id_status";
		$valor = $this->idStatus;

		$respuesta = ControladorStatus::ctrMostrarStatus($item, $valor);
		echo json_encode($respuesta);

	}
}

if(isset($_POST["idStatus"])){
	$editarStatus = new AjaxStatus();
	$editarStatus ->idStatus = $_POST["idStatus"];
	$editarStatus -> ajaxEditarStatus();
}