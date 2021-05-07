<?php 

class ControladorDistribuidores{

	static public function ctrCrearDistribuidor(){
		$tabla = "dealers";
		if(isset($_POST["nuevoNombre"])){

			$datos = $_POST["nuevoNombre"];
			$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
			if($respuesta=="ok"){
				echo '<script>
					swal({
							type:"success",
							title:"El distribuidor ha sido guardado correctamente",
							showConfirmButton:true,
							confirmButtonText: "cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "clientes";
							}
						});
				</script>';
			}	

		}
		
	}

	static public function ctrMostrarDistribuidores($item, $valor){

		$tabla = "dealers";
		$respuesta = ModeloDistribuidores::mdlMostrarDistribuidores($tabla, $item, $valor);

		return $respuesta;
	}

	public static function ctrEditarDistribuidor(){
		if(isset($_POST["editarNombre"])){
			$tabla = "dealers";

			$datos =array("nombre"=>$_POST["editarNombre"], 
				"id_cliente"=>$_POST["idCliente"]);

			$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
			var_dump($respuesta);			
			if($respuesta=="ok"){
				echo '<script>
				
						swal({
								type: "success",
								title: "El cliente ha sido editado correctamente",
								showConfirmButton: true,
								confirmButtonText: "cerrar",
								closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
									window.location = "clientes";
								}
							})

					</script>'; 					
			}else{
				echo '<script>
				
						swal({
								type: "error",
								title: "No se ha podido editar el cliente, verifique con el administrador",
								showConfirmButton: true,
								confirmButtonText: "cerrar",
								closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
									window.location = "clientes";
								}
							})

					</script>';
			}
		}
	}

	public static function ctrEliminarCliente($item,$valor){
		
		$tabla = "cliente";
		$id_cliente = $valor;

		$respuesta = ModeloClientes::mdlBorrarCliente($tabla, $id_cliente);

		if($respuesta == "ok"){
			echo "ok"; 
		}else{
			echo "error";
		}
		
	}
}