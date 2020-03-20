<h3 class="text-danger">Error en el sistema</h3>

<div class="row">
  <div class="col">
    <div class="card border-danger">
      <div class="card-body">
        
        Se presento un error en el sistema, por favor reintente realizando la acción nuevamente <br>
        Si se sigue presentando el error, por favor reporte al administrador del sistema.
        
        <div class="alert alert-danger">
          Error :  <?= $error->getMessage() ?>
        </div>

      </div>
    </div>
  </div>
</div>