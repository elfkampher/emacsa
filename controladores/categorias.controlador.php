<?php

class ControladorCategorias{

	/*========================================
	=            CREAR CATEGORIAS            =
	========================================*/
	static public function ctrCrearCategoria(){
		if(isset($_POST["nuevaCategoria"])){
			if(preg_match('/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["nuevaCategoria"])){

				$tabla = "categorias";

				$datos = $_POST["nuevaCategoria"];

				$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

				if($respuesta=="ok"){
					echo '<script>
					
							swal({
									type: "success",
									title: "La categoria ha sido guardada correctamente",
									showConfirmButton: true,
									confirmButtonText: "cerrar",
									closeOnConfirm: false
								}).then((result)=>{
									if(result.value){
										window.location = "categorias";
									}
								})

						</script>'; 					
				}

			}else{

				echo '<script>
					
					swal({
							type: "error",
							title: "!La categoria no puede ir vacia o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "categorias";
							}
						})

				</script>'; 
			}
		}
	}
	
	
	/*=====  End of CREAR CATEGORIAS  ======*/

		/*==========================================
	=            MOSTRAR CATEGORIAS            =
	==========================================*/
	
	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;
	}

		/*==========================================
	=            EDITAR CATEGORIA            =
	==========================================*/

	static public function ctrEditarCategoria(){
		if(isset($_POST["editarCategoria"])){
			if(preg_match('/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["editarCategoria"])){

				$tabla = "categorias";

				$datos =array("categoria"=>$_POST["editarCategoria"], "id_categoria"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if($respuesta=="ok"){
					echo '<script>
					
							swal({
									type: "success",
									title: "La categoria ha sido cambiada correctamente",
									showConfirmButton: true,
									confirmButtonText: "cerrar",
									closeOnConfirm: false
								}).then((result)=>{
									if(result.value){
										window.location = "categorias";
									}
								})

						</script>'; 					
				}

			}else{

				echo '<script>
					
					swal({
							type: "error",
							title: "!La categoria no puede ir vacia o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "categorias";
							}
						})

				</script>'; 
			}
		}
	}

	public static function ctrBorrarCategoria(){
		if(isset($_GET["idCategoria"])){
			$tabla = "categorias";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>
					
					swal({
							type: "success",
							title: "!La categoria ha sido borrada correctamente",
							showConfirmButton: true,
							confirmButtonText: "cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "categorias";
							}
						})

				</script>'; 
			}
		}
	}

}