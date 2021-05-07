<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Administrar Obras
        
      </h1>
      
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>        

        <li class="active">Administrar Obras</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarObra">

            Agregar Obra

          </button>       

          
        
        </div>
        
        <div class="box-body">
          
            <table class="table table-bordered table-striped dt-responsive tablas" >
              
              <thead>
                <tr>

                  <th style="width: 10px">#</th>
                  <th>Obras</th>                  
                  <th>Acciones</th>

                </tr>

              </thead>

              <tbody>

                <?php
                  $item = null;
                  $valor = null;
                  $obras = ControladorObras::ctrMostrarObrasTodas($item, $valor);
                  
                  foreach ($obras as $key => $value) {

                    echo '<tr>
                  <td>'.($key+1).'</td>
                  
                  <td>'.$value["descripcion"].'</td>
                  
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarObra" data-toggle="modal" data-target="#modalEditarObra" idObra="'.$value["id_obra"].'" ><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarObra" idObra="'.$value["id_obra"].'" ><i class="fa fa-times"></i></button>
                    </div>
                  </td>

                </tr>';
                  }
                ?>

                
                  
                
              </tbody>

            </table>



        </div>
        
      </div>

    </section>

</div>


  <!--=====================================
      =     MODAL AGREGAR OBRA            =
      =====================================-->


<div id="modalAgregarObra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Obra</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">

            <!-- ENTRADA PARA OBRA -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaObra" placeholder="Ingresar Obra" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR CLIENTE-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="nuevoCliente" required>
                  
                  <option value="" id="nuevoCliente">Cliente</option>
                  <?php
                    $item = null;
                    $valor = null;
                    $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                    
                    foreach ($cliente as $key => $value) {
                      echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="nuevoStatus" required>
                  
                  <option value="" id="nuevoStatus">Status</option>
                  <?php
                    $item = null;
                    $valor = null;
                    $status = ControladorObras::ctrMostrarStatus($item, $valor);
                    
                    foreach ($status as $key => $value) {
                      echo '<option value="'.$value["id_status_obra"].'">'.$value["descripcion"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn bg-primary">Guardar Obra</button>
              
            </div>

            
          </div>
        
        </div>

        <!--=====================================
        =     PIE DEL MODAL            =
        =====================================-->
        
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
        </div>
        <?php

          $crearObra = new ControladorObras();
          $crearObra -> ctrCrearObra();

        ?>
        

    </form>
    
    </div>

  </div>

</div>

<!--=====================================
        =     MODAL EDITAR OBRA            =
        =====================================-->

<div id="modalEditarObra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar Obra</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">

            <!-- ENTRADA PARA OBRA -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <input type="text" class="form-control input-lg" id="editarObra" name="editarObra" value="" required>

                <input type="hidden" class="form-control input-lg" id="idObra" name="idObra" value="">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR CLIENTE-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                  
                  <?php
                    $item = null;
                    $valor = null;
                    $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                    
                    foreach ($cliente as $key => $value) {
                      echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR STATUS-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="editarStatus" id="editarStatus" required>
                  
                  <?php
                    $item = null;
                    $valor = null;
                    $status = ControladorObras::ctrMostrarStatus($item, $valor);
                    
                    foreach ($status as $key => $value) {
                      echo '<option value="'.$value["id_status_obra"].'">'.$value["descripcion"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>                      
            

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn bg-primary">Guardar Cambios</button>
              
            </div>

            
          </div>
        
        </div>

        <!--=====================================
        =     PIE DEL MODAL            =
        =====================================-->
        
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
        </div>

        <?php
            $editarObra = new ControladorObras();
            $editarObra -> ctrEditarObra();

        ?>

    </form>
    
    </div>

  </div>

</div>



