document.addEventListener('DOMContentLoaded', function(){

  var _ = document;
  var $$ = _.querySelector.bind(_);

  var formUser = _.form_user;

  var getData = function(){
    $.ajax({
      url: _uri+'mgr/gestion/usuario/'+window.location.pathname.split('/').pop(),
      type: 'POST',
      dataType: 'json',
      beforeSend: ()=>{
        Swal.fire({
          'title': 'Cargando',
          onOpen: () => {
            Swal.showLoading()
          },
          allowOutsideClick: false,
          allowEscapeKey: false
        });
      }
    })
    .done(function( response ) {
      console.log("success");
      if( response.status ){
        var data = response.data;

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

        //bloquear username y correo
        formUser.username.disabled = formUser.correo.disabled = true;

      }
      Swal.close();
    })
    .fail(function() {
      console.log("error");
    });

  }
  getData();
  

});