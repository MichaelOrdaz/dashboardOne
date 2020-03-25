<h4 class="mg-b-0 tx-spacing--1">Cartera <b> <?= $carteraCliente ?> </b> </h4>

<div class="row mb-2">

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
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total de Gestiones</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-center">
        <i class="fas fa-clipboard-check fa-lg"></i>
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 ml-2"> <?= $gestiones['activeGestion'] ?> </h3>
        <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger"> <?= $gestiones['totalGestion'] ?> <i class="icon ion-md-arrow-down"></i></span></p>
      </div>
    </div>
  </div><!-- col -->
  <div class="col-md">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"> <abbr title="Promesas de Pago">P.P.</abbr> Pasadas / Cumplidas </h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-center">
        <i class="fas fa-comments-dollar fa-lg"></i>
        <h3 class="tx-normal tx-rubik mg-b-0 ml-2 lh-1"> <span id="promesas"> <?= $promesas ?> </span> / <span id="cumplidos"> <?= $pagos ?> </span> </h3>
      </div>
    </div>
  </div>


</div>


<div class="row">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h6 class="mg-b-0">Gestiones en la Cartera</h6>
      </div><!-- card-header -->
      <div class="card-body pd-lg-25">
        <div class="chart-seven"><canvas id="chartDonut2"></canvas></div>
      </div><!-- card-body -->
      <div class="card-footer pd-20">
        <div class="row">
          <div class="col-6">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 tx-nowrap mg-b-5">Gestiones Activas</p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background-color: skyblue"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="gestionActive"> <?= $gestiones['activeGestion'] ?> </h6>
            </div>
          </div><!-- col -->
          <div class="col-6">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5">Gestiones Concluidas</p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background-color: gray"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="gestionInactive" > <?= ( $gestiones['totalGestion'] - $gestiones['activeGestion'] ) ?> </h6>
            </div>
          </div><!-- col -->
        </div><!-- row -->
      </div><!-- card-footer -->
    </div><!-- card -->
  </div>
  
  

</div>

<div class="row my-2">
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h6 class="mg-b-0">Gestiones en la Cartera</h6>
      </div><!-- card-header -->
      <div class="card-body pd-lg-25">
        <div class="chart-seven"><canvas id="gestiones"></canvas></div>
      </div><!-- card-body -->
      <div class="card-footer pd-20">
        <div class="row">
          <div class="col-6">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 tx-nowrap mg-b-5">Gestiones Activas</p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background-color: skyblue"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="gestionActive"> <?= $gestiones['activeGestion'] ?> </h6>
            </div>
          </div><!-- col -->
          <div class="col-6">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5">Gestiones Concluidas</p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background-color: gray"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="gestionInactive" > <?= ( $gestiones['totalGestion'] - $gestiones['activeGestion'] ) ?> </h6>
            </div>
          </div><!-- col -->
        </div><!-- row -->
      </div><!-- card-footer -->
    </div><!-- card -->
  </div>
</div>

<pre>
<?php 

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

  //canvas de promesas de pago y pagos ejecutados
  var pp_pe = $$("#gestiones");
  var chart_pp_pe = new Chart(pp_pe, {
    type: 'line',
    data: {
      labels: JSON.parse('<?= json_encode($fechasLabel) ?>'),
      datasets: [
        {
          label: "Pago Ejecutado",
          data: JSON.parse('<?= json_encode($dataChartPago) ?>'),
          lineTension: 0,
          fill: false,
          borderColor: 'green'
        },
        {
          label: "Promesas De Pago",
          data: JSON.parse('<?= json_encode($dataChartPromesa) ?>'),
          lineTension: 0,
          fill: false,
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


  /** PIE CHART de usuarios **/
  // For a pie chart
  /*
  var ctx2 = document.getElementById('chartDonut');
  var myDonutChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Activos', 'Inactivos'],
      datasets: [{
        data: [
          Number( $$('#userActive').textContent ),
          Number( $$('#userInactive').textContent ),
        ],
        backgroundColor: ['green', 'red']
      }]
    },
    options: {
      // maintainAspectRatio: false,
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
  */


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
      // maintainAspectRatio: false,
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



});


</script>