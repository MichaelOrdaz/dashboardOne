<?php

/**
 * 
 */
class InstanciaModel extends CI_Model{
  
  private $DB = null;

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
      //la instancia no fue valida y no se obtivieron datos
      return false;
    }

    $instancia = $r->row();

    foreach ($instancia as $key => $value) {
      $this->{$key} = $value;
    }
    
    $this->DB = $this->load->database([
      'hostname'=> $this->host,
      'username'=> $this->user,
      'password'=> $this->password,
      'database'=> $this->database,
      'dbdriver'=> 'mysqli',
      'dbprefix' => '',
      'pconnect' => FALSE,
      'db_debug' => (ENVIRONMENT !== 'production'),
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
    ], TRUE, TRUE);

    return $this->DB;//lo regreso para que se regrese algo
  
  }

  public function get(){
    return $this->DB;
  }


  public function getCountUsers(){

    $r = $this->DB->query("SELECT count(idUser) as total FROM User where statusUser = 1");
    $activeUsers = $r->row()->total;
    // $this->DB->query("SELECT count(idUser) as total FROM User where statusUser = 1");
    $totalUsers = $this->DB->count_all_results('User');

    return compact('activeUsers', 'totalUsers');
  }


}