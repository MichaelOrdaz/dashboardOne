<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instancia extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model('dash/InstanciaModel', 'dbhost');
    $this->load->library('markup');
    $this->load->helper('custom');//cargo mis helper

    if( ( $role = $this->session->userdata('dash_roles') ) === NULL ){
      // if( in_array('ROLE_USER', $role) ){
        redirect( base_url('login') );
      // }
    }
  }

  /**
   * [establecerInstancia establece la conexion con la base de datos de la instancia dada o lanza una excepcion en cado de error]
   * @param  int    $id [el id la instancia]
   * @return [void]
   */
  protected function establecerInstancia( int $id ){
    
    $instancia = $this->dbhost->getInstancia( ['id'=> $id] );//recupero la instancia o false en cado de error
    if( $instancia === FALSE )
      throw new Exception("Error la instancia no existe", 1);

    //verifico si me puedo conectar o no conectar
    $statusConnection = connection_native( $instancia->host, $instancia->user, $instancia->password, $instancia->database );

    if( ! is_array($statusConnection) )
      throw new Exception("No se logro conectar al cliente Error::".$statusConnection, 1);

    //si llega hata aqui todo va bien con la conexion entonces, conectamos a la base de datos con CI
    if( ! $this->dbhost->set($instancia->id) )
      throw new Exception("No se pudo conectar a la instancia");

  } 

  public function index( $id = null ){

    try{
    
      if( ! is_numeric($id) )
        throw new Exception("La instancia es invalida");

      $this->establecerInstancia($id);

      /////////////////////////////////////////////////////////////
      //aqui tengo la instancia, si llego hasta aqui sin errores //
      /////////////////////////////////////////////////////////////
      
      $conteo['activeUsers'] = $this->dbhost->getCount('User', ['statusUser'=> 1]);//recuperar cuentas
      $conteo['totalUsers'] = $this->dbhost->getCount('User');//recuperar cuentas
      //recuperar el numero de empresa a las que atiendo
      //gestiones de codigo de resultado
      //gestiones de promersa de pago pasadas y por cumplirse
      
      //a largo plazo no creo que existan mas de 1000 empresas por cartera
      $clientes['activeClients'] = $this->dbhost->getCount('Cliente', ['statusCliente'=>1]);
      $clientes['totalClients'] = $this->dbhost->getCount('Cliente');

      //contar las gestiones en general
      $gestiones['activeGestion'] = $this->dbhost->getCount('AsignacionCobranza', ['statusCuenta'=>1]);
      $gestiones['totalGestion'] = $this->dbhost->getCount('AsignacionCobranza');

      ////////////////////////////////////////
      //contar promesas de pago y cumplidas //
      ////////////////////////////////////////
      
      //para obtener las promesas de pago, consulto las bitacoras con idCR igual a pp
      //las fechas importantes son fechaBitaGes, fechaProxContactBitaGes
      //para tener un calculo de las promesas de pagos, consulto las promesas de pago 
      //donde la fecha de la bitages sea mayor al ultimo mes
      $initDate = ( new DateTime() )->sub( new DateInterval('P1M') )->format('Y-m-d');
      $promesas = $this->dbhost->getCount( 'BitacoraGestion', ['idCR'=> 'PP', 'DATE(fechaBitaGes) >'=> $initDate] );
      $pagos = $this->dbhost->getCount( 'BitacoraGestion', ['idCR'=> 'PE', 'DATE(fechaBitaGes) >'=> $initDate] );
      
      //listar a los clientes
      // $queryClients = $this->dbhost->consultar('Cliente', NULL, 'idCliente, rfcCliente, cpCliente, nombreCliente, telefonoCliente, tipo, statusCliente');
      $queryClients = $this->dbhost->getClientesConAsignacion();
      $clientes['clientes'] = json_encode( $queryClients );

      $content = $this->load->view('mgr/instancias/index.php' , [
        'host'=> $this->dbhost->host,
        'conteo'=> $conteo,
        'clientes'=> $clientes,
        'gestiones'=> $gestiones,
        'promesas'=> $promesas,
        'pagos'=> $pagos,
      ], TRUE);

      $data = [
        'header'=> [
          'title'=> 'Instancias',
          'stylesheets'=> [
            // 'public/lib/datatables.net-dt/css/jquery.dataTables.min.css',
          ]
        ],
        'aside'=> ['instanciasLink'=> 'active'],
        'footer'=> [
          'scripts'=> [
            'public/lib/jquery.flot/jquery.flot.js',
            'public/lib/jquery.flot/jquery.flot.stack.js',
            'public/lib/jquery.flot/jquery.flot.resize.js',
            'public/lib/chart.js/Chart.bundle.min.js',
            "public/lib/datatables.net/js/jquery.dataTables.min.js",
            "public/lib/datatables.net-dt/js/dataTables.dataTables.min.js",
          ]
        ],
        'nav'=> [
          'breadcrumbMain'=> 'Instancias',
          'breadcrumbSecondary'=> 'Resumen',
        ],
        'body'=> $content,
      ];

      
      $this->markup->laucherView($data);
      

    }
    catch( Exception $e ){

      $this->markup->laucherView([
      'header'=> ['title' => 'Error'],
      'nav'=> ['breadcrumbMain'=> 'Sistema', 'breadcrumbSecondary'=> 'error'],
      'body'=> $this->load->view('error', ['error'=> $e], TRUE),
      ]);

    }

  }


  public function cliente( int $host, int $cliente ){

    try{

      if( ! is_numeric($host) )
        throw new Exception("La instancia es invalida");

      $this->establecerInstancia($host);

      // $conteo['activeUsers'] = $this->dbhost->getCount('User', ['statusUser'=> 1, 'empresaUser'=> $cliente]);//recuperar cuentas
      // $conteo['totalUsers'] = $this->dbhost->getCount('User', ['empresaUser'=> $cliente]);//recuperar cuentas
      $dataCliente = $this->dbhost->uniqueRow('Cliente', ['idCliente'=> $cliente]);

      //contar las gestiones en general
      $gestiones['activeGestion'] = $this->dbhost->getCount('AsignacionCobranza', ['statusCuenta'=>1, 'idCliente'=> $cliente]);
      $gestiones['totalGestion'] = $this->dbhost->getCount('AsignacionCobranza', ['idCliente'=> $cliente]);

      ////////////////////////////////////////
      //contar promesas de pago y cumplidas //
      ////////////////////////////////////////
      
      //gestiones de promersa de pago pasadas y por cumplirse      
      //para obtener las promesas de pago, consulto las bitacoras con idCR igual a pp
      //las fechas importantes son fechaBitaGes, fechaProxContactBitaGes
      //para tener un calculo de las promesas de pagos, consulto las promesas de pago 
      //donde la fecha de la bitages sea mayor al ultimo mes
      $initDate = ( new DateTime() )->sub( new DateInterval('P1M') )->format('Y-m-d');
      $promesas = $this->dbhost->getCount( 'BitacoraGestion', ['idCR'=> 'PP', 'DATE(fechaBitaGes) >'=> $initDate, 'idCliente'=> $cliente] );
      $pagos = $this->dbhost->getCount( 'BitacoraGestion', ['idCR'=> 'PE', 'DATE(fechaBitaGes) >'=> $initDate, 'idCliente'=> $cliente] );

      //necesito ahora rescatar las promesas de pago como cantidad agrupados por fecha
      $promesas_ultimo_mes = $this->dbhost->getPromesasAgrupadas($initDate, $cliente);
      $pagos_ultimo_mes = $this->dbhost->getPagosAgrupados($initDate, $cliente);

      //ahora necesito mezclar las fechas
      $last_promesas = $last_pagos = [];
      foreach ($promesas_ultimo_mes as $value) {
        $last_promesas[$value->fecha] = $value->total;
      }
      foreach ($pagos_ultimo_mes as $value) {
        $last_pagos[$value->fecha] = $value->total;
      }

      //mezclo las fechas de ambos array
      $fechas = array_unique( array_merge( array_keys($last_promesas), array_keys($last_pagos) ) );
      sort($fechas);
      //ya tengo el eje X de mi grafica
      
      //ahora necesito mostrar las cantidades por fechas
      //entonces creo un array lleno con la longitud de fechas unicas
      $dataChartPromesa = $dataChartPago = array_fill(0, count($fechas), 0);

      foreach ($fechas as $idx => $fecha){
        if( array_key_exists($fecha, $last_promesas) )
          $dataChartPromesa[$idx] = $last_promesas[$fecha];
        if( array_key_exists($fecha, $last_pagos) )
          $dataChartPago[$idx] = $last_pagos[$fecha];
      }

      //recuperar los codigo de resultado de las bitacoras
      $totalBitacoras = $this->dbhost->getCount('BitacoraGestion', ['idCliente'=> $cliente]);

      $codigos_r = $this->dbhost->obtenerCodigo('CR', $cliente);
      $codigos_a = $this->dbhost->obtenerCodigo('CA', $cliente);


      
      $content = $this->load->view('mgr/instancias/info_cliente.php' , [
        // 'conteo'=> $conteo,
        'carteraCliente'=> $dataCliente->nombreCliente,
        'gestiones'=> $gestiones,
        'promesas'=> $promesas,
        'pagos'=> $pagos,
        'promesas_ultimo_mes'=> $last_promesas,
        'pagos_ultimo_mes'=> $last_pagos,
        'fechasLabel'=> array_values($fechas),
        'dataChartPromesa'=> $dataChartPromesa,
        'dataChartPago'=> $dataChartPago,
        'codigos_r'=> $codigos_r ?? [],
        'codigos_a'=> $codigos_a ?? [],
        'totalBitacoras'=> $totalBitacoras,
      ], TRUE);
      
      ///////////////////
      //info de salida //
      ///////////////////
      $data = [
        'header'=> [
          'title'=> 'Instancias',
          'stylesheets'=> [
            // 'public/lib/datatables.net-dt/css/jquery.dataTables.min.css',
          ]
        ],
        'aside'=> ['instanciasLink'=> 'active'],
        'footer'=> [
          'scripts'=> [
            'public/lib/jquery.flot/jquery.flot.js',
            'public/lib/jquery.flot/jquery.flot.stack.js',
            'public/lib/jquery.flot/jquery.flot.resize.js',
            'public/lib/chart.js/Chart.bundle.min.js',
            "public/lib/datatables.net/js/jquery.dataTables.min.js",
            "public/lib/datatables.net-dt/js/dataTables.dataTables.min.js",
            "public/lib/moment/min/moment.min.js",
            "public/lib/moment/locale/es.js",
          ]
        ],
        'nav'=> [
          'breadcrumbMain'=> 'Instancia',
          'breadcrumbSecondary'=> $this->dbhost->host,
        ],
        'body'=> $content,
      ];

      
      $this->markup->laucherView($data);

    }
    catch( Exception $e ){

      $this->markup->laucherView([
      'header'=> ['title' => 'Error'],
      'nav'=> ['breadcrumbMain'=> 'Sistema', 'breadcrumbSecondary'=> 'error'],
      'body'=> $this->load->view('error', ['error'=> $e], TRUE),
      ]);

    }

  }


  /**
   * [users mostrar vista de los usuarios de la instancia]
   * @param [int] $host el identificador de la instancia
   * @return [void] []
   */
  public function users( $host ){

    try{

      if( ! is_numeric($host) )
        throw new Exception("La instancia es invalida");

      $this->establecerInstancia($host);

      $usuarios = $this->dbhost->consultar('User', NULL, 'idUser, nombreUser, paternoUser, maternoUser, emailUser , (SELECT nombreNivel FROM Nivel WHERE idNivel = nivelUser) AS nivel, statusUser');
      
      $content = $this->load->view('mgr/instancias/usuarios.php' , [
        'host'=> $this->dbhost->host,
        'usuarios'=> $usuarios,
      ], TRUE);
      
      ///////////////////
      //info de salida //
      ///////////////////
      $data = [
        'header'=> [
          'title'=> 'Instancias',
          'stylesheets'=> [
            // 'public/lib/datatables.net-dt/css/jquery.dataTables.min.css',
          ]
        ],
        'aside'=> ['instanciasLink'=> 'active'],
        'footer'=> [
          'scripts'=> [
            'public/lib/jquery.flot/jquery.flot.js',
            'public/lib/jquery.flot/jquery.flot.stack.js',
            'public/lib/jquery.flot/jquery.flot.resize.js',
            'public/lib/chart.js/Chart.bundle.min.js',
            "public/lib/datatables.net/js/jquery.dataTables.min.js",
            "public/lib/datatables.net-dt/js/dataTables.dataTables.min.js",
            "public/lib/moment/min/moment.min.js",
            "public/lib/moment/locale/es.js",
          ]
        ],
        'nav'=> [
          'breadcrumbMain'=> 'Instancia',
          'breadcrumbSecondary'=> $this->dbhost->host,
        ],
        'body'=> $content,
      ];
      $this->markup->laucherView($data);
    }
    catch( Exception $e ){

      $this->markup->laucherView([
      'header'=> ['title' => 'Error'],
      'nav'=> ['breadcrumbMain'=> 'Sistema', 'breadcrumbSecondary'=> 'error'],
      'body'=> $this->load->view('error', ['error'=> $e], TRUE),
      ]);

    }


  }


  public function skeleton(){

    try{

      if( ! is_numeric($host) )
        throw new Exception("La instancia es invalida");

      $this->establecerInstancia($host);

      $dataCliente = $this->dbhost->uniqueRow('Cliente', ['idCliente'=> $cliente]);

      
      $content = $this->load->view('mgr/instancias/vista.php' , [
      ], TRUE);
      
      ///////////////////
      //info de salida //
      ///////////////////
      $data = [
        'header'=> [
          'title'=> 'Instancias',
          'stylesheets'=> [
            // 'public/lib/datatables.net-dt/css/jquery.dataTables.min.css',
          ]
        ],
        'aside'=> ['instanciasLink'=> 'active'],
        'footer'=> [
          'scripts'=> [
            'public/lib/jquery.flot/jquery.flot.js',
            'public/lib/jquery.flot/jquery.flot.stack.js',
            'public/lib/jquery.flot/jquery.flot.resize.js',
            'public/lib/chart.js/Chart.bundle.min.js',
            "public/lib/datatables.net/js/jquery.dataTables.min.js",
            "public/lib/datatables.net-dt/js/dataTables.dataTables.min.js",
            "public/lib/moment/min/moment.min.js",
            "public/lib/moment/locale/es.js",
          ]
        ],
        'nav'=> [
          'breadcrumbMain'=> 'Instancia',
          'breadcrumbSecondary'=> $this->dbhost->host,
        ],
        'body'=> $content,
      ];

      
      $this->markup->laucherView($data);

    }
    catch( Exception $e ){

      $this->markup->laucherView([
      'header'=> ['title' => 'Error'],
      'nav'=> ['breadcrumbMain'=> 'Sistema', 'breadcrumbSecondary'=> 'error'],
      'body'=> $this->load->view('error', ['error'=> $e], TRUE),
      ]);

    }

  }




}
