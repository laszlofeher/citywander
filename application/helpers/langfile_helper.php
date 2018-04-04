<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');




if (!function_exists('getLangFile')) {

    function getLangFile($lang) {
        $languageArray = array(
            "af" => array(1 => "Afrikaans", 2 => "afrikaans"),
            "sq" => array(1 => "Albanian", 2 => "albanian"),
            "ar-dz" => array(1 => "Arabic (Algeria)", 2 => "arabic_algeria"),
            "ar-bh" => array(1 => "Arabic (Bahrain)", 2 => "arabic_bahrain"),
            "ar-eg" => array(1 => "Arabic (Egypt)", 2 => "arabic_egypt"),
            "ar-iq" => array(1 => "Arabic (Iraq)", 2 => "arabic_iraq"),
            "ar-jo" => array(1 => "Arabic (Jordan)", 2 => "arabic_jordan"),
            "ar-kw" => array(1 => "Arabic (Kuwait)", 2 => "arabic_kuwait"),
            "ar-lb" => array(1 => "Arabic (Lebanon)", 2 => "arabic_lebanon"),
            "ar-ly" => array(1 => "Arabic (Libya)", 2 => "arabic_libya"),
            "ar-ma" => array(1 => "Arabic (Morocco)", 2 => "arabic_morocco"),
            "ar-om" => array(1 => "Arabic (Oman)", 2 => "arabic_oman"),
            "ar-qa" => array(1 => "Arabic (Qatar)", 2 => "arabic_qatar"),
            "ar-sa" => array(1 => "Arabic (Saudi Arabia)", 2 => "arabic_saudi_arabia"),
            "ar" => array(1 => "Arabic (Standard)", 2 => "arabic_standard"),
            "ar-sy" => array(1 => "Arabic (Syria)", 2 => "arabic_syria"),
            "ar-tn" => array(1 => "Arabic (Tunisia)", 2 => "arabic_tunisia"),
            "ar-ae" => array(1 => "Arabic (U.A.E.)", 2 => "arabic_uae"),
            "ar-ye" => array(1 => "Arabic (Yemen)", 2 => "arabic_yemen"),
            "ar" => array(1 => "Aragonese", 2 => "aragonese"),
            "hy" => array(1 => "Armenian", 2 => "armenian"),
            "as" => array(1 => "Assamese", 2 => "assamese"),
            "ast" => array(1 => "Asturian", 2 => "asturian"),
            "az" => array(1 => "Azerbaijani", 2 => "azerbaijani"),
            "eu" => array(1 => "Basque	", 2 => "basque"),
            "be" => array(1 => "Belarusian", 2 => "belarusian"),
            "bn" => array(1 => "Bengali", 2 => "bengali"),
            "bs" => array(1 => "Bosnian", 2 => "bosnian"),
            "br" => array(1 => "Breton", 2 => "breton"),
            "bg" => array(1 => "Bulgarian", 2 => "bulgarian"),
            "bg" => array(1 => "Bulgarian", 2 => "bulgarian"),
            "my" => array(1 => "Burmese	", 2 => "burmese"),
            "ca" => array(1 => "Catalan	", 2 => "catalan"),
            "ch" => array(1 => "Chamorro", 2 => "chamorro"),
            "ce" => array(1 => "Chechen", 2 => "chechen"),
            "zh" => array(1 => "Chinese", 2 => "chinese"),
            "zh-hk" => array(1 => "Chinese (Hong Kong)", 2 => "chinese_hongkong"),
            "zh-cn" => array(1 => "Chinese (PRC)", 2 => "chinese_prc"),
            "zh-sg" => array(1 => "Chinese (Singapore)", 2 => "chinese_singapore"),
            "zh-tw" => array(1 => "Chinese (Taiwan)", 2 => "chinese_taiwan"),
            "cv" => array(1 => "Chuvash	", 2 => "chuvash"),
            "co" => array(1 => "Corsican", 2 => "corsican"),
            "cr" => array(1 => "Cree", 2 => "cree"),
            "hr" => array(1 => "Croatian", 2 => "croatian"),
            "cs" => array(1 => "Czech", 2 => "czech"),
            "da" => array(1 => "Danish", 2 => "danish"),
            "nl-be" => array(1 => "Dutch (Belgian)", 2 => "dutch_belgian"),
            "nl" => array(1 => "Dutch (Standard)", 2 => "dutch_standard"),
            "en" => array(1 => "English", 2 => "english"),
            "en-au" => array(1 => "English (Australia)", 2 => "english_australia"),
            "en-bz" => array(1 => "English (Belize)", 2 => "english_belize"),
            "en-ca" => array(1 => "English (Canada)", 2 => "english_canada"),
            "en-ie" => array(1 => "English (Ireland)", 2 => "english_ireland"),
            "en-jm" => array(1 => "English (Jamaica)", 2 => "english_jamaica"),
            "en-nz" => array(1 => "English (New Zealand)", 2 => "english_newzealand"),
            "en-ph" => array(1 => "English (Philippines)", 2 => "english_philippines"),
            "en-za" => array(1 => "English (South Africa)", 2 => "english_southafrica"),
            "en-tt" => array(1 => "English (Trinidad & Tobago)", 2 => "english_trinidad_tobago"),
            "en-gb" => array(1 => "English (United Kingdom)", 2 => "english_unitedkingdom"),
            "en-us" => array(1 => "English (United States)", 2 => "english_unitedstates"),
            "en-zw" => array(1 => "English (Zimbabwe)	", 2 => "english_zimbabwe"),
            "eo" => array(1 => "Esperanto", 2 => "esperanto"),
            "et" => array(1 => "Estonian", 2 => "estonian"),
            "fo" => array(1 => "Faeroese", 2 => "faeroese"),
            "fa" => array(1 => "Farsi", 2 => "farsi"),
            "fj" => array(1 => "Fijian", 2 => "fijian"),
            "fi" => array(1 => "Finnish", 2 => "finnish"),
            "fr-be" => array(1 => "French (Belgium)", 2 => "french_belgium"),
            "fr-ca" => array(1 => "French (Canada)", 2 => "french_canada"),
            "fr-fr" => array(1 => "French (France)", 2 => "french_france"),
            "fr-lu" => array(1 => "French (Luxembourg)", 2 => "french_luxembourg"),
            "fr-mc" => array(1 => "French (Monaco)", 2 => "french_monaco"),
            "fr" => array(1 => "French (Standard)", 2 => "french_standard"),
            "fr-ch" => array(1 => "French (Switzerland)", 2 => "french_switzerland"),
            "fy" => array(1 => "Frisian", 2 => "frisian	"),
            "fur" => array(1 => "Friulian", 2 => "friulian"),
            "mk" => array(1 => "FYRO Macedonian", 2 => "fyro_macedonian"),
            "gd-ie" => array(1 => "Gaelic (Irish)", 2 => "gaelic_irish"),
            "gd" => array(1 => "Gaelic (Scots)", 2 => "gaelic_scots"),
            "gl" => array(1 => "Galacian", 2 => "galacian"),
            "ka" => array(1 => "Georgian", 2 => "georgian"),
            "de-at" => array(1 => "German (Austria)", 2 => "german_austria"),
            "de-de" => array(1 => "German (Germany)", 2 => "german_germany"),
            "de-li" => array(1 => "German (Liechtenstein)", 2 => "german_liechtenstein"),
            "de-lu" => array(1 => "German (Luxembourg)", 2 => "german_luxembourg"),
            "de" => array(1 => "German (Standard)", 2 => "german_standard"),
            "de-ch" => array(1 => "German (Switzerland)", 2 => "german_switzerland"),
            "el" => array(1 => "Greek", 2 => "greek"),
            "gu" => array(1 => "Gujurati", 2 => "gujurati"),
            "ht" => array(1 => "Haitian", 2 => "haitian"),
            "he" => array(1 => "Hebrew", 2 => "hebrew"),
            "hi" => array(1 => "Hindi", 2 => "hindi"),
            "hu" => array(1 => "Hungarian", 2 => "hungarian"),
            "is" => array(1 => "Icelandic", 2 => "icelandic"),
            "id" => array(1 => "Indonesian", 2 => "indonesian"),
            "iu" => array(1 => "Inuktitut", 2 => "inuktitut"),
            "ga" => array(1 => "Irish", 2 => "irish"),
            "it" => array(1 => "Italian (Standard)", 2 => "italian_standard"),
            "it-ch" => array(1 => "Italian (Switzerland)", 2 => "italian_switzerland"),
            "ja" => array(1 => "Japanese", 2 => "japanese"),
            "kn" => array(1 => "Kannada", 2 => "kannada"),
            "ks" => array(1 => "Kashmiri", 2 => "kashmiri"),
            "kk" => array(1 => "Kazakh", 2 => "kazakh"),
            "km" => array(1 => "Khmer", 2 => "khmer"),
            "ky" => array(1 => "Kirghiz", 2 => "kirghiz"),
            "tlh" => array(1 => "Klingon", 2 => "klingon"),
            "ko" => array(1 => "Korean	", 2 => "korean"),
            "ko-kp" => array(1 => "Korean (North Korea)", 2 => "korean_northkorea"),
            "ko-kr" => array(1 => "Korean (South Korea)", 2 => "korean_southkorea"),
            "la" => array(1 => "Latin", 2 => "latin"),
            "lv" => array(1 => "Latvian", 2 => "latvian"),
            "lt" => array(1 => "Lithuanian", 2 => "lithuanian"),
            "lb" => array(1 => "Luxembourgish", 2 => "luxembourgish"),
            "ms" => array(1 => "Malay", 2 => "malay"),
            "ml" => array(1 => "Malayalam", 2 => "malayalam"),
            "mt" => array(1 => "Maltese", 2 => "maltese"),
            "mi" => array(1 => "Maori", 2 => "maori"),
            "mr" => array(1 => "Marathi", 2 => "marathi"),
            "mo" => array(1 => "Moldavian", 2 => "moldavian"),
            "nv" => array(1 => "Navajo", 2 => "navajo"),
            "ng" => array(1 => "Ndonga", 2 => "ndonga"),
            "ne" => array(1 => "Nepali", 2 => "nepali"),
            "no" => array(1 => "Norwegian", 2 => "norwegian"),
            "nb" => array(1 => "Norwegian (Bokmal)", 2 => "norwegian_bokmal"),
            "nn" => array(1 => "Norwegian (Nynorsk)", 2 => "norwegian_nynorsk"),
            "oc" => array(1 => "Occitan	", 2 => "occitan"),
            "or" => array(1 => "Oriya", 2 => "oriya"),
            "om" => array(1 => "Oromo", 2 => "oromo"),
            "fa" => array(1 => "Persian", 2 => "persian"),
            "fa-ir" => array(1 => "Persian/Iran	", 2 => "persian_iran"),
            "pl" => array(1 => "Polish", 2 => "polish"),
            "pt" => array(1 => "Portuguese", 2 => "portuguese"),
            "pt-br" => array(1 => "Portuguese (Brazil)", 2 => "portuguese_brazil"),
            "pa" => array(1 => "Punjabi	", 2 => "punjabi"),
            "pa-in" => array(1 => "Punjabi (India)", 2 => "punjabi_india"),
            "pa-pk" => array(1 => "Punjabi (Pakistan)", 2 => "punjabi_pakistan"),
            "qu" => array(1 => "Quechua", 2 => "quechua"),
            "rm" => array(1 => "Rhaeto-Romanic", 2 => "rhaeto_romanic"),
            "ro" => array(1 => "Romanian", 2 => "romanian"),
            "ro-mo" => array(1 => "Romanian (Moldavia)", 2 => "romanian_moldavia"),
            "ru" => array(1 => "Russian", 2 => "russian"),
            "ru-mo" => array(1 => "Russian (Moldavia)", 2 => "russian_moldavia"),
            "sz" => array(1 => "Sami (Lappish)", 2 => "sami_lappish"),
            "sg" => array(1 => "Sango", 2 => "sango"),
            "sa" => array(1 => "Sanskrit", 2 => "sanskrit"),
            "sc" => array(1 => "Sardinian", 2 => "sardinian"),
            "gd" => array(1 => "Scots Gaelic", 2 => "scots_gaelic"),
            "sr" => array(1 => "Serbian", 2 => "serbian"),
            "sd" => array(1 => "Sindhi", 2 => "sindhi"),
            "si" => array(1 => "Singhalese", 2 => "singhalese"),
            "sk" => array(1 => "Slovak", 2 => "slovak"),
            "sl" => array(1 => "Slovenian", 2 => "slovenian"),
            "so" => array(1 => "Somani", 2 => "	somani"),
            "sb" => array(1 => "Sorbian", 2 => "sorbian"),
            "es" => array(1 => "Spanish", 2 => "spanish"),
            "es-ar" => array(1 => "Spanish (Argentina)", 2 => "spanish_argentina"),
            "es-bo" => array(1 => "Spanish (Bolivia)", 2 => "spanish_bolivia"),
            "es-cl" => array(1 => "Spanish (Chile)", 2 => "spanish_chile"),
            "es-co" => array(1 => "Spanish (Colombia)", 2 => "spanish_colombia"),
            "es-cr" => array(1 => "Spanish (Costa Rica)", 2 => "spanish_costa Rica"),
            "es-do" => array(1 => "Spanish (Dominican Republic)", 2 => "spanish_dominican Republic	"),
            "es-ec" => array(1 => "Spanish (Ecuador)", 2 => "spanish_ecuador"),
            "es-sv" => array(1 => "Spanish (El Salvador)", 2 => "spanish_el Salvador"),
            "es-gt" => array(1 => "Spanish (Guatemala)", 2 => "spanish_guatemala"),
            "es-hn" => array(1 => "Spanish (Honduras)", 2 => "spanish_honduras"),
            "es-mx" => array(1 => "Spanish (Mexico)", 2 => "spanish_mexico"),
            "es-ni" => array(1 => "Spanish (Nicaragua)", 2 => "spanish_nicaragua"),
            "es-pa" => array(1 => "Spanish (Panama)", 2 => "spanish_panama"),
            "es-py" => array(1 => "Spanish (Paraguay)", 2 => "spanish_paraguay"),
            "es-pe" => array(1 => "Spanish (Peru)", 2 => "spanish_peru"),
            "es-pr" => array(1 => "Spanish (Puerto Rico)", 2 => "spanish_puerto Rico"),
            "es-es" => array(1 => "Spanish (Spain)", 2 => "spanish_spain"),
            "es-uy" => array(1 => "Spanish (Uruguay)", 2 => "spanish_uruguay"),
            "es-ve" => array(1 => "Spanish (Venezuela)", 2 => "spanish_venezuela"),
            "sx" => array(1 => "Sutu", 2 => "sutu"),
            "sw" => array(1 => "Swahili", 2 => "swahili"),
            "sv" => array(1 => "Swedish", 2 => "swedish"),
            "sv-fi" => array(1 => "Swedish (Finland)", 2 => "swedish_finland"),
            "sv-sv" => array(1 => "Swedish (Sweden)", 2 => "swedish_sweden"),
            "ta" => array(1 => "Tamil", 2 => "tamil"),
            "tt" => array(1 => "Tatar", 2 => "tatar"),
            "te" => array(1 => "Teluga", 2 => "teluga"),
            "th" => array(1 => "Thai", 2 => "thai"),
            "tig" => array(1 => "Tigre", 2 => "tigre"),
            "ts" => array(1 => "Tsonga", 2 => "tsonga"),
            "tn" => array(1 => "Tswana", 2 => "tswana"),
            "tr" => array(1 => "Turkish", 2 => "turkish"),
            "tk" => array(1 => "Turkmen", 2 => "turkmen"),
            "uk" => array(1 => "Ukrainian", 2 => "ukrainian"),
            "hsb" => array(1 => "Upper Sorbian", 2 => "upper_sorbian"),
            "ur" => array(1 => "Urdu", 2 => "urdu"),
            "ve" => array(1 => "Venda", 2 => "venda"),
            "vi" => array(1 => "Vietnamese", 2 => "vietnamese"),
            "vo" => array(1 => "Volapuk", 2 => "volapuk"),
            "wa" => array(1 => "Walloon", 2 => "walloon"),
            "cy" => array(1 => "Welsh", 2 => "welsh"),
            "xh" => array(1 => "Xhosa", 2 => "xhosa"),
            "ji" => array(1 => "Yiddish", 2 => "yiddish"),
            "zu" => array(1 => "Zulu", 2 => "zulu")
        );
        if (is_string($lang)) {
            $lang = substr($lang, 0,2);
            if(isset($languageArray[$lang][2])){
                if(file_exists('application/language/'.$languageArray[$lang][2].'/menu/menu_lang.php')){
                    return $languageArray[$lang][2]; 
                }
            }
        }
        return "english";
    }

    if (!function_exists('getPreferedLang')) {
        function getPreferedLang() {
            return array(
                "en",
                "de",
                "hu"
            );
        }
    }
    
    
    
    
}