$(".btnEditarCliente").click(function(){	
	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({
		url:"ajax/clientes.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$("#editarNombre").val(respuesta["nombre"]);
			$("#idCliente").val(respuesta["id_cliente"])
			console.log("respuesta", respuesta);
		}
	})
});


$(".btnEliminarCliente").click(function(){
	
	var idCliente = $(this).attr("idCliente");
	var datos = new FormData();
	datos.append("idCliented", idCliente);

	swal({
		title: '¿Esta seguro que desea borrar al cliente?',
		text: '¡Si no lo está, puede cancelar la acción!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, Borrar Cliente'
		
	}).then((result)=>{
		if(result.value){
			$.ajax({
				url:"ajax/clientes.ajax.php",
				method:"POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function(result){
					if(result == "ok"){					
					
					swal({
							type: "success",
							title: "!el cliente ha sido borrado correctamente",
							showConfirmButton: true,
							confirmButtonText: "cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "clientes";
							}
						});
					}if(result == "error"){

						swal({
							type: "error",
							title: "!No tiene los privilegios necesarios para eliminar!",
							showConfirmButton: true,
							confirmButtonText: "cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "clientes";
							}
						});

					}
					
				}
			
			});
		}
	});
	
});