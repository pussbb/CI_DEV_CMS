<?php

class Action extends CI_Model {

    function Action() {
        parent::CI_Model();
        $this->load->library('pagination');
    }

    function count($id) {
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    function article() {
        $uri = $this->uri->rsegment(3);
        if (is_numeric($uri) && $uri != 0) {

            $query = $this->db->get_where('blog', array('id' => $uri));
            $query2 = $this->db->get('catblog');

            $this->load->view('newarticle', array('cats' => $query2->result(), 'data' => $query->row_array()));
            return;
        }
        if (isset($_POST['title']) == false) {
            $data = array(
                'title' => '',
                'textpost' => '',
                'catid' => -1,
                'url' => '',
                'keywords' => "  ",
                'mainpage' => 0,
            );
            $query = $this->db->get('catblog');
            $this->load->view('newarticle', array('cats' => $query->result(), 'data' => $data));
        } else {

            if (isset($_POST['title']) && isset($_POST['catid']) && isset($_POST['text'])) {
                $perm = $this->userauth->default_permision;
                $catid = $this->input->post('catid');
                if (!isset($_POST['admin']) && !isset($_POST['user'])) {
                    $query = $this->db->get_where('catblog', array('id' => $this->input->post('catid')));
                    if ($query->num_rows > 0) {
                        $row = $query->row();
                        $perm = $row->permissions;
                    }
                } else {
                    $perm = $this->_post_perm();
                }
                $data = array(
                    'title' => $this->input->post('title'),
                    'textpost' => $this->input->post('text'),
                    'permissions' => $perm,
                    'catid' => $catid,
                    'author' => $this->session->userdata('userid'),
                    'url' => isset($_POST['url']) && !empty($_POST['url']) ? $this->input->post('url') : date("Y_m_d_h_m"),
                    'keywords' => isset($_POST['keywords']) && !empty($_POST['keywords']) ? $this->input->post('keywords') : "  ",
                    'shorttext' => truncate($this->input->post('text'), 200),
                    'datepost' => date("Y-m-d"),
                    'mainpage' => isset($_POST['mainpage']) ? $this->input->post('mainpage') : 0,
                );
                if (isset($_POST['article_id'])) {
                    $this->db->where('id', $this->input->post('article_id'));
                    if ($this->db->update('blog', $data) == 1)
                        echo 'Added';
                    else
                        echo 'error';
                }
                else {
                    if ($this->db->insert('blog', $data) == 1)
                        echo 'Added';
                    else
                        echo 'error';
                }
            }
        }
    }

    function newblogcat() {
        $uri = $this->uri->rsegment(3);
        if (is_numeric($uri) && $uri != 0) {

            $query = $this->db->get_where('catblog', array('id' => $uri));


            $this->load->view('newblogcat', array('data' => $query->row_array()));
            return;
        }
        if (isset($_POST['title']) == false) {
            $data = array(
                'id' => 0,
                'blogcat_name' => '',
                'blogcat_desr' => '',
                'permissions' => serialize($this->userauth->default_permision),
            );
            $this->load->view('newblogcat', array('data' => $data));
        } else {
            $perm = $this->userauth->default_permision;
            if (isset($_POST['admin']) && isset($_POST['user'])) {
                $perm = $this->_post_perm();
            }
            $data = array(
                'blogcat_name' => $this->input->post('title'),
                'blogcat_desr' => $this->input->post('blogcat_desr'),
                'permissions' => $perm
            );
            if (isset($_POST['blogcat_id'])) {
                $this->db->where('id', $this->input->post('blogcat_id'));
                if ($this->db->update('catblog', $data) == 1)
                    echo 'Added';
                else
                    echo 'error';
            }
            else {
                if ($this->db->insert('catblog', $data) == 1)
                    echo 'Added';
                else
                    echo 'error';
            }
        }
    }

    function newdowncat() {
        $uri = $this->uri->rsegment(3);
        if (is_numeric($uri) && $uri != 0) {

            $query = $this->db->get_where('downcat', array('id' => $uri));
            $this->load->view('newdowncat', array('data' => $query->row_array()));
            return;
        }
        if (isset($_POST['title']) == false) {

            $data = array(
                'id' => 0,
                'catname' => '',
                'catdescr' => '',
                'permission' => serialize($this->userauth->default_permision),
            );
            $this->load->view('newdowncat', array('data' => $data));
        } else {

            if (isset($_POST['title'])) {
                $perm = $this->userauth->default_permision;
                $catid = $this->input->post('catid');
                if (isset($_POST['admin']) && isset($_POST['user'])) { 
                    $perm = $this->_post_perm();
                }
                $data = array(
                    'catname' => $this->input->post('title'),
                    'catdescr' => $this->input->post('catdescr'),
                    'permission' => $perm,
                    
                );
                if (isset($_POST['downcat_id'])) {
                    $this->db->where('id', $this->input->post('downcat_id'));
                    if ($this->db->update('downcat', $data) == 1)
                        echo 'Added';
                    else
                        echo 'error';
                }
                else {
                    if ($this->db->insert('downcat', $data) == 1)
                        echo 'Added';
                    else
                        echo 'error';
                }
            }
        }
    }

    function newfile() {
        $uri = $this->uri->rsegment(3);
        if (is_numeric($uri) && $uri != 0) {
            $query = $this->db->get_where('downfiles', array('id' => $uri));
            $query2 = $this->db->get('downcat');

            $this->load->view('newfile', array('cats' => $query2->result(), 'data' => $query->row_array()));
            return;
        }
        if (isset($_POST['namefile']) == false) {
            $query = $this->db->get('downcat');
            $data = array(
                'name' => '',
                'descr' => '',
                'catid' => -1,
                'image' => '',
                'filepath' => ''
            );
            $this->load->view('newfile', array('cats' => $query->result(), 'data' => $data));
        } else {
            if (isset($_POST['namefile']) && isset($_POST['catid']) && isset($_POST['file'])) {
                $perm = $this->userauth->default_permision;
                $catid = $this->input->post('catid');
                if (!isset($_POST['admin']) && !isset($_POST['user'])) {
                    $query = $this->db->get_where('downcat', array('id' => $this->input->post('catid')));
                    if ($query->num_rows > 0) {
                        $row = $query->row();
                        $perm = $row->permission;
                    }
                } else {
                    $perm = $this->_post_perm();
                }

                $file = FCPATH . "../" . $this->input->post('file');
                $dets = 'Size: ' . $this->_niceSize(filesize($file)) . '<br />' . 'Date :' . date("d.m.y");
                // echo $dets;exit();
                $data = array(
                    'name' => $this->input->post('namefile'),
                    'descr' => $this->input->post('descr'),
                    'permission' => $perm,
                    'catid' => $catid,
                    'details' => $dets,
                    'image' => $this->input->post('image'),
                    'filepath' => $this->input->post('file')
                );
                if (isset($_POST['app_id'])) {
                    $this->db->where('id', $this->input->post('app_id'));
                    if ($this->db->update('downfiles', $data) == 1)
                        echo 'Added';
                    else
                        echo 'error';
                }
                else {
                    if ($this->db->insert('downfiles', $data) == 1)
                        echo 'Added';
                    else
                        echo 'error';
                }
            }
        }
    }

    function _niceSize($size) {
        $sidestep = 1024.0;
        static $sizeUnits = array();
        if (count($sizeUnits) == 0) {
            $sizeUnits[] = "&nbsp;" . "B";
            $sizeUnits[] = "KB";
            $sizeUnits[] = "MB";
            $sizeUnits[] = "GB";
            $sizeUnits[] = "TB";
        }

        if ($size === "")
            return "";

        $unitIndex = 0;
        while ($size > $sidestep) {
            $size = $size / $sidestep;
            $unitIndex++;
        }

        if ($unitIndex == 0) {
            return number_format($size, 0) . "&nbsp;" . $sizeUnits[$unitIndex];
        } else {
            return number_format($size, 1, ".", ",") . "&nbsp;" . $sizeUnits[$unitIndex];
        }
    }

    function user_edit() {
        if (!isset($_POST['user_id'])) {
            $uri = $this->uri->rsegment(3);
            $query = $this->db->get_where('users', array('id' => $uri));
            $this->load->view('edit_user', array('user' => $query->row()));
        } else {

            $permission['group'] = $this->input->post('group');
            $permission['admin'] = $this->input->post('admin');
            $permission['user'] = $this->input->post('user');
            $permission['guest'] = $this->input->post('guest');
            if (isset($_POST['banned'])) {
                $data['banned'] = 1;
                $data['banedreason'] = $this->input->post('banedreason');
            } else {
                $data['banned'] = 0;
                $data['banedreason'] = '';
            }
            $data['permission'] = serialize($permission);
            $this->db->where('id', $this->input->post('user_id'));
            if ($this->db->update('users', $data) == 1)
                echo 'Added';
            else
                echo 'error';
        }
    }

    function _post_perm() {
        $permission['group'] = $this->input->post('group');
        $permission['admin'] = $this->input->post('admin');
        $permission['user'] = $this->input->post('user');
        $permission['guest'] = $this->input->post('guest');
        return serialize($permission);
    }

    // $limit - кол-во получаемых записей
    // $offset - смещение, с какой записи начинать выборку
    function user_count($limit, $offset, $id) {
        $this->db->limit($limit, $offset);
        $this->db->from("users");
        $query = $this->db->get();
        return $query->result();
    }

    function userpagination($offset ='', $id) {
        $limit = 10;
        $this->data['users'] = $this->user_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'actions/userpaginate/' . $id);
        $config['total_rows'] = $this->count($id);
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();
        $this->data['inner_view'] = "pagination";
        return $this->load->view('users', $this->data, true);
    }

    function blog_count($limit, $offset, $id) {
        $this->db->limit($limit, $offset);
        $this->db->select('blog.*,catblog.blogcat_name');
        $this->db->from("blog");
        $this->db->join('catblog', 'catblog.id = blog.catid');
        $query = $this->db->get();
        return $query->result();
    }

    function blogpagination($offset ='', $id) {
        $limit = 10;
        $this->data['blog'] = $this->blog_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'actions/blogpaginate/' . $id);
        $query = $this->db->get('blog');
        $config['total_rows'] = $query->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();
        $this->data['inner_view'] = "pagination";
        return $this->load->view('blog', $this->data, true);
    }

    function app_count($limit, $offset, $id) {
        $this->db->limit($limit, $offset);
        $this->db->select('downfiles.*,downcat.catname');
        $this->db->from("downfiles");
        $this->db->join('downcat', 'downcat.id = downfiles.catid');
        $query = $this->db->get();
        return $query->result();
    }

    function apppagination($offset ='', $id) {
        $limit = 10;
        $this->data['app'] = $this->app_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'actions/apppaginate/' . $id);
        $query = $this->db->get('downfiles');
        $config['total_rows'] = $query->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();
        $this->data['inner_view'] = "pagination";
        return $this->load->view('app', $this->data, true);
    }
    function blogcomments_count($limit, $offset, $id) {
        $this->db->limit($limit, $offset);
        $this->db->from("blog_comments");
        $query = $this->db->get();
        return $query->result();
    }

    function blogcomments($offset ='', $id) {
        $limit = 10;
        $this->data['comments'] = $this->blogcomments_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'actions/bcommentspaginate/' . $id);
        $query = $this->db->get('blog_comments');
        $config['total_rows'] = $query->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();
        $this->data['inner_view'] = "pagination";
        return $this->load->view('blog_comments', $this->data, true);
    }
    function downfiles_statistic()
    {
        $query=$this->db->get('downfiles');
        $result='<table style="display:none;" id="datatable"><thead>
				<tr>
					<th></th>
					<th>Application downloads</th>
					
				</tr>
			</thead><tbody>';
        foreach ($query->result() as $item) {
            $result.='<tr><th>'.$item->name.'</th><td>'.$item->downed.'</td></tr>';
        }
        return $result.='</tbody></table>';
    }
    function errorlog()
    {
        $this->load->helper('directory');
        $this->load->helper('file');
        $file_path=$this->config->item('log_path');
        if($file_path=='')
            $file_path =BASEPATH.'logs/';

        $map = directory_map($file_path, 1);
        $this->load->view('logs',array('files'=>$map,'path'=>$file_path));
    }
}