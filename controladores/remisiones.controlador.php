<?php

class ControladorRemisiones{

	static public function ctrMostrarRemisiones($item, $valor){

		$tabla = "remision";

		$respuesta = ModeloRemisiones::mdlMostrarRemisiones($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrCrearRemision(){

		if(isset($_POST["nuevaRemision"])){

			/*=============================================================================
			=            ACTUALIZAR EL STATUS DE LOS PRODUCTOS REMISIONADOS
			=============================================================================*/
			
			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {
				
				$tablaProductos = "productos";

				$item = "id_producto";
				$valor = $value["id_producto"];
				$obra = null;

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $obra);

				$item1a = "status";
				$valor1a = 15;

				$nuevasRemisiones = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				
			}
			

			/*=========================================
			=            GUARDAR LA REMISION            =
			=========================================*/
			
			$tabla = "remision";

			$datos = array("id_usuario"=>$_POST["idUsuario"],
							"id_cliente"=>$_POST["seleccionarCliente"],
							"id_obra"=>$_POST["seleccionarObra"],
							"clave"=>$_POST["nuevaRemision"],
							"productos"=>$_POST["listaProductos"]);


			$respuesta = ModeloRemisiones::mdlIngresarRemision($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>
					localStorage.removeItem("rango");

					swal ({
							type:"success",
							title:"la remision ha sido guardada correctamente",
							showConfirmButton: true,
							confirmButtonText: "cerrar"}).then((result)=> {
								if(result.value){
									window.location = "remisiones";
								}
							})
				</script>';
			}
			
			/*=====  End of GUARDAR LA REMISION  ======*/
			
			
		}

	}
	
	/*=====  End of CREAR REMISION  ======*/

	/*===================================
	=            CREAR REMISION            =
	===================================*/
	
	static public function ctrEditarRemision(){

		if(isset($_POST["editarRemision"])){


			/*=============================================================================
			=            FORMATEAR TABLA PRODUCTOS Y TABLA CLIENTES            =
			=============================================================================*/
			$tabla="remision";
			
			$item = "id_remision";
			$valor = $_POST["editarRemision"];

			$traerRemision = ModeloRemisiones::mdlMostrarRemisiones($tabla, $item, $valor);

			/*============================================================
			=            REVISAR SI VIENE PRODUCTOS EDITADOS            =
			=============================================================*/
			
			$cambioProducto = false;

			if($_POST["listaProductos"]==""){
				
				$listaProductos = $traerRemision["productos"];
				$cambioProducto = false;

			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;

			}

			if($cambioProducto){

				$productos = json_decode($traerRemision["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {					
					
					$tablaProductos = "productos";
					$item ="id_producto";
					$valor = $value["id_producto"];
					$obra = null;

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $obra);

					$item1a = "status";
					$valor1a = 7;

					$nuevasRemisiones = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor); 
					
				}

				
				
				/*=============================================================================
				=            ACTUALIZAR STATUS DE LOS PRODUCTOS
				=============================================================================*/
				
				$listaProductos_2 = json_decode($listaProductos, true);
				

				foreach ($listaProductos_2 as $key => $value) {					
					
					$tablaProductos_2 = "productos";

					$item_2 = "id_producto";
					$valor_2 = $value["id_producto"];
					$obra = null;

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $obra);
					
					$item1a_2 = "status";
					$valor1a_2 = 15;

					$nuevasRemisiones_2 = ModeloProductos::MdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					
				}			
				

			}			
			

			/*=========================================
			=            GUARDAR CAMBIOS DE LA COMPRA            =
			=========================================*/

			$datos = array("id_usuario"=>$_POST["idUsuario"],
							"id_cliente"=>$_POST["seleccionarCliente"],
							"id_remision"=>$_POST["editarRemision"],
							"id_obra" =>$_POST["seleccionarObra"],
							"productos"=>$listaProductos);


			$respuesta = ModeloRemisiones::mdlEditarRemision($tabla, $datos);

			var_dump($respuesta);

			if($respuesta == "ok"){

				echo '<script>
					localStorage.removeItem("rango");

					swal ({
							type:"success",
							title:"la remision ha sido editada correctamente",
							showConfirmButton: true,
							confirmButtonText: "cerrar"}).then((result)=> {
								if(result.value){
									window.location = "remisiones";
								}
							})
				</script>';
			}
			
			/*=====  End of GUARDAR REMISION  ======*/
			
			
		}

	}
	
	/*=====  End of EDITAR REMISION  ======*/

	/*======================================
	=            ELIMINAR REMISION
	======================================*/
	
	static public function ctrEliminarRemision(){

		if(isset($_GET["idRemision"])){

			$tabla = "remision";
			$item = "id_remision";
			$valor = $_GET["idRemision"];

			$traerRemision = ModeloRemisiones::mdlMostrarRemisiones($tabla, $item, $valor);

			/*================================================
			=            ACTUALIZAR ULTIMA COMPRA            =
			================================================*/

			
			/*===============================================================
						=            FORMATEAR TABLA DE PRODUCTOS Y CLIENTES            =
			===============================================================*/
						
				$productos = json_decode($traerRemision["productos"], true);
				
				foreach ($productos as $key => $value) {					
					
					$tablaProductos = "productos";
					$item ="id_producto";
					$valor = $value["id_producto"];
					$obra = null;

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $obra);

					$item1a = "status";
					$valor1a = 7;

					$nuevasRemisiones = ModeloProductos::MdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor); 
					
				}
				
				/*=====  End of FORMATEAR TABLA DE PRODUCTOS Y CLIENTES  ======*/

				$respuesta = ModeloRemisiones::mdlEliminarRemision($tabla, $_GET["idRemision"]);

				if($respuesta == "ok"){
					echo '<script>
						
						swal({
							type: "success",
							title: "La remision ha sido borrada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result)=> {
								if(result.value){
									window.location = "remisiones";
								}
							})
					</script>';
				}
									

		}	

	}
	
	/*=====  End of ELIMINAR REMISION  ======*/
	
}

?>