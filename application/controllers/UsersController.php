<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('UserModel', 'User');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->auth->logged();
    }

    //@desc     show users table
    //@route    GET admin/users
    public function users($roleId)
    {
        $data['role'] = $this->BM->getById("roles", $roleId);
        $this->load->view('admin/users/users', $data);
    }

    //@desc     show data users table
    //@route    GET admin/users/users-table
    public function usersTable($roleId)
    {
        $querySelector = [
            "1" => "user-admin",
            "2" => "user-user",
        ];

        $role = $this->BM->getById("roles", $roleId);
        $users = $this->datatables->setDatatables(
            "users",
            [
                "columns" => ["id", "name", "email", "created_at"],
                "searchable" => ['name', 'email'],
                "actions" => "admin/actions/edit-delete",
                "delete_message" => [
                    'name' => "Yakin ingin menghapus [name] pada data $role->display_name",
                ],
                "middleware" => [
                    "created_at" => "toDateTime"
                ],
                "querySelector" => $querySelector[$roleId]
            ]
        );
        json($users);
    }

    //@desc     users create view
    //@route    GET admin/users/users/create
    public function create($roleId)
    {
        $roles = $this->BM->getWhere("roles", ['id' => $roleId]);
        $data['roles'] = $roles->result();
        $data['role'] = $roles->row();
        $this->load->View('admin/users/create', $data);
    }

    //@desc     users create action
    //@route    POST admin/users/add
    public function add()
    {
        $post = getPost();
        $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
        $user = $this->User->create($post);
        if ($user) {
            appJson([
                "message" => "Berhasil menambah data Pengguna",
            ]);
        }
    }

    //@desc     users update view
    //@route    GET admin/users/:userId/edit
    public function edit($id)
    {
        $user = $this->BM->checkById("users", $id);
        $data = [
            "user" => $user,
            "role" => $this->BM->getById("roles", $user->role),
            "roles" => $this->BM->getAll("roles")->result()
        ];
        $this->load->view('admin/users/edit', $data);
    }

    //@desc     users update action
    //@route    POST admin/users/:userId/update
    public function update($id)
    {
        $post = getPost();
        $user = $this->User->update($id, $post, $validate = ['name', 'email']);
        if ($user) {
            appJson([
                "message" => "Berhasil mengubah data Pengguna",
            ]);
        }
    }

    //@desc     users delete action
    //@route    GET admin/users/:userId/delete
    public function delete($id)
    {
        $this->BM->deleteById("users", $id);
        appJson($id);
    }
}
