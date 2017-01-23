<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
    private $_user;

    public function index()
    {
        $view = $this->load->view('index', array('_user' => $this->_user), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }
}
