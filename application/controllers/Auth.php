<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $_user;

    function __construct()
    {
        parent::__construct();

        $this->_user = $this->u->getUserFromSession();

        $this->_is_ajax = isset($_POST['is_ajax']);
    }

    public function index()
    {
        redirectDie('/auth/login/');
    }

    public function login()
    {
        if ($this->_user->id > 0) {
            redirectDie('/');
        }

        $data = new stdClass;
        if ($_POST) {
            $username = $_POST['username'] ? $_POST['username'] : '';
            $password = $_POST['password'] ? $_POST['password'] : '';
            if ($user_id = $this->u->attemptLogin($username, $password)) {
                $this->u->loginUser($user_id);
                redirect('/');
            } else {
                $data->username = $username;
            }
        }

        $view = $this->load->view('auth/login', array('data' => $data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }

    public function logout()
    {
        $this->u->logoutUser();
    }
}
