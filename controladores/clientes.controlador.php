<?php 

class ControladorClientes{

	static public function ctrCrearCliente(){
		$tabla = "cliente";
		if(isset($_POST["nuevoNombre"])){

			$datos = $_POST["nuevoNombre"];
			$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
			if($respuesta=="ok"){
				echo '<script>
					swal({
							type:"success",
							title:"El cliente ha sido guardado correctamente",
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

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "cliente";
		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
	}

	public static function ctrEditarCliente(){
		if(isset($_POST["editarNombre"])){
			$tabla = "cliente";

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