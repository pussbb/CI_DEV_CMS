<?php

class Qhda_mod extends CI_Model {
   
    var $qhda='';
    function Qhda_mod() {
        parent::CI_Model();
        //$this->db->close();
        $config['hostname'] = 'localhost';
        $config['username'] = 'root';
        $config['password'] = '';
        $config['database'] = 'b16_3360947_hda';
        $config['dbdriver'] = 'mysql';
        $config['dbprefix'] = null;
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        $config['swap_pre'] = '';
        $this->qhda=$this->load->database($config,true);
        $this->load->helper('article');
    }
    function get_books($full_url = true)
    {
        $query=$this->qhda->get('regbooks');
        $result='';
        if($query->num_rows()>0)
        {

            foreach($query->result() as $row)
            {$href='';
                if($full_url) $href= 'href="' . lang_url('', 'blog/qhda/' . $row->id) ;
                else $href='href="/'.lang_id().'/blog/qhda/' . $row->id;
              $result.='<li ><a title="' . $row->descr. '" '.$href.'">' . $row->name . "</a></li>";
            }
        }
      $this->load->database('default', TRUE);
        return $result;

    }
     function count($id) {
        
        $this->qhda->select("*");
        $this->qhda->from('artikle');
        foreach ($id as $row) {
             $this->qhda->or_where('catid', $row);
            }
        $query = $this->qhda->get();  ;
        return $query->num_rows();
    }

    // $limit - кол-во получаемых записей
    // $offset - смещение, с какой записи начинать выборку
    function articles_count($limit, $offset, $id) {
        
        $this->qhda->select("*");
        $this->qhda->from('artikle');
        $this->qhda->limit($limit, $offset);
        foreach ($id as $row) {
             $this->qhda->or_where('catid', $row);
        }
        $query = $this->qhda->get();  ;
        return $query->result();
    }
    function pagination($offset ='', $id) {
        $this->qhda->select("*");
        $this->qhda->from('regbooks');
        $this->qhda->where('regbooks.id', $id);
        $this->qhda->join('bookcat', 'regbooks.id = bookcat.bookid');
        $query = $this->qhda->get();
        if ($query->num_rows() > 0) {
             $ids=array();
            foreach ($query->result() as $row) {
                $ids[]=$row->id;
            }
           return $this->_pagination($offset, $ids);
        }
    }
    function _pagination($offset ='', $id) {
        $limit = 5;
        $this->data['articles'] = $this->articles_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'blog/qhdapaginate/' . $this->uri->segment(4, 0));
        $config['total_rows'] = $this->count($id);
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();

        $this->data['inner_view'] = "pagination";
        return $this->load->view('qhda/article_in_book', $this->data, true);
    }
    function myTruncate($string, $limit, $break=".", $pad="...")
    {
      // return with no change if string is shorter than $limit
      if(strlen($string) <= $limit) return $string;

      // is $break present between $limit and the end of the string?
      if(false !== ($breakpoint = strpos($string, $break, $limit))) {
        if($breakpoint < strlen($string) - 1) {
          $string = substr($string, 0, $breakpoint) . $pad;
        }
      }

      return $string;
    }
    function book_articles()
    {
        
        $this->qhda->select("*");
        $this->qhda->from('regbooks');
        $this->qhda->where('regbooks.id', $this->uri->segment(4, 0));
        $this->qhda->join('bookcat', 'regbooks.id = bookcat.bookid');
        $query = $this->qhda->get(); 
        if ($query->num_rows() > 0) {
            
             $meta='';
             $title='';
             $ids=array();
          // print_r($query->result());
            foreach ($query->result() as $row) {
             //$this->qhda->or_where('catid', $row->id);
                $ids[]=$row->id;
             $meta.=$row->name.','.$row->descr.','.$row->catname;
             $title=$row->name;
            }
            $this->template->write('meta',$meta , TRUE);
            $this->template->write('metadescr', $meta, TRUE);
            $this->template->write('title', $title, true);
            $this->template->write('content', $this->_pagination(null, $ids));
            $this->template->render();
        } else {
            show_404();
        }
    }
    function book_article($id)
    {
        $this->qhda->select("*");
        $this->qhda->from('artikle');
        
        $this->qhda->where('id',$id);
        $query=$this->qhda->get();
        if($query->num_rows()>0)
        {
            $data=$query->row_array();
            
            $this->qhda->select("regbooks.*,bookcat.catname,bookcat.bookid");
            $this->qhda->from('bookcat');
            $this->qhda->where('bookcat.id', $data['catid']);
            $this->qhda->join('regbooks', 'regbooks.id = bookcat.bookid');
            $query = $this->qhda->get();
            $data['book_title']=$query->row_array();
            $meta=$data['book_title']['catname'].','.$data['book_title']['descr'].','.$data['book_title']['name'];
            $this->template->write('meta',$meta , TRUE);
            $this->template->write('metadescr', $meta, TRUE);
            $this->template->write('title', $data['name'], true);
            $this->template->write_view('content','qhda/article',$data );
            $this->template->render();
            
        }
        else
        {
            show_404();
        }
    }
}
