<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BaseModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
    }

    public function getAll($table)
    {
        return $this->db->get($table);
    }
    
    public function getOne($table, $limit)
    {   
        $this->db->limit($limit);
        return $this->db->get($table);
    }

    public function getLike($table, $column, $value)
    {
        $this->db->like($column, $value);
        return $this->db->get($table);
    }

    public function getLimit($table, $limit, $start)
    {
        $this->db->limit($limit, $start);
        return $this->db->get($table)->result();
    }

    public function getTotal($table)
    {
        return $this->db->count_all($table);
    }

    public function getWhere($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function whereIn($table, $column, $data)
    {
        $this->db->where_in($column, $data);
        return $this->db->get($table);
    }

    public function getById($table, $id)
    {
        $query = $this->db->get_where($table, array("id" => $id))->result();
        return $query ? $query[0] : $query;
    }

    public function create($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function createMultiple($table, $data)
    {
        return $this->db->insert_batch($table, $data);
    }

    public function createForId($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function updateById($table, $id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

    public function update($table, $id, $column, $data)
    {
        $this->db->where($column, $id);
        return $this->db->update($table, $data);
    }

    public function updateMultiple($table, $data, $column)
    {
        return $this->db->update_batch($table, $data, $column);
    }

    public function deleteById($table, $id)
    {
        return $this->db->delete($table, array('id' => $id));
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function checkById($table, $id)
    {
        $query = $this->db->get_where($table, ['id' => $id])->result();
        if(!$query) {
            $data['message'] = "ID: $id tidak ditemukan";
            $this->load->view("errors/custom/id_not_found", $data);
            die();
        }else{
            return $query[0];
        }
    }
}
