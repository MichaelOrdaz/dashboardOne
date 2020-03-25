<?php

/*
* Ayudantes creados por Michael Ordaz Martinez, para crear funciones propias
* 
*/


if ( ! function_exists('my_message'))
{
  /**
   * my_message
   *
   * muestra un mensaje
   * preffix y suffix son las partes que envolveran al mensaje
   * 
   * @param string msg
   * @param preffix
   * @param suffix
   * @return string html formado o no
   */
  function my_message(string $msg, string $preffix = '', string $suffix = '')
  {
    if( empty($msg) )
      return '';

    //si estan establecidos preffix y sufffix envolvemos el mensaje
    if( ! empty($suffix) && ! empty($preffix) ){
      return $preffix . $msg . $suffix;
    }
    else{
      return $msg;
    }

  }
}


if ( ! function_exists('wrapper_message'))
{
  /**
   * wrapper_message
   *
   * crea un mensaje envuelto en un unico elemento html
   * attr es un array o un string que seran los atributos que se le colocaran al elemento que lo elvuelve
   * 
   * @param string msg
   * @param string elemento html
   * @param mixed atributos del elemento
   * @return string html formado
   */
  function wrapper_message(string $msg, string $domElement,  $attr)
  {

    if( empty($msg) )
      return '';

    $attrib = '';
    if( is_array( $attr ) ){
      foreach ($attr as $key => $value)
        $attrib .= "{$key}='{$value}'";
    }
    
    return "<{$domElement} {$attrib}> {$msg} </{$domElement}>";

  }
}

if ( ! function_exists('connection_native') ){

  /**
   * [connection_native realizaa uuna conexion a la base de datos con php puro para controlar los mensaje de error oo exito con la conexion proporcionada, si la conexion fue exitosa regresa un Array con los datos de la conexion, si falla, regresa el string error]
   * @param  [string] $host   [host a conectar]
   * @param  [string] $user   [usaurio de la base de datos]
   * @param  [string] $pass   [contraseña]
   * @param  [string] $dbname [base de datos]
   * @return [mixed]          [array en cado de exito, string en caso de error]
   */
  function connection_native( $host, $user, $pass, $dbname ){

    /* Conectar a una base de datos de MySQL invocando al controlador */
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
    $usuario = $user;
    $contraseña = $pass;

    try {
      $gbd = new PDO($dsn, $usuario, $contraseña);
      $attributes = array(
        "CONNECTION_STATUS", "SERVER_INFO", "SERVER_VERSION"
      );

      $connectionAttribute = [];
      foreach ($attributes as $val) {
        $connectionAttribute["PDO::ATTR_$val:"] = $gbd->getAttribute(constant("PDO::ATTR_$val"));
      }
      return $connectionAttribute;
    }
    catch (PDOException $e) {
      return $e->getMessage();
    }

  }


}


