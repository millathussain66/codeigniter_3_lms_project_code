<?php
class Case_report_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	function get_protfolio_summery_result()
    {
        $current_year = date('Y');
        $from_year = $current_year-3;
        //For ongoing case
        $ongoing_select="";
        $ongoing_select2="";
        $disposal_select="";
        $newly_filed_select="";
        $ongoing_select_amount="";
        $ongoing_select_amount2="";
        $disposal_select_amount="";
        $newly_filed_select_amount="";
        for ($i=$current_year; $i >=$from_year ; $i--) { 
               if($i==$from_year)
               {
                $filed_name1 = 'count_'.$i;
                $disposal_till = 'disposal_till_'.$i;
                $filed_name2 = 'amount_'.$i;
                $disposal_till_amount = 'disposal_till_amount_'.$i;
                $ongoing_select.=" SUM(IF((YEAR(s.filling_date)<=$i OR s.filling_date IS NULL OR s.filling_date='0000-00-00 00:00:00'),1,0)) AS '$filed_name1'";
                $ongoing_select2.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0)) AS '$disposal_till'";
                $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i,1,0)) AS '$filed_name1'";
                $newly_filed_select.=" SUM(IF(YEAR(s.filling_date)=$i,1,0)) AS '$filed_name1'";
                $ongoing_select_amount.=" SUM(IF((YEAR(s.filling_date)<=$i OR s.filling_date IS NULL OR s.filling_date='0000-00-00 00:00:00'),s.case_claim_amount,0)) AS '$filed_name2'";
                $ongoing_select_amount2.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0)) AS '$disposal_till_amount'";
                $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i,s.case_claim_amount,0)) AS '$filed_name2'";
                $newly_filed_select_amount.=" SUM(IF(YEAR(s.filling_date)=$i,s.case_claim_amount,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name1 = 'count_'.$i;
                $disposal_till = 'disposal_till_'.$i;
                $filed_name2 = 'amount_'.$i;
                $disposal_till_amount = 'disposal_till_amount_'.$i;
                $ongoing_select.=" SUM(IF((YEAR(s.filling_date)<=$i OR s.filling_date IS NULL OR s.filling_date='0000-00-00 00:00:00'),1,0)) AS '$filed_name1',";
                $ongoing_select2.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0)) AS '$disposal_till',";
                $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i,1,0)) AS '$filed_name1',";
                $newly_filed_select.=" SUM(IF(YEAR(s.filling_date)=$i,1,0)) AS '$filed_name1',";
                $ongoing_select_amount.=" SUM(IF((YEAR(s.filling_date)<=$i OR s.filling_date IS NULL OR s.filling_date='0000-00-00 00:00:00'),s.case_claim_amount,0)) AS '$filed_name2',";
                $ongoing_select_amount2.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0)) AS '$disposal_till_amount',";
                $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i,s.case_claim_amount,0)) AS '$filed_name2',";
                $newly_filed_select_amount.=" SUM(IF(YEAR(s.filling_date)=$i,s.case_claim_amount,0)) AS '$filed_name2',";
               }
        }
        $str="SELECT $ongoing_select,$ongoing_select2,$ongoing_select_amount,$ongoing_select_amount2,'Ongoing' as type 
            FROM suit_filling_info as s
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50)
            UNION ALL
            SELECT $disposal_select,$ongoing_select2,$disposal_select_amount,$ongoing_select_amount2,'Disposal' as type 
            FROM suit_filling_info as s
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50)
            UNION ALL
            SELECT $newly_filed_select,$ongoing_select2,$newly_filed_select_amount,$ongoing_select_amount2,'Newly Filed' as type 
            FROM suit_filling_info as s
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50)";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_legal_notice_summery_year_wise()
    {
        $current_year = date('Y');
        $from_year = $current_year-10;
        //For ongoing case
        $ongoing_select="";
        for ($i=$current_year; $i >=$from_year ; $i--) { 
               if($i==$from_year)
               {
                $filed_name1 = 'count_'.$i;
                $ongoing_select.=" SUM(IF((YEAR(s.filling_date)=$i OR s.filling_date IS NULL OR s.filling_date='0000-00-00 00:00:00'),1,0)) AS '$filed_name1'";
               }
               else
               {
                $filed_name1 = 'count_'.$i;
                $ongoing_select.=" SUM(IF((YEAR(s.filling_date)=$i OR s.filling_date IS NULL OR s.filling_date='0000-00-00 00:00:00'),1,0)) AS '$filed_name1',";
               }
        }
        $str="SELECT $ongoing_select,t.name as type 
            FROM fln_summary s
             LEFT JOIN ref_legal_notice_type t ON t.id=s.legal_type
             LEFT JOIN fln_card cd ON cd.batch_no=s.batch_no AND cd.sts<>0
             LEFT JOIN fln_collection cl ON cl.batch_no=s.batch_no AND cl.sts<>0
             LEFT JOIN fln_recovery rc ON rc.batch_no=s.batch_no AND rc.sts<>0
             LEFT JOIN fln_retail rt ON rt.batch_no=s.batch_no AND rt.sts<>0
            WHERE s.sts<>0 AND s.v_sts=24 GROUP BY s.legal_type";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_legal_notice_summery_month_wise()
    {
        $current_year = date('Y');
        //For ongoing case
        $ongoing_select="";
        for ($i=1; $i <=12 ; $i++) { 
               if($i==12)
               {
                $filed_name1 = 'count_'.$i;
                $ongoing_select.=" SUM(IF((MONTH(s.filling_date)=$i OR s.filling_date IS NULL OR s.filling_date='0000-00-00 00:00:00'),1,0)) AS '$filed_name1'";
               }
               else
               {
                $filed_name1 = 'count_'.$i;
                $ongoing_select.=" SUM(IF((MONTH(s.filling_date)=$i OR s.filling_date IS NULL OR s.filling_date='0000-00-00 00:00:00'),1,0)) AS '$filed_name1',";
               }
        }
        $str="SELECT $ongoing_select,t.name as type 
            FROM fln_summary s
             LEFT JOIN ref_legal_notice_type t ON t.id=s.legal_type
             LEFT JOIN fln_card cd ON cd.batch_no=s.batch_no AND cd.sts<>0
             LEFT JOIN fln_collection cl ON cl.batch_no=s.batch_no AND cl.sts<>0
             LEFT JOIN fln_recovery rc ON rc.batch_no=s.batch_no AND rc.sts<>0
             LEFT JOIN fln_retail rt ON rt.batch_no=s.batch_no AND rt.sts<>0
            WHERE YEAR(s.filling_date)=$current_year AND s.sts<>0 AND s.v_sts=24 GROUP BY s.legal_type";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_disposal_summery_cnc_quarter_wise()
    {
        $current_year = date('Y');
        $from_year = $current_year-5;
        
        $querter_month_1="1,2,3";
        $querter_month_2="4,5,6";
        $querter_month_3="7,8,9";
        $querter_month_4="10,11,12";
        $query_str="";
        for ($i=$current_year; $i >=$from_year ; $i--) { 
               if($i==$from_year)
               {
                $filed_name1 = 'count_'.$i;
                $query_str.="SELECT SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt) IN($querter_month_1)),1,0)) AS quarter1,";
                $query_str.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt) IN($querter_month_2)),1,0)) AS quarter2,";
                $query_str.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt) IN($querter_month_3)),1,0)) AS quarter3,";
                $query_str.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt) IN($querter_month_4)),1,0)) AS quarter4, '".$i." & Previous' as year_name";
                $query_str.=" FROM suit_filling_info as s 
                WHERE s.sts<>0 AND s.final_remarks=2";
               }
               else
               {
                $filed_name1 = 'count_'.$i;
                $query_str.="SELECT SUM(IF((YEAR(s.ac_close_dt)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt) IN($querter_month_1)),1,0)) AS quarter1,";
                $query_str.=" SUM(IF((YEAR(s.ac_close_dt)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt) IN($querter_month_2)),1,0)) AS quarter2,";
                $query_str.=" SUM(IF((YEAR(s.ac_close_dt)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt) IN($querter_month_3)),1,0)) AS quarter3,";
                $query_str.=" SUM(IF((YEAR(s.ac_close_dt)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt) IN($querter_month_4)),1,0)) AS quarter4, '".$i."' as year_name";
                $query_str.=" FROM suit_filling_info as s 
                WHERE s.sts<>0 AND s.final_remarks=2
                UNION ALL
                ";
               }
        }
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_disposal_summery_cnc_month_wise()
    {
        $current_year = date('Y');
        $from_year = $current_year-5;
        
        $query_str="";
        for ($i=$current_year; $i >=$from_year ; $i--) { 
               if($i==$from_year)
               {
                $query_str.="SELECT ";
                for ($j=1; $j <=12; $j++) { 
                    if($j==12)
                    {
                        $query_str.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$j),1,0)) AS month$j,";
                        $query_str.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$j),s.case_claim_amount,0)) AS month_amount$j, '".$i." & Previous' as year_name";
                    }
                    else
                    {
                        $query_str.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$j),1,0)) AS month$j,";
                        $query_str.=" SUM(IF((YEAR(s.ac_close_dt)<=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$j),s.case_claim_amount,0)) AS month_amount$j,";
                    }
                }
                $query_str.=" FROM suit_filling_info as s 
                WHERE s.sts<>0 AND s.final_remarks=2";
               }
               else
               {
                $query_str.="SELECT ";
                for ($j=1; $j <=12; $j++) { 
                    if($j==12)
                    {
                        $query_str.=" SUM(IF((YEAR(s.ac_close_dt)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$j),1,0)) AS month$j,";
                        $query_str.=" SUM(IF((YEAR(s.ac_close_dt)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$j),s.case_claim_amount,0)) AS month_amount$j, '".$i."' as year_name";
                    }
                    else
                    {
                        $query_str.=" SUM(IF((YEAR(s.ac_close_dt)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$j),1,0)) AS month$j,";
                        $query_str.=" SUM(IF((YEAR(s.ac_close_dt)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$j),s.case_claim_amount,0)) AS month_amount$j,";
                    }
                }
                $query_str.=" FROM suit_filling_info as s 
                WHERE s.sts<>0 AND s.final_remarks=2
                UNION ALL
                ";
               }
        }
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_filing_summery_cnc_month_wise()
    {
        $current_year = date('Y');
        $from_year = $current_year-5;
        
        $query_str="";
        for ($i=$current_year; $i >=$from_year ; $i--) { 
               if($i==$from_year)
               {
                $query_str.="SELECT ";
                for ($j=1; $j <=12; $j++) { 
                    if($j==12)
                    {
                        $query_str.=" SUM(IF((YEAR(s.filling_date)<=$i AND s.filling_date IS NOT NULL AND s.filling_date<>'0000-00-00 00:00:00' AND MONTH(s.filling_date)=$j),1,0)) AS month$j,";
                        $query_str.=" SUM(IF((YEAR(s.filling_date)<=$i AND s.filling_date IS NOT NULL AND s.filling_date<>'0000-00-00 00:00:00' AND MONTH(s.filling_date)=$j),s.case_claim_amount,0)) AS month_amount$j, '".$i." & Previous' as year_name";
                    }
                    else
                    {
                        $query_str.=" SUM(IF((YEAR(s.filling_date)<=$i AND s.filling_date IS NOT NULL AND s.filling_date<>'0000-00-00 00:00:00' AND MONTH(s.filling_date)=$j),1,0)) AS month$j,";
                        $query_str.=" SUM(IF((YEAR(s.filling_date)<=$i AND s.filling_date IS NOT NULL AND s.filling_date<>'0000-00-00 00:00:00' AND MONTH(s.filling_date)=$j),s.case_claim_amount,0)) AS month_amount$j,";
                    }
                }
                $query_str.=" FROM suit_filling_info as s 
                WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50)";
               }
               else
               {
                $query_str.="SELECT ";
                for ($j=1; $j <=12; $j++) { 
                    if($j==12)
                    {
                        $query_str.=" SUM(IF((YEAR(s.filling_date)=$i AND s.filling_date IS NOT NULL AND s.filling_date<>'0000-00-00 00:00:00' AND MONTH(s.filling_date)=$j),1,0)) AS month$j,";
                        $query_str.=" SUM(IF((YEAR(s.filling_date)=$i AND s.filling_date IS NOT NULL AND s.filling_date<>'0000-00-00 00:00:00' AND MONTH(s.filling_date)=$j),s.case_claim_amount,0)) AS month_amount$j, '".$i."' as year_name";
                    }
                    else
                    {
                        $query_str.=" SUM(IF((YEAR(s.filling_date)=$i AND s.filling_date IS NOT NULL AND s.filling_date<>'0000-00-00 00:00:00' AND MONTH(s.filling_date)=$j),1,0)) AS month$j,";
                        $query_str.=" SUM(IF((YEAR(s.filling_date)=$i AND s.filling_date IS NOT NULL AND s.filling_date<>'0000-00-00 00:00:00' AND MONTH(s.filling_date)=$j),s.case_claim_amount,0)) AS month_amount$j,";
                    }
                }
                $query_str.=" FROM suit_filling_info as s 
                WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50)
                UNION ALL
                ";
               }
        }
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_segment_wise_summery_result()
    {
        $category = $this->db->query("SELECT * FROM ref_req_type where data_status=1")->result();
        $str="SELECT ";
        foreach($category as $key)
        {
            $str.="SUM(IF(s.req_type=$key->id,1,0)) AS count_$key->id,";
        }
        $str.=" r.name as segment_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_loan_segment r ON(r.code=s.loan_segment)
            WHERE s.sts<>0 AND s.suit_sts=47 AND s.final_remarks=1 GROUP BY s.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_segment_wise_summery_result_report()
    {
        $i=date('Y');
        $ongoing_select="";
        $disposal_select="";
        $newly_filed_select="";
        $ongoing_select_amount="";
        $disposal_select_amount="";
        $newly_filed_select_amount="";
        $ongoing_select.=" SUM(IF((YEAR(s.ac_close_dt)>$i OR s.ac_close_dt IS NULL OR s.ac_close_dt='0000-00-00 00:00:00') AND YEAR(s.filling_date)=$i,1,0)) AS ongoing";
        $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.final_remarks=2,1,0)) AS disposal";
        $newly_filed_select.=" SUM(IF(YEAR(s.filling_date)=$i,1,0)) AS new_filling";
        $ongoing_select_amount.=" SUM(IF((YEAR(s.ac_close_dt)>$i OR s.ac_close_dt IS NULL OR s.ac_close_dt='0000-00-00 00:00:00') AND YEAR(s.filling_date)=$i,s.case_claim_amount,0)) AS ongoing_amount";
        $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.final_remarks=2,s.case_claim_amount,0)) AS disposal_amount";
        $newly_filed_select_amount.=" SUM(IF(YEAR(s.filling_date)=$i,s.case_claim_amount,0)) AS new_filling_amount";
        
        $str="SELECT $ongoing_select,$disposal_select,$newly_filed_select,$ongoing_select_amount,$disposal_select_amount,$newly_filed_select_amount,r.name as segment_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_loan_segment r ON(r.code=s.loan_segment)
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) GROUP BY s.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_segment_wise_summery_result_disposal()
    {
        $year = date('Y');
        $str="SELECT ";
        for ($i=1; $i <=12 ; $i++)
        {
            $str.="SUM(IF(s.ac_close_dt IS NOT NULL AND s.ac_close_dt<>'0000-00-00 00:00:00' AND MONTH(s.ac_close_dt)=$i,1,0)) AS count_$i,";
        }
        $str.=" r.name as segment_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_loan_segment r ON(r.code=s.loan_segment)
            WHERE s.sts<>0 AND s.final_remarks=2 AND YEAR(s.ac_close_dt)=$year GROUP BY s.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_disposal_summery_result()
    {
        $current_year = date('Y');
        $from_year = $current_year-3;
        //For ongoing case
        $disposal_select="";
        $disposal_select_amount="";
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.ac_close_dt)=$j,1,0)) AS '$filed_name1'";
            $disposal_select_amount.=" SUM(IF(MONTH(s.ac_close_dt)=$j,s.case_claim_amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.ac_close_dt)=$j,1,0)) AS '$filed_name1',";
            $disposal_select_amount.=" SUM(IF(MONTH(s.ac_close_dt)=$j,s.case_claim_amount,0)) AS '$filed_name2',";
           }
        } 
        $str="
            SELECT $disposal_select,$disposal_select_amount,'Disposal' as type,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,YEAR(s.ac_close_dt) as year 
            FROM suit_filling_info as s
            WHERE s.sts<>0 AND s.final_remarks=2 AND (s.suit_sts=47 OR s.suit_sts=50) GROUP BY YEAR(s.ac_close_dt) ORDER BY s.ac_close_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_new_filling_summery_result()
    {
        $current_year = date('Y');
        $from_year = $current_year-3;
        //For ongoing case
        $disposal_select="";
        $disposal_select_amount="";
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.filling_date)=$j,1,0)) AS '$filed_name1'";
            $disposal_select_amount.=" SUM(IF(MONTH(s.filling_date)=$j,s.case_claim_amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.filling_date)=$j,1,0)) AS '$filed_name1',";
            $disposal_select_amount.=" SUM(IF(MONTH(s.filling_date)=$j,s.case_claim_amount,0)) AS '$filed_name2',";
           }
        } 
        $str="
            SELECT $disposal_select,$disposal_select_amount,'Disposal' as type,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,YEAR(s.filling_date) as year 
            FROM suit_filling_info as s
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) GROUP BY YEAR(s.filling_date) ORDER BY s.filling_date ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_case_wise_summery_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }

        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }
        
        $case_summ = $this->db->query("SELECT r.name as case_type,
                    SUM(IF(s.filling_date <= '".$todt."' AND s.final_remarks=1,1,0)) AS ongoing,
                    SUM(IF(s.filling_date <= '".$todt."' AND s.final_remarks=1,s.case_claim_amount,0)) AS ongoing_amount,
                    SUM(IF(s.filling_date >='".$fromdt."' AND s.filling_date<='".$todt."' AND s.final_remarks=1,1,0)) AS new_filling,
                    SUM(IF(s.filling_date >='".$fromdt."' AND s.filling_date<='".$todt."' AND s.final_remarks=1,s.case_claim_amount,0)) AS new_filling_amount,
                    SUM(IF(s.ac_close_dt >='".$fromdt."' AND s.ac_close_dt<='".$todt."' AND s.final_remarks=2,1,0)) AS disposal,
                    SUM(IF(s.ac_close_dt >='".$fromdt."' AND s.ac_close_dt<='".$todt."' AND s.final_remarks=2,s.case_claim_amount,0)) AS disposal_amount
                    FROM suit_filling_info s 
                    LEFT JOIN ref_req_type r ON r.id=s.req_type
                    WHERE s.final_remarks!=2 AND s.sts<>0 ".$where."
                    GROUP BY s.req_type
                    ORDER BY s.req_type ASC")->result();

        return $case_summ;
    }
    function get_new_filling_summery_case_wise_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
            $where.=" AND s.filling_date >= '".$fromdt."'";
        }else{
            $where.=" AND s.filling_date >= '".date('Y')."-01-01'";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
            $where.=" AND s.filling_date <= '".$todt."'";
        }else{
            $where.=" AND s.filling_date <= '".date('Y-m-d')."'";
        }
        $new_case = $this->db->query("SELECT r.name as case_type,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=1,1,0)) AS jan_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=1,s.case_claim_amount,0)) AS jan_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=2,1,0)) AS fab_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=2,s.case_claim_amount,0)) AS fab_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=3,1,0)) AS mar_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=3,s.case_claim_amount,0)) AS mar_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=4,1,0)) AS apr_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=4,s.case_claim_amount,0)) AS apr_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=5,1,0)) AS may_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=5,s.case_claim_amount,0)) AS may_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=6,1,0)) AS jun_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=6,s.case_claim_amount,0)) AS jun_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=7,1,0)) AS jul_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=7,s.case_claim_amount,0)) AS jul_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=8,1,0)) AS aug_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=8,s.case_claim_amount,0)) AS aug_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=9,1,0)) AS sep_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=9,s.case_claim_amount,0)) AS sep_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=10,1,0)) AS oct_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=10,s.case_claim_amount,0)) AS oct_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=11,1,0)) AS nov_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=11,s.case_claim_amount,0)) AS nov_amt,
            SUM(IF(DATE_FORMAT(s.filling_date,'%m')=12,1,0)) AS dec_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=12,s.case_claim_amount,0)) AS dec_amt,
            count(s.id) AS total_case,SUM(s.case_claim_amount) AS total_amt
            FROM suit_filling_info s 
            LEFT JOIN ref_req_type r ON r.id=s.req_type
            WHERE s.final_remarks=1 AND s.sts<>0 ".$where."
            GROUP BY s.req_type
            ORDER BY s.req_type ASC")->result();
        
        return $new_case;
    }
    function get_disposal_summery_case_wise_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
            $where.=" AND s.ac_close_dt >= '".$fromdt."'";
        }else{
            $where.=" AND s.ac_close_dt >= '".date('Y')."-01-01'";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
            $where.=" AND s.ac_close_dt <= '".$todt."'";
        }else{
            $where.=" AND s.ac_close_dt <= '".date('Y-m-d')."'";
        }
        $dispose_case = $this->db->query("SELECT r.name as case_type,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=1,1,0)) AS jan_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=1,s.case_claim_amount,0)) AS jan_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=2,1,0)) AS fab_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=2,s.case_claim_amount,0)) AS fab_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=3,1,0)) AS mar_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=3,s.case_claim_amount,0)) AS mar_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=4,1,0)) AS apr_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=4,s.case_claim_amount,0)) AS apr_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=5,1,0)) AS may_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=5,s.case_claim_amount,0)) AS may_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=6,1,0)) AS jun_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=6,s.case_claim_amount,0)) AS jun_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=7,1,0)) AS jul_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=7,s.case_claim_amount,0)) AS jul_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=8,1,0)) AS aug_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=8,s.case_claim_amount,0)) AS aug_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=9,1,0)) AS sep_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=9,s.case_claim_amount,0)) AS sep_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=10,1,0)) AS oct_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=10,s.case_claim_amount,0)) AS oct_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=11,1,0)) AS nov_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=11,s.case_claim_amount,0)) AS nov_amt,
                SUM(IF(DATE_FORMAT(s.filling_date,'%m')=12,1,0)) AS dec_case,SUM(IF(DATE_FORMAT(s.filling_date,'%m')=12,s.case_claim_amount,0)) AS dec_amt,
                count(s.id) AS total_case,SUM(s.case_claim_amount) AS total_amt
                FROM suit_filling_info s 
                LEFT JOIN ref_req_type r ON r.id=s.req_type
                WHERE s.final_remarks=2 AND s.sts<>0 ".$where."
                GROUP BY s.req_type
                ORDER BY s.req_type ASC")->result();
        return $dispose_case;
    }
    
    function get_disposal_summery_segment_wise_result()
    {
        $disposal_select="";
        $disposal_select_amount="";
        $str="SELECT j0.*
            FROM ref_req_type as j0
            WHERE j0.data_status<>0 order by j0.id ASC";
            $query=$this->db->query($str);
        $req_type = $query->result();
        $i=date('Y');
        if (!empty($req_type)) {
            $count=count($req_type);
            $counter=0;
            foreach ($req_type as $key) 
            {
                $counter++;
                if($counter==$count)
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1'";
                $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1',";
                $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2',";
               }
            }
            $str="SELECT $disposal_select,$disposal_select_amount,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as segment_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_loan_segment r ON(r.code=s.loan_segment)
            WHERE s.sts<>0 AND YEAR(s.ac_close_dt)=$i AND s.final_remarks=2 AND (s.suit_sts=47 OR s.suit_sts=50) GROUP BY s.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    function get_new_filling_summery_segment_wise_result()
    {
        
        $new_filling_select="";
        $new_filling_select_amount="";
        $str="SELECT j0.*
            FROM ref_req_type as j0
            WHERE j0.data_status<>0 order by j0.id ASC";
            $query=$this->db->query($str);
        $req_type = $query->result();
        $i=date('Y');
        if (!empty($req_type)) {
            $count=count($req_type);
            $counter=0;
            foreach ($req_type as $key) 
            {
                $counter++;
                if($counter==$count)
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $new_filling_select.=" SUM(IF(YEAR(s.filling_date)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1'";
                $new_filling_select_amount.=" SUM(IF(YEAR(s.filling_date)=$i AND s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $new_filling_select.=" SUM(IF(YEAR(s.filling_date)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1',";
                $new_filling_select_amount.=" SUM(IF(YEAR(s.filling_date)=$i AND s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2',";
               }
            }
            $str="SELECT $new_filling_select,$new_filling_select_amount,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as segment_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_loan_segment r ON(r.code=s.loan_segment)
            WHERE s.sts<>0 AND YEAR(s.filling_date)=$i AND (s.suit_sts=47 OR s.suit_sts=50) GROUP BY s.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    function get_ongoing_summery_segment_wise_result()
    {

        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND unit= '".$this->input->post('unit')."'";
        }

        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }
        $str="SET @sql = NULL";
        $str2="
        SELECT
        GROUP_CONCAT(DISTINCT CONCAT(
          'SUM(
          CASE WHEN req_type = \"', req_type, '\" THEN 1 ELSE 0 END) 
          AS ', CONCAT('req_type_',req_type)),
          CONCAT(
          ',SUM(
          CASE WHEN req_type = \"', req_type, '\" THEN case_claim_amount ELSE 0 END) 
          AS ', CONCAT('amt_',req_type))
        )
        INTO @sql
        FROM suit_filling_info ;";
        $str3="SET @sql = CONCAT('SELECT loan_segment,SUM(case_claim_amount) as total_amt,COUNT(id) as total_case, ', @sql, 
          ' FROM suit_filling_info WHERE sts<>0 AND suit_sts IN (47,50) ".$where." GROUP BY loan_segment')";
        $str4="SELECT @sql d";
        $this->db->query($str);
        $this->db->query($str2);
        $this->db->query($str3);
        $res = $this->db->query($str4)->row();
        $r = $this->db->query($res->d)->result();
        /*echo '<pre>';
        print_r($r);exit;*/

        $ongoing_select="";
        $ongoing_select_amount="";
        $str="SELECT j0.*
            FROM ref_req_type as j0
            WHERE j0.data_status<>0 order by j0.id ASC";
            $query=$this->db->query($str);
        $req_type = $query->result();
        $i=date('Y');
        if (!empty($req_type)) {
            $count=count($req_type);
            $counter=0;
            foreach ($req_type as $key) 
            {
                $counter++;
                if($counter==$count)
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $ongoing_select.=" SUM(IF((YEAR(s.ac_close_dt)>$i OR s.ac_close_dt IS NULL OR s.ac_close_dt='0000-00-00 00:00:00') AND YEAR(s.filling_date)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1'";
                $ongoing_select_amount.=" SUM(IF((YEAR(s.ac_close_dt)>$i OR s.ac_close_dt IS NULL OR s.ac_close_dt='0000-00-00 00:00:00') AND YEAR(s.filling_date)=$i AND s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $ongoing_select.=" SUM(IF((YEAR(s.ac_close_dt)>$i OR s.ac_close_dt IS NULL OR s.ac_close_dt='0000-00-00 00:00:00') AND YEAR(s.filling_date)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1',";
                $ongoing_select_amount.=" SUM(IF((YEAR(s.ac_close_dt)>$i OR s.ac_close_dt IS NULL OR s.ac_close_dt='0000-00-00 00:00:00') AND YEAR(s.filling_date)=$i AND s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2',";
               }
            }
            $str="SELECT $ongoing_select,$ongoing_select_amount,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as segment_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_loan_segment r ON(r.code=s.loan_segment)
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) GROUP BY s.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
        }
        else
        {
            return array();
        }
    }

    function get_officer_wise_summery_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }

        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $i=date('Y');
        $ongoing_select="";
        $disposal_select="";
        $disposal_select2="";
        $newly_filed_select="";
        $ongoing_select.=" SUM(IF(s.final_remarks=1,1,0)) AS ongoing";
        $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND YEAR(s.filling_date)=$i AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.final_remarks=2,1,0)) AS disposal_new_filling";
        $disposal_select2.=" SUM(IF(s.final_remarks=2,1,0)) AS disposal_overall";
        $newly_filed_select.=" SUM(IF(YEAR(s.filling_date)=$i,1,0)) AS new_filling";

        $str="SELECT $ongoing_select,$disposal_select,$disposal_select2,$newly_filed_select,r.name as case_deal_officer,r.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info r ON(r.id=s.case_deal_officer)
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_deal_officer";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_disposal_summery_month_wise()
    {
        $current_year = date('Y');
        $where =" AND YEAR(s.ac_close_dt)=$current_year";
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }

        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $disposal_select="";
        $disposal_select_amount="";
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.ac_close_dt)=$j AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00',1,0)) AS '$filed_name1'";
            $disposal_select_amount.=" SUM(IF(MONTH(s.ac_close_dt)=$j AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00',s.case_claim_amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.ac_close_dt)=$j AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00',1,0)) AS '$filed_name1',";
            $disposal_select_amount.=" SUM(IF(MONTH(s.ac_close_dt)=$j AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00',s.case_claim_amount,0)) AS '$filed_name2',";
           }
        }

        $str="SELECT $disposal_select,$disposal_select_amount,r.name as case_deal_officer,r.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info r ON(r.id=s.case_deal_officer)
            WHERE s.sts<>0 AND s.final_remarks=2 ".$where." GROUP BY s.case_deal_officer";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_new_filing_month_wise()
    {
        $current_year = date('Y');
        $where =" AND YEAR(s.filling_date)=$current_year";
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }

        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $disposal_select="";
        $disposal_select_amount="";
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.filling_date)=$j AND s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00',1,0)) AS '$filed_name1'";
            $disposal_select_amount.=" SUM(IF(MONTH(s.filling_date)=$j AND s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00',s.case_claim_amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.filling_date)=$j AND s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00',1,0)) AS '$filed_name1',";
            $disposal_select_amount.=" SUM(IF(MONTH(s.filling_date)=$j AND s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00',s.case_claim_amount,0)) AS '$filed_name2',";
           }
        }

        $str="SELECT $disposal_select,$disposal_select_amount,r.name as case_deal_officer,r.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info r ON(r.id=s.case_deal_officer)
            WHERE s.sts<>0 AND (s.suit_sts=47 or s.suit_sts=50) ".$where." GROUP BY s.case_deal_officer";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_disposal_summery_officer_wise_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }

        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }
        $disposal_select="";
        $disposal_select_amount="";
        $str="SELECT j0.*
            FROM ref_req_type as j0
            WHERE j0.data_status<>0 order by j0.id ASC";
            $query=$this->db->query($str);
        $req_type = $query->result();
        $i=date('Y');
        if (!empty($req_type)) {
            $count=count($req_type);
            $counter=0;
            foreach ($req_type as $key) 
            {
                $counter++;
                if($counter==$count)
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1'";
                $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1',";
                $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i AND s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2',";
               }
            }
            $str="SELECT $disposal_select,$disposal_select_amount,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as case_deal_officer,r.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info r ON(r.id=s.case_deal_officer)
            WHERE s.sts<>0 AND YEAR(s.ac_close_dt)=$i AND s.final_remarks=2 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_deal_officer";
            $query=$this->db->query($str);
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    function get_new_filling_summery_officer_wise_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }

        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $new_filling_select="";
        $new_filling_select_amount="";
        $str="SELECT j0.*
            FROM ref_req_type as j0
            WHERE j0.data_status<>0 order by j0.id ASC";
            $query=$this->db->query($str);
        $req_type = $query->result();
        $i=date('Y');
        if (!empty($req_type)) {
            $count=count($req_type);
            $counter=0;
            foreach ($req_type as $key) 
            {
                $counter++;
                if($counter==$count)
               {
                $filed_name1 = 'count_'.$key->id;
                $new_filling_select.=" SUM(IF(YEAR(s.filling_date)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1'";
               }
               else
               {
                $filed_name1 = 'count_'.$key->id;
                $new_filling_select.=" SUM(IF(YEAR(s.filling_date)=$i AND s.req_type=$key->id,1,0)) AS '$filed_name1',";
               }
            }
            $str="SELECT $new_filling_select,r.name as case_deal_officer,r.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info r ON(r.id=s.case_deal_officer)
            WHERE s.sts<>0 AND YEAR(s.filling_date)=$i AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_deal_officer";
            $query=$this->db->query($str);
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    function get_ongoing_summery_officer_wise_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }

        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $ongoing_select="";
        $ongoing_select_amount="";
        $str="SELECT j0.*
            FROM ref_req_type as j0
            WHERE j0.data_status<>0 order by j0.id ASC";
            $query=$this->db->query($str);
        $req_type = $query->result();
        $i=date('Y');
        if (!empty($req_type)) {
            $count=count($req_type);
            $counter=0;
            foreach ($req_type as $key) 
            {
                $counter++;
                if($counter==$count)
               {
                $filed_name1 = 'count_'.$key->id;
                $ongoing_select.=" SUM(IF(s.final_remarks=1 AND s.suit_sts=47 AND s.req_type=$key->id,1,0)) AS '$filed_name1'";
               }
               else
               {
                $filed_name1 = 'count_'.$key->id;
                $ongoing_select.=" SUM(IF(s.final_remarks=1 AND s.suit_sts=47 AND s.req_type=$key->id,1,0)) AS '$filed_name1',";
               }
            }
            $str="SELECT $ongoing_select,r.name as case_deal_officer,r.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info r ON(r.id=s.case_deal_officer)
            WHERE s.sts<>0 AND s.suit_sts=47 AND s.final_remarks=1 ".$where." GROUP BY s.case_deal_officer";
            $query=$this->db->query($str);
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    function get_disposal_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $disposal_select="";
        $disposal_select_amount="";
        $str="SELECT j0.*
            FROM ref_req_type as j0
            WHERE j0.data_status<>0 order by j0.id ASC";
            $query=$this->db->query($str);
        $req_type = $query->result();
        if (!empty($req_type)) {
            $count=count($req_type);
            $counter=0;
            foreach ($req_type as $key) 
            {
                $counter++;
                if($counter==$count)
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $disposal_select.=" SUM(IF(s.req_type=$key->id,1,0)) AS '$filed_name1'";
                $disposal_select_amount.=" SUM(IF(s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name1 = 'count_'.$key->id;
                $filed_name2 = 'amount_'.$key->id;
                $disposal_select.=" SUM(IF(s.req_type=$key->id,1,0)) AS '$filed_name1',";
                $disposal_select_amount.=" SUM(IF(s.req_type=$key->id,s.case_claim_amount,0)) AS '$filed_name2',";
               }
            }
            $str="SELECT $disposal_select,$disposal_select_amount,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as case_status
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_case_sts r ON(r.id=s.case_sts_prev_dt)
            WHERE s.sts<>0 AND s.final_remarks=2 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_sts_prev_dt";
            $query=$this->db->query($str);
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    function get_disposal_result_year_wise()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $disposal_select="";
        $disposal_select_amount="";
        $current_year = date('Y');
        $from_year = $current_year-10;
        for ($i=$from_year; $i <=$current_year ; $i++) {
            if($i==$current_year)
               {
                $filed_name1 = 'count_'.$i;
                $filed_name2 = 'amount_'.$i;
                $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i,1,0)) AS '$filed_name1'";
                $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i,s.case_claim_amount,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name1 = 'count_'.$i;
                $filed_name2 = 'amount_'.$i;
                $disposal_select.=" SUM(IF(YEAR(s.ac_close_dt)=$i,1,0)) AS '$filed_name1',";
                $disposal_select_amount.=" SUM(IF(YEAR(s.ac_close_dt)=$i,s.case_claim_amount,0)) AS '$filed_name2',";
               }
        }
        $str="SELECT $disposal_select,$disposal_select_amount,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as case_status
        FROM suit_filling_info as s
        LEFT OUTER JOIN ref_case_sts r ON(r.id=s.case_sts_prev_dt)
        WHERE s.sts<>0 AND s.final_remarks=2 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_sts_prev_dt";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_disposal_result_month_wise()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $disposal_select="";
        $disposal_select_amount="";
        $current_year = date('Y');
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.ac_close_dt)=$j,1,0)) AS '$filed_name1'";
            $disposal_select_amount.=" SUM(IF(MONTH(s.ac_close_dt)=$j,s.case_claim_amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.ac_close_dt)=$j,1,0)) AS '$filed_name1',";
            $disposal_select_amount.=" SUM(IF(MONTH(s.ac_close_dt)=$j,s.case_claim_amount,0)) AS '$filed_name2',";
           }
        }
        $str="SELECT $disposal_select,$disposal_select_amount,sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as case_status
        FROM suit_filling_info as s
        LEFT OUTER JOIN ref_case_sts r ON(r.id=s.case_sts_prev_dt)
        WHERE s.sts<>0 AND YEAR(s.ac_close_dt)=$current_year AND s.final_remarks=2 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_sts_prev_dt";
        $query=$this->db->query($str);
        return $query->result();
    }

    function get_case_update_summery_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $i=date('Y');
        $grid_columns = array(
            "365-730",
            "180-365",
            "90-180",
            "0-90"
        );
        $query_str="SELECT ";
        for ($i=0; $i <count($grid_columns); $i++) { 
            $str= explode("-",$grid_columns[$i]);
            $from = $str[0];
            $to = $str[1];
            $filed_name1 = 'count_'.$grid_columns[$i];
            if($i==count($grid_columns)-1)
            {
                
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1'";
                
            }
            else
            {
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1',";
            }
        }
        $query_str.=",SUM(IF(s.next_dt_sts=1,1,0)) AS next_date_available";
        
        $query_str.=",count(s.id) as ongoing_cases,r.name as case_type
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_req_type r ON(r.id=s.req_type)
            WHERE s.sts<>0 AND s.final_remarks=1 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.req_type";
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_case_update_summery_officer_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $i=date('Y');
        $grid_columns = array(
            "365-730",
            "180-365",
            "90-180",
            "0-90"
        );
        $query_str="SELECT ";
        for ($i=0; $i <count($grid_columns); $i++) { 
            $str= explode("-",$grid_columns[$i]);
            $from = $str[0];
            $to = $str[1];
            $filed_name1 = 'count_'.$grid_columns[$i];
            if($i==count($grid_columns)-1)
            {
                
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1'";
                
            }
            else
            {
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1',";
            }
        }
        $query_str.=",SUM(IF(s.next_dt_sts=1,1,0)) AS next_date_available";
        
        $query_str.=",count(s.id) as ongoing_cases,u.name as user_name,u.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info u ON(u.id=s.present_plaintiff)
            WHERE s.sts<>0 AND s.final_remarks=1 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.present_plaintiff";
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_case_update_summery_officer_week_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $query_str="SELECT ";
        $stop_date = date('y-m-d');
        for($i=1;$i<8;$i++){
            $stop_date = date('Y-m-d', strtotime($stop_date . ' +1 day'));
            $query_str.="SUM(IF(DATE(s.next_date)='".$stop_date."',1,0)) AS 'day".$i."',";
        }
        $start_date = date('Y-m-d', strtotime(date('y-m-d') . ' +1 day'));
        $end_date = date('Y-m-d', strtotime(date('y-m-d') . ' +7 day'));
        $query_str.="SUM(IF(DATE(s.next_date)>='".$start_date."' AND DATE(s.next_date)<='".$end_date."',1,0)) AS total,";
        
        $query_str.="count(s.id) as ongoing_cases,u.name as user_name,u.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info u ON(u.id=s.present_plaintiff)
            WHERE s.sts<>0 AND s.final_remarks=1 AND s.suit_sts=47 ".$where." GROUP BY s.present_plaintiff";
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_case_update_summery_nature_week_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $query_str="SELECT ";
        $stop_date = date('y-m-d');
        for($i=1;$i<8;$i++){
            $stop_date = date('Y-m-d', strtotime($stop_date . ' +1 day'));
            $query_str.="SUM(IF(DATE(s.next_date)='".$stop_date."',1,0)) AS 'day".$i."',";
        }
        $start_date = date('Y-m-d', strtotime(date('y-m-d') . ' +1 day'));
        $end_date = date('Y-m-d', strtotime(date('y-m-d') . ' +7 day'));
        $query_str.="SUM(IF(DATE(s.next_date)>='".$start_date."' AND DATE(s.next_date)<='".$end_date."',1,0)) AS total,";
        
        $query_str.="count(s.id) as ongoing_cases,r.name as case_type
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_req_type r ON(r.id=s.req_type)
            WHERE s.sts<>0 AND s.final_remarks=1 AND s.suit_sts=47 ".$where." GROUP BY s.req_type";
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_case_update_summery_step_week_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $query_str="SELECT ";
        $stop_date = date('y-m-d');
        for($i=1;$i<8;$i++){
            $stop_date = date('Y-m-d', strtotime($stop_date . ' +1 day'));
            $query_str.="SUM(IF(DATE(s.next_date)='".$stop_date."',1,0)) AS 'day".$i."',";
        }
        $start_date = date('Y-m-d', strtotime(date('y-m-d') . ' +1 day'));
        $end_date = date('Y-m-d', strtotime(date('y-m-d') . ' +7 day'));
        $query_str.="SUM(IF(DATE(s.next_date)>='".$start_date."' AND DATE(s.next_date)<='".$end_date."',1,0)) AS total,";
        
        $query_str.="count(s.id) as ongoing_cases,r.name as case_status
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_case_sts r ON(r.id=s.case_sts_next_dt)
            WHERE s.sts<>0 AND s.final_remarks=1 AND s.suit_sts=47 ".$where." GROUP BY s.case_sts_next_dt";
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_case_update_summery_result_next_step_wise()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $i=date('Y');
        $grid_columns = array(
            "365-730",
            "180-365",
            "90-180",
            "0-90"
        );
        $query_str="SELECT ";
        for ($i=0; $i <count($grid_columns); $i++) { 
            $str= explode("-",$grid_columns[$i]);
            $from = $str[0];
            $to = $str[1];
            $filed_name1 = 'count_'.$grid_columns[$i];
            if($i==count($grid_columns)-1)
            {
                
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1'";
                
            }
            else
            {
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1',";
            }
        }
        $query_str.=",SUM(IF(s.next_dt_sts=1,1,0)) AS next_date_available";
        
        $query_str.=",count(s.id) as ongoing_cases,r.name as case_status
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_case_sts r ON(r.id=s.case_sts_next_dt)
            WHERE s.sts<>0 AND s.next_dt_sts=1 AND s.final_remarks=1 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_sts_next_dt";
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_case_update_summery_result_deal_officer_wise()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $i=date('Y');
        $grid_columns = array(
            "365-730",
            "180-365",
            "90-180",
            "0-90"
        );
        $query_str="SELECT ";
        for ($i=0; $i <count($grid_columns); $i++) { 
            $str= explode("-",$grid_columns[$i]);
            $from = $str[0];
            $to = $str[1];
            $filed_name1 = 'count_'.$grid_columns[$i];
            if($i==count($grid_columns)-1)
            {
                
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1'";
                
            }
            else
            {
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1',";
            }
        }
        $query_str.=",SUM(IF(s.next_dt_sts=1,1,0)) AS next_date_available";
        
        $query_str.=",count(s.id) as ongoing_cases,r.name as deal_officer,r.user_id
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info r ON(r.id=s.case_deal_officer)
            WHERE s.sts<>0 AND s.final_remarks=1 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_deal_officer";
        $query=$this->db->query($query_str);
        return $query->result();
    }

    function get_auction_result()
    {
        $sql = "SELECT
                SUM(IF(b.auction_sts=43,1,0)) as completed,
                SUM(IF(b.auction_sts=43,0,1)) as pending
                FROM auction b 
                WHERE b.module_name='cnc'";
                $query=$this->db->query($sql)->row();
        return $query;
    }
    function get_bill_result()
    {
        $sql = "SELECT
                SUM(IF(b.memo_sts=51,b.recommend_amount,0)) as completed,
                SUM(IF(b.memo_sts=51,0,b.recommend_amount)) as pending
                FROM case_management_expenses_cnc b 
                WHERE (b.module_name='cnc' OR b.module_name='cnc_case_sts' OR b.module_name='appeal_bail') AND b.sts<>0 AND b.v_sts=5";
                $query=$this->db->query($sql)->row();
        return $query;
    }

    function get_activity_prv_step_report(){
        $where ='';
        if(isset($_POST['cdo']) && $_POST['cdo']!=''){
            $where .=' AND s.case_deal_officer='.$_POST['cdo'];
        }
        if(isset($_POST['nature']) && $_POST['nature']!=''){
            $where .=' AND s.req_type='.$_POST['nature'];
        }
        if(isset($_POST['segment']) && $_POST['segment']!=''){
            $where .=' AND s.loan_segment='.$_POST['segment'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }

        $case_sts = $this->db->query("SELECT r.id,r.name FROM ref_case_sts r WHERE r.data_status<>0  order by r.name ASC")->result();
        $query_str='SELECT a.case_status,';
        foreach($case_sts as $key=>$val){
            $query_str.=" SUM(IF(a.case_sts_next_dt='".$val->id."',a.num,0)) as step_".$key.",";
        }
        $query_str .="SUM(a.num) AS total,a.case_sts_prev_dt
            FROM(SELECT r.name AS case_status,n.name AS next_status,s.case_sts_prev_dt,COUNT(s.case_sts_prev_dt) AS num,s.case_sts_next_dt,COUNT(s.case_sts_next_dt) AS nnum
            FROM suit_filling_info s
            LEFT OUTER JOIN ref_case_sts r ON(r.id=s.case_sts_prev_dt)
            LEFT OUTER JOIN ref_case_sts n ON(n.id=s.case_sts_next_dt)
            WHERE s.sts <> 0 
              AND s.final_remarks = 1 
              AND s.suit_sts = 47 ".$where."
            GROUP BY s.case_sts_prev_dt,s.case_sts_next_dt
            ORDER BY r.name) a
        GROUP BY a.case_sts_prev_dt";
       $res = $this->db->query($query_str)->result();
       return $res;
    }
    function get_activity_next_step_report(){
        $where ='';
        if(isset($_POST['cdo']) && $_POST['cdo']!=''){
            $where .=' AND s.case_deal_officer='.$_POST['cdo'];
        }
        if(isset($_POST['nature']) && $_POST['nature']!=''){
            $where .=' AND s.req_type='.$_POST['nature'];
        }
        if(isset($_POST['segment']) && $_POST['segment']!=''){
            $where .=' AND s.loan_segment='.$_POST['segment'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }

       $res = $this->db->query("SELECT r.name AS case_status,COUNT(s.id) AS num,s.case_sts_next_dt
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_case_sts r ON(r.id=s.case_sts_next_dt)
                WHERE s.sts <> 0 
                  AND s.final_remarks = 1 
                  AND s.suit_sts = 47 ".$where."
                GROUP BY s.case_sts_next_dt
                ORDER BY r.name")->result();
       return $res;
    }


    /* ================= Closed Account ====================*/
    function get_year_wise_case_filing(){
        $where='';
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['case_sts']) && $_POST['case_sts']!=''){
            $where .=' AND s.case_sts_prev_dt='.$_POST['case_sts'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['next_step']) && $_POST['next_step']!=''){
            $where .=' AND s.case_sts_next_dt='.$_POST['next_step'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['disposal_year']) && $_POST['disposal_year']!=''){
            $current_year=$_POST['disposal_year'];
        }else{
            $current_year = date('Y');
        }
        $from_year = $current_year-5;
        $filing_select='';
        $filing_select_amount='';
        for ($j=$current_year; $j >=$from_year ; $j--) { //for Year loop
           
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $filing_select.=" SUM(IF(YEAR(s.filling_date)=$j,1,0)) AS '$filed_name1',";
            $filing_select_amount.=" SUM(IF(YEAR(s.filling_date)=$j,s.case_claim_amount,0)) AS '$filed_name2',";
        } 
        $str="
            SELECT $filing_select $filing_select_amount sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as nature_name 
            FROM suit_filling_info as s
            LEFT JOIN ref_req_type r ON r.id=s.req_type
            WHERE (s.sts<>0 AND s.final_remarks=1 AND s.suit_sts=47) OR (s.sts=0 AND s.final_remarks=2 AND s.suit_sts=50) $where GROUP BY s.req_type ORDER BY s.req_type ASC";
           
            $query=$this->db->query($str);
            return $query->result();
    }

    function get_filing_year_wise_case_dispose(){
        $where='';
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['case_sts']) && $_POST['case_sts']!=''){
            $where .=' AND s.case_sts_prev_dt='.$_POST['case_sts'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['next_step']) && $_POST['next_step']!=''){
            $where .=' AND s.case_sts_next_dt='.$_POST['next_step'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['disposal_year']) && $_POST['disposal_year']!=''){
            $current_year=$_POST['disposal_year'];
        }else{
            $current_year = date('Y');
        }
        $from_year = $current_year-5;
        $filing_select='';
        $filing_select_amount='';
        for ($j=$current_year; $j >=$from_year ; $j--) { //for Year loop
           
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $filing_select.=" SUM(IF(YEAR(s.filling_date)=$j AND YEAR(s.ac_close_dt)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $filing_select $filing_select_amount sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as nature_name 
            FROM suit_filling_info as s
            LEFT JOIN ref_req_type r ON r.id=s.req_type
            WHERE s.sts<>0 AND s.final_remarks=2 AND s.suit_sts=50 AND YEAR(s.ac_close_dt) >=$from_year AND YEAR(s.filling_date) >= $from_year $where GROUP BY s.req_type ORDER BY s.req_type ASC";
           
            $query=$this->db->query($str);
            return $query->result();
    }

    function get_filing_year_dispose_stage(){
        $where='';
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['case_sts']) && $_POST['case_sts']!=''){
            $where .=' AND s.case_sts_prev_dt='.$_POST['case_sts'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['next_step']) && $_POST['next_step']!=''){
            $where .=' AND s.case_sts_next_dt='.$_POST['next_step'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['disposal_year']) && $_POST['disposal_year']!=''){
            $current_year=$_POST['disposal_year'];
        }else{
            $current_year = date('Y');
        }
        $from_year = $current_year-5;
        $filing_select='';
        $filing_select_amount='';
        for ($j=$current_year; $j >=$from_year ; $j--) { //for Year loop
           
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'amount_'.$j;
            $filing_select.=" SUM(IF(YEAR(s.filling_date)=$j AND YEAR(s.ac_close_dt)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $filing_select $filing_select_amount sum(s.case_claim_amount) as grand_amount,count(s.id) as grand_total,r.name as nature_name,c.name as stage_name,s.req_type
            FROM suit_filling_info as s
            LEFT JOIN ref_req_type r ON r.id=s.req_type
            LEFT JOIN ref_case_sts c ON(c.id=s.case_sts_prev_dt)
            WHERE s.sts<>0 AND s.final_remarks=2 AND s.suit_sts=50 AND YEAR(s.ac_close_dt) >=$from_year AND YEAR(s.filling_date) >= $from_year $where GROUP BY s.req_type,s.case_sts_prev_dt ORDER BY s.req_type ASC";
           
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_close_accounts(){

        $sql = "SELECT SUM(IF(final_remarks=2 AND suit_sts=50,1,0 )) AS disposal,
                SUM(IF(final_remarks=1 AND suit_sts=47,1,0 )) AS ongoing,
                COUNT(id) AS total,
                (SUM(IF(final_remarks=2 AND suit_sts=50,case_claim_amount,0 ))/10000000) AS disposalamt,
                (SUM(IF(final_remarks=1 AND suit_sts=47,case_claim_amount,0 ))/10000000) AS ongoingamt,
                (SUM(case_claim_amount)/10000000) AS total_amt
                FROM suit_filling_info
                WHERE sts<>0";
        $query=$this->db->query($sql);
        return $query->row();
    }

    function get_dispos_close_acc_summ(){
        $current_year = date('Y');
        $from_year = $current_year-3;
        //For ongoing case
        $disposal_select="";
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 'count_'.$j;
            $disposal_select.=" SUM(IF(MONTH(s.ac_close_dt)=$j,1,0)) AS '$filed_name1',";
        } 
        $str = "SELECT 
                YEAR(s.ac_close_dt) AS years,
                $disposal_select
                
                COUNT(s.id) AS total
                FROM suit_filling_info s
                WHERE s.sts<>0 AND s.final_remarks=2 AND s.suit_sts=50 AND YEAR(s.ac_close_dt) >YEAR(CURRENT_DATE())-6
                GROUP BY YEAR(s.ac_close_dt)";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_ongoing_close_acc_summary(){
        $where = "";
        $i=date('Y');
        $grid_columns = array(
            "365-730",
            "180-365",
            "90-180",
            "0-90"
        );
        $query_str="SELECT ";
        for ($i=0; $i <count($grid_columns); $i++) { 
            $str= explode("-",$grid_columns[$i]);
            $from = $str[0];
            $to = $str[1];
            $filed_name1 = 'count_'.$grid_columns[$i];
            if($i==count($grid_columns)-1)
            {
                
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1'";
                
            }
            else
            {
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.filling_date) BETWEEN $from AND $to,1,0)) AS '$filed_name1',";
            }
        }
        $query_str.=",SUM(IF(s.final_remarks=1 and s.next_dt_sts=1,1,0)) AS next_date_available";
        
        $query_str.=",sum(if(s.final_remarks=1,1,0 )) as ongoing_cases,r.name as user_name,r.user_id,
            sum(if(s.final_remarks=1 and s.ac_close_sts=1,1,0)) as ac_close,
            sum(if(s.ac_close_sts=1 and s.final_remarks=2 and YEAR(s.ac_close_dt)=YEAR(CURRENT_DATE()),1,0 )) as dispos_ac_close
            FROM suit_filling_info as s
            LEFT OUTER JOIN users_info r ON(r.id=s.present_plaintiff)
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.present_plaintiff";
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_ongoing_step_close_acc(){
        $where = "";
        $i=date('Y');
        $grid_columns = array(
            "365-730",
            "180-365",
            "90-180",
            "0-90"
        );
        $query_str="SELECT ";
        for ($i=0; $i <count($grid_columns); $i++) { 
            $str= explode("-",$grid_columns[$i]);
            $from = $str[0];
            $to = $str[1];
            $filed_name1 = 'count_'.$grid_columns[$i];
            if($i==count($grid_columns)-1)
            {
                
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.ac_close_dt) BETWEEN $from AND $to,1,0)) AS '$filed_name1'";
                
            }
            else
            {
                $query_str.=" SUM(IF(DATEDIFF('".date('Y-m-d')."',s.ac_close_dt) BETWEEN $from AND $to,1,0)) AS '$filed_name1',";
            }
        }
        $query_str.=",SUM(IF(s.next_dt_sts=1,1,0)) AS next_date_available";
        
        $query_str.=",r.name as case_sts,
            count(s.id) as total
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_case_sts r ON(r.id=s.case_sts_prev_dt)
            WHERE s.sts<>0 AND s.final_remarks=1 AND s.ac_close_sts=1 AND (s.suit_sts=47 OR s.suit_sts=50) ".$where." GROUP BY s.case_sts_prev_dt";
        $query=$this->db->query($query_str);
        return $query->result();
    }

    function get_ongoing_ac_close_nature_week_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('date_from')!=''){
            $fromdt = implode('-',array_reverse(explode('/',$this->input->post('date_from'))));
        }else{
            $fromdt=date('Y')."-01-01";
        }
        if($this->input->post('date_to')!=''){
            $todt = implode('-',array_reverse(explode('/',$this->input->post('date_to'))));
        }else{
            $todt=date('Y-m-d');
        }

        $query_str="SELECT ";
        $stop_date = date('y-m-d');
        for($i=1;$i<8;$i++){
            $stop_date = date('Y-m-d', strtotime($stop_date . ' +1 day'));
            $query_str.="SUM(IF(DATE(s.next_date)='".$stop_date."',1,0)) AS 'day".$i."',";
        }
        $start_date = date('Y-m-d', strtotime(date('y-m-d') . ' +1 day'));
        $end_date = date('Y-m-d', strtotime(date('y-m-d') . ' +7 day'));
        $query_str.="SUM(IF(DATE(s.next_date)>='".$start_date."' AND DATE(s.next_date)<='".$end_date."',1,0)) AS total,";
        
        $query_str.="count(s.id) as ongoing_cases,r.name as case_type
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_req_type r ON(r.id=s.req_type)
            WHERE s.sts<>0 AND s.final_remarks=1 AND s.suit_sts=47 ".$where." GROUP BY s.req_type";
        $query=$this->db->query($query_str);
        return $query->result();
    }
    function get_law_wise_summary()
    {
        $where ='';
        $start_year = date('Y');
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('branch')!=''){
            $where.=" AND s.branch_sol= '".$this->input->post('branch')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('next_step')!=''){
            $where.=" AND s.case_sts_next_dt= '".$this->input->post('next_step')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('disposal_year')!=''){
            //$where.=" AND YEAR(s.ac_close_dt)='".$this->input->post('disposal_year')."'";
            $start_year = $this->input->post('disposal_year');
        }
        if($this->input->post('disposal_month')!=''){
            //$where.=" AND MONTH(s.ac_close_dt)='".$this->input->post('disposal_month')."'";
        }

        $query_str="";
        $stop_year = $start_year-5;
        for($i=$start_year;$i>=$stop_year;$i--){
            $query_str.="SUM(IF((YEAR(s.ac_close_dt) = '".$i."' AND s.final_remarks = 2),1,0)) AS ddd_".$i.",";
        }
        
        $query="SELECT SUM(IF(s.final_remarks = 1, 1, 0)) AS ongoing_cases,
                SUM(IF(s.final_remarks = 2, 1, 0)) AS disposal,
                SUM(IF((YEAR(s.ac_close_dt) = '".$start_year."' AND s.final_remarks = 2),1,0)) AS disposal_current_year,$query_str
                r.name AS law_name,'' AS chamber_name
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_lawyer r ON (r.id = s.prest_lawyer_name) 
                WHERE s.sts <> 0 $where AND (s.suit_sts = 75 OR s.suit_sts = 76) 
                GROUP BY s.prest_lawyer_name";
        $query=$this->db->query($query);
        return $query->result();
    }
    function get_law_firm_vintage_summary()
    {
        $where ='';
        $start_year = date('Y');
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('branch')!=''){
            $where.=" AND s.branch_sol= '".$this->input->post('branch')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('next_step')!=''){
            $where.=" AND s.case_sts_next_dt= '".$this->input->post('next_step')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('filing_year')!=''){
            $where.=" AND YEAR(s.filling_date)='".$this->input->post('filing_year')."'";
            $start_year = $this->input->post('filing_year');
        }
        if($this->input->post('entry_month')!=''){
            $where.=" AND MONTH(s.filling_date)='".$this->input->post('entry_month')."'";
        }
        

        $query_str="";
        
        $stop_year = $start_year-5;
        for($i=$start_year;$i>=$stop_year;$i--){
            $query_str.="SUM(IF((YEAR(s.filling_date) = '".$i."' AND s.final_remarks = 2),1,0)) AS ddd_".$i.",";
        }
        
        $query="SELECT SUM(IF(s.final_remarks = 1, 1, 0)) AS ongoing_cases,
                SUM(IF(s.final_remarks = 2, 1, 0)) AS disposal,$query_str
                r.name AS law_name,'' AS chamber_name
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_lawyer r ON (r.id = s.prest_lawyer_name) 
                WHERE s.sts <> 0 $where AND (s.suit_sts = 75 OR s.suit_sts = 76) AND
                YEAR(s.filling_date)>=$stop_year
                GROUP BY s.prest_lawyer_name";
        $query=$this->db->query($query);
        return $query->result();
    }
    function get_branch_summary()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('branch')!=''){
            $where.=" AND s.branch_sol= '".$this->input->post('branch')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('filing_year')!=''){
            $where.=" AND YEAR(s.filling_date)='".$this->input->post('filing_year')."'";
        }
        if($this->input->post('entry_month')!=''){
            $where.=" AND MONTH(s.filling_date)='".$this->input->post('entry_month')."'";
        }

        if($this->input->post('disposal_year')!=''){
            $where.=" AND YEAR(s.ac_close_dt)='".$this->input->post('disposal_year')."'";
        }
        if($this->input->post('disposal_month')!=''){
            $where.=" AND MONTH(s.ac_close_dt)='".$this->input->post('disposal_month')."'";
        }
        
        
        $query="SELECT SUM(IF(s.final_remarks = 1, 1, 0)) AS ongoing_cases,
                SUM(IF(s.final_remarks = 1, s.case_claim_amount, 0)) AS ongoing_case_claim_amount,
                SUM(IF(s.final_remarks = 1, 0, 0)) AS ongoing_recovery,
                SUM(IF(s.final_remarks = 2, 1, 0)) AS disposal,
                SUM(IF(s.final_remarks = 2, 0, 0)) AS disposal_recovery,
                SUM(IF(s.final_remarks = 2, s.case_claim_amount, 0)) AS disposal_case_claim_amount,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, 1, 0)) AS total_cases,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, 0, 0)) AS total_recovery,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, s.case_claim_amount, 0)) AS total_suit_value,
                r.name AS branch_name
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_branch_sol r ON (r.code = s.branch_sol AND r.data_status=1) 
                WHERE s.sts <> 0 $where AND (s.suit_sts = 75 OR s.suit_sts = 76)
                GROUP BY s.branch_sol";
        $query=$this->db->query($query);
        return $query->result();
    }
    function get_district_summary()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('district')!=''){
            $where.=" AND s.district= '".$this->input->post('district')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('filing_year')!=''){
            $where.=" AND YEAR(s.filling_date)='".$this->input->post('filing_year')."'";
        }
        if($this->input->post('entry_month')!=''){
            $where.=" AND MONTH(s.filling_date)='".$this->input->post('entry_month')."'";
        }

        if($this->input->post('disposal_year')!=''){
            $where.=" AND YEAR(s.ac_close_dt)='".$this->input->post('disposal_year')."'";
        }
        if($this->input->post('disposal_month')!=''){
            $where.=" AND MONTH(s.ac_close_dt)='".$this->input->post('disposal_month')."'";
        }
        
        
        $query="SELECT SUM(IF(s.final_remarks = 1, 1, 0)) AS ongoing_cases,
                SUM(IF(s.final_remarks = 1, s.case_claim_amount, 0)) AS ongoing_case_claim_amount,
                SUM(IF(s.final_remarks = 1, 0, 0)) AS ongoing_recovery,
                SUM(IF(s.final_remarks = 2, 1, 0)) AS disposal,
                SUM(IF(s.final_remarks = 2, s.case_claim_amount, 0)) AS disposal_case_claim_amount,
                SUM(IF(s.final_remarks = 2, 0, 0)) AS disposal_recovery,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, 1, 0)) AS total_cases,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, 0, 0)) AS total_recovery,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, s.case_claim_amount, 0)) AS total_suit_value,
                r.name AS district_name
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_district r ON (r.id = s.district AND r.data_status=1) 
                WHERE s.sts <> 0 $where AND (s.suit_sts = 75 OR s.suit_sts = 76)
                GROUP BY s.district";
        $query=$this->db->query($query);
        return $query->result();
    }
    function get_court_location_summary()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('district')!=''){
            $where.=" AND s.prest_court_name= '".$this->input->post('district')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('filing_year')!=''){
            $where.=" AND YEAR(s.filling_date)='".$this->input->post('filing_year')."'";
        }
        if($this->input->post('entry_month')!=''){
            $where.=" AND MONTH(s.filling_date)='".$this->input->post('entry_month')."'";
        }

        if($this->input->post('disposal_year')!=''){
            $where.=" AND YEAR(s.ac_close_dt)='".$this->input->post('disposal_year')."'";
        }
        if($this->input->post('disposal_month')!=''){
            $where.=" AND MONTH(s.ac_close_dt)='".$this->input->post('disposal_month')."'";
        }
        
        
        $query="SELECT SUM(IF(s.final_remarks = 1, 1, 0)) AS ongoing_cases,
                SUM(IF(s.final_remarks = 1, s.case_claim_amount, 0)) AS ongoing_case_claim_amount,
                SUM(IF(s.final_remarks = 2, 1, 0)) AS disposal,
                SUM(IF(s.final_remarks = 2, s.case_claim_amount, 0)) AS disposal_case_claim_amount,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, 1, 0)) AS total_cases,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, s.case_claim_amount, 0)) AS total_suit_value,
                r.name AS court_name,
                d.name as district_name
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_district d ON (d.id = s.district) 
                LEFT OUTER JOIN ref_court r ON (r.id = s.prest_court_name AND r.data_status=1) 
                WHERE s.sts <> 0 $where AND (s.suit_sts = 75 OR s.suit_sts = 76)
                GROUP BY s.prest_court_name";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_iss_result()
    {
        $where ='';
        $accounting_year = date('Y');
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('branch')!=''){
            $where.=" AND s.branch_sol= '".$this->input->post('branch')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('filing_year')!=''){
            $where.=" AND YEAR(s.filling_date)='".$this->input->post('filing_year')."'";
        }
        if($this->input->post('entry_month')!=''){
            $where.=" AND MONTH(s.filling_date)='".$this->input->post('entry_month')."'";
        }

        if($this->input->post('disposal_year')!=''){
            $where.=" AND YEAR(s.ac_close_dt)='".$this->input->post('disposal_year')."'";
        }
        if($this->input->post('disposal_month')!=''){
            $where.=" AND MONTH(s.ac_close_dt)='".$this->input->post('disposal_month')."'";
        }
        $query="SELECT SUM(IF(s.final_remarks = 1, 1, 0)) AS ongoing_cases,
                SUM(IF(s.final_remarks = 1, 0, 0)) AS ongoing_recovery,
                SUM(IF(s.final_remarks = 2 AND YEAR(s.ac_close_dt)='".$accounting_year."', 0, 0)) AS disposal_recovery,
                SUM(IF(s.final_remarks = 2 AND s.case_sts_prev_dt=37 AND YEAR(s.ac_close_dt)='".$accounting_year."', 1, 0)) AS withdraw_cases,
                SUM(IF(s.final_remarks = 1, s.case_claim_amount, 0)) AS ongoing_case_claim_amount,
                r.name AS branch_name,r.code as branch_sol
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_branch_sol r ON (r.code = s.branch_sol AND r.data_status=1) 
                WHERE s.sts <> 0 $where AND (s.suit_sts = 75 OR s.suit_sts = 76)
                GROUP BY s.branch_sol";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_br_bb_result()
    {
        $where ='';
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('branch')!=''){
            $where.=" AND s.branch_sol= '".$this->input->post('branch')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('filing_year')!=''){
            $where.=" AND YEAR(s.filling_date)='".$this->input->post('filing_year')."'";
        }
        if($this->input->post('entry_month')!=''){
            $where.=" AND MONTH(s.filling_date)='".$this->input->post('entry_month')."'";
        }

        if($this->input->post('disposal_year')!=''){
            $where.=" AND YEAR(s.ac_close_dt)='".$this->input->post('disposal_year')."'";
        }
        if($this->input->post('disposal_month')!=''){
            $where.=" AND MONTH(s.ac_close_dt)='".$this->input->post('disposal_month')."'";
        }
        $query="SELECT SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, 1, 0)) AS total_filed,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, 0, 0)) AS total_recovery,
                SUM(IF(s.final_remarks = 1 OR s.final_remarks=2, s.case_claim_amount, 0)) AS total_filed_amount,
                SUM(IF(s.final_remarks = 1, 1, 0)) AS total_ongoing,
                SUM(IF(s.final_remarks = 1, 0, 0)) AS total_ongoing_recovery,
                SUM(IF(s.final_remarks = 1, s.case_claim_amount, 0)) AS total_ongoing_amount,
                SUM(IF(s.final_remarks = 2, 1, 0)) AS total_disposal,
                SUM(IF(s.final_remarks = 2, 0, 0)) AS total_disposal_recovery,
                SUM(IF(s.final_remarks = 2, s.case_claim_amount, 0)) AS total_disposal_amount,
                r.name AS nature_of_suit
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_req_type r ON (r.id = s.req_type) 
                WHERE s.sts <> 0 $where AND (s.suit_sts = 75 OR s.suit_sts = 76)
                GROUP BY s.req_type";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_tpsq_result()
    {
        $where ='';
        $upto_year = date('Y');
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('branch')!=''){
            $where.=" AND s.branch_sol= '".$this->input->post('branch')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('filing_year')!=''){
            $where.=" AND YEAR(s.filling_date)='".$this->input->post('filing_year')."'";
            $upto_year = $this->input->post('filing_year')+5;
        }
        if($this->input->post('entry_month')!=''){
            $where.=" AND MONTH(s.filling_date)='".$this->input->post('entry_month')."'";
        }

        if($this->input->post('disposal_year')!=''){
            $where.=" AND YEAR(s.ac_close_dt)='".$this->input->post('disposal_year')."'";
        }
        if($this->input->post('disposal_month')!=''){
            $where.=" AND MONTH(s.ac_close_dt)='".$this->input->post('disposal_month')."'";
        }


        $query="SELECT 
                SUM(IF($upto_year-YEAR(s.filling_date)>=5 AND s.final_remarks=1, 1, 0)) AS down_five_year,
                SUM(IF($upto_year-YEAR(s.filling_date)>=5 AND s.final_remarks=1, 0, 0)) AS down_five_year_recovery,
                SUM(IF($upto_year-YEAR(s.filling_date)>=5 AND s.final_remarks=1, s.case_claim_amount, 0)) AS down_five_year_amount,
                SUM(IF($upto_year-YEAR(s.filling_date)<5 AND s.final_remarks=1, 1, 0)) AS upto_five_year,
                SUM(IF($upto_year-YEAR(s.filling_date)<5 AND s.final_remarks=1, 0, 0)) AS upto_five_year_recovery,
                SUM(IF($upto_year-YEAR(s.filling_date)<5 AND s.final_remarks=1, 1, 0)) AS upto_five_year_amount,
                SUM(IF(s.final_remarks = 1, 1, 0)) AS total_ongoing,
                SUM(IF(s.final_remarks = 1, s.case_claim_amount, 0)) AS total_ongoing_amount,
                SUM(IF(s.final_remarks = 1, 0, 0)) AS total_ongoing_recovery,
                r.name AS nature_of_suit
                FROM suit_filling_info s
                LEFT OUTER JOIN ref_req_type r ON (r.id = s.req_type) 
                WHERE s.sts <> 0 $where AND s.suit_sts = 47
                GROUP BY s.req_type";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_finiancial_indicator_result()
    {
        $where ='';
        $current_month = date('m');
        $current_year = date('Y');
        if($this->input->post('department')!=''){
            $where.=" AND s.department= '".$this->input->post('department')."'";
        }
        if($this->input->post('unit')!=''){
            $where.=" AND s.unit= '".$this->input->post('unit')."'";
        }
        if($this->input->post('branch')!=''){
            $where.=" AND s.branch_sol= '".$this->input->post('branch')."'";
        }
        if($this->input->post('filed_type')!=''){
            $where.=" AND s.case_category= '".$this->input->post('filed_type')."'";
        }
        if($this->input->post('case_sts')!=''){
            $where.=" AND s.case_sts_prev_dt= '".$this->input->post('case_sts')."'";
        }
        if($this->input->post('nature_suit')!=''){
            $where.=" AND s.req_type= '".$this->input->post('nature_suit')."'";
        }
        if($this->input->post('filing_year')!=''){
            $current_year = date('Y');
        }
        if($this->input->post('entry_month')!=''){
            $current_month = date('m');
        }

        // if($this->input->post('disposal_year')!=''){
        //     $where.=" AND YEAR(s.ac_close_dt)='".$this->input->post('disposal_year')."'";
        // }
        // if($this->input->post('disposal_month')!=''){
        //     $where.=" AND MONTH(s.ac_close_dt)='".$this->input->post('disposal_month')."'";
        // }
        $total_suit_value1 = "";
        $total_suit_value2 = "";

        $ongoing_suit_1 = "";
        $ongoing_suit_2 = "";

        $disposal_till_1 = "";
        $disposal_till_2 = "";

        $disposal_suit_1 = "";
        $disposal_suit_2 = "";
        
        $total_disposal_value1 = "";
        $total_disposal_value2 = "";

        $total_withdrawn_value1 = "";
        $total_withdrawn_value2 = "";
        if($current_month<=6)
        {
            $first_year = ($current_year-1).'-12-31';
            $second_year = $current_year.'-06-30';
        }
        else
        {
            $first_year = $current_year.'-06-30';
            $second_year = $current_year.'-12-31';
        }
        $total_suit_value1 = "SUM(IF((YEAR(s.filling_date)<= '".$first_year."'),s.case_claim_amount,0)) AS total_suit_value1";
        $total_suit_value2 = "SUM(IF((YEAR(s.filling_date)<= '".$second_year."'),s.case_claim_amount,0)) AS total_suit_value2";

        $ongoing_suit_1 = "SUM(IF((DATE(s.filling_date)<= '".$first_year."'),1,0)) AS ongoing_suit_1";
        $ongoing_suit_2 = "SUM(IF((YEAR(s.filling_date)<= '".$second_year."'),1,0)) AS ongoing_suit_2";

        $disposal_till_1 = "SUM(IF((DATE(s.ac_close_dt)<= '".$first_year."' AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0)) AS disposal_till_1";
        $disposal_till_2 = "SUM(IF((YEAR(s.ac_close_dt)<= '".$second_year."' AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0)) AS disposal_till_2";

        $disposal_till_value_1 = "SUM(IF((DATE(s.ac_close_dt)<= '".$first_year."' AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0)) AS disposal_till_value_1";
        $disposal_till_value_2 = "SUM(IF((YEAR(s.ac_close_dt)<= '".$second_year."' AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0)) AS disposal_till_value_2";

        $disposal_suit_1 = "SUM(IF((YEAR(s.ac_close_dt)<= '".$first_year."' AND s.final_remarks=2 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0)) AS disposal_suit_1";
        $disposal_suit_2 = "SUM(IF((YEAR(s.ac_close_dt)<= '".$second_year."' AND s.final_remarks=2 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0)) AS disposal_suit_2";
        
        $total_disposal_value1 = "SUM(IF((YEAR(s.ac_close_dt)<= '".$first_year."' AND s.final_remarks=2 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0)) AS total_disposal_value1";
        $total_disposal_value2 = "SUM(IF((YEAR(s.ac_close_dt)<= '".$second_year."' AND s.final_remarks=2 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0)) AS total_disposal_value2";

        $total_withdrawn_value1 = "SUM(IF((YEAR(s.ac_close_dt)<= '".$first_year."' AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.case_sts_prev_dt=37),s.case_claim_amount,0)) AS total_withdrawn_value1";
        $total_withdrawn_value2 = "SUM(IF((YEAR(s.ac_close_dt)<= '".$second_year."' AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.case_sts_prev_dt=37),s.case_claim_amount,0)) AS total_withdrawn_value2";
        
        $query="SELECT $total_suit_value1,$total_suit_value2,
                $ongoing_suit_1,$ongoing_suit_2,$disposal_till_1,$disposal_till_2,
                $disposal_suit_1,$disposal_suit_2,$total_disposal_value1,$total_disposal_value2,
                $total_withdrawn_value1,$total_withdrawn_value2,
                $disposal_till_value_1,$disposal_till_value_2
                FROM suit_filling_info s
                WHERE s.sts <> 0 $where";
        $query=$this->db->query($query);
        return $query->row();
    }

    function get_case_filing_instruction_all(){
        $where='';
        $where2='';
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where .=' AND s.branch_sol='.$_POST['branch'];
            $where2 .=' AND c.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where .=' AND s.case_category='.$_POST['filed_type'];
            $where2 .=' AND c.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['case_sts']) && $_POST['case_sts']!=''){
            $where .=' AND s.case_sts_prev_dt='.$_POST['case_sts'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where .=' AND s.req_type='.$_POST['nature_suit'];
            $where2 .=' AND c.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['next_step']) && $_POST['next_step']!=''){
            $where .=' AND s.case_sts_next_dt='.$_POST['next_step'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
            $where2 .=' AND c.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
            $where2 .=' AND c.unit='.$_POST['unit'];
        }
        if(isset($_POST['filing_year']) && $_POST['filing_year']!=''){
            $current_year=$_POST['filing_year'];
        }else{
            $current_year = date('Y');
        }
        $from_year = $current_year-5;
        $filing_select='';
        $filing_select2='';
        for ($j=$current_year; $j >=$from_year ; $j--) { //for Year loop
           
            $filed_name1 = 'count_suit_'.$j;
            $filed_name2 = 'count_request_'.$j;
            $filing_select.=" SUM(IF(YEAR(s.filling_date)=$j,1,0)) AS '$filed_name1',";
            $filing_select2.=" SUM(IF(YEAR(c.filling_date)=$j,1,0)) AS '$filed_name2',";
        } 
        $str="
            SELECT sub.* FROM(
            SELECT $filing_select2 count(c.id) as grand_total_request
            FROM cnc as c
            WHERE c.sts<>0 AND c.cnc_sts<>14 AND c.cnc_sts<>21 $where2
            UNION ALL
            SELECT $filing_select count(s.id) as grand_total_suit
            FROM suit_filling_info as s
            WHERE ((s.sts<>0 AND (s.suit_sts=50 OR s.suit_sts=47)) OR (s.sts=0 AND (s.suit_sts=50 OR s.suit_sts=47) AND s.merged_sts=1)) $where
            )sub";
            $query=$this->db->query($str);
            return $query->result();
    }

    function case_file_instruction_type_wise(){
        $where2='';
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where2 .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where2 .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where2 .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where2 .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where2 .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['filing_year']) && $_POST['filing_year']!=''){
            $current_year=$_POST['filing_year'];
        }else{
            $current_year = date('Y');
        }
        $from_year = $current_year-5;
        $filing_select='';
        for ($j=$current_year; $j >=$from_year ; $j--) { //for Year loop
           
            $filed_name1 = 'count_suit_'.$j;
            $filing_select.=" SUM(IF(YEAR(s.filling_date)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $filing_select count(s.id) as grand_total_suit,rq.name as request_type
            FROM cnc as s
            left outer join ref_req_type rq on(rq.id=s.req_type)
            WHERE s.sts<>0 AND s.cnc_sts<>14 AND s.cnc_sts<>21 $where2  GROUP BY s.req_type";
            $query=$this->db->query($str);
            return $query->result();
    }

    function case_filed_instruction_monthly(){
        if(isset($_POST['filing_year']) && $_POST['filing_year']!=''){
            $current_year=$_POST['filing_year'];
        }else{
            $current_year = date('Y');
        }
        $where2=" AND YEAR(s.filling_date)=$current_year";
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where2 .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where2 .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where2 .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where2 .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where2 .=' AND s.unit='.$_POST['unit'];
        }
        $select="";
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 'count_'.$j;
            $select.=" SUM(IF(MONTH(s.filling_date)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $select count(s.id) as grand_total_suit,rq.name as request_type
            FROM cnc as s
            left outer join ref_req_type rq on(rq.id=s.req_type)
            WHERE s.sts<>0 AND s.cnc_sts<>14 AND s.cnc_sts<>21 $where2 GROUP BY s.req_type";
            $query=$this->db->query($str);
            return $query->result();
    }

    function case_filed_type_wise(){
        $where='';
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['case_sts']) && $_POST['case_sts']!=''){
            $where .=' AND s.case_sts_prev_dt='.$_POST['case_sts'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['next_step']) && $_POST['next_step']!=''){
            $where .=' AND s.case_sts_next_dt='.$_POST['next_step'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['filing_year']) && $_POST['filing_year']!=''){
            $current_year=$_POST['filing_year'];
        }else{
            $current_year = date('Y');
        }
        $from_year = $current_year-5;
        $filing_select='';
        for ($j=$current_year; $j >=$from_year ; $j--) { //for Year loop
           
            $filed_name1 = 'count_suit_'.$j;
            $filing_select.=" SUM(IF(YEAR(s.filling_date)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $filing_select count(s.id) as grand_total_suit,rq.name as request_type
            FROM suit_filling_info as s
            left outer join ref_req_type rq on(rq.id=s.req_type)
            WHERE ((s.sts<>0 AND (s.suit_sts=50 OR s.suit_sts=47)) OR (s.sts=0 AND (s.suit_sts=50 OR s.suit_sts=47) AND s.merged_sts=1)) $where  GROUP BY s.req_type";
            $query=$this->db->query($str);
            return $query->result();
    }

    function case_filed_monthly(){
        if(isset($_POST['filing_year']) && $_POST['filing_year']!=''){
            $current_year=$_POST['filing_year'];
        }else{
            $current_year = date('Y');
        }
        $where=" AND YEAR(s.filling_date)=$current_year";
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['case_sts']) && $_POST['case_sts']!=''){
            $where .=' AND s.case_sts_prev_dt='.$_POST['case_sts'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['next_step']) && $_POST['next_step']!=''){
            $where .=' AND s.case_sts_next_dt='.$_POST['next_step'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }
        $select="";
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 'count_'.$j;
            $select.=" SUM(IF(MONTH(s.filling_date)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $select count(s.id) as grand_total_suit,rq.name as request_type
            FROM suit_filling_info as s
            left outer join ref_req_type rq on(rq.id=s.req_type)
            WHERE ((s.sts<>0 AND (s.suit_sts=50 OR s.suit_sts=47)) OR (s.sts=0 AND (s.suit_sts=50 OR s.suit_sts=47) AND s.merged_sts=1)) $where  GROUP BY s.req_type";
            $query=$this->db->query($str);
            return $query->result();
    }

    function get_law_wise_legal_notice(){
        $where='';
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['ln_year']) && $_POST['ln_year']!=''){
            $current_year=$_POST['ln_year'];
        }else{
            $current_year = date('Y');
        }
        $from_year = $current_year-5;
        $filing_select='';
        $where.=" AND YEAR(s.filling_date) BETWEEN $from_year AND $current_year";
        for ($j=$current_year; $j >=$from_year ; $j--) { //for Year loop
           
            $filed_name1 = 'count_'.$j;
            $filing_select.=" SUM(IF(YEAR(s.filling_date)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $filing_select count(s.id) as grand_total,lw.name as lawyer_name,'' as law_chamber
            FROM fln_summary s
             LEFT OUTER JOIN ref_lawyer lw ON (lw.id=s.a_lawyer)
             LEFT OUTER JOIN fln_card cd ON cd.batch_no=s.batch_no AND cd.sts<>0
             LEFT OUTER JOIN fln_collection cl ON cl.batch_no=s.batch_no AND cl.sts<>0
             LEFT OUTER JOIN fln_recovery rc ON rc.batch_no=s.batch_no AND rc.sts<>0
             LEFT OUTER JOIN fln_retail rt ON rt.batch_no=s.batch_no AND rt.sts<>0
            WHERE s.sts<>0 AND s.v_sts=24 $where
            GROUP BY s.a_lawyer";
            $query=$this->db->query($str);
            return $query->result();
    }

    function get_law_wise_legal_notice_month(){
        $where='';
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['entry_month']) && $_POST['entry_month']!=''){
            $where .=' AND MONTH(s.filling_date)='.$_POST['entry_month'];
        }
        if(isset($_POST['ln_year']) && $_POST['ln_year']!=''){
            $current_year=$_POST['ln_year'];
        }else{
            $current_year = date('Y');
        }
        $where.=" AND YEAR(s.filling_date)=$current_year";
        $select="";
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 'count_'.$j;
            $select.=" SUM(IF(MONTH(s.filling_date)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $select count(s.id) as grand_total,lw.name as lawyer_name,'' as law_chamber
            FROM fln_summary s
             LEFT OUTER JOIN ref_lawyer lw ON (lw.id=s.a_lawyer)
             LEFT OUTER JOIN fln_card cd ON cd.batch_no=s.batch_no AND cd.sts<>0
             LEFT OUTER JOIN fln_collection cl ON cl.batch_no=s.batch_no AND cl.sts<>0
             LEFT OUTER JOIN fln_recovery rc ON rc.batch_no=s.batch_no AND rc.sts<>0
             LEFT OUTER JOIN fln_retail rt ON rt.batch_no=s.batch_no AND rt.sts<>0
            WHERE s.sts<>0 AND s.v_sts=24 $where
            GROUP BY s.a_lawyer";
            $query=$this->db->query($str);
            return $query->result();
    }

    function get_law_wise_legal_notice_type(){
        $where='';
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['entry_month']) && $_POST['entry_month']!=''){
            $where .=' AND MONTH(s.filling_date)='.$_POST['entry_month'];
        }
        if(isset($_POST['ln_year']) && $_POST['ln_year']!=''){
            $current_year=$_POST['ln_year'];
        }else{
            $current_year = date('Y');
        }
        $where.=" AND YEAR(s.filling_date)=$current_year";
        $ln_type = $this->db->query("SELECT * FROM ref_legal_notice_type")->result();
        $select="";
        foreach($ln_type as $key)
        {
            $filed_name1 = 'count_'.$key->id;
            $select.=" SUM(IF(s.legal_type=$key->id,1,0)) AS '$filed_name1',";
        }
        $str="
            SELECT $select count(s.id) as grand_total,lw.name as lawyer_name,'' as law_chamber
            FROM fln_summary s
             LEFT OUTER JOIN ref_lawyer lw ON (lw.id=s.a_lawyer)
             LEFT OUTER JOIN fln_card cd ON cd.batch_no=s.batch_no AND cd.sts<>0
             LEFT OUTER JOIN fln_collection cl ON cl.batch_no=s.batch_no AND cl.sts<>0
             LEFT OUTER JOIN fln_recovery rc ON rc.batch_no=s.batch_no AND rc.sts<>0
             LEFT OUTER JOIN fln_retail rt ON rt.batch_no=s.batch_no AND rt.sts<>0
            WHERE s.sts<>0 AND s.v_sts=24 $where
            GROUP BY s.a_lawyer";
            $query=$this->db->query($str);
            return $query->result();
    }

    function get_case_filing_next_step_summery(){
        $where2='';
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where2 .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where2 .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where2 .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where2 .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where2 .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['filing_year']) && $_POST['filing_year']!=''){
            $current_year=$_POST['filing_year'];
        }else{
            $current_year = date('Y');
        }
        $from_year = $current_year-5;
        $filing_select='';
        for ($j=$current_year; $j >=$from_year ; $j--) { //for Year loop
           
            $filed_name1 = 'count_'.$j;
            $filing_select.=" SUM(IF(YEAR(s.next_date)=$j,1,0)) AS '$filed_name1',";
        } 
        $str="
            SELECT $filing_select count(s.id) as grand_total_suit,cs.name as next_sts
            FROM suit_filling_info as s
            left outer join ref_case_sts cs on(cs.id=s.case_sts_next_dt)
            WHERE s.suit_sts=47 AND s.next_dt_sts=1 $where2  GROUP BY s.case_sts_next_dt";
            $query=$this->db->query($str);
            return $query->result();
    }

    function get_recovery_result_year_wise()
    {
        $current_year = date('Y');
        $from_year = $current_year-5;
        $where="";
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where2 .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where2 .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where2 .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where2 .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where2 .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['ln_year']) && $_POST['ln_year']!=''){
            $current_year=$_POST['ln_year'];
        }else{
            $current_year = date('Y');
        }
        //For ongoing case
        $ongoing_select_amount="";
        $disposal_select_amount="";
        $total_select_amount="";
        $appeal_select_amount="";
        $bail_select_amount="";
        for ($i=$current_year; $i >=$from_year ; $i--) { 
               if($i==$from_year)
               {
                $filed_name2 = 'amount_'.$i;
                $ongoing_select_amount.=" SUM(IF((YEAR(r.trans_date)=$i AND s.final_remarks=1),r.amount,0)) AS '$filed_name2'";
                $disposal_select_amount.=" SUM(IF(YEAR(r.trans_date)=$i AND s.final_remarks=2,r.amount,0)) AS '$filed_name2'";
                $total_select_amount.=" SUM(IF(YEAR(r.trans_date)=$i AND (s.final_remarks=2 or s.final_remarks=1),r.amount,0)) AS '$filed_name2'";
                $appeal_select_amount.=" SUM(IF(YEAR(s.prev_date)=$i AND s.case_sts_prev_dt=79,s.apb_money,0)) AS '$filed_name2'";
                $bail_select_amount.=" SUM(IF(YEAR(s.filling_date)=$i AND s.apb_money IS NOT NULL,s.apb_money,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name2 = 'amount_'.$i;
                $ongoing_select_amount.=" SUM(IF((YEAR(r.trans_date)=$i AND s.final_remarks=1),r.amount,0)) AS '$filed_name2',";
                $disposal_select_amount.=" SUM(IF(YEAR(r.trans_date)=$i AND s.final_remarks=2,r.amount,0)) AS '$filed_name2',";
                $total_select_amount.=" SUM(IF(YEAR(r.trans_date)=$i AND (s.final_remarks=2 or s.final_remarks=1),r.amount,0)) AS '$filed_name2',";
                $appeal_select_amount.=" SUM(IF(YEAR(s.prev_date)=$i AND s.case_sts_prev_dt=79,s.apb_money,0)) AS '$filed_name2',";
                $bail_select_amount.=" SUM(IF(YEAR(s.filling_date)=$i AND s.apb_money IS NOT NULL,s.apb_money,0)) AS '$filed_name2',";
               }
        }
        $str="SELECT $ongoing_select_amount,'Recovery against Ongoing Cases' as type
            FROM recovery_data r
            LEFT OUTER JOIN suit_filling_info s on(s.id=r.suit_id)
            WHERE r.suit_id IS NOT NULL AND r.suit_id<>'' AND r.module='C&C' AND r.sts<>0 $where
            UNION ALL
            SELECT $disposal_select_amount,'Recovery against Disposal Cases' as type
            FROM recovery_data r
            LEFT OUTER JOIN suit_filling_info s on(s.id=r.suit_id)
            WHERE r.suit_id IS NOT NULL AND r.suit_id<>'' AND r.module='C&C' AND r.sts<>0 $where
            UNION ALL 
            SELECT $total_select_amount,'Total Recovery against Case Proceedings' as type
            FROM recovery_data r
            LEFT OUTER JOIN suit_filling_info s on(s.id=r.suit_id)
            WHERE r.suit_id IS NOT NULL AND r.suit_id<>'' AND r.module='C&C' AND r.sts<>0 $where
            UNION ALL 
            SELECT $appeal_select_amount,'Associated Appeal Money Withdrawn' as type
            FROM suit_filling_info s
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) $where
            UNION ALL 
            SELECT $bail_select_amount,'Bail Amount/Restoration of ARA Cases' as type
            FROM suit_filling_info s
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) $where";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_recovery_result_month_wise()
    {
        $current_year = date('Y');
        $where="";
        if(isset($_POST['branch']) && $_POST['branch']!=''){
            $where2 .=' AND s.branch_sol='.$_POST['branch'];
        }
        if(isset($_POST['filed_type']) && $_POST['filed_type']!=''){
            $where2 .=' AND s.case_category='.$_POST['filed_type'];
        }
        if(isset($_POST['nature_suit']) && $_POST['nature_suit']!=''){
            $where2 .=' AND s.req_type='.$_POST['nature_suit'];
        }
        if(isset($_POST['department']) && $_POST['department']!=''){
            $where2 .=' AND s.department='.$_POST['department'];
        }
        if(isset($_POST['unit']) && $_POST['unit']!=''){
            $where2 .=' AND s.unit='.$_POST['unit'];
        }
        if(isset($_POST['ln_year']) && $_POST['ln_year']!=''){
            $current_year=$_POST['ln_year'];
        }else{
            $current_year = date('Y');
        }
        //For ongoing case
        $ongoing_select_amount="";
        $disposal_select_amount="";
        $total_select_amount="";
        $appeal_select_amount="";
        $bail_select_amount="";
        for ($i=1; $i <=12 ; $i++) {
               if($i==12)
               {
                $filed_name2 = 'amount_'.$i;
                $ongoing_select_amount.=" SUM(IF((MONTH(r.trans_date)=$i AND YEAR(r.trans_date)=$current_year AND s.final_remarks=1),r.amount,0)) AS '$filed_name2'";
                $disposal_select_amount.=" SUM(IF(MONTH(r.trans_date)=$i AND YEAR(r.trans_date)=$current_year AND s.final_remarks=2,r.amount,0)) AS '$filed_name2'";
                $total_select_amount.=" SUM(IF(MONTH(r.trans_date)=$i AND YEAR(r.trans_date)=$current_year AND (s.final_remarks=2 or s.final_remarks=1),r.amount,0)) AS '$filed_name2'";
                $appeal_select_amount.=" SUM(IF(MONTH(s.prev_date)=$i AND YEAR(s.prev_date)=$current_year AND s.case_sts_prev_dt=79,s.apb_money,0)) AS '$filed_name2'";
                $bail_select_amount.=" SUM(IF(MONTH(s.filling_date)=$i AND YEAR(s.filling_date)=$current_year AND s.apb_money IS NOT NULL,s.apb_money,0)) AS '$filed_name2'";
               }
               else
               {
                $filed_name2 = 'amount_'.$i;
                $ongoing_select_amount.=" SUM(IF((MONTH(r.trans_date)=$i AND YEAR(r.trans_date)=$current_year AND s.final_remarks=1),r.amount,0)) AS '$filed_name2',";
                $disposal_select_amount.=" SUM(IF(MONTH(r.trans_date)=$i AND YEAR(r.trans_date)=$current_year AND s.final_remarks=2,r.amount,0)) AS '$filed_name2',";
                $total_select_amount.=" SUM(IF(MONTH(r.trans_date)=$i AND YEAR(r.trans_date)=$current_year AND (s.final_remarks=2 or s.final_remarks=1),r.amount,0)) AS '$filed_name2',";
                $appeal_select_amount.=" SUM(IF(MONTH(s.prev_date)=$i AND YEAR(s.prev_date)=$current_year AND s.case_sts_prev_dt=79,s.apb_money,0)) AS '$filed_name2',";
                $bail_select_amount.=" SUM(IF(MONTH(s.filling_date)=$i AND YEAR(s.filling_date)=$current_year AND s.apb_money IS NOT NULL,s.apb_money,0)) AS '$filed_name2',";
               }
        }
        $str="SELECT $ongoing_select_amount,'Recovery against Ongoing Cases' as type
            FROM recovery_data r
            LEFT OUTER JOIN suit_filling_info s on(s.id=r.suit_id)
            WHERE r.suit_id IS NOT NULL AND r.suit_id<>'' AND r.module='C&C' AND r.sts<>0 $where
            UNION ALL
            SELECT $disposal_select_amount,'Recovery against Disposal Cases' as type
            FROM recovery_data r
            LEFT OUTER JOIN suit_filling_info s on(s.id=r.suit_id)
            WHERE r.suit_id IS NOT NULL AND r.suit_id<>'' AND r.module='C&C' AND r.sts<>0 $where
            UNION ALL 
            SELECT $total_select_amount,'Total Recovery against Case Proceedings' as type
            FROM recovery_data r
            LEFT OUTER JOIN suit_filling_info s on(s.id=r.suit_id)
            WHERE r.suit_id IS NOT NULL AND r.suit_id<>'' AND r.module='C&C' AND r.sts<>0 $where
            UNION ALL 
            SELECT $appeal_select_amount,'Associated Appeal Money Withdrawn' as type
            FROM suit_filling_info s
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) $where
            UNION ALL 
            SELECT $bail_select_amount,'Bail Amount/Restoration of ARA Cases' as type
            FROM suit_filling_info s
            WHERE s.sts<>0 AND (s.suit_sts=47 OR s.suit_sts=50) $where";
            $query=$this->db->query($str);
            return $query->result();
    }
}