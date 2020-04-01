<h3> <?= $title ?? '' ?> </h3>
<div class="row ">
  <div class="col">
    <div class="card">
      <div class="card-body text-right p-1">
        <a href="<?= base_url('mgr/gestion/instancias') ?>" class="btn btn-outline-info"> <i class="fas fa-redo"></i> Regresar </a>
      </div>
    </div>
  </div>
</div>

<div class="row my-1">
  
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h4> <?= $titleForm ?? '' ?> </h4>
      </div>
      <div class="card-body">

        <?= form_open('', ['name'=> 'form_host', 'id'=> 'form_host', 'role'=> 'formulario', 'class'=> 'was-validated']) ?>

          <div class="row">
            
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Nombre *</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre de la Conexión" value="<?= set_value('nombre', $host->nombre ?? '') ?>" maxlength="150" minlength="3" required />
              </div>
            </div>

            <div class="col-sm-6 col-md">
              <div class="form-group">
                <label>Descripción</label>
                <input type="text" class="form-control" name="des" placeholder="Descripción" value="<?= set_value('des', $host->descripcion ?? '') ?>" />
              </div>
            </div>

          </div>

          <div class="row">
            
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Hostname *</label>
                <input type="text" class="form-control" name="host" placeholder="Dominio o IP" value="<?= set_value('host', $host->host ?? '') ?>" maxlength="20" minlength="7" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Pública</label>
                <input type="text" class="form-control" name="public" placeholder="Dominio o IP pública" value="<?= set_value('public', $host->public_ip ?? '') ?>" maxlength="20" minlength="7" />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Usuario *</label>
                <input type="text" class="form-control" name="user" placeholder="usuario de la conexión" value="<?= set_value('user', $host->user ?? '') ?>" maxlength="40" minlength="4" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Contraseña *</label>
                <input type="password" class="form-control" name="pass" placeholder="Contraseña del usuario para la conexión" value="<?= set_value('user', $host->password ?? '') ?>" maxlength="150" />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Nombre de la Base de Datos *</label>
                <input type="text" class="form-control" name="dbname" placeholder="Nombre de la db para la conexión" value="<?= set_value('dbname', $host->database ?? '') ?>" maxlength="150" required />
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col text-center">
              <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Guardar </button>
            </div>
          </div>

        </form>

        <?= validation_errors('<div class="row my-1 justify-content-center">
          <div class="col col-sm-auto">
            <div class="alert alert-danger">
        ', '</div></div></div>') ?>

      </div>
    </div>
  </div>
</div>

<script>
  
document.addEventListener('DOMContentLoaded', function(){
  
  var _ = document;
  var $$ = _.querySelector.bind(_);

  //cargando para cuando se envie el formulario
  
  _.form_host.addEventListener('submit', function(ev){
    Swal.fire({
      'title': 'Cargando',
      onOpen: () => {
        Swal.showLoading()
      },
      allowOutsideClick: false,
      allowEscapeKey: false
    });
  })


});

</script>