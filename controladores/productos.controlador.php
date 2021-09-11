<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ControladorProductos{
	/*=========================================
	=            Mostrar productos            =
	=========================================*/
	static public function ctrMostrarProductos($item, $valor){
		
		if(isset($_SESSION["obraProductos"])){
			$idObra = $_SESSION["obraProductos"];
		}else{
			$idObra = null;
		}

		$tabla = "productos";
		
		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $idObra);
		
		return $respuesta;		
	}

	static public function ctrMostrarProductosPorObra(){

		$tabla = "productos";
		
		$respuesta = ModeloProductos::mdlMostrarProductosPorObra();
		
		return $respuesta;		
	}

	static public function ctrMostrarProductosEnObra(){

		$tabla = "productos";
		
		$respuesta = ModeloProductos::mdlMostrarProductosEnObra();
		
		return $respuesta;		
	}

	static public function ctrMostrarProductosPorStatus(){

		$respuesta = ModeloProductos::mdlMostrarProductosPorStatus();
		return $respuesta;
		
	}

	static public function ctrMostrarTotalProductos(){

		$respuesta = ModeloProductos::mdlMostrarTotalProductos();

		return $respuesta;

	}

	static public function ctrMostrarStatus(){
		$respuesta = ModeloProductos::mdlMostrarStatus();
		return $respuesta;
	}
	
	/*=====  End of Mostrar productos  ======*/

	static public function ctrMostrarConteo($valor){

		session_start();
		if(isset($_SESSION["obraConteo"])){

			$idObra = $_SESSION["obraConteo"];

		}else{

			$idObra = null;

		}
		
		$respuesta = ModeloProductos::mdlMostrarConteo($valor, $idObra);
		
		return $respuesta;
		
	}


	static public function ctrMostrarProductosRemision(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(isset($_SESSION["obraProductos"])){
			$idObra = $_SESSION["obraProductos"];
		}else{
			$idObra = null;
		}

		$respuesta = ModeloProductos::mdlMostrarProductosRemision($idObra);
		return $respuesta;
	}

	static public function ctrValidarMarca($marca, $idObra){

		$respuesta = ModeloProductos::mdlValidarMarca($marca, $idObra);
		return $respuesta;

	}

	static public function ctrRechazarProducto($id_conteo, $id_producto, $id_status){		
		session_start();
		$cantidad = 1;
		$id_statusn = ($id_status-1);
	    $datos = array("id_producto" => $id_producto,
					"id_status" => $id_statusn,
					"cantidad" => $cantidad);



	    if($id_status = 1 || ($id_status >= $_SESSION["id_perfil"]|| $id_status <= ($_SESSION["id_perfil"]+1))){
	    	if($_SESSION["id_perfil"]==9 && $id_status > 1){
	    		
	    		$res1 = ModeloProductos::mdlContarProducto($datos);
				$respuesta = ModeloProductos::mdlRechazarProducto($id_producto);	
					echo 'ok';	
	    	
	    	}else{
	    	
	    		echo 'error';		
	    	
	    	}

	    }else{
	    	$res1 = ModeloProductos::mdlContarProducto($datos);
			$respuesta = ModeloProductos::mdlRechazarProducto($id_producto);	
				echo 'ok';	
	    }
	    
		
	}	

	/*=====  End of Mostrar productos  ======*/

	static public function ctrImportarProductos(){
		if(isset($_POST["nuevaImportacion"])){			
			if(isset($_FILES["nuevoExcel"]["tmp_name"])){
				$id_obra = $_POST["importarObra"];
				$id_status = 6;
				$tabla = "productos";
				   $error = 0;
				   $ins = 0;
				   $duplicado = 0;
				   $ruta = $_FILES["nuevoExcel"]["tmp_name"];
				   $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");

				   $spreadsheet = $reader->load($ruta);
				   $sheet = $spreadsheet->getActiveSheet();
				   

				   foreach ($sheet->getRowIterator() as $row) {
				   	$cellIterator = $row->getCellIterator();
				   	$cellIterator->setIterateOnlyExistingCells(false);
				   		$datos = array("tipo" => $sheet->getCellByColumnAndRow(1, $row->getRowIndex()),
				   				   "marca" => $sheet->getCellByColumnAndRow(2, $row->getRowIndex()),  
				   				   "cantidad" => $sheet->getCellByColumnAndRow(3, $row->getRowIndex()),
				   				   "longitud" => $sheet->getCellByColumnAndRow(4, $row->getRowIndex()),
				   				   "peso_unitario" => $sheet->getCellByColumnAndRow(5, $row->getRowIndex()),
				   				   "unidad" => $sheet->getCellByColumnAndRow(6, $row->getRowIndex()),
				   				   "status" => $id_status,
				   					"id_obra" => $id_obra);
				   		$marca = $sheet->getCellByColumnAndRow(2, $row->getRowIndex());
				   		if($marca<>""){
				   			echo "marca:".$marca."<br>";
				   			$resvalid = ModeloProductos::mdlValidarMarca($marca, $id_obra);
				   			if(!empty($resvalid)){
				   				$duplicado = $duplicado+1;
				   			}else{
				   				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);	

				   				if($respuesta =="ok"){
							   		$ins = $ins+1;
							   	}else{
							   		$error = $error+1;
							   	}
							   	
				   			}				   			
						   	
				   		}
				   		
				   }

				   echo $ins;
				   			   
				   if($ins>=0){
				   		echo '<script>

							swal({
									type: "success",
									title: "El proceso ha sido ejecutado correctamente. '.$ins.' Productos insertados, registros duplicados '.$duplicado.' y '.$error.' errores",
									showConfirmButton: true,
									confirmButtonText: "Ok"
								}).then((result)=>{
									if(result.value){
										window.location = "productos";
									}
								})
				   		</script>';
				   }else if($ins==0){
				   		echo '<script>

							swal({
									type: "error",
									title: "¡No se ha insertado ningun producto en la base de datos, verifique el formato del archivo!",
									showConfirmButton: true,
									confirmButtonText: "cerrar"
								}).then((result)=>{
									if(result.value){
										window.location = "productos";
									}
								})
				   		</script>';

				   }
				   			
			}
		}
			

	}

	static public function ctrContarProducto(){

		if(isset($_POST["entradaCodigo"])){
			var_dump($_SESSION);
			$datos = array('marca' => $_POST["entradaCodigo"],
							'id_obra' =>$_SESSION["obraConteo"]);
			
			$prodid = ModeloProductos::mdlBuscarID($datos);			

			echo "datos id <br>";   
			var_dump($prodid);

			if(!empty($prodid)){

				$id_producto = $prodid["id_producto"];
				$status_actual = $prodid["status"];
				$id_status = $_SESSION["id_perfil"];
				$id_obra = $_SESSION["obraConteo"];

				/*======================================================================
									CODIGO DE VALIDACIÓN DE AREA
				=======================================================================*/

				//Omitiendo Status de Soldadura y pintura a Proceso de Validación
				
					//Validando el resto de áreas
				if( (($status_actual<>($id_status-1)) && $id_status<>1) AND ($status_actual <> 3 AND $status_actual <> 4 AND $status_actual <> 5) ){

					echo '<script>

						swal({
								type: "error",
								title: "¡Este no ha sido verificado por el área previa!",
								showConfirmButton: true,
								confirmButtonText: "cerrar"
							}).then((result)=>{
								if(result.value){
									window.location = "escaneo";
								}
							})
			   			</script>';
				   		

				}else{

					$data3 = array("id_producto" => $id_producto,
								"id_status" => $id_status);

					$contado = ModeloProductos::mdlValidarConteo($data3);				
					
					if(empty($contado)){

						$tabla = "productos";

					   $cantidad = 1;

					   $datos2 = array("id_producto" => $id_producto,
									"id_status" => $id_status,
									"cantidad" => $cantidad);				

					   $cont = ModeloProductos::mdlContarProducto($datos2);
					   
					   if($cont == "ok"){

					   		ModeloProductos::mdlUpdateStatusProducto($datos2);

					   		echo '<script>

								swal({
										type: "success",
										title: "¡Se ha procesado el producto correctamente!",
										showConfirmButton: true,
										confirmButtonText: "cerrar"
									}).then((result)=>{
										if(result.value){
											window.location = "escaneo";
										}
									})
					   			</script>';
					   	}

					}else{

						echo '<script>

							swal({
									type: "error",
									title: "¡Este producto ya ha sido inspeccionado por su área!",
									showConfirmButton: true,
									confirmButtonText: "cerrar"
								}).then((result)=>{
									if(result.value){
										window.location = "escaneo";
									}
								})
				   			</script>';
					}

				}//fin validacion de área

				

			   }else{

			   		echo '<script>

						swal({
								type: "error",
								title: "¡No se encuentra el producto en la base de datos!",
								showConfirmButton: true,
								confirmButtonText: "cerrar"
							}).then((result)=>{
								if(result.value){
									window.location = "escaneo";
								}
							})
			   		</script>';

			   }
		}

	}

	static public function ctrCrearProducto(){
		if(isset($_POST["nuevaMarca"])){
			echo $_POST["nuevaMarca"];	   
		   
		   $ruta = "vistas/img/productos/default/anonymous.png";

			if(isset($_FILES["nuevaImagen"]["tmp_name"])){

				list($ancho, $alto) =  getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*======================================
			=        DIRECTORIO DONDE SE GUARDA LA IMAGEN            =
			======================================*/

				$directorio = "vistas/img/productos/".$_POST["nuevaMarca"];
				mkdir($directorio, 0755);

				/*===============================================================================================
				=            DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP            =
				===============================================================================================*/
				
				if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

					/*=========================================================
					=            GUARDANDO IMAGEN EN EL DIRECTORIO            =
					=========================================================*/
					

					$aleatorio = mt_rand(100,999);

					$ruta = "vistas/img/productos/". $_POST["nuevaMarca"]."/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
				}

				if($_FILES["nuevaImagen"]["type"] == "image/png"){

					/*=========================================================
					=            GUARDANDO IMAGEN EN EL DIRECTORIO            =
					=========================================================*/
					

					$aleatorio = mt_rand(100,999);

					$ruta = "vistas/img/productos/". $_POST["nuevoCodigo"]."/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);
				}
				
				/*=====  End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP  ======*/
			}
			
		   $tabla = "productos";
		   
		   $datos = array("tipo" => $_POST["nuevoTipo"],
						"marca" => $_POST["nuevaMarca"],
						"cantidad" => $_POST["nuevaCantidad"],
						"longitud" => $_POST["nuevaLongitud"],
						"peso_unitario" => $_POST["nuevoPeso"],
						"unidad" => $_POST["nuevaUnidad"],
						"status" => $_POST["nuevoStatus"],
						"id_obra" => $_POST["nuevaObra"],
						"imagen" => $ruta);

		   $existe = ModeloProductos::mdlVerificarExistencia($datos);		   

		   $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

		   if($respuesta == "ok"){

		   		echo '<script>

					swal({
							type: "success",
							title: "El producto ha sido guardado exitosamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location = "productos";
							}
						})
		   		</script>';
		   }

		}

	}

	/*=======================================
	=            EDITAR PRODUCTO            =
	=======================================*/
	
	static public function ctrEditarProducto(){
		if(isset($_POST["editarMarca"])){
			   
			   $ruta = $_POST["imagenActual"];			   

				if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) =  getimagesize($_FILES["editarImagen"]["tmp_name"]);
					$editarAncho = 500;
					$editarAlto = 500;

				/*=========================================
				=  DIRECTORIO DONDE SE GUARDA LA IMAGEN  =
				==========================================*/

					$directorio = "vistas/img/productos/".$_POST["editarMarca"];

					/*=========================================
					=  VERIFICAR SI EXISTE IMAGEN EN BD  =
					==========================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);

					}

					

					/*==================================================================
					=            DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP            =
					====================================================================*/
					
					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=========================================================
						=            GUARDANDO IMAGEN EN EL DIRECTORIO            =
						=========================================================*/
						

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/". $_POST["editarMarca"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($editarAncho, $editarAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $editarAncho, $editarAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=========================================================
						=            GUARDANDO IMAGEN EN EL DIRECTORIO            =
						=========================================================*/
						

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/". $_POST["editarMarca"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($editarAncho, $editarAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $editarAncho, $editarAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}


					
					
					/*=====  End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP  ======*/
				}
			   $tabla = "productos";
			   
			   $datos = array("status" => $_POST["editarStatus"],
							"marca" => $_POST["editarMarca"],
							"tipo" => $_POST["editarTipo"],
							"cantidad" => $_POST["editarCantidad"],
							"peso_unitario" => $_POST["editarPeso"],
							"unidad" => $_POST["editarUnidad"],
							"longitud" => $_POST["editarLongitud"],
							"id_producto" => $_POST["eidProducto"],
							"id_obra" => $_POST["editarObra"],
							"imagen" => $ruta);

			   $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

			   if($respuesta == "ok"){

			   		echo '<script>

						swal({
								type: "success",
								title: "El producto ha sido editado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location = "productos";
								}
							})
			   		</script>';
			   }else{
			   	print_r($respuesta);
			   }

		}
		

	}

	static public function ctrEstablecerObraProductos($obraProductos){
		session_start();
		$_SESSION["obraProductos"]=$obraProductos;
		
	}

	static public function ctrEstablecerClienteProductos($clienteProductos){
		session_start();
		$_SESSION["clienteProductos"]=$clienteProductos;
		
	}



	
	/*=====  End of EDITAR PRODUCTO  ======*/

	
			
}