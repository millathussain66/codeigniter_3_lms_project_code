<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bill_approve_ho extends CI_Controller
{
    public $del_right;
    function __construct()
    {
        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('Bill_ho_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
        $this->load->model('User_info_model', '', TRUE);
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Expenses_model', '', TRUE);
        $this->del_right = $this->db->query("SELECT id FROM users_right WHERE user_info_id=" . $this->session->userdata['ast_user']['user_id'] . " AND menu_link_id=374 AND data_status=1")->row();
    }
    function view($menu_group = NULL, $menu_cat = NULL, $sub_menue = NULL, $operation = 'court_fee')
    {





        $data = array(
            'menu_group' => $menu_group,
            'menu_cat' => $menu_cat,
            'operation' => $operation,
            'tax_vat_text' => $this->User_model->get_parameter_data('ref_tax_vat_text', 'id', 'data_status = 1'),
            'billing_month' => $this->User_model->get_parameter_data('ref_billing_month', 'id', 'data_status = 1'),
            'approver_list' => $this->User_model->get_parameter_data('ref_approver_list', 'name', 'data_status = 1'),
            'employee_type' => $this->User_model->get_parameter_data('ref_employee_type', 'name', 'data_status = 1'),
            'sub_menue' => $sub_menue,
            'staff' => $this->Expenses_model->get_staff(),
            'legal_am' => $this->User_info_model->get_user_data('2'),
            'legal_zone' => $this->User_model->get_parameter_data('ref_zone', 'name', 'data_status = 1'),
            'bank' => $this->User_model->get_parameter_data('ref_bank', 'name', 'data_status = 1'),
            'payment_type' => $this->User_model->get_parameter_data('ref_payment_type', 'name', 'data_status = 1'),
            'lawyer' => $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1'),
            'return_type' => $this->User_model->get_parameter_data('ref_return_type', 'name', 'data_status = 1'),
            'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1'),
            'district' => $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1'),
            'pages' => 'bill_approve_ho/pages/grid',
            'per_page' => $this->config->item('per_pagess')
        );

        if ($operation == "lawyer_bill") {
            $data['pages'] = 'bill_approve_ho/pages/lawyer_grid';
        }

        $this->load->view('grid_layout', $data);
    }

    function court_fee_grid()
    {
        $this->load->model('Bill_ho_model', '', TRUE);
        $pagenum = $this->input->get('pagenum');
        $pagesize = $this->input->get('pagesize');
        $start = $pagenum * $pagesize;

        $result = $this->Bill_ho_model->get_grid_data_court_fee_ho($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

        $data[] = array(
            'TotalRows' => $result['TotalRows'],
            'Rows' => $result['Rows']
        );
        echo json_encode($data);
    }



    function lawyer_grid()
    {
        $this->load->model('Bill_ho_model', '', TRUE);
        $pagenum = $this->input->get('pagenum');
        $pagesize = $this->input->get('pagesize');
        $start = $pagenum * $pagesize;

        $result = $this->Bill_ho_model->get_grid_data_lawyer_approval($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

        $data[] = array(
            'TotalRows' => $result['TotalRows'],
            'Rows' => $result['Rows']
        );
        echo json_encode($data);
    }
    function lawyer_bill_details()
    {
        $this->Common_model->delete_tempfile();
        $csrf_token = $this->security->get_csrf_hash();
        $str = '';
        $id = $this->input->post('id');
        $details = $this->Bill_ho_model->get_row_details_lawyer($id);


        $bill_details = $this->Bill_ho_model->get_lawyer_bill_details_by_id($id);
        if (!empty($details)) {
            if ($details->file_for_finance != '' && $details->file_for_finance != NULL) {
                $file_for_finance = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/file_for_finance/' . $details->file_for_finance . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
            } else {
                $file_for_finance = "";
            }

            if ($details->file_from_finance != '' && $details->file_from_finance != NULL) {
                $file_from_finance = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/file_from_finance/' . $details->file_from_finance . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
            } else {
                $file_from_finance = "";
            }

            $str .= '<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>' . $details->sl_no . '</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Lawyer Bill</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>' . $details->lawyer_name . '</td>
						<td width="50%" align="left"><strong>Bill Date:</strong>' . $details->bill_dt . '</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Received From field Recovery AM:</strong>' . $details->received_dt . '</td>
						<td width="50%" align="left"><strong>Tax Vat Text:</strong>' . $details->tax_vat_text . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>' . $details->dispatch_no . '</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>' . number_format($details->bill_amount, 2) . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Discount Amount:</strong>' . number_format($details->discount_amount, 2) . '</td>
						<td width="50%" align="left"><strong>Memo Remarks:</strong>' . $details->memo_remarks . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>' . $details->memo_e_by . '</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>' . $details->e_dt . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>' . $details->v_by . '</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>' . $details->v_dt . '</td>
					</tr>
					<tr>
                        
                        <td width="50%" align="left"><strong>Attachment For Finance:</strong>' . $file_for_finance . '</td>
                        <td width="50%" align="left"><strong>File Send To Finanace By:</strong>' . $details->stf_by . '</td>
                    </tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return File:</strong>' . $file_from_finance . '</td>
                        <td width="50%" align="left"><strong>File Return Reason:</strong>' . $details->finance_r_reason . '</td>
                    </tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return By:</strong>' . $details->finance_r_by . '</td>
                        <td width="50%" align="left"><strong>File Return Date Time:</strong>' . $details->finanace_r_dt . '</td>
                    </tr>
					';
            $str .= '</tbody>
				</table>';
        }
        if (!empty($bill_details)) {
            $str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Vendor Name</td>
						<td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
						<td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
						<td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
						<td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
						<td width="10%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
						<td width="10%" style="font-weight: bold;text-align:center">Bill Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Discount Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Invoice Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
            $total = 0;
            $total_discount = 0;
            $total_invoice = 0;
            foreach ($bill_details as $key) {
                $total = $total + $key->amount;
                $total_discount = $total_discount + $key->discount_amount;
                $total_invoice = $total_invoice + $key->invoice_amount;
                $str .= '<tr>';
                $str .= '<td align="center">' . $key->lawyer_name . '</td>';
                $str .= '<td align="center">' . $key->loan_ac . '</td>';
                $str .= '<td align="center">' . $key->ac_name . '</td>';
                $str .= '<td align="center">' . $key->case_number . '</td>';
                $str .= '<td align="center">' . $key->txrn_dt . '</td>';
                $str .= '<td align="center">' . $key->activities_name . '</td>';
                $str .= '<td align="center">' . number_format($key->amount, 2) . '</td>';
                $str .= '<td align="center">' . number_format($key->discount_amount, 2) . '</td>';
                $str .= '<td align="center">' . number_format($key->invoice_amount, 2) . '</td>';
                $str .= '</tr>';
            }
            $str .= '<tr>';
            $str .= '<td colspan="6" align="right">Total</td>';
            $str .= '<td align="center">' . number_format($total, 2) . '</td>';
            $str .= '<td align="center">' . number_format($total_discount, 2) . '</td>';
            $str .= '<td align="center">' . number_format($total_invoice, 2) . '</td>';
            $str .= '</tr>';

            $str .= '</tbody>
				</table>
			</div>';
        }
        $var = array(
            "str" => $str,
            "csrf_token" => $csrf_token,
            'details' => $details
        );
        echo json_encode($var);
    }

    function court_fee_details()
    {
        $this->Common_model->delete_tempfile();
        $csrf_token = $this->security->get_csrf_hash();
        $str = '';
        $id = $this->input->post('id');
        $details = $this->Bill_ho_model->get_row_details_court_fee($id);
        $bill_details = $this->Bill_ho_model->get_court_fee_details_by_id($id);
        if (!empty($details)) {
            if ($details->file_for_finance != '' && $details->file_for_finance != NULL) {
                $file_for_finance = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/file_for_finance/' . $details->file_for_finance . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
            } else {
                $file_for_finance = "";
            }

            if ($details->file_from_finance != '' && $details->file_from_finance != NULL) {
                $file_from_finance = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/file_from_finance/' . $details->file_from_finance . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
            } else {
                $file_from_finance = "";
            }

            $str .= '<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>' . $details->sl_no . '</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Court Fee</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>' . $details->lawyer_name . '</td>
						<td width="50%" align="left"><strong>Bill Date:</strong>' . $details->bill_dt . '</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Received From field Recovery AM:</strong>' . $details->received_dt . '</td>
						<td width="50%" align="left"><strong>Tax Vat Text:</strong>' . $details->tax_vat_text . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>' . $details->dispatch_no . '</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>' . number_format($details->bill_amount, 2) . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Discount Amount:</strong>' . number_format($details->discount_amount, 2) . '</td>
						<td width="50%" align="left"><strong>Memo Remarks:</strong>' . $details->memo_remarks . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>' . $details->memo_e_by . '</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>' . $details->e_dt . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>' . $details->v_by . '</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>' . $details->v_dt . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Attachment For Finance:</strong>' . $file_for_finance . '</td>
						<td width="50%" align="left"><strong>File Send To Finanace By:</strong>' . $details->stf_by . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Finance Return File:</strong>' . $file_from_finance . '</td>
						<td width="50%" align="left"><strong>File Return Reason:</strong>' . $details->finance_r_reason . '</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Finance Return By:</strong>' . $details->finance_r_by . '</td>
						<td width="50%" align="left"><strong>File Return Date Time:</strong>' . $details->finanace_r_dt . '</td>
					</tr>
					';
            $str .= '</tbody>
				</table>';
        }
        if (!empty($bill_details)) {
            $str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Vendor Name</td>
						<td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
						<td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
						<td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
						<td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
						<td width="10%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
						<td width="10%" style="font-weight: bold;text-align:center">Bill Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Discount Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Invoice Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
            $total = 0;
            $total_discount = 0;
            $total_invoice = 0;
            foreach ($bill_details as $key) {
                $total = $total + $key->amount;
                $total_discount = $total_discount + $key->discount_amount;
                $total_invoice = $total_invoice + $key->invoice_amount;
                $str .= '<tr>';
                $str .= '<td align="center">' . $key->lawyer_name . '</td>';
                $str .= '<td align="center">' . $key->loan_ac . '</td>';
                $str .= '<td align="center">' . $key->ac_name . '</td>';
                $str .= '<td align="center">' . $key->case_number . '</td>';
                $str .= '<td align="center">' . $key->txrn_dt . '</td>';
                $str .= '<td align="center">' . $key->activities_name . '</td>';
                $str .= '<td align="center">' . number_format($key->amount, 2) . '</td>';
                $str .= '<td align="center">' . number_format($key->discount_amount, 2) . '</td>';
                $str .= '<td align="center">' . number_format($key->invoice_amount, 2) . '</td>';
                $str .= '</tr>';
            }
            $str .= '<tr>';
            $str .= '<td colspan="6" align="right">Total</td>';
            $str .= '<td align="center">' . number_format($total, 2) . '</td>';
            $str .= '<td align="center">' . number_format($total_discount, 2) . '</td>';
            $str .= '<td align="center">' . number_format($total_invoice, 2) . '</td>';
            $str .= '</tr>';

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

    function bulk_operation($operation = NULL, $module_name = NULL)
    {
        $lawyer = $this->Bill_ho_model->getAllLawer();

        $operation_name = '';
        if ($operation == 'apv' && $module_name == 'lawyer_bill') {
            $operation_name = 'Approve Lawyer Bill';
        }
        if ($operation == 'apv' && $module_name == 'court_fee') {

            $operation_name = 'Approve Court Fee';
        }
        if ($operation == 'apv' && $module_name == 'lawyer_bill_hc') {
            $operation_name = 'Approve Lawyer Bill HC';
        }
        $data = array(
            'legal_zone' => $this->User_model->get_parameter_data('ref_zone', 'name', 'data_status = 1'),
            'operation' => $operation,
            'module_name' => $module_name,
            'operation_name' => $operation_name,
            'vendors' => $lawyer,
            'pages' => 'bill_approve_ho/pages/bulk_operation',

        );
        $this->load->view('bill_approve_ho/form_layout', $data);
    }
    function load_bulk_data()
    {
        $this->load->helper('form');
        $csrf_token = $this->security->get_csrf_hash();
        $grid_data = $this->Bill_ho_model->get_bulk_data(true);
        $operation = $this->input->post('operation');
        $str = '';
        $str .= '<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
		<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead>
				<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
				<th width="3%"  style="font-weight: bold;text-align:center">P</th>
				<th width="15%" style="font-weight: bold;text-align:left">Vendor Name</th>
				<th width="20%" style="font-weight: bold;text-align:left">Bill Amount</th>
				<th width="15%" style="font-weight: bold;text-align:left">SL No.</th>
				<th width="15%" style="font-weight: bold;text-align:left">Despatch No.</th>
				<th width="20%" style="font-weight: bold;text-align:left">Remarks</th>
			</thead>
			<tbody>';

        if ($this->input->post('module_name') == 'lawyer_bill' || $this->input->post('module_name') == 'court_fee' ||  $this->input->post('module_name') == 'lawyer_bill_hc') {
            if (count($grid_data) <= 0) {
                $str .= '<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
                $str .= '<input type="hidden" name="event_counter" id="event_counter" value="0">';
                $str .= '</tbody></table></div>';
            } else {
                $i = 1;
                foreach ($grid_data as $data) {
                    $str .= '<tr>';
                    $str .= '<td align="center"><input type="checkbox" name="chkBoxSelect' . $i . '" id="chkBoxSelect' . $i . '" onClick="CheckChanged_2(this,\'' . $i . '\')" value="chk"/><input type="hidden" name="event_delete_' . $i . '" id="event_delete_' . $i . '" value="1"><input type="hidden" name="id_' . $i . '" id="id_' . $i . '" value="' . $data->id . '"></td>';
                    $str .= '<td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $data->id . ',\'details\',\'' . $this->input->post('module_name') . '\')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>';
                    $str .= '<td align="left">' . $data->lawyer_name . '</td>';
                    $str .= '<td align="left">' . $data->bill_amount . '</td>';
                    $str .= '<td align="left">' . $data->sl_no . '</td>';
                    $str .= '<td align="left" >' . $data->dispatch_no . '</td>';
                    $str .= '<td align="left">' . $data->memo_remarks . '</td>';
                    $str .= '</tr>';
                    $i++;
                }
                $str .= '<input type="hidden" name="event_counter" id="event_counter" value="' . ($i - 1) . '">';
                $str .= '</tbody></table></div>';
                $str .= '<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<tbody>';
                $str .= '<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="6">Total Selected : <span id="selected_value">0</span></td></tr>';
                $str .= '</tbody></table>';
            }
        }
        $var = array(
            "str" => $str,
            "csrf_token" => $csrf_token
        );
        echo json_encode($var);
    }
    function bulk_acktion()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
        //Lodaing facility for loan
        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Bill_ho_model->bulk_acktion();
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

    function delete_action()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
        //Lodaing facility for loan
        $row[] = '';
        if ($this->session->userdata['ast_user']['login_status']) {

            $id = $this->Bill_ho_model->delete_action();
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
}
