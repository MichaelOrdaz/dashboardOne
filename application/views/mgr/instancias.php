<h3> Administrar Instancias </h3>

<div class="row ">
  <div class="col">
    <div class="card">
      <div class="card-body text-right p-1">
        <a href="<?= base_url('mgr/gestion/instancias/add') ?>" class="btn btn-success"> <i class="fas fa-desktop"></i> Agregar Instancia </a>
      </div>
    </div>
  </div>
</div>

<div class="row my-1">
  
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h4>Lista de Instancias</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          
          <table class="table table-sm" id="table_host">
            <thead class="thead-ligth">
              <tr>
                <th>Nombre</th>
                <th>Hostname</th>
                <th>Usuario</th>
                <th>Base de Datos</th>
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

<script>
  
document.addEventListener('DOMContentLoaded', function(){
  
  var _ = document;
  var $$ = _.querySelector.bind(_);

  var oTable = $('#table_host').DataTable({
    language: {
      url: _uri+'public/assets/Spanish.json',
    },
    ajax: {
      url: _uri+'mgr/gestion/getInstancias',
      method: 'GET',
      dataType: 'json',
      dataSrc: '',
    },
    columns: [
      {data: 'nombre', defaultContent: ''},
      {data: 'host', defaultContent: ''},
      {data: 'user', defaultContent: ''},
      {data: 'database', defaultContent: ''},
      {
        orderable: false,
        data: (row, type, val, meta)=>{
          return `<button type="button" class="btn btn-xs btn-info info" title="Más"> <i class="fa fa-plus"></i> </button>
          <a href="${_uri}mgr/gestion/instancias/update/${row.id}" class="btn btn-xs btn-primary edit" title="editar datos"> <i class="fa fa-edit"></i></a>
          <button type="button" class="btn btn-xs btn-danger del" title="eliminar registro"> <i class="fa fa-times"></i> </button>`;
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
        text: "¿Desea eliminar la instancia "+data.nombre+"?",
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