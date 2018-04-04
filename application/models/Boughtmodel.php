<?php

class Boughtmodel extends CI_Model{
    
    /**
     * 
     * @param array $boughtWithItem
     * array(   'leadtravelerfirstname' =>'',
     *          'leadtravelerlastname' =>'',
     *          'leadtravelerfirstname2' =>'',
     *          'leadtravelerlastname2' =>'',
     *          'payed' =>'',
     *          'value' =>'',
     *          'items' => array(array(
     *              'promotion_option_id' => 1,
     *              'price'         => 1,
     *              'adultcount'    => 1,
     *              'childcount'    => 2,
     *              'infantcount'   => 3          
     *          ),array('promotion_option_id' => 2,
     *              'price'         => 1,
     *              'adultcount'    => 1,
     *              'childcount'    => 2,
     *              'infantcount'   => 3));
     * 
     */
    public function saveBought(array $boughtWithItem){
        $insertBoughtData = array(
            'leadtravelerfirstname'     =>$boughtWithItem['leadtravelerfirstname'],
            'leadtravelerlastname'      =>$boughtWithItem['leadtravelerlastname'],
            'leadtravelerfirstname2'    =>$boughtWithItem['leadtravelerfirstname2'],
            'leadtravelerlastname2'     =>$boughtWithItem['leadtravelerlastname2'],
            'visitor_id'                =>$boughtWithItem['visitor_id'],
            'paytype'                   =>$boughtWithItem['paytype'],
            'payed'                     =>2,
            'value'                     =>0
        );
        
        $this->db->insert('bought', $insertBoughtData);
        $lastid = $this->db->insert_id();
        for($i=0;$i<count($boughtWithItem['items']); $i++){
            $insertBoughtItemData = array(
                'bought_id'             => $lastid,
                'promotion_option_id'   => $boughtWithItem['items'][$i]['promotion_option_id'],
                'price'                 => $boughtWithItem['items'][$i]['price'],
                'adultcount'  => $boughtWithItem['items'][$i]['adultcount'],
                'childcount'  => $boughtWithItem['items'][$i]['childrencount'],
                'infantcount' => $boughtWithItem['items'][$i]['infantscount'],
            );
            $this->db->insert('boughtitem', $insertBoughtItemData);
        }
         return $lastid;     
    }
    
    
    
    public function getBought($id){
        $id = (int)$id;
        $this->db->select('b.id, b.paytype, sum(bi.price) as sumprice, firstname, lastname');
        $this->db->from('bought b ');
        $this->db->join('boughtitem bi','b.id=bi.bought_id','LEFT');
        $this->db->join('visitor v','v.id=b.visitor_id','LEFT');
        $this->db->where('b.id', $id);
        $this->db->group_by('b.id');
        $query = $this->db->get();
        $boughtArray = [];
        if($query->num_rows() > 0){
            $boughtArray = $query->result_array();
        }
        return $boughtArray;
    }
    
    
    
    
    
}