$('.tablaProductosRemision').DataTable({
    "ajax": "ajax/datatable-productos-remision.ajax.php",
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

});





/*$("#genRemPDF").click(function(){
	/*var contPDF = $("#contPDF").html();	
	$.post("ajax/remision.ajax.php",{contPDF: contPDF}, function(data){
		var w = window.open("about:blank", "remision.pdf");
		w.document.open();
		w.document.write(data);
		w.document.close();
	});
	$("#genRemPDF").hide(function(){
		html2canvas(document.querySelector("#contPDF"), {
			onrendered: function(canvas){
				var img = canvas.toDataURL("image/png");
				var doc = new jsPDF();
				doc.addImage(img, 'JPEG', 20, 20);
				doc.save('prueba.pdf');
			}
		});	
		$("#genRemPDF").show();
	});
	
});*/

$(".tablaProductosRemision tbody").on("click", "button.agregarProducto", function(){
	
	var idProducto = $(this).attr("idProducto");
	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	$.ajax({
		
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){

			var tipo = respuesta["tipo"];
			var marca = respuesta["marca"];
			var total = respuesta["total"];
			var cantidad = respuesta["cantidad"];

			
			$(".nuevoProducto").append(
			'<div class="row" style="padding:5px 15px">'+
				'<!--Descripcion del producto-->'+
                  
                  '<div class="col-xs-6" style="padding-right:0px">'+

                    '<div class="input-group">'+
                      
                      '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                      '<input type="text" class="form-control nuevaDescripcionProducto" name="agregarProducto" idProducto="'+idProducto+'" value="'+tipo+' '+marca+'" readonly required>'+

                    '</div>'+

                  '</div>'+
                  
                  '<!--Cantidad del producto-->'+
                  
                  '<div class="col-xs-3 ingresoCantidad">'+
                    
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'+cantidad+'" cantidad="'+cantidad+'" readonly>'+

                  '</div>'+
                    
                 '</div>');

			listarProductos();
			
		}


	});
});

/*====================================================
=  AL NAVEGAR EN LA TABLA   =
======================================================*/


$(".tablaProductosRemision").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
		console.log(listarProductos.length);
		for(var i = 0; i < listaIdProductos.length; i++){
		
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}

	}

})

 var idQuitarProducto = [];

 localStorage.removeItem("quitarProducto");

/*====================================================
=  QUITAR PRODUCTOS DE LA REMISION Y RECUPERAR BOTON   =
======================================================*/


$(".formularioRemision").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*==============================================================
	=  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR   =
	===============================================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];

	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));


	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	listarProductos();

	

});

/*===================================================================
=            AGREGANDO PRODUCTOS DESDE DISPOSITIVO MOVIL            =
===================================================================*/
var numProducto = 0;
$(".btnAgregarProducto").click(function(){
	numProducto ++;
	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			
			$(".nuevoProducto").append(
			'<div class="row" style="padding:5px 15px">'+
				'<!--Tipo del producto-->'+
                  
                  '<div class="col-xs-6" style="padding-right:0px">'+

                    '<div class="input-group">'+
                      
                      '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

                      '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

                      '<option>Seleccione el producto</option>'+

                      '</select>' +

                    '</div>'+

                  '</div>'+                 
                  
                    
                 '</div>');

			//agregar los productos al select

			respuesta.forEach(funcionForEach);

			function funcionForEach(item, index){

				if(item.stock != 0){

					$("#producto"+numProducto).append(

						'<option idProducto="'+item.id_producto+'" value="'+item.id_producto+'">'+item.tipo+' '+item.marca+'</option>'

					)
				}



			}

		}
	});
});

/*=====  End of AGREGANDO PRODUCTOS DESDE DISPOSITIVO MOVIL  ======*/

/*============================================
=            SELECCIONAR PRODUCTO            =
============================================*/

$(".formularioRemision").on("change", "select.nuevaDescripcionProducto", function(){

	var idProducto = $(this).val();

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevoPrecioProducto");

	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			listarProductos();
		}
	});

});

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id_producto": $(descripcion[i]).attr("idProducto"), 
							  "descripcion": $(descripcion[i]).val()});		
	}

	
	$("#listaProductos").val(JSON.stringify(listaProductos));

}

/*==========================================
=           BOTON EDITAR REMISION            =
==========================================*/

$(".btnEditarRemision").click(function(){
	var idRemision = $(this).attr("idRemision");

	window.location = "index.php?ruta=editar-remision&idRemision="+idRemision;
});

/*=====  End ofBOTON EDITAR REMISION  ======*/

/*=================================================================================================================
=            FUNCION PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABIA SIDO SELECCIONADO            =
=================================================================================================================*/

function quitarAgregarProducto(){

	//capturamos todos los id de producto que fueron elegidos en la remision
	var idProducto = $(".quitarProducto");
	//capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaProductosRemision tbody button.agregarProducto");
	//recorremos un ciclo para obtener los diferentes idProductos que fueron agregados a la remision
	
	for(var i = 0; i  < idProducto.length; i++){
		
		//capturamos los id de los productos agregados a la remision		
		var boton = $(idProducto[i]).attr("idProducto");
		
		//hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTabla.length; j++){

			if($(botonesTabla[j]).attr("idProducto") == boton){
				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");
			}
		}
	}

}

$(".tablaProductosRemision").on('draw.dt', function(){

	quitarAgregarProducto();

});


/*=====  End of FUNCION PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABIA SIDO SELECCIONADO  ======*/

/*====================================
=            BORRAR REMISION            =
====================================*/

$(".btnEliminarRemision").click(function(){

	var idRemision = $(this).attr("idRemision");

	swal({
		title:'¿Está seguro de borrar la remision?',
		text: "¡Si no está seguro puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar remision!'
	}).then((result) => {
		if (result.value){
			window.location = "index.php?ruta=remisiones&idRemision="+idRemision;
		}
	})
});

/*=====  End of BORRAR REMISIONES  ======*/

/*========================================
=            IMPRIMIR FACTURA            =
========================================*/

$(".tablas").on("click", ".btnImprimirRemision", function(){
	
	var idRemision = $(this).attr("idRemision");

	window.open("extensiones/tcpdf/pdf/remision.php?idRemision="+idRemision, "_blank");
})

/*=====  End of IMPRIMIR FACTURA  ======*/

$("#seleccionarCliente").on("change", function(){
	
	idCliente = $(this).val();
	var datos = new FormData();

	$("#seleccionarObra").empty();

	datos.append("idCliente", idCliente);

	$.ajax({

		url:"ajax/obras.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      		$("#seleccionarObra").append(
      			'<option value="">Seleccionar Obra</option>'
      		);

	        // AGREGAR LOS PRODUCTOS AL SELECT 

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){

	         	if(item.descripcion != ""){

		         	$("#seleccionarObra").append(

						'<option idObra="'+item.id_obra+'" value="'+item.id_obra+'">'+item.descripcion+'</option>'
		         	)

		         
		         }

		         

	         }
	     }
	})
});

$("#seleccionarObra").on("change", function(){
	$.post("ajax/productos.ajax.php",{
		obraProductos: $(this).val()
	}).done(function(){
		BorrarTablaProductosRem();
		CargarTablaProductosRem();
	});
});

function BorrarTablaProductosRem(){
	
	var table =$(".tablaProductosRemision").DataTable();

	table.destroy();
	
}

function CargarTablaProductosRem(){

	$('.tablaProductosRemision').DataTable({
	    "ajax": "ajax/datatable-productos-remision.ajax.php",
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

	});

}


