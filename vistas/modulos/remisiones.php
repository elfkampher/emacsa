<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Administrar Remisiones
        
      </h1>
      
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>        

        <li class="active">Administrar Remision</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">

          <a href="crear-remision">

            <button class="btn btn-primary">

              Agregar Remision

            </button>       
          
          </a>
          
        
        </div>
        
        <div class="box-body">
          
            <table class="table table-bordered table-striped dt-responsive tablas" >
              
              <thead>
                <tr>

                  <th style="width: 10px">#</th>
                  <th>Numero Remision</th>
                  <th>Cliente</th>                  
                  <th>Usuario</th>
                  <th>Obra</th>                  
                  <th>Fecha</th>                  
                  <th>Acciones</th>

                </tr>

              </thead>

              <tbody>

              <?php 

              $item = null;
              $valor = null;

              $respuesta = ControladorRemisiones::ctrMostrarRemisiones($item, $valor);

              
              
              foreach ($respuesta as $key => $value) {
                
                echo '<tr>
                  
                  <td>'.($key+1).'</td>
                  
                  <td>'.($value["clave"]).'</td>';

                  $itemCliente = "id_cliente";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = controladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
                  
                  echo '<td>'.$respuestaCliente["nombre"].'</td>';                  

                  $itemUsuario = "id_usuarios";
                  $valorUsuario = $value["id_usuario"];

                  $respuestaUsuario = controladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
                  
                  echo '<td>'.$respuestaUsuario["nombre"].'</td>';

                  $itemObra = "id_obra";
                  $valorObra = $value["id_obra"];

                  $respuestaObra = controladorObras::ctrMostrarObras($itemObra, $valorObra);
                  
                  echo '<td>'.$respuestaObra["descripcion"].'</td>
                  
                  <td>'.$value["fecha_remision"].'</td>                  
                  
                  <td>
                  
                    <div class="btn-group">

                      <button class="btn btn-info btnImprimirRemision" idRemision="'.$value["id_remision"].'">
                      
                        <i class="fa fa-print"></i>

                      </button>

                      <button class="btn btn-warning btnEditarRemision" idRemision ="'.$value["id_remision"].'"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarRemision"  idRemision ="'.$value["id_remision"].'"><i class="fa fa-times"></i></button>

                    </div>

                  </td>                  

                </tr>';

              }

              

              ?>

                
                  
                
              </tbody>

            </table>

            <?php

              $eliminarRemision = new ControladorRemisiones();
              $eliminarRemision -> ctrEliminarRemision();

            ?>

        </div>
        
      </div>

    </section>

</div>


  