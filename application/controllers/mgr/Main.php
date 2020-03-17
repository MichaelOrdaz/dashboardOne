<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

  public function __construct(){
    parent::__construct();

  }


  public function index(){

    $dataHeader = [
      'title'=> 'Home',
      'stylesheets' => [],
    ];
    $header = $this->load->view('base/header.php' , $dataHeader, TRUE);

    $dataAside = [
      'home'=> 'active',
    ];
    $aside = $this->load->view('base/aside.php' , $dataAside, TRUE);

    $dataContent = [
      'breadcrumbMain'=> 'Dashboard',
      'breadcrumbSecondary'=> 'Resumen',
    ];
    $content = $this->load->view('mgr/home.php' , $dataContent, TRUE);

    $dataFooter = [
      'scripts'=> [
        'public/assets/js/dashforge.sampledata.js',
        'public/mgr/home.js',
      ]
    ];
    $footer = $this->load->view('base/footer.php' , $dataFooter, TRUE);

    echo $header.$aside.$content.$footer;

  }


  public function test(){
    $this->load->model('Bitacora');

    $data['rows'] = $this->Bitacora->getBitacoras();



    $this->load->view('test', $data);

  }


}
