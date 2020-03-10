<?php
/**
 * 
 */
class Bitacora extends CI_Model
{
  
  public function __construct(){

  }

  public function getBitacoras(){

    $result = $this->db->get('bitacoragestion', 100);
    $rows = [];
    foreach ($result->result() as $row)
      $rows[] = $row;
    
    return $rows;
  }


}