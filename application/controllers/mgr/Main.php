<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model('instancias/Instancia_103');
  }

  public function index(){

    if( ( $role = $this->session->userdata('dash_roles') ) === NULL ){
      // if( in_array('ROLE_USER', $role) ){
        redirect( base_url('login') );
      // }
    }


    $usuarios = $this->Instancia_103->getUsers();

    $content = $this->load->view('mgr/home.php' , [
      'usuarios'=> $usuarios,
    ], TRUE);

    $data = [
      'header'=> ['title'=> 'Home'],
      'aside'=> ['home'=> 'active'],
      'footer'=> [
        'scripts'=> [
          'public/assets/js/dashforge.sampledata.js',
          'public/mgr/home.js',
          'public/lib/jquery.flot/jquery.flot.js',
          'public/lib/jquery.flot/jquery.flot.stack.js',
          'public/lib/jquery.flot/jquery.flot.resize.js',
        ]
      ],
      'content'=> [
        'usuarios'=> $usuarios,
      ],
      'nav'=> [
        'breadcrumbMain'=> 'Dashboard',
        'breadcrumbSecondary'=> 'Resumen',
      ],
      'body'=> $content,
    ];

    
    $this->loadView($data);

  }


  protected function loadView( array $data ){

    $header = $this->load->view('base/header.php' , $data['header'], TRUE);

    $aside = $this->load->view('base/aside.php' , $data['aside'], TRUE);

    $footer = $this->load->view('base/footer.php' , $data['footer'], TRUE);
    
    $data['nav']['body'] = $data['body'];
    $nav = $this->load->view('base/nav.php', $data['nav'], TRUE);

    $this->load->view('base/layout', compact('header', 'aside', 'nav', 'footer') );

 
  }


}
