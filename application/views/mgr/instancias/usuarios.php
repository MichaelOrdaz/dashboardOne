<h3> Usuarios del INCORE <?= $host ?> </h3>

<div class="row my-1">
  <div class="col">
    <div class="card">
      <div class="card-body text-right p-1">
        <a href="<?= base_url('mgr/instancia/index/'.$this->uri->segment(4)) ?>" class="btn btn-outline-info"> <i class="fas fa-redo"></i> Regresar </a>
      </div>
    </div>
  </div>
</div>

<div class="row my-1">
  
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h4>Listado de usuarios</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          
          <table class="table table-sm" id="table_users">
            <thead class="thead-ligth">
              <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Paterno</th>
                <th>Materno</th>
                <th>Correo</th>
                <th>Nivel</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Paterno</th>
                <th>Materno</th>
                <th>Correo</th>
                <th>Nivel</th>
              </tr>
            </tfoot>
            <tbody>
              <?php foreach( $usuarios as $user ): ?>
                <tr class="<?= $user->statusUser ? '' : 'table-danger' ?>">
                  <td><?= $user->idUser ?></td>
                  <td><?= $user->nombreUser ?></td>
                  <td><?= $user->paternoUser ?></td>
                  <td><?= $user->maternoUser ?></td>
                  <td><?= $user->emailUser ?></td>
                  <td><?= $user->nivel ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  
document.addEventListener('DOMContentLoaded', function(){
  
  var _ = document;
  var $$ = _.querySelector.bind(_);

  var oTable = $('#table_users').DataTable({
    language: {
      url: _uri+'public/assets/Spanish.json',
    },
    pageLength: 25
  });

});

</script>