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

	.button6 {
		background-color: #555555;
		/* Green */
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		;
		border-radius: 12px;
	}

	.button1 {
		background-color: #555555;
		/* Green */
		border: none;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		;
		border-radius: 12px;
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
		word-wrap: break-word
	}

	table.preview_table2 td,
	table.preview_table2 th {
		border: 1px solid #c7c7c7;
		word-wrap: break-word;
		padding: 5px;
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

	#details {
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
		overflow: hidden;
	}

	b {
		font-size: 14px;
	}

	#details td,
	#details th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	#details th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: center;
		background-color: #4CAF50;
		color: white;
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

	.buttonclose {
		background-color: white;
		color: black;
		border: 2px solid #555555;
		border-radius: 12px;
		padding: 10px 15px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		transition-duration: 0.4s;
		cursor: pointer;
	}

	.buttonclose:hover {
		background-color: #555555;
		color: white;
	}

	.wrapper {
		text-align: center;
	}

	.button {
		position: absolute;
		top: 50%;
	}

	#gurantor_table {
		border-collapse: collapse;
		word-wrap: break-word;
	}

	#gurantor_table td {
		border: 1px solid rgba(0, 0, 0, .20);
		word-wrap: break-word;
	}

	.errormsg {
		background-color: red !important;
		color: white;
	}

	.successmsg {
		background-color: green !important;
		color: white;
	}
</style>
<?
$zone = $this->user_model->get_parameter_data('ref_zone', 'name', "data_status = '1'");
$district = $this->user_model->get_parameter_data('ref_district', 'name', "data_status = '1'");
//$unit_office = $this->user_model->get_parameter_data('ref_unit_office','name',"data_status = '1'");
$status = $this->user_model->get_parameter_data('ref_status', 'name', "data_status = '1' AND module_name='f_legal_notice'");
$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment', 'name', "data_status = '1'");
$sorting = array(array('value' => 'b.zone', 'name' => 'zone'), array('value' => 'b.territory', 'name' => 'Territory'), array('value' => 'b.district', 'name' => 'District'));
$ordering = array(array('value' => 'ASC', 'name' => 'ASC'), array('value' => 'DESC', 'name' => 'DESC'));
?>
<div id="container">
	<div id="body">
		<!--Customization Start-->
		<script type="text/javascript">
			var csrf_tokens = '';
			var theme = 'classic';
			//var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0; //global variable

			jQuery(document).ready(function($) {
				jQuery('#zone').bind('change', function(event) {
					change_dropdown('zone');
				});
				// prepare the data
				//var theme = 'energyblue';
				var theme = 'classic';
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
				var source = {
					datatype: "json",
					datafields: [{
							name: 'id',
							type: 'int'
						},
						{
							name: 'checker_id',
							type: 'int'
						},
						{
							name: 'sts',
							type: 'string'
						},
						{
							name: 'sl_no',
							type: 'string'
						},
						{
							name: 'loan_ac',
							type: 'string'
						},
						{
							name: 'cif',
							type: 'string'
						},
						{
							name: 'branch_sol',
							type: 'string'
						},
						{
							name: 'ac_name',
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
							name: 'status',
							type: 'string'
						},
						{
							name: 'legal_notice_sts',
							type: 'int'
						},
						{
							name: 'req_type',
							type: 'string'
						},
						{
							name: 'proposed_type',
							type: 'string'
						},
						{
							name: 'loan_segment',
							type: 'string'
						},
						{
							name: 'return_reason_rm',
							type: 'string'
						},
						{
							name: 'reject_reason_rm',
							type: 'string'
						},
						{
							name: 'ho_return_reason',
							type: 'string'
						},
						{
							name: 'ho_decline_reason',
							type: 'string'
						},
						{
							name: 'holm_r_reason',
							type: 'string'
						},
						{
							name: 'stc_by',
							type: 'string'
						},
						{
							name: 'stc_dt',
							type: 'string'
						},
						{
							name: 'sth_by',
							type: 'string'
						},
						{
							name: 'sth_dt',
							type: 'string'
						},
						{
							name: 'v_by',
							type: 'string'
						},
						{
							name: 'v_dt',
							type: 'string'
						},
						{
							name: 'rec_by',
							type: 'string'
						},
						{
							name: 'rec_dt',
							type: 'string'
						},
						{
							name: 'loan_type',
							type: 'int'
						},
						{
							name: 'district',
							type: 'int'
						},
						{
							name: 'e_by_id',
							type: 'int'
						},
						{
							name: 'zone',
							type: 'int'
						},
						{
							name: 'migration_sts',
							type: 'string'
						},
						{
							name: 'return_reason',
							type: 'string'
						},
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
					url: '<?= base_url() ?>index.php/legal_notice/grid',
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
						var district = jQuery.trim(jQuery('#district').val());
						var zone = jQuery.trim(jQuery('#zone').val());
						var rec_dt_from = jQuery.trim(jQuery('#rec_dt_from').val());
						var rec_dt_to = jQuery.trim(jQuery('#rec_dt_to').val());
						var status = jQuery.trim(jQuery('#status').val());
						var e_dt_from = jQuery.trim(jQuery('#e_dt_from').val());
						var e_dt_to = jQuery.trim(jQuery('#e_dt_to').val());
						var v_dt_from = jQuery.trim(jQuery('#v_dt_from').val());
						var v_dt_to = jQuery.trim(jQuery('#v_dt_to').val());
						var loan_segment = jQuery.trim(jQuery('#loan_segment').val());
						// alert(status);
						// return;
						if (csrf_tokens == '') {
							csrf_tokens = '<?php echo $this->security->get_csrf_hash(); ?>';
						}
						jQuery.extend(data, {
							district: district,
							zone: zone,
							rec_dt_from: rec_dt_from,
							rec_dt_to: rec_dt_to,
							status: status,
							e_dt_from: e_dt_from,
							e_dt_to: e_dt_to,
							v_dt_from: v_dt_from,
							v_dt_to: v_dt_to,
							loan_segment: loan_segment,
							csrf_tokens: csrf_tokens

						});
						return data;
					}
				});
				var cellclassname = function(row, columnfield, value, rowdata) {
					var editrow = row;
					var dataRecord = jQuery("#jqxgrid").jqxGrid("getrowdata", editrow);

					if (dataRecord.return_reason != "" && (dataRecord.legal_notice_sts == 4 || dataRecord.legal_notice_sts == 5 || dataRecord.legal_notice_sts == 9)) {
						return "errormsg";
					} else if (dataRecord.return_reason != "" && (dataRecord.legal_notice_sts == 2 || dataRecord.legal_notice_sts == 3)) {
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
					pagesize: 50,
					enablehover: true,
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
							text: 'LN STS',
							datafield: 'legal_notice_sts',
							cellclassname: cellclassname,
							hidden: true,
							editable: false,
							width: '4%'
						},
						{
							text: 'Reason',
							datafield: 'return_reason',
							cellclassname: cellclassname,
							hidden: true,
							editable: false,
							width: '4%'
						},
						<? if (DELETE == 1) { ?> {
								text: 'D',
								menu: false,
								datafield: 'Edit',
								cellclassname: cellclassname,
								align: 'center',
								editable: false,
								sortable: false,
								width: '2%',
								cellsrenderer: function(row) {
									editrow = row;
									var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.e_by_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.legal_notice_sts == 1 || dataRecord.legal_notice_sts == 4 || dataRecord.legal_notice_sts == 9)) {
										return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'delete\',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/delete-New.png"></div>';
									} else {
										return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
									}

								}
							},
						<?php } ?> {
							text: 'DTL',
							menu: false,
							datafield: 'Preview',
							cellclassname: cellclassname,
							align: 'center',
							editable: false,
							sortable: false,
							width: '3%',
							cellsrenderer: function(row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';
							}
						},
						<?php if (EDIT == 1) { ?> {
								text: 'E',
								menu: false,
								datafield: 'Delete',
								cellclassname: cellclassname,
								align: 'center',
								editable: false,
								sortable: false,
								width: '2%',
								cellsrenderer: function(row) {
									editrow = row;
									var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.e_by_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.legal_notice_sts == 1 || dataRecord.legal_notice_sts == 4 || dataRecord.legal_notice_sts == 9)) {
										if (dataRecord.proposed_type == 'Investment') {
											var type = 1;
										} else {
											var type = 2
										}
										return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="editt(' + dataRecord.id + ',' + editrow + ',' + type + ')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
									} else {
										return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
									}
								}
							},
						<?php } ?>
						<? if (SENDTOCHECKER == 1) { ?> {
								text: 'STC',
								datafield: 'sendtochecker',
								cellclassname: cellclassname,
								editable: false,
								align: 'center',
								sortable: false,
								menu: false,
								width: 35,
								cellsrenderer: function(row) {
									editrow = row;
									var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.e_by_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.legal_notice_sts == 1 || dataRecord.legal_notice_sts == 4 || dataRecord.legal_notice_sts == 9)) {
										return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'sendtochecker\',' + editrow + ',' + dataRecord.district + ',' + dataRecord.zone + ')" ><img align="center" src="<?= base_url() ?>images/forward.png"></div>';
									} else if (dataRecord.legal_notice_sts == 2) {
										return '<div style=" margin-top: 8px;text-align:center">S</div>';
									} else {
										return '<div style=" margin-top: 8px;text-align:center"></div>';
									}
								}
							},
						<? } ?>
						<? if (RECOMMEND == 1) { ?> {
								text: 'REC',
								datafield: 'verify',
								cellclassname: cellclassname,
								editable: false,
								align: 'center',
								sortable: false,
								menu: false,
								width: 35,
								cellsrenderer: function(row) {
									editrow = row;
									var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									if (dataRecord.proposed_type == 'Investment') {
										var type = 1;
									} else {
										var type = 2
									}
									if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.checker_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.legal_notice_sts == 2)) {
										return '<div style="margin-top: 5px;text-align:center; cursor:pointer" onclick="verify(' + dataRecord.id + ',' + editrow + ',' + type + ')" ><img align="center" src="<?= base_url() ?>images/activate1.png"></div>';
									} else if (dataRecord.legal_notice_sts == '3') {
										return '<div style=" margin-top: 7px; cursor:pointer;text-align:center">R</div>';
									} else {
										return '<div style=" margin-top: 7px;text-align:center"></div>';
									}

								}
							},
						<? } ?>
						<? if (DOWNLOADLEGALNOTICEPDF == 1) { ?> {
								text: 'Print',
								datafield: 'printpdf',
								cellclassname: cellclassname,
								editable: false,
								align: 'center',
								cellsalign: 'center',
								sortable: false,
								menu: false,
								width: '3%',
								cellsrenderer: function(row) {
									editrow = row;
									var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									if (dataRecord.legal_notice_sts == 14 && (dataRecord.migration_sts == 0 || dataRecord.migration_sts == null)) {
										if (dataRecord.proposed_type == 'Investment') {
											var type = 1;
										} else {
											var type = 2
										}
										if (dataRecord.download_sts == 1) {
											var bgcolor = 'background-color:#FFD700';
											//var bgcolor = 'background-image: linear-gradient(141deg, #05286e 0%, #0072c4 51%, #05286e 75%) !important;';
										} else {
											var bgcolor = '';
										}
										//return '<div style=" margin-top: 8px; cursor:pointer;text-align:center">&nbsp;<img src="<?= base_url() ?>images/word_icon.gif" onclick=\'download("'+dataRecord.id+'","download","'+type+'");\'></div>';
										//return '<div style=" padding-bottom:7px;padding-top:4px; margin-top: 0px; cursor:pointer;text-align:center; '+bgcolor+'">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?= base_url() ?>index.php/legal_notice_ho/download_pdf/'+dataRecord.id+'/'+dataRecord.proposed_type+'" target="_blank" ><img align="center" src="<?= base_url() ?>images/pdf_icon.gif"></a></div>';
										return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?= base_url() ?>index.php/legal_notice_ho/download_pdf/' + dataRecord.id + '/' + dataRecord.proposed_type + '\')" align="center" src="<?= base_url() ?>images/pdf_icon.gif"></div>';
									} else {
										return '<div style=" margin-top: 5px;text-align:center"></div>';
									}

								}
							},
						<? } ?> {
							text: 'Status',
							datafield: 'status',
							cellclassname: cellclassname,
							editable: false,
							width: '18%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'Serial',
							datafield: 'sl_no',
							cellclassname: cellclassname,
							editable: false,
							width: '5%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'Portfolio',
							datafield: 'loan_segment',
							cellclassname: cellclassname,
							editable: false,
							width: '8%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'Decline/Return Reason',
							datafield: 'return_reason_rm',
							cellclassname: cellclassname,
							editable: false,
							align: 'left',
							cellsalign: 'left',
							sortable: false,
							menu: false,
							width: '15%',
							cellsrenderer: function(row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								var reason_text = '';
								if ((dataRecord.return_reason_rm != null || dataRecord.reject_reason_rm != null || dataRecord.ho_return_reason != null || dataRecord.ho_decline_reason != null) && (dataRecord.legal_notice_sts == 4 || dataRecord.legal_notice_sts == 5 || dataRecord.legal_notice_sts == 9)) {
									if (dataRecord.return_reason_rm != null) {
										reason_text += '(' + dataRecord.return_reason_rm + ')';
									}
									if (dataRecord.reject_reason_rm != null) {
										reason_text += '(' + dataRecord.reject_reason_rm + ')';
									}
									if (dataRecord.ho_return_reason != null) {
										reason_text += '(' + dataRecord.ho_return_reason + ')';
									}
									if (dataRecord.ho_decline_reason != null) {
										reason_text += '(' + dataRecord.ho_decline_reason + ')';
									}
								}
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history(' + dataRecord.id + ')"><span>' + reason_text + '</span></a></div>';

							}
						},
						{
							text: 'Investment A/C or Card No.',
							datafield: 'loan_ac',
							cellclassname: cellclassname,
							editable: false,
							align: 'center',
							cellsalign: 'center',
							sortable: true,
							menu: true,
							width: '11%',
							cellsrenderer: function(row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history(' + dataRecord.id + ',\'life_cycle\')"><span>' + dataRecord.loan_ac + '</span></a></div>';

							}
						},
						{
							text: 'A/C Name or Name on Card',
							datafield: 'ac_name',
							cellclassname: cellclassname,
							editable: false,
							width: '15%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'Initiate By',
							datafield: 'e_by',
							cellclassname: cellclassname,
							editable: false,
							width: '15%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'Initiate Date Time',
							datafield: 'e_dt',
							cellclassname: cellclassname,
							editable: false,
							width: '12%',
							align: 'center',
							cellsalign: 'center'
						},

						{
							text: 'STC By',
							datafield: 'stc_by',
							cellclassname: cellclassname,
							editable: false,
							width: '15%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'STC Date Time',
							datafield: 'stc_dt',
							cellclassname: cellclassname,
							editable: false,
							width: '12%',
							align: 'center',
							cellsalign: 'center'
						},
						{
							text: 'REC By',
							datafield: 'rec_by',
							cellclassname: cellclassname,
							editable: false,
							width: '15%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'REC Date and Time ',
							datafield: 'rec_dt',
							cellclassname: cellclassname,
							editable: false,
							width: '12%',
							align: 'center',
							cellsalign: 'center'
						},
						{
							text: 'Send To HOLM By',
							datafield: 'sth_by',
							cellclassname: cellclassname,
							editable: false,
							width: '15%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'Send To HOLM Date and Time',
							datafield: 'sth_dt',
							cellclassname: cellclassname,
							editable: false,
							width: '12%',
							align: 'center',
							cellsalign: 'center'
						},
						{
							text: 'Verify By',
							datafield: 'v_by',
							cellclassname: cellclassname,
							editable: false,
							width: '15%',
							align: 'left',
							cellsalign: 'left'
						},
						{
							text: 'Verify Date and Time',
							datafield: 'v_dt',
							cellclassname: cellclassname,
							editable: false,
							width: '12%',
							align: 'center',
							cellsalign: 'center'
						},
					],
					ready: function() {
						var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
						$('#jqxgrid').jqxGrid({
							pagesizeoptions: ['25', '100', '200']
						});
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

				var zone = [<? $i = 1;
							foreach ($zone as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
				jQuery("#zone").jqxComboBox({
					theme: theme,
					promptText: "Select zone",
					source: zone,
					width: '97%',
					height: 21
				});
				var district = [<? $i = 1;
								foreach ($district as $row) {
									if ($i != 1) {
										echo ',';
									}
									echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
									$i++;
								} ?>];
				jQuery("#district").jqxComboBox({
					theme: theme,
					promptText: "Select district",
					source: district,
					width: '97%',
					height: 21
				});
				var status = [<? $i = 1;
								foreach ($status as $row) {
									if ($i != 1) {
										echo ',';
									}
									echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
									$i++;
								} ?>];
				jQuery("#status").jqxComboBox({
					theme: theme,
					promptText: "Select Status",
					source: status,
					width: '97%',
					height: 21
				});
				var loan_segment = [<? $i = 1;
									foreach ($loan_segment as $row) {
										if ($i != 1) {
											echo ',';
										}
										echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
										$i++;
									} ?>];
				jQuery("#loan_segment").jqxComboBox({
					theme: theme,
					promptText: "Select Investment segment",
					source: loan_segment,
					width: '97%',
					height: 21
				});
				jQuery('#zone,#loan_segment,#district,#status').focusout(function() {
					commbobox_check(jQuery(this).attr('id'));
				});

			});

			function download_memo(url) {
				window.open(
					url, "_blank");
			}

			function change_dropdown(operation, edit = null) {
				var id = '';
				//check for add zone action
				if (edit == null) {
					id = jQuery("#" + operation).val();
				} else {
					id = edit;
				}
				var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				jQuery.ajax({
					url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
					async: false,
					type: "post",
					data: {
						[csrfName]: csrfHash,
						id: id,
						operation: operation
					},
					datatype: "json",
					success: function(response) {
						var json = jQuery.parseJSON(response);
						//console.log(json['row_info']);
						jQuery('.txt_csrfname').val(json.csrf_token);
						var str = '';
						var theme = getDemoTheme();
						if (operation == 'zone') {
							var district = [];
							jQuery.each(json['row_info'], function(key, obj) {
								district.push({
									value: obj.id,
									label: obj.name
								});
							});
							jQuery("#district").jqxComboBox({
								theme: theme,
								autoDropDownHeight: false,
								promptText: "Select District",
								source: district,
								width: '97%',
								height: 21
							});
							//For edit action
							if (edit != null) {
								jQuery("#district").jqxComboBox('val', '<?= (isset($result->district) && $result->district != 0) ? $result->district : '' ?>');
							}
						}

					},
					error: function(model, xhr, options) {
						alert('failed');
					},
				});

				return false;
			}

			function reloadCuragreementMessages() {
				window.location.reload();
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
					url: "<?= base_url() ?>legal_notice/r_history",
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
									html += '<td align="left">' + obj.oprs_reason + '</td>';
								} else {
									html += '<td align="left"></td>';
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

			function verify(id, indx, proposed_type) {
				jQuery("#jqxgrid").jqxGrid('clearselection');
				EOL.messageBoard.open('<?= base_url() ?>index.php/legal_notice/fromrecommend/' + id + '/' + indx + '/' + proposed_type, (jQuery(window).width() - 80), jQuery(window).height(), 'yes');
				return false;
			}

			function editt(val, indx, proposed_type) {
				jQuery("#jqxgrid").jqxGrid('clearselection');
				EOL.messageBoard.open('<?= base_url() ?>legal_notice/from/edit/' + val + '/' + indx + '/' + proposed_type, (jQuery(window).width() - 80), jQuery(window).height(), 'yes');
				return false;
			}

			function call_ajax_submit() {

				var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				var postData = jQuery('#action_form').serialize() + "&" + csrfName + "=" + csrfHash;
				jQuery.ajax({
					type: "POST",
					cache: false,
					url: '<?= base_url() ?>index.php/legal_notice/delete_action/',
					data: postData,
					datatype: "json",
					success: function(response) {
						///console.log(response);
						var json = jQuery.parseJSON(response);
						jQuery('.txt_csrfname').val(json.csrf_token);
						if (json.Message != 'OK') {
							if ($('type').value == 'delete') {
								jQuery("#delete_button").show();
								jQuery("#deletecancel").show();
								jQuery("#delete_loading").hide();
								jQuery('#details').jqxWindow('close');
								alert(json.Message);
							} else {
								jQuery("#sendtochecker").show();
								jQuery("#SendTocheckercancel").show();
								jQuery("#sendtochecker_loading").hide();
								jQuery('#details').jqxWindow('close');
								alert(json.Message);
							}
							return false;
						} else {

							if ($('type').value == 'delete') {
								jQuery("#delete_button").show();
								jQuery("#deletecancel").show();
								jQuery("#delete_loading").hide();
							} else {
								jQuery("#sendtochecker").show();
								jQuery("#SendTocheckercancel").show();
								jQuery("#sendtochecker_loading").hide();
							}
							var row = {};
							row["id"] = json['row_info'].id;
							row["legal_notice_sts"] = json['row_info'].sts;
							row["sts"] = json['row_info'].sts;
							row["status"] = json['row_info'].legal_notice_sts;
							row["sl_no"] = json['row_info'].sl_no;
							row["loan_ac"] = json['row_info'].loan_ac;
							row["ac_name"] = json['row_info'].ac_name;
							row["e_by"] = json['row_info'].e_by;
							row["e_dt"] = json['row_info'].e_dt;
							row["return_reason_rm"] = json['row_info'].return_reason_rm;
							row["stc_by"] = json['row_info'].stc_by;
							row["stc_dt"] = json['row_info'].stc_dt;
							row["rec_by"] = json['row_info'].rec_by;
							row["rec_dt"] = json['row_info'].rec_dt;
							//jQuery("#jqxgrid").jqxGrid('clearselection');

							// var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', $('verifyIndexId').value);


							// console.log(dataRecord);


							// if($('type').value!='delete')
							// {
							// 	jQuery("#jqxgrid").jqxGrid('updaterow', $('verifyIndexId').value, row);
							// 	// jQuery.each(row, function(key,val){
							// 	// 	jQuery("#jqxgrid").jqxGrid('setcellvalue',$('verifyIndexId').value, key, row[key]);
							// 	// });
							// }else{
							// 	jQuery("#row"+$('verifyIndexId').value+"jqxgrid").hide();									
							// }

							// var dataRecord2 = jQuery("#jqxgrid").jqxGrid('getrowdata', $('verifyIndexId').value);

							// console.log(dataRecord2);
							// console.log(row);
							var msz = '';
							//if($('comments_sts').value=='0'){msz=' comments send';}
							//alert("test");
							//jQuery("#jqxgrid").jqxGrid('updatebounddata');
							//alert("test 1");
							jQuery("#error").show();
							jQuery("#error").fadeIn(100, function() {
								jQuery("#error").fadeOut(11500);
							});
							jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + $('type').value + msz);
							jQuery('#details').jqxWindow('close');
							jQuery("#jqxgrid").jqxGrid('updatebounddata');

						}
					}
				});

			}

			function details(id, operation, indx, district = null, zone = null) {
				jQuery('#deleteEventId').val(id);
				jQuery('#type').val(operation);
				jQuery('#verifyIndexId').val(indx);
				if (operation == 'details') {
					jQuery("#header_title").html('Reminder Notice Details');
					jQuery('#sendtochecker_row').hide();
					jQuery('#delete_row').hide();
					jQuery('#close_btn_row').show();
				} else if (operation == 'delete') {
					jQuery('#comments').val('');
					jQuery("#header_title").html('Delete Reminder Notice');
					jQuery('#sendtochecker_row').hide();
					jQuery('#delete_row').show();
					jQuery('#close_btn_row').hide();
				} else if (operation == 'sendtochecker') {
					jQuery("#header_title").html('Send to Checker Reminder Notice');
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
					url: "<?= base_url() ?>legal_notice/details",
					data: {
						[csrfName]: csrfHash,
						id: id,
						district: district,
						zone: zone
					},
					datatype: "json",
					success: function(response) {
						//alert(response);
						var json = jQuery.parseJSON(response);

						jQuery('.txt_csrfname').val(json['csrf_token']);
						if (json.str) {
							document.getElementById("details").style.visibility = 'visible';

							jQuery("#main_body").html(json['str']);

							 var html = '';
							 var select = '';
							if (json['checker_info'].length > 0) {
							 	var i = 1;
							 	jQuery.each(json['checker_info'], function(key, obj) {
							 		select = '';
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

			function decline_action() {
				jQuery("#decline_check").val(1);
				jQuery('#decline_part').css("display", "block");

			}
		</script>
		<div id="container" style="">
			<div id="body">
				<div style="display:block; min-height:340px; height:auto">
					<form method="POST" name="form" id="form" style="margin:0px;">
						<div style="padding: 0.5%;width:98%;height:45px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
							<table id="deal_body" style="display:block;width:100%">
								<tr>
									<td style="text-align:right;width:5%"><strong>zone&nbsp;&nbsp;</strong> </td>
									<td style="width:15%">
										<div style="padding-left:1.8%" id="zone" name="zone"></div>
									</td>
									<td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
									<td style="width:15%">
										<div style="padding-left:1.8%" id="district" name="district"></div>
									</td>
									<td style="text-align:right;width:5%"><strong>Status&nbsp;&nbsp;</strong> </td>
									<td style="width:15%">
										<div style="padding-left:1.8%" id="status" name="status"></div>
									</td>
									<td style="text-align:right;width:5%"><strong>Portfolio&nbsp;&nbsp;</strong> </td>
									<td style="width:15%">
										<div style="padding-left:1.8%" id="loan_segment" name="loan_segment"></div>
									</td>
									<td style="text-align:right;width:5%"><strong>Rec Date&nbsp;&nbsp;</strong> </td>
									<td style="width:30%"><input id="rec_dt_from" name="rec_dt_from" style="width:40%" />
										<script type="text/javascript">
											datePicker("rec_dt_from");
										</script>
										<strong>To</strong> <input id="rec_dt_to" name="rec_dt_to" style="width:40%" />
										<script type="text/javascript">
											datePicker("rec_dt_to");
										</script>
									</td>
									<td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
									</td>
								</tr>
								<tr>

									<td style="text-align:right;width:5%"><strong>InI. Date&nbsp;&nbsp;</strong> </td>
									<td style="width:15%"><input id="e_dt_from" name="e_dt_from" style="width:40%" />
										<script type="text/javascript">
											datePicker("e_dt_from");
										</script>
										<strong>To</strong> <input id="e_dt_to" name="e_dt_to" style="width:40%" />
										<script type="text/javascript">
											datePicker("e_dt_to");
										</script>
									</td>
									<td style="text-align:right;width:5%"><strong>APP. Date&nbsp;&nbsp;</strong> </td>
									<td style="width:15%"><input id="v_dt_from" name="v_dt_from" style="width:40%" />
										<script type="text/javascript">
											datePicker("v_dt_from");
										</script>
										<strong>To</strong> <input id="v_dt_to" name="v_dt_to" style="width:40%" />
										<script type="text/javascript">
											datePicker("v_dt_to");
										</script>
									</td>

								</tr>
							</table>
						</div>
						<div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>
						<div id="jqxgrid" style="width:100%;min-height:320px;height:auto;margin-top:5px"></div>


						<div style="float:left;padding-top: 5px;">
							<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
								<? if (ADD == 1) { ?>
									<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" href="<?= base_url() ?>index.php/legal_notice/from/add" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:180px;" value="Initiate Reminder Notice" id="sendButton" /></a>
								<? } ?> &nbsp;&nbsp;
								<? if (BULKRECOMMEND == 1) { ?>
									<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" href="<?= base_url() ?>index.php/legal_notice/bulk_operation/recommend" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:140px;" value="BULK Recommend" id="sendButton" /></a>
								<? } ?> &nbsp;&nbsp;
								<strong>D = </strong> Delete,&nbsp;
								<strong>DTL = </strong> Detail,&nbsp;
								<strong>E = </strong> Edit,&nbsp;
								<strong>STC = </strong> Send to Checker,&nbsp;
								<strong>REC = </strong> Recommend&nbsp;
							</div> <br />
						</div>
					</form>
				</div>
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
				<div class="wrapper">
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
				pp.document.writeln('</tr><tr><td><table class="gurantor" cellspacing="0" cellspadding="0">');
				pp.document.writeln(document.getElementById(gurantor_table).innerHTML);
				pp.document.writeln('</table></td></tr><tr><td style="height:20px;"></td></tr><tr>');
				pp.document.writeln('<td style="text-align:center; font-weight:bold;font-size:20px;">Facility Info</td>');
				pp.document.writeln('</tr><tr><td><table class="facility" cellspacing="0" cellspadding="0">');
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