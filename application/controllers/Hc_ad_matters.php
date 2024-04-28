<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hc_ad_matters extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('Hc_ad_matters_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
    }
    
    function view ($menu_group,$menu_cat,$menu_link=null,$submenu=null){
        $add_edit='';$id="";
        
		$dept_where="";
		
        $hl_user = $this->user_model->get_parameter_data('users_info','name',"user_group_id = '1'");
        $hoco_user = $this->user_model->get_parameter_data('users_info','name',"user_group_id = '2'");
        $cdo_user = $this->user_model->get_parameter_data('users_info','name',"user_group_id IN (17,2)  OR id IN (44)");
        $nature_suit = $this->user_model->get_parameter_data('ref_hc_nuture_suit','name',"data_status=1");
        $branch_sol = $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status=1");
        $court = $this->user_model->get_parameter_data('ref_court','name',"data_status=1");
        
        $hc_case_status = $this->user_model->get_parameter_data('ref_hc_case_status','name',"data_status=1");
        $law_firm = '';//$this->user_model->get_parameter_data('ref_law_chamber','name',"data_status=1");
        $lawyer = $this->user_model->get_parameter_data('ref_lawyer','name',"data_status=1");

        $zone = $this->user_model->get_parameter_data('ref_zone','name',"data_status=1");
        $division = '';//$this->user_model->get_parameter_data('ref_division','name',"data_status=1");
        $concerned_division = $this->user_model->get_parameter_data('ref_concerned_division','name',"data_status=1");
        $step = '';//$this->user_model->get_parameter_data('ref_step_sc','name',"data_status=1");
        $dealing_officer = $this->user_model->get_parameter_data('users_info','name',"user_group_id = '17'");
		$request_type = $this->user_model->get_parameter_data('ref_case_file_type','name',"data_status = '1'");

        $case_category = $this->user_model->get_parameter_data('ref_hc_case_category','name',"data_status = '1'");
        $case_type = $this->user_model->get_parameter_data('ref_hc_case_type','name',"data_status = '1'");
        $hc_division = $this->user_model->get_parameter_data('ref_hc_division','name',"data_status = '1'");
        $case_status = $this->user_model->get_parameter_data('ref_hc_case_status','name',"data_status = '1'");
        $hoco_group = $this->user_model->get_parameter_data('user_group','group_name',"data_status = '1' AND id IN (2,10,19) ");
        $district = $this->user_model->get_parameter_data('ref_district','name',"data_status=1");
        $related_with = $this->user_model->get_parameter_data('ref_related_with_hc','name',"data_status=1");
        $data = array(
            'add_edit' => $add_edit,
            'submenu' => $submenu,
            'menu_link' => $menu_link,
            'id' => $id,
            'menu_group'=> $menu_group,
            'menu_cat'=> $menu_cat,
            //'department' => $dept,
            'nature_suit' => $nature_suit,
            'branch_sol' => $branch_sol,
            'lawyer' => $lawyer,
            'law_firm' => $law_firm,
            'dealing_officer' => $dealing_officer,
            'hc_case_status' => $hc_case_status,
            'court' => $court,
            'zone' => $zone,
            'district' => $district,
            'division' => $division,
            'concerned_division' => $concerned_division,
            'step' => $step,
            'hl_user' => $hl_user,
            'hoco_user' => $hoco_user,
            'cdo_user' => $cdo_user,
            'hoco_group' => $hoco_group,
            'request_type' => $request_type,
            'case_category' => $case_category,
            'case_type' => $case_type,
            'hc_division' => $hc_division,
            'expenses_type'=>$this->user_model->get_parameter_data('ref_expense_type','name','data_status=1 AND id IN (1)'),
            'paper_vendor' => $this->user_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
            'hc_activites' => $this->user_model->get_parameter_data('ref_hc_activities','name','data_status = 1'),
            'case_status' => $case_status,
            'related_with' => $related_with,
            'dispatch_user' => $this->user_model->get_parameter_data('users_info','name',"data_status = '1' AND user_group_id IN (25) "),
            'per_page' => $this->config->item('per_pagess'),

           );

        if($submenu=='case_status_update'){
            $data['pages']='hc_ad_matters/pages/case_status_update';
        }elseif($submenu=='case_details'){
            if(isset($_POST['mk_xl'])){
                $this->hc_case_deatails_xl();
            }else{
                //$data['result'] =$this->Hc_matter_model->hc_case_details();
                $data['pages']='hc_ad_matters/pages/case_details';  
            }
        }else{
            $data['pages']='hc_ad_matters/pages/grid';
        }
        $this->load->view('grid_layout',$data);
    }
    
    function grid(){
        $this->Common_model->delete_tempfile();
        $pagenum = $this->input->get('pagenum');
        $pagesize = $this->input->get('pagesize');
        $start = $pagenum * $pagesize;

        $result = $this->Hc_ad_matters_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

        $data[] = array(
           'TotalRows' => $result['TotalRows'],
           'Rows' => $result['Rows']
        );
        echo json_encode($data);    
    }
    function case_exit_check(){
        $csrf_token=$this->security->get_csrf_hash();

        $where = "s.sts=1 AND s.case_number='".$this->input->post('case_no')."'";
        if($this->input->post('editrow')!=''){
            $where.=' AND s.id NOT IN ('.$this->input->post('editrow').')';
        }
        $this->db->select('s.*', FALSE)
        ->from("hc_ad_matters s")
        ->where($where);
        $q=$this->db->get();
        $rows = $q->num_rows();
        $var['csrf_token']=$csrf_token;
        $var['row_info']=$rows;
        echo json_encode($var);
    }
    function add_edit_action(){
        $csrf_token=$this->security->get_csrf_hash();
        $text = array();
        if($this->session->userdata['ast_user']['login_status'])
        {
            
            $id = $this->Hc_ad_matters_model->add_edit_action();
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
    function cdo_edit_action(){
        $csrf_token=$this->security->get_csrf_hash();
        $text = array();
        if($this->session->userdata['ast_user']['login_status'])
        {
            
            $id = $this->Hc_ad_matters_model->cdo_edit_action();
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
    function get_details(){
        $id = $this->input->post('id');
        $csrf_token=$this->security->get_csrf_hash();
        if($id!=''){
        $rows = $this->Hc_ad_matters_model->get_details($id);
        }else{
            $rows='';
        }
        echo $rows.'####'.$csrf_token;
    }
    function get_edit_info(){
        $csrf_token=$this->security->get_csrf_hash();
        $id = $this->input->post('id');
        $rows = $this->Hc_ad_matters_model->get_edit_info($id);
        $var['csrf_token']=$csrf_token;
        $var['row_info']=$rows;
        echo json_encode($var);
    }
    function get_cdo_edit_info(){
        $csrf_token=$this->security->get_csrf_hash();
        $id = $this->input->post('id');
        $rows = $this->Hc_ad_matters_model->get_cdo_edit_info($id);
		//$expense = $this->Hc_ad_matters_model->get_case_expense_edit_info($id,'HC Matter');
        $var['csrf_token']=$csrf_token;
        $var['row_info']=$rows;
        //$var['expense']=$expense;
        echo json_encode($var);
    }
    function delete_action(){
        $csrf_token=$this->security->get_csrf_hash();
        $text = array();
        if($this->session->userdata['ast_user']['login_status'])
        {
            $id = $this->Hc_ad_matters_model->delete_action();
        }
        else{
            $text[]="Session out, login required";
        }
        
        $Message='';
        if(count($text)<=0){
            $Message='OK';
            
            if($id=='taken')
            {
                $Message='Action Already Taken Plz Refresh';
                $row[]='';  
            }
            else if($id==0)
            {
                $Message='Something went wrong';
                $row[]='';  
            }
            else if($this->input->post("type")=='delete'){$row[]='';}
            else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
            }
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

    // Case Status Update Start 
    function sts_up_view ($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null){
        $this->Common_model->delete_tempfile();
        $add_edit='';$id="";
        if($this->session->userdata['ast_user']['user_work_group_id']==14 || $this->session->userdata['ast_user']['user_work_group_id']== 15){
            $dept = $this->user_model->get_parameter_data('ref_department','name',"data_status = '1' AND id=".$this->session->userdata['ast_user']['department']."");
        }else{
            $dept = $this->user_model->get_parameter_data('ref_department','name',"data_status = '1'");
        }
        
        $dept_where="";
        if($this->session->userdata['ast_user']['user_system_admin_sts']!=2)
        {
            $dept_where=" AND department='".$this->session->userdata['ast_user']['department']."' ";
        }
        
        $court = $this->user_model->get_parameter_data('ref_court','name',"data_status=1");
        $lawyer = $this->user_model->get_parameter_data('ref_lawyer','name',"data_status=1");

        $expenses_type = $this->user_model->get_parameter_data('ref_expenses_type','name',"data_status=1 AND id IN (1)");
        $expenses_activities = $this->user_model->get_parameter_data('ref_expenses_activities','name',"data_status=1");

        $case_category = $this->user_model->get_parameter_data('ref_hc_case_category','name',"data_status = '1'");
        $case_type = $this->user_model->get_parameter_data('ref_hc_case_type','name',"data_status = '1'");
        $hc_division = $this->user_model->get_parameter_data('ref_hc_division','name',"data_status = '1'");
        $case_status = $this->user_model->get_parameter_data('ref_hc_case_status','name',"data_status = '1'");
        $law_firm = $this->user_model->get_parameter_data('ref_law_chamber','name',"data_status=1");
        $hc_division = $this->user_model->get_parameter_data('ref_hc_division','name',"data_status = '1'");
        
        $data = array(
            'add_edit' => $add_edit,
            'submenu' => $submenu,
            'sub_cat' => $sub_cat,
            'menu_link' => $menu_link,
            'id' => $id,
            'menu_group'=> $menu_group,
            'menu_cat'=> $menu_cat,
            'department' => $dept,
            'lawyer' => $lawyer,
            'expenses_type' => $expenses_type,
            'expenses_activities' => $expenses_activities,
            'case_status' => $case_status,
            'court' => $court,
            'law_firm' => $law_firm,
            'hc_division' => $hc_division,
            
            'per_page' => $this->config->item('per_pagess'),

           );
        $data['pages']='hc_ad_matters/pages/case_status_update';
        $this->load->view('grid_layout',$data);
    }
    function sts_up_grid(){
        $this->Common_model->delete_tempfile();
        $pagenum = $this->input->get('pagenum');
        $pagesize = $this->input->get('pagesize');
        $start = $pagenum * $pagesize;

        $result = $this->Hc_ad_matters_model->get_sts_up_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

        $data[] = array(
           'TotalRows' => $result['TotalRows'],
           'Rows' => $result['Rows']
        );
        echo json_encode($data);    
    }
    function get_sts_update_edit_info(){
        $csrf_token=$this->security->get_csrf_hash();
        $id = $this->input->post('id');
        $rows = $this->Hc_ad_matters_model->get_sts_update_edit_info($id);
        //$expense = $this->Hc_ad_matters_model->get_case_expense_edit_info($id,'HC Matter sts',$rows->last_sts_up_id);
        $var['csrf_token']=$csrf_token;
        $var['row_info']=$rows;
        //$var['expense']=$expense;
        echo json_encode($var);
    }
    function get_expense_amount()
    {
        $csrf_token=$this->security->get_csrf_hash();
        $sah=$this->Hc_ad_matters_model->get_expense_amount($this->input->post('act_id'));//,$this->input->post('cma_district'),$this->input->post('req_type')
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
        echo json_encode($jTableResult);
    }
    function status_update_add_edit_action(){
        $csrf_token=$this->security->get_csrf_hash();
        $text = array();
        if($this->session->userdata['ast_user']['login_status'])
        {
           
            $id = $this->Hc_ad_matters_model->status_update_add_edit_action();
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
    function get_sts_update_details(){
        $id = $this->input->post('id');
        $csrf_token=$this->security->get_csrf_hash();
        if($id!=''){
        $rows = $this->Hc_ad_matters_model->get_details($id,1);
        $his = $this->Hc_ad_matters_model->get_sts_update_details($id);
        }else{
            $rows='';
        }
        echo $rows.$his.'####'.$csrf_token;
    }
    function sts_udate_delete_action(){
        $csrf_token=$this->security->get_csrf_hash();
        $text = array();
        if($this->session->userdata['ast_user']['login_status'])
        {
            $id = $this->Hc_ad_matters_model->sts_udate_delete_action();
        }
        else{
            $text[]="Session out, login required";
        }
        
        $Message='';
        if(count($text)<=0){
            $Message='OK';
            
            if($id=='taken')
            {
                $Message='Action Already Taken Plz Refresh';
                $row[]='';  
            }
            else if($id==0)
            {
                $Message='Something went wrong';
                $row[]='';  
            }
            else if($this->input->post("type")=='delete'){$row[]='';}
            else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
            }
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

    function search_by_case()
    {
        $csrf_token=$this->security->get_csrf_hash();

        $where = "s.sts=1";
        //$where = "s.sts=75";
        
        if(trim($this->input->post('s_case_number')) != '' && trim($this->input->post('s_case_year')) != '')
        { $where.= " AND s.case_number='".trim($this->input->post('s_case_number'))."/".trim($this->input->post('s_case_year'))."'"; }
        if(trim($this->input->post('s_case_year')) != '')
        { 
            //$where.= " AND s.case_year='".trim($this->input->post('s_case_year'))."'"; 
        }
    
        if($this->input->post('s_proposed_type')!='')
        { $where.= " AND s.proposed_type='".trim($this->input->post('s_proposed_type'))."'"; }
        if($this->input->post('s_account')!=''){
            if($this->input->post('s_proposed_type')=='Card'){
                $card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('s_hidden_loan_ac')));

                $where.= " AND s.org_loan_ac = '".$card."'"; 
            }else{
                $where.= " AND s.loan_ac = '".trim($this->input->post('s_account'))."'";
            }
        }

            $this->db->select('s.*', FALSE)
            ->from("suit_filling_info s")
            ->where($where);
            if($this->input->post('limit')!='All'){
            $this->db->limit($this->input->post('limit'));
            }
            $q=$this->db->get();
            $suit_row = $q->result();
        
        $str_html="<div style='min-height:200px;position:relative;'>";
        if(count($suit_row)>0)
        {
            $str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;margin-bottom:40px;' >
            <tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
            <td style='width:15%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
            <td style='width:27%;border:1px solid #a0a0a0'><strong>Investment AC</strong></td>
            <td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>";
            $sl =1;
            foreach($suit_row as $row)
            {

                $str_html.='<tr>
                        <td style="border:1px solid #a0a0a0"><input type="checkbox" name="check_id" value="'.$row->id.'" onclick="onlyOne(this)"><input type="hidden" name="type_'.$row->id.'" id="type_'.$row->id.'" value="subordinate"></td>
                        <td style="border:1px solid #a0a0a0">'.$row->case_number.'</td>
                        <td style="border:1px solid #a0a0a0">'.$row->loan_ac.'</td>
                        <td style="border:1px solid #a0a0a0">'.$row->ac_name.'</td>
                    </tr>';
                $sl++;
            }
            $str_html.="</table>";
            //<button type='button' class='buttonStyle' style='background-color: rgb(67, 145, 24); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='loadsuit(\"New\")'>New</button>
        }
        else
        {
            //$str_html.="<button type='button' class='buttonStyle' style='background-color: rgb(67, 145, 24); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;position:absolute;bottom:0;left:50%;' onclick='load_new()'>New</button>";
        }
        $str_html.='</div>';
        echo $csrf_token."####".$str_html;
    }
    function load_case(){
        $csrf_token=$this->security->get_csrf_hash();
        $id = $this->input->post('case_no');
        $rows = $this->Hc_ad_matters_model->load_case($id);
        $var['csrf_token']=$csrf_token;
        $var['row_info']=$rows;
        echo json_encode($var);
    }

    function r_history()
    {
        $csrf_token=$this->security->get_csrf_hash();
        $sah=$this->Hc_ad_matters_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
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
    function r_sts_history()
    {
        $csrf_token=$this->security->get_csrf_hash();
        $sah=$this->Hc_ad_matters_model->get_r_sts_history($this->input->post('id'),$this->input->post('life_cycle'));
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
    function get_dropdown_data()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $id = $this->input->post('id');
        $operation = $this->input->post('operation');
        $condition='';$court=array();
        $jTableResult = array();
        $dist = array();
        if($operation=='hoco_group'){
            $condition=" lock_status = '0' AND block_status = '0' AND user_group_id = ".$id;
            $table='users_info';
            $sah=$this->User_model->get_parameter_data($table,'name',$condition);
        }
        if($operation=='case_district'){
            $condition=" data_status <> 0 AND district = ".$id;
            $table='ref_thana';
            $sah=$this->User_model->get_parameter_data($table,'name',$condition);
            $court=$this->User_model->get_parameter_data('ref_court','name',array('district'=>$id,'data_status'=>1));

        }
        if($operation=='hc_division'){
            $condition=" data_status <> 0 AND hc_division = ".$id;
            $table='ref_hc_case_category';
            $sah=$this->User_model->get_parameter_data($table,'name',$condition);

        }
        if($operation=='case_category'){
            $condition=" data_status <> 0 AND hc_category = ".$id;
            $table='ref_hc_case_type';
            $sah=$this->User_model->get_parameter_data($table,'name',$condition);

        }
        if($operation=='law_chamber_pre'){
            $condition=" data_status <> 0 AND chamber_name = ".$id;
            $table='ref_lawyer';
            $sah=$this->User_model->get_parameter_data($table,'name',$condition);

        }
        if($operation=='law_chamber'){
            $condition=" data_status <> 0 AND chamber_name = ".$id;
            $table='ref_lawyer';
            $sah=$this->User_model->get_parameter_data($table,'name',$condition);

        }
        if($operation=='law_chamber_verify'){
            $condition=" data_status <> 0 AND chamber_name = ".$id;
            $table='ref_lawyer';
            $sah=$this->User_model->get_parameter_data($table,'name',$condition);

        }
        if($operation=='branch_name_code'){
            $get_row = $this->db->query("SELECT * FROM ref_branch_sol WHERE data_status <> 0 AND id=$id")->row();
            $condition=" data_status <> 0 AND id = ".$get_row->zone;
            $table='ref_zone';
            $sah=$this->User_model->get_parameter_data($table,'name',$condition);

            $condition=" data_status <> 0 AND id = ".$get_row->district;
            $table='ref_district';
            $dist=$this->User_model->get_parameter_data($table,'name',$condition);
        }

        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['district_info'] = $dist;
        $jTableResult['court_info'] = $court;
        $jTableResult['csrf_token'] = $csrf_token;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }

    function case_details_view($menu_group,$menu_cat,$menu_link=null,$sub_cat=null,$submenu=null)
    {
        $data = array(
                    'submenu' => $submenu,
                    'sub_cat' => $sub_cat,
                    'menu_link' => $menu_link,
                    'menu_group'=> $menu_group,
                    'menu_cat'=> $menu_cat,
                    'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
                    'pages'=> 'hc_ad_matters/pages/case_details',
                    'per_page' => $this->config->item('per_pagess')
                   );
        $this->load->view('grid_layout',$data);
    }
    function get_case_details_result()
    {
        $csrf_token=$this->security->get_csrf_hash();
        $result =$this->Hc_ad_matters_model->get_all_cases();
        //echo '<pre>';
        //print_r($result);
        $str_html="";
        if(!empty($result))
        {
            $sl=0;
            foreach ($result as $key) 
            {
                $sl++;
                $str_html.='
                <tr>
                    <td><a href="#" onclick="details('.$key->id.')"><img align="center" src="'.base_url().'images/view_detail.png"></a></td>
                    <td>'.$key->case_number.'</td>
                    <td>'.$key->case_year.'</td>
                    <td>'.$key->case_filing_date.'</td>
                    <td>'.$key->branch_name_code.' ('.$key->branch_code.') </td>
                    <td>'.$key->district_name.'</td>
                    <td>'.$key->zone.'</td>
                    <td>'.$key->cb_number.'</td>
                    <td>'.$key->account_number.'</td>
                    <td>'.$key->hc_division_name.'</td>
                    <td>'.$key->case_category_name.'</td>
                    <td>'.$key->case_type_name.'</td>
                    <td>'.$key->nature_suit.'</td>
                    <td>'.$key->lawyer_name.'</td>
                    <td>'.$key->prv_step.'</td>
                    <td>'.$key->prv_hearing_date.'</td>
                </tr>';
            }
            
        }
        else
        {
            $str_html="<tr><td colspan='17' align='center'>No Data Found!!!</td></tr>";
        }
        echo $str_html."####".$csrf_token;
    }



    function get_xl_report(){

        $result =$this->Hc_ad_matters_model->get_all_cases();

        include_once('tbs/clas/tbs_class.php');
        include_once('tbs/clas/tbs_plugin_opentbs.php');

        $TBS = new clsTinyButStrong;
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

        $template = 'tbs/high_court_cases/court_cases.xlsx';

        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

        $TBS->MergeBlock('a', $result);

        $filename = 'court_cases.xlsx';
        $TBS->Show(OPENTBS_DOWNLOAD, $filename);
        exit();

    }



    function make_xl()
    {
        $result =$this->Hc_ad_matters_model->get_all_cases();

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
            $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(20);

            $rowNumber = 1;
            $headings1 = array('Case Details Report');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AZ'.$rowNumber); 
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
            $rowNumber++;

            $rowNumber++;  
            $headings4 = array('Serial','SOL Code','Branch',
                'Account No/ Contract No',
                'ACCT_NAME as per C&C Portfolio','CUST_ID','CREDIT_FILE_NO',
            'Card No./Link A/C no.','Name of the Account','SCHM_CODE',
            'Name of Product/ Scheme','Type of Segment','Name of Plaintiff/ Petitioner',
            'Name of the borrower/Accused','Case Status','Nature of Suit','Filed Type',
            'Date of Legal Notice','Suit Details','Filing Date','Suit Number',
            'Name of the Court','Session Number/ Re-Number',
            'Name of the Court (Session/Re number)',
            'CR Appeal/ CR Misc./ CR Revision/ High Court Related Case (if any)',
            'Status of CR Appeal/ CR Misc./ CR Revision/ High Court Related Case',
            'Cheque Number','Cheque Amount/ Outstanding Amount','Total Suit Value',
            'Total Suit Value(In Lacs)','Chronological Previous Date',
            'Chronological Previous Status','Next Date','Next Status',
            'Last Actions Taken on Previous Date/ Next Steps as per Court Order',
            'Remark','Date of Judgment','Judgment Details','Case Withdrawal Date',
            'Dealing Law Firm/ Chamber ','Contact Details (Dealing Lawyer)',
            'Past Lawyer\'s Information Detail (Issued NOC)','Employee ID','Present Dealing',
            'Phone Number (Present Dealing Officer)','District as per Court Name',
            'Previous Dealing Officer (Latest)','File Transfer Date','Filing Plaintiff',
            'Case Withdrawal Request Date','Sender of Case Withdrawal Request','Account Status','Unique ID');//
           // echo count($headings4);
            //exit;
            $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->getFont()->setBold(true);    
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'eee4e3')));
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->applyFromArray($styleArray_border);
            $rowNumber++;   
            $sl = 0;
            foreach($result as $key)
            {
                $sl++;
                $objPHPExcel->getActiveSheet()->fromArray(array(
                    $sl,
                    $key->branch_sol,
                    $key->branch_name,
                    $key->loan_ac,
                    $key->ac_name,
                    $key->cif,
                    $key->credit_file_no,
                    $key->link_ac,
                    $key->ac_name,
                    $key->schema_code,
                    $key->schema_name,
                    $key->loan_segment,
                    $key->filling_plaintiff,
                    $key->borrower_name,
                    $key->case_sts_prev_dt,
                    $key->case_name,
                    $key->case_category,
                    $key->ln_sent_date,
                    $key->case_number,
                    $key->filling_date,
                    $key->case_number,
                    $key->prest_court_name,
                    $key->session_number,
                    $key->session_court,
                    $key->hc_case_number,
                    $key->hc_case_sts,
                    $key->cheque_number,
                    $key->cheque_amount,
                    $key->case_claim_amount,
                    number_format($key->case_claim_amount/100000,2),
                    $key->prev_date,
                    $key->case_sts_prev_dt,
                    $key->next_date,
                    $key->next_date_sts,
                    $key->case_sts_prev_dt,
                    $key->remarks_prev_date,
                    $key->judgement_date,
                    $key->judgement_details,
                    $key->withdrawn_date,
                    $key->lawyer_name,
                    $key->chamber,
                    $key->prev_lawyer_name,
                    $key->deal_officer_id,
                    $key->case_deal_officer,
                    $key->case_deal_officer_phone,
                    $key->court_district_name,
                    $key->present_plaintiff,
                    $key->file_transfer_date,
                    $key->filling_plaintiff,
                    $key->close_ac_req_dt,
                    $key->close_req_reject_by,
                    $key->final_remarks,
                    $key->id
                    ),NULL,'A'.$rowNumber);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AZ'.$rowNumber)->applyFromArray($styleArray_border);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit(('D'.$rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                $rowNumber++;
            }
            

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Case Details Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="case_details_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
    }

    function temp_file(){
        $this->Common_model->delete_tempfile();
        echo 'success';
    }
}