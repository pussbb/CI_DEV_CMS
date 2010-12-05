<?php

class User_mod extends CI_Model {

    function User_mod() {
        parent::CI_Model();
        $this->user_menu();
    }

    function user_menu() {
        if ($this->session->userdata('username') != NULL) {
            $this->menu($this->session->userdata('userid'));
        } else {
            $this->template->write_view('usermenu', 'loginbox');
        }
    }

    function menu($userid) {
        $this->template->add_js("system/js/ckeditor/ckeditor.js", 'import');
        $this->template->add_js("system/js/ckeditor/adapters/jquery.js", 'import');
        $query = $this->db->get_where($this->db->dbprefix('messages'), array('userid' => $userid, 'inbox' => 1));
        $data['inbox'] = $query->num_rows();
        $this->template->write_view('usermenu', 'user_menu', $data);
    }

    function pms($action) {
        if ($this->session->userdata('username') != NULL) {
            switch ($action) {
                case 'new' : $this->pms_new();
                    break;
                case 'inbox': $this->pms_inbox();
                    break;
                case 'outbox':$this->pms_outbox();
                    break;
                case 'toold': {
                        $data = array(
                            'inbox' => 0,
                        );
                        $this->db->where('id', $this->input->post('id'));
                        $this->db->update('messages', $data);
                        break;
                    }
                case 'deloutbox': {
                        $data = array(
                            'outbox' => 0,
                        );
                        $this->db->where('fromid', $this->session->userdata('userid'));

                        $this->db->update('messages', $data);
                        break;
                    }
                case 'del': {
                        $this->db->delete('messages', array('id' => $this->input->post('id')));
                        break;
                    }
                default: break;
            }
        }
    }

    function pms_new() {
        if (!empty($_POST)) {
            $title = $this->input->post('title');
            $text = $this->input->post('text');
            if ($this->session->userdata('username') != NULL
                    && !empty($title) && !empty($text)) {
                $data = array(
                    'userid' => $this->input->post('user'),
                    'title' => $title,
                    'msg' => $text,
                    'new' => 1,
                    'outbox' => 1,
                    'inbox' => 1,
                    'fromid' => $this->session->userdata('userid'),
                    'namefrom' => $this->session->userdata('username')
                );
                $this->db->insert('messages', $data);
                echo lang('msg_send') . "<script type=\"text/javascript\">cancel_new_msg();</script>";
            } else {
                echo lang('fill_form_error');
            }
        } else {
            $this->db->select('id,name');
            $query = $this->db->get('users');
            //print_r($query->result());
            $data['users'] = $query->result();
            $this->load->view("pms/new", $data);
        }
    }

    function pms_inbox() {

        $this->db->where('userid', $this->session->userdata('userid'));
        $this->db->order_by("inbox", "desc");
        $query = $this->db->get('messages');
        //$query=$this->db->get_where($this->db->dbprefix('messages'),array('userid'=>$this->session->userdata('userid')));
        $data['inbox'] = $query->result();
        $this->load->view("pms/inbox", $data);
    }

    function pms_outbox() {

        $this->db->select('messages.*,users.name');
        $this->db->from('messages');
        $this->db->where('fromid', $this->session->userdata('userid'));
        $this->db->where('outbox', 1);
        $this->db->join('users', 'users.id =messages.userid');

        $query = $this->db->get();
        $data['inbox'] = $query->result();
        $this->load->view("pms/outbox", $data);
    }
    function _user_setting()
    {
        $data='';
        foreach ($_POST as $key => $value) {
            if(!empty($value))
            {
                $data[$key]=$value;
            }
        }
        if(!isset ($_POST['visible']))
        {
            $data['visible']=0;
        }
        return $data;
    }

    function settings() {
        if (!empty($_POST)) {
            $this->db->where('id', $this->session->userdata('userid'));
            $this->db->update('user_data',  $this->_user_setting());
        }
        $this->db->where('id', $this->session->userdata('userid'));
        $query = $this->db->get('user_data');
        if ($query->num_rows == 0) {
            $data = array(
                'id' => $this->session->userdata('userid')
            );
            $this->db->insert('user_data', $data);
        }
        $this->db->select('user_data.*,users.avatar');
        $this->db->from('user_data');
        $this->db->where('user_data.id', $this->session->userdata('userid'));
        $this->db->join('users', 'users.id =user_data.id');

        $query = $this->db->get();
        return $this->load->view("userauth/settings", $query->row(), true);
    }

    function avatarup() {

        if (isset($_FILES["file"]) && is_uploaded_file($_FILES["file"]["tmp_name"]) &&
                $_FILES["file"]["error"] == 0) {
            $path = FCPATH . "images/avatars/";
            $this->load->helper('file');
            print_r($_FILES);
            $info = pathinfo($_FILES["file"]["name"]);
            $file = md5($info['filename']) . '.' . $info['extension'];
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $path . $file)) {
                chmod($path . $file, 0777);
                //image resize
                $config['source_image'] = $path . $file;
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 36;
                $config['height'] = 36;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                //
                $data = array(
                    'avatar' => "images/avatars/" . $file
                );
                $this->db->where('id', $this->session->userdata('userid'));
                $this->db->update('users', $data);
                redirect($_SERVER['HTTP_REFERER']);
            }
            // Create a pretend file id, this might have come from a database.
        } else {
            show_error("nothing to change for you avatar");
        }
        exit(0);
    }

    function profile($name)
    {
        if ($this->session->userdata('username') != NULL) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('name', $name);
        $query = $this->db->get();
            if($query->num_rows>0)
            {
                $row=$query->row();
                $this->db->select('user_data.*,users.avatar');
                $this->db->from('user_data');
                $this->db->where('user_data.id', $row->id);
                $this->db->join('users', 'users.id =user_data.id');

                $query = $this->db->get();
                return $this->load->view("userauth/profile", $query->row(), true);
            }
            else {
                return lang('user_notfound');
            }
        } else {
            return lang('authr_user_only');
        }
    }

}