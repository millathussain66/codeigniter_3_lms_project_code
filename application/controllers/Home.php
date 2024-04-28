<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', true);
        $this->load->model('User_info_model', '', true);
        $this->load->model('Common_model', '', true);
        $this->load->model('Legal_notice_model', '', true);
        $this->load->model('Legal_notice_ho_model', '', true);
        $this->load->model('Cma_ho_model', '', true);
        $this->load->model('Cma_process_model', '', true);
        $this->load->helper('form');
        $this->load->helper('url');
    }

    function index($error = NULL, $u_id_slt = NULL, $attempt = 0)
    {

        if (isset($this->session->userdata['ast_user']['login_status']) && $this->session->userdata['ast_user']['login_status']) {
            redirect("/home/home_wc/1/1/32");
        } else {
            $this->session->sess_destroy();
            $data = array(
                'option' => '',
                'error' => $error,
                'u_id_slt' => $u_id_slt,
                'sys_config' => $this->User_info_model->upr_config_row(),
                'attempt' => $attempt
            );
            $this->load->view('login/login_form', $data);
        }
    }
    function product_details()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $sah = $this->User_model->get_product_details($this->input->post('operation_name'));
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function check_hiliday()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $sah = $this->User_model->check_hiliday($this->input->post('date'));
        //0=no hiliday,1=holiday,2=holiday not updated yet
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function get_information_by_legal_district_legal_affair()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $id = $this->input->post('act_id');
        $court = $this->User_model->get_parameter_data('ref_court', 'name', 'data_status = 1 AND district="'.$id.'"');
        //$lawyer = $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1');
        $plaintiff = $this->User_model->get_parameter_data('users_info', 'name', 'data_status = 1 AND user_group_id IN (4,9) AND district='.$id.' AND admin_status<>2 AND district<>0 AND district IS NOT NULL');
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        $jTableResult['status'] = "success";
        $jTableResult['court'] = $court;
        //$jTableResult['lawyer'] = $lawyer;
        $jTableResult['plaintiff'] = $plaintiff;
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function get_information_by_legal_district()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $id = $this->input->post('act_id');
        $court = $this->User_model->get_parameter_data('ref_court', 'name', 'data_status = 1 AND district="'.$id.'"');
        //$lawyer = $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1');
        $plaintiff = $this->User_model->get_parameter_data('users_info', 'name', 'data_status = 1 AND user_group_id IN (4,9) AND district='.$id.' AND admin_status<>2 AND district<>0 AND district IS NOT NULL');
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        $jTableResult['status'] = "success";
        $jTableResult['court'] = $court;
        //$jTableResult['lawyer'] = $lawyer;
        $jTableResult['plaintiff'] = $plaintiff;
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function get_expense_amount()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $sah = $this->User_model->get_expense_amount($this->input->post('act_id'), $this->input->post('cma_district'), $this->input->post('req_type'),$this->input->post('vendor_id'));
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function get_file($valll)
    {
        $images = [
            'xyzzzsdsbbbjpgr' => 'images/login_images/R.jpg',
            'xyzzzsdsbbbpngrefl' => 'images/login_images/reflection.png',
            'xyzzzsdsbbbpngfavi' => 'images/favicon.png',
            'xyzzzsdsbbbpngclient' => 'images/login_images/client.png',
            'xyzzzsdsbbbpnglogo' => 'images/login_images/logo.png',

            'xyzzzsdsbbbjsjq36' => 'scripts/jquery-3.6.0.min.js',
            'xyzzzsdsbbbjsjqvmin' => 'scripts/jquery.validate.min.js',


            'xyzzzsdsbbbcsss' => 'setting/assets/css/style.css',
            'xyzzzsdsbbbcssf' => 'setting/assets/css/form.css',
            'xyzzzsdsbbbcssuiljq' => 'css/ui-lightness/jquery-ui-1.8.10.custom.css',
            'xyzzzsdsbbbjsjquimin' => 'js/jquery-ui-1.13.0.custom/jquery-ui.min.js',
            'xyzzzsdsbbbjst' => 'js/timer.js',
            'xyzzzsdsbbbpnge' => 'images/exit.png',


            'xyzzzsdsbbbgifl' => 'images/loader.gif',
            'xyzzzsdsbbbpngsn' => 'images/SetNew.png',
            'xyzzzsdsbbbpngn' => 'images/notify.png',
            'xyzzzsdsbbbpngvd' => 'images/view_detail.png',
            'xyzzzsdsbbbcsssc' => 'css/simple-chart.css',
            'xyzzzsdsbbbpngise' => 'images/icon-select.png', //
            'xyzzzsdsbbbjscust' => 'js/custom.js',
            'xyzzzsdsbbbcsscomn' => 'msg_popup_hsn/common.css', //
            'xyzzzsdsbbbjsutj' => 'msg_popup_hsn/Util-jar.js',

            'logoutzxzxbjsbase' => 'jqwidgets/styles/jqx.base.css',
            'xyzzzsdsbbbjscore' => 'jqwidgets/jqxcore.js',
            'xyzzzsdsbbbjsval' => 'jqwidgets/jqxvalidator.js',
            'xyzzzsdsbbbjsbut' => 'jqwidgets/jqxbuttons.js',


            'xyzzzsdsbbbpngfol' => 'setting/assets/images/footer-left.png',
            'xyzzzsdsbbbpngfor' => 'setting/assets/images/footer-right.png',


        ];

        $get = ""; //images/login_images/client.png
        if (array_key_exists($valll, $images)) {
            $get = $images[$valll];
        } else {
            die('<pre>Sorry! This is an unauthorized attempted. Please ensure proper Content-Name (1008).</pre>');
        }

        $img = base_url() . $get;
        //$ctype='image/jpeg';

        $array = explode('.', $get);
        $extension = end($array);

        if ($extension == 'css') {
            header('Content-Type: text/css');
        } else if ($extension == 'js') {
            header('Content-Type: text/javascript');
        } else if ($extension == 'jpg') {
            header('Content-Type: image/jpeg');
        } else if ($extension == 'png') {
            header('Content-Type: image/png');
        } else if ($extension == 'gif') {
            header('Content-Type: image/gif');
        }

        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        echo $response = file_get_contents($img, false, stream_context_create($arrContextOptions));


        //readfile($img);

    }

    function get_total_notification()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $total = $this->User_model->get_notification_data();
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;

        if ($total != '') {
            if (!empty($total)) {
                $total_notify = count($total);
            } else {
                $total_notify = 0;
            }
        } else {
            $total_notify = 0;
        }


        if ($total_notify != 0) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $total_notify;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = '0';
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function load_grid_table($type)
    {
        $str_result = "";
        if ($type == 'cma_verify_pending') {
            $str_result = $this->User_model->get_cma_verify_pending();
        }
        if ($type == 'legal_notice_verify_pending') {
            $str_result = $this->User_model->get_legal_notice_verify_pending();
        }

        $csrf_token = $this->security->get_csrf_hash();
        $var = array(
            "csrf_token" => $csrf_token,
            "str_result" => $str_result
        );
        echo json_encode($var);
    }
    function get_notification_data()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $sah = $this->User_model->get_notification_data();
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function ajaxFileUpload($module_name = NULL, $data_field_name = NULL)
    {
        $data = array(
            'data_field_name' => $data_field_name,
            'module_name' => $module_name
        );
        $this->load->view('Upload_File_view', $data);
    }
    function get_sub_deshboard_data()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $ln_data = $this->User_model->get_legal_notice_deshboard();
        $cma_data = $this->User_model->get_cma_deshboard();
        $cma_data_init = $this->User_model->get_cma_deshboard_init();
        $auction_data = $this->User_model->get_auction_deshboard();

        $var = array(
            "csrf_token" => $csrf_token,
            "ln_data" => $ln_data,
            "cma_data" => $cma_data,
            "cma_data_init" => $cma_data_init,
            "auction_data" => $auction_data
        );
        echo json_encode($var);
    }
    function get_notification_data_dashboard()
    {
        $csrf_token = $this->security->get_csrf_hash();

        $notification = $this->User_model->get_dashboard_notification();

        $var = array(
            "csrf_token" => $csrf_token,
            "notification" => $notification,
        );
        echo json_encode($var);
    }
    function get_front_deshboard_data()
    {

        // total_recovery_this_month

        $csrf_token = $this->security->get_csrf_hash();
        $total_hc_data = $this->User_model->get_total_case_data_hc();
        $recovery_data = $this->User_model->get_total_recvery_data();
        $total_recovery_this_month = (!empty($recovery_data)) ? round(($recovery_data->total_recovery_this_month / 10000000), 2) : 0;
        $total_recovery_this_year = (!empty($recovery_data)) ? round(($recovery_data->total_recovery_this_year / 10000000), 2) : 0;



        $total_approval_list = (!empty($this->User_model->get_total_approval_list())) ? $this->User_model->get_total_approval_list()->total_approval_list : 0;
        $total_running_case = (!empty($this->User_model->get_total_case_data())) ? $this->User_model->get_total_case_data()->total_running_case : 0;
        $total_running_case_hc = (!empty($total_hc_data)) ? $total_hc_data->total_running_case_hc : 0;
        $total_disposed_case = (!empty($this->User_model->get_total_case_data())) ? $this->User_model->get_total_case_data()->total_disposed_case : 0;
        $total_disposed_case_hc = (!empty($total_hc_data)) ? $total_hc_data->total_disposed_case_hc : 0;
        $total_active_lawyer = (!empty($this->User_model->get_total_active_lawyer())) ? $this->User_model->get_total_active_lawyer()->total_active_lawyer : 0;
        $total_case_type_wise = $this->User_model->get_total_case_by_case_type();

        $total_case_type_wise_disposal = $this->User_model->get_total_case_by_case_type_disposal();

        $appeal_bail_money_data = $this->User_model->get_appeal_bail_money_data();
        $appeal_money = (!empty($appeal_bail_money_data)) ? round(($appeal_bail_money_data->appeal_money / 10000000), 2) : 0;
        $bail_money = (!empty($appeal_bail_money_data)) ? round(($appeal_bail_money_data->bail_money / 10000000), 2) : 0;
        $warrent_arrest_data = $this->User_model->get_warrent_arrest_data();
        $pending_warrent = (!empty($warrent_arrest_data)) ? $warrent_arrest_data->total_pending : 0;
        $executed_warrent = (!empty($warrent_arrest_data)) ? $warrent_arrest_data->total_executed : 0;
        $ni_act = (!empty($total_case_type_wise)) ? $total_case_type_wise->ni_act : 0;
        $ara = (!empty($total_case_type_wise)) ? $total_case_type_wise->ara : 0;
        $ara_ex = (!empty($total_case_type_wise)) ? $total_case_type_wise->ara_ex : 0;

        $others = (!empty($total_case_type_wise)) ? $total_case_type_wise->others : 0;



        $ni_act_disposal = (!empty($total_case_type_wise_disposal)) ? $total_case_type_wise_disposal->ni_act : 0;
        $ara_disposal = (!empty($total_case_type_wise_disposal)) ? $total_case_type_wise_disposal->ara : 0;
        $others_disposal = (!empty($total_case_type_wise_disposal)) ? $total_case_type_wise_disposal->others : 0;

        $get_recovery_deposit_amt_data = $this->User_model->get_recovery_deposit_amt_data();
        $recovery_ni_money = (!empty($get_recovery_deposit_amt_data)) ? round(($get_recovery_deposit_amt_data['ni_money'] / 100000), 2) : 0;
        $recovery_ara_money = (!empty($get_recovery_deposit_amt_data)) ? round(($get_recovery_deposit_amt_data['ara_money'] / 100000), 2) : 0;
        $recovery_others_money = (!empty($get_recovery_deposit_amt_data)) ? round(($get_recovery_deposit_amt_data['others_money'] / 100000), 2) : 0;

        $type_wise_legal_cost = $this->User_model->get_type_wise_legal_cost();
        $total_cost = round(($type_wise_legal_cost->total_cost / 1000000), 2);
        $total_court_enter = round(($type_wise_legal_cost->total_court_enter / 1000000), 2);
        $total_staff_conv = round(($type_wise_legal_cost->total_staff_conv / 1000000), 2);
        $total_vendor_bill = round(($type_wise_legal_cost->total_vendor_bill / 1000000), 2);
        $total_lawyer_bill = round(($type_wise_legal_cost->total_lawyer_bill / 1000000), 2);
        $total_court_fee = round(($type_wise_legal_cost->total_court_fee / 1000000), 2);

        $total_legal_cost_req_type = $this->User_model->get_req_type_wise_legal_cost();
        $total_ni_act = (!empty($total_legal_cost_req_type)) ? round(($total_legal_cost_req_type->total_ni_act / 100000), 2) : 0;
        $total_ara = (!empty($total_legal_cost_req_type)) ? round(($total_legal_cost_req_type->total_ara / 100000), 2) : 0;
        $total_others = (!empty($total_legal_cost_req_type)) ? round(($total_legal_cost_req_type->total_others / 100000), 2) : 0;

        $total_case_against_bank_type_wise = $this->User_model->get_case_against_bank_data_type_wise();
        $total_running_case_case_against_bank=(!empty($total_case_against_bank_type_wise))?$total_case_against_bank_type_wise->total_running_case_case_against_bank:0;
        $total_disposed_case_case_against_bank=(!empty($total_case_against_bank_type_wise))?$total_case_against_bank_type_wise->total_disposed_case_case_against_bank:0;

        $total_case_html = $this->User_model->get_total_case_data_table();


        $var = array(
            "csrf_token" => $csrf_token,
            "total_disposed_case_case_against_bank" => $total_disposed_case_case_against_bank,
            "total_running_case_case_against_bank" => $total_running_case_case_against_bank,
            "total_recovery_this_month" => $total_recovery_this_month,
            "total_recovery_this_year" => $total_recovery_this_year,
            "total_ni_act" => $total_ni_act,
            "total_ara" => $total_ara,
            "total_others" => $total_others,
            "total_cost" => $total_cost,
            "total_case_html" => $total_case_html,
            "total_court_enter" => $total_court_enter,
            "total_staff_conv" => $total_staff_conv,
            "total_vendor_bill" => $total_vendor_bill,
            "total_lawyer_bill" => $total_lawyer_bill,
            "total_court_fee" => $total_court_fee,
            "pending_warrent" => $pending_warrent,
            "executed_warrent" => $executed_warrent,
            "appeal_money" => $appeal_money,
            "bail_money" => $bail_money,
            "recovery_ni_money" => $recovery_ni_money,
            "recovery_ara_money" => $recovery_ara_money,
            "recovery_others_money" => $recovery_others_money,
            "ni_act" => $ni_act,
            "ara" => $ara,
            "ara_ex" => $ara_ex,
            "others" => $others,
            "ni_act_disposal" => $ni_act_disposal,
            "ara_disposal" => $ara_disposal,
            "others_disposal" => $others_disposal,
            "total_running_case" => $total_running_case,
            "total_disposed_case" => $total_disposed_case,
            "total_disposed_case_hc" => $total_disposed_case_hc,
            "total_running_case_hc" => $total_running_case_hc,
            "total_approval_list" => $total_approval_list,
            "total_active_lawyer" => $total_active_lawyer
        );
        
        echo json_encode($var);
    }
    function get_html_details()
    {
        $csrf_token = $this->security->get_csrf_hash();

        $result = $this->User_model->get_html_details();
        $thead = "";
        $tbody = '';
        $thead .= '<table style="width: 100%;" class="preview_table2">
        <thead id="details_head">
        <tr>
            <th align="left"><strong>SL</strong></th>
            <th align="left"><strong>Investment AC</strong></th>
            <th align="left"><strong>AC Name</strong></th>
            <th align="left"><strong>Branch</strong></th>
            <th align="left"><strong>Case Type</strong></th>
            <th align="left"><strong>Case Number</strong></th>
            <th align="left"><strong>Court Name</strong></th>
            <th align="left"><strong>Lawyer NAME</strong></th>
            <th align="left"><strong>Zone Name</strong></th>
            <th align="left"><strong>District</strong></th>
        </tr>';
        if (!empty($result)) {
            $sl=0;
            foreach ($result as $key) {
                $sl++;
                $tbody .= '<tr>
                    <td align="center">' . $sl . '</td>
                    <td align="center">' . $key->loan_ac . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->branch_name . '</td>
                    <td align="center">' . $key->request_type . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="left">' . $key->court_name . '</td>
                    <td align="left">' . $key->lawyer_name . '</td>
                    <td align="left">' . $key->zone_name . '</td>
                    <td align="left">' . $key->district_name . '</td>
                    </tr>';
            }
        }
        $tbody .= '</tbody></table>';
        $var = array(
            "csrf_token" => $csrf_token,
            "tbody" => $tbody,
            "thead" => $thead
        );
        echo json_encode($var);
    }
    function get_case_sts_data()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $total_case_status_data = $this->User_model->get_case_status_data();
        $total_updated = (!empty($total_case_status_data)) ? $total_case_status_data->total_updated : 0;
        $total_pending = (!empty($total_case_status_data)) ? $total_case_status_data->total_pending : 0;
        $total_yet_to_fix = (!empty($total_case_status_data)) ? $total_case_status_data->total_yet_to_fix : 0;
        $total_not_available = (!empty($total_case_status_data)) ? $total_case_status_data->total_not_available : 0;
        $var = array(
            "csrf_token" => $csrf_token,
            "total_updated" => $total_updated,
            "total_pending" => $total_pending,
            "total_not_available" => $total_not_available,
            "total_yet_to_fix" => $total_yet_to_fix,
        );
        echo json_encode($var);
    }
    function get_pending_case_list()
    {



        $year=0;
        $branch=0;
        $zone=0;
        $district=0;
        $loan_segment=0;

        if ($_POST['year'] != '' && $_POST['year'] != 0) {
            $year=$this->security->xss_clean($_POST['year']);
        }
        if ($_POST['branch'] != '' && $_POST['branch'] != 0) {
            $branch=$this->security->xss_clean($_POST['branch']);
        }
        if ($_POST['zone'] != '' && $_POST['zone'] != 0) {
            $zone=$this->security->xss_clean($_POST['zone']);
        }
        if ($_POST['district'] != '' && $_POST['district'] != 0) {
            $district=$this->security->xss_clean($_POST['district']);
        }
        if ($_POST['loan_segment'] != '') {
            $loan_segment=$this->security->xss_clean($_POST['loan_segment']);
        }



        $csrf_token = $this->security->get_csrf_hash();
        $operation = 'Pending Update';
        $thead = "";
        $tbody = '';
        $result = $this->User_model->get_pending_status_data($operation);
        if ($_POST['date'] == '') {
            $date = date("Y-m-d");
        } else {
            $date = date("Y-m-d", strtotime($_POST['date']));
        }

        $operation2 = "pending_status";
        $module = "case_schedule";
        $thead .= '<table style="width: 100%;" class="preview_table2">
        <thead id="details_head">
        <tr>
                <th colspan="17" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/case_status_data_xl/' . $operation2 . '/' . $date . '/' . $module .'/'.$zone. '/'. $district.'/'.$branch.'/'.$loan_segment.'" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
        </tr>
        <tr>
            <th align="left"><strong>SL</strong></th>
            <th align="left"><strong>Zone</strong></th>
            <th align="left"><strong>District</strong></th>
            <th align="left"><strong>Branch</strong></th>
            <th align="center"><strong>Proposed Type</strong></th>
            <th align="left"><strong>Account Name</strong></th>
            <th align="left"><strong>Case Type</strong></th>
            <th align="left"><strong>Case No.</strong></th>
            <th align="left"><strong>Suit Value</strong></th>
            <th align="left"><strong>Current Date</strong></th>
            <th align="left"><strong>Current Status</strong></th>
            <th align="left"><strong>Next Date</strong></th>
            <th align="left"><strong>Next Status</strong></th>
            <th align="left"><strong>Dealing Officer</strong></th>
            <th align="left"><strong>Court Name</strong></th>
            <th align="left"><strong>Lawyer Name</strong></th>
            <th align="left"><strong>Remarks</strong></th>
        </tr>';
        if (!empty($result)) {
            $sl=0;
            foreach ($result as $key) {
                $sl++;
                $tbody .= '<tr>
                    <td align="center">' . $sl . '</td>
                    <td align="center">' . $key->zone . '</td>
                    <td align="left">' . $key->district . '</td>
                    <td align="left">' . $key->branch_name . '</td>
                    <td align="center">' . $key->proposed_type . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->req_type_name . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="left">' . $key->case_claim_amount . '</td>
                    <td align="left">' . $key->prev_date . '</td>
                    <td align="left">' . $key->case_sts_prev_dt . '</td>
                    <td align="left">' . $key->next_date . '</td>
                    <td align="left">' . $key->present_case_sts . '</td>
                    <td align="left">' . $key->current_plaintiff . '</td>
                    <td align="left">' . $key->court_name . '</td>
                    <td align="left">' . $key->lawyer . '</td>
                    <td align="left"></td>
                    </tr>';
            }
        }
        $tbody .= '</tbody></table>';
        $var = array(
            "csrf_token" => $csrf_token,
            "tbody" => $tbody,
            "thead" => $thead
        );
        echo json_encode($var);
    }
    function get_active_lawyer_details()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $result = $this->User_model->get_active_lawyer_details();
        $str="";
        $str .= '<table style="width: 100%;" class="preview_table2">
        <thead id="details_head">
        <tr>
            <th align="center" rowspan="2"><strong>SL</strong></th>
            <th align="center" rowspan="2"><strong>Name of Lawyer</strong></th>
            <th align="center" colspan="6"><strong>Number of Assigned Cases</strong></th>
            <th align="center" colspan="6"><strong>Number of Disposed off Cases</strong></th>
            <th align="center" colspan="6"><strong>Number of Pending Cases</strong></th>
            <th align="center" rowspan="2"><strong>Disposal Rate (%)</strong></th>
        </tr>
        <tr>
            <th align="center"><strong>N.I Act</strong></th>
            <th align="center"><strong>ARA</strong></th>
            <th align="center"><strong>AR. Ex</strong></th>
            <th align="center"><strong>SC</strong></th>
            <th align="center"><strong>Others</strong></th>
            <th align="center"><strong>Total</strong></th>
            <th align="center"><strong>N.I Act</strong></th>
            <th align="center"><strong>ARA</strong></th>
            <th align="center"><strong>AR. Ex</strong></th>
            <th align="center"><strong>SC</strong></th>
            <th align="center"><strong>Others</strong></th>
            <th align="center"><strong>Total</strong></th>
            <th align="center"><strong>N.I Act</strong></th>
            <th align="center"><strong>ARA</strong></th>
            <th align="center"><strong>AR. Ex</strong></th>
            <th align="center"><strong>SC</strong></th>
            <th align="center"><strong>Others</strong></th>
            <th align="center"><strong>Total</strong></th>
        </tr>';
        if (!empty($result)) {
            $counter=1;
            $total_running = 0;
            $total_pending = 0;
            $total_disposed = 0;
            $rate = 0;
            foreach ($result as $key) {
                $total_pending = $key->total_ni_pending+$key->total_ara_pending+$key->total_ex_pending+$key->total_hc_pending+$key->total_others_pending;
                $total_running = $key->total_ni_live+$key->total_ara_live+$key->total_ex_live+$key->total_hc_live+$key->total_others_live;
                $total_disposed = $key->total_ni_dis+$key->total_ara_dis+$key->total_ex_dis+$key->total_hc_dis+$key->total_others_dis;
                $rate  = ($total_running>0 && $total_disposed>0)?($total_disposed/$total_running)*100:0.00;
                $str .= '<tr>
                    <td align="center">' . $counter. '</td>
                    <td align="center"><a style = "cursor: pointer;" onclick="get_lawyer_contact_details(\''.$key->lawyer_key_id.'\')">' . $key->lawyer_name . '</a></td>
                    <td align="center">' . $key->total_ni_live . '</td>
                    <td align="center">' . $key->total_ara_live . '</td>
                    <td align="center">' . $key->total_ex_live . '</td>
                    <td align="center">' . $key->total_hc_live . '</td>
                    <td align="center">' . $key->total_others_live . '</td>
                    <td align="center">' . $total_running . '</td>
                    <td align="center">' . $key->total_ni_dis . '</td>
                    <td align="center">' . $key->total_ara_dis . '</td>
                    <td align="center">' . $key->total_ex_dis . '</td>
                    <td align="center">' . $key->total_hc_dis . '</td>
                    <td align="center">' . $key->total_others_dis . '</td>
                    <td align="center">' . $total_disposed . '</td>
                    <td align="center">' . $key->total_ni_pending . '</td>
                    <td align="center">' . $key->total_ara_pending . '</td>
                    <td align="center">' . $key->total_ex_pending . '</td>
                    <td align="center">' . $key->total_hc_pending . '</td>
                    <td align="center">' . $key->total_others_pending . '</td>
                    <td align="center">' . $total_pending . '</td>
                    <td align="center">' . number_format($rate,2) . '%</td>
                    </tr>';
                    $counter++;
            }
        }
        $str .= '</tbody></table>';
        $var = array(
            "csrf_token" => $csrf_token,
            "str" => $str
        );
        echo json_encode($var);
    }
    function get_lawyer_contact_details()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $result = $this->db->query("SELECT * FROM ref_lawyer where id='".$_POST['lawyer_id']."' LIMIT 1")->row();
        $str="";
        $str .= '<table style="width: 100%;" class="preview_table2">
        <thead id="details_head">
        <tr>
            <th align="center"><strong>Name of Lawyer</strong></th>
            <th align="center"><strong>Phone</strong></th>
            <th align="center"><strong>Email</strong></th>
        </tr>';
        if (!empty($result)) {
            $str .= '<tr>
                <td align="center">' . $result->name . '</td>
                <td align="center">' . $result->mobile . '</td>
                <td align="center">' . $result->email . '</td>
            </tr>';
        }
        $str .= '</tbody></table>';
        $var = array(
            "csrf_token" => $csrf_token,
            "str" => $str
        );
        echo json_encode($var);
    }
    function get_recovery_details()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $result = $this->User_model->get_recovery_details();
        $str="";
        $str .= '<table style="width: 100%;" class="preview_table2">
        <thead id="details_head">
        <tr>
            <th align="center"><strong>SL</strong></th>
            <th align="center"><strong>AC Number</strong></th>
            <th align="center"><strong>Client Name</strong></th>
            <th align="center"><strong>Case Number</strong></th>
            <th align="center"><strong>Recovery Amount</strong></th>
            <th align="center"><strong>Recovery Date</strong></th>
            <th align="center"><strong>Branch Name(Code)</strong></th>
        </tr>';
        if (!empty($result)) {
            $counter=1;
            $total=0;
            foreach ($result as $key) {
                $total+=$key->amount;
                $str .= '<tr>
                    <td align="center">' . $counter.'</td>
                    <td align="center">' . $key->investment_ac_no.'</td>
                    <td align="center">' . $key->ac_name.'</td>
                    <td align="center">' . $key->case_number.'</td>
                    <td align="center">' . number_format($key->amount,2).'</td>
                    <td align="center">' . $key->recive_date.'</td>
                    <td align="center">' . $key->branch_name_with_code .'</td>
                    </tr>';
                    $counter++;
            }
            $str .= '<tr>
                    <td align="center" colspan="4"><strong>Total</strong></td>
                    <td align="center"><strong>' . number_format($total,2).'</strong></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    </tr>';
        }
        $str .= '</tbody></table>';
        $var = array(
            "csrf_token" => $csrf_token,
            "str" => $str
        );
        echo json_encode($var);
    }
    function case_status_data_xl($operation, $date, $module,$zone,$district,$branch,$loan_segment)
    {

        $str_where = "b.sts=1 AND b.suit_sts=75";

        // Case Status Report

        $maker_array = array("4","6","7","8","9");
        $head_office_array = array("2","3");
        if (in_array($this->session->userdata['ast_user']['user_work_group_id'], $maker_array)) //For Maker
        {
            $where2='';
            $where2 .= " and b.branch_sol='" . $this->session->userdata['ast_user']['user_branch_code'] . "'";
        }
        else if(in_array($this->session->userdata['ast_user']['user_work_group_id'], $head_office_array)) // For HO User
        {
            $str_where .= " and bs.ho_dealing_officer='" . $this->session->userdata['ast_user']['user_id'] . "'";
        }
        
        if ($operation == 'updated_status') {
            $str_where .= " AND date_format(b.last_case_sts_update_dt,'%Y-%m-%d')='" . $this->security->xss_clean($date) . "'";
        } else if ($operation == 'yet_to_fix') {
            $str_where .= " AND b.next_dt_sts=0 AND b.not_available_sts=0 AND b.next_date!='' AND b.case_sts_prev_dt NOT IN(3,15,7,4)";
        } else if ($operation == 'not_available') {
            $str_where .= " AND b.next_dt_sts=0 AND b.not_available_sts=1 AND b.next_date!='' AND b.case_sts_prev_dt NOT IN(3,15,7,4)";
        } else if ($operation == 'pending_status' && $module == 'case_schedule') {
            $str_where .= " AND b.next_date!='' AND b.next_date='" . $this->security->xss_clean($date) . "'";
        } else {
            $str_where .= " AND b.next_date!='' AND b.next_date<='" . $this->security->xss_clean($date) . "'";
        }

        
        if ($zone != '0') {
			$str_where .= " AND b.zone='" . $zone . "'";
		}
		if ($district != '0') {
			$str_where .= " AND b.district='" . $district . "'";
		}
        if ($branch != '0') {
			$str_where .= " AND b.branch_sol='" . $branch . "'";
		}
        if ($loan_segment != '0') {
			$str_where .= " AND b.loan_segment='" . $loan_segment . "'";
		}
        $sql = "SELECT
        b.id,c.name as court_name,b.remarks_next_date,
        cs2.name as case_sts_prev_dt,r.name as zone,b.proposed_type,
        CONCAT(cd.name,'(',cd.pin,')') as current_plaintiff,
        rq.name as req_type_name,
        bs.name as branch_name,
        b.case_claim_amount,
        DATE_FORMAT(b.prev_date,'%d-%b-%y') as prev_date,
        cd.mobile_number as case_deal_officer_phone,
        l.name as lawyer,cs.name as next_case_sts,
        CONCAT(l.mobile,',',l.email) as lawyer_details,
        d.name as district,b.loan_ac,b.ac_name,
        b.case_number,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,'%d-%b-%y'),b.next_date) AS next_date
        FROM suit_filling_info b 
        LEFT OUTER JOIN ref_case_sts cs on(b.case_sts_next_dt=cs.id)
        LEFT OUTER JOIN ref_case_sts cs2 on(b.case_sts_prev_dt=cs2.id)
        LEFT OUTER JOIN ref_district d on(b.district=d.id) 
        LEFT OUTER JOIN ref_zone r on(b.zone=r.id)
        LEFT OUTER JOIN ref_branch_sol bs on(b.branch_sol=bs.code)
        LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id)
        LEFT OUTER JOIN ref_court c on(b.prest_court_name=c.id)
        LEFT OUTER JOIN ref_lawyer l on(b.prest_lawyer_name=l.id)
        LEFT OUTER JOIN users_info cd on(b.case_deal_officer=cd.id)
        WHERE $str_where";
        $query = $this->db->query($sql)->result();



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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);

        $rowNumber = 1;
        if ($operation == 'updated_status') {
            $headings1 = array('Updated Status Report');
        } else if ($operation == 'yet_to_fix') {
            $headings1 = array('Case Next Date Yet To Fix');
        } else {
            $headings1 = array('Pending Update Report');
        }
        if ($module == 'status_data') {
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':P' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
            $rowNumber++;
            $rowNumber++;
            $headings4 = array(
                'SL',
                'Zone',
                'District',
                'Branch',
                'Proposed Type', 
                'Account Name',
                'Case Type',
                'Case No',
                'Suit Value',
                'Next Date',
                'Next Status',
                'Present Date',
                'Present Status',
                'Dealing Officer',
                'Court Name',
                'Lawyer Name'
            );
            $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $sl = 0;
            foreach ($query as $key) {
                $sl++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $sl,
                    $key->zone,
                    $key->district,
                    $key->branch_name,
                    $key->proposed_type,
                    $key->ac_name,
                    $key->req_type_name,
                    $key->case_number,
                    $key->case_claim_amount,
                    $key->next_date,
                    $key->next_case_sts,
                    $key->prev_date,
                    $key->case_sts_prev_dt,
                    $key->current_plaintiff,
                    $key->court_name,
                    $key->lawyer
                ), NULL, 'A' . $rowNumber);

                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':M' . $rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->applyFromArray($styleArray_border);
                // $objPHPExcel->getActiveSheet()->setCellValueExplicit(('A' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':M' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $rowNumber++;
            }
        } else {
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':O' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':O' . $rowNumber)->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':O' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);

            $rowNumber++;

            $rowNumber++;
            $headings4 = array(
                'SL',
                'Zone',
                'District',
                'Branch',
                'Proposed Type', 
                'Account Name',
                'Case Type',
                'Case No',
                'Suit Value',
                'Current Date',
                'Current Status',
                'Next Date',
                'Next Status',
                'Dealing Officer',
                'Court Name',
                'Lawyer Name',
                'Remarks'
            );
            $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':Q' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':Q' . $rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':Q' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':Q' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':Q' . $rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $sl = 0;
            foreach ($query as $key) {
                $sl++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $sl,
                    $key->zone,
                    $key->district,
                    $key->branch_name,
                    $key->proposed_type,
                    $key->ac_name,
                    $key->req_type_name,
                    $key->case_number,
                    $key->case_claim_amount,
                    $key->prev_date,
                    $key->case_sts_prev_dt,
                    $key->next_date,
                    $key->present_case_sts,
                    $key->current_plaintiff,
                    $key->court_name,
                    $key->lawyer
                ), NULL, 'A' . $rowNumber);
                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':Q' . $rowNumber)->applyFromArray($styleArray_border);
                // $objPHPExcel->getActiveSheet()->setCellValueExplicit(('A' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':P' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $rowNumber++;
            }
        }



        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Case Status Report');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="case_status_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
    }
    function pending_delivered_data_xl($operation, $year = NULL, $branch = NULL, $district = NULL, $zone = NULL, $loan_segment = NULL)
    {
        $result = array();
        if ($operation == 'live_case') {
            $result = $this->User_model->get_live_case_data($year, $branch, $district, $zone, $loan_segment);
        }
        if ($operation == 'instru_delivered') {
            $result = $this->User_model->get_cma_data_verified($year, $branch, $district, $zone, $loan_segment);
        }
        if ($operation == 'case_pending') {
            $result = $this->User_model->get_pending_cma_data($year, $branch, $district, $zone, $loan_segment);
        }
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);

        $rowNumber = 1;
        if ($operation == 'live_case') {
            $headings1 = array('Live Case');
        }
        if ($operation == 'instru_delivered') {
            $headings1 = array('Instrument Delivered');
        }
        if ($operation == 'case_pending') {
            $headings1 = array('Case Filing Pending');
        }
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':I' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);

        $rowNumber++;

        $rowNumber++;
        if ($operation == 'live_case') {
            $headings4 = array(
                'SL', 'Proposed Type',
                'Req Type',
                'AC', 'AC Name', 'Zone', 'District', 'Case Number'
            );
            $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $sl = 0;
            if (!empty($result)) {
                foreach ($result as $key) {
                    $sl++;
                    $objPHPExcel->getActiveSheet()->fromArray(array(
                        $key->sl_no,
                        $key->proposed_type,
                        $key->req_type_name,
                        $key->loan_ac,
                        $key->ac_name,
                        $key->zone,
                        $key->district,
                        $key->case_number
                    ), NULL, 'A' . $rowNumber);
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
                    $objPHPExcel->getActiveSheet()->setCellValueExplicit(('D' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $rowNumber++;
                }
            }
        }

        if ($operation == 'instru_delivered' || $operation == 'case_pending') {
            $headings4 = array(
                'SL', 'Proposed Type',
                'Req Type',
                'AC', 'AC Name', 'Borrower Name', 'Zone', 'District'
            );
            $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $sl = 0;
            if (!empty($result)) {
                foreach ($result as $key) {
                    $sl++;
                    $objPHPExcel->getActiveSheet()->fromArray(array(
                        $key->sl_no,
                        $key->proposed_type,
                        $key->req_type_name,
                        $key->loan_ac,
                        $key->ac_name,
                        $key->brrower_name,
                        $key->zone,
                        $key->district
                    ), NULL, 'A' . $rowNumber);
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
                    $objPHPExcel->getActiveSheet()->setCellValueExplicit(('D' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $rowNumber++;
                }
            }
        }




        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Case Report');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="case_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
    }
    function live_disposal_data_xl($operation, $module=NULL, $year = NULL, $branch = NULL, $district = NULL, $zone = NULL, $loan_segment = NULL)
    {

        $result = array();
        if ($operation == 'NI_ACT') {
            $operation = 'NI ACT';
        }
        if ($operation == 'ARA_EX') {
            $operation = 'ARA EX';
        }
        if ($operation == 'N.I_Act') {
            $operation = 'N.I Act';
        }
        if ($operation == 'ni_act') {
            $operation = 'ni act';
        }

        if ($operation == 'Running_Case') {
            $operation = 'Running Case';
        }
        if ($operation == 'Disposed_Case') {
            $operation = 'Disposed Case';
        }
        if ($module == 'live_case') {
            $result = $this->User_model->get_ara_filing_data($operation, $year, $branch, $district, $zone, $loan_segment);
        }
        if ($module == 'disposal_case') {
            $result = $this->User_model->get_ara_filing_data_disposal($operation, $year, $branch, $district, $zone, $loan_segment);
        }
        if ($operation == 'Running Case' || $operation == 'Disposed Case') {
            $result = $this->User_model->get_case_against_bank_filing_disposal_data($operation, $year, $branch, $district, $zone, $loan_segment);
        }
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);

        $rowNumber = 1;
        if ($module == 'live_case') {
            $headings1 = array('Live Case');
        }
        if ($module == 'disposal_case') {
            $headings1 = array('Disposal Case');
        }
        if ($operation == 'Running Case') {
            $headings1 = array('Running Case');
        }
        if ($operation == 'Disposed Case') {
            $headings1 = array('Disposed Case');
        }
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':N' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);

        $rowNumber++;

        $rowNumber++;
        $headings4 = array(
            'Zone',
            'District',
            'Branch', 
            'Proposed Type', 
            'Account Name', 
            'Case Type', 
            'Case Number',
            'Present Date',
            'Present Status',
            'Next Date',
            'Next Case Status',
            'Suit Value',
            'Present Status',
            'Dealing Officer',
            'Court Name',
            'Lawyer Name'
        );
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 0;
        if (!empty($result)) {
            foreach ($result as $key) {
                $sl++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $key->zone,
                    $key->district,
                    $key->branch_name,
                    $key->proposed_type,
                    $key->ac_name,
                    $key->req_type_name,
                    $key->case_number,
                    $key->prev_date,
                    $key->present_status,
                    $key->next_date,
                    $key->case_sts_next_date,
                    $key->case_claim_amount,
                    $key->present_status,
                    $key->case_deal_officer,
                    $key->court_name,
                    $key->lawyer_name,
                ), NULL, 'A' . $rowNumber);
                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':L' . $rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':L' . $rowNumber)->applyFromArray($styleArray_border);
                // $objPHPExcel->getActiveSheet()->setCellValueExplicit(('D' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':L' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $rowNumber++;
            }
        }




        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Live Disposal Case');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="live_disposal_case.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
    }
    function live_disposal_data_xl_hc($operation, $module=NULL, $year = NULL, $branch = NULL, $district = NULL, $zone = NULL, $loan_segment = NULL)
    {
        $result = array();
        if ($operation == 'Running_Case_HC') {
            $operation = 'Running Case HC';
        }
        if ($operation == 'Disposed_Case_HC') {
            $operation = 'Disposed Case HC';
        }
        if ($operation == 'Running Case HC' || $operation == 'Disposed Case HC') {
            $result = $this->User_model->get_HC_filing_disposal_data($operation, $year, $branch, $district, $zone, $loan_segment);
        }
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);

        $rowNumber = 1;
        if ($operation == 'Running Case HC') {
            $headings1 = array('Running Case');
        }
        if ($operation == 'Disposed Case HC') {
            $headings1 = array('Disposed Case');
        }
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':K' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);

        $rowNumber++;

        $rowNumber++;
        $headings4 = array(
            'SL', 
            'Case Type',
            'AC', 
            'AC Name', 
            'Zone', 
            'District', 
            'Branch', 
            'Case Number',
            'Suit Value',
            'Court Type',
            'Lawyer Name'
        );
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 0;
        if (!empty($result)) {
            foreach ($result as $key) {
                $sl++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $sl,
                    $key->req_type_name,
                    $key->loan_ac,
                    $key->ac_name,
                    $key->zone,
                    $key->district,
                    $key->branch_name,
                    $key->case_number,
                    $key->suit_value,
                    $key->hc_division,
                    $key->lawyer_name,
                ), NULL, 'A' . $rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':K' . $rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
        }




        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Live Disposal Case');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="live_disposal_case.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
    }
    function bill_data_xl($operation, $year = NULL, $branch = NULL, $district = NULL, $zone = NULL, $loan_segment = NULL)
    {
        $result = array();
        if ($operation == 'total_bill') {
            $operation = 'Total Bill';
        } else if ($operation == 'court_enter') {
            $operation = 'Court Ent.';
        } else if ($operation == 'staff_conv') {
            $operation = 'Staff Con.';
        } else if ($operation == 'vendor_bill') {
            $operation = 'Vendor Bill';
        } else if ($operation == 'lawyer_bill') {
            $operation = 'Lawyer Bill';
        } else if ($operation == 'court_fee') {
            $operation = 'Court Fees';
        }
        $result = $this->User_model->get_bill_details($operation, $year, $branch, $district, $zone, $loan_segment);
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);

        $rowNumber = 1;
        $objPHPExcel->getActiveSheet()->fromArray(array($operation), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':I' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);

        $rowNumber++;

        $rowNumber++;
        $headings4 = array(
            'loan_ac', 'AC Name',
            'Case Number',
            'Bill Type', 'Vendor Name', 'Purpose',
            'Activities Date', 'Amount', 'Remarks'
        );
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 0;
        if (!empty($result)) {
            $total = 0;
            foreach ($result as $key) {
                $sl++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $key->loan_ac,
                    $key->ac_name,
                    $key->case_number,
                    $key->bill_type,
                    $key->vendor_name,
                    $key->act_name,
                    $key->txrn_dt,
                    $key->amount,
                    $key->expense_remarks
                ), NULL, 'A' . $rowNumber);

                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit(('A' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $rowNumber++;
                $total = $total + $key->amount;
            }
            $objPHPExcel->getActiveSheet()->fromArray(array(
                'Total',
                '',
                '',
                '',
                '',
                '',
                '',
                $total,
                ''
            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':G' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':G' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }




        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($operation);
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="bill_data.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
    }
    function warrent_arrest_data_xl($operation, $year = NULL, $branch = NULL, $district = NULL, $zone = NULL, $loan_segment = NULL)
    {
        $result = array();
        if ($operation == 'pending_warrent') {
            $operation = 'Pending Warrant';
        } else if ($operation == 'warrent_execution') {
            $operation = 'Warrant Execution';
        }
        $result = $this->User_model->get_warrent_details($operation, $year, $branch, $district, $zone, $loan_segment);
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);

        $rowNumber = 1;
        $objPHPExcel->getActiveSheet()->fromArray(array($operation), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':N' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);

        $rowNumber++;

        $rowNumber++;
        $headings4 = array(
            'Zone',
            'District',
            'Branch',
            'AC Name',
            'Case Type',
            'Case No',
            'Suit Value',
            'Date Of Decree',
            'Warrant Memo No',
            'Issue Date',
            'Police Station Name',
            'Fine Amount',
            'Status',
            'Remarks',
        );
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 0;
        if (!empty($result)) {
            foreach ($result as $key) {
                $sl++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $key->zone_name,
                    $key->district_name,
                    $key->branch_name,
                    $key->ac_name,
                    $key->request_type,
                    $key->case_number,
                    $key->case_claim_amount,
                    $key->date_of_decree,
                    $key->memo_no,
                    $key->issue_date,
                    $key->ps_name,
                    $key->fine_amount,
                    $key->final_remarks,
                    $key->remarks,
                ), NULL, 'A' . $rowNumber);

                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->applyFromArray($styleArray_border);
                // $objPHPExcel->getActiveSheet()->setCellValueExplicit(('A' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':N' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $rowNumber++;
            }
        }




        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($operation);
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="warrentarrest.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
    }
    function appeal_bail_data_xl($operation, $year = NULL, $branch = NULL, $district = NULL, $zone = NULL, $loan_segment = NULL)
    {
        $result = array();
        if ($operation == 'bail_money') {
            $operation = 'Bail Money';
        } else if ($operation == 'appeal_money') {
            $operation = 'Appeal Money';
        }
        $result = $this->User_model->get_appeal_bail_money_details($operation, $year, $branch, $district, $zone, $loan_segment);
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);

        $rowNumber = 1;
        $objPHPExcel->getActiveSheet()->fromArray(array($operation), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':I' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);

        $rowNumber++;

        $rowNumber++;
        $headings4 = array(
            'Investment AC', 'AC Name',
            'Case Number',
            'Deposit Amount', 'Appeal Bail Type', 'Deposit Date',
            'Arrrested', 'Zone', 'District'
        );
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 0;
        if (!empty($result)) {
            foreach ($result as $key) {
                $sl++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $key->loan_ac,
                    $key->ac_name,
                    $key->case_number,
                    $key->deposit_amt,
                    $key->appeal_bail_type,
                    $key->deposit_date,
                    $key->arrested,
                    $key->zone,
                    $key->district
                ), NULL, 'A' . $rowNumber);

                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($styleArray_border);
                // $objPHPExcel->getActiveSheet()->setCellValueExplicit(('A' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                // $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':I' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $rowNumber++;
            }
        }




        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($operation);
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="appeal_bail_money.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
    }
    function get_front_deshboard_details()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $operation = $this->input->post('operation_name');
        $tmp = $operation;
        $thead = "";
        $tbody = '';
        $year = ($_POST['year']!='')?$_POST['year']:0;
        $branch = ($_POST['branch']!='')?$_POST['branch']:0;
        $district = ($_POST['district']!='')?$_POST['district']:0;
        $zone = ($_POST['zone']!='')?$_POST['zone']:0;
        $loan_segment = ($_POST['loan_segment']!='')?$_POST['loan_segment']:0;
        if ($operation == 'Running Case' || $operation == 'Disposed Case') //For Live case ara/ni  
        {
            $result = $this->User_model->get_case_against_bank_filing_disposal_data($operation, $year, $branch, $district, $zone, $loan_segment);

            if ($operation == 'Running Case') {
                $operation2 = 'Running_Case';
            }else if ($operation == 'Disposed Case') {
                $operation2 = 'Disposed_Case';
            } else {
                $operation2 = $operation;
            }
            $module = '0';
            $thead .= '<table style="width: 100%;" class="preview_table2">
            <thead id="details_head">
            <tr>
                <th colspan="11" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/live_disposal_data_xl/' . $operation2 . '/' . $module . '/' . $year . '/' . $branch . '/' . $district . '/' . $zone . '/' . $loan_segment . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
            </tr>
            <tr>
                    <th align="left"><strong>SL</strong></th>
                    <th align="left" width="3%"><strong>P</strong></th>
                    <th align="left"><strong>Zone</strong></th>
                    <th align="left"><strong>District</strong></th>
                    <th align="center"><strong>Branch</strong></th>
                    <th align="left"><strong>Proposed Type</strong></th>
                    <th align="left"><strong>AC Name</strong></th>
                    <th align="left"><strong>Case Type</strong></th>
                    <th align="left"><strong>Case No.</strong></th>
                    <th align="left"><strong>Court Name</strong></th>
                    <th align="left"><strong>Lawyer Name</strong></th>
                </tr>';
            if (!empty($result)) {
                $count = 0;
                foreach ($result as $key) {
                    $count++;
                    $tbody .= '<tr>
                    <td align="left">' . $count . '</td>
                    <td align="center"><div style="text-align:center; cursor:pointer" onclick="case_against_bank_details(' . $key->id . ')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>
                    <td align="left">' . $key->zone . '</td>
                    <td align="center">' . $key->district . '</td>
                    <td align="left">' . $key->branch_name . '</td>
                    <td align="left">' . $key->proposed_type . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->req_type_name . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="left">' . $key->court_name . '</td>
                    <td align="left">' . $key->lawyer_name . '</td>
                    </tr>';
                }
            }
            $tbody .= '</tbody></table>';
        }
        if ($operation == 'Running Case HC' || $operation == 'Disposed Case HC') //For Live case ara/ni  
        {
            $result = $this->User_model->get_HC_filing_disposal_data($operation, $year, $branch, $district, $zone, $loan_segment);

            if ($operation == 'Running Case HC') {
                $operation2 = 'Running_Case_HC';
            }else if ($operation == 'Disposed Case HC') {
                $operation2 = 'Disposed_Case_HC';
            } else {
                $operation2 = $operation;
            }
            $module = '0';
            $thead .= '<table style="width: 100%;" class="preview_table2">
            <thead id="details_head">
            <tr>
                <th colspan="12" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/live_disposal_data_xl_hc/' . $operation2 . '/' . $module . '/' . $year . '/' . $branch . '/' . $district . '/' . $zone . '/' . $loan_segment . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
            </tr>
            <tr>
                    <th align="left"><strong>SL</strong></th>
                    <th align="left" width="3%"><strong>P</strong></th>
                    <th align="left"><strong>Case Type</strong></th>
                    <th align="center"><strong>AC</strong></th>
                    <th align="left"><strong>AC Name</strong></th>
                    <th align="left"><strong>Zone</strong></th>
                    <th align="left"><strong>District</strong></th>
                    <th align="left"><strong>Branch</strong></th>
                    <th align="left"><strong>Case Number</strong></th>
                    <th align="left"><strong>Suit Value</strong></th>
                    <th align="left"><strong>Court Type</strong></th>
                    <th align="left"><strong>Lawyer Name</strong></th>
                </tr>';
            if (!empty($result)) {
                $count = 0;
                foreach ($result as $key) {
                    $count++;
                    $tbody .= '<tr>
                    <td align="left">' . $count . '</td>
                    <td align="center"><div style="text-align:center; cursor:pointer" onclick="hc_details(' . $key->id . ')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>

                    <td align="left">' . $key->req_type_name . '</td>
                    <td align="center">' . $key->loan_ac . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->zone . '</td>
                    <td align="left">' . $key->district . '</td>
                    <td align="left">' . $key->branch_name . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="left">' . $key->suit_value . '</td>
                    <td align="left">' . $key->hc_division . '</td>
                    <td align="left">' . $key->lawyer_name . '</td>
                    </tr>';
                }
            }
            $tbody .= '</tbody></table>';
        }
        if ($operation == 'ARA' || $operation == 'NI ACT' || $operation == 'ARA EX' || $operation == 'Others') //For Live case ara/ni  
        {
            $result = $this->User_model->get_ara_filing_data($operation, $year, $branch, $district, $zone, $loan_segment);

            if ($operation == 'NI ACT') {
                $operation2 = 'NI_ACT';
            }else if ($operation == 'ARA EX') {
                $operation2 = 'ARA_EX';
            } else {
                $operation2 = $operation;
            }
            $module = 'live_case';
            $thead .= '<table style="width: 100%;" class="preview_table2">
            <thead id="details_head">
            <tr>
                <th colspan="15" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/live_disposal_data_xl/' . $operation2 . '/' . $module . '/' . $year . '/' . $branch . '/' . $district . '/' . $zone . '/' . $loan_segment . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
            </tr>
            <tr>
                    <th align="left" width="3%"><strong>P</strong></th>
                    <th align="left" width="2%"><strong>SL</strong></th>
                    <th align="left" width="5%"><strong>Zone</strong></th>
                    <th align="left" width="5%"><strong>District</strong></th>
                    <th align="center" width="10%"><strong>Branch</strong></th>
                    <th align="left" width="5%"><strong>Proposed Type</strong></th>
                    <th align="left" width="10%"><strong>AC Name</strong></th>
                    <th align="left" width="10%"><strong>Case Type</strong></th>
                    <th align="left" width="10%"><strong>Case No.</strong></th>
                    <th align="left" width="10%"><strong>Present Date</strong></th>
                    <th align="left" width="10%"><strong>Present Status</strong></th>
                    <th align="left" width="10%"><strong>Next Date</strong></th>
                    <th align="left" width="10%"><strong>Next Case Status</strong></th>
                    <th align="left" width="10%"><strong>Court Name</strong></th>
                    <th align="left" width="10%"><strong>Lawyer Name</strong></th>
                </tr>';
            if (!empty($result)) {
                $count = 0;
                foreach ($result as $key) {
                    $count++;
                    $tbody .= '<tr>
                    <td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $key->id . ',\'pending\',' . $key->cma_id . ')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>
                    <td align="left">' . $count . '</td>
                    <td align="left">' . $key->zone . '</td>
                    <td align="left">' . $key->district . '</td>
                    <td align="left">' . $key->branch_name . '</td>
                    <td align="left">' . $key->proposed_type . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->req_type_name . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="left">' . $key->prev_date . '</td>
                    <td align="left">' . $key->present_status . '</td>
                    <td align="left">' . $key->next_date . '</td>
                    <td align="left">' . $key->case_sts_next_date . '</td>
                    <td align="left">' . $key->court_name . '</td>
                    <td align="left">' . $key->lawyer_name . '</td>
                    </tr>';
                }
            }
            $tbody .= '</tbody></table>';
        }
        if ($operation == 'A.R.A' || $operation == 'N.I Act' || $operation == 'ARA.Ex') //For Live case ara/ni  
        {
            if ($operation == 'ni act') {
                $operation2 = 'ni_act';
            }
            else if ($operation == 'ara ex') {
                $operation2 = 'ara_ex';
            }else if ($operation == 'N.I Act') {
                $operation2 = 'N.I_Act';
            } else {
                $operation2 = $operation;
            }
            $module = 'disposal_case';
            $result = $this->User_model->get_ara_filing_data_disposal($operation, $year, $branch, $district, $zone, $loan_segment);
            $thead .= '<table style="width: 100%;" class="preview_table2">
            <thead id="details_head">
            <tr>
                <th colspan="11" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/live_disposal_data_xl/' . $operation2 . '/' . $module . '/' . $year . '/' . $branch . '/' . $district . '/' . $zone . '/' . $loan_segment . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
            </tr>
            <tr>
                    <th align="left" width="3%"><strong>P</strong></th>
                    <th align="left" width="2%"><strong>SL</strong></th>
                    <th align="left" width="10%"><strong>Zone</strong></th>
                    <th align="left" width="10%"><strong>District</strong></th>
                    <th align="center" width="10%"><strong>Branch</strong></th>
                    <th align="left" width="10%"><strong>Proposed Type</strong></th>
                    <th align="left" width="10%"><strong>AC Name</strong></th>
                    <th align="left" width="10%"><strong>Case Type</strong></th>
                    <th align="left" width="10%"><strong>Case No.</strong></th>
                    <th align="left" width="10%"><strong>Court Name</strong></th>
                    <th align="left" width="15%"><strong>Lawyer Name</strong></th>
                </tr>';
            if (!empty($result)) {
                $count = 0;
                foreach ($result as $key) {
                    $count++;
                    $tbody .= '<tr>
                    <td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $key->id . ',\'pending\',' . $key->cma_id . ')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>
                    <td align="left">' . $count . '</td>
                    <td align="left">' . $key->zone . '</td>
                    <td align="left">' . $key->district . '</td>
                    <td align="left">' . $key->branch_name . '</td>
                    <td align="left">' . $key->proposed_type . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->req_type_name . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="left">' . $key->court_name . '</td>
                    <td align="left">' . $key->lawyer_name . '</td>
                    </tr>';
                }
            }
            $tbody .= '</tbody></table>';
        }
        if ($operation == 'Total Bill' || $operation == 'Court Ent.' || $operation == 'Staff Con.' || $operation == 'Vendor Bill' || $operation == 'Lawyer Bill' || $operation == 'Court Fees') //For Live case ara/ni  
        {
            $result = $this->User_model->get_bill_details($operation, $year, $branch, $district, $zone, $loan_segment);
            if ($operation == 'Total Bill') {
                $operation2 = 'total_bill';
            } else if ($operation == 'Court Ent.') {
                $operation2 = 'court_enter';
            } else if ($operation == 'Staff Con.') {
                $operation2 = 'staff_conv';
            } else if ($operation == 'Vendor Bill') {
                $operation2 = 'vendor_bill';
            } else if ($operation == 'Lawyer Bill') {
                $operation2 = 'lawyer_bill';
            } else if ($operation == 'Court Fees') {
                $operation2 = 'court_fee';
            }
            $thead .= '<table style="width: 100%;" class="preview_table2">
            <thead id="details_head">
            <tr>
                <th colspan="9" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/bill_data_xl/' . $operation2 . '/' . $year . '/' . $branch . '/' . $district . '/' . $zone . '/' . $loan_segment . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
            </tr>
            <tr>
                    <th align="left"><strong>Investment ac</strong></th>
                    <th align="left"><strong>AC Name</strong></th>
                    <th align="left"><strong>Case Number</strong></th>
                    <th align="left"><strong>Bill Type</strong></th>
                    <th align="center"><strong>Vendor Name</strong></th>
                    <th align="left"><strong>Purpose</strong></th>
                    <th align="left"><strong>Activities Date</strong></th>
                    <th align="left"><strong>Amount</strong></th>
                    <th align="left"><strong>Remarks</strong></th>
                </tr>';
            if (!empty($result)) {
                foreach ($result as $key) {
                    $tbody .= '<tr>
                    <td align="center">' . $key->loan_ac . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="center">' . $key->bill_type . '</td>
                    <td align="left">' . $key->vendor_name . '</td>
                    <td align="left">' . $key->act_name . '</td>
                    <td align="left">' . $key->txrn_dt . '</td>
                    <td align="left">' . $key->amount . '</td>
                    <td align="left">' . $key->expense_remarks . '</td>
                    </tr>';
                }
            }
            $tbody .= '</tbody></table>';
        }
        if ($operation == 'Status Update' || $operation == 'Pending Update' || $operation == 'Yet To Fix' || $operation == 'Not Available') //For Live case ara/ni  
        {


            $year=0;
            $branch=0;
            $zone=0;
            $district=0;
            $loan_segment=0;
    
            if ($_POST['year'] != '' && $_POST['year'] != 0) {
                $year=$this->security->xss_clean($_POST['year']);
            }
            if ($_POST['branch'] != '' && $_POST['branch'] != 0) {
                $branch=$this->security->xss_clean($_POST['branch']);
            }
            if ($_POST['zone'] != '' && $_POST['zone'] != 0) {
                $zone=$this->security->xss_clean($_POST['zone']);
            }
            if ($_POST['district'] != '' && $_POST['district'] != 0) {
                $district=$this->security->xss_clean($_POST['district']);
            }
            if ($_POST['loan_segment'] != '') {
                $loan_segment=$this->security->xss_clean($_POST['loan_segment']);
            }
    


            if ($_POST['date'] == '') {
                $date = date("Y-m-d");
            } else {
                $date = date("Y-m-d", strtotime($_POST['date']));
            }
            if ($operation == 'Status Update') {
                $operation2 = "updated_status";
            } else if ($operation == 'Yet To Fix') {
                $operation2 = "yet_to_fix";
            } else if ($operation == 'Not Available') {
                $operation2 = "not_available";
            } else {
                $operation2 = "pending_status";
            }
            $module = "status_data";
            $result = $this->User_model->get_pending_status_data($operation);

            $tmp = $operation;
            $thead .= '<table style="width: 100%;" class="preview_table2">
            <thead id="details_head">
            <tr>
                <th colspan="15" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/case_status_data_xl/' . $operation2 . '/' . $date . '/' . $module .'/'.$zone. '/'. $district.'/'.$branch.'/'.$loan_segment.'" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
            </tr>
            <tr>
                    <th align="left"><strong>SL</strong></th>
                    <th align="left"><strong>P</strong></th>
                    <th align="left"><strong>Zone</strong></th>
                    <th align="left"><strong>District</strong></th>
                    <th align="left"><strong>Branch</strong></th>
                    <th align="center"><strong>Proposed Type</strong></th>
                    <th align="left"><strong>Account Name</strong></th>
                    <th align="left" style="width: 84px;"><strong>Case Type</strong></th>
                    <th align="left"><strong>Case No.</strong></th>
                    <th align="left"><strong>Next Date</strong></th>
                    <th align="left"><strong>Next Status</strong></th>
                    <th align="left"><strong>Present Date</strong></th>
                    <th align="left"><strong>Present Status</strong></th>
                    <th align="left"><strong>Court Name</strong></th>
                    <th align="left"><strong>Lawyer Name</strong></th>
                </tr>';
            if (!empty($result)) {
                $count=0;
                foreach ($result as $key) {
                    $count++;
                    $tbody .= '<tr>
                    <td align="center">' . $count . '</td>
                    <td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $key->id . ',\'pending\',0)" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>

                    <td align="center">' . $key->zone . '</td>
                    <td align="left">' . $key->district . '</td>
                    <td align="left">' . $key->branch_name . '</td>
                    <td align="center">' . $key->proposed_type . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->req_type_name . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="left">' . $key->next_date . '</td>
                    <td align="left">' . $key->next_case_sts . '</td>
                    <td align="left">' . $key->prev_date . '</td>
                    <td align="left">' . $key->case_sts_prev_dt . '</td>
                    <td align="left">' . $key->court_name . '</td>
                    <td align="left">' . $key->lawyer . '</td>
                    </tr>';
                }
            }
            $tbody .= '</tbody></table>';
        }
        if ($operation == 'Pending Warrant' || $operation == 'Warrant Execution') //For Live case ara/ni  
        {
            $result = $this->User_model->get_warrent_details($operation, $year, $branch, $district, $zone, $loan_segment);
            if ($operation == 'Pending Warrant') {
                $operation2 = 'pending_warrent';
            } else if ($operation == 'Warrant Execution') {
                $operation2 = 'warrent_execution';
            }
            $thead .= '<table style="width: 100%;" class="preview_table2">
            <thead id="details_head">
            <tr>
                <th colspan="16" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/warrent_arrest_data_xl/' . $operation2 . '/' . $year . '/' . $branch . '/' . $district . '/' . $zone . '/' . $loan_segment . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
            </tr>
            <tr>
                    <th align="left"><strong>SL</strong></th>
                    <th align="left"><strong>P</strong></th>

                    <th align="left"><strong>Zone</strong></th>
                    <th align="left"><strong>District</strong></th>
                    <th align="left"><strong>Branch</strong></th>
                    <th align="left"><strong>AC Name</strong></th>
                    <th align="left"><strong>Case Type</strong></th>
                    <th align="left"><strong>Case No</strong></th>
                    <th align="left"><strong>Suit Value</strong></th>
                    <th align="left"><strong>Date Of Decree</strong></th>
                    <th align="left"><strong>Warrant Memo No</strong></th>
                    <th align="left"><strong>Issue Date</strong></th>
                    <th align="left"><strong>Police Station Name</strong></th>
                    <th align="left"><strong>Fine Amount</strong></th>
                    <th align="left"><strong>Status</strong></th>
                    <th align="left"><strong>Remarks</strong></th>
                </tr>';
            if (!empty($result)) {
                $count=0;
                foreach ($result as $key) {
                    $count++;
                    $tbody .= '<tr>
                    <td align="center">' . $count . '</td>
                    <td align="center"><div style="text-align:center; cursor:pointer" onclick="warrent_arrest_details(' . $key->id . ')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>
                    <td align="center">' . $key->zone_name . '</td>
                    <td align="left">' . $key->district_name . '</td>
                    <td align="left">' . $key->branch_name . '</td>
                    <td align="center">' . $key->ac_name . '</td>
                    <td align="left">' . $key->request_type . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="left">' . $key->case_claim_amount . '</td>
                    <td align="left">' . $key->date_of_decree . '</td>
                    <td align="left">' . $key->memo_no . '</td>
                    <td align="left">' . $key->issue_date . '</td>
                    <td align="left">' . $key->ps_name . '</td>
                    <td align="left">' . $key->fine_amount . '</td>
                    <td align="left">' . $key->final_remarks . '</td>
                    <td align="left">' . $key->remarks . '</td>
                    </tr>';
                }
            }
            $tbody .= '</tbody></table>';
        }
        if ($operation == 'Bail Money' || $operation == 'Appeal Money') //For Live case ara/ni  
        {
            $result = $this->User_model->get_appeal_bail_money_details($operation, $year, $branch, $district, $zone, $loan_segment);
            if ($operation == 'Bail Money') {
                $operation2 = 'bail_money';
            } else if ($operation == 'Appeal Money') {
                $operation2 = 'appeal_money';
            }
            $thead .= '<table style="width: 100%;" class="preview_table2">
            <thead id="details_head">
            <tr>
                <th colspan="10" align="center"><a id="inXLadfc" style="text-align:center;cursor:pointer;text-decoration:none" href="' . base_url() . 'index.php/home/appeal_bail_data_xl/' . $operation2 . '/' . $year . '/' . $branch . '/' . $district . '/' . $zone . '/' . $loan_segment . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/icon_xls.gif"></a></th>
            </tr>
            <tr>
                    <th align="left"><strong>SL</strong></th>
                    <th align="left"><strong>Investment AC</strong></th>
                    <th align="left"><strong>AC Name</strong></th>
                    <th align="left"><strong>Case Number</strong></th>
                    <th align="center"><strong>Deposit Amount</strong></th>
                    <th align="left"><strong>Appeal Bail Type</strong></th>
                    <th align="left"><strong>Deposit Date</strong></th>
                    <th align="left"><strong>Arrrested</strong></th>
                    <th align="left"><strong>Zone</strong></th>
                    <th align="left"><strong>District</strong></th>
                </tr>';
            if (!empty($result)) {
                $count=0;
                foreach ($result as $key) {
                    $count++;
                    $tbody .= '<tr>
                    <td align="center">' . $count . '</td>
                    <td align="center">' . $key->loan_ac . '</td>
                    <td align="left">' . $key->ac_name . '</td>
                    <td align="left">' . $key->case_number . '</td>
                    <td align="center">' . $key->deposit_amt . '</td>
                    <td align="left">' . $key->appeal_bail_type . '</td>
                    <td align="left">' . $key->deposit_date . '</td>
                    <td align="left">' . $key->arrested . '</td>
                    <td align="left">' . $key->zone . '</td>
                    <td align="left">' . $key->district . '</td>
                    </tr>';
                }
            }
            $tbody .= '</tbody></table>';
        }
        $var = array(
            "tbody" => $tbody,
            "thead" => $thead,
            "csrf_token" => $csrf_token,
            'tmp' => $tmp
        );
        echo json_encode($var);
    }
    function upload_by_ajax($module_name, $data_field_name)
    {
        $this->load->helper('form');
        $csrf_token = $this->security->get_csrf_hash();
        $destination_path = getcwd() . DIRECTORY_SEPARATOR;

        $result = 0;
        $size1 = basename($_FILES['myfile']['size']);
        $size = $size1 / 1048576;
        $filename = stripslashes($_FILES['myfile']['name']);
        $i = strrpos($filename, ".");
        $l = strlen($filename) - $i;
        $extension = substr($filename, $i + 1, $l);
        $extension = strtolower($extension);
        $file_name_new = $module_name . '_' . $data_field_name . '_' . $this->session->userdata['ast_user']['user_id'] . '_' . time() . '.' . $extension;
        //$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
        $target_path = $destination_path . '/temp_upload_file/' . $file_name_new;
        //$this->load->model('archivedoc_model','',TRUE);   
        $data = array(
            'Session_Id'   => $this->session->userdata['ast_user']['user_id'],
            'module_name'   => $module_name,
            'data_field_name'   => $data_field_name,
            'Orginal_file_name'   => basename($_FILES['myfile']['name']),
            'New_file_name'   => $file_name_new,
            'file_size'   => round($size, 3),
            'file_type' => basename($_FILES['myfile']['type'])
        );
        $str = $this->db->insert_string('temp_upload_file', $data);

        if (@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
            $result = 1;
            $status1 = $this->db->query($str);
        }
        $Message = 'OK';
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['result'] = $result;
        echo json_encode($var);
    }
    function ajaxloadfile($sessionid = NULL, $module_name = NULL, $data_field_name = NULL)
    {
        $csrf_token = $this->security->get_csrf_hash();
        $this->load->model('Common_model', '', TRUE);
        $res = $this->Common_model->ajaxloadfile($sessionid, $module_name, $data_field_name);
        $close = "";
        $s = '<table cellspacing="0" cellpadding="0" border="0" style="width: 100%;" class="grid"><thead>
            <tr><td nowrap="" class="gridColumn" style="padding: 1px 5px;">Name</td>
            <td nowrap="" class="gridColumn" style="padding: 1px 5px;">Type</td>
            <td nowrap="" class="gridColumn" style="text-align: right; padding: 1px 5px;">Size</td>
            <td nowrap="" class="gridColumn" style="text-align: right; padding: 1px 5px;">Remove</td></tr></thead>
            <tbody>';
        $c = 1;
        foreach ($res as $row) {
            $close .= '<a href="' . base_url() . 'temp_upload_file/' . $row->New_file_name . '" target="_blank"><img height="16" width="16" src="' . base_url() . 'old_assets/images/print-preview.png" style="vertical-align: middle; margin-right: 2px;"></a>';
            $s .= '<tr title="' . $row->Orginal_file_name . '">
            <td nowrap="" class="gridCell" style="border-top: 1px solid white; border-bottom: 1px solid white; border-left: 1px solid white;"><span><a href="' . base_url() . 'temp_upload_file/' . $row->New_file_name . '" target="_blank"><img height="16" width="16" src="' . base_url() . 'old_assets/images/print-preview.png" style="vertical-align: middle; margin-right: 2px;"></a><span style="vertical-align: middle;">' . $row->Orginal_file_name . '</span></span></td>
            <td nowrap="" class="gridCell" style="border-top: 1px solid white; border-bottom: 1px solid white;"><span>' . $row->file_type . '</span></td>
            <td nowrap="" class="gridCell" style="text-align: right; border-top: 1px solid white; border-bottom: 1px solid white; border-right: 1px solid white;"><span>' . $row->file_size . ' MB</span></td>
            <td nowrap="" class="gridCell" style="text-align: right; border-top: 1px solid white; border-bottom: 1px solid white; border-right: 1px solid white;"><span><img height="16" style="cursor:pointer" onClick="remove_file(' . $row->Id . ',\'' . $row->New_file_name . '\');" width="16" src="' . base_url() . 'images/reportsDelete.gif" style="vertical-align: middle; margin-right: 2px;"></span></td>
            </tr>';
            $c++;
        }
        if (count($res) == 0) {
            $s .= '<tr><td nowrap="" class="gridCell" colspan="4"  style="border-top: 1px solid white; border-bottom: 1px solid white; border-left: 1px solid white;">Empty</td>
            </tr>';
        }
        $s .= '</tbody></table>';
        echo $close . "####" . $s . "####" . count($res) . "####" . $csrf_token;
    }
    function remove_file($Id = NULL, $filename = NULL)
    {
        $csrf_token = $this->security->get_csrf_hash();
        $this->load->model('Common_model', '', TRUE);
        $res = $this->Common_model->remove_file($Id);
        $result = 3;

        $path = "./temp_upload_file/$filename";
        unlink($path);
        echo $result . "####" . $csrf_token;
    }
    function make_xl_legal_cost()
    {

        $result = array();
        $str_where2 = "1";
        $str_where3 = "1";
        //LEFT OUTER JOIN ref_paper_bill_activities as pa on (b.vendor_type=2 AND b.activities_id=pa.id AND b.main_table_name='expenses')
        $str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0";
        $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and (b.req_type=1 or b.req_type=3 or b.req_type=4) AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))
            LEFT OUTER JOIN ref_staff_conv_activities as sc on (b.vendor_type=3 AND b.activities_id=sc.id)
            LEFT OUTER JOIN ref_court_entertainment_activities as ce on (b.vendor_type=5 AND b.activities_id=ce.id)
            LEFT OUTER JOIN ref_others_cost_activities as oa on (b.vendor_type=6 AND b.activities_id=oa.id AND b.main_table_name='expenses')
            LEFT OUTER JOIN court_entertainment_data v1 on (b.vendor_type=5 AND v1.id=b.main_table_id AND b.main_table_name='court_entertainment_data')
            LEFT OUTER JOIN users_info as v2 on (b.vendor_id=v2.id and b.vendor_type=3)
            LEFT OUTER JOIN ref_paper_vendor as v3 on (b.vendor_id=v3.id and b.vendor_type=2)
            LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
            LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
        $select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=2,v3.name,IF(b.vendor_type=3,v2.name,IF(b.vendor_type=4,v5.name,IF(vendor_type=5,v1.staff_pin,b.vendor_name))))) as vendor_name,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.vendor_type=3,sc.name,IF(b.vendor_type=5,ce.name,IF(b.vendor_type=6,oa.name,IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name)))))))))) as act_name,IF(b.vendor_type=1,'Lawyer Bill',IF(b.vendor_type=2,'Paper Bill',IF(b.vendor_type=3,'Staff Conveyence',IF(b.vendor_type=4,'Court Fee',IF(b.vendor_type=5,'Court Entertainment','Others Bill'))))) as bill_type";
        if (trim($this->input->post('legal_cost_proposed_type')) != '') {
            if (trim($this->input->post('legal_cost_proposed_type')) == 'Investment') {
                $str_where .= " AND b.loan_ac='" . trim($this->input->post('legal_cost_loan_ac')) . "'";
                $str_where2 .= " AND a.loan_ac='" . trim($this->input->post('legal_cost_loan_ac')) . "'";
                $str_where3 .= " AND c.loan_ac='" . trim($this->input->post('legal_cost_loan_ac')) . "'";
            } else {
                $str_where .= " AND b.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('legal_cost_hidden_loan_ac')) . "'";
                $str_where2 .= " AND a.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('legal_cost_hidden_loan_ac')) . "'";
                $str_where3 .= " AND c.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('legal_cost_hidden_loan_ac')) . "'";
            }
        }
        if (trim($this->input->post('legal_cost_req_type')) != '') {
            $str_where .= " AND b.req_type=" . $this->db->escape(trim($this->input->post('legal_cost_req_type')));
            $str_where2 .= " AND a.req_type=" . $this->db->escape(trim($this->input->post('legal_cost_req_type')));
            $str_where3 .= " AND c.req_type=" . $this->db->escape(trim($this->input->post('req_type')));
        }
        $sql = "SELECT 
                a.legal_cost as amount,rq.name as req_type_name,'' as expense_remarks,a.loan_ac,a.ac_name,a.case_number,d2.name as district,DATE_FORMAT(dm.e_dt,'%d-%b-%Y') as txrn_dt,'' AS vendor_name,a.activities as act_name,'Migrated Cost' as bill_type
                FROM legal_cost a
                LEFT OUTER JOIN ref_district d2 on(a.district=d2.id) 
                LEFT OUTER JOIN ref_req_type rq on(a.req_type=rq.id) 
                LEFT OUTER JOIN data_migration_history dm on(a.migration_id=dm.id) 
                WHERE $str_where2
                UNION ALL
                SELECT
                b.amount,rq.name as req_type_name,b.expense_remarks,b.loan_ac,b.ac_name,IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,d.name as district,DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,$select
                FROM cost_details b
                $join
                LEFT OUTER JOIN ref_district d on(b.district=d.id) 
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                WHERE $str_where
                UNION ALL
                SELECT
                c.amount,rq.name as req_type_name,c.expense_remarks,c.loan_ac,c.ac_name,'1st Legal Notice' AS case_number,d.name as district,DATE_FORMAT(c.txrn_dt,'%d-%b-%Y') as txrn_dt,l.name AS vendor_name,c.description as act_name,'Lawyer Bill' as bill_type
                FROM legal_notice_cost_details c
                LEFT OUTER JOIN ref_district d on(c.district=d.id) 
                LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.id) 
                LEFT OUTER JOIN ref_lawyer l on(c.vendor_id=l.id) 
                WHERE $str_where3";
        $q = $this->db->query($sql);
        $result = $q->result();
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);

        $rowNumber = 1;
        $headings1 = array('Legal Cost');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':H' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);

        $rowNumber++;

        $headings4 = array(
            'Investment Ac', 'Case Type',
            'AC Name', 'Case Number', 'Vendor Name', 'Activities',
            'Activities Date', 'Amount'
        );
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F28A8C')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 0;
        $total = 0;
        if (!empty($result)) {
            foreach ($result as $key) {
                $sl++;
                $total = $total + $key->amount;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $key->loan_ac,
                    $key->req_type_name,
                    $key->ac_name,
                    $key->case_number,
                    $key->vendor_name,
                    $key->act_name,
                    $key->txrn_dt,
                    $key->amount
                ), NULL, 'A' . $rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit(('A' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $rowNumber++;
            }

            $objPHPExcel->getActiveSheet()->fromArray(array('Total', '', '', '', '', '', '', $total), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':G' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':H' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }




        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Total Legal Cost');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="legal_cost.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
    }
    function ajax_login($attempt)
    {
        if (count($_POST) <= 0) {
            redirect("/home/index/");
        }

        $user_id_post = $this->security->xss_clean($this->input->post('user_id'));
        $user_password = $this->security->xss_clean($this->input->post('user_password'));
        $data['client'] = $this->User_model->login($user_id_post, $this
            ->User_model
            ->encrypt($user_password));

        if (!empty($data['client'])) {

            $count_IP = explode(".", $this->input->ip_address());

            if ($data['client']->lock_status == 1) {
                redirect('/home/index/405/' . $this->input->post('msgArea'));
                exit();
            } else if ($data['client']->block_status == 1) {
                redirect('/home/index/406/' . $this->input->post('msgArea'));
                exit();
            } else if ($data['client']->password_expiry_date < date('Y-m-d')) {
                /*redirect('/home/index/407/'.$this->input->post('msgArea'));
			  exit();*/

                $expiry = 2;
            }

            if ($data['client']->password_change_status == 0  || $expiry == 2) {

                $session_data = array(
                    'user_id' => $data['client']->id,
                    'user_full_id' => $data['client']->user_id,
                    'login_status' => true,
                    'sessionId' => $this->session->userdata('sessionId')
                );
                $this->session->set_userdata('change_pass', $session_data);

                redirect('/home/change_pass/1/1/' . $expiry);
            }

            $session_data = array(
                'user_id' => $data['client']->id,
                'user_name' => $data['client']->name,
                'mobile_number' => $data['client']->mobile_number,
                'bank_ac' => $data['client']->bank_ac,
                'functional_designation_id' => $data['client']->functional_designation_id,
                'group_name' => $data['client']->user_group,
                'email' => $data['client']->email_address,
                // 'branch_name' => $data['client']->branch_name,

                'branch' => $data['client']->branch,
                'branch_code' => $data['client']->branch_code,
                'branch_name' => $data['client']->branch,
                'branch_name_details' => $data['client']->branch_name_details,
                'zone_name' => $data['client']->zone_name,
                'zone' => $data['client']->zone,
                'recovery_makers' => $data['client']->recovery_makers,
                'district' => $data['client']->district,
                'unit_office' => $data['client']->unit_office,
                'unit_office_name' => $data['client']->unit_office_name,
                'user_designation' => $data['client']->dename,
                'user_full_id' => $data['client']->user_id,
                'user_work_group_id' => $data['client']->user_group_id,
                'user_branch_code' => $data['client']->branch_code,
                'user_department_id' => $data['client']->department_id,
                'dept_name' => $data['client']->dept_name,
                'user_system_admin_sts' => $data['client']->admin_status,
                'SESSION_idle_time' => $data['client']->SESSION_idle_time,
                'login_status' => true,
                'last_login_time' => date("Y-m-d H:i:s")
                // 'sessionId' => $this->session->userdata('session_id')
            );

         

            //$uniqueId = uniqid($this->input->ip_address(), TRUE);
            //$this->session->set_userdata("sessionId", md5($uniqueId));

            // $this->session->sess_expiration = round($data['client']->SESSION_idle_time * 60);
            $this->session->set_userdata('ast_user', $session_data);

            //  echo '<pre>'; print_r($session_data); exit;
            if ($data['client']->password_change_status == 1 && $expiry == 0) {
                redirect('/home/log_success');
            }
            //redirect('/home/log_success');

            //}else{
            $attempt = $attempt + 1;
            if ($attempt >= 2) {
                $data_wrong = $this->User_model->get_user_actual_id($user_id_post);
                if (is_object($data_wrong)) {
                    $sql = ("UPDATE users_info set lock_status = '1' where id = '" . $data_wrong->id . "' and ID<>1 ");
                    $query = $this->db->query($sql);


                    $data2 = $this->User_model->user_activities(54, '', $data_wrong->id, 'users_info', 'Wrong Password Lock', '', $data_wrong->id, $user_id_post);
                }
            }
            redirect('/home/index/407/' . $user_id_post . '/' . $attempt);
            exit();
            // }
        } else {
            $data_wrong = $this->User_model->get_user_actual_id($user_id_post);
            if (empty($data_wrong)) {
                redirect('/home/index/404/' . $user_id_post);
                exit();
            }

            if ($data_wrong->lock_status == 1) {
                redirect('/home/index/405/' . $user_id_post);
                exit();
            } else if ($data_wrong->block_status == 1) {
                redirect('/home/index/406/' . $user_id_post);
                exit();
            } else if ($data_wrong->password_expiry_dates < date('Y-m-d')) {
                redirect('/home/index/407/' . $user_id_post);
                exit();
            }

            $attempt = $attempt + 1;
            if ($attempt >= 2) {
                if (is_object($data_wrong)) {
                    $sql = ("UPDATE users_info set lock_status = '1' where id = '" . $data_wrong->id . "' and id<>1 ");
                    $query = $this->db->query($sql);

                    $data2 = $this->User_model->user_activities(54, '', $data_wrong->id, 'users_info', 'Wrong Password Lock', '', $data_wrong->id, $user_id_post);
                }
            }
            redirect('/home/index/404/' . $this->input->post('user_id') . '/' . $attempt);
        }
    }

    function log_success($menu_group = 1, $menu_cat = NULL)
    {
        //echo 1;exit;
        $ip = $this->input->ip_address();

        if ($ip == '0.0.0.0') {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        if ($this->session->userdata['ast_user']['login_status']) {
            $ip = $this->input->ip_address();

            if ($ip == '0.0.0.0') {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $sql = $this->db->query("UPDATE user_log_history SET logout_status = 1 WHERE user_id = '" . $this->session->userdata['ast_user']['user_id'] . "' AND logout_status = 0 ORDER BY id DESC LIMIT 1");

            $idata = array(
                "user_id" => $this->session->userdata['ast_user']['user_id'],
                "ip_address" => $ip,
                "login_datetime" => date("Y-m-d H:i:s"),
                "last_activities" => date("Y-m-d H:i:s"),
            );

            $this->db->insert('user_log_history', $idata);

            redirect("/home/home_wc/1/1/32");
        } else {
            redirect("/home/index/");
        }
    }

    function home_wc($menu_group = 1, $menu_cat = NULL, $status_msg = NULL)
    {

        if ($this->session->userdata['ast_user']['login_status']) {

            $arr_links = $this->User_model->check_user_rights();
            // print_r($arr_links);
            $data = array(
                'arr_links' => $arr_links,
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'status_msg' => $status_msg,
                'case_type' => $this->user_model->get_parameter_data('ref_case_type', 'id', 'data_status = 1'),
                'zone' => $this->user_model->get_parameter_data('ref_zone', 'id', 'data_status = 1 '),
                'req_type' => $this->user_model->get_parameter_data('ref_req_type', 'id', 'data_status = 1 AND id in(1,2,3)'),
                'district' => $this->user_model->get_parameter_data('ref_district', 'id', 'data_status = 1'),
                'branch_sol' => $this->user_model->get_parameter_data('ref_branch_sol', 'id', 'data_status = 1'),
                'loan_segment' => $this->User_model->get_parameter_data('ref_loan_segment', 'name', 'data_status = 1'),
                'pages' => 'home/pages/grid'
            );

            $this->load->view('grid_layout', $data);
        } else {
            redirect("/home/index/");
        }
    }


    function get_report()
    {
        $this
            ->load
            ->dbutil();
        $this
            ->load
            ->helper('file');
        $report = $this
            ->User_model
            ->getCSV();
        $delimiter = ",";
        $newline = "\r\n";
        $new_report = $this
            ->dbutil
            ->csv_from_result($report, $delimiter, $newline);
        write_file($this->file_path . '/csv_file.csv', $new_report);
        $this
            ->load
            ->helper('download');
        $data = file_get_contents($this->file_path . '/csv_file.csv');
        $name = 'name-' . date('d-m-Y') . '.csv';
        force_download($name, $data);
    }


    function detail($id = NULL, $type = NULL, $name = NULL)
    {
        $result = array();
        if ($type == 'Petty') {
            $result = $this
                ->User_model
                ->get_pettycash_detail($id);
        } else if ($type == 'all' || $type == 'halt' || $type == 'rtn' || $type == 'disburse') {
            $result = $this
                ->User_model
                ->get_detail_data($id, $type);
        } else {
            $result = $this
                ->User_model
                ->get_summary_detail_data($id, $type, $name);
        }
        if (isset($name)) {
            if ($name == 'ALL') {
                $name = 'Summary';
            } else {
                $name = $name;
            }
        }
        $data = array(
            'name' => isset($name) ? $name : "",
            'id' => isset($id) ? $id : "",
            'petty_service' => $this
                ->User_model
                ->get_petty_service($id),
            'type' => isset($type) ? $type : "",
            'results' => $result,
            'pages' => 'home/pages/details'
        );
        $this
            ->load
            ->view('home/form_layout', $data);
    }



    function change_pass($menu_group = 1, $menu_cat = NULL, $alert = NULL)
    {
        if ($this->session->userdata['change_pass']['login_status']) {
            $data = array(
                'option' => '',
                'alert' => $alert,
                'sys_config' => $this
                    ->User_info_model
                    ->upr_config_row()
            );

            $this
                ->load
                ->view('pass_word_view', $data);
        } else {
            redirect("/home/index/");
        }
    }
    function reset_pass($menu_group = 1, $menu_cat = NULL)
    {
        $data = array(
            'option' => '',
            'sys_config' => $this
                ->User_info_model
                ->upr_config_row()
        );

        // echo '<pre>'; print_r($data);
        $this
            ->load
            ->view('reset_password_view', $data);
    }

    function reset_ajax_login()
    {
        $email = $this->security->xss_clean($this
            ->input
            ->post('email'));
        $b = '';
        $mm = '';
        $d = $this->User_info_model->reset_userid_check($email);

        if (
            $this
            ->User_info_model
            ->reset_userid_check($email) > 0
        ) {

            $str = "Select id,email_address,user_id from users_info where email_address='" . $email . "'
				";

            $query = $this
                ->db
                ->query($str)->row();
            if ($query->email_address != $email) {
                $b = 2;
            } else {

                $ranStr = $query->user_id . date("Ymdhis");
                $ranStr2 = $this->User_model->encrypt($ranStr);

                $start = date('Y-m-d H:i:s');
                $expiry_time = date('Y-m-d H:i:s', strtotime('+20 minutes', strtotime($start)));


                $this->db->query("Update users_info set random_str='" . $ranStr2 . "', expiry_link='" . $expiry_time . "' where id=" . $query->id);
                $m = $this->sendemail_user_link($ranStr, $expiry_time, $email);

                $data2 = $this
                    ->User_model
                    ->user_activities(47, '', $query->id, 'users_info', 'Reset Password', '', $query->id, $query->user_id);

                if ($m == 'Sent') {
                    $b = 1;
                    $mm = $m;
                } else {
                    $b = 3;
                    $mm = $m;
                }
            }
        } else {
            $b = 0;
        }
        // echo $b;
        if ($b == 0) {
            $msg = "User ID does not exits";
        } else if ($b == 1) {
            $msg = "OK";
        } else if ($b == 2) {
            $msg = "Email is not valid for this User ID";
        } else {
            $msg = 'Email Not Sent ' . $mm;
        }
        // $msg .=$m;
        $jTableResult = array();
        $jTableResult['Message'] = $msg;
        $jTableResult['csrf_token'] = $this->security->get_csrf_hash();
        echo json_encode($jTableResult);
    }

    function sendemail_user_link($ranStr, $expiry_time, $to_mail)
    {
        $msg = '';
        $msg .= '<a href="' . base_url() . 'home/forget_pass/' . $ranStr . '">Reset your password </a> and follow the on-screen instructions. This email can be ignored in case you didn\'t request a password reset, the link is only available for a short time.';

        $msg .= '-Thank You.';
        $from_email = 'rafiya@mmtvbd.com'; // address of email receiver
        $from_name = 'AIBL LMS:Litigation Management System'; // address of email receiver
        $to = $to_mail; // address of email receiver
        $subject = 'Password Recovery ';
        $cc = '';
        // if($number>0){
        $ch = $this
            ->User_model
            ->send_email($from_email, $from_name, $to, $cc, $subject, $msg);
        // }
        // echo $ch;
        return $ch;
    }
    function forget_pass($ranStr)
    {

        $ranStr2 = $this->User_model->encrypt($ranStr);
        $this->db
            ->select("id,user_id,expiry_link", FALSE)
            ->from('users_info')
            ->where("random_str=" . $this->db->escape($ranStr2) . " ", NULL, FALSE);
        $query = $this->db->get();
        //$query=$this->db->query("Select id,user_id,expiry_link from users_info where random_str='".$ranStr2."'");
        $num_row = $query->num_rows();
        $row = $query->row();
        //$d1 = new DateTime('2008-08-03 14:52:10')
        $dateTime = date('Y-m-d H:i:s');
        if ($num_row > 0) {
            if (strtotime($row->expiry_link) > strtotime($dateTime)) {
                $data = array(
                    'option' => '',
                    'ranStr' => $ranStr,

                    'sys_config' => $this
                        ->User_info_model
                        ->upr_config_row()
                );

                // echo '<pre>'; print_r($data);
                $this
                    ->load
                    ->view('forget_pass_word_view', $data);
            } else {
                echo '<br/><br/><br/>Your Time is expired. To reset your password again, please go to the link: <br/>
				<a href="' . base_url() . 'home/reset_pass/1/1">' . base_url() . '</a>';
            }
        } else {
            echo '<br/><br/><br/>Not Authenticated. To reset your password, please go to the link: <br/>
				<a href="' . base_url() . 'home/reset_pass/1/1">' . base_url() . '</a>';
            echo "";
        }
    }
    function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function sendemail_user($to_mail, $pass)
    {
        $msg = '';
        // $s=$this->db->query("SELECT name,pass from usr_users where employee_ID='".$user_id."'")->row();
        $q = $this
            ->db
            ->query("SELECT user_id,name,password_log from users_info where email_address='" . $to_mail . "' ")->row();
        // $number=$q->num_r
        $msg .= 'Dear Concern,
	   			<span style="float:right">Date: "' . date('d M Y') . '" </span>  <br/><br/>
                 It appears that you have requested a password reset at LMS application.<br/><br/>
                 If you didn\'t request this please ignore this email.<br/><br/>
To reset your password, please use the following credential:<br/><br/>

User ID:' . $q->user_id . '<br/>
Password:' . $pass . '<br/><br/>

After login with this credential, system will force you to change the password.<br/><br/>';

        $msg .= "Click here <a href='" . base_url() . "'>" . base_url() . "</a> to login.<br/><br/>
      
		This is a system generated email, no need to reply.<br/><br/>  
		Thanks";
        $from_email = ''; // address of email receiver
        $from_name = 'AIBL LMS:Litigation Management System'; // address of email receiver
        $to = $to_mail; // address of email receiver
        $subject = 'Password Recovery ';
        $cc = '';
        // if($number>0){
        $ch = $this
            ->User_model
            ->send_email($from_email, $from_name, $to, $cc, $subject, $msg);
        // }
        // echo $ch;
        return $ch;
    }
    function getNextId2($table_name, $id)
    {

        $sql = "SELECT MAX(id) AS NEXTID FROM " . $table_name . " WHERE change_by=" . $id;
        $query = $this
            ->db
            ->query($sql)->row();
        return $query->NEXTID;
    }
    function getNextId($table_name)
    {

        $sql = "SELECT MAX(id) AS NEXTID FROM " . $table_name . " WHERE change_by=" . $this
            ->session
            ->userdata['ast_user']['user_id'];
        $query = $this
            ->db
            ->query($sql)->row();
        return $query->NEXTID;
    }

    function old_pass_check()
    {
        $user_id = $this->session->userdata['change_pass']['user_id'];
        $pass = $this->security->xss_clean($this->input->post('val'));
        $pass2 = $this->User_model->encrypt($pass);

        $b = $this->User_model->old_pass_check($user_id, $pass2);

        $jTableResult = array();
        $jTableResult['Status'] = $b > 0 ? "OK" : "Internal Server Error";

        echo json_encode($jTableResult);
    }

    function change_ajax_login($alert = 0)
    {
        if ($this->session->userdata['change_pass']['login_status']) {
            $old_pass = $this->security->xss_clean($this->input->post('msgArea'));
            $old_pass2 = $this->User_model->encrypt($old_pass);

            $pass = $this->security->xss_clean($this->input->post('pass'));
            $pass2 = $this->User_model->encrypt($pass);

            if (
                $this
                ->User_info_model
                ->old_pass_check($this
                    ->session
                    ->userdata['change_pass']['user_id'], $old_pass2) > 0
            ) {

                $b = $this->immediate_pervious_4_password($this->session->userdata['change_pass']['user_id'], $pass2);
                if ($b != 0) {
                    $msg = "System must not allow users to reuse immediate pervious 4 passwords.";
                } else {
                    $sql = 'INSERT INTO user_password_change_history (user_id,change_by,change_datetime,password)  ';
                    $sql .= "VALUES ('" . $this->session->userdata['change_pass']['user_id'] . "','" . $this->session->userdata['change_pass']['user_id'] . "','" . date("Y-m-d H:i:s") . "','" . $pass2 . "') ";
                    $query = $this
                        ->db
                        ->query($sql);
                    $msg_log = 'default password';
                    if ($alert == 2) {
                        $msg_log = 'password expired';
                    }
                    $data2 = $this->User_model->user_activities(52, '', $this->session->userdata['change_pass']['user_id'], 'users_info', 'Change Password (' . $msg_log . ')', '', $this->session->userdata['change_pass']['user_id'], $this->session->userdata['change_pass']['user_full_id']);
                    $sys_config = $this
                        ->User_info_model
                        ->upr_config_row();
                    $data = array(
                        'password_change_status' => '1',
                        'password_log' => $pass2,
                        'password_expiry_date' => $sys_config->expiry_dt,
                        'password_change_datetime' => date("Y-m-d H:i:s")
                    );

                    $this->db->where('id', $this->session->userdata['change_pass']['user_id']);
                    $this->db->update('users_info', $data);

                    $msg = "OK";
                    $this->session->sess_destroy();
                }
            } else {
                $msg = "Wrong Old Password";
            }


            $jTableResult = array();
            $jTableResult['Message'] = $msg;
            $jTableResult['csrf_token'] = $this->security->get_csrf_hash();
            echo json_encode($jTableResult);
        } else {
            redirect("/home/index/");
        }
    }

    function immediate_pervious_4_password($id, $pass2)
    {
        $str = "select * from user_password_change_history where user_id=" . $this->db->escape($id) . " order by change_datetime DESC LIMIT 4 ";

        $query = $this
            ->db
            ->query($str);

        $count = 0;
        foreach ($query->result() as $row) {

            if ($row->password == $pass2) {
                $count++;
            }
        }

        return $count;
    }

    function change_forget_pass($ranStr)
    {
        $ranStr2 = $this->User_model->encrypt($ranStr);
        $this->db
            ->select("id,user_id,expiry_link", FALSE)
            ->from('users_info')
            ->where("random_str=" . $this->db->escape($ranStr2) . " ", NULL, FALSE);
        $query = $this->db->get();
        //$query=$this->db->query("Select id,user_id,expiry_link from users_info where random_str='".$ranStr2."'");
        $num_row = $query->num_rows();
        $row = $query->row();
        if ($num_row > 0) {
            $pass = $this->security->xss_clean($this->input->post('pass'));
            $pass2 = $this->User_model->encrypt($pass);
            $b = $this->immediate_pervious_4_password($row->id, $pass2);
            if ($b != 0) {
                $msg = "System must not allow users to reuse immediate pervious 4 passwords.";
            } else {

                $sql = 'INSERT INTO user_password_change_history (user_id,change_by,change_datetime,password)  ';
                $sql .= "VALUES ('" . $row->id . "','" . $row->id . "','" . date("Y-m-d H:i:s") . "','" . $pass2 . "') ";
                $query = $this
                    ->db
                    ->query($sql);

                $last_insert_id =  $this->db->insert_id();
                $data2 = $this
                    ->User_model
                    ->user_activities(52, '', $row->id, 'user_password_change_history', 'Change Password (Reset)', '', $row->id, $row->user_id);
                $sys_config = $this
                    ->User_info_model
                    ->upr_config_row();
                $data = array(
                    'password_change_status' => '0',
                    'password_log' => $pass2,
                    'password_expiry_date' => $sys_config->expiry_dt,
                    'password_change_datetime' => date("Y-m-d H:i:s"),
                    'random_str' => '',
                    'expiry_link' => ''
                );

                $this->db->where('id', $row->id);
                $this->db->update('users_info', $data);

                $msg = "OK";
            }
        } else {
            $msg = "Not Authenticated";
        }

        $jTableResult = array();
        $jTableResult['Message'] = $msg;
        echo json_encode($jTableResult);
    }
    function logout($ip = 0)
    {

        $sql = ("UPDATE user_log_history SET last_activities = '" . date("Y-m-d H:i:s") . "',logout_status = 1 WHERE user_id = '" . $this
            ->session
            ->userdata['ast_user']['user_id'] . "'");

        //echo $sql;exit;
        $query = $this
            ->db
            ->query($sql);
        // echo $this->db->last_query();exit;

        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            // if($key!='session_id' && $key!='session_id' && $key!='ip_address' && $key!='user_agent' && $key!='last_activity'){
            $this->session->unset_userdata($key);
            // }
        }
        $this->session->sess_destroy();
        //redirect('/home');
        //exit;
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {

                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }
        $past = time() - 3600;
        foreach ($_COOKIE as $key => $value) {
            setcookie($key, $value, $past, '/');
        }

        redirect('/home');
    }
    function get_recovery_after_case()
    {
        $str_where = "a.sts=38";

        if (trim($this->input->post('proposed_type')) != '') {
            if (trim($this->input->post('proposed_type')) == 'Investment') {
                $str_where .= " AND a.investment_ac_no='" . trim($this->input->post('recovery_loan_ac')) . "'";
            } else {
                $str_where .= " AND a.card_number_encript='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('recovery_hidden_loan_ac')) . "'";
            }
        }
        $sql = 'select a.amount,a.investment_ac_no,a.case_number,date_format(a.recive_date,"%d/%m/%Y") as withdraw_dt
            from recovery_data as a 
            where ' . $str_where;
        $q = $this->db->query($sql);
        $csrf_token = $this->security->get_csrf_hash();
        $var = array();
        $var['csrf_token'] = $csrf_token;
        $var['result'] = $q->result();
        echo json_encode($var);
    }
    function get_case_against_bank_data()
    {
        $str_where = "b.sts='1'";
        if (trim($this->input->post('proposed_type')) != '') {
            if (trim($this->input->post('proposed_type')) == 'Investment') {
                $str_where .= " AND b.loan_ac='" . trim($this->input->post('case_against_bank_loan_ac')) . "'";
            } else {
                $str_where .= " AND b.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('case_against_bank_hidden_loan_ac')) . "'";
            }
        }
        if (trim($this->input->post('req_type')) != '') {
            $str_where .= " AND b.req_type=" . $this->db->escape(trim($this->input->post('req_type')));
        }
        $this->db
            ->select('b.id,b.loan_ac,b.ac_name,b.proposed_type,b.defendant_name,j0.name as branch_sol,
                j1.name as req_type,
                j5.name as district,
                j7.name as case_name,b.case_number,b.case_section,b.case_history,
                DATE_FORMAT(b.next_date,"%d-%b-%Y") AS next_date,j8.name as case_sts,
                CONCAT(j9.name," (",j9.pin,")")as filling_plaintiff,DATE_FORMAT(b.filling_date,"%d-%b-%Y") AS filling_date,
                j10.name as prest_lawyer_name,j11.name as prest_court_name,j12.name as retail_branch,
                b.remarks,CONCAT(j13.name," (",j13.user_id,")")as e_by,DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt', FALSE)
            ->from("case_against_bank b")
            ->join('ref_branch_sol as j0', 'b.branch_sol=j0.code', 'left')
            ->join('ref_case_type as j1', 'b.req_type=j1.id', 'left')
            ->join('ref_district as j5', 'b.district=j5.id', 'left')
            ->join('ref_suit_name as j7', 'b.case_name=j7.id', 'left')
            ->join('ref_case_sts as j8', 'b.case_sts_prev_dt=j8.id', 'left')
            ->join('users_info as j9', 'b.filling_plaintiff=j9.id', 'left')
            ->join('ref_lawyer as j10', 'b.prest_lawyer_name=j10.id', 'left')
            ->join('ref_court as j11', 'b.prest_court_name=j11.id', 'left')
            ->join('ref_retail_branch as j12', 'b.retail_branch=j12.id', 'left')
            ->join('users_info as j13', 'b.e_by=j13.id', 'left')
            ->where($str_where, NULL, FALSE)
            ->limit(1);
        $suit_file_details = $this->db->get()->row();
        $csrf_token = $this->security->get_csrf_hash();
        $str = '';
        $expense = array();
        if (!empty($suit_file_details)) {
            if ($suit_file_details->proposed_type == 'Investment') {
                $no_tag = "Investment A/C";
                $nam_tag = "Investment A/C Name";
            } else {
                $no_tag = "Card";
                $nam_tag = "Name on Card";
            }
            $str .= '<table style="width: 100%;" id="preview_table">
                <thead></thead>
                <tbody id="details_body">
                    
                    <tr>
                        <td width="50%" align="left"><strong>Case Type:</strong>' . $suit_file_details->req_type . '</td>
                        <td width="50%" align="left"><strong>Proposed Type:</strong> ' . $suit_file_details->proposed_type . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>' . $nam_tag . ':</strong>' . $suit_file_details->ac_name . '</td>
                        <td width="50%" align="left"><strong>' . $no_tag . 'No.:</strong> ' . $suit_file_details->loan_ac . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Name Of Defendant/Accused:</strong>' . $suit_file_details->defendant_name . '</td>
                        <td width="50%" align="left"><strong>Branch (Code):</strong> ' . $suit_file_details->branch_sol . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Filling Date:</strong>' . $suit_file_details->filling_date . '</td>
                        <td width="50%" align="left"><strong>Case Number:</strong>' . $suit_file_details->case_number . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>District:</strong>' . $suit_file_details->district . '</td>
                        <td width="50%" align="left"><strong>Background /Case history:</strong>' . $suit_file_details->case_history . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Case Name:</strong>' . $suit_file_details->case_name . '</td>
                        <td width="50%" align="left"><strong>Case Section:</strong>' . $suit_file_details->case_section . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Current Case Status:</strong> ' . $suit_file_details->case_sts . '</td>
                        <td width="50%" align="left"><strong>Case Dealing Officer:</strong>' . $suit_file_details->filling_plaintiff . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Present Lawyer Name:</strong>' . $suit_file_details->prest_lawyer_name . '</td>
                        <td width="50%" align="left"><strong>Present Name Of The Court:</strong>' . $suit_file_details->prest_court_name . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Retail Branch (If any):</strong>' . $suit_file_details->retail_branch . '</td>
                        <td width="50%" align="left"><strong>Remarks:</strong>' . $suit_file_details->remarks . '</td>

                    </tr>';
            $str .= '</tbody>
                </table>';
        }
        $var = array(
            "str" => $str,
            "csrf_token" => $csrf_token
        );
        echo json_encode($var);
    }
    function get_legal_cost_type_wise()
    {
        $str_where2 = "1";
        $str_where3 = "1";
        //LEFT OUTER JOIN ref_paper_bill_activities as pa on (b.vendor_type=2 AND b.activities_id=pa.id AND b.main_table_name='expenses')
        $str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0";
        $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and (b.req_type=1 or b.req_type=3 or b.req_type=4) AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))
            LEFT OUTER JOIN ref_staff_conv_activities as sc on (b.vendor_type=3 AND b.activities_id=sc.id)
            LEFT OUTER JOIN ref_court_entertainment_activities as ce on (b.vendor_type=5 AND b.activities_id=ce.id)
            LEFT OUTER JOIN ref_others_cost_activities as oa on (b.vendor_type=6 AND b.activities_id=oa.id AND b.main_table_name='expenses')
            LEFT OUTER JOIN court_entertainment_data v1 on (b.vendor_type=5 AND v1.id=b.main_table_id AND b.main_table_name='court_entertainment_data')
            LEFT OUTER JOIN users_info as v2 on (b.vendor_id=v2.id and b.vendor_type=3)
            LEFT OUTER JOIN ref_paper_vendor as v3 on (b.vendor_id=v3.id and b.vendor_type=2)
            LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
            LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
        $select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=2,v3.name,IF(b.vendor_type=3,v2.name,IF(b.vendor_type=4,v5.name,IF(vendor_type=5,v1.staff_pin,b.vendor_name))))) as vendor_name,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.vendor_type=3,sc.name,IF(b.vendor_type=5,ce.name,IF(b.vendor_type=6,oa.name,IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name)))))))))) as act_name,IF(b.vendor_type=1,'Lawyer Bill',IF(b.vendor_type=2,'Paper Bill',IF(b.vendor_type=3,'Staff Conveyence',IF(b.vendor_type=4,'Court Fee',IF(b.vendor_type=5,'Court Entertainment','Others Bill'))))) as bill_type";
        if (trim($this->input->post('proposed_type')) != '') {
            if (trim($this->input->post('proposed_type')) == 'Investment') {
                $str_where .= " AND b.loan_ac='" . trim($this->input->post('legal_cost_loan_ac')) . "'";
                $str_where2 .= " AND a.loan_ac='" . trim($this->input->post('legal_cost_loan_ac')) . "'";
                $str_where3 .= " AND c.loan_ac='" . trim($this->input->post('legal_cost_loan_ac')) . "'";
            } else {
                $str_where .= " AND b.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('legal_cost_hidden_loan_ac')) . "'";
                $str_where2 .= " AND a.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('legal_cost_hidden_loan_ac')) . "'";
                $str_where3 .= " AND c.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('legal_cost_hidden_loan_ac')) . "'";
            }
        }
        if (trim($this->input->post('req_type')) != '') {
            $str_where .= " AND b.req_type=" . $this->db->escape(trim($this->input->post('req_type')));
            $str_where2 .= " AND a.req_type=" . $this->db->escape(trim($this->input->post('req_type')));
            $str_where3 .= " AND c.req_type=" . $this->db->escape(trim($this->input->post('req_type')));
        }
        $sql = "SELECT 
                a.legal_cost as amount,rq.name as req_type_name,'' as expense_remarks,a.loan_ac,a.ac_name,a.case_number,d2.name as district,DATE_FORMAT(dm.e_dt,'%d-%b-%Y') as txrn_dt,'' AS vendor_name,a.activities as act_name,'Migrated Cost' as bill_type
                FROM legal_cost a
                LEFT OUTER JOIN ref_district d2 on(a.district=d2.id) 
                LEFT OUTER JOIN ref_req_type rq on(a.req_type=rq.id) 
                LEFT OUTER JOIN data_migration_history dm on(a.migration_id=dm.id) 
                WHERE $str_where2
                UNION ALL
                SELECT
                b.amount,rq.name as req_type_name,b.expense_remarks,b.loan_ac,b.ac_name,IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,d.name as district,DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,$select
                FROM cost_details b
                $join
                LEFT OUTER JOIN ref_district d on(b.district=d.id) 
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                WHERE $str_where
                UNION ALL
                SELECT
                c.amount,rq.name as req_type_name,c.expense_remarks,c.loan_ac,c.ac_name,'1st Legal Notice' AS case_number,d.name as district,DATE_FORMAT(c.txrn_dt,'%d-%b-%Y') as txrn_dt,l.name AS vendor_name,c.description as act_name,'Lawyer Bill' as bill_type
                FROM legal_notice_cost_details c
                LEFT OUTER JOIN ref_district d on(c.district=d.id) 
                LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.id) 
                LEFT OUTER JOIN ref_lawyer l on(c.vendor_id=l.id) 
                WHERE $str_where3";
        $q = $this->db->query($sql);
        $csrf_token = $this->security->get_csrf_hash();
        $var = array();
        $var['csrf_token'] = $csrf_token;
        $var['result'] = $q->result();
        echo json_encode($var);
    }
    function details_360()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $legal_notice_str = '';
        $auction_data_str = '';
        $final_legal_notice_str = '';
        $auction_info = array();
        $suit_file_details = array();
        $suit_data_str = '';
        $other_document_str = '<table style="width: 100%;" id="preview_table">
                <thead></thead>
                <tbody id="details_body">';
        $details = $this->User_model->get_recommend_info();
        $suit_file_details = $this->User_model->get_suit_info();
        if (isset($details->id)) {
            $guarantor_info = $this->Legal_notice_model->get_guarantor_info('edit', $details->id);
            if ($details->proposed_type == 'Investment') {
                $facility_info = $this->Legal_notice_ho_model->get_facility($details->id);
            } else {
                $facility_info = $this->Legal_notice_ho_model->get_card_facility($details->id);
            }

            if (!empty($details)) {
                $other_document_str .= '<tr>
                        <td width="50%" align="left"><strong>1st Legal Notice:</strong><a id="inXLadfc" style="text-align:center;cursor:pointer;" href="' . base_url() . 'index.php/legal_notice_ho/download_pdf/' . $details->id . '/' . $details->proposed_type . '" target="_blank" ><img width="20px" height="20px" align="center" src="' . base_url() . 'images/pdf_icon.gif"></a></td>
                        <td width="50%" align="left"><strong>1st Legal Notice Approval Date:</strong>' . $details->v_dt . '</td>
            </tr>';
                $pre_ln_data = $this->Legal_notice_model->get_pre_ln_data_by_id($details->pre_ln_id);
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
                $legal_notice_str .= '<table style="width: 100%;" id="preview_table">
                <thead></thead>
                <tbody id="details_body">
                    <tr>
                        <td width="50%" align="left"><strong>SL No.:</strong>' . $details->sl_no . '</td>
                        <td width="50%" align="left"><strong>More A/C No.:</strong>' . $details->more_acc_number . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Proposed Type:</strong>' . $details->proposed_type . '</td>
                        <td width="50%" align="left"><strong>Remarks:</strong>' . $details->remarks . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>' . $no_tag . 'No.:</strong> ' . $details->loan_ac . '</td>
                        <td width="50%" align="left"><strong>Status:</strong>' . $details->legal_notice_sts . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>CID:</strong>' . $details->cif . '</td>
                        <td width="50%" align="left"><strong>Initiate By:</strong>' . $details->e_by . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Branch Code:</strong>' . $details->branch_sol . '</td>
                        <td width="50%" align="left"><strong>Initiate Date Time:</strong>' . $details->e_dt . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>' . $nam_tag . ':</strong>' . $details->ac_name . '</td>
                        <td width="50%" align="left"><strong>STC By:</strong>' . $details->stc_by . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Business Type:</strong>' . $details->subject_name . '</td>
                        <td width="50%" align="left"><strong>STC Date Time:</strong>' . $details->stc_dt . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Spouse Name :</strong>' . $spouse_name . '</td>
                        <td width="50%" align="left"><strong>Recommended By:</strong>' . $details->rec_by . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Mother Name :</strong>' . $mother_name . '</td>
                        <td width="50%" align="left"><strong>Recommend Date Time:</strong>' . $details->rec_dt . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Investment Segment (Portfolio) :</strong>' . $details->loan_segment . '</td>
                        <td width="50%" align="left"><strong>Acknowledge By:</strong>' . $details->ack_by . '</td>

                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Current/Updated Address:</strong>' . $details->current_address . '</td>
                        <td width="50%" align="left"><strong>Acknowledge Date Time:</strong>' . $details->ack_dt . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Zone:</strong>' . $details->zone_name . '</td>
                        <td width="50%" align="left"><strong>Send To HOLM By:</strong>' . $details->sth_by . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>District:</strong>' . $details->district_name . '</td>
                        <td width="50%" align="left"><strong>Verify By:</strong>' . $details->v_by . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Hold Reason:</strong>' . $details->hold_reason . '</td>
                        <td width="50%" align="left"><strong>Customer Contact:</strong>' . $details->mobile_no . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Call up File:</strong>' . $call_up_file . '</td>
                        <td width="50%" align="left"><strong>Legal Notice sent by:</strong>' . $details->l_sent_by . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Call up Date:</strong>' . $details->call_up_dt . '</td>
                        <td width="50%" align="left"><strong>Legal Notice sent Date:</strong>' . $details->legal_notice_s_dt . '</td>
                        
                    </tr>';
                if (!empty($pre_ln_data)) {
                    $legal_notice_str .= '<tr>
                            <td width="50%" align="left"><strong>Pre LN By:</strong>' . $pre_ln_data->pre_ln_by . '</td>
                            <td width="50%" align="left"><strong>Pre LN File:</strong><a id="inXLadfc" style="text-align:center;cursor:pointer;" href="' . base_url() . 'index.php/legal_notice_ho/download_pdf/' . $pre_ln_data->id . '/' . $pre_ln_data->proposed_type . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/pdf_icon.gif"></a></td>
                        </tr>';
                }
                $legal_notice_str .= '<tr>
                        
                        <td width="50%" align="left"><strong>Lawyer Name:</strong>' . $details->lawyer_name . '</td>
                        <td width="50%" align="left"></td>
                    </tr>
                </tbody>
            </table>';
            }
            if (!empty($guarantor_info)) {
                $legal_notice_str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
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
                    $legal_notice_str .= '<tr>';
                    $legal_notice_str .= '<td align="center">' . $key->type_name . '</td>';
                    $legal_notice_str .= '<td align="left">' . $key->guarantor_name . '</td>';
                    $legal_notice_str .= '<td align="left">' . $key->father_name . '</td>';
                    $legal_notice_str .= '<td align="left">' . $key->present_address . '</td>';
                    $legal_notice_str .= '<td align="left">' . $key->permanent_address . '</td>';
                    $legal_notice_str .= '<td align="left">' . $key->business_address . '</td>';
                    $legal_notice_str .= '<td align="center">' . $key->guar_sts_name . '</td>';
                    $legal_notice_str .= '<td align="center">' . $key->occ_sts_name . '</td>';
                    $legal_notice_str .= '</tr>';
                }

                $legal_notice_str .= '</tbody>
                </table>
            </div>';
            }
            if (!empty($facility_info)) {
                if ($details->proposed_type == 'Investment') {
                    $legal_notice_str .= '<br/><div id="facility_for_loan" style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
                <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
                <table border="1" id="facility_table" style="border-color:#c0c0c0;width:127%;margin:20px" >
                <thead>
                    <tr>
                        <td width="5%" style="font-weight: bold;text-align:center">Faci lity Type</td>
                        <td width="5%" style="font-weight: bold;text-align:center">A/C Number</td>
                        <td width="5%" style="font-weight: bold;text-align:center">A/C Name</td>
                        <td width="5%" style="font-weight: bold;text-align:center">Sch Desc.</td>
                        <td width="5%" style="font-weight: bold;text-align:center">Disbur sement Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Disbur sed Amount</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Expire Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Due install ments</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Payable</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Repayment</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Overdue Balance</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Overdue BL Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Call -up Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">CL(BB)</td>
                        <td width="7%" style="font-weight: bold;text-align:center">CL(AIBL)</td>
                    </tr>
                </thead>
                <tbody id="facility_info_loan">';
                    foreach ($facility_info as $key) {
                        $legal_notice_str .= '<tr>';
                        $legal_notice_str .= '<td align="left">' . $key->facility_type_name . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->ac_number . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->ac_name . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->sch_desc . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->disbursement_date . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->disbursed_amount . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->expire_date . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->due_installments . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->payble . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->repayment . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->outstanding_bl . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->outstanding_bl_dt . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->overdue_bl . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->overdue_bl_dt . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->call_up_dt . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->cl_bb . '</td>';
                        $legal_notice_str .= '<td align="left">' . $key->cl_bbl . '</td>';
                        $legal_notice_str .= '</tr>';
                    }
                    $legal_notice_str .= '</tbody>
                    </table>
                </div>';
                } else {
                    $legal_notice_str .= '<br/><div id="facility_for_card" style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
                    <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Details</span>
                    <table border="1" id="facility_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                    <thead>
                        <tr>
                            <td width="10%" style="font-weight: bold;text-align:center">Card Type</td>
                            <td width="15%" style="font-weight: bold;text-align:center">Card No</td>
                            <td width="15%" style="font-weight: bold;text-align:center">Card Holder Name</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Card Issue Date</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Card Exp Date</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Card Limit</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Outstanding Balance</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Outstanding BL DT</td>
                        </tr>
                    </thead>
                    <tbody id="facility_info_card">';
                    foreach ($facility_info as $key) {
                        $legal_notice_str .= '<tr>';
                        $legal_notice_str .= '<td align="center">' . $key->card_type . '</td>';
                        $legal_notice_str .= '<td align="center">' . $key->card_no . '</td>';
                        $legal_notice_str .= '<td align="center">' . $key->card_name . '</td>';
                        $legal_notice_str .= '<td align="center">' . $key->card_issue_dt . '</td>';
                        $legal_notice_str .= '<td align="center">' . $key->card_exp_dt . '</td>';
                        $legal_notice_str .= '<td align="center">' . $key->card_limit . '</td>';
                        $legal_notice_str .= '<td align="center">' . $key->outstanding_bl . '</td>';
                        $legal_notice_str .= '<td align="center">' . $key->outstanding_bl_dt . '</td>';
                        $legal_notice_str .= '</tr>';
                    }
                    $legal_notice_str .= '<tr>';
                    $legal_notice_str .= '<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding : </td>';
                    $legal_notice_str .= '<td style="font-weight: bold;text-align:center">' . $details->outstanding_bl . '</td>';
                    $legal_notice_str .= '<td style="font-weight: bold;text-align:center"></td>';
                    $legal_notice_str .= '</tr>';

                    $legal_notice_str .= '</tbody>
                    </table>
                </div>';
                }
            }
        } else {
            $legal_notice_str .= 'No Data Found!';
        }
        $cma_str = '';
        $details = $this->User_model->get_cma_recommend_info();
        if (isset($details->id)) {
            $guarantor_info = $this->Cma_process_model->get_guarantor_info('edit', $details->id);
            if ($details->proposed_type == 'Investment') {
                $facility_info = $this->Cma_ho_model->get_facility($details->id);
                $mortgage_info = $this->Cma_ho_model->get_mortgage($details->id);
                $security_info = $this->Cma_ho_model->get_security($details->id);
                $bidder_info = $this->Cma_ho_model->get_bidder($details->id);
            } else {
                $mortgage_info = array();
                $security_info = array();
                $bidder_info = array();
                $facility_info = $this->Cma_ho_model->get_card_facility($details->id);
            }

            $condition = "AND legal_sent_sts='1'";
            $doc_files = $this->Cma_process_model->get_cma_doc_files($details->id, $condition);
            if (!empty($details)) {
                $auction_info = $this->Cma_process_model->get_auction_details_by_cma($details->id);
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
                    $call_up_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/call_up_file/' . $details->call_up_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
                } else {
                    $call_up_file = "";
                }

                if ($details->remarks_file != '') {
                    $remarks_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/remarks_file/' . $details->remarks_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
                } else {
                    $remarks_file = "";
                }

                if ($details->senction_letter != '') {
                    $senction_letter = '<br/><strong> Senction Letter :</strong> <img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/senction_letter/' . $details->senction_letter . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
                } else {
                    $senction_letter = "";
                }

                if ($details->ln_scan_copy != '') {
                    $ln_scan_copy = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/ln_scan_copy/' . $details->ln_scan_copy . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
                } else {
                    $ln_scan_copy = "";
                }

                if ($details->auction_sts == 33) {
                    $current_auct_sts = "Completed";
                } else {
                    $current_auct_sts = "";
                }

                if ($details->uploaded_statement != '') {
                    $statement_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/uploaded_statement/' . $details->uploaded_statement . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
                } else if ($details->generated_statement != '') {
                    $statement_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/generated_statement/' . $details->generated_statement . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
                } else {
                    $statement_file = "";
                }
                if ($details->final_ln != '') {
                    $final_ln = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/ln_scan_copy/' . $details->final_ln . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
                } else {
                    $final_ln = "";
                }
                $other_document_str .= '
            <tr>
                    <td width="50%" align="left"><strong>Call UP File:</strong>' . $call_up_file . '</td>
                    <td width="50%" align="left"><strong>Senction Letter:</strong>' . $senction_letter . '</td>
            </tr>
            <tr>
                    <td width="50%" align="left"><strong>Auction Legal Notice:</strong>' . $ln_scan_copy . '</td>
                    <td width="50%" align="left"><strong>Final Legal Notice:</strong>' . $final_ln . '</td>
            </tr>
            <tr>
                <td width="50%" align="left"><strong>Statement File:</strong>' . $statement_file . '</td>
                <td width="50%" align="left"><strong>Remarks File:</strong>' . $remarks_file . '</td>
            </tr>';
                $cma_str .= '<table style="width: 100%;" id="preview_table">
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
                        <td width="50%" align="left"><strong>Previous CMA Approval Type:</strong>' . $details->pre_cma_app_type . '</td>
                        <td width="50%" align="left"><strong>Previous CMA Approval Date:</strong>' . $details->pre_cma_app_dt . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Previous Case Status:</strong>' . $details->pre_case_sts . '</td>
                        <td width="50%" align="left"><strong>Previous Case Type:</strong>' . $details->pre_case_type . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Disposal Status:</strong>' . $details->disposal_sts . '</td>
                        <td width="50%" align="left"><strong>Customer Contact:</strong>' . $details->mobile_no . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Borrower Name:</strong>' . $details->brrower_name . '</td>
                        
                        <td width="50%" align="left"><strong>Initiate Date Time:</strong>' . $details->e_dt . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Business Type:</strong>' . $details->subject_name . '</td>
                        
                        <td width="50%" align="left"><strong>STC By:</strong> ' . $details->stc_by . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Spouse Name :</strong> ' . $spouse_name . '</td>
                        
                        <td width="50%" align="left"><strong>STC Date Time:</strong>' . $details->stc_dt . '</td>

                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Mother Name :</strong>' . $mother_name . '</td>
                        
                        <td width="50%" align="left"><strong>Recommended By:</strong>' . $details->rec_by . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Investment Segment (Portfolio) :</strong>' . $details->loan_segment . '</td>
                        
                        <td width="50%" align="left"><strong>Recommend Date Time:</strong>' . $details->rec_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Current/Updated Address:</strong>' . $details->current_address . '</td>
                        
                        <td width="50%" align="left"><strong>HO Acknowledge By:</strong>' . $details->ack_by . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Zone:</strong>' . $details->zone_name . '</td>
                        
                        <td width="50%" align="left"><strong>HO Acknowledge Date Time:</strong>' . $details->ack_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Call Up Date:</strong>' . $details->call_up_serv_dt . '</td>
                        
                        <td width="50%" align="left"><strong>Send To HOLM By:</strong>' . $details->sth_by . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Call Up File:</strong>' . $call_up_file . '</td>
                        
                        <td width="50%" align="left"><strong>Send To HOLM Date Time:</strong>' . $details->sth_dt . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Chq Expiry Date:</strong>' . $details->chq_expiry_date . '</td>
                        
                        <td width="50%" align="left"><strong>Verify By:</strong>' . $details->v_by . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Last Payment Date:</strong>' . $details->last_payment_date . '</td>
                        
                        <td width="50%" align="left"><strong>Verify Date Time:</strong>' . $details->v_dt . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Last Payment Amount:</strong>' . $details->last_payment_amount . '</td>
                        
                        <td width="50%" align="left"><strong>Auction Complete By:</strong>' . $details->auction_complete_by . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Case File District:</strong>' . $details->case_file_district . '</td>
                        <td width="50%" align="left"><strong>Case Claim Amount:</strong>' . $details->st_belance . '</td>
                        

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Remarks:</strong>' . $details->remarks . $remarks_file . '</td>
                        
                        <td width="50%" align="left"><strong>Auction Complete Date:</strong>' . $details->auction_complete_dt . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Previous Auction Sts:</strong>' . $details->pre_auc_sts . '</td>
                        
                        <td width="50%" align="left"><strong>Hold Reason:</strong>' . $details->hold_reason . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Current Auction Sts:</strong>' . $current_auct_sts . '</td>
                        
                        <td width="50%" align="left"><strong>Previous Case Filling Date:</strong>' . $details->pre_case_fill_dt . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Current DPD:</strong>' . $details->current_dpd . 'DPD</td>
                        <td width="50%" align="left"><strong></strong></td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Disposal remarks:</strong>' . $details->disposal_remarks . '</td>
                        <td width="50%" align="left"><strong>Judgment Summary:</strong>' . $details->judgement_summery . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Business Status:</strong>' . $details->busi_sts . '</td>
                        <td width="50%" align="left"><strong>Security Status:</strong>' . $details->sec_sts . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Borrower Status:</strong>' . $details->borr_sts . '</td>
                        <td width="50%" align="left"><strong>Interest Rate (As per Sanction):</strong>' . $details->int_rate . $senction_letter . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Logic for ARA Case:</strong>' . $details->case_logic . '</td>
                        <td width="50%" align="left"><strong>Chq. Status:</strong>' . $details->chq_sts . '</td>
                    </tr>';
                if ($details->proposed_type == 'Investment' && $details->sec_sts_id == 1) {
                    if ($details->auction_sign_memo != '' && $details->auction_sign_memo != NULL) {
                        $auction_sign_memo = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/auction_sign_memo/' . $details->auction_sign_memo . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
                    } else {
                        $auction_sign_memo = "";
                    }
                    $cma_str .= '<tr>
                        <td width="50%" align="left"><strong>Auc Ack By:</strong>' . $details->auc_ack_by . '</td>
                        <td width="50%" align="left"><strong>Auc Ack Date Time:</strong>' . $details->auc_ack_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auc Stc By:</strong>' . $details->auc_stc_by . '</td>
                        <td width="50%" align="left"><strong>Auc Stc Date Time:</strong>' . $details->auc_stc_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auc Verify By:</strong>' . $details->auc_v_by . '</td>
                        <td width="50%" align="left"><strong>Auc Verify Date Time:</strong>' . $details->auction_v_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auc STL By:</strong>' . $details->auc_st_l_by . '</td>
                        <td width="50%" align="left"><strong>Auc STL Date Time:</strong>' . $details->auc_st_l_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Legal Response By:</strong>' . $details->legal_response_by . '</td>
                        <td width="50%" align="left"><strong>Legal Response Date Time:</strong>' . $details->legal_response_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Lawyer:</strong>' . $details->lawyer_name . '</td>
                        <td width="50%" align="left"><strong>LN Scan Copy:</strong>' . $ln_scan_copy . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>LN Serve Date:</strong>' . $details->ln_serve_dt_format . '</td>
                        <td width="50%" align="left"><strong>LN Expiry Date:</strong>' . $details->ln_expiry_dt_format . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Paper Vendor:</strong>' . $details->paper_vendor . '</td>
                        <td width="50%" align="left"><strong>Paper Name:</strong>' . $details->paper_name . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Paper Date:</strong>' . $details->paper_date . '</td>
                        <td width="50%" align="left"><strong>Auction Date:</strong>' . $details->auction_date . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auction Time:</strong>' . $details->auction_time . '</td>
                        <td width="50%" align="left"><strong>Auction Address:</strong>' . $details->auction_address . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auction Complete By:</strong>' . $details->auc_comp_by . '</td>
                        <td width="50%" align="left"><strong>Auction Complete Date Time:</strong>' . $details->auction_complete_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auction Sign Memo:</strong>' . $auction_sign_memo . '</td>
                        <td width="50%" align="left"><strong>Auction Complete Remarks:</strong>' . $details->complete_remarks . '</td>
                    </tr>';
                }

                $cma_str .= '<tr>
                        <td width="50%" align="left"><strong>Send To HOOPS By:</strong>' . $details->sthoops_by . '</td>
                        <td width="50%" align="left"><strong>Send To HOOPS Date Time:</strong>' . $details->sthoops_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>File Deliver By:</strong>' . $details->deliver_by . '</td>
                        <td width="50%" align="left"><strong>File Deliver Date Time:</strong>' . $details->deliver_dt . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Legal Ack By:</strong>' . $details->legal_ack_by . '</td>
                        <td width="50%" align="left"><strong>Legal Ack Date Time:</strong>' . $details->legal_ack_dt . '</td>
                    </tr>';
                if ($details->uploaded_statement != '' || $details->generated_statement != '') {
                    $cma_str .= '<tr>
                            <td width="50%" align="left"><strong>Statement File:</strong>' . $statement_file . '</td>
                            <td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>' . $details->ln_sent_date . '</td>
                        </tr>
                        <tr>
                            <td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>' . $details->ln_val_dt . '</td>
                            <td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>' . $details->lawyer_legal . '</td>
                        </tr>';
                }

                $cma_str .= '</tbody>
                </table>';

                $final_legal_notice_str .= '<table style="width: 100%;" id="preview_table">
                <thead></thead>
                <tbody id="details_body">
                    <tr>
                        <td width="50%" align="left"><strong>Legal Notice Sent Date:</strong>' . $details->ln_sent_date . '</td>
                        <td width="50%" align="left"><strong>Legal Notice Expiry Date:</strong>' . $details->ln_val_dt . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Legal Notice Status:</strong>' . $details->final_ln_status . '</td>
                        <td width="50%" align="left"><strong>Total Legal Notice Sent:</strong>' . $details->total_final_ln . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Legal Notice Copy:</strong> ' . $final_ln . '</td>
                        <td width="50%" align="left"><strong>Lawyer Name:</strong>' . $details->lawyer_legal . '</td>
                    </tr>';
                $final_legal_notice_str .= '
                </tbody>
            </table>';
            }
            if (!empty($guarantor_info)) {
                $cma_str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
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
                    $cma_str .= '<tr>';
                    $cma_str .= '<td align="center">' . $key->type_name . '</td>';
                    $cma_str .= '<td align="left">' . $key->guarantor_name . '</td>';
                    $cma_str .= '<td align="left">' . $key->father_name . '</td>';
                    $cma_str .= '<td align="left">' . $key->present_address . '</td>';
                    $cma_str .= '<td align="left">' . $key->permanent_address . '</td>';
                    $cma_str .= '<td align="left">' . $key->business_address . '</td>';
                    $cma_str .= '<td align="center">' . $key->guar_sts_name . '</td>';
                    $cma_str .= '<td align="center">' . $key->occ_sts_name . '</td>';
                    $cma_str .= '</tr>';
                }

                $cma_str .= '</tbody>
                </table>
            </div>';
            }
            if (!empty($facility_info)) {
                if ($details->proposed_type == 'Investment') {
                    $cma_str .= '<br/><div id="facility_for_loan" style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
                <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
                <table border="1" id="facility_table" style="border-color:#c0c0c0;width:127%;margin:20px" >
                <thead>
                    <tr>
                        <td width="5%" style="font-weight: bold;text-align:center">Faci lity Type</td>
                        <td width="5%" style="font-weight: bold;text-align:center">A/C Number</td>
                        <td width="5%" style="font-weight: bold;text-align:center">A/C Name</td>
                        <td width="5%" style="font-weight: bold;text-align:center">Sch Desc.</td>
                        <td width="5%" style="font-weight: bold;text-align:center">Profit Rate</td>
                        <td width="5%" style="font-weight: bold;text-align:center">Disbur sement Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Disbur sed Amount</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Expire Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Tenour</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Payable</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Repayment</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Overdue Balance</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Overdue BL Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Call -up Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Write - off Date</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Write - off Amount</td>
                        <td width="7%" style="font-weight: bold;text-align:center">Recovery After Write -off</td>
                        <td width="7%" style="font-weight: bold;text-align:center">CL(BB)</td>
                        <td width="7%" style="font-weight: bold;text-align:center">CL(AIBL)</td>
                    </tr>
                </thead>
                <tbody id="facility_info_loan">';
                    foreach ($facility_info as $key) {
                        $cma_str .= '<tr>';
                        $cma_str .= '<td align="left">' . $key->facility_type_name . '</td>';
                        $cma_str .= '<td align="left">' . $key->ac_number . '</td>';
                        $cma_str .= '<td align="left">' . $key->ac_name . '</td>';
                        $cma_str .= '<td align="left">' . $key->sch_desc . '</td>';
                        $cma_str .= '<td align="left">' . $key->int_rate . '</td>';
                        $cma_str .= '<td align="left">' . $key->disbursement_date . '</td>';
                        $cma_str .= '<td align="left">' . $key->disbursed_amount . '</td>';
                        $cma_str .= '<td align="left">' . $key->expire_date . '</td>';
                        $cma_str .= '<td align="left">' . $key->loan_tenor . '</td>';
                        $cma_str .= '<td align="left">' . $key->payble . '</td>';
                        $cma_str .= '<td align="left">' . $key->repayment . '</td>';
                        $cma_str .= '<td align="left">' . $key->outstanding_bl . '</td>';
                        $cma_str .= '<td align="left">' . $key->outstanding_bl_dt . '</td>';
                        $cma_str .= '<td align="left">' . $key->overdue_bl . '</td>';
                        $cma_str .= '<td align="left">' . $key->overdue_bl_dt . '</td>';
                        $cma_str .= '<td align="left">' . $key->call_up_dt . '</td>';
                        $cma_str .= '<td align="left">' . $key->write_off_dt . '</td>';
                        $cma_str .= '<td align="left">' . $key->write_off_amount . '</td>';
                        $cma_str .= '<td align="left">' . $key->recovery_after_Wf . '</td>';
                        $cma_str .= '<td align="left">' . $key->cl_bb . '</td>';
                        $cma_str .= '<td align="left">' . $key->cl_bbl . '</td>';
                        $cma_str .= '</tr>';
                    }
                    $cma_str .= '</tbody>
                    </table>
                </div>';
                } else {
                    $cma_str .= '<br/><div id="facility_for_card" style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
                    <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Details</span>
                    <table border="1" id="facility_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                    <thead>
                        <tr>
                            <td width="10%" style="font-weight: bold;text-align:center">Card Type</td>
                            <td width="15%" style="font-weight: bold;text-align:center">Card No</td>
                            <td width="15%" style="font-weight: bold;text-align:center">Card Holder Name</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Card Issue Date</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Card Exp Date</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Card Limit</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Outstanding Balance</td>
                            <td width="12%" style="font-weight: bold;text-align:center">Outstanding BL DT</td>
                        </tr>
                    </thead>
                    <tbody id="facility_info_card">';
                    foreach ($facility_info as $key) {
                        $cma_str .= '<tr>';
                        $cma_str .= '<td align="center">' . $key->card_type . '</td>';
                        $cma_str .= '<td align="center">' . $key->card_no . '</td>';
                        $cma_str .= '<td align="center">' . $key->card_name . '</td>';
                        $cma_str .= '<td align="center">' . $key->card_issue_dt . '</td>';
                        $cma_str .= '<td align="center">' . $key->card_exp_dt . '</td>';
                        $cma_str .= '<td align="center">' . $key->card_limit . '</td>';
                        $cma_str .= '<td align="center">' . $key->outstanding_bl . '</td>';
                        $cma_str .= '<td align="center">' . $key->outstanding_bl_dt . '</td>';
                        $cma_str .= '</tr>';
                    }
                    $cma_str .= '<tr>';
                    $cma_str .= '<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding : </td>';
                    $cma_str .= '<td style="font-weight: bold;text-align:center">' . $details->outstanding_bl . '</td>';
                    $cma_str .= '<td style="font-weight: bold;text-align:center"></td>';
                    $cma_str .= '</tr>';
                    $cma_str .= '</tbody>
                    </table>
                </div>';
                }
            }
            if (!empty($doc_files)) {
                $cma_str .= '<br/><div id="doc_file_div" style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
                <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Secured Document Files</span>
                <table border="1" id="doc_file_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                <thead>
                    <tr>
                        <td width="70%" style="font-weight: bold;text-align:left">Document Title</td>
                        <td width="30%" style="font-weight: bold;text-align:center">File</td>
                    </tr>
                </thead>
                <tbody id="doc_file_body">';
                foreach ($doc_files as $key) {
                    $cma_str .= '<tr>';
                    $cma_str .= '<td align="left">' . $key->org_document_name . '</td>';
                    if ($key->file_name != '') {
                        $cma_str .= '<td align="center"><img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/document_file/' . $key->file_name . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png"></td>';
                    } else {
                        $cma_str .= '<td align="center"></td>';
                    }

                    $cma_str .= '</tr>';
                }
                $cma_str .= '</tbody>
                    </table>
                </div>';
            }
            if (!empty($auction_info)) {
                $auction_data_str .= '<table style="width: 100%;" id="preview_table">
                <thead></thead>
                <tbody id="details_body">
                    <tr>
                        <td width="50%" align="left"><strong>loan_ac:</strong>' . $auction_info->loan_ac . '</td>
                        <td width="50%" align="left"><strong>Paper Vendor:</strong>' . $auction_info->paper_vendor . '</td>
                        
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Paper Name:</strong>' . $auction_info->paper_name . '</td>
                        <td width="50%" align="left"><strong>Paper Date:</strong>' . $auction_info->paper_date . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auction Date:</strong> ' . $auction_info->auction_date . '</td>
                        <td width="50%" align="left"><strong>Auction Time:</strong>' . $auction_info->auction_time . '</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>CID:</strong>' . $auction_info->cif . '</td>
                        <td width="50%" align="left"><strong>Auction Address:</strong>' . $auction_info->auction_address . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Paper Remarks:</strong>' . $auction_info->paper_remarks . '</td>
                        <td width="50%" align="left"><strong>Auction Verify By:</strong>' . $auction_info->auc_v_by . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auction Verify Date:</strong>' . $auction_info->auction_v_dt . '</td>
                        <td width="50%" align="left"><strong>Lawyer :</strong>' . $auction_info->lawyer_name . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Legal Notice Serve Date:</strong>' . $auction_info->ln_serve_dt . '</td>
                        <td width="50%" align="left"><strong>Legal Notice Expiry Date:</strong>' . $auction_info->ln_expiry_dt_format . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auction Remarks :</strong>' . $auction_info->auction_remarks . '</td>
                        <td width="50%" align="left"><strong>Auction Complete Remarks:</strong>' . $auction_info->complete_remarks . '</td>

                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>Auction Acknowledge By :</strong>' . $auction_info->auc_ack_by . '</td>
                        <td width="50%" align="left"><strong>Acknowledge Date Time:</strong>' . $auction_info->auc_ack_dt . '</td>

                    </tr>';
                $auction_data_str .= '
                </tbody>
            </table>';
            }
            if (!empty($mortgage_info)) {
                $i = 1;
                $auction_data_str .= '<br/><div id="mortgage_div" style="background-color:#eaeaea;padding:10px;margin-top:10px;overflow:scroll;padding-top:20px;">
                <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Mortgage Info</span>
                <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:140%;margin:20px" >
                <thead>
                    <tr>
                        <td style="font-weight: bold;text-align:center">Schedule Name</td>
                        <td style="font-weight: bold;text-align:center">Schedule Description</td>
                        <td style="font-weight: bold;text-align:center">Deed Number</td>
                        <td style="font-weight: bold;text-align:center">Mortgage Date</td>
                        <td style="font-weight: bold;text-align:center">Valuator Name</td>
                        <td style="font-weight: bold;text-align:center">Valuator Date</td>
                        <td style="font-weight: bold;text-align:center">Valuator MV</td>
                        <td style="font-weight: bold;text-align:center">Valuator FSV</td>
                        <td style="font-weight: bold;text-align:center">Re-Valuator Name</td>
                        <td style="font-weight: bold;text-align:center">Re-Valuator Date</td>
                        <td style="font-weight: bold;text-align:center">Re-Valuator MV</td>
                        <td style="font-weight: bold;text-align:center">Re-Valuator FSV</td>
                        <td style="font-weight: bold;text-align:center">Gov’t Mouza Rate</td>
                        <td style="font-weight: bold;text-align:center">Total Land Area</td>
                        <td style="font-weight: bold;text-align:center">Butted and bounded by</td>
                    </tr>
                </thead>
                <tbody id="mortgage_body">';
                foreach ($mortgage_info as $key) {
                    $auction_data_str .= '<tr>';
                    $auction_data_str .= '<td align="center">' . $key->mort_schedule_name . '<input type="hidden" name="mort_name_' . $i . '" id="mort_name_' . $i . '" value="' . $key->mort_schedule_name . '"></td>';
                    $auction_data_str .= '<td align="center">' . $key->mort_schedule_desc . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->deed_number . '<input type="hidden" name="deed_number_' . $i . '" id="deed_number_' . $i . '" value="' . $key->deed_number . '"></td>';
                    $auction_data_str .= '<td align="center">' . $key->mortgage_date . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->valuator_name . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->valuator_date . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->valuator_mv . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->valuator_fsv . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->re_valuator_name . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->re_valuator_date . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->re_valuator_mv . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->re_valuator_fsv . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->gov_mouza_rate . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->land_area . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->bounded_by . '</td>';
                    $auction_data_str .= '</tr>';
                    $i++;
                }
                $auction_data_str .= '<input type="hidden" name="mortgage_counter_preview" id="mortgage_counter_preview" value="' . ($i - 1) . '">';
                $auction_data_str .= '</tbody>
                    </table>
                </div>';
            } else {
                $auction_data_str .= '<input type="hidden" name="mortgage_counter_preview" id="mortgage_counter_preview" value="0">';
            }
            if (!empty($security_info)) {
                $i = 1;
                $auction_data_str .= '<br/><div id="security_div" style="background-color:#eaeaea;padding:10px;overflow:scroll;margin-top:10px;padding-top:20px;">
                <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Security Info</span>
                <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:150%;margin:20px" >
                <thead>
                    <tr>
                        <td style="font-weight: bold;text-align:center">Deed Number</td>
                        <td style="font-weight: bold;text-align:center">Reg. Date</td>
                        <td style="font-weight: bold;text-align:center">Deed Type</td>
                        <td style="font-weight: bold;text-align:center">District</td>
                        <td style="font-weight: bold;text-align:center">Thana</td>
                        <td style="font-weight: bold;text-align:center">Sub Reg Office</td>
                        <td style="font-weight: bold;text-align:center">Mouza</td>
                        <td style="font-weight: bold;text-align:center">Land Area</td>
                        <td style="font-weight: bold;text-align:center">Plot Number</td>
                        <td style="font-weight: bold;text-align:center">Holding number</td>
                        <td style="font-weight: bold;text-align:center">Jote No.</td>
                        <td style="font-weight: bold;text-align:center">CS Khatian no.</td>
                        <td style="font-weight: bold;text-align:center">SA/PS Khatian no.</td>
                        <td style="font-weight: bold;text-align:center">RS /MRR Khatian no.</td>
                        <td style="font-weight: bold;text-align:center">BS/DP/ROR Khatian no.</td>
                        <td style="font-weight: bold;text-align:center">City Jorip Khatian no.</td>
                        <td style="font-weight: bold;text-align:center">Mutation Khatian no.</td>
                        <td style="font-weight: bold;text-align:center">CS Dag no.</td>
                        <td style="font-weight: bold;text-align:center">SA Dag no.</td>
                        <td style="font-weight: bold;text-align:center">RS Dag no.</td>
                        <td style="font-weight: bold;text-align:center">BS/DP Dag no.</td>
                        <td style="font-weight: bold;text-align:center">City Jorip Dag no.</td>
                    </tr>
                </thead>
                <tbody id="security_body">';
                foreach ($security_info as $key) {
                    $auction_data_str .= '<tr>';
                    $auction_data_str .= '<td align="center">' . $key->title_deed_number . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->reg_date . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->deed_type . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->district . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->thana . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->sub_reg_office . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->mouza . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->land_area . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->plot_number . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->holding_number . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->jote_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->cs_khatian_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->sa_khatian_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->rs_khatian_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->bs_dp_khatian_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->city_jorip_khatian_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->mutation_khatian_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->cs_dag_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->sa_dag_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->rs_dag_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->bs_dp_dag_no . '</td>';
                    $auction_data_str .= '<td align="center">' . $key->city_jorip_dag_no . '</td>';
                    $auction_data_str .= '</tr>';
                    $i++;
                }
                $auction_data_str .= '<input type="hidden" name="security_counter_preview" id="security_counter_preview" value="' . ($i - 1) . '">';
                $auction_data_str .= '</tbody>
                    </table>
                </div>';
            } else {
                $auction_data_str .= '<input type="hidden" name="security_counter_preview" id="security_counter_preview" value="0">';
            }
        } else {
            $auction_data_str .= 'No Data Found!';
        }
        if (!empty($bidder_info)) {
            $auction_data_str .= '<br/><div id="bidder_div" style="background-color:#eaeaea;padding:10px;margin-top:10px;overflow:scroll;padding-top:20px;">
            <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bidder Info</span>
            <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
            <thead>
                <tr>
                    <td style="font-weight: bold;text-align:center">Bidder Name</td>
                    <td style="font-weight: bold;text-align:center">Bidder Details</td>
                    <td style="font-weight: bold;text-align:center">Bidder Rank</td>
                    <td style="font-weight: bold;text-align:center">Selection</td>
                    <td style="font-weight: bold;text-align:center">Pay Order No</td>
                    <td style="font-weight: bold;text-align:center">Pay order date</td>
                    <td style="font-weight: bold;text-align:center">Pay Order Amount</td>
                    <td style="font-weight: bold;text-align:center">Bid Amount</td>
                    <td style="font-weight: bold;text-align:center">Rs Plot No</td>
                    <td style="font-weight: bold;text-align:center">Remarks</td>
                </tr>
            </thead>
            <tbody id="bidder_body">';
            $i = 1;
            foreach ($bidder_info as $key) {
                if ($key->selected == '1') {
                    $selected = "Selected";
                } else {
                    $selected = "";
                }
                $auction_data_str .= '<tr>';
                $auction_data_str .= '<td align="center">' . $key->bidder_name . '</td>';
                $auction_data_str .= '<td align="center">' . $key->bidder_details . '</td>';
                $auction_data_str .= '<td align="center">' . $key->bidder_rank . '</td>';
                $auction_data_str .= '<td align="center">' . $selected . '</td>';
                $auction_data_str .= '<td align="center">' . $key->pay_order_no . '</td>';
                $auction_data_str .= '<td align="center">' . $key->pay_order_date . '</td>';
                $auction_data_str .= '<td align="center">' . $key->pay_order_amount . '</td>';
                $auction_data_str .= '<td align="center">' . $key->bid_amount . '</td>';
                $auction_data_str .= '<td align="center">' . $key->r_s_plot_no . '</td>';
                $auction_data_str .= '<td align="center">' . $key->remarks . '</td>';
                $auction_data_str .= '</tr>';
                $i++;
            }
            $auction_data_str .= '<input type="hidden" name="bidder_info_counter" id="bidder_info_counter" value="' . ($i - 1) . '">';
            $auction_data_str .= '</tbody>
                    </table>
                </div>';
        }
        if (!empty($suit_file_details)) {
            if ($suit_file_details->arji_copy != '') {
                $arji_copy = '<img id="file_preview" onclick="popup(\'' . base_url() . 'cma_file/arji_copy/' . $suit_file_details->arji_copy . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
            } else {
                $arji_copy = "";
            }
            $other_document_str .= '
            <tr>
                    <td width="50%" align="left"><strong>Arji Copy:</strong>' . $arji_copy . '</td>
                    <td width="50%" align="left"></td>
            </tr>';
            $suit_data_str .= '<br/>';
            $suit_data_str .= '<table style="width: 100%;" id="preview_table" class="suit_file">
                <thead>
                <tr>
                    <td colspan="2" style="font-size:20px;font-weight:bold;text-align:center">Suit File Info</td>
                </tr>
                </thead>
                <tbody id="details_body" id="suit_file">
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
            $suit_data_str .= '</tbody>
                </table>';
        }
        $other_document_str .= '
                </tbody>
            </table>';
        $var = array(
            "cma_str" => $cma_str,
            "other_document_str" => $other_document_str,
            "suit_data_str" => $suit_data_str,
            "auction_data_str" => $auction_data_str,
            "final_legal_notice_str" => $final_legal_notice_str,
            "legal_notice_str" => $legal_notice_str,
            "csrf_token" => $csrf_token
        );
        echo json_encode($var);
    }















}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
