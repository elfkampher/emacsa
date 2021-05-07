
<div class="content-wrapper">    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        Escanear Productos
        
      </h1>
      
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>        

        <li class="active">Escanear Productos</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">


          <!-- ENTRADA PARA SELECCIONAR OBRA-->
          <div class="input-group col-xs-6 col-sm-2">

            <button class="btn btn-primary" id="iniciaScan" data-toggle="modal" data-target="#modalEscanearProducto">

            Escanear

          </button>
          
            <span class="input-group-addon"><i class="fa fa-building"></i></span>
            <select class="input-sm" name="ObraConteo" id="ObraConteo">
                  
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
          
            <table class="table table-bordered table-striped dt-responsive tablaConteo" width="100%">
              
              <thead>
                <tr>

                  <th style="width:10px">#</th>
                  <th>Tipo</th>
                  <th>Marca</th>
                  <th>Cantidad</th>
                  <th>longitud</th>
                  <th>status</th>
                  <th>peso_unitario</th>
                  <th>Peso Total</th>
                  <th>Fecha Conteo</th>
                  <th>Obra</th>                
                  <th>Rechazar</th>

                </tr>

              </thead>              

            </table>

        </div>
        
      </div>

    </section>

</div>


  <!--=====================================
      =     MODAL ESCANEAR PRODUCTO            =
      =====================================-->


<div id="modalEscanearProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        =     CABEZA DEL MODAL            =
        =====================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Escanear Producto</h4>
        
        </div>

        <!--=====================================
        =     CUERPO DEL MODAL            =
        =====================================-->
        
        <div class="modal-body">
        
          <div class="box-body">
            
            <!-- ENTRADA PARA ESCANEAR CODIGO DE BARRAS-->

            <div class="form-group">

                <div id="result_strip">
                    <ul class="thumbnails"></ul>
                    <ul class="collector"></ul>
                </div>
                <label>
                  <span>Camara</span>
                  <select name="input-stream_constraints" id="deviceSelection">
                  </select>
                </label>
                <div id="interactive" class="input-group viewport"></div>
              

            </div>

            <!-- ENTRADA PARA EL CODIGO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="entradaCodigo" name="entradaCodigo" placeholder="Codigo">

              </div>

            </div>

            
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
      $contarProducto = new controladorProductos();
      $contarProducto -> ctrContarProducto();
    ?>
    
    </div>

  </div>

</div>

  <!--=====================================
      =     MODAL EDITAR STATUS            =
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
            <!-- ENTRADA PARA SELECCIONAR CATEGORIA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="editarCategoria" id="editarCategoria" name="nuevaCategoria" readonly>
                  
                  <option id="editarCategoria"></option>                  

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" placeholder="Ingresar Codigo" required>

              </div>

            </div>

            <!-- ENTRADA LA DESCRIPCION -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" placeholder="Ingresar Descripción" required>

              </div>

            </div>           
            
            

            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group">

              <div class="col-xs-12 col-sm-6">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio Compra" required>

                </div>

              </div>
           

            <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-12 col-sm-6">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio Venta" required>

                </div>

                <br>
                
                <!-- CHECK BOX PARA PORCENTAJE -->                
                <div class="col-xs-6">
                    
                  <div class="form-group">
                    
                    <label>                    
                      <input type="checkbox" class="minimal porcentaje" checked>
                      Utilizar Porcentaje                    
                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6" style="padding:0">
                  
                  <div class="input-group">
                    
                    <input type="number" class="form-control input-lg nuevoPorcentaje" name="nuevoPorcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR IMAGEN -->

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen" id="nuevaFoto">

              <p class="help-block">peso maximo 200 MB </p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

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

            

            <!-- ENTRADA PARA INGRESAR EXCEL -->

            <div class="form-group">
              
              <div class="panel">SUBIR EXCEL</div>

              <input type="file" class="nuevoExcel" name="nuevoExcel" id="nuevoExcel">

              <input type="text" class="nuevaImportacion" name="nuevaImportacion" id="nuevaImportacion" hidden>

              <p class="help-block">peso maximo 200 MB </p>

            </div>

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
      $crearProducto -> ctrImportarProductos();                        
    ?>
    
    </div>

  </div>

</div>
<?php
echo 
'<script>
$(document).ready(function(){
  
  $("#ObraConteo option[value='.$_SESSION["obraConteo"].']").attr("selected",true);
});
  
</script>';
?>                