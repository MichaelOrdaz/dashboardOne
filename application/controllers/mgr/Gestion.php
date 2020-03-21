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
            // "public/lib/datatables.net-dt/css/jquery.dataTables.min.css",
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
          
          $rules = [];

          if( $accion === 'add' ){

            $title = 'Crear usuario';
            $breadcrumbSecondary = 'Crear';

            $rules = array_merge($rules, [
              [
                'field'=> 'correo',
                'label'=> 'Correo Electrónico',
                'rules'=> 'required|is_unique[usuarios.correo]|valid_email',
                'errors'=> [
                  'is_unique'=> 'El correo %s ya esta en uso',
                ]
              ],
              [
                'field'=> 'username',
                'label'=> 'Nombre de Usuario',
                'rules'=> 'required|is_unique[usuarios.username]',
                'errors'=> [
                  'is_unique'=> 'El nombre de usuario %s ya esta en uso',
                ]
              ],
            ] );

          }
          else if( $accion === 'update' ){

            $title = 'Actualizar usuario';
            $breadcrumbSecondary = 'Editar';

          }

          //validar información
          //id, nombre, paterno, materno, roles, correo, username, genero, pass, direccion, telefono, celular, created_at, updated_at, acciones, status
          $rules = array_merge( [
            [
              'field'=> 'nombre',
              'label'=> 'Nombre',
              'rules'=> 'required',
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
          ] );

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
              $dataView['parrafo'] = "El usuario <b>{$this->input->post('username')}</b>, {$this->input->post('nombre')} {$this->input->post('paterno')} {$this->input->post('materno')} se creo correctamente <br> Importante, la contraseña es {$pass}";
            
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

    echo json_encode($response);
    // $this->output
    //   ->set_status_header(200)
    //   ->set_content_type('application/json', 'utf-8')
    //   ->set_output( json_encode( $response ) )
    //   ->_display();
    // exit;

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



  ///////////////////////////////////////////////////////////////////////////
  //gestion de las instancias la hare de otra forma para mejor legibilidad //
  ///////////////////////////////////////////////////////////////////////////
  
  /**
   * esta funcion gestionara las peticiones que se realicen para la administracion de las instancias, 
   * el CRUD.
   * @param  [string] $action [la accion a realizar con la instancia(s)]
   * @param  [?int] $idHost [el identificador de la instancia]
   * @return [void] 
   */
  public function instancias(string $action = 'list', $idHost = '' ): void {

    try{
    
      if( $action === 'list' ){
        $this->obtenerInstancias();
      }
      else if( $action === 'add' ){
        $this->createInstancia();
      }
      else if( $action === 'update' ){
        if( ! is_numeric($idHost) ){
          throw new Exception("La instancia para actualizar es invalida");
        }
        $this->updateInstancia($idHost);
      }
      else if( $action === 'delete' ){
        if( ! is_numeric($idHost) ){
          echo json_encode(['status'=> 0, 'msg'=> 'La Instancia es invalida']);
        }
        $this->deleteInstancia($idHost);
      }

    }
    catch( Exception $e ){
      
      $this->markup->laucherView([
      'header'=> ['title' => 'Error'],
      'nav'=> ['breadcrumbMain'=> 'Sistema', 'breadcrumbSecondary'=> 'error'],
      'body'=> $this->load->view('error', ['error'=> $e], TRUE),
      ]);

    }

  }

  protected function getRulesForm( string $form ): array {
    $rules = [];

    switch ( $form ) {
      case 'createInstancia': case 'updateInstancia':

        $rules = array_merge($rules, [
          [
            'field'=> 'nombre',
            'label'=> 'Nombre',
            'rules'=> 'required',
          ],
          [
            'field'=> 'host',
            'label'=> 'Hostname',
            'rules'=> 'required',
          ],
          [
            'field'=> 'user',
            'label'=> 'Usuario',
            'rules'=> 'required',
          ],
          [
            'field'=> 'dbname',
            'label'=> 'Base de Datos',
            'rules'=> 'required'
          ],
        ]);

      break;

      default:
        //statements
      break;
    }

    return $rules;
  }


  protected function updateInstancia(int $id){

    $this->load->helper('form');
    $this->load->library('form_validation');

    $breadcrumbMain = 'Instancias';
    $breadcrumbSecondary = 'Actualizar';

    $rules = $this->getRulesForm('updateInstancia');

    $this->form_validation->set_rules( $rules );

    if ( $this->form_validation->run() === FALSE ){

      $dataView['title'] = 'Actualizar Instancia';
      $dataView['titleForm'] = 'Actualizar Datos de la Instancias';
      $content = $this->load->view('mgr/formInstancia' , $dataView, TRUE);

    }
    else{

      $this->load->model('dash/InstanciaModel', 'dbhost');

      $datos = [
        'nombre'=> $this->input->post('nombre', TRUE),
        'host'=> $this->input->post('host', TRUE),
        'database'=> $this->input->post('dbname', TRUE),
        'password'=> $this->input->post('pass', TRUE),
        'descripcion'=> $this->input->post('des', TRUE),
        'user'=> $this->input->post('user', TRUE),
      ];

      if( $this->dbhost->update( $id, $datos ) !== FALSE ){//si se almaceno correctamente
        $instancia = $this->dbhost->getInstancia( ['id'=> $id] );//recupero la instancia recien guardada o false en cado de error
        if( $instancia === FALSE ){
          throw new Exception("Error al recuperar la instancia recien actualizada");
        }

        //verifico si me puedo conectar o no conectar
        $this->load->helper('custom');//cargo mis helper
        $statusConnection = connection_native( $instancia->host, $instancia->user, $instancia->password, $instancia->database );

        $dataView['title'] = 'Instancia';
        $dataView['msg'] = 'La instancia de la base de datos se actualizó correctamente';
        $dataView['instancia'] = $statusConnection;
        $dataView['host'] = $instancia->host;
        $content = $this->load->view('mgr/successInstancia' , $dataView, TRUE);

      }
      else{//si no se regreso un id, lanzamos error, que debe ser cachado por la funcion llamadora
        throw new Exception("Se produjo un error al almacenar la instancia, por favor reintente");
      }
    }

    $data = [
      'header'=> ['title' => 'Instancias', 
        'stylesheets'=> [
          // "public/lib/datatables.net-dt/css/jquery.dataTables.min.css",
        ]
      ],
      'aside'=> ['adminSistemas' => 'active'],
      'footer'=> [
        'scripts'=> [
          "public/mgr/updateInstancia.js",
        ]
      ],
      'nav'=> compact('breadcrumbMain', 'breadcrumbSecondary'),
      'body'=> $content,
    ];
    
    $this->markup->laucherView($data); 

  }

  protected function createInstancia(){

    $this->load->helper('form');
    $this->load->library('form_validation');

    $breadcrumbMain = 'Instancias';
    $breadcrumbSecondary = 'Crear';

    $rules = $this->getRulesForm('createInstancia');

    $this->form_validation->set_rules( $rules );

    if ( $this->form_validation->run() === FALSE ){

      $dataView['title'] = 'Agregar Instancia';
      $dataView['titleForm'] = 'Alta de Instancias en el sistema';
      
      $content = $this->load->view('mgr/formInstancia' , $dataView, TRUE);
    
    }
    else{

      $this->load->model('dash/InstanciaModel', 'dbhost');

      $datos = [
        'nombre'=> $this->input->post('nombre', TRUE),
        'host'=> $this->input->post('host', TRUE),
        'database'=> $this->input->post('dbname', TRUE),
        'password'=> $this->input->post('pass', TRUE),
        'descripcion'=> $this->input->post('des', TRUE),
        'user'=> $this->input->post('user', TRUE),
      ];

      if( ( $insert_id = $this->dbhost->create( $datos ) ) !== FALSE ){//si se almaceno correctamente, me regresa el id
        $instancia = $this->dbhost->getInstancia( ['id'=> $insert_id] );//recupero la instancia recien guardada o false en cado de error
        if( $instancia === FALSE ){
          throw new Exception("Error al recuperar la instancia recien almacenada", 1);
        }

        //verifico si me puedo conectar o no conectar
        $this->load->helper('custom');//cargo mis helper
        $statusConnection = connection_native( $instancia->host, $instancia->user, $instancia->password, $instancia->database );

        $dataView['title'] = 'Instancia';
        $dataView['msg'] = 'La instancia de la base de datos se almacenó correctamente';
        $dataView['instancia'] = $statusConnection;
        $dataView['host'] = $instancia->host;
        $content = $this->load->view('mgr/successInstancia' , $dataView, TRUE);


      }
      else{//si no se regreso un id, lanzamos error, que debe ser cachado por la funcion llamadora
        throw new Exception("Se produjo un error al almacenar la instancia, por favor reintente");
      }
    }

    $data = [
      'header'=> ['title' => 'Instancias', 
        'stylesheets'=> [
          // "public/lib/datatables.net-dt/css/jquery.dataTables.min.css",
        ]
      ],
      'aside'=> ['adminSistemas' => 'active'],
      'footer'=> [
        'scripts'=> [
          // "public/lib/datatables.net/js/jquery.dataTables.min.js",
          // "public/lib/datatables.net-dt/js/dataTables.dataTables.min.js",
        ]
      ],
      'nav'=> compact('breadcrumbMain', 'breadcrumbSecondary'),
      'body'=> $content,
    ];
    
    $this->markup->laucherView($data); 


  }

  protected function obtenerInstancias(){

    $breadcrumbMain = 'Instancias';
    $breadcrumbSecondary = 'Listado';

    $dataView = [];

    $content = $this->load->view('mgr/instancias' , $dataView, TRUE);

    $data = [
      'header'=> ['title' => 'Instancias', 
        'stylesheets'=> [
          // "public/lib/datatables.net-dt/css/jquery.dataTables.min.css",
        ]
      ],
      'aside'=> ['adminSistemas' => 'active'],
      'footer'=> [
        'scripts'=> [
          "public/lib/datatables.net/js/jquery.dataTables.min.js",
          "public/lib/datatables.net-dt/js/dataTables.dataTables.min.js",
        ]
      ],
      'nav'=> compact('breadcrumbMain', 'breadcrumbSecondary'),
      'body'=> $content,
    ];
    
    $this->markup->laucherView($data);

  }

  //JSON de instancias
  public function getInstancias(){

    $this->load->model('dash/Instancias');
    $r = $this->Instancias->getAll();
    foreach ($r as &$item){
      unset( $item->password );
    }
    echo json_encode( $r );
  }

  protected function deleteInstancia(int $id){
    $this->load->model('dash/InstanciaModel', 'host');

    $instancia = $this->host->getInstancia( ['id'=> $id] );
    
    if( $instancia ){
      if( $this->host->delete($id) )
        echo json_encode(['status'=> 1, 'msg'=> 'La instancia se elimino correctamente']);
      else
        echo json_encode(['status'=> 0, 'msg'=> 'La instancia no pudo eliminarse, por favor reintente']);
    }
    else{
      echo json_encode(['status'=> 0, 'msg'=> 'La instancia es invalida']);
    }
  }


  //recupera la informacion de una sola instancia por id
  public function instancia( int $id ){

    $response = [];
    if( ( $id = filter_var($id, FILTER_VALIDATE_INT ) ) === FALSE ){
      $response = ['status'=> 0, 'msg'=> 'La instancia es invalida'];
    }
    else{
      $this->load->model('dash/InstanciaModel', 'host');
      if( ( $instancia = $this->host->getInstancia( ['id'=> $id] ) ) !== FALSE ){
        unset( $instancia->password );
        $response = ['status'=> 1, 'msg'=> 'Ok', 'data'=> $instancia];
      }
      else{
        $response = ['status'=> 0, 'msg'=> 'No se pudo obtener el usuario'];
      }
    }
    echo json_encode( $response );
  }


}
