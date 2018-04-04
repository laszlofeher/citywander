<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion','visitor', 'messages','settings','buyeracquisitormodel'));
        $this->load->library(array('form_validation', 'email', 'emailfill', 'cart','facebooklogin','googlelogin'));
        $this->load->helper(array('form','string2'));
        //$this->config->load('email', TRUE);
    }
   
    private function languageSettings($language = 'en') {
        $output['lang']         = $language;
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
        $this->lang->load('carousel/carousel', getLangFile($language));
        $output["what_do_you_want_to_do_in_budapest"] = $this->lang->line("what_do_you_want_to_do_in_budapest");
        $output["when_are_you_travelling"] = $this->lang->line("when_are_you_travelling");
        $output["search"] = $this->lang->line("search");
        
        $this->lang->load('registration/registration', getLangFile($language));
        //registration
        $output['registration']     = $this->lang->line("registration");
        $output['fullname']         = $this->lang->line("fullname");
        $output['mobile']           = $this->lang->line("mobile");
        $output['password']         = $this->lang->line("password");
        $output['confirm_password'] = $this->lang->line("confirm_password");
        $output['register']         = $this->lang->line("register");
        //registration placeholder 
        $output['type_in_your_fullname']          =  $this->lang->line("type_in_your_fullname"); 
        $output['type_in_your_email']             =  $this->lang->line("type_in_your_email"); 
        $output['type_in_your_phone_number']      =  $this->lang->line("type_in_your_phone_number"); 
        $output['type_in_your_password']          =  $this->lang->line("type_in_your_password"); 
        $output['type_in_your_password_again']    =  $this->lang->line("type_in_your_password_again"); 
        
        $output['i_subscribe_to_the_newsletter']    = $this->lang->line("i_subscribe_to_the_newsletter");
        $output['i_accept_the']                     = $this->lang->line("i_accept_the");                
        $output['terms_and_conditions']             = $this->lang->line("terms_and_conditions");        
        $output['sign_in_with_facebook']            = $this->lang->line("sign_in_with_facebook");      
        $output['sign_in_with_google']              = $this->lang->line("sign_in_with_google");         
        
        //footer
        $this->lang->load('footer/footer', getLangFile($language));
        $output['term_conditions']  = $this->lang->line("term_conditions");
        $output['faq']              = $this->lang->line("faq");
        $output['legal']            = $this->lang->line("legal");
        $output['contact']          = $this->lang->line("contact");
        $output['sitemap']          = $this->lang->line("sitemap");

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
    
    public function index($language = '') {
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        $output['facebookurl']  = $this->facebooklogin->createLink("http://citywander.website/index.php/login/facebooklogin");
        $output['googleurl']    = $this->googlelogin->loginURL();
        
        //registration rules
        //$this->form_validation->set_rules('firstname', 'Vezetéknév', 'trim|required');
        //$this->form_validation->set_rules('lastname', 'Keresztnév', 'trim|required');
        $this->form_validation->set_rules('fullname', 'Teljes név', 'trim|required');
        $this->form_validation->set_rules('emailaddress', 'Email cím', 'trim|required|valid_email|is_unique[visitor.emailaddress]');
        //$this->form_validation->set_rules('mobile', 'Mobil telefonszám', 'trim|required|callback_checkPhone');
        $this->form_validation->set_rules('password1', 'Jelszó ', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password2', 'Jelszó újra', 'trim|required|min_length[6]|matches[password1]');
        //$this->form_validation->set_rules('sponsoremail', 'Ajánló email', 'trim|valid_email');
        $this->form_validation->set_rules('terms', 'Terms', '');
        
        $recaptchaResponse  = trim($this->input->post('g-recaptcha-response'));
        $userIp             = $this->input->ip_address();
        
        $secret = '6LcwiEAUAAAAAJAnDY5wmBckpXxLXZXAuSiG_AtI';
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip;=" . $userIp;
        $response = file_get_contents($url);
       
        $status = json_decode($response, true);
        if ($status['success']) {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('registration', $output);
            } else {
                if($this->input->post('terms') == null){
                    $this->form_validation->set_message('terms', 'Kérem töltse ki a Jogi nyilatkozatot!');
                    $this->load->view('registration', $output);
                }else{
                    $this->saveuser();
                    $output = array();
                    //language settings
                    $output = $this->languageSettings($this->getLanguageSettings());
                    //end of language settings
                    //currency settings
                    $output['currency'] = $this->getCurrencySettings();
                    $output['historycount']= $this->getHistoryCount();
        
                    $output['message'] = $this->messages->getMessage("_thanksforregistration",$this->getLanguageSettings());
                    if ($this->session->userdata('logged_in')) {
                        $output['loggedin'] = true;
                    } else {
                        $output['loggedin'] = false;
                    }
                    $this->load->view('message', $output);
                }
            }
        }else{
            $output['error_message'] = 'Error reCaptcha!';
            $this->load->view('registration', $output);
        }
    }

    public function regWithBuyeracquisitor($id = -1) {
        $id = (int)$id;
        //check id is exist 
        $buyeraquisitor = $this->buyeracquisitormodel->getBuyerAquisitor($id);
        if(count($buyeraquisitor) > 0){
            //language settings
            $output = array();
            //language settings
            $output = $this->languageSettings($this->getLanguageSettings());
            //end of language settings
            //currency settings
            $output['currency']     = $this->getCurrencySettings();
            $output['historycount'] = $this->getHistoryCount();
            $output['facebookurl']  = $this->facebooklogin->createLink("http://citywander.website/index.php/login/facebooklogin");
            $output['googleurl']    = $this->googlelogin->createLink("http://citywander.website/index.php/login/googlelogin");
            
            $output['withbuyeraquisitor'] = 1;
            $output['buyeraquisitor_id']  = $buyeraquisitor[0]['bid'];
            $output['buyeraquisitor_name']= $buyeraquisitor[0]['company'];
            
            //registration rules
            //$this->form_validation->set_rules('firstname', 'Vezetéknév', 'trim|required');
            //$this->form_validation->set_rules('lastname', 'Keresztnév', 'trim|required');
            $this->form_validation->set_rules('fullname', 'Teljes név', 'trim|required');
            $this->form_validation->set_rules('emailaddress', 'Email cím', 'trim|required|valid_email|is_unique[visitor.emailaddress]');
            //$this->form_validation->set_rules('mobile', 'Mobil telefonszám', 'trim|required|callback_checkPhone');
            $this->form_validation->set_rules('password1', 'Jelszó ', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('password2', 'Jelszó újra', 'trim|required|min_length[6]|matches[password1]');
            //$this->form_validation->set_rules('sponsoremail', 'Ajánló email', 'trim|valid_email');
            $this->form_validation->set_rules('terms', 'Terms', '');

            $recaptchaResponse  = trim($this->input->post('g-recaptcha-response'));
            $userIp             = $this->input->ip_address();

            $secret = '6LcwiEAUAAAAAJAnDY5wmBckpXxLXZXAuSiG_AtI';
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip;=" . $userIp;
            $response = file_get_contents($url);

            $status = json_decode($response, true);
            if ($status['success']) {
                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('registration', $output);
                } else {
                    if($this->input->post('terms') == null){
                        $this->form_validation->set_message('terms', 'Kérem töltse ki a Jogi nyilatkozatot!');
                        $this->load->view('registration', $output);
                    }else{
                        $this->saveuser();
                        $output = array();
                        //language settings
                        $output = $this->languageSettings($this->getLanguageSettings());
                        //end of language settings
                        //currency settings
                        $output['currency'] = $this->getCurrencySettings();
                        $output['historycount']= $this->getHistoryCount();

                        $output['message'] = $this->messages->getMessage("_thanksforregistration",$this->getLanguageSettings());
                        if ($this->session->userdata('logged_in')) {
                            $output['loggedin'] = true;
                        } else {
                            $output['loggedin'] = false;
                        }
                        $this->load->view('message', $output);
                    }
                }
            }else{
                $output['error_message'] = 'Error reCaptcha!';
                $this->load->view('registration', $output);
            }
        }else{

        }
    }
    
    function saveuser() {
        //read field
        $fullname               = $this->input->post('fullname');
        $emailaddress           = $this->input->post('emailaddress');
        $password1              = $this->input->post('password1');
        $password2              = $this->input->post('password2');
        $buyeracquisitor_id     = (int)$this->input->post('buyeracquisitor_id');
        
        $nsalt = uniqid(mt_rand(), true);
        $npassword = hash('sha512', $password1 . $nsalt);
        //egyéb hiba ellenőrzések
        //registráció

        if($buyeracquisitor_id > 0){
            $lastid = $this->visitor->addVisitorFirst($fullname, $emailaddress, $npassword, $nsalt,'',1, $buyeracquisitor_id);
        }else{
            $lastid = $this->visitor->addVisitorFirst($fullname, $emailaddress, $npassword, $nsalt,'',1, -1);
        }
        
        //generate string
        $generatedString = checkeduserGenerate($lastid);
        //save checkedUserString
        $this->visitor->updateCheckedVisitorString($lastid, $generatedString);
        $this->sendMail('assets/template/thanksregistration.html',$fullname, $emailaddress, $generatedString);
    }

    private function sendMail($template, $fullname, $emailaddress, $chekeduserstring='') {
        
        $frommail = $this->settings->getTextSettingsByName('_fromregistration')['value'];
        $replyeregistration = $this->settings->getIntSettingsByName('_replyregistratrion')['value'];
        $replyeregistrationemail = $this->settings->getTextSettingsByName('_replyregistrationemail')['value'];
        $registrationemailsubject = $this->settings->getTextSettingsByName('_registrationemailsubject')['value'];
        
        $newvalue= array();
        $newvalue['name']       = $fullname;
        $newvalue['cus']        = $chekeduserstring;
        $newvalue['regdate']    = date("Y.m.d");      
        $content                = $this->emailfill->templateFill($template,$newvalue);
        $result = null;
        if((int)$replyeregistration ==1){
            $result = $this->email
                ->from($frommail)
                ->reply_to($replyeregistrationemail)    // Optional, an account where a human being reads.
                ->to($emailaddress)
                ->subject($registrationemailsubject)
                ->message($content)
                ->send();
        }else{
            $result                 = $this->email
                ->from($frommail)
                ->to($emailaddress)
                ->subject($registrationemailsubject)
                ->message($content)
                ->send();
        }
    }

    
    
    public function registredCheckedVisitor($checkeduserstring){
        $registreduser_id = -1;
        if(strlen($checkeduserstring) > 0){
            $registreduser_id = $this->visitor->updateCheckedVisitor($checkeduserstring);
        }
        if($registreduser_id > 0){
            $registreduserdata = $this->visitor->getVisitorById($registreduser_id);
            //$this->sendMailMaster();
            $this->sendMail('assets/template/registrationtemplate.html', $registreduserdata['firstname'], $registreduserdata['lastname'], $registreduserdata['emailaddress']); 
        }
        $output             = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency'] = $this->getCurrencySettings();
        $output['historycount']= $this->getHistoryCount();
        // set messages
        $output['message']  = $this->messages->getMessage("_thanksforregistration",$this->getLanguageSettings());
        if($this->session->userdata('logged_in')){
            $output['loggedin']     = true;
        }else{
            $output['loggedin']     = false;
        } 
        $this->load->view('message', $output);
    }
    
    /*
     * 
     */
    /*
    public function checkPhone($phonenumber){
        if(preg_match("/^([0-9\(\)\/\+ \-]*)$/", $phonenumber)) {
            return true;
        }
        return false;
    }
    */

}
