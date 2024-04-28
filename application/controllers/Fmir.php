<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fmir extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('User_info_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
        $this->load->model('Fmir_model', '', TRUE);
    }

    function view($menu_group, $menu_cat)
    {


        $users =  $this->Fmir_model->getUsers();
        $link_id = 172;
        $data = array(
            'menu_group' => $menu_group,
            'menu_cat' => $menu_cat,
            'pages' => 'fmir/pages/grid',
            'checker_info' => $this->User_info_model->get_checker_data($link_id, '3,4,12,13,14,15'),
            'per_page' => $this->config->item('per_pagess'),
            'users' => $users
        );
        $this->load->view('grid_layout', $data);
    }

    function grid()
    {



        $this->load->model('Legal_notice_model', '', TRUE);
        $pagenum = $this->input->get('pagenum');
        $pagesize = $this->input->get('pagesize');
        $start = $pagenum * $pagesize;

        $result = $this->Fmir_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

        $data[] = array(
            'TotalRows' => $result['TotalRows'],
            'Rows' => $result['Rows'],
            'q' => $result['query']
        );
        echo json_encode($data);
    }
    public function details()
    {


        $type = null;
        if ($this->input->post('type')) {
            $type = $this->input->post('type');
        }



        $id = $this->input->post('id');
        $csrf_token = $this->security->get_csrf_hash();
        if ($id != '') {
            $rows = $this->Fmir_model->get_details($id, $type);
        } else {
            $rows = '';
        }
        $data['csrf_token'] = $csrf_token;
        $data['html'] = $rows['html'];
        //   $data['history'] = $rows['history'];
        echo json_encode($data);
    }



    function delete_action()
    {


        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Fmir_model->delete_action();
        } else {
            $text[] = "Session out, login required";
        }
        $Message = '';
        if (count($text) <= 0) {
            $Message = 'OK';
            if ($id == 'taken') {
                $Message = 'Action Already Taken Plz Refresh';
                $row[] = '';
            } else if ($id == 0) {
                $Message = 'Something went wrong';
                $row[] = '';
            } else if ($this->input->post("type") == 'delete') {
                $row[] = '';
            } else {
                $row[] = '';  //$row=$this->New_Contract_Model->get_add_action_data($id);
            }
        } else {
            for ($i = 0; $i < count($text); $i++) {
                if ($i > 0) {
                    $Message .= ',';
                }
                $Message .= $text[$i];
            }
            $row[] = '';
        }
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['row_info'] = $row;
        $var['id'] = $id;
        echo json_encode($var);
    }

    function form($add_edit = 'add', $id = NULL, $editrow = NULL)
    {

        $result = array();
        if ($id != null) {
            $result = $this->Fmir_model->getInfo($id);
        }


        $data = array(
            'option' => '',
            'add_edit' => $add_edit,
            'result' => $result,
            'id' => $id,
            'branch_sol' => $this->User_model->get_parameter_data('ref_branch_sol', 'name', 'data_status = 1'),
            'option' => 'Add',
            'pages' => 'fmir/pages/form',
            'editrow' => $editrow
        );
        $this->load->view('fmir/form_layout', $data);
    }

    function add_edit($id = null)
    {


        $status = false;
        $data['status'] = 201;
        $data['message'] = "failed";


        $_POST['letter_date'] = implode("-", array_reverse(explode("/", $this->input->post("letter_date"))));
        $_POST['inward_date'] = implode("-", array_reverse(explode("/", $this->input->post("inward_date"))));


        if ($this->input->post("fmir_id")) {
            //if fmir id found means edit mode
            $status = $this->Fmir_model->add_edit_fmir($this->input->post('fmir_id'), $this->input->post());
            if ($status) {
                $data['status'] = 200;
                $data['message'] = "Updated";
            }
        } else {
            //add data to fmir table
            $sl = $this->Fmir_model->get_unique_serial("fmir");
            $_POST['sl_no'] = $sl;

            $status = $this->Fmir_model->add_edit_fmir(null, $this->input->post());
            if ($status) {
                $data['status'] = 200;
                $data['message'] = "Added";
            }
        }
        $csrf_token = $this->security->get_csrf_hash();
        $data['csrf_token'] = $csrf_token;
        echo json_encode($data);
    }
}
