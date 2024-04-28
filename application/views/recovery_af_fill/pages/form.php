
<script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>
<!--  styling starts: -->
<style type="text/css">
	#cto_data_table {
		border-collapse: collapse;
	}

	#cto_data_table,
	#cto_data_table th,
	#cto_data_table td {
		border-color: #c7c7c7;
	}

	.text-input-medium {
		width: 250px;
	}

	.addmore {
		background-image: url(<?= base_url() ?>images/addmore_grn.png);
		/*background-size: 20px 20px;*/
		background-repeat: no-repeat;
		border: 0;
		width: 18px;
		height: 18px;
		background-color: transparent;
		cursor: pointer;
	}

	.del {
		background-image: url(<?= base_url() ?>images/del.png);
		background-repeat: no-repeat;
		border: 0;
		width: 18px;
		height: 18px;
		background-color: transparent;
		cursor: pointer;
	}

	.edit {
		background-image: url(<?= base_url() ?>images/edit.png);
		background-repeat: no-repeat;
		border: 0;
		width: 18px;
		height: 18px;
		background-color: transparent;
		cursor: pointer;
	}

	.nextButton {
		float: right;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

	.backButton {
		float: left;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

	#tab1Table td,
	#tab3Table td,
	#tab2Table td {
		vertical-align: top;
	}

	table#addressTable {
		border-collapse: collapse;
	}

	table#addressTable,
	#addressTable th,
	#addressTable td {
		border: 1px solid #c7c7c7;
	}

	table#addressTablet {
		border-collapse: collapse;
	}

	table#addressTablet,
	#addressTablet th,
	#addressTablet td {
		border: 1px solid #c7c7c7;
	}

	table#facility_info td {
		border: 1px solid #c7c7c7;
		text-align: center;
	}

	table#loanTable {
		border-collapse: collapse;
	}

	table#loanTable,
	#loanTable th,
	#loanTable td {
		border: 1px solid #c7c7c7;
	}

	table#loanTable_detail {
		border-collapse: collapse;
	}

	table#guarantor_info td {
		border: 1px solid #c7c7c7;
		text-align: center;
	}

	table#loanTable_detail,
	#loanTable_detail th,
	#loanTable_detail td {
		border: 1px solid #c7c7c7;
	}

	#loanTable_detail th,
	#loanTable_detail td {
		text-align: center;
	}

	#addressTable th,
	#addressTable td {
		text-align: center;
	}

	#addressTablet th,
	#addressTablet td {
		text-align: center;
	}

	#loanTable th,
	#loanTable td {
		text-align: center;
	}

	table#owner_addressTable {
		border-collapse: collapse;
	}

	table#owner_addressTable,
	#owner_addressTable th,
	#owner_addressTable td {
		border: 1px solid #c7c7c7;
	}

	#owner_addressTable th,
	#owner_addressTable td {
		text-align: center;
	}

	table#owner_addressTablet {
		border-collapse: collapse;
	}

	table#owner_addressTablet,
	#owner_addressTablet th,
	#owner_addressTablet td {
		border: 1px solid #c7c7c7;
	}

	#owner_addressTablet th,
	#owner_addressTablet td {
		text-align: center;
	}

	#ownerTable {
		border-collapse: collapse;
	}

	#ownerTable,
	#ownerTable th,
	#ownerTable td {
		border-color: #c7c7c7;
	}

	.hint {

		color: red;
	}

	.section {
		padding: 5px;
	}

	#hintWrapper {
		float: left;
		margin: 10px;
	}

	.jqx-window-modal {
		height: 625px !important;
	}

	.nextButton {
		float: right;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

	.backButton {
		float: left;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

	#sectionButtonsWrapper {
		float: right;
	}

	#basketButtonsWrapper {
		float: right;

	}

	#selectedProductsButtonsWrapper {
		float: right;

	}

	#ownerSave,
	#addmoreOwner {
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

	.dateSpan {
		font-weight: normal;
		font-size: 12px;
		color: #808080;
	}

	.tablescroll #headerTable td {
		border: none;
	}

	.headSpan {
		float: left;
		font-weight: bold;
		font-size: 9pt;
		cursor: pointer;
	}
</style>

<!--   styling Ends:  -->


<script type="text/javascript">
	var csrf_tokens = '';

	jQuery(document).ready(function() {







		var theme = getDemoTheme();
		jQuery('#in_req_button').jqxButton({
			template: "default",
			width: "150"
		});



		jQuery('#ac_type').on('change', function() {

			var get_value = jQuery('#ac_type').val();

			if (get_value == "Card") {
				jQuery('#card_no_row').show();
				jQuery('#investment_ac_no_row').hide();


			} else {
				jQuery('#card_no_row').hide();
				jQuery('#investment_ac_no_row').show();
			}



		});




		jQuery('#collection_method').on('change', function() {

			var get_value = jQuery('#collection_method').val();

			if (get_value == 1) {
				jQuery('#bank_name_row').show();
				jQuery('#branch_name_row').show();

				jQuery('#po_number_row').show();
				jQuery('#cheque_number_row').hide();

			}


			if (get_value == 2) {
				jQuery('#bank_name_row').show();
				jQuery('#branch_name_row').show();
				jQuery('#po_number_row').hide();
				jQuery('#cheque_number_row').show();
			}
		});





		var collection_method = [<? $i = 1;
									foreach ($collection_method as $key => $row) {

										if ($i != 1) {
											echo ',';
										}
										echo '{value:"' . $key . '", label:"' . $row . '"}';
										$i++;
									} ?>];


		var representative_user = [<? $i = 1;
									foreach ($representative_user as $row) {
										if ($i != 1) {
											echo ',';
										}
										echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
										$i++;
									} ?>];

		var bank_name = [<? $i = 1;
							foreach ($bank_name as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];

		var branch_name = [<? $i = 1;
							foreach ($branch_name as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];


		var ac_type = ["Investment", "Card"];





		jQuery('.text-input').addClass('jqx-input');
		jQuery('.text-input').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input').addClass('jqx-input-' + theme);
			jQuery('.text-input').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input').addClass('jqx-rc-all-' + theme);
		}

		//Combobox
		jQuery("#collection_method").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Collection Method",
			source: collection_method,
			width: 250,
			height: 25
		});

		jQuery("#representative_user").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Representative User",
			source: representative_user,
			width: 250,
			height: 25
		});

		jQuery("#bank_name").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Bank Name",
			source: bank_name,
			width: 250,
			height: 25
		});

		jQuery("#branch_name").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Branch Name",
			source: branch_name,
			width: 250,
			height: 25
		});

		jQuery("#ac_type").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Proposed Type",
			source: ac_type,
			width: 250,
			height: 25
		});

		jQuery('#collection_method,#representative_user,#branch_name,bank_name,#ac_type').focusout(function() {
			//alert(jQuery(this).attr('id'));
			commbobox_check(jQuery(this).attr('id'));
		});


		<? if ($add_edit == 'edit') { ?>
			jQuery("#ac_type").jqxComboBox('val', '<?= (isset($result->ac_type)) ? $result->ac_type : '' ?>');
			jQuery("#collection_method").jqxComboBox('val', '<?= (isset($result->collection_method) && $result->collection_method != 0) ? $result->collection_method : '' ?>');
			jQuery("#representative_user").jqxComboBox('val', '<?= (isset($result->representative_user) && $result->representative_user != 0) ? $result->representative_user : '' ?>');
			jQuery("#branch_name").jqxComboBox('val', '<?= (isset($result->branch_name) && $result->branch_name != 0) ? $result->branch_name : '' ?>');
			jQuery("#bank_name").jqxComboBox('val', '<?= (isset($result->bank_name) && $result->bank_name != 0) ? $result->bank_name : '' ?>');
			jQuery("#recive_date").val('<?= (isset($result->recive_date) && $result->recive_date != 0) ? $result->recive_date : '' ?>');

		<? } ?>

		<? if ($add_edit == 'edit') { ?>
			jQuery("#doc_file").change(function() {
				if (jQuery("#file_change_sts").val() == '0') {
					if (confirm('Are you sure to replace previous file?')) {
						jQuery("#file_change_sts").val('1');
						jQuery("#file_preview").hide();
					} else {
						jQuery("#doc_file").val('');
						return false;
					}
				}
			});
		<? } ?>
		// initialize validator.
		var acLength = <?php echo $acLength; ?>;
		validToggle = 0;

		jQuery('#doc_file_upload_form').jqxValidator({
			rules: [

				{
					input: '#investment_ac_no',
					message: 'Required',
					action: 'keyup, blur, change',
					rule: function(input, commit) {
						if (input.val() == '') {
							return false;
						} else {
							return true;
						}


					}
				},

				{
					input: '#investment_ac_no',
					message: 'Only Numeric',
					action: 'keyup, blur, change',
					rule: function(input, commit) {
						if (input.val() != '') {
							if (checknumber_alphabaticwithstar("investment_ac_no")) {
								return true;
							} else {
								return false;
							}
						} else {
							return true;
						}


					}
				},
				{
					input: '#investment_ac_no',
					message: 'must be ' + acLength.join(" or ") + " Digits",
					action: 'keyup, blur, change',
					rule: function(input, commit) {
						if (input.val() != '') {

							if (jQuery.inArray(String(input.val().length), acLength) != -1) {
								return true;
							} else {
								return false;
							}

						}
						return true;

					}
				},

				{
					input: '#case_number',
					message: 'Required!',
					action: 'blur, change',
					rule: function(input) {
						if (input.val() != '') {
							return true;
						}
						return false;
					}
				},


				{
					input: '#account',
					message: 'Required!',
					action: 'blur, change',
					rule: function(input) {
						if (input.val() != '') {
							return true;
						}
						return false;
					}
				},

				{
					input: '#recive_date',
					message: 'Require!',
					action: 'keyup, blur, change',
					rule: function(input, commit) {
						if (input.val() != '') {
							return true;
						} else {
							return false;
						}
					}
				},

				{
					input: '#collection_method',
					message: 'Required!',
					action: 'blur, change',
					rule: function(input) {
						if (input.val() != '') {
							var item = jQuery("#collection_method").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='collection_method']").val(item.value);
							}
							return true;
						}
						return false;
					}
				},

				{
					input: '#ac_type',
					message: 'Required!',
					action: 'blur, change',
					rule: function(input) {
						if (input.val() != '') {
							var item = jQuery("#ac_type").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='ac_type']").val(item.value);
							}
							return true;
						}
						return false;
					}
				},

				{
					input: '#representative_user',
					message: 'Required!',
					action: 'blur, change',
					rule: function(input) {
						if (input.val() != '') {
							var item = jQuery("#representative_user").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='representative_user']").val(item.value);
							}
							return true;
						}
						return false;
					}
				},

				{
					input: '#bank_name',
					message: 'Required!',
					action: 'blur, change',
					rule: function(input) {
						if (input.val() != '') {
							var item = jQuery("#bank_name").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='bank_name']").val(item.value);
							}
							return true;
						}
						else 
						{
							var item = jQuery("#collection_method").jqxComboBox('getSelectedItem');
							if(item!=null && item.value=='1' || item.value=='2')
							{
								return false;
							}
							return true;
						}
						return true;
					}
				},

				{
					input: '#branch_name',
					message: 'Required!',
					action: 'blur, change',
					rule: function(input) {
						if (input.val() != '') {
							var item = jQuery("#branch_name").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='branch_name']").val(item.value);
							}
							return true;
						}
						return false;
					}
				},




				// {
				// 	input: '#doc_file',
				// 	message: 'Required!',
				// 	action: 'blur, change',
				// 	rule: function(input) {

				// 		if (jQuery("#hidden_doc_file").val() != '') {
				// 			return true;
				// 		} else if (input.val() != '' && jQuery("#hidden_doc_file").val() == '') {
				// 			return true;
				// 		}
				// 		return false;
				// 	}
				// }
			]
		});
		jQuery('#doc_file_upload_form').jqxValidator({
			onError: function() {
				validToggle = 0;
			}
		});
		jQuery('#doc_file_upload_form').jqxValidator({
			onSuccess: function() {
				validToggle = 1;
			}
		});

		<? if ($add_edit == 'add') { ?>

			jQuery("#ac_type").jqxComboBox('val', 'Investment');


		<?php } ?>






		<?php if ($this->session->userdata['ast_user']['branch_code']) { ?>

           jQuery("#branch_name").jqxComboBox('val',<?php echo $this->session->userdata['ast_user']['branch_code'] ?>);
           
           jQuery("#branch_name").jqxComboBox({
           	disabled:true
           });



       <?php }  ?>

	});

	function certificate_file_validation() {

		<? if ($add_edit == 'add') { ?>

			// if (jQuery("#investment_ac_no").val() == '') {
			// 	alert('Doc Name Needed!!');
			// 	return false;
			// } else if (jQuery("#investment_ac_no").val() == '') {
			// 	alert('Doc Name Needed!!');
			// 	return false;
			// } else {
			return true;
			// }





		<? } ?>
		<? if ($add_edit == 'edit') { ?>


			return true;

		<? } ?>

	}

	function mask(str, textbox) {
		var item = jQuery("#ac_type").jqxComboBox('getSelectedItem');
		if (item.value == 'Card') {
			if (!str.includes("*") && str.length == 16) //For one time value paste
			{
				var length = str.length;
				var first_6 = str.slice(0, 6);
				var mid = '******';
				var last_6 = str.slice(12, 16);
				var final_str = first_6 + mid + last_6;
				textbox.value = final_str
				jQuery("#hidden_loan_ac").val(str);
			} else //For single value enter
			{
				//For New value
				var orginal_loan_ac = jQuery("#hidden_loan_ac").val();
				if (orginal_loan_ac.length < str.length) {
					var index = str.length - 1;
					var new_val = str.slice(index);
					orginal_loan_ac += new_val;
					//alert(orginal_loan_ac);
					jQuery("#hidden_loan_ac").val(orginal_loan_ac);
				}
				//For delete key
				else {
					var len = str.length;
					var new_val = orginal_loan_ac.slice(0, len);
					jQuery("#hidden_loan_ac").val(new_val);
				}
				//For First 6 key
				if (str.length <= 6) {
					textbox.value = str
				}
				//for the last 4 key
				else if (str.length >= 13) {
					textbox.value = str
				}
				//For the middle 4 key
				else {
					var length = str.length;
					var first_6 = str.slice(0, 6);
					var mid = (str.length - 6);
					var final_str = first_6;
					for (var i = 1; i <= mid; i++) {
						final_str += '*';
					}
					textbox.value = final_str
				}

				if (str.length == 16) //wrong input check
				{
					var letter_Count = 0;
					var letter = '*';
					for (var position = 0; position < str.length; position++) {
						if (str.charAt(position) == letter) {
							letter_Count += 1;
						}
					}
					if (letter_Count < 6 || jQuery("#hidden_loan_ac").val().length != 16) {
						textbox.value = '';
						jQuery("#hidden_loan_ac").val('');
						alert('Wrong way to input Card No please try again');
					}
				}
			}
		}
	}

</script>

<body style="height:94%;">
	<div style=" width:99.8%; margin:auto">
		<div class="form">
			<div class="formHeader" style="background-color:#185891;">Recovery After Filing</div>
		</div>
		<div style="width:96%;margin: auto;paddding: 10px;">
			<form class="form" name="doc_file_upload_form" id="doc_file_upload_form" method="post" action="<?= base_url() ?>index.php/Recovery_af_fill/add_edit_action/<?= $add_edit ?>/<?= $id ?>" enctype="multipart/form-data">

				<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

				<input type="hidden" id="add_edit" value="<?= $add_edit ?>" name="add_edit">
				<input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">

				<table style="width:100%" id="tab1Table">
					<tbody>
						<tr>
							<td colspan="2">


								<table style="width: 100%;">

									<tr>
										<td width="20%" style="font-weight: bold;">Proposed Type<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="ac_type" name="ac_type" tabindex="2"></div>
										</td>

									</tr>


									<tr id="card_no_row" style="display: none;">
										<td width="20%" style="font-weight: bold;">Card No.<span style="color:red">*</span> </td>
										<td width="30%"><input type="text" style="width:248px" id="card_no" name="card_no" value="<?= isset($result->card_no) ? $result->card_no : '' ?> " onKeyUp="javascript:return mask(this.value,this);"></td>
									</tr>



									<tr id="investment_ac_no_row">
										<td width="20%" style="font-weight: bold;">Investment A/C Number:<span style="color:red">*</span> </td>
										<td width="30%"><input type="text" style="width:248px" id="investment_ac_no" name="investment_ac_no" value="<?= isset($result->investment_ac_no) ? $result->investment_ac_no : '' ?>"></td>
									</tr>



									<tr>
										<td width="20%" style="font-weight: bold;">Case Number:<span style="color:red">*</span> </td>
										<td width="30%"><input type="text" style="width:248px" id="case_number" name="case_number" value="<?= isset($result->case_number) ? $result->case_number : '' ?>"></td>

									</tr>
									<tr>
										<td width="20%" style="font-weight: bold;">Amount:<span style="color:red">*</span> </td>
										<td width="30%"><input type="number" step="any" style="width:248px" id="account" name="account" value="<?= isset($result->amount) ? $result->amount : '' ?>"></td>
									</tr>

									<tr>


										<td width="20%" style="font-weight: bold;">Receive Date:<span style="color:red">*</span> </td>
										<td width="60%">
											<input style="width:245px" name="recive_date" id="recive_date" type="text" class="text-input" placeholder="dd/mm/yyyy">
											<script type="text/javascript">
												datePicker("recive_date");
											</script>
										</td>
									</tr>

									<tr id="branch_name_row">
										<td width="20%" style="font-weight: bold;">Branch Name: <span style="color:red">*</span> </td>
										<td>
											<div id="branch_name" name="branch_name"></div>
										</td>
									</tr>
									<tr>
										<td width="20%" style="font-weight: bold;">Collection Methods: <span style="color:red">*</span> </td>
										<td width="30%">
											<div id="collection_method" name="collection_method"></div>
										</td>
									</tr>
									<!-- After Select Collection Methods -->
									<tr id="bank_name_row" style="display: none;">
										<td width="20%" style="font-weight: bold;">Bank Name: <span style="color:red">*</span> </td>
										<td>
											<div id="bank_name" name="bank_name"></div>
										</td>
									</tr>
				
									<tr id="po_number_row" style="display: none;">
										<td width="20%" style="font-weight: bold;">PO NO: </td>
										<td width="30%"><input type="text" style="width:250px" id="po_no" name="po_no" value="<?= isset($result->po_no) ? $result->po_no : '' ?>"></td>

									</tr>

									<tr id="cheque_number_row" style="display: none;">
										<td width="20%" style="font-weight: bold;">Cheque NO: <span style="color:red">*</span> </td>
										<td width="30%"><input type="text" style="width:250px" id="cheque_no" name="cheque_no" value="<?= isset($result->cheque_no) ? $result->cheque_no : '' ?>"></td>

									</tr>

									<!-- After Select Collection Methods -->
									<tr>


										<td width="20%" style="font-weight: bold;">Responsive/Representative<span style="color:red">*</span> </td>
										<td width="30%">

											<div id="representative_user" name="representative_user"></div>

										</td>


									<tr>
										<td width="20%" style="font-weight: bold;">Doc File : </td>
										<td style="text-align: left;">
											<? if ($add_edit == 'edit' && $result->doc_file != '') { ?>
												<img id="file_preview" onclick="popup('<?= base_url() ?>doc_files/<?= $result->doc_file ?>')" style=" cursor:pointer;text-align:center" height="18" src="<?= base_url() ?>old_assets/images/print-preview.png">

												&nbsp; &nbsp; &nbsp; &nbsp;
											<? } /*<img onclick="aof_delete(<?=$id?>)" src="<?=base_url()?>images/delete.png" alt="Delete" title="Delete">*/ ?>
											<input type="file" id="doc_file" name="doc_file">
											<input type="hidden" id="hidden_doc_file" name="hidden_doc_file" value="<? if ($add_edit == 'edit') {
																														echo $result->doc_file;
																													} ?>" />
											<input type="hidden" id="file_change_sts" name="file_change_sts" value="0">
										</td>
									</tr>
						</tr>
						<tr>
							<td width="20%" style="font-weight: bold;">Remarks:</td>
							<td width="30%"><textarea name="remarks" class="text-input-big" id="remarks" style="height:40px !important;width:250px"><?= isset($result->remarks) ? $result->remarks : '' ?></textarea></td>
						</tr>

				</table>
				</td>
				</tr>


				</tbody>
				</table>
				<div style="text-align:left;  margin-left: 320px;">
					<input type="button" value="Save" id="in_req_button" class="" /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
				</div>

			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
	function popup(url) {
		var winl = (screen.width - 900) / 2;
		var wint = 40;
		newwindow = window.open(url, 'name', 'height=600, width=900,top=' + wint + ', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left=' + winl);
		if (window.focus) {
			newwindow.focus()
		}
		return false;
	}
	var options = {
		complete: function(response) {

			var json = jQuery.parseJSON(response.responseText);
			window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
			jQuery('.txt_csrfname').val(json.csrf_token);
			if (json.Message != 'OK') {
				jQuery("#in_req_button").show();
				jQuery("#in_req_loading").hide();
				alert(json.Message);
				return false;
			} else {
				var row = {};
				// console.log(json['row_info']);

				row["id"] = json['row_info'].id;
				row["sts"] = json['row_info'].sts;
				row["v_sts"] = json['row_info'].v_sts;
				row["stc_sts"] = json['row_info'].stc_sts;
				row["e_dt"] = json['row_info'].e_dt;

				row["investment_ac_no"] = json['row_info'].investment_ac_no;
				row["case_number"] = json['row_info'].case_number;
				row["account"] = json['row_info'].account;

				row["recive_date"] = json['row_info'].recive_date;


				row["remarks"] = json['row_info'].remarks;
				row["collection_method"] = json['row_info'].collection_method;
				row["bank_name"] = json['row_info'].bank_name;
				row["branch_name"] = json['row_info'].branch_name;
				row["po_no"] = json['row_info'].po_no;
				row["representative_user"] = json['row_info'].representative_user;
				row["doc_file"] = json['row_info'].doc_file;
				row["remarks"] = json['row_info'].remarks;


				window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
				jQuery("#msgArea").val('');
				window.parent.jQuery("#error").show();
				window.parent.jQuery("#error").fadeOut(11500);
				window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Saved');
				window.top.EOL.messageBoard.close();
			}

		}
	};
	jQuery("#doc_file_upload_form").ajaxForm(options);
	jQuery("#in_req_button").click(function() {
		var validationResult = function(isValid) {
			if (isValid && certificate_file_validation() == true) {
				jQuery("#in_req_button").hide();
				jQuery("#in_req_loading").show();
				jQuery("#doc_file_upload_form").submit();
			}
		}
		jQuery('#doc_file_upload_form').jqxValidator('validate', validationResult);
	});
</script>