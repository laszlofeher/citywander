<?php

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion','settings'));
        $this->load->helper(array('string2'));
    }

    private function languageSettings($language = 'en') {
        $output['lang']             = $language;
        $output['preferedlang']     = getPreferedLang();

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

        $output['things_to_do']                         = $this->lang->line("things_to_do");
        $output['sightseeing']                          = $this->lang->line("sightseeing");
        $output['activities']                           = $this->lang->line("activities");
        $output['packages']                             = $this->lang->line("packages");
        $output['must_try']                             = $this->lang->line("must_try");
        
        $this->lang->load('carousel/carousel', getLangFile($language));
        
        $output["what_do_you_want_to_do_in_budapest"]   = $this->lang->line("what_do_you_want_to_do_in_budapest");
        $output["when_are_you_travelling"]              = $this->lang->line("when_are_you_travelling");
        $output["search"]                               = $this->lang->line("search");
        $output["carousel_text"]                        = $this->lang->line("carousel_text");

        //page next text
        $output['popular_things_to_do']                 = $this->lang->line("popular_things_to_do");

        $output['hop_on_hop_off']                       = $this->lang->line("hop_on_hop_off");
        $output['authentic']                            = $this->lang->line("authentic");
        $output['gastro']                               = $this->lang->line("gastro");
        $output['budapest_spa']                         = $this->lang->line("budapest_spa");

        $output['top_sightseeings']                     = $this->lang->line("top_sightseeings");
        
        $output['i_want_something_else']                = $this->lang->line("i_want_something_else");
        $output['get_in_touch_budapest_assistant']      = $this->lang->line("get_in_touch_budapest_assistant");
        
        $output['top_activities']                       = $this->lang->line("top_activities");
        $output['view_all']                             = $this->lang->line("view_all");
        //footer
        $this->lang->load('footer/footer', getLangFile($language));
        $output['term_conditions']                      = $this->lang->line("term_conditions");
        $output['faq']                                  = $this->lang->line("faq");
        $output['legal']                                = $this->lang->line("legal");
        $output['contact']                              = $this->lang->line("contact");
        $output['sitemap']                              = $this->lang->line("sitemap");
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
    
    public function index() {
        $output = array();
        
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']         = $this->getCurrencySettings();
        $output['historycount']     = $this->getHistoryCount();
        $output['loggedin']         = false;
        $output['fullname']         = '';

        if ($this->session->userdata('logged_in') !== null) {
            $output['cartcontent']      = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
            $output['loggedin']     = true;
            $output['fullname']     = $this->session->userdata('logged_in')['fullname'];
            $this->load->view('dashboard', $output);
        } else {
            $output['cartcontent']  = $this->cart->contents();
            $this->load->view('dashboard', $output);
        }
    }
}