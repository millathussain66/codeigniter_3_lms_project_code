<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recovery_list extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Recovery_list_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'recovery_list/pages/grid',
					'document_type'=>$this->User_model->get_parameter_data('ref_document_type','name','data_status = 1'),
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Recovery_list_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Recovery_list_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}


	function from($add_edit='add',$id=NULL,$editrow=NULL)
	{

	   $collection_method = array(1=>'Pay Order',2=>'Cheque');
	   $representative_user = $this->user_model->get_parameter_data('users_info','name',"user_group_id = '1'");
	   $branch_name = $this->user_model->get_parameter_data('ref_branch_sol','name',"data_status=1");

	   $bank_name = $this->user_model->get_parameter_data('ref_bank','name',"data_status=1");



		$this->load->model('Recovery_list_model', '', TRUE);


		$result = $this->Recovery_list_model->get_info($add_edit,$id);
		$data = array(
					 'option' => '',
					 'add_edit' => $add_edit,
					 'result' => $result,
					 'id' => $id,
					 'collection_method' =>  $collection_method,
					 'representative_user' =>  $representative_user,
					 'branch_name' =>  $branch_name,
					 'bank_name' =>  $bank_name,
                     'option' => 'upload_recovery',
					 'document_type'=>$this->User_model->get_parameter_data('ref_document_type','name','data_status = 1'),
					 'pages'=> 'recovery_list/pages/form',
					 'editrow' => $editrow
					 );
		$this->load->view('recovery_list/form_layout',$data);

	}
	
	function from2($add_edit='edit',$id=NULL,$editrow=NULL)
	{



		$result = $this->Recovery_list_model->get_info($add_edit,$id);
		$data = array(
					 'option' => '',
					 'add_edit' => $add_edit,
					 'result' => $result,
					 'id' => $id,
		
					 'document_type'=>$this->User_model->get_parameter_data('ref_document_type','name','data_status = 1'),
					 'pages'=> 'recovery_list/pages/form2',
					 'editrow' => $editrow
					 );
		$this->load->view('recovery_list/form_layout',$data);

	}



	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Recovery_list_model->add_edit_action($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";
		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Recovery_list_model->get_add_action_data($id);

		

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

	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Recovery_list_model->delete_action();
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			if($this->input->post("type")=='delete'){$row[]='';	}
			else{$row=$this->Recovery_list_model->get_add_action_data($id);}
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

	function details()
	{

		$csrf_token=$this->security->get_csrf_hash();
			if ($this->input->post('id') != ""){
				//$details=$this->Recovery_list_model->get_ptp_info($this->input->post('id'));
				$details=array();
				$var =array(
								"details"=>$details,
								"csrf_token"=>$csrf_token
								);
				echo json_encode($var);
	    	}
	}
	function verify() {
        //$result=$this->Recovery_list_model->verify_ptp($this->input->post('ptp_id'));
        $result=1;
        $jTableResult = array();
        if ($result == 1) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $result;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }

	function Recovery_Data_Templete()
    {

      
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $filepath=$destination_path.'recovery_template/Templete.xlsx';
        //$file_name='Templete.xlsx';
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($filepath) . "\""); 
        readfile($filepath);
    }

    function recovery_upload()
    {
       $total_error_rows=0;
        $count=0;
        $investment_ac_type='';
        $cif_no='';
        $account_name='';
        $count=0;

       $this->load->helper('form');
       $csrf_token=$this->security->get_csrf_hash();     
       $str='';       
       $destination_path = getcwd().DIRECTORY_SEPARATOR;
       //Removing Previous File
       $path = $destination_path.'/recovery_template/recovery_file/temp_recovery_file_'.$this->session->userdata['ast_user']['user_id'].'.xlsx';
       if (file_exists($path)) {
        unlink($path);
       }
       $result = 0;
       $size1=basename($_FILES['recovery_file']['size']);
       $size=$size1/1048576;
       $filename = stripslashes($_FILES['recovery_file']['name']);
       $i = strrpos($filename,".");
       $l = strlen($filename) - $i;
       $extension = substr($filename,$i+1,$l);             
       $extension = strtolower($extension);                   
       $file_name_new='temp_recovery_file_'.$this->session->userdata['ast_user']['user_id'].'.'.$extension;
       //$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
       $target_path = $destination_path.'/recovery_template/recovery_file/' .$file_name_new;
        
        if(@move_uploaded_file($_FILES['recovery_file']['tmp_name'], $target_path)) {
          $result = 1;
        } 
        if ($result==1) 
        {
            
            $str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
            <table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
                <thead>
                    <th width="5%" style="font-weight: bold;text-align:center">SL</th>
                    <th width="5%" style="font-weight: bold;text-align:left">Inastment A/C Number</th>
                    <th width="20%" style="font-weight: bold;text-align:left">CID NO </th>
                    <th width="10%" style="font-weight: bold;text-align:left">Account Number</th>

           
                </thead>
                <tbody id="table_tbody">';

            $path = $target_path;
            include_once('tbs/clas/tbs_class.php');
            include_once('tbs/clas/tbs_plugin_opentbs.php');

            $TBS = new clsTinyButStrong();
            $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

            $TBS->LoadTemplate($path);

            $options = array(
                'noerr' => TRUE,
                //'rangeinfo' => true,
            );

            $range = '$A:$C';
            


            $data = $TBS->Plugin(OPENTBS_GET_CELLS, $range, $options);
            /*if(in_array(null, $data[9], true) || in_array('', $data[9], true)){
                echo 1;
            }*/
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // exit;


            $error = 0;
            $error_msg = '';
            if (empty($data)) {
                $str.='<tr> <td colspan="7" align="center">Invalid File!!</td></tr>';
                $Message='NotOk';
                $str.='<input type="hidden" name="total_row" id="total_row" value="0">';
                $str.='<input type="hidden" name="total_number_of_error" id="total_number_of_error" value="0">';
            }
            else
            {
                foreach ($data as $key => $val) {



                    if (in_array(null, $val, true) || in_array('', $val, true)) {
                        continue;
                    }
                    if($key==0)
                    {
                        continue;
                    }
                    $count++;
                    $str.='<tr id="row_'.$count.'">';
                    $str.='<td align="center">'.$count.'</td>';
                    foreach ($val as $key2 =>$col) {

                        print_r($col);
                        // $col->investment_ac_type = $investment_ac_type;
                        // $col->cif_no = $cif_no;
                        // $col->account_name = $account_name;

                        $str.='<td align="left">'.$col.'</td>';
                        
                    }

                        $str.='<td align="left">
                        
                        <input type="hidden" id="investment_ac_type_'.$count.'" name="investment_ac_type_'.$count.'" value="'.$investment_ac_type.'">
                        <input type="hidden" id="cif_no_'.$count.'" name="cif_no_'.$count.'" value="'.$cif_no.'">
                        <input type="hidden" id="account_name_'.$count.'" name="account_name_'.$count.'" value="'.$account_name.'">

            
                        </td>';
                    
                    //End Row
                    $str.='</tr>';
                }
                    $Message='OK';
            } 
        }  
        $var =array(
        "str"=>$str,
        "Message"=>$Message,
        "total_error_rows"=>$total_error_rows,
        "csrf_token"=>$csrf_token
        );


        echo json_encode($var);
    }



    function delete_action_data()
    {
        $csrf_token=$this->security->get_csrf_hash();
        $text = array();
        //Lodaing facility for loan
        if($this->session->userdata['ast_user']['login_status'])
        {
            $id = $this->Recovery_list->delete_action();
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
            else if($this->input->post("type")=='delete'){$row[]='';    }
            else if(isset($_POST['typebulk'])){$row[]='';}
            else{$row=array();}
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

}
?>
