<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_semilla_uno extends CI_Migration {

  public function up()
  {

    //ingresar el primer usuario, administrador
    $data = [
      'id'=> 1,
      'nombre'=> 'administrador',
      'paterno'=> 'admin',
      'materno'=> 'admin',
      'roles'=> '["ROLE_USER", "ROLE_ADMIN"]',
      'correo'=> 'admin@mail.com',
      'username'=> 'admin',
      'genero'=> 'M',
      'pass'=> '$2y$10$SQdhvCU4pE3j07nh3G/bE.hzySIoANovXXfeXZlNZo25t9Qt7UBFq',//fucho76
      'direccion'=> '7 poniente',
      'telefono'=> '',
      'celular'=> '',
      'status'=> 1
    ];

    $this->db->insert('usuarios', $data );

  }

  public function down()
  {
    // $this->dbforge->drop_table('llamadas', TRUE);
    $this->db->delete('usuarios', ['id'=> 1]);
  }

}