<?php

class imprimirRemision{

public $id_remision;

public function traerImpresionRemision(){

//TRAER INFORMACION DE LA REMISION

$itemRemision = "id_remision";
$valorRemision = $this->idRemision;

$respuestaRemision = ControladorRemision::ctrMostrarRemision($itemRemision, $valorRemision);

}


}

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

$bloque1 = <<<EOF

	<table>

		<tr>
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">

					<br>

					REMISION: 54215

					<br>
					Dirección: Acceso V #107B


				</div>

			</td>

			<td>

				<div style="font-size:8.5px; text-align:right; line-height:15px">

					<br>
					Telefono: 442-3-55-69

					<br>
					correo@emacsaconstruccion.com.mx

				</div>

			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red">

				<br><br>REMISION # 12345<br>
			
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

//SALIDA DEL ARCHIVO

$pdf->Output('remision.pdf');

$remision = new imprimirRemision();
$remision -> idRemision = $_GET["idRemision"];
$factura ->traerImpresionRemision();

?>