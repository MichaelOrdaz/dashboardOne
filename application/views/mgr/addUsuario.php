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


<h3> <?= $title ?> <small>del sistema </small> </h3>


<div class="row ">
  <div class="col">
    <div class="card">
      <div class="card-body text-right p-1">
        <a href="<?= base_url('mgr/gestion/usuarios') ?>" class="btn btn-outline-info"> <i class="fas fa-redo"></i> Regresar </a>
      </div>
    </div>
  </div>
</div>

<div class="row my-1">
  
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h4> <?= $titleForm ?> </h4>
      </div>
      <div class="card-body">

        <?= form_open('', ['name'=> 'form_user', 'id'=> 'form_user', 'role'=> 'formulario', 'class'=> 'was-validated']) ?>
          <!-- id, nombre, paterno, materno, roles, correo, username, genero, pass, direccion, telefono, celular, created_at, updated_at, acciones, status -->

          <div class="row">
            
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Nombre *</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" value="<?= set_value('nombre') ?>" maxlength="150" minlength="3" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Apellido Paterno *</label>
                <input type="text" class="form-control" name="paterno" placeholder="Apellido del Padre" value="<?= set_value('paterno') ?>" maxlength="80" minlength="4" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Apellido Materno *</label>
                <input type="text" class="form-control" name="materno" placeholder="Apellido de la Madre" value="<?= set_value('materno') ?>" maxlength="80" minlength="4" required />
              </div>
            </div>

          </div>

          <div class="row">
            
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Nombre de Usuario *</label>
                <input type="text" class="form-control" name="username" placeholder="Nombre de Usuario Elegido" value="<?= set_value('username') ?>" maxlength="80" minlength="4" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Correo electrónico *</label>
                <input type="email" class="form-control" name="correo" placeholder="correo@mail.com" value="<?= set_value('correo') ?>" maxlength="150" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" class="form-control" name="tel" placeholder="Teléfono" value="<?= set_value('tel') ?>" maxlength="15" minlength="7" pattern="\d+" title="solo números" />
              </div>
            </div>

          </div>

          <div class="row">
            
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Celular</label>
                <input type="tel" class="form-control" name="cel" placeholder="Celular" value="<?= set_value('cel') ?>" maxlength="15" minlength="10" pattern="\d+" title="solo números" />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" name="dir" placeholder="Dirección" value="<?= set_value('dir') ?>" maxlength="200" minlength="" />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Rol *</label>
                <select name="rol" class="form-control" required>
                  <option <?= set_select('rol', '', TRUE) ?> value="">Seleccione un Rol</option>
                  <option <?= set_select('rol', 'admin') ?> value="admin">Administrador</option>
                  <option <?= set_select('rol', 'cliente') ?> value="client">Cliente</option>
                </select>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Genero *</label>
                <select name="genero" class="form-control" required>
                  <option <?= set_select('genero', '', TRUE) ?> value="">Seleccione un Genero</option>
                  <option <?= set_select('genero', 'Masculino') ?> value="Masculino">Masculino</option>
                  <option <?= set_select('genero', 'Femenino') ?> value="Femenino">Femenino</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col text-center">
              <button class="btn btn-primary" type="submit" > <i class="fas fa-save"></i> Guardar </button>
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


});

</script>