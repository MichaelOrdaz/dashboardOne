<?php
/**
 * clase usuario
 */
class Usuario extends CI_Model
{
  

  public function __construct(){
    parent::__construct();

    // $this->load->library('Entity/User');
    // $this->load->library('Entity/User', NULL, 'user');
    // $this->config->load('Entity/User');
  
  }

  public function getUser( array $campos ){

    $data = $this->db->get_where('usuarios', $campos, 1);    
    if( $this->db->affected_rows() > 0 ){
      return $data->row(0);
    }
    else{
      return FALSE;
    }

  }

  //cuando establezca el usaurio, siempre le coloco ROLE_USER
  public function setUser( array $datos ) {
    $datos['roles'] = $this->generateRol( $datos['roles'] );

    $datos['acciones'] = "creador {$this->session->userdata('dash_user')} fecha " . date('Y-m-d H:i:s') . " ip {$this->input->ip_address()},"; 
    $datos['status'] = 1;

    //generar pass
    $infoPass = $this->asignarPass('auto');
    $datos['pass'] = $infoPass['hash'];

    return $this->db->insert('usuarios', $datos) ? $infoPass['pass'] : false;
  
  }

  public function updateUser( int $id, array $datos ): bool {
    
    //si existe el valor roles, lo formateamos correctamente
    if( array_key_exists('roles', $datos) ){
      $datos['roles'] = $this->generateRol( $datos['roles'] );
    }

    $accion = "editor {$this->session->userdata('dash_user')} fecha " . date('Y-m-d H:i:s') . " ip {$this->input->ip_address()},";

    return $this->db->where('id', $id)
      ->set( $datos )
      ->set( 'acciones', "CONCAT(acciones, '{$accion}')", FALSE )
      ->update('usuarios');
  }

  public function deleteUser( int $id ): bool{

    $accion = "elimino {$this->session->userdata('dash_user')} fecha " . date('Y-m-d H:i:s') . " ip {$this->input->ip_address()},";

    return $this->db->where('id', $id)
      ->set( 'status', 0 )
      ->set( 'acciones', "CONCAT(acciones, '{$accion}')", FALSE )
      ->update('usuarios');      
  }

  /*
  genera el rol del usuario como json, agregando siemre el rol de usuario, ya que todo usuario que este registrado es evidentemente un usario, mas el otro tipo de usuario que es.
   */
  protected function generateRol( string $simpleRol ): string{
    $rol = ['ROLE_USER'];
    $rol[] = strtoupper( 'ROLE_' . $simpleRol );
    return json_encode($rol);
  }


  public function getSimpleRol( string $rol ): string{
    $roles = json_decode($rol);
    $i = array_search('ROLE_USER', $roles);
    unset( $roles[$i] );
    $str = implode('', $roles);
    return strtolower( substr($str, 5) );
  }



  /**
   * [asignarPass asigna una contraseña a una instancia del objeto usuario]
   * @param  string $mode [string con valores auto, false, o false]
   * @param  string $pass [description]
   * @return [type]       [description]
   */
  public function asignarPass( string $pass = 'auto' ){

    if( 'auto' === $pass ){
      $this->load->helper('string');
      $pass = random_string('alnum', 8);
    }
    return ['pass'=> $pass, 'hash'=> $this->generateHash($pass)];
  }


  /**
   * [generatePass genera el hash de la contraseña dada]
   * @param  string $plainTxt [la contrasela en texto plano]
   * @return string la contraseña hasheada
   */
  protected function generateHash( $plainTxt ): string{
    // apply hash
    $pass = password_hash($plainTxt, PASSWORD_DEFAULT);
    $info = password_get_info($pass);
    return $pass;
  }




}