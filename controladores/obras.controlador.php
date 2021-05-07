<?php

class ControladorObras{
	/*=====================================
	=            Mostrar Obras            =
	=====================================*/
	
	static public function ctrMostrarObras($item, $valor){
		$tabla = "obra";

		$respuesta = ModeloObras::mdlMostrarObras($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarObrasTodas($item, $valor){
		$tabla = "obra";

		$respuesta = ModeloObras::mdlMostrarObrasTodas($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarObrasCliente($item, $valor){
		$tabla = "obra";

		$respuesta = ModeloObras::mdlMostrarObrasCliente($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarStatus($item, $obra){
		$tabla ="status_obra";

		$respuesta = ModeloObras::mdlMostrarStatus($tabla, $item, $obra);
		return $respuesta;
	}
	
	/*=====  End of Mostrar Obras  ======*/

	static public function ctrCrearObra(){
		if(isset($_POST["nuevaObra"])){
			$tabla = "obra";

			$datos = array("obra"=>$_POST["nuevaObra"],
							"id_cliente"=>$_POST["nuevoCliente"],
							"id_status_obra"=>$_POST["nuevoStatus"]);

			$respuesta = ModeloObras::mdlIngresarObra($tabla, $datos);

			if($respuesta=="ok"){
				echo '<script>
					
					swal({
							type: "success",
							title: "La obra ha sido registrada correctamente",
							showConfirmButton: true,
							confirmButtonText: "cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "obras";
							}
						})

				</script>'; 
			}

		}
	}

	/*==========================================
	=            EDITAR OBRA
	==========================================*/

	static public function ctrEditarObra(){
		if(isset($_POST["editarObra"])){			

			$tabla = "obra";

			$datos =array("obra"=>$_POST["editarObra"], 
				"id_obra"=>$_POST["idObra"],
				"id_cliente"=>$_POST["editarCliente"],
				"id_status_obra"=>$_POST["editarStatus"]);

			$respuesta = ModeloObras::mdlEditarObra($tabla, $datos);

			if($respuesta=="ok"){
				echo '<script>
				
						swal({
								type: "success",
								title: "La obra ha sido editada correctamente",
								showConfirmButton: true,
								confirmButtonText: "cerrar",
								closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
									window.location = "obras";
								}
							})

					</script>'; 					
			}
		}
	}

	public static function ctrEliminarObras($item, $valor){
		session_start();
		$tabla = "obra";
		$datos = $valor;
		if($_SESSION["id_perfil"]==9){
			$respuesta = ModeloObras::mdlBorrarObra($tabla, $datos);

			if($respuesta == "ok"){
				echo "ok";		 
			}	
		}else{
			echo "error";		
		}			
		
	}

	static public function ctrEstablecerObraConteo($obraConteo){
		session_start();
		$_SESSION["obraConteo"]=$obraConteo;
		var_dump($_SESSION);
	}
	
}