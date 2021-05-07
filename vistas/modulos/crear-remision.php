<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>

        Nueva Remision
        
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>        
        <li class="active">Nueva Remisión</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

     <div class="row">


       <!--===================================
                  EL FORMULARIO
      =======================================-->

       <div class="col-lg-5 col-xs-12">

        <div class="box box-success">
          
          <div class="box-header with-border"></div>
          
          <form role="form" method="post" class="formularioRemision">

          <div class="box-body">            
              
              <div class="box">
                
                <!--===================================
                        ENTRADA DEL USUARIO
                =======================================-->
                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id_usuarios"];?>" >

                  </div>

                </div>

                <!--===================================
                        ENTRADA DEL CODIGO DE LA REMISION
                =======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $remisiones = ControladorRemisiones::ctrMostrarRemisiones($item, $valor);

                    if(!$remisiones){

                      echo '<input type="text" class="forma-control" id="nuevaRemision" name="nuevaRemision" value="10001" readonly>';                      

                    }else{

                      foreach ($remisiones as $key => $value) {
                        # code...
                      }
                      $idRemision = $value["id_remision"]+1;

                      echo '<input type="text" class="forma-control" id="nuevaRemision" name="nuevaRemision" value="'.$idRemision.'" readonly>';

                    }

                    ?>
                    

                  </div>

                </div>

                <!--===================================
                        ENTRADA DEL CLIENTE
                =======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select type="text" class="form-control" name="seleccionarCliente" id="seleccionarCliente" required>
                      
                      <option value="">Seleccionar Cliente</option>

                      <?php
                      
                      $item = null;
                      $valor = null;

                      $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($clientes as $key => $value) {
                        
                        echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                      }
                      ?>

                    </select>

                    <!--<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>-->

                  </div>

                </div>

                <!--===================================
                        ENTRADA DE LA OBRA
                =======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>

                    <select type="text" class="form-control" name="seleccionarObra" id="seleccionarObra" required>
                      
                      <option value="">Seleccionar Obra</option>

                      <?php
                      
                      $item = null;
                      $valor = null;

                      $clientes = ControladorObras::ctrMostrarObras($item, $valor);

                      foreach ($clientes as $key => $value) {
                        
                        echo '<option value="'.$value["id_obra"].'">'.$value["descripcion"].'</option>';
                      }
                      ?>

                    </select>

                    <!--<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Obra</button></span>-->

                  </div>

                </div>

                <!--===================================
                     ENTRADA PARA AGREGAR PRODUCTO 
                =======================================-->
                <div class="form-group row nuevoProducto">

                  
                  
                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--BOTON PARA AGREGAR PRODUCTO-->                

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar Producto</button>

                <hr>

                <div class="row">
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">
                      
                      <thead>          

                        <tbody>

                          

                        </tbody>

                      </thead>

                    </table>

                  </div>  

                </div>

                <hr>                

                <br>
                
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar Remision</button>
            
          </div>

          </form>

          <?php

          $guardarRemision = new ControladorRemisiones();
          $guardarRemision -> ctrCrearRemision();
          
        ?>

        </div>
         
       </div>

       <!--===================================
                  TABLA DE PRODUCTOS
      =======================================-->

       <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">
          
          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaProductosRemision">
              
              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>tipo</th>
                  <th>marca</th>
                  <th>obra</th>
                  <th>cantidad</th>                  
                  <th>peso unitario</th>
                  <th>total</th>
                  <th>Acciones</th>
                </tr>
                
              </thead>              

            </table>

          </div>

        </div>
         
       </div>

     </div>

    </section>
    <!-- /.content -->
</div>

<!--=====================================
      =     MODAL AGREGAR CLIENTE            =
      =====================================-->


<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Cliente</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">

            <!-- ENTRADA PARA NOMBRE -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA DOCUMENTO ID -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar Documento">

              </div>

            </div>

            <!-- ENTRADA PARA EMAIL -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Telefono" data-inputmask="'mask':'(999) 999-99-99'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA DIRECCION -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA FECHA DE NACIMIENTO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

            

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn bg-primary">Guardar Cliente</button>
              
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

          $crearCliente = new ControladorClientes();
          $crearCliente -> ctrCrearCliente();

        ?>
        

    </form>
    
    </div>

  </div>

</div>
 