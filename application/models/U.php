<?php

class U extends CI_Model
{
    public static $default_user;

    function __construct()
    {
        parent::__construct();

        self::$default_user = (object)[
            'id' => 0,
            'username' => 'Anonymous'
        ];
    }

    function getUserByName($username = '')
    {
        $user = $this->db->select("*")
            ->from("users")
            ->where("username", $username)
            ->row();

        return $user;
    }

    function getUserByIdHash($id_hash = '')
    {
        return $this->db->select("*")
            ->from("users")
            ->where("id", $id_hash)
            ->row();
    }

    function attemptLogin($username = '', $password = '')
    {
        $account = $this->db->query("SELECT * FROM users WHERE username = ?", array($username))->row();
        if (isset($account->password)) {
            if (password_verify($password . $account->salt, $account->password)) {
                return $account->id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function attemptRegister($email = '', $username = '', $password = '')
    {
        $data = new stdClass;
        if (strlen($username) <= 4) {
            $data->successful = false;
            $data->error = 'Your username must be at least 4 characters long.';
            return $data;
        }
        if (strlen($password) <= 6) {
            $data->successful = false;
            $data->error = 'Your password must be at least 6 characters long.';
            return $data;
        }
        if ($this->db->query("SELECT * FROM users WHERE username = ?", array($username))->num_rows() > 0) {
            $data->successful = false;
            $data->error = 'Username must be unique.';
            return $data;
        }
        if ($this->db->query("SELECT * FROM users WHERE email = ?", array($email))->num_rows() > 0 && $email !== '') {
            $data->successful = false;
            $data->error = 'Email must be unique.';
            return $data;
        }

        // User specific details
        $salt = md5('id_' . $username . uniqid('user_'));
        $password = password_hash($password . $salt, PASSWORD_BCRYPT);

        // Date now
        $date_now = time();

        $insert_users = $this->db->query(
            "INSERT INTO users (
                  username,
                  email,
                  password,
                  salt,
                  created
                  )
                 VALUES 
				  (?, ?, ?, ?, ?)",
            array($username, $email, $password, $salt, $date_now));

        $data->successful = $insert_users ? true : false;
        $data->error = !$insert_users ? 'An unexpected error occurred' : null;
        $data->id = ($data->successful) ? $this->db->select("users.id")
            ->from('users')
            ->where("users.username", $username)
            ->get()
            ->row() : null;

        return $data;
    }

    function generateUserHash($user_id)
    {
        $user_hash = md5('user_' . $user_id . time());

        return $user_hash;
    }

    function getUserData($user_id)
    {
        $user = $this->db->select("users.id, users.username, users.is_deleted, users.email, users.created")
            ->from("users")
            ->where("users.id", $user_id)
            ->get()
            ->row();
        return $user;
    }

    function loginUser($user_id)
    {
        $this->session->set_userdata('user', $this->getUserData($user_id));
    }

    function logoutUser()
    {
        $this->session->unset_userdata('user');
        $this->session->set_userdata('user', self::$default_user);
        redirect('/auth/login/');
    }

    function getUserFromSession()
    {
        if ($this->session->userdata('user') == null) {
            $this->session->set_userdata('user', self::$default_user);
        }
        return $this->session->userdata('user');
    }

}