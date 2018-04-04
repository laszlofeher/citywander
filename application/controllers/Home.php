<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->helper(array('string2'));
    }

    private function languageSettings($language = 'en') {
        $output['lang']             = $language;
        $output['preferedlang']     = getPreferedLang();

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
    
    public function pagingSettings(){
        if($this->session->userdata('itemcount') == null){
            $this->session->set_userdata('itemcount',15);
        }
        if($this->session->userdata('sorttype') == null){
            $this->session->set_userdata('sorttype',1);
        }
    }
    
    /*
     * 
     * getHomePopularThings
     * 
     * Listview rész re irányítás miatti bejegyzés
     * Mindig ezt hivjuk tipusnak megfeleloen fog mukodni
     * $type =
     * 1. Things to do gomb => minden promoció
     * 2. Sightseeing  gomb => cimke alapján keres
     * 3. Activities  gomb  => cimeke alapján keres
     * 4. Packages 
     * 5. Must try          => history alapján a legtöbbet megnézett promoció
     * vagy a legtöbbet vásárolt promoció
     * 6. kiválasztott kategóriák a popular things szekcióban
     * 7. -"-
     * 8. -"-
     * 9. -"-
     * 10. -"-
     * 11. -"-
     * 12. -"-
     * 13. -"-
     * milyen nézet jelenjen meg
     * 
     * $view
     * 1. thumbnail
     * 2. list
     * rendezési szempontok
     * $sortby
     * hány találat jelenjen meg.
     * $limit
     * 
     * $search sessionbe megy
     */
    public function getHomePopularThings(){
        $hptArray = $this->settings->getHomePopularThings($this->getLanguageSettings());
        
        $rand_keys = array();
        if(count($hptArray) > 4){
            $rand_keys = array_rand($hptArray, 4);
        }
        $resultArray = array();
        foreach ($rand_keys as $key => $value) {
            switch ($hptArray[$value]["settingsname"]) {
                case "_1_popular_things":
                    $link = base_url()."index.php/listview/index/6/1/1/1/-1";
                    $hptArray[$value]["link"]= $link;
                    break;
                case "_2_popular_things":
                    $link = base_url()."index.php/listview/index/7/1/1/1/-1";
                    $hptArray[$value]["link"]= $link;
                    break;
                case "_3_popular_things":
                    $link = base_url()."index.php/listview/index/8/1/1/1/-1";
                    $hptArray[$value]["link"]= $link;
                    break;
                case "_4_popular_things":
                    $link = base_url()."index.php/listview/index/9/1/1/1/-1";
                    $hptArray[$value]["link"]= $link;
                    break;
                case "_5_popular_things":
                    $link = base_url()."index.php/listview/index/10/1/1/1/-1";
                    $hptArray[$value]["link"]= $link;
                    break;
                case "_6_popular_things":
                    $link = base_url()."index.php/listview/index/11/1/1/1/-1";
                    $hptArray[$value]["link"]= $link;
                    break;
                case "_7_popular_things":
                    $link = base_url()."index.php/listview/index/12/1/1/1/-1";
                    $hptArray[$value]["link"]= $link;
                    break;
                case "_8_popular_things":
                    $link = base_url()."index.php/listview/index/13/1/1/1/-1";
                    $hptArray[$value]["link"]= $link;
                    break;
                default:
                    break;
            }
            $resultArray[] = $hptArray[$value];
        }
        return $resultArray;        
    }

    /*
     * top sightseeings
     * 
     * 
     */
    
    public function getTopsightseeings($limit=10, $start=0){
        if(isset($this->settings->getTopSightseeing()['categoryid'])){
            return $this->promotion->getPromotionsByCategory((int)$this->settings->getTopSightseeing()['categoryid'],$this->getCurrencySettings()['id'],$limit, $start);
        }else{
            return array();
        }
    }
    
    public function getTopActivities($limit=10, $start=0){
        return $this->promotion->getPromotionTopActivitiesByBestComission();
    }
    
    public function index() {
        $output = array();
        //paging settings
        $this->pagingSettings();
        
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        //currency settings
        $output['currency']         = $this->getCurrencySettings();
        $output['historycount']     = $this->getHistoryCount();
        $output['loggedin']         = false;
        $output['fullname']         = '';
        //carousel 
        $output['carousel']         = $this->settings->getCarouselPictures();

        //popular things 
        $output['popularthings']    = $this->getHomePopularThings();
        
        $output['topsightseeings']  = $this->getTopsightseeings();
        $output['topactivities']    = $this->getTopActivities();

        if ($this->session->userdata('logged_in') !== null) {
            $output['cartcontent']      = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
            $output['loggedin']         = true;
            $output['fullname']         = $this->session->userdata('logged_in')['fullname'];
            $this->load->view('home', $output);
        } else {
            $output['cartcontent']     = $this->cart->contents();
            $this->load->view('home', $output);
        }
    }

    public function search() {
        $search                 = $this->input->post('searchtext');
        $search                 = filter_var($search, FILTER_SANITIZE_SPECIAL_CHARS);
        $promotionArray         = $this->promotion->getPromotions($search);
        //language settings
        $output                 = $this->languageSettings();
        //end of language settings
        $output["promotions"]   = $promotionArray; //var_dump($promotionArray);
        print(json_encode($promotionArray));
    }

    public function searchByCategory() {
        $search                 = $this->input->post('categoryid');
        $search                 = filter_var($search, FILTER_SANITIZE_SPECIAL_CHARS);
        $searchid = (int) $search;
        $promotionArray         = $this->promotion->getPromotionsByCategory($searchid);
        //language settings
        $output                 = $this->languageSettings();
        //end of language settings
        $output["promotions"]   = $promotionArray;
        print(json_encode($promotionArray));
    }
}