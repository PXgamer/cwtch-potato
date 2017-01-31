<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller
{
    private $_user;

    function __construct()
    {
        parent::__construct();

        $this->_user = $this->u->getUserFromSession();

        if (file_exists('application/core/is_setup')) {
            redirectDie('/');
        }
    }

    public function index()
    {
        if ($_POST ?? false) {
            $this->load->dbforge();

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
            if ($this->dbforge->create_table('users')) {
                $this->u->attemptRegister($_POST['email'], $_POST['username'], $_POST['password']);
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
            $this->dbforge->create_table('services');

            file_put_contents('application/core/is_setup', null);
            redirectDie('/');
        }

        $view = $this->load->view('install/index', [], true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }
}
