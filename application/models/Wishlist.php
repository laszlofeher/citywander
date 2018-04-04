<?php

class Wishlist extends Basemodel {

    /**
     * 
     * @param type $wishArray
     * 
     * visitor_id
     * promotion_id
     * 
     * 
     */
    
    
    public function addWishlist($wishArray) {
        $error = 0;
        if(isset($wishArray['visitor_id'])){
            $error['visitor_id']=1;
        }
        
        if(isset($wishArray['promotion_id'])){
            $error['promotion_id']=1;
        }
        
        $historyArray['deleted'] = '2';
        $this->db->insert('history',$historyArray);
    }

    public function removeWishlist($wishlist_id) {
        $wishlist_id = (int)$wishlist_id;
        $this->db->set('deleted', '1');
        $this->db->where('id', $wishlist_id);
        $this->db->update('wishlist');
    }
    
    public function getWishlistByVisitorId($visitor_id){
        $visitor_id = (int)$visitor_id;
        $this->db->select('wishlist.id,wishdate,deleted, promotion.id as promotion_id, promotion.name, promotion.smalldescription');
        $this->db->from('wishlist');
        $this->db->join('promotion','promotion.id = wishlist.promotion_id','left');
        $this->db->where('wishlist.visitor_id',$visitor_id);
        $query = $this->db->get();
        $wishlist = array();
        if($query->num_rows() >0){
            foreach ($query->result() as $row){
                $wishlist[] = array(
                    'id'                => $row->id,
                    'wishdate'          => $row->wishdate,
                    'deleted'           => $row->deleted,
                    'promotion_id'      => $row->promotion_id,
                    'name'              => $row->name,
                    'smalldescription'  => $row->smalldescription
                );
            }
        }
        return $wishlist;
    }
    
    /*
     * save wishlist
     * ha már szerepel de törölt, akkor update
     * ha még nem szerepel, akkor insert
     */
    
    public function saveWishlist($promotionid=-1, $visitorid=-1){
        $promotionid    = (int)$promotionid;
        $visitorid      = (int)$visitorid;
        
        $this->db->select('id, deleted');
        $this->db->from('wishlist');
        $this->db->where('promotion_id',$promotionid);
        $this->db->where('visitor_id',$visitorid);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if ($rowcount > 0) {
            foreach ($query->result_array() as $row) {}
            if($row['deleted'] == 1){
                $this->db->set('wishdate', 'NOW()', FALSE);
                $this->db->set('deleted', '2');
                $this->db->where('promotion_id',$promotionid);
                $this->db->where('visitor_id',$visitorid);
                $this->db->update('wishlist');
            }else if($row['deleted'] == 2){
                $this->db->set('wishdate', 'NOW()', FALSE);
                $this->db->set('deleted', '1');
                $this->db->where('promotion_id',$promotionid);
                $this->db->where('visitor_id',$visitorid);
                $this->db->update('wishlist');
            }
        }else{
            $insert_data = array(
                'promotion_id' =>$promotionid,
                'visitor_id' =>$visitorid,
                'deleted' =>'2'
            );
            $this->db->set('wishdate', 'NOW()', FALSE);
            $this->db->insert("wishlist", $insert_data);
        }
    }
}
