<?php $this->load->view('cma_process/pages/css'); ?>




<!--Customization Start-->
<script type="text/javascript">
	var csrf_tokens = '';
	//var idd = 0; var indxx = 0;

	jQuery(document).ready(function($) {
		var theme = 'classic';
		var proposed_type = ['Investment', 'Card'];
		jQuery("#proposed_type").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Proposed Type",
			source: proposed_type,
			width: 150,
			height: 25
		});
		jQuery('#s_proposed_type').focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});
		s_change_caption();
		jQuery('#proposed_type').bind('change', function(event) {
			jQuery("#loan_ac").val('');
			jQuery("#hidden_loan_ac").val('');
			s_change_caption();
		});

		jQuery("#delete_button").click(function() {
			var validationResult = function(isValid) {
				if (isValid) {
					jQuery("#delete_button").hide();
					jQuery("#deletecancel").hide();
					jQuery("#delete_loading").show();
					call_ajax_submit();
				}
			}
			jQuery('#action_form').jqxValidator('validate', validationResult);
		});
		jQuery("#sendtochecker").click(function() {
			if (jQuery('#checker_to_notify').val() == '' || jQuery('#checker_to_notify').val() == 0 || jQuery('#checker_to_notify').val() == null || jQuery('#checker_to_notify').val() == 'undefined') {
				alert('The checker to notify field is required!');
				jQuery('#checker_to_notify').focus();
				return;
			} else {
				jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
				call_ajax_submit();
			}
		});
		jQuery('#action_form').jqxValidator({
			rules: [{
					input: '#comments',
					message: 'required!',
					action: 'keyup, blur',
					rule: function(input, commit) {
						if (jQuery("#comments").val() == '') {
							jQuery("#comments").focus();
							return false;
						} else {
							return true;
						}
					}
				},

				{
					input: '#comments',
					message: 'more than 250 characters',
					action: 'keyup, blur, change',
					rule: function(input, commit) {
						if (input.val() != '') {
							if (input.val().length > 250) {
								jQuery("#comments").focus();
								return false;

							}
						}
						return true;

					}
				},

			]
		});

		<? if (ADD == 1) { ?>
			//jQuery("#sendButton").jqxButton({template:"primary",width:"170"});
		<? } ?>
		var source = {
			datatype: "json",
			datafields: [{
					name: 'id',
					type: 'int'
				},
				{
					name: 'v_sts',
					type: 'int'
				},
				{
					name: 'sts',
					type: 'string'
				},
				{
					name: 'ac_type',
					type: 'string'
				},
				{
					name: 'investment_ac',
					type: 'string'
				},
				{
					name: 'cif_no',
					type: 'string'
				},
				{
					name: 'account_name',
					type: 'string'
				},
				{
					name: 'e_by',
					type: 'string'
				},
				{
					name: 'e_dt',
					type: 'string'
				},
				{
					name: 'case_file_expiry_date',
					type: 'string'
				}, {
					name: 'case_expire_date',
					type: 'string'
				}

			],
			addrow: function(rowid, rowdata, position, commit) {
				commit(true);
			},
			deleterow: function(rowid, commit) {
				commit(true);
			},
			updaterow: function(rowid, newdata, commit) {
				commit(true);
			},
			url: '<?= base_url() ?>index.php/cma_process/grid',
			cache: false,
			filter: function() {
				// update the grid and send a request to the server.
				jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
			},
			sort: function() {
				// update the grid and send a request to the server.
				jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
			},
			root: 'Rows',
			beforeprocessing: function(data) {
				if (data != null) {
					//alert(data[0].TotalRows)
					source.totalrecords = data[0].TotalRows;
				}
			}

		};

		var dataadapter = new jQuery.jqx.dataAdapter(source, {
			loadError: function(xhr, status, error) {
				alert(error);
			},
			formatData: function(data) {
				var loan_ac = jQuery.trim(jQuery('#loan_ac').val());
				var cif = jQuery.trim(jQuery('#cif').val());
				var ac_name = jQuery.trim(jQuery('#ac_name').val());
				var ac_type = jQuery.trim(jQuery('#proposed_type').val());
				var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac').val());
				// alert(status);
				// return;
				jQuery.extend(data, {
					loan_ac: loan_ac,
					cif: cif,
					ac_name: ac_name,
					ac_type: ac_type,
					hidden_loan_ac: hidden_loan_ac,
				});
				return data;
			}
		});
		var cellclassname = function(row, columnfield, value, rowdata) {
			var editrow = row;
			var dataRecord = jQuery("#jqxgrid").jqxGrid("getrowdata", editrow);

			if ((dataRecord.return_reason != "" && (dataRecord.cma_sts == 4 || dataRecord.cma_sts == 5 || dataRecord.cma_sts == 9)) || dataRecord.cma_sts == 103) {
				return "errormsg";
			} else if (dataRecord.return_reason != "" && (dataRecord.cma_sts == 2 || dataRecord.cma_sts == 3)) {
				return "successmsg";
			}
		};
		var columnCheckBox = null;
		var updatingCheckState = false;
		// initialize jqxGrid. Disable the built-in selection.
		var celledit = function(row, datafield, columntype) {
			var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
			if (checked == false) {
				return false;
			};
		};

		var cellsrenderer = function(row, column, value) {
			return '<div style="text-align: left; margin-top: 10px;">' + value + '</div>';
		}
		var columnsrenderer = function(value) {
			return '<div style="text-align: left; margin-top: 10px;margin-left:5px;">' + value + '</div>';
		}
		var win_h = jQuery(window).height() - 300;
		jQuery("#jqxgrid").jqxGrid({
			width: '99%',
			height: win_h,
			source: dataadapter,
			theme: theme,
			filterable: true,
			sortable: true,
			//autoheight: true,
			pageable: true,
			virtualmode: true,
			editable: true,
			enablehover: true,
			pagesize: 50,
			enablebrowserselection: true,
			selectionmode: 'none',
			rendergridrows: function(obj) {
				return obj.data;
			},

			columns: [{
					text: 'Id',
					datafield: 'id',
					cellclassname: cellclassname,
					hidden: true,
					editable: false,
					width: '4%'
				},
				{
					text: 'CMA',
					menu: false,
					datafield: 'sendtochecker',
					align: 'center',
					editable: false,
					sortable: false,
					width: '5%',
					cellsrenderer: function(row) {
						editrow = row;
						var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);


						var c_date = '<?php echo date("Y-m-d"); ?>';
						if (c_date <= dataRecord.case_file_expiry_date) {

							if (dataRecord.v_sts == 106) {

								return '<div style="text-align:center;"><a style="text-align:center;margin-top: 5px;  cursor:pointer" href="<?php echo base_url('cma_process/view/' . $menu_group . '/' . $menu_cat . '/' . $menu_link . '/'); ?>running/' + dataRecord.id + '" ><img align="center" src="<?= base_url() ?>images/contactsIcon.png"></a></div>';
							} else {
								return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
							}
						} else {
							return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
						}


					}
				},
				{
					text: 'A/C Type',
					datafield: 'ac_type',
					editable: false,
					width: '15%'
				},
				{
					text: 'A/C Number',
					datafield: 'investment_ac',
					editable: false,
					width: '15%'
				},
				{
					text: 'CID Number',
					datafield: 'cif_no',
					editable: false,
					width: '15%'
				},
				{
					text: 'A/C Name',
					datafield: 'account_name',
					editable: false,
					width: '15%'
				},
				{
					text: 'Expire Date',
					datafield: 'case_expire_date',
					editable: false,
					width: '15%'
				},

			],
			ready: function() {
				var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
				$('#jqxgrid').jqxGrid({
					pagesizeoptions: ['25', '100', '200']
				});
			}
		});


		// jqx tab init
		var initWidgets = function(tab) {
			switch (tab) {
				case 0:
					break;
				case 1:
					//initGrid2();
					break;
			}
		}
		//document.getElementById("jqxTabs").style.minHeight = "280px";
		jQuery('#jqxTabs').jqxTabs({
			width: '99%',
			initTabContent: initWidgets
		});

		jQuery('#jqxTabs').bind('selected', function(event) {

			if (event.args.item == 0) {
				//clear_form();
			}

		});


		jQuery("#details").jqxWindow({
			theme: theme,
			width: '75%',
			height: '90%',
			resizable: false,
			isModal: true,
			autoOpen: false,
			cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel")
		});
		jQuery("#r_history").jqxWindow({
			theme: theme,
			width: '100%',
			height: '90%',
			resizable: false,
			isModal: true,
			autoOpen: false,
			cancelButton: jQuery("#r_ok")
		});
		jQuery('#details').on('close', function(event) {
			jQuery('#action_form').jqxValidator('hide');
		});


	});

	function s_mask(str, textbox) {
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		if (item != null) {
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

	}

	function s_change_caption() {
		if (jQuery("#proposed_type").val() == '') {
			document.getElementById("loan_ac").disabled = true;
			jQuery("#s_l_or_c_no").html('Investment A/C or Card');
		} else {
			document.getElementById("loan_ac").disabled = false;
			var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
			if (item.value == 'Investment') {
				jQuery("#s_l_or_c_no").html('Investment A/C ');
			} else if (item.value == 'Card') {
				jQuery("#s_l_or_c_no").html('Card');
			}
		}

	}

	function r_history(id, life_cycle = null) {
		if (life_cycle == 'life_cycle') {
			jQuery("#r_heading").html('Life Cycle');
		} else {
			jQuery("#r_heading").html('Decline/Return Reason History');
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?= base_url() ?>cma_process/r_history",
			data: {
				[csrfName]: csrfHash,
				id: id,
				life_cycle: life_cycle
			},
			datatype: "json",
			success: function(response) {
				//alert(response);
				var json = jQuery.parseJSON(response);

				jQuery('.txt_csrfname').val(json.csrf_token);
				if (json['row_info']) {
					document.getElementById("r_history").style.visibility = 'visible';
					var html = '';
					jQuery.each(json['row_info'], function(key, obj) {
						html += '<tr>';
						html += '<td align="left">' + obj.oprs_sts + '</td>';
						html += '<td align="left">' + obj.r_by + '</td>';
						html += '<td align="center">' + obj.oprs_dt + '</td>';
						html += '<td align="left">' + obj.oprs_descriptions + '</td>';
						if (obj.oprs_reason != null) {
							html += '<td align="center">' + obj.oprs_reason + '</td>';
						} else {
							html += '<td align="center"></td>';
						}
						html += '</tr>';
					});
					jQuery("#r_history_details").html(html);
					jQuery("#r_history").jqxWindow('open');
				} else {
					alert("Something went wrong, please refresh the page.")
				}

			}
		});
	}

	function editt(val, indx, proposed_type) {
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?= base_url() ?>cma_process/from/edit/' + val + '/' + indx + '/' + proposed_type, (jQuery(window).width() - 80), jQuery(window).height(), 'yes');
		return false;
	}


	function details(id, operation, indx, territory = null, region = null) {

		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(indx);
		if (operation == 'details') {
			jQuery("#header_title").html('Case Merit Analysis Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
		} else if (operation == 'delete') {
			jQuery('#comments').val('');
			jQuery("#header_title").html('Delete CMA');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').show();
			jQuery('#close_btn_row').hide();
		} else if (operation == 'sendtochecker') {
			jQuery("#header_title").html('Send to Checker CMA');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
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
			url: "<?= base_url() ?>cma_process/details",
			data: {
				[csrfName]: csrfHash,
				id: id,
				territory: territory,
				region: region
			},
			datatype: "json",
			success: function(response) {
				//alert(response);
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				if (json.str) {
					document.getElementById("details").style.visibility = 'visible';
					jQuery("#main_body").html(json['str']);
					var html = '';
					if (json['checker_info'].length > 0) {
						var i = 1;
						jQuery.each(json['checker_info'], function(key, obj) {
							if (obj.recovery_makers != '' && obj.recovery_makers != null) {
								var str = obj.recovery_makers.split(",");
								if (str.includes('<?= $this->session->userdata['ast_user']['user_id'] ?>')) {
									select = 'selected';
								} else {
									select = '';
								}
							} else {
								select = '';
							}
							html += '<option value="' + obj.id + '" ' + select + ' >' + obj.NAME + '</option>';
							i++;
						});
						jQuery("#checker_to_notify").html(html);
					}
					jQuery('#loading_preview').hide();
					jQuery('#loading_p').hide();
					jQuery('#details_table').show();
					jQuery("#details").jqxWindow('open');
				} else {
					alert("Something went wrong, please refresh the page.")
				}

			}
		});
	}
	var count = 0;
	var maxrow = 0;
	var displayrow = 0;
	inc = 0;
	decr = 0;

	function clearCount() {
		count = 0;
		maxrow = 0;
		displayrow = 0;
	}

	function search_data() {
		jQuery("#jqxgrid").jqxGrid('updatebounddata');
		return;
	}
</script>
<div id="container" style="">
	<div id="body">
		<table class="">
			<tr id="widgetsNavigationTree">
				<td valign="top" align="left" class='navigation'>
					<!---- Left Side Menu Start ------>
					<?php $this->load->view('cma_process/pages/left_side_nav'); ?>
					<!-- --====== Left Side Menu End==========--- -->
				</td>
				<td valign="top" id="demos" class='rc-all content'>
					<div id="preloader">
						<div id="camera"></div>
					</div>
					<div id="">
						<div id='jqxTabs'>
							<ul>
								<li style="margin-left: 30px;">Data Grid</li>
							</ul>
							<!---==== First Tab Start ==========----->
							<div style="overflow: hidden;">
								<div style="display:block; min-height:340px; height:auto">
									<form method="POST" name="form" id="form" style="margin:0px;">
										<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
										<input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
										<div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
											<table id="deal_body" style="display:block;width:100%">
												<tr>
													<td style="width:10%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
													<td style="width:5%">
														<div id="proposed_type" name="proposed_type"></div>
													</td>
													<td style="width:15%"><strong><span id="s_l_or_c_no"></span></strong>:</td>
													<td style="width:5%"><input id="loan_ac" name="loan_ac" type="text" style="width:200" maxlength="16" size="16" onKeyUp="javascript:return s_mask(this.value,this);" />
													</td>
													<td style="width:10%"><strong>CID Number:</strong></td>
													<td style="width:5%"><input id="cif_number" name="cif_number" type="text" style="width:200" />
													</td>
													<td style="width:10%"><strong>Account Name:</strong></td>
													<td style="width:5%"><input id="ac_name" name="ac_name" type="text" style="width:200" />
													</td>
													<td style="width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px;height:25px" />
													</td>
												</tr>
											</table>
										</div>
										<div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>
										<div id="jqxgrid" style="margin-top:5px;width:100%;min-height:320px;height:auto;"></div>


										<div style="float:left;padding-top: 5px;">
											<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

												<strong>CMA = </strong> Case Merit Analysis&nbsp;
											</div> <br />
										</div>
									</form>
								</div>
							</div>
							<!---==== Second Tab Start ==========----->

						</div>
						<div>
				</td>
			</tr>
		</table>
	</div>
</div>
<style>
	* {
		padding: 0px;
		margin: 0px;
	}
</style>
<!-- Modal for product details -->
<div id="details" style="visibility:hidden;">
	<div><strong><label id="header_title"></label></strong></div>
	<form method="POST" name="action_form" id="action_form" style="margin:0px;">
		<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
		<input name="type" id="type" value="" type="hidden">
		<div id="loading_preview" style="text-align:center">
			<span id="loading_p" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
		</div>
		<div style="" id="details_table">
			&nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table','gurantor_table','facility_table','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />
			<span id="main_body"></span>
			<br>
			<div id="preview_table"></div>
			<div id="gurantor_table"></div>
			<div id="facility_table"></div>
			<div id="facility_card"></div>
			<div id="proposed_type_d"></div>
			<div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
				Select Checker To Notify: <span style="color: red;">*</span>
				<select name="checker_to_notify" id="checker_to_notify">
					<option value="">Select a Checker</option>
					<?php $count = 0; ?>
					<?php foreach ($checker_info as $checker) : ?>
						<?php
						if ($checker->recovery_makers != '' && $checker->recovery_makers != NULL) {
							$str = explode(",", $checker->recovery_makers);
							if (in_array($this->session->userdata['ast_user']['user_id'], $str)) {
								$select = "selected";
							} else {
								$select = "";
							}
						} else {
							$select = "";
						}
						?>
						<?php $count++; ?>
						<option value="<?= $checker->id ?>" <?php if ($count == 1 && $select == "") {
																echo "selected";
															} else {
																echo $select;
															}  ?>><?= $checker->name . ' (' . $checker->user_id . ')' ?></option>
					<?php endforeach; ?>
				</select><br>
				Notify By:&nbsp;&nbsp;
				<label>
					<input type="checkbox" name="email_notification" id="email_notification" value="email"> Email
					<input type="checkbox" name="sms_notification" id="sms_notification" value="sms"> SMS
				</label>
				&nbsp;&nbsp;&nbsp;
				<input type="button" class="buttonsendtochecker" id="sendtochecker" value="Send" />
				<input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
				<span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
			</div>
			<div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
				<strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
				<textarea name="comments" id="comments" style="width:370px;"></textarea>
				</br></br>
				<input type="button" class="buttondelete" id="delete_button" value="Delete" />
				<input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
				<span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
			</div>
			<div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
				<input type="button" align="center" class="button1" id="codeOK" value="Close" />
			</div>
		</div>
	</form>
</div>
<div id="r_history" style="visibility:hidden;">
	<div><strong><span id="r_heading"></span></strong></div>
	<div style="" id="details_table">
		<table style="width: 100%;" class="preview_table2">
			<thead>
				<th width="20%" align="left"><strong>Status</strong></th>
				<th width="20%" align="left"><strong>User</strong></th>
				<td width="20%" align="center"><strong>Date and Time</strong></td>
				<td width="20%" align="left"><strong>Description</strong></td>
				<td width="20%" align="left"><strong>Reason</strong></td>
			</thead>
			<tbody id="r_history_details">

			</tbody>
		</table>
		<div class="wrapper" style="text-align:center">
			</br></br><input type="button" align="center" class="button1" id="r_ok" value="Close" />
		</div>

	</div>
</div>

<script>
	function printpage(print_area, gurantor_table, facility_table, facility_card, type) {
		var pp = window.open();
		var tt = document.getElementById(print_area).innerHTML;
		var ptype = document.getElementById(type).innerHTML;
		var loan_card_g = "Guarantor/Company/Director/Owner";
		if (ptype == 'Card') {
			var loan_card_g = "Borrower/Reference";
		}
		pp.document.writeln('<HTML><HEAD><title></title>')
		pp.document.writeln('<style>.gurantor,.facility{width:100%; text-align:center; font-weight:bold;font-size:9pt;}.gurantor tr td,.facility tr td{border:1px solid #000;} </style>');

		pp.document.writeln('<style type="text/css"  media="print">	#PRINT, #CLOSE, #mssgg {visibility:hidden;}</style><base target="_self"></HEAD>');

		pp.document.writeln('<body  style="font-family:Verdana;font-size:8pt;" bottomMargin="20" leftMargin="50" topMargin="20" rightMargin="30">');

		pp.document.writeln('<table style="width:100%; text-align:center; font-weight:bold;font-size:9pt;"><tr><td><img ID="PRINT" alt="Print" src="<?= base_url() ?>old_assets/images/Print.png" onclick="javascript:location.reload(true);window.print();">&nbsp;<img ID="CLOSE" alt="CLOSE" src="<?= base_url() ?>old_assets/images/close.png" onclick="window.close();"><br /><span style="font-weight:normal; color:green; font-size:8pt;" ID="mssgg" >Print in Portrait Page</span></td></tr><tr><td>');
		pp.document.writeln('<table style="width:100%; text-align:center; font-weight:bold;font-size:9pt;" cellpadding="3" cellspacing="0" >');
		pp.document.writeln(document.getElementById(print_area).innerHTML);
		pp.document.writeln('</table></td></tr><tr>');
		pp.document.writeln('<td style="text-align:center; font-weight:bold;font-size:20px;">' + loan_card_g + '</td>');
		pp.document.writeln('</tr><tr><td><table style="width:100%;"  class="gurantor" cellspacing="0" cellspadding="0">');
		pp.document.writeln(document.getElementById(gurantor_table).innerHTML);
		pp.document.writeln('</table></td></tr><tr><td style="height:20px;"></td></tr><tr>');
		pp.document.writeln('<td style="text-align:center; font-weight:bold;font-size:20px;">Facility Info</td>');
		pp.document.writeln('</tr><tr><td><table style="width:100% !important" class="facility" cellspacing="0" cellspadding="0">');
		if (ptype == 'Card') {
			pp.document.writeln(document.getElementById(facility_card).innerHTML);
		} else {
			pp.document.writeln(document.getElementById(facility_table).innerHTML);
		}

		//pp.document.writeln('</td></tr>');
		pp.document.writeln('</table></td></tr>');

		pp.document.writeln('</body></HTML>');
		//window.print();
	}
</script>