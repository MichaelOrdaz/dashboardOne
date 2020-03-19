<?php

/**
 * esta clase solo se encargara de lanzar las vista principales que tengo en el sistema, recibir los datos y lanzar 
 */
class Markup
{
  
  protected $CI;

  public function __construct(){
    
    $this->CI =& get_instance();
  
  }


  public function laucherView( $data ){

    //aqui siemrpe recupero la info de los host (instancias )
    //para colocarlas en el menu aside bar y siempre esten presentes
    //
    $this->CI->load->model('dash/Instancias');
    $instancias = $this->CI->Instancias->getAll();

    $data['aside']['instancias'] = $instancias;//array_column($instancias, 'host');


    $header = $this->CI->load->view('base/header.php' , $data['header'] ?? '', TRUE);

    $aside = $this->CI->load->view('base/aside.php' , $data['aside'] ?? '', TRUE);

    $footer = $this->CI->load->view('base/footer.php' , $data['footer'] ?? '', TRUE);
    
    $data['nav']['body'] = $data['body'] ?? '';
    $nav = $this->CI->load->view('base/nav.php', $data['nav'] ?? '', TRUE);

    $this->CI->load->view('base/layout', compact('header', 'aside', 'nav', 'footer') );

 

  }


}