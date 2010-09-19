<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Author _pussbb
 */
/**
  if ( ! function_exists('fn'))
  {
  function fn()
  {

  }
  }
 */
/**
  function lang_url() returns full url with language id wich can set manualy.
 */
if (!function_exists('lang_url')) {

    function lang_url($str = '', $base = '') {

        $CI = &get_instance();
        $lang = $CI->config->item("language");
        if ($base == '') {
            $a = explode('/', $_SERVER["REQUEST_URI"]);
            if (count($a) > 0) {
            $lang = lang_id();
            if($a[1]==$lang)
            {
             unset($a[1]);
            }
            
            }
        } else {
            $a =array($base) ;
        }
        if ($str != '') {
            $lang = $str;
        }
        return base_url() . $lang .'/'. implode('/', $a);
    }

}
/**
  function lang_id() возвращает индетификатор языка
 */
if (!function_exists('lang_id')) {

    function lang_id() {
        $CI = &get_instance();
        $lang = $CI->config->item("language");
        $a = explode('/', $_SERVER["REQUEST_URI"]);
        if (sizeof($a) > 0) {
            switch ($a[1]) {
                case 'ru': {
                        $lang = "ru";
                        break;
                    }
                case 'en':
                default:  {
                        $lang = "en";
                        break;
                    }
            }
        }

        return $lang;
    }

}
/**
  function gtranslate() tarnsalte given text with help Google Translate
  $text = text wich need to translate
  $from = from language
  $to = to language
 */
if (!function_exists('gtranslate')) {

    function gtranslate($text = '', $from = 'ru', $to = 'en') {
        $GAPI = &load_class('googleapi');
        return $GAPI->translate($text, $from, $to) . "<div id='branding'></div>";
    }

}
/**
  function autogtrans() пtarnsalte given text with help Google Translate
  $text = text wich need to translate
  $from = from language
  $to = to language
 */
if (!function_exists('autogtrans')) {

    function autogtrans($text = '', $from = 'ru', $to = 'en') {
        if (lang_id() != $from) {
            $GAPI = &load_class('googleapi');
            return $GAPI->translate($text, $from, $to) . "<div id='branding'></div>";
        } else {
            return $text;
        }
    }

}