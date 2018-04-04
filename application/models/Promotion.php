<?php

class Promotion extends Basemodel {
    /**
     *  SELECT * FROM citywander.promotion p 
     *  left join citywander.promotioncategory pc on(p.promotioncategory_id = pc.id)
     *  left join citywander.label l on(p.id = l.promotion_id)
     * 
     */
    public function getPromotions($search, $currency, $limit=15, $start=0) {
        $this->db->select("p.id, "
                    . " p.daytime_id,"
                    . " p.code,"
                    . " p.location,"
                    . " p.name as promotion_name,"
                    . " p.smalldescription,"
                    . " p.description,"
                    . " p.otherproperties,"
                    . " p.otherinformation,"
                    . " p.picture,"
                    . " d.hour,"
                    . " d.minute,"
                    . " d.day,"
                    . " pp.price,"
                    . " pp.currency,"
                    . " pp.from,"
                    . " pp.to,"
                    . " pc.name as category_name,"
                    . " avg(r.rate) as rate,"
                    . " count(r.id) as countreflection,"
                    . " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                    . " w.visitor_id as wishlist_visitor_id,"
                    . " l.title");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "pl.promotion_id = p.id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("duration d", "p.duration_id = d.id", 'left');
        $this->db->join("reflection r", "p.id = r.promotion_id", 'left');
        $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where("pp.currency", substr($currency,0,3));
        $this->db->group_start();
        //search in name
        $this->db->like('p.name', $search);
        //search in smalldescription
        $this->db->or_like('p.smalldescription', $search);
        //search in description
        $this->db->or_like('p.description', $search);
        //search in otherproperties
        $this->db->or_like('p.otherproperties', $search);
        //search in otherinformation
        $this->db->or_like('p.otherinformation', $search);
        //search in otherinformation
        $this->db->or_like('l.title', $search);
        //search in promotioncategory.name
        $this->db->or_like('pc.name', $search);
        $this->db->group_end();
        $this->db->group_by('p.id');     
        
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        $result_array = array();
        if ($rowcount > 0) {
            $result_array = $query->result_array();
        }
        return $result_array;
    }
    
    public function getPromotionsCount($search, $currency) {
        $this->db->select("count(p.id) as count ");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "pl.promotion_id = p.id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("duration d", "p.duration_id = d.id", 'left');
        $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where("pp.currency", substr($currency,0,3));
        $this->db->group_start();
        //search in name
        $this->db->like('p.name', $search);
        //search in smalldescription
        $this->db->or_like('p.smalldescription', $search);
        //search in description
        $this->db->or_like('p.description', $search);
        //search in otherproperties
        $this->db->or_like('p.otherproperties', $search);
        //search in otherinformation
        $this->db->or_like('p.otherinformation', $search);

        //search in otherinformation
        $this->db->or_like('l.title', $search);
        //search in promotioncategory.name
        $this->db->or_like('pc.name', $search);
        $this->db->group_end();
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if ($rowcount > 0) {
            return $query->result_array()[0]['count'];
        }
        return 0;
    }
    
    /**
     * 
     * 
     */
    public function getPromotionsWithFilter($search, $currency, $limit=15, $start=0, $duration, $pricefrom, $priceto, $daytime){
        
    }
    
    public function getPromotionsFromList($idlist, $currency = 'HUF') {
        if (is_array($idlist)) {
            $this->db->select("p.id, "
                    . " p.code,"
                    . " p.location,"
                    . " p.name as promotion_name,"
                    . " p.smalldescription,"
                    . " p.description,"
                    . " p.otherproperties,"
                    . " p.otherinformation,"
                    . " d.hour,"
                    . " d.minute,"
                    . " d.day,"
                    . " pp.price,"
                    . " pp.currency,"
                    . " pp.from,"
                    . " pp.to,"
                    . " pc.name as category_name,"
                    . " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                    . " w.visitor_id as wishlist_visitor_id"
                    );
            $this->db->from("promotion p");
            $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
            $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
            $this->db->join("duration d", "p.duration_id = d.id", 'left');
            $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
            $this->db->where("p.validation", "1");
            $this->db->where('pp.currency', $currency);
            $this->db->where('pp.from <= NOW()');
            $this->db->where('pp.to >= NOW()');
            $i=0;
            $idwhere = '';
            foreach ($idlist as $key => $value) {
                if($i==0){
                   $idwhere .= " (p.id = '".(int)$value."'"; 
                }else{
                   $idwhere .= " or p.id = '".(int)$value."'";  
                }
                $i++;
            }
            $idwhere .=") ";
            $this->db->where($idwhere, NULL, FALSE);
            $query = $this->db->get();
            $rowcount = $query->num_rows();
            $result_array = array();
            if ($rowcount > 0) {
                $result_array = $query->result_array();
            }
            return $result_array;
        } else {
            return $result_array;
        }
    }

    public function getPromotionsByCategory($categoryid, $currency, $limit=5, $start=0) {
        $this->db->select("p.id, "
                . " p.name as promotion_name,"
                . " p.picture as picture,"
                . " p.smalldescription,"
                . " p.description,"
                . " p.otherproperties,"
                . " p.otherinformation,"
                . " l.title,"
                . " pp.price,"
                . " pp.currency,"
                . " pp.from,"
                . " pp.to,"
                . " avg(r.rate) as rate,"
                . " count(r.id) as countreflection,"
                . " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                . " w.visitor_id as wishlist_visitor_id,"
                . " pc.name as category_name");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "p.id = pl.promotion_id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("reflection r", "p.id = r.promotion_id", 'left');
        $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where("pp.currency", substr($currency,0,3));
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
        $this->db->where('pc.id',$categoryid);
        $this->db->group_by("p.id");
        $this->db->order_by("pp.price desc");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        $result_array = array();
        if ($rowcount > 0) {
            $result_array = $query->result_array();
        }
        return $result_array;
    }
    
    public function getPromotionsByCategoryCount($categoryid, $currency){
        $this->db->select("count(p.id) as count");
        $this->db->from("promotion p");
        $this->db->where("p.validation", "1");
        $this->db->where('p.promotioncategory_id',$categoryid);
        
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if ($rowcount > 0) {
            return $query->result_array()[0]["count"];
        }
        return 0;
    }
    /*
     * 1 Most popular
     * 2 Lowest    price 
     * 3 Highest   price
     * 4 Shortest  program
     * 5 Longest   program 
    */
    public function getPromotionsByLabel($title, $currency, $limit=5, $start=0, $sorttype= 3) {
        $this->db->select("p.id, "
                . " p.name as promotion_name,"
                . " p.picture as picture,"
                . " p.smalldescription,"
                . " p.description,"
                . " p.otherproperties,"
                . " p.otherinformation,"
                . " l.title,"
                . " pp.price,"
                . " pp.currency,"
                . " pp.from,"
                . " pp.to,"
                . " avg(r.rate) as rate,"
                . " count(r.id) as countreflection,"
                . " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                . " w.visitor_id as wishlist_visitor_id,"
                . " pc.name as category_name");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "p.id = pl.promotion_id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("reflection r", "p.id = r.promotion_id", 'left');
        $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where("pp.currency", substr($currency,0,3));
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
        $this->db->like('lower(l.title)', strtolower($title), 'after');
        $this->db->group_by("p.id");
        if($sorttype == 1){
            //legnepszerubb majd rendelési adatokból
            $this->db->order_by("pp.price desc");
        }     
        if($sorttype == 2){
            $this->db->order_by("pp.price asc");
        }     
        if($sorttype == 3){
            $this->db->order_by("pp.price desc");
        }     
        if($sorttype == 4){
            $this->db->order_by("p.day asc, p.hour asc, p. minute asc");
        }     
        if($sorttype == 5){
            $this->db->order_by("p.day desc, p.hour desc, p. minute desc");
        } 
        $this->db->limit($limit, $start);

        $query = $this->db->get();
        $rowcount = $query->num_rows();
        $result_array = array();
        if ($rowcount > 0) {
            $result_array = $query->result_array();
        }
        return $result_array;
    }
    
    /*
     * a getPromotionsByLabel függvény count párja
     */
    public function getPromotionsByLabelCount($title, $currency){
        $this->db->select("count(p.id) as count ");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "p.id = pl.promotion_id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->like('l.title', $title, 'after');
        $this->db->group_by("p.id");
        
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {}
        return $row["count"];
    }
    
    /*
     * A legjobb értékelés szerint rendezve
     */
    
    
    public function getPromotionsByBestRate($currency, $limit=5, $start=0) {
        $this->db->select("p.id, "
                . " p.name as promotion_name,"
                . " p.picture as picture,"
                . " p.smalldescription,"
                . " p.description,"
                . " p.otherproperties,"
                . " p.otherinformation,"
                . " l.title,"
                . " pp.price,"
                . " pp.currency,"
                . " pp.from,"
                . " pp.to,"
                . " avg(r.rate) as rate,"
                . " count(r.id) as countreflection,"
                . " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                . " w.visitor_id as wishlist_visitor_id,"
                . " pc.name as category_name");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "p.id = pl.promotion_id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("reflection r", "p.id = r.promotion_id", 'left');
        $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where("pp.currency", substr($currency,0,3));
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
        $this->db->group_by("p.id");
        $this->db->order_by("rate desc");
        $this->db->limit($limit, $start);

        $query = $this->db->get();
        $rowcount = $query->num_rows();
        $result_array = array();
        if ($rowcount > 0) {
            $result_array = $query->result_array();
        }
        return $result_array;
    }
    
    /*
     * a getPromotionsByBestRate függvény count párja
     */
    public function getPromotionsByBestRateCount($currency){
        $this->db->select("count(p.id) as count ");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "p.id = pl.promotion_id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("reflection r", "p.id = r.promotion_id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where("pp.currency", substr($currency,0,3));
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
        
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {}
        return $row["count"];
    }
    
    
    /*
     * Minden promoció legelöl a legdrágább promoció
     * sorttype
     * 1 Most popular
     * 2 Lowest    price 
     * 3 Highest   price
     * 4 Shortest  program
     * 5 Longest   program 
     *
     * 
     * 
     * 
     * 
     */
    public function getAllPromotions($currency, $limit=5, $start=0, $sorttype = 3) {
        $this->db->select("p.id,"
                . " p.name as promotion_name,"
                . " p.picture as picture,"
                . " p.smalldescription,"
                . " p.description,"
                . " p.otherproperties,"
                . " p.otherinformation,"
                . " l.title,"
                . " pp.price,"
                . " pp.currency,"
                . " pp.from,"
                . " pp.to,"
                . " avg(r.rate) as rate,"
                . " count(r.id) as countreflection,"
                . " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                . " w.visitor_id as wishlist_visitor_id,"
                . " pc.name as category_name");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "p.id = pl.promotion_id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("reflection r", "p.id = r.promotion_id", 'left');
        $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where("pp.currency", substr($currency,0,3));
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
        $this->db->group_by("p.id");
        if($sorttype == 1){
            //legnepszerubb majd rendelési adatokból
            $this->db->order_by("pp.price desc");
        }     
        if($sorttype == 2){
            $this->db->order_by("pp.price asc");
        }     
        if($sorttype == 3){
            $this->db->order_by("pp.price desc");
        }     
        if($sorttype == 4){
            $this->db->order_by("p.day asc, p.hour asc, p. minute asc");
        }     
        if($sorttype == 5){
            $this->db->order_by("p.day desc, p.hour desc, p. minute desc");
        }     
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        $result_array = array();
        if ($rowcount > 0) {
            $result_array = $query->result_array();
        }
        return $result_array;
    }
    /*
     * a getAllPromotions függvény count párja
     */
    public function getAllPromotionsCount($currency){
        $this->db->select("count(p.id) as count ");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionlabel pl", "p.id = pl.promotion_id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where("pp.currency", substr($currency,0,3));
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
        
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {}
        return $row["count"];
    }
    
    public function getPromotionDetail($id, $currency = "HUF") {
        $id = (int) $id;
        $this->db->select("p.id,"
                . " p.daytime_id,"
                . " p.code,"
                . " p.location,"
                . " p.name as promotion_name,"
                . " p.smalldescription,"
                . " p.description,"
                . " p.otherproperties,"
                . " p.otherinformation,"
                . " d.hour,"
                . " d.minute,"
                . " d.day,"
                . " pp.price,"
                . " pp.currency,"
                . " pp.from,"
                . " pp.to,"
                . " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                . " w.visitor_id as wishlist_visitor_id,"
                . " pc.name as category_name");
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("duration d", "p.duration_id = d.id", 'left');
        $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        $this->db->where("p.id", $id);
        $this->db->where('pp.currency', $currency);
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        $result_array = array();
        if ($rowcount > 0) {
            foreach ($query->result_array() as $row) {
                $result_array = array(
                    "id" => $row["id"],
                    "promotion_name" => $row["promotion_name"],
                    "smalldescription" => $row["smalldescription"],
                    "description" => $row["description"],
                    "otherproperties" => $row["otherproperties"],
                    "otherinformation" => $row["otherinformation"],
                    "category_name" => $row["category_name"],
                    "hour" => $row["hour"],
                    "minute" => $row["minute"],
                    "day" => $row["day"],
                    "code" => $row["code"],
                    "location" => $row["location"],
                    "price" => $row["price"],
                    "from" => $row["from"],
                    "to" => $row["to"],
                    "currency" => $row["currency"],
                    "wishlist" => $row["wishlist"],
                    "wishlist_visitor_id" => $row["wishlist_visitor_id"]
                );
            }
            //reflection 
            $this->db->select("r.id,"
                . " r.memo,"
                . " r.visitor_id,"
                . " r.rate,"
                . " month(r.crd) as month,"
                . " day(r.crd) as day,"
                . " v.firstname,"
                . " v.lastname");
            $this->db->from("reflection r");
            $this->db->join("visitor v","v.id = r.visitor_id", "left");
            $this->db->where("r.promotion_id", $id);
            $this->db->where("r.visible", '1');
            $query = $this->db->get();
            $rowcount = $query->num_rows();
            $reflection_array=array();
            if ($rowcount > 0) {
                foreach ($query->result_array() as $row) {
                    $reflection_array[] = array(
                        "id"            => $row["id"],
                        "memo"          => $row["memo"],
                        "visitor_id"    => $row["visitor_id"],
                        "rate"          => $row["rate"],
                        "month"         => $row["month"],
                        "day"           => $row["day"],
                        "firstname"     => $row["firstname"],
                        "lastname"      => $row["lastname"]);
                }
            }
            $result_array["reflections"] = $reflection_array;
        }
        return $result_array;
    }
    /*
     * id is a promotion id
     * 
     */
    public function getPromotionWithOptions($id, $currency = "HUF", $visitorid=-1) {
        $id         = (int) $id;
        $visitorid  = (int) $visitorid;
        $select = " p.id,"
                . " p.daytime_id,"
                . " p.code,"
                . " p.location,"
                . " p.name as promotion_name,"
                . " p.smalldescription,"
                . " p.description,"
                . " p.otherproperties,"
                . " p.otherinformation,"
                . " d.hour,"
                . " d.minute,"
                . " d.day,"
                . " pp.price,"
                . " pp.currency,"
                . " pp.from,"
                . " pp.to,"
                . " pop.price as optionprice,"
                . " pop.currency as optioncurrency,"
                . " pop.from as optionfrom,"
                . " pop.to as optionto,"
                . " po.id as promotionid,"
                . " po.optionname,"
                . " po.optiondetail,";
        /*
        if($visitorid > 0){
                $select .= " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                . " w.visitor_id as wishlist_visitor_id,";
        }
         * 
         */
        $select .= " pc.name as category_name";
        $this->db->select($select);
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("promotion_option po", "p.id = po.promotion_id", 'left');
        $this->db->join("promotion_option_price pop", "po.id = pop.promotion_option_id", 'left');
        $this->db->join("duration d", "p.duration_id = d.id", 'left');
        /*
        if($visitorid > 0){
            $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        }
         * 
         */
        $this->db->where("p.id", $id);

        $this->db->where('pp.currency', $currency);
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
    
        $this->db->where('pop.currency', $currency);
        $this->db->where('pop.from <= NOW()');
        $this->db->where('pop.to >= NOW()');
        $this->db->where('po.deleted = 2');
        /*
        if($visitorid > 0){
            $this->db->where('w.visitor_id', $visitorid);
        }
         * 
         */
        $query              = $this->db->get();
        $rowcount           = $query->num_rows();
        $result_array       = array();
        if ($rowcount > 0) {
            $result_array   = $query->result_array();
        }
        return $result_array;
    }
    
    
    public function getPromotionOptionByPromotionOptionId($promotion_id, $currency = "HUF") {
        $promotion_id  = (int) $promotion_id;
        $select = " p.id,"
                . " p.daytime_id,"
                . " p.code,"
                . " p.location,"
                . " p.name as promotion_name,"
                . " p.smalldescription,"
                . " p.description,"
                . " p.otherproperties,"
                . " p.otherinformation,"
                . " d.hour,"
                . " d.minute,"
                . " d.day,"
                . " pp.price,"
                . " pp.currency,"
                . " pp.from,"
                . " pp.to,"
                . " pop.adultsprice     as adultsprice,"
                . " pop.childrenprice   as childrenprice,"
                . " pop.infantsprice    as infantsprice,"
                . " pop.currency as optioncurrency,"
                . " pop.from as optionfrom,"
                . " pop.to as optionto,"
                . " po.id as promotionid,"
                . " po.optionname,"
                . " po.optiondetail,";
        
        $select .= " pc.name as category_name";
        $this->db->select($select);
        $this->db->from("promotion p");
        $this->db->join("promotioncategory pc", "p.promotioncategory_id = pc.id", 'left');
        $this->db->join("promotionprice pp", "p.id = pp.promotion_id", 'left');
        $this->db->join("promotion_option po", "p.id = po.promotion_id", 'left');
        $this->db->join("promotion_option_price pop", "po.id = pop.promotion_option_id", 'left');
        $this->db->join("duration d", "p.duration_id = d.id", 'left');
        
        $this->db->where("po.id", $promotion_id);
        $this->db->where('pp.currency', $currency);
        $this->db->where('pp.from <= NOW()');
        $this->db->where('pp.to >= NOW()');
        $this->db->where('pop.currency', $currency);
        $this->db->where('pop.from <= NOW()');
        $this->db->where('pop.to >= NOW()');
        $this->db->where('po.deleted = 2');
        
        $query              = $this->db->get();
        $rowcount           = $query->num_rows();
        $result_array       = array();
        if ($rowcount > 0) {
            $result_array   = $query->result_array();
        }
        return $result_array;
    }
    
    /*
     * save rating to promotion
     */
    
    public function saveRating($promotionid=-1, $rate=1, $memo='', $visitorid = -1){
        $promotionid = (int)$promotionid;
        $rate = (int)$rate;
        $insert_data = array(
            'promotion_id' =>$promotionid,
            'visitor_id' =>$visitorid,
            'rate' =>$rate,
            'memo' =>$memo,
            'visible'  =>'2'
        );
        $this->db->set('crd', 'NOW()', FALSE);
        $this->db->insert("reflection", $insert_data);
    }
    
    /*
     * get rating from promotion
     */
    
    public function getRatingByPromotionIdVisitorId($promotionid, $visitorid){
        $promotionid    = (int)$promotionid;
        $visitorid      = (int)$visitorid;
                
        $this->db->select("count(r.id) as count");
        $this->db->from("reflection r");
        $this->db->join("visitor v","v.id = r.visitor_id", "left");
        $this->db->where("r.promotion_id", $promotionid);
        $this->db->where("r.visitor_id", $visitorid);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {}
        return $row['count'];   
    }
    
    /*
     * promotion price
     * range topn n
     *  SELECT 
        min(price) as minprice, 
        max(price) as maxprice,
        (max(price)-min(price))/4 ,
        min(price)+((max(price)-min(price))/4) as _first,
        min(price)+((max(price)-min(price))/4)*2 as _sec,
        min(price)+((max(price)-min(price))/4)*3 as _terc
        FROM promotion p
        LEFT JOIN promotionprice pp ON(p.id = pp.promotion_id)
        WHERE now() between pp.from and pp.to
        AND currency = 'HUF'
     * 
     * 10-100

        /4 = 22,5

        10-32,5
        32,5-56
        56-78,5+
             */
    
    public function getPriceMargin($currency ="HUF"){
        $sql = "SELECT 
        min(price) as minprice, 
        max(price) as maxprice,
        (max(price)-min(price))/4 ,
        min(price)+((max(price)-min(price))/4) as _first,
        min(price)+((max(price)-min(price))/4)*2 as _sec,
        min(price)+((max(price)-min(price))/4)*3 as _third
        FROM promotion p
        LEFT JOIN promotionprice pp ON(p.id = pp.promotion_id)
        WHERE now() between pp.from and pp.to
        AND currency = '".$currency."'";
        
        $query = $this->db->query($sql);
        $priceMarginArray = array();
        if($query->num_rows() >0 ){
            foreach ($query->result() as $row) {}
                $priceMarginArray = array(
                    "_first"    => $row->_first,
                    "_sec"      => $row->_sec,
                    "_third"    => $row->_third
                );
            
        }
        return $priceMarginArray;
    }
    
    
    /**
     * A legjobb jutalékkal rendelkező promociók jelenjenek meg.
     */
    public function getPromotionTopActivitiesByBestComission(){
        $this->db->select("p.id, "
                . " p.name as promotion_name,"
                . " p.picture as picture,"
                . " p.smalldescription,"
                . " p.description,"
                . " p.otherproperties,"
                . " p.otherinformation,"
                . " l.title,"
                . " avg(r.rate) as rate,"
                . " count(r.id) as countreflection,"
                . " if(ifnull(w.deleted,1)=1, 1 ,2) as wishlist,"
                . " w.visitor_id as wishlist_visitor_id,");
        $this->db->from('comission c');
        $this->db->join('programprovider pp', 'c.programprovider_id = pp.id', 'left');
        $this->db->join('promotion p', 'p.programprovider_id = pp.id', 'left');
        $this->db->join("promotionlabel pl", "p.id = pl.promotion_id", 'left');
        $this->db->join("label l", "pl.label_id = l.id", 'left');
        $this->db->join("reflection r", "p.id = r.promotion_id", 'left');
        $this->db->join("wishlist w", "w.promotion_id = p.id", 'left');
        $this->db->where("p.validation", "1");
        $this->db->where('c.deleted','2');
        $this->db->where("now() BETWEEN c.from AND c.to");
        $this->db->group_by("p.id");
        $this->db->order_by('comissionvalue');
        $this->db->limit(10,0);
        $query = $this->db->get();
        $resultArray = [];
        if($query->num_rows() > 0){
            $resultArray = $query->result_array();
        }
        return $resultArray;
    }
        
}