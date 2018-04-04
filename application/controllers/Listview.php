<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listview extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model(array('basemodel', 'promotion','promotioncategory','settings'));
        $this->load->library(array('pagination','cart'));
        $this->load->helper(array('string2'));
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
        $output['view']                           = $this->lang->line("view");

        $output['sort_by']                        = $this->lang->line("sort_by");
        $output['most_popular']                   = $this->lang->line("most_popular");
        $output['lowest_price']                   = $this->lang->line("lowest_price");
        $output['highest_price']                  = $this->lang->line("highest_price");
        $output['shortest_program']               = $this->lang->line("shortest_program");
        $output['longest_program']                = $this->lang->line("longest_program");
        
        $output['i_want_it']                      = $this->lang->line("i_want_it");
        
        $output['searchedtext']                   = $this->lang->line("searchedtext");
        
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

    private function searchByCategory() {
        $search = $this->input->post('categoryid');
        $search = filter_var($search, FILTER_SANITIZE_SPECIAL_CHARS);
        $searchid = (int) $search;
        $promotionArray = $this->promotion->getPromotionsByCategory($searchid);
        //language settings
        $output = $this->languageSettings();
        //end of language settings
        $output["promotions"] = $promotionArray;
        print(json_encode($promotionArray));
    }
    
    private function searchByCategoryId($categoryid, $limit=15, $start=0){
        /* @var $categoryid int */
        $categoryid = (int)$categoryid;
        return $this->promotion->getPromotionsByCategory($categoryid, $this->getCurrencySettings()['id'], $limit, $start);
    }
    
    private function searchByLabel($title, $limit, $start, $sorttype) {
        $title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS);
        $promotionArray = $this->promotion->getPromotionsByLabel($title, $this->getCurrencySettings()['id'],(int)$limit, (int)$start, $sorttype);
        return $promotionArray;
    }
    
    /*
     * Az összes promocio, legdrágább promoció legelől
     */
    
    private function allPromotions($limit, $start, $sorttype){
        $promotionArray = $this->promotion->getAllPromotions($this->getCurrencySettings()['id'], $limit, $start, $sorttype);
        return $promotionArray;
    }
    
    /*
     * Sightseeing – Olyan promóciók listája, amelyekhez a „sightseeing” címke kapcsolva lett. 
     */
    private function searchBySightseeing($limit, $start, $sorttype){
        return $this->searchByLabel('sightseeing',$limit, $start, $sorttype);
    }
    
    /*
     * Activities – Olyan promóciók listája, amelyekhez a „activities” címke kapcsolva lett. 
     */
    private function searchByActivities($limit, $start, $sorttype){
        return $this->searchByLabel('activities',$limit, $start, $sorttype);
    }
    /*
     * Must try – Az összes elérhető promóció listája, a legnépszerűbb promócióval az első helyen. 
     */
    private function searchByMustTry($limit, $start){
        return $this->promotion->getPromotionsByBestRate($this->getCurrencySettings()['id'],$limit, $start);
    }
    
    private function searchSightseeing($limit, $start){
        return $this->promotion->getPromotionsByCategory((int)$this->settings->getTopSightseeing()['categoryid'], $this->getCurrencySettings()['id'], $limit, $start);
    }
    
    private function search($search, $limit, $start){
        $search = filter_var($search, FILTER_SANITIZE_SPECIAL_CHARS);
        if(strlen($search)>0){
            if($this->session->userdata('searchtext') === null){
                $this->session->set_userdata('searchtext',$search);
            }else if($this->session->userdata('searchtext') !== null && $this->session->userdata('searchtext') !== $search){
                $this->session->set_userdata('searchtext',$search);
            }
        }
        return $this->promotion->getPromotions($this->session->userdata('searchtext'), $this->getCurrencySettings()['id'], $limit, $start);
    }
    
    public function searchcount($search){
        if(strlen($search)>0){
            if($this->session->userdata('searchtext') === null){
                $this->session->set_userdata('searchtext',$search);
            }else if($this->session->userdata('searchtext') !== null && $this->session->userdata('searchtext') !== $search){
                $this->session->set_userdata('searchtext',$search);
            }
        }
        $this->promotion->getPromotionsCount($this->session->userdata('searchtext'), $this->getCurrencySettings()['id']);
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
     * Mindig ezt hivjuk tipusnak megfeleloen fog mukodni
     * $type =
     * 1. Things to do gomb => minden promoció
     * 2. Sightseeing  gomb => cimke alapján keres
     * 3. Activities  gomb  => cimke alapján keres
     * 4. Packages 
     * 5. Must try          => history alapján a legtöbbet megnézett promoció
     * vagy a legtöbbet vásárolt promoció
     * 6. kiválasztott kategóriák a popular things szekcióban
     * 15. szabadszavas keresés
     * milyen nézet jelenjen meg
     * $view
     * 1. thumbnail
     * 2. list
     * rendezési szempontok
     * $sortby
     * hány találat jelenjen meg.
     * $limit
     * 
     * 
     * $search sessionbe megy
     */
    
    /*  1 Most popular
     *  2 Lowest    price 
     *  3 Highest   price
     *  4 Shortest  program
     *  5 Longest   program 
     */
    
    public function index($type=1, $categoryid=0 ,$view =1, $sortby = 1, $limit = 15) {
        $type       = (int)$type;
        $categoryid = (int)$categoryid;
        $view       = (int)$view;
        $sortby     = (int)$sortby;
        $limit      = (int)$limit;
        $this->session->set_userdata('categoryid', $categoryid);
        if($type == 15){
            $searchtext = $this->input->post('search');
            $searchtext = filter_var($searchtext, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $output = array();
                
        $limit = (int)$this->session->userdata('itemcount');
        //language settings
        $output = $this->languageSettings($this->getLanguageSettings());
        //end of language settings
        
        //pagingsettings
        $this->pagingSettings();
        $output["itemcount"]    = $this->session->userdata('itemcount');
        $output["sorttype"]     = $this->session->userdata('sorttype');
        //end of paging settings
        //currency settings
        $output['currency']     = $this->getCurrencySettings();
        $output['historycount'] = $this->getHistoryCount();
        $output['loggedin']     = false;
        $output['visitor_id']   = -1;
        $output['fullname']     = '';
        //Pagination for News list
        $config = array();
        $config["base_url"]     = base_url() . "index.php/listview/index/".$type."/".$categoryid."/".$view."/".$sortby."/".$limit;
        $config['first_url']    = base_url() . "index.php/listview/index/".$type."/".$categoryid."/".$view."/".$sortby."/".$limit."/-1"; 
        $config["total_rows"]   = 0;
        
        //get popular things
        switch ($type) {
            case 1:
                $config["total_rows"]   = $this->promotion->getAllPromotionsCount($this->getCurrencySettings()['id']);
                break;
            case 2:
                $config["total_rows"]   = $this->promotion->getPromotionsByLabelCount('sightseeing', $this->getCurrencySettings()['id']);
                break;
            case 3:
                $config["total_rows"]   = $this->promotion->getPromotionsByLabelCount('activities', $this->getCurrencySettings()['id']);
                break;
            case 5:
                $config["total_rows"]   = $this->promotion->getPromotionsByBestRateCount($this->getCurrencySettings()['id']);
                break;
            case 6:
                $config["total_rows"]   = $this->promotion->getPromotionsByCategoryCount($categoryid, $this->getCurrencySettings()['id']);
                break;
            
            
            //szabadszavas keresés
            case 15:
                $config["total_rows"]   = $this->searchcount($searchtext);
                break;
            default:
                break;
        }   
        
        $config["per_page"]         = (int)$this->session->userdata('itemcount');
        $config["uri_segment"]      = $this->uri->segment(8)?8:7 ;
      
        //enclosing markup
        $config['full_tag_open']    = '<div class="col-sm-6 col-sm-push-3"><ul class="paginate">';
        $config['full_tag_close']   = '</ul></div>';
        //customizing first link
        $config['first_link']       = 'első';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        //customizing last link
        $config['last_link']        = 'utolsó';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        //next
        $config['next_link']        = 'következő';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        //previews
        $config['prev_link']        = 'elöző';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        //num customizing
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        //current page settings
        $config['cur_tag_open']     = '<li  class="active"><a>';
        $config['cur_tag_close']    = '</a></li>';
        
        $this->pagination->initialize($config);
        $page                       = $this->uri->segment(8)?$this->uri->segment(8):$this->uri->segment(7);;
        //Search type result
        $output['promotions'] = array();
        // itt több eshetőség is lesz majd nyelvi file-okat megnézni
        
        //pl category KATEGORIA NEVE
        //pl search ASDF
        //pl Price 1-50 dollár
        
        $output['sectiontitle'] = '';
        switch ($type) {
            case 1:
                $output["promotions"]       = $this->allPromotions($config["per_page"], $page == -1?0:$page, $output["sorttype"]);
                break;
            case 2:
                $output["promotions"]       = $this->searchBySightseeing($config["per_page"], $page == -1?0:$page, $output["sorttype"]);
                break;
            case 3:
                $output["promotions"]       = $this->searchByActivities($config["per_page"], $page == -1?0:$page, $output["sorttype"]);
                break;
            case 5:
                $output["promotions"]       = $this->searchByMustTry($config["per_page"], $page == -1?0:$page);
                break;
            case 6:
                $output["promotions"]       = $this->searchByCategoryId($categoryid, $config["per_page"], $page == -1?0:$page);
                break;
            
            //szabadszavas keresés
            case 15:
                $output["promotions"]       = $this->search($searchtext, $config["per_page"], $page == -1?0:$page);
                $output['sectiontitle']     = $output['searchedtext']. '"<mark>'.$searchtext.'</mark>"';
                $output['searchtext']       = $searchtext;
                break;
            default:
                break;
        }
        
        $output["links"]            = $this->pagination->create_links();
        $output["actualpage"]       = round($page / $config["per_page"]) + 1;
        $output["allpages"]         = round($config["total_rows"] / $config["per_page"]) == 0 ? 1 : ceil($config["total_rows"] / $config["per_page"]);
        //for filter details
        $output['promotioncategory']    = $this->promotioncategory->getPromotionCategories();
        $output['pricemargin']          = $this->promotion->getPriceMargin($this->getCurrencySettings()['id']);
        //end of for filter details

        //thumb or list link
        $output['thumburl'] = base_url() . "index.php/listview/index/".$type."/".$categoryid."/2/".$sortby."/".$limit."/".$page;
        $output['listurl']  = base_url() . "index.php/listview/index/".$type."/".$categoryid."/1/".$sortby."/".$limit."/".$page;

        if ($this->session->userdata('logged_in') !== null) {
            $output['cartcontent']      = $this->cartmodel->getCartByVisitorId($this->session->userdata('logged_in')['id'], $this->getCurrencySettings()['id']);
            $output['loggedin']     = true;
            $output['fullname']     = $this->session->userdata('logged_in')['fullname'];
            $output['visitor_id']   = $this->session->userdata('logged_in')['id'];
            if($view == 1){
                $this->load->view('list', $output);
            }else if($view == 2){
                $this->load->view('thumb', $output);
            }
        } else {
            $output['cartcontent']     = $this->cart->contents();
            if($view == 1){
                $this->load->view('list', $output);
            }else if($view == 2){
                $this->load->view('thumb', $output);
            }
        }
    }
    
    
    public function filter(){
        if($this->session->userdata('categoryid') !== null){
            
            
        }
        
        
    }
}