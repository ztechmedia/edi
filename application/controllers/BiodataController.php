<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BiodataController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->library('Datatables', 'datatables');
        $this->load->library("form_validation");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    //@desc     show biodata table
    //@route    GET admin/biodata
    public function biodata()
    {
        $this->load->view('admin/biodata/biodata');
    }

    //@desc     show data biodata table
    //@route    GET admin/biodata/biodata-table
    public function biodataTable()
    {
        $teachers = $this->datatables->setDatatables(
            "biodata",
            [
                "columns" => ["id", "name", "ttl", "position_applied"],
                "searchable" => ["name", "CONCAT(birth_place,', ',date_format(birth_date, '%d-%m-%Y'))", "position_applied"],
                "actions" => "admin/actions/edit-delete-bio",
                "delete_message" => [
                    'name' => "Yakin ingin menghapus [name] pada data User",
                ],
                "querySelector" => "biodata",
            ]
        );
        json($teachers);
    }

    //@desc     biodata create view
    //@route    GET admin/biodata/:userId/edit
    public function edit($userId)
    {
        $data['user'] = $this->BM->getWhere("biodata", ["user_id" => $userId])->row();
        $this->load->view('admin/biodata/crud', $data);
    }

    //@desc     biodata create action
    //@route    POST admin/biodata/update/:userId
    public function update($userId)
    {
        $post = getPost();
        $post['birth_date'] = revDate($post['birth_date']);
        $bioId = $this->BM->getWhere("biodata", ["user_id" => $userId])->row()->id;
        if (!$this->validator([], $bioId)) {
            appJson(['errors' => $this->form_validation->error_array()]);
        }

        $biodata = $this->BM->update("biodata", $userId, "user_id", $post);
        if ($biodata) {
            $datauser = [
                "name" => $post['name'],
                "email" => $post["email"]
            ];
            $user = $this->BM->updateById("users", $userId, $datauser);
            appJson([
                "message" => "Berhasil memperbarui data",
            ]);
        }
    }

    public function validator($skip = [], $id = null)
    {
        $uniqueNip = $id ? "biodata.nip.$id" : "biodata.nip";
        $uniqueEmail = $id ? "biodata.email.$id" : "biodata.email";

        $rules = [
            "name" => [
                'field' => 'name',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nama tidak boleh kosong',
                ],
            ],
            "position_applied" => [
                'field' => 'position_applied',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Posisi dilamar tidak boleh kosong',
                ],
            ],
            "id_card" => [
                'field' => 'id_card',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nomor KTP tidak boleh kosong',
                ],
            ],
            "birth_place" => [
                'field' => 'birth_place',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Tempat lahir tidak boleh kosong',
                ],
            ],
            "birth_date" => [
                'field' => 'birth_date',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Tanggal lahir tidak boleh kosong',
                ],
            ],
            "blood" => [
                'field' => 'blood',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Golongan darah tidak boleh kosong',
                ],
            ],
            "status" => [
                'field' => 'status',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Status tidak boleh kosong',
                ],
            ],
            "address_id" => [
                'field' => 'address_id',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Alamat KTP tidak boleh kosong',
                ],
            ],
            "email" => [
                'field' => 'email',
                'label' => 'Email',
                'rules' => "required|trim|isUnique[$uniqueEmail]",
                'errors' => [
                    'required' => '* Email tidak boleh kosong',
                    'isUnique' => 'Email sudah digunakan',
                ],
            ],
            "phone" => [
                'field' => 'phone',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nomor telpon tidak boleh kosong',
                ],
            ],
            "closest_person" => [
                'field' => 'closest_person',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Orang terdekat tidak boleh kosong',
                ],
            ],
            "last_education" => [
                'field' => 'last_education',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Pendidikan terkahir tidak boleh kosong',
                ],
            ],
            "skills" => [
                'field' => 'skills',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Skill tidak boleh kosong',
                ],
            ],
            "expected_sallary" => [
                'field' => 'expected_sallary',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Gaji yang diharapkan tidak boleh kosong',
                ],
            ],
        ];

        $filterRules = [];

        foreach ($rules as $rule => $value) {
            if (!array_key_exists($rule, $skip)) {
                $filterRules[] = $rules[$rule];
            }
        }

        $this->form_validation->set_rules($filterRules);
        return $this->form_validation->run();
    }
}