<?php
class Terget_setup_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    function get_grid_data($filterscount, $sortdatafield, $sortorder, $limit, $offset)
    {
        $i = 0;
        $where2 = "ts.sts!='0'";



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

                 if ($filterdatafield == 'status_name') {
                    $filterdatafield = 'rs.name';
                }  else {
                    $filterdatafield = 'ts.' . $filterdatafield;
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
            $sortdatafield = "ts.id";
            $sortorder = "DESC";
        }




        //concat(u.name ,u.user_id)
        $this->db
            ->select('SQL_CALC_FOUND_ROWS ts.*, rs.name as status_name,
             ts.year,ts.v_sts,ts.id as terget_id ', FALSE)

            ->from("terget_setup ts")
            ->join('ref_status as rs', 'ts.v_sts=rs.id', 'left')

            ->where($where)
            ->where($where2)
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

    function getInfo($id)
    {
        return  $this->db->select('year,suit_file_ids,v_sts ')->from("terget_setup")->where('id', $id)->get()->row();
    }
    function getSuitSearchResult()
    {
        $str_where = "c.sts<>0 AND c.suit_sts=75 AND c.final_remarks=1";

        
        if (trim($this->input->post('proposed_type')) != '') {
            $str_where .= " AND c.proposed_type=" . $this->db->escape(trim($this->input->post('proposed_type')));
        }
        if (trim($this->input->post('proposed_type')) != '' && trim($this->input->post('loan_ac')) != '') {
            if (trim($this->input->post('proposed_type')) == 'Investment') {
                $str_where .= " AND c.loan_ac='" . trim($this->input->post('loan_ac')) . "'";
            } else {
                $str_where .= " AND c.org_loan_ac='" . $this->Common_model->stringEncryption('encrypt', $this->input->post('hidden_loan_ac')) . "'";
            }
        }
        if (trim($this->input->post('req_type')) != '') {
            $str_where .= " AND c.req_type=" . $this->db->escape(trim($this->input->post('req_type')));
        }
        if (trim($this->input->post('case_number')) != '') {
            $str_where .= " AND c.case_number='" . trim($this->input->post('case_number')) . "'";
        }

        if ($this->input->post('action_type') == "add") {
            $str_where .= " AND c.terget_setup_id IS NULL ";
        }

        //$str_where .= " AND ( c.org_loan_ac IS NOT NULL  AND c.loan_ac IS NOT NULL) ";

        $suit_row = $this->db->query("SELECT r.name as req_type,c.case_number,c.id,c.loan_ac,c.ac_name
			FROM suit_filling_info as c 
			LEFT OUTER JOIN ref_req_type r on(c.req_type=r.id)
			WHERE " . $str_where . "")->result();
        return $suit_row;
    }

    function add_edit_tergetSetup($data)
    {

        $year = $this->input->post('year');
        $checkBoxList = $this->input->post("checkBoxList");

        if ($this->input->post('action_type') == "add") {


            $data = array(
                "v_sts" => 39, //39 refers to added to //ref_status
                "sts" => 1,
                'e_by' => $this->session->userdata['ast_user']['user_id'],
                "e_dt" => date('Y-m-d h:i:s a', time()),
                "year" => $year,
                "suit_file_ids" => $checkBoxList
            );

            $this->db->insert("terget_setup", $data);
            $insertedId = $this->db->insert_id();
            foreach (json_decode($checkBoxList) as $check) {
                $suitData[] = array(
                    "id" => $check,
                    "terget_setup_id" => $insertedId
                );
            }
            //after inserting into terget setup then update each suit filing info with terget setup  id
            $this->db->update_batch('suit_filling_info', $suitData, 'id');

            $this->user_model->user_activities(39, 'terget_setup', $insertedId, 'terget_setup', 'added(' . $insertedId . ')', '', $this->session->userdata['ast_user']['user_id'], '');
        } else if ($this->input->post('action_type') == "edit") {



            $data= array(
                'terget_setup_id' =>'0',
            );

            $this->db->where('terget_setup_id', $_POST['id']);
            $this->db->update("suit_filling_info", $data);



            // Edit Terget File 


            $data = array(
                "v_sts" => 35, //35 refers to updated to //ref_status
                'u_by' => $this->session->userdata['ast_user']['user_id'],
                "u_dt" => date('Y-m-d h:i:s a', time()),
                "year" => $year,
                "suit_file_ids" => $checkBoxList
            );

            $this->db->where('id', $_POST['id']);
            $this->db->update("terget_setup", $data);

            $insertedId = $_POST['id'];

            foreach (json_decode($checkBoxList) as $check) {
                $suitData[] = array(
                    "id" => $check,
                    "terget_setup_id" => $insertedId
                );
            }

            $this->db->update_batch('suit_filling_info', $suitData, 'id');

            $this->user_model->user_activities(39, 'terget_setup', $insertedId, 'terget_setup', 'added(' . $insertedId . ')', '', $this->session->userdata['ast_user']['user_id'], '');
            return $status = 200;
        }
    }
    function checkYear($year)
    {
        $data = $this->db->select("year")->from("terget_setup")->where("year", $year)->get()->row();
        if ($data)
            return true;
        else
            return false;
    }
    function get_details($id)
    {
        if ($id != '') {
            $this->db->select("j0.year,j0.suit_file_ids,j3.id,
            DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt", FALSE)
                ->from('terget_setup AS j0')

                ->join('suit_filling_info as j3', 'j0.id=j3.terget_setup_id', 'left')

                ->where("j0.sts='1'", NULL, FALSE)
                ->where(array('j0.id' => $id, 'j0.sts' => 1));
                $q = $this->db->get();
                $result = $q->row();

                $html = '';
                $html .= '<table style="width: 100%;" class="preview_table2" >
                    <tr>
                        <th width="20%" align="left"><strong>Year:</strong></th>
                        <td width="30%" align="left">' . $result->year . '</td>
                    </tr>
                    <tr>
                        <th width="20%" align="left"><strong>Entry Date:</strong></th>
                        <td width="30%" align="left">' . $result->e_dt . '</td>
                    </tr>
                
                    
                    
                </table>';

                    return $html;


        
        }
    }
    function delete_action()
    {

        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $table_name = "terget_setup";




        if ($this->input->post('type') == 'delete') {

            $pre_action_result = $this->Common_model->get_pre_action_data($table_name, $_POST['deleteEventId'], 0, 'sts');
            if (count($pre_action_result) > 0)
            {
                return 'taken';
            } else {
                $data = array(
                    'd_reason' => trim($_POST['comments']),
                    'sts' => 0,
                    'd_by' => $this->session->userdata['ast_user']['user_id'],
                    'd_dt' => date('Y-m-d H:i:s'),
                    'v_sts' => 3
                );

                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update($table_name, $data);
                $row_id = $_POST['deleteEventId'];



                $data= array(
                    'terget_setup_id' =>'0',
                );
    
                $this->db->where('terget_setup_id', $row_id);
                $this->db->update("suit_filling_info", $data);
    
    

            }
        }

        else if ($this->input->post('type') == 'sendtochecker') {

                $data = array(
                    'stc_by' => $this->session->userdata['ast_user']['user_id'],
                    'stc_dt' => date('Y-m-d H:i:s'),
                    'v_sts' => 37,
                );
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update($table_name, $data);
                $row_id= $_POST['verifyid'];

            
        }

       else  if ($this->input->post('type') == 'approve') {

            $data = array(
                'v_dt' => date('Y-m-d H:i:s'),
                'v_by' => $this->session->userdata['ast_user']['user_id'],
                'v_sts' => 38,
            );
            $this->db->where('id', $_POST['verifyid']);
            $this->db->update($table_name, $data);
            $row_id= $_POST['verifyid'];

        }




        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->db->db_debug = $db_debug;
            return 0;
        } else {
            $this->db->trans_commit();
            $this->db->db_debug = $db_debug;
            return $row_id;
        }
    }

}
