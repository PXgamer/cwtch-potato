<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends CI_Controller
{
    private $_user;

    function __construct()
    {
        parent::__construct();

        $this->_user = $this->u->getUserFromSession();

        $this->_is_ajax = isset($_POST['is_ajax']);
    }

    public function movies()
    {
        $page_num = $this->uri->segment(3) ?? 1;

        $_data = [];
        $tokens['tmdb'] = $this->config->item('tmdb_key');
        if ($tokens['tmdb'] !== '') {
            $token = new \Tmdb\ApiToken($tokens['tmdb']);
            $tmdb = new \Tmdb\Client($token);

            $_data['tmdb']['config'] = $tmdb->getConfigurationApi()->getConfiguration();

            $_data['tmdb']['results']['movies'] = $tmdb
                ->getDiscoverApi()
                ->discoverMovies([
                    'page' => $page_num,
                    'language' => 'en'
                ]);
        }

        $this->paginator->initialize(array(
            'base_url' => "/browse/movies/",
            'per_page' => 10,
            'total_rows' => 1000000,
            'cur_page' => $page_num
        ));

        $view = $this->load->view('browse/index', array('_user' => $this->_user, '_data' => $_data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }
}
