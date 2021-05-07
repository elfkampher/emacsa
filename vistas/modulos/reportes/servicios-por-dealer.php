<?php?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <i class="fa fa-bar-chart-o"></i>

      <h3 class="box-title">Servicios por Distribuidor</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div id="line-chart" style="height: 300px;"></div>
    </div>
    <!-- /.box-body-->
  </div>
  <!-- /.box -->

  <script>
    
    <?php 
      //Obteniendo Listado de Distribuidores
      $item = null;
      $valor = null;
      $dealers = ControladorDealers::ctrMostrarDealers($item, $valor);
      //Recorriendo los servicios agrupados por mes de cada distribuidor
      $fechaInicial = date('Y-m','2019-01');
      $fechaInicial = strtotime($fechaInicial);
      for($i = 1; $i <= 12; $i++) {
        $fechaConsulta = date('Y-m', strtotime(+$i." month", $fechaInicial));
        echo $fechaConsulta.'<br>';
      }


    ?>

    var sin = [], cos = []
    for (var i = -14; i < 14; i += 0.5) {
      sin.push([i, i*i])
      cos.push([i, Math.cos(i)])
    }

    console.log(sin);


    var line_data1 = {
      data : sin,
      color: '#3c8dbc'
    }
    var line_data2 = {
      data : cos,
      color: '#00c0ef'
    }
    $.plot('#line-chart', [line_data1, line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
          .css({ top: item.pageY + 5, left: item.pageX + 5 })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
    /* END LINE CHART */
  </script>