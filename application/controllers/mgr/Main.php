<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {


  public function index(){
    // $this->load->view('');
    echo "Hola desde el admin";

  }


  public function test(){

    $this->load->view('test');

  }


}
