<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

  public function __construct(){
    parent::__construct();

  }


  public function index(){
    // $this->load->view('');
    echo "Hola desde el admin";

  }


  public function test(){
    $this->load->model('Bitacora');

    $data['rows'] = $this->Bitacora->getBitacoras();



    $this->load->view('test', $data);

  }


}
