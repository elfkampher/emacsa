/*=============================================
=            sidebar menu            =
=============================================*/


$('.sidebar-menu').tree();

/*=============================================
=            Data Table            =
=============================================*/

$(".tablas").DataTable({

	"language":{
		sProcessing:     "Procesando...",
        sSearch:         "Buscar:",
        sLengthMenu:    "Mostrar _MENU_ registros",
        sInfo:           "mostrando registros del _START_ al _END_ de un total de _TOTAL_ ",
        sInfoEmpty:      "mostrando registros del 0 al 0 de un total de 0",
        sinfoFiltered:   "(filtrado de un total de  _MAX_ registros)",
        sInfoPostFix:    "",
        sLoadingRecords: "Cargando...",
        sZeroRecords:    "No hay registros",
        emptyTable:     "tabla vacia",
        oPaginate: {
            sFirst:      "Primero",
            sPrevious:   "Anterior",
            sNext:       "Siguiente",
            sLast:       "Ultimo"
        },
        oAria: {
            sortAscending:  ": Activar para ordenar la columna de manera ascendente",
            sortDescending: ": Activar para ordenar la columna de manera descendente"
        }

	}


});

/*=============================================
=            iCheck            =
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
})