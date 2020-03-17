<?php
defined('BASEPATH') OR exit('No se permite el acceso directo al script');
  
class User {

  protected $id;
  public $username;
  public $nombre;
  public $paterno;
  public $materno;
  public $telefono;
  public $roles = array();
  protected $pass;
  public $genero;
  public $direccion;
  public $correo;
  public $celular;
  public $status;
  public $created_at;
  public $updated_at;

  protected $CI;

  public function __construct( $data ){
    
    $this->CI =& get_instance();
    //data debe ser un objeto o un array asociativo
    $property_allowed = ['id', 'username', 'nombre', 'paterno', 'materno', 'telefono', 'roles', 'pass', 'genero', 'direccion', 'correo', 'celular', 'status', 'created_at', 'updated_at'];

    foreach ($data as $key => $val) {
      
      if( in_array($key, $property_allowed) ){//si la propiedad esta permitida en el objeto
        
        if( $key === 'roles' ){
          $this->{$key} = json_decode( $val );
          continue;
        }
        else if( $key === 'created_at' || $key === 'updated_at' ){
          $this->{$key} = new DateTime( $val );
          continue;
        }

        $this->{$key} = $val;
      }

    }

  }
      

  public function getId(){
    return $this->id;
  }

  public function getPass(){
    return $this->pass;
  }
  
  /**
   * [save_session guarda en variables de SESSION php, los valores del usuario]
   * @return [void];
   */
  public function save_session():void{
    $this->CI->session->dash_user = $this->username;
    $this->CI->session->dash_nombre = $this->nombre;
    $this->CI->session->dash_paterno = $this->paterno;
    $this->CI->session->dash_materno = $this->materno;
    $this->CI->session->dash_roles = $this->roles;
  }

  /**
   * [verifyPass comprueba la igualdad de la contraseña dada por un usuario contra la contraseña almacenada en base de datos de ese usuario]
   * @param  [string] $plain [contraseña ingresada en texto plano]
   * @return [bool] true si la contraseña es identica, false de lo contrario 
   */
  public function verifyPass( $plain ){
    
    //hashing
    $verify = password_verify($plain, $this->pass);
    return $verify;

  }

  /**
   * [asignarPass asigna una contraseña a una instancia del objeto usuario]
   * @param  string $mode [string con valores auto, false, o false]
   * @param  string $pass [description]
   * @return [type]       [description]
   */
  public function asignarPass( string $mode = 'auto', string $pass = '' ){

    if( 'auto' === $mode ){
      $this->load->helper('string');
      $pass = random_string('alnum', 8);
    }
    $this->pass = $this->generatePass($pass);

  }


  /**
   * [generatePass genera el hash de la contraseña dada]
   * @param  string $plainTxt [la contrasela en texto plano]
   * @return string la contraseña hasheada
   */
  protected function generateHash( $plainTxt ): string{
    // apply hash
    $pass = password_hash($this->pass, PASSWORD_DEFAULT);
    $info = password_get_info($pass);
    return $pass;
  }






}
