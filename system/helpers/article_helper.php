<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('truncate'))
{
/**
* Truncates text.
*
* Cuts a string to the length of $length and replaces the last characters
* with the ending if the text is longer than length.
*
* @param string  $text String to truncate.
* @param integer $length Length of returned string, including ellipsis.
* @param string  $ending Ending to be appended to the trimmed string.
* @param boolean $exact If false, $text will not be cut mid-word
* @param boolean $considerHtml If true, HTML tags would be handled correctly
* @return string Trimmed string.
*/
    function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = true) {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }

            // splits all html-tags to scanable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';

            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                    // if tag is a closing tag (f.e. </b>)
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                    // if tag is an opening tag (f.e. <b>)
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }

                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length+$content_length> $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1]+1-$entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }

                // if the maximum length is reached, get off the loop
                if($total_length>= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }

        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }

        // add the defined ending to the text
        $truncate .= $ending;

        if($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }

        return $truncate;

    }
}
if ( ! function_exists('syntaxhilight'))
{
    function syntaxhilight($data) {
        $langAlias = "";
        
	 $regexLangAlias = '/brush[^:]*:[\s|\S?:](.*?;)/s';
        // print_r(preg_match($regexLangAlias,$data));
        if (preg_match_all($regexLangAlias, $data, $langAliasMatches) > 0) {
           $CI =& get_instance();
            //if($code==false){
                $CI->template->add_js("system/js/syntaxhighlighter/scripts/shCore.js", 'import');
                $CI->template->add_css("system/js/syntaxhighlighter/styles/shCore.css", 'link');
                $CI->template->add_css("system/js/syntaxhighlighter/styles/shThemeDefault.css", 'link');
                $CI->template->add_js("SyntaxHighlighter.config.clipboardSwf = '" . base_url() . "system/js/syntaxhighlighter/scripts/clipboard.swf';SyntaxHighlighter.all();", 'embed');
                $CI->code=true;
          //  }
          
            $langAlias = $langAliasMatches[1];
            foreach ($langAlias as $value) {
                  $value=str_replace(" ", "",  $value);
                switch ($value) {
                    case 'as3;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAS3.js");
                        break;
                    case 'clj;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushClojure.js", 'import');
                        break;
                    case 'css;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushCss.js", 'import');
                        break;
                    case 'fsharp;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushFSharp.js", 'import');
                        break;
                    case 'javascript;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushJScript.js", 'import');
                        break;
                    case 'script;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushJScript.js", 'import');
                        break;
                    case 'mathematica;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushMathematica.js", 'import');
                        break;
                    case 'objc;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushObjectiveC.js", 'import');
                        break;
                    case 'powershell;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPowerShell.js", 'import');
                        break;
                    case 'rpgle;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushRpgle.js", 'import');
                        break;
                    case 'sql;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushSql.js", 'import');
                        break;
                    case 'ada;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAda.js", 'import');
                        break;
                    case 'asm;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAsm.js", 'import');
                        break;
                    case 'coldfusion;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushColdFusion.js", 'import');
                        break;
                    case 'delphi;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushDelphi.js", 'import');
                        break;
                    case 'pascal;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushDelphi.js", 'import');
                        break;
                    case 'groovy;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushGroovy.js", 'import');
                        break;
                    case 'latex;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushLatex.js", 'import');
                        break;
                    case 'matlab;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushMatlab.js", 'import');
                        break;
                    case 'perl;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPerl.js", 'import');
                        break;
                    case 'processing;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushProcessing.js", 'import');
                        break;
                    case 'ruby;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushRuby.js", 'import');
                        break;
                    case 'vb;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushVb.js", 'import');
                        break;
                    case 'autohotkey;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAhk.js", 'import');
                        break;
                    case 'shell;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushBash.js", 'import');
                        break;
                    case 'cpp;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushCpp.js", 'import');
                        break;
                    case 'c;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushCpp.js", 'import');
                        break;
                    case 'diff;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushDiff.js", 'import');
                        break;
                    case 'javafx;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushJavaFX.js", 'import');
                        break;
                    case 'lsl;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushLsl.js", 'import');
                        break;
                    case 'matlabkey;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushMatlabSimple.js", 'import');
                        break;
                    case 'php;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPhp.js", 'import');
                        break;
                    case 'python;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPython.js", 'import');
                        break;
                    case 'sahiscript;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushSahi.js", 'import');
                        break;
                    case 'xml;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushXml.js", 'import');
                        break;
                    case 'applescript;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAppleScript.js", 'import');
                        break;
                    case 'bat;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushBat.js", 'import');
                        break;
                    case 'csharp;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushCSharp.js", 'import');
                        break;
                    case 'erlang;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushErlang.js", 'import');
                        break;
                    case 'java;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushJava.js", 'import');
                        break;
                    case 'lua;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushLua.js", 'import');
                        break;
                    case 'nasm;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushNasm8086.js", 'import');
                        break;
                    case 'text;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPlain.js", 'import');
                        break;
                    case 'ros;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushRouterOS.js", 'import');
                        break;
                    case 'scala;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushScala.js", 'import');
                        break;
                    case 'yaml;': $CI->template->add_js("system/js/syntaxhighlighter/scripts/shBrushYaml.js", 'import');
                        break;
                }
            }
        }
        return $data;
    }
}