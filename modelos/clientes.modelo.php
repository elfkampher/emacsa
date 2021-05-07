<?php 

require_once "conexion.php";

class ModeloClientes{

	/*=====================================
	=            Mostrar Cliente            =
	=====================================*/
	
	static public function mdlMostrarClientes($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_cliente DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();
		
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		}

		$stmt -> close();

		$stmt = null;
	}	
	
	/*=====  End of Mostrar clientes  ======*/

	/*=======================================
	=            CREAR CLIENTE
	=======================================*/
	static public function mdlIngresarCliente($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");

		$stmt->bindParam(":nombre", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	
	
	/*=====  End of CREAR CLIENTE  ====*/

	static public function mdlEditarCliente($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id_cliente = :id_cliente");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok".$stmt->debugDumpParams();

		}else{

			return "error".$stmt->debugDumpParams();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlBorrarCliente($tabla, $id_cliente){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id_cliente");
		$stmt -> bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
		
		if($stmt->execute()){
		
			return "ok";
		
		}else{
		
			return "error";
		
		}

		$stmt->close();

		$stmt = null;
	}
	
}