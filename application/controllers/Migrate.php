<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{

  public function __construct(){
    parent::__construct();
    $this->load->library('migration');
  }

  public function index(){

    $migration_actual = '';

    $result = $this->db->get('migrations');
    if( $this->db->affected_rows() > 0 ){

      $current = $result->row()->version;
      $fecha = DateTime::createFromFormat('YmdHis', $current);
      $migration_actual = "Versión {$fecha->format('l Y-F-d h:i:s a')}";
    
    }
    else{
      $migration_actual = 'No se ha establecido ninguna migración';
    }

    echo "Las siguientes migraciones estan disponibles, <br> 
    para aplicar <b>hasta</b> una migración, seleccionala para su ejecución <br>";
   
    echo "<b> Migración actual: {$migration_actual} </b>";
    echo "<hr>";

    $migrations = $this->migration->find_migrations();

    if( count( $migrations ) > 0 ){
      echo "<table border='1'>";
      echo "<thead>
        <tr>
        <th>Timestamp</th>
        <th>Fecha</th>
        <th>Migrations File</th>
        <th>Aplicar</th>
      </tr>
      </thead>";
      foreach ($migrations as $key => $value) {
        
        $fecha = DateTime::createFromFormat('YmdHis', $key);

        echo "
          <tr>
            <td> {$key} </td>
            <td> {$fecha->format('l Y-F-d h:i:s a')}  </td>
            <td> ".basename($value, '.php')." </td>
            <td> <a href='".current_url()."/version/{$key}' title='aplicar hasta esta migración'> &#10003; </a>  </td>
          </tr>
        ";
      }
      echo "</table>";

    }
    else{
      echo "No hay migraciones";
    }

  }

  public function current()
  {

    $result = $this->migration->current();

    if ( $result === FALSE)
    {
      show_error($this->migration->error_string());
    }
    else if( $result === TRUE ){
      echo "No se encontro ese migración";
    }
    else{
      echo "Migración {$result} aplicada correctamente";
    } 

    echo " <hr> <a href='".base_url('migrate')."' title='Regresar'> Regresar </a>";

  }

  public function last(){
    $result = $this->migration->lastest();
    if ( $result === FALSE)
    {
      show_error($this->migration->error_string());
    }
    else{
      echo "Ultima migración {$result} en el sistema aplicada correctamente";
    } 

    echo " <hr> <a href='".base_url('migrate')."' title='Regresar'> Regresar </a>";
  }

  public function version( $version = '' ){

    if( $version === '' ){
      echo "migración invalida";
      return;
    }

    $result = $this->migration->version($version);

    if ( $result === FALSE)
    {
      show_error($this->migration->error_string());
    }
    else if( $result === TRUE ){
      echo "No se encontro ese migración";
    }
    else{
      echo "Migración {$result} aplicada correctamente";
    } 

    echo " <hr> <a href='".base_url('migrate')."' title='Regresar'> Regresar </a>";



  }

}