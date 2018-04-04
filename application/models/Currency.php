<?php
class Currency extends CI_Model{
    
    public function getAllCurrency(){
        $this->db->select('id, name, symbol');
        $this->db->from('currency');
        $this->db->where('deleted', 2);
        $query          = $this->db->get();
        $currencyArray  = [];
        if($query->num_rows() > 0){
            $currencyArray = $query->result_array();
        }
        return $currencyArray;       
    }
    
    public function getCurrencyById($id){
        $id = substr($id, 0, 3);
        $this->db->select('id, name, symbol');
        $this->db->from('currency');
        $this->db->where('deleted', 2);
        $this->db->where('id', $id);
        $query          = $this->db->get();
        $currencyArray  = [];
        if($query->num_rows() > 0){
            $currencyArray = $query->result_array()[0];
        }
        return $currencyArray;       
    }
}