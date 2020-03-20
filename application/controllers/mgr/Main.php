<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('markup');

    if( ( $role = $this->session->userdata('dash_roles') ) === NULL ){
      // if( in_array('ROLE_USER', $role) ){
        redirect( base_url('login') );
      // }
    }
    
  }

  public function index(){


    $content = $this->load->view('mgr/home.php', NULL, TRUE);

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
      'nav'=> [
        'breadcrumbMain'=> 'Dashboard',
        'breadcrumbSecondary'=> 'Resumen',
      ],
      'body'=> $content,
    ];

    
    $this->markup->laucherView($data);

  }




}
