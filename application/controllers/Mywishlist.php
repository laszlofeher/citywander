<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mywishlist extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    private function getCurrencySettings() {
        if ($this->session->userdata('currency') == null) {
            $currencyArray = $this->currency->getCurrencyById('HUF');
            $this->session->set_userdata('currency', $currencyArray);
        }
        return $this->session->userdata('currency');
    }
    
    public function setWishlist($id){
        
        
        
    }
    
    

}
