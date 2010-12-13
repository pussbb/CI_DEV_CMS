<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class System
{  
    function add_js()
    {   $CI = &get_instance();
        $CI->template->add_js("system/js/jquery-1.4.2.min.js", 'import');
        $CI->template->add_js("system/js/jquery.tools.min.js", 'import');
        $CI->template->add_js("system/js/admin_system.js", 'import');
	$CI->template->add_js("system/js/colorbox/jquery.colorbox-min.js", 'import');
	$CI->template->add_css("system/js/colorbox/style2/colorbox.css", 'link','screen');
        $CI->template->add_js("system/js/ckeditor/ckeditor.js", 'import');
        $CI->template->add_js("system/js/ckeditor/adapters/jquery.js", 'import');

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
        $CFG->load('site');
        $a = explode('/', $_SERVER["REQUEST_URI"]);
        if (sizeof($a) > 0) {
            $lang=$a[1];
            
            if($CFG->item('folder')==true){$lang=$a[2];}
                        switch ($lang) {
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
