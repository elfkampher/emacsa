<?php

require_once "conexion.php";

class ModeloRemisiones{

	/*======================================
	=            MOSTRAR VENTAS            =
	======================================*/
	
	static public function mdlMostrarRemisiones($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha_remision DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_remision ASC");

			$stmt ->execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}
	
	/*=====  End of MOSTRAR REMISIONES  ======*/

	/*==========================================
	=            REGISTRO DE REMISIONES            =
	==========================================*/
	
	static public function mdlIngresarRemision($tabla, $datos){		

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(clave, id_cliente, id_usuario, id_obra, productos) VALUES (:clave, :id_cliente, :id_usuario, :id_obra, :productos)");

		$stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null();
	}
	
	/*=====  End of REGISTRO DE REMISIONES  ======*/

	/*==========================================
	=            EDICION DE REMISIONES            =
	==========================================*/
	
	static public function mdlEditarRemision($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_cliente = :id_cliente, id_usuario = :id_usuario, productos = :productos, id_obra = :id_obra WHERE id_remision = :id_remision");

		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);	
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_remision", $datos["id_remision"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);				
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null();
	}
	
	/*=====  End of EDICION DE REMISION  ======*/

	/*======================================
	=            ELIMINAR REMISION            =
	======================================*/
	static public function mdlEliminarRemision($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_remision = :id_remision");

		$stmt -> bindParam(":id_remision", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;
	}
	
	
	/*=====  End of ELIMINAR REMISION  ======*/
	
}