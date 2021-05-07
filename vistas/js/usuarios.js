/*=================================================
=            SUBIENDO FOTO DEL USUARIO            =
=================================================*/

$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	//console.log("imagen", imagen);

	/*=================================================
=            VALIDANDO FORMATO DE IMAGEN            =
=================================================*/

	if(imagen["type"] != "image/jpeg"  && imagen["type"] != "image/png"){
		$(".nuevaFoto").val("");

		swal({

			title: "Error al subir imagen",
			text: "!La Imagen debe estar en formato JPG o PNG¡",
			type: "error",
			confirmationButtonText: "!Cerrar¡"

		});

	}else if(imagen["size"] > 2000000){
		$(".nuevaFoto").val("");

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

/*======================================
=            EDITAR USUARIO            =
======================================*/
$(document).on("click", ".btnEditarUsuario", function(){
	var idUsuario = $(this).attr("idUsuario");
	//console.log("idUsuario", idUsuario);
	
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){			
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#passwordActual").val(respuesta["password"]);
			$("#editarPerfil").val(respuesta["id_perfil"]);
			$("#fotoActual").val(respuesta["foto"]);
			
			if(respuesta["foto"]!=""){
				$(".previsualizar").attr("src", respuesta["foto"]);
			}
			//Estableciendo el valor del select conforme al perfil del usuario
			$("#editar_perfil option[value='"+respuesta["id_perfil"]+"']").attr("selected",true);			
			
			

		}
	});
});


/*=====  End of EDITAR USUARIO  ======*/

/*=======================================
=            Activar Usuario            =
=======================================*/

$(document).on("click", ".btnActivar", function() {
	
	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
	datos.append("activarId", idUsuario);
	datos.append("activarUsuario", estadoUsuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			
			if(window.matchMedia("(max-width:767px)").matches){

				swal({
					title: "el usuario ha sido actualizado",
					type: "success",
					confrimButtonText: "cerrar"
				}).then(function(result){

					if (result.value){

						window.location = "usuarios"
					}

				});
				
			}

		}
	})

	if(estadoUsuario == 0){
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario', 1);
	}else{
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-success');
		$(this).html('Activado');
		$(this).attr('estadoUsuario', 0);
	}

})


/*=====  End of Activar Usuario  ======*/

/*=============================================================
=            Revisar si ya esta registrado usuario            =
=============================================================*/

$("#nuevoUsuario").change(function(){
	
	$(".alert").remove();

	var usuario = $(this).val();
	
	var datos = new FormData();	
	datos.append("validarUsuario", usuario);

	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			
			if(respuesta){
				$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

				$("#nuevoUsuario").val("");
			}

		}
	});


});


/*=====  End of Revisar si ya esta registrado usuario  ======*/

/*========================================
=            Eliminar Usuario            =
========================================*/

$(document).on("click", ".btnEliminarUsuario", function(){
	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");
	swal({
		title: '¿Estas seguro de borrar el usuario?',
		text: '¡si no lo está puede cancelar la accion!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario!'

	}).then(function(result){
		if(result.value){

			window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;

		}
		

	});

});



/*=====  End of Eliminar Usuario  ======*/
