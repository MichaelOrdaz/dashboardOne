<h4 class="mg-b-0 tx-spacing--1">Instancia <b> <?= $host ?> </b> </h4>

<div class="row mb-2">

  <div class="col-md">
    <div class="card card-body">
      <div class="row">
        <div class="col">
          <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Usuarios Activos / Total</h6>
        </div>
        <div class="col-auto pl-0">
          <a title="Mostrar Usuarios" href="<?= base_url('mgr/instancia/users/'.$this->uri->segment(4)) ?>"> <i class="fas fa-link"></i> </a> 
        </div>
      </div>
      <div class="d-flex d-lg-block d-xl-flex align-items-center">
        <i class="fas fa-users fa-lg"></i>
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 text-success ml-2"> <?= $conteo['activeUsers'] ?> </h3>
        <p class="tx-11 tx-color-03 mg-b-0"><span class=""> / <?= $conteo['totalUsers'] ?> </i></span></p>
      </div>
    </div>
  </div><!-- col -->
  <div class="col-md">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total de Clientes</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-center">
        <i class="fas fa-industry fa-lg"></i>
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 ml-2 text-success"> <?= $clientes['activeClients'] ?> </h3>
        <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium"> <?= $clientes['totalClients'] ?> </span></p>
      </div>
    </div>
  </div><!-- col -->
  <div class="col-md">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total de Gestiones</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-center">
        <i class="fas fa-clipboard-check fa-lg"></i>
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 ml-2"> <?= number_format($gestiones['activeGestion'], 0, '', ' ') ?> </h3>
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

<div class="row mb-1">

  <div class="col">

    <div class="card">
      <div class="card-body">
        <h5>Clientes Activos</h5>
        <div class="table-responsive">
          <table class="table" id="tablaClientes">
            <thead>
              <tr>
                <th>Cliente</th>
                <th><abbr title="Código Postal">C.P.</abbr></th>
                <th>Teléfono</th>
                <th>RFC</th>
                <th>Tipo</th>
                <th>Gestiones</th>
                <th>Más</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h6 class="mg-b-0">Cuentas de Usuario</h6>
      </div><!-- card-header -->
      <div class="card-body pd-lg-25">
        <div class="chart-seven"><canvas id="chartDonut"></canvas></div>
      </div><!-- card-body -->
      <div class="card-footer pd-20">
        <div class="row">
          <div class="col-6">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 tx-nowrap mg-b-5">Activos</p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle bg-success mg-r-5"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="userActive"> <?= $conteo['activeUsers'] ?> </h6>
            </div>
          </div><!-- col -->
          <div class="col-6">
            <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5">Inactivos</p>
            <div class="d-flex align-items-center">
              <div class="wd-10 ht-10 rounded-circle bg-danger mg-r-5"></div>
              <h6 class="tx-normal tx-rubik mg-b-0" id="userInactive" > <?= ( $conteo['totalUsers'] - $conteo['activeUsers'] ) ?> </h6>
            </div>
          </div><!-- col -->
        </div><!-- row -->
      </div><!-- card-footer -->
    </div><!-- card -->
  </div>

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


<script>
  
window.addEventListener('DOMContentLoaded', function(){

  var _ = document;
  var $$ = _.querySelector.bind(_);


  //////////////////////////
  //table de los clientes //
  //////////////////////////
  var oTable = $("#tablaClientes").DataTable({
    language: {
      url: _uri+'public/assets/Spanish.json'
    },
    data: JSON.parse('<?= $clientes["clientes"] ?>'),
    createdRow: (row, data, dataIndex)=>{
      if( data.statusCliente == 0 )
        row.classList.add('table-danger');
      else if( data.statusCliente == 1 )
        row.classList.add('table-success');
    },
    columns: [
      {data: 'nombreCliente', defaultContent: ''},
      {data: 'cpCliente', defaultContent: ''},
      {data: 'telefonoCliente', defaultContent: ''},
      {data: 'rfcCliente', defaultContent: ''},
      {data: 'tipo', defaultContent: ''},
      {data: 'gestiones', defaultContent: ''},
      {data: 
        (row)=> Number( row.statusCliente ) ? 
          `<a href="${_uri}mgr/instancia/cliente/<?= $this->uri->segment(4) ?>/${row.idCliente}" class="btn btn-dark btn-xs"> <i class="fas fa-plus"></i> </a>` : ''
        , 
        orderable: false
      },
    ]
  });


  /** PIE CHART de usuarios **/
  // For a pie chart
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