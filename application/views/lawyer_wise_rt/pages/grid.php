<style type="text/css">
    #details {
     font-family: Arial, Helvetica, sans-serif;
     border-collapse: collapse;
     width: 100%;
   }
</style>

<script type="text/javascript">
	jQuery().ready(function() {
       jQuery('#report_list').bind('change', function () {
       		var val = jQuery('#report_list').val();
       		if (val == '0') {
       			return false;
       		}
            var url = "<?=base_url()?>index.php/"+val+"/<?=$menu_group?>/<?=$menu_cat?>";
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
	});

    function popup(url) {
    
        var heightReduc = 100;
        var widthReduce = 140;
        
        var pwidth = screen.width - 140;
        var pheight = screen.height - 100;
        var wint = 140/2;
        var winl = 100/2;
        
        newwindow=window.open(url,'name',"height="+pheight+", width="+pwidth+",top="+wint+", toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left="+winl);
        if (window.focus) {newwindow.focus()}
        return false;
    }
</script>
<?
$zone = $this->user_model->get_parameter_data('ref_zone','name',"data_status = '1'");
$lawyer = $this->user_model->get_parameter_data('ref_lawyer','name',"data_status = '1'");
$district = array();


//$status = $this->user_model->get_parameter_data('ref_status','name',"data_status = '1' AND id IN(3,6,7,8,9,10,11,12,13,14)");

$sorting = array(array('value' => 'b.zone','name'=>'zone'),array('value' => 'b.district','name'=>'District'));
$ordering = array(array('value' => 'ASC','name'=>'ASC'),array('value' => 'DESC','name'=>'DESC'));
?>

<? if($option == 'daily_report'){ ?>
	<script language="javascript" type="text/javascript">
	jQuery().ready(function() {
        jQuery('#zone').bind('change', function (event) {
            change_dropdown('zone');      
        });

        <?php //$url?>
        
        var lawyer = [<? $i=1; foreach($lawyer as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [{value:'0', label:'All zone'},<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone",selectedIndex: 0, source: zone, width: '97%', height: 21});
        jQuery("#lawyer").jqxComboBox({theme: theme, promptText: "Select Lawyer",selectedIndex: 0, source: lawyer, width: '97%', height: 21});
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '97%', height: 21});
        //var status = [{value:'0', label:'All Status'},<? $i=1; foreach($status as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        //jQuery("#status").jqxComboBox({theme: theme, promptText: "Select Status",selectedIndex: 0, source: status, width: '97%', height: 21});
        var proposed_type = [{value:'', label:'All Type'},{value:'Investment', label:'Investment'},{value:'Card', label:'Card'}];
        jQuery("#proposed_type").jqxComboBox({theme: theme, promptText: "Type",selectedIndex: 0, source: proposed_type, width: '97%', height: 21});
        var limit = [{value:'100', label:'100'},{value:'200', label:'200'},{value:'300', label:'300'},{value:'400', label:'400'},{value:'500', label:'500'}];
        jQuery("#limit").jqxComboBox({theme: theme, promptText: "Limit",selectedIndex: 0, source: limit, width: '97%', height: 21});

        <? if($post_sts=='1'){?>
            

            jQuery("#zone").jqxComboBox('val', '<?=(isset($zone_id))?$zone_id:''?>');
            jQuery("#lawyer").jqxComboBox('val', '<?=(isset($lawyer_id))?$lawyer_id:''?>');
            
            jQuery("#district").jqxComboBox('val', '<?=(isset($district_id) && $district_id!=0)?$district_id:''?>');

            //jQuery("#status").jqxComboBox('val', '<?=(isset($status_id))?$status_id:''?>');
            jQuery("#proposed_type").jqxComboBox('val', '<?=(isset($proposed_type))?$proposed_type:''?>');
            jQuery("#limit").jqxComboBox('val', '<?=(isset($limit))?$limit:''?>');
        <? } ?>


        jQuery('#zone,#district,#lawyer,#proposed_type,#limit').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

        

	});
    function change_dropdown(operation,edit=null)
    {
        var id='';
        //check for add zone action
        if (edit==null) 
        {
            id = jQuery("#"+operation).val();
        }
        else
        {
            id=edit;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,id : id,operation:operation},
        datatype: "json",
        success: function(response){
            var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str='';
                    var theme = getDemoTheme();
                    if (operation=='zone') 
                    {
                        var district = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            district.push({ value: obj.id, label: obj.name });
                        });
                        jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: '97%', height: 21});
                        //For edit action
                        if (edit!=null) 
                        {
                            jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
                        }
                    }

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
            });

            return false;
    }

    
</script>
<?php //print_r($col_xl); ?>
<style type="text/css">
	th{border-color: #ccc;}
</style>

<div id="container" style="">
    <div id="body"  >
        <div  style="display:block; height:auto">
            <form method="POST" name="form" id="daily_report_search"  style="margin:0px;" action="<?=base_url()?>index.php/lawyer_wise_rt/daily_report/<?=$menu_group?>/<?=$menu_cat?>">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
               <div style="padding: 0.5%;width:98%;height:45px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                    <table id="deal_body" style="display:block;width:100%">
                        <tr>
                           
                            <td style="text-align:right;width:4%"><strong>zone&nbsp;&nbsp;</strong> </td>
                            <td style="width:13%"><div style="padding-left:1.8%" id="zone" name="zone_id"></div></td>
                            <td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
                            <td style="width:13%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                            <td style="text-align:right;width:6%"><strong>Lawyer&nbsp;&nbsp;</strong> </td>
                            <td style="width:13%"><div style="padding-left:1.8%" id="lawyer" name="lawyer_id"></div></td>
                            <td style="text-align:right;width:5%"><strong>Type&nbsp;&nbsp;</strong> </td>
                            <td style="width:10%"><div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div></td>
                            <td style="text-align:right;width:4%"><strong>Limit&nbsp;&nbsp;</strong> </td>
                            <td style="width:10%"><div style="padding-left:1.8%" id="limit" name="limit"></div></td>
                            <td style="width:2%"></td>
                            
                        </tr>
                    </table>
                    <table id="deal_body" style="display:block;width:100%">
                        <tr>
                            <td style="text-align:right;width:3%"></td>
                            <td style="width:12%"></td>
                            <td style="text-align:right;width:5%"></td>
                            <td style="width:15%">
                            </td>
                            <td style="text-align:right;width:5%"></td>
                            <td style="width:15%">
                            </td>
                            
                            <td  style="width:2%"><input name="post_sts" id="post_sts" class="crmbutton small create"  value="Search" type="submit">
                            </td>
                            <td style="width:2%" valign="top">
                                <?php if (count($result) >0 ) { ?>
                                    <button type="submit" formtarget="_blank" name="xlsts" title="Case List"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                    <!--a id="inXLadfc" style="text-align:center;cursor:pointer;" target="_blank" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></a-->
                                <?php } ?>
                                
                            </td>
                        </tr>
                    </table>
              </div>
              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>

            </form>
        </div>
    </div>
</div>

    <table align="center" border="0"  cellpadding="0" cellspacing="0" width="98%">
        <tbody><tr>
            <td width="100%" valign="top" <? if($post_sts == 1){?> style="border:#837E6F 2px inset" <? }?>>
                <? if($post_sts == 1){?>
                       <table style="font-size:10pt" width="100%" class="input_box" border="0" cellspacing="0" cellpadding="1" align="center">           
                        <tr style="text-align:left; font-weight:bold; background-color: #B8E4F3; border-color: #ccc">
                            <th align="center">Sl</th>
                            <th align="left">Zone</th>
                            <th align="left">District</th>
                            <th align="left">Branch</th>
                            <th align="left">Suit Type</th>
                            <th align="left">Client Name</th>
                            <th align="left">Case Number</th>
                            <th align="left">Filling Date</th>
                            <th align="left">Ageing</th>
                            <th align="left">Current Status</th>
                        </tr>
                        <?php $sl=1; if (!empty($result)): ?>
                            <?php foreach ($result as $key): ?>
                                <tr>
                                    <td align="center"><?=$sl;?></td>
                                    <td align="left"><?=$key->zone_name;?></td>
                                    <td align="left"><?=$key->district_name;?></td>
                                    <td align="left"><?=$key->branch_name;?></td>
                                    <td align="left"><?=$key->suit_type;?></td>
                                    <td align="left"><?=$key->ac_name;?></td>
                                    <td align="left"><?=$key->case_number;?></td>
                                    <td align="left"><?=$key->filling_date;?></td>
                                    <td align="left"><?=$key->aging;?></td>
                                    <td align="left"><?=$key->current_status;?></td>
                                </tr>
                            <?php $sl++; endforeach ?>
                        <?php else: ?>
                             <tr style="vertical-align:top;" ><td colspan="13" align="center" style="color: #AA0000">No result found !!</td></tr>
                        <?php endif ?>
                    </table><br /><br /><br />
                <? }?>
            </td>
        </tr>
        </tbody>
    </table>
         
<? } 

else { ?>

   <!--  <form action="<?=base_url()?>index.php/other_report/view<?=$menu_group?>/<?=$menu_cat?>" style="margin:auto; padding:0; clear:both" id="report_form_search" method="post">
        <table  style="background-color:#CCC" align="center" border="0" cellpadding="1" cellspacing="2" width="98%">
            <tbody>
            <tr>
                <td align="left" nowrap="nowrap" width="30%"><strong>Report Type:</strong>
                    <?=form_dropdown('report_list', $report_list, $report_select, " id=\"report_list\" style=\"width:70%\" ");?></td>
                <td width="70%">&nbsp;</td>
                
                
            </tr>
        </tbody>
        </table>
    </form><br/>
     -->
         
<? } ?>


