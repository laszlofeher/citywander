<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Set extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion','settings'));
    }
    
    function setLanguage($language='en'){
        $language = substr($language, 0,2);
        $this->session->set_userdata('language',$language);
    }
    
    
    function setCurrency($currency='HUF'){
        $currency = substr($currency, 0,3);
        $currencyArray = $this->currency->getCurrencyById($currency);
        $this->session->set_userdata('currency',$currencyArray);
    }
    
    function setWishList($promotionid = -1){
        $promotionid = (int)$promotionid;
        if ($this->session->userdata('logged_in') !== null) {
            $this->promotion->saveWishlist($promotionid, $this->session->userdata('logged_in')['id'] );
        }
    }
    
    function setItemcount($itemcount=10){
        $itemcount = (int)$itemcount;
        $this->session->set_userdata('itemcount',$itemcount);
    }
    
    function setSortBy($sortby=1){
        $sortby = (int)$sortby;
        $this->session->set_userdata('sorttype',$sortby);
    }
    
    function setCategoryIdInListview(){
        $categoryid = (int) $this->input->post('categoryid');
        $this->session->set_userdata('categoryid', $categoryid);
        
    }
    
    //------------------------ filter section ----------------------
    function setDuration(){
        $duration1 = $this->input->post('duration1');
        $duration2 = $this->input->post('duration2');
        $duration3 = $this->input->post('duration3');
        $duration4 = $this->input->post('duration4');
        $this->session->set_userdata('duration', array('duration1' => $duration1,
                                                       'duration2' => $duration2,
                                                       'duration3' => $duration3,
                                                       'duration4' => $duration4 ));
    }
    
    function setPriceRange(){
        $priceRange1 = $this->input->post('pricerange1');
        $priceRange2 = $this->input->post('pricerange2');
        $priceRange3 = $this->input->post('pricerange3');
        $priceRange4 = $this->input->post('pricerange4');
        $this->session->set_userdata('pricerange', array('pricerange1' => $priceRange1,
                                                         'pricerange2' => $priceRange2,
                                                         'pricerange3' => $priceRange3,
                                                         'pricerange4' => $priceRange4 ));
    }
    
    function setDayTime(){
        $dayTime1 = $this->input->post('daytime1');
        $dayTime2 = $this->input->post('daytime2');
        $dayTime3 = $this->input->post('daytime3');
        $dayTime4 = $this->input->post('daytime4');
        $dayTime5 = $this->input->post('daytime5');
        $this->session->set_userdata('daytime', array('daytime1' => $dayTime1,
                                                         'daytime2' => $dayTime2,
                                                         'daytime3' => $dayTime3,
                                                         'daytime4' => $dayTime4,
                                                         'daytime5' => $dayTime5, ));
    }
    
    function setFilterDefault(){
        $ok = $this->input->post('ok');
        if($ok == 'ok'){
            $this->session->unset_userdata('duration');
            $this->session->unset_userdata('pricerange');
            $this->session->unset_userdata('daytime');
        }
    }
}
