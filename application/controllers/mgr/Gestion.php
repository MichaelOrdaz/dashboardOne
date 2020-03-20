<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('markup');

    if( ( $role = $this->session->userdata('dash_roles') ) === NULL ){
      // if( in_array('ROLE_USER', $role) ){
        redirect( base_url('login') );
      // }
    }

  }

  public function usuarios( $accion = null, $idUser = '' ){


    $error = '';
    $dataView = [];
    $vista = '';

    try{
      
      $active = 'adminSistemas';
      $breadcrumbMain = 'Usuarios';

      switch ($accion) {
        case NULL: case 'list':
          //listar usuarios
          $title = 'Usuario';
          $breadcrumbSecondary = 'Listado';
          $vista = 'mgr/usuarios.php';

          $links = [
            "public/lib/datatables.net-dt/css/jquery.dataTables.min.css",
            "public/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css",
          ];

          $scripts = [
            "public/lib/datatables.net/js/jquery.dataTables.min.js",
            "public/lib/datatables.net-dt/js/dataTables.dataTables.min.js",
          ];


        break;
        case 'add': case 'update':
          //crear usuarios
          $this->load->helper('form');
          $this->load->library('form_validation');
          
          if( $accion === 'add' ){

            $title = 'Crear usuario';
            $breadcrumbSecondary = 'Crear';

          }
          else if( $accion === 'update' ){

            $title = 'Actualizar usuario';
            $breadcrumbSecondary = 'Editar';

          }

          //validar información
          //id, nombre, paterno, materno, roles, correo, username, genero, pass, direccion, telefono, celular, created_at, updated_at, acciones, status
          $rules = [
            [
              'field'=> 'nombre',
              'label'=> 'Nombre',
              'rules'=> 'required',
            ],
            [
              'field'=> 'correo',
              'label'=> 'Correo Electrónico',
              'rules'=> 'required|is_unique[usuarios.correo]|valid_email',
              'errors'=> [
                'is_unique'=> 'El correo %s ya esta en uso',
              ]
            ],
            [
              'field'=> 'paterno',
              'label'=> 'Apellido Paterno',
              'rules'=> 'required',
            ],
            [
              'field'=> 'materno',
              'label'=> 'Apellido Materno',
              'rules'=> 'required',
            ],
            [
              'field'=> 'rol',
              'label'=> 'Rol',
              'rules'=> 'required|in_list[admin,client]',
              'errors'=> [
                'in_list'=> 'El rol no es valido',
              ],
            ],
            [
              'field'=> 'username',
              'label'=> 'Nombre de Usuario',
              'rules'=> 'required|is_unique[usuarios.username]',
              'errors'=> [
                'is_unique'=> 'El nombre de usuario %s ya esta en uso',
              ]
            ],
            [
              'field'=> 'genero',
              'label'=> 'Género',
              'rules'=> 'required',
            ],
            [
              'field'=> 'tel',
              'label'=> 'Teléfono',
              'rules'=> 'numeric',
            ],
            [
              'field'=> 'cel',
              'label'=> 'Celular',
              'rules'=> 'numeric',
            ]
          ];

          $this->form_validation->set_rules( $rules );

          if ( $this->form_validation->run() === FALSE ){
            
            $vista = 'mgr/addUsuario.php';

            if( $accion === 'update' ){
              $scripts = ['public/mgr/updateUser.js'];
              $dataView['title'] = 'Actualizar datos del usuario';
              $dataView['titleForm'] = 'Formulario de actualización del usuario';
            }
            else if( $accion === 'add' ){
              $dataView['title'] = 'Crear nuevo usuario';
              $dataView['titleForm'] = 'Formulario de alta de usuarios';
            }

          }
          else{

            $this->load->model('dash/Usuario');
            
            if( $accion === 'add' ){

              $vista = 'mgr/successUser.php';
              $dataView['subTitle'] = 'Usuario creado';
              $dataView['parrafo'] = "El usuario <b>{$this->input->post('username')}</b>, {$this->input->post('nombre')} {$this->input->post('paterno')} {$this->input->post('materno')} se creo correctamente <br> Importante, la contraseña es {$passUser}";


              //recuperamos datos
              $datos = [
                'username'=> $this->input->post('username', TRUE),
                'nombre'=> ucwords( $this->input->post('nombre', TRUE) ),
                'paterno'=> ucwords( $this->input->post('paterno', TRUE) ),
                'materno'=> ucwords( $this->input->post('materno', TRUE) ),
                'genero'=> $this->input->post('genero', TRUE),
                'correo'=> $this->input->post('correo', TRUE),
                'direccion'=> $this->input->post('dir', TRUE),
                'telefono'=> $this->input->post('tel', TRUE),
                'celular'=> $this->input->post('cel', TRUE),
                'roles'=> $this->input->post('rol', TRUE),
              ];


              if( ! ( $pass = $this->Usuario->setUser( $datos ) ) ){
                throw new Exception("No se pudo crear el cliente, por favor reintente");
              }

              $dataView['passUser'] = $pass;
            
            }//endifAdd
            else if( $accion === 'update' ){

              $vista = 'mgr/successUser.php';
              $dataView['subTitle'] = 'Información del Usuario actualizada';
              $dataView['parrafo'] = "La informacion del usuario <b>{$this->input->post('username')}</b>, {$this->input->post('nombre')} {$this->input->post('paterno')} {$this->input->post('materno')} se actualizo correctamente";
              
              //recuperamos datos
              $datos = [
                'nombre'=> ucwords( $this->input->post('nombre', TRUE) ),
                'paterno'=> ucwords( $this->input->post('paterno', TRUE) ),
                'materno'=> ucwords( $this->input->post('materno', TRUE) ),
                'genero'=> $this->input->post('genero', TRUE),
                'direccion'=> $this->input->post('dir', TRUE),
                'telefono'=> $this->input->post('tel', TRUE),
                'celular'=> $this->input->post('cel', TRUE),
                'roles'=> $this->input->post('rol', TRUE),
              ];

              $this->Usuario->updateUser( $idUser, $datos );

            }//endifupdate


          }


        break;
        case 'delete':

          $this->input->is_ajax_request() or die('HTTP REQUEST NOT ALLOWED');

          $response = [];
          //elimina
          $id = $this->input->post('id');
          if( ( $id = filter_var($id, FILTER_VALIDATE_INT ) ) === FALSE ){
            $response = ['status'=> 0, 'msg'=> 'El usuario a eliminar es invalido'];
          }
          else{
            $this->load->model('dash/Usuario');
            if( $this->Usuario->deleteUser( $id ) ){
              $response = ['status'=> 1, 'msg'=> 'Usuario eliminado correctamente'];
            }
            else{
              $response = ['status'=> 0, 'msg'=> 'No se pudo eliminar el usuario, por favor reintente'];
            }
          }

          $this->output
          ->set_status_header(200)
          ->set_content_type('application/json', 'utf-8')
          ->set_output( json_encode( $response ) )
          ->_display();
          exit;

        break;
      }//endSwitch

    }//endTry
    catch( Exception $e ){
      $error = $e->getMessage();
    }
    
    $dataView['error'] = $error;
    $content = $this->load->view($vista , $dataView, TRUE);

    $data = [
      'header'=> ['title' => $title, 'stylesheets'=> $links ?? null],
      'aside'=> [$active => 'active'],
      'footer'=> [
        'scripts'=> $scripts ?? null
      ],
      'nav'=> compact('breadcrumbMain', 'breadcrumbSecondary'),
      'body'=> $content,
    ];
    
    $this->markup->laucherView($data);

  }

  public function listarUsuarios(){

    $this->input->is_ajax_request() or die('Request HTTP not allowed');

    $this->load->model('dash/UsuariosModel', 'usuarios');
    $this->load->model('dash/Usuario', 'user');

    $rows = $this->usuarios->getUsers();

    if( $rows ){
      
      foreach ($rows as &$row) {
        $row->roles = $this->user->getSimpleRol( $row->roles );
      }

      $response = ['status'=> 1, 'data'=> $rows, 'msg'=> 'Ok'];
    }
    else{
      $response = ['status'=> 0, 'msg'=> 'Error'];
    }

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output( json_encode( $response ) )
      ->_display();
    exit;

  }


  //recupera la informacion de un solo usuario por id
  public function usuario( int $id ){

    $response = [];
    if( ( $id = filter_var($id, FILTER_VALIDATE_INT ) ) === FALSE ){
      $response = ['status'=> 0, 'msg'=> 'El usuario es invalido'];
    }
    else{
      $this->load->model('dash/Usuario');
      if( ( $user = $this->Usuario->getUser( ['id'=> $id] ) ) !== FALSE ){
        $user->roles = $this->Usuario->getSimpleRol( $user->roles );
        $response = ['status'=> 1, 'msg'=> 'Ok', 'data'=> $user];
      }
      else{
        $response = ['status'=> 0, 'msg'=> 'No se pudo obtener el usuario'];
      }
    }

    echo json_encode( $response );

  }



}
