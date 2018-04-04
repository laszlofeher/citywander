<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends CI_Controller {

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
        $this->load->model(array('basemodel', 'promotion','promotion','settings','messages'));
        $this->load->library(array('form_validation', 'email', 'emailfill', 'cart'));
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
        //carousel from home
        $this->lang->load('home/home', getLangFile($language));

        $output["what_do_you_want_to_do_in_budapest"] = $this->lang->line("what_do_you_want_to_do_in_budapest");
        $output["when_are_you_travelling"] = $this->lang->line("when_are_you_travelling");

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

    private function getHistoryCount(){
        if($this->session->userdata('history') != null){
            return count(array_unique($this->session->userdata('history')));
        }else{
            return 0; 
        }
    }
    /*
     * promotion id -t kell megadni
     */
    public function index($id=-1) {
        $id=(int)$id;
        //form validation
        $this->form_validation->set_rules('promotionid', 'promotionid', 'trim|required');
        $this->form_validation->set_rules('rate', 'Rate', 'trim|required|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('memo', 'Memo', 'trim|required|alpha_numeric_spaces');

        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency'] = $this->getCurrencySettings();
        $output['historycount']= $this->getHistoryCount();
        $output['promotiondetail'] = $this->promotion->getPromotionDetail((int) $id,$output['currency']);
        
        $output['loggedin'] = false;
        $output['fullname'] = '';
        if ($this->session->userdata('logged_in') !== null) {
            $output['cartcontent']  = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
            //ha már szavazott, akkor ne tudjon többször.
            $output['ratingthisvisitorthispromotion'] = $this->promotion->getRatingByPromotionIdVisitorId($id,$this->session->userdata('logged_in')['id']);
            if ($this->form_validation->run() === FALSE) {
                $output['loggedin'] = true;
                $output['fullname'] = $this->session->userdata('logged_in')['fullname'];
                $this->load->view('rating', $output);
            }else{
                $recaptchaResponse  = trim($this->input->post('g-recaptcha-response'));
                $userIp             = $this->input->ip_address();

                $secret = '6LcwiEAUAAAAAJAnDY5wmBckpXxLXZXAuSiG_AtI';
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip;=" . $userIp;
                $response = file_get_contents($url);
                $status = json_decode($response, true);
                if ($status['success']) {
                    $this->saverating();
                    $output['message'] = $this->messages->getMessage("_after_rating",$this->getLanguageSettings());
                    if ($this->session->userdata('logged_in')) {
                        $output['loggedin'] = true;
                    } else {
                        $output['loggedin'] = false;
                    }
                    $this->load->view('message', $output);
                }else{
                    if ($this->session->userdata('logged_in') !== null) {
                        $output['loggedin'] = true;
                        $output['fullname'] = $this->session->userdata('logged_in')['fullname'];
                        $output['recaptchaerror'] = 'Recaptcha error';
                        $this->load->view('rating', $output);
                    }
                }
            }
        } else {
            redirect("index.php/home");
        }
    }
    
    
    public function saverating(){
        $promotionid    = $this->input->post('promotionid');
        $rate           = $this->input->post('rate');
        $memo           = trim($this->input->post('memo'));
        $this->promotion->saveRating($promotionid, $rate, $memo, $this->session->userdata('logged_in')['id']);
       
        return true;
    }
}