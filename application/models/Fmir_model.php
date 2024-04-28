<?php
class  Fmir_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }

    function get_grid_data($filterscount, $sortdatafield, $sortorder, $limit, $offset)
    {
        $i = 0;
        $where2 = "b.sts!='0'";
        $filterdatafield2 = ' ';

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

                if ($filterdatafield == 'i_date') {
                    $filterdatafield = "DATE_FORMAT(b.inward_date,'%d-%b-%Y')";
                }

                if ($filterdatafield == 'l_date') {
                    $filterdatafield = "DATE_FORMAT(b.letter_date,'%d-%b-%Y')";
                }
                if ($filterdatafield == 'sth_date') {
                    $filterdatafield = "DATE_FORMAT(b.assigned_dt,'%d-%b-%Y')";
                }



                if ($filterdatafield == 'user_name') {
                    $filterdatafield = 'u.name';
                }


                // else if($filterdatafield=='return_reason_rm')
                // {
                // 	$filterdatafield='b.return_reason_rm';
                // }

                //else{$filterdatafield='b.'.$filterdatafield;}

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
                if ($filterdatafield == 'i_date') {
                    $where .= " (j2.name LIKE '%" . $filtervalue . "%' OR j2.user_id LIKE '%" . $filtervalue . "%') ";
                } else {
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
        // $where_initi=''; 
        // if($where=='' || count($where)<=0){			
        // 	$where_initi.=" ";
        // }
        if ($sortorder == '') {
            //$sortdatafield="b.id";
            //$sortorder = "DESC";	
            $sortdatafield = "b.id";
            $sortorder = "DESC";
        }
        if ($this->input->get('sorting') != '') {
            $sortdatafield = $this->input->get('sorting');
        }
        if ($this->input->get('ordering') != '') {
            $sortorder = $this->input->get('ordering');
        }


        if ($this->session->userdata['ast_user']['user_work_group_id'] == '4') //Branch Maker
        {
            $where2 .= " AND b.e_by='" . $this->session->userdata['ast_user']['user_id'] . "'";
        } else if ($this->session->userdata['ast_user']['user_work_group_id'] == '3') //Head office Approver
        {

            $where2 .= " AND (b.v_sts=110 OR b.v_sts=111 OR b.v_sts=113)";
        } else if ($this->session->userdata['ast_user']['user_work_group_id'] == '2') //Head office maker
        {
            $where2 .= " AND b.assigned_user ='" . $this->session->userdata['ast_user']['user_id'] . "'";
        }
        $this->db
            ->select('SQL_CALC_FOUND_ROWS b.id,b.sl_no,bs.name as branch_name,
            b.client_name,b.subject,b.letter_no,b.letter_date,b.inward_no,b.inward_date,
            b.assigned_user,
            u.name as user_name,b.v_sts,
            DATE_FORMAT(b.letter_date,"%d-%b-%Y") as l_date,
            DATE_FORMAT(b.inward_date,"%d-%b-%Y") as i_date,
            DATE_FORMAT(b.assigned_dt,"%d-%b-%Y") as sth_date,
            b.assigned_dt,b.complete_dt
	    	', FALSE)
            ->from("fmir b")
            ->join('ref_branch_sol as bs', 'bs.code=b.branch_name', 'left')
            ->join('ref_status as j6', 'b.v_sts=j6.id', 'left')
            ->join('users_info as u', 'b.assigned_user=u.id', 'left')
            ->where($where)
            ->where($where2)
            ->order_by($sortdatafield, $sortorder)
            ->limit($limit, $offset);
        $q = $this->db->get();





        $query = $this->db->query('SELECT FOUND_ROWS() AS Count');
        $objCount = $query->result_array();
        $result["TotalRows"] = $objCount[0]['Count'];

        if ($q->num_rows() > 0) {
            $result["Rows"] = $q->result();
        } else {
            $result["Rows"] = array();
        }
        $result['query'] = "";
        return $result;
    }
    public function get_details($id, $type)
    {




        $this->db
            ->select('b.id,b.sl_no,
        b.client_name,b.subject,b.letter_no,b.letter_date,b.inward_no,b.inward_date,
        b.assigned_user,bs.name as branch_name,

        DATE_FORMAT(b.letter_date,"%d-%b-%Y") as l_date,
        DATE_FORMAT(b.inward_date,"%d-%b-%Y") as i_date,

        u.name as user_name,b.v_sts
        ', FALSE)
            ->from("fmir b")
            ->join('ref_status as j6', 'b.v_sts=j6.id', 'left')
            ->join('ref_branch_sol as bs', 'bs.code=b.branch_name', 'left')
            ->join('users_info as u', 'b.assigned_user=u.id', 'left')
            ->where(array('b.id' => $id));

        $get_data  = $this->db->get();
        $result = $get_data->row();
        $html = '';


        if (!empty($result)) {

            $html .= '<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body" style="padding:0px">
					<tr>
						<td width="50%" align="left"><strong>Serial No :</strong> ' . $result->sl_no . '</td>
						<td width="50%" align="left"><strong> Branch Name:</strong> ' . $result->branch_name . '</td>
					</tr>

					<tr>
					<td width="50%" align="left"><strong>Client Name :</strong> ' . $result->client_name . '</td>
                    <td  width="50%"  align="left"><strong>Assigned To : </strong> ' . $result->user_name . '</td>

					</tr>

					<tr>
						<td width="50%" align="left"><strong>Letter No:</strong>' . $result->letter_no . '</td>
						<td width="50%" align="left"><strong>Letter Date:</strong> ' . $result->l_date . '</td>

					</tr>

					<tr>
						<td width="50%" align="left"><strong>Inward No:</strong> ' . $result->inward_no . '</td>
						<td width="50%" align="left"><strong>Inward Date:</strong> ' . $result->i_date . '</td>

					</tr>
					<tr>
                    <td colspan=2 align="left"><strong>Subject :</strong> ' . $result->subject . '</td>

					</tr>

	
					</tbody>
				</table>';
        }



        $history = "";
        if ($type == "history") {

            $this->db
                ->select('h.id,h.module_id,h.reason,un1.name as op_by,un2.name as previous_user,un3.name as new_user
            ,ref.name as status_name,ref.name as action_status,
            DATE_FORMAT(h.operation_dt,"%d-%b-%Y") as operation_date
            
            ', FALSE)
                ->from("fmir_history h")
                ->join('users_info as un1', 'h.operation_by=un1.id', 'left')
                ->join('users_info as un2', 'h.prev_user=un2.id', 'left')
                ->join('users_info as un3', 'h.new_user=un3.id', 'left')
                ->join('ref_status as ref', 'h.activities_id=ref.id', 'left')
                ->order_by("h.id asc")
                ->where(array('h.module_id' => $id));
            $get_history = $this->db->get()->result();


            if (!empty($get_history)) {
                $history .= "<strong><p style='background:#e8e8e8;padding:5px 0px 5px 5px !important;border:1px solid #c5c5c5;'>FMIR Life Cycle</p></strong><table table style='width: 100%;'>
                     <thead class='fmirLifeCycle'>
                        <tr>
                            <th style='color:black;background:none;text-align:left;'>Status</th>
                            <th style='color:black;background:none;text-align:left;''>Operated By</th>
                            <th style='color:black;background:none;text-align:left;''>Date</th>
                            <th style='color:black;background:none;text-align:left;''>Previous User</th>
                            <th style='color:black;background:none;text-align:left;''>New User</th>
                            <th style='color:black;background:none;text-align:left;''>Reason</th>
                        </tr>
                    </thead>
            ";

                foreach ($get_history as $h) {
                    $history .= "<tr>
                         <td>" . $h->action_status . "</td>
                         <td>" . $h->op_by . "</td>
                         <td>" . $h->operation_date . "</td>
                         <td>" . $h->previous_user . "</td>
                         <td>" . $h->new_user . "</td>
                         <td>" . $h->reason . "</td>
                      <tr>";
                }

                $history .= "</table>";
            }
        }

        $data = array(
            "html" => $html . $history,

        );
        return $data;
    }

    function getInfo($id)
    {
        $this->db
            ->select('b.id,b.sl_no,b.branch_name,
            b.client_name,b.subject,b.letter_no,b.letter_date,b.inward_no,b.inward_date,
            b.assigned_user,
            u.name as user_name,b.v_sts,
            DATE_FORMAT(b.letter_date,"%d/%m/%Y") as l_date,
            DATE_FORMAT(b.inward_date,"%d/%m/%Y") as i_date,
            ', FALSE)
            ->from("fmir b")
            ->join('ref_status as j6', 'b.v_sts=j6.id', 'left')
            ->join('users_info as u', 'b.assigned_user=u.id', 'left')
            ->where(array('b.id' => $id));

        $get_data  = $this->db->get();
        return  $result = $get_data->row();
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
            $this->db->update('fmir', $data);
            $data2 = $this->user_model->user_activities(15, '', $this->input->post('deleteEventId'), 'fmir', 'Deleted from fmir(' . $this->input->post('deleteEventId') . ')', '', $this->session->userdata['ast_user']['user_id'], '');
            $this->updateFmirHistory($_POST['deleteEventId'], 15,  trim($_POST['comments']));
        } else if ($this->input->post('type') == 'sth') {

            //v_sts=110 means sent to head office
            $data = array(
                'v_sts' => 110,
                'stho_by' => $this->session->userdata['ast_user']['user_id'],
                'stho_dt' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('fmir', $data);
            $data2 = $this->user_model->user_activities(110, '', $this->input->post('deleteEventId'), 'fmir', 'sent to HO, fmir(' . $this->input->post('deleteEventId') . ')', '', $this->session->userdata['ast_user']['user_id'], '');
            $this->updateFmirHistory($_POST['deleteEventId'], 110, "");
        } else if ($this->input->post('type') == 'assign') {

            //v_sts=110 means sent to head office
            $data = array(
                'assigned_user' => $this->input->post("assigned_user"),
                'v_sts' => 111,
                'assigned_by' => $this->session->userdata['ast_user']['user_id'],
                'assigned_dt' => date('Y-m-d h:i:s', time())

            );

            $this->updateFmirHistory($_POST['deleteEventId'], 111, "", $this->input->post("assigned_user"));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('fmir', $data);
            $data2 = $this->user_model->user_activities(111, '', $this->input->post('deleteEventId'), 'fmir', 'Assigned, fmir(' . $this->input->post('deleteEventId') . ')', '', $this->session->userdata['ast_user']['user_id'], '');
        } else if ($this->input->post('type') == 'delay') {


            //v_sts=110 means sent to head office
            $data = array(
                'reason_for_delay' => $this->input->post('delay_reason'),
                'v_sts' => 113, //delay status
                'delay_reason_e_by' => $this->session->userdata['ast_user']['user_id'],
                'delay_reason_e_dt' => date('Y-m-d h:i:s', time())
            );


            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('fmir', $data);
            $data2 = $this->user_model->user_activities(113, '', $this->input->post('deleteEventId'), 'fmir', 'Delayed, fmir(' . $this->input->post('deleteEventId') . ')', '', $this->session->userdata['ast_user']['user_id'], '');
            $this->updateFmirHistory($_POST['deleteEventId'], 113, $this->input->post('delay_reason'));
        } else if ($this->input->post('type') == 'complete') {

            //v_sts=110 means sent to head office
            $data = array(
                'complete_remarks' => $this->input->post('complete_remarks'),
                'v_sts' => 112, //Complete status
                'complete_by' => $this->session->userdata['ast_user']['user_id'],
                'complete_dt' => date('Y-m-d h:i:s', time())
            );


            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('fmir', $data);
            $data2 = $this->user_model->user_activities(112, '', $this->input->post('deleteEventId'), 'fmir', 'Completed, fmir(' . $this->input->post('deleteEventId') . ')', '', $this->session->userdata['ast_user']['user_id'], '');
            $this->updateFmirHistory($_POST['deleteEventId'], 112, $this->input->post('complete_remarks'));
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
    function getUsers()
    {

        $this->db
            ->select('u.id,u.name', FALSE)
            ->from("users_info u")
            ->join('user_group as ug', 'ug.id=u.user_group_id', 'left')
            ->WHERE('ug.id=2 OR ug.id=3');

        return $get_data  = $this->db->get()->result();
    }

    function add_edit_fmir($id = null, $post)
    {



        if ($id != null) {

            unset($post['fmir_id']);

            $post['v_sts'] = 35;
            $post['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $post['u_dt'] = date('Y-m-d h:i:s', time());
            $this->user_model->user_activities(35, '', $id, 'fmir', 'updated,fmir(' . $id . ')', '', $this->session->userdata['ast_user']['user_id'], '');

            $this->db->where('id', $this->security->xss_clean($id));
            $status =  $this->db->update('fmir', $post);
            $this->updateFmirHistory($id, 39, "");
            return $status;
        } else {
            unset($post['fmir_id']);
            $post['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $post['e_dt'] = date('Y-m-d h:i:s', time());
            $this->user_model->user_activities(39, '', $id, 'fmir', 'added,fmir(' . $id . ')', '', $this->session->userdata['ast_user']['user_id'], '');


            $status = $this->db->insert("fmir", $post);
            $insertId = $this->db->insert_id();
            $this->updateFmirHistory($insertId, 39, "");
            return $status;
        }
    }
    function get_unique_serial($ref_no)
    {
        $value = $this->db->query("SELECT sqn_req_serial_fn('" . $ref_no . "') as item")->result();
        foreach ($value as $key) {
            return $key->item;
        }
    }

    function updateFmirHistory($fmir_id, $status_id, $reason, $new_user = null)
    {
        $prev_user = null;
        if ($new_user) {
            $this->db->select("*")->from("fmir")->where('id', $fmir_id);
            $result = $this->db->get()->row();
            $prev_user = $result->assigned_user;
        }

        $data = array(
            "module_id" => $fmir_id,
            "operation_by" => $this->session->userdata['ast_user']['user_id'],
            "operation_dt" => date('Y-m-d h:i:s', time()),
            "activities_id" => $status_id,
            "reason" => $reason,
            "new_user" => $new_user,
            "prev_user" => $prev_user
        );


        return $this->db->insert("fmir_history", $data);
    }
}
