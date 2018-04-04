<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
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
        $this->load->model(array('basemodel', 'promotion','settings'));
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

    private function getHistoryCount(){
        if($this->session->userdata('history') != null){
            return count(array_unique($this->session->userdata('history')));
        }else{
            return 0; 
        }
    }
    
    public function index($settingsname) {
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency'] = $this->getCurrencySettings();
        $output['historycount']= $this->getHistoryCount();
        $output['message'] = $this->settings->getFooterText($settingsname,$this->getLanguageSettings()); 
        
        $output['loggedin'] = false;
        $output['fullname'] = '';
        if ($this->session->userdata('logged_in') !== null) {
            $output['cartcontent']      = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
            $output['loggedin']         = true;
            $output['fullname']         = $this->session->userdata('logged_in')['fullname'];
            $this->load->view('message', $output);
        } else {
            $output['cartcontent']     = $this->cart->contents();
            $this->load->view('message', $output);
        }
    }
    
    public function aboutus(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('pagewithtextcontent', $output);
    }
    
    public function whyworkwithus(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('pagewithtextcontent', $output);
    }
    
    public function newsuppliers(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('pagewithtextcontent', $output);
    }
    
    public function travelagents(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('pagewithtextcontent', $output);
    }
    
    public function helpdesk(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('pagewithtextcontent', $output);
    }
    
    public function faq(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('faq', $output);
    }
    
    public function groupsservices(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('pagewithtextcontent', $output);
    }
    
    public function termsconditions(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('pagewithtextcontent', $output);
    }
    
    public function privacypolicy(){
        //language settings
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        
        $output['content']  = " Lorem ipsum dolor sit amet, nam aliquam, a ad, wisi massa possimus magnis lectus pretium scelerisque. Nulla et mauris non felis, eget pellentesque quam, consequatur est, semper ut, suspendisse in morbi sed tempus qui. Morbi mauris fusce sollicitudin lorem. Velit porta felis mattis massa fusce. In quis nam, massa sagittis feugiat vestibulum morbi eleifend, volutpat augue eu integer dictum quia. Lectus pede suspendisse nam sapien gravida ut. Id blandit porta laoreet commodo fusce, tortor ut quis a aenean metus. Scelerisque hendrerit non, enim nec nulla nunc nulla, et vestibulum interdum dictum, scelerisque molestie laoreet pellentesque eu sed arcu. A adipiscing tortor.
                                Wisi magna sed sit, venenatis imperdiet at eu sodales neque sit, iusto pulvinar egestas risus blandit dictum magnis, in convallis per et sed lacinia felis. In ac pede non imperdiet ut. Massa donec vestibulum tempus eros odio. Dui diam lacus, integer semper, lacus amet consectetuer, sed lacus sem lobortis. In imperdiet enim consectetuer sed pharetra ac, eros ipsum viverra vestibulum tempor fusce dolor, pede tellus. Dui at sed, velit sed consectetuer, id feugiat nulla semper amet hac.
                                Faucibus scelerisque odio eros venenatis ante, non id curabitur scelerisque tincidunt et purus, felis nam est laoreet impedit, orci cras euismod vel. Et nibh sem duis sem sit suspendisse. Tortor vitae rutrum fermentum in, curae dui conubia ut sit ante mollis, id venenatis, mauris ac dignissimos magnis dui, condimentum tempus sed. Natoque amet, nonummy vel orci, sed a fusce aliquam euismod a. Eget tellus scelerisque vitae varius, integer malesuada orci tellus, nullam risus ac mauris, quo justo lorem ipsum, gravida nec. Fringilla risus neque mollis erat est, ut pede dapibus, malesuada vestibulum auctor lacus diam egestas. Et morbi, convallis et nulla tellus, eget cupiditate aliquam phasellus gravida.
                                Rutrum nulla et iaculis, ultricies non montes mi, lectus sociis et, consectetuer id rem netus sodales sit odio, mattis eu sem pede urna interdum nullam. Cras magna turpis quis, dolor consectetuer duis etiam pulvinar, gravida quis non elit at, sollicitudin convallis neque imperdiet dictumst enim nulla. Elit rutrum venenatis justo integer velit phasellus. Non pharetra, condimentum metus mauris porta sit urna, et eros lacinia imperdiet, scelerisque tortor nec ultricies sed fusce vivamus, magnis leo. Ea neque nulla, suscipit aliquet nam nam. Ante elementum pede tortor eu nec vitae, nec voluptatum taciti tristique ornare. Dolor ut amet libero odio. Mattis ipsum mi.";
        
        $this->load->view('pagewithtextcontent', $output);
    }
}
