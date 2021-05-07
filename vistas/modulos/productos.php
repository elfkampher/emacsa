<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Administrar Productos
        
      </h1>
      
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>        

        <li class="active">Administrar Productos</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">

          <div class="input-group col-xs-6">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">

            Agregar Producto

          </button>
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalImportarTabla">

            Importar Excel

          </button>
          
          <span class="input-group-addon"><i class="fa fa-building"></i></span>
            <select class="input-sm" name="ObraProductos" id="ObraProductos">
                  
              <option value="" >Obra</option>
              <?php              
                $item = null;
                $valor = null;
                $obra = ControladorObras::ctrMostrarObras($item, $valor);
                
                foreach ($obra as $key => $value) {
                  echo '<option value="'.$value["id_obra"].'">'.$value["descripcion"].'</option>';
                }                
              ?>

            </select>       

          </div>
        
        </div>

                
        <div class="box-body">
          
            <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
              
              <thead>
                <tr>

                  <th style="width:10px">#</th>
                  <th>tipo</th>
                  <th>marca</th> 
                  <th>status</th>                  
                  <th>Cantidad</th>                  
                  <th>longitud</th>
                  <th>Peso Unitario</th>
                  <th>Peso Total</th>
                  <th>Obra</th>                
                  <th>Acciones</th>

                </tr>

              </thead>

              

            </table>



        </div>
        
      </div>

    </section>

</div>


  <!--=====================================
      =     MODAL AGREGAR PRODUCTO            =
      =====================================-->


<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Producto</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">
            
            <!-- ENTRADA PARA SELECCIONAR OBRA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="nuevoStatus" id="nuevoStatus" required>
                  
                  <option value="">Status</option>
                  <?php

                    $status = ControladorProductos::ctrMostrarStatus();
                    
                    foreach ($status as $key => $value) {
                      echo '<option value="'.$value["id_status"].'">'.$value["descripcion"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR OBRA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="nuevaObra" id="nuevaObra" required>
                  
                  <option value="" >Obra</option>
                  <?php
                    $item = null;
                    $valor = null;
                    $obra = ControladorObras::ctrMostrarObras($item, $obra);
                    
                    foreach ($obra as $key => $value) {
                      echo '<option value="'.$value["id_obra"].'">'.$value["descripcion"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL TIPO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoTipo" name="nuevoTipo" placeholder="Ingresar Tipo" required>

              </div>

            </div>

            <!-- ENTRADA LA MARCA -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaMarca" id="nuevaMarca" placeholder="Ingresar Marca" required>

              </div>

            </div>

            <!-- ENTRADA PARA CANTIDAD -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="nuevaCantidad" min="0" placeholder="Cantidad" required>

              </div>

            </div>

            <!-- ENTRADA PARA LONGITUD -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-long-arrow-up"></i></span>

                <input type="number" class="form-control input-lg" name="nuevaLongitud" min="0" placeholder="Longitud" required>

              </div>

            </div>

            <!-- ENTRADA PARA PESO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>

                <input type="number" class="form-control input-lg" id="nuevoPeso" name="nuevoPeso" step="any" min="0" placeholder="Peso Unitario" required>

              </div>

            </div>

             <!-- ENTRADA PARA UNIDAD -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>

                <input type="text" class="form-control input-lg" id="nuevaUnidad" name="nuevaUnidad"  placeholder="Unidad de Medida" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR IMAGEN -->

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen" id="nuevaFoto">

              <p class="help-block">peso maximo 200 MB </p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

            <!--FOOTER-->

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn bg-primary">Guardar Producto</button>
              
            </div>

            
          </div>
        
        </div>

        <!--=====================================
        =     PIE DEL MODAL            =
        =====================================-->
        
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        
        </div>

      </form>

    <?php
      $crearProducto = new controladorProductos();
      $crearProducto -> ctrCrearProducto();
    ?>
    
    </div>

  </div>

</div>


  <!--=====================================
      =     MODAL EDITAR PRODUCTO            =
      =====================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar Producto</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">
            
            <!-- ENTRADA PARA SELECCIONAR STATUS-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="editarStatus" required>
                  
                  <option value="" id="editarStatus">Status</option>
                  <?php

                    $status = ControladorProductos::ctrMostrarStatus();
                    
                    foreach ($status as $key => $value) {
                      echo '<option value="'.$value["id_status"].'">'.$value["descripcion"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR OBRA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="editarObra" required>
                  
                  <option value="" id="editarObra">Obra</option>
                  <?php
                    $item = null;
                    $valor = null;
                    $obra = ControladorObras::ctrMostrarObras($item, $obra);
                    
                    foreach ($obra as $key => $value) {
                      echo '<option value="'.$value["id_obra"].'">'.$value["descripcion"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>



            <!-- ENTRADA PARA EL TIPO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editarTipo" name="editarTipo" placeholder="Ingresar Tipo" required>

              </div>

            </div>

            <!-- ENTRADA LA MARCA -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca" placeholder="Ingresar Marca" required>

              </div>

            </div>

            <!-- ENTRADA PARA CANTIDAD -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="editarCantidad" id="editarCantidad" min="0" placeholder="Cantidad" required>

              </div>

            </div>

            <!-- ENTRADA PARA LONGITUD -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-long-arrow-up"></i></span>

                <input type="number" class="form-control input-lg" name="editarLongitud" id="editarLongitud" min="0" placeholder="Longitud" required>

              </div>

            </div>

            <!-- ENTRADA PARA PESO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>

                <input type="number" class="form-control input-lg" id="editarPeso" name="editarPeso" step="any" min="0" placeholder="Peso Unitario" required>

              </div>

            </div>

            <!-- ENTRADA PARA PESO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>

                <input type="text" class="form-control input-lg" id="editarUnidad" name="editarUnidad" placeholder="Unidad de Medida" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR IMAGEN -->

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="editarImagen" name="editarImagen" id="editarFoto">

              <p class="help-block">peso maximo 200 MB </p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" id="imagenActual" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">
              <input type="hidden" name="eidProducto" id="eidProducto">

            </div>

            <!--FOOTER-->

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
        
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        
        </div>

      </form>

    <?php
      $editarProducto = new controladorProductos();
      $editarProducto -> ctrEditarProducto();
    ?>
    
    </div>

  </div>

</div>

  <!--=====================================
      =     MODAL IMPORTAR TABLA            =
      =====================================-->


<div id="modalImportarTabla" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Importar Tabla</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR OBRA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                <select class="form-control input-lg" name="importarObra" required>
                  
                  <option value="" id="importarObra">Obra</option>
                  <?php
                    $item = null;
                    $valor = null;
                    
                    if(isset($_SESSION["obraProductos"])){
                    
                      $obra = $_SESSION["obraProductos"];
                    
                    }else{
                    
                      $obra = null;
                    
                    }
                    
                    $obra = ControladorObras::ctrMostrarObras($item, $obra);
                    
                    foreach ($obra as $key => $value) {
                      echo '<option value="'.$value["id_obra"].'">'.$value["descripcion"].'</option>';
                    }
                  ?>

                </select>

              </div>

            </div>  

            <!-- ENTRADA PARA INGRESAR EXCEL -->

            <div class="form-group">
              
              <div class="input-group">SUBIR EXCEL</div>
              <div class="callout callout-info">
                <p>Columnas:<br>
                  <table class="table table-bordered">
                    <tr>
                      <td>Tipo</td>
                      <td>Marca</td>
                      <td>Cantidad</td>
                      <td>Longitud</td>
                      <td>Peso Unitario</td>
                      <td>Unidad de Medida</td>
                    </tr>
                  </table>
                </p>  
              </div>
              

              <input type="file" class="nuevoExcel" name="nuevoExcel" id="nuevoExcel">

              <input type="text" class="nuevaImportacion" name="nuevaImportacion" id="nuevaImportacion" hidden>

              <p class="help-block">peso maximo 200 MB </p>

            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn bg-primary">Importar Productos</button>
              
            </div>

            
          </div>
        
        </div>

        <!--=====================================
        =     PIE DEL MODAL            =
        =====================================-->
        
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
        </div>

      </form>

    <?php
      $crearProducto = new controladorProductos();
      $crearProducto -> ctrImportarProductos();                        
    ?>
    
    </div>

  </div>

</div>

<?php
//  $rechazarConteo = new controladorProductos();
//  $rechazarConteo -> ctrEliminarConteo();
?>