<?php
class Cartmodel extends CI_Model{
    
    public function getCartByVisitorId($visitorid = -1, $currency){
        $visitorid = (int)$visitorid;
        $this->db->select('c.id, '
                . 'c.memo, '
                . 'c.childcount, '
                . 'c.adultscount, '
                . 'c.infantscount, '
                . 'c.crd, '
                . 'c.lud, '
                . 'c.dd, '
                . 'c.deleted, '
                . 'c.price, '
                . 'c.currency,'
                . 'c.promotiondate,'
                . 'year(c.promotiondate) as pyear,'
                . 'month(c.promotiondate) as pmonth,'
                . 'day(c.promotiondate) as pday,'
                . "p.name as promotion_name,"
                . 'po.id as poid,'
                . 'po.optionname,'
                . 'po.optiondetail,'
                . 'pop.adultsprice     as adultsprice,'
                . 'pop.childrenprice   as childrenprice,'
                . 'pop.infantsprice    as infantsprice,'
                . 'pop.currency as optioncurrency'
        );
        $this->db->from('cart c');
        $this->db->join('promotion_option po','c.promotion_option_id=po.id','left');
        $this->db->join("promotion_option_price pop", "po.id = pop.promotion_option_id", 'left');
        $this->db->join("promotion p",'po.promotion_id=p.id','left');
        $this->db->where('visitor_id', $visitorid);
        $this->db->where('c.deleted', '2');
        $this->db->where('pop.currency', $currency);
        $this->db->where('pop.from <= NOW()');
        $this->db->where('pop.to >= NOW()');
        
        $query = $this -> db -> get();
        $cartArray = [];
        if($query->num_rows() > 0){
            foreach($query->result_array() as $row){
                $cartArray[] = array(
                    'id'      => $row['poid'],
                    'cartid'  => $row['id'],
                    'qty'     => 1,
                    'price'   => $row['price'],
                    'name'    => $row['promotion_name'],
                    'options' => array( 'adultcount'    => $row['adultscount'],
                                        'childrencount' => $row['childcount'],
                                        'infantscount'  => $row['infantscount'],
                                        'adultsprice'   => $row['adultsprice'],
                                        'childrenprice' => $row['childrenprice'],
                                        'infantsprice'  => $row['infantsprice'],
                                        'year'          => $row['pyear'],
                                        'month'         => $row['pmonth'],
                                        'day'           => $row['pday'],
                                        'optionname'    => $row['optionname'] ));
            }
        }
        return $cartArray;
    }
    
    /*
     * 1. megnézem benne van, e a kosárban
     * Ha benne van hozzáadom, rákérdezés
     * 2. ha nincs benne ilyen, akkor beirom.
     */
    
    public function addToCart($promotion_option_id =-1, $visitor_id=-1,  $adultcount, $childrencount, $infantscount, $year, $month, $day){
        $this->db->select('id, adultscount, childcount, infantscount');
        $this->db->from('cart');
        $this->db->where('promotion_option_id', $promotion_option_id);
        $this->db->where('promotiondate', "STR_TO_DATE('".$year.".".$month.".".$day."', '%Y.%m.%d')",FALSE);
        $this->db->where('visitor_id', $visitor_id);
        $this->db->where('deleted', 2);
        $query = $this -> db -> get();
        if ($query->num_rows() > 0) {
            
            
            
            
            
            
            
        }else{
            $insertCart = array(
                'promotion_option_id'   => $promotion_option_id,
                'visitor_id'            => $visitor_id,
                'childcount'            => $childrencount,
                'adultscount'           => $adultcount,
                'infantscount'          => $infantscount,
                'deleted'               => 2
            );
            $this->db->set('promotiondate', "STR_TO_DATE('".$year.".".$month.".".$day."', '%Y.%m.%d')", FALSE);
            $this->db->set('crd', 'NOW()', FALSE);
            $this->db->insert('cart', $insertCart);
        }
        
    }
    
    
    
    
}