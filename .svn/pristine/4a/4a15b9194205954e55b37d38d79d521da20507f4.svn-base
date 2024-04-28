<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Terget_setup extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('Common_model', '', TRUE);
        $this->load->model('User_model', '', TRUE);
        $this->load->model('User_info_model', '', TRUE);
        $this->load->model('Terget_setup_model', '', TRUE);
    }

    function view($menu_group, $menu_cat)
    {


        $data = array(
            'menu_group' => $menu_group,
            'menu_cat' => $menu_cat,
            'pages' => 'terget_setup/pages/grid',
            'per_page' => $this->config->item('per_pagess')
        );
        $this->load->view('grid_layout', $data);
    }

    function grid()
    {


        $pagenum = $this->input->get('pagenum');
        $pagesize = $this->input->get('pagesize');
        $start = $pagenum * $pagesize;

        $result = $this->Terget_setup_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

        $data[] = array(
            'TotalRows' => $result['TotalRows'],
            'Rows' => $result['Rows']
        );
        echo json_encode($data);
    }



    function get_details(){
        $id = $this->input->post('id');
        $csrf_token=$this->security->get_csrf_hash();
        if($id!=''){
        $rows = $this->Terget_setup_model->get_details($id);
        }else{
            $rows='';
        }
        echo $csrf_token.'####'.$rows;
    }


    function delete_action()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Terget_setup_model->delete_action();
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
            $result = $this->Terget_setup_model->getInfo($id);
        }


        $data = array(
            'option' => '',
            'add_edit' => $add_edit,
            'result' => $result,
            'id' => $id,
            'option' => 'Add',
            'result' => $result,
            'req_type' => $this->User_model->get_parameter_data('ref_req_type', 'name', 'data_status = 1'),
            'pages' => 'terget_setup/pages/form',
            'editrow' => $editrow
        );
        $this->load->view('terget_setup/form_layout', $data);
    }

    function add_edit($id = null)
    {


        $status = false;
        $data['status'] = 201;
        $data['message'] = "failed";


        if ($this->input->post("action_type") == "edit") {
            // if tergetsetup id found means edit mode
            $status = $this->Terget_setup_model->add_edit_tergetSetup($this->input->post());
            if ($status) {
                $data['status'] = 200;
                $data['message'] = "Updated";
            }
        } else {
            //add data to terget Setup table

            $idStatus = $this->Terget_setup_model->checkYear($this->input->post('year'));

            if (!$idStatus) {
                $status = $this->Terget_setup_model->add_edit_tergetSetup($this->input->post());
                $data['status'] = 200;
                $data['message'] = "Added";
            } else {
                $data['status'] = 201;
                $data['message'] = "Duplicate Year";
            }
        }

        $data['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    function search_suit()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $rows = $this->Terget_setup_model->getSuitSearchResult();
        $data['csrf'] = $csrf_token;
        $data['rows'] =  $rows;
        echo json_encode($data);
    }
    function check()
    {
        echo  $status = $this->Terget_setup_model->checkYear("2022");
    }
}
