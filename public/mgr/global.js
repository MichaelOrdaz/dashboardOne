document.addEventListener('DOMContentLoaded', function(){

  var _ = document;
  var $$ = _.querySelector.bind(_);

  $$('#logout').addEventListener('click', function(ev){
    ev.preventDefault();
    $.ajax({
      url: _uri+'/login/logout',
      type: 'GET',
      dataType: 'json',
      beforeSend: ()=>{
        Swal.fire({
          title: 'Cerrando Sesión',
          onOpen: () => {
            Swal.showLoading()
          },
          allowOutsideClick: false,
          allowEscapeKey: false
        });
      }
    })
    .done(function() {
      console.log("success");
      Swal.fire("Session Cerrada", '', 'success');
      setTimeout( ()=>{ window.location.reload() } , 2000);
    })
    .fail(function() {
      console.log("error");
      Swal.fire("Error al cerrar la sesión, reintente", '', 'warning');
    })

  });



});