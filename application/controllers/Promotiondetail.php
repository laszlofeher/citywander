<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Promotiondetail extends CI_Controller {

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
        $this->load->model(array('basemodel', 'promotion','promotioncategory'));
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
        
        $this->lang->load('list/list', getLangFile($language));
        $output['your_search_within_budapest']    = $this->lang->line("your_search_within_budapest");
        $output['categories']                     = $this->lang->line("categories");
        $output['duration']                       = $this->lang->line("duration");

        $output['duration1']                      = $this->lang->line("duration1");
        $output['duration2']                      = $this->lang->line("duration2");
        $output['duration3']                      = $this->lang->line("duration3");
        $output['duration4']                      = $this->lang->line("duration4");

        $output['price_range']                    = $this->lang->line("price_range");
        $output['date']                           = $this->lang->line("date");
        $output['daytime']                        = $this->lang->line("daytime");

        $output['morning']                        = $this->lang->line("morning");
        $output['during_the_day']                 = $this->lang->line("during_the_day");
        $output['afternoon']                      = $this->lang->line("afternoon");
        $output['evening']                        = $this->lang->line("evening");
        $output['night']                          = $this->lang->line("night");

        $output['clear_filters']                  = $this->lang->line("clear_filters");
        $output['might_interest_you']             = $this->lang->line("might_interest_you");
        $this->lang->load('promotion/promotion', getLangFile($language));
        $output['share']                          = $this->lang->line("share");
        $output['print']                          = $this->lang->line("print");
        $output['share_with_friend']              = $this->lang->line("share_with_friend");
        $output['overview']                       = $this->lang->line("overview");
        $output['important']                      = $this->lang->line("important");
        $output['reviews']                        = $this->lang->line("reviews");
        $output['viewing_all']                    = $this->lang->line("viewing_all");
        $output['best_price_guaranted']           = $this->lang->line("best_price_guaranted");
        $output['view_dates']                     = $this->lang->line("view_dates");
        
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

    private function saveHistory($id = -1){
        $id = (int)$id;
        if ((int) $id > 0) {
            if($this->session->userdata('history') != null && is_array($this->session->userdata('history'))){
               $historyArray= $this->session->userdata('history');
               $search = array_search($id,$historyArray);
               if(!$search){
                   $historyArray[] = $id;
                   $this->session->set_userdata('history',$historyArray);
               }
            }else{
               $historyArray = array($id);
               $this->session->set_userdata('history',$historyArray);
            }
        }
    }
    
    private function getHistoryCount(){
        if($this->session->userdata('history') != null){
            return count(array_unique($this->session->userdata('history')));
        }else{
            return 0; 
        }
    }
    
    public function index($id = -1) {
        if ((int) $id > 0) {
            $output = [];
            //language settings
            $output = $this->languageSettings($this->getLanguageSettings());
            //end of language settings
            
            //for filter details
            $output['promotioncategory']    = $this->promotioncategory->getPromotionCategories();
            $output['pricemargin']          = $this->promotion->getPriceMargin($this->getCurrencySettings()['id']);
            //end of for filter details

            //currency settings
            $output['currency']         = $this->getCurrencySettings();
            $output['historycount']     = $this->getHistoryCount();
            $output['loggedin']         = false;
            $output['visitor_id']       = -1;
            $output['fullname']         = '';
            $output['promotionid']      = $id;
            $output['promotiondetail']  = $this->promotion->getPromotionDetail((int) $id,$this->getCurrencySettings()['id']);
            $this->saveHistory($id);
            if ($this->session->userdata('logged_in') !== null) {
                $output['cartcontent']  = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
                $output['loggedin']     = true;
                $output['fullname']     = $this->session->userdata('logged_in')['fullname'];
                $output['visitor_id']   = $this->session->userdata('logged_in')['id'];
                $this->load->view('promotion', $output);
            } else {
                $output['cartcontent']     = $this->cart->contents();
                $this->load->view('promotion', $output);
            }
        } else {
            $this->load->view('home', $output);
        }
    }

}
