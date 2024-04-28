<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lawyer_wise_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Hoops_model', '', TRUE);
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group, $menu_cat){

		$report_list = array(
            'lawyer_wise_rt/daily_report' => 'Daily Report',
		);
		$report_select = 'lawyer_wise_rt/daily_report';
		$result = array();
		$post_sts = 0;
        $zone_id=isset($_POST['zone_id'])?$_POST['zone_id']:0;
        $lawyer_id=isset($_POST['lawyer_id'])?$_POST['lawyer_id']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:0;
        
        $limit=isset($_POST['limit'])?$_POST['limit']:100;
		$data = array(
            'menu_group' => $menu_group,
            'menu_cat' => $menu_cat,
            'report_select' => $report_select,
            'report_list' => $report_list,
            'result' => $result,
            'post_sts' => $post_sts,
            'zone_id' => $zone_id,
            'district_id' => $district,
            'lawyer_id' => $lawyer_id,
            'proposed_type' => $proposed_type,
            'limit' => $limit,
            'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice"'),
            'zone_data' => $this->user_model->get_parameter_data('ref_zone','id','data_status = 1'),
            'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
            'pages' => 'lawyer_wise_rt/pages/grid',
            'option' => 'daily_report'
        );
        $this->load->view('grid_layout',$data);

	}	


	function daily_report($menu_group, $menu_cat){
		$report_list = array(
                'lawyer_wise_rt/daily_report' => 'Daily Report',
            );
		$report_select = 'lawyer_wise_rt/daily_report';
		$result = array();
	    if(isset($_POST['xlsts'])){
	      $this->mk_xl_daily_report();
	    }else{
			$post_sts = isset($_POST['post_sts']) ? 1 : 0;
		if ($post_sts == 1) {
			$result = $this->Hoops_model->get_report_data_lawyer_wise();
		}
        $lawyer_id=isset($_POST['lawyer_id'])?$_POST['lawyer_id']:0;
        $zone_id=isset($_POST['zone_id'])?$_POST['zone_id']:0;
        $territory=isset($_POST['territory'])?$_POST['territory']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:'';
        $limit=isset($_POST['limit'])?$_POST['limit']:100;

 
		$data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'report_select' => $report_select,
                'report_list' => $report_list,
                'result' => $result,
                'post_sts' => $post_sts,
                'zone_id' => $zone_id,
                'district_id' => $district,
                'lawyer_id' => $lawyer_id,
                'proposed_type' => $proposed_type,
                'limit' => $limit,
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice"'),
                'zone_data' => $this->user_model->get_parameter_data('ref_zone','id','data_status = 1'),
                'pages' => 'lawyer_wise_rt/pages/grid',
                'option' => 'daily_report'
            );
    
            $this->load->view('grid_layout',$data);
      }
	}

    function mk_xl_daily_report(){
    	$result = $this->Hoops_model->get_report_data_lawyer_wise();
		require_once('./application/Classes/PHPExcel.php'); 
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $styleArray_border = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
              )
          ); 
		$headings2 = array(
      'SL No.',
      'Zone',
      'District',
      'Branch',
      'Suit Type',
      'Client Name',
      'Case Number',
      'Ageing',
      'Current Status');

		$colnum = count($headings2);
        if($colnum==0){
          $colnum=1;
        }
        $rowNumber=1;
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $rowNumber++;
        $sl = 0;
        foreach($result as $row){
          $sl++;
			$dataar = array(
                  $sl,
                  $row->zone_name,
                  $row->district_name,
                  $row->branch_name,
                  $row->suit_type,
                  $row->ac_name,
                  $row->case_number,
                  $row->aging,
                  $row->current_status
              );
			$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
			$rowNumber++;
		}
		$rowNumber++;
		$rowNumber--;
		$rowNumber--;
		$objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border); 

		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Hoops Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Hoops_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}
	
}
?>