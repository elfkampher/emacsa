/*==========================================================
=            CARGAR TABLA DINAMICA DE PRODUCTOS            =
==========================================================*/
/* $.ajax({

 	url: "ajax/datatable-productos.ajax.php",
 	success:function(respuesta){
 		console.log("respuesta", respuesta);
 	}
 })
*/
$('.tablaProductos').DataTable({
    "ajax": "ajax/datatable-productos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*==========================================================
=            CARGAR TABLA DINAMICA DE CONTEO            =
==========================================================*/
/* $.ajax({

 	url: "ajax/datatable-productos.ajax.php",
 	success:function(respuesta){
 		console.log("respuesta", respuesta);
 	}
 })
*/
$('.tablaConteo').DataTable( {
    "ajax": "ajax/datatable-productos-conteo.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );


/*================================================================
=            CAPTURANDO CATEGORIA PARA ASIGNAR CODIGO            =
================================================================*/

$("#nuevaCategoria").change(function(){
	
	var idCategoria = $(this).val();

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType:false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			if(!respuesta){
				var nuevoCodigo = idCategoria+"01";
				$("#nuevoCodigo").val(nuevoCodigo);
			}else{
				var nuevoCodigo = Number(respuesta["codigo"])+1;
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			

		}

	})
	
});

/*================================================================
=          AGREGANDO NUEVO PRECIO DE VENTA                      =
================================================================*/

$("#nuevoPrecioCompra").change(function(){
	if($(".porcentaje").prop("checked")){
		var valorPorcentaje = $(".nuevoPorcentaje").val();
		console.log("valorPorcentaje", valorPorcentaje);	
		var porcentaje = (Number($("#nuevoPrecioCompra").val())*valorPorcentaje/100)+Number($("#nuevoPrecioCompra").val());
		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly", true);
	}else{

	}
	
});

$(".nuevoPorcentaje").change(function() {
	if($(".porcentaje").prop("checked")){
		var valorPorcentaje = $(".nuevoPorcentaje").val();
		console.log("valorPorcentaje", valorPorcentaje);	
		var porcentaje = (Number($("#nuevoPrecioCompra").val())*valorPorcentaje/100)+Number($("#nuevoPrecioCompra").val());
		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly", true);
	}else{

	}
})

$(".porcentaje").on("ifUnchecked", function(){
	$("#nuevoPrecioVenta").prop("readonly", false);
});

$(".porcentaje").on("ifChecked", function(){
	var valorPorcentaje = $(".nuevoPorcentaje").val();
	console.log("valorPorcentaje", valorPorcentaje);	
	var porcentaje = (Number($("#nuevoPrecioCompra").val())*valorPorcentaje/100)+Number($("#nuevoPrecioCompra").val());
	$("#nuevoPrecioVenta").val(porcentaje);	
	$("#nuevoPrecioVenta").prop("readonly", true);
});

/*=================================================
=            SUBIENDO FOTO DEL PRODUCTO            =
=================================================*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	//console.log("imagen", imagen);

	/*=================================================
=            VALIDANDO FORMATO DE IMAGEN            =
=================================================*/

	if(imagen["type"] != "image/jpeg"  && imagen["type"] != "image/png"){
		$(".nuevaImagen").val("");

		swal({

			title: "Error al subir imagen",
			text: "!La Imagen debe estar en formato JPG o PNG¡",
			type: "error",
			confirmationButtonText: "!Cerrar¡"

		});

	}else if(imagen["size"] > 2000000){
		$(".nuevaImagen").val("");

		swal({

			title: "Error al subir imagen",
			text: "!La Imagen debe pesar mas de 2MB¡",
			type: "error",
			confirmationButtonText: "!Cerrar¡"

		});

	}else{
		
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		
		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		});
	}

});

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){
	var idProducto = $(this).attr("idProducto");
	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			var datosStatus = new FormData();
			datosStatus.append("idStatus", respuesta["status"]);
			$.ajax({
				url: "ajax/status.ajax.php",
				method: "POST",
				data: datosStatus,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){
					$("#editarStatus").val(respuesta["id_status"]);
					$("#editarStatus").html(respuesta["descripcion"])
				}

			});
			$("#eidProducto").val(respuesta["id_producto"]);
			$("#editarTipo").val(respuesta["tipo"]);
			$("#editarMarca").val(respuesta["marca"]);
			$("#editarCantidad").val(respuesta["cantidad"]);
			$("#editarLongitud").val(respuesta["longitud"]);
			$("#editarPeso").val(respuesta["peso_unitario"]);
			$("#editarUnidad").val(respuesta["unidad"]);
		}
	})
});

$(".tablaConteo tbody").on("click", "button.btnRechazarConteo", function(){

	var idConteo = $(this).attr("idconteo");
	var idProducto = $(this).attr("idproducto");
	var idStatus = $(this).attr("idstatus");
	var rechazar = true;
	var datos = new FormData();

	datos.append("idProductor", idProducto);
	datos.append("idConteor", idConteo);
	datos.append("idStatusr", idStatus);
	datos.append("rechazar", rechazar);
	
	$.ajax({
		url: "ajax/productos.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if (respuesta == "ok"){
				swal({
					type: "success",
					title: "El producto ha sido rechazado",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then((result)=>{
					if(result.value){
						window.location = "escaneo";
					}
				})
			}else if(respuesta == "error"){
				swal({
					type: "info",
					title: "Este producto no puede ser rechazado por su área",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then((result)=>{
					if(result.value){
						window.location = "escaneo";
					}
				})
			}
		}

	});
});


/*======================================
=            FILTRO DE OBRA            =
======================================*/

$("#ObraProductos").on("change", function(){
	$.post("ajax/productos.ajax.php",{
		obraProductos: $(this).val()
	}).done(function(){
		BorrarTablaProductos();
		CargarTablaProductos();
	});
});

function BorrarTablaProductos(){
	
	var table =$(".tablaProductos").DataTable();

	table.destroy();
	
}

function CargarTablaProductos(){

	$('.tablaProductos').DataTable({
    "ajax": "ajax/datatable-productos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

}

/*=====  End of FILTRO DE OBRA  ======*/


$("#nuevaMarca").change(function(){
	
	$(".alert").remove();
	var marca = $(this).val();
	var id_obra = $("#nuevaObra").val();

	var datos = new FormData();
	datos.append("validarMarca", marca);
	datos.append("validarObra", id_obra);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType:false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			if(respuesta){
			
				$("#nuevaMarca").parent().after('<div class="alert alert-warning">Esta marca ya existe en esta obra</div>');

				$("#nuevaMarca").val("");
			}
		}
	});
});

