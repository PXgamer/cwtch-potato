<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Installer extends CI_Migration
{

    public function up()
    {
        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'BIGINT',
                'unique' => true,
                'auto_increment' => true
            ),
            'option' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'unique' => true
            ),
            'value' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000'
            )
        );
        $this->dbforge->add_field($fields);
        if ($this->dbforge->create_table('options', true)) {
            $data = [
                [
                    'option' => 'is_installed',
                    'value' => true
                ],
                [
                    'option' => 'trakt_client_id',
                    'value' => ''
                ],
                [
                    'option' => 'trakt_client_secret',
                    'value' => ''
                ],
                [
                    'option' => 'igdb_key',
                    'value' => ''
                ],
                [
                    'option' => 'tmdb_key',
                    'value' => ''
                ],
                [
                    'option' => 'tmdb_poster_size',
                    'value' => 1
                ],
            ];

            $this->db->insert_batch('options', $data);
        }

        $user_fields = array(
            'id' => array(
                'type' => 'BIGINT',
                'unique' => true,
                'auto_increment' => true
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'unique' => true
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => true
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000'
            ),
            'salt' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000'
            ),
            'is_deleted' => array(
                'type' => 'INT',
                'constraint' => '11',
                'default' => 0
            ),
            'created' => array(
                'type' => 'BIGINT'
            ),
            'trakt_token' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => true
            )
        );
        $this->dbforge->add_field($user_fields);
        $password = md5(uniqid('_CwtchPotato_'));

        if ($this->dbforge->create_table('users', true)) {
            $this->u->attemptRegister('admin@example.com', 'admin', $password);
        }

        $services_fields = array(
            'id' => array(
                'type' => 'BIGINT',
                'unique' => true,
                'auto_increment' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '500'
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'null' => true
            ),
            'base_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '500'
            ),
            'configured' => array(
                'type' => 'INT',
                'constraint' => '11',
                'default' => 0
            )
        );
        $this->dbforge->add_field($services_fields);
        $this->dbforge->create_table('services', true);

        $view = "<div class='alert alert-success'>
                    <p>Successfully set up Cwtch Potato tables.</p>
                    <ul>
                        <li>Username: admin</li>
                        <li>Password: $password</li>
                    </ul>
                 </div>";

        $this->load->view('include/template', array('view' => $view, '_user' => U::$default_user));
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
        $this->dbforge->drop_table('services');
        $this->dbforge->drop_table('options');
    }
}