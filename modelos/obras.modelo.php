<?php 

require_once "conexion.php";

class ModeloObras{

	/*=====================================
	=            Mostrar Obras            =
	=====================================*/
	
	static public function mdlMostrarObrasTodas($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_obra DESC");

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

	static public function mdlMostrarObras($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_status_obra = 1 ORDER BY id_obra DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();
		
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_status_obra = 1");

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarObrasCliente($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_obra DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();
		
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarStatus($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

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
	
	/*=====  End of Mostrar Obras  ======*/

	/*=======================================
	=            CREAR OBRA
	=======================================*/
	static public function mdlIngresarObra($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, id_cliente, id_status_obra) VALUES (:obra, :id_cliente, :id_status_obra)");

		$stmt->bindParam(":obra", $datos["obra"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":id_status_obra", $datos["id_status_obra"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	
	
	/*=====  End of CREAR OBRA  ====*/

	static public function mdlEditarObra($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :obra, id_cliente = :id_cliente, id_status_obra = :id_status_obra WHERE id_obra = :id_obra");

		$stmt->bindParam(":obra", $datos["obra"], PDO::PARAM_STR);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_status_obra", $datos["id_status_obra"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlBorrarObra($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_obra = :id_obra");
		$stmt -> bindParam(":id_obra", $datos, PDO::PARAM_INT);
		
		if($stmt->execute()){
		
			return "ok";
		
		}else{
		
			return "error";
		
		}

		$stmt->close();

		$stmt = null;
	}
	
}