<?php
class Hc_ad_matters_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
    function get_sts_up_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = " h.sts<>0 AND h.v_sts = 38 ";
        
        if($this->input->get('hc_division')!=''){
            $where2.=" AND h.hc_division = ".$this->db->escape(trim($this->input->get('hc_division')));
        }
        if($this->input->get('case_number')!=''){
            $where2.=" AND h.case_number = ".$this->db->escape(trim($this->input->get('case_number')));
        }
        if($this->input->get('case_category')!=''){
            $where2.=" AND h.case_category = ".$this->db->escape(trim($this->input->get('case_category')));
        }
        if($this->input->get('case_type')!=''){
            $where2.=" AND h.case_type = ".$this->db->escape(trim($this->input->get('case_type')));
        }
        if($this->input->get('case_year')!=''){
            $where2.=" AND h.case_year = ".$this->db->escape(trim($this->input->get('case_year')));
        }
        
        if($this->input->get('filling_date')!=''){
            $filling_date = $this->db->escape(trim($this->input->get('filling_date')));
            $where2.=" AND DATE_FORMAT(h.case_filing_date,'%d/%m/%Y') >= ".$filling_date;
        }
        if($this->input->get('filling_date_to')!=''){
            $filling_date_to = $this->db->escape(trim($this->input->get('filling_date_to')));
            $where2.=" AND DATE_FORMAT(h.case_filing_date,'%d/%m/%Y') <= ".$filling_date_to;
        }
        
       

        
        if (isset($filterscount) && $filterscount > 0)
        {
            $where = "(";

            $tmpdatafield = "";
            $tmpfilteroperator = "";
            for ($i=0; $i < $filterscount; $i++)
            {//$where2.="(".$this->input->get('filterdatafield'.$i)." like '%".$this->input->get('filtervalue'.$i)."%')";

                // get the filter's value.
                $filtervalue = $this->input->get('filtervalue'.$i);
                // get the filter's condition.
                $filtercondition = $this->input->get('filtercondition'.$i);
                // get the filter's column.
                $filterdatafield = $this->input->get('filterdatafield'.$i);
                // get the filter's operator.
                $filteroperator = $this->input->get('filteroperator'.$i);

                if($filterdatafield=='dept_name')
                {
                    $filterdatafield = "d.name";
                }   
                else if($filterdatafield=='unit_name')
                {
                    $filterdatafield = "u.name";
                }  
                else if($filterdatafield=='account_number')
                {
                    $filterdatafield = "h.account_number";
                }
                else if($filterdatafield=='account_name')
                {
                    $filterdatafield = "h.account_name";
                }
                else if($filterdatafield=='branch_name')
                {
                    $filterdatafield = "bs.name";
                }
                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield = "l.name";
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(h.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield = "s.name";
                }
                else
                {
                    $filterdatafield='h.'.$filterdatafield;
                }

                if ($tmpdatafield == "")
                {
                    $tmpdatafield = $filterdatafield;
                }
                else if ($tmpdatafield <> $filterdatafield)
                {
                    $where .= ")AND(";
                }
                else if ($tmpdatafield == $filterdatafield)
                {
                    if ($tmpfilteroperator == 0)
                    {
                        $where .= " AND ";
                    }
                    else $where .= " OR ";
                }

                if($filterdatafield =='e_by')
                {
                    $where .= " (j2.name LIKE '%".$filtervalue."%' OR j2.user_id LIKE '%".$filtervalue."%') ";
                }
                else
                {
                    switch($filtercondition)
                    {
                        case "CONTAINS":
                            $where .= " ".$filterdatafield . " LIKE '%" . $filtervalue ."%'";
                            break;
                        case "DOES_NOT_CONTAIN":
                            $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                            break;
                        case "EQUAL":
                            $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                            break;
                        case "NOT_EQUAL":
                            $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
                            break;
                        case "GREATER_THAN":
                            $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
                            break;
                        case "LESS_THAN":
                            $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
                            break;
                        case "GREATER_THAN_OR_EQUAL":
                            $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
                            break;
                        case "LESS_THAN_OR_EQUAL":
                            $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
                            break;
                        case "STARTS_WITH":
                            $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                            break;
                        case "ENDS_WITH":
                            $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                            break;
                    }
                }
                

                if ($i == $filterscount - 1)
                {
                    $where .= ")";

                }

                $tmpfilteroperator = $filteroperator;
                $tmpdatafield = $filterdatafield;

            }
            // build the query.
        }else{$where=array();}
        $where_initi=''; 
        // if($where=='' || count($where)<=0){          
        //  //$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
        // }
        
        if ($sortorder == '')
        {
            $sortdatafield="h.id";
            $sortorder = "DESC";                
        }
        $this->db->select('SQL_CALC_FOUND_ROWS h.*,
            s.name as status,CONCAT(bs.name," (",bs.code,")") as branch_name,
            DATE_FORMAT(h.e_dt,"%d/%m/%Y %h:%i %p") AS e_dt,
            j2.name as e_by,
            j3.up_v_sts,j3.up_stc,j3.up_verify,
            DATE_FORMAT(h.case_filing_date,"%d/%m/%Y") AS case_filing_date,
            if(up.next_date=0000-00-00,"",DATE_FORMAT(up.next_date,"%d/%m/%Y")) AS next_date,
            cs.name as case_sts_name,ups.name as up_status,up.for_verify,up.v_sts as sts_v_sts,d.name as hc_division_name,
            c.name as case_category_name,ns.name as nature_of_suit,
            t.name as hc_type_name
            ', FALSE)
            ->from("hc_ad_matters h")
            ->join('ref_branch_sol bs', 'bs.code=h.branch_name_code', 'left')
            ->join('ref_status s', 's.id=h.v_sts', 'left')
            ->join('ref_hc_division d', 'd.id=h.hc_division', 'left')
            ->join('ref_hc_case_category c', 'c.id=h.case_category', 'left')
            ->join('ref_hc_case_type t', 't.id=h.case_type', 'left')
            ->join('ref_hc_nuture_suit ns', 'ns.id=h.nature_suit', 'left')
            ->join('users_info as j2', 'h.e_by=j2.id', 'left')
            ->join('(SELECT SUM(IF(v_sts IN (39,35,90),1,0)) AS up_v_sts,SUM(IF(v_sts IN (37),1,0)) AS up_stc,SUM(IF(v_sts IN (38),1,0)) AS up_verify,hc_id FROM hc_ad_case_sts_update WHERE sts <> 0 GROUP BY hc_id) as j3', 'h.id=j3.hc_id', 'left')
            ->join('hc_ad_case_sts_update up', 'up.id=h.last_sts_up_id AND up.sts <> 0', 'left')
            ->join('ref_status ups', 'ups.id=up.v_sts', 'left')
            ->join('ref_hc_case_status cs', 'cs.id=up.case_status', 'left')
            ->where($where2)
            ->where($where)
            //->order_by($sortdatafield,$sortorder)
            ->order_by('h.final_remarks','ASC')
            ->limit($limit, $offset);
        $q=$this->db->get();

        $query = $this->db->query('SELECT FOUND_ROWS() AS Count');
        $objCount = $query->result_array();
        $result["TotalRows"] = $objCount[0]['Count'];

        if ($q->num_rows() > 0){
            $result["Rows"] = $q->result();
        } else {
            $result["Rows"] = array();
        }
        return $result;

    }
    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = " h.sts<>0";
        if($this->input->get('case_number')!=''){
            $where2.=" AND h.case_number = ".$this->db->escape(trim($this->input->get('case_number')));
        }
        if($this->input->get('case_year')!=''){
            $where2.=" AND h.case_year = ".$this->db->escape(trim($this->input->get('case_year')));
        }
        if($this->input->get('date_from')!=''){
            $date_from = implode('-',array_reverse(explode('/',$this->input->get('date_from'))));
            $where2.=" AND h.case_filing_date >= ".$this->db->escape(trim($date_from));
        }
        if($this->input->get('date_to')!=''){
            $date_to = implode('-',array_reverse(explode('/',$this->input->get('date_to'))));
            $where2.=" AND h.case_filing_date <= ".$this->db->escape(trim($date_to));
        }


        
        if (isset($filterscount) && $filterscount > 0)
        {
            $where = "(";

            $tmpdatafield = "";
            $tmpfilteroperator = "";
            for ($i=0; $i < $filterscount; $i++)
            {//$where2.="(".$this->input->get('filterdatafield'.$i)." like '%".$this->input->get('filtervalue'.$i)."%')";

                // get the filter's value.
                $filtervalue = $this->input->get('filtervalue'.$i);
                // get the filter's condition.
                $filtercondition = $this->input->get('filtercondition'.$i);
                // get the filter's column.
                $filterdatafield = $this->input->get('filterdatafield'.$i);
                // get the filter's operator.
                $filteroperator = $this->input->get('filteroperator'.$i);

                if($filterdatafield=='received_date')
                {
                    $filterdatafield = "DATE_FORMAT(h.received_date,'%d-%m-%Y')";
                }   
                
                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield = "l.name";
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(h.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield = "s.name";
                }
                else
                {
                    $filterdatafield='h.'.$filterdatafield;
                }

                if ($tmpdatafield == "")
                {
                    $tmpdatafield = $filterdatafield;
                }
                else if ($tmpdatafield <> $filterdatafield)
                {
                    $where .= ")AND(";
                }
                else if ($tmpdatafield == $filterdatafield)
                {
                    if ($tmpfilteroperator == 0)
                    {
                        $where .= " AND ";
                    }
                    else $where .= " OR ";
                }

                if($filterdatafield =='e_by')
                {
                    $where .= " (j2.name LIKE '%".$filtervalue."%' OR j2.user_id LIKE '%".$filtervalue."%') ";
                }
                else
                {
                    switch($filtercondition)
                    {
                        case "CONTAINS":
                            $where .= " ".$filterdatafield . " LIKE '%" . $filtervalue ."%'";
                            break;
                        case "DOES_NOT_CONTAIN":
                            $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                            break;
                        case "EQUAL":
                            $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                            break;
                        case "NOT_EQUAL":
                            $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
                            break;
                        case "GREATER_THAN":
                            $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
                            break;
                        case "LESS_THAN":
                            $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
                            break;
                        case "GREATER_THAN_OR_EQUAL":
                            $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
                            break;
                        case "LESS_THAN_OR_EQUAL":
                            $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
                            break;
                        case "STARTS_WITH":
                            $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                            break;
                        case "ENDS_WITH":
                            $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                            break;
                    }
                }
                

                if ($i == $filterscount - 1)
                {
                    $where .= ")";

                }

                $tmpfilteroperator = $filteroperator;
                $tmpdatafield = $filterdatafield;

            }
            // build the query.
        }else{$where=array();}
        $where_initi=''; 
        // if($where=='' || count($where)<=0){          
        //  //$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
        // }
        
        if ($sortorder == '')
        {
            $sortdatafield="h.life_cycle";
            $sortorder = "ASC";                
        }
        $this->db->select('SQL_CALC_FOUND_ROWS h.*,
            s.name as status,
            DATE_FORMAT(h.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(h.case_filing_date,"%d-%m-%Y") AS filling_date,
            j2.name as e_by,d.name as hc_division_name,
            c.name as case_category_name,
            t.name as hc_type_name
            ', FALSE)
            ->from("hc_ad_matters h")
            ->join('ref_hc_division d', 'd.id=h.hc_division', 'left')
            ->join('ref_hc_case_category c', 'c.id=h.case_category', 'left')
            ->join('ref_hc_case_type t', 't.id=h.case_type', 'left')
            ->join('ref_status s', 's.id=h.v_sts', 'left')
            ->join('users_info as j2', 'h.e_by=j2.id', 'left')
            ->where($where2)
            ->where($where)
            ->order_by($sortdatafield,$sortorder)
            ->limit($limit, $offset);
        $q=$this->db->get();

        $query = $this->db->query('SELECT FOUND_ROWS() AS Count');
        $objCount = $query->result_array();
        $result["TotalRows"] = $objCount[0]['Count'];

        if ($q->num_rows() > 0){
            $result["Rows"] = $q->result();
        } else {
            $result["Rows"] = array();
        }
        return $result;

    }
    
    function add_edit_action(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $this->form_validation->set_rules('edit_row', 'edit_row', 'trim|xss_clean');
        $this->form_validation->set_rules('add_edit', 'add_edit', 'trim|required|xss_clean');
        $this->form_validation->set_rules('request_name', 'request_name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('received_date', 'received_date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('remarks', 'remarks', 'trim|xss_clean');
        if ($this->form_validation->run() == TRUE){
           
            

            $edit_id = $this->input->post('edit_row');
            $activities_datetime = date('Y-m-d H:i:s');
            $activities_by = $this->session->userdata['ast_user']['user_id'];
            $ip_address = $this->input->ip_address();
            $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
            $activities_id = "";
            $description_activities = "";
            
            $file = $this->get_file_name('req_scan_file','legal_unit/hc_case/');

            $received_date = implode('-',array_reverse(explode('/',$this->input->post('received_date'))));
            $request_data = array(
                'request_name' =>$this->input->post('request_name'),
                'received_date' =>$received_date,
                'remarks' =>$this->input->post('remarks')
            );
            if($file!=''){
                $request_data['request_file']=$file;
            }
            if($this->input->post('add_edit')=="add"){
                $sl_no=$this->user_model->get_unique_serial('hc_ad');
                $request_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
                $request_data['e_dt'] = date('Y-m-d H:i:s');
                $request_data['v_sts'] = 1;
                $request_data['serial_no'] = 'Legal/Highcourt/'.date('Y').'/'.$sl_no;
                $this->db->insert('hc_ad_matters', $request_data);
                $insert_idss = $this->db->insert_id();
                $activities_id = 1;
                $description_activities = 'Add Request Received - ('.$insert_idss.')';
            }else{
                $request_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $request_data['u_dt'] = date('Y-m-d H:i:s');
                $request_data['v_sts'] = 2;
                $this->db->where('id', $edit_id);
                $this->db->update('hc_ad_matters', $request_data);
                $insert_idss = $edit_id;
                $activities_id = 2;
                $description_activities = 'Edit Request Received - ('.$insert_idss.')';

            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return 00;
            }else{
                $this->User_model->legal_file_history('hc_ad_matters',$insert_idss,$activities_id,'hc matter',$description_activities);//table/id/actid/module/des
                $this->db->trans_commit();
                //$this->User_model->user_activities($activities_id,'',$insert_idss,'hc_ad_matters',$description_activities);
                
                return $insert_idss;
            }
        }else{
            return validation_errors();
        }
        
    }
    function get_file_name($field_name,$path){

        //Deleteng old file when no new file selected
        if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            if(file_exists($delete_path)){
            unlink($delete_path);  
            } 
            $file ="";
        }//Deleteng old file and new file selected
        else if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='1') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            if(file_exists($delete_path)){
                unlink($delete_path); 
            }              
            $file = $this->Common_model->get_file_name('legal',$field_name,$path);
        }//Taking Old File
        else if (isset($_POST['hidden_'.$field_name.'_value']) && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $file = $_POST['hidden_'.$field_name.'_value'];
        }//Taking Full New File
        else
        {
            $file = $this->Common_model->get_file_name('legal',$field_name,$path);
        }
        return $file;
    }

    function get_details($id,$his=null){
        $this->db->select('s.*,u.name as received_by,
            concat(s.case_number,"/",s.case_year) as case_number,
            
            if(s.case_filing_date=0000-00-00,"",DATE_FORMAT(s.case_filing_date,"%d/%m/%Y")) AS case_filing_date,
            if(s.engage_date=0000-00-00,"",DATE_FORMAT(s.engage_date,"%d/%m/%Y")) AS engage_date,
            if(s.date_judgment=0000-00-00,"",DATE_FORMAT(s.date_judgment,"%d/%m/%Y")) AS date_judgment,
            if(s.judgment_detail=0000-00-00,"",DATE_FORMAT(s.judgment_detail,"%d/%m/%Y")) AS judgment_detail,
            
            if(s.prv_hearing_date=0000-00-00,"",DATE_FORMAT(s.prv_hearing_date,"%d/%m/%Y")) AS prv_hearing_date,
            if(s.next_hearing_date=0000-00-00,"",DATE_FORMAT(s.next_hearing_date,"%d/%m/%Y")) AS next_hearing_date,

            if(s.entry_date=0000-00-00,"",DATE_FORMAT(s.entry_date,"%d/%m/%Y")) AS entry_date,
            if(s.stay_from_date=0000-00-00,"",DATE_FORMAT(s.stay_from_date,"%d/%m/%Y")) AS stay_from_date,
            if(s.stay_to_date=0000-00-00,"",DATE_FORMAT(s.stay_to_date,"%d/%m/%Y")) AS stay_to_date,
            if(s.last_case_sts_update_date=0000-00-00,"",DATE_FORMAT(s.last_case_sts_update_date,"%d/%m/%Y")) AS last_case_sts_update_date,
            b.name as branch_name_code,n.name as nature_suit,l.name as lawyer_name,
            z.name as zone,
            ps.name as prv_step, ns.name as next_step,rt.name as request_type_name,
            ct.name as case_type_name,div.name as hc_division_name,cat.name as case_category_name,dis.name as district_name,rel.name as related_with_name
            ', FALSE)
            ->from("hc_ad_matters s")
            ->join('users_info u', 'u.id=s.e_by', 'left')
            ->join('ref_branch_sol b', 'b.code=s.branch_name_code', 'left')
            ->join('ref_hc_nuture_suit n', 'n.id=s.nature_suit', 'left')
            ->join('ref_court c', 'c.id=s.court_name', 'left')
            ->join('ref_lawyer l', 'l.id=s.lawyer_name', 'left')
            ->join('ref_zone z', 'z.id=s.zone', 'left')
            ->join('ref_hc_case_status ps', 'ps.id=s.prv_step', 'left')
            ->join('ref_hc_case_status ns', 'ns.id=s.next_step', 'left')
            ->join('ref_case_file_type rt', 'rt.id=s.request_type', 'left')
            ->join('ref_hc_case_type ct', 'ct.id=s.case_type', 'left')
            ->join('ref_hc_division div', 'div.id=s.hc_division', 'left')
            ->join('ref_hc_case_category cat', 'cat.id=s.case_category', 'left')
            ->join('ref_district dis', 'dis.id=s.district', 'left')
            ->join('ref_related_with_hc rel', 'rel.id=s.related_with', 'left')
            ->join('ref_status sts', 'sts.id=s.v_sts', 'left')
            ->where(array('s.id'=>$id,'s.sts'=>1));
        $q=$this->db->get();
        $result = $q->row();

  
        $html = '';
        if(!empty($result)){

            $html.='<h4>Suit Info:</h4>
            <table style="width: 100%;" class="preview_table2" >
            <tr>
                <th width="20%" align="left"><strong>Customer ID</strong></th>
                <td width="30%" align="left" >'.$result->cb_number.'</td>
                <th width="20%" align="left"><strong>Suit Value</strong></th>
                <td width="30%" align="left" >'.number_format((float) $result->suit_value,2,'.','').'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Number</strong></th>
                <td width="30%" align="left" >'.$result->account_number.'</td>
                <th width="20%" align="left"><strong>Suit Details</strong></th>
                <td width="30%" align="left" >'.$result->suit_details.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Case File By/Against</strong></th>
                <td width="30%" align="left" >'.$result->request_type_name.'</td>
                <th width="20%" align="left"><strong>Related With</strong></th>
                <td width="30%" align="left" >'.$result->related_with_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Branch Name & Code</strong></th>
                <td width="30%" align="left" >'.$result->branch_name_code.'</td>
                <th width="20%" align="left"><strong>Related Case (Arising Out Of)</strong></th>
                <td width="30%" align="left" >'.$result->related_case.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Name of Account</strong></th>
                <td width="30%" align="left" >'.$result->account_name.'</td>
                <th width="20%" align="left"><strong>Dealing Lawyer\'s Name (Present)</strong></th>
                <td width="30%" align="left" >'.$result->lawyer_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Name of the Respondent/Opposite party</strong></th>
                <td width="30%" align="left" >'.$result->accused_name.'</td>
                <th width="20%" align="left"><strong>Lawyer Engage Date</strong></th>
                <td width="30%" align="left" >'.$result->engage_date.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Name Petitioner</strong></th>
                <td width="30%" align="left" >'.$result->petitioner.'</td>
                <th width="20%" align="left"><strong>Date of Judgment & Decree</strong></th>
                <td width="30%" align="left" >'.$result->date_judgment.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Nature of Suit</strong></th>
                <td width="30%" align="left" >'.$result->nature_suit.'</td>
                <th width="20%" align="left"><strong>Judgment/Decree Detail</strong></th>
                <td width="30%" align="left" >'.$result->judgment_detail.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>District</strong></th>
                <td width="30%" align="left" >'.$result->district_name.'</td>
                <th width="20%" align="left"><strong>Zone </strong></th>
                <td width="30%" align="left" >'.$result->zone.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Division</strong></th>
                <td width="30%" align="left" >'.$result->hc_division_name.'</td>
                <th width="20%" align="left"><strong>Case Step </strong></th>
                <td width="30%" align="left" >'.$result->prv_step.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Case Category</strong></th>
                <td width="30%" align="left" >'.$result->case_category_name.'</td>
                <th width="20%" align="left"><strong>Next Date </strong></th>
                <td width="30%" align="left" >'.$result->next_hearing_date.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Case Type</strong></th>
                <td width="30%" align="left" >'.$result->case_type_name.'</td>
                <th width="20%" align="left"><strong>Name of the Court</strong></th>
                <td width="30%" align="left" >'.$result->court_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Case Number</strong></th>
                <td width="30%" align="left" >'.$result->case_number.'</td>
                <th width="20%" align="left"><strong>Remarks</strong></th>
                <td width="30%" align="left" >'.$result->remarks_by_cdo.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Case Filing Date</strong></th>
                <td width="30%" align="left" >'.$result->case_filing_date.'</td>
                <th width="20%" align="left"><strong>Stay From</strong></th>
                <td width="30%" align="left" >'.$result->stay_from_date.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Entry Date</strong></th>
                <td width="30%" align="left" >'.$result->entry_date.'</td>
                <th width="20%" align="left"><strong>Stay To</strong></th>
                <td width="30%" align="left" >'.$result->stay_to_date.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Disposed/order Date</strong></th>
                <td width="30%" align="left" >'.$result->prv_hearing_date.'</td>
                <th width="20%" align="left"><strong></strong></th>
                <td width="30%" align="left" ></td>
            </tr>
            </table>
            ';

        
           

            
        } 
        return $html;
    }
    function get_edit_info($id){
        $this->db->select('s.*,DATE_FORMAT(s.received_date,"%d/%m/%Y") as received_date', FALSE)
            ->from("hc_ad_matters s")
            //->join('hc_matter_status s', 's.hc_matter_id=a.id', 'left')
            ->where("s.id='".$id."' AND s.sts=1 AND s.life_cycle=1", NULL, FALSE)
            ->limit(1);
        $q=$this->db->get();
        $result = $q->row();
        return $result;
    }
    function delete_action(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $table_name = "hc_ad_matters";
        $activities_id='';
        $row_id='';
        $description_activities='';
        $reason ='';

        if($this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_matters',$_POST['deleteEventId'],0,'sts');
            $pre_action_v=$this->Common_model->get_pre_action_data('hc_ad_matters',$_POST['deleteEventId'],'39,35','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('hc_ad_matters', $data);
                $activities_id = 15;
                $description_activities = 'Delete HC & AD Matters - ('.$_POST['deleteEventId'].')';
                $row_id=$_POST['deleteEventId'];
                $reason =trim($_POST['comments']);
            }
            
        }
        if($this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_matters',$_POST['verifyid'],'37','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('v_sts'=>37,'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'life_cycle'=>2);
                //'req_hol'=>$_POST['hl_user'],
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('hc_ad_matters', $data);

               

                $activities_id = 37;
                $description_activities = 'Send to Checker HC & AD Matters - ('.$_POST['verifyid'].')';
                $row_id=$_POST['verifyid'];
                
            }
        }
        
        if($this->input->post('type')=='verify_return'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_matters',$_POST['verifyid'],'57,20,21','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('corr_hol_reason'=>$_POST['return_reason_verify'],'corr_hol_by'=> $this->session->userdata['ast_user']['user_id'], 'corr_hol_dt'=>date('Y-m-d H:i:s'),'v_sts'=>20);
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('hc_ad_matters', $data);

                $reason=$_POST['return_reason_verify'];
                $activities_id = 20;
                $description_activities = 'Return by HOL HC & AD Matters- ('.$_POST['verifyid'].')';
                $row_id=$_POST['verifyid'];

            }
        }
        if($this->input->post('type')=='verify_reject'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_matters',$_POST['verifyid'],'21,57','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {

                $data = array('dec_hol_reason'=>$_POST['return_reason_verify'],'dec_hol_by'=> $this->session->userdata['ast_user']['user_id'], 'dec_hol_dt'=>date('Y-m-d H:i:s'),'v_sts'=>21);
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('hc_ad_matters', $data);

                $reason=$_POST['return_reason_verify'];
                $activities_id = 21;
                $description_activities = 'Decline by HOL HC & AD Matters- ('.$_POST['verifyid'].')';
                $row_id=$_POST['verifyid'];
                
            }    
        }
        if($this->input->post('type')=='verify'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_matters',$_POST['verifyid'],38,'v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38,'life_cycle'=>7);
                $case_info = $this->db->query("SELECT s.id,s.court_name,s.lawyer_name,s.prv_step,s.prv_hearing_date,s.next_hearing_date,t.name as case_type_name,s.case_number,s.case_year,s.previous_suit_id FROM hc_ad_matters s LEFT JOIN ref_hc_case_type t ON t.id=s.case_type WHERE s.id=".$_POST['verifyid']."")->row();

                
                // status data
                $status_data = array(
                    'court_name' =>$case_info->court_name,
                    'lawyer' =>$case_info->lawyer_name,
                    'case_status' =>$case_info->prv_step,
                    'final_remarks'=> 'Running',
                    'disposed_order_date'=>$case_info->prv_hearing_date,
                    'next_date'=>$case_info->next_hearing_date,
                    'hc_id'=>$case_info->id
                );
                $case_status_data = $this->db->query("SELECT * FROM ref_hc_case_status WHERE id=".$case_info->prv_step)->row();
                /*if($case_status_data->id ==2){
                    $status_data['final_remarks']='Close';
                    $data['final_remarks']=1;
                }*/
                $status_data['e_by']=$this->session->userdata['ast_user']['user_id'];
                $status_data['e_dt']=date('Y-m-d H:i:s');
                $status_data['v_by']=$this->session->userdata['ast_user']['user_id'];
                $status_data['v_dt']=date('Y-m-d H:i:s');
                $status_data['v_sts']=38;
                $this->db->insert('hc_ad_case_sts_update', $status_data);
                $sts_id = $this->db->insert_id();
                $data['last_sts_up_id']=$sts_id;
                
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('hc_ad_matters', $data);

               

                

                $activities_id = 38;
                $description_activities = 'Approve by HOL HC & AD Matters- ('.$_POST['verifyid'].')';
                $row_id=$_POST['verifyid'];
                
            }
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->db->db_debug = $db_debug;
            return 0;
        }
        else {
            $this->User_model->user_activities($activities_id,'HC Matter',$row_id,'hc_ad_matters',$description_activities,$reason);
            
            //$this->User_model->user_activities($activities_id,'',$row_id,$table_name,$description_activities,$reason);

            $this->db->trans_commit();

            $this->db->db_debug = $db_debug;
            return $row_id;
        }
    }
    // CDO Edit 
    function cdo_edit_action(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $this->form_validation->set_rules('edit_row_cdo', 'edit_row', 'trim|xss_clean');
        $this->form_validation->set_rules('add_edit_cdo', 'add_edit', 'trim|required|xss_clean');

        $this->form_validation->set_rules('district', 'district', 'trim|xss_clean');
        $this->form_validation->set_rules('account_number', 'account_number', 'trim|xss_clean');
        $this->form_validation->set_rules('cb_number', 'cb_number', 'trim|xss_clean');
        $this->form_validation->set_rules('branch_name_code', 'branch_name_code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('request_type', 'request_type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('case_category', 'case_category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('case_type', 'case_type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('present_status', 'present_status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('account_name', 'account_name', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('dealing_lawyer_hc', 'dealing_lawyer_hc', 'trim|xss_clean');
        $this->form_validation->set_rules('accused_name', 'accused_name', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('hc_case_status', 'hc_case_status', 'trim|xss_clean');
        $this->form_validation->set_rules('nature_suit', 'nature_suit', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('withdrawn_date', 'withdrawn_date', 'trim|xss_clean');
        $this->form_validation->set_rules('petitioner', 'petitioner', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cdo_remarks', 'cdo_remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('related_with', 'related_with', 'trim|xss_clean');
        $this->form_validation->set_rules('related_case', 'related_case', 'trim|xss_clean');
        $this->form_validation->set_rules('suit_details', 'suit_details', 'trim|xss_clean');
        //$this->form_validation->set_rules('law_chamber_pre', 'law_chamber_pre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('case_filing_date', 'case_filing_date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lawyer_name_pre', 'lawyer_name_pre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('engage_date', 'engage_date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('case_number', 'case_number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('case_year', 'case_year', 'trim|required|xss_clean');
        $this->form_validation->set_rules('hc_division', 'hc_division', 'trim|required|xss_clean');
        $this->form_validation->set_rules('court_name', 'court_name', 'trim|xss_clean');
        //$this->form_validation->set_rules('concerned_div', 'concerned_div', 'trim|required|xss_clean');
        $this->form_validation->set_rules('suit_value', 'suit_value', 'trim|xss_clean');
        $this->form_validation->set_rules('judgment_detail', 'judgment_detail', 'trim|xss_clean');
        $this->form_validation->set_rules('judgment_date', 'judgment_date', 'trim|xss_clean');
        $this->form_validation->set_rules('next_hearing_date', 'next_hearing_date', 'trim|xss_clean');
        $this->form_validation->set_rules('zone', 'zone', 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE){
           

            $edit_id = $this->input->post('edit_row_cdo');
            $activities_datetime = date('Y-m-d H:i:s');
            $activities_by = $this->session->userdata['ast_user']['user_id'];
            $ip_address = $this->input->ip_address();
            $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
            $activities_id = "";
            $description_activities = "";
            

            $request_data = array(
                'request_type'=>$this->input->post('request_type'),
                'case_type'=>$this->input->post('case_type'),
                'case_category'=>$this->input->post('case_category'),
                'previous_case_no'=>$this->input->post('old_case_number'),
                'previous_suit_id'=>$this->input->post('previous_suit_id'),
                'hc_division'=>$this->input->post('hc_division'),
                'cb_number'=>$this->input->post('cb_number'),
                'account_number'=>$this->input->post('account_number'),
                'branch_name_code'=>$this->input->post('branch_name_code'),
                'account_name'=>$this->input->post('account_name'),
                'accused_name'=>$this->input->post('accused_name'),
                'district'=>$this->input->post('district'),
                'nature_suit'=>$this->input->post('nature_suit'),
                'petitioner'=>$this->input->post('petitioner'),
                'suit_details'=>$this->input->post('suit_details'),
                'case_filing_date'=>implode('-',array_reverse(explode('/',$this->input->post('case_filing_date')))),
                'engage_date'=>implode('-',array_reverse(explode('/',$this->input->post('engage_date')))),
                'case_number'=>$this->input->post('case_number'),
                'case_year'=>$this->input->post('case_year'),
                'court_name'=>$this->input->post('court_name'),
                'suit_value'=>$this->input->post('suit_value'),
                'remarks_by_cdo'=>$this->input->post('cdo_remarks'),
                'related_with'=>$this->input->post('related_with'),
                'related_case'=>$this->input->post('related_case'),
                //'law_chamber'=>$this->input->post('law_chamber_pre'),
                'lawyer_name'=>$this->input->post('lawyer_name_pre'),
                'zone'=>$this->input->post('zone'),
                'judgment_detail'=>$this->input->post('judgment_detail'),
            );

            
            $request_data['prv_step']=$this->input->post('present_status');
            $request_data['date_judgment']=implode('-',array_reverse(explode('/',$this->input->post('judgment_date'))));
            //$request_data['withdrawn_date']=implode('-',array_reverse(explode('/',$this->input->post('withdrawn_date'))));
            $request_data['prv_hearing_date']=implode('-',array_reverse(explode('/',$this->input->post('case_filing_date'))));
            if($this->input->post('next_date')!=''){
                $request_data['next_hearing_date']=implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
            }


            $expense_data = array(
                'module_name' =>'HC Matter',
                'main_table' =>'hc_ad_matters',
                'expense_type' => 1,
                'vendor_id' =>$this->security->xss_clean( $this->input->post('dealing_lawyer_hc')),
                'activities_id' => 1,
                'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('case_filing_date')))),
                );
            
            if($this->input->post('add_edit_cdo')=="add"){
                $request_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
                $request_data['e_dt'] = date('Y-m-d H:i:s');
                $request_data['v_sts'] = 39;
                $request_data['cdo_life_cycle'] = 1;
                $request_data['cdo_sts'] = 1;
                $this->db->insert('hc_ad_matters', $request_data);
                $insert_idss = $this->db->insert_id();

                /*$expense_data['event_id']=$insert_idss;
                $expense_data['main_table_id']=$insert_idss;
                $expense_data['v_sts']=1;
                $expense_data['e_by']=$this->session->userdata['ast_user']['user_id'];
                $expense_data['e_dt']=date('Y-m-d H:i:s');
                $this->db->insert('legal_expenses', $expense_data);*/

                $activities_id = 39;
                $description_activities = 'Add HC & AD Case File - ('.$insert_idss.')';
            }else{
                $request_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $request_data['u_dt'] = date('Y-m-d H:i:s');
                $request_data['v_sts'] = 35;
                $this->db->where('id', $edit_id);
                $this->db->update('hc_ad_matters', $request_data);
                $insert_idss = $edit_id;

                /*$expense_data['v_sts']=2;
                $expense_data['u_by']=$this->session->userdata['ast_user']['user_id'];
                $expense_data['u_dt']=date('Y-m-d H:i:s');
                $this->db->where("event_id='".$insert_idss."' AND module_name='HC Matter'");
                $this->db->update('legal_expenses', $expense_data);*/

                $activities_id = 35;
                $description_activities = 'Update HC & AD Case File - ('.$insert_idss.')';

            }
            

            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return 00;
            }else{
                $this->User_model->user_activities($activities_id,'HC Matter',$insert_idss,'hc_ad_matters',$description_activities);
                
                $this->db->trans_commit();
                //$this->User_model->user_activities($activities_id,'',$insert_idss,'hc_ad_matters',$description_activities);
                
                return $insert_idss;
            }
        }else{
            return validation_errors();
        }
        
    }
    function get_cdo_edit_info($id){
        $this->db->select('s.*,
            if(s.date_judgment=0000-00-00,"",DATE_FORMAT(s.date_judgment,"%d/%m/%Y")) as date_judgment,
            if(s.date_judgment=0000-00-00,"",DATE_FORMAT(s.date_judgment,"%d/%m/%Y")) as date_judgment,
           
            if(s.prv_hearing_date=0000-00-00,"",DATE_FORMAT(s.prv_hearing_date,"%d/%m/%Y")) as prv_hearing_date,
            if(s.next_hearing_date=0000-00-00,"",DATE_FORMAT(s.next_hearing_date,"%d/%m/%Y")) as next_hearing_date,
            if(s.case_filing_date=0000-00-00,"",DATE_FORMAT(s.case_filing_date,"%d/%m/%Y")) as case_filing_date

            ', FALSE)
            ->from("hc_ad_matters s")
            //->join('hc_matter_status s', 's.hc_matter_id=a.id', 'left')
            ->where("s.id='".$id."' AND s.sts=1 AND v_sts IN (35,39,90,38)", NULL, FALSE)
            ->limit(1);
        $q=$this->db->get();
        $result = $q->row();
        return $result;
    }


    // Case Status Update Start 
    
    function get_sts_update_edit_info($id){
        $this->db->select('s.*, stsp.name as status_name_prv,j0.petitioner,
            lp.name as lawyer_name_prv,j0.lawyer_name as prv_lawyer,
            st.name as prv_case_step,
            j0.law_chamber as law_chamber_last,
            d.name as case_division,cat.name as case_category_name,ty.name as case_type_name,
            concat(j0.case_number,"/",j0.case_year) as case_number, 
            if(j0.account_name="",j0.accused_name,j0.account_name) as account_name,
            date_format(s.case_date,"%d/%m/%Y") as case_date, 
            date_format(s.disposed_order_date,"%d/%m/%Y") as disposed_order_date, 
            sts.name as status_name_pres,l.name as lawyer_name_pres,
            DATE_FORMAT(s.case_date_prv,"%d/%m/%Y") as case_date_prv,
            if(s.next_date=0000-00-00,"",DATE_FORMAT(s.next_date,"%d/%m/%Y")) as next_date,
            j0.last_sts_up_id', FALSE)
            ->from("hc_ad_matters j0")
            ->join('hc_ad_case_sts_update s', 's.id=j0.last_sts_up_id', 'left')
            ->join('ref_hc_case_status sts', 'sts.id=s.case_status', 'left')
            ->join('ref_hc_case_status stsp', 'stsp.id=s.case_status_prv', 'left')
            ->join('ref_lawyer l', 'l.id=s.lawyer', 'left')
            ->join('ref_lawyer lp', 'lp.id=j0.lawyer_name', 'left')
            ->join('ref_hc_division d', 'd.id=j0.hc_division', 'left')
            ->join('ref_hc_case_category cat', 'cat.id=j0.case_category', 'left')
            ->join('ref_hc_case_type ty', 'ty.id=j0.case_type', 'left')
            ->join('ref_hc_case_status st', 'st.id=j0.prv_step', 'left')
            ->where("j0.id='".$id."' AND j0.sts<>0 ", NULL, FALSE)
            ->limit(1);
        $q=$this->db->get();
        $result = $q->row();
        return $result;
    }
    function get_case_expense_edit_info($id,$module_name,$history_id=null){
        $where ='';
        if($history_id!=''){
            $where='AND e.event_id='.$history_id;
        }
        $this->db->select('e.*,
            if(UNIX_TIMESTAMP(e.activities_date) IS NULL,"",DATE_FORMAT(e.activities_date,"%d/%m/%Y")) AS activities_date
            ', FALSE)
            ->from("legal_expenses e")
            ->where("e.main_table_id=".$id." ".$where." AND e.module_name='".$module_name."' AND e.sts<>0 AND e.v_sts IN (1,2,20)", NULL, FALSE);
        $q=$this->db->get();
        $result = $q->result();
        return $result;
    }
    function get_expense_amount($act_id,$district=null,$req_type=null){
        $select = "a.instation as amount";
        $table_name = "ref_expenses_activities";
        $sql="SELECT $select FROM $table_name a WHERE a.id='".$act_id."'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    function status_update_add_edit_action(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $this->form_validation->set_rules('edit_row', 'edit_row', 'trim|xss_clean');
        $this->form_validation->set_rules('sub_id', 'sub_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('add_edit', 'add_edit', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('court_name', 'court_name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lawyer', 'lawyer', 'trim|xss_clean');
        $this->form_validation->set_rules('case_step', 'case_step', 'trim|required|xss_clean');
        $this->form_validation->set_rules('entry_date', 'entry_date', 'trim|xss_clean');
        $this->form_validation->set_rules('disposed_order_date', 'disposed_order_date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('from_date', 'from_date', 'trim|xss_clean');
        $this->form_validation->set_rules('to_date', 'to_date', 'trim|xss_clean');
        $this->form_validation->set_rules('remarks', 'remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('bb_remarks', 'bb_remarks', 'trim|xss_clean');
        $this->form_validation->set_rules('next_date', 'next_date', 'trim|xss_clean');
        if ($this->form_validation->run() == TRUE){

            $hc_id = $this->input->post('sub_id');
            $add_edit = $this->input->post('add_edit');
            $edit_id = $this->input->post('edit_row');
            $activities_datetime = date('Y-m-d H:i:s');
            $activities_by = $this->session->userdata['ast_user']['user_id'];
            $ip_address = $this->input->ip_address();
            $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
            $activities_id = "";
            $description_activities = "";
            
            $disposed_order_date = implode('-',array_reverse(explode('/',$this->input->post('disposed_order_date'))));
            $request_data = array(
                //'court_name' =>$this->input->post('court_name'),
                'case_status' =>$this->input->post('case_step'),
                'disposed_order_date' =>$disposed_order_date,
                'remarks' =>$this->input->post('remarks'),
                'bb_remarks' =>$this->input->post('bb_remarks'),
            );
            
            if($this->input->post('lawyer')!=''){
                $request_data['lawyer']=$this->input->post('lawyer');
            }
            if($this->input->post('next_date')!=''){
                $request_data['next_date']=implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
            }
            if($this->input->post('entry_date')!=''){
                $request_data['entry_date']=implode('-',array_reverse(explode('/',$this->input->post('entry_date'))));
            }
            if($this->input->post('from_date')!=''){
                $request_data['stay_from_date']=implode('-',array_reverse(explode('/',$this->input->post('from_date'))));
            }
            if($this->input->post('to_date')!=''){
                $request_data['stay_to_date']=implode('-',array_reverse(explode('/',$this->input->post('to_date'))));
            }

            // get HC Suit Row
            $suit_row = $this->db->query("SELECT * FROM hc_ad_matters WHERE id=$hc_id AND sts<>0")->row();


            // Change Lawyer
            if($this->input->post('lawyer')!=$suit_row->lawyer_name){
                $file = $this->get_file_name('noc_file','legal_unit/hc_case/noc_file/');
                $request_data['noc_file']=$file;
            }
            
            $expense_data = array(
                'module_name' =>'HC Matter sts',
                'main_table' =>'hc_ad_matters',
                'sub_table' =>'hc_ad_case_sts_update',
                'expense_type' =>'1',
                'activities_id' => $this->security->xss_clean($this->input->post('case_step')),
                'activities_date' => $disposed_order_date,
            );
            if($this->input->post('lawyer')!=''){
                $expense_data['vendor_id']=$this->input->post('lawyer');
            }else{
                $expense_data['vendor_id']=$suit_row->lawyer_name;
            }

            if($this->input->post('add_edit')=="add"){
                $subordi = $this->db->query("SELECT * FROM hc_ad_case_sts_update WHERE hc_id=$hc_id AND sts<>0 AND v_sts=38 ORDER BY id DESC LIMIT 1")->row();
                if(!empty($subordi)){
                    //$request_data['court_name_prv'] = $subordi->court_name;
                    $request_data['lawyer_prv'] = $suit_row->lawyer_name;
                    $request_data['case_status_prv'] = $suit_row->prv_step;
                    $request_data['case_date_prv'] = $suit_row->prv_hearing_date;

                    if($subordi->remarks!=''){
                        $request_data['remarks_prv'] = $subordi->remarks;
                    }
                }
                $request_data['hc_id'] = $hc_id;
                $request_data['final_remarks'] = 'Running';
                $request_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
                $request_data['e_dt'] = date('Y-m-d H:i:s');
                $request_data['v_sts'] = 39;
                $this->db->insert('hc_ad_case_sts_update', $request_data);
                $insert_idss = $this->db->insert_id();
                $this->db->where('id', $hc_id);
                $this->db->update('hc_ad_matters', array('last_sts_up_id'=>$insert_idss));

                $expense_data['event_id']=$insert_idss;
                $expense_data['main_table_id']=$hc_id;
                $expense_data['sub_table_id']=$insert_idss;
                $expense_data['v_sts']=39;
                $expense_data['e_by']=$this->session->userdata['ast_user']['user_id'];
                $expense_data['e_dt']=date('Y-m-d H:i:s');
                //$this->db->insert('legal_expenses', $expense_data);

                $activities_id = 39;
                $description_activities = 'Add HC & AD Matters Status Update - ('.$insert_idss.')';
            }else{
                $request_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $request_data['u_dt'] = date('Y-m-d H:i:s');
                $request_data['v_sts'] = 35;
                $this->db->where('id', $edit_id);
                $this->db->update('hc_ad_case_sts_update', $request_data);
                $insert_idss = $edit_id;

                $expense_data['v_sts']=35;
                $expense_data['u_by']=$this->session->userdata['ast_user']['user_id'];
                $expense_data['u_dt']=date('Y-m-d H:i:s');
                $this->db->where("event_id='".$insert_idss."' AND module_name='HC Matter sts'");
                //$this->db->update('legal_expenses', $expense_data);

                $activities_id = 35;
                $description_activities = 'Edit HC & AD Matters Status Update - ('.$insert_idss.')';

            }

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return 00;
            }else{

                $this->User_model->user_activities($activities_id,'',$insert_idss,'hc_ad_matters',$description_activities);
                $this->db->trans_commit();
                
                
                return $insert_idss;
            }
        }else{
            return validation_errors();
        }
        
    }
    function get_sts_update_details($id){
        $case_row = $this->db->query("SELECT * FROM hc_ad_matters WHERE id=$id AND sts<>0")->row();

        $this->db->select("s.*,l.name as lawyer_name,
            lp.name as lawyer_name_prv, cs.name as case_sts_name, csp.name as case_sts_name_prv,
            sts.name as status_name,DATE_FORMAT(s.disposed_order_date,'%d/%m/%Y') as case_date, 
            DATE_FORMAT(s.case_date_prv,'%d/%m/%Y') as case_date_prv,
            if(s.next_date=0000-00-00,'',DATE_FORMAT(s.next_date,'%d/%m/%Y')) as next_date
            ",FALSE)
        ->from('hc_ad_case_sts_update as s')
        ->join('ref_lawyer l','l.id=s.lawyer','left')
        ->join('ref_lawyer lp','lp.id=s.lawyer_prv','left')
        ->join('ref_hc_case_status cs','cs.id=s.case_status','left')
        ->join('ref_hc_case_status csp','csp.id=s.case_status_prv','left')
        ->join('ref_status sts','sts.id=s.v_sts','left')
        ->where("s.hc_id=$id AND s.sts<>0 AND s.v_sts<>21")
        ->order_by('s.id','DESC');
        $q =$this->db->get();
        $histories = $q->result();

        /*$quey=$this->db->select("e.*, DATE_FORMAT(e.activities_date,'%d/%m/%Y') as activities_date,et.name as expense_name,l.name as lawyer_name,ea.name as activities_name
            ",FALSE)
        ->from('legal_expenses as e')
        ->join('ref_expenses_type et','et.id=e.expense_type','left')
        ->join('ref_lawyer l','l.id=e.vendor_id','left')
        ->join('ref_expenses_activities ea','ea.id=e.activities_id','left')
        ->where("e.event_id='".$case_row->last_sts_up_id."' AND e.sts<>0 AND e.module_name='HC Matter sts'")
        ->get();
        $expenses = $quey->result();*/
        $html ='';
        $html .='<h3>Status History</h3>
        <table style="width: 100%;" class="preview_table2" >
                <tr>
                    <th>SL</th>
                    <th>Lawyer Name</th>
                    <th>Case Status</th>
                    <th>Case Date </th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>BB Remarks</th>
                </tr>
                ';
        foreach($histories as $key => $history){
            $i=$key+1;
            $html .='<tr>
                        <td>'.$i.'</td>
                        <td>'.$history->lawyer_name.'</td>
                        <td>'.$history->case_sts_name.'</td>
                        <td>'.$history->case_date.'</td>
                        <td>'.$history->remarks.'</td>
                        <td>'.$history->status_name.'</td>
                        <td>'.$history->bb_remarks.'</td>
                    </tr>';
        }
        $html .='</table>';

        return $html;
    }
    function sts_udate_delete_action(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $table_name = "hc_ad_case_sts_update";
        $activities_id='';
        $row_id='';
        $description_activities='';
        $reason ='';

        if($this->input->post('type')=='delete'){
            $sub_row = $this->db->query("SELECT * FROM hc_ad_matters WHERE id=".$_POST['deleteEventId'])->row();
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_case_sts_update',$sub_row->last_sts_up_id,0,'sts');

            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $getuprow = $this->db->query("SELECT * FROM hc_ad_case_sts_update WHERE id NOT IN (".$sub_row->last_sts_up_id.") AND v_sts=38 AND sts <>0 ORDER BY id DESC LIMIT 1")->row();
                $data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
                $expense = $data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);

                $this->db->where('id', $sub_row->last_sts_up_id);
                $this->db->update('hc_ad_case_sts_update', $data);

                /*$this->db->where('event_id = '.$sub_row->last_sts_up_id.' AND module_name="HC Matter sts" AND sts<>0');
                $this->db->update('legal_expenses', $expense);*/

                if(!empty($getuprow)){$dd = $getuprow->id;}else{$dd='';}
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('hc_ad_matters', array('last_sts_up_id'=>$dd));
                $activities_id = 15;
                $description_activities = 'Delete HC & AD Matters Status Update - ('.$sub_row->last_sts_up_id.')';
                $row_id=$sub_row->last_sts_up_id;
                $reason =trim($_POST['comments']);
            }
            
        }
        if($this->input->post('type')=='sendtochecker'){
            $sub_row = $this->db->query("SELECT * FROM hc_ad_matters WHERE id=".$_POST['verifyid'])->row();
            $sts_row = $this->db->query("SELECT * FROM hc_ad_case_sts_update WHERE id=".$sub_row->last_sts_up_id)->row();

            
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_case_sts_update',$sub_row->last_sts_up_id,37,'v_sts');
            
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('v_sts'=>37,'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $sub_row->last_sts_up_id);
                $this->db->update('hc_ad_case_sts_update', $data);

                $activities_id = 37;
                $description_activities = 'Send to Checker HC & AD Matters Status Update - ('.$sub_row->last_sts_up_id.')';
                

                $row_id=$sub_row->last_sts_up_id;
                
            }
        }
        
        if($this->input->post('type')=='verify_return'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_matters',$_POST['verifyid'],'90,38,91','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('corr_hol_reason'=>$_POST['return_reason_verify'],'corr_hol_by'=> $this->session->userdata['ast_user']['user_id'], 'corr_hol_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('hc_ad_matters', $data);

                $reason=$_POST['return_reason_verify'];
                $activities_id = 90;
                $description_activities = 'Return by HOL HC & AD Matters- ('.$_POST['verifyid'].')';
                $row_id=$_POST['verifyid'];

            }
        }
        if($this->input->post('type')=='verify_reject'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_matters',$_POST['verifyid'],'91,38','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {

                $data = array('dec_hol_reason'=>$_POST['return_reason_verify'],'dec_hol_by'=> $this->session->userdata['ast_user']['user_id'], 'dec_hol_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('hc_ad_matters', $data);

                $reason=$_POST['return_reason_verify'];
                $activities_id = 91;
                $description_activities = 'Decline by HOL HC & AD Matters- ('.$_POST['verifyid'].')';
                $row_id=$_POST['verifyid'];
                
            }    
        }
        if($this->input->post('type')=='verify'){
            $sub_row = $this->db->query("SELECT * FROM hc_ad_matters WHERE id=".$_POST['verifyid'])->row();
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_ad_case_sts_update',$sub_row->last_sts_up_id,38,'v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $sts_data = $this->db->query("SELECT * FROM hc_ad_case_sts_update WHERE id=".$sub_row->last_sts_up_id)->row();

                $expense = $data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
                $hc_array = array(
                    'prv_step'=>$sts_data->case_status,
                    'prv_hearing_date'=>$sts_data->disposed_order_date,
                    'last_case_sts_update_date'=>$sts_data->disposed_order_date,
                );
                if($sts_data->law_chamber!=''){
                    $hc_array['law_chamber']=$sts_data->law_chamber;
                    $hc_array['law_chamber_prv']=$sub_row->law_chamber;
                }
                if($sts_data->lawyer!=''){
                    $hc_array['lawyer_name']=$sts_data->lawyer;
                    $hc_array['lawyer_name_prv']=$sub_row->lawyer_name;
                    
                    $change_request = array('module'=>'hcad_sts','change_type'=>'lawyer','suit_id'=>$_POST['verifyid'],'status_id'=>$sub_row->last_sts_up_id,'law_chamber_id'=>$sts_data->law_chamber,'law_id'=>$sts_data->lawyer,'e_by'=>$this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'),'last_sts'=>55);

                    $this->db->insert('law_court_change_request', $change_request);
                }
                if($sts_data->next_date!=''){
                    $hc_array['next_hearing_date']=$sts_data->next_date;
                }
                if($sts_data->entry_date!=''){
                    $hc_array['entry_date']=$sts_data->entry_date;
                }
                if($sts_data->stay_from_date!=''){
                    $hc_array['stay_from_date']=$sts_data->stay_from_date;
                }
                if($sts_data->stay_to_date!=''){
                    $hc_array['stay_to_date']=$sts_data->stay_to_date;
                }
                
                if($sts_data->case_status ==2){
                    
                    $data['final_remarks']='Close';
                    $hc_array['final_remarks']='2';
                }

                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('hc_ad_matters', $hc_array);


                $this->db->where('id', $sub_row->last_sts_up_id);
                $this->db->update('hc_ad_case_sts_update', $data);

                /*$this->db->where('event_id = '.$sub_row->last_sts_up_id.' AND sts<>0');
                $this->db->update('legal_expenses', $expense);*/

                $lower_court_suit_data = array('hc_last_sts'=>$sts_data->case_status);

                $activities_id = 38;
                $description_activities = 'Approve by HOL HC & AD Matters Status Update - ('.$sub_row->last_sts_up_id.')';
                $row_id=$sub_row->last_sts_up_id;
                
            }
        }
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->db->db_debug = $db_debug;
            return 0;
        }
        else {
            //$this->User_model->legal_file_history('hc_ad_case_sts_update',$row_id,$activities_id,'hc matter',$description_activities,$reason);//table/id/actid/module/des/reason
            $this->User_model->user_activities($activities_id,'',$row_id,'hc_ad_case_sts_update',$description_activities,$reason);

            $this->db->trans_commit();

            $this->db->db_debug = $db_debug;
            return $row_id;
        }
    }

    function search_by_case(){
        $court_type = $this->input->post('s_court_type');
        $case_number = $this->input->post('s_case_number');
        $case_year = $this->input->post('s_case_year');
        $html ='<table style="width: 100%;" class="preview_table2" >
                <tr>
                    <th></th>
                    <th>Account Name</th>
                    <th>Case Number</th>
                    <th>Case Type</th>
                    <th>Court Type</th>
                    <th>Preview</th>
                </tr>
                ';
        if($court_type=='Subordinate'){
            $this->db->select('s.*,n.name as nature_suit_name', FALSE)
                ->from("subordinate_case s")
                ->join('ref_hc_nuture_suit n', 's.nature_suit=n.id', 'left')
                ->where("s.case_number='".$case_number."' AND s.case_year='".$case_year."' AND s.sts<>0 ", NULL, FALSE)
                ;
            $q=$this->db->get();
            $result = $q->result();
            if(!empty($result)){
                foreach($result as $val){
                    $html.='<tr>
                        <td><input type="checkbox" name="check_id" value="'.$val->id.'" onclick="onlyOne(this)"><input type="hidden" name="type_'.$val->id.'" id="type_'.$val->id.'" value="subordinate"></td>
                        <td>'.$val->account_name.'</td>
                        <td>'.$val->case_number.'</td>
                        <td>'.$val->nature_suit_name.'</td>
                        <td>Subordinate Case</td>
                        <td><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="all_case_details('.$val->id.',\'Subordinate\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
                    </tr>';
                }
            }
        }
        
        if($court_type=='CNC'){
            $case_numbercnc = $case_number.'/'.$case_year;
            $this->db->select('c.*,s.name as req_type_name', FALSE)
                ->from("cnc_suit_filling_info c")
                ->join('ref_req_type s', 's.id=c.req_type', 'left')
                ->where("c.suit_number LIKE '%".$case_numbercnc."%' AND c.sts<>0 ", NULL, FALSE)
                ;
            $q=$this->db->get();
            $cncres = $q->result();
            if(!empty($cncres)){
                foreach($cncres as $val){
                    $html.='<tr>
                        <td><input type="checkbox" name="check_id" value="'.$val->id.'" onclick="onlyOne(this)"><input type="hidden" name="type_'.$val->id.'" id="type_'.$val->id.'" value="cnc"></td>
                        <td>'.$val->ac_name.'</td>
                        <td>'.$val->suit_number.'</td>
                        <td>'.$val->req_type_name.'</td>
                        <td>CNC Case</td>
                        <td><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="all_case_details('.$val->id.',\'CNC\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
                    </tr>';
                }
            } 
        }
        if($court_type=='SAMD'){
            $case_numbersamd = $case_number.'/'.$case_year;
            $this->db->select('m.*,s.name as req_type_name', FALSE)
                ->from("samd_suit_filling_info m")
                ->join('ref_req_type s', 's.id=m.req_type', 'left')
                ->where("m.suit_number LIKE '%".$case_numbersamd."%' AND m.sts<>0 ", NULL, FALSE)
                ;
            $q=$this->db->get();
            $samdres = $q->result();
            if(!empty($samdres)){
                foreach($samdres as $val){
                    $html.='<tr>
                        <td><input type="checkbox" name="check_id" value="'.$val->id.'" onclick="onlyOne(this)"><input type="hidden" name="type_'.$val->id.'" id="type_'.$val->id.'" value="samd"></td>
                        <td>'.$val->ac_name.'</td>
                        <td>'.$val->suit_number.'</td>
                        <td>'.$val->req_type_name.'</td>
                        <td>SAMD Case</td>
                        <td><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="all_case_details('.$val->id.',\'SAMD\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
                    </tr>';
                }
            }
        }

        $html.='</table>';
        return $html;
    }

    function load_case($id){
        $result = '';
        
            $this->db->select('s.*
            ', FALSE)
            ->from("suit_filling_info s")
            ->where("s.id='".$id."' AND s.sts<>0", NULL, FALSE)
            ->limit(1);
            $q=$this->db->get();
            $result = $q->row();

        
        
        return $result;
    }

    function get_r_history($id,$type=Null) // get data for edit
    {
        if($id!=''){
            $str=" SELECT r.activites,r.reason,s.name AS status_name,DATE_FORMAT(r.e_dt,'%d-%b-%y %h:%i %p') AS r_dt,CONCAT(u.name,' (',u.user_id,')') AS r_by
                FROM legal_file_history r
                LEFT JOIN users_info AS u ON u.id=r.e_by
                LEFT JOIN ref_status AS s ON s.id=r.act_id
                WHERE r.module='hc matter' AND r.table_name='hc_ad_matters' AND r.table_id=".$this->db->escape($id)." ORDER BY r.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }

    function get_r_sts_history($id,$type=Null) // get data for edit
    {
        if($id!=''){
            $str=" SELECT r.activites,r.reason,s.name AS status_name,DATE_FORMAT(r.e_dt,'%d-%b-%y %h:%i %p') AS r_dt,CONCAT(u.name,' (',u.user_id,')') AS r_by
                FROM legal_file_history r
                LEFT JOIN users_info AS u ON u.id=r.e_by
                LEFT JOIN ref_status AS s ON s.id=r.act_id
                WHERE r.module='hc matter' AND r.table_name='hc_ad_case_sts_update' AND r.table_id=".$this->db->escape($id)." ORDER BY r.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }

    function get_all_cases()
    {
        $str_where = " s.sts <>0 ";
        $limit="";



            if(isset($_POST['proposed_type']))
            {
                if (trim($this->input->post('proposed_type')) != '') {
                    $str_where.= " AND s.request_type='".trim($this->input->post('proposed_type'))."'";
                }
            }
            if(isset($_POST['s_account']))
            {
                if (trim($this->input->post('s_account')) != '') {
                    $str_where.= " AND s.account_number='".trim($this->input->post('s_account'))."'";
                }
            }

            if (isset($_POST['hc_division'])) {
                if (trim($this->input->post('hc_division')) != '') {
                    $str_where.= " AND s.hc_division='".trim($this->input->post('hc_division'))."'";
                }
            } 
            if (isset($_POST['case_category'])) {
                if (trim($this->input->post('case_category')) != '') {
                    $str_where.= " AND s.case_category='".trim($this->input->post('case_category'))."'";
                }
            } 
            if (isset($_POST['case_type'])) {
                if (trim($this->input->post('case_type')) != '') {
                    $str_where.= " AND s.case_type='".trim($this->input->post('case_type'))."'";
                }
            } 
            if(isset($_POST['s_case_number']))
            {
                if (trim($this->input->post('s_case_number')) != '') {
                    $str_where.= " AND s.case_number=".$this->db->escape(trim($this->input->post('s_case_number')));
                }
            }
            if(isset($_POST['case_year']))
            {
                if (trim($this->input->post('case_year')) != '') {
                    $str_where.= " AND s.case_year=".$this->db->escape(trim($this->input->post('case_year')));
                }
            }
            
            if(isset($_POST['limit']))
            {
                if (trim($this->input->post('limit')) != '' && trim($this->input->post('limit')) != 'All') {
                    $limit= trim($this->input->post('limit'));
                }
            }

        // final_remarks
        if (isset($_POST['present_status'])) {
            if (trim($this->input->post('present_status')) != '') {
                $str_where.= " AND s.final_remarks='".trim($this->input->post('present_status'))."'";
            }
        } 


        
        if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
        else{$filling_dt_from='0';}
        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
        else{$filling_dt_to='0';}

        if( $filling_dt_from!='0' && $filling_dt_to=='0')
        { $str_where.= " and s.case_filing_date='".$filling_dt_from."'"; }
        
        if( $filling_dt_from!='0' && $filling_dt_to!='0')
        { $str_where.= " and s.case_filing_date between '".$filling_dt_from."' and '".$filling_dt_to."'";}


        
        $this->db->select('s.*,s.id as uniq_id,
            
            if(s.case_filing_date=0000-00-00,"",DATE_FORMAT(s.case_filing_date,"%d-%b-%y")) AS case_filing_date,
            if(s.date_judgment=0000-00-00,"",DATE_FORMAT(s.date_judgment,"%d-%b-%y")) AS date_judgment,
            if(s.judgment_detail=0000-00-00,"",DATE_FORMAT(s.judgment_detail,"%d-%b-%y")) AS judgment_detail,
            
            if(s.prv_hearing_date=0000-00-00,"",DATE_FORMAT(s.prv_hearing_date,"%d-%b-%y")) AS prv_hearing_date,
            if(s.next_hearing_date=0000-00-00,"",DATE_FORMAT(s.next_hearing_date,"%d-%b-%y")) AS next_hearing_date,

            if(s.entry_date=0000-00-00,"",DATE_FORMAT(s.entry_date,"%d-%b-%y")) AS entry_date,
            if(s.stay_from_date=0000-00-00,"",DATE_FORMAT(s.stay_from_date,"%d-%b-%y")) AS stay_from_date,
            if(s.stay_to_date=0000-00-00,"",DATE_FORMAT(s.stay_to_date,"%d-%b-%y")) AS stay_to_date,
            if(s.last_case_sts_update_date=0000-00-00,"",DATE_FORMAT(s.last_case_sts_update_date,"%d-%b-%y")) AS last_case_sts_update_date,
            b.name as branch_name_code,
            b.code as branch_code,
            n.name as nature_suit,
            case.name as hc_case_status,
            l.name as lawyer_name, 
            z.name as zone,
            ps.name as prv_step, ns.name as next_step,
            ct.name as case_type_name,div.name as hc_division_name,cat.name as case_category_name,dis.name as district_name,rel.name as related_with_name,
            fmrk.name as final_remarks_name
            ', FALSE)
            ->from("hc_ad_matters s")
            ->join('users_info u', 'u.id=s.e_by', 'left')
            ->join('ref_branch_sol b', 'b.id=s.branch_name_code', 'left')
            ->join('ref_hc_nuture_suit n', 'n.id=s.nature_suit', 'left')
            ->join('ref_court c', 'c.id=s.court_name', 'left')
            ->join('ref_hc_case_status case', 'case.id=s.prv_step', 'left')
            ->join('ref_lawyer l', 'l.id=s.lawyer_name', 'left')
            ->join('ref_zone z', 'z.id=s.zone', 'left')
            ->join('ref_hc_case_status ps', 'ps.id=s.prv_step', 'left')
            ->join('ref_hc_case_status ns', 'ns.id=s.next_step', 'left')
            ->join('ref_hc_case_type ct', 'ct.id=s.case_type', 'left')
            ->join('ref_hc_division div', 'div.id=s.hc_division', 'left')
            ->join('ref_hc_case_category cat', 'cat.id=s.case_category', 'left')
            ->join('ref_district dis', 'dis.id=s.district', 'left')
            ->join('ref_related_with_hc rel', 'rel.id=s.related_with', 'left')

            ->join('ref_final_remarks fmrk', 'fmrk.id=s.final_remarks', 'left')



            ->where($str_where);
            if($limit!=''){
                $this->db->limit($limit);
            }
        $query=$this->db->get();
        return $query->result();
    }
}