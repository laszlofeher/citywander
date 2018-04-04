<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion','settings','visitor','messages'));
        $this->load->library(array('form_validation','emailfill','email'));
        $this->load->helper(array('string2'));
    }
    
    private function languageSettings($language = 'en') {
        $output['lang'] = $language;
        $output['preferedlang'] = getPreferedLang();

        $this->lang->load('menu/menu', getLangFile($language));
         $output['home']            = $this->lang->line("home");
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
        
        $this->lang->load('home/home', getLangFile($language));

        $output['things_to_do'] = $this->lang->line("things_to_do");
        $output['sightseeing'] = $this->lang->line("sightseeing");
        $output['activities'] = $this->lang->line("activities");
        $output['packages'] = $this->lang->line("packages");
        $output['must_try'] = $this->lang->line("must_try");
        $output["what_do_you_want_to_do_in_budapest"] = $this->lang->line("what_do_you_want_to_do_in_budapest");
        $output["when_are_you_travelling"] = $this->lang->line("when_are_you_travelling");
        $output["search"] = $this->lang->line("search");

        //page next text
        $output['popular_things_to_do'] = $this->lang->line("popular_things_to_do");
        $output['top_sightseeings'] = $this->lang->line("top_sightseeings");
        $output['top_activities'] = $this->lang->line("top_activities");
        $output['view_all'] = $this->lang->line("view_all");
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
    
    private function getHistoryCount() {
        if ($this->session->userdata('history') != null) {
            return count(array_unique($this->session->userdata('history')));
        } else {
            return 0;
        }
    }
    
    private function sendMessage($messageType, $output){
        $output['message']      = $this->messages->getMessage($messageType,$this->getLanguageSettings());
        if ($this->session->userdata('logged_in')) {
            $output['loggedin'] = true;
        } else {
            $output['loggedin'] = false;
        }
        $this->load->view('message', $output);
    }
        
    public function index(){
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['loggedin']     = false;
        $output['fullname']     = '';
        
        $this->form_validation->set_rules('emailaddress', 'Email', 'trim|required|callback_checkemail');
        if($this->form_validation->run() === TRUE){
            $this->sendMessage('_forgotpassword', $output);
        }else{
            $this->load->view('forgotpassword', $output);
        }
    }
        
    public function checkemail(){
        $visitorEmail = $this->input->post('emailaddress');
        $visitorArray = $this->visitor->getVisitorByEmail($visitorEmail);
        $resetid = '';
        if(count($visitorArray) > 0){
            $resetid = checkeduserGenerate($visitorArray['id']);
            $this->visitor->updateVisitorResetid($visitorEmail, $resetid);
            $this->sendMail('assets/template/forgotpasswordtemplate.html', $visitorArray['firstname'].' '.$visitorArray['lastname'], $visitorArray['emailaddress'], $resetid);
            return true;
        }
        $this->form_validation->set_message('checkemail', 'Az {field} nem szerepel a nyilvántartásban ');
        return false;
    }
    
    public function resetpassword($resetid){
        $visitor = $this->visitor->getResetpassword($resetid);
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['loggedin']     = false;
        $output['fullname']     = '';
        
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|matches[password]|callback_newpassword');
        if(count($visitor) > 0){
            if($this->form_validation->run() === TRUE){
                redirect('login');
            }else{
                $this->load->view('resetpassword', $output);
            }
        }else{
            $output['message'] = $this->messages->getMessage("_resetpassworderror",$this->getLanguageSettings());
            $this->load->view('message', $output);
        }
    }
    
    public function newpassword(){
        $password = $this->input->post('password');
        $nsalt = uniqid(mt_rand(), true);
        $npassword = hash('sha512', $password . $nsalt);
        $this->visitor->updateVisitorPassword();
    }
    
    private function sendMail($template, $fullname, $emailaddress, $resetid='') {
        
        $frommail = $this->settings->getTextSettingsByName('_fromregistration')['value'];
        $replyeregistration = $this->settings->getIntSettingsByName('_replyregistratrion')['value'];
        $replyeregistrationemail = $this->settings->getTextSettingsByName('_replyregistrationemail')['value'];
        $registrationemailsubject = $this->settings->getTextSettingsByName('_registrationemailsubject')['value'];
        
        $newvalue= array();
        $newvalue['name']       = $fullname;
        $newvalue['resetid']    = $resetid;
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
    
}