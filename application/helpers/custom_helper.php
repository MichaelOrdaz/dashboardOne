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