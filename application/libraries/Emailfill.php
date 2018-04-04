<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailfill {

        
    /**
     * 
     * @param type $template
     * @param type $searchReplaceArray
     * 
     * 
     * serchReplace egy asszociatív tömb, amelyben a kulcs az amit 
     * keres és az érték amire átír
     */
        
    public function templateFill($template, $searchReplaceArray){
        $newcontents = "";
        //template megnyitás
        $handle = fopen($template, "r");
        if($handle){
            //tartalom kiolvasása
            $contents = fread($handle, filesize($template));
            //file bezárása
            fclose($handle);
            $searchArray    = array_keys($searchReplaceArray);
            $replaceArray   = array_values($searchReplaceArray);
            for ($i = 0; $i<count($searchArray); $i++){
                $searchArray[$i] = '<<<'.$searchArray[$i].'>>>';
            }
            $newcontents    = str_replace($searchArray, $replaceArray, $contents);
            return $newcontents;
        }else{
            return false;
        }
    }
}

?>