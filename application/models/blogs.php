<?php

class Blogs extends CI_Model {
    const EDIT=0;
    const ADD=1;
    const READ=2;
    var $code=false;
    function Blogs() {
        parent::CI_Model();
        $this->load->library('pagination');
    }

    function read($role, $param) {
        if ($role == false) {
            //echo 'You don\'t have permission to acces edit<br />';
        } else {
        /*    $this->template->write('futures', '<script type="text/javascript">
                $(document).ready(function(){
                blog_comments(' . $param . ');
                });</script><p class="blog_comments"></p>');*/
        }
    }

    function edit($role, $param) {
        if ($role == false) {
            //echo 'You don\'t have permission to acces edit<br />';
        } else {
            //echo 'edit<br />';
        }
    }

    function add($role, $param) {
        if ($role === true) {
            // $this->template->add_js("system/js/ckeditor/ckeditor.js", 'import');
            $this->template->add_js("system/js/ckeditor/adapters/jquery.js", 'import');
            $html = "
                <input id=\"blog_add_editor\" id onclick=\"blog_add_editor();\" type=\"button\" value=\"" . $this->lang->line('addcomment') . "\" />
<div class=\"blog_comments_editor\">

	</div><div style=\"display:none;\" id=\"comments_buttons\">
        <input onclick=\"blog_get_text_editor('" . lang_url(null, "blog/addcomment/" . $param) . "');\" type=\"button\" value=\"" . $this->lang->line('submitcomment') . "\" />
<input onclick=\" remove_edit_blog();\" type=\"button\" value=\"" . $this->lang->line('cancel') . "\" /></div>";
            $this->template->write('futures', $html);
        } else {
            $this->template->write('futures', "<span class=\"red\">" . $this->lang->line('addcomment') . "  -  " . lang('authr_user_only') . "</span>");
        }
    }

    function comments($id) {
        $this->db->select('blog_comments.*,users.avatar');
        $this->db->from('blog_comments');
        $this->db->where('artid', $id);
        $this->db->join('users', 'users.id =blog_comments.author');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = '';
            foreach ($query->result() as $row) {
                $result.="<img class=\"avatar\" style=\"float:left;padding-right:5px;\" src=\"" . base_url() . $row->avatar . "\" alt=\"avatar\" /><span>" .
                        $this->lang->line('author') . " : <a href=\"" . lang_url(null, 'user/profile/' . $row->author_name) . "\"> $row->author_name</a>
                        </span><p>" . $row->text . "</p><hr>";
                $this->syntaxhilight($row->text);
            }
            return '<span class="red">' . $this->lang->line('comments') . ' : </span><br />' . $result;
        } else {
            return '';
        }
    }

    function cat_menu() {
        $text = '<div class="title">' . $this->lang->line('cats') . '</div><ul>';
        $query = $this->db->get($this->db->dbprefix('catblog'));
        if ($query->num_rows > 0) {
            foreach ($query->result() as $row) {
                $href = '';
                $title = '';

                if ($this->permissions->simple(self::READ, unserialize($row->permissions)) == true) {
                    $href = 'href="' . lang_url('', 'blog/viewcat/' . $row->id) . '"';
                } else {
                    $title = '<br />' . $this->lang->line('accesdenie');
                }
                $text.='<li style="list-style:none;"><a title="' . $row->blogcat_desr . $title . '" ' . $href . '>' . $row->blogcat_name . "</a></li>";
            }
        }
        return "<div class=\"text_box\">$text</ul></div>";
    }

    function count($id) {
        $query = $this->db->get_where($this->db->dbprefix('blog'), array('catid' => $id));
        return $query->num_rows();
    }

    // $limit - кол-во получаемых записей
    // $offset - смещение, с какой записи начинать выборку
    function articles_count($limit, $offset, $id) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get_where($this->db->dbprefix('blog'), array('catid' => $id));
        return $query->result();
    }

    function pagination($offset ='', $id) {
        $limit = 5;
        $this->data['articles'] = $this->articles_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'blog/paginate/' . $id);
        $config['total_rows'] = $this->count($id);
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();

        $this->data['inner_view'] = "pagination";
        return $this->load->view('articles_in_cat', $this->data, true);
    }

    function random() {
        $result = '';
        $this->db->order_by("datepost", "desc");
        $query = $this->db->get_where($this->db->dbprefix('blog'), array('mainpage' => 1), 5);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                if ($this->permissions->simple(self::READ, unserialize($row->permissions))) {
                    $result.=$this->load->view('single_article', $row, true);
                }
        }
        return $result;
    }

    function article($data) {
        $this->template->write('title', $data->blogcat_name . ' - ' . $data->title, TRUE);
        $this->template->write('meta', $data->blogcat_name . ' ,' . $data->keywords);
        $this->template->write('metadescr', $data->keywords . ' ,' . $data->blogcat_desr);
        //$this->template->write('title2', $row->name, TRUE);
        $func = array('edit', 'add', 'read');
        $this->permissions->proceed($module = 'blogs', unserialize($data->permissions), $func, $data->id);
        $this->template->write('futures', '<p class="blog_comments">'.$this->comments($data->id).'</p>');
        $this->template->write_view('content', 'article', $data);
        $this->template->render();
    }

    function article_data($url) {
        $prefix = $this->config->item('dbprefix');
        $this->db->select("users.name,catblog.*,blog.*");
        $this->db->from('blog');
        $this->db->where('url', $url);
        $this->db->join('catblog', 'catblog.id = blog.catid');
        $this->db->join('users', 'users.id = blog.author');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            show_404();
        }
    }

    function pdf($data) {
        $this->load->library("pdf");
        $this->pdf->link = lang_url(null, 'blog/article/' . $data->url . '.html');
        $this->pdf->AddPage();
        $this->pdf->SetY(15);
        $html = $this->load->view('article', $data, true); //html_entity_decode(htmlentities($html))
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
        $this->pdf->writeHTML($this->xmlEntities($html), true, false, true, false, '');
        $this->pdf->Output($data->url . '.pdf', 'D');
    }

    function xmlEntities($string) {
        $translationTable = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);

        foreach ($translationTable as $char => $entity) {
            $from[] = $entity;
            $to[] = '&#' . ord($char) . ';';
        }
        return str_replace($from, $to, $string);
    }

    function syntaxhilight($data) {
        $langAlias = "";
       
	 $regexLangAlias = '/brush[^:]*:([\s|\S?:](.*?;))/s';
        // print_r(preg_match($regexLangAlias,$data));
        if (preg_match_all($regexLangAlias, $data, $langAliasMatches) > 0) {
            if($this->code==false){
                $this->template->add_js("system/js/syntaxhighlighter/scripts/shCore.js", 'import');
                $this->template->add_css("system/js/syntaxhighlighter/styles/shCore.css", 'link');
                $this->template->add_css("system/js/syntaxhighlighter/styles/shThemeDefault.css", 'link');
                $this->template->add_js("SyntaxHighlighter.config.clipboardSwf = '" . base_url() . "system/js/syntaxhighlighter/scripts/clipboard.swf';SyntaxHighlighter.all();", 'embed');
                $this->code=true;
            }
            
            $langAlias = $langAliasMatches[1];
            str_replace("&gt; ", "", $langAlias);
            foreach ($langAlias as $value) {
              
                switch ($value) {
                    case 'as3;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAS3.js");
                        break;
                    case 'clj;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushClojure.js", 'import');
                        break;
                    case 'css;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushCss.js", 'import');
                        break;
                    case 'fsharp;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushFSharp.js", 'import');
                        break;
                    case 'javascript;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushJScript.js", 'import');
                        break;
                    case 'script;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushJScript.js", 'import');
                        break;
                    case 'mathematica;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushMathematica.js", 'import');
                        break;
                    case 'objc;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushObjectiveC.js", 'import');
                        break;
                    case 'powershell;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPowerShell.js", 'import');
                        break;
                    case 'rpgle;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushRpgle.js", 'import');
                        break;
                    case 'sql;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushSql.js", 'import');
                        break;
                    case 'ada;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAda.js", 'import');
                        break;
                    case 'asm;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAsm.js", 'import');
                        break;
                    case 'coldfusion;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushColdFusion.js", 'import');
                        break;
                    case 'delphi;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushDelphi.js", 'import');
                        break;
                    case 'pascal;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushDelphi.js", 'import');
                        break;
                    case 'groovy;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushGroovy.js", 'import');
                        break;
                    case 'latex;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushLatex.js", 'import');
                        break;
                    case 'matlab;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushMatlab.js", 'import');
                        break;
                    case 'perl;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPerl.js", 'import');
                        break;
                    case 'processing;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushProcessing.js", 'import');
                        break;
                    case 'ruby;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushRuby.js", 'import');
                        break;
                    case 'vb;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushVb.js", 'import');
                        break;
                    case 'autohotkey;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAhk.js", 'import');
                        break;
                    case 'shell;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushBash.js", 'import');
                        break;
                    case 'cpp;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushCpp.js", 'import');
                        break;
                    case 'c;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushCpp.js", 'import');
                        break;
                    case 'diff;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushDiff.js", 'import');
                        break;
                    case 'javafx;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushJavaFX.js", 'import');
                        break;
                    case 'lsl;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushLsl.js", 'import');
                        break;
                    case 'matlabkey;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushMatlabSimple.js", 'import');
                        break;
                    case 'php;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPhp.js", 'import');
                        break;
                    case 'python;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPython.js", 'import');
                        break;
                    case 'sahiscript;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushSahi.js", 'import');
                        break;
                    case 'xml;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushXml.js", 'import');
                        break;
                    case 'applescript;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushAppleScript.js", 'import');
                        break;
                    case 'bat;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushBat.js", 'import');
                        break;
                    case 'csharp;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushCSharp.js", 'import');
                        break;
                    case 'erlang;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushErlang.js", 'import');
                        break;
                    case 'java;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushJava.js", 'import');
                        break;
                    case 'lua;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushLua.js", 'import');
                        break;
                    case 'nasm;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushNasm8086.js", 'import');
                        break;
                    case 'text;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushPlain.js", 'import');
                        break;
                    case 'ros;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushRouterOS.js", 'import');
                        break;
                    case 'scala;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushScala.js", 'import');
                        break;
                    case 'yaml;': $this->template->add_js("system/js/syntaxhighlighter/scripts/shBrushYaml.js", 'import');
                        break;
                }
            }
        }
    }

}