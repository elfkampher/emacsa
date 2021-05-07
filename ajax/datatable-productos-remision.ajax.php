<?php

require_once "../controladores/productos.controlador.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos{
	/*==================================================
	=            MOSTRAR TABLA DE PRODUCTOS            =
	==================================================*/
	public function mostrarTablaProductos(){

		$item = null;
		$valor = null;

		$productos = ControladorProductos::ctrMostrarProductosRemision();
				
		if(count($productos)<>0){

			$datosJson = '{
				"data": [';
					for($i = 0; $i < count($productos); $i++){

						/*==================================================
						=            DEFINIMOS LAS ACCIONES            =
						==================================================*/

						$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id_producto"]."'>Agregar</button></div>";
						/*==================================================
						=            TRAEMOS IMAGEN DEL PRODUCTO            =
						==================================================
						$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
						==================================================
						=            TRAEMOS LA CATEGORIA                  =
						==================================================
						$item = "id_categoria";
						
						$valor = $productos[$i]["id_categoria"];

						$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

						==================================================
						=            TRRAEMOS EL STOCK                  =
						==================================================
						if($productos[$i]["stock"]<=10){
							$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
						}else if($productos[$i]["stock"]>=11 && $productos[$i]["stock"]<=15){
							$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
						}else{
							$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
						}*/
							

						$datosJson .= '[
							"'.($i+1).'",
							"'.$productos[$i]["tipo"].'",
							"'.$productos[$i]["marca"].'",
							"'.$productos[$i]["descripcion"].'",
							"'.$productos[$i]["cantidad"].'",
							"'.$productos[$i]["peso_unitario"].'",														
							"'.$productos[$i]["total"].'",							
							"'.$botones.	'"	
						],';
					}
			$datosJson = substr($datosJson, 0, -1);				
			$datosJson .= ']
			}';
		}else{
			$datosJson = '{"data":[]}';
		}

		echo $datosJson;

	}
}

/*==================================================
=            ACTIVAR TABLA DE PRODUCTOS            =
==================================================*/

$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

/*=====  End of ACTIVAR TABLA DE PRODUCTOS  ======*/

