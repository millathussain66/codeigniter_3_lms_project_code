<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Case_report extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('Case_report_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
        $this->load->model('User_model', '', TRUE);
    }
    /* ==== Basic Reporting Format =================*/

    function br_bb_report($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/br_bb_report';
        $result = $this->Case_report_model->get_br_bb_result();
        $result2 = $this->Case_report_model->get_tpsq_result();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $this->input->post('filing_year');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'result'=> $result,
            'result2'=> $result2,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/basic_report';
        $this->load->view('grid_layout',$data);
    }
    function crmr($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){

    }
    function financial_indicator($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/financial_indicator';
        $result = $this->Case_report_model->get_finiancial_indicator_result();
        $current_month = date('m');
        $current_year = date('Y');
        $column_name1='';
        $column_name2='';
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $this->input->post('filing_year');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
            $current_month = ($this->input->post('entry_month')!='')?$this->input->post('entry_month'):date('m');
            $current_year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
        }
        if($current_month<=6)
        {
            $column_name1='Amount of Taka<br>(Previous Month)<br>December\''.($current_year-1);
            $column_name2='Current Month<br>(June,'.$current_year.')';
        }
        else
        {
            $column_name1='Amount of Taka<br>(Previous Month)<br>June\''.$current_year;
            $column_name2='Current Month<br>(December,'.$current_year.')';
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'result'=> $result,
            'column_name1'=> $column_name1,
            'column_name2'=> $column_name2,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/basic_report';
        $this->load->view('grid_layout',$data);
    }
    function iss_report($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/iss_report';
        $result = $this->Case_report_model->get_iss_result();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $this->input->post('filing_year');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'result'=> $result,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/basic_report';
        $this->load->view('grid_layout',$data);
    }
    /* ==== Performance Summary Dashboards =================*/
    function protfolio_summery ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/protfolio_summery';
        $summery_result = $this->Case_report_model->get_protfolio_summery_result();
        $disposal_summery = $this->Case_report_model->get_disposal_summery_result();
        $new_filling_summery = $this->Case_report_model->get_new_filling_summery_result();
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'summery_result'=> $summery_result,
            'disposal_summery'=> $disposal_summery,
            'new_filling_summery'=> $new_filling_summery,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
           );
        $data['pages']='case_report/pages/grid';
        $this->load->view('grid_layout',$data);
    }
    function case_wise_summery ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/case_wise_summery';
        $summery_result = $this->Case_report_model->get_case_wise_summery_result();
        $disposal_summery = $this->Case_report_model->get_disposal_summery_case_wise_result();
        $new_filling_summery = $this->Case_report_model->get_new_filling_summery_case_wise_result();
        //echo '<pre>';
        //print_r($new_filling_summery);
        //exit;
        $dist='';
        $zone='';
        $date_from='';
        $date_to='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'summery_result'=> $summery_result,
            'disposal_summery'=> $disposal_summery,
            'new_filling_summery'=> $new_filling_summery,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'date_from'=> $date_from,
            'date_to'=> $date_to,
           );
        $data['pages']='case_report/pages/grid';
        $this->load->view('grid_layout',$data);
    }
    function ac_wise_summery ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/ac_wise_summery';
        $summery_result = $this->Case_report_model->get_case_wise_summery_result();
        $disposal_summery = $this->Case_report_model->get_disposal_summery_case_wise_result();
        $new_filling_summery = $this->Case_report_model->get_new_filling_summery_case_wise_result();
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'summery_result'=> $summery_result,
            'disposal_summery'=> $disposal_summery,
            'new_filling_summery'=> $new_filling_summery,
            'per_page' => $this->config->item('per_pagess'),

           );
        $data['pages']='case_report/pages/grid';
        $this->load->view('grid_layout',$data);
    }
    function ac_wise_legal_cost(){
        $loan_ac = $this->input->post('loan_ac');
        $proposed_type = $this->input->post('proposed_type');
        $rows='';
        $rows = $this->Case_report_model->get_ac_wise_legal_cost();
        
        $var = array();
        $var['csrf_token']=$this->security->get_csrf_hash();
        $var['rows']=$rows;
        echo json_encode($var);
    }
    function segment_wise_summery ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/segment_wise_summery';
        $summery_result = $this->Case_report_model->get_segment_wise_summery_result_report();
        $disposal_summery = $this->Case_report_model->get_disposal_summery_segment_wise_result();
        $new_filling_summery = $this->Case_report_model->get_new_filling_summery_segment_wise_result();
        $ongoing_summery = $this->Case_report_model->get_ongoing_summery_segment_wise_result();
        $dist='';
        $zone='';
        $date_from='';
        $date_to='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'summery_result'=> $summery_result,
            'disposal_summery'=> $disposal_summery,
            'req_type' => $this->user_model->get_parameter_data('ref_req_type','id',"data_status = '1'"),
            'new_filling_summery'=> $new_filling_summery,
            'ongoing_summery'=> $ongoing_summery,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'date_from'=> $date_from,
            'date_to'=> $date_to,
           );
        $data['pages']='case_report/pages/grid';
        $this->load->view('grid_layout',$data);
    }
    function officer_wise_summery ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/officer_wise_summery';
        $summery_result = $this->Case_report_model->get_officer_wise_summery_result();
        $disposal_summery = $this->Case_report_model->get_disposal_summery_officer_wise_result();
        $disposal_summery_month_wise = $this->Case_report_model->get_disposal_summery_month_wise();
        $new_filing_month_wise = $this->Case_report_model->get_new_filing_month_wise();
        $new_filling_summery = $this->Case_report_model->get_new_filling_summery_officer_wise_result();
        $ongoing_summery = $this->Case_report_model->get_ongoing_summery_officer_wise_result();
        $dist='';
        $zone='';
        $date_from='';
        $date_to='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'summery_result'=> $summery_result,
            'disposal_summery'=> $disposal_summery,
            'disposal_summery_month_wise'=> $disposal_summery_month_wise,
            'new_filing_month_wise'=> $new_filing_month_wise,
            'req_type' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'new_filling_summery'=> $new_filling_summery,
            'ongoing_summery'=> $ongoing_summery,
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'date_from'=> $date_from,
            'date_to'=> $date_to,
            'per_page' => $this->config->item('per_pagess'),

           );
        $data['pages']='case_report/pages/grid';
        $this->load->view('grid_layout',$data);
    }
    function disposal_summery ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/disposal_summery';
        $summery_result = $this->Case_report_model->get_disposal_result();
        $summery_result_year_wise = $this->Case_report_model->get_disposal_result_year_wise();
        $summery_result_month_wise = $this->Case_report_model->get_disposal_result_month_wise();
        $dist='';
        $zone='';
        $date_from='';
        $date_to='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'summery_result'=> $summery_result,
            'summery_result_year_wise'=> $summery_result_year_wise,
            'summery_result_month_wise'=> $summery_result_month_wise,
            'req_type' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'date_from'=> $date_from,
            'date_to'=> $date_to,
            'per_page' => $this->config->item('per_pagess'),

           );
        $data['pages']='case_report/pages/grid';
        $this->load->view('grid_layout',$data);
    }
    function case_update_summery ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/case_update_summery';
        $summery_result = $this->Case_report_model->get_case_update_summery_result();
        $summery_officer_result = $this->Case_report_model->get_case_update_summery_officer_result();
        $summery_officer_week_result = $this->Case_report_model->get_case_update_summery_officer_week_result();
        $summery_nature_week_result = $this->Case_report_model->get_case_update_summery_nature_week_result();
        $summery_step_week_result = $this->Case_report_model->get_case_update_summery_step_week_result();
        $summery_result_next_step_wise = $this->Case_report_model->get_case_update_summery_result_next_step_wise();
        $summery_result_deal_officer_wise = $this->Case_report_model->get_case_update_summery_result_deal_officer_wise();
        $dist='';
        $zone='';
        $date_from='';
        $date_to='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'summery_result'=> $summery_result,
            'summery_step_week_result'=> $summery_step_week_result,
            'summery_nature_week_result'=> $summery_nature_week_result,
            'summery_officer_result'=> $summery_officer_result,
            'summery_officer_week_result'=> $summery_officer_week_result,
            'summery_result_next_step_wise'=> $summery_result_next_step_wise,
            'summery_result_deal_officer_wise'=> $summery_result_deal_officer_wise,
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'date_from'=> $date_from,
            'date_to'=> $date_to,
            'per_page' => $this->config->item('per_pagess'),

           );
        $data['pages']='case_report/pages/grid';
        $this->load->view('grid_layout',$data);
    }
    function case_activity_report ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/case_activity_report';
        $prv_step = $this->Case_report_model->get_activity_prv_step_report();
        $next_step = $this->Case_report_model->get_activity_next_step_report();
        $cdo='';
        $nature='';
        $segment='';
        $dist='';
        $zone='';
        if(isset($_POST['search_btn'])){
            $cdo = $this->input->post('cdo');
            $nature = $this->input->post('nature');
            $segment = $this->input->post('segment');
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'cdo_select'=> $cdo,
            'nature_select'=> $nature,
            'segment_select'=> $segment,
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'report_select'=> $report_select,
            'cdo'=> $this->User_model->get_parameter_data('users_info','name','user_group_id in (11)'),
            'nature'=> $this->User_model->get_parameter_data('ref_req_type','name','data_status<>0'),
            'segment'=> $this->User_model->get_parameter_data('ref_loan_segment','name','data_status <>0'),
            'district'=> $this->User_model->get_parameter_data('ref_district','name','data_status <>0'),
            'zone'=> $this->User_model->get_parameter_data('ref_zone','name','data_status <>0'),
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'prv_step'=> $prv_step,
            'next_step'=> $next_step,
            'per_page' => $this->config->item('per_pagess'),

           );
        $data['pages']='case_report/pages/grid';
        $this->load->view('grid_layout',$data);
    }



    /* ==== Summary on account closed report =================*/

    function vintage_analysis($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/vintage_analysis';
        $year_wise = $this->Case_report_model->get_year_wise_case_filing();
        $disposal_summery = $this->Case_report_model->get_filing_year_wise_case_dispose();
        $dispose_stage = $this->Case_report_model->get_filing_year_dispose_stage();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $this->input->post('disposal_year');
            $month = $this->input->post('disposal_month');
        }else{
            $year = date('Y');
        }

        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'year_wise'=> $year_wise,
            'disposal_summery'=> $disposal_summery,
            'dispose_stage'=> $dispose_stage,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
           );
        $data['pages']='case_report/pages/ac_close';
        $this->load->view('grid_layout',$data);
    }
    function closed_accounts($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/closed_accounts';
        $close_acc = $this->Case_report_model->get_close_accounts();
        $dispos_close_acc = $this->Case_report_model->get_dispos_close_acc_summ();
        $ongoing_close_acc = $this->Case_report_model->get_ongoing_close_acc_summary();
        $ongoing_step_close = $this->Case_report_model->get_ongoing_step_close_acc();
        $nature_week = $this->Case_report_model->get_ongoing_ac_close_nature_week_result();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $this->input->post('disposal_year');
            $month = $this->input->post('disposal_month');
        }else{
            $year = date('Y');
        }

        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'close_acc'=> $close_acc,
            'dispos_close_acc'=> $dispos_close_acc,
            'ongoing_close_acc'=> $ongoing_close_acc,
            'ongoing_step_close'=> $ongoing_step_close,
            'nature_week'=> $nature_week,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
           );
        $data['pages']='case_report/pages/ac_close';
        $this->load->view('grid_layout',$data);
    }
    function lawyer_performance($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/lawyer_performance';
        $law_sum = $this->Case_report_model->get_law_wise_summary();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $year = ($this->input->post('disposal_year')!='')?$this->input->post('disposal_year'):date('Y');
            $month = $this->input->post('disposal_month');
        }else{
            $year = date('Y');
        }

        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'law_sum'=> $law_sum,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
           );
        $data['pages']='case_report/pages/ac_close';
        $this->load->view('grid_layout',$data);
    }
    function vintage_law_firms($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/vintage_law_firms';
        $law_sum = $this->Case_report_model->get_law_firm_vintage_summary();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
            $month = $this->input->post('entry_month');
        }else{
            $year = date('Y');
        }

        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'law_sum'=> $law_sum,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
           );
        $data['pages']='case_report/pages/ac_close';
        $this->load->view('grid_layout',$data);
    }
    function branch($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/branch';
        $branch_sum = $this->Case_report_model->get_branch_summary();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $this->input->post('filing_year');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
        }

        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'branch_sum'=> $branch_sum,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/ac_close';
        $this->load->view('grid_layout',$data);
    }
    function district($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/district';
        $district_sum = $this->Case_report_model->get_district_summary();
        $dist='';
        $zone='';
        $district='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $district = $this->input->post('district');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $this->input->post('filing_year');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
        }

        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'district_sum'=> $district_sum,
            'per_page' => $this->config->item('per_pagess'),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'zone_select'=> $zone,
            'district_select'=> $district,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/ac_close';
        $this->load->view('grid_layout',$data);
    }
    function court_location_wise_summary($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/court_location_wise_summary';
        $district_sum = $this->Case_report_model->get_court_location_summary();
        $dist='';
        $zone='';
        $district='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year='';
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $zone = $this->input->post('zone');
            $district = $this->input->post('district');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = $this->input->post('filing_year');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
        }

        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'district_sum'=> $district_sum,
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'per_page' => $this->config->item('per_pagess'),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'court_location' => $this->user_model->get_parameter_data('ref_court','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'zone_select'=> $zone,
            'district_select'=> $district,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/ac_close';
        $this->load->view('grid_layout',$data);
    }
    
    /* ==== Legal Notice & Recovery =================*/

    function summary_filing_instraction($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/summary_filing_instraction';
        $result = $this->Case_report_model->get_case_filing_instruction_all();
        $result2 = $this->Case_report_model->case_file_instruction_type_wise();
        $result3 = $this->Case_report_model->case_filed_type_wise();
        $result4 = $this->Case_report_model->case_filed_instruction_monthly();
        $result5 = $this->Case_report_model->case_filed_monthly();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year=date('Y');
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'result'=> $result,
            'result2'=> $result2,
            'result3'=> $result3,
            'result4'=> $result4,
            'result5'=> $result5,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/legal_notice';
        $this->load->view('grid_layout',$data);
    }
    function summary_legal_notice($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){

    }
    function law_wise_legal_notice($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/law_wise_legal_notice';
        $result = $this->Case_report_model->get_law_wise_legal_notice();
        $result2 = $this->Case_report_model->get_law_wise_legal_notice_month();
        $result3 = $this->Case_report_model->get_law_wise_legal_notice_type();
        $dist='';
        $zone='';
        $year=date('Y');
        $month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $year = ($this->input->post('ln_year')!='')?$this->input->post('ln_year'):date('Y');
            $month = $this->input->post('entry_month');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'result'=> $result,
            'result2'=> $result2,
            'result3'=> $result3,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'ln_type' => $this->user_model->get_parameter_data('ref_legal_notice_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'year'=> $year,
            'month'=> $month
           );
        $data['pages']='case_report/pages/legal_notice';
        $this->load->view('grid_layout',$data);
    }
    function summary_recovery($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/summary_recovery';
        $result = $this->Case_report_model->get_recovery_result_year_wise();
        $result2 = $this->Case_report_model->get_recovery_result_month_wise();
        $result3 = array();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year=date('Y');
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'result'=> $result,
            'result2'=> $result2,
            'result3'=> $result3,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/legal_notice';
        $this->load->view('grid_layout',$data);
    }
    function summary_next_step($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $report_list = $this->Common_model->report_list($menu_group,$menu_cat,$menu_link,$sub_cat);
        $report_select = 'case_report/summary_next_step';
        $result = $this->Case_report_model->get_case_filing_next_step_summery();
        $dist='';
        $zone='';
        $branch='';
        $filed_type='';
        $case_sts='';
        $nature_suit='';
        $next_step='';
        $year=date('Y');
        $disposal_year='';
        $month='';
        $disposal_month='';
        if(isset($_POST['search_btn'])){
            $dist = $this->input->post('district');
            $zone = $this->input->post('zone');
            $branch = $this->input->post('branch');
            $filed_type = $this->input->post('filed_type');
            $case_sts = $this->input->post('case_sts');
            $nature_suit = $this->input->post('nature_suit');
            $next_step = $this->input->post('next_step');
            $year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
            $month = $this->input->post('entry_month');
            $disposal_month = $this->input->post('disposal_month');
            $disposal_year = $this->input->post('disposal_year');
        }
        $data = array(
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'menu_group'=> $menu_group,
            'report_select'=> $report_select,
            'menu_cat'=> $menu_cat,
            'report_list'=> $report_list,
            'result'=> $result,
            'per_page' => $this->config->item('per_pagess'),
            'district' => $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'"),
            'zone' => $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'"),
            'branch' => $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status = '1'"),
            'case_sts' => $this->user_model->get_parameter_data('ref_case_sts','name',"data_status = '1'"),
            'filed_type' => $this->user_model->get_parameter_data('ref_request_type','name',"data_status = '1'"),
            'nature_suit' => $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'"),
            'dist_select'=> $dist,
            'zone_select'=> $zone,
            'branch_select'=> $branch,
            'filed_type_select'=> $filed_type,
            'case_sts_select'=> $case_sts,
            'nature_suit_select'=> $nature_suit,
            'next_step_select'=> $next_step,
            'year'=> $year,
            'month'=> $month,
            'disposal_year'=> $disposal_year,
            'disposal_month'=> $disposal_month,
           );
        $data['pages']='case_report/pages/legal_notice';
        $this->load->view('grid_layout',$data);
    }


    // ========= Make Xl For All Report ===========
    function mk_xl(){
        $result=array();
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
        $rowNumber = 1;
        if($this->input->post('report_list')=='case_report/branch')
        {
            $result = $this->Case_report_model->get_branch_summary();
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            
            $headings1 = array('Name of Branch','Ongoing','','','Disposal','','','Total Cases','','');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1)); 
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':G'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowNumber.':J'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('','Number','Suit Value','Total Recovery','Number','Suit Value','Total Recovery','Number','Suit Value','Total Recovery');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $total_ongoing1=0;
            $total_ongoing2=0;
            $total_ongoing3=0;
            $total_disposal1=0;
            $total_disposal2=0;
            $total_disposal3=0;
            $grand_total1=0;
            $grand_total2=0;
            $grand_total3=0;
            foreach($result as $key)
            {
                $total_ongoing1=$total_ongoing1+$key->ongoing_cases;
                $total_ongoing2=$total_ongoing2+$key->ongoing_case_claim_amount;
                $total_ongoing3=$total_ongoing3+$key->ongoing_recovery;
                $total_disposal1=$total_disposal1+$key->disposal;
                $total_disposal2=$total_disposal2+$key->disposal_case_claim_amount;
                $total_disposal3=$total_disposal3+$key->disposal_recovery;
                $grand_total1=$grand_total1+$key->total_cases;
                $grand_total2=$grand_total2+$key->total_suit_value;
                $grand_total3=$grand_total3+$key->total_recovery;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $key->branch_name,
                    $key->ongoing_cases,
                    number_format($key->ongoing_case_claim_amount/10000000,2),
                    number_format($key->ongoing_recovery/10000000,2),
                    $key->disposal,
                    number_format($key->disposal_case_claim_amount/10000000,2),
                    number_format($key->disposal_recovery/10000000,2),
                    $key->total_cases,
                    number_format($key->total_suit_value/10000000,2),
                    number_format($key->total_recovery/10000000,2)
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
            }

            $objPHPExcel->getActiveSheet()->fromArray(array(
                'Total',
                $total_ongoing1,
                number_format($total_ongoing2/10000000,2),
                number_format($total_ongoing3/10000000,2),
                $total_disposal1,
                number_format($total_disposal2/10000000,2),
                number_format($total_disposal3/10000000,2),
                $grand_total1,
                number_format($grand_total2/10000000,2),
                number_format($grand_total3/10000000,2)
                ),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
            $rowNumber++;
        }
        else if($this->input->post('report_list')=='case_report/district')
        {
            $result = $this->Case_report_model->get_district_summary();
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            
            $headings1 = array('Name of District','Ongoing','','','Disposal','','','Total Cases','','');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1)); 
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':G'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowNumber.':J'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('','Number','Suit Value','Total Recovery','Number','Suit Value','Total Recovery','Number','Suit Value','Total Recovery');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $total_ongoing1=0;
            $total_ongoing2=0;
            $total_ongoing3=0;
            $total_disposal1=0;
            $total_disposal2=0;
            $total_disposal3=0;
            $grand_total1=0;
            $grand_total2=0;
            $grand_total3=0;
            foreach($result as $key)
            {
                $total_ongoing1=$total_ongoing1+$key->ongoing_cases;
                $total_ongoing2=$total_ongoing2+$key->ongoing_case_claim_amount;
                $total_ongoing3=$total_ongoing3+$key->ongoing_recovery;
                $total_disposal1=$total_disposal1+$key->disposal;
                $total_disposal2=$total_disposal2+$key->disposal_case_claim_amount;
                $total_disposal3=$total_disposal3+$key->disposal_recovery;
                $grand_total1=$grand_total1+$key->total_cases;
                $grand_total2=$grand_total2+$key->total_suit_value;
                $grand_total3=$grand_total3+$key->total_recovery;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $key->district_name,
                    $key->ongoing_cases,
                    number_format($key->ongoing_case_claim_amount/10000000,2),
                    number_format($key->ongoing_recovery/10000000,2),
                    $key->disposal,
                    number_format($key->disposal_case_claim_amount/10000000,2),
                    number_format($key->disposal_recovery/10000000,2),
                    $key->total_cases,
                    number_format($key->total_suit_value/10000000,2),
                    number_format($key->total_recovery/10000000,2)
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
            }

            $objPHPExcel->getActiveSheet()->fromArray(array(
                'Total',
                $total_ongoing1,
                number_format($total_ongoing2/10000000,2),
                number_format($total_ongoing3/10000000,2),
                $total_disposal1,
                number_format($total_disposal2/10000000,2),
                number_format($total_disposal3/10000000,2),
                $grand_total1,
                number_format($grand_total2/10000000,2),
                number_format($grand_total3/10000000,2)
                ),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
            $rowNumber++;
        }
        else if($this->input->post('report_list')=='case_report/iss_report')
        {
            $result = $this->Case_report_model->get_iss_result();
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            
            $headings1 = array('Sol Code','Branch Name','Ongoing Cases (By Bank)','Suit Value','Recovery against Ongoing Cases for this accounting year up to the reporting month','Total Expenses incurred by the branch against suit cases for this accounting year up to the reporting month','Number of Withdrawn Cases (By Bank) for this accounting year up to the reporting month','Total amount recovered by the branch against disposal cases for this accounting year up to the reporting month');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            
            $total_suit=0;
            $total_suit_value=0;
            $total_recovery_ongoing=0;
            $total_recovery_disposal=0;
            $total_withdrawl=0;
            foreach($result as $key)
            {
                $total_suit+=$key->ongoing_cases;
                $total_suit_value+=$key->ongoing_case_claim_amount;
                $total_recovery_ongoing+=$key->ongoing_recovery;
                $total_recovery_disposal+=$key->disposal_recovery;
                $total_withdrawl+=$key->withdraw_cases;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $key->branch_sol,
                    $key->branch_name,
                    $key->ongoing_cases,
                    $key->ongoing_case_claim_amount,
                    $key->ongoing_recovery,
                    '',
                    $key->withdraw_cases,
                    $key->disposal_recovery
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit(('A'.$rowNumber), $key->branch_sol, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
            }

            $objPHPExcel->getActiveSheet()->fromArray(array(
                'Total',
                '',
                $total_suit,
                number_format($total_suit_value,2),
                $total_recovery_ongoing,
                '',
                $total_withdrawl,
                $total_recovery_disposal
                ),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $rowNumber++;
        }
        else if($this->input->post('report_list')=='case_report/br_bb_report')
        {
            $result = $this->Case_report_model->get_br_bb_result();
            $result2 = $this->Case_report_model->get_tpsq_result();
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            
            $headings1 = array('BR4 BB Report');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':K'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Serial No','Nature of Suit','Total Case Filed','','','Total Disposal Cases','','','Total Ongoing Cases','','');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1)); 
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1)); 
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':E'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':H'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowNumber.':K'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('','','Number','Suit Value','Total Recovery','Number','Suit Value','Total Recovery','Number','Suit Value','Total Recovery');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            
            $total1=0;
            $total2=0;
            $total3=0;
            $total4=0;
            $total5=0;
            $total6=0;
            $total7=0;
            $total8=0;
            $total_r=0;
            $total_dr=0;
            $total_or=0;
            $sl=0;
            foreach($result as $key)
            {
                $sl++;  
                $total1+=$key->total_filed;
                $total2+=$key->total_filed_amount;
                $total3+=$key->total_disposal;
                $total4+=$key->total_disposal_amount;
                $total6+=$key->total_ongoing;
                $total7+=$key->total_ongoing_amount;
                $total_r+=$key->total_recovery;
                $total_dr+=$key->total_disposal_recovery;
                $total_or+=$key->total_ongoing_recovery;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $sl,
                    $key->nature_of_suit,
                    $key->total_filed,
                    number_format($key->total_filed_amount/10000000,2),
                    number_format($key->total_recovery/10000000,2),
                    $key->total_disposal,
                    number_format($key->total_disposal_amount/10000000,2),
                    number_format($key->total_disposal_recovery/10000000,2),
                    $key->total_ongoing,
                    number_format($key->total_ongoing_amount/10000000,2),
                    number_format($key->total_ongoing_recovery/10000000,2)
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
            }

            $objPHPExcel->getActiveSheet()->fromArray(array(
                'Total',
                '',
                $total1,
                number_format($total2/10000000,2),
                number_format($total_r/10000000,2),
                $total3,
                number_format($total4/10000000,2),
                number_format($total_dr/10000000,2),
                $total6,
                number_format($total7/10000000,2),
                number_format($total_or/10000000,2),
                ),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $rowNumber++;
            $rowNumber++;
            $rowNumber++;

            $headings1 = array('DBI22; TPSQ Report');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':K'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Serial No','Nature of Suit','For upto 5-Years','','','For more than 5-Years','','','Total Ongoing Cases','','');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1)); 
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1)); 
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':E'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':H'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowNumber.':K'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('','','Number','Suit Value','Total Recovery','Number','Suit Value','Total Recovery','Number','Suit Value','Total Recovery');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            
            $total1=0;
            $total2=0;
            $total3=0;
            $total4=0;
            $total5=0;
            $total6=0;
            $total7=0;
            $total8=0;
            $total9=0;
            $total_rec1=0;
            $total_rec2=0;
            $total_rec3=0;
            $sl=0;
            foreach($result2 as $key)
            {
                $sl++;  
                $total1+=$key->upto_five_year;
                $total2+=$key->upto_five_year_amount;
                $total4+=$key->down_five_year;
                $total5+=$key->down_five_year_amount;
                $total7+=$key->total_ongoing;
                $total8+=$key->total_ongoing_amount;
                $total_rec1+=$key->down_five_year_recovery;
                $total_rec2+=$key->upto_five_year_recovery;
                $total_rec3+=$key->total_ongoing_recovery;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $sl,
                    $key->nature_of_suit,
                    $key->upto_five_year,
                    number_format($key->upto_five_year_amount/10000000,2),
                    number_format($key->upto_five_year_recovery/10000000,2),
                    $key->down_five_year,
                    number_format($key->down_five_year_amount/10000000,2),
                    number_format($key->down_five_year_recovery/10000000,2),
                    $key->total_ongoing,
                    number_format($key->total_ongoing_amount/10000000,2),
                    number_format($key->total_ongoing_recovery/10000000,2)
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
            }

            $objPHPExcel->getActiveSheet()->fromArray(array(
                'Total',
                '',
                $total1,
                number_format($total2/10000000,2),
                number_format($total_rec2/10000000,2),
                $total4,
                number_format($total5/10000000,2),
                number_format($total_rec1/10000000,2),
                $total7,
                number_format($total8/10000000,2),
                number_format($total_rec3/10000000,2),
                ),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':K'.$rowNumber)->getAlignment()->setWrapText(true);
            $rowNumber++;

        }

        else if($this->input->post('report_list')=='case_report/summary_filing_instraction')
        {
            $result = $this->Case_report_model->get_case_filing_instruction_all();
            $result2 = $this->Case_report_model->case_file_instruction_type_wise();
            $result3 = $this->Case_report_model->case_filed_type_wise();
            $result4 = $this->Case_report_model->case_filed_instruction_monthly();
            $result5 = $this->Case_report_model->case_filed_monthly();
            $year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
            
            $headings1 = array('Case Filing Instructions');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':H'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Particulars');
            $current_year = $year;
            for ($j=$current_year; $j >=$current_year-5 ; $j--)
            {
                ${'total_' . $j} = 0;
                array_push($headings1,$j);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Number of Instructions');
            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                $name = 'count_request_'.$j;
                ${'total_' . $j} = ${'total_' . $j}+$result[0]->$name;
                array_push($headings1,$result[0]->$name);
            }
            array_push($headings1,$result[0]->grand_total_request);
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;

            $headings1 = array('Number of Case Filed');
            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                $name = 'count_request_'.$j;
                ${'total_' . $j} = ${'total_' . $j}+$result[1]->$name;
                array_push($headings1,$result[1]->$name);
            }
            array_push($headings1,$result[1]->grand_total_request);
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $rowNumber++;
            $rowNumber++;

            $headings1 = array('Case Filing Instructions');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':H'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Nature of Case');
            $current_year = $year;
            for ($j=$current_year; $j >=$current_year-5 ; $j--)
            {
                ${'total_' . $j} = 0;
                array_push($headings1,$j);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            foreach ($result2 as $key) {
                $headings1 = array($key->request_type);
                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                    $name = 'count_suit_'.$j;
                    ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                    array_push($headings1,$key->$name);
                }
                array_push($headings1,$key->grand_total_suit);
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            $rowNumber++;

            $headings1 = array('Number of Case Filed');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':H'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Nature of Case');
            $current_year = $year;
            for ($j=$current_year; $j >=$current_year-5 ; $j--)
            {
                ${'total_' . $j} = 0;
                array_push($headings1,$j);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            foreach ($result3 as $key) {
                $headings1 = array($key->request_type);
                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                    $name = 'count_suit_'.$j;
                    ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                    array_push($headings1,$key->$name);
                }
                array_push($headings1,$key->grand_total_suit);
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            $rowNumber++;
            $rowNumber++;
            $rowNumber++;
            $rowNumber++;

            $headings1 = array('Case Filing Instructions');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':N'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Nature of Case');
            for ($i=1; $i <=12 ; $i++) { 
                ${'total_' . $i} = 0;
                $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                array_push($headings1,$month);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            foreach ($result4 as $key) {
                $headings1 = array($key->request_type);
                for ($i=1; $i <=12 ; $i++) { 
                    $month = 'count_'.$i;
                    ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                    array_push($headings1,$key->$month);
                }
                array_push($headings1,$key->grand_total_suit);
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            $rowNumber++;

            $headings1 = array('Number of Case Filed');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':N'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Nature of Case');
            for ($i=1; $i <=12 ; $i++) { 
                ${'total_' . $i} = 0;
                $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                array_push($headings1,$month);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            foreach ($result5 as $key) {
                $headings1 = array($key->request_type);
                for ($i=1; $i <=12 ; $i++) { 
                    $month = 'count_'.$i;
                    ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                    array_push($headings1,$key->$month);
                }
                array_push($headings1,$key->grand_total_suit);
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            $rowNumber++;


        }

        else if($this->input->post('report_list')=='case_report/law_wise_legal_notice')
        {
            $result = $this->Case_report_model->get_law_wise_legal_notice();
            $result2 = $this->Case_report_model->get_law_wise_legal_notice_month();
            $result3 = $this->Case_report_model->get_law_wise_legal_notice_type();
            $year = ($this->input->post('ln_year')!='')?$this->input->post('ln_year'):date('Y');
            $ln_type = $this->user_model->get_parameter_data('ref_legal_notice_type','name',"data_status = '1'");
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
            
            $headings1 = array('Legal Notice');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':I'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Law Firm/Chamber','Lawyers\' Name');
            $current_year = $year;
            for ($j=$current_year; $j >=$current_year-5 ; $j--)
            {
                ${'total_' . $j} = 0;
                array_push($headings1,$j);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            foreach($result as $key)
            {
                $headings1 = array($key->law_chamber,$key->lawyer_name);
                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                    $name = 'count_'.$j;
                    ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                    array_push($headings1,$key->$name);
                }
                array_push($headings1,$key->grand_total);
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':I'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            
            
            

            $rowNumber++;
            $rowNumber++;
            $rowNumber++;

            $headings1 = array('Law Firm/Chamber','Lawyers\' Name');
            for ($i=1; $i <=12 ; $i++) { 
                ${'total_' . $i} = 0;
                $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                array_push($headings1,$month);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            foreach ($result2 as $key) {
                $headings1 = array($key->law_chamber,$key->lawyer_name);
                for ($i=1; $i <=12 ; $i++) { 
                    $month = 'count_'.$i;
                    ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                    array_push($headings1,$key->$month);
                }
                array_push($headings1,$key->grand_total);
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            $rowNumber++;
            $rowNumber++;
            $rowNumber++;

            
            $headings1 = array('Law Firm/Chamber','Lawyers\' Name');
            foreach($ln_type as $key)
            {
                array_push($headings1,$key->name);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            foreach ($result3 as $key) {
                $headings1 = array($key->law_chamber,$key->lawyer_name);
                foreach ($ln_type as $key2) { //for Year loop
                    $name = 'count_'.$key2->id;
                    ${'total_' . $key2->id} = ${'total_' . $key2->id}+$key->$name;
                    array_push($headings1,$key->$name);
                }
                array_push($headings1,$key->grand_total);
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            $rowNumber++;
            $rowNumber++;
        }

        else if($this->input->post('report_list')=='case_report/summary_next_step')
        {
            $result = $this->Case_report_model->get_case_filing_next_step_summery();
            $year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
            
            $headings1 = array('Case Filing');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':H'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Next Steps (Ongoing Cases)');
            $current_year = $year;
            for ($j=$current_year; $j >=$current_year-5 ; $j--)
            {
                ${'total_' . $j} = 0;
                array_push($headings1,$j);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $total=0;
            foreach($result as $key)
            {
            $total=$total+$key->grand_total_suit;
                $headings1 = array($key->next_sts);
                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                    $name = 'count_'.$j;
                    ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                    array_push($headings1,$key->$name);
                }
                array_push($headings1,$key->grand_total_suit);
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            
            $headings1 = array('Total');
            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                array_push($headings1,${'total_' . $j});
            }
            array_push($headings1,$total);
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            


        }
        else if($this->input->post('report_list')=='case_report/summary_recovery')
        {
            $result = $this->Case_report_model->get_recovery_result_year_wise();
            $result2 = $this->Case_report_model->get_recovery_result_month_wise();
            $year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
            
            $headings1 = array('Recovery Report');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':H'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Particulars');
            $current_year = $year;
            for ($j=$current_year; $j >=$current_year-5 ; $j--)
            {
                ${'total_' . $j} = 0;
                array_push($headings1,$j);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $total=0;
            $grand_total = 0;
            foreach($result as $key)
            {
                $total=0;
                $headings1 = array($key->type);
                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                    $name = 'amount_'.$j;
                    ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                    $total=$total+$key->$name;
                    array_push($headings1,number_format($key->$name,2));
                }
                $grand_total = $grand_total+$total;
                array_push($headings1,number_format($total,2));
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }

            $headings1 = array('Total');
            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                array_push($headings1,number_format(${'total_' . $j},2));
            }
            array_push($headings1,number_format($grand_total,2));
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $rowNumber++;
            $rowNumber++;

            $headings1 = array('Recovery');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':N'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $headings1 = array('Particulars');
            for ($i=1; $i <=12 ; $i++) { 
                ${'total_' . $i} = 0;
                $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                array_push($headings1,$month);
            }
            array_push($headings1,"Total");
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            $total=0;
            $grand_total=0;
            foreach ($result2 as $key) {
                $headings1 = array($key->type);
                $total=0;
                for ($i=1; $i <=12 ; $i++) { 
                    $month = 'amount_'.$i;
                    ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                    array_push($headings1,number_format($key->$month,2));
                    $total=$total+$key->$month;
                }
                $grand_total=$grand_total+$total;
                array_push($headings1,number_format($total,2));
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
            }
            $headings1 = array('Total');
                $total=0;
                for ($i=1; $i <=12 ; $i++) { 
                    array_push($headings1,number_format(${'total_' . $i},2));
                }
                array_push($headings1,number_format($grand_total,2));
                $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleArray_border);
                $rowNumber++;
        }
        else if($this->input->post('report_list')=='case_report/financial_indicator')
        {
            $current_month = date('m');
            $current_year = date('Y');
            $current_month = ($this->input->post('entry_month')!='')?$this->input->post('entry_month'):date('m');
            $current_year = ($this->input->post('filing_year')!='')?$this->input->post('filing_year'):date('Y');
            if($current_month<=6)
            {
                $column_name1='Amount of Taka(Previous Month)December\''.($current_year-1);
                $column_name2='Current Month(June,'.$current_year.')';
            }
            else
            {
                $column_name1='Amount of Taka(Previous Month)<br>June\''.$current_year;
                $column_name2='Current Month(December,'.$current_year.')';
            }
            $result = $this->Case_report_model->get_finiancial_indicator_result();
            $rowNumber++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            
            $headings1 = array('Major Indicators',$column_name1,$column_name2,'Comments');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;
            
            if(!empty($result))
            {
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'a) No. of Cases/Suits Ongoing for recovery of bad loans',
                    $result->ongoing_suit_1,
                    $result->ongoing_suit_2,
                    'Artha Rin, Artha Jari Execution, Criminal Cases, Session, Bankruptcy court etc.'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'b) Suit Value of Ongoing Cases',
                    number_format(($result->total_suit_value1-$result->disposal_till_value_1)/100000,2),
                    number_format(($result->total_suit_value2-$result->disposal_till_value_2)/100000,2),
                    'Suit value  (Lac)'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'c) Recovery against Ongoing Cases',
                    '',
                    '',
                    'Recovery  (figure in lac) against Ongoing Cases'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;

                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'd) Number of Disposal Cases',
                    $result->disposal_suit_1,
                    $result->disposal_suit_2,
                    'Suit Value  (figure in lac) against Withdrawn Suits'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;

                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'e) Suit Value of Disposal Cases',
                    number_format($result->total_disposal_value1/100000,2),
                    number_format($result->total_disposal_value2/100000,2),
                    'Suit value  (Lac)'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'f) Recovery against Disposal Cases',
                    '',
                    '',
                    'Recovery  (figure in lac) against Ongoing Cases'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'g) Number of Disposal Cases',
                    $result->disposal_suit_1,
                    $result->disposal_suit_2,
                    'Artha Rin, Artha Jari Execution, Criminal Cases, Session, Bankruptcy court etc.'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'h) Suit Value of Withdrawn Cases',
                    number_format($result->total_withdrawn_value1/100000,2),
                    number_format($result->total_withdrawn_value2/100000,2),
                    'Suit value  (Lac)'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    'i) Recovery against Withdrawn Cases',
                    '',
                    '',
                    'Recovery  (figure in lac) against Withdrawn Cases'
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
                $rowNumber++;
            }
        }
        

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('CNC Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_start();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Cnc_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output'); 
        $xlsData = ob_get_contents();

        /*ob_start();
        $objWriter->save("php://output");
        $xlsData = ob_get_contents();*/
        ob_end_clean();
        //ob_clean();
        $csrf_token = $this->security->get_csrf_hash();
        $response =  array(
            'op' => 'ok',
            'csrf_token'=>$csrf_token,
            'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
        );

        die(json_encode($response));
    }
}