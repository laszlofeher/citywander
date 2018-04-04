<?php

class Promotioncategory extends Basemodel {

    public function getPromotionCategories(){
        $this->db->select('pc.id, pcg.name as pcgname, if(pc.name is null, pcg.name, pc.name) as name');
        $this->db->from('promotioncategorygroup pcg');
        $this->db->join('promotioncategory pc','pcg.id = pc.promotioncategorygroup_id and pcg.deleted = 2 and pc.deleted = 2','left');
        $this->db->order_by('pcg.order, pc.order');
        $query = $this->db->get();
        $promotionArray = array();
        if($query->num_rows()>0){
            $promotionArray = $query->result_array();
        }
        return $promotionArray;
    }
    
}