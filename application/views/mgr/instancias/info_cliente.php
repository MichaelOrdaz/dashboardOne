<h4 class="mg-b-0 tx-spacing--1">Cartera <b> <?= $carteraCliente ?> </b> </h4>

<?php
  // echo ( new DateTime() )->add( new DateInterval('P1D') )->format('Y-m-d');
?>

<div class="row row-xs my-2">
  <div class="col">
    <div class="card">
      <div class="card-body text-right p-1">
        <a href="<?= base_url('mgr/instancia/index/'.$this->uri->segment(4)) ?>" class="btn btn-outline-info"> <i class="fas fa-redo"></i> Regresar </a>
      </div>
    </div>
  </div>
</div>

<div class="row row-xs my-2">

  <div class="col-md">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Usuarios Activos / Total</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-center">
        <i class="fas fa-users fa-lg"></i>
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 text-success ml-2"> XXX </h3>
        <p class="tx-11 tx-color-03 mg-b-0"><span class=""> / XXX </i></span></p>
      </div>
    </div>
  </div><!-- col -->
  <div class="col-md">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total de Gestiones Activas</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-center">
        <i class="fas fa-clipboard-check fa-lg"></i>
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 ml-2"> <?= number_format($gestiones['activeGestion'], 0, '', ',') ?> </h3>
      </div>
    </div>
  </div><!-- col -->
  <div class="col-md">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"> Promesa de Pago / Pago Ejecutado <br> <span class="startDate"> </span> - <span class="endDate"> </h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-center">
        <i class="fas fa-comments-dollar fa-lg"></i>
        <h3 class="tx-normal tx-rubik mg-b-0 ml-2 lh-1"> <span id="promesas" class="text-success"> <?= $promesas ?> </span> / <span id="cumplidos" class="text-danger"> <?= $pagos ?> </span> </h3>
      </div>
    </div>
  </div>


</div>


<div class="row row-xs">

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h6 class="mg-b-0">Gestiones en la Cartera</h6>
      </div><!-- card-header -->
      <div class="card-body pd-lg-25">
        <div class="chart-seven"><canvas id="chartDonut2"></canvas></div>
      </div><!-- card-body -->
      <div class="card-footer pd-20">
        <div class="row">
          <div class="col-sm">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 tx-nowrap mg-b-5">Gestiones Activas</p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background-color: skyblue"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="gestionActive"> <?= $gestiones['activeGestion'] ?> </h6>
            </div>
          </div><!-- col -->
          <div class="col-sm">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5">Gestiones Inactivas</p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background-color: gray"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="gestionInactive" > <?= ( $gestiones['totalGestion'] - $gestiones['activeGestion'] ) ?> </h6>
            </div>
          </div><!-- col -->
          <div class="col-sm">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5">Total de Gestiones </p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background-color: navy"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="gestionInactive" > <?= $gestiones['totalGestion'] ?> </h6>
            </div>
          </div><!-- col -->
        </div><!-- row -->
      </div><!-- card-footer -->
    </div><!-- card -->
  </div>


  <div class="col-md-8">
    <div class="card">
      <div class="card-header bd-b-0 pd-t-20 pd-lg-t-25 pd-l-20 pd-lg-l-25 d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
        <div>
          <h6 class="mg-b-5"> Top 10 Códigos de Resultado </h6>
        </div>
      </div><!-- card-header -->
      <div class="card-body pd-lg-25">
        <div class="row align-items-sm-end">
          <div class="col">
            <div class="chart-six">
              <canvas id="chartCR"></canvas>
            </div>
          </div>

        </div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>

</div>

<div class="row row-xs my-2">
  
  <div class="col">
    
    <div class="card">
      <div class="card-header">
        <h4>
          Número de Gestiones: <?= number_format($totalBitacoras, 0, '', ',') ?> </div>
        </h4>
      <div class="card-body">
        <p class="text-muted">Gestiones por código de resultado</p>
        <div class="row">
          
          <?php 
          for($i = 0, $length = count($codigos_r); $i < $length; $i++): 
            $code = $codigos_r[$i];
            if( in_array($i, [0, 10, 20, 30, 40, 50]) )
              echo '<div class="col-sm-6 col-md"> <ul class="list-group">';          
          ?>
                
                <li class="list-group-item d-flex px-2 py-1">
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-0"> <?= $code->idCR ?> </p>
                    <small class="tx-12 tx-color-03 mg-b-0"> <?= $code->descripcion ?> </small>
                  </div>
                  <div class="mg-l-auto text-right">
                    <p class="tx-medium mg-b-0"> <?= $code->total ?> </p>
                  </div>
                </li>
              
          <?php 
            if( in_array($i, [9, 19, 29, 39, 49, 59]) || $i === ($length-1) )
              echo '</ul> </div>';
          endfor; 
          ?>

        </div>

      </div>  
    </div>

  </div>

</div>

<div class="row row-xs my-2">

  <div class="col">
    <div class="card">
      <div class="card-header">
        <h6 class="mg-b-0">Gestiones en la Cartera</h6>
      </div><!-- card-header -->
      <div class="card-body pd-lg-25">
        <div class="chart-seven"><canvas id="gestiones"></canvas></div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>

</div>

<!-- 
<div class="row row-xs my-2">

  <div class="col">
    <div class="card">
      <div class="card-header">
        <h6 class="mg-b-0">Gestiones en la Cartera</h6>
      </div>
      <div class="card-body pd-lg-25">
        <div class="chart-seven"><canvas id="gestiones2"></canvas></div>
      </div>
    </div>
  </div>

</div> -->

<div class="row row-xs my-2">

  <div class="col">
    <div class="card">
      <div class="card-header">
        <h6 class="mg-b-0">Gestiones en la Cartera</h6>
      </div><!-- card-header -->
      <div class="card-body pd-lg-25">
        <div class="chart-seven"><canvas id="gestiones3"></canvas></div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>

</div>

<div class="row row-xs my-2">
  
  <div class="col">
    
    <div class="card border-primary">
      <div class="card-header">
        <h4>Análisis de Promesas de Pago del periodo <span class="startDate"> </span> al <span class="endDate"> </span>
        </h4>
      </div>
      <div class="card-body">
        
        <div class="row mb-3">
        
          <div class="col-sm border py-2">            
            <h6 class="text-muted"> Promesas de Pago Previstas para Mañana <span id="tomorrow"> </span> </h6>
            <div class="d-flex d-lg-block d-xl-flex align-items-center">
              <i class="fas fa-hand-holding-usd fa-lg"></i>
              <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 text-success ml-2"> <?= $pp_tomorrow ?> </h3>
            </div>
          </div>

          <div class="col-sm border py-2">            
            <h6 class="text-muted"> Promesas de Pago Cumplidas </h6>
            <div class="d-flex d-lg-block d-xl-flex align-items-center">
              <i class="fas fa-hand-holding-usd fa-lg"></i>
              <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 text-success ml-2"> <?= $pp_cumplidas ?> </h3>
            </div>
          </div>
        
        </div>

        <div class="row">
          <div class="col">
            <div class="alert alert-info">
              Las filas amarillas indican que el cliente no realizo el pago el dia prometido, el verde que realizo el pago en el día que indico 
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-sm" id="tabla_promesas">
            <thead>
              <!-- telContactBitaGes, fechaProxContactBitaGes, fechaBitaGes, folio, idCR -->
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Fecha <abbr title="Promesa de Pago">P.P.</abbr> </th>
              <th>Fecha <abbr title="Proximo">P.</abbr> Contacto</th>
              <th>Folio</th>
              <!-- <th>C.R.</th> -->
              <th>Cumplio?</th>
              <th>Días</th>
            </thead>
          </table>
        </div>
      </div>
    </div>

  </div>

</div>


<div class="row row-xs my-2">
  
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bd-b-0 pd-t-20 pd-lg-t-25 pd-l-20 pd-lg-l-25 d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
        <div>
          <h6 class="mg-b-5"> Top 10 Códigos de Acción</h6>
        </div>
      </div><!-- card-header -->
      <div class="card-body pd-lg-25">
        <div class="row align-items-sm-end">
          <div class="col">
            <div class="chart-six">
              <canvas id="chartCA"></canvas>
            </div>
          </div>

        </div>
      </div><!-- card-body -->
    </div><!-- card -->
  </div>

</div>


<div class="row row-xs my-2">
  
  <div class="col">
    
    <div class="card">
      <div class="card-header">Número de Gestiones <?= number_format($totalBitacoras, 0, '', ',') ?> </div>
      <div class="card-body">
        
        <p class="text-muted"> Gestiones por código de acción</p>        
        <div class="row">
          
          <?php 
          for($i = 0, $length = count($codigos_a); $i < $length; $i++): 
            $code = $codigos_a[$i];
            if( in_array($i, [0, 10, 20, 30, 40, 50]) )
              echo '<div class="col-sm-6 col-md"> <ul class="list-group">';          
          ?>
                
                <li class="list-group-item d-flex px-2 py-1">
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-0"> <?= $code->idCA ?> </p>
                    <small class="tx-12 tx-color-03 mg-b-0"> <?= $code->descripcion ?> </small>
                  </div>
                  <div class="mg-l-auto text-right">
                    <p class="tx-medium mg-b-0"> <?= $code->total ?> </p>
                  </div>
                </li>
              
          <?php 
            if( in_array($i, [9, 19, 29, 39, 49, 59]) || $i === ($length-1) )
              echo '</ul> </div>';
          endfor; 
          ?>

        </div>

      </div>  
    </div>

  </div>

</div>

<pre>
<?php 
  // var_dump($codigos_r);
  // var_dump($codigos_a);
?>
</pre>

<script>

window.addEventListener('DOMContentLoaded', function(){

  var _ = document;
  var $$ = _.querySelector.bind(_);

  // var obtenerFechasDelUltimoMes = function(){
    // var fechas = [];
    // for( var init = moment().subtract(1, 'M') )
  // }
  // 
  // 
  
  var startDate = moment('<?= $startDate ?>').format('DD MMMM'); 
  var endDate = moment('<?= $endDate ?>').format('DD MMMM'); 
  var tomorrow = moment().add(1, 'days').format('DD [de] MMMM');

  $('.startDate').text(startDate);
  $('.endDate').text(endDate);
  $('#tomorrow').text(tomorrow);

  var codigos_a = JSON.parse('<?= json_encode($codigos_a, JSON_HEX_QUOT|JSON_HEX_APOS) ?>');
  var codigos_r = JSON.parse('<?= json_encode($codigos_r, JSON_HEX_QUOT|JSON_HEX_APOS) ?>');

  console.log(codigos_a, codigos_r);

  //rescatar los primeros 15 codigos
  var top10CR = codigos_r.splice(0, 10);


  var CRCanvas = $$("#chartCR");
  var barChart = new Chart(CRCanvas, {
    type: 'bar',
    data: {
      labels: top10CR.map( item=> item.idCR ),
      datasets: [{
        label: 'Código de Resultado',
        data: top10CR.map(item=> item.total),
        backgroundColor: '#065f04'
      }]
    }
  });

  var top10CA = codigos_a.splice(0, 10);
  var CACanvas = $$("#chartCA");
  var barChart = new Chart(CACanvas, {
    type: 'bar',
    data: {
      labels: top10CA.map( item=> item.idCA ),
      datasets: [{
        label: 'Código de Resultado',
        data: top10CA.map(item=> item.total),
        backgroundColor: 'navy'
      }]
    }
  });

  //canvas de promesas de pago y pagos ejecutados
  
  var fechasLabel = JSON.parse('<?= json_encode($fechasLabel) ?>');
  var dataChartPago = JSON.parse('<?= json_encode($dataChartPago) ?>');
  var dataChartPromesa = JSON.parse('<?= json_encode($dataChartPromesa) ?>');
  
  var pp_pe = $$("#gestiones");
  var chart_pp_pe = new Chart(pp_pe, {
    type: 'line',
    data: {
      labels: fechasLabel,
      datasets: [
        {
          label: "Pago Ejecutado",
          data: dataChartPago,
          lineTension: 0.3,
          // fill: false,
          borderColor: 'green'
        },
        {
          label: "Promesas De Pago",
          data: dataChartPromesa,
          lineTension: 0.3,
          // fill: false,
          borderColor: 'blue'
        }
      ]
    },
    options: {
      legend: {
        display: true,
        position: 'top',
        labels: {
          boxWidth: 80,
          fontColor: 'black'
        }
      }
    }
  });

  /*
  var pp_pe2 = $$("#gestiones2");
  var chart_pp_pe2 = new Chart(pp_pe2, {
    type: 'bar',
    data: {
      labels: fechasLabel,
      datasets: [
        {
          label: "Pago Ejecutado",
          data: dataChartPago,
          // lineTension: 0,
          // fill: false,
          // borderColor: 'green'
          backgroundColor: 'rgba(0, 200, 0, 0.6)',
        },
        {
          label: "Promesas De Pago",
          backgroundColor: ['green', 'blue'],
          data: dataChartPromesa,
          backgroundColor: 'rgba(0, 0, 200, 0.6)',
          // lineTension: 0,
          // fill: false,
          // borderColor: 'blue'
        }
      ]
    },
    options: {
      legend: {
        display: true,
        position: 'top',
        labels: {
          boxWidth: 80,
          fontColor: 'black'
        }
      }
    }
  });
  */

  var pp_pe3 = $$("#gestiones3");
  var chart_pp_pe3 = new Chart(pp_pe3, {
    type: 'bar',
    data: {
      labels: fechasLabel,
      datasets: [
        {
          label: "Pago Ejecutado",
          data: dataChartPago,
          backgroundColor: 'rgba(0, 200, 0, 0.6)',
        },
        {
          label: "Promesas De Pago",
          backgroundColor: ['green', 'blue'],
          data: dataChartPromesa,
          backgroundColor: 'rgba(0, 0, 200, 0.6)',
        }
      ]
    },
    options: {
      legend: {
        display: true,
        position: 'top',
        labels: {
          boxWidth: 80,
          fontColor: 'black'
        }
      },
      scales: {
        xAxes: [{
          stacked: true
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }
  });

 


  /** PIE CHART de gESTIONES DE LA CARTERA **/
  // For a pie chart
  var ctxGestion = document.getElementById('chartDonut2');
  var donutChartGestion = new Chart(ctxGestion, {
    type: 'doughnut',
    data: {
    labels: ['Gestiones Activas', 'Gestiones Inactivas'],
      datasets: [{
        data: [
          Number( $$('#gestionActive').textContent ),
          Number( $$('#gestionInactive').textContent ),
        ],
        backgroundColor: ['skyblue', 'gray']
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false,
      },
      animation: {
        animateScale: true,
        animateRotate: true
      }
    }
  });




  var oTable = $("#tabla_promesas").DataTable({
    order: [ [3, 'desc'] ],
    language: {
      url: _uri+'public/assets/Spanish.json',
    },
    "processing": true,
    "serverSide": true,
    ajax: {
      url: _uri+"mgr/instancia/promesas_pago/<?= $this->uri->segment(4) .'/'. $this->uri->segment(5) ?> ",
      type: 'POST',
    },
    createdRow: (row, data, index)=>{
      if( Number(data.cumplio) > 0 ){
        row.classList.add('table-success');
      }
      else{
        row.classList.add('table-warning');
      }
    },
    columns: [
    //telContactBitaGes, fechaProxContactBitaGes, fechaBitaGes, folio, idCR
      {data: 'name', defaultContent: 'unknown', orderable: false},
      {data: 'telContactBitaGes', defaultContent: ''},
      {data: 'fechaBitaGes', defaultContent: ''},
      {data: 'fechaProxContactBitaGes', defaultContent: ''},
      {data: 'folio', defaultContent: ''},
      // {data: 'idCR', defaultContent: ''},
      {data: (row, data)=> Number(row.cumplio) > 0 ? 'Si' : 'No'
      },
      {
        data: 'interval', 
        defaultContent: '',
        orderable: false
      },
    ]

  });



});


</script>