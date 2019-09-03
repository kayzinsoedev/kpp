<?php

class get_users_model extends CI_Model{

    protected $table = 'users';
    protected $_primary_key = 'id';

    public function __construct(){
        parent::__construct();
    }

    public function sign_in($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $q = $this->db->get($this->table);

        return $q->row();
    }


    public function get($id = null, $order_by = null){

        if(is_numeric($id)){
            $q = $this->db->where($this->_primary_key, $id);
        }

        if(is_array($id)){
            foreach($id as $key => $value){
                $q = $this->db->where($key,$value);
            }
        }

        $q = $this->db->get($this->table);
        return $q->result_array();
    }

    public function insert($data){

        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }

    public function update($new_data, $where){
        if(is_numeric($where)){
            $this->db->where($this->_primary_key,$where);
        }
        elseif(is_array($where)){
            foreach($where as $key => $value){
                $this->db->where($key,$value);
            }
        }
        else {
            die("You must pass a second parameter to update() method");
        }

        $this->db->update($this->table,$new_data);
        return $this->db->affected_rows();
    }

    public function delete($id){

        if(is_numeric($id)){
            $this->db->where($this->_primary_key,$id);
        }
        elseif(is_array($id)){
            foreach($id as $key => $value){
                $this->db->where($key,$value);
            }
        }
        else {
            die("You must pass a parameter to delete() method");
        }
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function insertUpdate($data, $id = false){

        if(!$id){
            die("Need Second Parameter for insertUpdate");
        }

        $this->db->select($this->_primary_key);
        $this->db->where($this->_primary_key,$id);
        $q = $this->db->get($this->table);
        $result = $q->num_rows();
//        return $result;

        if($result == 1){
//            Update
            $this->db->where($this->_primary_key,$id);
            $this->db->update($this->table,$data);
            return $this->db->affected_rows();
        }
//        Insert
        return $this->db->insert($this->table,$data);
    }

}