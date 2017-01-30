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
    }

    public function services()
    {
        $_data = null;

        if ($this->_user->id > 0) {
            $_data['services'] = $this->db->select('*')
                ->from('services')
                ->get()
                ->result();
        }

        $view = $this->load->view('services/index', array('_user' => $this->_user, '_data' => $_data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }
}