<?php

class Blogs extends CI_Model {
    const EDIT=0;
    const ADD=1;
    const READ=2;

    function Blogs() {
        parent::CI_Model();
        $this->load->library('pagination');
    }

    function read($role,$param) {
        if ($role == false) {
            //echo 'You don\'t have permission to acces edit<br />';
        } else {
            $this->template->write('futures', '<script type="text/javascript">
                $(document).ready(function(){
                blog_comments('.$param.');
                });</script><p class="blog_comments"></p>');
        }
    }

    function edit($role,$param) {
        if ($role == false) {
            //echo 'You don\'t have permission to acces edit<br />';
        } else {
            //echo 'edit<br />';
        }
    }

    function add($role,$param) {
        if ($role == true) {
            $this->template->add_js("system/js/ckeditor/ckeditor.js", 'import');
            $this->template->add_js("system/js/ckeditor/adapters/jquery.js", 'import');
            $html="
                <input onclick=\"blog_add_editor();\" type=\"button\" value=\"Add comment\" />
                <input onclick=\"blog_get_text_editor();\" type=\"button\" value=\"Add comment\" />
<div class=\"blog_comments_editor\">
	</div>";
            $this->template->write('futures',$html);
        } else {
            $this->template->write('futures', 'you dont have permission');
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
        $this->permissions->proceed($module = 'blogs', unserialize($data->permissions), $func,$data->id);
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

}