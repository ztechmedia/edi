<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->helper("utility");
        $this->auth->auth();
    }

    //@desc     load login view
    //@route    GET /login
    public function login()
    {
        $data["view"] = "auth/login";
        $this->load->view("template/auth/app", $data);
    }

    //@desc     login logic to verify users
    //@route    GET auth/login
    public function authLogin()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        if (strlen($email) <= 0) {
            appJson(["errors" => ["email" => "Email tidak boleh kosong"]]);
        }

        if (strlen($password) <= 0) {
            appJson(["errors" => ["password" => "Password tidak boleh kosong"]]);
        }

        $user = $this->BM->getWhere("users", ["email" => $email])->row();
        if (!$user) {
            appJson(["errors" => [
                "email" => "Email tidak terdaftar",
            ]]);
        }

        if (!password_verify($password, $user->password)) {
            appJson(["errors" => [
                "password" => "Password tidak cocok",
            ]]);
        }

        $role = $this->BM->getById("roles", $user->role);

        $session = array(
            "userId" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "role" => $role->name,
        );

        $this->session->set_userdata(SESSION_KEY, $session);

        $url = $role->id == 1 ? 'admin/users/1' : 'admin/users/2';

        appJson([
            "success" => true,
            "type" => "login",
            "redirect" => base_url("admin"),
            "currentUrl" => base_url($url),
        ]);
    }

    //@desc     load register view
    //@route    GET /register
    public function register()
    {
        $data["view"] = "auth/register";
        $this->load->view("template/auth/app", $data);
    }

    //@desc     register logic to create new member
    //@route    GET auth/register
    public function authRegister()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $confirm = $this->input->post("confirm");

        if (strlen($email) <= 0) {
            appJson(["errors" => ["email" => "Email tidak boleh kosong"]]);
        }

        if (strlen($password) <= 0) {
            appJson(["errors" => ["password" => "Password tidak boleh kosong"]]);
        }

        if (strlen($confirm) <= 0) {
            appJson(["errors" => ["confirm" => "Konfirmasi password tidak boleh kosong"]]);
        }

        $checkEmail = $this->BM->getWhere("users", ["email" => $email])->row();
        if ($checkEmail) {
            appJson(["errors" => [
                "email" => "Email sudah terdaftar",
            ]]);
        }

        if ($password !== $confirm) {
            appJson(["errors" => [
                "confirm" => "Konfirmasi password tidak sama",
            ]]);
        }

        $data = [
            "email" => $email,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "role" => 2,
        ];

        $role = $this->BM->getById("roles", 2);
        $user = $this->BM->createForId("users", $data);
        
        $session = array(
            "userId" => $user,
            "email" => $email,
            "role" => $role->name,
        );

        $databio = [
            "user_id" => $user,
            "email" => $email,
        ];

        $biodata = $this->BM->create("biodata", $databio);
        if($biodata) {
            $this->session->set_userdata(SESSION_KEY, $session);
        
            appJson([
                "success" => true,
                "type" => "register",
                "redirect" => base_url("admin/users/2"),
            ]);
        }
    }
}
