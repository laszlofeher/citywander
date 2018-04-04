<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion','settings','visitor','boughtmodel'));
        $this->load->helper(array('string2'));
        $this->load->library(array('paypal_lib'));
    }

    private function languageSettings($language = 'en') {
        $output['lang'] = $language;
        $output['preferedlang'] = getPreferedLang();

        $this->lang->load('menu/menu', getLangFile($language));

        $output['home']         = $this->lang->line("home");
        $output['login']        = $this->lang->line("login");
        $output['logout']       = $this->lang->line("logout");
        $output['profile']      = $this->lang->line("profile");
        $output['registration'] = $this->lang->line("registration");
        $output['language']     = $this->lang->line("language");
        $output['my_history']   = $this->lang->line("my_history");
        $output['my_wishlist']  = $this->lang->line("my_wishlist");
        $output['cart']         = $this->lang->line("cart");
        $output['hu']           = $this->lang->line("hu");
        $output['en']           = $this->lang->line("en");
        $output['de']           = $this->lang->line("de");

        foreach ($output['preferedlang'] as $key => $value) {
            $output[$key] = $this->lang->line($key);
        }
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

        $output['hop_on_hop_off'] = $this->lang->line("hop_on_hop_off");
        $output['authentic'] = $this->lang->line("authentic");
        $output['gastro'] = $this->lang->line("gastro");
        $output['budapest_spa'] = $this->lang->line("budapest_spa");

        $output['top_sightseeings'] = $this->lang->line("top_sightseeings");
        
        $output['i_want_something_else'] = $this->lang->line("i_want_something_else");
        $output['get_in_touch_budapest_assistant'] = $this->lang->line("get_in_touch_budapest_assistant");
        
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
    
    public function index(){
        $output                 = array();
        //language settings
        $output                 = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        $output['loggedin']     = false;
        $output['fullname']     = '';
        $output['sum']          = 0;
        $output['count']        = 0;
        
        if ($this->session->userdata('logged_in') !== null) {
            $output['cartcontent']      = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
            $output['loggedin']         = true;
            
            $output['fullname']         = $this->session->userdata('logged_in')['fullname'];
            $output['firstname']        = $this->session->userdata('logged_in')['firstname'];
            $output['lastname']         = $this->session->userdata('logged_in')['lastname'];
            $output['mobile']           = $this->session->userdata('logged_in')['mobile'];
            $output['email']            = $this->session->userdata('logged_in')['username'];
            
            $this->form_validation->set_rules('leadtravelerfirstname','Lead traveller first name','trim|required');
            $this->form_validation->set_rules('leadtravelerlastname','Lead traveller last name','trim|required');
            $this->form_validation->set_rules('leadtravelerfirstname2','Lead traveller first name 2','trim|required');
            $this->form_validation->set_rules('leadtravelerlastname2','Lead traveller last name 2','trim|required');
            if($this->form_validation->run() === false){
                $this->load->view('checkout', $output);
            }else{
                $boughtId   = $this->saveDetails();
                $bought     = $this->boughtmodel->getBought($boughtId);
                if($bought[0]['paytype'] == 'paypal'){
                     $this-> payWithPaypal('Rendelés szám', $bought[0]['firstname'].' '.$bought[0]['lastname'], '1', $bought[0]['sumprice']);
                }
            }
            $this->load->view('checkout', $output);
        } else {
            foreach ($this->cart->contents() as $key => $value) {
                $promotionoption = $this->promotion->getPromotionOptionByPromotionOptionId($value['id'], $this->getCurrencySettings()['id']);
                $data = array(
                    'rowid' => $key,
                    'price' => ($promotionoption[0]['adultsprice']*$value['options']['adultcount'])+($promotionoption[0]['childrenprice']*$value['options']['childrencount'])+($promotionoption[0]['infantsprice']*$value['options']['infantscount'])
                );
                $output['sum'] += (float)(float)($promotionoption[0]['adultsprice']*$value['options']['adultcount'])+($promotionoption[0]['childrenprice']*$value['options']['childrencount'])+($promotionoption[0]['infantsprice']*$value['options']['infantscount']);
                $this->cart->update($data);
                $output['count']++;
            }
            $output['cartcontent'] = $this->cart->contents();
            $this->form_validation->set_rules('leadtravelerfirstname','Lead traveller first name','trim|required');
            $this->form_validation->set_rules('leadtravelerlastname','Lead traveller last name','trim|required');
            $this->form_validation->set_rules('leadtravelerfirstname2','Lead traveller first name 2','trim|required');
            $this->form_validation->set_rules('leadtravelerlastname2','Lead traveller last name 2','trim|required');
            $this->form_validation->set_rules('firstname','First name','trim|required');
            $this->form_validation->set_rules('lastname','Last name','trim|required');
            $this->form_validation->set_rules('mobile','Mobile','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required');
            $this->form_validation->set_rules('confirmemail','Confirm email','trim|required');

            if($this->form_validation->run() === false){
                $this->load->view('checkout', $output);
            }else{
                $boughtId   = $this->saveDetails();
                $bought     = $this->boughtmodel->getBought($boughtId);
                if($bought[0]['paytype'] == 'paypal'){
                     $this-> payWithPaypal('Rendelés szám', $bought[0]['firstname'].' '.$bought[0]['lastname'], '1', $bought[0]['sumprice']);
                }
            }
        }
    }
    
    public function saveDetails(){
        if($this->session->userdata('logged_in') !== null){
            $cartitems = [];
            foreach ($this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']) as $row) {
                $cartitems[] = array('promotion_option_id'   => $row['id'],
                                     'price'                 => $row['price'],
                                     'adultcount'            => $row['options']['adultcount'],
                                     'childrencount'         => $row['options']['childrencount'],
                                     'infantscount'          => $row['options']['infantscount'],
                                     'year'                  => $row['options']['year'],
                                     'month'                 => $row['options']['month'],
                                     'day'                   => $row['options']['day']
                );
            }
            
            //detail
            $leadtravelerfirstname  = $this->input->post('leadtravelerfirstname');
            $leadtravelerlastname   = $this->input->post('leadtravelerlastname');
            $leadtravelerfirstname2 = $this->input->post('leadtravelerfirstname2');
            $leadtravelerlastname2  = $this->input->post('leadtravelerlastname2');
            $payType                = $this->input->post('pay');
            
            $visitorId              = $this->session->userdata('logged_in')['id'];
            $bought = array(
                'leadtravelerfirstname'     => $leadtravelerfirstname,
                'leadtravelerlastname'      => $leadtravelerlastname,
                'leadtravelerfirstname2'    => $leadtravelerfirstname2,
                'leadtravelerlastname2'     => $leadtravelerlastname2,
                'visitor_id'                => $visitorId,
                'items'                     => $cartitems,
                'paytype'                   => $payType
            );
            
            $boughtid = $this->boughtmodel->saveBought($bought);
            //delete cart
            foreach ($this->cart->contents() as $key => $value) {
                $data = array(
                        'rowid'   => $key,
                        'qty'     => 0
                        );
                $this->cart->update($data); 
            }
        }else{
            //cart
            $cartitems = [];
            foreach ($this->cart->contents() as $row) {
                $cartitems[] = array('promotion_option_id'   => $row['id'],
                                     'price'                 => $row['price'],
                                     'adultcount'            => $row['options']['adultcount'],
                                     'childrencount'         => $row['options']['childrencount'],
                                     'infantscount'          => $row['options']['infantscount'],
                                     'year'                  => $row['options']['year'],
                                     'month'                 => $row['options']['month'],
                                     'day'                   => $row['options']['day']
                );
            }
            
            //detail
            $leadtravelerfirstname  = $this->input->post('leadtravelerfirstname');
            $leadtravelerlastname   = $this->input->post('leadtravelerlastname');
            $leadtravelerfirstname2 = $this->input->post('leadtravelerfirstname2');
            $leadtravelerlastname2  = $this->input->post('leadtravelerlastname2');
            $payType                = $this->input->post('pay');
            
            $firstname              = $this->input->post('firstname');
            $lastname               = $this->input->post('lastname');
            $mobile                 = $this->input->post('mobile');
            $email                  = $this->input->post('email');
            
            $visitorId = $this->visitor->addVisitor($firstname, 
                $lastname, $email,
                '', '', $mobile,
                $facebook_id='',$google_id='',$newsletter = 0,
                $sponsoremail='');
            
            $bought = array(
                'leadtravelerfirstname'     => $leadtravelerfirstname,
                'leadtravelerlastname'      => $leadtravelerlastname,
                'leadtravelerfirstname2'    => $leadtravelerfirstname2,
                'leadtravelerlastname2'     => $leadtravelerlastname2,
                'visitor_id'                => $visitorId,
                'items'                     => $cartitems,
                'paytype'                   => $payType
            );
            
            $boughtid = $this->boughtmodel->saveBought($bought);
            //delete cart
            foreach ($this->cart->contents() as $key => $value) {
                $data = array(
                        'rowid'   => $key,
                        'qty'     => 0
                        );
                $this->cart->update($data); 
            }
        }
        return $boughtid;
        
    } 
    
    public function checkEmail(){
        $email          = $this->input->post('email');
        $visitorDetail  = $this->visitor->getVisitorByEmail($email);
        if(count($visitorDetail) > 0){
            print('exist_email');
        }else{
            print('not_exist_email');
        }        
    }
    
    function success(){
        //get the transaction data
        $paypalInfo = $this->input->get();
        $data['item_number']        = $paypalInfo['item_number']; 
        $data['txn_id']             = $paypalInfo["tx"];
        $data['payment_amt']        = $paypalInfo["amt"];
        $data['currency_code']      = $paypalInfo["cc"];
        $data['status']             = $paypalInfo["st"];
        
        //pass the transaction data to view
        $this->load->view('paypal/success', $data);
    }
     
    function cancel(){
        $this->load->view('paypal/cancel');
    }
     
    function ipn(){
        //paypal return transaction details array
        $paypalInfo                 = $this->input->post();
        $data['user_id']            = $paypalInfo['custom'];
        $data['product_id']         = $paypalInfo["item_number"];
        $data['txn_id']             = $paypalInfo["txn_id"];
        $data['payment_gross']      = $paypalInfo["mc_gross"];
        $data['currency_code']      = $paypalInfo["mc_currency"];
        $data['payer_email']        = $paypalInfo["payer_email"];
        $data['payment_status']     = $paypalInfo["payment_status"];

        $paypalURL                  = $this->paypal_lib->paypal_url;        
        $result                     = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
            $this->product->insertTransaction($data);
        }
    }
    public function payWithPaypal($item_name, $custom, $item_number, $amount){
        //Set variables for paypal form
        $returnURL = base_url().'paypal/success'; //payment success url
        $cancelURL = base_url().'paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'paypal/ipn'; //ipn url

        $logo = base_url().'assets/images/codexworld-logo.png';

        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $item_name);
        $this->paypal_lib->add_field('custom', $custom);
        $this->paypal_lib->add_field('item_number', $item_number);
        $this->paypal_lib->add_field('amount', $amount);        
        $this->paypal_lib->image($logo);

        $this->paypal_lib->paypal_auto_form();
    }
}