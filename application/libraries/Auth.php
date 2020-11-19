<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth
{
    protected $ci;

    public $userId;
    public $name;
    public $email;
    public $role;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->me();
    }

    public function logged()
    {
        if (!$this->ci->session->userdata(SESSION_KEY)) {
            redirect("login");
        }
    }

    public function auth()
    {
        if ($this->ci->session->userdata(SESSION_KEY)) {
            redirect("admin");
        }
    }

    public function me()
    {
        if ($this->ci->session->userdata(SESSION_KEY)) {
            $this->userId = $_SESSION[SESSION_KEY]["userId"];
            $this->name = array_key_exists("name", $_SESSION[SESSION_KEY]) ? $_SESSION[SESSION_KEY]['name'] : "Anonimous";
            $this->email = $_SESSION[SESSION_KEY]["email"];
            $this->role = $_SESSION[SESSION_KEY]["role"];
        }
    }
}
