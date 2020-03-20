<h3> <?= $title ?? '' ?> </h3>

<div class="row">
  <div class="col">
    <div class="card border-success">
      <div class="card-body">
        
        <div class="alert alert-success">
          <?= $msg ?? '' ?>
        </div>
        
        <?php if( $instancia ): ?>
          <div class="alert alert-info">
            Se realizo la conexión con la instancia <?= $instancia->host ?> Satisfactoriamente <i class="fas fa-network-wired"></i> .
          </div>
        <?php else: ?>
          <div class="alert alert-warning">
            No se logro la conexión con la instancia <?= $instancia->host ?>, hubo errores en la conexión, por favor verifique sus datos<br>
          </div>
        <?php endif; ?>

        <p class="text-center">
          <?= anchor('mgr/gestion/instancias/add', 'Agregar Otra Instancia', 'class="btn btn-outline-info"') ?>
          <?= anchor('mgr/gestion/instancias', 'Lista de Instancias', 'class="btn btn-outline-primary"') ?>
        </p>

      </div>
    </div>
  </div>
</div>