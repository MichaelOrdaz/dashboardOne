<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Roles extends CI_Migration {

  public function up()
  {
    
    ///////////////////////////////////
    // creacion de la tabla roles de usuario //
    ///////////////////////////////////
    ///
    //alter table a la tabla de usuarios
    //pienso guardar aqui un array con roles como un array json

    //crear tabla de prueba para probar las relaciones
    //crear campo id
    $this->dbforge->add_field('id');

    //creas mas campo
    $this->dbforge->add_field(
      array(
        'nombre' => 
          array(
            'type' => 'VARCHAR',
            'constraint' => '150',
          ),
        'telefono' => 
          array(
            'type' => 'VARCHAR',
            'constraint' => '30',
          ),
        'nota'=>[
          'type'=> 'text',
        ],
        'created_at datetime default current_timestamp',
        'updated_at datetime default current_timestamp on update current_timestamp',
        'status' => 
          array(
            'type' => 'tinyint',
            'constraint' => '1',
        ),
        'usuario'=>[
          'type'=> 'int',
        ],
        'constraint usuario foreign key (usuario) references usuarios(id)'
      )
    );

    $this->dbforge->create_table('llamadas', TRUE);

  }

  public function down()
  {
    $this->dbforge->drop_table('llamadas', TRUE);
  }

}