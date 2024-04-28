<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
<style type="text/css">
	.button1 {
	  background-color: #555555; /* Green */
	  border: none;
	  color: white;
	  padding: 10px 20px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;;
	  border-radius: 12px;
	}
	.grid_table_div { overflow: auto; height: 100px; }
	.grid_table_div thead th { position: sticky; top: 0; z-index: 1; border: 1px solid #ccc;}
</style>
<script type="text/javascript">
	var csrf_token='';
	jQuery(document).ready(function () {
		var theme = getDemoTheme();

		jQuery('#zone').bind('change', function (event) {
			change_dropdown('zone');		
		});
		jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK") });
		jQuery('#sendButton').jqxButton({template:"success", width: 120, height: 40, theme: theme });
		var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '97%', height: 21});
		var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '97%', height: 21});
		var loan_segment = [<? $i=1; foreach($loan_segment as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#loan_segment").jqxComboBox({theme: theme, promptText: "Select Investment segment", source: loan_segment, width: '97%', height: 21});
		var limit = [
				{value:'50',label:'50'},
				{value:'100',label:'100'}
			];
		var type = [
				{value:'Investment',label:'Investment'},
				{value:'Card',label:'Card'},
				//{value:'All',label:'All'}
			];
		jQuery("#type").jqxComboBox({theme: theme, promptText: "Select Type", source: type, width: '97%', height: 21});
		jQuery("#type").jqxComboBox('val','Investment');
		jQuery("#limit").jqxComboBox({theme: theme, promptText: "Select Limit", source: limit, width: '97%', height: 21});
		jQuery('#limit,#zone,#loan_segment,#district').focusout(function() {
	        commbobox_check(jQuery(this).attr('id'));
	    });
	    jQuery('#type').bind('change', function (event) {
            jQuery('#result_table').html('');
			jQuery("#submit_button_table").hide();      
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
	function search_data()
	{
		var item = jQuery("#type").jqxComboBox('getSelectedItem');
		if (item==null)
		{
			alert('Please Select Type');
			jQuery("#type input").focus();
			return false;
		}
		jQuery("#grid_search").hide();
		jQuery("#grid_loading").show();
		
		var theme = getDemoTheme();
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postdata = jQuery('#form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?=base_url()?>index.php/legal_notice_ho/load_bulk_data/",
				data : postdata,
				datatype: "json",
				success: function(response){
						var json = jQuery.parseJSON(response);
						jQuery('.txt_csrfname').val(json.csrf_token);
						jQuery('#result_table').html(json.str);
						//For Bulk Send To approver
						jQuery('#inXL').attr("href",'#');
						jQuery('#pdf').attr("href",'#');
						jQuery("#sendButton").show();
						jQuery("#loading").hide();
						jQuery("#inXL").hide();
						jQuery("#pdf").hide();
						if (jQuery("#event_counter").val()!=0)
						{
							jQuery("#submit_button_table").show();
						}else{jQuery("#submit_button_table").hide();}
						jQuery("#grid_search").show();
						jQuery("#grid_loading").hide();
					
				}
			});
	}
	function CheckAll_2(checkAllBox)							
	{							
		var ChkState=checkAllBox.checked;
		var number=jQuery("#event_counter").val();
		var counter=0;
		if (ChkState==true) 
		{
			for(var i=1; i<=number; i++){				
				jQuery("#event_delete_"+i).val(0);
				document.getElementById("chkBoxSelect"+i).checked=ChkState;
				counter++;							
			}
		}	
		else{
			for(var i=1; i<=number; i++){				
				jQuery("#event_delete_"+i).val(1);
				document.getElementById("chkBoxSelect"+i).checked=ChkState;							
			}
			counter=0;
		}	
		jQuery('#selected_value').html(counter);									
	}	
	function CheckChanged_2(checkAllBox,counter)
	{
		var ChkState=checkAllBox.checked;
		if (ChkState==true) 
		{
			jQuery("#event_delete_"+counter).val(0);
		}
		else
		{
			jQuery("#event_delete_"+counter).val(1);
		}
		var number=jQuery("#event_counter").val();
		var checkco=0;
		for(var i=1; i<=number; i++){														
			if(document.getElementById("chkBoxSelect"+i).checked==true){
			checkco++;	
			}											
		}
		if (number==checkco){
		document.getElementById("checkAll").checked=true;
		}else{
		document.getElementById("checkAll").checked=false;
		}
		jQuery('#selected_value').html(checkco);	   								
	}
	function details(id,operation,indx,district=null,zone=null)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(indx);
		if (operation=='details') 
		{
			jQuery("#header_title").html('Reminder Notice Details');
			jQuery('#close_btn_row').show();
		}
		jQuery('#loading_preview').show();
		jQuery('#loading_p').show();
		jQuery('#details_table').hide();
		jQuery("#details").jqxWindow('open');
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>legal_notice/details",
			data : {[csrfName]: csrfHash,id: id,
			district:district,zone:zone
			},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);

				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.str)
					{
						document.getElementById("details").style.visibility='visible';

						jQuery("#main_body").html(json['str']);
						jQuery('#loading_preview').hide();
						jQuery('#loading_p').hide();
						jQuery('#details_table').show();
						jQuery("#details").jqxWindow('open');
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
	}
	function row_validation()
	{
		var theme = getDemoTheme();
		var counter=0;
		var total_row = jQuery('#event_counter').val();
		//alert(total_row);
		var check=0;
		for(var i=1; i<=total_row; i++)
		{
			if(document.getElementById("chkBoxSelect"+i).checked==true)
			{
				check++;
			}
		}
		if (check<1)
		{
		 	alert('Please, select at least one Data !!');
		 	return false;
		}
		if (jQuery("#operation").val()=='sta')
		{
			rules2 = [
				{ input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {					
					if(input.val() != '')
					{
						var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='lawyer']").val(item.value);}
						return true;				
					}
					else
					{
						jQuery("#lawyer input").focus();
						return false;
					}
				}  
				},
				{ input: '#holm', message: 'required!', action: 'blur,change', rule: function (input) {					
					if(input.val() != '')
					{
						var item = jQuery("#holm").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='holm']").val(item.value);}
						return true;				
					}
					else
					{
						jQuery("#holm input").focus();
						return false;
					}
				}  
				}
            ];
            jQuery('#form').jqxValidator({
			        rules: rules2, theme: theme
		    });
		    if (jQuery('#form').jqxValidator('validate')) 
		    {
		    	return true;
		    }
		    else
		    {
		    	return false;
		    }
			
		}
		return true;
	}
	function call_ajax_submit()
	{
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = $('form').toQueryString()+"&"+csrfName+"="+csrfHash;
		$('sendToCheckerMessageDialogConfirm').style.display = 'none';
		$('sendToCheckerMessageDialogCancel').style.display = 'none';
		$('loadingReturn').style.display = 'inline';
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?=base_url()?>index.php/legal_notice_ho/bulk_download/',
			data : postData,
			datatype: "json",
			success: function(response){
              ///console.log(response);
				var json = jQuery.parseJSON(response);
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.Message!='OK')
					{								
						alert(json.Message);
						//window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
						window.top.EOL.messageBoard.close();
					}else{

					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+jQuery("#success_message").val());	
                    //window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');										
					window.top.EOL.messageBoard.close();
				}
			}
		});
	}
	function delete_action() {
		if (row_validation()!=false) 
		{
			var item = jQuery("#type").jqxComboBox('getSelectedItem');
			if(item!=null)
			{
				jQuery("#sendButton").hide();
				jQuery("#loading").show();
				var number=jQuery("#event_counter").val();
				var ids = item.value;
				for(var i=1; i<=number; i++){														
					if(jQuery("#event_delete_"+i).val()==0)
					{
						var ids = ids+'_'+jQuery("#event_id_"+i).val();
					}						
				}
				var strLink = '<?=base_url()?>index.php/legal_notice_ho/bulk_download/'+ids;
				var strLink2 = '<?=base_url()?>index.php/legal_notice_ho/bulk_download_pdf/'+ids;
				jQuery('#inXL').attr("href",strLink);
				jQuery('#pdf').attr("href",strLink2);
				jQuery("#sendButton").hide();
				jQuery("#loading").hide();
				if(item.value=='All')
				{
					jQuery("#inXL").hide();
					jQuery("#pdf").show();
				}
				else
				{
					jQuery("#inXL").show();
					jQuery("#pdf").show();
				}

			}
			else
			{
				jQuery('#result_table').html('');
				jQuery("#submit_button_table").hide();
			}
			
		}
	}
	function close_window()
	{
		sendToCheckerMessageDialog.hide();
	}
    </script>

<style>

 .custtable table{
		color: #333;
		font-family: Helvetica, Arial, sans-serif;
		width: 640px;
		border-collapse:
		collapse; border-spacing: 0;
		margin-top:15px;
		table-layout: fixed;
	 }

	.custtable td, .custtable th {
		border: 1px solid #ccc; 
		height: 25px;
		transition: all 0.3s; 
	 }
	 table {
		border-collapse: collapse;
		table-layout: fixed;
	}
	table#preview_table td {
		border: 1px solid #c7c7c7;
		word-wrap:break-word;
		padding: 8px;
	}
	.custtable th {
		background: #DFDFDF;  
		font-weight: bold;
		padding-left:5px;
		padding-right:5px;
		text-align: left;
	}
	table.preview_table2 td, table.preview_table2 th{
		border: 1px solid #c7c7c7;
		word-wrap:break-word;
		padding:5px;
	}
	.custtable td {
		background: #FAFAFA;
		padding-left:5px;
		padding-right:5px;
		text-align: left;
		word-wrap:break-word
	}
	.custtable tr:nth-child(even) td { background: #F1F1F1; }  
	.custtable tr:nth-child(odd) td { background: #FEFEFE; } 
	.custtable tr:hover{ background: #666; color: #000; } 
	#gurantor_table {
        border-collapse: collapse;
	    }
	    #gurantor_table td {
	        border: 1px solid rgba(0,0,0,.20); 
	    }
</style>
<body style="font-family:calibri">    
	<div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
		Bulk <?=$operation_name;?>
	</div>	
	
	<div  id="username_error_show" style="color:#FF0000; font-weight:bold; text-align:center"></div>
	<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	<div align="left">	
		<form class="form" id="form" name="form"  method="post" action="<?=base_url()?>legal_notice_ho/upload_file" enctype="multipart/form-data">
			<input type="hidden" id="operation" name="operation" value="<?=$operation;?>" />
			<br/>
			<div style="margin-left:10px;padding: 0.5%;width:98%;height:65px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
					<table id="deal_body" style="display:block;width:100%">
						<tr>
							<td style="text-align:right;width:5%"><strong>zone&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
							<td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
							<td style="text-align:right;width:5%"><strong>Portfolio&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="loan_segment" name="loan_segment"></div></td>
							<td style="text-align:right;width:5%"><strong>Limit&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="limit" name="limit"></div></td>
							<td style="text-align:right;width:5%"><strong>Rec Date&nbsp;&nbsp;</strong> </td>
							<td style="width:40%"><input id="rec_dt_from" name="rec_dt_from" style="width:40%" /><script type="text/javascript">datePicker("rec_dt_from");</script>
							<strong>To</strong> <input id="rec_dt_to" name="rec_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("rec_dt_to");</script>
							</td>
							<td  style="text-align:right;width:7%"><input type='button' class="buttonclose" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
							<span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;width:5%"><strong>Type&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="type" name="type"></div></td>
						</tr>
					</table>
			  </div>


			  <span id="result_table"></span>

			<table id="submit_button_table"  align="center" style="font-size:15px !important;margin-bottom:20px !important;display:none" border="0" cellspacing="0" cellpadding="2">
			  <tr align="center"><td style="border:0px; vertical-align:top;">		
				<br/>
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Generate" id="sendButton" onclick="delete_action()" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<a id="inXL" style="text-align:center;cursor:pointer;display: none;" href="" target="_blank" ><img align="center" src="<?=base_url()?>images/word_icon.gif" style="width:30px"></a>&nbsp;&nbsp;
				<a id="pdf" style="text-align:center;cursor:pointer;display: none;" href="" target="_blank" ><img align="center" src="<?=base_url()?>images/pdf_icon.gif" style="width:30px"></a>&nbsp;&nbsp;
				<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
				<br/>
				</td>
			  </tr>
			</table>
		</form>
	</div>

	<!-- Modal for product details -->
	<div id="details" style="visibility:hidden;">
    <div><strong><label id="header_title"></label></strong></div>
		<form method="POST" name="action_form" id="action_form"  style="margin:0px;">
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
    		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
    		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<div id="loading_preview" style="text-align:center">
				<span id="loading_p" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			</div>
			<div style="" id="details_table">
				<span id="main_body"></span>
				<br>
			    <div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
			    	<input type="button" align="center" class="button1" id="codeOK" value="Close" />
			    </div>
			</div>
		</form>
	</div>

	<div id="sendToCheckerMessageDialogContent"  style="display:none;">
	    <div class="hd" ><h2 class="conf" style="margin-top:0px">Take Action (<span id="message"></span>)?</h2></div>
	    <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin-top:0px;">
	        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	       <input name="type" id="type" value="" type="hidden">	
	       <input name="success_message" id="success_message" value="" type="hidden">		
	        <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a> 
	        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
	        <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>