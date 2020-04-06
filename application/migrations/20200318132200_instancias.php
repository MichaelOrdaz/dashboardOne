<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_instancias extends CI_Migration {

  public function up()
  {
    
    //////////////////////////////////////////////////////////////////////////////////////////////////
    //creo una tabla para almacenar las instancias que en teoria deben existir y se deben gestionar //
    //////////////////////////////////////////////////////////////////////////////////////////////////

    $this->dbforge->add_field('id');
    //creas mas campo
    $this->dbforge->add_field(
      array(
        'nombre' => 
          array(
            'type' => 'VARCHAR',
            'constraint' => '150',
          ),
        'host' => 
          array(
            'type' => 'VARCHAR',
            'constraint' => '30',
          ),
        'password'=>[
          'type'=> 'varchar',
          'constraint' => '30',
        ],
        'user'=>[
          'type'=> 'varchar',
          'constraint' => '30',
        ],
        'database'=>[
          'type'=> 'varchar',
          'constraint' => '200',
        ],
        'descripcion'=> [
          'type'=> 'TEXT',
        ],
        'public_ip'=> [
          'type'=> 'varchar',
          'constraint'=> '30',
        ],
        'created_at datetime default current_timestamp',
        'updated_at datetime default current_timestamp on update current_timestamp',
        'status' => 
          array(
            'type' => 'tinyint',
            'constraint' => '1',
            'default'=> '1'
        ),
      )
    );

    $this->dbforge->create_table('instancias', TRUE);

    //ingresar las instancias que ya existen y entan funcionando
    $data = [
      [
        'nombre' => 'Instancia 100 (192.168.0.100)',
        'host' => '192.168.0.100',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:9010'
      ],
      [
        'nombre' => 'Instancia 101 (192.168.0.101)',
        'host' => '192.168.0.101',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:8090'
      ],
      [
        'nombre' => 'Instancia 102 (192.168.0.102)',
        'host' => '192.168.0.102',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:9030'
      ],
      [
        'nombre' => 'Instancia 103 (192.168.0.103)',
        'host' => '192.168.0.103',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:8080'
      ],
      [
        'nombre' => 'Instancia 104 (192.168.0.104)',
        'host' => '192.168.0.104',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:9090'
      ],
      [
        'nombre' => 'Instancia 105 (192.168.0.105)',
        'host' => '192.168.0.105',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:9040'
      ],
      [
        'nombre' => 'Instancia 106 (192.168.0.106)',
        'host' => '192.168.0.106',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:9050'
      ],
      [
        'nombre' => 'Instancia 249 (192.168.0.249)',
        'host' => '192.168.0.249',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:8050'
      ],
      [
        'nombre' => 'Instancia 250 (192.168.0.250)',
        'host' => '192.168.0.250',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:8070'
      ],
      [
        'nombre' => 'Instancia 251 (192.168.0.251)',
        'host' => '192.168.0.251',
        'user' => 'application',
        'password' => 'Application123',
        'database' => 'Legal',
        'descripcion' => '',
        'public_ip'=> '201.168.151.77:8060'
      ],
    ];

    $this->db->insert_batch('instancias', $data );

  }

  public function down()
  {
    $this->dbforge->drop_table('instancias', TRUE);
  }

}