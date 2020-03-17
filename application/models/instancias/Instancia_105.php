<?php
/**
 * instancia 100
 */
class Instancia_105 extends CI_Model
{
    
  protected $DB;

  public function __construct(){
    parent::__construct();

    $this->DB = $this->load->database('instancia_105', TRUE, TRUE);
  
  }

  public function getUsers(){

    $r = $this->DB->get('User');
    return $r->result();

  }


}