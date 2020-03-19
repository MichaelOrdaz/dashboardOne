<?php

/**
 * 
 */
class Instancias extends CI_Model
{
  

  public function getAll(){
    $r = $this->db->get_where('instancias', ['status'=> 1]);
    return $r->result();
  }



}