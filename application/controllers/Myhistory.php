<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Myhistory extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion'));
    }

    private function languageSettings($language = 'en') {
        $output['lang'] = $language;
        $output['preferedlang'] = getPreferedLang();

        $this->lang->load('menu/menu', getLangFile($language));

        $output['home']             = $this->lang->line("home");
        $output['login']            = $this->lang->line("login");
        $output['logout']           = $this->lang->line("logout");
        $output['profile']          = $this->lang->line("profile");
        $output['registration']     = $this->lang->line("registration");
        $output['language']         = $this->lang->line("language");
        $output['my_history']       = $this->lang->line("my_history");
        $output['my_wishlist']      = $this->lang->line("my_wishlist");
        $output['cart']             = $this->lang->line("cart");
        $output['hu']               = $this->lang->line("hu");
        $output['en']               = $this->lang->line("en");
        $output['de']               = $this->lang->line("de");

        foreach ($output['preferedlang'] as $key => $value) {
            $output[$key] = $this->lang->line($key);
        }
       
        //footer
        $this->lang->load('footer/footer', getLangFile($language));
        $output['term_conditions'] = $this->lang->line("term_conditions");
        $output['faq'] = $this->lang->line("faq");
        $output['legal'] = $this->lang->line("legal");
        $output['contact'] = $this->lang->line("contact");
        $output['sitemap'] = $this->lang->line("sitemap");

        return $output;
    }

    private function getLanguageSettings() {
        if ($this->session->userdata('language') == null) {
            $this->session->set_userdata('language', substr($this->agent->languages()[0],0,2));
        }
        return $this->session->userdata('language');
    }

    private function getCurrencySettings() {
        if ($this->session->userdata('currency') == null) {
            $currencyArray = $this->currency->getCurrencyById('HUF');
            $this->session->set_userdata('currency', $currencyArray);
        }
        return $this->session->userdata('currency');
    }

    private function getHistory(){
        if($this->session->userdata('history') != null && is_array($this->session->userdata('history'))){
            return $this->promotion->getPromotionsFromList($this->session->userdata('history'), $this->getCurrencySettings());
        }
        return array();
    }
    
    private function getHistoryCount(){
        if($this->session->userdata('history') != null){
            return count(array_unique($this->session->userdata('history')));
        }else{
            return 0; 
        }
    }
    
    public function index() {
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency'] = $this->getCurrencySettings();
        $output['historycount']= $this->getHistoryCount();
        $output['history']  = $this->getHistory();
        $output['loggedin'] = false;
        $output['fullname'] = '';
        if ($this->session->userdata('logged_in') !== null) {
            $output['loggedin'] = true;
            $output['fullname'] = $this->session->userdata('logged_in')['fullname'];
            $this->load->view('myhistory', $output);
        } else {
            $this->load->view('myhistory', $output);
        }
    }
}
