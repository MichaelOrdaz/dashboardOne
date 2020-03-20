<?php

/**
 * 
 */
class UsuariosModel extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
  }


  public function getUsers( int $active = 1 ): array{
    $r = $this->db->where( ['status'=> $active] )
      ->get('usuarios');
    return $r->result();
  }

  


}