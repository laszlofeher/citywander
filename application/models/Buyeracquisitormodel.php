<?php
 
class Buyeracquisitormodel extends Basemodel {
    function getBuyerAquisitor($id){
        $id = (int)$id;
        $this->db->select("buyeracquisitoruser.id as buid, buyeracquisitor.id as bid, firstname, lastname, company");
        $this->db->from("buyeracquisitoruser");
        $this->db->join("buyeracquisitor","buyeracquisitoruser.buyeracquisitor_id = buyeracquisitor.id","left");
        $this->db->where("buyeracquisitoruser.id", $id);
        $query = $this->db->get();
        $resultArray= [];
        if($query->num_rows() > 0){
            $resultArray = $query->result_array();
        }
        return $resultArray;
    }
}