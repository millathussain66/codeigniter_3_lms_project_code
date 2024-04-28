<?php
class Bb_rt_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function get_statement_result($branch)
	{
		$month =  date('m');
		$present_month = (int)$month;
		//For The Present Quarter Segemnt
		$str = "SELECT q.* FROM ref_quarter q
			WHERE FIND_IN_SET($present_month, q.value) LIMIT 1";
		$query = $this->db->query($str);
		$present_quarter = $query->row();

		$present_quarter_months = $present_quarter->value;
		$present_quarter_segment = $present_quarter->segment;

		//For Previous Quarter Segment
		$previous_quarter_segement = ($present_quarter_segment - 1);

		if ($previous_quarter_segement < 0) {
			$previous_quarter_segement = 4;
		}

		$str = "SELECT q.* FROM ref_quarter q
			WHERE q.segment='" . $previous_quarter_segement . "' LIMIT 1";
		$query = $this->db->query($str);
		$previous_quarter = $query->row();
		$previous_quarter_months = $previous_quarter->value;

		$str = "SELECT sub3.*,sub4.* FROM
				(
					SELECT '1' AS join_indecator,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $previous_quarter_months . ") THEN sub.case_claim_amount ELSE 0 END) AS ni_last_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $previous_quarter_months . ") THEN sub.counter ELSE 0 END) AS ni_last_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") THEN sub.case_claim_amount ELSE 0 END) AS ni_present_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") THEN sub.counter ELSE 0 END) AS ni_present_total,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS ni_settled_amount,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS ni_settled_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS ni_unsettled_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS ni_unsettled_total
					FROM
					(
					SELECT s.*,'1' AS counter FROM suit_filling_info s
					WHERE s.sts<>0 AND s.req_type=1 AND s.branch_sol='" . $branch . "'
					)sub GROUP BY sub.req_type

				)sub3
				LEFT OUTER JOIN (
					SELECT '1' AS join_indecator,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $previous_quarter_months . ") THEN sub.case_claim_amount ELSE 0 END) AS ara_last_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $previous_quarter_months . ") THEN sub.counter ELSE 0 END) AS ara_last_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") THEN sub.case_claim_amount ELSE 0 END) AS ara_present_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") THEN sub.counter ELSE 0 END) AS ara_present_total,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS ara_settled_amount,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS ara_settled_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS ara_unsettled_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS ara_unsettled_total
					FROM
					(
					SELECT s.*,'1' AS counter FROM suit_filling_info s
					WHERE s.sts<>0 AND s.req_type=2 AND s.branch_sol='" . $branch . "'
					)sub GROUP BY sub.req_type
				)sub4 ON(sub3.join_indecator=sub4.join_indecator)";
		$query = $this->db->query($str);
		return $query->row();
	}
	function get_statement_result_court()
	{
		$str_where = " AND s.req_type=2 AND s.suit_sts IN(75,76)";
		if ($this->input->post('branch_sol') != '') {
			$where .= " AND s.branch_sol= '" . $this->input->post('branch_sol') . "'";
		}
		if ($this->input->post('zone') != '') {
			$where .= " AND s.zone= '" . $this->input->post('zone') . "'";
		}
		if ($this->input->post('related_with') != '') {
			$where .= " AND s.related_with= '" . $this->input->post('related_with') . "'";
		}
		$str = "";
		$query = $this->db->query($str);
		return $query->result();
	}
	function get_statement_result_classified($branch)
	{
		$month =  date('m');
		$present_month = (int)$month;
		//For The Present Quarter Segemnt
		$str = "SELECT q.* FROM ref_quarter q
			WHERE FIND_IN_SET($present_month, q.value) LIMIT 1";
		$query = $this->db->query($str);
		$present_quarter = $query->row();

		$present_quarter_months = $present_quarter->value;
		$present_quarter_segment = $present_quarter->segment;

		//For Previous Quarter Segment
		$previous_quarter_segement = ($present_quarter_segment - 1);

		if ($previous_quarter_segement < 0) {
			$previous_quarter_segement = 4;
		}

		$str = "SELECT q.* FROM ref_quarter q
			WHERE q.segment='" . $previous_quarter_segement . "' LIMIT 1";
		$query = $this->db->query($str);
		$previous_quarter = $query->row();
		$previous_quarter_months = $previous_quarter->value;


		$str = "SELECT l.name,sub3.* FROM ref_loan_segment l
				LEFT OUTER JOIN (
					SELECT sub.loan_segment,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(" . $previous_quarter_months . ") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS pre_unsettled_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS prest_settled_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS prest_unsettled_total
					FROM
					(
						SELECT s.*,'1' AS counter FROM suit_filling_info s
						WHERE s.sts<>0  AND s.branch_sol='" . $branch . "'
					)sub GROUP BY sub.loan_segment

				)sub3 ON (l.code=sub3.loan_segment)
				WHERE l.data_status<>0";
		$query = $this->db->query($str);
		return $query->result();
	}
	function get_case_filed_quarterly($quarter_id)
	{
		//For The Quarter Segemnt
		$str = "SELECT q.* FROM ref_quarter q
			WHERE q.id='" . $quarter_id . "' LIMIT 1";
		$query = $this->db->query($str);
		$present_quarter = $query->row();

		$present_quarter_months = $present_quarter->value;

		$str = "SELECT 
				c.name AS court_name,
				GROUP_CONCAT(sub4.loan_segment  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS loan_segment, 
				GROUP_CONCAT(sub4.no_case_filed  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_case_filed,
				GROUP_CONCAT(sub4.no_case_claim_amount  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_case_claim_amount,
				GROUP_CONCAT(sub4.no_of_setteled  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_of_setteled,
				GROUP_CONCAT(sub4.no_of_setteled_amount  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_of_setteled_amount,
				GROUP_CONCAT(sub4.no_of_case_running  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_of_case_running,
				GROUP_CONCAT(sub4.no_of_case_running_amount  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_of_case_running_amount,
				SUM(sub4.no_case_filed) AS total_no_case_filed,
				SUM(sub4.no_case_claim_amount) AS total_no_case_claim_amount,
				SUM(sub4.no_of_setteled) AS total_no_of_setteled,
				SUM(sub4.no_of_setteled_amount) AS total_no_of_setteled_amount,
				SUM(sub4.no_of_case_running) AS total_no_of_case_running,
				SUM(sub4.no_of_case_running_amount) AS total_no_of_case_running_amount
				FROM
				(
					SELECT ls.name AS loan_segment,sub.prest_court_name,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") THEN sub.counter ELSE 0 END) AS no_case_filed,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") THEN sub.case_claim_amount ELSE 0 END) AS no_case_claim_amount,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS no_of_setteled,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS no_of_setteled_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS no_of_case_running,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") AND sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS no_of_case_running_amount
					FROM
					(
						SELECT s.*,'1' AS counter FROM suit_filling_info s
						WHERE s.sts<>0  
					)sub
					LEFT OUTER JOIN ref_loan_segment ls ON(ls.code=sub.loan_segment)
					GROUP BY sub.loan_segment,sub.prest_court_name,ls.name ORDER BY ls.name
				)sub4 
				LEFT OUTER JOIN ref_court c ON(sub4.prest_court_name=c.id)
				GROUP BY sub4.prest_court_name,c.name";
		$query = $this->db->query($str);
		return $query->result();
	}
	function get_internal_report($year)
	{
		$str = "SELECT 
				sub2.month_name,
				GROUP_CONCAT(sub2.req_type  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS req_type,
				GROUP_CONCAT(sub2.no_of_setteled  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_of_setteled,
				GROUP_CONCAT(sub2.no_of_unsetteled  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_of_unsetteled,
				GROUP_CONCAT(sub2.no_case_filed  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_case_filed,
				GROUP_CONCAT(sub2.no_case_claim_amount  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_case_claim_amount,
				GROUP_CONCAT(sub2.recovery_amount  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS recovery_amount,
				GROUP_CONCAT(sub2.total_recovered  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS total_recovered,
				GROUP_CONCAT(sub2.no_case_claim_amount_settled  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_case_claim_amount_settled
				FROM
				(
				SELECT
				sub.req_type,
				sub.mon,
				SUM(CASE WHEN sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS no_of_setteled,
				SUM(CASE WHEN sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS no_of_unsetteled,
				SUM(sub.counter) AS no_case_filed,sub.month_name,
				SUM(sub.case_claim_amount) AS no_case_claim_amount,
				SUM(CASE WHEN sub.deposit_amount IS NOT NULL THEN sub.deposit_amount ELSE 0 END) AS recovery_amount,
				SUM(CASE WHEN sub.deposit_amount IS NOT NULL THEN sub.counter ELSE 0 END) AS total_recovered,
				SUM(CASE WHEN sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS no_case_claim_amount_settled
					FROM
					(
						SELECT s.req_type,s.final_remarks,appeal.deposit_amount,s.ac_close_dt,s.case_claim_amount,'1' AS counter,
						DATE_FORMAT(s.e_dt,'%M') AS month_name,
						DATE_FORMAT(s.e_dt,'%m') AS mon
						FROM suit_filling_info s
						LEFT OUTER JOIN (
							SELECT SUM(a.deposit_amt) AS deposit_amount ,a.suit_id
							FROM appeal_deposit a
							WHERE a.sts<>0 AND a.v_sts=38
							GROUP BY a.suit_id
						)appeal ON(s.id=appeal.suit_id)
						WHERE s.sts<>0 AND YEAR(s.e_dt)='" . $year . "'
						ORDER BY s.e_dt ASC
					)sub
				GROUP BY sub.req_type,sub.month_name,sub.mon

				)sub2 GROUP BY sub2.mon,sub2.month_name ORDER BY sub2.mon ASC";
		$query = $this->db->query($str);
		return $query->result();
	}
	function get_case_filed_quarterly_seg($quarter_id)
	{
		//For The Quarter Segemnt
		$str = "SELECT q.* FROM ref_quarter q
			WHERE q.id='" . $quarter_id . "' LIMIT 1";
		$query = $this->db->query($str);
		$present_quarter = $query->row();

		$present_quarter_months = $present_quarter->value;
		$str = "SELECT ls.name,sub2.* FROM ref_loan_segment ls
				LEFT OUTER JOIN (

					SELECT sub.loan_segment,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") THEN sub.counter ELSE 0 END) AS no_case_filed_prest,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(" . $present_quarter_months . ") THEN sub.case_claim_amount ELSE 0 END) AS no_case_claim_amount_prest,
					SUM(sub.counter) AS no_case_filed,
					SUM(sub.case_claim_amount) AS no_case_claim_amount,
					SUM(CASE WHEN sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS no_of_setteled,
					SUM(CASE WHEN sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS no_of_setteled_amount,
					SUM(CASE WHEN sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS no_of_case_running,
					SUM(CASE WHEN sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS no_of_case_running_amount
					FROM
					(
						SELECT s.*,'1' AS counter FROM suit_filling_info s
						WHERE s.sts<>0  
					)sub
					GROUP BY sub.loan_segment

				)sub2 ON(ls.code=sub2.loan_segment)
				WHERE ls.data_status<>0";
		$query = $this->db->query($str);
		return $query->result();
	}

	function get_all_xl_data($type, $branch_sol = NULL, $zone = NULL, $district = NULL)
	{

		$data = '';
		if ($type == "statement_rt") {
			$where = " ";
			if (!empty($branch_sol)) {
				$where .= " AND s.branch_sol = " . $branch_sol;
			} else if (!empty($zone)) {
				$where .= " AND s.zone = " . $zone;
			} else if (!empty($district)) {
				$where .= " AND s.district = " . $district;
			}
			$date = date('Y-m-d');

			$SQL = "SELECT '' AS serial_number,date_format(CURRENT_DATE(), '%d.%m.%Y') AS tody_dt,
			 '" . $this->translate_number(date("m", strtotime($date))) . "' AS m_n,
			 '" . $this->translate_day(date("F", strtotime($date))) . ",' AS d_n,
			 '" . $this->translate_number(date("Y", strtotime($date))) . "' AS y_n,
		    SUM(IF(s.final_remarks=1,1,0)) AS  total_running_case,
			SUM(IF(s.final_remarks=1,s.case_claim_amount,0)) AS  total_running_case_value,
			SUM(IF(s.final_remarks=2,1,0)) AS  total_disposed_case,
			SUM(IF(s.final_remarks=1,s.case_claim_amount,0)) AS  total_disposed_case_value
			FROM suit_filling_info s 
			WHERE s.sts<>0 AND s.suit_sts IN(75,76) AND s.req_type=2$where";
			$data = $this->db->query($SQL)->result_array();
		} else if ($type == "bbquarterlygart") {

			$where = " ";
			if (!empty($branch_sol)) {
				$where .= " AND s.branch_sol = " . $branch_sol;
			} else if (!empty($zone)) {
				$where .= " AND s.zone = " . $zone;
			} else if (!empty($district)) {
				$where .= " AND s.district = " . $district;
			}
			if ($_POST['from_dt'] != '' && $_POST['from_dt'] != 0 && ($_POST['to_dt'] == '' || $_POST['to_dt'] == 0)) {
				$where .= " AND DATE(s.ac_close_dt) ='" . implode('-', array_reverse(explode('/', trim($_POST['from_dt'])))) . "'";
			}
			if ($_POST['from_dt'] != '' && $_POST['from_dt'] != 0 && $_POST['to_dt'] != '' && $_POST['to_dt'] != 0) {
				$where .= " AND DATE(s.ac_close_dt) >= '" . implode('-', array_reverse(explode('/', trim($_POST['from_dt'])))) . "' AND DATE(s.ac_close_dt) <= '" . implode('-', array_reverse(explode('/', trim($_POST['to_dt'])))) . "'";
			}

			$SQL = "SELECT '' AS serial_number,
			s.case_claim_amount,s.case_number,date_format(s.ac_close_dt, '%d/%m/%Y') as ac_close_dt
			FROM suit_filling_info s 
			WHERE s.sts<>0 AND s.final_remarks=2$where";
			$data = $this->db->query($SQL)->result_array();
		} else if ($type == "bb_quarterly_ka_rt") {


			$current_month = date('m');
			$current_year = date('Y');
			$str_where2="";

			if (!empty($branch_sol)) {
				$str_where2 .= " AND s.branch_sol = " . $branch_sol;
			} else if (!empty($zone)) {
				$str_where2 .= " AND s.zone = " . $zone;
			} else if (!empty($district)) {
				$str_where2 .= " AND s.district = " . $district;
			}

			if($current_month<=3)
			{
				$prev_quarter = ($current_year-1).'-12-31';
				$present_quarter = $current_year.'-03-31';
				$present_quarter_start = $current_year.'-01-01';
			}
			else if($current_month<=6 && $current_month>3)
			{
				$prev_quarter = $current_year.'-03-31';
				$present_quarter = $current_year.'-06-30';
				$present_quarter_start = $current_year.'-04-01';
			}
			else if($current_month<=9 && $current_month>6)
			{
				$prev_quarter = $current_year.'-06-30';
				$present_quarter = $current_year.'-09-30';
				$present_quarter_start = $current_year.'-07-01';
			}
			else
			{
				$prev_quarter = $current_year.'-09-30';
				$present_quarter = $current_year.'-12-31';
				$present_quarter_start = $current_year.'-10-01';
			}
			$select1 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=2 AND s.case_name<>4,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=2 AND s.case_name<>4 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prev_quarter_pending_ara'";
			$select2 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=2 AND s.case_name<>4,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=2 AND s.case_name<>4 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prest_quarter_pending_ara'";
			$select3 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 AND s.case_name<>4,1,0)) AS 'prest_quarter_settled_ara'";
			$select4 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 AND s.case_name<>4,1,0)) AS 'prest_quarter_new_file_ara'";

			$select5 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=2 AND s.case_name=4,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=2 AND s.case_name=4 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prev_quarter_pending_jari'";
			$select6 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=2 AND s.case_name=4,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=2 AND s.case_name=4 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prest_quarter_pending_jari'";
			$select7 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 AND s.case_name=4,1,0)) AS 'prest_quarter_settled_jari'";
			$select8 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 AND s.case_name=4,1,0)) AS 'prest_quarter_new_file_jari'";

			$select9 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=1,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=1 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prev_quarter_pending_ni'";
			$select10 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=1,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=1 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prest_quarter_pending_ni'";
			$select11 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=1,1,0)) AS 'prest_quarter_settled_ni'";
			$select12 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=1,1,0)) AS 'prest_quarter_new_file_ni'";

			$select13 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type NOT IN(1,2),1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type NOT IN(1,2) AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prev_quarter_pending_other'";
			$select14 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type NOT IN(1,2),1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type NOT IN(1,2) AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prest_quarter_pending_other'";
			$select15 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type NOT IN(1,2),1,0)) AS 'prest_quarter_settled_other'";
			$select16 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type NOT IN(1,2),1,0)) AS 'prest_quarter_new_file_other'";


			$selectamt1 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=2 AND s.case_name<>4,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=2 AND s.case_name<>4 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prev_quarter_pending_ara_amount'";
			$selectamt2 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=2 AND s.case_name<>4,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=2 AND s.case_name<>4 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prest_quarter_pending_ara_amount'";
			$selectamt3 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 AND s.case_name<>4,s.case_claim_amount,0)) AS 'prest_quarter_settled_ara_amount'";
			$selectamt4 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 AND s.case_name<>4,s.case_claim_amount,0)) AS 'prest_quarter_new_file_ara_amount'";

			$selectamt5 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=2 AND s.case_name=4,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=2 AND s.case_name=4 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prev_quarter_pending_jari_amount'";
			$selectamt6 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=2 AND s.case_name=4,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=2 AND s.case_name=4 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prest_quarter_pending_jari_amount'";
			$selectamt7 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 AND s.case_name=4,s.case_claim_amount,0)) AS 'prest_quarter_settled_jari_amount'";
			$selectamt8 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 AND s.case_name=4,s.case_claim_amount,0)) AS 'prest_quarter_new_file_jari_amount'";

			$selectamt9 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=1,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=1 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prev_quarter_pending_ni_amount'";
			$selectamt10 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=1,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=1 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prest_quarter_pending_ni_amount'";
			$selectamt11 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=1,s.case_claim_amount,0)) AS 'prest_quarter_settled_ni_amount'";
			$selectamt12 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=1,s.case_claim_amount,0)) AS 'prest_quarter_new_file_ni_amount'";

			$selectamt13 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type NOT IN(1,2),s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type NOT IN(1,2) AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prev_quarter_pending_other_amount'";
			$selectamt14 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type NOT IN(1,2),s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type NOT IN(1,2) AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prest_quarter_pending_other_amount'";
			$selectamt15 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type NOT IN(1,2),s.case_claim_amount,0)) AS 'prest_quarter_settled_other_amount'";
			$selectamt16 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type NOT IN(1,2),s.case_claim_amount,0)) AS 'prest_quarter_new_file_other_amount'";

			$SQL="SELECT 
			$select1,
			$select2,
			$select3,
			$select4,
			$select4,
			$select5,
			$select6,
			$select7,
			$select8,
			$select9,
			$select10,
			$select11,
			$select12,
			$select13,
			$select14,
			$select15,
			$select16,
			$selectamt1,
			$selectamt2,
			$selectamt3,
			$selectamt4,
			$selectamt4,
			$selectamt5,
			$selectamt6,
			$selectamt7,
			$selectamt8,
			$selectamt9,
			$selectamt10,
			$selectamt11,
			$selectamt12,
			$selectamt13,
			$selectamt14,
			$selectamt15,
			$selectamt16
			FROM suit_filling_info s
			WHERE s.sts <> 0 AND (s.suit_sts=76 OR s.suit_sts=75) $str_where2";
			$data_array = $this->db->query($SQL)->result_array();

			$data = array(
				array(
					'prev_quarter_pending_ara'   => $data_array[0]['prev_quarter_pending_ara'],
					'prest_quarter_pending_ara'  => $data_array[0]['prest_quarter_pending_ara'],
					'prest_quarter_pending_jari' => $data_array[0]['prest_quarter_pending_jari'],
					'prev_quarter_pending_jari'  => $data_array[0]['prev_quarter_pending_jari'],
					'prest_quarter_new_file_ara' => $data_array[0]['prest_quarter_new_file_ara'],
					'prest_quarter_settled_ara'  => $data_array[0]['prest_quarter_settled_ara'],
					'prest_quarter_pending_ni'   => $data_array[0]['prest_quarter_pending_ni'],
					'prev_quarter_pending_ni'    => $data_array[0]['prev_quarter_pending_ara'],
					'prest_quarter_new_file_jari' => $data_array[0]['prev_quarter_pending_ara'],
					'prest_quarter_settled_jari' => $data_array[0]['prest_quarter_settled_jari'],
					'prest_quarter_pending_other' => $data_array[0]['prest_quarter_pending_other'],
					'prev_quarter_pending_other' => $data_array[0]['prev_quarter_pending_other'],
					'prest_quarter_new_file_ni' => $data_array[0]['prest_quarter_new_file_ni'],
					'prest_quarter_settled_ni' => $data_array[0]['prest_quarter_settled_ni'],
					'prest_quarter_new_file_other' => $data_array[0]['prest_quarter_new_file_other'],
					'prest_quarter_settled_other' => $data_array[0]['prest_quarter_settled_other'],


					'total_prev_quarter' =>$data_array[0]['prev_quarter_pending_ara_amount']+$data_array[0]['prev_quarter_pending_jari_amount']+  $data_array[0]['prev_quarter_pending_ni_amount']+ $data_array[0]['prev_quarter_pending_other_amount'],
					'total_prest_quarter' => $data_array[0]['prest_quarter_pending_ara_amount']+$data_array[0]['prest_quarter_pending_jari_amount']+  $data_array[0]['prest_quarter_pending_ni_amount']+ $data_array[0]['prest_quarter_pending_other_amount'],
					'total_prest_quarter_settled' => $data_array[0]['prest_quarter_settled_ara_amount']+$data_array[0]['prest_quarter_settled_jari_amount']+  $data_array[0]['prest_quarter_settled_ni_amount']+ $data_array[0]['prest_quarter_settled_other_amount'],
					'total_prest_quarter_new_file' => $data_array[0]['prest_quarter_new_file_ara_amount']+$data_array[0]['prest_quarter_new_file_jari_amount']+  $data_array[0]['prest_quarter_new_file_ni_amount']+ $data_array[0]['prest_quarter_new_file_other_amount'],
				)
			);

		

		} else if ($type == "br4_statement_for_bb") {

			$where = " ";
			if (!empty($branch_sol)) {
				$where .= " AND s.branch_sol = " . $branch_sol;
			} else if (!empty($zone)) {
				$where .= " AND s.zone = " . $zone;
			} else if (!empty($district)) {
				$where .= " AND s.district = " . $district;
			}

			$SQL = "SELECT  '' AS serial_number,date_format(CURRENT_DATE(), '%d.%m.%Y') AS tody_dt,
			'A_©FY Av`vjZ' AS  type_name,
			SUM(IF(s.req_type=2,1,0)) AS total_suit_ara,
			SUM(IF(s.req_type=2,s.case_claim_amount,0)) AS total_suit_ara_amount,
			SUM(IF(s.req_type=2 AND s.final_remarks=1,1,0)) AS total_suit_ara_running,
			SUM(IF(s.req_type=2 AND s.final_remarks=1,s.case_claim_amount,0)) AS total_suit_ara_amount_running,
			SUM(IF(s.req_type=2 AND s.final_remarks=2,1,0)) AS total_suit_ara_disposed,
			SUM(IF(s.req_type=2 AND s.final_remarks=2,s.case_claim_amount,0)) AS total_suit_ara_amount_disposed
			FROM suit_filling_info s 
			WHERE s.sts<>0 AND s.suit_sts IN(75,76) AND s.req_type=2$where
			UNION ALL
			SELECT  '' AS serial_number,date_format(CURRENT_DATE(), '%d.%m.%Y') AS tody_dt,
			'Ab¨vb¨ (N.I. Act)' AS  type_name,
			SUM(IF(s.req_type=1,1,0)) AS total_suit_ara,
			SUM(IF(s.req_type=1,s.case_claim_amount,0)) AS total_suit_ara_amount,
			SUM(IF(s.req_type=1 AND s.final_remarks=1,1,0)) AS total_suit_ara_running,
			SUM(IF(s.req_type=1 AND s.final_remarks=1,s.case_claim_amount,0)) AS total_suit_ara_amount_running,
			SUM(IF(s.req_type=1 AND s.final_remarks=2,1,0)) AS total_suit_ara_disposed,
			SUM(IF(s.req_type=1 AND s.final_remarks=2,s.case_claim_amount,0)) AS total_suit_ara_amount_disposed
			FROM suit_filling_info s 
			WHERE s.sts<>0 AND s.suit_sts IN(75,76) AND s.req_type=1$where";
			$data = $this->db->query($SQL)->result_array();
		} else if ($type == "cib_wp_attachment") {

			$where = " ";
			if (!empty($branch_sol)) {
				$where .= " AND s.branch_sol = " . $branch_sol;
			} else if (!empty($zone)) {
				$where .= " AND s.zone = " . $zone;
			} else if (!empty($district)) {
				$where .= " AND s.district = " . $district;
			}

			$SQL = "SELECT  '' AS serial_number,
			h.case_number,h.account_name,l.name AS lawyer_name,l.mobile AS lawyer_mobile
			FROM hc_ad_matters h
			LEFT OUTER JOIN ref_lawyer l ON(l.id=h.lawyer_name)
			WHERE h.sts<>0 AND h.v_sts=38$where";
			$data = $this->db->query($SQL)->result_array();
		} else if ($type == "top_33_sheet") {

			$where = " ";
			if (!empty($branch_sol)) {
				$where .= " AND s.branch_sol = " . $branch_sol;
			} else if (!empty($zone)) {
				$where .= " AND s.zone = " . $zone;
			} else if (!empty($district)) {
				$where .= " AND s.district = " . $district;
			}
			$SQL = "SELECT '' AS serial_number,
			s.ac_name,s.case_number,b.name AS branch_name,s.case_claim_amount,l.name AS lawyer_name,l.mobile AS lawyer_mobile
			FROM suit_filling_info s
			LEFT OUTER JOIN ref_branch_sol b ON(b.code=s.branch_sol)
			LEFT OUTER JOIN ref_lawyer l ON(l.id=s.prest_lawyer_name)
			WHERE s.sts<>0 AND s.suit_sts IN(75,76)$where";
			$data = $this->db->query($SQL)->result_array();
		} else if ($type == "top_33_sheet_bb_kha") {

			$data[] = array(
				'ni1' => '100',
				'ni2' => '100',
				'ni3' => '100',
				'ni4' => '100',
				'ni5' => '100',
				'ni6' => '100',
				'ni7' => '100',
				'ni8' => '100',
				'ni9' => '100',
				'ni10' => '100',
				'ni11' => '100',
				'ni12' => '100',
				'ni13' => '100',
				'ni14' => '100',
			);
		}
		return $data;
	}

	function get_all_xl_data2($type, $branch_sol = NULL, $zone = NULL, $district = NULL){

		$data = '';
		if ($type == "bb_quarterly_ka_rt") {

				$current_month = date('m');
				$current_year = date('Y');
				$str_where2="";
				if($current_month<=3)
				{
					$prev_quarter = ($current_year-1).'-12-31';
					$present_quarter = $current_year.'-03-31';
					$present_quarter_start = $current_year.'-01-01';
				}
				else if($current_month<=6 && $current_month>3)
				{
					$prev_quarter = $current_year.'-03-31';
					$present_quarter = $current_year.'-06-30';
					$present_quarter_start = $current_year.'-04-01';
				}
				else if($current_month<=9 && $current_month>6)
				{
					$prev_quarter = $current_year.'-06-30';
					$present_quarter = $current_year.'-09-30';
					$present_quarter_start = $current_year.'-07-01';
				}
				else
				{
					$prev_quarter = $current_year.'-09-30';
					$present_quarter = $current_year.'-12-31';
					$present_quarter_start = $current_year.'-10-01';
				}
				$select1 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=2 ,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=2  AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prev_quarter_pending_writ'";
				$select2 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=2 ,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=2  AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prest_quarter_pending_writ'";
				$select3 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 ,1,0)) AS 'prest_quarter_settled_writ'";
				$select4 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 ,1,0)) AS 'prest_quarter_new_file_writ'";

				$select5 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=13,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=13 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prev_quarter_pending_appeal'";
				$select6 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=13,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=13 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prest_quarter_pending_appeal'";
				$select7 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=13,1,0)) AS 'prest_quarter_settled_appeal'";
				$select8 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=13,1,0)) AS 'prest_quarter_new_file_appeal'";

				$select9 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=5,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=5 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prev_quarter_pending_revision'";
				$select10 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=5,1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=5 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prest_quarter_pending_revision'";
				$select11 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=5,1,0)) AS 'prest_quarter_settled_revision'";
				$select12 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=5,1,0)) AS 'prest_quarter_new_file_revision'";

				$select13 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type NOT IN(2,13,5),1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type NOT IN(2,13,5) AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prev_quarter_pending_other'";
				$select14 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type NOT IN(2,13,5),1,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type NOT IN(2,13,5) AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),1,0))) AS 'prest_quarter_pending_other'";
				$select15 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type NOT IN(2,13,5),1,0)) AS 'prest_quarter_settled_other'";
				$select16 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type NOT IN(2,13,5),1,0)) AS 'prest_quarter_new_file_other'";







				$selectamt1 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=2 ,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=2  AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prev_quarter_pending_writ_amount'";


				$selectamt2 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=2 ,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=2  AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prest_quarter_pending_writ_amount'";
				$selectamt3 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 ,s.case_claim_amount,0)) AS 'prest_quarter_settled_writ'";
				$selectamt4 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=2 ,s.case_claim_amount,0)) AS 'prest_quarter_new_file_writ_amount'";

				$selectamt5 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=13,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=13 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prev_quarter_pending_appeal_amount'";


				$selectamt6 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=13,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=13 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prest_quarter_pending_appeal_amount'";

				$selectamt7 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=13,s.case_claim_amount,0)) AS 'prest_quarter_settled_appeal_amount'";
				$selectamt8 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=13,s.case_claim_amount,0)) AS 'prest_quarter_new_file_appeal_amount'";

				$selectamt9 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type=5,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type=5 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prev_quarter_pending_revision_amount'";

				$selectamt10 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type=5,s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type=5 AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prest_quarter_pending_revision_amount'";
				$selectamt11 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=5,s.case_claim_amount,0)) AS 'prest_quarter_settled_revision_amount'";
				$selectamt12 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type=5,s.case_claim_amount,0)) AS 'prest_quarter_new_file_revision_amount'";

				$selectamt13 = "(SUM(IF(DATE(s.filling_date)<='".$prev_quarter."' AND s.req_type NOT IN(2,13,5),s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$prev_quarter."'  AND s.req_type NOT IN(2,13,5) AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prev_quarter_pending_other_amount'";
				$selectamt14 = "(SUM(IF(DATE(s.filling_date)<='".$present_quarter."' AND s.req_type NOT IN(2,13,5),s.case_claim_amount,0)) - SUM(IF((DATE(s.ac_close_dt)<='".$present_quarter."'  AND s.req_type NOT IN(2,13,5) AND s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00'),s.case_claim_amount,0))) AS 'prest_quarter_pending_other_amount'";
				$selectamt15 = "SUM(IF((s.ac_close_dt IS NOT NULL AND s.ac_close_dt!='0000-00-00 00:00:00' AND s.ac_close_dt between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type NOT IN(2,13,5),s.case_claim_amount,0)) AS 'prest_quarter_settled_other_amount'";
				$selectamt16 = "SUM(IF((s.filling_date IS NOT NULL AND s.filling_date!='0000-00-00 00:00:00' AND s.filling_date between '".$present_quarter_start."' and '".$present_quarter."')  AND s.req_type NOT IN(2,13,5),s.case_claim_amount,0)) AS 'prest_quarter_new_file_other_amount'";


				$SQL="SELECT 
				$select1,
				$select2,
				$select3,
				$select4,
				$select4,
				$select5,
				$select6,
				$select7,
				$select8,
				$select9,
				$select10,
				$select11,
				$select12,
				$select13,
				$select14,
				$select15,
				$select16,
				$selectamt1,
				$selectamt2,
				$selectamt3,
				$selectamt4,
				$selectamt4,
				$selectamt5,
				$selectamt6,
				$selectamt7,
				$selectamt8,
				$selectamt9,
				$selectamt10,
				$selectamt11,
				$selectamt12,
				$selectamt13,
				$selectamt14,
				$selectamt15,
				$selectamt16

				FROM case_against_bank s
				WHERE s.sts <> 0 AND (s.suit_sts=76 OR s.suit_sts=75) $str_where2";
				$data_array = $this->db->query($SQL)->result_array();

				$data = array(
					array(
						'prev_quarter_pending_writ'   => $data_array[0]['prev_quarter_pending_writ'],
						'prest_quarter_pending_writ'  => $data_array[0]['prest_quarter_pending_writ'],
						'prest_quarter_pending_appeal' => $data_array[0]['prest_quarter_pending_appeal'],
						'prev_quarter_pending_appeal'  => $data_array[0]['prev_quarter_pending_appeal'],
						'prest_quarter_new_file_writ' => $data_array[0]['prest_quarter_new_file_writ'],
						'prest_quarter_settled_writ'  => $data_array[0]['prest_quarter_settled_writ'],
						'prest_quarter_pending_revision'   => $data_array[0]['prest_quarter_pending_revision'],
						'prev_quarter_pending_revision'    => $data_array[0]['prev_quarter_pending_writ'],
						'prest_quarter_new_file_appeal' => $data_array[0]['prev_quarter_pending_writ'],
						'prest_quarter_settled_appeal' => $data_array[0]['prest_quarter_settled_appeal'],
						'prest_quarter_pending_other' => $data_array[0]['prest_quarter_pending_other'],
						'prev_quarter_pending_other' => $data_array[0]['prev_quarter_pending_other'],
						'prest_quarter_new_file_revision' => $data_array[0]['prest_quarter_new_file_revision'],
						'prest_quarter_settled_revision' => $data_array[0]['prest_quarter_settled_revision'],
						'prest_quarter_new_file_other' => $data_array[0]['prest_quarter_new_file_other'],
						'prest_quarter_settled_other' => $data_array[0]['prest_quarter_settled_other'],



						'total_prev_quarter' =>$data_array[0]['prev_quarter_pending_writ_amount']+$data_array[0]['prev_quarter_pending_appeal_amount']+  $data_array[0]['prev_quarter_pending_revision_amount']+ $data_array[0]['prev_quarter_pending_other_amount'],
						'total_prest_quarter' => $data_array[0]['prest_quarter_pending_writ_amount']+$data_array[0]['prest_quarter_pending_appeal_amount']+  $data_array[0]['prest_quarter_pending_revision_amount']+ $data_array[0]['prest_quarter_pending_other_amount'],
						'total_prest_quarter_settled' => $data_array[0]['prest_quarter_settled_writ']+$data_array[0]['prest_quarter_settled_appeal_amount']+  $data_array[0]['prest_quarter_settled_revision_amount']+ $data_array[0]['prest_quarter_settled_other_amount'],
						'total_prest_quarter_new_file' => $data_array[0]['prest_quarter_new_file_writ_amount']+$data_array[0]['prest_quarter_new_file_appeal_amount']+  $data_array[0]['prest_quarter_new_file_revision_amount']+ $data_array[0]['prest_quarter_new_file_other_amount'],
					)
				);


		}
		return $data;





	}




	function get_all_xl_data_total($type, $branch_sol = NULL, $zone = NULL, $district = NULL)
	{

		$data = '';
		if ($type == "statement_rt") {
			// Perform calculations if the condition is true
		} else if ($type == "bbquarterlygart") {
			$where = " ";
			if (!empty($branch_sol)) {
				$where .= " AND s.branch_sol = " . $branch_sol;
			} else if (!empty($zone)) {
				$where .= " AND s.zone = " . $zone;
			} else if (!empty($district)) {
				$where .= " AND s.district = " . $district;
			}
			if ($_POST['from_dt'] != '' && $_POST['from_dt'] != 0 && ($_POST['to_dt'] == '' || $_POST['to_dt'] == 0)) {
				$where .= " AND DATE(s.ac_close_dt) ='" . implode('-', array_reverse(explode('/', trim($_POST['from_dt'])))) . "'";
			}
			if ($_POST['from_dt'] != '' && $_POST['from_dt'] != 0 && $_POST['to_dt'] != '' && $_POST['to_dt'] != 0) {
				$where .= " AND DATE(s.ac_close_dt) >= '" . implode('-', array_reverse(explode('/', trim($_POST['from_dt'])))) . "' AND DATE(s.ac_close_dt) <= '" . implode('-', array_reverse(explode('/', trim($_POST['to_dt'])))) . "'";
			}

			$SQL = "SELECT 
			SUM(s.case_claim_amount) as total
			FROM suit_filling_info s 
			WHERE s.sts<>0 AND s.final_remarks=2$where";
			$data = $this->db->query($SQL)->result_array();
		} else if ($type == "bb_quarterly_ka_rt") {
			// Perform calculations if the condition is true


		} else if ($type == "br4_statement_for_bb") {

			$date = date('Y-m-d');
			$data = array(
				array(
					'tody_dt' => date('d.m.Y'),
					'm_n' 	  =>  $this->translate_number(date("m", strtotime($date))),
					'd_n' 	  =>  $this->translate_day(date("F", strtotime($date))),
					'y_n' 	  =>  $this->translate_number(date("Y", strtotime($date)))
				)

			);
		} else  if ($type == "cib_wp_attachment") {


			$date = date('Y-m-d');
			$data = array(
				array(
					'tody_dt' => date('d.m.Y'),
					'm_n' 	  =>  $this->translate_number(date("m", strtotime($date))),
					'd_n' 	  =>  $this->translate_day(date("F", strtotime($date))),
					'y_n' 	  =>  $this->translate_number(date("Y", strtotime($date))),
					'dd' 	  =>  $this->translate_xyx(date("m", strtotime($date))),
				)

			);
		} else if ($type == "top_33_sheet") {
			$where = " ";
			if (!empty($branch_sol)) {
				$where .= " AND s.branch_sol = " . $branch_sol;
			} else if (!empty($zone)) {
				$where .= " AND s.zone = " . $zone;
			} else if (!empty($district)) {
				$where .= " AND s.district = " . $district;
			}
			$SQL = "SELECT SUM(s.case_claim_amount) as total
			FROM suit_filling_info s
			LEFT OUTER JOIN ref_branch_sol b ON(b.code=s.branch_sol)
			LEFT OUTER JOIN ref_lawyer l ON(l.id=s.prest_lawyer_name)
			WHERE s.sts<>0 AND s.suit_sts IN(75,76)$where";
			$data = $this->db->query($SQL)->result_array();
		} else if ($type == "top_33_sheet_bb_kha") {

			// Perform calculations if the condition is true

		}


		return $data;
	}

	// date, time, month, year bangla converter

	function translate_number($str)
	{
		$en = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
		$bn = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
		$str = str_replace($en, $bn, $str);
		return $str;
	}

	function translate_day($str)
	{
		$en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$en_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		$bn = array('জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');

		$str = str_replace($en, $bn, $str);
		$str = str_replace($en_short, $bn, $str);
		return $str;
	}

	function translate_xyx($str)
	{
		$data = "";
		if ($str >= 1 && $str <= 3) {
			$data .= "জানুয়ারি - মার্চ";
		} else if ($str >= 4 && $str <= 6) {
			$data .= "এপ্রিল - জুন";
		} else if ($str >= 7 && $str <= 9) {
			$data .= "জুলাই - সেপ্টেম্বর";
		} else if ($str >= 10 && $str <= 12) {
			$data .= "অক্টোবর - ডিসেম্বর";
		} else {
			$data .= "Invalid month";
		}
		return $data;
	}




}
