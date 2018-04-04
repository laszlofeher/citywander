<?php

class Facebooklogin {

    //facebook
    private $applicationId = "1577963905625109";
    private $secretCode = "3494da2ef3e6615c6988ad0d4c8a34b7";
    private $ci;

    /**
     * A system param tĂˇblĂˇbĂłl kiveszi az alkalmazĂˇs kĂłdot Ă©s az alkalmazĂˇs titkos kĂłdot
     */
    public function __construct() {
        $this->ci = & get_instance();
        //$this->ci->config->load('facebook');
        //$this->applicationId    = $this->ci->config->item('app_id');
        //$this->secretCode       = $this->ci->config->item('app_secret_id');
    }

    /**
     * Facebook Oauth link generálás, amely feldobja az authentikációs ablakot.
     *
     * @param url
     * @return Azzal a linkkel tér vissza, amelyik feldobja az authentikációs ablakot
     */
    public function createLink($url = "") {
        $applicationId = $this->getApplicationCode();
        $fbLoginUrl = "";
        if (strlen($url) > 0) {
            $fbLoginUrl = "https://www.facebook.com/v2.10/dialog/oauth?client_id=" . $applicationId . "&redirect_uri=" . urlencode($url) . "&auth_type=rerequest" . "&scope=email";
        }
        return $fbLoginUrl;
    }

    /**
     * AccessToken-t ellenőrő link generálása.
     * https://graph.facebook.com/oauth/access_token
     * 
     * 
     * @param code
     * @param url
     * @return Egy ellenőrő kóddal tér vissza, amelyikkel már lehet adatot kérni.
     */
    public function getAccessTokenUrl($code, $url) {
        $fbGraphUrl = "";
        
        $applicationId = $this->getApplicationCode();
        $secretCode = $this->getSecretApplicationCode();
        $fbGraphUrl = "https://graph.facebook.com/oauth/access_token?" . "client_id=" . $applicationId . "&redirect_uri=" . urlencode($url) . "&client_secret=" . $secretCode . "&code=" . $code;
        return $fbGraphUrl;
    }

    /**
     * 
     * @param code
     * @param url
     * @return 
     */
    public function getAccessToken($code, $url) {
        $fbGraphURL = $this->getAccessTokenUrl($code, $url);
        $returnedJSONString = file_get_contents($fbGraphURL);
        $jsonArray = json_decode($returnedJSONString, true);
        $accessToken = $jsonArray['access_token'];
        return $accessToken;
    }

    /**
     * 
     * @param accessToken
     * @return 
     */
    public function getJSONData($accessToken) {
        $g = "https://graph.facebook.com/me?fields=id,email,first_name,last_name&access_token=" . $accessToken;
        $graph = file_get_contents($g);
        return $graph;
    }

    /**
     * 
     * @return 
     */
    public function getApplicationCode() {
        return $this->applicationId;
    }

    /**
     * 
     * @return 
     */
    public function getSecretApplicationCode() {
        return $this->secretCode;
    }

    /**
     * 
     * @param JSONString
     * @param code
     * @param url
     * @return RegistrationData adatokkal feltĂ¶ltve
     */

    public function getUserData($code, $url) {
    //Visszatér access token
    $accessToken = $this->getAccessToken($code, $url);
    //Megkapom a Json stringet az Url e-n keresztĂĽl.
    $userDetailsJson = $this->getJSONData($accessToken);
    $json = json_decode($userDetailsJson, true);
    return $json;
}

}
