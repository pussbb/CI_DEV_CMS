<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class System
{  
    function add_js()
    {   $CI = &get_instance();
        $CI->template->add_js("system/js/jquery-1.4.2.min.js", 'import');
        $CI->template->add_js("system/js/jquery.tools.min.js", 'import');
        $CI->template->add_js("system/js/system.js", 'import');
    }


    function debug()
 {
    $CI = &get_instance();
        if ($CI->config->item('debug') == true) {
             $CI->output->enable_profiler(true);
         }
 }
    function setlang()
    {
        $CFG = &load_class('Config');
        //$OUT = &load_class('Output');
        
        $a = explode('/', $_SERVER["REQUEST_URI"]);
        if (sizeof($a) > 0) {
            switch ($a[1]) {
                case 'ru':
                    {
                        $CFG->set_item('language', "ru");
                        break;
                    }
                case 'en':
                    {
                        $CFG->set_item('language', "en");
                        break;
                    }
                default:
                    {
                        include(BASEPATH.'libraries/third_party/Geoip.php');
                        
                        $country=geoip_country_code_by_addr(open_geo(), $_SERVER['REMOTE_ADDR']);
                        switch($country)
                        {
                            case('RU'):{$CFG->set_item('language', "ru");
                        break;}
                            case('UA'):{$CFG->set_item('language', "ru"); break;}
                        default:{ $CFG->set_item('language', "en");break;}
                        }
                    }

            }
        }
       
        
    }
}
