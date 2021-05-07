<?php



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  
  <title>SymbioTICs | SinapSys</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

  <!-- PLUGINS DE CSS -->
  
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">

  <link rel="stylesheet" href="vistas/dist/css/quagga.css">
  
  <!-- AdminLTE Skins  -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck para checkboxes y radio inputs-->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">
  <!-- morris chart-->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">  


<!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

<!-- jQuery 3 -->
<!--<script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- FastClick -->
<script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

<!-- Sweet Alert 2-->
<script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

<!-- Sweet Alert 2-->
<script src="vistas/plugins/iCheck/icheck.min.js"></script>

<!-- Codigo de barras-->

<script src="vistas/plugins/barcode/js/adapter-lastest.js" type="text/javascript"></script>
<script src="vistas/plugins/barcode/js/quagga.js" type="text/javascript"></script>
<script src="vistas/plugins/barcode/js/live_w_locator.js" type="text/javascript"></script>

<!-- bootstrap datepicker -->
<script src="vistas/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Funcion para cmpativilidad con internet explorer 11 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!--Librerias para generar PDF-->

<script src="vistas/plugins/html2canvas/jspdf.min.js" type="text/javascript"></script>

<script src="vistas/plugins/html2canvas/html2canvas.js" type="text/javascript"></script>

<!-- morris.js charts-->
<script src="vistas/bower_components/raphael/raphael.min.js"></script>
<script src="vistas/bower_components/morris.js/morris.min.js"></script>

<!-- ChartJS -->
<script src="vistas/bower_components/chart.js/Chart.js"></script>
<!-- Flot Charts -->
<script src="vistas/bower_components/Flot/jquery.flot.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

  <audio id="beep">
    <source src="vistas/plugins/barcode/audio/beep.mp3" type="audio/mpeg">
  </audio>

  <?php

    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
    
    echo '<div class="wrapper">';
    
    /*=============================================
    =            CABEZOTE
    =============================================*/
    
    include "modulos/cabezote.php";

    /*=============================================
    =            MENU            =
    =============================================*/
    
    include "modulos/menu.php";

    /*=============================================
    =            CONTENIDO            =
    =============================================*/
    if(isset($_GET["ruta"])){
      
      if($_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "usuarios" ||
         $_GET["ruta"] == "categorias" || 
         $_GET["ruta"] == "productos" ||
         $_GET["ruta"] == "escaneo" ||
         $_GET["ruta"] == "ventas" ||
         $_GET["ruta"] == "crear-remision" ||
         $_GET["ruta"] == "editar-remision" ||
         $_GET["ruta"] == "remisiones" ||
         $_GET["ruta"] == "obras" ||
         $_GET["ruta"] == "clientes" ||
         $_GET["ruta"] == "reportes" ||
         $_GET["ruta"] == "salir" 
       ){
      
        include "modulos/".$_GET["ruta"].".php";    
      
      }else{

        include "modulos/404.php";

      }        
      
    }else{

      include "modulos/inicio.php";

    }

    

    /*=============================================
    =            FOOTER            =
    =============================================*/

    include "modulos/footer.php";

    echo "</div>";
  
  }else{

      include "modulos/login.php";

  }

  ?>

  

<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/remision.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/obras.js"></script>
<script src="vistas/js/productos.js"></script>
<script src="vistas/js/escaneo.js"></script>
<script src="vistas/js/clientes.js"></script>

</body>
</html>
