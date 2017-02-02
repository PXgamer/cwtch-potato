<?php

class C extends CI_Model
{
    public static $IS_INSTALLED;
    public static $TRAKT_CLIENT_ID;
    public static $TRAKT_CLIENT_SECRET;
    public static $IGDB_KEY;
    public static $TMDB_KEY;
    public static $TMDB_POSTER_SIZE;

    function __construct()
    {
        parent::__construct();

        if ($this->db->table_exists('options')) {
            $results = $this->db->select("*")
                ->from("options")
                ->get()
                ->result_array();
            foreach ($results as $result) {
                $option = strtoupper($result['option']);
                self::${$option} = $result['value'];
            }
        }
    }
}