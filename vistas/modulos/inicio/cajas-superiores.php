<?php

$item = null;
$valor = null;

$Productos = ControladorProductos::ctrMostrarProductos($item, $valor);
$totalProductos = count($Productos);

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

$totalUsuarios = count($usuarios);

$obras = ControladorObras::ctrMostrarObras($item, $valor);
$totalObras = count($obras);

$remisiones = ControladorRemisiones::ctrMostrarRemisiones($item, $valor);
$totalRemisiones = count($remisiones);


?>

<div class="row">
  
  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-aqua">
  
      <div class="inner">
        
        <h3><?php echo number_format($totalProductos); ?></h3>

        <p>Productos</p>
      </div>

      <div class="icon">
        
        <i class="ion ion-stats-bars"></i>
        
      
      </div>
      
      <a href="productos" class="small-box-footer">

        Más información <i class="fa fa-arrow-circle-right"></i>

      </a>

    </div>

  </div>


  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-green">
      
      <div class="inner">
        
        <h3><?php echo number_format($totalUsuarios); ?></h3>

        <p>Usuarios</p>

      </div>

      <div class="icon">

        <i class="ion ion-person-add"></i>

      </div>

      <a href="servicios" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
  
    </div>

  </div>

  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-yellow">
      
      <div class="inner">

        <h3><?php echo number_format($totalObras); ?></h3>

        <p>Obras</p>

      </div>

      <div class="icon">
        
        <i class="ion ion-clipboard"></i>
      
      </div>

      <a href="obras" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

  </div>

  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-red">

      <div class="inner">

        <h3><?php echo number_format($totalRemisiones); ?></h3>

        <p>Remisiones</p>
        
      </div>
    
      <div class="icon">

        <i class="ion ion-folder"></i>
        
      </div>
      
      <a href="remisiones" class="small-box-footer">
        Mas información <i class="fa fa-arrow-circle-right"></i>
      </a>

    </div>
  
  </div>
  
</div>
      