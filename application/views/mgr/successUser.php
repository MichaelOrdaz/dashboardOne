
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

<h3> <?= $subTitle ?> <small>del sistema </small> </h3>

<div class="row ">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <div class="alert alert-success text-center">
          <h4> <?= $parrafo ?> </h4>
          <p>
            <?= anchor('mgr/gestion/usuarios/add', 'Agregar Otro Usuario', 'class="btn btn-outline-info"') ?>
            <?= anchor('mgr/gestion/usuarios', 'Listado de Usuarios', 'class="btn btn-outline-primary"') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
