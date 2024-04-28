<?php
class Recovery_list_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "b.sts!='0'";
	
		if($this->input->get('investment_ac_no')!='') 
		{$where2.=" AND b.investment_ac_no LIKE '%".trim($this->input->get('investment_ac_no'))."%'";}


		if($this->input->get('case_number')!='') 
		{$where2.=" AND b.case_number LIKE '%".trim($this->input->get('case_number'))."%'";}

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

        	if($filterdatafield=='e_dt')
				{
					$filterdatafield='b.e_dt';
				}
				else if($filterdatafield=='doc_type')
				{
					$filterdatafield='c.name';
				}
				else if($filterdatafield=='e_name')
				{
					$filterdatafield='u.name';
				}
				else if($filterdatafield=='remarks')
				{
					$filterdatafield='b.remarks';
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

				if ($i == $filterscount - 1)
				{
					$where .= ")";

				}

				$tmpfilteroperator = $filteroperator;
				$tmpdatafield = $filterdatafield;

			}
			// build the query.
		}else{$where=array();}
		//if($where=='' || count($where)<=0){	
		// if($where=='' ){			
		// 	$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		// }
		
		if ($sortorder == '')
		{
			$sortdatafield="b.id";
			$sortorder = "DESC";				
		}
		//concat(u.name ,u.user_id)
     $this->db
     ->select('SQL_CALC_FOUND_ROWS b.*', FALSE)
			
	 ->from("approval_list b")



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
 	function file_upload($input_name=NULL,$file=NULL)
	{
		
		$image = $_FILES[$input_name]['name'];
		$file_Size = $_FILES[$input_name]['size'];			
			if ($image)
			{	
				$filename = stripslashes($_FILES[$input_name]['name']);
				$i = strrpos($filename,".");
				if (!$i) {$text[]="Unknown Extention";}
				$l = strlen($filename) - $i;
				$extension = substr($filename,$i+1,$l);				
				$extension = strtolower($extension);					
				$file_name_new='Doc_Files_'.$this->session->userdata['ast_user']['user_id'].'_'.rand().'.'.$extension;								
			}
			if($file_name_new!='' && $image==true)
			{
				if(($file_Size >0))
				{
						$copied = copy($_FILES[$input_name]['tmp_name'], 'doc_files/'.$file_name_new);
						if($_POST['hidden_'.$input_name]!=''){unlink("doc_files/".$_POST['hidden_'.$input_name]);}				
				}
				else{ 
						$text[]="Unknown Attached documents (AF) Extention";
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
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{

		

		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    if(isset($_FILES['doc_file']['name']))
		{				
			$doc_file = $this->file_upload('doc_file',$this->input->post('doc_file'));																		
		}
		else
		{
			$doc_file = $_POST['hidden_doc_file'];
		}



		$recive_date       = implode('-',array_reverse(explode('/',$this->input->post('recive_date'))));


		if(isset($_POST['card_no'])){

			$card_no = $this->security->xss_clean( $this->input->post('card_no'));
		}

		
		if(isset($_POST['investment_ac_no'])){
			$investment_ac_no = $this->security->xss_clean( $this->input->post('investment_ac_no'));
		}

		if ($_POST['ac_type']=='Card') 
			{
				$card_number_encript = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac')); 
			}

		

	    $doc_upload_data = array(
			


			'ac_type' =>$this->security->xss_clean( $this->input->post('ac_type')),

			'card_no' => $card_no,
			'investment_ac_no' => $investment_ac_no,

			'card_number_encript'=> $card_number_encript,

			'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
			'account' =>$this->security->xss_clean( $this->input->post('account')),

			'recive_date' => $recive_date,

			'collection_method' =>$this->security->xss_clean( $this->input->post('collection_method')),

			'bank_name' =>$this->security->xss_clean( $this->input->post('bank_name')),
			'branch_name' =>$this->security->xss_clean( $this->input->post('branch_name')),
			
			'po_no' =>$this->security->xss_clean( $this->input->post('po_no')),
			'cheque_no' =>$this->security->xss_clean( $this->input->post('cheque_no')),
	
			'representative_user' =>$this->security->xss_clean( $this->input->post('representative_user')),
			'doc_file' =>$doc_file,
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

		);
		if($add_edit=="add")
		{
			$doc_upload_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$doc_upload_data['e_dt'] = date('Y-m-d H:i:s');
			$this->db->insert('approval_list', $doc_upload_data);
			$insert_idss = $this->db->insert_id();
			$data2 = $this->user_model->user_activities(39,'',$insert_idss,'approval_list','Add Document('.$insert_idss.')','', $this->session->userdata['ast_user']['user_id'], $this->security->xss_clean( $this->input->post('doc_name')));
		    
		}
		else
		{
	  		$doc_upload_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$doc_upload_data['u_dt'] = date('Y-m-d H:i:s');
			$this->db->where('id', $edit_id);
			$this->db->update('approval_list', $doc_upload_data);
	  		$insert_idss = $edit_id;

	        $data2 = $this->user_model->user_activities(35,'',$insert_idss,'approval_list','Edit Document('.$insert_idss.')','', $this->session->userdata['ast_user']['user_id'], $this->security->xss_clean( $this->input->post('doc_name')));
			
		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
			return $insert_idss;
		}


	}
	function get_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select('SQL_CALC_FOUND_ROWS b.*', FALSE)
			->from("approval_list b")
	   
			->where("b.id='".$id."'",NULL,FALSE)
			->limit(1);
			return  $this->db->get()->row();
	

		}
		else{return NULL;}
	}
	function delete_action()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start

		if($this->input->post('type')=='delete'){


			$data = array(
					'd_reson'=>trim($_POST['comments']),
					'sts' => 0, 
					'd_by'=> $this->session->userdata['ast_user']['user_id'],
					'd_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('approval_list', $data);

			
		}
		if($this->input->post('type')=='sendtochecker'){
			
			$data = array(
			 'sts' => 10, 
			 'stc_by'=> $this->session->userdata['ast_user']['user_id'],
			 'stc_dt'=>date('Y-m-d H:i:s'),
			);
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('approval_list', $data);
			
		}
		if($this->input->post('type')=='verify'){
			$data = array(
				'sts' => 2,
				'v_by'=> $this->session->userdata['ast_user']['user_id'],
				'v_dt'=>date('Y-m-d H:i:s'
				));

			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('approval_list', $data);
			$data2 = $this->user_model->user_activities(38,'',$this->input->post('deleteEventId'),'approval_list','Verify Document('.$this->input->post('deleteEventId').')','', $this->session->userdata['ast_user']['user_id'], '');
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
			return $_POST['deleteEventId'];
		}
	}


	function get_recovery_details_by_batch($batch)
	{
		if($batch!=''){
            $str=" SELECT r.*
            FROM approval_list r
            WHERE  r.sts=1 AND r.batch_no=".$this->db->escape($batch);
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
	}


	function delete_action_data()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        

        if($this->input->post('type')=='save_recovery'){


            $data=array();

            $e_dt = date('Y-m-d H:i:s');
            $e_by = $this->session->userdata['ast_user']['user_id'];



            for ($i=1;$i<= $_POST['total_row'];$i++) 
            { 
              
                 
                    $array = array(
                    'investment_ac_type' => $this->input->post('investment_ac_type_'.$i),
                    'cif_no' => $this->input->post('cif_no_'.$i),
                    'account_name' => $this->input->post('account_name_'.$i),
                    'e_by'=> $e_by,
                    'e_dt'=>$e_dt
                    );
                    array_push($data,$array);
                    
               
            }
            $this->db->insert_batch('approval_list', $data);

            $data2 = $this->user_model->user_activities(68,'','','approval_list','Upload approval List');

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





}
?>
