$(document).on("click", ".btnEditarObra" ,function(){	
	
	$("#editarCliente").find("option").attr("selected",false);
	$("#editarStatus").find("option").attr("selected",false);
	

	var idObra = $(this).attr("idObra");
	var datos = new FormData();
	datos.append("idObra", idObra);

	$.ajax({
		url:"ajax/obras.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$("#editarObra").val(respuesta["descripcion"]);
			$("#idObra").val(respuesta["id_obra"]);
			$("#editarCliente option[value='"+respuesta["id_cliente"]+"']").attr("selected",true);
			$("#editarStatus option[value='"+respuesta["id_status_obra"]+"']").attr("selected",true);
			console.log("respuesta", respuesta);
		}
	})
});


$(document).on("click", ".btnEliminarObra",function(){
	
	var idObra = $(this).attr("idObra");
	var datos = new FormData();
	datos.append("idObrad", idObra);

	swal({
		title: '¿Esta seguro que desea borrar la obra?',
		text: '¡Si no lo está, puede cancelar la acción!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, Borrar Obra'
		
	}).then((result)=>{
		if(result.value){
			$.ajax({
				url:"ajax/obras.ajax.php",
				method:"POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function(result){
					if(result == "ok"){					
					
					swal({
							type: "success",
							title: "!La obra ha sido borrada correctamente",
							showConfirmButton: true,
							confirmButtonText: "cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = "obras";
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
								window.location = "obras";
							}
						});

					}
					
				}
			
			});
		}
	});
	
}); 