<h3> Usuarios <small>del sistema </small> </h3>


<div class="row ">
  
  <div class="col">
    <div class="card">
      <div class="card-body text-right p-1">
        <a href="<?= base_url('mgr/gestion/usuarios/add') ?>" class="btn btn-success"> <i class="fa fa-user"></i> Agregar usuario </a>
        <!-- <a href="<?= current_url() . '/add' ?>" class="btn btn-success"> <i class="fa fa-user"></i> Agregar usuario </a> -->
      </div>
    </div>
  </div>
</div>

<div class="row my-1">
  
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h4>Listado de usuarios en el sistema</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          
          <table class="table table-sm" id="table_users">
            <thead class="thead-ligth">
              <tr>
                <th>Nombre</th>
                <th>Paterno</th>
                <th>Materno</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos Completos del usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="#" id="form_user" name="form_user" >
        <fieldset disabled>

          <div class="row">
            
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Nombre *</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" maxlength="150" minlength="3" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Apellido Paterno *</label>
                <input type="text" class="form-control" name="paterno" placeholder="Apellido del Padre" maxlength="80" minlength="4" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Apellido Materno *</label>
                <input type="text" class="form-control" name="materno" placeholder="Apellido de la Madre" maxlength="80" minlength="4" required />
              </div>
            </div>

          </div>

          <div class="row">
            
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Nombre de Usuario *</label>
                <input type="text" class="form-control" name="username" placeholder="Nombre de Usuario Elegido" maxlength="80" minlength="4" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Correo electrónico *</label>
                <input type="email" class="form-control" name="correo" placeholder="correo@mail.com" maxlength="150" required />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" class="form-control" name="tel" placeholder="Teléfono" maxlength="15" minlength="7" pattern="\d+" title="solo números" />
              </div>
            </div>

          </div>

          <div class="row">
            
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Celular</label>
                <input type="tel" class="form-control" name="cel" placeholder="Celular" maxlength="15" minlength="10" pattern="\d+" title="solo números" />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" name="dir" placeholder="Dirección" maxlength="200" minlength="" />
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Rol *</label>
                <select name="rol" class="form-control" required>
                  <option value="">Seleccione un Rol</option>
                  <option value="admin">Administrador</option>
                  <option value="client">Cliente</option>
                </select>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-sm-6 col-md-4">
              <div class="form-group">
                <label>Genero *</label>
                <select name="genero" class="form-control" required>
                  <option value="">Seleccione un Genero</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                </select>
              </div>
            </div>
          </div>
        
        </fieldset>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  
document.addEventListener('DOMContentLoaded', function(){
  
  var _ = document;
  var $$ = _.querySelector.bind(_);

  var formUser = _.form_user;

  var oTable = $('#table_users').DataTable({
    language: {
      url: _uri+'public/assets/Spanish.json',
    },
    ajax: {
      url: _uri+'mgr/gestion/listarusuarios',
      method: 'GET',
      dataType: 'json',
    },
    columns: [
      {data: 'nombre', defaultContent: ''},
      {data: 'paterno', defaultContent: ''},
      {data: 'materno', defaultContent: ''},
      {data: 'username', defaultContent: ''},
      {data: 'correo', defaultContent: ''},
      {data: 'telefono', defaultContent: ''},
      {
        orderable: false,
        data: (row, type, val, meta)=>{
          return `<button type="button" class="btn btn-xs btn-info info" title="Más"> <i class="fa fa-plus"></i> </button>
          <a href="${_uri}mgr/gestion/usuarios/update/${row.id}" class="btn btn-xs btn-primary edit" title="editar datos"> <i class="fa fa-edit"></i></a>
          <button type="button" class="btn btn-xs btn-danger del" title="eliminar usuario"> <i class="fa fa-times"></i> </button>`;
        }
      }
    ],


  });


  $('#table_users').on('click', 'button', function(ev){

    var data = oTable.row( this.closest('tr') ).data();
    console.log(data);

    if( this.classList.contains('info') ){

      formUser.username.value = data.username;
      formUser.nombre.value = data.nombre;
      formUser.paterno.value = data.paterno;
      formUser.materno.value = data.materno;
      formUser.dir.value = data.direccion;
      formUser.tel.value = data.telefono;
      formUser.cel.value = data.celular;
      formUser.correo.value = data.correo;
      formUser.rol.value = data.roles;
      formUser.genero.value = data.genero;

      $('#modal').modal();

    }
    else if( this.classList.contains('del') ){

      Swal.fire({
        title: 'Eliminar',
        text: "¿Desea eliminar al usuario "+data.nombre+"?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
      }).then((result) => {

        if (result.value) {
            
          $.ajax({
            url: _uri+'mgr/gestion/usuarios/delete',
            type: 'POST',
            dataType: 'json',
            data: {
              id: data.id
            },
            beforeSend: ()=>{
              Swal.fire({
                title: 'Eliminando',
                onOpen: () => {
                  Swal.showLoading()
                },
                allowOutsideClick: false,
                allowEscapeKey: false
              });
            }
          })
          .done((response)=>{
            if( response.status ){
              Swal.fire('Exito', response.msg, 'success');
            }
            else{
              Swal.fire('Error', response.msg, 'error');
            }
            oTable.ajax.reload();
          })
          .fail(function() {
            Swal.fire("", 'La red no esta disponible, intente más tarde', 'warning');
          });

        }

      });

    }

  });

});

</script>