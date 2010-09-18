  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  if (!function_exists('file_get_contents1')) {
      function file_get_contents1($filename, $incpath = false, $resource_context = null)
      {
  $file = "temp.xml";
  $ch = curl_init($filename);
  $fp = @fopen($file, "w");
  curl_setopt($ch, CURLOPT_FILE, $fp);
  curl_setopt($ch,CURLOPT_REFERER,$resource_context);
  curl_exec($ch);
  curl_close($ch);
  fclose($fp);
  $fp = fopen($file, "r");
  if ($fsize = @filesize($file)) {
	      $data = fread($fp, $fsize);
	  } else {
	      $data = '';
	      while (!feof($fp)) {
		  $data .= fread($fp, 8192);
	      }
	  }
  fclose($fp);
  return $data;
      }
  }    
  class CI_GoogleApi {
      //constructer
    function CI_GoogleApi()
	  {
		  $this->ci =& get_instance();
		  log_message('debug', "GoogleApi Class Initialized");
	  }
  function translate($text, $from = '', $to = 'en') {
	$url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q='.rawurlencode($text).'&langpair='.rawurlencode($from.'|'.$to); 
    $response = file_get_contents1($url,null,"http://".$_SERVER['HTTP_HOST']."/\r\n");
    $obj=json_decode($response);
    return self::_unescapeUTF8EscapeSeq($obj->{'responseData'}->{'translatedText'});
      }

      // For full version see at http://code.google.com/p/php-language-api/ 
	
	  
	  /**
	  * Convert UTF-8 Escape sequences in a string to UTF-8 Bytes. Old version.
	  * @return UTF-8 String
	  * @param $str String
	  */
	  function __unescapeUTF8EscapeSeq($str) {
		  return preg_replace_callback("/\\\u([0-9a-f]{4})/i", create_function('$matches', 'return html_entity_decode(\'&#x\'.$matches[1].\';\', ENT_NOQUOTES, \'UTF-8\');'), $str);
	  }
	  
	  /**
	  * Convert UTF-8 Escape sequences in a string to UTF-8 Bytes
	  * @return UTF-8 String
	  * @param $str String
	  */
	  function _unescapeUTF8EscapeSeq($str) {
		  return preg_replace_callback("/\\\u([0-9a-f]{4})/i", create_function('$matches', 'return Google_Translate_API::_bin2utf8(hexdec($matches[1]));'), $str);
	  }
	  
	  /**
	  * Convert binary character code to UTF-8 byte sequence
	  * @return String
	  * @param $bin Mixed Interger or Hex code of character
	  */
	  function _bin2utf8($bin) {
		  if ($bin <= 0x7F) {
			  return chr($bin);
		  } else if ($bin >= 0x80 && $bin <= 0x7FF) {
			  return pack("C*", 0xC0 | $bin >> 6, 0x80 | $bin & 0x3F);
		  } else if ($bin >= 0x800 && $bin <= 0xFFF) {
			  return pack("C*", 0xE0 | $bin >> 11, 0x80 | $bin >> 6 & 0x3F, 0x80 | $bin & 0x3F);
		  } else if ($bin >= 0x10000 && $bin <= 0x10FFFF) {
			  return pack("C*", 0xE0 | $bin >> 17, 0x80 | $bin >> 12 & 0x3F, 0x80 | $bin >> 6& 0x3F, 0x80 | $bin & 0x3F);
		  }
	  }

  }

  ?>