<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');

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
        // redirect("/mgr/main");
        if( $user->verifyPass($pass) ){
          $this->load->view('sigin', ['msg'=> 'Correcto', 'user'=> $user, 'type'=> 'success']);
        }
        else{
          $this->load->view('sigin', ['msg'=> 'Las contraseña es incorrecta', 'user'=>$user, 'type'=> 'danger' ]);
        }
        
      }
      else{
        $this->load->view('sigin', ['msg'=> 'Las credenciales son incorrectas', 'user'=>$user, 'type'=> 'danger' ]);
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
