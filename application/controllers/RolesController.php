<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RolesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->auth->logged();
    }

    //@desc     show roles tables
    //@route    GET /roles
    public function roles()
    {
        $this->load->view('admin/roles/roles');
    }

    //@desc     show data roles tables
    //@route    GET /roles/roles-table
    public function rolesTable()
    {
        $users = $this->datatables->setDatatables(
            "roles",
            [
                "columns" => ["id", "name", "display_name"],
                "searchable" => ['name', 'display_name'],
            ]
        );
        json($users);
    }
}
