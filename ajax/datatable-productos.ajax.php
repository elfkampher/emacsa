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

		if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		$item = null;
		$valor = null;

		$productos = ControladorProductos::ctrMostrarProductos($item, $valor);
		
		
		if(count($productos)<>0){			
						
			$datosJson = '{
				"data": [';
					for($i = 0; $i < count($productos); $i++){

						/*==================================================
						=            DEFINIMOS LAS ACCIONES            =
						==================================================*/
						if($_SESSION["id_perfil"]==1 || $_SESSION["id_perfil"]==9){
							
							$boton = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto = '".$productos[$i]["id_producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id_producto"]."' codigo='".$productos[$i]["marca"]."'><i class='fa fa-times'></i></button></div>";

						}else{
							$boton = "";
						}
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
							"'.$productos[$i]["longitud"].'",
							"'.$productos[$i]["peso_unitario"].'",
							"'.$productos[$i]["total"].'",
							"'.$productos[$i]["obra"].'",
							"'.$boton.	'"	
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

