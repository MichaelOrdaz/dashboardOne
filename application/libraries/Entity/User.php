<?php
defined('BASEPATH') OR exit('No se permite el acceso directo al script');
  
class User {

  public $id;
  public $username;
  public $nombre;
  public $paterno;
  public $materno;
  public $telefono;
  public $roles;
  protected $pass;
  public $genero;
  public $direccion;
  public $correo;
  public $celular;
  public $status;
  public $created_at;
  public $updated_at;

  protected $CI;

  public function __construct(){
    $this->CI =& get_instance();
  }

  public function __set( $key, $value ){
    $propAllowed = ['id', 'username', 'nombre', 'paterno', 'materno', 'telefono', 'roles', 'pass', 'genero', 'direccion', 'correo', 'celular', 'status', 'created_at', 'updated_at'];
    if( in_array($key, $propAllowed) ){

      if( $key === 'roles' ){
        $this->{$key} = json_decode( $value );
      }
      else if( $key === 'created_at' || $key === 'updated_at' ){
        $this->{$key} = new DateTime($value);
      }

      return $this;
    }
    else{
      return false;
    }

  }

  public function __get($key){

    if( isset( $this->{$key} ) ){
      return $key;
    }
    return false;
  }


    public function verifyPass( $plain ){
    
    // $plain = 'fucho76';

    //hashing
    // $pass = password_hash($plain, PASSWORD_DEFAULT);
    // $info = password_get_info($pass);

    $verify = password_verify($plain, $this->pass);
    return $verify;
    // var_dump( $pass );
    // var_dump( $info );

    // var_dump($verify ? 'TRUE': 'FALSE');
    

  }




}
