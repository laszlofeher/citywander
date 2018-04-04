<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

if (!function_exists('getMonthName')) {

    function getMonthName($lang) {
        $CI = & get_instance();
        $CI->lang->load('dateprint/dateprint', $lang);
        $output[1]  = $CI->lang->line("january");
        $output[2]  = $CI->lang->line("february");
        $output[3]  = $CI->lang->line("march");
        $output[4]  = $CI->lang->line("april");
        $output[5]  = $CI->lang->line("may");
        $output[6]  = $CI->lang->line("june");
        $output[7]  = $CI->lang->line("july");
        $output[8]  = $CI->lang->line("august");
        $output[9]  = $CI->lang->line("september");
        $output[10] = $CI->lang->line("october");
        $output[11] = $CI->lang->line("november");
        $output[12] = $CI->lang->line("december");
        return $output;
    }
    
    
if (!function_exists('dayInMonth')) {    
    function dayInMonth($year, $month){
        return cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
    }
}
}