<?php

$productos = ControladorProductos::ctrMostrarProductosPorStatus();

$productosall = ControladorProductos::ctrMostrarTotalProductos();

?>

<div class="box box-default">
  
  <div class="box-header with-border">
  
    <h3 class="box-title">Productos por Status</h3>    
  
  </div>
  <!-- /.box-header -->
  <div class="box-body border-radius-none">
  
    <canvas id="pie-chart" height="110"></canvas>

</div>

<script>
  
  new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: [<?php 
          foreach ($productos as $key => $value) {
            echo "'".$value["descripcion"]."',";
          }
        ?>],
      datasets: [{
        label: "Productos",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3e96cd","#e1c3b9","#2e5ea2","#5e6ea2"],
        data: [<?php 
          foreach ($productos as $key => $value) {
            echo $value["count(p.id_producto)"].",";
          }
        ?>]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Productos Por Status'
      }
    }
});

</script>
