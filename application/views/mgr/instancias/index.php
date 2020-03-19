<?php

  if( ! empty($error) ){

    echo '<div class="row">
      <div class="col"> 
        <div class="alert alert-danger">
          '.$error.'
        </div>
      </div>
    </div>';

    return;//no se por que este return funciona pero funciona
  }

?>

<h4 class="mg-b-0 tx-spacing--1">Instancia <b> <?= $host ?> </b> </h4>

<div class="row row-xs">

  <div class="col-sm-6 col-lg-3">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Usuarios Activos / Total</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-end">
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1 text-success"> <?= $conteo['activeUsers'] ?> </h3>
        <p class="tx-11 tx-color-03 mg-b-0"><span class=""> / <?= $conteo['totalUsers'] ?> </i></span></p>
      </div>
    </div>
  </div><!-- col -->
  <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total de Clientes</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-end">
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">3,137</h3>
        <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.7% <i class="icon ion-md-arrow-down"></i></span></p>
      </div>
    </div>
  </div><!-- col -->
  <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total de Gestiones</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-end">
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">$306.20</h3>
        <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.3% <i class="icon ion-md-arrow-down"></i></span></p>
      </div>
    </div>
  </div><!-- col -->
  <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
    <div class="card card-body">
      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Order Quantity</h6>
      <div class="d-flex d-lg-block d-xl-flex align-items-end">
        <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">1,650</h3>
        <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">2.1% <i class="icon ion-md-arrow-up"></i></span></p>
      </div>
    </div>
  </div><!-- col -->


</div>
