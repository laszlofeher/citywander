<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion', 'settings', 'promotioncategory', 'cartmodel'));
        $this->load->helper(array('string2', 'dateprint'));
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

        foreach ($output['preferedlang'] as $key => $value) {
            $output[$key]                       = $this->lang->line($key);
        }
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
            $this->session->set_userdata('language', substr($this->agent->languages()[0], 0, 2));
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

    public function index($visitorid = -1) {
        $visitorid              = (int) $visitorid;

        $output                 = array();
        //language settings
        $output                 = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        $output['loggedin']     = false;
        $output['fullname']     = '';
        $output['sum']          = 0;
        if ($this->session->userdata('logged_in') !== null) {
            $output['cartcontent']  = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
            $output['loggedin']     = true;
            $output['fullname']     = $this->session->userdata('logged_in')['fullname'];
            for ($i = 0; $i < count($output['cartcontent']); $i++) {
                $output['sum'] += (float)($output['cartcontent'][$i]['options']['adultsprice']*$output['cartcontent'][$i]['options']['adultcount'])+($output['cartcontent'][$i]['options']['childrenprice']*$output['cartcontent'][$i]['options']['childrencount'])+($output['cartcontent'][$i]['options']['infantsprice']*$output['cartcontent'][$i]['options']['infantscount']);
            }
            $this->load->view('cart', $output);
        } else {
            foreach ($this->cart->contents() as $key => $value) {
                $promotionoption = $this->promotion->getPromotionOptionByPromotionOptionId($value['id'], $this->getCurrencySettings()['id']);
                $data = array(
                    'rowid' => $key,
                    'price' => ($promotionoption[0]['adultsprice']*$value['options']['adultcount'])+($promotionoption[0]['childrenprice']*$value['options']['childrencount'])+($promotionoption[0]['infantsprice']*$value['options']['infantscount'])
                );
                $output['sum'] += (float)($promotionoption[0]['adultsprice']*$value['options']['adultcount'])+($promotionoption[0]['childrenprice']*$value['options']['childrencount'])+($promotionoption[0]['infantsprice']*$value['options']['infantscount']);
                $this->cart->update($data);
            }
            $output['cartcontent'] = $this->cart->contents();
            $this->load->view('cart', $output);
        }
    }

}
