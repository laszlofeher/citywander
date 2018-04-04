<?php
class Settings extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getThanksForRegistration(){
        $this->db->select('settingsname, textproperty, textproperty1, description');
        $this->db->from('settings');
        $this->db->where('settingsname', '_thanksforregistration');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {}
            $data = array(
                "title"         => $row->textproperty,
                "description"   => $row->description
            );
            return $data;
        }
        return array();
    }
    
    public function getActualPricetype(){
        $this->db->select('settingsname ,intproperty ');
        $this->db->from('settings');
        $this->db->where('settingsname', '_actualpricetype');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {}
            $data = $row->intproperty;   
            return $data;
        }
        return false;
    }
    
    public function getFreeShippingMargin(){
        $this->db->select('settingsname ,intproperty ');
        $this->db->from('settings');
        $this->db->where('settingsname', '_freeshippingmargin');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {}
            $data = $row->intproperty;   
            return $data;
        }
        return false;
    }
    
    public function getProductPageSettings(){
        $this->db->select('settingsname ,intproperty, description');
        $this->db->from('settings');
        $this->db->where('settingsgroup', '_product');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data[$row->settingsname] = $row->intproperty;                    
            }
            return $data;
        }
        return false;
    }
    
    public function getProductlistPageSettings(){
        $this->db->select('settingsname ,intproperty, description');
        $this->db->from('settings');
        $this->db->where('settingsgroup', '_productlist');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data[$row->settingsname] = $row->intproperty;           
            }
            return $data;
        }
        return false;
    }
    
    public function getPackageQuotationsSettings(){
        $this->db->select('settingsname ,intproperty, description');
        $this->db->from('settings');
        $this->db->where('settingsname', '_package_quotations');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data[] = array(
                    'settingsname'      => $row->settingsname,
                    'value'             => $row->intproperty,
                    'description'       => $row->description
                );
            }
            return $data;
        }
        return false;
    }
    
    public function getAfterLogout(){
        $this->db->select('settingsname ,textproperty, textproperty1, description');
        $this->db->from('settings');
        $this->db->where('settingsname', '_after_logout');
        $this->db->where('settingsgroup', '_messages');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {}
                $data = array(
                    'settingsname'   => $row->settingsname,
                    'title'          => $row->textproperty,
                    'description'    => $row->textproperty1
                );
            return $data;
        }
        return false;
    }
    
    public function getAfterOrder(){
        $this->db->select('settingsname ,textproperty, textproperty1, description');
        $this->db->from('settings');
        $this->db->where('settingsname', '_after_order');
        $this->db->where('settingsgroup', '_messages');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {}
                $data = array(
                    'settingsname'   => $row->settingsname,
                    'title'          => $row->textproperty,
                    'description'    => $row->textproperty1
                );
            return $data;
        }
        return false;
    }
    
    
    public function getShippingError(){
        $this->db->select('settingsname ,textproperty, textproperty1, description');
        $this->db->from('settings');
        $this->db->where('settingsname', '_shipping_error');
        $this->db->where('settingsgroup', '_messages');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {}
                $data = array(
                    'settingsname'   => $row->settingsname,
                    'title'          => $row->textproperty,
                    'description'    => $row->textproperty1
                );
            return $data;
        }
        return false;
    }
    
    public function getPaymentError(){
        $this->db->select('settingsname ,textproperty, textproperty1, description');
        $this->db->from('settings');
        $this->db->where('settingsname', '_payment_error');
        $this->db->where('settingsgroup', '_messages');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {}
                $data = array(
                    'settingsname'   => $row->settingsname,
                    'title'          => $row->textproperty,
                    'description'    => $row->textproperty1
                );
            return $data;
        }
        return false;
    }
    
    
    
    
    
    public function getIntSettingsByName($namesarray){
        if(is_array($namesarray)){
            $this->db->select('settingsname ,intproperty, description');
            $this->db->from('settings');
            if(isset($namesarray[0]) && (count($namesarray)>1 || count($namesarray)==1)){
                $this->db->where('settingsname', $namesarray[0]);
            }
            for($j=1; $j<count($namesarrays); $j++){
                $this->db->or_where('settingsname', $namesarray[$j]);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $data = array();
                foreach ($query->result() as $row) {
                    $data[] = array(
                        'settingsname'      => $row->settingsname,
                        'value'             => $row->intproperty,
                        'description'       => $row->description
                    );
                }
                return $data;
            }
            return false;
        }else{
            return false;
        }
    }
    public function getTextSettingsByName($namesarray){
        if(is_array($namesarray)){
            $this->db->select('settingsname ,textproperty, description');
            $this->db->from('settings');
            if(isset($namesarray[0]) && (count($namesarray)>1 || count($namesarray)==1)){
                $this->db->where('settingsname', $namesarray[0]);
            }
            for($j=1; $j<count($namesarrays); $j++){
                $this->db->or_where('settingsname', $namesarray[$j]);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $data = array();
                foreach ($query->result() as $row) {
                    $data[] = array(
                        'settingsname'      => $row->settingsname,
                        'value'             => $row->textproperty,
                        'description'       => $row->description
                    );
                }
                return $data;
            }
            return false;
        }else if(is_string($namesarray)){
            $this->db->select('settingsname ,textproperty, description');
            $this->db->from('settings');
            $this->db->where('settingsname', $namesarray);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $data = array();
                foreach ($query->result() as $row) {
                    $data = array(
                        'settingsname'      => $row->settingsname,
                        'value'             => $row->textproperty,
                        'description'       => $row->description
                    );
                }
                return $data;
            }
            return false;
        }
    }
    
    public function getFooterText($settingsname, $language){
        $this->db->select('id ,textproperty, textproperty1');
        $this->db->from('settings');
        $this->db->where('settingsname',$settingsname);
        $this->db->where('settingsgroup','_footer');
        $this->db->where('language', $language);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data = array(
                    'id'=>$row->id,
                    'title'=>$row->textproperty,
                    'description'=>$row->textproperty1);
            }
            return $data;
        }
        return array();
    }
    
    
    
    public function getHomePopularThings($language){
        $this->db->select('s.id, intproperty, settingsname, textproperty, textproperty1, pc.name');
        $this->db->from('settings s');
        $this->db->join('promotioncategory pc','pc.id = s.intproperty','left');
        $this->db->group_start();
        $this->db->where('settingsname','_1_popular_things');
        $this->db->or_where('settingsname','_2_popular_things');
        $this->db->or_where('settingsname','_3_popular_things');
        $this->db->or_where('settingsname','_4_popular_things');
        $this->db->or_where('settingsname','_5_popular_things');
        $this->db->or_where('settingsname','_6_popular_things');
        $this->db->or_where('settingsname','_7_popular_things');
        $this->db->or_where('settingsname','_8_popular_things');
        $this->db->group_end();
        $this->db->where('settingsgroup','_home');
        $this->db->where('language', $language);
        $this->db->order_by('settingsname', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data[] = array(
                    'id'=>$row->intproperty,
                    'name'=>$row->textproperty,
                    'settingsname'=>$row->settingsname,
                    'picturepath'=>$row->textproperty1);
            }
            return $data;
        }
        return array();   
    }
    
    public function getTopSightseeing(){
        $this->db->select('s.id, intproperty');
        $this->db->from('settings s');
        $this->db->where('settingsname','_top_sightseeings');
        $this->db->where('settingsgroup','_home');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array();
            foreach ($query->result() as $row) {
                $data = array(
                    'id'        =>$row->id,
                    'categoryid'=>$row->intproperty);
            }
            return $data;
        }
        return array();   
    }
    
    public function getCarouselPictures(){
        $this->db->select('id, textproperty as picture, intproperty as order');
        $this->db->from('settings');
        $this->db->where('settingsgroup', '_carousel');
        $query = $this->db->get();
        $returnArray = [];
        if($query->num_rows() > 0){
            $returnArray = $query->result_array();
        }
        return $returnArray;
    }
    
}