<?php

/**
 * 
 */
class InstanciaModel extends CI_Model{
  
  private $DB = FALSE;

  private $id;
  public $host;
  public $database;
  public $user;
  private $password;
  public $descripcion;
  public $nombre;
  public $created_at;
  public $updated_at;
  public $status;

  public function __construct(){
    parent::__construct();
  }

  //establece la base de datos con la cual voy a trabajar
  public function set( int $id ){

    $r = $this->db->get_where('instancias', ['id'=> $id], 1);

    if( ! $this->db->affected_rows() > 0 ){
      //la instancia no fue valida y no se obtuvieron datos
      return false;
    }

    $instancia = $r->row();

    foreach ($instancia as $key => $value) {
      $this->{$key} = $value;
    }
    
    $this->config = [
      'hostname'=> $this->host,
      'username'=> $this->user,
      'password'=> $this->password,
      'database'=> $this->database,
      'dbdriver'=> 'mysqli',
      'dbprefix' => '',
      'pconnect' => FALSE,
      'db_debug' => FALSE,
      'cache_on' => FALSE,
      'cachedir' => '',
      'char_set' => 'utf8',
      'dbcollat' => 'utf8_general_ci',
      'swap_pre' => '',
      'encrypt' => FALSE,
      'compress' => FALSE,
      'stricton' => FALSE,
      'failover' => array(),
      'save_queries' => TRUE
    ];

    // echo "antes del load database";

    $this->DB = $this->load->database($this->config, TRUE, TRUE);

    // var_dump("Esto regresa el load database", $this->DB);

    return $this->DB;//lo regreso para que se regrese algo
    //este puede ser la instancia de db o false en caso de error
    //aqui estoy mal por que regresa la conexion del driver igual lo dejo, pero lo ignoro
  
  }

  /**
   * [getConnection devuelve la conexion a la base de datos de la intancia, con query builder activo]
   * @return [mixed] [devuelve la conexion de db o false en caso de error con la conexion]
   */
  public function getConnection(){
    return $this->DB;
  }

  public function getInstancia( array $where ){
    $r = $this->db->get_where('instancias', $where, 1);

    if( ! $this->db->affected_rows() > 0 ){
      return false;
    }
    return $r->row();

  }

  /**
   * [create crea un registro de conexion de una instancia]
   * @param  [array] $datos [description]
   * @return [mixed] objeto si se almaceno correctamente o false
   */
  public function create( array $datos ){

    $datos['acciones'] = "creador {$this->session->userdata('dash_user')} fecha " . date('Y-m-d H:i:s') . " ip {$this->input->ip_address()},"; 

    if( $this->db->insert('instancias', $datos) ){
      $id = $this->db->insert_id();
      return $id;
      // return $this->set( $id );
    }
    else
      return FALSE;
  }

  public function delete( int $id ): bool{

    $accion = "elimino {$this->session->userdata('dash_user')} fecha " . date('Y-m-d H:i:s') . " ip {$this->input->ip_address()},";

    return $this->db->where('id', $id)
      ->set( 'status', 0 )
      ->set( 'acciones', "CONCAT(acciones, '{$accion}')", FALSE )
      ->update('instancias');
  }

  public function update( int $id, array $datos ): bool {
    
    $accion = "editor {$this->session->userdata('dash_user')} fecha " . date('Y-m-d H:i:s') . " ip {$this->input->ip_address()},";

    return $this->db->where('id', $id)
      ->set( $datos )
      ->set( 'acciones', "CONCAT(acciones, '{$accion}')", FALSE )
      ->update('instancias');
  }


  ///////////////
  //  metodos  //
  ///////////////

  /**
   * [getCount ajecuta una funcion count de mysql]
   * @param  string $table [tabla a la cual hara el conteo]
   * @param  string $where [la parte where]
   * @return [int]        [retorna el numero contado]
   */
  public function getCount( string $table, $where = '' ){

    $this->DB->select('COUNT(*) as total')
      ->from($table);
    
    if( $where )
      $this->DB->where($where);
    
    $r = $this->DB->get();
    
    return $r->row()->total;

  }

  /**
   * Obtener los/el clientes
   * @param [array] [where: array asociativo para buscar coincidencias en la base de datos]
   * return array
   */
  public function getClientes( array $where = array() ){
    $this->DB->select('idCliente, rfcCliente, cpCliente, nombreCliente, telefonoCliente, tipo');
    if( $where )
      $this->DB->where( $where );
    $r = $this->DB->get('Cliente');
    return $r->result();
  }

  public function uniqueRow($table, $where ){
    $r = $this->DB->get_where($table, $where, 1);
    return $r->row();
  }

  /**
   * [consultar ejecuta una consulta a la tabla propocionada]
   * @param  string $table  [tabla de la bd]
   * @param  [mixed] $where  [parte where de la consulta]
   * @param  [mixed] $fields [campos a seleccionar]
   * @return [array]  [devuleve un array de resultados como objetos]
   */
  public function consultar( string $table, $where = null, $fields = null ){
    if( $fields )
      $this->DB->select($fields);
    if( $where )
      $this->DB->where( $where );

    $r = $this->DB->get($table);
    return $r->result(); 
  }


  public function getPromesasAgrupadas($initDate, $cliente){
    //select count(*), date(fechaBitaGes) from bitacoragestion b2 where idCR = 'PP' and date(fechaBitaGes) > '2019-11-24' and idCliente = 3 group by date(fechaBitaGes)
    $r = $this->DB->select( 'COUNT(*) as total, DATE(fechaBitaGes) as fecha' )
      ->from('BitacoraGestion')
      ->where('idCR', 'PP')
      ->where('DATE(fechaBitaGes) >', $initDate)
      ->where('idCliente', $cliente)
      ->group_by( 'DATE(fechaBitaGes)' )
      ->get();
    return $r->result();

  }

  public function getPagosAgrupados($initDate, $cliente){
    //select count(*), date(fechaBitaGes) from bitacoragestion b2 where idCR = 'PP' and date(fechaBitaGes) > '2019-11-24' and idCliente = 3 group by date(fechaBitaGes)
    $r = $this->DB->select( 'COUNT(*) as total, DATE(fechaBitaGes) as fecha' )
      ->from('BitacoraGestion')
      ->where('idCR', 'PE')
      ->where('DATE(fechaBitaGes) >', $initDate)
      ->where('idCliente', $cliente)
      ->group_by( 'DATE(fechaBitaGes)' )
      ->get();
    return $r->result();

  }

  public function getClientesConAsignacion(){
    //select c.idCliente , c.rfcCliente , c.nombreCliente , c.cpCliente , c.tipo, count(ac.idCliente), c.statusCliente from cliente c join asignacioncobranza as ac on c.idCliente = ac.idCliente where 1 and ac.statusCuenta = 1 group by ac.idCliente ;
    // $r = $this->DB->select("c.idCliente , c.rfcCliente , c.nombreCliente , c.cpCliente , c.tipo, COUNT(ac.idCliente) AS gestiones, c.statusCliente")
    //   ->from('Cliente AS c')
    //   ->join('AsignacionCobranza AS ac', 'ac.idCliente = c.idCliente')
    //   ->group_by('ac.idCliente')
    //   ->get();
    //   
    $r = $this->DB->select("c.idCliente , c.rfcCliente , c.nombreCliente , c.cpCliente , c.tipo, (SELECT COUNT(*) FROM AsignacionCobranza WHERE idCliente = c.idCliente AND statusCuenta = 1) AS gestiones, c.statusCliente")
      ->from('Cliente AS c')
      ->get();
    

    return $r->result();

  }



  public function obtenerCodigo( $codigo, $cliente ){
    // select b.idCR, (select cr.descCR from cr where idCliente = b.idCliente and idCR = b.idCR limit 1 ) as descripcion, COUNT(*) as total from bitacoragestion b where 1 = (select statusCuenta from asignacioncobranza a where folio = b.folio) group by b.idCR  order by total;
    //tipos de codigo son CR = codigo de resultado y CA codigo de accion
    $codigoUpper = strtoupper($codigo);

    $r = $this->DB->select("b.id{$codigoUpper}, (SELECT desc{$codigoUpper} FROM {$codigoUpper} WHERE idCliente = b.idCliente AND id{$codigoUpper} = b.id{$codigoUpper} LIMIT 1 ) AS descripcion, COUNT(*) AS total")
      ->from('BitacoraGestion AS b')
      // ->where('1', '(SELECT statusCuenta FROM AsignacionCobranza a WHERE folio = b.folio LIMIT 1)', FALSE)
      ->where('idCliente', $cliente)
      ->group_by("b.id{$codigoUpper}")
      ->order_by('total', 'DESC')
      ->limit('50')
      ->get();
    return $r->result();
  }



  public function getPromesasToDT($request, $client, $fecha){

    // select idBitaGes, telContactBitaGes, fechaProxContactBitaGes, fechaBitaGes, folio, idCR from BitacoraGestion bg where idCR = 'PP' AND idCliente = 3 AND DATE(fechaBitaGes) > '2020-02-26';

    // los indices de las columnas de datatable deben coincidir conm el nombrte en la base de datos
    $columns = array(
      'dmname',
      'telContactBitaGes',
      'fechaProxContactBitaGes',
      'fechaBitaGes',
      'folio',
      'idCR',
      'cumplio',
    );

    $totalFiltered = $totalData = 0;

    $sql = "SELECT idBitaGes, telContactBitaGes, fechaProxContactBitaGes, fechaBitaGes, folio, idCR, (select COUNT(*) FROM BitacoraGestion bg2 WHERE DATE(bg2.fechaBitaGes) = DATE(bg.fechaProxContactBitaGes) AND bg2.idCliente = bg.idCliente AND bg2.folio = bg.folio AND bg2.idCR = 'PE') AS cumplio FROM BitacoraGestion bg WHERE idCR = 'PP' AND idCliente = '{$client}' AND DATE(fechaBitaGes) > '{$fecha}' ";
    $sqlCount = "SELECT COUNT(*) AS total from BitacoraGestion bg WHERE idCR = 'PP' AND idCliente = '{$client}' AND DATE(fechaBitaGes) > '{$fecha}' ";

    $result = $this->DB->query( $sqlCount );
    $totalData = $totalFiltered = $result->row()->total;

        // Si exiten parametros de busqueda (provenientes del cuadro de busqueda da la datatable) se aplican
    // los campos evaluados en el where se deben reemplazar por los que contenga la tabla a seleccionar
    if( ! empty( $request['search']['value'] ) ){
      $sqlSearch = " AND ( telContactBitaGes LIKE '%{$request['search']['value']}%' OR fechaProxContactBitaGes LIKE '%{$request['search']['value']}%' OR fechaBitaGes LIKE '%{$request['search']['value']}%')";
      $sql .= $sqlSearch;
      $sqlCount .= $sqlSearch;
      $result = $this->DB->query( $sqlCount );
      $totalFiltered = $result->row()->total;
    }

    // Es importante declarar el array colums de esa forma la datatable podrá ordenar ascendente o descendente los registros
    $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] ." {$request['order'][0]['dir']} ";
    // LIMIT
    $sql .= " LIMIT ".intval($request['start']).", ".intval($request['length']);
    //ejecutamos el query Final
    $result = $this->DB->query( $sql );

    $rows = $result->result();

    //Este array es el que recibe la datatable y convierte en el resultado deseado
    return array(
      "draw" => intval($request['draw']),   // Registros por paginado
      "recordsTotal" => intval($totalData),   // Registros totales
      "recordsFiltered" => intval($totalFiltered),// Registros filtrados por el cuadro de busqueda
      "data" => $rows,  // Objeto que contiene la tabla a ser mostrada
      'sql'=> $sql
    );

    /*
    $sql = $this->DB->select('idBitaGes, telContactBitaGes, fechaProxContactBitaGes, fechaBitaGes, folio, idCR')
      ->from('BitacoraGestion')
      ->where(['idCR'=> 'PP', 'idCliente'=> $client, 'DATE(fechaBitaGes) >'=> $fecha])
      ->group_start()
        ->like('telContactBitaGes')
        ->or_like('fechaProxContactBitaGes')
        ->or_like('fechaBitaGes')
      ->group_end()
      ->order_by()
      ->limit()
      ->get_compiled_select();
    */
  }


  public function contarPromesasCumplidas($client, $date){

    // $r = $this->DB->query("SELECT SUM( IF( (SELECT COUNT(*) FROM BitacoraGestion bg2 WHERE DATE(bg2.fechaBitaGes) = DATE(bg.fechaProxContactBitaGes) AND bg2.idCliente = bg.idCliente AND bg2.folio = bg.folio AND bg2.idCR = 'PE') > 0, 1, 0 ) ) AS cumplidos FROM BitacoraGestion bg WHERE idCR = 'PP' AND idCliente = '{$client}' AND DATE(fechaBitaGes) > '{$date}'");

    // return $r->row()->cumplidos;
    $r = $this->DB->query("SELECT (SELECT COUNT(*) FROM BitacoraGestion bg2 WHERE DATE(bg2.fechaBitaGes) = DATE(bg.fechaProxContactBitaGes) AND bg2.idCliente = bg.idCliente AND bg2.folio = bg.folio AND bg2.idCR = 'PE' ) AS cumplio FROM BitacoraGestion bg WHERE idCR = 'PP' AND idCliente = '{$client}' AND DATE(fechaBitaGes) > '{$date}'");
    $cumplidos = 0;

    foreach ($r->result() as $item) {
      if( $item->cumplio > 0 )
        $cumplidos++;   
    }
    return $cumplidos;

  }


}