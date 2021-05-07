<?php

require_once "../../../controladores/remisiones.controlador.php";
require_once "../../../modelos/remisiones.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirRemision{

public $id_remision;

public function traerImpresionRemision(){

//TRAER INFORMACION VENTA

$itemRemision = "id_remision";
$valorRemision = $this->idRemision;

$respuestaRemision = ControladorRemisiones::ctrMostrarRemisiones($itemRemision, $valorRemision);

$fecha = substr($respuestaRemision["fecha_remision"], 0, -8);
$productos = json_decode($respuestaRemision["productos"], true);

//TRAER INFORMACION DEL CLIENTE

$itemCliente = "id_cliente";
$valorCliente = $respuestaRemision["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAER INFORMACION DEL VENDEDOR

$itemUsuario = "id_usuarios";
$valorUsuario = $respuestaRemision["id_usuario"];

$respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

//REQUERIR CLASE TCPDF

require_once('tcpdf_include.php');

// Crear el nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

setlocale(LC_ALL, "es_ES");

$fechaLocal = strftime("%A %d de %B del %Y");

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
	
				<div style="font-size:8.5px; text-align:right; line-height:15px;">

				<br>
				R.F.C. EMA880826L98

				<br>
				Ignacio Espinoza No.108 Aculco MEX.

				</div>

			</td>

			<td style="background-color:white; width 140px">
			
				<div style="font-size:8.5px; text-align:right; line-height:15px;">

					<br>
					Telefono: 01 (718) 124-01-92 124-03-19 124-06-37
					<br>
					correo@empresa.com

				</div>

			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red">
				<br>
					REMISION N°.
				<br>
					$valorRemision		
			</td>

		</tr>

	</table>	

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


$bloque2 = <<<EOF

	<table>

		<tr>

			<td style="width:540px"><img src="images/back.jpg"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:350px">

				Facturar A: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:190px; text-align:right">

				Fecha $fechaLocal

			</td>

		</tr>

		<tr>
			
			<td style="border: 1px solid #666; background-color:white; width:540px">Usuario: $respuestaUsuario[nombre]</td>

		</tr>

		<tr>

			<td style="border-top: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque1a = <<<EOF

	<table>

		<tr>

			<td style="width:540px">Recibí de ESTRUCTURAS METALICAS DE ACULCO S.A. de C.V los siguientes trabajos de herrería: </td>

		</tr>

		<tr>
			<td style="width:540px"></td>
		</tr>		

	</table>

EOF;

$pdf->writeHTML($bloque1a, false, false, false, false, '');

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Marca</td>
			<td style="border: 1px solid #666; background-color:white; width:190px; text-align:center">Descripcion</td>
			<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Unidad</td>
			<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Cantidad</td>
			<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Peso Unitario</td>
			<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Peso Total</td>

		</tr>

	</table>

EOF;


$pdf->writeHTML($bloque3, false, false, false, false, '');

$pesoTotalRemision = 0;
$numeroPiezas = 0;

foreach($productos as $key => $item){

$itemProducto = "id_producto";
$valorProducto = $item["id_producto"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);	



$pesoUnitario = number_format($respuestaProducto["peso_unitario"], 2);

$pesoTotal = number_format($respuestaProducto["peso_unitario"]*$respuestaProducto["cantidad"], 2);

$pesoTotalRemision = $pesoTotalRemision+($respuestaProducto["peso_unitario"]*$respuestaProducto["cantidad"]);

$descripcion = $respuestaProducto["tipo"].' '.$respuestaProducto["marca"];

$numeroPiezas = $numeroPiezas + $respuestaProducto["cantidad"];

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; color: #333; background-color: white; width:70px; text-align:center">
				$respuestaProducto[marca]
			</td>
			<td style="border: 1px solid #666; color: #333; background-color: white; width:190px; text-align:center">
				$respuestaProducto[tipo]
			</td>
			<td style="border: 1px solid #666; color: #333; background-color: white; width:70px; text-align:center">
				$respuestaProducto[unidad]
			</td>
			<td style="border: 1px solid #666; color: #333; background-color: white; width:70px; text-align:center">
				$respuestaProducto[cantidad]
			</td>
			<td style="border: 1px solid #666; color: #333; background-color: white; width:70px; text-align:center">
				$pesoUnitario
			</td>
			<td style="border: 1px solid #666; color: #333; background-color: white; width:70px; text-align:center">
				$pesoTotal
			</td>

		</tr>

	</table>

EOF;


$pdf->writeHTML($bloque4, false, false, false, false, '');

}

$bloque5 = <<<EOF

	<table>

		<tr>
	
			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color #333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
				
			<td style="border: 1px solid #666; background-color: white; width:100px; text-align:center">
				Total Piezas:
			</td>
				
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$numeroPiezas
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color: white; width:100px; text-align:center">
				Peso Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$pesoTotalRemision KG
			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

$bloque1a = <<<EOF

	<table>

		<tr>
			<td style="width:540px"></td>
		</tr>

		<tr>

			<td style="width:540px">Trabajos utilizados en:_____________________________________________________________ </td>

		</tr>

		<tr>
			<td style="width:540px">Debe (mos) y pagaré (mos) incondicionalmente por este Pagaré a la Orden de ESTRUCTURAS METALICAS DE ACULCO, S.A. de C.V. en Jilotepec, Edo. de México el dia______________________________ la cantidad de "$"_____________________ </td>
		</tr>

		<tr>
			
			<td style="width:540px">Por la mercancia recibida a mi (nuestra) entera satisfacción, Al no pagarse este documento en su fecha de vencimiento hasta el dia de su liquidación, causara intereses moratorios al tipo de _________% mensual, pagadero en esta ciudad juntamente con el principal. </td>

		</tr>

		<tr>
			<td></td>
		</tr>		

	</table>

	<table>

		<tr>

			<td style="color:#333; background-color:white; width:140px; text-align:center">Datos del Deudor</td>
	
			<td style="color:#333; background-color:white; width:200x; text-align:center"></td>

			<td style="background-color:white; width:100px; text-align:right">Recimibos de </td>

			<td style="color #333; background-color:white; width:100px; text-align:left"> Conformidad</td>

		</tr>
		

		<tr>

			<td style=" color:#333; background-color:white; width:200px; text-align:left">Nombre:_______________________</td>

			<td style=" color:#333; background-color:white; width:40px; text-align:center"></td>
				
			<td style=" background-color: white; width:100px; text-align:center">
				
			</td>
				
			<td style="color:#333; background-color:white; width:100px; text-align:center">
				
			</td>

		</tr>

		<tr>

			<td style=" color:#333; background-color:white; width:340px; text-align:left">Direccion:______________________</td>			

		</tr>

		<tr>
			<td style=" color:#333; background-color:white; width:340px; text-align:left">Poblacion:______________________</td>

			<td style=" background-color: white; width:100px; text-align:right">
				______________
			</td>

			<td style="color:#333; background-color:white; width:100px; text-align:left">
				______________
			</td>
		</tr>



	</table>

EOF;

$pdf->writeHTML($bloque1a, false, false, false, false, '');

$pdf->Output('remision.pdf');

}

}

$remision = new imprimirRemision();
$remision -> idRemision = $_GET["idRemision"];
$remision -> traerImpresionRemision();

?>