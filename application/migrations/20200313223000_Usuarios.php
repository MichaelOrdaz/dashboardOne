<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Usuarios extends CI_Migration {

  public function up()
  {
    
    ///////////////////////////////////
    // creacion de la tabla usuarios //
    ///////////////////////////////////

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
        'paterno' => 
          array(
            'type' => 'VARCHAR',
            'constraint' => '80',
          ),
        'materno' => 
          array(
            'type' => 'VARCHAR',
            'constraint' => '80',
          ),
        'roles'=> [
          'type'=> 'VARCHAR',
          'constraint'=> '255',
        ],
        'correo' => 
          array(
            'type' => 'varchar',
            'constraint' => '150',
            'unique'=> TRUE,
        ),
        'username' => 
          array(
            'type' => 'varchar',
            'constraint' => '80',
        ),
        'genero' => 
          array(
            'type' => 'varchar',
            'constraint' => '30',
        ),
        'pass' => 
          array(
            'type' => 'varchar',
            'constraint' => '255',
        ),
        'direccion' => 
          array(
            'type' => 'varchar',
            'constraint' => '200',
        ),
        'telefono' => 
          array(
            'type' => 'varchar',
            'constraint' => '30',
        ),
        'celular' => 
          array(
            'type' => 'varchar',
            'constraint' => '30',
        ),
        'created_at datetime default current_timestamp',
        'updated_at datetime default current_timestamp on update current_timestamp',
        'status' => 
          array(
            'type' => 'tinyint',
            'constraint' => '1',
        )
      )
    );

    $this->dbforge->create_table('usuarios', TRUE);
  }

  public function down()
  {
    $this->dbforge->drop_table('usuarios', TRUE);
  }

}