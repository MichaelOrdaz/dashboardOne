document.addEventListener('DOMContentLoaded', function(){

  var _ = document;
  var $$ = _.querySelector.bind(_);

  var formHost = _.form_host;

  var getData = function(){
    $.ajax({
      url: _uri+'mgr/gestion/instancia/'+window.location.pathname.split('/').pop(),
      type: 'GET',
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

        formHost.nombre.value = data.nombre;
        formHost.host.value = data.host;
        formHost.des.value = data.descripcion;
        formHost.user.value = data.user;
        formHost.dbname.value = data.database;
        // formHost.creado.value = data.created_at;

        // formHost.creado.disabled = true;

      }
      Swal.close();
    })
    .fail(function() {
      console.log("error");
    });

  }
  // getData();
  

});