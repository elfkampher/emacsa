<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

/*======================================
=            Editar Usuario            =
======================================*/

	public $idUsuario;

	public function ajaxEditarUsuario(){
		$item = "id_usuarios";
		$valor = $this->idUsuario;
		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

	public $activarUsuario;
	public $activarId;
	

	/*==Funcion que activa el usuario llamando directamente el modelo y saltando el controlador==*/
	public function ajaxActivarUsuario(){

		$tabla = "usuarios";
		$item1 = "estado";
		$valor1 = $this->activarUsuario;
		$item2 = "id_usuarios";
		$valor2 = $this->activarId;
		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
		echo $respuesta;
		//echo "<p>algo</p>";

	}

	/*=====  End of Editar Usuario  ======*/

	/*======================================
	=            VALIDAR USARIO            =
	======================================*/
	public $validarUsuario;

	public function ajaxValidarUsuario(){

		$item = "usuario";
		$valor = $this->validarUsuario;
		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}


	/*=====  End of VALIDAR USARIO  ======*/



}

if(isset($_POST["idUsuario"])){

	$editar = new AjaxUsuarios();
	$editar-> idUsuario = $_POST["idUsuario"];
	$editar-> ajaxEditarUsuario();
}


if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();
}

/*========================================================
=            VALIDAR QUE NO SE REPITA USUARIO            =
========================================================*/

if(isset($_POST["validarUsuario"])){
	
	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();
}


/*=====  End of VALIDAR QUE NO SE REPITA USUARIO  ======*/
