<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->load->model(array('basemodel', 'promotion','visitor'));
        $this->load->library(array());
        
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
        $this->lang->load('home/home', getLangFile($language));

        $output['things_to_do'] = $this->lang->line("things_to_do");
        $output['sightseeing'] = $this->lang->line("sightseeing");
        $output['activities'] = $this->lang->line("activities");
        $output['packages'] = $this->lang->line("packages");
        $output['must_try'] = $this->lang->line("must_try");
        
        $this->lang->load('carousel/carousel', getLangFile($language));
        
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
    
    public function index($language = '') {
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency'] = $this->getCurrencySettings();
        $output['historycount']= $this->getHistoryCount();
        
        
        $output['loggedin']     = false;
        $output['fullname']     = '';
        $output['facebookurl']  = $this->facebooklogin->createLink("http://citywander.website/index.php/login/facebooklogin");
        $output['googleurl']    = $this->googlelogin->loginURL();
        if ($this->session->userdata('logged_in') !== null) {
            $output['loggedin'] = true;
            $output['fullname'] = $this->session->userdata('logged_in')['fullname'];
            $this->load->view('home', $output);
        } else {
            $output['loggedin'] = false;
            //This method will have the credentials validation
            $this->form_validation->set_rules('emailaddress', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_checkvisitor');
            if ($this->form_validation->run() === FALSE) {
                //Field validation failed.  User redirected to login page
                $this->load->view('login', $output);
            } else {
                $output['loggedin'] = true;
                $output['fullname'] = $this->session->userdata('logged_in')['fullname'];
                redirect("index.php/home");
            }
        }
    
         
    }

    public function checkvisitor() {
        //Field validation succeeded.  Validate against database
        $emailaddress       = $this->input->post('emailaddress');
        $password           = $this->input->post('password');
        $recaptchaResponse  = trim($this->input->post('g-recaptcha-response'));
        $userIp             = $this->input->ip_address();
        
        $secret = '6LcwiEAUAAAAAJAnDY5wmBckpXxLXZXAuSiG_AtI';
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip;=" . $userIp;
        $response = file_get_contents($url);
       
        $status = json_decode($response, true);

        if ($status['success']) {
            //query the database
            $row = $this->visitor->login($emailaddress, $password);
            if ($row) {
                //if($row->templogin==1){
                //    redirect('templogin');				
                //}else{
                $sess_array = array(
                    'id'        => $row->id,
                    'username'  => $row->emailaddress,
                    'firstname' => $row->firstname,
                    'lastname'  => $row->lastname,
                    'mobile'    => $row->mobile,
                    'fullname'  => $row->firstname . ' ' . $row->lastname
                );
                $this->session->set_userdata('logged_in', $sess_array);
                return TRUE;
                //}
            }else{
                $this->form_validation->set_message('checkvisitor', 'Invalid username or password');
                /**
                 * login error logged
                 */
            }
        } else {
            return false;
        }
        return false;
    }
/*
 * object(stdClass)#24 (4) { ["id"]=> string(16) "2463095977249254" ["email"]=> string(20) "ruanderflp@gmail.com" ["first_name"]=> string(6) "Fehér" ["last_name"]=> string(15) "László Péter" }
 * 
 */
    
    public function facebooklogin(){
        $code = $this->input->get('code').'#_=_';
        $userdata           = $this->facebooklogin->getUserData($code,'http://citywander.website/index.php/login/facebooklogin');
        
        $facebook_id        =  $userdata["id"];
        $email              =  $userdata["email"];
        $first_name         =  $userdata["first_name"];
        $last_name          =  $userdata["last_name"];
        
        $visitorArrayEmail  = $this->visitor->getVisitorByEmail($email);
        if(count($visitorArrayEmail) > 0){
            $visitorArray = $this->visitor->getVisitorByFacebookId($facebook_id);
            if(count($visitorArray)>0){
                $sess_array = array(
                    'id'        => $visitorArray['id'],
                    'username'  => $visitorArray['emailaddress'],
                    'fullname'  => $visitorArray['firstname'] . ' ' . $visitorArray['last_name']
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }else{
                $this->visitor->updateVisitorWithFacebookid($visitorArrayEmail['id'],$facebook_id);
                $sess_array = array(
                    'id'        => $visitorArrayEmail['id'],
                    'username'  => $email,
                    'fullname'  => $first_name . ' ' . $last_name
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
        }else{
            $visitorArray = $this->visitor->getVisitorByFacebookId($facebook_id);
            if(count($visitorArray)>0){
                $sess_array = array(
                    'id'        => $visitorArray['id'],
                    'username'  => $visitorArray['emailaddress'],
                    'fullname'  => $visitorArray['firstname'] . ' ' . $visitorArray['last_name']
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }else{
                $lastid = $this->visitor->addVisitor($first_name, $last_name, $email,'', '', '', $facebook_id,0,'');
                $sess_array = array(
                    'id'        => $lastid,
                    'username'  => $email,
                    'fullname'  => $first_name . ' ' . $last_name
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
        }
        redirect('index.php/home');
    }
    
    public function googlelogin(){
        $code = $this->input->get('code');
        //authenticate user
        $this->googlelogin->getAuthenticate();
        //get user info from google
        $userdata = $this->googlelogin->getUserInfo();
        
        $google_id      =  $userdata["id"];
        $email          =  $userdata["email"];
        $first_name     =  $userdata["family_name"];
        $last_name      =  $userdata["given_name"];
        
        $visitorArrayEmail  = $this->visitor->getVisitorByEmail($email);
        if(count($visitorArrayEmail) > 0){
            $visitorArray = $this->visitor->getVisitorByGoogleId($google_id);
            if(count($visitorArray)>0){
                $sess_array = array(
                    'id' => $visitorArray['id'],
                    'username' => $visitorArray['emailaddress'],
                    'fullname' => $visitorArray['firstname'] . ' ' . $visitorArray['last_name']
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }else{
                $this->visitor->updateVisitorWithGoogleid($visitorArrayEmail['id'],$google_id);
                $sess_array = array(
                    'id'        => $visitorArrayEmail['id'],
                    'username'  => $email,
                    'fullname'  => $first_name . ' ' . $last_name
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
        }else{
            $visitorArray = $this->visitor->getVisitorByGoogleId($google_id);
            if(count($visitorArray)>0){
                $sess_array = array(
                    'id'        => $visitorArray['id'],
                    'username'  => $visitorArray['emailaddress'],
                    'fullname'  => $visitorArray['firstname'] . ' ' . $visitorArray['last_name']
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }else{
                $facebook_id = '';
                $lastid = $this->visitor->addVisitor($first_name, 
                $last_name, $email,
                '', '', '',
                $facebook_id, $google_id);
                $sess_array = array(
                    'id'        => $lastid,
                    'username'  => $email,
                    'fullname'  => $first_name . ' ' . $last_name
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
        }
        redirect('index.php/home');
    }
    
    
    
}
