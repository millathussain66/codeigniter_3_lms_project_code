<?php
class Approval_list_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
	}
	function get_grid_data($filterscount, $sortdatafield, $sortorder, $limit, $offset, $status)
	{
		$i = 0;
		$where2 = "b.sts!='0'";



		if ($this->input->get('proposed_type') != '') {
			$where2 .= " AND b.ac_type = '" . trim($this->input->get('proposed_type')) . "'";
		}


		if ($this->input->get('loan_ac') != '' && $this->input->get('proposed_type') != '') {
			if ($this->input->get('proposed_type') == 'Investment') {
				$where2 .= " AND b.investment_ac='" . $this->input->get('loan_ac') . "'";
			} else if ($this->input->get('proposed_type') == 'Card') {
				$where2 .= " AND b.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->get('loan_ac2')) . "'";
			}
		}

		if ($this->input->get('case_number') != '') {
			$where2 .= " AND b.cif_no LIKE '%" . trim($this->input->get('case_number')) . "%'";
		}

		if (isset($filterscount) && $filterscount > 0) {
			$where = "(";

			$tmpdatafield = "";
			$tmpfilteroperator = "";
			for ($i = 0; $i < $filterscount; $i++) { //$where2.="(".$this->input->get('filterdatafield'.$i)." like '%".$this->input->get('filtervalue'.$i)."%')";

				// get the filter's value.
				$filtervalue = $this->input->get('filtervalue' . $i);
				// get the filter's condition.
				$filtercondition = $this->input->get('filtercondition' . $i);
				// get the filter's column.
				$filterdatafield = $this->input->get('filterdatafield' . $i);
				// get the filter's operator.
				$filteroperator = $this->input->get('filteroperator' . $i);

				if ($filterdatafield == 'e_dt') {
					$filterdatafield = 'b.e_dt';
				} else if ($filterdatafield == 'doc_type') {
					$filterdatafield = 'c.name';
				} else if ($filterdatafield == 'e_name') {
					$filterdatafield = 'u.name';
				} else if ($filterdatafield == 'remarks') {
					$filterdatafield = 'b.remarks';
				} else if ($filterdatafield == 'status') {
					$filterdatafield = 'j1.name';
				} else if ($filterdatafield == 'status') {
					$filterdatafield = 'j1.name';
				} else if ($filterdatafield == 'ac_type') {
					$filterdatafield = 'b.ac_type';
				} else {
					$filterdatafield = 'b.' . $filterdatafield;
				}



				if ($tmpdatafield == "") {
					$tmpdatafield = $filterdatafield;
				} else if ($tmpdatafield <> $filterdatafield) {
					$where .= ")AND(";
				} else if ($tmpdatafield == $filterdatafield) {
					if ($tmpfilteroperator == 0) {
						$where .= " AND ";
					} else $where .= " OR ";
				}

				// build the "WHERE" clause depending on the filter's condition, value and datafield.
				switch ($filtercondition) {
					case "CONTAINS":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "%'";
						break;
					case "DOES_NOT_CONTAIN":
						$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue . "%'";
						break;
					case "EQUAL":
						$where .= " " . $filterdatafield . " = '" . $filtervalue . "'";
						break;
					case "NOT_EQUAL":
						$where .= " " . $filterdatafield . " <> '" . $filtervalue . "'";
						break;
					case "GREATER_THAN":
						$where .= " " . $filterdatafield . " > '" . $filtervalue . "'";
						break;
					case "LESS_THAN":
						$where .= " " . $filterdatafield . " < '" . $filtervalue . "'";
						break;
					case "GREATER_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " >= '" . $filtervalue . "'";
						break;
					case "LESS_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " <= '" . $filtervalue . "'";
						break;
					case "STARTS_WITH":
						$where .= " " . $filterdatafield . " LIKE '" . $filtervalue . "%'";
						break;
					case "ENDS_WITH":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "'";
						break;
				}

				if ($i == $filterscount - 1) {
					$where .= ")";
				}

				$tmpfilteroperator = $filteroperator;
				$tmpdatafield = $filterdatafield;
			}
			// build the query.
		} else {
			$where = array();
		}
		//if($where=='' || count($where)<=0){	
		// if($where=='' ){			
		// 	$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		// }

		if ($sortorder == '') {
			$sortdatafield = "b.id";
			$sortorder = "DESC";
		}



		if ($status == "running") {
			$where3 = "j1.name='$status' ";
		} else {

			$where3 = "j1.name!=" . "'running'";
		}

		//concat(u.name ,u.user_id)
		$this->db
			->select('SQL_CALC_FOUND_ROWS b.*,j1.name as status,b.org_loan_ac,
			DATE_FORMAT(b.case_file_expiry_date,"%d-%b-%y") as case_expire_date,
			DATE_FORMAT(b.approval_dt,"%d-%b-%y") as approval_dt,
			DATE_FORMAT(b.e_dt,"%d-%b-%y") as e_dt,
			j2.name as e_by,
	 
	 
	 
	 ', FALSE)

			->from("approval_list b")

			->join('ref_status as j1', 'b.v_sts=j1.id', 'left')
			->join('users_info as j2', 'b.e_by=j2.id', 'left')


			->where($where)
			->where($where2)
			->where($where3)
			->order_by($sortdatafield, $sortorder)
			->limit($limit, $offset);
		$q = $this->db->get();

		$lastQuery = $this->db->last_query();
		$query = $this->db->query('SELECT FOUND_ROWS() AS Count');
		$objCount = $query->result_array();
		$result["TotalRows"] = $objCount[0]['Count'];

		if ($q->num_rows() > 0) {
			$result["Rows"] = $q->result();
		} else {
			$result["Rows"] = array();
		}
		return $result;
	}
	function file_upload($input_name = NULL, $file = NULL)
	{

		$image = $_FILES[$input_name]['name'];
		$file_Size = $_FILES[$input_name]['size'];
		if ($image) {
			$filename = stripslashes($_FILES[$input_name]['name']);
			$i = strrpos($filename, ".");
			if (!$i) {
				$text[] = "Unknown Extention";
			}
			$l = strlen($filename) - $i;
			$extension = substr($filename, $i + 1, $l);
			$extension = strtolower($extension);
			$file_name_new = 'Doc_Files_' . $this->session->userdata['ast_user']['user_id'] . '_' . rand() . '.' . $extension;
		}
		if ($file_name_new != '' && $image == true) {
			if (($file_Size > 0)) {
				$copied = copy($_FILES[$input_name]['tmp_name'], 'doc_files/' . $file_name_new);
				if ($_POST['hidden_' . $input_name] != '') {
					unlink("doc_files/" . $_POST['hidden_' . $input_name]);
				}
			} else {
				$text[] = "Unknown Attached documents (AF) Extention";
			}
		}
		return  $file_name_new;
	}
	function get_add_action_data($id)
	{
		$this->db
			->select("b.*,DATE(b.e_dt) as e_dt,", FALSE)
			->from("approval_list b")
			// ->join('ref_document_type as c', 'b.document_type=c.id', 'left')
			->where("b.sts='1' and b.id='" . $id . "'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function add_edit_action($add_edit = NULL, $edit_id = NULL, $editrow = NULL)
	{

		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error


		$this->db->trans_begin();
		if ($editrow == "") {
			$editrow = 0;
		}
		$data = array();
		$e_dt = date('Y-m-d H:i:s');
		$e_by = $this->session->userdata['ast_user']['user_id'];

		$apv_date       = implode('-', array_reverse(explode('/', $this->input->post('apv_date'))));
		$apv_ref_no = $this->input->post('apv_ref_no');

		for ($i = 1; $i <= $_POST['total_row']; $i++) {

			$array = array(

				'ac_type' => $this->input->post('ac_type_' . $i),
				'investment_ac' => $this->input->post('investment_ac_' . $i),
				'org_loan_ac' => $this->input->post('org_loan_ac_' . $i),
				'cif_no' => $this->input->post('cif_no_' . $i),
				'account_name' => $this->input->post('account_name_' . $i),
				'case_file_expiry_date' => $this->input->post('expiry_date_' . $i),
				'approval_ref' => $apv_ref_no,
				'approval_dt' => $apv_date,
				'e_by' => $e_by,
				'e_dt' => $e_dt,
				'sts' => 1,
				'v_sts' => 1,
			);
			array_push($data, $array);
		}



		$this->db->insert_batch('approval_list', $data);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		} else {
			$this->db->trans_commit();
			$this->db->db_debug = $db_debug;
			return 1;
		}
	}
	function get_info($add_edit, $id) // get data for edit
	{
		if ($id != '') {
			$this->db
				->select('SQL_CALC_FOUND_ROWS b.*', FALSE)
				->from("approval_list b")

				->where("b.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			return  $this->db->get()->row();
		} else {
			return NULL;
		}
	}
	function delete_action()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start

		if ($this->input->post('type') == 'delete') {

			$data = array(
				'd_reson' => trim($_POST['comments']),
				'sts' => 0,
				'd_by' => $this->session->userdata['ast_user']['user_id'],
				'd_dt' => date('Y-m-d H:i:s')
			);
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('approval_list', $data);
		}
		if ($this->input->post('type') == 'sendtochecker') {

			$data = array(
				'v_sts' => 37,
				'stc_by' => $this->session->userdata['ast_user']['user_id'],
				'stc_dt' => date('Y-m-d H:i:s'),
			);
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('approval_list', $data);
		}

		if ($this->input->post('type') == 'verify') {
			$data = array(
				'v_sts' => 106,
				'v_by' => $this->session->userdata['ast_user']['user_id'],
				'v_dt' => date(
					'Y-m-d H:i:s'
				)
			);

			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('approval_list', $data);
			$data2 = $this->user_model->user_activities(38, '', $this->input->post('deleteEventId'), 'approval_list', 'Verify Document(' . $this->input->post('deleteEventId') . ')', '', $this->session->userdata['ast_user']['user_id'], '');
		}
		if ($this->input->post('type') == 'extend') {

			$new_date = implode("-", array_reverse(explode("/", $this->input->post('new_date'))));

			$data = array(
				'event_id' => $this->input->post('deleteEventId'),
				'prev_date' => $this->input->post('prev_date'),
				'new_date' => $new_date,
				'reason' => $this->input->post('comments'),
				'u_by' => $this->session->userdata['ast_user']['user_id'],
				'u_dt' => date(
					'Y-m-d H:i:s'
				)
			);
			$this->db->insert('case_expiry_date_extend_history', $data);
			$data2 = $this->user_model->user_activities(190, '', $this->input->post('deleteEventId'), 'case_expiry_date_extend_history', 'Extend Case Expiry Date(' . $this->input->post('deleteEventId') . ')', '', $this->session->userdata['ast_user']['user_id'], '');

			$ApprovalData = array(
				'case_file_expiry_date' => $new_date,
				'e_by' => $this->session->userdata['ast_user']['user_id'],
				'e_dt' => date(
					'Y-m-d H:i:s'
				)
			);
			$this->db->where('id', $this->input->post('deleteEventId'));
			$this->db->update('approval_list', $ApprovalData);
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		} else {
			$this->db->trans_commit();
			$this->db->db_debug = $db_debug;
			return $_POST['deleteEventId'];
		}
	}
	function get_recovery_details_by_batch($batch)
	{
		if ($batch != '') {
			$str = " SELECT r.*
            FROM approval_list r
            WHERE  r.sts=1 AND r.batch_no=" . $this->db->escape($batch);
			$query = $this->db->query($str);
			return $query->result();
		} else {
			return NULL;
		}
	}
	function delete_action_data()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start


		if ($this->input->post('type') == 'save_recovery') {


			$data = array();

			$e_dt = date('Y-m-d H:i:s');
			$e_by = $this->session->userdata['ast_user']['user_id'];



			for ($i = 1; $i <= $_POST['total_row']; $i++) {


				$array = array(
					'investment_ac_type' => $this->input->post('investment_ac_type_' . $i),
					'cif_no' => $this->input->post('cif_no_' . $i),
					'account_name' => $this->input->post('account_name_' . $i),
					'e_by' => $e_by,
					'e_dt' => $e_dt
				);
				array_push($data, $array);
			}
			$this->db->insert_batch('approval_list', $data);

			$data2 = $this->user_model->user_activities(68, '', '', 'approval_list', 'Upload approval List');
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		} else {
			$this->db->trans_commit();
			$this->db->db_debug = $db_debug;
			return 1;
		}
	}
	function add_edit_action_indevisual()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start

		$loan_ac = "";
		$org_loan_ac = "";


		if ($this->input->post('ac_type') == 'Investment') {

			$loan_ac = $this->input->post('investment_ac');
			$org_loan_ac = "";
		} else if ($this->input->post('ac_type') == 'Card') {
			$investment_ac_number = $this->input->post('investment_ac');

			$loan_ac = substr($investment_ac_number, 0, 6) . '******' . substr($investment_ac_number, 12, 16);
			$org_loan_ac = $this->Common_model->stringEncryption('encrypt', $investment_ac_number);
		}


		$data = array(
			'ac_type' 	     => $this->input->post('ac_type'),
			'investment_ac'    => $loan_ac,
			'org_loan_ac'      =>  $org_loan_ac,
			'cif_no'           => $this->input->post('cif_no'),
			'account_name'     => $this->input->post('account_name'),
			'v_sts'            => 35,
			'case_file_expiry_date' => implode('-', array_reverse(explode('/', trim($this->input->post('case_file_expiry_date')))))
		);

		// echo "<pre>";
		// print_r($data);
		// exit();

		$this->db->where('id', $_POST['edit_id']);
		$this->db->update('approval_list', $data);



		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		} else {
			$this->db->trans_commit();
			$this->db->db_debug = $db_debug;
			return $_POST['edit_id'];
		}
	}
	public function get_details($id)
	{

		//concat(u.name ,u.user_id)
		$this->db->select('SQL_CALC_FOUND_ROWS b.*,j1.name as status,
			
			DATE_FORMAT(b.approval_dt,"%d-%b-%y") as approval_dt,
			DATE_FORMAT(b.case_file_expiry_date,"%d-%b-%y") as case_expire_date,
			DATE_FORMAT(b.e_dt,"%d-%b-%y") as e_dt,
			j2.name as e_by,', FALSE)

			->from("approval_list b")
			->join('ref_status as j1', 'b.v_sts=j1.id', 'left')
			->join('users_info as j2', 'b.e_by=j2.id', 'left')
			->where(array('b.id' => $id));

		$get_data  = $this->db->get();
		$result = $get_data->row();
		$html = '';
		$html = '';

		if (!empty($result)) {

			$html .= '<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body" style="padding:9px">
					<tr>
						<td width="50%" align="left"><strong>A/C Type :</strong>' . $result->ac_type . '</td>
						<td width="50%" align="left"><strong> A/C Number:</strong>' . $result->investment_ac . '</td>
					</tr>

					<tr>
					<td width="50%" align="left"><strong>Account Name :</strong>' . $result->account_name . '</td>

						<td width="50%" align="left"><strong>CID NO :</strong>' . $result->cif_no . '</td>
					</tr>

					<tr>
						<td width="50%" align="left"><strong>Approval Ref NO:</strong>' . $result->approval_ref . '</td>
						<td width="50%" align="left"><strong>Approval Date:</strong>' . $result->approval_dt . '</td>

					</tr>

					<tr>
						<td width="50%" align="left"><strong>Entry Date:</strong>' . $result->e_dt . '</td>
						<td width="50%" align="left"><strong>Entry By:</strong>' . $result->e_by . '</td>

					</tr>
					<tr>
						<td  colspan="" align="left"><strong>Case File Expiry Date : </strong>' . $result->case_expire_date . '</td>
						
					</tr>

	
					</tbody>
				</table>';
		}

		$data = array(
			"html" => $html,
			'prev_date' => $result->case_file_expiry_date
		);
		return $data;
	}
}
