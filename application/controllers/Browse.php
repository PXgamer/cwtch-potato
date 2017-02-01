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

    public function index()
    {
        $_data = [
            'movies' => (C::$TMDB_KEY !== '' ? true : false),
            'tv' => (C::$TMDB_KEY !== '' ? true : false),
            'games' => (C::$IGDB_KEY !== '' ? true : false),
        ];

        $view = $this->load->view('browse/index', array('_user' => $this->_user, '_data' => $_data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }

    public function movies()
    {
        $_data = [];
        $_data['title'] = 'Movies';

        $page_num = $this->uri->segment(3) ?? 1;

        $tokens['tmdb'] = C::$TMDB_KEY;
        if ($tokens['tmdb'] ?? '' !== '') {
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
            'per_page' => 20,
            'total_rows' => $_data['tmdb']['results']['movies']['total_results'] ?? null,
            'cur_page' => $page_num
        ));

        $view = $this->load->view('browse/browse', array('_user' => $this->_user, '_data' => $_data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }

    public function tv()
    {
        $_data = [];
        $_data['title'] = 'TV Shows';

        $page_num = $this->uri->segment(3) ?? 1;

        $tokens['tmdb'] = C::$TMDB_KEY;
        if ($tokens['tmdb'] ?? '' !== '') {
            $token = new \Tmdb\ApiToken($tokens['tmdb']);
            $tmdb = new \Tmdb\Client($token);

            $_data['tmdb']['config'] = $tmdb->getConfigurationApi()->getConfiguration();

            $_data['tmdb']['results']['tv'] = $tmdb
                ->getDiscoverApi()
                ->discoverTv([
                    'page' => $page_num,
                    'language' => 'en'
                ]);
        }
        $this->paginator->initialize(array(
            'base_url' => "/browse/tv/",
            'per_page' => 20,
            'total_rows' => $_data['tmdb']['results']['tv']['total_results'] ?? null,
            'cur_page' => $page_num
        ));

        $view = $this->load->view('browse/browse', array('_user' => $this->_user, '_data' => $_data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }

    public function games()
    {
        $_data = [];
        $_data['title'] = 'Games';

        $page_num = $this->uri->segment(3) ?? 1;

        $tokens['igdb'] = C::$IGDB_KEY;
        if ($tokens['igdb'] ?? '' !== '') {
            $igdb = new \YnotnA\Igdb\IgdbApi($tokens['igdb']);

            $_data['igdb']['results']['games'] = $igdb->getGames(null, [], 20, $page_num);
        }
        $this->paginator->initialize(array(
            'base_url' => "/browse/games/",
            'per_page' => 20,
            'total_rows' => 25000 ?? null,
            'cur_page' => $page_num
        ));

        $view = $this->load->view('browse/browse', array('_user' => $this->_user, '_data' => $_data), true);
        $this->load->view('include/template', array('view' => $view, '_user' => $this->_user));
    }
}
