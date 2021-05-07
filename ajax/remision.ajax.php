<?php
require_once "../controladores/remisiones.controlador.php";

class AjaxRemision{
	public $contPDF;
	public function ajaxCrearRemision(){
		$contPDF = $this->contPDF;

		controladorRemision::ctrCrearRemision($contPDF);
	}
}

if(isset($_POST["contPDF"])){
	$crearPDF = new AjaxRemision();
	$crearPDF -> contPDF = $_POST["contPDF"];
	$crearPDF -> ajaxCrearRemision();
}