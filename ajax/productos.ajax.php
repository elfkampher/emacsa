<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{
	/*=============================================
	=            GENERAR CODIGO A PARTIR DE ID CATEGORIA =
	=============================================*/
	public $idCategoria;
	public $idProducto;
	public function ajaxCrearCodigoProducto(){

		$item = "id_categoria";
		$valor = $this->idCategoria;

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

		echo json_encode($respuesta);


	}

	public function ajaxEditarProducto(){
		
		$item = "id_producto";
		$valor = $this->idProducto;
				
		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
		echo json_encode($respuesta);
	}

	public function ajaxRechazarProducto(){
		
		$id_conteo = $this->idConteo;
		$id_producto = $this->idProducto;
		$id_status = $this->idStatus;

		ControladorProductos::ctrRechazarProducto($id_conteo, $id_producto, $id_status);
	}

	public $obraProductos;
	
	public function ajaxObraSesion(){
		$obraProductos = $this->obraProductos;		
		$respuesta = ControladorProductos::ctrEstablecerObraProductos($obraProductos);
		echo $respuesta;
	}
	

	//Validando que un producto no se pueda dar de alta 2 veces en la misma obra
	public $validarMarca;
	public $validarObra;
	
	public function ajaxValidarMarca(){

		$marca = $this->validarMarca;
		$idObra = $this->validarObra;
		$respuesta = ControladorProductos::ctrValidarMarca($marca, $idObra);

		echo json_encode($respuesta);
	}
}

if(isset($_POST["idCategoria"])){


	$codigoProducto = new AjaxProductos();
	$codigoProducto -> idCategoria = $_POST["idCategoria"];
	$codigoProducto -> ajaxCrearCodigoProducto();
}

if(isset($_POST["idProducto"])){
	$editarProducto = new AjaxProductos();
	$editarProducto -> idProducto = $_POST["idProducto"];
	$editarProducto -> ajaxEditarProducto();
}
if(isset($_POST["rechazar"])){
	$editarConteo = new AjaxProductos();
	$editarConteo -> idProducto = $_POST["idProductor"];
	$editarConteo -> idConteo = $_POST["idConteor"];
	$editarConteo -> idStatus = $_POST["idStatusr"];
	$editarConteo -> ajaxRechazarProducto();
}

if(isset($_POST["obraProductos"])){
	$Obra = new AjaxProductos();
	$Obra -> obraProductos = $_POST["obraProductos"];
	$Obra -> ajaxObraSesion();
}

if(isset($_POST["validarMarca"])){
	$marca = new AjaxProductos();
	$marca -> validarMarca = $_POST["validarMarca"];
	$marca -> validarObra = $_POST["validarObra"];
	$marca -> ajaxValidarMarca();
}

