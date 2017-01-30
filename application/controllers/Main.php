<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
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
        $_data = [];
        $tokens['tmdb'] = $this->config->item('tmdb_key');
        if ($tokens['tmdb'] !== '') {
            $token = new \Tmdb\ApiToken($tokens['tmdb']);
            $tmdb = new \Tmdb\Client($token);

            $_data['tmdb']['config'] = $tmdb->getConfigurationApi()->getConfiguration();

            $_data['tmdb']['results']['movies'] = $tmdb
                ->getDiscoverApi()
                ->discoverMovies([
                    'page' => 1,
                    'language' => 'en'
                ]);
            $_data['tmdb']['results']['tv_shows'] = $tmdb
                ->getDiscoverApi()
                ->discoverTv([
                    'page' => 1,
                    'language' => 'en'
                ]);
        }

        $view = $this->load->view('index', array('_user' => $this->_user, '_data' => $_data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }
}
