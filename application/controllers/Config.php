<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller
{
    private $_user;

    function __construct()
    {
        parent::__construct();

        $this->_user = $this->u->getUserFromSession();

        $this->_is_ajax = isset($_POST['is_ajax']);
        if ($this->_user->id < 1) {
            redirectDie('/');
        }
    }

    public function index()
    {
        $view = $this->load->view('admin/index', array('_user' => $this->_user), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }

    public function services()
    {
        $_data = null;

        $_data['services'] = $this->db->select('*')
            ->from('services')
            ->get()
            ->result();

        $view = $this->load->view('admin/services', array('_user' => $this->_user, '_data' => $_data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }
}