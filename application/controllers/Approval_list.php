<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Approval_list extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('Approval_list_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
    }

    function view($menu_group, $menu_cat, $menu_link = null, $submenu = 'pending')
    {

        $currentDate = date("Y-m-d");

        $data = array(
            'menu_group' => $menu_group,
            'menu_cat' => $menu_cat,
            'submenu' => $submenu,
            'menu_link' => $menu_link,
            'current_date' => $currentDate,
            'pages' => 'approval_list/pages/grid',
            'document_type' => $this->User_model->get_parameter_data('ref_document_type', 'name', 'data_status = 1'),
            'per_page' => $this->config->item('per_pagess')
        );
        $this->load->view('grid_layout', $data);
    }

    function grid($submenu = "pending")
    {

        $this->load->model('Approval_list_model', '', TRUE);
        $pagenum = $this->input->get('pagenum');
        $pagesize = $this->input->get('pagesize');
        $start = $pagenum * $pagesize;

        $result = $this->Approval_list_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start, $submenu);

        $data[] = array(
            'TotalRows' => $result['TotalRows'],
            'Rows' => $result['Rows'],
            'status' => $submenu
        );
        echo json_encode($data);
    }
    function from($add_edit = 'add', $id = NULL, $editrow = NULL)
    {

        $collection_method = array(1 => 'Pay Order', 2 => 'Cheque');
        $representative_user = $this->user_model->get_parameter_data('users_info', 'name', "user_group_id = '1'");
        $branch_name = $this->user_model->get_parameter_data('ref_branch_sol', 'name', "data_status=1");

        $bank_name = $this->user_model->get_parameter_data('ref_bank', 'name', "data_status=1");



        $this->load->model('Approval_list_model', '', TRUE);


        $result = $this->Approval_list_model->get_info($add_edit, $id);
        $data = array(
            'option' => '',
            'add_edit' => $add_edit,
            'result' => $result,
            'id' => $id,
            'collection_method' =>  $collection_method,
            'representative_user' =>  $representative_user,
            'branch_name' =>  $branch_name,
            'bank_name' =>  $bank_name,
            'option' => 'upload_recovery',
            'document_type' => $this->User_model->get_parameter_data('ref_document_type', 'name', 'data_status = 1'),
            'pages' => 'approval_list/pages/form',
            'editrow' => $editrow
        );
        $this->load->view('approval_list/form_layout', $data);
    }
    function from2($add_edit = 'edit', $id = NULL, $editrow = NULL)
    {

        $acLength = $this->Common_model->getInvestmentAcLength();
        $acPartStr = json_encode(explode(",", $acLength));

        $result = $this->Approval_list_model->get_info($add_edit, $id);
        $data = array(
            'option' => '',
            'add_edit' => $add_edit,
            'result' => $result,
            'id' => $id,
            'document_type' => $this->User_model->get_parameter_data('ref_document_type', 'name', 'data_status = 1'),
            'pages' => 'approval_list/pages/form2',
            'editrow' => $editrow,
            'acLength' => $acPartStr
        );
        $this->load->view('approval_list/form_layout', $data);
    }
    function add_edit_action($add_edit = NULL, $edit_id = NULL)
    {
        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
        if ($this->session->userdata['ast_user']['login_status']) {

            $id = $this->Approval_list_model->add_edit_action($add_edit, $edit_id);
        } else {
            $text[] = "Session out, login required";
        }

        $Message = '';
        if (count($text) <= 0) {
            $Message = 'OK';
            $row = $this->Approval_list_model->get_add_action_data($id);
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
    public function add_edit_action_indevisual()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Approval_list_model->add_edit_action_indevisual();
        } else {
            $text[] = "Session out, login required";
        }

        $Message = '';
        if (count($text) <= 0) {
            $Message = 'OK';
            $row = $this->Approval_list_model->get_add_action_data($id);
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


            $id = $this->Approval_list_model->delete_action();
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
    public function details()
    {
        $id = $this->input->post('id');
        $csrf_token = $this->security->get_csrf_hash();
        if ($id != '') {
            $rows = $this->Approval_list_model->get_details($id);
        } else {
            $rows = '';
        }
        $data['csrf_token'] = $csrf_token;
        $data['html'] = $rows['html'];
        $data['prev_date'] = $rows['prev_date'];

        echo json_encode($data);
    }
    function verify()
    {
        //$result=$this->Approval_list_model->verify_ptp($this->input->post('ptp_id'));
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

    function Recovery_Data_Templete()
    {
        $destination_path = getcwd() . DIRECTORY_SEPARATOR;
        $filepath = $destination_path . 'Recovery_list/Recovery_Data_Templete.xlsx';
        //$file_name='Templete.xlsx';
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($filepath) . "\"");
        readfile($filepath);
    }


    function dateFormatValidate($date)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            return true;
        } else {
            return false;
        }
    }
    function recovery_upload()
    {

        $acLength = $this->Common_model->getInvestmentAcLength();
        $acLength = explode(",", $acLength);


        $total_error_rows = 0;
        $count = 0;
        $count = 0;
        $type_error = '';


        // ksdjf
        $ac_name = '';
        $ac_type = '';
        $ac_number = '';

        $error_message_amnt_account_number = '';



        $loan_ac = '';
        $org_ac_type = '';


        $error_message_amnt_two = '';
        $error_message_deset = '';

        $org_loan_ac = "";


        $tmp = "";

        $validationError = "";
        $this->load->helper('form');
        $csrf_token = $this->security->get_csrf_hash();
        $str = '';
        $destination_path = getcwd() . DIRECTORY_SEPARATOR;
        //Removing Previous File
        $path = $destination_path . '/recovery_template/recovery_file/temp_recovery_file_' . $this->session->userdata['ast_user']['user_id'] . '.xlsx';
        if (file_exists($path)) {
            unlink($path);
        }
        $result = 0;
        $size1 = basename($_FILES['recovery_file']['size']);
        $size = $size1 / 1048576;
        $filename = stripslashes($_FILES['recovery_file']['name']);
        $i = strrpos($filename, ".");
        $l = strlen($filename) - $i;
        $extension = substr($filename, $i + 1, $l);
        $extension = strtolower($extension);
        $file_name_new = 'temp_recovery_file_' . $this->session->userdata['ast_user']['user_id'] . '.' . $extension;
        //$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
        $target_path = $destination_path . '/recovery_template/recovery_file/' . $file_name_new;

        if (@move_uploaded_file($_FILES['recovery_file']['tmp_name'], $target_path)) {
            $result = 1;
        }
        if ($result == 1) {

            $str .= '<div style="margin-top:10px;overflow-x:hidden;height:350px;" class="grid_table_div">

            <table id="deal_body" style="display:block;width:100%;margin-top: 1rem;">
            <tr>
                <td style="text-align:left;width:3%">
                    <strong id="select_tag" style="margin-left: 11px;">Approval Ref Number <span style="color:red">*</span> : </strong><input type="text" name="apv_ref_no" id="apv_ref_no">
                </td>

                <td style="text-align:left;width:12%">
                    <strong>Approval Date <span style="color:red">*</span>  : </strong>
                    <input id="apv_date" name="apv_date" placeholder="dd/mm/yyyy" />
                    <script type="text/javascript">
                        datePicker("apv_date");
                    </script>

                </td>
        
            
            </tr>
          
        </table>
            <table class="result_table" border="0" style="margin-left:10px;width:98%;font-size:15px;border-collapse:collapse; margin-top: 1rem;">
                <thead>
                    <th width="6%" style="font-weight: bold;text-align:center">A/C Type</th>
                    <th width="15%" style="font-weight: bold;text-align:center">Investment A/C</th>
                    <th width="15%" style="font-weight: bold;text-align:left">CID NO </th>
                    <th width="10%" style="font-weight: bold;text-align:left">Account Name</th>
                    <th width="15%" style="font-weight: bold;text-align:left">Expiry Date</th>
                     <th width="40%" style="font-weight: bold;text-align:left">Error</th>

                </thead>
               <tbody id="table_tbody">';

            $path = $target_path;
            include_once('tbs/clas/tbs_class.php');
            include_once('tbs/clas/tbs_plugin_opentbs.php');

            $TBS = new clsTinyButStrong();
            $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

            $TBS->LoadTemplate($path);

            $options = array(
                'noerr' => TRUE,
                //'rangeinfo' => true,
            );

            $range = '$A:$E';

            $data = $TBS->Plugin(OPENTBS_GET_CELLS, $range, $options);



            $error = 0;
            $error_msg = '';
            if (empty($data)) {
                $str .= '<tr> <td colspan="4" align="center">Invalid File!!</td></tr>';
                $Message = 'NotOk';
                $str .= '<input type="hidden" name="total_row" id="total_row" value="0">';
                $str .= '<input type="hidden" name="total_number_of_error" id="total_number_of_error" value="0">';
            } else {


                foreach ($data as $key => $val) {



                    // if (in_array(null, $val, true) || in_array('', $val, true)) {
                    //     continue;
                    // }
                    if ($key == 0) {
                        continue;
                    }




                    $count++;
                    $str .= '<tr id="row_' . $count . '">';


                    // new code 

                    foreach ($val as $key2 => $col) {


                        if ($key2 == 0) {
                            $ac_type = $col;
                            if (!($ac_type == 'Card' || $ac_type == 'Investment')) {
                                $type_error = 'Invalid A/C Type';
                            } else {
                                $type_error = '';
                            }
                        } else if ($key2 == 1) {
                            if (is_numeric($col)) {

                                if (in_array(strlen($col), $acLength)) {
                                    $validationError = "";
                                } else {
                                    $validationError = "Investment A/C must be " . implode(" or ", $acLength) . " Digits";
                                }
                                $error_message_amnt_two = $validationError;

                                $error_message_amnt = '';
                                $ac_number = $col;
                            } else {
                                $error_message_amnt = 'Invalid Account Number ';
                            }

                            if (strlen($col) > 16) {

                                $error_message_amnt_two = "Account A/C Must Be 16 Character";
                            }
                        } else if ($key2 == 3) {
                            if (is_string($col)) {
                                $error_message_amnt_account_number = '';
                                $ac_name = $col;
                            } else {
                                $error_message_amnt_account_number = "Account Name Must Be String";
                            }
                        }





                        if ($key2 == 4) {




                            if ($this->dateFormatValidate($col)) {

                                $validationError = $col;
                                $str .= '<input type="hidden" id="expiry_date_' . $count . '" name="expiry_date_' . $count . '" value="' . $col . '">';
                            } else {
                                $total_error_rows++;
                                $validationError = "<span style='color:red;'>" . $col . "</span>";
                                $error_message_amnt_two .= "<br>Date format must be YY-MM-DD";
                            }

                            $str .= '<td align="left">' . $validationError  . '</td>';
                        } else {
                            $str .= '<td align="left">' . $col . '</td>';
                        }
                    }

                    //$val returns date here





                    if ($type_error != '') {

                        $str .= '<td align="left"><strong><span style="color:red">' . $type_error . '</span></strong></td>';
                        $total_error_rows++;
                    } else if ($error_message_amnt != '') {
                        $str .= '<td align="left"><strong><span style="color:red">' . $error_message_amnt . '</span></strong></td>';
                        $total_error_rows++;
                    } else if ($error_message_amnt_two != '') {
                        $str .= '<td align="left"><strong><span style="color:red">' . $error_message_amnt_two . '</span></strong></td>';
                        $total_error_rows++;
                    } else if ($error_message_amnt_account_number != '') {
                        $str .= '<td align="left"><strong><span style="color:red">' . $error_message_amnt_account_number . '</span></strong></td>';
                        $total_error_rows++;
                    } else {


                        if ($val[0] == 'Investment') {

                            $loan_ac = $val[1];
                            $org_loan_ac = "";
                        } else {

                            $loan_ac = substr($val[1], 0, 6) . '******' . substr($val[1], 12, 16);
                            $org_loan_ac = $this->Common_model->stringEncryption('encrypt', $val[1]);
                        }





                        $str .= '<td align="left">
                        <input type="hidden" id="ac_type_' . $count . '" name="ac_type_' . $count . '" value="' . $val[0] . '">

                        <input type="hidden" id="investment_ac_' . $count . '" name="investment_ac_' . $count . '" value="' . $loan_ac . '">

                        <input type="hidden" id="org_loan_ac_' . $count . '" name="org_loan_ac_' . $count . '" value="' . $org_loan_ac . '">

                        <input type="hidden" id="cif_no_' . $count . '" name="cif_no_' . $count . '" value="' . $val[2] . '">
                        <input type="hidden" id="account_name_' . $count . '" name="account_name_' . $count . '" value="' . $val[3] . '">
                    </td>
                   
                    </tr>';
                    }
                }
                $str .= '</tbody></table></div><input type="hidden" name="total_row" id="total_row" value="' . $count . '">
                <input type="hidden" name="selected_row" id="selected_row" value="' . $count . '">';



                if ($total_error_rows > 0) {
                    $str .= '<table class="result_table" id="total_result_table" border="0" style="dsiplay:inline;margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
                    <tbody>';
                    $str .= '<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="7"><input type="hidden" name="total_number_of_error" id="total_number_of_error" value="' . $total_error_rows . '"><strong><span style="color:red">Total Error : <span id="error_number">' . $total_error_rows . '<span></span></strong></td></tr>';
                    $str .= '</tbody></table>';
                } else {

                    $str .= '<div id="button_center"><input type="button" value="Submit" id="save_ttttbutton" onclick="validation_form()" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;"> </div><span id="send_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loadingimage.gif" align="bottom"></span>
                    <br/><br/><br/>';
                }

                $Message = 'OK';
            }
        }


        $var = array(
            "tmp" => $tmp,
            "str" => $str,
            "Message" => $Message,
            "total_error_rows" => $total_error_rows,
            "csrf_token" => $csrf_token

        );
        echo json_encode($var);
    }



    function delete_action_data()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
        //Lodaing facility for loan
        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Approval_list->delete_action();
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
            } else if (isset($_POST['typebulk'])) {
                $row[] = '';
            } else {
                $row = array();
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
