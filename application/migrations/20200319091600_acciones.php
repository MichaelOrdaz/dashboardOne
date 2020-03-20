<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_acciones extends CI_Migration {

  public function up()
  {
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //creo un campos para mi tablas usuarios y instancias, ara colocar todo el historial de acciones que se lleve a cabo sobre un registro, mas que nada, llevar registro de quien lo modifico o quien lo elimino  //
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $this->dbforge->add_column('instancias', [
      'acciones'=> [
        'type'=> 'text',
        'after'=> 'updated_at'
      ]
    ]);

    $this->dbforge->add_column('usuarios', [
      'acciones'=> [
        'type'=> 'text',
        'after'=> 'updated_at'
      ]
    ]);


  }

  public function down()
  {
    $this->dbforge->drop_columns('instacias', 'acciones');
    $this->dbforge->drop_columns('usuarios', 'acciones');
  }

}