<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Ip_publica extends CI_Migration {

  public function up()
  {
    //se añade el campo de ip publica del host de las instancias
    $this->dbforge->add_column('instancias', [
      'public_ip'=> [
        'type'=> 'varchar',
        'constraint'=> 30,
        'after'=> 'database'
      ]
    ]);

  }

  public function down()
  {
    $this->dbforge->drop_column('instancias', 'public_ip');
  }

}