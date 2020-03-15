<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->load->helper('custom');//cargo mis ayudantes

  }

  public function index()
  {

    $rules = [
      [
        'field'=> 'username',
        'label'=> 'Nombre de Usuario',
        'rules'=> 'required',
        'errors'=> [
          'required'=> 'Debe indicar el %s',
        ],
      ],
      [
        'field'=> 'pass',
        'label'=> 'Contraseña',
        'rules'=> 'required|min_length[5]',
        'errors'=> [
          'required'=> 'Debe indicar %s',
          'min-length'=> 'La contraseña es demasiado corta',
        ],
      ],

    ];
    $this->form_validation->set_rules( $rules );

    if ($this->form_validation->run() == FALSE){
      $this->load->view('sigin');
    }
    else{

      $username = $this->input->post('username', TRUE);
      $pass = $this->input->post('pass', TRUE);

      $this->load->model('dash/Usuario');

      $user = $this->Usuario->getUser(['username'=> $username]);
      
      if( $user !== FALSE ){
        
        if( $user->verifyPass($pass) ){
          header('refresh:4;url='.base_url('/mgr/main'));
          $this->load->view('sigin', ['msg'=> 'Correcto sera redirigido en un momento <i class="fas fa-spinner fa-pulse"></i>', 'status'=> 1]);
          // redirect("/mgr/main");
        }
        else{
          $this->load->view('sigin', ['msg'=> 'Las credenciales son incorrectas', 'status'=> 0 ]);
        }
        
      }
      else{
        $this->load->view('sigin', ['msg'=> 'Las credenciales son invalidas', 'status'=> 0 ]);
      }

    }

  }

  public function autenticate(){




    /*
      $plain = 'somepass';

      //hashing
      $pass = password_hash($plain, PASSWORD_DEFAULT);
      
      $info = password_get_info($pass);

      $verify = password_verify($plain.'5', $pass);

      var_dump( $pass );

      var_dump( $info );

      var_dump($verify ? 'TRUE': 'FALSE');
  
    */

  }

}
