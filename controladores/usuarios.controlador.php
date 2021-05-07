<?php
session_start();
class ControladorUsuarios{

	/*=============================================
	=            Ingreso Usuario          =
	=============================================*/
	
	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

			   	$encriptar = sha1($_POST["ingPassword"]);

		   		$tabla = "usuarios";

		   		$item = "usuario";
		   		$valor = $_POST["ingUsuario"];

		   		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		   		if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

		   			if($respuesta["estado"]==1){
		   			
			   			$_SESSION["iniciarSesion"]="ok";
			   			$_SESSION["nombre"]=$respuesta["nombre"];
			   			$_SESSION["id_usuarios"]=$respuesta["id_usuarios"];
			   			$_SESSION["usuario"]=$respuesta["usuario"];
			   			$_SESSION["id_perfil"]=$respuesta["id_perfil"];
			   			$_SESSION["foto"]=$respuesta["foto"];

			   			/*================================================================
			   			=            REGISTRAR FECHA Y HORA PARA ULTIMO LOGIN            =
			   			================================================================*/
			   			
			   			date_default_timezone_get('America/Mexico_city');

			   			$fecha = date('y-m-d');
			   			$hora = date('H:i:s');		   			
			   			
			   			$fechaActual = $fecha.' '.$hora;
			   			$item1 = "ultimo_login";
			   			$valor1 = $fechaActual;

			   			$item2 = "id_usuarios";
			   			$valor2 = $respuesta["id_usuarios"];

			   			$ultimologin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
			   			
			   			if($ultimologin == "ok"){
			   					echo '<script>
							
								window.location = "inicio";

			   				</script>';

			   			}
		   			
		   			}else{
		   				echo '<br><div class="alert alert-danger btnActivar">¡Alerta el usuario aun no esta activado!</div>';
		   			}

		   		}else{
		   			echo '<br><div class="alert alert-danger btnActivar">Error al ingresar, vuelve a intentar</div>';
		   		}



		   }
		}
	}


	/*=============================================
	=            Registro Usuario          =
	=============================================*/

	static public function ctrCrearUsuario(){
		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["nuevoNombre"]) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
			){

				/*======================================
				=          VALIDAR IMAGEN            =
				======================================*/
				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) =  getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*======================================
				=        DIRECTORIO DONDE SE GUARDA LA IMAGEN            =
				======================================*/

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
					mkdir($directorio, 0755);

					/*===============================================================================================
					=            DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP            =
					===============================================================================================*/
					
					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=========================================================
						=            GUARDANDO IMAGEN EN EL DIRECTORIO            =
						=========================================================*/
						

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/". $_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=========================================================
						=            GUARDANDO IMAGEN EN EL DIRECTORIO            =
						=========================================================*/
						

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/". $_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}


					
					
					/*=====  End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP  ======*/
					

					//var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"]));
				}
				
				$tabla = "usuarios";

				$encriptar = sha1($_POST["nuevoPassword"]);

				$datos = array("nombre" => $_POST["nuevoNombre"],
							   "usuario" => $_POST["nuevoUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["nuevoPerfil"],
							   "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
				
				if($respuesta == "ok"){
					echo '<script>
								swal({

									type:"success",
									title: "!El Usuario ha sido guardado correctamente¡",
									showConfirmButton: true,
									confirmButtonText: "cerrar",
									closeOnConfirm: false

									}).then((result)=>{
											
										if(result.value){
											
											window.location = "usuarios";
											
										}
										
									});
							</script>';

				}else{
					echo '<script>

							swal({

								type:"error",
								title: "!Error al ingresar el usuario¡",
								showConfirmButton: true,
								confirmButtonText: "cerrar",
								closeOnConfirm: false

								}).then((result)=>{
										
									if(result.value){
										
										window.location = "usuarios";
										
									}
									
								});
						</script>';
				}

			}else{

				echo '<script>

					swal({

						type:"error",
						title: "!El usuario no puede ir vacio o llevar caracteres especiales¡",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false

						}).then((result)=>{
								
							if(result.value){
								
								window.location = "usuarios";
								
							}
							
						});
				</script>';

			}  
		}
	}

	static public function ctrMostrarUsuarios($item, $valor){
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}
	/*======================================
	=            Editar Usuario            =
	======================================*/
	
	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["editarNombre"])){

				/*=============================================
				=            Validar Imagen Editar            =
				=============================================*/
				$ruta="";
				$ruta = $_POST["fotoActual"];
				
				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) =  getimagesize($_FILES["editarFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*======================================
				=        DIRECTORIO DONDE SE GUARDA LA IMAGEN            =
				======================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}/*=== fin de validación if(!empty($_POST["fotoActual"])) ==*/

					

					/*===============================================================================================
					=            DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP            =
					===============================================================================================*/
					
					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=========================================================
						=            GUARDANDO IMAGEN EN EL DIRECTORIO            =
						=========================================================*/
						

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/". $_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=========================================================
						=            GUARDANDO IMAGEN EN EL DIRECTORIO            =
						=========================================================*/
						

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/". $_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}


					
					
					/*=====  End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP  ======*/
					

					//var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"]));
				}/*== fin de validación if(isset($_FILES["nuevaFoto"]["tmp_name"]))  ==*/
				
				/*=====  End of Validar Imagen Editar  ======*/
				$tabla = "usuarios";

				/*==validando si el password viene vacio==*/
				if($_POST["editarPassword"]!=""){
					/*==validando si el password viene con caracteres especiales==*/
					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = sha1($_POST["editarPassword"]);

					}else{

						echo '<script>

							swal({

								type:"error",
								title: "!El password no puede ir vacio o llevar caracteres especiales¡",
								showConfirmButton: true,
								confirmButtonText: "cerrar",
								closeOnConfirm: false

							}).then((result)=>{
										
									if(result.value){
										
										window.location = "usuarios";
										
								}
									
							});
						</script>';

					}// fin de validación de if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editar_password"]))

				}else{

					$encriptar = $passwordActual;					


				}// fin de validación if($_POST["editarPassword"]!="")
				
				
				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);
				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta = "ok"){

					echo '<script>

							swal({

								type:"success",
								title: "El usuario ha sido editado correctamente",
								showConfirmButton: true,
								confirmButtonText: "cerrar",
								closeOnConfirm: false

							}).then((result)=>{
										
									if(result.value){
										
										window.location = "usuarios";
										
								}
									
							});
						</script>';					

				}else{

					echo '<script>

							swal({

								type:"error",
								title: "!Hubo un error al actualizar los datos¡",
								showConfirmButton: true,
								confirmButtonText: "cerrar",
								closeOnConfirm: false

							}).then((result)=>{
										
									if(result.value){
										
										window.location = "usuarios";
										
								}
									
							});
						</script>';

				}//fin de validación de la respuesta de la base de datos


			}else{

				echo '<script>

							swal({

								type:"error",
								title: "¡El nombre no puede ir vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "cerrar",
								closeOnConfirm: false

							}).then((result)=>{
										
									if(result.value){
										
										window.location = "usuarios";
										
								}
									
							});
						</script>';
			}/*--  Fin validación if(preg_match('/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["editarNombre"]))  --*/

		}/*==  Fin de validación if(isset($_POST["editarUsuario"]))  ==*/



	}/*===== Fin de function ctrEditarUsuario()  ======*/

	/*======================================
	=            BORRAR USUARIO            =
	======================================*/
	
	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){
			
			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];
			
			if($_GET["fotoUsuario"]!=""){
				
				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta=="ok"){

				echo '<script>

							swal({

								type:"success",
								title: "El usuario ha sido borrado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{
										
									if(result.value){
										
										window.location = "usuarios";
										
								}
									
							});
						</script>';

			}else{
				echo '<script>

							swal({

								type:"error",
								title: "Error al borrar usuario'.$respuesta.'",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{
										
									if(result.value){
										
										window.location = "usuarios";
										
								}
									
							});
						</script>';
			}
		}
	}
	
	/*=====  End of BORRAR USUARIO  ======*/
	


}//fin de controlador

			

	


