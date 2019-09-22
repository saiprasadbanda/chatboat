<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct(){
        parent::__construct();
    }


    //////////////////////Seconod openion model

    public function check_record($selected,$table,$where,$where_in,$limit=null,$offset=null){
        //echo '<pre>'.print_r($where_in);exit;
        $this->db->select($selected);
        $this->db->from($table);
        if(isset($where))
            $this->db->where($where);
        if(is_array($where_in))
            $this->db->where_in($where_in['field'],$where_in['data']);
        if($limit >=0 && $offset >=0)
            $this->db->limit($limit,$offset);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        return $query->result_array();
    }

    public function insert_data($table,$data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update_data($table,$data,$where){
        $this->db->where($where);
        if($this->db->update($table, $data))
            return 1;
        else
            return 0;
    }

    public function delete_data($table,$where){
        if($this->db->delete($table, $where))
            return 1;
        else
            return 0;
    }
    public function custom_query($q){
        $query = $this->db->query($q);
        //return $query->result_array();
    }

    public function getCategories($data){
        $this->db->select('id,name')->from('categories');
        if($data['search_key'])
            $this->db->like('name',$data['search']);
    }

}