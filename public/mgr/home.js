
(function(){

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

})();




$(function(){
  'use strict'

  var plot = $.plot('#flotChart', [{
    data: df3,
    color: '#69b2f8'
  },{
    data: df1,
    color: '#d1e6fa'
  },{
    data: df2,
    color: '#d1e6fa',
    lines: {
      fill: false,
      lineWidth: 1.5
    }
  }], {
    series: {
      stack: 0,
      shadowSize: 0,
      lines: {
        show: true,
        lineWidth: 0,
        fill: 1
      }
    },
    grid: {
      borderWidth: 0,
      aboveData: true
    },
    yaxis: {
      show: false,
      min: 0,
      max: 350
    },
    xaxis: {
      show: true,
      ticks: [[0,''],[8,'Jan'],[20,'Feb'],[32,'Mar'],[44,'Apr'],[56,'May'],[68,'Jun'],[80,'Jul'],[92,'Aug'],[104,'Sep'],[116,'Oct'],[128,'Nov'],[140,'Dec']],
      color: 'rgba(255,255,255,.2)'
    }
  });


  $.plot('#flotChart2', [{
    data: [[0,55],[1,38],[2,20],[3,70],[4,50],[5,15],[6,30],[7,50],[8,40],[9,55],[10,60],[11,40],[12,32],[13,17],[14,28],[15,36],[16,53],[17,66],[18,58],[19,46]],
    color: '#69b2f8'
  },{
    data: [[0,80],[1,80],[2,80],[3,80],[4,80],[5,80],[6,80],[7,80],[8,80],[9,80],[10,80],[11,80],[12,80],[13,80],[14,80],[15,80],[16,80],[17,80],[18,80],[19,80]],
    color: '#f0f1f5'
  }], {
    series: {
      stack: 0,
      bars: {
        show: true,
        lineWidth: 0,
        barWidth: .5,
        fill: 1
      }
    },
    grid: {
      borderWidth: 0,
      borderColor: '#edeff6'
    },
    yaxis: {
      show: false,
      max: 80
    },
    xaxis: {
      ticks:[[0,'Jan'],[4,'Feb'],[8,'Mar'],[12,'Apr'],[16,'May'],[19,'Jun']],
      color: '#fff',
    }
  });

  $.plot('#flotChart3', [{
      data: df4,
      color: '#9db2c6'
    }], {
    series: {
      shadowSize: 0,
      lines: {
        show: true,
        lineWidth: 2,
        fill: true,
        fillColor: { colors: [ { opacity: 0 }, { opacity: .5 } ] }
      }
    },
    grid: {
      borderWidth: 0,
      labelMargin: 0
    },
    yaxis: {
      show: false,
      min: 0,
      max: 60
    },
    xaxis: { show: false }
  });

  $.plot('#flotChart4', [{
      data: df5,
      color: '#9db2c6'
    }], {
    series: {
      shadowSize: 0,
      lines: {
        show: true,
        lineWidth: 2,
        fill: true,
        fillColor: { colors: [ { opacity: 0 }, { opacity: .5 } ] }
      }
    },
    grid: {
      borderWidth: 0,
      labelMargin: 0
    },
    yaxis: {
      show: false,
      min: 0,
      max: 80
    },
    xaxis: { show: false }
  });

  $.plot('#flotChart5', [{
      data: df6,
      color: '#9db2c6'
    }], {
    series: {
      shadowSize: 0,
      lines: {
        show: true,
        lineWidth: 2,
        fill: true,
        fillColor: { colors: [ { opacity: 0 }, { opacity: .5 } ] }
      }
    },
    grid: {
      borderWidth: 0,
      labelMargin: 0
    },
    yaxis: {
      show: false,
      min: 0,
      max: 80
    },
    xaxis: { show: false }
  });

  $.plot('#flotChart6', [{
      data: df4,
      color: '#9db2c6'
    }], {
    series: {
      shadowSize: 0,
      lines: {
        show: true,
        lineWidth: 2,
        fill: true,
        fillColor: { colors: [ { opacity: 0 }, { opacity: .5 } ] }
      }
    },
    grid: {
      borderWidth: 0,
      labelMargin: 0
    },
    yaxis: {
      show: false,
      min: 0,
      max: 60
    },
    xaxis: { show: false }
  });


});//endDocument ready