<?php

require_once "conexion.php";

class ModeloProductos{

	/*=========================================
	=            MOSTRAR PRODUCTOS            =
	=========================================*/
	static public function mdlMostrarProductos($tabla, $item, $valor, $obra){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.id_producto, p.tipo, p.marca, p.status, p.cantidad, p.longitud, p.peso_unitario, (p.peso_unitario * p.cantidad) AS total, p.unidad, o.descripcion AS obra FROM productos p, obra o WHERE p.$item = :$item AND o.id_obra = p.id_obra AND o.id_status_obra <> 2 ORDER BY id_producto DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt ->execute();

			return $stmt -> fetch();				

		}else if($obra != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.id_producto, p.tipo, p.marca, s.descripcion, p.cantidad, p.longitud, p.peso_unitario, (p.peso_unitario * p.cantidad) AS total, o.descripcion AS obra FROM productos p, status_producto s, obra o WHERE o.id_obra = p.id_obra AND p.id_obra = :$obra AND p.status = s.id_status AND o.id_status_obra <> 2 ORDER BY id_producto DESC");

			$stmt -> bindParam(":".$obra, $obra, PDO::PARAM_STR);

			$stmt ->execute();

			return $stmt -> fetchAll();

		}else if($obra == null && $item ==null){			

			$stmt = Conexion::conectar()->prepare("SELECT p.id_producto, p.tipo, p.marca, s.descripcion, p.cantidad, p.longitud, p.peso_unitario, (p.peso_unitario * p.cantidad) AS total, o.descripcion AS obra FROM productos p, status_producto s, obra o WHERE p.status = s.id_status AND o.id_obra = p.id_obra AND o.id_status_obra <> 2");

			$stmt -> execute();

			return $stmt->fetchAll();
		}		

		$stmt -> close();

		$stmt = null;
	}
	/*=====  End of MOSTRAR PRODUCTOS  ======*/
	
	static public function mdlMostrarProductosContados($item, $valor, $obra){

		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_producto DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt ->execute();

			return $stmt -> fetch();

		}else if($obra != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarProductosRemision($idObra){

		if($idObra !=null){
			$stmt = Conexion::conectar()->prepare("SELECT p.id_producto, p.tipo, p.marca, o.descripcion, p.cantidad, p.longitud, p.peso_unitario, round((p.peso_unitario * p.cantidad),2) AS total, p.unidad  FROM productos p, status_producto s, obra o WHERE p.status = s.id_status AND p.status = 7 AND p.id_obra = :idObra AND o.id_obra = p.id_obra;");

			$stmt -> bindParam(":idObra", $idObra, PDO::PARAM_INT);			

		}else if($idObra==null){
			$stmt = Conexion::conectar()->prepare("SELECT p.id_producto, p.tipo, p.marca, o.descripcion, o.descripcion, p.cantidad, p.longitud, p.peso_unitario, round((p.peso_unitario * p.cantidad),2) AS total, p.unidad  FROM productos p, status_producto s, obra o WHERE p.status = s.id_status AND p.status = 7 AND p.id_obra = o.id_obra;");	
		}

		
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarStatus(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM status_producto");
		$stmt -> execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt=null;
	}
	
	
	/*=========================================
	=            INGRESAR PRODUCTOS            =
	=========================================*/
	static public function mdlIngresarProducto($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO productos (tipo, marca, cantidad, longitud, peso_unitario, status, unidad, id_obra) VALUES (:tipo, :marca, :cantidad, :longitud, :peso_unitario, :status, :unidad, :id_obra)");		
		
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		
		$stmt->bindParam(":longitud", $datos["longitud"], PDO::PARAM_STR);

		$stmt->bindParam(":peso_unitario", $datos["peso_unitario"], PDO::PARAM_STR);

		$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);

		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);

		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_STR);


		if($stmt->execute()){
			return "ok";
			
		}else{
			return "error";
		}

		$stmt->close();
		$stmt=null;
	}

	static public function mdlMostrarConteo($valor, $idObra){

		if($valor != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT c.id_conteo, c.id_producto, p.tipo, p.marca, c.cantidad, p.longitud, s.descripcion, c.id_status, p.peso_unitario, Round(p.peso_unitario * p.cantidad,2) AS peso_total, c.fecha_conteo, o.descripcion AS obra FROM 
				productos p, conteo c, status_producto s, obra o WHERE c.id_producto = p.id_producto AND c.id_status = s.id_status AND c.marca = $valor AND p.id_obra = o.id_obra AND o.id_status_obra <> 2 ORDER BY id_producto DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt ->execute();

			return $stmt -> fetch();

		}else if($idObra !=null){

			$stmt = Conexion::conectar()->prepare("SELECT c.id_conteo, c.id_producto, p.tipo, p.marca, p.cantidad, p.longitud, s.descripcion, c.id_status, p.peso_unitario, Round(p.peso_unitario * p.cantidad,2) AS peso_total, c.fecha_conteo, o.descripcion AS obra FROM 
				productos p, conteo c, status_producto s, obra o WHERE c.id_producto = p.id_producto AND c.id_status = s.id_status AND p.id_obra = o.id_obra AND o.id_obra = :idObra AND o.id_status_obra <> 2  ORDER BY id_producto DESC");

			$stmt -> bindParam(":idObra", $idObra, PDO::PARAM_STR);

			$stmt ->execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT c.id_conteo, c.id_producto, p.tipo, p.marca, p.cantidad, p.longitud, s.descripcion, c.id_status , p.peso_unitario, Round(p.peso_unitario * c.cantidad,2) AS peso_total, c.fecha_conteo, o.descripcion AS obra FROM 
				productos p, conteo c, status_producto s, obra o WHERE c.id_producto = p.id_producto AND c.id_status = s.id_status AND p.id_obra = o.id_obra AND o.id_status_obra <> 2");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlBuscarID($datos){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE marca = :marca AND id_obra = :id_obra;");

		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlValidarConteo($datos){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM conteo WHERE id_producto = :id_producto AND id_status = :id_status;");

		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);

		$stmt->bindParam(":id_status", $datos["id_status"], PDO::PARAM_INT);	

		$stmt->execute();

		return $stmt->fetch();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlContarProducto($datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO conteo (id_producto, id_status, cantidad) VALUES
		(:id_producto, :id_status, :cantidad);");

		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);

		$stmt->bindParam(":id_status", $datos["id_status"], PDO::PARAM_INT);

		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);		
		

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt = null;

	}

	static public function mdlUpdateStatusProducto($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE productos SET status = :status WHERE id_producto = :id_producto");

		$stmt->bindParam(":status", $datos["id_status"]);

		$stmt->bindParam("id_producto", $datos["id_producto"]);

		if($stmt->execute()){
			echo "upok";
		}else{
			echo "uperror";
		}

		$stmt = null;
	}

		/*=========================================
	=            EDITAR PRODUCTOS            =
	=========================================*/
	static public function mdlEditarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = :status, tipo = :tipo, imagen = :imagen, marca = :marca, cantidad = :cantidad, longitud = :longitud, peso_unitario = :peso_unitario, unidad = :unidad WHERE id_producto = :id_producto");

		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":longitud", $datos["longitud"], PDO::PARAM_STR);
		$stmt->bindParam(":peso_unitario", $datos["peso_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";

		}else{
			$arr = $stmt->errorInfo();
			return $arr;
		}

		$stmt->close();
		$stmt=null;
	}

	static public function mdlRechazarProducto($id_producto){
		$stmt = Conexion::conectar()->prepare("UPDATE productos SET status = (status-1) WHERE id_producto = $id_producto");

		$stmt->execute();
		
		$stmt=null;
	}
	
	static public function mdlValidarMarca($marca, $idObra){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE marca = :marca AND id_obra = :idObra");

		$stmt->bindParam(":marca", $marca, PDO::PARAM_STR);

		$stmt->bindParam(":idObra", $idObra, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt = null;

	}

	/*===========================================
	=            ACTUALIZAR PRODUCTO            =
	===========================================*/
	
	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_producto = :id");

		$stmt ->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt ->bindParam(":id", $valor, PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";


		}	

		

		$stmt -> close();

		$stmt = null;

	}

	//Codigo agregado para reportes.

	static public function mdlMostrarProductosPorObra(){
			
		$stmt = Conexion::conectar()->prepare("SELECT count(p.id_producto), o.descripcion FROM obra o LEFT JOIN productos p  ON p.id_obra = o.id_obra WHERE o.id_status_obra = 1 group by o.descripcion ORDER BY o.descripcion;");

		$stmt ->execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarProductosEnObra(){
			
		$stmt = Conexion::conectar()->prepare("SELECT count(p.id_producto), o.descripcion FROM obra o LEFT JOIN productos p  ON p.id_obra = o.id_obra AND p.status = 8 WHERE o.id_status_obra = 1 group by o.descripcion ORDER BY o.descripcion;");

		$stmt ->execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarProductosPorStatus(){
			
		$stmt = Conexion::conectar()->prepare("SELECT count(p.id_producto), s.descripcion FROM obra o, status_producto s LEFT JOIN productos p ON p.status = s.id_status WHERE p.id_obra = o.id_obra AND o.id_status_obra = 1 group by s.descripcion ORDER BY s.descripcion;");

		$stmt ->execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarTotalProductos(){
			
		$stmt = Conexion::conectar()->prepare("SELECT count(p.id_producto) FROM productos p, obra o WHERE p.id_obra = o.id_obra AND o.id_status_obra = 1;");

		$stmt ->execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}


	
}