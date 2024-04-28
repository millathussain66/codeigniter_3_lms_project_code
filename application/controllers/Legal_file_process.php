<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Legal_file_process extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Legal_file_process_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Cma_process_model', '', TRUE);
		$this->load->model('Cma_ho_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Legal_status_expense_model', '', TRUE);
	}

	function view($menu_group, $menu_cat, $menu_links, $submenu = NULL)
	{
		$this->Common_model->delete_tempfile();
		$data = array(
			'menu_group' => $menu_group,
			'menu_cat' => $menu_cat,
			'submenu' => $submenu,
			'menu_links' => $menu_links,
			'ln_status' => $this->User_model->get_parameter_data('ref_ln_status', 'name', 'data_status = 1'),
			'branch' => $this->User_model->get_parameter_data('ref_branch_sol', 'name', 'data_status = 1'),
			'bank' => $this->User_model->get_parameter_data('ref_bank', 'name', 'data_status = 1'),
			'pages' => 'legal_file_process/pages/case_management_grid',
			'zone' => $this->user_model->get_parameter_data('ref_zone', 'id', 'data_status = 1'),
			'branch_sol' => $this->user_model->get_parameter_data('ref_branch_sol', 'id', 'data_status = 1'),
			'per_page' => $this->config->item('per_pagess')
		);
		$this->load->view('grid_layout', $data);
	}
	function suit_file_view($menu_group, $menu_cat, $menu_links, $submenu = NULL)
	{
		$cma_id = NULL;
		if (isset($_POST['grid_cma_id'])) {
			$cma_id = $_POST['grid_cma_id'];
		}
		$data = array(
			'menu_group' => $menu_group,
			'menu_cat' => $menu_cat,
			'submenu' => $submenu,
			'grid_cma_id' => $cma_id,
			'sys_config' => $this->User_info_model->upr_config_row(),
			'menu_links' => $menu_links,
			'branch_sol' => $this->User_model->get_parameter_data('ref_branch_sol', 'name', 'data_status = 1'),
			'district' => $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1'),
			'zone' => $this->User_model->get_parameter_data('ref_zone', 'name', 'data_status = 1'),
			'loan_segment' => $this->User_model->get_parameter_data('ref_loan_segment', 'name', 'data_status = 1'),
			'case_sts' => $this->User_model->get_parameter_data('ref_case_sts', 'name', 'data_status = 1'),
			'req_type' => $this->User_model->get_parameter_data('ref_req_type', 'name', 'data_status = 1'),
			'pages' => 'legal_file_process/pages/suit_file_grid',
			'per_page' => $this->config->item('per_pagess')
		);
		$this->load->view('grid_layout', $data);
	}
	function recase_file_view($menu_group, $menu_cat, $menu_links, $submenu = NULL)
	{
		$data = array(
			'menu_group' => $menu_group,
			'menu_cat' => $menu_cat,
			'submenu' => $submenu,
			'menu_links' => $menu_links,
			'zone' => $this->user_model->get_parameter_data('ref_zone', 'id', 'data_status = 1'),
			'branch_sol' => $this->user_model->get_parameter_data('ref_branch_sol', 'id', 'data_status = 1'),
			'case_sts' => $this->User_model->get_parameter_data('ref_case_sts', 'name', 'data_status = 1'),
			'sys_config' => $this->User_info_model->upr_config_row(),
			'req_type' => $this->User_model->get_parameter_data('ref_req_type', 'name', 'data_status = 1'),
			'pages' => 'legal_file_process/pages/recase_grid',
			'per_page' => $this->config->item('per_pagess')
		);
		$this->load->view('grid_layout', $data);
	}
	function case_details_view($menu_group, $menu_cat, $menu_links, $submenu = NULL)
	{
		$data = array(
			'menu_group' => $menu_group,
			'menu_cat' => $menu_cat,
			'submenu' => $submenu,
			'menu_links' => $menu_links,
			'req_type' => $this->User_model->get_parameter_data('ref_req_type', 'name', 'data_status = 1'),
			'branch_sol' => $this->User_model->get_parameter_data('ref_branch_sol', 'name', 'data_status = 1'),
			'pages' => 'legal_file_process/pages/case_details_grid',
			'per_page' => $this->config->item('per_pagess')
		);
		$this->load->view('grid_layout', $data);
	}
	function get_case_details_result()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$result = $this->Legal_file_process_model->get_all_cases();
		$merged_amount_array = array();
		$str_html = "";
		$total_legal_cost = 0;

		// if Have User Right  Add 33/5 And 33/7
		$user_id = $this->session->userdata['ast_user']['user_id'];
		$sql_ADD = "SELECT menu_link_id FROM users_right WHERE user_info_id =".$user_id." AND menu_link_id =458";
		$sql_DOWNLOAD = "SELECT menu_link_id FROM users_right WHERE user_info_id =".$user_id." AND menu_link_id =459";
		$sql_ADD_run = $this->db->query($sql_ADD)->result();
		$sql_DOWNLOAD_run = $this->db->query($sql_DOWNLOAD)->result();
		$HaveAddRight = 0;
		$HaveDownloadRight = 0;
		$countVal_add = count($sql_ADD_run); 
		if ($countVal_add==1) {
			$HaveAddRight = 1;
		}
		$countVal_download = count($sql_DOWNLOAD_run); 
		if ($countVal_download==1) {
			$HaveDownloadRight = 1;
		}
		// if Have User Right Add 33/5 And 33/7

		// if Have User Right  Warrant Form
		$sql_ADDWarrantForm = "SELECT menu_link_id FROM users_right WHERE user_info_id =".$user_id." AND menu_link_id =460";
		$sql_DOWNLOADWarrantForm = "SELECT menu_link_id FROM users_right WHERE user_info_id =".$user_id." AND menu_link_id =461";
		$sql_ADDWarrantForm_run = $this->db->query($sql_ADDWarrantForm)->result();
		$sql_DOWNLOADWarrantForm_run = $this->db->query($sql_DOWNLOADWarrantForm)->result();
		$HaveWarrantAddRight = 0;
		$HaveWarrantDownloadRight = 0;
		$countVal_add = count($sql_ADDWarrantForm_run); 
		if ($countVal_add==1) {
			$HaveWarrantAddRight = 1;
		}
		$countVal_download = count($sql_DOWNLOADWarrantForm_run); 
		if ($countVal_download==1) {
			$HaveWarrantDownloadRight = 1;
		}
		// if Have User Right Warrant Form


		if (!empty($result)) {
			$sl = 0;
			foreach ($result as $key) {
				if ($key->sts == 0) //when case was merged
				{
					$merged_amount_array[$key->merged_with] = $key->total_legal_cost;
					continue;
				}
				if (isset($merged_amount_array[$key->id])) {
					$total_legal_cost = $key->total_legal_cost + $merged_amount_array[$key->id];
				} else {
					$total_legal_cost = $key->total_legal_cost;
				}
				$sl++;
				$str_html .= '<tr>
                    <td style="text-align:center"><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' . $key->id . ')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>';


					if($HaveAddRight==1){
					$str_html .= '<td style="text-align:center"><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="add_additional_info(' . $key->id . ')" ><img align="center" src="' . base_url() . 'images/copy-26.png"></div></td>';
					}
					if($HaveDownloadRight==1){
					$str_html .= '<td style="text-align:center"><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="download_additional_info(' . $key->id . ')" ><img align="center" src="' . base_url() . 'images/downloading_updates-26.png"></div></td>';

					}


					if($HaveWarrantAddRight==1){
					$str_html .= '<td style="text-align:center"><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="add_warrantform(' . $key->id . ')" ><img align="center" src="' . base_url() . 'images/copy-26.png"></div></td>';
					}
					if($HaveWarrantDownloadRight==1){
					$str_html .= '<td style="text-align:center"><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="download_warrantform(' . $key->id . ')" ><img align="center" src="' . base_url() . 'images/downloading_updates-26.png"></div></td>';
					}

                    $str_html .= '<td style="text-align:center;word-wrap: break-word;">' . $key->proposed_type . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->loan_ac . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->ac_name . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->branch_name . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->case_name . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->filling_date . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->case_number . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->case_claim_amount . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->prev_date . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->case_sts_prev_dt . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->act_prev_date . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->next_date . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->next_date_sts . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->remarks_prev_date . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->filling_plaintiff . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->present_plaintiff . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->case_deal_officer . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->lawyer_name . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->prev_court_name . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->prest_court_name . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->district . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->loan_segment . '</td>
                    <td style="text-align:center;word-wrap: break-word;">' . $key->final_remarks . '</td>
                </tr>';
			}
		} else {
			$str_html = "<tr><td colspan='17' align='center'>No Data Found!!!</td></tr>";
		}
		echo $str_html . "####" . $csrf_token;
	}
	function make_xl()
	{
		$merged_amount_array = array();
		$str_where = "1";
		$maker_array = array("4", "6", "7", "8", "9");
		$head_office_array = array("2","3");
		if (in_array($this->session->userdata['ast_user']['user_work_group_id'], $maker_array)) //For Maker
		{
			$str_where .= " and s.branch_sol='" . $this->session->userdata['ast_user']['branch_code'] . "'";
		}
		else if(in_array($this->session->userdata['ast_user']['user_work_group_id'], $head_office_array)) // For HO User
        {
        	$str_where .= " and bs.ho_dealing_officer='" . $this->session->userdata['ast_user']['user_id'] . "'";
        }
		if ($_POST['proposed_type'] != '') {
			if ($_POST['proposed_type'] == 'Investment') {
				$str_where .= " AND s.loan_ac='" . $_POST['loan_ac'] . "'";
			} else if ($_POST['proposed_type'] == 'Card') {
				$str_where .= " AND s.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $_POST['hidden_loan_ac']) . "'";
			}
		}
		if ($_POST['req_type'] != '' && $_POST['req_type'] != 0) {
			$str_where .= " AND s.req_type IN(" . $_POST['req_type'] . ")";
		}
		if ($_POST['branch_sol'] != '' && $_POST['branch_sol'] != 0) {
			$str_where .= " AND s.branch_sol IN(" . $_POST['branch_sol'] . ")";
		}
		if ($_POST['zone'] != '' && $_POST['zone'] != 0) {
			$str_where .= " AND s.zone=" . $this->db->escape($_POST['zone']);
		}
		if ($_POST['district'] != '' && $_POST['district'] != 0) {
			$str_where .= " AND s.district=" . $this->db->escape($_POST['district']);
		}
		if ($_POST['loan_segment'] != '' && $_POST['loan_segment'] != 0) {
			$str_where .= " AND s.loan_segment=" . $this->db->escape($_POST['loan_segment']);
		}
		if ($_POST['case_number'] != '') {
			$str_where .= " AND s.case_number=" . $this->db->escape($_POST['case_number']);
		}
		$limit = "";
		if (isset($_POST['limit'])) {
			if (trim($this->input->post('limit')) != '' && trim($this->input->post('limit')) != 'All') {
				$limit .= " LIMIT " . trim($this->input->post('limit'));
			}
		}
		if ($this->input->post("filling_dt_from") != '') {
			$filling_dt_from = $this->input->post("filling_dt_from");
		} else {
			$filling_dt_from = '0';
		}
		if ($this->input->post("filling_dt_to") != '') {
			$filling_dt_to = $this->input->post("filling_dt_to");
		} else {
			$filling_dt_to = '0';
		}
		if ($filling_dt_from != '0') {
			$filling_dt_from = implode('-', array_reverse(explode('/', $filling_dt_from)));
		} else {
			$filling_dt_from = '0';
		}
		if ($filling_dt_to != '0') {
			$filling_dt_to = implode('-', array_reverse(explode('/', $filling_dt_to)));
		} else {
			$filling_dt_to = '0';
		}

		if ($filling_dt_from != '0' && $filling_dt_to == '0') {
			$str_where .= " and s.filling_date=" . $this->db->escape($filling_dt_from);
		}

		if ($filling_dt_from != '0' && $filling_dt_to != '0') {
			$str_where .= " and s.filling_date between " . $this->db->escape($filling_dt_from) . " and " . $this->db->escape($filling_dt_to);
		}


		$str = " SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
        lr.name as zone,ls.name as loan_segment,s.remarks_next_date,bs.name as branch_name,
        CONCAT(fp.name,' (',IF(fp.pin IS NULL,'',fp.pin),')')as filling_plaintiff,
        CONCAT(pp.name,' (',IF(pp.pin IS NULL,'',pp.pin),')')as present_plaintiff,
        CONCAT(bu.name,' (',IF(bu.pin IS NULL,'',bu.pin),')')as ho_dealing_officer,
        bu.mobile_number as ho_dealing_officer_mobile,
        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
            LEFT OUTER JOIN ref_district d ON (d.id=s.district)
            LEFT OUTER JOIN ref_branch_sol bs ON (bs.code=s.branch_sol)
            LEFT OUTER JOIN users_info bu ON (bu.id=bs.ho_dealing_officer)
            LEFT OUTER JOIN ref_zone lr ON (lr.id=s.zone)
            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) AND (s.suit_sts=75 OR s.suit_sts=76 OR s.suit_sts=81)   ORDER BY s.id ASC $limit";
		$query = $this->db->query($str);
		$result = $query->result();

		require_once('./application/Classes/PHPExcel.php');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$styleArray_border = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);

		$rowNumber = 1;
		$headings1 = array('Case Details Report');
		$objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':AA' . $rowNumber);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
		$rowNumber++;

		$rowNumber++;
		$sl = 0;
		$headings4 = array(
			'SL',
			'Proposed Type', 'A/C Number', 'A/C Name', 'Branch Name',
			'Type Of Case', 'Filling Date', 'Case Number',
			'Case Claim Amount', 'Previous Date', 'Case Status On The Previous Date', 'Activities Taken On The Previous Date',
			'Next Date', 'Case Status on the Next date', 'Remarks on Case Status on the Previous date',
			'Filling Plaintiff', 'Present Plaintiff', 'Case Dealings  officer', 'HO Dealings  officer', 'HO Dealings  officer Contact', 'Lawyer\'s Name',
			'Previous Name Of The Court', 'Present Name Of The Court', 'District', 'Remarks', 'Protfolio', 'Final Remarks','Unique ID'
		); //,strtotime($dealdate)));
		$objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->applyFromArray($styleArray_border);
		$rowNumber++;
		$sl = 0;
		$total_legal_cost = 0;
		foreach ($result as $key) {
			$sl++;
			$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$key->proposed_type,
				$key->loan_ac,
				$key->ac_name,
				$key->branch_name,
				$key->case_name,
				$key->filling_date,
				$key->case_number,
				$key->case_claim_amount,
				$key->prev_date,
				$key->case_sts_prev_dt,
				$key->act_prev_date,
				$key->next_date,
				$key->next_date_sts,
				$key->remarks_prev_date,
				$key->filling_plaintiff,
				$key->present_plaintiff,
				$key->case_deal_officer,
				$key->ho_dealing_officer,
				$key->ho_dealing_officer_mobile,
				$key->lawyer_name,
				$key->prev_court_name,
				$key->prest_court_name,
				$key->district,
				'',
				$key->loan_segment,
				$key->final_remarks,
				$key->id
			), NULL, 'A' . $rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':AA' . $rowNumber)->applyFromArray($styleArray_border);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
		}


		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('Case Details Report');
		//include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
		require_once './application/Classes/PHPExcel/IOFactory.php';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
		ob_clean();
		header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
		header("Content-type:   application/x-msexcel; charset=utf-8");
		header('Content-Disposition: attachment;filename="case_details_report.xls"');
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		$objWriter->save('php://output');
		exit();
	}
	function case_management_grid()
	{
		$this->load->model('Legal_file_process_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_file_process_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

		$data[] = array(
			'TotalRows' => $result['TotalRows'],
			'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function suit_file_grid()
	{
		$this->load->model('Legal_file_process_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_file_process_model->get_suit_file_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

		$data[] = array(
			'TotalRows' => $result['TotalRows'],
			'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function recase_file_grid()
	{
		$this->load->model('Legal_file_process_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_file_process_model->get_recase_file_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

		$data[] = array(
			'TotalRows' => $result['TotalRows'],
			'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function search_ac()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$str_where = "c.sts<>0";
		$maker_array = array("4", "6", "9");
		if (in_array($this->session->userdata['ast_user']['user_work_group_id'], $maker_array)) //For Maker
		{
			$str_where .= " AND c.legal_user='" . $this->session->userdata['ast_user']['user_id'] . "'";
		}

		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type')) == 'Investment') {
				$str_where .= " AND c.loan_ac='" . trim($this->input->post('loan_ac')) . "'";
			} else {
				$str_where .= " AND c.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('hidden_loan_ac')) . "'";
			}
		}
		if (trim($this->input->post('req_type')) != '') {
			$str_where .= " AND c.req_type=" . $this->db->escape(trim($this->input->post('req_type')));
		}
		$suit_row = $this->db->query("SELECT sub.* FROM(
			SELECT r.name as req_type,c.cma_sts,A.total_auth,c.id,c.loan_ac,c.ac_name,IF(c.ln_val_dt<='" . date("Y-m-d") . "', '1', '0') as ln_exp_sts
			FROM cma as c 
			LEFT OUTER JOIN ref_req_type r on(c.req_type=r.id)
			LEFT OUTER JOIN (
				SELECT a.event_id,COUNT(a.id) AS total_auth FROM authorization AS a WHERE (a.authorization_type=8 OR a.authorization_type=1) AND a.event_name='cma' AND a.sts=1 AND a.auth_sts=67 GROUP BY a.event_id
			)A on(c.id=A.event_id)
			WHERE " . $str_where . "
			)sub WHERE (sub.ln_exp_sts=1 AND sub.cma_sts=67) OR (sub.total_auth>0 AND sub.cma_sts!=64 AND sub.cma_sts!=65 AND sub.cma_sts!=75)")->result();
		$str_html = "";
		$str_html .= "<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Type</strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Investment AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>";
		if (count($suit_row) > 0) {

			$sl = 1;
			foreach ($suit_row as $row) {

				$str_html .= "<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' name='suit_id' onclick='onlyOne(this)' value='" . $row->id . "' /></td>
				<td style='border:1px solid #a0a0a0'>" . $row->req_type . "
				<input type='hidden' id='id_" . $sl . "' value='" . $row->id . "' />
				<td style='border:1px solid #a0a0a0'>" . $row->loan_ac . "</td>
				<td style='border:1px solid #a0a0a0'>" . $row->ac_name . "</td>
				</tr>";
				$sl++;
			}
			$str_html .= "<input type='hidden' id='suitCount' value='" . count($suit_row) . "' />
				<tr><td colspan='5'></td></tr>
				<tr><td colspan='5' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='load_filing_info()' id='next_button'>Next</button><span id=\"next_loading\" style=\"display:none\">Please wait... <img src=\"" . base_url() . "images/loader.gif\" align=\"bottom\"></span></td></tr>
			</table>";
		} else {
			$str_html .= "<tr><td colspan='5' align='center'>No Result Found !!!</td></tr>";
		}
		echo $str_html . "####" . $csrf_token;
	}
	function search_recase_suit()
	{

		$csrf_token = $this->security->get_csrf_hash();
		$str_where = "c.sts<>0 AND (c.suit_sts=75 || c.suit_sts=76)";
		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type')) == 'Investment') {
				if (trim($this->input->post('loan_ac')) != '') {
					$str_where .= " AND c.loan_ac='" . trim($this->input->post('loan_ac')) . "'";
				}
			} else {
				$str_where .= " AND c.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('hidden_loan_ac')) . "'";
			}
		}
		if (trim($this->input->post('req_type')) != '') {
			$str_where .= " AND c.req_type=" . $this->db->escape(trim($this->input->post('req_type')));
		}
		if (trim($this->input->post('case_number')) != "") {
			$str_where .= " AND c.case_number=" . $this->db->escape(trim($this->input->post('case_number')));
		}
		$suit_row = $this->db->query("SELECT r.name as req_type,c.final_remarks as final_remarks_id,fr.name as final_remarks,c.case_number,c.id,c.loan_ac,c.ac_name
			FROM suit_filling_info as c 
			LEFT OUTER JOIN ref_final_remarks fr on(fr.id=c.final_remarks)
			LEFT OUTER JOIN ref_req_type r on(c.req_type=r.id)
			WHERE " . $str_where . "")->result();

		// echo $this->db->last_query();
		// exit();
		$str_html = "";
		$str_html .= "<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Type</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Investment AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>
			<td style='width:10%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:10%;border:1px solid #a0a0a0'><strong>Final Remarks</strong></td>";

		if (count($suit_row) > 0) {

			$sl = 1;
			foreach ($suit_row as $row) {

				$str_html .= "<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' name='suit_id' onclick='onlyOne(this)' value='" . $row->id . "' /></td>
				<td style='border:1px solid #a0a0a0'>" . $row->req_type . "
				<input type='hidden' id='id_" . $sl . "' value='" . $row->id . "' />
				<td style='border:1px solid #a0a0a0'>" . $row->loan_ac . "</td>
				<td style='border:1px solid #a0a0a0'>" . $row->ac_name . "</td>
				<td style='border:1px solid #a0a0a0'>" . $row->case_number . "</td>
				<td style='border:1px solid #a0a0a0'><input type='hidden' id='case_close_sts_" . $row->id . "' name='case_close_sts_" . $row->id . "' value='" . $row->final_remarks_id . "'>" . $row->final_remarks . "</td>
				</tr>";
				$sl++;
			}
			$str_html .= "<input type='hidden' id='suitCount' value='" . count($suit_row) . "' />
				<tr><td colspan='6'></td></tr>
				<tr><td colspan='6' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='load_filing_info()' id='next_button'>Next</button><span id=\"next_loading\" style=\"display:none\">Please wait... <img src=\"" . base_url() . "images/loader.gif\" align=\"bottom\"></span></td></tr>
			</table>";
		} else {
			$str_html .= "<tr><td colspan='6' align='center'>No Result Found !!!</td></tr>";
		}
		echo $str_html . "####" . $csrf_token;
	}
	function get_filing_info_edit()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token = $this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$package_info = array();
		$package_sts = 0;
		$row_info = $this->Legal_file_process_model->get_add_action_data_suit($id);
		$expense = $this->Legal_file_process_model->get_expenese_info($id);
		if (!empty($row_info)) {
			$Message = 'ok';
			$package_info = $this->db->query("SELECT h.*,h.id as history_id,c.id as package_id,c.case_number,c.loan_ac,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,c.package_amount,l.name as lawyer_name
			FROM package_select_history as h 
			LEFT OUTER JOIN lawyer_package_bill_setup c on(h.package_id=c.id)
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE h.event_id='" . $row_info->id . "' AND h.event_table_name='suit_filling_info' LIMIT 1")->row();
			if (!empty($package_info)) {
				$package_sts = 1;
			}
		} else {
			$Message = 'No Data';
		}
		$case_name = $this->User_model->get_parameter_data('ref_case_name', 'name', 'data_status = 1 AND req_type="' . $row_info->req_type . '"');

		$plaintiff = $this->User_model->get_parameter_data('users_info', 'name', 'data_status = 1  AND admin_status<>2  AND block_status = 0');//AND user_group_id IN(4,7)

		$case_sts = $this->User_model->get_parameter_data('ref_case_sts', 'name', 'data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1');
		$court = $this->User_model->get_parameter_data('ref_court', 'name', 'data_status = 1 AND district="' . $row_info->district . '"');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type', 'name', 'data_status = 1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1');
		if ($row_info->req_type == 2) {
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara', 'name', 'data_status = 1');
		} else {
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni', 'name', 'data_status = 1');
		}
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities', 'name', 'data_status = 1');
		$var['csrf_token'] = $csrf_token;
		$var['row_info'] = $row_info;
		$var['case_name'] = $case_name;
		$var['plaintiff'] = $plaintiff;
		$var['case_sts'] = $case_sts;
		$var['lawyer'] = $lawyer;
		$var['vendor'] = $vendor;
		$var['court'] = $court;
		$var['district'] = $district;
		$var['expense_activities'] = $expense_activities;
		$var['court_activities'] = $court_activities;
		$var['Message'] = $Message;
		$var['expense'] = $expense;
		$var['expense_type'] = $expense_type;
		$var['package_info'] = $package_info;
		$var['package_sts'] = $package_sts;
		echo json_encode($var);
	}
	function get_recase_info_edit()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$package_info = array();
		$package_sts = 0;
		$row_info = $this->Legal_file_process_model->get_add_action_data_recase($id);
		$suit_info = $this->Legal_file_process_model->get_suit_info($row_info->pre_suit_id);
		$expense = $this->Legal_file_process_model->get_expenese_info($id);

		if (!empty($row_info)) {
			$Message = 'ok';
			$package_info = $this->db->query("SELECT h.*,h.id as history_id,c.id as package_id,c.case_number,c.loan_ac,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,c.package_amount,l.name as lawyer_name
			FROM package_select_history as h 
			LEFT OUTER JOIN lawyer_package_bill_setup c on(h.package_id=c.id)
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE h.event_id='" . $row_info->id . "' AND h.event_table_name='suit_filling_info' LIMIT 1")->row();
			if (!empty($package_info)) {
				$package_sts = 1;
			}
		} else {
			$Message = 'No Data';
		}
		$case_name = $this->User_model->get_parameter_data('ref_case_name', 'name', 'data_status = 1 AND req_type="' . $row_info->req_type . '"');
		$plaintiff = $this->User_model->get_parameter_data('users_info', 'name', 'data_status = 1  AND admin_status<>2  AND block_status = 0');//AND user_group_id IN(4,7)
		$case_sts = $this->User_model->get_parameter_data('ref_case_sts', 'name', 'data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1');
		$court = $this->User_model->get_parameter_data('ref_court', 'name', 'data_status = 1 AND district="' . $row_info->district . '"');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type', 'name', 'data_status = 1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1');
		if ($row_info->req_type == 2) {
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara', 'name', 'data_status = 1 AND aurtho_jari_sts=1');
		} else {
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni', 'name', 'data_status = 1');
		}
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities', 'name', 'data_status = 1');
		$var['csrf_token'] = $csrf_token;
		$var['row_info'] = $row_info;
		$var['case_name'] = $case_name;
		$var['suit_info'] = $suit_info;
		$var['plaintiff'] = $plaintiff;
		$var['case_sts'] = $case_sts;
		$var['lawyer'] = $lawyer;
		$var['vendor'] = $vendor;
		$var['court'] = $court;
		$var['district'] = $district;
		$var['expense_activities'] = $expense_activities;
		$var['court_activities'] = $court_activities;
		$var['Message'] = $Message;
		$var['expense'] = $expense;
		$var['expense_type'] = $expense_type;
		$var['package_info'] = $package_info;
		$var['package_sts'] = $package_sts;
		echo json_encode($var);
	}
	function get_filing_info()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token = $this->security->get_csrf_hash();
		$package_info = array();
		$package_sts = 0;
		$cma_id = $this->input->post('id');
		$cma_info = $this->Legal_file_process_model->get_cma_info($cma_id);
		if (!empty($cma_info)) {
			$Message = 'ok';
			$str_where = "c.sts<>0 AND c.disbursed_sts=0 AND c.v_sts=13 AND c.package_type=1";
			if ($cma_info->proposed_type == 'Investment') {
				$str_where .= " AND c.loan_ac='" . $cma_info->loan_ac . "'";
			} else {
				$str_where .= " AND c.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $cma_info->loan_ac) . "'";
			}
			$str_where .= " AND c.req_type=" . $this->db->escape($cma_info->req_type);
			$str_where .= " AND c.lawyer=" . $this->db->escape($cma_info->lawyer);
			$package_info = $this->db->query("SELECT c.*,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,l.name as lawyer_name
			FROM lawyer_package_bill_setup as c 
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE " . $str_where . " LIMIT 1")->row();
			if (!empty($package_info)) {
				$package_sts = 1;
			}
		} else {
			$Message = 'No Data';
		}
		$case_name = $this->User_model->get_parameter_data('ref_case_name', 'name', 'data_status = 1 AND req_type="' . $cma_info->req_type . '"');
		$plaintiff = $this->User_model->get_parameter_data('users_info', 'name', 'data_status = 1  AND admin_status<>2 AND block_status = 0');//AND user_group_id IN(4,6,9) 
		$case_sts = $this->User_model->get_parameter_data('ref_case_sts', 'name', 'data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1');
		$court = $this->User_model->get_parameter_data('ref_court', 'name', 'data_status = 1 AND district="' . $cma_info->case_fill_dist . '"');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type', 'name', 'data_status = 1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1');
		if ($cma_info->req_type == 2) {
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara', 'name', 'data_status = 1');
		} else {
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni', 'name', 'data_status = 1');
		}
		$case_prefix = $this->User_model->get_prefix_name('ref_req_type', 'name', 'data_status = 1 AND id="' . $cma_info->req_type . '"')->case_prefix;
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities', 'name', 'data_status = 1');
		$var['csrf_token'] = $csrf_token;
		$var['cma_info'] = $cma_info;
		$var['case_prefix'] = $case_prefix;
		$var['case_name'] = $case_name;
		$var['plaintiff'] = $plaintiff;
		$var['case_sts'] = $case_sts;
		$var['lawyer'] = $lawyer;
		$var['vendor'] = $vendor;
		$var['court'] = $court;
		$var['district'] = $district;
		$var['expense_activities'] = $expense_activities;
		$var['court_activities'] = $court_activities;
		$var['Message'] = $Message;
		$var['expense_type'] = $expense_type;
		$var['package_info'] = $package_info;
		$var['package_sts'] = $package_sts;
		echo json_encode($var);
	}
	function get_fresh_filing_info()
	{
		$Message = 'ok';
		$this->Common_model->delete_tempfile();
		$csrf_token = $this->security->get_csrf_hash();
		$plaintiff = $this->User_model->get_parameter_data('users_info', 'name', 'data_status = 1  AND admin_status<>2  AND block_status = 0');//AND user_group_id IN(4,6,9)
		$case_sts = $this->User_model->get_parameter_data('ref_case_sts', 'name', 'data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1');
		$court = $this->User_model->get_parameter_data('ref_court', 'name', 'data_status = 1');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type', 'name', 'data_status = 1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1');
		$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara', 'name', 'data_status = 1');
		$case_prefix = '';
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities', 'name', 'data_status = 1');
		$var['csrf_token'] = $csrf_token;
		$var['case_prefix'] = $case_prefix;
		$var['plaintiff'] = $plaintiff;
		$var['case_sts'] = $case_sts;
		$var['lawyer'] = $lawyer;
		$var['vendor'] = $vendor;
		$var['court'] = $court;
		$var['district'] = $district;
		$var['expense_activities'] = $expense_activities;
		$var['court_activities'] = $court_activities;
		$var['Message'] = $Message;
		$var['expense_type'] = $expense_type;
		echo json_encode($var);
	}
	function get_case_prefix()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token = $this->security->get_csrf_hash();
		$act_id = $this->input->post('act_id');
		$case_prefix = $this->User_model->get_prefix_name('ref_case_name', 'name', 'data_status = 1 AND id="' . $act_id . '"')->case_prefix;
		$var['csrf_token'] = $csrf_token;
		$var['case_prefix'] = $case_prefix;
		echo json_encode($var);
	}
	function get_recase_filing_info()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$suit_id = $this->input->post('id');
		$package_info = array();
		$package_sts = 0;
		$suit_info = $this->Legal_file_process_model->get_suit_info($suit_id);
		if (!empty($suit_info)) {
			$Message = 'ok';
			$str_where = "c.sts<>0 AND c.disbursed_sts=0 AND c.v_sts=13 AND c.package_type=1";
			if ($suit_info->proposed_type == 'Investment') {
				$str_where .= " AND c.loan_ac='" . $suit_info->loan_ac . "'";
			} else {
				$str_where .= " AND c.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $suit_info->loan_ac) . "'";
			}
			$str_where .= " AND c.req_type=" . $this->db->escape($suit_info->req_type);
			$str_where .= " AND c.lawyer=" . $this->db->escape($suit_info->prest_lawyer_name);
			$package_info = $this->db->query("SELECT c.*,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,l.name as lawyer_name
			FROM lawyer_package_bill_setup as c 
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE " . $str_where . " LIMIT 1")->row();
			if (!empty($package_info)) {
				$package_sts = 1;
			}
		} else {
			$Message = 'No Data';
		}
		$case_name = $this->User_model->get_parameter_data('ref_case_name', 'name', 'data_status = 1 AND req_type="' . $suit_info->req_type . '"');
		$plaintiff = $this->User_model->get_parameter_data('users_info', 'name', 'data_status = 1  AND admin_status<>2  AND block_status = 0');//AND user_group_id IN(4,6,9)
		$case_sts = $this->User_model->get_parameter_data('ref_case_sts', 'name', 'data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1');
		$court = $this->User_model->get_parameter_data('ref_court', 'name', 'data_status = 1 AND district="' . $suit_info->district . '"');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type', 'name', 'data_status = 1 AND id=1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1');
		if ($suit_info->req_type == 2) {
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara', 'name', 'data_status = 1 AND aurtho_jari_sts=1');
		} else {
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni', 'name', 'data_status = 1');
		}
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities', 'name', 'data_status = 1');
		$var['csrf_token'] = $csrf_token;
		$var['suit_info'] = $suit_info;
		$var['case_name'] = $case_name;
		$var['plaintiff'] = $plaintiff;
		$var['case_sts'] = $case_sts;
		$var['lawyer'] = $lawyer;
		$var['vendor'] = $vendor;
		$var['court'] = $court;
		$var['district'] = $district;
		$var['expense_activities'] = $expense_activities;
		$var['court_activities'] = $court_activities;
		$var['Message'] = $Message;
		$var['expense_type'] = $expense_type;
		$var['package_info'] = $package_info;
		$var['package_sts'] = $package_sts;
		echo json_encode($var);
	}
	function statement_download($type, $file_url)
	{
		if ($type == 'uploaded') {
			$file_url = 'cma_file/uploaded_statement/' . $file_url;
		} else if ($type == 'generated') {
			$file_url = 'cma_file/generated_statement/' . $file_url;
		} else {
			$file_url = '';
		}
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary");
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
		readfile($file_url);
	}
	function fileprocessing($id = NULL, $editrow = NULL, $proposed_type = NULL)
	{
		$link_id = '227';
		if ($proposed_type == 1) {
			$type = 'Investment';
		} else {
			$type = 'Card';
		}
		$result = $this->Cma_process_model->get_recommend_info($id);
		if ($type == 'Investment') {
			$facility_info = $this->Cma_ho_model->get_facility($id);
		} else {
			$facility_info = $this->Cma_ho_model->get_card_facility($id);
		}
		$bidder_info = $this->Cma_ho_model->get_bidder($id);
		$doc_files = $this->Cma_process_model->get_cma_doc_files($id);
		$checker_info = $this->User_info_model->get_checker_data($link_id, '', "zone=" . $result->zone . "");
		$data = array(
			'option' => '',
			'result' => $result,
			'doc_files' => $doc_files,
			'facility_info' => $facility_info,
			'bidder_info' => $bidder_info,
			'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit', $id),
			'facility_name' => $this->User_model->get_parameter_data('ref_facility_name', 'name', 'data_status = 1'),
			'id' => $id,
			'checker_info' => $checker_info,
			'proposed_type' => $type,
			'pages' => 'legal_file_process/pages/file_processing_form',
			'edit_row' => $editrow
		);
		$this->load->view('legal_file_process/form_layout', $data);
	}
	function delete_action()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if ($this->session->userdata['ast_user']['login_status']) {

			// echo "<pre>";
			// print_r($_POST);
			// exit();
			$id = $this->Legal_file_process_model->delete_action();
		} else {
			$text[] = "Session out, login required";
		}
		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';
			if ($id == 'taken') {
				$Message = 'Action Already Taken Plz Refresh';
				$row[] = '';
			} else if ($id == 'limitcrossed') {
				$Message = 'Sorry! Package Bill Limit Crossed Please Try Again.';
				$row[] = '';
			} else if ($id == 0) {
				$Message = 'Something went wrong';
				$row[] = '';
			} else if ($this->input->post("type") == 'delete') {
				$row[] = '';
			} else if (isset($_POST['typebulk'])) {
				$row[] = '';
			} else {
				$row = $this->Legal_file_process_model->get_add_action_data($id);
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
		$this->Common_model->delete_tempfile();
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $Message;
		$var['row_info'] = $row;
		$var['id'] = $id;
		echo json_encode($var);
	}
	function delete_action_recase()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if ($this->session->userdata['ast_user']['login_status']) {

			$id = $this->Legal_file_process_model->delete_action_recase();
		} else {
			$text[] = "Session out, login required";
		}
		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';
			if ($id == 'taken') {
				$Message = 'Action Already Taken Plz Refresh';
				$row[] = '';
			} else if ($id == 'limitcrossed') {
				$Message = 'Sorry! Package Bill Limit Crossed Please Try Again.';
				$row[] = '';
			} else if ($id == 'bill taken') {
				$Message = 'Unable to take action due to bill alreday selected on other end';
				$row[] = '';
			} else if ($id == 0) {
				$Message = 'Something went wrong';
				$row[] = '';
			} else if ($this->input->post("type") == 'delete') {
				$row[] = '';
			} else if (isset($_POST['typebulk'])) {
				$row[] = '';
			} else {
				$row = $this->Legal_file_process_model->get_add_action_data($id);
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
	function add_edit_suit_filling()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		$row = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			if ($_POST['edit_after_verify_sts'] == 0) {
				$id = $this->Legal_file_process_model->add_edit_suit_filling();
			} else {

				$id = $this->Legal_file_process_model->add_edit_suit_filling_after_verify();
			}
		} else {
			$text[] = "Session out, login required";
		}
		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';
			if ($id == '00') {
				$Message = 'Something went wrong';
				$row[] = '';
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
	function add_edit_recase_filling()
	{
		$req_type = "";
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		$row = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			if ($_POST['edit_after_verify_sts'] == 0) {

				$req_type = "add edit ";

				$id = $this->Legal_file_process_model->add_edit_recase_filling();
			} else {
				$req_type = "Edit after verify";
				$id = $this->Legal_file_process_model->add_edit_recase_filling_after_verify();
			}
		} else {
			$text[] = "Session out, login required";
		}
		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';
			if ($id == '00') {
				$Message = 'Something went wrong';
				$row[] = '';
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
		$var['req_type'] = $req_type;
		echo json_encode($var);
	}
	function cma_and_suit_details()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$str = '';
		$expense = array();


		if (isset($_POST['operation'])) {
			$operation = $this->input->post('operation');
		} else {
			$operation = "";
		}
		if ($this->input->post('cma_id') != "") {
			$details = $this->Cma_process_model->get_recommend_info($this->input->post('cma_id'));
			$guarantor_info = $this->Cma_process_model->get_guarantor_info('edit', $this->input->post('cma_id'));
			$suit_file_details = $this->Legal_file_process_model->get_suit_filling_details_by_cmaid_all($this->input->post('cma_id'));
		} else {
			$details = array();
			$suit_file_details = array();
		}

		$suit_file_details = $this->Legal_file_process_model->get_suit_file_details($this->input->post('id'));


		if (!empty($details)) {
			if ($details->proposed_type == 'Investment') {
				$no_tag = "Investment A/C";
				$guar_tag = "Borrower/Guarantor/Company Director/Owner";
				$nam_tag = "Investment A/C Name";
			} else {
				$no_tag = "Card";
				$guar_tag = "Borrower/Reference";
				$nam_tag = "Name on Card";
			}
			if ($details->spouse_name != '') {
				$spouse_name = $details->spouse_name;
			} else {
				$spouse_name = "N/A";
			}
			if ($details->mother_name != '') {
				$mother_name = $details->mother_name;
			} else {
				$mother_name = "N/A";
			}
			if ($details->call_up_file != '') {
				$call_up_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'legal_notice_file/call_up_file/' . $details->call_up_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$call_up_file = "";
			}

			if ($details->remarks_file != '') {
				$remarks_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/remarks_file/' . $details->remarks_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$remarks_file = "";
			}

			if ($details->final_ln != '') {
				$final_ln = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/ln_scan_copy/' . $details->final_ln . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$final_ln = "";
			}

			if ($details->uploaded_statement != '') {
				$statement_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/uploaded_statement/' . $details->uploaded_statement . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else if ($details->generated_statement != '') {
				$statement_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/generated_statement/' . $details->generated_statement . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$statement_file = "";
			}

			$str .= '<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
	    				<tr>
							<td width="50%" align="left"><strong>SL No.:</strong>' . $details->sl_no . '</td>
							<td width="50%" align="left"><strong>Proposed Type:</strong>' . $details->proposed_type . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Requisition Type:</strong>' . $details->req_type . '</td>
							<td width="50%" align="left"><strong>District:</strong>' . $details->district_name . '</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>' . $no_tag . 'No.:</strong> ' . $details->loan_ac . '</td>
							<td width="50%" align="left"><strong>More A/C No.:</strong>' . $details->more_acc_number . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>CID:</strong>' . $details->cif . '</td>
							<td width="50%" align="left"><strong>Investment Sanction Date:</strong>' . $details->loan_sanction_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Branch code:</strong>' . $details->branch_sol . '</td>
							<td width="50%" align="left"><strong>Status:</strong>' . $details->cma_sts . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>' . $nam_tag . ':</strong>' . $details->ac_name . '</td>
							<td width="50%" align="left"><strong>Initiate By:</strong>' . $details->e_by . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Borrower Name:</strong>' . $details->brrower_name . '</td>
							
							<td width="50%" align="left"><strong>Initiate Date Time:</strong>' . $details->e_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Investment Segment (Portfolio) :</strong>' . $details->loan_segment . '</td>
							<td width="50%" align="left"><strong>Call Up File:</strong>' . $call_up_file . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Chq Expiry Date:</strong>' . $details->chq_expiry_date . '</td>
							<td width="50%" align="left"><strong>Last Payment Date:</strong>' . $details->last_payment_date . '</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Current DPD:</strong>' . $details->current_dpd . 'DPD</td>
							<td width="50%" align="left"><strong>Zone:</strong>' . $details->zone_name . '</td>
						</tr>';

			$str .= '
						<tr>
							<td width="50%" align="left"><strong>File Deliver By:</strong>' . $details->deliver_by . '</td>
							<td width="50%" align="left"><strong>File Deliver Date Time:</strong>' . $details->deliver_dt . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Legal Ack By:</strong>' . $details->legal_ack_by . '</td>
							<td width="50%" align="left"><strong>Legal Ack Date Time:</strong>' . $details->legal_ack_dt . '</td>
						</tr>';
			if ($details->sts == 84) {
				$str .= '<tr>
								<td width="50%" align="left"><strong>File Reassign By:</strong>' . $details->reassign_by . '</td>
								<td width="50%" align="left"><strong>Reassigned Legal User:</strong>' . $details->reassigned_legal_user . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>File Reassign Date Time:</strong>' . $details->ln_val_dt . '</td>
								<td width="50%" align="left"><strong>File Reassign Reason:</strong>' . $details->reassign_reason . '</td>
							</tr>';
			}
			if ($details->uploaded_statement != '' || $details->generated_statement != '') {
				$str .= '<tr>
								<td width="50%" align="left"><strong>Statement File:</strong>' . $statement_file . '</td>
								<td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>' . $details->ln_sent_date . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>' . $details->ln_val_dt . '</td>
								<td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>' . $details->lawyer_legal . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Scan Copy (Legal):</strong>' . $final_ln . '</td>
								<td width="50%" align="left"></td>
							</tr>';
			}

			$str .= '</tbody>
					</table>';
		}
		if (!empty($guarantor_info)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">' . $guar_tag . '</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Type</td>
							<td width="10%" style="font-weight: bold;text-align:left">Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Father Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Present Address</td>
							<td width="10%" style="font-weight: bold;text-align:left">Permanent Address</td>
							<td width="10%" style="font-weight: bold;text-align:left">Business Address</td>
							<td width="10%" style="font-weight: bold;text-align:center">Status</td>
							<td width="10%" style="font-weight: bold;text-align:center">Occupation</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
			foreach ($guarantor_info as $key) {
				$str .= '<tr>';
				$str .= '<td align="center">' . $key->type_name . '</td>';
				$str .= '<td align="left">' . $key->guarantor_name . '</td>';
				$str .= '<td align="left">' . $key->father_name . '</td>';
				$str .= '<td align="left">' . $key->present_address . '</td>';
				$str .= '<td align="left">' . $key->permanent_address . '</td>';
				$str .= '<td align="left">' . $key->business_address . '</td>';
				$str .= '<td align="center">' . $key->guar_sts_name . '</td>';
				$str .= '<td align="center">' . $key->occ_sts_name . '</td>';
				$str .= '</tr>';
			}

			$str .= '</tbody>
					</table>
				</div>';
		}


		if (!empty($suit_file_details)) {
			if ($suit_file_details->arji_copy != '') {
				$arji_copy = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/arji_copy/' . $suit_file_details->arji_copy . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$arji_copy = "";
			}
			$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id, $suit_file_details->req_type);
			$str .= '<br/>';
			$str .= '<table style="width: 100%;" id="preview_table" class="suit_file">
            <thead>
            <tr>
                <td colspan="2" style="font-size:20px;font-weight:bold;text-align:center">Suit File Info</td>
            </tr>
            </thead>
            <tbody id="details_body" id="suit_file">
                <tr>
                    <td width="50%" align="left"><strong>Investment/Card No.:</strong>' . $suit_file_details->loan_ac . '</td>
                    <td width="50%" align="left"><strong>AC Name:</strong>' . $suit_file_details->ac_name . '</td>
                    

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>CID:</strong>' . $suit_file_details->cif . '</td>
                    <td width="50%" align="left"><strong>Zone:</strong>' . $suit_file_details->zone_name . '</td>
                    

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>District:</strong>' . $suit_file_details->district_name . '</td>
                    <td width="50%" align="left"><strong>Branch:</strong>' . $suit_file_details->branch_name . '</td>
                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Requisition Type:</strong>' . $suit_file_details->req_type . '</td>
                    <td width="50%" align="left"><strong>District:</strong>' . $suit_file_details->district_name . '</td>
                    

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Case Name:</strong>' . $suit_file_details->case_name . '</td>
                    <td width="50%" align="left"><strong>Case Number:</strong>' . $suit_file_details->case_number . '</td>
                    
                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Case Claim Amount:</strong>' . $suit_file_details->case_claim_amount . '</td>
                    <td width="50%" align="left"><strong>Previous Date:</strong>' . $suit_file_details->prev_date . '</td>
                    

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Case Status Previous Date:</strong>' . $suit_file_details->case_sts_prev_dt . '</td>
                    <td width="50%" align="left"><strong>Activities Previous Date:</strong>' . $suit_file_details->act_prev_date . '</td>
                    

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Next Date:</strong> ' . $suit_file_details->next_date . '</td>
                    <td width="50%" align="left"><strong>Case Status Next Date:</strong>' . $suit_file_details->case_sts_next_dt . '</td>

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Remarks Next Date:</strong>' . $suit_file_details->remarks_next_date . '</td>
                    <td width="50%" align="left"><strong>Filling Plaintiff:</strong>' . $suit_file_details->filling_plaintiff . '</td>

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Filling Date:</strong>' . $suit_file_details->filling_date . '</td>
                    <td width="50%" align="left"><strong>Suit File Entry Date:</strong>' . $suit_file_details->e_dt . '</td>

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Case Deal Officer:</strong>' . $suit_file_details->case_deal_officer . '</td>
                    <td width="50%" align="left"><strong>Previous Lawyer Name:</strong>' . $suit_file_details->prev_lawyer_name . '</td>

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Present Lawyer Name:</strong>' . $suit_file_details->prest_lawyer_name . '</td>
                    
                    <td width="50%" align="left"><strong>Previous Court Name:</strong>' . $suit_file_details->prev_court_name . '</td>

                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Present Court Name:</strong>' . $suit_file_details->prest_court_name . '</td>
                    <td width="50%" align="left"><strong>Suit File Entry By:</strong>' . $suit_file_details->e_by . '</td>
                </tr>
                <tr>
                    <td width="50%" align="left"><strong>Arji Copy:</strong>' . $arji_copy . '</td>
                    <td width="50%" align="left"><strong>Judge Name:</strong>' . $suit_file_details->judge_name . '</td>
                </tr>';
			$str .= '</tbody>
            </table>';
		}
		if (!empty($expense)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
            <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expense Info</span>
            <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
            <thead>
                <tr>
                    <td width="10%" style="font-weight: bold;text-align:center">Expense Type</td>
                    <td width="10%" style="font-weight: bold;text-align:left">Vendor Name</td>
                    <td width="10%" style="font-weight: bold;text-align:left">Activities Name</td>
                    <td width="10%" style="font-weight: bold;text-align:left">Activities Date</td>
                    <td width="10%" style="font-weight: bold;text-align:left">Amount</td>
                    <td width="10%" style="font-weight: bold;text-align:left">Remarks</td>
                </tr>
            </thead>
            <tbody id="guarantor_info">';
			foreach ($expense as $key) {


				$tmpColor = "";
				if ($key->amount_status != 0) {
					$tmpColor = "style='color:red;'";
				}


				$str .= '<tr>';
				$str .= '<td align="center">' . $key->expense_type_name . '</td>';
				$str .= '<td align="left">' . $key->vendor_name . '</td>';
				$str .= '<td align="left">' . $key->activities_name . '</td>';
				$str .= '<td align="left">' . $key->activities_date . '</td>';
				$str .= '<td align="left" ' . $tmpColor . ' >' . $key->amount . '</td>';
				$str .= '<td align="left">' . $key->remarks . '</td>';
				$str .= '</tr>';
			}

			$str .= '</tbody>
            </table>
        </div>';
		}








		if ($this->input->post('operation') == 'reassign') {
			$link_id = '227';
			$legal_user = $this->User_info_model->get_checker_data($link_id, '6', "zone=" . $details->zone . "");
		} else {
			$legal_user = array();
		}

		$var = array(
			"str" => $str,
			"csrf_token" => $csrf_token,
			"legal_user" => $legal_user
		);
		echo json_encode($var);
	}
	function details()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$str = '';
		$expense = array();
		$suit_file_details = array();
		if (isset($_POST['operation'])) {
			$operation = $this->input->post('operation');
		} else {
			$operation = "";
		}
		if ($this->input->post('cma_id') != "") {
			$details = $this->Cma_process_model->get_recommend_info($this->input->post('cma_id'));
			$guarantor_info = $this->Cma_process_model->get_guarantor_info('edit', $this->input->post('cma_id'));
		} else {
			$details = array();
		}
		$suit_file_details = $this->Legal_file_process_model->get_suit_file_details($this->input->post('id'));
		$package_info = $this->Legal_file_process_model->get_package_details($this->input->post('id'), $suit_file_details->req_type);
		if (!empty($details)) {
			if ($details->proposed_type == 'Investment') {
				$no_tag = "Investment A/C";
				$guar_tag = "Borrower/Guarantor/Company Director/Owner";
				$nam_tag = "Investment A/C Name";
			} else {
				$no_tag = "Card";
				$guar_tag = "Borrower/Reference";
				$nam_tag = "Name on Card";
			}
			if ($details->spouse_name != '') {
				$spouse_name = $details->spouse_name;
			} else {
				$spouse_name = "N/A";
			}
			if ($details->mother_name != '') {
				$mother_name = $details->mother_name;
			} else {
				$mother_name = "N/A";
			}
			if ($details->call_up_file != '') {
				$call_up_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'legal_notice_file/call_up_file/' . $details->call_up_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$call_up_file = "";
			}

			if ($details->remarks_file != '') {
				$remarks_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/remarks_file/' . $details->remarks_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$remarks_file = "";
			}

			if ($details->final_ln != '') {
				$final_ln = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/ln_scan_copy/' . $details->final_ln . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$final_ln = "";
			}

			if ($details->uploaded_statement != '') {
				$statement_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/uploaded_statement/' . $details->uploaded_statement . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else if ($details->generated_statement != '') {
				$statement_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/generated_statement/' . $details->generated_statement . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$statement_file = "";
			}

			$str .= '<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
	    				<tr>
							<td width="50%" align="left"><strong>SL No.:</strong>' . $details->sl_no . '</td>
							<td width="50%" align="left"><strong>Proposed Type:</strong>' . $details->proposed_type . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>' . $no_tag . 'No.:</strong> ' . $details->loan_ac . '</td>
							<td width="50%" align="left"><strong>More A/C No.:</strong>' . $details->more_acc_number . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>CID:</strong>' . $details->cif . '</td>
							<td width="50%" align="left"><strong>Investment Sanction Date:</strong>' . $details->loan_sanction_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Branch Code:</strong>' . $details->branch_sol . '</td>
							<td width="50%" align="left"><strong>Status:</strong>' . $details->cma_sts . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>' . $nam_tag . ':</strong>' . $details->ac_name . '</td>
							<td width="50%" align="left"><strong>Initiate By:</strong>' . $details->e_by . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Borrower Name:</strong>' . $details->brrower_name . '</td>
							
							<td width="50%" align="left"><strong>Initiate Date Time:</strong>' . $details->e_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Investment Segment (Portfolio) :</strong>' . $details->loan_segment . '</td>
							<td width="50%" align="left"><strong>Call Up File:</strong>' . $call_up_file . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Chq Expiry Date:</strong>' . $details->chq_expiry_date . '</td>
							<td width="50%" align="left"><strong>Last Payment Date:</strong>' . $details->last_payment_date . '</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Current DPD:</strong>' . $details->current_dpd . 'DPD</td>
							<td width="50%" align="left"><strong>Zone:</strong>' . $details->zone_name . '</td>
						</tr>';

			$str .= '
						<tr>
							<td width="50%" align="left"><strong>File Deliver By:</strong>' . $details->deliver_by . '</td>
							<td width="50%" align="left"><strong>File Deliver Date Time:</strong>' . $details->deliver_dt . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Legal Ack By:</strong>' . $details->legal_ack_by . '</td>
							<td width="50%" align="left"><strong>Legal Ack Date Time:</strong>' . $details->legal_ack_dt . '</td>
						</tr>';
			if ($details->sts == 84) {
				$str .= '<tr>
								<td width="50%" align="left"><strong>File Reassign By:</strong>' . $details->reassign_by . '</td>
								<td width="50%" align="left"><strong>Reassigned Legal User:</strong>' . $details->reassigned_legal_user . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>File Reassign Date Time:</strong>' . $details->ln_val_dt . '</td>
								<td width="50%" align="left"><strong>File Reassign Reason:</strong>' . $details->reassign_reason . '</td>
							</tr>';
			}
			if ($details->uploaded_statement != '' || $details->generated_statement != '') {
				$str .= '<tr>
								<td width="50%" align="left"><strong>Statement File:</strong>' . $statement_file . '</td>
								<td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>' . $details->ln_sent_date . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>' . $details->ln_val_dt . '</td>
								<td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>' . $details->lawyer_legal . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Scan Copy (Legal):</strong>' . $final_ln . '</td>
								<td width="50%" align="left"></td>
							</tr>';
			}

			$str .= '</tbody>
					</table>';
		}
		if (!empty($guarantor_info)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">' . $guar_tag . '</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Type</td>
							<td width="10%" style="font-weight: bold;text-align:left">Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Father Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Present Address</td>
							<td width="10%" style="font-weight: bold;text-align:left">Permanent Address</td>
							<td width="10%" style="font-weight: bold;text-align:left">Business Address</td>
							<td width="10%" style="font-weight: bold;text-align:center">Status</td>
							<td width="10%" style="font-weight: bold;text-align:center">Occupation</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
			foreach ($guarantor_info as $key) {
				$str .= '<tr>';
				$str .= '<td align="center">' . $key->type_name . '</td>';
				$str .= '<td align="left">' . $key->guarantor_name . '</td>';
				$str .= '<td align="left">' . $key->father_name . '</td>';
				$str .= '<td align="left">' . $key->present_address . '</td>';
				$str .= '<td align="left">' . $key->permanent_address . '</td>';
				$str .= '<td align="left">' . $key->business_address . '</td>';
				$str .= '<td align="center">' . $key->guar_sts_name . '</td>';
				$str .= '<td align="center">' . $key->occ_sts_name . '</td>';
				$str .= '</tr>';
			}

			$str .= '</tbody>
					</table>
				</div>';
		}
		if (!empty($suit_file_details)) {
			if ($suit_file_details->arji_copy != '') {
				$arji_copy = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/arji_copy/' . $suit_file_details->arji_copy . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$arji_copy = "";
			}
			$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id, $suit_file_details->req_type);
			$str .= '<br/>';
			$str .= '<table style="width: 100%;" id="preview_table" class="suit_file">
					<thead>
					<tr>
						<td colspan="2" style="font-size:20px;font-weight:bold;text-align:center">Suit File Info</td>
					</tr>
					</thead>
					<tbody id="details_body" id="suit_file">
						<tr>
							<td width="50%" align="left"><strong>Investment/Card No.:</strong>' . $suit_file_details->loan_ac . '</td>
							<td width="50%" align="left"><strong>AC Name:</strong>' . $suit_file_details->ac_name . '</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>CID:</strong>' . $suit_file_details->cif . '</td>
							<td width="50%" align="left"><strong>Zone:</strong>' . $suit_file_details->zone_name . '</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>District:</strong>' . $suit_file_details->district_name . '</td>
							<td width="50%" align="left"><strong>Branch:</strong>' . $suit_file_details->branch_name . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Requisition Type:</strong>' . $suit_file_details->req_type . '</td>
							<td width="50%" align="left"><strong>District:</strong>' . $suit_file_details->district_name . '</td>
							

						</tr>
	    				<tr>
							<td width="50%" align="left"><strong>Case Name:</strong>' . $suit_file_details->case_name . '</td>
							<td width="50%" align="left"><strong>Case Number:</strong>' . $suit_file_details->case_number . '</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Claim Amount:</strong>' . $suit_file_details->case_claim_amount . '</td>
							<td width="50%" align="left"><strong>Previous Date:</strong>' . $suit_file_details->prev_date . '</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Status Previous Date:</strong>' . $suit_file_details->case_sts_prev_dt . '</td>
							<td width="50%" align="left"><strong>Activities Previous Date:</strong>' . $suit_file_details->act_prev_date . '</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Next Date:</strong> ' . $suit_file_details->next_date . '</td>
							<td width="50%" align="left"><strong>Case Status Next Date:</strong>' . $suit_file_details->case_sts_next_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Remarks Next Date:</strong>' . $suit_file_details->remarks_next_date . '</td>
							<td width="50%" align="left"><strong>Filling Plaintiff:</strong>' . $suit_file_details->filling_plaintiff . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Filling Date:</strong>' . $suit_file_details->filling_date . '</td>
							<td width="50%" align="left"><strong>Suit File Entry Date:</strong>' . $suit_file_details->e_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Deal Officer:</strong>' . $suit_file_details->case_deal_officer . '</td>
							<td width="50%" align="left"><strong>Previous Lawyer Name:</strong>' . $suit_file_details->prev_lawyer_name . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Present Lawyer Name:</strong>' . $suit_file_details->prest_lawyer_name . '</td>
							
							<td width="50%" align="left"><strong>Previous Court Name:</strong>' . $suit_file_details->prev_court_name . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Present Court Name:</strong>' . $suit_file_details->prest_court_name . '</td>
							<td width="50%" align="left"><strong>Suit File Entry By:</strong>' . $suit_file_details->e_by . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Arji Copy:</strong>' . $arji_copy . '</td>
							<td width="50%" align="left"><strong>Judge Name:</strong>' . $suit_file_details->judge_name . '</td>
						</tr>';
			$str .= '</tbody>
					</table>';
		}
		if (!empty($expense)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expense Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Expense Type</td>
							<td width="10%" style="font-weight: bold;text-align:left">Vendor Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities Date</td>
							<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
							<td width="10%" style="font-weight: bold;text-align:left">Remarks</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
			foreach ($expense as $key) {


				$tmpColor = "";
				if ($key->amount_status != 0) {
					$tmpColor = "style='color:red;'";
				}


				$str .= '<tr>';
				$str .= '<td align="center">' . $key->expense_type_name . '</td>';
				$str .= '<td align="left">' . $key->vendor_name . '</td>';
				$str .= '<td align="left">' . $key->activities_name . '</td>';
				$str .= '<td align="left">' . $key->activities_date . '</td>';
				$str .= '<td align="left" ' . $tmpColor . ' >' . $key->amount . '</td>';
				$str .= '<td align="left">' . $key->remarks . '</td>';
				$str .= '</tr>';
			}

			$str .= '</tbody>
					</table>
				</div>';
		}
		if (!empty($package_info)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Package Bill Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Lawyer Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Investment AC</td>
							<td width="10%" style="font-weight: bold;text-align:left">Case Number</td>
							<td width="10%" style="font-weight: bold;text-align:left">Remaining Package Amount</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities</td>
							<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
			$str .= '<tr>';
			$str .= '<td align="center">' . $package_info->lawyer_name . '</td>';
			$str .= '<td align="left">' . $package_info->loan_ac . '</td>';
			$str .= '<td align="left">' . $package_info->case_number . '</td>';
			$str .= '<td align="left">' . number_format($package_info->package_amount - $package_info->disbursed_amount, 2) . '</td>';
			$str .= '<td align="left">' . $package_info->activities_name . '</td>';
			$str .= '<td align="left">' . $package_info->amount . '</td>';
			$str .= '</tr>';

			$str .= '</tbody>
					</table>
				</div>';
		}
		if ($this->input->post('operation') == 'reassign_file') {
			$link_id = '226';
			$legal_user = $this->User_info_model->get_checker_data($link_id, '2');
		} else {
			$legal_user = array();
		}

		$var = array(
			"str" => $str,
			"csrf_token" => $csrf_token,
			"legal_user" => $legal_user
		);
		echo json_encode($var);
	}
	function suit_file_details()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$str = '';
		$expense = array();
		$suit_file_details = $this->Legal_file_process_model->get_suit_file_details($this->input->post('id'));
		if (!empty($suit_file_details)) {
			$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id, $suit_file_details->req_type);
			if ($suit_file_details->proposed_type == 'Investment') {
				$no_tag = "Investment A/C";
				$guar_tag = "Borrower/Guarantor/Company Director/Owner";
				$nam_tag = "Investment A/C Name";
			} else {
				$no_tag = "Card";
				$guar_tag = "Borrower/Reference";
				$nam_tag = "Name on Card";
			}
			$str .= '<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
						
						<tr>
							<td width="50%" align="left"><strong>' . $nam_tag . ':</strong>' . $suit_file_details->ac_name . '</td>
							<td width="50%" align="left"><strong>' . $no_tag . 'No.:</strong> ' . $suit_file_details->loan_ac . '</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Number:</strong>' . $suit_file_details->case_number . '</td>
							<td width="50%" align="left"><strong>Suit File Entry By:</strong>' . $suit_file_details->e_by . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Claim Amount:</strong>' . $suit_file_details->case_claim_amount . '</td>
							<td width="50%" align="left"><strong>Previous Date:</strong>' . $suit_file_details->prev_date . '</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Status Previous Date:</strong>' . $suit_file_details->case_sts_prev_dt . '</td>
							<td width="50%" align="left"><strong>Activities Previous Date:</strong>' . $suit_file_details->act_prev_date . '</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Next Date:</strong> ' . $suit_file_details->next_date . '</td>
							<td width="50%" align="left"><strong>Case Status Next Date:</strong>' . $suit_file_details->case_sts_next_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Remarks Next Date:</strong>' . $suit_file_details->remarks_next_date . '</td>
							<td width="50%" align="left"><strong>Filling Plaintiff:</strong>' . $suit_file_details->filling_plaintiff . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Filling Date:</strong>' . $suit_file_details->filling_date . '</td>
							<td width="50%" align="left"><strong>Suit File Entry Date:</strong>' . $suit_file_details->e_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Deal Officer:</strong>' . $suit_file_details->case_deal_officer . '</td>
							<td width="50%" align="left"><strong>Present Lawyer Name:</strong>' . $suit_file_details->prest_lawyer_name . '</td>

						</tr>
						<tr>
							
							<td width="50%" align="left"><strong>Present Court Name:</strong>' . $suit_file_details->prest_court_name . '</td>
							<td width="50%" align="left"></td>
							
						</tr>';
			$str .= '</tbody>
					</table>';
		}
		if (!empty($expense)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expense Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Expense Type</td>
							<td width="10%" style="font-weight: bold;text-align:left">Vendor Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities Date</td>
							<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
							<td width="10%" style="font-weight: bold;text-align:left">Remarks</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
			foreach ($expense as $key) {
				$str .= '<tr>';
				$str .= '<td align="center">' . $key->expense_type_name . '</td>';
				$str .= '<td align="left">' . $key->vendor_name . '</td>';
				$str .= '<td align="left">' . $key->activities_name . '</td>';
				$str .= '<td align="left">' . $key->activities_date . '</td>';
				$str .= '<td align="left">' . $key->amount . '</td>';
				$str .= '<td align="left">' . $key->remarks . '</td>';
				$str .= '</tr>';
			}

			$str .= '</tbody>
					</table>
				</div>';
		}
		$var = array(
			"str" => $str,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function get_case_details_info()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$str = '';
		$expense = array();
		$suit_file_details = $this->Legal_file_process_model->get_case_details_info($this->input->post('id'));
		$expense = $this->Legal_file_process_model->get_all_expense_by_case($this->input->post('id'), $suit_file_details->req_type, $suit_file_details->cma_id);
		$status_history = $this->Legal_status_expense_model->get_case_status_history($this->input->post('id'));
		if (!empty($suit_file_details)) {
			$Message = 'ok';
			$str .= '<table style="width: 100%;">
				<thead></thead>
				<tbody id="details_body">
                        <tr>
                            <td width="50%">
                                <table style="width: 100%;">
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">AC No./Card No.</td>
                                        <td width="60%" >' . $suit_file_details->loan_ac . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Account Name</td>
                                        <td width="60%" >' . $suit_file_details->ac_name . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Type Of Case</td>
                                        <td width="60%" >' . $suit_file_details->case_type . '</td>
                                    </tr>
                                     <tr>
                                        <td width="40%" style="font-weight: bold;">Type Of Case Name</td>
                                        <td width="60%" >' . $suit_file_details->case_name . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Filling Date</td>
                                        <td width="60%" >' . $suit_file_details->filling_date . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Case Number</td>
                                        <td width="60%" >' . $suit_file_details->case_number . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Case Claim Amount</td>
                                        <td width="60%" >' . $suit_file_details->case_claim_amount . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Outstanding Amount</td>
                                        <td width="60%" >' . $suit_file_details->outstanding_bl . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Filling Plaintiff</td>
                                        <td width="60%" >' . $suit_file_details->filling_plaintiff . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Filling Plaintiff Pin</td>
                                        <td width="60%" >' . $suit_file_details->filling_plaintiff_pin . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Case Dealing Officer</td>
                                        <td width="60%" >' . $suit_file_details->case_deal_officer . '</td>
                                    </tr>     
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Case Dealing Officer Pin</td>
                                        <td width="60%" >' . $suit_file_details->case_deal_officer_pin . '</td>
                                    </tr>   
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Dealing Officer Cell No.</td>
                                        <td width="60%" >' . $suit_file_details->case_deal_officer_phone . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Lawyer\'s Name</td>
                                        <td width="60%" >' . $suit_file_details->lawyer_name . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Court Name</td>
                                        <td width="60%" >' . $suit_file_details->prev_court_name . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Present Court Name</td>
                                        <td width="60%" >' . $suit_file_details->prest_court_name . '</td>
                                    </tr>                
                                </table>
                            </td>

                            <td width="50%">
                                <table style="width: 100%;">
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Case Date</td>
                                        <td width="60%" >' . $suit_file_details->prev_date . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Case Status</td>
                                        <td width="60%" >' . $suit_file_details->case_sts_prev_dt . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Date Activities</td>
                                        <td width="60%" >' . $suit_file_details->act_prev_date . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Date Case Status Remarks</td>
                                        <td width="60%" >' . $suit_file_details->remarks_prev_date . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Next Date</td>
                                        <td width="60%" >' . $suit_file_details->next_date . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Next Case Status</td>
                                        <td width="60%" >' . $suit_file_details->next_date_case_sts . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Recovery AM</td>
                                        <td width="60%" >' . $suit_file_details->recovery_am . '</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">District</td>
                                        <td width="60%" >' . $suit_file_details->district_name . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Protfolio</td>
                                        <td width="60%" >' . $suit_file_details->loan_segment . '</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Account Closing Date</td>
                                        <td width="60%" >' . $suit_file_details->ac_close_dt . '</td>
                                    </tr>  
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Final Case Status</td>
                                        <td width="60%" >' . $suit_file_details->final_case_sts . '</td>
                                    </tr>  
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Remarks</td>
                                        <td width="60%" >' . $suit_file_details->final_remarks . '</td>
                                    </tr>     
                                </table>
                            </td>
                        </tr>
                    </tbody>';
			$str .= '</table>';

			if (!empty($status_history)) {
				$count = count($status_history);
				$height = $count > 4 ? 'height:250px' : '';
				$str .= '<br/><div>
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Case Status History</span>
					<div style="overflow-x:hidden;' . $height . '">
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Prev Case Status</td>
							<td width="10%" style="font-weight: bold;text-align:center">New Case Status</td>
							<td width="15%" style="font-weight: bold;text-align:center">Change By</td>
							<td width="15%" style="font-weight: bold;text-align:center">Change Date</td>
							<td width="15%" style="font-weight: bold;text-align:center">Next Case Date</td>
							<td width="15%" style="font-weight: bold;text-align:center">Next Date Purpose</td>
							<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
				foreach ($status_history as $key) {
					if ($key->back_case_status == 1) {
						$style_color = 'style="color:red;"';
					} else {
						$style_color = '';
					}
					$str .= '<tr>';
					$str .= '<td align="center">' . $key->prev_case_sts . '</td>';
					$str .= '<td align="center" ' . $style_color . '>' . $key->present_case_sts . '</td>';
					$str .= '<td align="center">' . $key->e_by . '</td>';
					$str .= '<td align="center">' . $key->e_dt . '</td>';
					$str .= '<td align="center">' . $key->next_case_dt . '</td>';
					$str .= '<td align="center">' . $key->next_dt_purpose . '</td>';
					$str .= '<td align="center">' . $key->remarks . '</td>';
					$str .= '</tr>';
				}

				$str .= '</tbody>
					</table>
					</div>
				</div>';
			}
			if (!empty($expense)) {
				$count = count($expense);
				$total = 0;
				$height = $count > 4 ? 'height:250px' : '';
				$str .= '<br/><div>
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expense Info</span>
					<div style="overflow-x:hidden;' . $height . '">
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Vendor Type</td>
							<td width="10%" style="font-weight: bold;text-align:left">Vendor Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities Date</td>
							<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
							<td width="10%" style="font-weight: bold;text-align:left">Remarks</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
				foreach ($expense as $key) {
					$total = $total + $key->amount;
					$str .= '<tr>';
					$str .= '<td align="center">' . $key->expense_type_name . '</td>';
					$str .= '<td align="left">' . $key->vendor_name . '</td>';
					$str .= '<td align="left">' . $key->activities_name . '</td>';
					$str .= '<td align="left">' . $key->activities_date . '</td>';
					$str .= '<td align="left">' . $key->amount . '</td>';
					$str .= '<td align="left">' . $key->expense_remarks . '</td>';
					$str .= '</tr>';
				}
				$str .= '<tr>';
				$str .= '<td align="center" colspan="4">Total</td>';
				$str .= '<td align="left">' . $total . '</td>';
				$str .= '<td align="center"></td>';
				$str .= '</tr>';
				$str .= '</tbody>
					</table>
					</div>
				</div>';
			}
		} else {

			$Message = 'No Data';
		}
		$var = array(
			"str" => $str,
			"Message" => $Message,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function recase_file_details()
	{


		$csrf_token = $this->security->get_csrf_hash();
		$str = '';
		$expense = array();
		$details = $this->Cma_process_model->get_recommend_info($this->input->post('cma_id'));
		$guarantor_info = $this->Cma_process_model->get_guarantor_info('edit', $this->input->post('cma_id'));
		$suit_file_details = $this->Legal_file_process_model->get_suit_file_details($this->input->post('id'));
		$package_info = $this->Legal_file_process_model->get_package_details($this->input->post('id'), $suit_file_details->req_type);
		if (!empty($details)) {
			if ($details->proposed_type == 'Investment') {
				$no_tag = "Investment A/C";
				$guar_tag = "Borrower/Guarantor/Company Director/Owner";
				$nam_tag = "Investment A/C Name";
			} else {
				$no_tag = "Card";
				$guar_tag = "Borrower/Reference";
				$nam_tag = "Name on Card";
			}
			if ($details->spouse_name != '') {
				$spouse_name = $details->spouse_name;
			} else {
				$spouse_name = "N/A";
			}
			if ($details->mother_name != '') {
				$mother_name = $details->mother_name;
			} else {
				$mother_name = "N/A";
			}
			if ($details->call_up_file != '') {
				$call_up_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'legal_notice_file/call_up_file/' . $details->call_up_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$call_up_file = "";
			}

			if ($details->remarks_file != '') {
				$remarks_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/remarks_file/' . $details->remarks_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$remarks_file = "";
			}

			if ($details->final_ln != '') {
				$final_ln = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/ln_scan_copy/' . $details->final_ln . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$final_ln = "";
			}

			if ($details->uploaded_statement != '') {
				$statement_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/uploaded_statement/' . $details->uploaded_statement . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else if ($details->generated_statement != '') {
				$statement_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/generated_statement/' . $details->generated_statement . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$statement_file = "";
			}

			$str .= '<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
	    				<tr>
							<td width="50%" align="left"><strong>SL No.:</strong>' . $details->sl_no . '</td>
							<td width="50%" align="left"><strong>Proposed Type:</strong>' . $details->proposed_type . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Requisition Type:</strong>' . $details->req_type . '</td>
							<td width="50%" align="left"><strong>District:</strong>' . $details->district_name . '</td>
							

						</tr>
							
							
						<tr>
							<td width="50%" align="left"><strong>' . $no_tag . 'No.:</strong> ' . $details->loan_ac . '</td>
							<td width="50%" align="left"><strong>More A/C No.:</strong>' . $details->more_acc_number . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>CID:</strong>' . $details->cif . '</td>
							<td width="50%" align="left"><strong>Investment Sanction Date:</strong>' . $details->loan_sanction_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Branch Code:</strong>' . $details->branch_sol . '</td>
							<td width="50%" align="left"><strong>Status:</strong>' . $details->cma_sts . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>' . $nam_tag . ':</strong>' . $details->ac_name . '</td>
							<td width="50%" align="left"><strong>Initiate By:</strong>' . $details->e_by . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Borrower Name:</strong>' . $details->brrower_name . '</td>
							
							<td width="50%" align="left"><strong>Initiate Date Time:</strong>' . $details->e_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Investment Segment (Portfolio) :</strong>' . $details->loan_segment . '</td>
							<td width="50%" align="left"><strong>Call Up File:</strong>' . $call_up_file . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Chq Expiry Date:</strong>' . $details->chq_expiry_date . '</td>
							<td width="50%" align="left"><strong>Last Payment Date:</strong>' . $details->last_payment_date . '</td>
							
						</tr>';

			$str .= '
						<tr>
							<td width="50%" align="left"><strong>File Deliver By:</strong>' . $details->deliver_by . '</td>
							<td width="50%" align="left"><strong>File Deliver Date Time:</strong>' . $details->deliver_dt . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Legal Ack By:</strong>' . $details->legal_ack_by . '</td>
							<td width="50%" align="left"><strong>Legal Ack Date Time:</strong>' . $details->legal_ack_dt . '</td>
						</tr>';
			if ($details->sts == 84) {
				$str .= '<tr>
								<td width="50%" align="left"><strong>File Reassign By:</strong>' . $details->reassign_by . '</td>
								<td width="50%" align="left"><strong>Reassigned Legal User:</strong>' . $details->reassigned_legal_user . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>File Reassign Date Time:</strong>' . $details->ln_val_dt . '</td>
								<td width="50%" align="left"><strong>File Reassign Reason:</strong>' . $details->reassign_reason . '</td>
							</tr>';
			}
			if ($details->uploaded_statement != '' || $details->generated_statement != '') {
				$str .= '<tr>
								<td width="50%" align="left"><strong>Statement File:</strong>' . $statement_file . '</td>
								<td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>' . $details->ln_sent_date . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>' . $details->ln_val_dt . '</td>
								<td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>' . $details->lawyer_legal . '</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Scan Copy (Legal):</strong>' . $final_ln . '</td>
								<td width="50%" align="left"></td>
							</tr>';
			}

			$str .= '</tbody>
					</table>';
		}
		if (!empty($guarantor_info)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">' . $guar_tag . '</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Type</td>
							<td width="10%" style="font-weight: bold;text-align:left">Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Father Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Present Address</td>
							<td width="10%" style="font-weight: bold;text-align:left">Permanent Address</td>
							<td width="10%" style="font-weight: bold;text-align:left">Business Address</td>
							<td width="10%" style="font-weight: bold;text-align:center">Status</td>
							<td width="10%" style="font-weight: bold;text-align:center">Occupation</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
			foreach ($guarantor_info as $key) {
				$str .= '<tr>';
				$str .= '<td align="center">' . $key->type_name . '</td>';
				$str .= '<td align="left">' . $key->guarantor_name . '</td>';
				$str .= '<td align="left">' . $key->father_name . '</td>';
				$str .= '<td align="left">' . $key->present_address . '</td>';
				$str .= '<td align="left">' . $key->permanent_address . '</td>';
				$str .= '<td align="left">' . $key->business_address . '</td>';
				$str .= '<td align="center">' . $key->guar_sts_name . '</td>';
				$str .= '<td align="center">' . $key->occ_sts_name . '</td>';
				$str .= '</tr>';
			}

			$str .= '</tbody>
					</table>
				</div>';
		}
		if (!empty($suit_file_details)) {
			$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id, $suit_file_details->req_type);
			if ($suit_file_details->proposed_type == 'Investment') {
				$no_tag = "Investment A/C";
				$guar_tag = "Borrower/Guarantor/Company Director/Owner";
				$nam_tag = "Investment A/C Name";
			} else {
				$no_tag = "Card";
				$guar_tag = "Borrower/Reference";
				$nam_tag = "Name on Card";
			}
			if ($suit_file_details->merge_case_sts == 1) {
				$merge_sts = 'Yes';
				$merge_style = 'style="color:red"';
			} else {
				$merge_sts = 'No';
				$merge_style = '';
			}
			if ($suit_file_details->both_case_sts == 0) {
				$running_sts = 'No';
				$run_style = 'style="color:red"';
			} else {
				$running_sts = 'Yes';
				$run_style = '';
			}
			$str .= '<table style="width: 100%;" id="preview_table">
				<thead>
					<tr>
						<td colspan="2" style="font-size:20px;font-weight:bold;text-align:center">Suit File Info</td>
					</tr>
					</thead>
				<tbody id="details_body">
					
					<tr>
						<td width="50%" align="left"><strong>' . $nam_tag . ':</strong>' . $suit_file_details->ac_name . '</td>
						<td width="50%" align="left"><strong>' . $no_tag . 'No.:</strong> ' . $suit_file_details->loan_ac . '</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Case Name:</strong>' . $suit_file_details->case_name . '</td>
						<td width="50%" align="left"><strong>Case Number:</strong>' . $suit_file_details->case_number . '</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Prev Date:</strong> ' . $suit_file_details->prev_date . '</td>
						<td width="50%" align="left"><strong>Prev Case Sts:</strong>' . $suit_file_details->case_sts_prev_dt . '</td>

					</tr>
					<tr>
						<td width="50%" align="left"><strong>Next Date:</strong> ' . $suit_file_details->next_date . '</td>
						<td width="50%" align="left"><strong>Next Case Status:</strong>' . $suit_file_details->case_sts_next_dt . '</td>

					</tr>
					<tr>
						<td width="50%" align="left"><strong>Remarks:</strong>' . $suit_file_details->remarks_next_date . '</td>
						<td width="50%" align="left"><strong>Filling Plaintiff:</strong>' . $suit_file_details->filling_plaintiff . '</td>

					</tr>
					<tr>
						<td width="50%" align="left"><strong>Filling Date:</strong>' . $suit_file_details->filling_date . '</td>
						<td width="50%" align="left"><strong>Suit File Entry Date:</strong>' . $suit_file_details->e_dt . '</td>

					</tr>
					<tr>
						<td width="50%" align="left" ' . $run_style . '><strong>Both Case Running:</strong>' . $running_sts . '</td>
						<td width="50%" align="left" ' . $merge_style . '><strong>Merge With Previous Case:</strong>' . $merge_sts . '</td>

					</tr>
					<tr>
						<td width="50%" align="left"><strong>Present Lawyer Name:</strong>' . $suit_file_details->prest_lawyer_name . '</td>
						<td width="50%" align="left"><strong>Present Court Name:</strong>' . $suit_file_details->prest_court_name . '</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Case Claim Amount:</strong>' . $suit_file_details->case_claim_amount . '</td>
						<td width="50%" align="left"><strong>Suit File Entry By:</strong>' . $suit_file_details->e_by . '</td>
					</tr>';
			$str .= '</tbody>
				</table>';
		}
		if (!empty($expense)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Expense Type</td>
						<td width="10%" style="font-weight: bold;text-align:left">Vendor Name</td>
						<td width="10%" style="font-weight: bold;text-align:left">Activities Name</td>
						<td width="10%" style="font-weight: bold;text-align:left">Activities Date</td>
						<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
						<td width="10%" style="font-weight: bold;text-align:left">Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
			foreach ($expense as $key) {

				$tmpColor = "";
				if ($key->amount_status != 0) {
					$tmpColor = "style='color:red;'";
				}

				$str .= '<tr>';
				$str .= '<td align="center">' . $key->expense_type_name . '</td>';
				$str .= '<td align="left">' . $key->vendor_name . '</td>';
				$str .= '<td align="left">' . $key->activities_name . '</td>';
				$str .= '<td align="left">' . $key->activities_date . '</td>';
				$str .= '<td align="left" ' . $tmpColor . '>' . $key->amount . '</td>';
				$str .= '<td align="left">' . $key->remarks . '</td>';
				$str .= '</tr>';
			}

			$str .= '</tbody>
				</table>
			</div>';
		}
		if (!empty($package_info)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Package Bill Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Lawyer Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Investment AC</td>
							<td width="10%" style="font-weight: bold;text-align:left">Case Number</td>
							<td width="10%" style="font-weight: bold;text-align:left">Remaining Package Amount</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities</td>
							<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
			$str .= '<tr>';
			$str .= '<td align="center">' . $package_info->lawyer_name . '</td>';
			$str .= '<td align="left">' . $package_info->loan_ac . '</td>';
			$str .= '<td align="left">' . $package_info->case_number . '</td>';
			$str .= '<td align="left">' . number_format($package_info->package_amount - $package_info->disbursed_amount, 2) . '</td>';
			$str .= '<td align="left">' . $package_info->activities_name . '</td>';
			$str .= '<td align="left">' . $package_info->amount . '</td>';
			$str .= '</tr>';

			$str .= '</tbody>
					</table>
				</div>';
		}
		if ($this->input->post('operation') == 'reassign_file') {
			$link_id = '226';
			$legal_user = $this->User_info_model->get_checker_data($link_id, '2');
		} else {
			$legal_user = array();
		}
		$var = array(
			"str" => $str,
			"legal_user" => $legal_user,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function bulk_operation_recase($operation = NULL)
	{
		$operation_name = '';
		if ($operation == 'confirm') {
			$operation_name = 'Bulk Confirm';
		}
		$data = array(
			'zone' => $this->User_model->get_parameter_data('ref_zone', 'name', 'data_status = 1'),
			'branch' => $this->User_model->get_parameter_data('ref_branch_sol', 'name', 'data_status = 1'),
			'operation' => $operation,
			'operation_name' => $operation_name,
			'pages' => 'legal_file_process/pages/bulk_operation_recase',
		);
		$this->load->view('legal_file_process/form_layout', $data);
	}
	function bulk_operation($operation = NULL)
	{
		$operation_name = '';
		if ($operation == 'blk_lawyer') {
			$operation_name = 'File Assign To Lawyer';
		}
		if ($operation == 'blk_rf') {
			$operation_name = 'Reasign File';
		}
		if ($operation == 'blk_ack') {
			$operation_name = 'Acknowledgement File';
		}
		if ($operation == 'blk_rf_approve') {
			$operation_name = 'Reassign File Approval';
		}
		$zone = $this->user_model->get_parameter_data('ref_zone', 'name', "data_status = '1'");
		$district = array();
		$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment', 'name', "data_status = '1'");
		$req_type = $this->user_model->get_parameter_data('ref_req_type', 'name', "data_status = '1'");
		$data = array(
			'zone' => $zone,
			'district' => $district,
			'loan_segment' => $loan_segment,
			'req_type' => $req_type,
			'operation' => $operation,
			'branch' => $this->User_model->get_parameter_data('ref_branch_sol', 'name', 'data_status = 1'),
			'bank' => $this->User_model->get_parameter_data('ref_bank', 'name', 'data_status = 1'),
			'lawyer' => $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1'),
			'operation_name' => $operation_name,
			'pages' => 'legal_file_process/pages/bulk_operation',
		);
		$this->load->view('legal_file_process/form_layout', $data);
	}
	function bulk_operation_suit_file($operation = NULL)
	{
		$operation_name = '';
		if ($operation == 'blk_rf_main' || $operation == 'blk_rf_recase') {
			$operation_name = 'Reasign File';
		}
		if ($operation == 'blk_rf_approve_main' || $operation == 'blk_rf_approve_recase') {
			$operation_name = 'Reasign File Approve';
		}
		$req_type = $this->user_model->get_parameter_data('ref_req_type', 'name', "data_status = '1'");
		$data = array(
			'branch' => $this->User_model->get_parameter_data('ref_branch_sol', 'name', 'data_status = 1'),
			'zone' => $this->user_model->get_parameter_data('ref_zone', 'id', 'data_status = 1'),
			'operation' => $operation,
			'operation_name' => $operation_name,
			'pages' => 'legal_file_process/pages/bulk_operation_file',
		);
		$this->load->view('legal_file_process/form_layout', $data);
	}
	function bulk_acktion()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Legal_file_process_model->bulk_acktion();
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
			} else if (isset($_POST['typebulk'])) {
				$row[] = '';
			} else {
				$row[] = '';
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
	function bulk_acktion_recase()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Legal_file_process_model->bulk_acktion_recase();
		} else {
			$text[] = "Session out, login required";
		}
		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';
			if ($id == 'taken') {
				$Message = 'Action Already Taken Plz Refresh';
				$row[] = '';
			} else if ($id == 'limitcrossed') {
				$Message = 'Sorry! Package Bill Limit Crossed Please Try Again.';
				$row[] = '';
			} else if ($id == 0) {
				$Message = 'Something went wrong';
				$row[] = '';
			} else if (isset($_POST['typebulk'])) {
				$row[] = '';
			} else {
				$row[] = '';
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
	function bulk_acktion_file()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Legal_file_process_model->bulk_acktion_file();
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
			} else if (isset($_POST['typebulk'])) {
				$row[] = '';
			} else {
				$row[] = '';
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
	function load_bulk_data()
	{
		$this->load->helper('form');
		$csrf_token = $this->security->get_csrf_hash();
		$grid_data = $this->Legal_file_process_model->get_bulk_data();
		$operation = $this->input->post('operation');

		$str = '';
		$counter = 0;
		if ($operation == 'blk_lawyer') {
			$str .= '<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="5%" style="font-weight: bold;text-align:left">Serial</th>
					<th width="10%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Investment A/C or Card No</th>
					<th width="15%" style="font-weight: bold;text-align:left">A/C Name</th>
					<th width="10%" style="font-weight: bold;text-align:left">Court Fee</th>
					<th width="10%" style="font-weight: bold;text-align:left">Procurement</th>
					<th width="10%" style="font-weight: bold;text-align:left">Branch</th>
					<th width="10%" style="font-weight: bold;text-align:left">Bank</th>
					<th width="10%" style="font-weight: bold;text-align:left">Dishonore Dt</th>
					<th width="10%" style="font-weight: bold;text-align:left">Chq Number</th>
					<th width="10%" style="font-weight: bold;text-align:left">Chq Amount</th>
				</thead>
				<tbody>';
		} else {
			$str .= '<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="5%" style="font-weight: bold;text-align:left">Serial</th>
					<th width="10%" style="font-weight: bold;text-align:left">Protfolio</th>
					<th width="10%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Investment A/C or Card No</th>
					<th width="15%" style="font-weight: bold;text-align:left">A/C Name</th>
					<th width="10%" style="font-weight: bold;text-align:left">Zone</th>
					<th width="10%" style="font-weight: bold;text-align:left">District</th>
					<th width="10%" style="font-weight: bold;text-align:left">Rec By</th>
					<th width="10%" style="font-weight: bold;text-align:left">Rec Date Time</th>
				</thead>
				<tbody>';
		}


		if (count($grid_data) <= 0) {
			$str .= '<tr><td colspan="11" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str .= '<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str .= '</tbody></table></div>';
		} else {
			$i = 1;
			foreach ($grid_data as $data) {
				if ($operation == 'blk_lawyer') {
					$counter++;
					if ($data->req_type == 2) //Court Fee Calculation only for ARA
					{
						$pre_court_fee_data = $this->db->query("SELECT c.*
						FROM cost_details as c 
						WHERE c.vendor_type=4 AND c.main_table_name='cma' AND c.main_table_id='" . $data->id . "' ORDER BY c.id DESC LIMIT 1")->row();
						$pre_set_data = $this->User_info_model->upr_config_row();
						$procurement = $pre_set_data->procurement;
						$fixed_court_fee = $pre_set_data->fixed_court_fee;

						//Court Fee Calculation
						$court_fee_25 = (($data->st_belance / 100) * 2.5);
						$court_fee_15 = (($court_fee_25 / 100) * 15);
						$actual_cost = ($court_fee_25 + $court_fee_15);
						if ($actual_cost > $fixed_court_fee) {
							$actual_cost = $fixed_court_fee;
						}
						$court_fee = ($actual_cost + $procurement);
					}
					$str .= '<tr>';
					$str .= '<td align="center"><input type="checkbox" name="chkBoxSelect' . $i . '" id="chkBoxSelect' . $i . '" onClick="CheckChanged_2(this,\'' . $i . '\')" value="chk"/><input type="hidden" name="event_delete_' . $i . '" id="event_delete_' . $i . '" value="1"><input type="hidden" name="hidden_req_type_' . $i . '" id="hidden_req_type_' . $i . '" value="' . $data->req_type . '"><input type="hidden" name="event_id_' . $i . '" id="event_id_' . $i . '" value="' . $data->id . '"><input type="hidden" name="pre_legal_user_' . $i . '" id="pre_legal_user_' . $i . '" value="' . $data->legal_user . '"></td>';
					$str .= '<td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $data->id . ',\'details\')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>';
					$str .= '<td align="left">' . $data->sl_no . '</td>';
					$str .= '<td align="left">' . $data->requisition_name . '</td>';
					$str .= '<td align="left">' . $data->loan_ac . '</td>';
					$str .= '<td align="left">' . $data->ac_name . '</td>';
					if ($data->req_type == 2) {
						if (empty($pre_court_fee_data) || ($pre_court_fee_data->bill_id != '' && $pre_court_fee_data->bill_id != 0 && $pre_court_fee_data->bill_id != NULL)) {
							$str .= '<td align="left"><input name="new_court_fee_sts_' . $i . '" id="new_court_fee_sts_' . $i . '" value="1" type="hidden"><input style="float:left;width:100px" name="court_fee_amount_' . $i . '" type="text" id="court_fee_amount_' . $i . '" value="' . $court_fee . '" onkeypress="return numbersonly(event)" class="text-input-big" /></td>';
							$str .= '<td align="left"><input style="float:left;width:100px" name="procument_cost_' . $i . '" type="text" id="procument_cost_' . $i . '" value="' . $procurement . '" class="text-input-big" onkeypress="return numbersonly(event)" onKeyUp="javascript:return add_procurment(this.value,' . $court_fee . ',' . $procurement . ',' . $i . ');"/></td>';
						} else {
							$str .= '<td align="left" colspan="2"><input name="new_court_fee_sts_' . $i . '" id="new_court_fee_sts_' . $i . '" value="0" type="hidden"><input name="court_fee_id_' . $i . '" id="court_fee_id_' . $i . '" value="' . $pre_court_fee_data->id . '" type="hidden"><span style="float:left"><strong>Court Fee already Added It will be Replace by New lawyer!</strong></span><input style="float:left;width:100px" name="court_fee_amount_' . $i . '" type="hidden" id="court_fee_amount_' . $i . '" value="0" onkeypress="return numbersonly(event)" class="text-input-big" /></td>';
						}
						$str .= '<td align="left"></td>';
						$str .= '<td align="left"></td>';
						$str .= '<td align="left"></td>';
						$str .= '<td align="left"></td>';
						$str .= '<td align="left"></td>';
					} else {
						$str .= '<td align="left" colspan="2"><input name="new_court_fee_sts_' . $i . '" id="new_court_fee_sts_' . $i . '" value="0" type="hidden"><input name="court_fee_id_' . $i . '" id="court_fee_id_' . $i . '" value="0" type="hidden"><span style="float:left"><strong>No Court Fee For this type of case</strong></span><input style="float:left;width:100px" name="court_fee_amount_' . $i . '" type="hidden" id="court_fee_amount_' . $i . '" value="0" onkeypress="return numbersonly(event)" class="text-input-big" /></td>';
						$str .= '<td align="left"><div style="float:left" id="branch_' . $i . '" name="branch_' . $i . '" style="padding-left: 3px"></div></td>';
						$str .= '<td align="left"><div style="float:left" id="bank_' . $i . '" name="bank_' . $i . '" style="padding-left: 3px"></div></td>';
						$str .= '<td align="left"><input type="text" name="dishonor_dt_' . $i . '" placeholder="dd/mm/yyyy" style="width:100px;float:left" id="dishonor_dt_' . $i . '" value="" ></td>';
						$str .= '<td align="left"><input type="text" name="chq_number_' . $i . '" placeholder="" style="width:100px;float:left" id="chq_number_' . $i . '" value="" ></td>';
						$str .= '<td align="left"><input type="text" name="chq_amount_' . $i . '" placeholder="" style="width:100px;float:left" id="chq_amount_' . $i . '" value="" ></td>';
					}
					$str .= '</tr>';
				} else {
					$str .= '<tr>';
					$str .= '<td align="center"><input type="checkbox" name="chkBoxSelect' . $i . '" id="chkBoxSelect' . $i . '" onClick="CheckChanged_2(this,\'' . $i . '\')" value="chk"/><input type="hidden" name="event_delete_' . $i . '" id="event_delete_' . $i . '" value="1"><input type="hidden" name="event_id_' . $i . '" id="event_id_' . $i . '" value="' . $data->id . '"><input type="hidden" name="pre_legal_user_' . $i . '" id="pre_legal_user_' . $i . '" value="' . $data->legal_user . '"></td>';
					$str .= '<td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $data->id . ',\'details\')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>';
					$str .= '<td align="left">' . $data->sl_no . '</td>';
					$str .= '<td align="left">' . $data->loan_segment . '</td>';
					$str .= '<td align="left">' . $data->requisition_name . '</td>';
					$str .= '<td align="left">' . $data->loan_ac . '</td>';
					$str .= '<td align="left">' . $data->ac_name . '</td>';
					$str .= '<td align="left">' . $data->zone_name . '</td>';
					$str .= '<td align="left">' . $data->district_name . '</td>';
					$str .= '<td align="left">' . $data->rec_by . '</td>';
					$str .= '<td align="left">' . $data->rec_dt . '</td>';
					$str .= '</tr>';
				}

				$i++;
			}
			$str .= '<input type="hidden" name="event_counter" id="event_counter" value="' . ($i - 1) . '">';
			$str .= '</tbody></table></div>';
			$str .= '<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			$str .= '<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="12">Total Selected : <span id="selected_value">0</span></td></tr>';
			$str .= '</tbody></table>';
		}
		$var = array(
			"counter" => $counter,
			"str" => $str,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function load_bulk_data_file()
	{
		$this->load->helper('form');
		$csrf_token = $this->security->get_csrf_hash();
		$grid_data = array();
		$operation = $this->input->post('operation_name');
		if ($operation == 'blk_rf_main' || $operation == 'blk_rf_recase') {
			$grid_data = $this->Legal_file_process_model->load_bulk_data_file($operation);
		}
		if ($operation == 'blk_rf_approve_main' || $operation == 'blk_rf_approve_recase') {
			$grid_data = $this->Legal_file_process_model->load_bulk_data_file($operation);
		}
		$str = '';
		$str .= '<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="10%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Investment A/C or Card No</th>
					<th width="10%" style="font-weight: bold;text-align:left">Protfolio</th>
					<th width="10%" style="font-weight: bold;text-align:left">Case Number</th>
					<th width="10%" style="font-weight: bold;text-align:left">Zone</th>
					<th width="10%" style="font-weight: bold;text-align:left">District</th>
					<th width="10%" style="font-weight: bold;text-align:left">Branch</th>
					<th width="10%" style="font-weight: bold;text-align:left">Entry By</th>
					<th width="10%" style="font-weight: bold;text-align:left">Entry Date Time</th>
				</thead>
				<tbody>';


		if (count($grid_data) <= 0) {
			$str .= '<tr><td colspan="11" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str .= '<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str .= '</tbody></table></div>';
		} else {
			$i = 1;
			foreach ($grid_data as $data) {
				$str .= '<tr>';
				$str .= '<td align="center"><input type="checkbox" name="chkBoxSelect' . $i . '" id="chkBoxSelect' . $i . '" onClick="CheckChanged_2(this,\'' . $i . '\')" value="chk"/><input type="hidden" name="event_delete_' . $i . '" id="event_delete_' . $i . '" value="1"><input type="hidden" name="id_' . $i . '" id="id_' . $i . '" value="' . $data->id . '"></td>';
				$str .= '<td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $data->id . ',\'details\')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>';
				$str .= '<td align="left">' . $data->request_type_name . '</td>';
				$str .= '<td align="left">' . $data->loan_ac . '</td>';
				$str .= '<td align="left">' . $data->loan_segment . '</td>';
				$str .= '<td align="left">' . $data->case_number . '</td>';
				$str .= '<td align="left">' . $data->zone_name . '</td>';
				$str .= '<td align="left">' . $data->district_name . '</td>';
				$str .= '<td align="left">' . $data->branch_name . '</td>';
				$str .= '<td align="left">' . $data->e_by . '</td>';
				$str .= '<td align="left">' . $data->e_dt . '</td>';
				$str .= '</tr>';
				$i++;
			}
			$str .= '<input type="hidden" name="event_counter" id="event_counter" value="' . ($i - 1) . '">';
			$str .= '</tbody></table></div>';
			$str .= '<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			$str .= '<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="12">Total Selected : <span id="selected_value">0</span></td></tr>';
			$str .= '</tbody></table>';
		}
		$var = array(
			"str" => $str,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function load_bulk_data_recase()
	{
		$this->load->helper('form');
		$csrf_token = $this->security->get_csrf_hash();
		$grid_data = $this->Legal_file_process_model->get_bulk_data_recase();
		$operation = $this->input->post('operation');

		$str = '';
		$counter = 0;
		$str .= '<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="5%" style="font-weight: bold;text-align:left">Status</th>
					<th width="10%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Investment A/C or Card No</th>
					<th width="10%" style="font-weight: bold;text-align:left">Protfolio</th>
					<th width="10%" style="font-weight: bold;text-align:left">Case Number</th>
					<th width="10%" style="font-weight: bold;text-align:left">Zone</th>
					<th width="10%" style="font-weight: bold;text-align:left">District</th>
					<th width="10%" style="font-weight: bold;text-align:left">Entry By</th>
					<th width="10%" style="font-weight: bold;text-align:left">Entry Date Time</th>
				</thead>
				<tbody>';


		if (count($grid_data) <= 0) {
			$str .= '<tr><td colspan="12" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str .= '<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str .= '</tbody></table></div>';
		} else {
			$i = 1;
			foreach ($grid_data as $data) {
				$str .= '<tr>';
				$str .= '<td align="center"><input type="checkbox" name="chkBoxSelect' . $i . '" id="chkBoxSelect' . $i . '" onClick="CheckChanged_2(this,\'' . $i . '\')" value="chk"/><input type="hidden" name="event_delete_' . $i . '" id="event_delete_' . $i . '" value="1"><input type="hidden" name="id_' . $i . '" id="id_' . $i . '" value="' . $data->id . '"></td>';
				$str .= '<td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $data->id . ',\'details\')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>';
				$str .= '<td align="left">' . $data->status . '</td>';
				$str .= '<td align="left">' . $data->request_type_name . '</td>';
				$str .= '<td align="left">' . $data->loan_ac . '</td>';
				$str .= '<td align="left">' . $data->loan_segment . '</td>';
				$str .= '<td align="left">' . $data->case_number . '</td>';
				$str .= '<td align="left">' . $data->zone_name . '</td>';
				$str .= '<td align="left">' . $data->district_name . '</td>';
				$str .= '<td align="left">' . $data->e_by . '</td>';
				$str .= '<td align="left">' . $data->e_dt . '</td>';
				$str .= '</tr>';
				$i++;
			}
			$str .= '<input type="hidden" name="event_counter" id="event_counter" value="' . ($i - 1) . '">';
			$str .= '</tbody></table></div>';
			$str .= '<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			$str .= '<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="12">Total Selected : <span id="selected_value">0</span></td></tr>';
			$str .= '</tbody></table>';
		}
		$var = array(
			"counter" => $counter,
			"str" => $str,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function get_lawyer_email_phone()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$row = $this->Legal_file_process_model->get_lawyer_email_phone($this->input->post('id'));
		$var['csrf_token'] = $csrf_token;
		$var['row_info'] = $row;
		echo json_encode($var);
	}
	function calculate_court_fee()
	{
		$court_fee = 0;
		$case_claim_amount = $_POST['case_claim_amount'];
		$pre_set_data = $this->User_info_model->upr_config_row();
		$procurement = $pre_set_data->procurement;
		$fixed_court_fee = $pre_set_data->fixed_court_fee;

		//Court Fee Calculation
		$court_fee_25 = (($case_claim_amount / 100) * 2.5);
		$court_fee_15 = (($court_fee_25 / 100) * 15);
		$actual_cost = ($court_fee_25 + $court_fee_15);
		if ($actual_cost > $fixed_court_fee) {
			$actual_cost = $fixed_court_fee;
		}
		$court_fee = ($actual_cost + $procurement);

		$csrf_token = $this->security->get_csrf_hash();
		$var['csrf_token'] = $csrf_token;
		$var['court_fee'] = number_format($court_fee, 2, '.', '');
		echo json_encode($var);
	}
	function get_add_input_data()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$row = $this->Legal_file_process_model->get_total_address($this->input->post('id'));
		$result = $this->Cma_process_model->get_add_action_data($this->input->post('id'));
		//Generating Legal Notice cost
		$district_array = array(1, 2, 3, 4, 70, 71, 76);
		if (in_array($result->case_fill_dist, $district_array)) //Checking district is in dhaka
		{
			$field_name = "amount_in_dhaka";
		} else {
			$field_name = "amount_out_dhaka";
		}
		if ($result->req_type == 2) {
			$ln_cost = $this->Cma_process_model->get_ln_cost_amount('ref_schedule_charges_ara', $field_name, 1);
		} else {
			$ln_cost = $this->Cma_process_model->get_ln_cost_amount('ref_schedule_charges_ni', $field_name, 1);
		}
		$single_ln_cost = $ln_cost->amount;
		$lawyer_info = $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1');
		$var['csrf_token'] = $csrf_token;
		$var['single_ln_cost'] = $single_ln_cost;
		$var['total_address'] = $row->total;
		$var['result'] = $result;
		$var['lawyer_info'] = $lawyer_info;
		echo json_encode($var);
	}
	function r_history()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$sah = $this->Legal_file_process_model->get_r_history($this->input->post('id'), $this->input->post('life_cycle'));
		$jTableResult = array();
		$jTableResult['csrf_token'] = $csrf_token;
		if ($sah != null) {
			$jTableResult['status'] = "success";
			$jTableResult['row_info'] = $sah;
		} else {
			$jTableResult['status'] = "";
			$jTableResult['row_info'] = array();
		}
		$jTableResult['csrf_token'] = $csrf_token;
		// $jTableResult['sql'] = $id;
		echo json_encode($jTableResult);
	}




	// get_case_claim_amount

	function get_case_claim_amount()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$amount = $this->input->post('case_claim_amount');


		if ($amount > 0 && $amount <= 50000) {
			$percentage = 8;
			$fixed_val = ($percentage / 100) * $amount;
			if ($fixed_val < 2000) {
				$fixed_val = 2000;
			} else {
				$fixed_val = ($percentage / 100) * $amount;
			}
		} else if ($amount > 50000 && $amount <= 200000) {

			$percentage = 4;
			$fixed_val = ($percentage / 100) * $amount;
			if ($fixed_val < 4000) {
				$fixed_val = 4000;
			} else {
				$fixed_val = ($percentage / 100) * $amount;
			}
		} else if ($amount > 200000 && $amount <= 500000) {

			$percentage = 3;
			$fixed_val = ($percentage / 100) * $amount;
			if ($fixed_val < 5000) {
				$fixed_val = 5000;
			} else {
				$fixed_val = ($percentage / 100) * $amount;
			}
		} else if ($amount > 500000 && $amount <= 1000000) {

			$percentage = 2.5;
			$fixed_val = ($percentage / 100) * $amount;
			if ($fixed_val < 7000) {
				$fixed_val = 7000;
			} else {
				$fixed_val = ($percentage / 100) * $amount;
			}
		} else if ($amount > 1000000 && $amount <= 5000000) {

			$percentage = 1;
			$fixed_val = ($percentage / 100) * $amount;

			if ($fixed_val < 10000) {
				$fixed_val = 10000;
			} else if ($fixed_val > 25000) {
				$fixed_val = 25000;
			} else {
				$fixed_val = ($percentage / 100) * $amount;
			}
		} else if ($amount > 5000000 && $amount <= 10000000) {

			$percentage = 0.50;
			$fixed_val = ($percentage / 100) * $amount;

			if ($fixed_val < 20000) {
				$fixed_val = 20000;
			} else if ($fixed_val > 30000) {
				$fixed_val = 30000;
			} else {
				$fixed_val = ($percentage / 100) * $amount;
			}
		} else if ($amount > 10000000 && $amount <= 100000000) {


			$percentage = 0.30;
			$fixed_val = ($percentage / 100) * $amount;

			if ($fixed_val < 30000) {
				$fixed_val = 30000;
			} else if ($fixed_val > 35000) {
				$fixed_val = 35000;
			} else {
				$fixed_val = ($percentage / 100) * $amount;
			}
		} else if ($amount > 100000000) {
			$percentage = 0.20;
			$fixed_val = ($percentage / 100) * $amount;

			if ($fixed_val < 35000) {
				$fixed_val = 35000;
			} else if ($fixed_val > 50000) {
				$fixed_val = 50000;
			} else {
				$fixed_val = ($percentage / 100) * $amount;
			}
		} else {
			$fixed_val = 0;
		}

		$var = array(
			'Message' => "Ok",
			'csrf_token' => $csrf_token,
			'row_data' => $fixed_val
		);
		echo json_encode($var);
	}


	public function from($id)
    {
		$row = $this->Legal_file_process_model->get_edit_info($id);
		$row_generate = $this->Legal_file_process_model->generate_info($id);

		$this->Common_model->delete_tempfile();
        $data = array(
            'id' => $id,
            'row' => $row,
            'row_generate' => $row_generate,
            'pages' => 'legal_file_process/pages/add_additional_form',
        );
        $this->load->view('legal_file_process/form_layout', $data);
    }



	public function download_additional_info($id)
    {

		// $row_generate = $this->Legal_file_process_model->generate_info($id);

		$this->db->select('b.*,b.e_by as e_by_id,j6.name as status,j7.name as zone_name,b.ac_name,b.case_number,b.case_claim_amount,
		j9.name as district_name,s.name as loan_segment,
		j1.name as request_type_name,
		CONCAT(j2.name," (",j2.user_id,")")as e_by,
		DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
		DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,
		IF(b.certificate_receipt_date="00/00/0000","",DATE_FORMAT(b.certificate_receipt_date,"%d/%m/%Y")) as certificate_receipt_date,
		IF(b.valuation_date_branch="00/00/0000","",DATE_FORMAT(b.valuation_date_branch,"%d/%m/%Y")) as valuation_date_branch,
		IF(b.valuation_date_surveyor="00/00/0000","",DATE_FORMAT(b.valuation_date_surveyor,"%d/%m/%Y")) as valuation_date_surveyor
		', FALSE)
				->from("suit_filling_info b")
				->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
				->join('users_info as j2', 'b.e_by=j2.id', 'left')
				->join('ref_status as j6', 'b.suit_sts=j6.id', 'left')
				->join('ref_zone as j7', 'b.zone=j7.id', 'left')
				->join('ref_district as j9', 'b.district=j9.id', 'left')
				->join('users_info as j12', 'b.legal_user=j12.id', 'left')
				->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
				->where("b.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			$q = $this->db->get();
			$result = $q->result();
		include_once('tbs/clas/tbs_class.php');
        include_once('tbs/clas/tbs_plugin_opentbs.php');

        $TBS = new clsTinyButStrong;
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

        $template = 'tbs/format_33_57.docx';

        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
        $TBS->MergeBlock('a', $result);
        // $TBS->MergeBlock('b', $row_generate);
        $filename = 'format_33_57.docx';
        $TBS->Show(OPENTBS_DOWNLOAD, $filename);
        exit();
    }
	function add_edit_action(){
        $csrf_token=$this->security->get_csrf_hash();
        $text = array();
        if($this->session->userdata['ast_user']['login_status'])
        {
            $id = $this->Legal_file_process_model->add_edit_action();
        }
        else{
            $text[]="Session out, login required";
        }
        $Message='';
        if(count($text)<=0){
            $Message='OK';
            $row=[];
        }else{
            for($i=0; $i<count($text); $i++)
            {
                if($i>0){$Message.=',';}
                $Message.=$text[$i];                
            }   
            $row[]='';  
        }
        $var['csrf_token']=$csrf_token;
        $var['Message']=$Message;
        $var['row_info']=$row;
        $var['id']=$id;
        echo json_encode($var);
    }






	// Warrant Form

	public function add_warrantform($id)
    {
		$row = $this->Legal_file_process_model->get_edit_info($id);
		$row_generate = $this->Legal_file_process_model->generate_info($id);
		$this->Common_model->delete_tempfile();
        $data = array(
            'id' => $id,
            'row' => $row,
            'row_generate' => $row_generate,
            'pages' => 'legal_file_process/pages/add_warrantform',
        );
        $this->load->view('legal_file_process/form_layout', $data);
    }
	function add_edit_action2(){
        $csrf_token=$this->security->get_csrf_hash();
        $text = array();
        if($this->session->userdata['ast_user']['login_status'])
        {
            $id = $this->Legal_file_process_model->add_edit_action2();
        }
        else{
            $text[]="Session out, login required";
        }
        $Message='';
        if(count($text)<=0){
            $Message='OK';
            $row=[];
        }else{
            for($i=0; $i<count($text); $i++)
            {
                if($i>0){$Message.=',';}
                $Message.=$text[$i];                
            }   
            $row[]='';  
        }
        $var['csrf_token']=$csrf_token;
        $var['Message']=$Message;
        $var['row_info']=$row;
        $var['id']=$id;
        echo json_encode($var);
    }

	
	public function download_warrantform($id)
    {
		$this->db->select('b.*,b.e_by as e_by_id,j6.name as status,j7.name as zone_name,b.ac_name,b.case_number,b.case_claim_amount,
		j9.name as district_name,s.name as loan_segment,
		j1.name as request_type_name,
		CONCAT(j2.name," (",j2.user_id,")")as e_by,
		DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
		DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,
		IF(b.certificate_receipt_date="00/00/0000","",DATE_FORMAT(b.certificate_receipt_date,"%d/%m/%Y")) as certificate_receipt_date,
		IF(b.valuation_date_branch="00/00/0000","",DATE_FORMAT(b.valuation_date_branch,"%d/%m/%Y")) as valuation_date_branch,
		IF(b.valuation_date_surveyor="00/00/0000","",DATE_FORMAT(b.valuation_date_surveyor,"%d/%m/%Y")) as valuation_date_surveyor,
		IF(b.certificate_receipt_date2="00/00/0000","",DATE_FORMAT(b.certificate_receipt_date2,"%d/%m/%Y")) as certificate_receipt_date2
		', FALSE)
				->from("suit_filling_info b")
				->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
				->join('users_info as j2', 'b.e_by=j2.id', 'left')
				->join('ref_status as j6', 'b.suit_sts=j6.id', 'left')
				->join('ref_zone as j7', 'b.zone=j7.id', 'left')
				->join('ref_district as j9', 'b.district=j9.id', 'left')
				->join('users_info as j12', 'b.legal_user=j12.id', 'left')
				->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
				->where("b.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			$q = $this->db->get();
			$result = $q->result();
		include_once('tbs/clas/tbs_class.php');
        include_once('tbs/clas/tbs_plugin_opentbs.php');

        $TBS = new clsTinyButStrong;
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
        $template = 'tbs/form_warrant.docx';
        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
        $TBS->MergeBlock('a', $result);
        $filename = 'form_warrant.docx';
        $TBS->Show(OPENTBS_DOWNLOAD, $filename);
        exit();
    }






}