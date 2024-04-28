<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recovery_af_fill extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Recovery_af_fill_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group, $menu_cat)
	{
		$data = array(
			'menu_group' => $menu_group,
			'menu_cat' => $menu_cat,
			'pages' => 'recovery_af_fill/pages/grid',
			'document_type' => $this->User_model->get_parameter_data('ref_document_type', 'name', 'data_status = 1'),
			'per_page' => $this->config->item('per_pagess')
		);
		$this->load->view('grid_layout', $data);
	}

	function grid()
	{
		$this->load->model('Recovery_af_fill_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Recovery_af_fill_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

		$data[] = array(
			'TotalRows' => $result['TotalRows'],
			'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}


	function from($add_edit = 'add', $id = NULL, $editrow = NULL)
	{

		$acLength = $this->Common_model->getInvestmentAcLength();
		$acPartStr = json_encode(explode(",", $acLength));


		$collection_method = array(1 => 'Pay Order', 2 => 'Cheque', 3 => 'Cash');
		$representative_user = $this->user_model->get_parameter_data('users_info', 'name', "user_group_id = '1'");
		$branch_name = $this->user_model->get_parameter_data('ref_branch_sol', 'name', "data_status=1");


		$bank_name = $this->user_model->get_parameter_data('ref_bank', 'name', "data_status=1");



		$this->load->model('Recovery_af_fill_model', '', TRUE);



		$result = $this->Recovery_af_fill_model->get_info($add_edit, $id);
		$data = array(
			'option' => '',
			'add_edit' => $add_edit,
			'result' => $result,
			'id' => $id,
			'collection_method' =>  $collection_method,
			'representative_user' =>  $representative_user,
			'branch_name' =>  $branch_name,
			'bank_name' =>  $bank_name,
			'document_type' => $this->User_model->get_parameter_data('ref_document_type', 'name', 'data_status = 1'),
			'pages' => 'recovery_af_fill/pages/form',
			'editrow' => $editrow,
			'acLength' => $acPartStr
		);
		$this->load->view('recovery_af_fill/form_layout', $data);
	}


	function add_edit_action($add_edit = NULL, $edit_id = NULL)
	{



		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {

			$id = $this->Recovery_af_fill_model->add_edit_action($add_edit, $edit_id);
		} else {
			$text[] = "Session out, login required";
		}

		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';
			$row = $this->Recovery_af_fill_model->get_add_action_data($id);
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

	function delete_action()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Recovery_af_fill_model->delete_action();
		} else {
			$text[] = "Session out, login required";
		}
		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';
			if ($this->input->post("type") == 'delete') {
				$row[] = '';
			} else {
				$row = $this->Recovery_af_fill_model->get_add_action_data($id);
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

	function details()
	{

		$csrf_token = $this->security->get_csrf_hash();
		if ($this->input->post('id') != "") {
			//$details=$this->Recovery_af_fill_model->get_ptp_info($this->input->post('id'));
			$details = array();
			$var = array(
				"details" => $details,
				"csrf_token" => $csrf_token
			);
			echo json_encode($var);
		}
	}
	function verify()
	{
		//$result=$this->Recovery_af_fill_model->verify_ptp($this->input->post('ptp_id'));
		$result = 1;
		$jTableResult = array();
		if ($result == 1) {
			$jTableResult['status'] = "success";
			$jTableResult['row_info'] = $result;
		} else {
			$jTableResult['status'] = "";
			$jTableResult['row_info'] = array();
		}
		$jTableResult['errorMsgs'] = 0;
		// $jTableResult['sql'] = $id;
		echo json_encode($jTableResult);
	}
}
