<?php
class Hoops_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }



    function get_grid_data($filterscount, $sortdatafield, $sortorder, $limit, $offset)
    {
        $i = 0;
        $where2 = "b.sts!='0' and b.life_cycle IN(3,4)";
        //$where2.=' AND b.cma_sts<>12 AND b.cma_sts<>5 ';

        if ($this->input->get('type') == 'Pending') {
            $where2 .= " AND b.deliver_by IS NULL AND b.cma_sts<>76";
        } else if ($this->input->get('type') == 'Executed') {
            $where2 .= " AND b.deliver_by IS NOT NULL ";
        }
        if ($this->input->get('req_type') != '') {
            $where2 .= " AND b.req_type = " . $this->db->escape(trim($this->input->get('req_type')));
        }
        if ($this->input->get('portfolio') != '' && $this->input->get('portfolio') != 0) {
            $where2 .= " AND b.loan_segment = " . $this->db->escape(trim($this->input->get('portfolio')));
        }

        if ($this->input->get('proposed_type') != '') {
            $where2 .= " AND b.proposed_type=" . $this->db->escape(trim($this->input->get('proposed_type')));
        }
        if ($this->input->get('loan_ac') != '') {
            if ($this->input->get('proposed_type') == 'Card') {
                $card = $this->Common_model->stringEncryption('encrypt', $this->security->xss_clean($this->input->get('hidden_loan_ac')));
                $where2 .= " AND b.org_loan_ac = '" . $card . "'";
            } else {
                if ($this->input->get('loan_ac') != '' && $this->input->get('loan_ac') != 0) {
                    $where2 .= " AND b.loan_ac = '" . trim($this->input->get('loan_ac')) . "'";
                }
            }
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

                if ($filterdatafield == 'loan_ac') {
                    $filterdatafield = 'b.loan_ac';
                } else if ($filterdatafield == 'sl_no') {
                    $filterdatafield = 'b.sl_no';
                } else if ($filterdatafield == 'ac_name') {
                    $filterdatafield = 'b.ac_name';
                } else if ($filterdatafield == 'cl_bbl') {
                    $filterdatafield = 'b.cl_bbl';
                } else if ($filterdatafield == 'int_rate') {
                    $filterdatafield = 'b.int_rate';
                } else if ($filterdatafield == 'branch') {
                    $filterdatafield = 'bs.name';
                } else if ($filterdatafield == 'loan_segment') {
                    $filterdatafield = 's.name';
                } else if ($filterdatafield == 'request_type_name') {
                    $filterdatafield = 'j1.name';
                } else if ($filterdatafield == 'zone_name') {
                    $filterdatafield = 'j7.name';
                } else if ($filterdatafield == 'district_name') {
                    $filterdatafield = 'j9.name';
                } else if ($filterdatafield == 'e_dt') {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(b.e_dt,'%d-%b-%y %h:%i %p')";
                } else if ($filterdatafield == 'stc_dt') {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(b.stc_dt,'%d-%b-%y %h:%i %p')";
                } else if ($filterdatafield == 'sth_dt') {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(b.sth_dt,'%d-%b-%y %h:%i %p')";
                } else if ($filterdatafield == 'v_dt') {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(b.v_dt,'%d-%b-%y %h:%i %p')";
                } else if ($filterdatafield == 'deliver_dt') {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(b.deliver_dt,'%d-%b-%y %h:%i %p')";
                } else if ($filterdatafield == 'rec_dt') {
                    //$filterdatafield='b.rec_dt';
                    $filterdatafield = "DATE_FORMAT(b.rec_dt,'%d-%b-%y %h:%i %p')";
                } else if ($filterdatafield == 'legal_ack_dt') {
                    $filterdatafield = "DATE_FORMAT(b.legal_ack_dt,'%d-%b-%y %h:%i %p')";
                } else if ($filterdatafield == 'status') {
                    $filterdatafield = 'j6.name';
                } else if ($filterdatafield == 'ho_return_reason') {
                    $filterdatafield = 'b.ho_return_reason';
                }

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
                if ($filterdatafield == 'e_by') {
                    $where .= " (j2.name LIKE '%" . $filtervalue . "%' OR j2.user_id LIKE '%" . $filtervalue . "%') ";
                } else if ($filterdatafield == 'stc_by') {
                    $where .= " (j4.name LIKE '%" . $filtervalue . "%' OR j4.user_id LIKE '%" . $filtervalue . "%') ";
                } else if ($filterdatafield == 'sth_by') {
                    $where .= " (j13.name LIKE '%" . $filtervalue . "%' OR j13.user_id LIKE '%" . $filtervalue . "%') ";
                } else if ($filterdatafield == 'v_by') {
                    $where .= " (j14.name LIKE '%" . $filtervalue . "%' OR j14.user_id LIKE '%" . $filtervalue . "%') ";
                } else if ($filterdatafield == 'rec_by') {
                    $where .= " (j5.name LIKE '%" . $filtervalue . "%' OR j5.user_id LIKE '%" . $filtervalue . "%') ";
                } else if ($filterdatafield == 'deliver_by') {
                    $where .= " (dv.name LIKE '%" . $filtervalue . "%' OR dv.user_id LIKE '%" . $filtervalue . "%') ";
                } else if ($filterdatafield == 'legal_ack_by') {
                    $where .= " (lac.name LIKE '%" . $filtervalue . "%' OR lac.user_id LIKE '%" . $filtervalue . "%') ";
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
        //  $where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
        // }

        if ($sortorder == '') {
            $sortdatafield = "b.id";
            $sortorder = "DESC";
            // $sortdatafield="j6.s_order";        
            // $sortorder = "ASC";               
        }
        if ($this->session->userdata['ast_user']['user_work_group_id'] == '18') //For HOOPS
        {
            $where2 .= "AND b.hoops_user in(" . $this->session->userdata['ast_user']['user_id'] . ")";
        }
        $this->db
            ->select('SQL_CALC_FOUND_ROWS b.*,CONCAT(bs.name,"(",bs.code,")") as branch,A.other_ac,j6.name as status,j7.name as zone_name,
        j9.name as district_name,s.name as loan_segment,
        j1.name as request_type_name,
        CONCAT(j2.name," (",j2.user_id,")")as e_by,
        CONCAT(j13.name," (",j13.user_id,")")as sth_by,
        CONCAT(j14.name," (",j14.user_id,")")as v_by,
        CONCAT(j4.name," (",j4.user_id,")")as stc_by,
        CONCAT(j5.name," (",j5.user_id,")")as rec_by,
        CONCAT(dv.name," (",dv.user_id,")")as deliver_by,
        CONCAT(lac.name," (",lac.user_id,")")as legal_ack_by,
        DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(b.legal_ack_dt,"%d-%b-%y %h:%i %p") AS legal_ack_dt,
        DATE_FORMAT(b.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
        DATE_FORMAT(b.deliver_dt,"%d-%b-%y %h:%i %p") AS deliver_dt,
        DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,
        DATE_FORMAT(b.sth_dt,"%d-%b-%y %h:%i %p") AS sth_dt,
        DATE_FORMAT(b.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
        ', FALSE)
            ->from("cma b")
            ->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
            ->join('users_info as j2', 'b.e_by=j2.id', 'left')
            ->join('users_info as j4', 'b.stc_by=j4.id', 'left')
            ->join('users_info as j5', 'b.rec_by=j5.id', 'left')
            ->join('users_info as dv', 'b.deliver_by=dv.id', 'left')
            ->join('users_info as lac', 'b.legal_ack_by=lac.id', 'left')
            ->join('ref_status as j6', 'b.cma_sts=j6.id', 'left')
            ->join('ref_zone as j7', 'b.zone=j7.id', 'left')
            ->join('ref_district as j9', 'b.case_fill_dist=j9.id', 'left')
            ->join('users_info as j12', 'b.legal_user=j12.id', 'left')
            ->join('users_info as j13', 'b.sth_by=j13.id', 'left')
            ->join('users_info as j14', 'b.v_by=j14.id', 'left')
            ->join('users_info as j15', 'b.hoops_user=j15.id', 'left')
            ->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
            ->join('ref_branch_sol as bs', 'b.branch_sol=bs.code', 'left')
            ->join('(SELECT f.cma_id,GROUP_CONCAT(IF(c.loan_ac<>f.ac_number,f.ac_number,NULL)  ORDER BY f.id ASC SEPARATOR ", " ) AS other_ac
                FROM cma_facility f 
                LEFT OUTER JOIN cma c ON(f.cma_id=c.id)
                WHERE f.sts<>0 
                GROUP BY f.cma_id) A', 'b.id=A.cma_id', 'left')
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
        return $result;
    }
    function get_add_action_data($id)
    {
        $this->db
            ->select("b.*", FALSE)
            ->from("cma b")
            ->where("b.sts='1' and b.id='" . $id . "'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_data_by_loan_ac($loan_ac, $type, $req_type)
    {
        if ($loan_ac != '' && $req_type != '') {
            if ($type == 'Investment') {
                $where = "WHERE (b.cma_sts='59' or b.cma_sts='60') and b.loan_ac='" . $loan_ac . "' AND b.req_type='" . $req_type . "'";
            } else {
                $ac = str_replace(' ', '', $this->Common_model->stringEncryption('encrypt', $loan_ac));
                $where = "WHERE (b.cma_sts='59' or b.cma_sts='60') and b.org_loan_ac='" . $ac . "' AND b.req_type='" . $req_type . "'";
            }
            $str = "SELECT b.loan_ac,b.zone,b.cma_sts,b.id,b.generated_statement
                FROM cma as b
                " . $where . " AND b.migration_sts<>1 ORDER BY id DESC LIMIT 1";
            $q = $this->db->query($str);
            if ($q->num_rows() > 0) {
                return $q->row();
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    function get_cma_data($proposed_type, $req_type, $loan_ac)
    {
        if ($proposed_type == 'Investment') {
            $where = "WHERE b.loan_ac='" . $loan_ac . "'";
        } else {
            $where = "WHERE b.org_loan_ac='" . $loan_ac . "'";
        }
        $str = "SELECT IF(b.proposed_type='Investment',b.loan_ac,b.org_loan_ac) as loan_ac,b.zone,b.cma_sts,b.id,b.int_rate
            FROM cma as b
            " . $where . " AND b.proposed_type='" . $proposed_type . "' AND b.sts='1' AND b.cma_sts NOT IN (5,12) AND b.req_type='" . $req_type . "' ORDER BY id DESC LIMIT 1";
        $q = $this->db->query($str);
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return array();
        }
    }
    function get_data_by_pin($pin, $zone)
    {
        $link_id = '227';
        //AND zone=".$this->db->escape($zone)."
        $where = "b.user_id='" . $pin . "'  AND j1.menu_link_id=" . $this->db->escape($link_id) . "";
        $this->db->select('b.id', FALSE)
            ->from("users_info b")
            ->join('users_right as j1', 'b.id=j1.user_info_id', 'left')
            ->where($where)
            ->order_by('b.id', 'DESC')
            ->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return array();
        }
    }
    function get_generated_statement_file($id)
    {
        $this->db->select('IF(b.proposed_type="Loan",b.loan_ac,b.org_loan_ac) as loan_ac,b.loan_ac as org_loan_ac,b.int_rate,b.cif,b.generated_statement,b.libality_statement,j1.name as req_type,b.ac_name,b.proposed_type', FALSE)
            ->from("cma b")
            ->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
            ->where("b.id='" . $id . "'")
            ->order_by('b.id', 'DESC')
            ->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return array();
        }
    }
    function get_loan_data($id)
    {
        $this->db->select('b.ac_number as loan_ac,b.int_rate,b.ac_name', FALSE)
            ->from("cma_facility b")
            ->where("b.id='" . $id . "'")
            ->order_by('b.id', 'DESC')
            ->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return array();
        }
    }
    function get_card_data($id)
    {
        $this->db->select('b.org_card_no as loan_ac,b.card_no,b.card_name', FALSE)
            ->from("sub_card_data b")
            ->where("b.id='" . $id . "'")
            ->order_by('b.id', 'DESC')
            ->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return array();
        }
    }
    function get_generated_statement_data($id)
    {
        if ($id != '') {
            $str = " SELECT g.*
            FROM statement_data g
            WHERE g.cma_id= " . $this->db->escape($id) . " AND g.Session_Id='" . $this->session->userdata['ast_user']['user_id'] . "' ORDER BY g.date ASC";
            $query = $this->db->query($str);
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_generated_statement_data_by_ac($loan_ac)
    {
        if ($loan_ac != '') {
            $str = " SELECT g.*
            FROM statement_data g
            WHERE g.loan_ac= '" . $loan_ac . "' AND g.Session_Id='" . $this->session->userdata['ast_user']['user_id'] . "' ORDER BY g.date ASC";
            $query = $this->db->query($str);
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_recovery_data($loan_ac, $year, $month)
    {
        if ($loan_ac != '') {
            $str = " SELECT r.*
            FROM recovery_data r
            WHERE r.sts=1 AND r.loan_ac= '" . $loan_ac . "' AND YEAR(r.trans_date) =" . $year . " AND MONTH(r.trans_date) = " . $month . "";
            $query = $this->db->query($str);
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_recovery_jari_data($loan_ac, $year, $month)
    {
        if ($loan_ac != '') {
            $str = " SELECT r.*
            FROM jari_recovery_data_cbs r
            WHERE r.loan_ac= '" . $loan_ac . "' AND YEAR(r.date) =" . $this->db->escape($year) . " AND MONTH(r.date) = " . $month . "";
            $query = $this->db->query($str);
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_recovery_data_by_batch($from_dt, $to_dt)
    {
        if ($from_dt != '') {
            $where = 'r.sts=1';
            if ($from_dt != '' && $to_dt != 0 && ($to_dt == '' || $to_dt == 0)) {
                $where .= " AND DATE(r.e_dt) ='" . implode('-', array_reverse(explode('/', trim($from_dt)))) . "'";
            }
            if ($from_dt != '' && $from_dt != 0 && $to_dt != '' && $to_dt != 0) {
                $where .= " AND DATE(r.e_dt) >= '" . implode('-', array_reverse(explode('/', trim($from_dt)))) . "' AND DATE(r.e_dt) <= '" . implode('-', array_reverse(explode('/', trim($to_dt)))) . "'";
            }

            $str = " SELECT r.*,CONCAT(u.name,' (',u.user_id,')')as e_by,DATE_FORMAT(r.e_dt,'%d-%b-%y %h:%i %p') AS e_dt
            FROM recovery_data r
            LEFT OUTER JOIN users_info as u on (u.id=r.e_by)
            WHERE  $where GROUP BY r.batch_no ORDER BY r.id DESC";
            $query = $this->db->query($str);
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_recovery_details_by_batch($batch)
    {
        if ($batch != '') {
            $str = " SELECT r.*,DATE_FORMAT(r.trans_date,'%d-%b-%Y') AS trans_date,IF(r.ac_type='Investment',r.loan_ac,r.card_no)as loan_ac,
            CONCAT(u.name,' (',u.user_id,')')as e_by,DATE_FORMAT(r.e_dt,'%d-%b-%y %h:%i %p') AS e_dt
            FROM recovery_data r
            LEFT OUTER JOIN users_info as u on (u.id=r.e_by)
            WHERE  r.sts=1 AND r.batch_no=" . $this->db->escape($batch);
            $query = $this->db->query($str);
            return $query->result();
        } else {
            return NULL;
        }
    }
    function get_file_name($field_name, $path)
    {
        //Deleteng old file when no new file selected
        if (isset($_POST['file_delete_value_' . $field_name]) && $_POST['file_delete_value_' . $field_name] == '1' && $_POST['hidden_' . $field_name . '_select'] == '0') {
            $delete_path = $path . $_POST['hidden_' . $field_name . '_value'];
            //chmod($path, 0777);
            unlink($delete_path);
            $file = "";
        } //Deleteng old file and new file selected
        else if (isset($_POST['file_delete_value_' . $field_name]) && $_POST['file_delete_value_' . $field_name] == '1' && $_POST['hidden_' . $field_name . '_select'] == '1') {
            $delete_path = $path . $_POST['hidden_' . $field_name . '_value'];
            //chmod($path, 0777);
            unlink($delete_path);
            $file = $this->Common_model->get_file_name('statement', $field_name, $path);
        } //Taking Old File
        else if (isset($_POST['hidden_' . $field_name . '_value']) && $_POST['hidden_' . $field_name . '_select'] == '0') {
            $file = $_POST['hidden_' . $field_name . '_value'];
        } //Taking Full New File
        else {
            $file = $this->Common_model->get_file_name('statement', $field_name, $path);
        }
        return $file;
    }
    function get_statement_file_name($module_name, $data_field_name, $upload_path, $file_name)
    {
        $str = "select * from temp_upload_file where module_name='$module_name' and New_file_name='$file_name' and data_field_name='$data_field_name' and Session_Id='" . $this->session->userdata['ast_user']['user_id'] . "'";
        //$query=$this->db->query($str);
        $result = $this->db->query($str)->row();
        if ($result != '') {
            if (!empty($result)) {
                copy(FCPATH . 'temp_upload_file/' . $result->New_file_name, FCPATH . $upload_path . $result->New_file_name);
                return $result->New_file_name;
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    function getAllLaywer()
    {
        return $this->db->select("id,name")->from('ref_lawyer')->where("data_status", 1)->get()->result();
    }
    function delete_action($id = NULL, $bulk = NULL, $type = NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if ($this->input->post('type') == 'deliver') {


            // $pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'60','cma_sts');
            // if (count($pre_action_result)>0) 
            // {
            //     return 'taken';
            // }
            // else
            // {
            $uploaded_statement = $this->get_file_name('uploaded_statement', 'cma_file/uploaded_statement/');

            $data = array(
                'cma_sts' => 60,
                'lawyer' => $this->input->post('lawyer'),
                'legal_user' => $this->input->post('legal_user'),
                'uploaded_statement' => $uploaded_statement,
                'life_cycle' => 4,
                'deliver_by' => $this->session->userdata['ast_user']['user_id'],
                'st_belance' => $this->input->post('belance'),
                'st_belance_dt' => implode('-', array_reverse(explode('/', $this->input->post('belance_dt')))),
                'deliver_dt' => date('Y-m-d H:i:s')
            );
            if ($_POST['hidden_generated_file_value'] != '') {
                $statement_file = $this->get_statement_file_name('statement', 'generated_statement', 'cma_file/generated_statement/', $_POST['hidden_generated_file_value']);
                $data['generated_statement'] = $statement_file;
            }
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma', $data);
            //echo $this->db->last_query();
            $data2 = $this->user_model->user_activities(60, 'cma', $this->input->post('deleteEventId'), 'cma', 'File Deliver To Legal(' . $this->input->post('deleteEventId') . ')');
            // }

        }
        if ($this->input->post('type') == 'hold') {
            $data = array('cma_sts' => 101, 'hoops_hold_reason' => trim($_POST['hold_reason']), 'hoops_hold_by' => $this->session->userdata['ast_user']['user_id'], 'hoops_hold_dt' => date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma', $data);
            $data2 = $this->user_model->user_activities(101, 'cma', $this->input->post('deleteEventId'), 'cma', 'Hold CMA BY HOOPS(' . $this->input->post('deleteEventId') . ')', $_POST['hold_reason']);
        }
        if ($this->input->post('type') == 'recovery_delete') {
            $data = array(
                'sts' => 0,
                'd_by' => $this->session->userdata['ast_user']['user_id'],
                'd_dt' => date('Y-m-d H:i:s')
            );
            $this->db->where('batch_no', $_POST['deleteEventId']);
            $this->db->update('recovery_data', $data);
            $data2 = $this->user_model->user_activities(15, 'cma', $this->input->post('deleteEventId'), 'recovery_data', 'Delete Recovery Data');
        }
        if ($this->input->post('type') == 'save_statement') {
            $statement_file = $this->Common_model->get_file_name('statement', 'generated_statement', 'cma_file/generated_statement/');
            $lib_statement_file = $this->Common_model->get_file_name('statement', 'libality_statement', 'cma_file/generated_statement/');
            if ($_POST['prev_statement'] != '') {
                $old_path = "./cma_file/generated_statement/" . $_POST['prev_statement'];
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }
            if ($_POST['prev_lib_statement'] != '') {
                $old_path = "./cma_file/generated_statement/" . $_POST['prev_lib_statement'];
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }
            $data = array(
                'generated_statement' => $statement_file,
                'libality_statement' => $lib_statement_file,
                'st_generate_by' => $this->session->userdata['ast_user']['user_id'],
                'st_genereate_dt' => date('Y-m-d H:i:s')
            );
            $str = " SELECT r.id
            FROM suit_filling_info r
            WHERE  r.sts=1 AND r.cma_id=" . $_POST['deleteEventId'] . "";
            $query = $this->db->query($str);
            $suit_data = $query->result();
            if (empty($suit_data)) //Checking Suit File added or not
            {
                $data['st_belance'] = $_POST['final_belance'];
                $data['st_belance_dt'] = $_POST['final_dt'];
            }
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma', $data);
            $data2 = $this->user_model->user_activities(72, 'cma', $this->input->post('deleteEventId'), 'cma', 'Statement Generate(' . $this->input->post('deleteEventId') . ')');
        }
        if ($this->input->post('type') == 'bulk_deliver') {
            for ($i = 1; $i <= $_POST['total_row']; $i++) {
                if ($_POST['event_id_' . $i] != 0 && $_POST['event_id_' . $i] != 'ignored') {
                    $pre_action_result = $this->Common_model->get_pre_action_data('cma', $_POST['event_id_' . $i], '60', 'cma_sts');
                    if (count($pre_action_result) > 0) {
                        return 'taken';
                    } else {
                        $data = array(
                            'cma_sts' => 60,
                            'legal_user' => $this->input->post('user_id_' . $i),
                            'life_cycle' => 4,
                            'deliver_by' => $this->session->userdata['ast_user']['user_id'],
                            'st_belance' => $this->input->post('st_belance_' . $i),
                            'st_belance_dt' => $this->input->post('st_belance_dt_' . $i),
                            'deliver_dt' => date('Y-m-d H:i:s')
                        );
                        $this->db->where('id', $_POST['event_id_' . $i]);
                        $this->db->update('cma', $data);
                        $data2 = $this->user_model->user_activities(60, 'cma', $_POST['event_id_' . $i], 'cma', 'File Deliver To Legal(' . $_POST['event_id_' . $i] . ')');
                    }
                }
            }
        }
        if ($this->input->post('type') == 'save_recovery') {
            $data = array();
            $e_dt = date('Y-m-d H:i:s');
            $e_by = $this->session->userdata['ast_user']['user_id'];
            $batch_no = time();
            for ($i = 1; $i <= $_POST['total_row']; $i++) {
                if ($this->input->post('A_' . $i) == 'Investment') {
                    $ac = $this->input->post('B_' . $i); //for loan ac number
                    $card_no = '';
                } else {
                    $ac = $this->Common_model->stringEncryption('encrypt', $this->input->post('B_' . $i)); //for Card number
                    $card_no = substr($this->input->post('B_' . $i), 0, 6) . "******" . substr($this->input->post('B_' . $i), 12, 16);
                }
                $narration = $this->Common_model->get_narration_data();
                $array = array(
                    'ac_type' => $this->input->post('A_' . $i),
                    'loan_ac' => $ac,
                    'card_no' => $card_no,
                    'narration' => $narration->str,
                    'amount' => $this->input->post('C_' . $i),
                    'trans_date' => $this->input->post('D_' . $i),
                    'batch_no' => $batch_no,
                    'e_by' => $e_by,
                    'e_dt' => $e_dt
                );
                array_push($data, $array);
            }
            $this->db->insert_batch('recovery_data', $data);
            $data2 = $this->user_model->user_activities(56, 'cma', '', 'recovery_data', 'Upload Recovery Data');
        }
        if (isset($_POST['type']) && $this->input->post('type') == 'closeaccount') {
            $pre_action_result = $this->Common_model->get_pre_action_data('cma', $_POST['deleteEventId'], '76', 'cma_sts');
            if (count($pre_action_result) > 0) {
                return 'taken';
            } else {
                $close_account_file = $this->get_file_name('close_account_file', 'cma_file/close_account_file/');
                $data = array('cma_sts' => 76, 'close_account_file' => $close_account_file, 'file_close_remarks' => $_POST['close_account_remarks'], 'file_close_by' => $this->session->userdata['ast_user']['user_id'], 'file_close_dt' => date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma', $data);
                $data3 = $this->user_model->user_activities(76, 'cma', $this->input->post('deleteEventId'), 'cma', 'Account Closed by Hoops(' . $this->input->post('deleteEventId') . ')', $_POST['close_account_remarks']);
            }
            $id = $_POST['deleteEventId'];
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

    function get_report_data()
    {
        $ToDate = implode('-', array_reverse(explode('/', $this->input->post($this->input->post('ToDate')))));
        $FromDate = implode('-', array_reverse(explode('/', $this->input->post($this->input->post('FromDate')))));
        $appFromDate = implode('-', array_reverse(explode('/', $this->input->post($this->input->post('appFromDate')))));
        $appToDate = implode('-', array_reverse(explode('/', $this->input->post($this->input->post('appToDate')))));
        $zone_id = trim($this->input->post('zone_id'));
        $status_id = trim($this->input->post('status_id'));
        $district = trim($this->input->post('district'));
        $limit = trim($this->input->post('limit'));
        $proposed_type = trim($this->input->post('proposed_type'));

        $where = 'j0.sts=1 AND j0.cma_sts<>12 AND j0.cma_sts<>5 AND j0.deliver_by IS NULL ';
        if ($ToDate != '' && $FromDate != '') {

            $where .= ' and DATE(j0.e_dt) between ' . $this->db->escape($FromDate) . ' 
               and "' . $ToDate . '"  ';
        }
        if ($appToDate != '' && $appFromDate != '') {
            $where .= ' and DATE(j0.rec_dt) between ' . $this->db->escape($appFromDate) . ' 
               and "' . $appToDate . '"  ';
        }
        if ($proposed_type != '') {
            $where .= ' and j0.proposed_type=' . $this->db->escape($proposed_type) . ' ';
        }
        if ($zone_id != 0) {
            $where .= ' and j0.zone=' . $this->db->escape($zone_id) . ' ';
        }
        if ($district != '') {
            $where .= ' and j0.district=' . $this->db->escape($district) . ' ';
        }
        if ($status_id != 0) {
            $where .= ' and j0.cma_sts=' . $this->db->escape($status_id) . ' ';
        }

        $this->db->select("j0.*,a.complete_remarks,a.auction_sign_memo,j0.lawyer as lawyer_id,j0.sec_sts as sec_sts_id,a.auction_date,a.paper_date,a.auction_time,a.auction_address,a.paper_remarks,a.paper_name,a.paper_vendor,a.lawyer,a.ln_serve_dt,a.ln_expiry_dt,a.ln_scan_copy,a.legal_checker_id,auc.name as pre_auc_sts,a.auction_sts,j0.cma_sts as sts,j15.name as cma_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
                j1.name as zone_name,j3.name as district_name,
                j29.name as busi_sts,j30.name as borr_sts,j31.name as case_logic,j32.name as chq_sts,j28.name as sec_sts,
                cs.name as pre_case_sts,j26.name as pre_case_type,j27.name as disposal_sts,
                j6.name as subject_name,j7.name as loan_segment,j8.name as e_by,
                j34.name as lawyer_name,DATE_FORMAT(a.ln_serve_dt,'%d-%b-%y') AS ln_serve_dt_format,
                DATE_FORMAT(a.ln_expiry_dt,'%d-%b-%y') AS ln_expiry_dt_format,j38.name as paper_vendor,
                j46.name as lawyer_legal,j0.req_type as requisition,
                j39.name as paper_name,j47.name as case_file_district,
                CONCAT(j33.name,' (',j33.user_id,')') as st_auch_by,
                CONCAT(j9.name,' (',j9.user_id,')') as stc_by,
                CONCAT(j10.name,' (',j10.user_id,')') as rec_by,
                CONCAT(j14.name,' (',j14.user_id,')') as r_by,
                CONCAT(j16.name,' (',j16.user_id,')') as reject_by_rm,
                CONCAT(j17.name,' (',j17.user_id,')') as ack_by,
                CONCAT(j18.name,' (',j18.user_id,')') as hold_by,
                CONCAT(j19.name,' (',j19.user_id,')') as sth_by,
                CONCAT(j20.name,' (',j20.user_id,')') as q_by,
                CONCAT(j21.name,' (',j21.user_id,')') as ho_r_by,
                CONCAT(j22.name,' (',j22.user_id,')') as v_by,
                CONCAT(j23.name,' (',j23.user_id,')') as holm_r_by,
                CONCAT(j24.name,' (',j24.user_id,')') as ho_decline_by,
                CONCAT(j35.name,' (',j35.user_id,')') as auc_stc_by,
                CONCAT(j36.name,' (',j36.user_id,')') as auc_v_by,
                CONCAT(j37.name,' (',j37.user_id,')') as legal_response_by,
                CONCAT(j25.name,' (',j25.user_id,')') as auction_complete_by,
                CONCAT(j40.name,' (',j40.user_id,')') as auc_ack_by,
                CONCAT(j41.name,' (',j41.user_id,')') as auc_st_l_by,
                CONCAT(j42.name,' (',j42.user_id,')') as auc_comp_by,
                CONCAT(j43.name,' (',j43.user_id,')') as sthoops_by,
                CONCAT(j44.name,' (',j44.user_id,')') as deliver_by,
                CONCAT(j45.name,' (',j45.user_id,')') as legal_ack_by,
                CONCAT(j48.name,' (',j48.user_id,')') as reassigned_legal_user,
                CONCAT(j49.name,' (',j49.user_id,')') as reassign_by,
                DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,r.name as req_type,
                DATE_FORMAT(j0.loan_sanction_dt,'%d-%b-%y') AS loan_sanction_dt,
                DATE_FORMAT(j0.stc_dt,'%d-%b-%y %h:%i %p') AS stc_dt,
                DATE_FORMAT(a.stc_dt,'%d-%b-%y %h:%i %p') AS st_auch_dt,
                DATE_FORMAT(j0.pre_cma_app_dt,'%d-%b-%y') AS pre_cma_app_dt,
                DATE_FORMAT(j0.pre_case_fill_dt,'%d-%b-%y') AS pre_case_fill_dt,
                DATE_FORMAT(j0.last_payment_date,'%d-%b-%y') AS last_payment_date,
                DATE_FORMAT(j0.call_up_serv_dt,'%d-%b-%y') AS call_up_serv_dt,
                DATE_FORMAT(j0.return_dt_rm,'%d-%b-%y %h:%i %p') AS r_dt,
                DATE_FORMAT(j0.reject_dt_rm,'%d-%b-%y %h:%i %p') AS reject_dt_rm,
                DATE_FORMAT(j0.ack_dt,'%d-%b-%y %h:%i %p') AS ack_dt,
                DATE_FORMAT(j0.hold_dt,'%d-%b-%y %h:%i %p') AS hold_dt,
                DATE_FORMAT(j0.chq_expiry_date,'%d-%b-%y') AS chq_expiry_date,
                DATE_FORMAT(j0.sth_dt,'%d-%b-%y %h:%i %p') AS sth_dt,
                DATE_FORMAT(j0.q_dt,'%d-%b-%y %h:%i %p') AS q_dt,
                DATE_FORMAT(j0.ho_r_dt,'%d-%b-%y %h:%i %p') AS ho_r_dt,
                DATE_FORMAT(j0.v_dt,'%d-%b-%y %h:%i %p') AS v_dt,
                DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
                DATE_FORMAT(j0.holm_r_dt,'%d-%b-%y %h:%i %p') AS holm_r_dt,
                DATE_FORMAT(j0.ho_decline_dt,'%d-%b-%y %h:%i %p') AS ho_decline_dt,
                DATE_FORMAT(a.stc_dt,'%d-%b-%y %h:%i %p') AS auc_stc_dt,
                DATE_FORMAT(a.legal_response_dt,'%d-%b-%y %h:%i %p') AS legal_response_dt,
                DATE_FORMAT(a.auction_v_dt,'%d-%b-%y %h:%i %p') AS auction_v_dt,
                DATE_FORMAT(a.paper_date,'%d-%b-%y') AS paper_date,
                DATE_FORMAT(a.auction_date,'%d-%b-%y') AS auction_date,
                DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auc_ack_dt,
                DATE_FORMAT(a.auc_st_l_dt,'%d-%b-%y %h:%i %p') AS auc_st_l_dt,
                DATE_FORMAT(j0.sthoops_dt,'%d-%b-%y %h:%i %p') AS sthoops_dt,
                DATE_FORMAT(j0.deliver_dt,'%d-%b-%y %h:%i %p') AS deliver_dt,
                DATE_FORMAT(a.auction_complete_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
                TIME_FORMAT(a.auction_time,'%h:%i %p') AS auction_time,
                DATE_FORMAT(j0.legal_ack_dt,'%d-%b-%y %h:%i %p') AS legal_ack_dt,
                DATE_FORMAT(j0.ln_sent_date,'%d-%b-%y %h:%i %p') AS ln_sent_date,
                DATE_FORMAT(j0.ln_val_dt,'%d-%b-%y %h:%i %p') AS ln_val_dt,
                DATE_FORMAT(j0.ln_val_dt,'%d-%b-%y %h:%i %p') AS ln_val_dt,
                DATE_FORMAT(j0.legal_reassign_dt,'%d-%b-%y %h:%i %p') AS legal_reassign_dt", FALSE)
            ->from('cma as j0')
            ->join('ref_auc_sts as auc', 'j0.pre_auc_sts=auc.id', 'left')
            ->join('cma_auction as a', 'j0.id=a.cma_id', 'left')
            ->join("users_info as j25", "a.ack_by=j25.id", "left")
            ->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
            ->join("ref_zone as j1", "j0.zone=j1.id", "left")
            ->join("ref_district as j3", "j0.case_fill_dist=j3.id", "left")
            ->join("ref_subject_type as j6", "j0.sub_type=j6.id", "left")
            ->join("ref_loan_segment as j7", "j0.loan_segment=j7.code", "left")
            ->join("users_info as j8", "j0.e_by=j8.id", "left")
            ->join("users_info as j9", "j0.stc_by=j9.id", "left")
            ->join("users_info as j10", "j0.rec_by=j10.id", "left")
            ->join("users_info as j14", "j0.return_by_rm=j14.id", "left")
            ->join("ref_branch_sol as j13", "j0.branch_sol=j13.code", "left")
            ->join("ref_status as j15", "j0.cma_sts=j15.id", "left")
            ->join("users_info as j16", "j0.reject_by_rm=j16.id", "left")
            ->join("users_info as j17", "j0.ack_by=j17.id", "left")
            ->join("users_info as j18", "j0.hold_by=j18.id", "left")
            ->join("users_info as j19", "j0.sth_by=j19.id", "left")
            ->join("users_info as j20", "j0.q_by=j20.id", "left")
            ->join("users_info as j21", "j0.ho_r_by=j21.id", "left")
            ->join("users_info as j22", "j0.v_by=j22.id", "left")
            ->join("users_info as j23", "j0.holm_r_by=j23.id", "left")
            ->join("users_info as j24", "j0.ho_decline_by=j24.id", "left")
            ->join("ref_case_sts as cs", "j0.pre_case_sts=cs.id", "left")
            ->join("ref_req_type as j26", "j0.pre_case_type=j26.id", "left")
            ->join("ref_disposal_sts as j27", "j0.disposal_sts=j27.id", "left")
            ->join("ref_sec_sts as j28", "j0.sec_sts=j28.id", "left")
            ->join("ref_busi_sts as j29", "j0.busi_sts=j29.id", "left")
            ->join("ref_borr_sts as j30", "j0.borr_sts=j30.id", "left")
            ->join("ref_case_logic as j31", "j0.case_logic=j31.id", "left")
            ->join("ref_chq_sts as j32", "j0.chq_sts=j32.id", "left")
            ->join("users_info as j33", "a.stc_by=j33.id", "left")
            ->join("ref_lawyer as j34", "a.lawyer=j34.id", "left")
            ->join("users_info as j35", "a.stc_by=j35.id", "left")
            ->join("users_info as j36", "a.auction_v_by=j36.id", "left")
            ->join("users_info as j37", "a.legal_response_by=j37.id", "left")
            ->join("ref_paper_vendor as j38", "a.paper_vendor=j38.id", "left")
            ->join("ref_paper as j39", "a.paper_name=j39.id", "left")
            ->join("users_info as j40", "a.ack_by=j40.id", "left")
            ->join("users_info as j41", "a.auc_st_l_by=j41.id", "left")
            ->join("users_info as j42", "a.auction_complete_by=j42.id", "left")
            ->join("users_info as j43", "j0.sthoops_by=j43.id", "left")
            ->join("users_info as j44", "j0.deliver_by=j44.id", "left")
            ->join("users_info as j45", "j0.legal_ack_by=j45.id", "left")
            ->join("ref_lawyer as j46", "j0.lawyer=j46.id", "left")
            ->join("ref_district as j47", "j0.case_fill_dist=j47.id", "left")
            ->join("users_info as j48", "j0.temp_legal_user=j48.id", "left")
            ->join("users_info as j49", "j0.legal_reassign_by=j49.id", "left")
            ->where($where, NULL, FALSE);
        $this->db->order_by('j0.id', 'desc');
        $this->db->limit($limit);
        $result = $this->db->get()->result();
        return $result;
    }

    // XL all report 
    function get_all_report_data()
    {
        $where2 = "b.sts!='0' and b.life_cycle IN(3,4)";

        if ($this->input->post('current_status') != '') {
            if ($this->input->post('current_status') == 'Pending') {
                $where2 .= " AND b.deliver_by IS NULL AND b.cma_sts<>76";
            } else {
                $where2 .= " AND b.deliver_by IS NOT NULL ";
            }
        }
        if ($this->input->post('req_type') != '') {
            $where2 .= " AND b.req_type = " . $this->db->escape(trim($this->input->post('req_type')));
        }
        if ($this->input->post('portfolio') != '' && $this->input->post('portfolio') != 0) {
            $where2 .= " AND b.loan_segment = " . $this->db->escape(trim($this->input->post('portfolio')));
        }

        if ($this->input->post('proposed_type') != '') {
            $where2 .= " AND b.proposed_type = " . $this->db->escape(trim($this->input->post('proposed_type')));
        }
        if ($this->input->post('loan_ac') != '') {
            if ($this->input->post('proposed_type') == 'Card') {
                $card = $this->Common_model->stringEncryption('encrypt', $this->security->xss_clean($this->input->post('hidden_loan_ac')));
                $where2 .= " AND b.org_loan_ac = '" . $card . "'";
            } else {
                if ($this->input->post('loan_ac') != '' && $this->input->post('loan_ac') != 0) {
                    $where2 .= " AND b.loan_ac = " . $this->db->escape(trim($this->input->post('loan_ac')));
                }
            }
        }
        if ($this->session->userdata['ast_user']['user_work_group_id'] == '18') //For HOOPS
        {
            $where2 .= "AND b.hoops_user in(" . $this->session->userdata['ast_user']['user_id'] . ")";
        }
        $this->db->select('A.other_ac as more_acc_number,b.int_rate,b.cl_bbl,IF(b.deliver_by IS NULL,"Pending","Executed") as final_status,b.org_loan_ac,b.loan_ac,b.cif,b.branch_sol,b.spouse_name,b.current_address,b.mother_name,b.ac_name,b.proposed_type,b.sl_no,b.id,IF(b.cma_sts="60",CONCAT(j6.name," ",j12.name," (",j12.user_id,")"),IF(b.cma_sts="59",CONCAT(j6.name," "," (",j15.user_id,")"),j6.name)) as status,j7.name as zone_name,
        j9.name as district_name,s.name as loan_segment,
        j1.name as req_type,
        CONCAT(j2.name," (",j2.user_id,")")as e_by,
        CONCAT(j13.name," (",j13.user_id,")")as sth_by,
        CONCAT(j14.name," (",j14.user_id,")")as v_by,
        CONCAT(j4.name," (",j4.user_id,")")as stc_by,
        CONCAT(j5.name," (",j5.user_id,")")as rec_by,
        CONCAT(dv.name," (",dv.user_id,")")as deliver_by,
        CONCAT(lac.name," (",lac.user_id,")")as legal_ack_by,
        DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(b.deliver_dt,"%d-%b-%y %h:%i %p") AS deliver_dt,
        DATE_FORMAT(b.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
        DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,
        DATE_FORMAT(b.legal_ack_dt,"%d-%b-%y %h:%i %p") AS legal_ack_dt,
        DATE_FORMAT(b.sth_dt,"%d-%b-%y %h:%i %p") AS sth_dt,
        DATE_FORMAT(b.v_dt,"%d-%b-%y %h:%i %p") AS v_dt', FALSE)
            ->from("cma b")
            ->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
            ->join('users_info as j2', 'b.e_by=j2.id', 'left')
            ->join('users_info as dv', 'b.deliver_by=dv.id', 'left')
            ->join('users_info as lac', 'b.legal_ack_by=lac.id', 'left')
            ->join('users_info as j4', 'b.stc_by=j4.id', 'left')
            ->join('users_info as j5', 'b.rec_by=j5.id', 'left')
            ->join('ref_status as j6', 'b.cma_sts=j6.id', 'left')
            ->join('ref_zone as j7', 'b.zone=j7.id', 'left')
            ->join('ref_district as j9', 'b.case_fill_dist=j9.id', 'left')
            ->join('users_info as j12', 'b.legal_user=j12.id', 'left')
            ->join('users_info as j13', 'b.sth_by=j13.id', 'left')
            ->join('users_info as j14', 'b.v_by=j14.id', 'left')
            ->join('users_info as j15', 'b.hoops_user=j15.id', 'left')
            ->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
            ->join('(SELECT f.cma_id,GROUP_CONCAT(IF(c.loan_ac<>f.ac_number,f.ac_number,NULL)  ORDER BY f.id ASC SEPARATOR ", " ) AS other_ac
                FROM cma_facility f 
                LEFT OUTER JOIN cma c ON(f.cma_id=c.id)
                WHERE f.sts<>0 
                GROUP BY f.cma_id) A', 'b.id=A.cma_id', 'left')
            ->where($where2, NULL, FALSE);
        $this->db->order_by('b.id', 'desc');
        //$this->db->limit($limit);
        $result = $this->db->get()->result();
        return $result;
    }

    function get_report_data_lawyer_wise()
    {
        $zone_id = trim($this->input->post('zone_id'));
        $lawyer_id = trim($this->input->post('lawyer_id'));
        $district = trim($this->input->post('district'));
        $limit = trim($this->input->post('limit'));
        $proposed_type = trim($this->input->post('proposed_type'));

        $where = 'b.sts<>0';
        $where2 = 'b.sts<>0';
        if ($proposed_type != '') {
            $where .= ' and b.proposed_type=' . $this->db->escape($proposed_type);
        }
        if ($zone_id != 0) {
            $where .= ' and b.zone=' . $this->db->escape($zone_id);
            $where2 .= ' and b.zone=' . $this->db->escape($zone_id);
        }
        if ($district != '') {
            $where .= ' and b.district=' . $this->db->escape($district);
            $where2 .= ' and b.district=' . $this->db->escape($district);
        }

        if ($lawyer_id != 0) {
            $where .= ' and b.prest_lawyer_name=' . $this->db->escape($lawyer_id);
            $where2 .= ' and b.lawyer_name=' . $this->db->escape($lawyer_id);
        }
        $result = $this->db->query('SELECT b.loan_ac,
                b.ac_name,
                r.name as zone_name,
                d.name as district_name,
                CONCAT(bs.name,"(",bs.code,")") as branch_name,
                rq.name as suit_type,
                b.case_number,
                DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,
                IF(b.final_remarks=1,TIMESTAMPDIFF(MONTH, b.filling_date, CURDATE()),"Disposed") as aging,
                fr.name as current_status
                FROM 
                suit_filling_info b
                LEFT OUTER JOIN ref_zone as r on(b.zone=r.id)
                LEFT OUTER JOIN ref_district as d on(b.district=d.id)
                LEFT OUTER JOIN ref_branch_sol as bs on(b.branch_sol=bs.code)
                LEFT OUTER JOIN ref_req_type as rq on(b.req_type=rq.id)
                LEFT OUTER JOIN ref_final_remarks as fr on(b.final_remarks=fr.id)
                WHERE '.$where.'
                UNION ALL
                SELECT b.account_number as loan_ac,
                b.account_name as ac_name,
                r.name as zone_name,
                "" as district_name,
                CONCAT(bs.name,"(",bs.code,")") as branch_name,
                rq.name as suit_type,
                CONCAT(b.case_number) as case_number,
                DATE_FORMAT(b.case_filing_date,"%d-%b-%y") AS filling_date,
                IF(b.final_remarks=1,TIMESTAMPDIFF(MONTH, b.case_filing_date, CURDATE()),"Disposed") as aging,
                fr.name as current_status
                FROM 
                hc_ad_matters b
                LEFT OUTER JOIN ref_zone as r on(b.zone=r.id)
                LEFT OUTER JOIN ref_district as d on(b.district=d.id)
                LEFT OUTER JOIN ref_branch_sol as bs on(b.branch_name_code=bs.id)
                LEFT OUTER JOIN ref_case_type as rq on(b.case_type=rq.id)
                LEFT OUTER JOIN ref_final_remarks as fr on(b.final_remarks=fr.id)
                WHERE '.$where2)->result();
        
        return $result;
    }

    function get_old_legal_cost_report_data()
    {
        $zone_id = trim($this->input->post('zone_id'));
        $case_number = trim($this->input->post('case_number'));
        $req_type = trim($this->input->post('req_type'));
        $district = trim($this->input->post('district'));
        $limit = trim($this->input->post('limit'));
        $proposed_type = trim($this->input->post('proposed_type'));

        $where = 'b.sts<>0';
        if ($proposed_type != '') {
            $where .= ' and b.proposed_type=' . $this->db->escape($proposed_type);
        }
        if ($zone_id != 0) {
            $where .= ' and b.zone=' . $this->db->escape($zone_id);
        }
        if ($req_type != 0) {
            $where .= ' and b.req_type=' . $this->db->escape($req_type);
        }
        if ($district != '') {
            $where .= ' and b.district=' . $this->db->escape($district);
        }

        if ($case_number != 0) {
            $where .= ' and b.case_number=' . $this->db->escape($case_number);
        }

        $this->db
            ->select('b.id,b.proposed_type,r.name as zone_name,d.name as district_name,
                    b.loan_ac,b.org_loan_ac,b.case_number,b.ac_name,rq.name as req_type_name,ls.name as loan_segment_name,
                    DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,b.legal_cost,b.case_claim_amount,
                    r.name as zone_name,DATE_FORMAT(b.previous_date,"%d-%b-%y") AS previous_date,d.name as district_name
                    ', FALSE)
            ->from("legal_cost b")
            ->join('ref_zone as r', 'b.zone=r.id', 'left')
            ->join('ref_district as d', 'b.district=d.id', 'left')
            ->join('ref_req_type as rq', 'b.req_type=rq.id', 'left')
            ->join('ref_loan_segment as ls', 'b.loan_segment=ls.code', 'left')
            ->where($where, NULL, FALSE);
        $this->db->order_by('b.id', 'desc');
        $this->db->limit($limit);
        $result = $this->db->get()->result();
        return $result;
    }
}