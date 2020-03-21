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

  public function getCountUsers(){

    $r = $this->DB->query("SELECT count(idUser) as total FROM User where statusUser = 1");
    $activeUsers = $r->row()->total;
    // $this->DB->query("SELECT count(idUser) as total FROM User where statusUser = 1");
    $totalUsers = $this->DB->count_all_results('User');

    return compact('activeUsers', 'totalUsers');
  }


}