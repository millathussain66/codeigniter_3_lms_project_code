<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
<body style="height:96%">
<style type="text/css">
	.ms-parent{ width: 320px !important;}
	.text-input-big{
		height: 23px !important;
	}
	#sendButton{
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
		cursor: pointer
	}
</style>
<script type="text/javascript">
	var csrf_tokens='';
	var theme = 'energyblue';
	jQuery(document).ready(function () {
		
		//jQuery("#sendButton").jqxButton({template:"default",width:"120"});
		jQuery('#sendButton').jqxButton({ height: 30, theme: theme });
		jQuery('.text-input-small').addClass('jqx-input');
		jQuery('.text-input-small').addClass('jqx-rc-all');
		jQuery('.text-input-big').addClass('jqx-input');
		jQuery('.text-input-big').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input-small').addClass('jqx-input-' + theme);
			jQuery('.text-input-small').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input-small').addClass('jqx-rc-all-' + theme);
			jQuery('.text-input-big').addClass('jqx-input-' + theme);
			jQuery('.text-input-big').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input-big').addClass('jqx-rc-all-' + theme);
		}
		var zone_data = [<? $i=1; foreach($zone_data as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		
		jQuery("#zone").jqxComboBox({theme: theme,  autoDropDownHeight: false, promptText: "Select Zone", source: zone_data, width: 316, height: 16});
		

		var work_group_id = [<? $i=1; foreach($working_group_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->group_name.'"}'; $i++;}?>];
		jQuery("#work_group_id").jqxComboBox({theme: theme,  autoDropDownHeight: false, promptText: "Select User Group", source: work_group_id, width: 316, height: 16});
		<? if($add_edit=='edit'){?>
			var district = [<? $i=1; foreach($district_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
			jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: 316, height: 16});
			var branch = [<? $i=1; foreach($branch_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
			jQuery("#branch").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Branch", source: branch, width: 316, height: 16});

		<? } ?>

		<? if($add_edit=='add'){?>
			
			var district = [<? $i=1; foreach($district_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
			jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: 316, height: 16});
		
			var branch = [<? $i=1; foreach($branch_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
			//jQuery("#unit_office").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Unit Office", source: unit_office, width: 316, height: 16});
			jQuery("#branch").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Branch", source: branch, width: 316, height: 16});
			
		<? } ?>

		var designation_id = [<? $i=1; foreach($designation_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		jQuery("#designation_id").jqxComboBox({theme:theme, autoDropDownHeight:false,promptText:"Select Designation",source: designation_id,width: 316, height: 16});

		var fun_designation_id = [<? $i=1; foreach($fun_designation_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		jQuery("#fun_designation_id").jqxComboBox({theme:theme, autoDropDownHeight:false,promptText:"Select Functional Designation",source: fun_designation_id,width: 316, height: 16});

		var department_id = [<? $i=1; foreach($department_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		jQuery("#department_id").jqxComboBox({theme:theme, autoDropDownHeight:true,promptText:"Select Department",source: department_id,width: 316, height: 16});

	    var free_field_3 = [<? $i=1; foreach($free_field_3_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		jQuery("#Free_Field_3").jqxComboBox({theme: theme,  autoDropDownHeight: false, promptText: "Select Free Field 3", source: free_field_3, width: 316, height: 16});
		var free_field_4 = [<? $i=1; foreach($free_field_4_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		jQuery("#Free_Field_4").jqxComboBox({theme: theme,  autoDropDownHeight: false, promptText: "Select Free Field 4", source: free_field_4, width: 316, height: 16});

		<? if($add_edit=='edit'){?>
			
			jQuery("#work_group_id").jqxComboBox('val', '<?=(isset($result->user_group_id) && $result->user_group_id!=0)?$result->user_group_id:''?>');
			//row_action();
			jQuery("#designation_id").jqxComboBox('val', '<?=(isset($result->designation_id) && $result->designation_id!=0)?$result->designation_id:''?>');
			jQuery("#fun_designation_id").jqxComboBox('val', '<?=(isset($result->fun_designation_id) && $result->fun_designation_id!=0)?$result->fun_designation_id:''?>');
			jQuery("#department_id").jqxComboBox('val', '<?=(isset($result->department_id) && $result->department_id!=0)?$result->department_id:''?>');
			jQuery("#Free_Field_3").jqxComboBox('val', '<?=(isset($result->Free_Field_3) && $result->Free_Field_3!=0)?$result->Free_Field_3:''?>');
			jQuery("#Free_Field_4").jqxComboBox('val', '<?=(isset($result->Free_Field_4) && $result->Free_Field_4!=0)?$result->Free_Field_4:''?>');
			
			jQuery("#zone").jqxComboBox('val', '<?=(isset($result->zone) && $result->zone!=0)?$result->zone:''?>');
			change_dropdown('zone',<?=(isset($result->zone) && $result->zone!=0)?$result->zone:'0'?>);
			// change_dropdown('district',<?=(isset($result->district) && $result->district!=0)?$result->district:'0'?>);
			
			jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
			change_dropdown('district',<?=(isset($result->district) && $result->district!=0)?$result->district:'0'?>);
		
			

		<? } ?>


		jQuery('#work_group_id,#zone,#district,#designation_id,#department_id,#fun_designtion_id').focusout(function(){
			commbobox_check(jQuery(this).attr('id'));
		});
		/*jQuery('#work_group_id').bind('change', function (event) {
			row_action();
		});*/
        jQuery('#zone').bind('change', function (event) {
			change_dropdown('zone');		
		});
		
		
		jQuery('#district').bind('change', function (event) {
			change_dropdown('district');	
			
		});

		 jQuery("#acceptterms").bind('change', function (event) {
			var checked = jQuery('#acceptterms').is(':checked');
		 	if(checked==true){ jQuery("#emailValidationMark").show();	}
		 	else {// jQuery("#emailValidationMark").hide();	
			}
		 });

		 jQuery("#picture").change(function(){
			 	<? if($add_edit=='edit'){?>
			 		jQuery("#file_preview_picture").hide();	
					fileValidation('picture');
				<? } ?>
				<? if($add_edit=='add'){?>
					fileValidation('picture');
				<? } ?>
			});
			jQuery("#signature").change(function(){
				<? if($add_edit=='edit'){?>
			 		jQuery("#file_preview_signature").hide();	
					fileValidation('signature');
				<? } ?>
				<? if($add_edit=='add'){?>
					fileValidation('signature');
				<? } ?>
			});



		// initialize validator.
		jQuery('#form').jqxValidator({
			rules: [
			{ input: '#employee_ID', message: 'required', action: 'keyup, blur', rule: 'required' },
			{ input: '#employee_ID', message: 'User ID must be between <?=$sys_config->user_id_min_length?> and <?=$sys_config->user_id_max_length?> characters', action: 'keyup, blur', rule: 'length=<?=$sys_config->user_id_min_length?>,<?=$sys_config->user_id_max_length?>'
			},
			{ input: '#employee_ID', message: 'Duplicate User ID!', action: 'keyup, blur', rule: function (input,commit) {
				if(input.val()==''){
					commit(true);
					return true
				}
				else
				{

					var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
					var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
					jQuery.ajax({
						type: "POST",
						cache: false,
						async:false,
						url: "<?=base_url()?>user_info/duplicate_field/user_id/<?=$add_edit?>/<?=$id?>",
						data : {[csrfName]: csrfHash,val: input.val()},
						datatype: "json",
						success: function(response){
							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);
							if(json.Status=='ok')
							{
								commit(true);
								//return true;
							}
							else{
								commit(false);
								//return false;

							}
						}
					});
				}
				}
			},
			{ input: '#employee_ID', message: 'Must contain 1 latter, 1 numeric!', action: 'keyup, blur', rule: function (input,commit) {
					if(input.val()==''){
						commit(true);
						return true
					}
					else
					{

						if(input.val().match(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{<?=$sys_config->user_id_min_length?>,<?=$sys_config->user_id_max_length?>}$/) == null){
				    		
				    		jQuery('#employee_ID').focus();
				    		commit(false);
				    		return false;
				    	}else
				    	{
				    		commit(true);
				    		return true;
				    	}
					}
				}
			},
			
			<? if($add_edit=='add'){?>
			
			{ input: '#pass', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
			{ input: '#pass', message: 'Your password must be between <?=$sys_config->password_min_length?> and <?=$sys_config->password_max_length?> digits!', action: 'keyup, blur', rule: 'length=<?=$sys_config->password_min_length?>,<?=$sys_config->password_max_length?>' },
			{ input: '#pass', message: 'Must contain 1 capital latter, 1 small latter, 1 numeric and no special character!', action: 'keyup, focus', rule: function (input, commit) {
					if(input.val()=='' || input.val().length<<?=$sys_config->password_min_length?> ){
						commit(true);
						return true
					}


					if(input.val().match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{<?=$sys_config->password_min_length?>,<?=$sys_config->password_max_length?>}$/))
					{
						if(input.val().length <= <?=$sys_config->password_min_length?>){
							input.parent().find('span').remove();
							input.after('<span>&nbsp;&nbsp;the password strength is low.</span>');
						}else if(input.val().length > <?=$sys_config->password_min_length?> && input.val().length < <?=($sys_config->password_min_length+3)?>){
							input.parent().find('span').remove();
							input.after('<span>&nbsp;&nbsp;the password strength is Medium.</span>');
						}else{
							input.parent().find('span').remove();
							input.after('<span>&nbsp;&nbsp;the password strength is Strong.</span>');
						}

						commit(true);
						return true;
					}
					else{
						commit(false);
						return false;
					}



				}
			},
			
			<? }?>
			{ input: '#name', message: 'required', action: 'keyup, blur', rule: 'required' },
			{ input: '#name', message: 'only Alphabetic (A – Z)', action: 'keyup, blur', rule: 'notNumber' },
			{ input: '#work_group_id', message: 'required', action: 'blur, change', rule: function (input) {
					if(input.val() != '')
					{
						var item = jQuery("#work_group_id").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='work_group_id']").val(item.value);}
						return true;
					}
					jQuery("#work_group_id input").focus();
					return false;
				}
			},
			{ input: '#zone', message: 'required', action: 'blur, change', rule: function (input) {
					if(input.val() != '')
					{
						var item = jQuery("#zone").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='zone']").val(item.value);}
						return true;
					}
					jQuery("#zone input").focus();
					return false;
						
				}
			},
			
			
			{ input: '#district', message: 'required', action: 'blur, change', rule: function (input) {
					
					if(input.val() != '')
					{
						var item = jQuery("#district").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='district']").val(item.value);}
						return true;
					}
					jQuery("#district input").focus();
					return false;
						
				}
			},
			
			{ input: '#branch', message: 'required', action: 'blur, change', rule: function (input) {
					
					if(input.val() != '')
					{
						var item = jQuery("#branch").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='branch']").val(item.value);}
						return true;

					}
					else
					{
						jQuery("#branch").focus();
						return false;
					}
						
				}
			},
			{ input: '#mobile_number', message: 'invalid Phone Number', action: 'keyup, blur', rule: 'number' },
			{ input: '#mobile_number', message: 'duplicate Mobile Phone', action: 'keyup, blur', rule: function (input,commit) {
					if(input.val()==''){
						commit(true);
						return true
					}
					else
					{

						var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
						var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
						jQuery.ajax({
							type: "POST",
							cache: false,
							url: "<?=base_url()?>index.php/user_info/duplicate_field/mobile_number/<?=$add_edit?>/<?=$id?>",
							data : {[csrfName]: csrfHash,val: input.val()},
							datatype: "json",
							success: function(response){
								var json = jQuery.parseJSON(response);
								jQuery('.txt_csrfname').val(json.csrf_token);
								if(json.Status=='ok')
								{
									commit(true);
									//return true;
								}
								else{
									commit(false);
									//return false;

								}
							}
						});
					}
				}
			},
			{ input: '#mobile_number', message: 'must be 11 digits', action: 'keyup, blur, change', rule: function (input, commit)
			 {
			 	if(input.val() != '')
				{
					if(input.val().length<11 || input.val().length>11)
					{
						jQuery("#mobile_number").focus();
					 	return false;

					}
				}
				return true;

			} },
			{ input: '#email_address', message: 'required', action: 'keyup, blur', rule: 'required' },
			{ input: '#email_address', message: 'invalid e-mail', action: 'keyup', rule: 'email' },
			{ input: '#email_address', message: 'duplicate Email', action: 'keyup, blur', rule: function (input,commit) {
					if(input.val()==''){
						commit(true);
						return true
					}
					else
					{

						var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
						var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
						jQuery.ajax({
							type: "POST",
							cache: false,
							url: "<?=base_url()?>user_info/duplicate_field/email_address/<?=$add_edit?>/<?=$id?>",
							data : {[csrfName]: csrfHash,val: input.val()},
							datatype: "json",
							success: function(response){
								var json = jQuery.parseJSON(response);
								jQuery('.txt_csrfname').val(json.csrf_token);
								if(json.Status=='ok')
								{
									commit(true);
									//return true;
								}
								else{
									commit(false);
									//return false;

								}
							}
						});
					}
				}
			},
			{ input: '#mobile_number', message: 'required', action: 'keyup, blur', rule: 'required' },

			{ input: '#email_address', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
				if (jQuery('#acceptterms').is(':checked')) {
					if (jQuery('#email_address').val()=='') {
						commit(false);
						return false
					}
					else{
						commit(true);
					}
				}
				else{
					commit(true);
				}
			}
			},
			{ input: '#designation_id', message: 'required', action: 'blur,change', rule: function (input) {
					if(input.val() != '')
					{
						var item = jQuery("#designation_id").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='designation_id']").val(item.value);}
						return true;
					}
					jQuery("#designation_id input").focus();
					return false;
				}
			},
		 { input: '#department_id', message: 'required', action: 'blur,change', rule: function (input) {

					return true;
					
				}
			}


			]
		});
		jQuery('#employee_ID').focus();

	});
	/*function row_action()
	{
		var item = jQuery("#work_group_id").jqxComboBox('getSelectedItem');
		if(item==null)
		{
			return false;
		}
		if (item.value==17) 
		{
			jQuery('#zone_row').show();
			jQuery('#district_row').hide();
			jQuery('#branch_row').hide();
			jQuery("#district").jqxComboBox('clearSelection');
			jQuery("#branch").jqxComboBox('clearSelection');
		}
		else if(item.value==3)
		{
			jQuery('#zone_row').show();
			jQuery('#district_row').hide();
			jQuery('#branch_row').hide();
			jQuery("#district").jqxComboBox('clearSelection');
			jQuery("#branch").jqxComboBox('clearSelection');
		}
		else if(item.value==2 || item.value==20 || item.value==21)
		{
			jQuery('#zone_row').hide();
			jQuery('#district_row').hide();
			jQuery('#branch_row').hide();
			jQuery("#branch").jqxComboBox('clearSelection');
		}
		else if(item.value==1)
		{
			jQuery('#zone_row').hide();
			jQuery('#district_row').hide();
			jQuery('#branch_row').hide();
			jQuery("#branch").jqxComboBox('clearSelection');
		}
		else if(item.value==4)
		{
			jQuery('#zone_row').show();
			jQuery('#district_row').show();
			jQuery('#branch_row').show();
		}
		else
		{
			jQuery('#zone_row').hide();
			jQuery('#district_row').hide();
			jQuery('#branch_row').hide();
			jQuery("#zone").jqxComboBox('clearSelection');
			jQuery("#district").jqxComboBox('clearSelection');
			jQuery("#branch").jqxComboBox('clearSelection');
		}
	}*/
	function change_dropdown(operation,edit=null)
	{
		var id='';
		if (edit==null) 
		{
			id = jQuery("#"+operation).val();
		}
		else
		{
			id=edit;
		}
		//alert(id);


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

					
					
					if (operation=='zone') 
					{
						var district = [];
						jQuery.each(json['row_info'],function(key,obj){
							district.push({ value: obj.id, label: obj.name });
						});
						jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: 316, height: 16});
						//For edit action
						if (edit!=null) 
						{
							jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
						}
					}
					if (operation=='district') 
					{
						var branch = [];
						jQuery.each(json['row_info'],function(key,obj){
							branch.push({ value: obj.id, label: obj.name });
						});
						jQuery("#branch").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Branch", source: branch, width: 316, height: 16});
						//jQuery("#unit_office").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Unit Office", source: unit_office, width: 316, height: 16});
						//For edit action
						if (edit!=null) 
						{
							
							jQuery("#branch").jqxComboBox('val', '<?=(isset($result->branch) && $result->branch!=0)?$result->branch:''?>');
						}
					}

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        	});

			return false;
	}
	function fileValidation(name){
		//alert(name);
		var fileInput = document.getElementById(name);
	    var filePath = fileInput.value;
	    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
	    var fileSize = document.getElementById(name).files[0].size;
	    if(!allowedExtensions.exec(filePath)){
	        alert('Only jpeg/jpg/png file is allowed');
	        fileInput.value = '';
	        return false;
	    }
	    else if(fileSize>50000)
	    {
	    	alert('File size will be maximum 50KB');
	        fileInput.value = '';
	        return false;
	    }
	    else{
	        if (fileInput.files && fileInput.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('imagePreview_'+name).innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(fileInput.files[0]);
	        }
	    }
	}

	var cdrMessageDialog;
	function initCdrMessageDialog(id,gid) {
		// Define various event handlers for Dialog
		var handleCancel = function() {
			this.hide();
		};
	 var handleCdrMessageSuccess = function(req) {
		var response = eval('(' + req + ')');
		//alert(response.errorMsgs+eval('(' + req + ')')+req)
		if( response.status == 'success') {
			cdrMessageDialog.hide();
			//reload results
			//reloadCurrentMessages();
			jQuery("#msgArea").val('');
			window.parent.jQuery("#error").show();
			window.parent.jQuery("#error").fadeOut(11500);
			window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
			window.top.EOL.messageBoard.close();

		} else {
			$('cdrMessageErrorMsg').innerHTML = response.errorMsgs;
			$('cdrMessageErrorMsg').style.display = '';
			jQuery("#msgArea").val('');
			window.parent.jQuery("#error").show();
			window.parent.jQuery("#error").fadeOut(11500);
			window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;'+response.errorMsgs);
			window.top.EOL.messageBoard.close();
		}
	  };
	 var handleCdrMessageFailure = function(o) {
			showInfoDialog( 'cdrMessagefailuretitle', 'cdrMessagefailurebody', 'WARN' );
	  };

	 var handleSubmit = function() {
	  	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var request =  new Request({
							url: '<?=base_url()?>index.php/user_info/set_default_group_rights',
							method: 'post',
							data: {'id':id,'gid':gid,[csrfName]: csrfHash},
							onSuccess: function(req) {handleCdrMessageSuccess(req);jQuery('.txt_csrfname').val(json.csrf_token);},
							onFailure: function(req) {handleCdrMessageFailure(req);}
						});
		request.send();
		$('cdrMessageDialogConfirm').style.display = 'none';
		$('cdrMessageDialogCancel').style.display = 'none';
		$('loading').style.display = '';

	  };

	  var handleSubmit_go_right_page = function() {
			window.location.href = "<?=base_url()?>index.php/user_info/set_right/"+id+"/"+gid+"/";
	  };

		cdrMessageDialog = new EOL.dialog($('cdrMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'cdrMessageDialog' });

		cdrMessageDialog.afterShow = function() {

			$$('#cdrMessageDialog #cdrMessageDialogConfirm').addEvent('click',handleSubmit);
			$$('#cdrMessageDialog #cdrMessageDialogCancel').addEvent('click',handleSubmit_go_right_page);
		};


		cdrMessageDialog.show();
	}


	function confirm_default_rights(id,gid)
	{
		if (!cdrMessageDialog) {
			initCdrMessageDialog(id,gid);
		}
		cdrMessageDialog.show();
	}
	function reloadCurrentMessages()
	{
		window.location.reload();
	}
	
	
    </script>

    <div  style=" width:100%; margin:auto">
       <form class="form" id="form" method="post" action="<?=base_url()?>user_info/add_edit_action/<?=$add_edit?>/<?=$id?>" enctype="multipart/form-data">
            <div class="formHeader" style="background-color:#185891;">User Information </div>
            <input type="hidden" name="u_logo" id="u_logo" value="0" />
			<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input type="hidden" name="image_name" id="image_name" value="<?=isset($result->picture)?$result->picture:''?>" />
            <table class="register-table" width="60%">
				<tr>
					<td width="15%"><strong>User ID</strong><span style="color:#FF0000">*</span></td>
					<td><input name="employee_ID" type="text" id="employee_ID" value="<?=isset($result->user_id)?$result->user_id:''?>"  class="text-input-big" /></td>
					<td colspan ="4" rowspan="25" style="width:16%;text-align:center" valign="top">
						<span id="imagePreview_picture">
						<?php if ($add_edit=='edit' && $result->picture!=''): ?>
							<img src="<?=base_url()?>user_profile_images/<?=$result->picture;?>" style="margin:5px;border:solid 1px #c0c0c0" title="Image" alt="image" border="1">
						<?php endif ?>
						</span>
						<br/>
						<span id="imagePreview_signature">
						<?php if ($add_edit=='edit' && $result->signature!=''): ?>
							<img src="<?=base_url()?>user_profile_images/<?=$result->signature;?>" style="margin:5px;border:solid 1px #c0c0c0" title="Signature" alt="Signature" border="1">
						<?php endif ?>
						</span>
					</td>
				</tr>
				<? if($add_edit=='add'){?>
				<tr>
					<td style="padding:0 0 10 0"><strong>Password</strong><span style="color:#FF0000">*</span> </td>
					<td style=" color:#005ce6"><input name="pass" type="password" id="pass" maxlength="<?=$sys_config->password_max_length?>" value="" autocomplete="off"  class="text-input-big"  />
						<?
						//if($sys_config->default_password_type=='Custom'){ echo 'By Default password is '.$sys_config->default_password;}
						//else if($sys_config->default_password_type=='Dot'){ echo 'By Default password is Dot';}
						//else if($sys_config->default_password_type=='Random'){ echo 'By Default password is random';}
						?>
					</td>
				</tr>
				<? } ?>
				
                
				<tr>
					<td><strong>User Group</strong><span style="color:#FF0000">*</span></td>
					<td> <div name="work_group_id" class="text-input-big" id="work_group_id"></div>
                    </td>
				</tr>
				<tr>
					<td><strong>Name</strong><span style="color:#FF0000">*</span></td>
					<td><input name="name" type="text" id="name" maxlength="200" value="<?=isset($result->name)?$result->name:''?>"  class="text-input-big" style="text-transform:capitalize" /></td>
				</tr>
				
				<tr id="zone_row" >
					<td><strong>Zone</strong><span style="color:#FF0000">*</span></td>
					<td> <div name="zone" class="text-input-big" id="zone"></div></td>
				</tr>
				
				<tr id="district_row" >
					<td><strong>District</strong><span style="color:#FF0000">*</span></td>
					<td> <div name="district" class="text-input-big" id="district"></div></td>
				</tr>
				<tr id="branch_row" >
					<td><strong>Branch</strong><span style="color:#FF0000">*</span></td>
					<td> <div name="branch" class="text-input-big" id="branch"></div></td>
				</tr>
				<?php
				$depDivStyle="display:none";
                    if(isset($result->branch_name) && $result->branch_name=='Head Office') {
						$depDivStyle="";
					}
				?>
				<tr>
					<td><strong>Department/Division</strong><span id="depDivValidationMark" style="color:#FF0000;<?=$depDivStyle?>">*</span></td>
					<td> <div name="department_id" class="text-input-big" id="department_id"></div></td>
				</tr>
				<tr>
                    <td><strong>Location</strong></td>
                    <td><input name="location" type="text" id="location" value="<?=isset($result->location)?$result->location:''?>" class="text-input-big" /></td>
				</tr>
				<tr>
					<td><strong>Designation</strong><span style="color:#FF0000">*</span></td>
					<td> <div name="designation_id" class="text-input-big" id="designation_id"></div></td>
				</tr>
				  <tr>
                        <td><strong>Functional Designation</strong></td>
                        <td> <div name="fun_designation_id" class="text-input-big" id="fun_designation_id"></div></td>
                    </tr>
				<tr>
					<td><strong>Mobile Phone</strong><span style="color:#FF0000">*</span></td>
					<td><input name="mobile_number" type="text" id="mobile_number" value="<?=isset($result->mobile_number)?$result->mobile_number:''?>" class="text-input-big" /></td>
				</tr>
				<?php
				$emailStyle="";
				//$emailStyle="display:none";
                    if(isset($result->send_email_credential) && $result->send_email_credential==1) {
						$emailStyle="";
					}
				?>
				<tr>
					<td><strong>E-mail</strong><span id="emailValidationMark" style="color:#FF0000;<?=$emailStyle?>">*</span></td>
					<td><input name="email_address" type="text" id="email_address" value="<?=isset($result->email_address)?$result->email_address:''?>" class="text-input-big" /></td>
				</tr>
				<tr>
					<td><strong>Picture</strong></td>
					<td style="text-align: left;">
					<? if($add_edit =='edit' && $result->picture!=''){ ?>
                                    
                        	<img id="file_preview_picture" onclick="popup('<?=base_url()?>user_profile_images/<?=$result->picture?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png">
                        	
                        &nbsp; &nbsp; &nbsp; &nbsp;
                    <? } /*<img onclick="aof_delete(<?=$id?>)" src="<?=base_url()?>images/delete.png" alt="Delete" title="Delete">*/?>
					<input type="file" id="picture" name="picture">
					<input type="hidden" id="hidden_picture" name="hidden_picture" value="<? if($add_edit =='edit'){ echo $result->picture; } ?>" />
                   	<!-- <input type="hidden" id="file_change_sts_picture" name="file_change_sts_picture" value="0"> -->
					</td>
				</tr>
				<tr>
					<td><strong>Signature</strong></td>
					<td style="text-align: left;">
					<? if($add_edit =='edit' && $result->signature!=''){ ?>
                                    
                        	<img id="file_preview_signature" onclick="popup('<?=base_url()?>user_profile_images/<?=$result->signature?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png">
                        	
                        &nbsp; &nbsp; &nbsp; &nbsp;
                    <? } /*<img onclick="aof_delete(<?=$id?>)" src="<?=base_url()?>images/delete.png" alt="Delete" title="Delete">*/?>
					<input type="file" id="signature" name="signature">
					<input type="hidden" id="hidden_signature" name="hidden_signature" value="<? if($add_edit =='edit'){ echo $result->signature; } ?>" />
                    <!-- <input type="hidden" id="file_change_sts_signature" name="file_change_sts_signature" value="0"> -->
					</td>
				</tr>
                <? if($add_edit=='add')
				{?>
				 <tr>
					<td>&nbsp;</td>
					<td ><input type="checkbox" value="1" name="acceptterms" id="acceptterms" <?php if(isset($result->send_email_credential) && $result->send_email_credential==1) { echo "checked";} ?> style="margin:5px 5px 0 0;color:#0066ff"><span style="color:#005ce6">Send user credential to email</span></td>
				</tr>	
                <? }?>
                <tr>
					<td><strong>Bank AC</strong></td>
					<td><input name="bank_ac" type="text" id="bank_ac" value="<?=isset($result->bank_ac)?$result->bank_ac:''?>" class="text-input-big" /></td>
				</tr>
				<tr>
					<td><strong>Remarks</strong> </td>
					<td>
					<textarea name="remarks" maxlength="255" id="remarks" style="width: 316px;" ><?=isset($result->remarks)?$result->remarks:''?></textarea>
					</td>
				</tr>
				<tr>
					<td><strong>Free Field 1</strong> </td>
					<td><input name="Free_Field_1" type="text" id="Free_Field_1" value="<?=isset($result->Free_Field_1)?$result->Free_Field_1:''?>" class="text-input-big" /></td>
				</tr>
				<tr>
					<td><strong>Free Field 2</strong> </td>
					<td><input name="Free_Field_2" type="text" id="Free_Field_2" value="<?=isset($result->Free_Field_2)?$result->Free_Field_2:''?>" class="text-input-big" /></td>
				</tr>
				<tr>
					<td><strong>Free Field 3</strong></td>
					<td> <div name="Free_Field_3" class="text-input-big" id="Free_Field_3"></div></td>
				</tr>

				<tr>
					<td><strong>Free Field 4</strong> </td>
					<td> <div name="Free_Field_4" class="text-input-big" id="Free_Field_4"></div></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: left;padding-left:178px"><br><input type="button" value="<?php if($add_edit=="add") { echo "  Create User  ";} else{ echo "  Update User  ";}?>" id="sendButton" class="btn-small btn-small-normal enabledElem" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:55px;width:120px;font-family: sans-serif;font-size: 16px;"/> <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></td>
				</tr>

			</table>
        </form>
    </div>
    <div id="cdrMessageDialogContent"  style="display:none">
          <div class=""><h2 class="conf">User account successfully created.<br>
		  <br>Do you want to set default group privilege for this user account?</h2></div>
          	<div class="bd">
              <div class="inlineError" id="cdrMessageErrorMsg" style="display:none"></div>
            </div>
            <a class="btn-small btn-small-normal" id="cdrMessageDialogConfirm"><span>Yes</span></a>
            <a class="btn-small btn-small-secondary" id="cdrMessageDialogCancel"><span>Cancel</span></a>
            <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </div>
<script type="text/javascript">
	function popup(url) {
		var winl = (screen.width - 900) / 2;
		var wint = 40;
		newwindow=window.open(url,'name','height=600, width=900,top='+wint+', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left='+winl);
		if (window.focus) {newwindow.focus()}
		return false;
	}
	var options = { 
			complete: function(response) 
			{
				var json = jQuery.parseJSON(response.responseText); 
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				jQuery('.txt_csrfname').val(json.csrf_token);
				if(json.Message!='OK')
				{
					jQuery("#sendButton").show();
					jQuery("#loading").hide();
					alert(json.Message);
					return false;
				}
				else
				{
					var row = {};
					row["id"] = json['row_info'].id;
					row["user_id"] = json['row_info'].user_id;
					row["name"] = json['row_info'].name;
					row["department_name"] = json['row_info'].department_name;
					row["mobile_number"] = json['row_info'].mobile_number;
					row["email_address"] = json['row_info'].email_address;
					row["lock_status"] = json['row_info'].lock_status;
					row["block_status"] = json['row_info'].block_status;
					row["unblock_status"] = json['row_info'].unblock_status;
					row["user_group_id"] = json['row_info'].user_group_id;
					row["group_name"] = json['row_info'].group_name;
					row["send_to_checker"] = json['row_info'].send_to_checker;
					row["verify_status"] = json['row_info'].verify_status;
					row["data_status"] = json['row_info'].data_status;
					row["admin_status"] = json['row_info'].admin_status;
					row["password_change_status"] = json['row_info'].password_change_status;

					window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
					<? if($add_edit=='add'){?>
					var paginginformation = window.parent.jQuery("#jqxgrid").jqxGrid('getpaginginformation');
					var insert_index=paginginformation.pagenum*paginginformation.pagesize;
					var commit = window.parent.jQuery("#jqxgrid").jqxGrid('addrow', null, row,insert_index);
					window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', insert_index);
					<? } else if($add_edit=='edit'){?>
					jQuery.each(row, function(key,val){
						//alert(key+" "+val);
						window.parent.jQuery("#jqxgrid").jqxGrid('setcellvalue', <?=$editrow?>, key, row[key]);
					});
					window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?=$editrow?>);
					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					<? } ?>


					<? if($add_edit=='add'){?>
							//alert(1);
							confirm_default_rights(json['row_info'].id,json['row_info'].user_group_id);
					<? }else{?>
						jQuery("#msgArea").val('');
						window.parent.jQuery("#error").show();
						window.parent.jQuery("#error").fadeOut(11500);
						window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
						window.top.EOL.messageBoard.close();
					<? }?>
				}
							
			}  
		}; 
		jQuery("#form").ajaxForm(options);
		jQuery("#sendButton").click(function() {
			var validationResult = function (isValid) {
				if (isValid) {
					jQuery("#sendButton").hide();
					jQuery("#loading").show();
					jQuery("#form").submit();
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);		
		});
</script>