<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instancia extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model('dash/InstanciaModel', 'host');
    $this->load->library('markup');

  }

  public function index( $instancia = null ){

    if( ( $role = $this->session->userdata('dash_roles') ) === NULL ){
      // if( in_array('ROLE_USER', $role) ){
        redirect( base_url('login') );
      // }
    }

    $error = '';


    try{

      if( ! is_numeric($instancia) ){
        throw new Exception("La instancia es invalida");
      }
      //si falla al establecer la instancia
      if( ! $this->host->set($instancia) ){
        throw new Exception("La instancia no existe o ha sido borrada");
      }

      //aqui tengo la instancia, si llego hasta aqui sin errores
      $conteo = $this->host->getCountUsers();
      

    }
    catch( Exception $e ){
      $error = $e->getMessage();
    }

    $content = $this->load->view('mgr/instancias/index.php' , [
      'error'=> $error,
      'host'=> $this->host->host,
      'conteo'=> $conteo,

    ], TRUE);

    $data = [
      'header'=> ['title'=> 'Instancias'],
      'aside'=> ['instanciasLink'=> 'active'],
      'footer'=> [
        'scripts'=> [
          'public/lib/jquery.flot/jquery.flot.js',
          'public/lib/jquery.flot/jquery.flot.stack.js',
          'public/lib/jquery.flot/jquery.flot.resize.js',
        ]
      ],
      'nav'=> [
        'breadcrumbMain'=> 'Instancias',
        'breadcrumbSecondary'=> 'Resumen',
      ],
      'body'=> $content,
    ];

    
    $this->markup->laucherView($data);

    



  }




}
