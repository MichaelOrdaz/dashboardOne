<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Entity/User.php';

class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->load->helper('custom');//cargo mis ayudantes

    // $this->load->library('Entity/User');
    

  }

  public function index()
  {

    //primero verifico que si el usuario existe y sea un usuario, lo redireccionamos a el admin
    //si no es asi sigue su curso normalmente
    if( ( $role = $this->session->userdata('dash_roles') ) !== NULL ){

      if( in_array('ROLE_USER', $role) ){
        redirect( base_url('mgr/main') );
      }

    }


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

      $info = $this->autenticate( $username, $pass );

      $this->load->view('sigin', $info);
    
    }

  }

  protected function autenticate( $user, $pass ){

    $this->load->model('dash/Usuario');

    $customUser = $this->Usuario->getUser(['username'=> $user]);

    $info;

    if( $customUser !== FALSE ){

      $user = new User($customUser);
      
      if( $user->verifyPass($pass) ){
        header('refresh:4;url='.base_url('/mgr/main'));
        $user->save_session();
        $info = ['msg'=> 'Correcto sera redirigido en un momento <i class="fas fa-spinner fa-pulse"></i>', 'status'=> 1 ];
      }
      else{
        $info = ['msg'=> 'Las credenciales son incorrectas', 'status'=> 0 ];
      }
      
    }
    else{
      $info = ['msg'=> 'Las credenciales son invalidas', 'status'=> 0 ];
    }

    return $info;

  }

  public function logout(){

    // $_SESSION = array();
    // session_destroy();
    unset(
      $_SESSION['dash_nombre'],
      $_SESSION['dash_paterno'],
      $_SESSION['dash_materno'],
      $_SESSION['dash_username'],
      $_SESSION['dash_roles'],
      $_SESSION['dash_email']
    );

    echo json_encode(['status'=> 1, 'La sesión se cerrará']);

  }


}
