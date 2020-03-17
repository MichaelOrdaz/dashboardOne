<?php
/**
 * instancia 100
 */
class Instancia_100 extends CI_Model
{
    
  protected $DB;

  public function __construct(){
    parent::__construct();

    $this->DB = $this->load->database('instancia_100', TRUE, TRUE);
  
  }

  public function getUsers(){

    $r = $this->DB->get('User');
    return $r->result();

  }


}