<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion','settings','promotioncategory','cartmodel'));
        $this->load->helper(array('string2','dateprint'));
        $this->load->library(array('cart'));
    }

    private function languageSettings($language = 'en') {
        $output['lang'] = $language;
        $output['preferedlang'] = getPreferedLang();

        $this->lang->load('menu/menu', getLangFile($language));

        $output['home']                         = $this->lang->line("home");
        $output['login']                        = $this->lang->line("login");
        $output['logout']                       = $this->lang->line("logout");
        $output['profile']                      = $this->lang->line("profile");
        $output['registration']                 = $this->lang->line("registration");
        $output['language']                     = $this->lang->line("language");
        $output['my_history']                   = $this->lang->line("my_history");
        $output['my_wishlist']                  = $this->lang->line("my_wishlist");
        $output['cart']                         = $this->lang->line("cart");
        $output['hu']                           = $this->lang->line("hu");
        $output['en']                           = $this->lang->line("en");
        $output['de']                           = $this->lang->line("de");
        
        $this->lang->load('list/list', getLangFile($language));
        
        $output['your_search_within_budapest']  = $this->lang->line("your_search_within_budapest");
        $output['categories']                   = $this->lang->line("categories");
        $output['duration']                     = $this->lang->line("duration");

        $output['duration1']                    = $this->lang->line("duration1");
        $output['duration2']                    = $this->lang->line("duration2");
        $output['duration3']                    = $this->lang->line("duration3");
        $output['duration4']                    = $this->lang->line("duration4");

        $output['price_range']                  = $this->lang->line("price_range");
        $output['date']                         = $this->lang->line("date");
        $output['daytime']                      = $this->lang->line("daytime");

        $output['morning']                      = $this->lang->line("morning");
        $output['during_the_day']               = $this->lang->line("during_the_day");
        $output['afternoon']                    = $this->lang->line("afternoon");
        $output['evening']                      = $this->lang->line("evening");
        $output['night']                        = $this->lang->line("night");

        $output['clear_filters']                = $this->lang->line("clear_filters");
        $output['might_interest_you']           = $this->lang->line("might_interest_you");
        //activity page 
        $this->lang->load('activity/activity', getLangFile($language));
        $output['activity_options']             = $this->lang->line("activity_options");
        $output['select_dates_and_participants']= $this->lang->line("select_dates_and_participants");
        $output['choose_a_date']                = $this->lang->line("choose_a_date");
        $output['how_many_people']              = $this->lang->line("how_many_people");
        $output['check_availability']           = $this->lang->line("check_availability");
        $output['share']                        = $this->lang->line("share");
        $output['adults']                       = $this->lang->line("adults");
        $output['chilrden']                     = $this->lang->line("chilrden");
        $output['infants']                      = $this->lang->line("infants");
        //footer
        $this->lang->load('footer/footer', getLangFile($language));
        $output['term_conditions']              = $this->lang->line("term_conditions");
        $output['faq']                          = $this->lang->line("faq");
        $output['legal']                        = $this->lang->line("legal");
        $output['contact']                      = $this->lang->line("contact");
        $output['sitemap']                      = $this->lang->line("sitemap");

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
    
    public function index($promotionid = -1){
        $promotionid = (int)$promotionid;
        
        $output = array();
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //for filter details
        $output['promotioncategory']    = $this->promotioncategory->getPromotionCategories();
        $output['pricemargin']          = $this->promotion->getPriceMargin($this->getCurrencySettings()['id']);
        //end of for filter details
        //currency settings
        $output['currency']             = $this->getCurrencySettings();
        $output['historycount']         = $this->getHistoryCount();
        $output['loggedin']             = false;
        $output['fullname']             = '';
        
        $output['namesofmonth']         = getMonthName(getLangFile($this->getLanguageSettings()));
        $output['dayofmonth']           = dayInMonth((int)(new DateTime())->format('Y'), (int)(new DateTime())->format('n'));
        $output['startday']             = (new DateTime())->format('d');
        
        $output['promotionoptions']     = $this->promotion->getPromotionWithOptions($promotionid, $this->getCurrencySettings()['id']);
        
        if ($this->session->userdata('logged_in') !== null) {
            $output['cartcontent']     = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
            $output['loggedin'] = true;
            $output['fullname'] = $this->session->userdata('logged_in')['fullname'];
            $this->load->view('activity', $output);
        } else {
            $output['cartcontent']     = $this->cart->contents();
            $this->load->view('activity', $output);
        }
    }
    
    public function getDayInMonth(){
        $month  = (int)$this->input->post('month');
        $year   = (int)$this->input->post('year');
        print(dayInMonth($year, $month));
    }
    
    public function add2Cart(){
        $promotion_option_id    = (int)$this->input->post('promotion_option');
        //day
        $day                    = (int)$this->input->post('date1');
        //year, month
        $yearmonth              = explode(',',$this->input->post('date2'));
        
        $adultcount             = (int)$this->input->post('adult');
        $childrencount          = (int)$this->input->post('children');
        $infantscount           = (int)$this->input->post('infants');
        $promotionoption        = $this->promotion->getPromotionOptionByPromotionOptionId($promotion_option_id, $this->getCurrencySettings()['id']);
                
        if($this->session->userdata('logged_in') !== null){
            $this->cartmodel->addToCart($promotion_option_id, $this->session->userdata('logged_in')['id'], $adultcount, $childrencount, $infantscount, (int)$yearmonth[0], (int)$yearmonth[1], $day);
        }else{
            $data = array(
                    'id'      => $promotion_option_id,
                    'qty'     => 1,
                    'price'   => $promotionoption[0]['adultsprice'], 
                    'name'    => $promotionoption[0]['promotion_name'],
                    'options' => array( 'adultcount'    => $adultcount,
                                        'childrencount' => $childrencount,
                                        'infantscount'  => $infantscount,
                                        'adultsprice'   => $promotionoption[0]['adultsprice'],
                                        'childrenprice' => $promotionoption[0]['childrenprice'],
                                        'infantsprice'  => $promotionoption[0]['infantsprice'],
                                        'year'          => (int)$yearmonth[0],
                                        'month'         => (int)$yearmonth[1],
                                        'day'           => $day,
                                        'optionname'    => $promotionoption[0]['optionname'] ));
            $this->cart->insert($data);
        }
        redirect('index.php/cart');
    }
}
