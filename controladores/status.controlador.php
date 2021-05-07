<?php

class ControladorStatus{
	static public function ctrMostrarStatus($item, $valor){
		$tabla = "status_producto";

		$respuesta = ModeloStatus::mdlMostrarStatus($tabla, $item, $valor);
		return $respuesta;
	}
}