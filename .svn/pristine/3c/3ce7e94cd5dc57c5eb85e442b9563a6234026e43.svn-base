<?php $this->load->view('approval_list/pages/css'); ?>

<style type="text/css">
	.button {
		background-color: #4CAF50;
		/* Green */
		border: none;
		color: white;
		padding: 16px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		transition-duration: 0.4s;
		cursor: pointer;
	}

	/* td:nth-child(2) {
		    padding-right: 20px;
		 }​  */
	#ext {
		border-collapse: separate;
		border-spacing: 0 15px;
	}

	.buttondelete {
		background-color: white;
		color: black;
		border: 2px solid #f44336;
		border-radius: 12px;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		transition-duration: 0.4s;
		cursor: pointer;
	}

	.buttondelete:hover {
		background-color: #f44336;
		color: white;
	}

	.button_delete {
		background-color: #00ffff;
		/* Green */
		border: none;
		color: white;
		padding: 5px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		transition-duration: 0.4s;
		cursor: pointer;
	}

	.buttonsendtochecker {
		background-color: white;
		color: black;
		border: 2px solid #008CBA;
		border-radius: 12px;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		transition-duration: 0.4s;
		cursor: pointer;
	}

	.buttonsendtochecker:hover {
		background-color: #008CBA;
		color: white;
	}

	.button3 {
		background-color: #4CAF50;
		color: black;
	}

	table {
		border-collapse: collapse;
	}

	table#preview_table td {
		border: 1px solid #c7c7c7;
	}





	table#preview_table td {
		border: 1px solid #c7c7c7;
		padding: 1rem;
	}

	.button4 {
		background-color: #00ffff;
		color: black;
	}

	.button3,
	.button4:hover {
		background-color: #f44336;
		color: white;
	}

	.center {
		margin: 0;
		position: absolute;
		top: 90%;
		left: 50%;
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
	}

	/* .center {
		  margin: auto;
		  width: 20%;
		  padding: 10px;
		} */
	.text-input {
		height: 23px;
		width: 350px;
	}


	.required {
		vertical-align: baseline;
		color: red;
		font-size: 10px;
	}
</style>





<div>

	<table style="width:100%;">
		<tr>
			<td style="width:13%;padding-top:5px;padding-left:5px;position:fixed;">
				<!---- Left Side Menu Start ------>
				<?php $this->load->view('approval_list/pages/left_side_nav'); ?>
				<!-- --====== Left Side Menu End==========--- -->
			</td>
			<td style="width:87%;">
				<!--  -->
				<div id="container">
					<div id="body">
						<!--Customization Start-->
						<script type="text/javascript">
							var theme = getDemoTheme();


							var proposed_type = ["Investment", "Card"];


							var csrf_tokens = '';
							var idd = 0;
							var indxx = 0;

							jQuery(document).ready(function($) {

								jQuery("#proposed_type_grid").jqxComboBox({
									theme: theme,
									width: "150px",
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Proposed Type",
									source: proposed_type,
									height: 25
								});



								jQuery('#proposed_type_grid').focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								// jQuery("#proposed_type_grid").jqxComboBox('val','Investment');

								var rules1 = [ //Rules for delete
									{
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
								];




								jQuery('#proposed_type_grid').bind('change', function(event) {
									jQuery("#loan_ac_grid").val('');
									jQuery("#hidden_loan_ac_grid").val('');
									change_caption_grid();
								});





								jQuery("#delete_button").click(function() {
									jQuery('#delete_convence').jqxValidator({
										rules: rules1,
										theme: theme
									});
									var validationResult = function(isValid) {
										if (isValid) {

											jQuery("#delete_button").hide();
											jQuery("#deletecancel").hide();
											jQuery("#delete_loading").show();
											call_ajax_submit_delete();
											clear_form();
										}
									}
									jQuery('#delete_convence').jqxValidator('validate', validationResult);

								});

								//sendtorecommender_btn
								jQuery("#sendtochecker_btn").click(function() {
									jQuery("#sendtochecker_btn").hide();
									jQuery("#sendtochecker_btn_del").hide();
									jQuery("#sendtochecker_loding").show();
									call_ajax_submit_delete();
									clear_form();
								});

								//Expand expiry date
								jQuery("#extend_btn").click(function() {
									jQuery('#delete_convence').jqxValidator({
										rules: [ //Rules for delete
											{
												input: '#extendComments',
												message: 'required!',
												action: 'keyup, blur',
												rule: function(input, commit) {
													if (jQuery("#extendComments").val() == '') {
														jQuery("#extendComments").focus();
														return false;
													} else {
														return true;
													}
												}
											},


											{
												input: '#extendComments',
												message: 'more than 250 characters',
												action: 'keyup, blur, change',
												rule: function(input, commit) {
													if (input.val() != '') {
														if (input.val().length > 250) {
															jQuery("#extendComments").focus();
															return false;
														}
													}
													return true;

												}
											},
											{
												input: '#new_date',
												message: 'Required',
												action: 'keyup, blur, change',
												rule: function(input, commit) {

													if (input.val() != "") {
														return true;
													} else {
														return false;
													}

													// if (input.val() == '') {

													// 	return false;

													// } else {
													// 	return true;
													// }


												}
											},
										],
										theme: theme
									});
									var validationResult = function(isValid) {
										if (isValid) {

											jQuery("#sendtochecker_btn").hide();
											jQuery("#sendtochecker_btn_del").hide();
											jQuery("#sendtochecker_btn_del").hide();
											jQuery("#extend_btn").hide();
											jQuery("#extend_loading").show();
											jQuery("#deletecancel").hide();

											jQuery("#delete_button").hide();
											call_ajax_submit_delete();
											jQuery("#extendComments").val("");
											jQuery("#new_date").val("");
										}
									}
									jQuery('#delete_convence').jqxValidator('validate', validationResult);
								});





								//sendtorecommender_btn
								jQuery("#verify_btn").click(function() {
									jQuery("#verify_btn").hide();
									jQuery("#verify_btn_del").hide();
									jQuery("#verify_loding").show();
									call_ajax_submit_delete();
									clear_form();
								});







								// prepare the data
								//var theme = 'energyblue';
								var theme = 'classic';

								var source = {
									datatype: "json",
									datafields: [

										{
											name: 'id',
											type: 'int'
										},

										{
											name: 'sts',
											type: 'int'
										},
										{
											name: 'v_sts',
											type: 'int'
										},
										{
											name: 'ac_type',
											type: 'int'
										},

										{
											name: 'investment_ac',
											type: 'string'
										},
										{
											name: 'org_loan_ac',
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
											name: 'approval_ref',
											type: 'string'
										},

										{
											name: 'e_by',
											type: 'int'
										},
										{
											name: 'e_dt',
											type: 'string'
										},
										{
											name: 'approval_dt',
											type: 'string'
										},
										{
											name: 'case_file_expiry_date',
											type: 'string'
										},

										{
											name: 'status',
											type: 'string'
										},
										{
											'name': 'case_expire_date',
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
									url: '<?= base_url() . "index.php/Approval_list/grid/" . $submenu; ?>',
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
										var proposed_type = jQuery.trim(jQuery('input[name=proposed_type_grid]').val());
										var loan_ac = jQuery.trim(jQuery('#loan_ac_grid').val());
										var loan_ac2 = jQuery.trim(jQuery('#loan_ac_grid').val());

										var case_number = jQuery.trim(jQuery('input[name=case_number]').val());


										jQuery.extend(data, {
											proposed_type: proposed_type,
											loan_ac: loan_ac,
											loan_ac2: loan_ac2,
											case_number: case_number
										});
										return data;
									}
								});
								var columnCheckBox = null;
								var updatingCheckState = false;
								// initialize jqxGrid. Disable the built-in selection.
								var celledit = function(row, datafield, columntype) {
									var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
									if (checked == false) {
										return false;
									};
								};
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
									enablebrowserselection: true,
									selectionmode: 'none',
									rendergridrows: function(obj) {
										return obj.data;
									},

									columns: [{
											text: 'Id',
											datafield: 'id',
											hidden: true,
											editable: false,
											width: '4%'
										},

										<?php


										if (isset($submenu) && $submenu != "running") { ?>
											<? if (DELETE == 1) { ?> {
													text: 'D',
													menu: false,
													datafield: 'Delete',
													align: 'center',
													editable: false,
													sortable: false,
													width: '2%',
													cellsrenderer: function(row) {
														editrow = row;
														var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
														if (dataRecord.v_sts == 1 || dataRecord.v_sts == 35) {


															return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'delete\',' + editrow + ',' + dataRecord.sts + ');" ><img align="center" src="<?= base_url() ?>images/delete-New.png"></div>';

														}
													}
												},
											<?php }
											if (EDIT == 1) { ?> {
													text: 'E',
													menu: false,
													datafield: 'Edit',
													align: 'center',
													editable: false,
													sortable: false,
													width: '2%',
													cellsrenderer: function(row) {
														editrow = row;
														var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
														if (dataRecord.v_sts == 1 || dataRecord.v_sts == 35) {
															return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="editt2(' + dataRecord.id + ',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';

														}
													}
												},
											<?php } ?>

										<?php  }

										?>

										{
											text: 'P',
											menu: false,
											datafield: 'Preview',
											align: 'center',
											editable: false,
											sortable: false,
											width: '2%',
											cellsrenderer: function(row) {
												editrow = row;
												var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
												return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

											}
										},

										<?php
										if (isset($submenu) && $submenu != "running") { ?>
											<? if (SENDTOCHECKER == 1) { ?> {
													text: 'STC',
													datafield: 'sendtochecker',
													editable: false,
													align: 'center',
													sortable: false,
													menu: false,
													width: 35,
													cellsrenderer: function(row) {
														editrow = row;
														var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
														if (dataRecord.v_sts == 1 || dataRecord.v_sts == 35) {


															return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'sendtochecker\',' + editrow + ',' + dataRecord.sts + ');" ><img align="center" src="<?= base_url() ?>images/forward.png"></div>';
														}
													}
												},
											<? } ?>

											<? if (VERIFY == 1) { ?> {
													text: 'V',
													datafield: 'verify',
													editable: false,
													align: 'center',
													sortable: false,
													menu: false,
													width: 35,
													cellsrenderer: function(row) {
														editrow = row;
														var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
														if (dataRecord.v_sts == 37) {
															return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'verify\',' + editrow + ',' + dataRecord.sts + ');" ><img align="center" src="<?= base_url() ?>images/drag.png"></div>';
														}
													}
												},

											<? } ?>

											//
											<? if (EXTEND == 1) { ?> {
													text: 'Ex',
													datafield: 'Extend',
													editable: false,
													align: 'center',
													sortable: false,
													menu: false,
													width: 38,
													cellsrenderer: function(row) {
														editrow = row;
														var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
														// if (dataRecord.v_sts == 37)

														if (dataRecord.status == "Pending") {
															return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'extend\',' + editrow + ',' + dataRecord.sts + ');" ><img align="center" src="<?= base_url() ?>images/expand.png"></div>';
														}
													}
												},

											<? } ?>
											//
										<?php }

										?>




										{
											text: 'Status',
											datafield: 'status',
											editable: false,
											width: '11%',
											align: 'left',
										},


										{
											text: ' A/C Type',
											datafield: 'ac_type',
											editable: false,
											width: '7%',
											align: 'left',
										},

										{
											text: 'Investment A/C Type',
											datafield: 'investment_ac',
											editable: false,
											width: '13%',
											align: 'left',
										},



										// { text: 'Org Loan A/C', datafield: 'org_loan_ac',editable: false, width: '40%',align: 'left',},

										{
											text: 'Account Name',
											datafield: 'account_name',
											editable: false,
											width: '10%',
											align: 'left',
										},
										{
											text: 'CID No',
											datafield: 'cif_no',
											editable: false,
											width: '10%',
											align: 'left',
										},

										{
											text: 'Approval Ref Number',
											datafield: 'approval_ref',
											editable: false,
											width: '13%',
											align: 'left',
										},
										<?php if (isset($submenu) && $submenu != "running") { ?> {
												text: 'Expiry Date',
												datafield: 'case_expire_date',
												editable: false,
												width: '10%',
												align: 'left',
											},
										<?php
										}
										?> {
											text: 'Approval Date',
											datafield: 'approval_dt',
											editable: false,
											width: '10%',
											align: 'left',
										},

										{
											text: 'Entry By',
											datafield: 'e_by',
											editable: false,
											width: '13%',
											align: 'left',
										},
										{
											text: 'Entry Date',
											datafield: 'e_dt',
											editable: false,
											width: '10%',
											align: 'left',
										},






									],
								});


								jQuery("#details").jqxWindow({
									theme: theme,
									width: '75%',
									height: '90%',
									resizable: false,
									isModal: true,
									autoOpen: false,
									cancelButton: jQuery("#sendtochecker_btn_del,#verify_btn_del,#deletecancel,#codeOK")
								});

								jQuery('#details').on('close', function(event) {
									jQuery('#delete_convence').jqxValidator('hide');
								});






							});

							function search_data() {
								jQuery("#jqxgrid").jqxGrid('updatebounddata');
								return;
							}

							function editt2(val, indx) {

								jQuery("#jqxgrid").jqxGrid('clearselection');
								EOL.messageBoard.open('<?= base_url() ?>Approval_list/from2/edit/' + val + '/' + indx, (jQuery(window).width() - 80), jQuery(window).height(), 'yes');
								return false;
							}



							function clear_form() {

								jQuery("#comments").val('');

								jQuery("#investment_ac_no").val('');
								jQuery("#case_number").val('');
								jQuery("#loan_ac_grid").val('');
								jQuery('#proposed_type_grid').jqxComboBox('val', '');




							}

							function reload() {

							}



							function details(id, operation) {


								jQuery('#deleteEventId').val(id);
								jQuery('#type').val(operation);
								jQuery("#previewtable").show();
								jQuery("#extend_loading").hide();




								if (operation == 'details') {
									jQuery("#extend_reason").hide();
									jQuery("#delete_row").hide();
									jQuery("#sendtochecker_row").hide();
									jQuery("#verify_row").hide();
									jQuery("#header_title").html('Details');
									jQuery("#close_btn_row").show();



								}

								if (operation == 'delete') {

									jQuery("#header_title").html('Delete');
									jQuery("#extend_reason").hide();
									jQuery("#delete_row").show();

									jQuery("#delete_button").show();
									jQuery("#deletecancel").show();
									jQuery("#delete_loading").hide();


									jQuery("#sendtochecker_row").hide();
									jQuery("#verify_row").hide();

									jQuery("#close_btn_row").hide();



								} else if (operation == 'sendtochecker') {

									jQuery("#delete_row").hide();
									jQuery("#sendtochecker_row").show();
									jQuery("#verify_row").hide();
									jQuery("#close_btn_row").hide();
									jQuery("#extend_reason").hide();



									jQuery("#sendtochecker_btn").show();
									jQuery("#sendtochecker_btn_del").show();
									jQuery("#sendtochecker_loding").hide();




									jQuery("#header_title").html('Send To Chacker');


								} else if (operation == 'verify') {
									jQuery("#verify_row").show();
									jQuery("#sendtochecker_row").hide();
									jQuery("#delete_row").hide();
									jQuery("#extend_reason").hide();
									jQuery("#header_title").html('Verify');

									jQuery("#close_btn_row").hide();

									jQuery("#verify_btn").show();
									jQuery("#verify_btn_del").show();
									jQuery("#verify_loding").hide();


								} else if (operation == 'extend') {
									jQuery("#extend_btn").show();
									jQuery("#verify_row").hide();
									jQuery("#sendtochecker_row").hide();
									jQuery("#delete_row").hide();
									jQuery("#extend_reason").show();
									jQuery("#header_title").html('Extend Case File Expiry Date');

									jQuery("#close_btn_row").hide();

									jQuery("#verify_btn").show();
									jQuery("#verify_btn_del").show();
									jQuery("#verify_loding").hide();


								}

								jQuery("#details").jqxWindow('open');

								var csrfName = jQuery('.txt_csrfname').attr('name');
								var csrfHash = jQuery('.txt_csrfname').val();



								jQuery.ajax({
									type: "POST",
									cache: false,
									url: "<?= base_url() ?>Approval_list/details",
									data: {
										[csrfName]: csrfHash,
										id: id
									},
									datatype: "json",
									success: function(response) {



										var response = JSON.parse(response);
										jQuery('.txt_csrfname').val(response.csrf_token);
										jQuery('#previewtable').html(response.html);
										jQuery("#prev_date").val(response.prev_date);

									}

								});
								clear_form();
								document.getElementById("details").style.display = 'block';
								jQuery("#details").jqxWindow('open');


							}


							function call_ajax_submit_delete() {
								jQuery(".buttonclose").hide();

								var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
								var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
								var postData = jQuery('#delete_convence').serialize() + "&" + csrfName + "=" + csrfHash;


								jQuery.ajax({
									type: "POST",
									cache: false,
									url: '<?= base_url() ?>Approval_list/delete_action/',
									data: postData,
									datatype: "json",
									success: function(response) {

										var json = jQuery.parseJSON(response);
										jQuery('.txt_csrfname').val(json.csrf_token);

										jQuery(".buttonclose").show();
										jQuery("#deletecancel").show();
										if (jQuery('type').value == 'delete') {

											jQuery("#delete_button").show();
											jQuery("#deletecancel").show();
											jQuery("#delete_loading").hide();
											jQuery('#details').jqxWindow('close');

										} else if (jQuery('type').value == 'sendtochecker') {

											jQuery("#sendtochecker").show();
											jQuery("#sendtochecker_btn_del").show();
											jQuery("#sendtochecker_loding").hide();
											jQuery('#details').jqxWindow('close');

										} else if (jQuery('type').value == 'verify') {
											jQuery("#verify").show();
											jQuery("#verify_btn_del").show();
											jQuery("#verify_loding").hide();
											jQuery('#details').jqxWindow('close');

										}

										if (json.Message != 'OK') {
											alert(json.Message);
											return false;
										} else {
											var msz = '';
											jQuery("#error").show();
											jQuery("#error").fadeIn(100, function() {
												jQuery("#error").fadeOut(11500);
											});
											jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + $('type').value + msz);
											jQuery('#details').jqxWindow('close');
											jQuery("#jqxgrid").jqxGrid('updatebounddata');
											// menu_counter_get('<?= $this->uri->segment(6) ?>');
											reload();

										}

									}

								});
							}


							function change_caption_grid() {
								if (jQuery("#proposed_type_grid").val() == '') {
									document.getElementById("loan_ac_grid").disabled = true;
									jQuery("#l_or_c_no_grid").html('Investment A/C or Card');
								} else {
									document.getElementById("loan_ac_grid").disabled = false;
									var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
									if (item.value == 'Investment') {
										jQuery("#l_or_c_no_grid").html('Investment A/C ');
									} else if (item.value == 'Card') {
										jQuery("#l_or_c_no_grid").html('Card');
									}
								}

							}
						</script>
						<div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
							<table id="deal_body" style="display:block;width:100%">
								<tr>

									<!--td style="text-align:right;width:5%"><strong> A/C Type&nbsp;&nbsp;</strong> </td>
				   <td style="width:15%"><div id="ac_type_search" name="ac_type_search"></div></td>-->


									<input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
									<input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">

									<td style="text-align:right;width:10.5%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
									<td style="width:10%">
										<div style="padding-left:1.8%" id="proposed_type_grid" name="proposed_type_grid"></div>
									</td>

									<td style="text-align:right;width:18%;"><strong><span id="l_or_c_no_grid"></span> No.</strong></td>
									<td style="width:10%"><input name="loan_ac_grid" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac_grid" value="" /></td>


									<!-- <td style="text-align:right;width:15%"><strong>Investment A/C Number&nbsp;&nbsp;</strong> </td> -->
									<!-- <td style="width:15%"><div style="padding-left:1.8%" id="doc_type" name="doc_type"></div></td> -->
									<!-- <td style="width:15%"><input type="text" name="investment_ac_no" id="investment_ac_no" placeholder="Investment A/C Number"></td> -->





									<td style="text-align:right;width:9%"><strong>CID Number &nbsp;&nbsp;</strong> </td>
									<td style="width:15%"><input type="text" name="case_number" id="case_number" placeholder="CID Number"></td>

									<td style="text-align:right;width:5%">
										<input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px;height:25px" />
									</td>
									<td style="width:15%"></td>
									<td style="text-align:right;width:5%"></td>
									<td style="width:15%"></td>
									<td style="text-align:right;width:7%"></td>
									<td style="width:15%"></td>
									<td style="text-align:right;width:5%"></td>
									<td style="width:30%">
									</td>
									<td style="text-align:right;width:5%">
									</td>
								</tr>
							</table>
						</div>
						<div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>
						<div id="jqxgrid" style="margin: 10px auto;"></div>

						<?php
						if ($submenu != "running") { ?>
							<div style="float:left;padding-top: 5px;padding-left:5px;">
								<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
									<? if (ADD == 1) { ?>
										<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" href="<?= base_url() ?>index.php/Approval_list/from/add" title="">

											<input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px" value="Upload" id="sendButton" /></a>


									<? } ?> &nbsp;&nbsp;&nbsp;&nbsp;
									<strong>D = </strong> Delete,&nbsp;
									<strong>E = </strong> Edit,&nbsp;
									<strong>P = </strong> Preview,&nbsp;
									<strong>STC = </strong> Send To Chacker&nbsp;
									<strong>V = </strong> Verify,&nbsp;
									<strong>Ex = </strong> Extend Expiry Date&nbsp;
								</div> <br />
							</div>
						<?php }
						?>




						<style>
							* {
								padding: 0px;
								margin: 0px;
							}
						</style>


						<!-- Detailse -->

						<div id="details" style="display: none;">
							<div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>

							<form method="POST" name="delete_convence" id="delete_convence" style="margin:0px;">

								<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
								<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
								<input name="verifyid" id="verifyid" value="" type="hidden">
								<input name="type" id="type" value="" type="hidden">

								<input name="type_id_get" id="type_id_get" value="" type="hidden">




								&nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />



								<div id="previewtable">

								</div>

								<div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%;margin-top: 20px">
									<input type="button" class="button6" id="codeOK" value="Close" />
								</div>

								<div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%; margin-top:15px">
									<strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
									<textarea name="comments" id="comments" style="width:250px;"></textarea>
									</br></br>

									<input type="button" class="buttondelete" id="delete_button" value="Delete" />

									<input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
									<span id="delete_loading" style="display:">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
								</div>

								<div id="extend_reason" style="text-align:center;margin-bottom:30px;width:100%; margin-top:15px">
									<table style="width:45%;margin:auto;">
										<tr>
											<td style="width:150px;"><strong>Extend Date <span style="color:red">*</span> </strong></td>
											<input type="hidden" name="prev_date" id="prev_date">
											<td width="20%"><input type="text" id="new_date" name="new_date" placeholder="dd/mm/yyyy" style="width:250px;height:20px;padding:2px;" required />
												<script type="text/javascript">
													datePicker("new_date");
												</script>
											</td>
										</tr>
										<tr>
											<td width="20%"> <strong style="vertical-align:top">Extend Reason<span style="color: red;">*</span></strong>
											</td>
											<td width="20%"> <textarea name="comments" id="extendComments" style="width:250px;" required></textarea>
											</td>
										</tr>
									</table>


									</br></br>

									<input type="button" class="buttondelete" id="extend_btn" value="Extend" />
									<input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
									<span id="extend_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
								</div>

								<br>

								<!-- STR -->
								<div id="sendtochecker_row" style="text-align:center;margin-bottom:30px;width:100%;">
									<br>
									<input type="button" class="buttonsendtochecker" id="sendtochecker_btn" value="Send to Chacker">
									<input type="button" class="buttonclose" id="sendtochecker_btn_del" onclick="close()" value="Cancel">
									<span id="sendtochecker_loding" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
								</div>
								<!-- R -->



								<!-- STR -->
								<div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
									<br>
									<input type="button" class="buttonsendtochecker" id="verify_btn" value="Verify">
									<input type="button" class="buttonclose" id="verify_btn_del" onclick="close()" value="Cancel">
									<span id="verify_loding" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
								</div>
								<!-- R -->



							</form>
						</div>
						<!--  -->
			</td>
		</tr>
	</table>

</div>