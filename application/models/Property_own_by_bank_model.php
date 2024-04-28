<?php
class Property_own_by_bank_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }



    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        //$where2 = "b.sts!='0' and b.life_cycle IN(4)";
        $where2 ="j0.sts!=0";

        if($this->input->get('sell_no_grid_search')!='') 
        {$where2.=" AND j0.sell_deed_no = '".trim($this->input->get('sell_no_grid_search'))."'";}

        if($this->input->get('mutation_number_gird_search')!='') 
        {$where2.=" AND j0.mutation_status_number = '".trim($this->input->get('mutation_number_gird_search'))."'";}

        if($this->input->get('petition_number_grid_search')!='') 
        {$where2.=" AND j0.petition_number = '".trim($this->input->get('petition_number_grid_search'))."'";}



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

                if($filterdatafield=='loan_ac')
                {
                    $filterdatafield='c.loan_ac';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='c.sl_no';
                }
                else if($filterdatafield=='case_number')
                {
                    $filterdatafield='c.case_number';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j1.name';
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='u_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(j0.u_dt,'%d-%b-%y %h:%i %p')";
                }
                

                else{$filterdatafield='b.'.$filterdatafield;}

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

                // build the "WHERE" clause depending on the filter's condition, value and datafield.
                if($filterdatafield =='e_by')
                {
                    $where .= " (j0.name LIKE '%".$filtervalue."%' OR j0.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='u_by')
                {
                    $where .= " (j0.name LIKE '%".$filtervalue."%' OR j0.user_id LIKE '%".$filtervalue."%') ";
                }
                else{
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
        
        if ($sortorder == '')
        {
            $sortdatafield="j0.id";
            $sortorder = "DESC";                
        }


        $this->db->select('SQL_CALC_FOUND_ROWS j0.*,j1.name as status,IF(j0.sell_deed=0,"Yes","No") as sell_deed,j0.sell_deed_no,  IF(j0.possession_recovery_by=0,"Yes","No") as possession_recovery_by, IF(j0.possession_taken_by=0,"Yes","No") as possession_taken_by,DATE_FORMAT(j0.possession_taken_by_date,"%d-%b-%y %h:%i %p") AS possession_taken_by_date,  
        , IF(j0.mutation_status=0,"Yes","No") as mutation_status,j0.sell_deed_no,j0.mutation_status_number, DATE_FORMAT(j0.mutation_status_date,"%d-%b-%y %h:%i %p") AS mutation_status_date   ,j0. district, IF(j0.petition_status=0,"Yes","No") as petition_status,j0.petition_number,
        DATE_FORMAT(j0.petition_date,"%d-%b-%y %h:%i %p") AS petition_date,
        j0.remarks,j2.name as thana_name,j3.name as district_name,(CASE 
        WHEN j0.mutation_process = 0 THEN "A.C.Land"
         WHEN j0.mutation_process = 1 THEN "HC"
         WHEN j0.mutation_process = 2 THEN "Not Stayed" END) as mutation_process', FALSE)

        ->from("change_property_own_by_bank j0")
        ->join('ref_status as j1', 'j0.sts=j1.id', 'left')


        ->join('csms_ref_thana as j2', 'j0.thana=j2.id', 'left')

        ->join('csms_ref_districts as j3', 'j0.district=j3.id', 'left')

            ->where($where)
            ->where($where2)
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
    function get_expense_data($id)
    {
        if($id!=''){
            $str=" SELECT j0.*
            FROM expenses as j0
            WHERE j0.sts=1 AND j0.event_id= ".$id." AND j0.module_name='Case Status' ORDER BY id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_package_details($id,$req_type)
    {
        $join = "";
        if ($req_type==1) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (h.activities_id=a.id)";
            $select = "a.name as activities_name,";
        }
        else if ($req_type==2) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as a on (h.activities_id=a.id)";
            $select = "a.name as activities_name,";
        }
        else
        {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (h.activities_id=a.id)";
            $select = "a.name as activities_name,";
        }
        if($id!=''){
            $str="SELECT h.*,".$select."h.id as history_id,c.id as package_id,c.case_number,c.loan_ac,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,c.package_amount,l.name as lawyer_name
            FROM package_select_history as h 
            LEFT OUTER JOIN lawyer_package_bill_setup c on(h.package_id=c.id)
            LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
            $join
            WHERE h.event_id='".$id."' AND h.amount_selection=1 AND h.event_table_name='change_request' LIMIT 1";
            $query=$this->db->query($str);
            return $query->row();
        }
        else{return NULL;}
    }
    function get_expense_details($id,$req_type)
    {
        $join = "";
        if ($req_type==1) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (j0.activities_name=a.id AND j0.expense_type=1)";
            $select = "a.name,";
        }
        else if ($req_type==2) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as a on (j0.activities_name=a.id AND j0.expense_type=1)";
            $select = "a.name,";
        }
        else
        {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (j0.activities_name=a.id AND j0.expense_type=1)";
            $select = "a.name,";
        }
        if($id!=''){
            $str=" SELECT j0.amount,j0.proxy_sts,j0.expense_type,j0.remarks,IF(j0.expense_type=1 or j0.expense_type=4,l.name,IF(expense_type=2,v.name,IF((j0.expense_type=3 or j0.expense_type=5),CONCAT(u.name,' (',u.user_id,')'),j0.vendor_name))) as vendor_name,
            e.name as expense_type_name,DATE_FORMAT(j0.activities_date,'%d-%b-%y') AS activities_date,
            IF(j0.expense_type=1,".$select."IF(j0.expense_type=2,p.name,IF(j0.expense_type=3,s.name,IF(j0.expense_type=4,c.name,IF(j0.expense_type=5,en.name,ot.name))))) as activities_name
            FROM expenses as j0
            LEFT OUTER JOIN ref_expense_type as e on (j0.expense_type=e.id)
            LEFT OUTER JOIN ref_lawyer as l on (j0.vendor_id=l.id and (j0.expense_type=1 or j0.expense_type=4))
            LEFT OUTER JOIN ref_paper_vendor as v on (j0.vendor_id=v.id and j0.expense_type=2)
            LEFT OUTER JOIN users_info as u on (j0.vendor_id=u.id and (j0.expense_type=3 or j0.expense_type=5))
            LEFT OUTER JOIN ref_paper_bill_activities as p on (j0.activities_name=p.id and j0.expense_type=2)
            LEFT OUTER JOIN ref_staff_conv_activities as s on (j0.activities_name=s.id and j0.expense_type=3)
            LEFT OUTER JOIN ref_court_fee_activities as c on (j0.activities_name=c.id and j0.expense_type=4)
            LEFT OUTER JOIN ref_court_entertainment_activities as en on (j0.activities_name=en.id and j0.expense_type=5)
            LEFT OUTER JOIN ref_others_cost_activities as ot on (j0.activities_name=ot.id and j0.expense_type=6)
            $join
            WHERE j0.sts=1 AND j0.event_id= ".$id." AND j0.module_name='Case Status' ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_case_status_history($id)
    {
        if($id!=''){
            $str=" SELECT j0.*,pre_c.name as prev_case_sts,prs_c.name as present_case_sts,
            CONCAT(u.name,' (',u.user_id,')')as e_by,DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,DATE_FORMAT(j0.next_case_dt,'%d-%b-%y') AS next_case_dt,
            next_dt_pur.name as next_dt_purpose
            FROM change_request as j0
            LEFT OUTER JOIN ref_case_sts as pre_c on (j0.prev_item=pre_c.id)
            LEFT OUTER JOIN ref_case_sts as prs_c on (j0.case_sts=prs_c.id)
            LEFT OUTER JOIN ref_case_sts as next_dt_pur on (j0.next_date_purpose=next_dt_pur.id)
            LEFT OUTER JOIN users_info as u on (j0.e_by=u.id)
            WHERE j0.sts=51 AND j0.suit_file_id= ".$this->db->escape($id)." AND j0.change_type=1 ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_security($id) // get data for edit
	{
		if($id!=''){

			$new_query=" SELECT j0.*,j1.name as deed_type,d.name as district,t.name as thana,s.name as sub_reg_office,
				date_format(j0.reg_date,'%d-%b-%y') as reg_date,j2.name as mouza
			FROM cma_facility_mortgage_security as j0
			LEFT OUTER JOIN csms_ref_districts as d on(d.id=j0.district)
			LEFT OUTER JOIN csms_ref_thana as t on(t.id=j0.thana)
			LEFT OUTER JOIN csms_ref_sro_office_name as s on(s.id=j0.sub_reg_office)
			LEFT OUTER JOIN csms_ref_type_of_deed as j1 on(j1.id=j0.deed_type)
			LEFT OUTER JOIN csms_ref_mouza as j2 on(j2.id=j0.mouza)
			WHERE j0.cma_id= ".$this->db->escape($id)." AND j0.sts='1' ORDER BY j0.id ASC";
			$new_query = $this->db->query($new_query);
			$security_info = $new_query->result();


            $str='';

              $i =1;
                $str.='<br/><div id="security_div" style="background-color:#eaeaea;padding:10px;overflow:scroll;margin-top:10px;padding-top:20px;">
                    <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Security Info</span>
                    <table border="1" id="gurantor_table_security" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:150%;margin:20px" >
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
                	foreach ($security_info as $key) 
                	{
                		$str.='<tr>';
                			$str.='<td align="center">'.$key->title_deed_number.'</td>';
                			$str.='<td align="center">'.$key->reg_date.'</td>';
                			$str.='<td align="center">'.$key->deed_type.'</td>';
                			$str.='<td align="center">'.$key->district.'</td>';
                			$str.='<td align="center">'.$key->thana.'</td>';
                			$str.='<td align="center">'.$key->sub_reg_office.'</td>';
                			$str.='<td align="center">'.$key->mouza.'</td>';
                			$str.='<td align="center">'.$key->land_area.'</td>';
                			$str.='<td align="center">'.$key->plot_number.'</td>';
                			$str.='<td align="center">'.$key->holding_number.'</td>';
                			$str.='<td align="center">'.$key->jote_no.'</td>';
                			$str.='<td align="center">'.$key->cs_khatian_no.'</td>';
                			$str.='<td align="center">'.$key->sa_khatian_no.'</td>';
                			$str.='<td align="center">'.$key->rs_khatian_no.'</td>';
                			$str.='<td align="center">'.$key->bs_dp_khatian_no.'</td>';
                			$str.='<td align="center">'.$key->city_jorip_khatian_no.'</td>';
                			$str.='<td align="center">'.$key->mutation_khatian_no.'</td>';
                			$str.='<td align="center">'.$key->cs_dag_no.'</td>';
                			$str.='<td align="center">'.$key->sa_dag_no.'</td>';
                			$str.='<td align="center">'.$key->rs_dag_no.'</td>';
                			$str.='<td align="center">'.$key->bs_dp_dag_no.'</td>';
                			$str.='<td align="center">'.$key->city_jorip_dag_no.'</td>';
                		$str.='</tr>';
                		$i++;
                	}
                $str.='<input type="hidden" name="security_counter_preview" id="security_counter_preview" value="'.($i-1).'">';
                $str.='</tbody>
                        </table>
                    </div>';
    
                
                   return $str;
            



		}
		else{return NULL;}
	}
    function get_bulk_data()
    {
        $where2 = "b.sts!='0' AND b.change_type=1";
        $where2.=" AND b.sts = '37'";
        if($this->input->post('legal_region') != '')
        {
            $where2.=" AND s.legal_region = '".$this->input->post('legal_region')."'";
        }
        if($this->input->post('legal_district') != '')
        {
            $where2.=" AND s.district = '".$this->input->post('legal_district')."'";
        }
        if($this->input->post('case_deal_officer') != '')
        {
            $where2.=" AND s.case_deal_officer = '".$this->input->post('case_deal_officer')."'";
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
        {$where2.=" AND DATE(b.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
        {$where2.=" AND DATE(b.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(b.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('b.*,s.case_number,s.loan_ac,s.ac_name,j8.name as case_sts,
                DATE_FORMAT(b.case_dt,"%d-%b-%y") AS case_dt,j10.name as prev_case_sts,
                DATE_FORMAT(b.next_case_dt,"%d-%b-%y") AS next_case_dt,
                DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt,DATE_FORMAT(b.u_dt,"%d-%b-%y") AS u_dt,
                CONCAT(j6.name," (",j6.user_id,")")as e_by,
                CONCAT(j7.name," (",j7.user_id,")")as u_by', FALSE)
            ->from("change_request b")
            ->join('suit_filling_info as s', 'b.suit_file_id=s.id', 'left')
            ->join('users_info as j6', 'b.e_by=j6.id', 'left')
            ->join('users_info as j7', 'b.u_by=j7.id', 'left')
            ->join('ref_case_sts as j8', 'b.case_sts=j8.id', 'left')
            ->join('ref_case_sts as j10', 'b.prev_item=j10.id', 'left')
            ->where($where2)
            ->order_by('b.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function get_add_action_data($id)
    {
        $this->db
                    ->select("b.*,
            IF(YEAR(b.possession_taken_by_date)>0,  DATE_FORMAT(b.possession_taken_by_date,'%d/%m/%Y') ,'') AS possession_taken_by_date ,IF(YEAR(b.mutation_status_date)>0,  DATE_FORMAT(b.mutation_status_date,'%d/%m/%Y') ,'') AS mutation_status_date,
                    IF(YEAR(b.petition_date)>0,  DATE_FORMAT(b.petition_date,'%d/%m/%Y') ,'') AS petition_date,
            
                    IF(b.district>0,b.district,'') AS district,
                    IF(b.thana>0,b.thana,'') AS thana
                    
                    ", FALSE)

                    

                    ->from("change_property_own_by_bank b")
                    ->where("b.sts!=0 and b.id='".$id."'", NULL, FALSE)
                    ->limit(1);
                $data = $this->db->get()->row();
                return $data;
    }
    function get_pre_case_sts($id)
    {
        $str=" SELECT cr.id as changed_id,ca.name as case_sts_next_dt,DATEDIFF(b.next_date,'".date('Y-m-d')."') as dif,b.case_sts_next_dt as next_date_sts,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,'%d/%m/%Y'),b.next_date) AS next_date,b.case_sts_prev_dt as pre_case_sts_sl,cr.remarks as prev_case_sts_remarks,
            DATE_FORMAT(cr.case_dt,'%d-%b-%Y') AS prev_case_dt,cr.next_dt_remarks,IF(b.req_type=2,sca.name,scn.name) as act_prev_date
            FROM suit_filling_info as b
            LEFT OUTER JOIN ref_case_sts as ca on (b.case_sts_prev_dt=ca.id)
            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (b.act_prev_date=scn.id AND b.req_type=1)
            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (b.act_prev_date=sca.id AND b.req_type=2)
            LEFT OUTER JOIN(
                SELECT c.* FROM change_request c WHERE c.sts<>0 AND c.change_type=1 AND c.suit_file_id='".$id."' AND c.sts=51 ORDER BY id DESC LIMIT 1
            ) cr on (cr.suit_file_id=b.id)
            WHERE b.id='".$id."' LIMIT 1";
        $query=$this->db->query($str);
        return $query->row();
    }
    function get_details($id)
    {

        $this->db->select(' j0.*,j1.name as status,IF(j0.sell_deed=0,"Yes","No") as sell_deed,j0.sell_deed_no,  IF(j0.possession_recovery_by=0,"Yes","No") as possession_recovery_by, IF(j0.possession_taken_by=0,"Yes","No") as possession_taken_by,DATE_FORMAT(j0.possession_taken_by_date,"%d-%b-%y %h:%i %p") AS possession_taken_by_date,  
        , IF(j0.mutation_status=0,"Yes","No") as mutation_status,j0.sell_deed_no,j0.mutation_status_number, DATE_FORMAT(j0.mutation_status_date,"%d-%b-%y %h:%i %p") AS mutation_status_date   ,j0. district, IF(j0.petition_status=0,"Yes","No") as petition_status,j0.petition_number,
        DATE_FORMAT(j0.petition_date,"%d-%b-%y %h:%i %p") AS petition_date,
        j0.remarks,j2.name as thana_name,j3.name as district_name,(CASE 
        WHEN j0.mutation_process = 0 THEN "A.C.Land"
        WHEN j0.mutation_process = 1 THEN "HC"
        WHEN j0.mutation_process = 2 THEN "Not Stayed" END) as mutation_process', FALSE)


        ->from("change_property_own_by_bank j0")
        ->join('ref_status as j1', 'j0.sts=j1.id', 'left')
        ->join('csms_ref_thana as j2', 'j0.thana=j2.id', 'left')
        ->join('csms_ref_districts as j3', 'j0.district=j3.id', 'left')





            ->where("j0.sts!=0 and j0.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }

    function delete_action($id=NULL,$bulk=NULL,$type=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('change_property_own_by_bank',$_POST['deleteEventId'],'0','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array(
                    'sts' => 0,
                    'd_reason'=>$this->input->post('comments'),
                    'd_by'=> $this->session->userdata['ast_user']['user_id'],
                    'd_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('change_property_own_by_bank', $data);

                // $data2 = $this->user_model->user_activities(67,'suit_file',$this->input->post('deleteEventId'),'change_property_own_by_bank','Case Status Delete('.$this->input->post('deleteEventId').')',$_POST['comments']);
            }
            
        }
        if($this->input->post('type')=='sendtochecker'){

            $pre_action_result=$this->Common_model->get_pre_action_data('change_property_own_by_bank',$_POST['deleteEventId'],'37','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data2 = array(
                    'sts' => 37,
                    'stc_by'=> $this->session->userdata['ast_user']['user_id'],
                    'stc_dt'=>date('Y-m-d H:i:s')
                );
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('change_property_own_by_bank', $data2);
                // $data3 = $this->user_model->user_activities(37,'suit_file',$this->input->post('deleteEventId'),'change_request','Case Status Send To Checker('.$this->input->post('deleteEventId').')');
            }
            
        }
       

        if($this->input->post('type')=='verify'){
            $pre_action_result=$this->Common_model->get_pre_action_data('change_property_own_by_bank',$_POST['deleteEventId'],'38','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else{

                $data2 = array(
                    'sts' => 38,
                    'v_by'=> $this->session->userdata['ast_user']['user_id'],
                    'v_dt'=>date('Y-m-d H:i:s')
                );
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('change_property_own_by_bank', $data2);

            }   
        }

        //  NBA
        if($this->input->post('type')=='updatenextdate'){


            $pre_action_result=$this->Common_model->get_pre_action_data('change_property_own_by_bank',$_POST['deleteEventId'],'2','sts');
            if (count($pre_action_result)>0)
            {
                return 'taken';
            }
            else{
                $data2 = array(
                    'non_banker_asset' => $_POST['non_banker_asset'],
                    'non_banker_asset_date' => implode('-',array_reverse(explode('/',$this->input->post('new_next_date')))),
                    'sts' => 104,
                );
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('change_property_own_by_bank', $data2);

            }

        }

        if($this->input->post('type')=='approve'){

            $pre_action_result=$this->Common_model->get_pre_action_data('change_property_own_by_bank',$_POST['deleteEventId'],'51','sts');
            if (count($pre_action_result)>0)
            {
                return 'taken';
            }
            else{
                $data2 = array(
                    'sts' => 105,
                );
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('change_property_own_by_bank', $data2);

            }
        }

        if($this->input->post('type')=='decline_approval'){

       
                $data2 = array(
                    'sts' => 2,
                );
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('change_property_own_by_bank', $data2);

            
        }




        // 








        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->db->db_debug = $db_debug;
            return 0;
        }
        else {
            $this->db->trans_commit();
            $this->db->db_debug = $db_debug;
            return $_POST['deleteEventId'];
        }
    }
    function bulk_acktion()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('operation')=='approve'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('change_request',$_POST['id_'.$i],'51','sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        
                       //Update Case Status
                        $str="SELECT  j0.remarks,j0.not_available_sts,j0.next_dt_remarks,j0.next_dt_sts,j0.next_date_purpose,j0.e_by,j0.case_dt,j0.next_case_dt,j0.e_dt,j0.final_remarks,j0.case_sts,j0.suit_file_id,j0.new_lawyer_name,j0.new_plaintiff,j0.new_court,j0.new_district
                                 FROM change_request j0
                             WHERE j0.sts != '0'  AND j0.id= '".$_POST['id_'.$i]."'";   
                        $case_sts_data=$this->db->query($str)->row();
                        $str2="SELECT  j0.*
                                 FROM suit_filling_info j0
                             WHERE j0.id= '".$case_sts_data->suit_file_id."'";   
                        $suit_data=$this->db->query($str2)->row();
                        //For Expense data
                        $loan_ac = $suit_data->loan_ac;
                        $org_loan_ac = $suit_data->org_loan_ac;
                        $ac_name = $suit_data->ac_name;
                        $req_type = $suit_data->req_type;
                        $loan_segment = $suit_data->loan_segment;
                        $region = $suit_data->region;
                        $territory = $suit_data->territory;
                        $district = $suit_data->district;
                        $proposed_type = $suit_data->proposed_type;
                        $case_number = $suit_data->case_number;
                        $prev_remarks = $suit_data->remarks_next_date;
                        $data2 = array();

                        //Genereate Package Expenses
                        $str="SELECT  j0.*,s.lawyer,IF(s.disbursed_amount IS NULL,0,s.disbursed_amount) as disbursed_amount,s.package_amount
                                 FROM package_select_history j0
                                 LEFT OUTER JOIN lawyer_package_bill_setup s on(s.id=j0.package_id)
                             WHERE j0.event_table_name='change_request' AND j0.amount_selection=1  AND j0.event_id= '".$_POST['id_'.$i]."' LIMIT 1";   
                        $package_data=$this->db->query($str)->row();
                        if (!empty($package_data)) {
                            $total_disbursed_amount = $package_data->disbursed_amount+$package_data->amount;
                            if($total_disbursed_amount>$package_data->package_amount)
                            {
                                return 'limitcrossed';
                            }
                            if($total_disbursed_amount==$package_data->package_amount)
                            {
                                $disbursed_sts = 1;
                            }
                            else
                            {
                                $disbursed_sts = 0;
                            }
                            //update total disbursed amount
                            $data = array('disbursed_amount' => $total_disbursed_amount,'disbursed_sts' => $disbursed_sts);
                            $this->db->where('id', $package_data->package_id);
                            $this->db->update('lawyer_package_bill_setup', $data);

                            $cost_data = array(
                                    'module_name' => 'suit_file',
                                    'main_table_name' => 'suit_filling_info',
                                    'main_table_id' => $case_sts_data->suit_file_id,
                                    'sub_table_name' => 'package_select_history',
                                    'sub_table_id' => $package_data->id,
                                    'suit_id' => $case_sts_data->suit_file_id,
                                    'activities_id' => $package_data->activities_id,
                                    'package_id' => $package_data->package_id,
                                    'vendor_type' => 1,
                                    'vendor_id' => $package_data->lawyer,
                                    'amount' =>$package_data->amount,
                                    'txrn_dt' => $case_sts_data->e_dt,
                                    'loan_ac' =>$loan_ac,
                                    'org_loan_ac' =>$org_loan_ac,
                                    'ac_name' =>$ac_name,
                                    'req_type' =>$req_type,
                                    'proposed_type' =>$proposed_type,
                                    'loan_segment' =>$loan_segment,
                                    'case_number' =>$case_number,
                                    'region' =>$region,
                                    'territory' =>$territory,
                                    'district' =>$district
                                );
                            $data3=$this->user_model->cost_details($cost_data);
                            
                        }

                        if($case_sts_data->new_lawyer_name!='' && $case_sts_data->new_lawyer_name!=NULL && $case_sts_data->new_lawyer_name!=0)
                        {
                            $data2['prest_lawyer_name'] = $case_sts_data->new_lawyer_name;
                            $data2['prev_lawyer_name'] = $suit_data->prest_lawyer_name;
                            $str="SELECT  j0.id
                                 FROM change_request j0
                             WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_lawyer_name IS NOT NULL AND j0.new_lawyer_name!='0')  AND j0.suit_file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                            $pre_changed_data=$this->db->query($str)->row();
                            if(!empty($pre_changed_data))
                            {
                                $new_data = array('suit_alocated_date_lawyer'=>date('Y-m-d H:i:s'));
                                $this->db->where('id', $pre_changed_data->id);
                                $this->db->update('change_request', $new_data);
                            }
                        }
                        if($case_sts_data->new_plaintiff!='' && $case_sts_data->new_plaintiff!=NULL && $case_sts_data->new_plaintiff!=0)
                        {
                            $data2['prev_plaintiff'] = $suit_data->present_plaintiff;
                            $data2['present_plaintiff'] = $suit_data->case_deal_officer;
                            $data2['case_deal_officer'] = $case_sts_data->new_plaintiff;

                            $str="SELECT  j0.id
                                 FROM change_request j0
                             WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_plaintiff IS NOT NULL AND j0.new_plaintiff!='0')  AND j0.suit_file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                            $pre_changed_data=$this->db->query($str)->row();
                            if(!empty($pre_changed_data))
                            {
                                $new_data = array('suit_alocated_date_plaintiff'=>date('Y-m-d H:i:s'));
                                $this->db->where('id', $pre_changed_data->id);
                                $this->db->update('change_request', $new_data);
                            }
                        }
                        if($case_sts_data->new_court!='' && $case_sts_data->new_court!=NULL && $case_sts_data->new_court!=0)
                        {
                            $data2['prest_court_name'] = $case_sts_data->new_court;
                            $data2['prev_court_name'] = $suit_data->prest_court_name;

                            $str="SELECT  j0.id
                                 FROM change_request j0
                             WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_court IS NOT NULL AND j0.new_court!='0')  AND j0.suit_file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                            $pre_changed_data=$this->db->query($str)->row();
                            if(!empty($pre_changed_data))
                            {
                                $new_data = array('suit_alocated_date_court'=>date('Y-m-d H:i:s'));
                                $this->db->where('id', $pre_changed_data->id);
                                $this->db->update('change_request', $new_data);
                            }
                        }
                        if($case_sts_data->new_district!='' && $case_sts_data->new_district!=NULL && $case_sts_data->new_district!=0)
                        {
                            $data2['district'] = $case_sts_data->new_district;

                            $str="SELECT  j0.id
                                 FROM change_request j0
                             WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_district IS NOT NULL AND j0.new_district!='0')  AND j0.suit_file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                            $pre_changed_data=$this->db->query($str)->row();
                            if(!empty($pre_changed_data))
                            {
                                $new_data = array('suit_alocated_date_district'=>date('Y-m-d H:i:s'));
                                $this->db->where('id', $pre_changed_data->id);
                                $this->db->update('change_request', $new_data);
                            }
                        }
                        //For Update suitfile info
                        
                        //$data2['prev_date'] = $suit_data->filling_date;
                        $data2['remarks_next_date'] = $case_sts_data->next_dt_remarks;
                        $data2['remarks_prev_date'] = $case_sts_data->remarks;
                        $data2['case_sts_next_dt'] = $case_sts_data->next_date_purpose;
                        $data2['next_date'] = $case_sts_data->next_case_dt;
                        $data2['next_dt_sts'] = $case_sts_data->next_dt_sts;
                        $data2['not_available_sts'] = $case_sts_data->not_available_sts;
                        $data2['case_sts_prev_dt'] = $case_sts_data->case_sts;
                        $data2['final_remarks'] = $case_sts_data->final_remarks;
                        $data2['prev_date'] = $case_sts_data->case_dt;
                        $data2['last_case_sts_update_dt'] = $case_sts_data->e_dt;
                        $data2['last_case_sts_id'] = $_POST['id_'.$i];
                        if($case_sts_data->final_remarks==2) //When case withdrawn
                        {
                            $data2['suit_sts'] = 76;
                            $data2['ac_close_by'] = $case_sts_data->e_by;
                            $data2['ac_close_dt'] = date('Y-m-d H:i:s');
                        }
                        $this->db->where('id', $case_sts_data->suit_file_id);
                        $this->db->update('suit_filling_info', $data2);
                        //Update status
                        $data2 = array();
                        $data2 = array('sts' => 51,'v_by'=> $this->session->userdata['ast_user']['user_id'],'v_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('change_request', $data2);
                        //Genereate Expenses
                        $str="SELECT  j0.*,c.suit_file_id
                                 FROM expenses j0
                                 LEFT OUTER JOIN change_request as c on (j0.event_id=c.id)
                             WHERE j0.sts != '0'  AND j0.event_id= '".$this->input->post('id_'.$i)."' AND j0.module_name='Case Status'";   
                        $expense_data=$this->db->query($str)->result();
                        if (!empty($expense_data)) {
                                $txrn_dt='';
                                $orginal_vendor_id = '';
                                $pre_case_act=0;
                                foreach ($expense_data as $key) {
                                    //Duplicate bill with proxy check
                                    if($key->proxy_sts==1)
                                    {
                                        $txrn_dt=$key->activities_date;
                                        $orginal_vendor_id = $key->proxy_against;
                                    }
                                    if($orginal_vendor_id==$key->vendor_id && $txrn_dt==$key->activities_date)
                                    {
                                        $duplicate_bill_with_proxy = 1;
                                    }
                                    else
                                    {
                                        $duplicate_bill_with_proxy = 0;
                                    }
                                    $cost_data = array(
                                    'module_name' => 'suit_file',
                                    'main_table_name' => 'suit_filling_info',
                                    'main_table_id' => $_POST['suit_file_id_'.$i],
                                    'sub_table_name' => 'expenses',
                                    'sub_table_id' => $key->id,
                                    'suit_id' => $_POST['suit_file_id_'.$i],
                                    'activities_id' => $key->activities_name,
                                    'vendor_type' => $key->expense_type,
                                    'vendor_id' => $key->vendor_id,
                                    'proxy_sts' => $key->proxy_sts,
                                    'proxy_against' => $key->proxy_against,
                                    'duplicate_bill_with_proxy' => $duplicate_bill_with_proxy,
                                    'vendor_name' => $key->vendor_name,
                                    'amount' =>$key->amount,
                                    'txrn_dt' => $key->activities_date,
                                    'loan_ac' =>$loan_ac,
                                    'org_loan_ac' =>$org_loan_ac,
                                    'ac_name' =>$ac_name,
                                    'req_type' =>$req_type,
                                    'proposed_type' =>$proposed_type,
                                    'loan_segment' =>$loan_segment,
                                    'case_number' =>$case_number,
                                    'region' =>$region,
                                    'territory' =>$territory,
                                    'district' =>$district,
                                    'expense_remarks' =>$key->remarks
                                );
                                    $pre_case_act=$key->activities_name;
                                    $data3=$this->user_model->cost_details($cost_data);
                            }
                            if($pre_case_act!=0)//For suit file last activities update
                            {
                                $suit_data = array('act_prev_date' => $pre_case_act);
                                $this->db->where('id', $case_sts_data->suit_file_id);
                                $this->db->update('suit_filling_info', $suit_data);
                            }
                        }
                        $data3 = $this->user_model->user_activities(51,'suit_file',$this->input->post('id_'.$i),'change_request','Case Status Verify('.$this->input->post('id_'.$i).')');
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='return'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('change_request',$_POST['id_'.$i],'90','sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $data2 = array('sts' => 90,'r_reason' => $_POST['return_reason'],'r_by'=> $this->session->userdata['ast_user']['user_id'],'r_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('change_request', $data2);
                        $data3 = $this->user_model->user_activities(90,'suit_file',$this->input->post('id_'.$i),'change_request','Case Status Return('.$this->input->post('id_'.$i).')',$_POST['return_reason']);
                    }
                }
                
                
            }
        }
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->db->db_debug = $db_debug;
            return 0;
        }
        else {
            $this->db->trans_commit();
            $this->db->db_debug = $db_debug;
            return 1;
        }
    }
    function get_file_name($field_name,$path)
    {
        //Deleteng old file when no new file selected
        if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            unlink($delete_path);   
            $file ="";
        }//Deleteng old file and new file selected
        else if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='1') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            unlink($delete_path);   
            $file = $this->Common_model->get_file_name('cma',$field_name,$path);
        }//Taking Old File
        else if (isset($_POST['hidden_'.$field_name.'_value']) && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $file = $_POST['hidden_'.$field_name.'_value'];
        }//Taking Full New File
        else
        {
            $file = $this->Common_model->get_file_name('cma',$field_name,$path);
        }
        return $file;
    }

    function add_edit()
    {


        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start




         $data = array(
                'cma_auction_id' =>$this->security->xss_clean( $this->input->post('cma_auction_id')),
                'sell_deed' =>$this->security->xss_clean( $this->input->post('sell_deed')),
                'sell_deed_no' =>$this->security->xss_clean( $this->input->post('sell_deed_no')),
                'possession_recovery_by' =>$this->security->xss_clean( $this->input->post('possession_recovery_by')),
                'possession_taken_by' =>$this->security->xss_clean( $this->input->post('possession_taken_by')),
                'possession_taken_by_date' => implode('-',array_reverse(explode('/',$this->input->post('possession_taken_by_date')))),
                'mutation_status' =>$this->security->xss_clean( $this->input->post('mutation_status')),
                'mutation_status_number' =>$this->security->xss_clean( $this->input->post('mutation_status_number')),
                'mutation_status_date' =>implode('-',array_reverse(explode('/',$this->input->post('mutation_status_date')))),

                'thana'    => $this->security->xss_clean( $this->input->post('thana')),
                'district' =>$this->security->xss_clean( $this->input->post('district')),
                'mutation_status' =>$this->security->xss_clean( $this->input->post('mutation_status')),
                'petition_status' =>$this->security->xss_clean( $this->input->post('petition_status')),
                'petition_number' =>$this->security->xss_clean( $this->input->post('petition_number')),
                'petition_date' =>implode('-',array_reverse(explode('/',$this->input->post('petition_date')))),
                'mutation_process' =>$this->security->xss_clean( $this->input->post('mutation_process')),
                'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
        );

        // echo "<pre>";
        // print_r($data);
        // die;


        if ($this->input->post('add_edit')=='add') 
        {

            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['e_dt'] = date('Y-m-d H:i:s');
            $data['sts'] = 39;
            $this->db->insert('change_property_own_by_bank', $data);
            $insert_idss = $this->db->insert_id();
            


        }
        else //For Update 
        {
            $edit_id = $this->input->post('edit_id');
            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $data['sts'] = 35;

            $this->db->where('id', $edit_id);
            $this->db->update('change_property_own_by_bank', $data);
            $insert_idss = $edit_id;
            //echo $this->db->last_query();
           // exit;
        }
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return '00';
        }
        else
        {
            $this->db->trans_commit();
            return $insert_idss;
        }


    }
    function add_edit_after_verify()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $edit_id = $this->input->post('edit_id');
        $insert_idss = $edit_id;
        if($this->security->xss_clean( $this->input->post('lawyer'))!=0)
         {
            $prev_lawyer_name = $this->input->post('lawyer');
         }
         else
         {
            $prev_lawyer_name = $_POST['present_lawyer_id'];
         }
        $this->Common_model->edit_expense($insert_idss,'Case Status',$prev_lawyer_name);
        $data2 = $this->user_model->user_activities(35,'suit_file',$insert_idss,'change_request','Update Case Status & Expense Request('.$insert_idss.')');
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return '00';
        }
        else
        {
            $this->db->trans_commit();
            return $insert_idss;
        }


    }
    function get_suit_filling_info($id)
    {
        if($id!=''){
                $this->db
                ->select("b.*", FALSE)
                ->from("suit_filling_info b")
                ->where("b.cma_id='".$id."'", NULL, FALSE)
                ->limit(1);
            $data = $this->db->get()->row();
        return $data;
        }
        else{return NULL;}
    }
    function get_r_history($id,$type=Null) // get data for edit
    {
        if($id!=''){
            if ($type=='life_cycle') {
                $where="AND(r.activities_id=39 || r.activities_id=37 || r.activities_id=51)";
            }
            else
            {
                $where="";
            }
            $str=" SELECT r.description_activities as oprs_descriptions,r.oprs_reason,s.name as oprs_sts,DATE_FORMAT(r.activities_datetime,'%d-%b-%y %h:%i %p') AS oprs_dt,CONCAT(u.name,' (',u.user_id,')') as r_by
            FROM user_activities_history as r
            LEFT OUTER JOIN users_info u ON u.id=r.activities_by
            LEFT OUTER JOIN ref_status s ON s.id=r.activities_id
            WHERE r.table_row_id= ".$this->db->escape($id)." AND r.section_name='suit_file'  ".$where."  ORDER BY r.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }




}
?>
