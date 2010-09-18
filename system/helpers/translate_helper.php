<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 function lang_url() возвращает полный url с индетификатором языка 
 который можно задать вручную как аргумент.
 TODO: надо пресмотреть алгорит не нравиться он мне
 */
if ( ! function_exists('lang_url'))
  {
  	function lang_url($str = '')
  	{
  	 
  	$CI = &get_instance();
    $lang=$CI->config->item("language");
    $a = explode('/', $_SERVER["REQUEST_URI"]);
        if (sizeof($a) > 0) {
           switch ($a[1]) {
                case 'ru':
                    {  $lang= "ru";unset($a[1]); break; }
                case 'en':
                    { $lang= "en";unset($a[1]);  break;  }
                default:  break;        
            }
        }
      if ($str!='') {$lang=$str;}       
      return base_url().$lang.implode('/',$a);
       
  	}	
  }
 /**
 function lang_id() возвращает индетификатор языка 
 */
if ( ! function_exists('lang_id'))
  {
  	function lang_id()
  	{
  	$CI = &get_instance();
    $lang=$CI->config->item("language");
    $a = explode('/', $_SERVER["REQUEST_URI"]);
        if (sizeof($a) > 0) {
           switch ($a[1]) {
                case 'ru':
                    {  $lang= "ru"; break; }
                case 'en':
                    { $lang= "en";  break;  }
                default:  break;        
            }
        }
           
      return $lang;
       
  	}	
  }
 /**
 function gtranslate() переводит заданый текст с помощью Google Translate
 $text = текст который надо перевести
 $from = с какого языка
 $to = на какой язык
 */
if ( ! function_exists('gtranslate'))
  {
  	function gtranslate($text = '',$from = 'ru', $to = 'en')
  	{
  $GAPI=&load_class('googleapi');
  return $GAPI->translate($text,$from,$to)."<div style=\"margin-left:40%;width : 100%; height : 10px; }\" id='branding'></div>";
   }	
  }
 /**
 function lang_id() переводит заданый текст с помощью Google Translate
 $text = текст который надо перевести
 $from = с какого языка
 $to = на какой язык
 */
if ( ! function_exists('autogtrans'))
  {
  	function autogtrans($text = '',$from = 'ru', $to = 'en')
  	{
  if (lang_id()!=$from){
  $GAPI=&load_class('googleapi');
  return $GAPI->translate($text,$from,$to)."<div id='branding'></div>";
    }
    else {return $text;}
   }	
  }