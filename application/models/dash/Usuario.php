<?php
/**
 * clase usuario
 */
class Usuario extends CI_Model
{
  

  public function __construct(){
    parent::__construct();

    // $this->load->library('Entity/User');
    // $this->load->library('Entity/User', NULL, 'user');
    // $this->config->load('Entity/User');
  
  }

  public function getUser( array $campos ){

    $data = $this->db->get_where('usuarios', $campos, 1);    
    if( $this->db->affected_rows() > 0 ){
      return $data->row(0);
    }
    else{
      return FALSE;
    }

  }


}