<?php $this->load->view('cma_process/pages/css'); ?>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>


<!--Customization Start-->
<script type="text/javascript">
	var csrf_tokens = '';
	//var idd = 0; var indxx = 0;
	var guar_sts = [<? $i = 1;
					foreach ($guar_sts as $row) {
						if ($i != 1) {
							echo ',';
						}
						echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
						$i++;
					} ?>];
	var guar_type = [<? $i = 1;
						foreach ($guar_type as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
	var occ_sts = [<? $i = 1;
					foreach ($guar_occ as $row) {
						if ($i != 1) {
							echo ',';
						}
						echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
						$i++;
					} ?>];
	var cl = [<? $i = 1;
				foreach ($cl as $row) {
					if ($i != 1) {
						echo ',';
					}
					echo '{value:"' . $row->name . '", label:"' . $row->name . '"}';
					$i++;
				} ?>];
	//var facility_name = [<? $i = 1;
							foreach ($facility_name as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];

	jQuery(document).ready(function($) {
		var theme = 'classic';
		var proposed_type = ['Investment', 'Card'];
		jQuery("#proposed_type").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Proposed Type",
			source: proposed_type,
			width: 250,
			height: 25
		});
		jQuery("#s_proposed_type").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Proposed Type",
			source: proposed_type,
			width: 250,
			height: 25
		});
		var status = [<? $i = 1;
						foreach ($status as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var req_type = [<? $i = 1;
						foreach ($req_type as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var pre_auc_sts = [<? $i = 1;
							foreach ($pre_auc_sts as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		var loan_segment = [<? $i = 1;
							foreach ($loan_segment as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		var sub_type = [<? $i = 1;
						foreach ($sub_type as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var zone_data = [<? $i = 1;
							foreach ($zone_data as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		var case_fill_dist = [<? $i = 1;
								foreach ($district_list as $row) {
									if ($i != 1) {
										echo ',';
									}
									echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
									$i++;
								} ?>];

		var branch_sol = [<? $i = 1;
							foreach ($branch_sol as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->code . '", label:"' . $row->name . ' (' . $row->code . ')"}';
								$i++;
							} ?>];
		var sec_sts = [<? $i = 1;
						foreach ($sec_sts as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var busi_sts = [<? $i = 1;
						foreach ($busi_sts as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var borr_sts = [<? $i = 1;
						foreach ($borr_sts as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var case_logic = [<? $i = 1;
							foreach ($case_logic as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		//var recovery_am = [<? $i = 1;
								foreach ($recovery_am as $row) {
									if ($i != 1) {
										echo ',';
									}
									echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
									$i++;
								} ?>];
		var chq_sts = [<? $i = 1;
						foreach ($chq_sts as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var pre_case_sts = [<? $i = 1;
							foreach ($case_sts as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		var disposal_sts = [<? $i = 1;
							foreach ($disposal_sts as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		jQuery("#sec_sts").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Security Status",
			source: sec_sts,
			width: 250,
			height: 25
		});
		jQuery("#busi_sts").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Business Status",
			source: busi_sts,
			width: 250,
			height: 25
		});
		jQuery("#borr_sts").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Borrower Status",
			source: borr_sts,
			width: 250,
			height: 25
		});
		jQuery("#case_logic").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Logic for ARA Case",
			source: case_logic,
			width: 250,
			height: 25
		});
		//jQuery("#recovery_am").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Recovery AM", source: recovery_am, width: 250, height: 25});
		jQuery("#chq_sts").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Chq. Status",
			source: chq_sts,
			width: 250,
			height: 25
		});
		jQuery("#pre_case_sts").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Case Status",
			source: pre_case_sts,
			width: 250,
			height: 25
		});
		jQuery("#disposal_sts").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Disposal Status",
			source: disposal_sts,
			width: 250,
			height: 25
		});
		jQuery("#branch_sol").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Branch Code",
			source: branch_sol,
			width: 250,
			height: 25
		});
		jQuery("#zone").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select Zone",
			source: zone_data,
			width: 250,
			height: 25
		});
		jQuery("#req_type").jqxComboBox({
			theme: theme,
			width: 250,
			autoDropDownHeight: false,
			promptText: "Select Requisition Type",
			source: req_type,
			height: 25
		});
		jQuery("#pre_auc_sts").jqxComboBox({
			theme: theme,
			width: 250,
			autoDropDownHeight: false,
			promptText: "Previous Auc Status",
			source: pre_auc_sts,
			height: 25
		});
		jQuery("#pre_case_type").jqxComboBox({
			theme: theme,
			width: 250,
			autoDropDownHeight: false,
			promptText: "Select Previous Case Type",
			source: req_type,
			height: 25
		});
		jQuery("#loan_segment").jqxComboBox({
			theme: theme,
			width: 250,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Segement",
			source: loan_segment,
			height: 25
		});
		jQuery("#sub_type").jqxComboBox({
			theme: theme,
			width: 250,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Business Type",
			source: sub_type,
			height: 25
		});
		jQuery("#guar_sts_1").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Stauts",
			source: guar_sts,
			width: 100,
			height: 25
		});
		jQuery("#occ_sts_1").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Occupation",
			source: occ_sts,
			width: 140,
			height: 25
		});
		jQuery("#guarantor_type_1").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Type",
			source: guar_type,
			width: 100,
			height: 25
		});

		var district = [];
		jQuery("#district").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select District",
			source: district,
			width: 250,
			height: 25,
			disabled: false
		});
		jQuery("#g_district").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select District",
			source: district,
			width: 200,
			height: 25,
			disabled: false
		});
		jQuery("#g_cl_bbl").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select CL AIBL",
			source: cl,
			width: '97%',
			height: 25,
			disabled: false
		});
		jQuery("#g_status").jqxComboBox({
			theme: theme,
			promptText: "Select Status",
			source: status,
			width: '97%',
			height: 21
		});
		jQuery("#g_loan_segment").jqxComboBox({
			theme: theme,
			width: 200,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Segement",
			source: loan_segment,
			height: 25
		});
		jQuery("#g_zone").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select Zone",
			source: zone_data,
			width: 150,
			height: 25
		});

		jQuery('#req_type,#pre_auc_sts,#pre_case_type,#pre_case_sts,#disposal_sts,#chq_sts,#case_logic,#borr_sts,#busi_sts,#branch_sol,#sec_sts,#guar_sts_1,#occ_sts_1,#guarantor_type_1,#zone,#district,#g_zone,#g_district,#proposed_type,#s_proposed_type,#loan_segment,#g_loan_segment,#sub_type,#g_status,#g_cl_bbl').focusout(function() {
			//alert(jQuery(this).attr('id'));
			commbobox_check(jQuery(this).attr('id'));
		});
		s_change_caption();
		jQuery('#s_proposed_type').bind('change', function(event) {
			jQuery("#s_account").val('');
			jQuery("#s_hidden_loan_ac").val('');
			s_change_caption();
		});
		change_caption();
		jQuery('#proposed_type').bind('change', function(event) {
			jQuery("#loan_ac").val('');
			jQuery("#hidden_loan_ac").val('');
			change_caption();
		});


		jQuery('#zone').bind('change', function(event) {
			change_dropdown('zone');
		});
		jQuery('#g_zone').bind('change', function(event) {
			change_dropdown('g_zone');
		});
		jQuery("#zone").jqxComboBox('val', '<?=$this->session->userdata['ast_user']['zone']?>');
		jQuery("#district").jqxComboBox('val', '<?=$this->session->userdata['ast_user']['district']?>');
		jQuery("#branch_sol").jqxComboBox('val', '<?=$this->session->userdata['ast_user']['branch_code']?>');
		jQuery("#zone").jqxComboBox({disabled: true});
		jQuery("#district").jqxComboBox({disabled: true});
		jQuery("#branch_sol").jqxComboBox({disabled: true});
		jQuery('#proposed_type').bind('change', function(event) {
			jQuery("#loan_ac").val('');
			jQuery("#hidden_loan_ac").val('');
			jQuery("#card_facility_row").hide();
			jQuery('#cma_form').jqxValidator('hide');
			change_caption();
		});
		jQuery('#sec_sts').bind('change', function(event) {
			var item = jQuery("#sec_sts").jqxComboBox('getSelectedItem');
			if (item.value == 1) {
				jQuery('#cma_doc_div').show();
				document.getElementById('auction_div').style.display = '';
			} else {
				jQuery('#cma_doc_div').hide();
				document.getElementById('auction_div').style.display = 'none';
			}
		});
		jQuery('#sub_type').bind('change', function(event) {
			var item = jQuery("#sub_type").jqxComboBox('getSelectedItem');
			if (item.label == 'Personal') {
				jQuery('#spfm').show();
			} else {
				jQuery('#spfm').hide();
				jQuery('#mother_name').val('');
				jQuery('#spouse_name').val('');
			}
			jQuery('#cma_form').jqxValidator('hide');
		});
		jQuery('#req_type').bind('change', function(event) {
			var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
			var item2 = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
			if (item.value != 2 && item.value != 5) {
				jQuery("#sec_sts").jqxComboBox('val', 4);
				jQuery("#sec_sts").jqxComboBox({
					disabled: false
				});
				jQuery("#pre_auc_sts").jqxComboBox('clearSelection');
				document.getElementById('auction_div').style.display = 'none';
			} else if (item.value == 5 && item2 != null && item2.value != 'Card') {
				jQuery("#sec_sts").jqxComboBox('val', 1);
				jQuery("#sec_sts").jqxComboBox({
					disabled: true
				});
				// jQuery("#pre_auc_sts").jqxComboBox('clearSelection');
				// document.getElementById('auction_div').style.display = 'none' ;
			} else if (item2 != null && item2.value == 'Card') {
				jQuery("#sec_sts").jqxComboBox('val', 4);
				jQuery("#sec_sts").jqxComboBox({
					disabled: true
				});
				jQuery("#pre_auc_sts").jqxComboBox('clearSelection');
				document.getElementById('auction_div').style.display = 'none';
			} else {
				jQuery("#sec_sts").jqxComboBox('clearSelection');
				jQuery("#sec_sts").jqxComboBox({
					disabled: false
				});
				document.getElementById('auction_div').style.display = '';
			}
			jQuery('#cma_form').jqxValidator('hide');
			//clear_desable_facility_checkbox();
		});
		jQuery('#req_type input').focus();
		jQuery("#delete_button").click(function() {
			var validationResult = function(isValid) {
				if (isValid) {
					jQuery("#delete_button").hide();
					jQuery("#deletecancel").hide();
					jQuery("#delete_loading").show();
					delete_action();
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
				delete_action();
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
		var jqxgrid = function() {
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
						name: 'e_by_id',
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
						name: 'cma_sts',
						type: 'int'
					},
					{
						name: 'req_type_id',
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
						name: 'rec_by',
						type: 'string'
					},
					{
						name: 'rec_dt',
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
						name: 'loan_type',
						type: 'int'
					},
					{
						name: 'sec_sts',
						type: 'int'
					},
					{
						name: 'district',
						type: 'int'
					},
					{
						name: 'zone',
						type: 'int'
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
				url: '<?= base_url() ?>index.php/cma_process/running_grid',
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
					var district = jQuery.trim(jQuery('#g_district').val());
					var zone = jQuery.trim(jQuery('#g_zone').val());
					var rec_dt_from = jQuery.trim(jQuery('#g_rec_dt_from').val());
					var rec_dt_to = jQuery.trim(jQuery('#g_rec_dt_to').val());
					var status = jQuery.trim(jQuery('#g_status').val());
					var e_dt_from = jQuery.trim(jQuery('#g_e_dt_from').val());
					var e_dt_to = jQuery.trim(jQuery('#g_e_dt_to').val());
					var v_dt_from = jQuery.trim(jQuery('#g_v_dt_from').val());
					var v_dt_to = jQuery.trim(jQuery('#g_v_dt_to').val());
					var loan_segment = jQuery.trim(jQuery('#g_loan_segment').val());
					var cl_bbl = jQuery.trim(jQuery('#g_cl_bbl').val());
					var outst_range = jQuery.trim(jQuery('#g_outst_range').val());
					// alert(status);
					// return;
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
						outst_range: outst_range,
						cl_bbl: cl_bbl,
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
						text: 'CMA STS',
						datafield: 'cma_sts',
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
								if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.e_by_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.cma_sts == 1 || dataRecord.cma_sts == 4 || dataRecord.cma_sts == 9 || dataRecord.cma_sts == 35)) {
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
								if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.e_by_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.cma_sts == 1 || dataRecord.cma_sts == 4 || dataRecord.cma_sts == 9 || dataRecord.cma_sts == 103 || dataRecord.cma_sts == 35)) {
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
								if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.e_by_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.cma_sts == 1 || dataRecord.cma_sts == 4 || dataRecord.cma_sts == 9 || dataRecord.cma_sts == 103 || dataRecord.cma_sts == 35)) {
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'sendtochecker\',' + editrow + ',' + dataRecord.district + ',' + dataRecord.zone + ')" ><img align="center" src="<?= base_url() ?>images/forward.png"></div>';
								} else if (dataRecord.cma_sts == 2) {
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
								if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.checker_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.cma_sts == 2)) {
									return '<div style="margin-top: 5px;text-align:center; cursor:pointer" onclick="verify(' + dataRecord.id + ',' + editrow + ',' + dataRecord.sec_sts + ',' + type + ',' + dataRecord.req_type_id + ')" ><img align="center" src="<?= base_url() ?>images/activate1.png"></div>';
								} else if (dataRecord.cma_sts == 'Recommended') {
									return '<div style=" margin-top: 7px; cursor:pointer;text-align:center">R</div>';
								} else {
									return '<div style=" margin-top: 7px;text-align:center"></div>';
								}

							}
						},
					<? } ?> {
						text: 'Status',
						datafield: 'status',
						cellclassname: cellclassname,
						editable: false,
						width: '25%',
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
						text: 'Protfolio',
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
							if ((dataRecord.return_reason_rm != null || dataRecord.reject_reason_rm != null || dataRecord.ho_return_reason != null || dataRecord.ho_decline_reason != null) && (dataRecord.cma_sts == 4 || dataRecord.cma_sts == 5 || dataRecord.cma_sts == 9)) {
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
						width: '15%',
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
						text: 'Requisition',
						datafield: 'req_type',
						cellclassname: cellclassname,
						editable: false,
						width: '8%',
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

		}
		// jqx tab init
		var initWidgets = function(tab) {
			switch (tab) {
				case 0:
					break;
				case 1:
					jqxgrid();
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
				clear_form();
			}

		});

		rules = [{
				input: '#req_type',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='req_type']").val(item.value);
						}
						return true;
					} else {
						jQuery("#req_type input").focus();
						return false;
					}
				}
			},
			{
				input: '#pre_case_type',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#pre_case_type").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='pre_case_type']").val(item.value);
						}
						return true;
					} else if (input.val() == '' && jQuery("#pre_cma_id").val() != '') {
						jQuery("#pre_case_type input").focus();
						return false;
					} else {
						return true;
					}
				}
			},
			{
				input: '#pre_auc_sts',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
					var item2 = jQuery("#sec_sts").jqxComboBox('getSelectedItem');
					if (item != null && item2 != null && item.value == 2 && item2.value == 1) {
						if (input.val() != '') {
							var item = jQuery("#pre_auc_sts").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='pre_auc_sts']").val(item.value);
							}
							return true;
						} else {
							jQuery("#pre_auc_sts input").focus();
							return false;
						}
					} else {
						return true;
					}

				}
			},
			{
				input: '#proposed_type',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='proposed_type']").val(item.value);
						}
						return true;
					} else {
						jQuery("#proposed_type input").focus();
						return false;
					}
				}
			},
			{
				input: '#loan_ac',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#loan_ac").val() == '') {
						jQuery("#loan_ac").focus();
						return false;
					} else {
						return true;
					}

				}
			},
			{
				input: '#loan_ac',
				message: 'only numeric',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (!checknumber_alphabaticwithstar('loan_ac')) {
							jQuery("#loan_ac").focus();
							return false;

						}
					}
					return true;

				}
			},
			{
				input: '#loan_ac',
				message: 'must be <?= loan_ac_count() ?> digits',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						var arr = '<?= loan_ac_count() ?>';
						arr = arr.split(',');
						if (jQuery.inArray(String(input.val().length), arr) != -1) {
							return true;
						} else {
							jQuery("#loan_ac").focus();
							return false;
						}
					}
					return true;

				}
			},
			{
				input: '#cif',
				message: 'only numeric',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (!checknumber_alphabaticwithstar('cif')) {
							jQuery("#cif").focus();
							return false;

						}
					}
					return true;

				}
			},
			{
				input: '#cif',
				message: 'must be 8 characters',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (input.val().length > 8 || input.val().length < 8) {
							jQuery("#cif").focus();
							return false;

						}
					}
					return true;

				}
			},
			{
				input: '#branch_sol',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#branch_sol").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='branch_sol']").val(item.value);
							return true;
						} else {
							jQuery("#branch_sol input").focus();
							return false;
						}
					} else {
						jQuery("#branch_sol input").focus();
						return false;
					}
				}
			},
			{
				input: '#ac_name',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#ac_name").val() == '') {
						jQuery("#ac_name").focus();
						return false;
					} else {
						return true;
					}
				}
			},
			{
				input: '#brrower_name',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
					if (jQuery("#brrower_name").val() == '' && item.value == 'Investment') {
						jQuery("#brrower_name").focus();
						return false;
					} else {
						return true;
					}
				}
			},
			{
				input: '#loan_segment',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='loan_segment']").val(item.value);
						}
						return true;
					} else {
						jQuery("#loan_segment input").focus();
						return false;
					}
				}
			},
			{
				input: '#current_address',
				message: 'more than 250 characters',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (input.val().length > 250) {
							jQuery("#current_address").focus();
							return false;

						}
					}
					return true;

				}
			},
			{
				input: '#disposal_remarks',
				message: 'more than 250 characters',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (input.val().length > 250) {
							jQuery("#disposal_remarks").focus();
							return false;

						}
					}
					return true;

				}
			},
			{
				input: '#judgement_summery',
				message: 'more than 250 characters',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (input.val().length > 250) {
							jQuery("#judgement_summery").focus();
							return false;

						}
					}
					return true;

				}
			},
			{
				input: '#pre_case_fill_dt',
				message: 'Invalid',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (!input.val()) {
						return true;
					}
					if (validate_date(input.val())) {
						return true;
					} else {
						jQuery("#pre_case_fill_dt").focus();
						return false;
					}
				}
			},
			{
				input: '#last_payment_date',
				message: 'Invalid',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (!input.val()) {
						return true;
					}
					if (validate_date(input.val())) {
						return true;
					} else {
						jQuery("#last_payment_date").focus();
						return false;
					}
				}
			},
			{
				input: '#loan_sanction_dt',
				message: 'Invalid',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (!input.val()) {
						return true;
					}
					if (validate_date(input.val())) {
						return true;
					} else {
						jQuery("#loan_sanction_dt").focus();
						return false;
					}
				}
			},
			{
				input: '#call_up_serv_dt',
				message: 'required!',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (jQuery("#call_up_serv_dt").val() == '') {
						var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
						if (item != null) {
							if (item.value != 1) {
								jQuery("#call_up_serv_dt").focus();
								return false;
							} else if (item.value == 1 && dateCheck() == false) {
								return true;
							} else {
								return false;
							}
						} else {
							return false;
						}
					} else {
						return true;
					}
				}
			},
			{
				input: '#call_up_serv_dt',
				message: 'Invalid',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (!input.val()) {
						return true;
					}
					if (validate_date(input.val())) {
						return true;
					} else {
						jQuery("#call_up_serv_dt").focus();
						return false;
					}
				}
			},
			{
				input: '#chq_expiry_date',
				message: 'Invalid',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (!input.val()) {
						return true;
					}
					if (validate_date(input.val())) {
						return true;
					} else {
						jQuery("#chq_expiry_date").focus();
						return false;
					}
				}
			},

			{
				input: '#zone',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#zone").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='zone']").val(item.value);
						}
						return true;
					} else {
						jQuery("#zone input").focus();
						return false;
					}
				}
			},


			{
				input: '#district',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#district").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='district']").val(item.value);
						}
						return true;
					} else {
						jQuery("#district input").focus();
						return false;
					}
				}
			},
			{
				input: '#sec_sts',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#sec_sts").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='sec_sts']").val(item.value);
						}
						return true;
					} else {
						jQuery("#sec_sts input").focus();
						return false;
					}
				}
			},
			{
				input: '#busi_sts',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#busi_sts").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='busi_sts']").val(item.value);
						}
						return true;
					} else {
						jQuery("#busi_sts input").focus();
						return false;
					}
				}
			},
			{
				input: '#borr_sts',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#borr_sts").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='borr_sts']").val(item.value);
						}
						return true;
					} else {
						jQuery("#borr_sts input").focus();
						return false;
					}
				}
			},
			// { input: '#int_rate', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
			// 	if(jQuery("#int_rate").val()=='')
			// 	{
			// 		jQuery("#int_rate").focus();
			// 		return false;
			// 	}
			// 	else
			// 	{
			// 		return true;
			// 	}
			// }
			// },
			// { input: '#int_rate', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
			//  {
			//  	if(input.val() != '')
			// 	{
			// 		if(!checknumber_alphabaticDot('int_rate'))
			// 		{
			// 			jQuery("#int_rate").focus();
			// 		 	return false;

			// 		}
			// 	}
			// 	return true;

			// } },
			{
				input: '#current_dpd',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#current_dpd").val() == '') {
						jQuery("#current_dpd").focus();
						return false;
					} else {
						return true;
					}
				}
			},
			{
				input: '#current_dpd',
				message: 'only numeric',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (!checknumber_alphabaticDot('current_dpd')) {
							jQuery("#current_dpd").focus();
							return false;

						}
					}
					return true;

				}
			},
			{
				input: '#case_logic',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#case_logic").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='case_logic']").val(item.value);
						}
						return true;
					} else {
						jQuery("#case_logic input").focus();
						return false;
					}
				}
			},
			// { input: '#recovery_am', message: 'required!', action: 'blur, change', rule: function (input) {
			// 		if(input.val() != '')
			// 		{
			// 			var item = jQuery("#recovery_am").jqxComboBox('getSelectedItem');
			// 			if(item != null){jQuery("input[name='recovery_am']").val(item.value);}
			// 			return true;
			// 		}
			// 		else
			// 		{
			// 			jQuery("#recovery_am input").focus();
			// 			return false;
			// 		}
			// 	}
			// },
			{
				input: '#remarks',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#remarks").val() == '' && jQuery("#pre_cma_id").val() != '') {
						jQuery("#remarks").focus();
						return false;
					} else {
						return true;
					}
				}
			},
			{
				input: '#guarantor_type_1',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#guarantor_type_1").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='guarantor_type_1']").val(item.value);
						}
						return true;
					} else {
						jQuery("#guarantor_type_1 input").focus();
						return false;
					}
				}
			},
			{
				input: '#guarantor_name_1',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#guarantor_name_1").val() == '') {
						jQuery("#guarantor_name_1").focus();
						return false;
					} else {
						return true;
					}
				}
			},
			{
				input: '#guarantor_name_1',
				message: 'more than 50 characters',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (input.val().length > 50) {
							jQuery("#guarantor_name_1").focus();
							return false;

						}
					}
					return true;

				}
			},
			// { input: '#father_name_1', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
			// 	var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
			// 	if (item.value=='Investment')
			// 	{
			// 		if(jQuery("#father_name_1").val()=='')
			// 		{
			// 			jQuery("#father_name_1").focus();
			// 			return false;
			// 		}
			// 		else
			// 		{
			// 			return true;
			// 		}
			// 	}
			// 	return true;

			// }
			// },
			{
				input: '#father_name_1',
				message: 'more than 50 characters',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
					if (item.value == 'Investment') {
						if (input.val() != '') {
							if (input.val().length > 50) {
								jQuery("#father_name_1").focus();
								return false;

							}
						}
						return true;
					}
					return true;

				}
			},
			{
				input: '#present_address_1',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#present_address_1").val() == '') {
						jQuery("#present_address_1").focus();
						return false;
					} else {
						return true;
					}
				}
			},
			{
				input: '#present_address_1',
				message: 'more than 200 characters',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (input.val().length > 200) {
							jQuery("#present_address_1").focus();
							return false;

						}
					}
					return true;

				}
			},
			{
				input: '#guar_sts_1',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
					if (item.value == 'Investment') {
						if (input.val() != '') {
							var item = jQuery("#guar_sts_1").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='guar_sts_1']").val(item.value);
							}
							return true;
						} else {
							jQuery("#guar_sts_1 input").focus();
							return false;
						}
					}
					return true;

				}
			},
			{
				input: '#occ_sts_1',
				message: 'required!',
				action: 'blur, change',
				rule: function(input) {
					var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
					if (item.value == 'Investment') {
						if (input.val() != '') {
							var item = jQuery("#occ_sts_1").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='occ_sts_1']").val(item.value);
							}
							return true;
						} else {
							jQuery("#occ_sts_1 input").focus();
							return false;
						}
					}
					return true;
				}
			}

		];
		jQuery("#in_req_button").click(function() {
			jQuery('#cma_form').jqxValidator({
				rules: rules,
				theme: theme
			});
			var validationResult = function(isValid) {
				if (isValid && owner_validation() == true && facility_validation() == true) {
					jQuery("#in_req_button").hide();
					jQuery("#send_loading").show();
					call_ajax_submit();
				} else {
					return;
				}
			}
			jQuery('#cma_form').jqxValidator('validate', validationResult);
		});
		if (jQuery("#add_edit").val()=='add') {
			jQuery("#proposed_type").jqxComboBox('val', 'Investment');
			call_api();
		}

	});

	function verify(id, indx, sec_sts, proposed_type, case_type) {
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?= base_url() ?>index.php/cma_process/fromrecommend/' + id + '/' + indx + '/' + sec_sts + '/' + proposed_type + '/' + case_type, (jQuery(window).width() - 80), jQuery(window).height(), 'yes');
		return false;
	}

	function call_ajax_submit() {
		var postdata = jQuery('#cma_form').serialize();
		var add_edit = jQuery("#add_edit").val();
		var edit_row = jQuery("#edit_row").val();

		//console.log(postdata);
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?= base_url() ?>cma_process/add_edit_action/",
			data: postdata,
			datatype: "json",
			async: false,
			success: function(response) {
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				if (json.Message != 'OK') {
					if (add_edit == 'edit') {
						jQuery("#in_up_loading").hide();
						jQuery("#in_up_button").show();
						jQuery('#jqxTabs').jqxTabs('select', 1);

					} else {
						jQuery("#in_req_button").show();
						jQuery("#in_req_loading").hide();
					}
					var err = json.Message.split(" ");
					if (err[1] != 'out') {
						jQuery("#" + err[1]).focus();
					}
					alert(json.Message);

					return false;
				}
				var msg = '';
				if (edit_row > 0) {
					msg = 'Updated';
				} else {
					msg = "Saved";
				}
				clear_form();
				jQuery("#error").show();
				jQuery("#error").fadeOut(11500);
				jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + msg);
				if (add_edit == 'edit') {
					jQuery("#in_up_loading").hide();
					jQuery("#in_up_button").show();
					jQuery('#jqxTabs').jqxTabs('select', 1);
				} else {
					jQuery("#in_req_button").show();
					jQuery("#in_req_loading").hide();
				}
				jQuery('#jqxTabs').jqxTabs('select', 1);
				jQuery("#jqxgrid").jqxGrid('updatebounddata');
			}
		});
	}

	function delete_action() {
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#action_form').serialize() + "&" + csrfName + "=" + csrfHash;
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?= base_url() ?>index.php/cma_process/delete_action/',
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
					row["sl_no"] = json['row_info'].sl_no;
					row["loan_ac"] = json['row_info'].loan_ac;
					row["ac_name"] = json['row_info'].ac_name;

					var msz = '';
					// //if($('comments_sts').value=='0'){msz=' comments send';}
					jQuery("#jqxgrid").jqxGrid('updatebounddata');
					jQuery("#error").show();
					jQuery("#error").fadeIn(100, function() {
						jQuery("#error").fadeOut(11500);
					});
					jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + $('type').value + msz);
					jQuery('#details').jqxWindow('close');
				}
			}
		});

	}

	function clear_form() {
		jQuery('#search_area').hide();
		jQuery('#filing_area').show();
		jQuery('#preview_next').show();
		jQuery('#searchTable').html('');
		jQuery('#in_req_button').val('Initiate Request');
		jQuery('#add_edit').val('add');
		jQuery('#edit_row').val('');
		jQuery('#pending_id').val('');
		jQuery('#operation').val('');
		jQuery('#life_cycle').val('');
		jQuery('#more_acc_available').val('');
		jQuery('#pre_cma_id').val('');
		jQuery('#sl_no_edit').val('');
		jQuery('#card_iss_date').val('');
		jQuery('#card_exp_date').val('');
		jQuery('#outstanding_bl_dt').val('');
		jQuery('#card_limit').val('');
		jQuery('#outstanding_bl').val('');
		jQuery('#hidden_loan_ac').val('');
		jQuery('#hidden_dis_date').val('');
		jQuery('#hidden_customer_id').val('');
		jQuery('#pre_req_type').val('');
		jQuery('#pre_block_sts').val('');
		jQuery("#spouse_name").val('');
		jQuery("#mother_name").val('');

		jQuery("#req_type").jqxComboBox('clearSelection');
		jQuery("#req_type").val('');
		jQuery("#proposed_type").jqxComboBox('clearSelection');
		jQuery("#proposed_type").val('');
		jQuery("#loan_ac").val('');
		jQuery("#cif").val('');
		jQuery("#ac_name").val('');
		jQuery("#hidden_loan_ac").val('');
		jQuery("#branch_sol").jqxComboBox('clearSelection');
		jQuery("#branch_sol").val('');
		jQuery("#sub_type").jqxComboBox('clearSelection');
		jQuery("#sub_type").val('');
		jQuery("#loan_segment").jqxComboBox('clearSelection');
		jQuery("#loan_segment").val('');
		jQuery("#pre_case_sts").jqxComboBox('clearSelection');
		jQuery("#pre_case_sts").val('');
		jQuery("#pre_case_type").jqxComboBox('clearSelection');
		jQuery("#pre_case_type").val('');
		jQuery("#disposal_sts").jqxComboBox('clearSelection');
		jQuery("#disposal_sts").val('');
		jQuery("#zone").jqxComboBox('clearSelection');
		jQuery("#zone").val('');
		jQuery("#district").jqxComboBox('clearSelection');
		jQuery("#district").val('');
		jQuery("#sec_sts").jqxComboBox('clearSelection');
		jQuery("#sec_sts").val('');
		jQuery("#pre_auc_sts").jqxComboBox('clearSelection');
		jQuery("#pre_auc_sts").val('');
		jQuery("#busi_sts").jqxComboBox('clearSelection');
		jQuery("#busi_sts").val('');
		jQuery("#borr_sts").jqxComboBox('clearSelection');
		jQuery("#borr_sts").val('');
		jQuery("#case_logic").jqxComboBox('clearSelection');
		jQuery("#case_logic").val('');

		jQuery("#current_address").val('');
		jQuery("#brrower_name").val('');
		jQuery("#mobile_no").val('');
		jQuery("#chq_expiry_date").val('');
		jQuery("#last_payment_date").val('');
		jQuery("#last_payment_amount").val('');
		jQuery("#disposal_remarks").val('');
		jQuery("#judgement_summery").val('');
		jQuery("#call_up_serv_dt").val('');
		jQuery("#loan_sanction_dt").val('');
		jQuery("#pre_case_fill_dt").val('');
		jQuery("#current_dpd").val('');
		jQuery("#more_acc_number").val('');
		jQuery("#chq_sts").val('');
		jQuery("#remarks").val('');

		jQuery("#cma_doc_div").hide();
		jQuery("#card_row_for_facility").hide();
		jQuery("#loan_facility_row").show();

		jQuery("#card_row_for_facility_body").html('');
		jQuery("#loan_facility_info_body").html('');

		jQuery("#card_facility_info_counter").val(0);
		jQuery("#facility_info_counter").val(0);
		jQuery("#guarantor_info_counter").val(1);

		jQuery("#guarantor_info_delete_1").val(0);
		jQuery("#guarantor_info_edit_1").val(0);
		jQuery("#same_address_permission_1").val('');
		jQuery("#guarantor_type_1").jqxComboBox('clearSelection');
		jQuery("#guarantor_type_1").val('');
		jQuery("#guarantor_name_1").val('');
		jQuery("#father_name_1").val('');
		jQuery("#present_address_1").val('');
		jQuery("#permanent_address_1").val('');
		jQuery("#business_address_1").val('');
		jQuery("#guar_sts_1").jqxComboBox('clearSelection');
		jQuery("#guar_sts_1").val('');
		jQuery("#occ_sts_1").jqxComboBox('clearSelection');
		jQuery("#occ_sts_1").val('');

		var html = '';
		html += '<img style="cursor:pointer" src="<?= base_url() ?>images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'call_up_file\')"/>';
		html += '<input type="hidden" id="hidden_call_up_file_select" name="hidden_call_up_file_select" value="0">';
		html += '<span id="hidden_call_up_file">';
		jQuery('#call_up_file').html(html);

		var html = '';
		html += '<img style="cursor:pointer" src="<?= base_url() ?>images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'remarks_file\')"/>';
		html += '<input type="hidden" id="hidden_remarks_file_select" name="hidden_remarks_file_select" value="0">';
		html += '<span id="hidden_remarks_file">';
		jQuery('#remarks_file').html(html);

		var html = '';
		html += '<img style="cursor:pointer" src="<?= base_url() ?>images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'senction_letter\')"/>';
		html += '<input type="hidden" id="hidden_senction_letter_select" name="hidden_senction_letter_select" value="0">';
		html += '<span id="hidden_senction_letter">';
		jQuery('#senction_letter').html(html);

		jQuery("#in_req_button").show();
		jQuery("#proposed_type").jqxComboBox('val', 'Investment');
		add_more_facility();
		document.getElementById("checkAll").checked = false;

		jQuery("#zone").jqxComboBox('val', '<?=$this->session->userdata['ast_user']['zone']?>');
		jQuery("#district").jqxComboBox('val', '<?=$this->session->userdata['ast_user']['district']?>');
		jQuery("#branch_sol").jqxComboBox('val', '<?=$this->session->userdata['ast_user']['branch_code']?>');
		jQuery("#zone").jqxComboBox({disabled: true});
		jQuery("#district").jqxComboBox({disabled: true});
		jQuery("#branch_sol").jqxComboBox({disabled: true});
	}

	function fileValidation(name) {
		//alert(name);
		var fileInput = document.getElementById(name);
		var filePath = fileInput.value;
		var allowedExtensions = /(\.pdf|\.docx|\.jpeg|\.png|\.jpg)$/i;
		var fileSize = document.getElementById(name).files[0].size;
		if (!allowedExtensions.exec(filePath)) {
			alert('Only pdf/docx/jpeg/png/jpg file is allowed');
			fileInput.value = '';
			return false;
		}
		return true;
	}

	function facility_validation() {
		//clear_desable_facility_checkbox();
		//For loan facility validation
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		if (item.value == 'Investment') {
			var counter = 0;
			var total_row = jQuery('#facility_info_counter').val();
			//alert(total_row);
			var check = 0;
			var base_facility_check = 0;
			for (var i = 1; i <= total_row; i++) {
				if (document.getElementById("chkBoxSelect" + i).checked == true) {
					check++;
				}

				if (document.getElementById("chkBoxSelect" + i).checked == true && jQuery('#base_facility_' + i).val() == 1) {
					base_facility_check++;
				}
			}
			for (i = 1; i <= total_row; i++) {
				if (jQuery('#facility_info_delete_' + i).val() == 0) {
					if (jQuery.trim(jQuery('#disbursement_date_' + i).val()) == '') {
						alert('Disbursement Date Required');
						jQuery('#disbursement_date_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#expire_date_' + i).val()) == '') {
						alert('Expire Date Required');
						jQuery('#expire_date_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#int_rate_' + i).val()) == '') {
						alert('Profit Rate Required');
						jQuery('#int_rate_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#disbursed_amount_' + i).val()) == '') {
						alert('Disbursed Amount Required');
						jQuery('#disbursed_amount_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#outstanding_bl_' + i).val()) == '') {
						alert('Outstanding Balance Required');
						jQuery('#outstanding_bl_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#outstanding_bl_dt_' + i).val()) == '') {
						alert('Outstanding Bl Date Required');
						jQuery('#outstanding_bl_dt_' + i).focus();
						return false;
					}
					var item = jQuery("#cl_bb_" + i).jqxComboBox('getSelectedItem');
					//alert(item.value);
					if (!item) {
						alert('CL BB Required');
						jQuery('#cl_bb_' + i + ' input').focus();
						return false;
					}
					var item2 = jQuery("#cl_bbl_" + i).jqxComboBox('getSelectedItem');
					//alert(item.value);
					if (!item2) {
						alert('CL AIBL Required');
						jQuery('#cl_bbl_' + i + ' input').focus();
						return false;
					}
				}

			}
			// if (check < 1 || base_facility_check < 1) {
			// 	alert('Select your required account from facility info!!');
			// 	return false;
			// }


		} else {
			var ade = jQuery('#add_edit').val();
			if (ade == 'add') {
				var item = jQuery("#cl_bb_card").jqxComboBox('getSelectedItem');
				//alert(item.value);
				if (!item) {
					alert('CL BB Required');
					jQuery('#cl_bb_card input').focus();
					return false;
				}
				var item2 = jQuery("#cl_bbl_card").jqxComboBox('getSelectedItem');
				//alert(item.value);
				if (!item2) {
					alert('CL AIBL Required');
					jQuery('#cl_bbl_card input').focus();
					return false;
				}
			}
		}

		return true;
	}

	function CheckAll_2(checkAllBox) {
		var ChkState = checkAllBox.checked;
		var number = jQuery("#facility_info_counter").val();
		var loan_ac = jQuery("#loan_ac").val();
		if (ChkState == true) {
			for (var i = 1; i <= number; i++) {
				jQuery("#facility_info_delete_" + i).val(0);
				document.getElementById("chkBoxSelect" + i).checked = ChkState;
				var hidden_loan_ac = jQuery("#ac_number_" + i).val();
				if (hidden_loan_ac == loan_ac) {
					jQuery('#base_facility_' + i).val(1);
				}
			}
		} else {
			for (var i = 1; i <= number; i++) {
				jQuery("#facility_info_delete_" + i).val(1);
				document.getElementById("chkBoxSelect" + i).checked = ChkState;
			}
		}
	}

	function CheckChanged_2(checkAllBox, counter) {
		if (jQuery("#ac_number_" + counter).val() == '') {
			checkAllBox.checked = false;
			alert('A/C Number required');
			jQuery("#ac_number_" + counter).focus();
			return 0;
		}
		var ChkState = checkAllBox.checked;
		if (ChkState == true) {
			jQuery("#facility_info_delete_" + counter).val(0);
		} else {
			jQuery("#facility_info_delete_" + counter).val(1);
		}

		var number = jQuery("#facility_info_counter").val();
		var checkco = 0;
		var loan_ac = jQuery("#loan_ac").val();
		for (var i = 1; i <= number; i++) {
			if (document.getElementById("chkBoxSelect" + i).checked == true) {
				var hidden_loan_ac = jQuery("#ac_number_" + i).val();
				if (hidden_loan_ac == loan_ac) {
					jQuery('#base_facility_' + i).val(1);
				}
				checkco++;

			}
		}

		if (number == checkco) {
			document.getElementById("checkAll").checked = true;
		} else {
			document.getElementById("checkAll").checked = false;
		}
	}

	function api_date_format(str) {
		if (str == '' || str == undefined) {
			return '';
		} else {
			var str_1 = str.split("T");
			var str_2 = str_1[0].split("-");
			var final_str = str_2[2] + '/' + str_2[1] + '/' + str_2[0];
			return final_str;
		}
	}

	function get_chq_expiry(str, count_days = null, count_month = null) {
		if (str != '' || str == undefined) {
			var str_2 = str.split("/");
			var final_str = str_2[2] + '-' + str_2[1] + '-' + str_2[0];
			var result = new Date(final_str);
			if (count_month != null) //Adding Month
			{
				result.setMonth(result.getMonth() + parseInt(count_month));
			} else //Adding Days
			{
				result.setDate(result.getDate() + parseInt(count_days));
			}
			var dateString = moment(result).format('DD/MM/YYYY');
			return dateString;
		} else {
			return '';
		}
	}

	function api_date_format_x_time(str) {
		//var str_1=str.split("T");
		if (str == '' || str == undefined) {
			return '';
		} else {
			var str_2 = str.split("-");
			var final_str = str_2[0] + '/' + str_2[1] + '/' + str_2[2];
			return final_str;
		}
	}

	function card_date_format(str) {
		if (str == '' || str == undefined) {
			return '';
		} else {
			var year = str.slice(0, 4);
			var month = str.slice(4, 6);
			var day = str.slice(6, 8);
			var final_dt = day + '/' + month + '/' + year;
			return final_dt;
		}
	}

	function validate_api_call() {
		jQuery('#cma_form').jqxValidator('hide');

		var rules = [];
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		var acLength = <?php echo $acLength; ?>;
		if (item.value == 'Investment') {
			rules.push({
				input: '#proposed_type',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='proposed_type']").val(item.value);
						}
						return true;
					} else {
						jQuery("#proposed_type input").focus();
						return false;
					}
				}
			}, {
				input: '#loan_ac',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#loan_ac").val() == '') {
						jQuery("#loan_ac").focus();
						return false;
					} else {
						return true;
					}

				}
			}, {
				input: '#loan_ac',
				message: 'only numeric',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (!checknumber_alphabaticwithstar('loan_ac')) {
							jQuery("#loan_ac").focus();
							return false;

						}
					}
					return true;

				}
			}, {
				input: '#loan_ac',
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
			}, {
				input: '#cif',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#cif").val() == '') {
						jQuery("#cif").focus();
						return false;
					} else {
						return true;
					}
				}
			}, {
				input: '#cif',
				message: 'must be 8 characters',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (input.val().length > 8 || input.val().length < 8) {
							jQuery("#cif").focus();
							return false;

						}
					}
					return true;

				}
			});
		} else {
			rules.push({
				input: '#proposed_type',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='proposed_type']").val(item.value);
						}
						return true;
					} else {
						jQuery("#proposed_type input").focus();
						return false;
					}
				}
			}, {
				input: '#loan_ac',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#loan_ac").val() == '') {
						jQuery("#loan_ac").focus();
						return false;
					} else {
						return true;
					}

				}
			}, {
				input: '#loan_ac',
				message: 'only numeric',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (!checknumber_alphabaticwithstar('loan_ac')) {
							jQuery("#loan_ac").focus();
							return false;

						}
					}
					return true;

				}
			}, {
				input: '#loan_ac',
				message: 'must be <?= loan_ac_count() ?> digits',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						var arr = '<?= loan_ac_count() ?>';
						arr = arr.split(',');
						if (jQuery.inArray(String(input.val().length), arr) != -1) {
							return true;
						} else {
							jQuery("#loan_ac").focus();
							return false;
						}
					}
					return true;

				}
			});
		}
		jQuery('#cma_form').jqxValidator({
			rules: rules,
			theme: theme
		});
		var validationResult = function(isValid) {
			if (isValid) {
				call_api();
			}
		}
		jQuery('#cma_form').jqxValidator('validate', validationResult);
	}

	function capitialize(field) {
		const mySentence = jQuery('#' + field).val();
		const words = mySentence.split(" ");

		for (let i = 0; i < words.length; i++) {
			words[i] = words[i].substr(0, 1).toUpperCase() + words[i].substr(1).toLowerCase();
		}
		jQuery('#' + field).val(words.join(" "));
	}

	function card_exp_date_format(str) {
		if (str == '' || str == undefined) {
			return '';
		} else {
			var year = str.slice(0, 4);
			var month = str.slice(4, 6);
			var day = '01';
			var final_dt = day + '/' + month + '/' + year;
			return final_dt;
		}
	}

	function clear_desable_facility_checkbox() {
		var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
		var item2 = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		var loan_ac = jQuery("#loan_ac").val();
		if (item != null && item.value == 1 && item2 != null && item2.value == 'Investment') //when request name is NI-ACT other facility will be desabe for select as per mail request by prince(13-12-2022)
		{
			var number = jQuery("#facility_info_counter").val();
			for (var i = 1; i <= number; i++) {
				jQuery("#facility_info_delete_" + i).val(1);
				var hidden_loan_ac = jQuery("#ac_number_" + i).val();
				if (hidden_loan_ac == loan_ac) {
					document.getElementById("chkBoxSelect" + i).checked = true;
					document.getElementById("chkBoxSelect" + i).disabled = true;
					jQuery("#facility_info_delete_" + i).val(0);
					jQuery('#base_facility_' + i).val(1);
				} else {
					document.getElementById("chkBoxSelect" + i).checked = false;
					document.getElementById("chkBoxSelect" + i).disabled = true;
					jQuery("#facility_info_delete_" + i).val(1);
					jQuery('#base_facility_' + i).val(0);
				}
			}
			//document.getElementById("checkAll").disabled = true;

		} else {
			var number = jQuery("#facility_info_counter").val();
			for (var i = 1; i <= number; i++) {
				document.getElementById("chkBoxSelect" + i).checked = false;
				document.getElementById("chkBoxSelect" + i).disabled = false;
				jQuery("#facility_info_delete_" + i).val(1);
				jQuery('#base_facility_' + i).val(0);
			}
			//document.getElementById("checkAll").disabled = false;
		}
	}

	function card_number_masker(str) {
		if (str == '' || str == undefined) {
			return '';
		} else {
			var leg1 = str.slice(0, 6);
			var leg3 = str.slice(12, 16);
			var leg2 = '******';
			var final_leg = leg1 + leg2 + leg3;
			return final_leg;
		}
	}

	function call_api() {
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		if(item==null)
		{
			var type = 'Investment';
		}
		else
		{
			var type = item.value;
		}

		//Set empty of all condition field
		jQuery('#facility_info_counter').val(0);
		jQuery('#loan_facility_info_body').html('');
		jQuery("#loan_facility_row").hide();
		jQuery("#card_facility_row").hide();
		jQuery("#card_row_for_facility").hide();
		jQuery('#card_row_for_facility_body').html('');
		jQuery("#card_iss_date").val('');
		jQuery("#card_exp_date").val('');
		jQuery("#brrower_name").val('');
		jQuery("#card_limit").val('');
		jQuery("#outstanding_bl").val('');
		jQuery("#card_facility_body").html('');
		jQuery('#card_facility_counter').val(0);
		jQuery("#spfm").hide();
		jQuery("#spouse_name").val('');
		jQuery("#mother_name").val('');
		jQuery("#show_customer_id").html('');
		if (type == 'Investment') {
			var loan_ac = jQuery('#loan_ac').val();
			var cif = jQuery('#cif').val();
		}
		if (type == 'Card') {
			var loan_ac = jQuery('#hidden_loan_ac').val();
			var cif = jQuery('#cif').val();
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?= base_url() ?>cma_process/get_cif",
			data: {
				[csrfName]: csrfHash,
				type: type,
				ac: loan_ac,
				cif: cif
			},
			datatype: "json",
			beforeSend: function() {
				jQuery("#loading-overlay").show();
			},
			success: function(response) {
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				if (json.pre_cma_data != '') {
					jQuery("#pre_cma_app").html(json.pre_cma_data.status_name);
					jQuery("#pre_cma_app_type").val(json.pre_cma_data.status_name);
					jQuery("#pre_cma_app_dt").val(json.pre_cma_data.activities_datetime);
					jQuery("#pre_cma_app_dt_l").html(json.pre_cma_data.dt_fromat);
					jQuery("#pre_cma_id").val(json.pre_cma_data.cma_id);
					jQuery("#pre_req_type").val(json.pre_cma_data.req_type);
					jQuery("#pre_block_sts").val(json.pre_cma_data.duplicate);
					jQuery("#pre_case_type").jqxComboBox('val', json.pre_cma_data.req_type);
				} else {
					jQuery("#pre_cma_app").html('');
					jQuery("#pre_cma_app_type").val('');
					jQuery("#pre_cma_app_dt").val('');
					jQuery("#pre_cma_app_dt_l").html('');
					jQuery("#pre_cma_id").val('');
					jQuery("#pre_req_type").val('');
					jQuery("#pre_block_sts").val('');
					jQuery("#pre_case_type").jqxComboBox('clearSelection');
				}
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				var type = item.value;
				if (type == 'Card') {

					if (json.Message == 'ok') {
						jQuery("#hidden_loan_ac").val(loan_ac);
						jQuery("#cif").val(json.results['CIF_NO']);
						jQuery("#ac_name").val(name_filter(json.results['CARDHOLDER_NAME']));
						jQuery("#hidden_customer_id").val(json.results['CUSTOMER_ID']);
						jQuery("#show_customer_id").html(json.results['CUSTOMER_ID']);
						var present_address = address_filter(address_trim_end(json.results['HOME_ADDR1']) + ',' + address_trim_end(json.results['HOME_ADDR2']) + ',' + address_trim_end(json.results['HOME_ADDR3']) + ',' + address_trim_end(json.results['HOME_ADDR4']) + ',' + address_trim_end(json.results['HOME_ADDR5']));
						var parmanent_address = address_filter(address_trim_end(json.results['ALT1_BILL_ADDR1']) + ',' + address_trim_end(json.results['ALT1_BILL_ADDR2']) + ',' + address_trim_end(json.results['ALT1_BILL_ADDR3']) + ',' + address_trim_end(json.results['ALT1_BILL_ADDR4']) + ',' + address_trim_end(json.results['ALT1_BILL_ADDR5']));
						var business_address = address_filter(address_trim_end(json.results['CO_ADDR1']) + ',' + address_trim_end(json.results['CO_ADDR2']) + ',' + address_trim_end(json.results['CO_ADDR3']) + ',' + address_trim_end(json.results['CO_ADDR4']) + ',' + address_trim_end(json.results['CO_ADDR5']));
						jQuery('#branch_sol').jqxComboBox('val', json.results['ISSUING_BRANCH_ID'].replace(/\s\s+/g, ' '));
						/*jQuery("#card_iss_date").val(card_date_format(json.results['CREATION_DATE']));
						jQuery("#card_exp_date").val(card_date_format(json.results['EXPIRY_DATE']));
						jQuery("#outstanding_bl_dt").val(card_date_format(json.results['OUTSTD_BAL_DT']));
						jQuery("#card_limit").val(json.results['CREDIT_LIMIT']);
						jQuery("#outstanding_bl").val(json.results['OUTSTD_BAL']);*/
						//Card facility info
						if (typeof json['sub_card_data'] === 'object' && json['sub_card_data'] != null) {
							var size = Object.keys(json['sub_card_data']).length;
						} else {
							var size = 0;
						}
						html_string = '';
						var sub_card_counter = 0;
						var card_type = '';
						var out_bl_dt = '';
						if (size > 0) {

							jQuery.each(json['sub_card_data'], function(key, obj) {
								if (obj.BASIC_CARDHOLDER_NO.replaceAll(' ', '') == loan_ac) //Skipping other cards
								{
									var card_type = '';
									var card_no = '';
									var org_card_no = '';
									var card_exp_date = '';
									sub_card_counter++;
									if (obj.BASIC_SUPPLE_IND.replaceAll(' ', '') == 'B') {
										card_type = 'Basic';
									} else {
										card_type = 'Sup';
									}
									var card_no = card_number_masker(obj.CARDHOLDER_NO.replaceAll(' ', '')); //masking orginal card no
									var org_card_no = obj.CARDHOLDER_NO.replaceAll(' ', '');
									card_exp_date = card_exp_date_format(obj.EXPIRY_DATE.replaceAll(' ', ''));
									var today = new Date();
									out_bl_dt = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
									html_string += '<tr>';
									html_string += '<td style="text-align:center">' + card_type + '<input type="hidden" id="card_type_' + sub_card_counter + '" value="' + card_type + '" name="card_type_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + card_no + '<input type="hidden" id="org_card_no_' + sub_card_counter + '" value="' + org_card_no + '" name="org_card_no_' + sub_card_counter + '"><input type="hidden" id="card_no_' + sub_card_counter + '" value="' + card_no + '" name="card_no_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + name_filter(obj.CARDHOLDER_NAME) + '<input type="hidden" id="card_name_' + sub_card_counter + '" value="' + name_filter(obj.CARDHOLDER_NAME) + '" name="card_name_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + card_date_format(obj.CREATION_DATE.replaceAll(' ', '')) + '<input type="hidden" id="card_issue_dt_' + sub_card_counter + '" value="' + card_date_format(obj.CREATION_DATE.replaceAll(' ', '')) + '" name="card_issue_dt_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + card_exp_date + '<input type="hidden" id="card_exp_dt_' + sub_card_counter + '" value="' + card_exp_date + '" name="card_exp_dt_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + obj.CREDIT_LIMIT + '<input type="hidden" id="card_limit_' + sub_card_counter + '" value="' + obj.CREDIT_LIMIT + '" name="card_limit_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + obj.OUTSTD_BAL + '<input type="hidden" id="outstanding_bl_' + sub_card_counter + '" value="' + obj.OUTSTD_BAL + '" name="outstanding_bl_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + out_bl_dt + '<input type="hidden" id="outstanding_bl_dt_' + sub_card_counter + '" value="' + out_bl_dt + '" name="outstanding_bl_dt_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center"><div id="cl_bb_card" name="cl_bb_card" style="padding-left: 3px" ></div></td>';
									html_string += '<td style="text-align:center"><div id="cl_bbl_card" name="cl_bbl_card" style="padding-left: 3px" ></div></td>';
									html_string += '</tr>';
								}


							});
							html_string += '<tr>';
							html_string += '<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding :</td>';
							html_string += '<td style="font-weight: bold;text-align:center">' + json.results['OUTSTD_BAL'] + '</td>';
							html_string += '</tr>';

							//Card facility info
							html_string += '<input type="hidden" id="sub_card_counter" value="' + sub_card_counter + '" name="sub_card_counter">';

						} else {
							sub_card_counter++;
							var ca_no = jQuery('#loan_ac').val();
							var org_no = jQuery('#hidden_loan_ac').val();
							html_string += '<tr>';
							html_string += '<td style="text-align:center">Basic<input type="hidden" id="card_type_' + sub_card_counter + '" value="Basic" name="card_type_' + sub_card_counter + '"></td>';
							html_string += '<td style="text-align:center">' + ca_no + '<input type="hidden" id="org_card_no_' + sub_card_counter + '" value="' + org_no + '" name="org_card_no_' + sub_card_counter + '"><input type="hidden" id="card_no_' + sub_card_counter + '" value="' + ca_no + '" name="card_no_' + sub_card_counter + '"></td>';
							html_string += '<td style="text-align:center"><input type="text" id="card_name_' + sub_card_counter + '" value="" name="card_name_' + sub_card_counter + '"></td>';
							html_string += '<td style="text-align:center"><input type="text" id="card_issue_dt_' + sub_card_counter + '" value="" name="card_issue_dt_' + sub_card_counter + '"></td>';
							html_string += '<td style="text-align:center"><input type="text" id="card_exp_dt_' + sub_card_counter + '" value="" name="card_exp_dt_' + sub_card_counter + '"></td>';
							html_string += '<td style="text-align:center"><input type="text" id="card_limit_' + sub_card_counter + '" value="" name="card_limit_' + sub_card_counter + '"></td>';
							html_string += '<td style="text-align:center"><input type="text" id="outstanding_bl_' + sub_card_counter + '" value="" name="outstanding_bl_' + sub_card_counter + '"></td>';
							html_string += '<td style="text-align:center"><input type="text" id="outstanding_bl_dt_' + sub_card_counter + '" value="" name="outstanding_bl_dt_' + sub_card_counter + '"></td>';
							html_string += '<td style="text-align:center"><div id="cl_bb_card" name="cl_bb_card" style="padding-left: 3px" ></div></td>';
							html_string += '<td style="text-align:center"><div id="cl_bbl_card" name="cl_bbl_card" style="padding-left: 3px" ></div></td>';
							html_string += '</tr>';
							html_string += '<tr>';
							html_string += '<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding :</td>';
							html_string += '<td style="font-weight: bold;text-align:center">' + json.results['OUTSTD_BAL'] + '</td>';
							html_string += '</tr>';
							html_string += '<input type="hidden" id="sub_card_counter" value="' + sub_card_counter + '" name="sub_card_counter">';
						}
						jQuery('#card_row_for_facility_body').html(html_string);
						jQuery('#cl_bb_card').jqxComboBox({
							theme: theme,
							width: 100,
							autoOpen: false,
							autoDropDownHeight: false,
							promptText: "CL BB",
							source: cl,
							height: 25
						});
						jQuery('#cl_bb_card').focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
						});
						jQuery('#cl_bbl_card').jqxComboBox({
							theme: theme,
							width: 100,
							autoOpen: false,
							autoDropDownHeight: false,
							promptText: "CL AIBL",
							source: cl,
							height: 25
						});
						jQuery('#cl_bbl_card').focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
						});
						datePicker('card_issue_dt_' + sub_card_counter);
						datePicker('card_exp_dt_' + sub_card_counter);
						datePicker('outstanding_bl_dt_' + sub_card_counter);

						jQuery("#card_row_for_facility").show();
						jQuery("#sub_type").val(3);
						//Guarantor info

						jQuery('#guarantor_info_body').html('');
						var new_counter = 1;
						html_string = '';
						for (var i = 1; i <= 1; i++) {
							if (i == 1) //For borrower info
							{
								html_string += '<tr id="guarantor_info_' + new_counter + '">';
								html_string += '<td>';
								html_string += '<input type="hidden" id="guarantor_info_edit_' + new_counter + '" name="guarantor_info_edit_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="guarantor_info_delete_' + new_counter + '" name="guarantor_info_delete_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="same_address_permission_' + new_counter + '" name="same_address_permission_' + new_counter + '" value="">';
								html_string += '<input type="hidden" id="ac_no_' + new_counter + '" name="ac_no_' + new_counter + '" value="' + json.results['CIF_NO'] + '">';
								html_string += '</td>';
								html_string += '<td><div id="guarantor_type_' + new_counter + '" name="guarantor_type_' + new_counter + '" style="padding-left: 3px" ></div></td>';
								html_string += '<td><input name="guarantor_name_' + new_counter + '" onblur="capitialize(\'guarantor_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="guarantor_name_' + new_counter + '" value="' + name_filter(json.results['CARDHOLDER_NAME']) + '"/></td>';
								html_string += '<td><input name="father_name_' + new_counter + '" onblur="capitialize(\'father_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="father_name_' + new_counter + '" value="' + name_filter(json.results['FATHER_NAME']) + '"/></td>';
								html_string += '<td><textarea name="present_address_' + new_counter + '" onblur="capitialize(\'present_address_' + new_counter + '\')" class="text-input-big" id="present_address_' + new_counter + '" style="height:40px !important;width:90%">' + present_address + '</textarea></td>';
								html_string += '<td><textarea name="permanent_address_' + new_counter + '" onblur="capitialize(\'permanent_address_' + new_counter + '\')" class="text-input-big" id="permanent_address_' + new_counter + '" style="height:40px !important;width:90%">' + parmanent_address + '</textarea></td>';
								html_string += '<td><textarea name="business_address_' + new_counter + '" onblur="capitialize(\'business_address_' + new_counter + '\')" class="text-input-big" id="business_address_' + new_counter + '" style="height:40px !important;width:90%">' + business_address + '</textarea></td>';
								html_string += '<td><div id="guar_sts_' + new_counter + '" name="guar_sts_' + new_counter + '" style="padding-left: 3px"></div></td>';
								html_string += '<td><div id="occ_sts_' + new_counter + '" name="occ_sts_' + new_counter + '" style="padding-left: 3px"></div></td>';
								html_string += '</tr>';
								jQuery('#guarantor_info_body').html(html_string);
								jQuery('#guarantor_type_' + new_counter).jqxComboBox({
									theme: theme,
									width: 100,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Type",
									source: guar_type,
									height: 25
								});
								jQuery('#guarantor_type_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#guarantor_type_' + new_counter).jqxComboBox('val', 'M');
								jQuery('#guar_sts_' + new_counter).jqxComboBox({
									theme: theme,
									width: 100,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Status",
									source: guar_sts,
									height: 25
								});
								jQuery('#guar_sts_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#occ_sts_' + new_counter).jqxComboBox({
									theme: theme,
									width: 140,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Occupation",
									source: occ_sts,
									height: 25
								});
								jQuery('#occ_sts_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
							}
							// else //For Refference info
							// {
							// 	html_string = '';
							// 	html_string += '<tr id="guarantor_info_'+new_counter+'">';
							// 	html_string += '<td>';
							// 	html_string += '<input type="hidden" id="guarantor_info_edit_'+new_counter+'" name="guarantor_info_edit_'+new_counter+'" value="0">';
							// 	html_string += '<input type="hidden" id="guarantor_info_delete_'+new_counter+'" name="guarantor_info_delete_'+new_counter+'" value="0">';
							// 	html_string += '<input type="hidden" id="ac_no_'+new_counter+'" name="ac_no_'+new_counter+'" value="">';
							// 	html_string += '</td>';
							// 	html_string += '<td><div id="guarantor_type_'+new_counter+'" name="guarantor_type_'+new_counter+'" style="padding-left: 3px" ></div></td>';
							// 	html_string += '<td><input name="guarantor_name_'+new_counter+'" onblur="capitialize(\'guarantor_name_'+new_counter+'\')" type="text" class="" style="width:90%" id="guarantor_name_'+new_counter+'" value="'+json.results['REL_NAME']+'"/></td>';
							// 	html_string += '<td><input name="father_name_'+new_counter+'" onblur="capitialize(\'father_name_'+new_counter+'\')" type="text" class="" style="width:90%" id="father_name_'+new_counter+'" value=""/></td>';
							// 	html_string += '<td><textarea name="present_address_'+new_counter+'" onblur="capitialize(\'present_address_'+new_counter+'\')" class="text-input-big" id="present_address_'+new_counter+'" style="height:40px !important;width:90%">'+json.results['REL_ADDR1']+'</textarea></td>';
							// 	html_string += '<td><textarea name="permanent_address_'+new_counter+'" onblur="capitialize(\'permanent_address_'+new_counter+'\')" class="text-input-big" id="permanent_address_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
							// 	html_string += '<td><textarea name="business_address_'+new_counter+'" onblur="capitialize(\'business_address_'+new_counter+'\')" class="text-input-big" id="business_address_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
							// 	html_string += '<td><div id="guar_sts_'+new_counter+'" name="guar_sts_'+new_counter+'" style="padding-left: 3px"></div></td>';
							// 	html_string += '<td><div id="occ_sts_'+new_counter+'" name="occ_sts_'+new_counter+'" style="padding-left: 3px"></div></td>';
							// 	html_string += '</tr>';

							// 	jQuery('#guarantor_info_' +(new_counter-1)).after(html_string);
							// 	jQuery('#guarantor_type_'+new_counter).jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: guar_type, height: 25});
							// 	jQuery('#guarantor_type_'+new_counter).focusout(function() {
							// 				commbobox_check(jQuery(this).attr('id'));
							// 	});
							// 	jQuery('#guarantor_type_'+new_counter).jqxComboBox('val','R');
							// 	jQuery('#guar_sts_'+new_counter).jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Status", source: guar_sts, height: 25});
							// 	jQuery('#guar_sts_'+new_counter).focusout(function() {
							// 				commbobox_check(jQuery(this).attr('id'));
							// 	});
							// 	jQuery('#occ_sts_'+new_counter).jqxComboBox({theme: theme, width: 140, autoOpen: false, autoDropDownHeight: false, promptText: "Occupation", source: occ_sts, height: 25});
							// 	jQuery('#occ_sts_'+new_counter).focusout(function() {
							// 				commbobox_check(jQuery(this).attr('id'));
							// 	});
							// 	jQuery('#guarantor_info_counter').val(new_counter);
							// }
							jQuery('#guarantor_info_counter').val(new_counter);
							new_counter++;
						}
						jQuery("#loan_segment").jqxComboBox('val', 'R');
						if (json.results['MOTHER_NAME'] != '') {
							jQuery("#spfm").show();
							jQuery("#mother_name").val(name_filter(json.results['MOTHER_NAME'].trimEnd()));
							jQuery("#spouse_name").val(name_filter(json.results['SPOUSE_NAME'].trimEnd()));
						}

						jQuery("#loading-overlay").hide();
					} else {
						jQuery("#hidden_loan_ac").val('');
						jQuery("#hidden_customer_id").val('');
						jQuery("#loan_ac").val('');
						jQuery("#loading-overlay").hide();
						// alert("No Data Please try again..")
					}

				} else {
					if (json.Message == 'ok') {
						if (json.loan_segment) {
							var loan_segment = obj_cleaner_for_api_data(json.loan_segment);

						} else {
							var loan_segment = '';
						}
						if (json.mother_name) {
							var mother_name = obj_cleaner_for_api_data(json.mother_name);

						} else {
							var mother_name = '';
						}
						if (json.spouse_name) {
							var spouse_name = obj_cleaner_for_api_data(json.spouse_name);

						} else {
							var spouse_name = '';
						}
						if (loan_segment == 'R') {
							jQuery("#sub_type").val(3);
							jQuery("#spfm").show();
							jQuery("#mother_name").val(mother_name);
							jQuery("#spouse_name").val(spouse_name);
						}
						if (json.business_type) {
							var business_type = obj_cleaner_for_api_data(json.business_type);

						} else {
							var business_type = '';
						}

						if (loan_segment != 'R') {
							if (json.borrower_name) {
								var borrower_name = obj_cleaner_for_api_data(json.borrower_name);

							} else {
								var borrower_name = '';
							}
							jQuery("#brrower_name").val(borrower_name); //Set borrower name for Cor
							document.getElementById('borrower_name_div').style.display = '';
							if (business_type != '' && business_type == 'PROP') {
								jQuery("#sub_type").val(1); //compant
							} else if (business_type != '') {
								jQuery("#sub_type").val(2); //propotorship
							}
							jQuery("#spfm").hide();
						}
						jQuery("#loan_segment").jqxComboBox('val', loan_segment);
						//Guarantor Details
						if (typeof json['guar_details'] === 'object' && json['guar_details'] != null) {
							var size = Object.keys(json['guar_details']).length;
						} else {
							var siz = 0;
						}
						if (size > 0) {
							jQuery('#guarantor_info_body').html('');
							var counter = 0;
							for (var i = 1; i <= size; i++) {
								var new_counter = i;
								if (json['guar_details'][i]['type']) {
									var type = obj_cleaner_for_api_data(json['guar_details'][i]['type']);

								} else {
									var type = '';
								}
								if (json['guar_details'][i]['name']) {
									var name = name_filter(obj_cleaner_for_api_data(json['guar_details'][i]['name']));

								} else {
									var name = '';
								}
								if (json['guar_details'][i]['ac_no']) {
									var ac_no = obj_cleaner_for_api_data(json['guar_details'][i]['ac_no']);

								} else {
									var ac_no = '';
								}
								if (json['guar_details'][i]['father_name']) {
									var father_name = name_filter(obj_cleaner_for_api_data(json['guar_details'][i]['father_name']));

								} else {
									var father_name = '';
								}
								if (json['guar_details'][i]['present_address']) {
									var present_address = address_filter(obj_cleaner_for_api_data(json['guar_details'][i]['present_address']));

								} else {
									var present_address = '';
								}
								if (json['guar_details'][i]['permanent_address']) {
									var permanent_address = address_filter(obj_cleaner_for_api_data(json['guar_details'][i]['permanent_address']));

								} else {
									var permanent_address = '';
								}
								if (json['guar_details'][i]['business_address']) {
									var business_address = address_filter(obj_cleaner_for_api_data(json['guar_details'][i]['business_address']));

								} else {
									var business_address = '';
								}
								if (json['guar_details'][i]['Occupation']) {
									var Occupation = obj_cleaner_for_api_data(json['guar_details'][i]['Occupation']);

								} else {
									var Occupation = '';
								}
								html_string = '';
								html_string += '<tr id="guarantor_info_' + new_counter + '">';
								html_string += '<td>';
								html_string += '<input type="hidden" id="guarantor_info_edit_' + new_counter + '" name="guarantor_info_edit_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="guarantor_info_delete_' + new_counter + '" name="guarantor_info_delete_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="same_address_permission_' + new_counter + '" name="same_address_permission_' + new_counter + '" value="">';
								html_string += '<input type="hidden" id="ac_no_' + new_counter + '" name="ac_no_' + new_counter + '" value="' + ac_no + '">';
								if (i > 1) {
									html_string += '<img src="<?= base_url() ?>images/delete-New.png" onclick="delete_row_guarantor(' + new_counter + ')" style="margin-top: 5px;" style="cursor:pointer;">';
								}
								html_string += '</td>';
								html_string += '<td><div id="guarantor_type_' + new_counter + '" name="guarantor_type_' + new_counter + '" style="padding-left: 3px;margin-left:5px" ></div></td>';
								html_string += '<td><input name="guarantor_name_' + new_counter + '" onblur="capitialize(\'guarantor_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="guarantor_name_' + new_counter + '" value="' + name + '"/></td>';
								html_string += '<td><input name="father_name_' + new_counter + '" onblur="capitialize(\'father_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="father_name_' + new_counter + '" value="' + father_name + '"/></td>';
								html_string += '<td><textarea name="present_address_' + new_counter + '" onblur="capitialize(\'present_address_' + new_counter + '\')" class="text-input-big" id="present_address_' + new_counter + '" style="height:40px !important;width:90%">' + present_address.replace(/\s\s+/g, ' ') + '</textarea></td>';
								html_string += '<td><textarea name="permanent_address_' + new_counter + '" onblur="capitialize(\'permanent_address_' + new_counter + '\')" class="text-input-big" id="permanent_address_' + new_counter + '" style="height:40px !important;width:90%">' + permanent_address.replace(/\s\s+/g, ' ') + '</textarea></td>';
								html_string += '<td><textarea name="business_address_' + new_counter + '" onblur="capitialize(\'business_address_' + new_counter + '\')" class="text-input-big" id="business_address_' + new_counter + '" style="height:40px !important;width:90%">' + business_address.replace(/\s\s+/g, ' ') + '</textarea></td>';
								html_string += '<td><div id="guar_sts_' + new_counter + '" name="guar_sts_' + new_counter + '" style="padding-left: 3px;margin-left:5px"></div></td>';
								html_string += '<td><div id="occ_sts_' + new_counter + '" name="occ_sts_' + new_counter + '" style="padding-left: 3px;margin-left:5px"></div></td>';
								html_string += '</tr>';
								if (i == 1) {
									//alert(html_string);
									jQuery('#guarantor_info_body').html(html_string);
									counter++;
								} else {
									jQuery('#guarantor_info_' + counter).after(html_string);
									counter++;
								}
								jQuery('#guarantor_info_counter').val(new_counter);

								jQuery('#guarantor_type_' + new_counter).jqxComboBox({
									theme: theme,
									width: 100,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Type",
									source: guar_type,
									height: 25
								});
								jQuery('#guarantor_type_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#guarantor_type_' + new_counter).jqxComboBox('val', type);
								jQuery('#guar_sts_' + new_counter).jqxComboBox({
									theme: theme,
									width: 100,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Status",
									source: guar_sts,
									height: 25
								});
								jQuery('#guar_sts_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#occ_sts_' + new_counter).jqxComboBox({
									theme: theme,
									width: 140,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Occupation",
									source: occ_sts,
									height: 25
								});
								jQuery('#occ_sts_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#occ_sts_' + new_counter).jqxComboBox('val', Occupation);
							}
						}
						if (json.ac_name) {
							var ac_name = obj_cleaner_for_api_data(json.ac_name);

						} else {
							var ac_name = '';
						}
						if (json.mobileNo) {
							var mobileNo = obj_cleaner_for_api_data(json.mobileNo);

						} else {
							var mobileNo = '';
						}
						jQuery("#ac_name").val(ac_name);
						if (loan_segment == 'R') {
							jQuery("#brrower_name").val(ac_name);
						}
						jQuery("#mobile_no").val(mobileNo);
						//Facility Details
						var size = Object.keys(json['facility_info']).length;
						var counter = 0;
						if (size > 0) {
							jQuery('#loan_facility_info_body').html('');
							for (var i = 1; i <= size; i++) {
								var html_string = '';
								var facility_type = obj_cleaner_for_api_data(json['facility_info'][i]['facilit_type']);
								//var ac_name=json['facility_info'][i]['ac_name'][0];
								if (json['facility_info'][i]['ac_name']) {
									var ac_name = obj_cleaner_for_api_data(json['facility_info'][i]['ac_name']);

								} else {
									var ac_name = '';
								}
								var sch_desc = obj_cleaner_for_api_data(json['facility_info'][i]['schmDesc']);
								var dis_amt = obj_cleaner_for_api_data(json['facility_info'][i]['dis_amt']);
								var dis_date = api_date_format_x_time(obj_cleaner_for_api_data(json['facility_info'][i]['dis_date']));
								var lastAnyTrnDate = api_date_format_x_time(obj_cleaner_for_api_data(json['facility_info'][i]['lastAnyTrnDate']));
								var size2 = Object.keys(json['facility_info'][i]['details']).length;
								for (var j = 1; j <= size2; j++) {
									var ac_number = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['accountNumber']);
									var loanOpeningDate = api_date_format(obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['loanOpeningDate']));
									var expiryDate = api_date_format(obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['expiryDate']));
									//var tenureDays =json['facility_info'][i]['details'][j]['tenureDays'][0];
									if (json['facility_info'][i]['details'][j]['tenureMonths']) {
										var tenureMonths = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['tenureMonths']);

									} else {
										var tenureMonths = 0;
									}
									if (loan_ac == ac_number) //Checking the main loan acoount
									{
										var expiry_dat = get_chq_expiry(loanOpeningDate, 0, tenureMonths); //Getting Counted expiry date
										var chq_expiry_dat = get_chq_expiry(expiry_dat, 180); //Getting Counted chq expiry date
										jQuery("#chq_expiry_date").val(chq_expiry_dat);

										if (loanOpeningDate == undefined) {
											loanOpeningDate = '';
										}
										jQuery("#loan_sanction_dt").val(loanOpeningDate);
										jQuery("#hidden_dis_date").val(i); //initiate the row number of mathced loan ac
									}
									var totalLimit = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['totalLimit']);
									if (json['facility_info'][i]['details'][j]['numberOfRemainingInstallments']) {
										var numberOfRemainingInstallments = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['numberOfRemainingInstallments']);

									} else {
										var numberOfRemainingInstallments = '';
									}
									if (json['facility_info'][i]['details'][j]['oustandingAmount']) {
										var oustandingAmount = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['oustandingAmount']);

									} else {
										var oustandingAmount = '';
									}
									if (json['facility_info'][i]['details'][j]['overdueAmount']) {
										var overdueAmount = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['overdueAmount']);

									} else {
										var overdueAmount = '';
									}
									if (numberOfRemainingInstallments == undefined) {
										numberOfRemainingInstallments = '';
									}
									if (expiryDate == undefined) {
										expiryDate = '';
									}
									if (oustandingAmount == undefined) {
										oustandingAmount = '';
									}
									if (overdueAmount == undefined) {
										overdueAmount = '';
									}
								}
								var new_counter = i;
								html_string += '<tr id="facility_info_' + new_counter + '">';
								html_string += '<td>';
								if (loan_ac == ac_number) //Checking the main loan acoount
								{
									html_string += '<input type="hidden" id="base_facility_' + new_counter + '" name="base_facility_' + new_counter + '" value="1">';
								} else {
									html_string += '<input type="hidden" id="base_facility_' + new_counter + '" name="base_facility_' + new_counter + '" value="0">';
								}
								html_string += '<input type="hidden" id="facility_info_edit_' + new_counter + '" name="facility_info_edit_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="facility_info_delete_' + new_counter + '" name="facility_info_delete_' + new_counter + '" value="1">';
								html_string += '<input type="hidden" id="csms_new_' + new_counter + '" name="csms_new_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="due_installments_' + new_counter + '" name="due_installments_' + new_counter + '" value="' + numberOfRemainingInstallments + '">';
								//checked="checked"
								html_string += '<input type="checkbox" name="chkBoxSelect' + new_counter + '"  id="chkBoxSelect' + new_counter + '" onClick="CheckChanged_2(this,' + new_counter + ')" value="chk"/>';
								html_string += '</td>';
								html_string += '<td style="text-align:center"><input name="facility_type_' + new_counter + '" type="hidden" class="" style="width:90%" id="facility_type_' + new_counter + '" value="' + facility_type + '"/>' + facility_type + '</td>';
								html_string += '<td style="text-align:center"><input name="ac_number_' + new_counter + '" type="hidden" class="" style="width:90%" id="ac_number_' + new_counter + '" value="' + ac_number + '"/>' + ac_number + '</td>';
								html_string += '<td style="text-align:center"><input name="ac_name_' + new_counter + '" type="hidden" class="" style="width:90%" id="ac_name_' + new_counter + '" value="' + ac_name + '"/>' + ac_name + '</td>';
								html_string += '<td style="text-align:center"><input name="sch_desc_' + new_counter + '" type="hidden" class="" style="width:90%" id="sch_desc_' + new_counter + '" value="' + sch_desc + '"/>' + sch_desc + '</td>';
								html_string += '<td style="text-align:center"><input name="int_rate_' + new_counter + '" type="text" class="" style="width:90%" id="int_rate_' + new_counter + '" value=""/></td>';
								html_string += '<td style="text-align:center"><input name="disbursement_date_' + new_counter + '" type="text" class="" style="width:90%" id="disbursement_date_' + new_counter + '" value="' + dis_date + '" /></td>';
								html_string += '<td style="text-align:center"><input name="disbursed_amount_' + new_counter + '" type="text" class="" style="width:90%" id="disbursed_amount_' + new_counter + '" value="' + dis_amt + '"/></td>';
								html_string += '<td style="text-align:center"><input name="expire_date_' + new_counter + '" type="text" class="" style="width:90%" id="expire_date_' + new_counter + '" value="' + expiryDate + '" /></td>';
								html_string += '<td><input name="loan_tenor_' + new_counter + '" type="text" class="" style="width:90%" id="loan_tenor_' + new_counter + '" value="' + tenureMonths + '" /></td>';
								html_string += '<td><input name="payble_' + new_counter + '" type="text" class="" style="width:90%" id="payble_' + new_counter + '" /></td>';
								html_string += '<td><input name="repayment_' + new_counter + '" type="text" class="" style="width:90%" id="repayment_' + new_counter + '" /></td>';
								html_string += '<td><input name="outstanding_bl_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_' + new_counter + '" value="' + oustandingAmount + '"/></td>';
								html_string += '<td><input name="outstanding_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_dt_' + new_counter + '" value="' + lastAnyTrnDate + '"/></td>';
								html_string += '<td><input name="overdue_bl_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_' + new_counter + '" value="' + overdueAmount + '"/></td>';
								html_string += '<td><input name="overdue_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_dt_' + new_counter + '" /></td>';
								html_string += '<td><input name="call_up_dt_' + new_counter + '" type="text" class="" style="width:90%" id="call_up_dt_' + new_counter + '" /></td>';
								html_string += '<td style="text-align:center"><input name="write_off_dt_' + new_counter + '" type="text" class="" style="width:90%" id="write_off_dt_' + new_counter + '" value="" /></td>';
								html_string += '<td style="text-align:center"><input name="write_off_amount_' + new_counter + '" type="text" class="" style="width:90%" id="write_off_amount_' + new_counter + '" value=""/></td>';
								html_string += '<td style="text-align:center"><input name="recovery_after_Wf_' + new_counter + '" type="text" class="" style="width:90%" id="recovery_after_Wf_' + new_counter + '" value=""/></td>';
								html_string += '<td style="text-align:center"><div id="cl_bb_' + new_counter + '" name="cl_bb_' + new_counter + '" style="padding-left: 3px;"></div></td>';
								html_string += '<td style="text-align:center"><div id="cl_bbl_' + new_counter + '" name="cl_bbl_' + new_counter + '" style="padding-left: 3px;"></div></td>';
								html_string += '</tr>';
								if (i == 1) {
									//alert(html_string);
									jQuery('#loan_facility_info_body').html(html_string);
									counter++;
								} else {
									//alert(html_string);
									jQuery('#facility_info_' + counter).after(html_string);
									counter++;
								}
								// jQuery('#facility_type_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, promptText: "Facility", source: facility_name, height: 25});
								// jQuery('#facility_type_'+new_counter).jqxComboBox('val',facility_type);
								// jQuery('#facility_type_'+new_counter).jqxComboBox({ disabled: true });
								jQuery('#cl_bb_' + new_counter).jqxComboBox({
									theme: theme,
									width: 60,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "CL",
									source: cl,
									height: 25
								});
								jQuery('#cl_bbl_' + new_counter).jqxComboBox({
									theme: theme,
									width: 60,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "CL",
									source: cl,
									height: 25
								});
								jQuery('#cl_bb_' + new_counter + ',#cl_bbl_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								datePicker('disbursement_date_' + new_counter);
								datePicker('expire_date_' + new_counter);
								datePicker('write_off_dt_' + new_counter);
								datePicker('outstanding_bl_dt_' + new_counter);
								datePicker('overdue_bl_dt_' + new_counter);
								datePicker('call_up_dt_' + new_counter);
								html_string = '';
							}
							jQuery('#facility_info_counter').val(new_counter);
							jQuery("#card_facility_row").hide();
							jQuery("#loan_facility_row").show();
							//clear_desable_facility_checkbox();
						} else {
							jQuery("#card_facility_row").hide();
							jQuery("#loan_facility_row").show();
							jQuery('#loan_facility_info_body').html('');
							jQuery('#facility_info_counter').val(0);
							add_more_facility();
						}
						jQuery("#loading-overlay").hide();
					} else {
						jQuery('#facility_info_counter').val(0);
						jQuery('#loan_facility_info_body').html('');
						jQuery("#loan_facility_row").show();
						add_more_facility();
						jQuery("#loading-overlay").hide();
						// alert("No Data Please try again..")
					}
				}
			}
		});
	}

	function change_dropdown(operation, edit = null) {
		var id = '';
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
				var csrf_tokena = json.csrf_token;
				jQuery('.txt_csrfname').val(json.csrf_token);
				var str = '';
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
						width: 250,
						height: 25
					});
					//For edit action
					if (edit != null) {
						jQuery("#district").jqxComboBox('val', '<?= (isset($result->district) && $result->district != 0) ? $result->district : '' ?>');
					}
				}
				if (operation == 'g_zone') {
					var district = [];
					jQuery.each(json['row_info'], function(key, obj) {
						district.push({
							value: obj.id,
							label: obj.name
						});
					});
					jQuery("#g_district").jqxComboBox({
						theme: theme,
						autoDropDownHeight: false,
						promptText: "Select District",
						source: district,
						width: 250,
						height: 25
					});

				}

				if (operation == 'district') {
					var unit_office = [];
					//var educqu='<?= $this->session->userdata["ast_user"]["unit_office"] ?>'.split(',');
					jQuery.each(json['row_info'], function(key, obj) {
						// if (educqu.includes(obj.id))
						// {
						// 	unit_office.push({ value: obj.id, label: obj.name });
						// }
						unit_office.push({
							value: obj.id,
							label: obj.name
						});

					});
					jQuery("#unit_office").jqxComboBox({
						theme: theme,
						autoDropDownHeight: false,
						promptText: "Select Unit Office",
						source: unit_office,
						width: 250,
						height: 25
					});
					//For edit action
					if (edit != null) {
						jQuery("#unit_office").jqxComboBox('val', '<?= (isset($result->unit_office) && $result->unit_office != 0) ? $result->unit_office : '' ?>');
					}
				}

			},
			error: function(model, xhr, options) {
				alert('failed');
			},
		});

		return false;
	}

	function add_more_owner() {
		var counter = jQuery('#guarantor_info_counter').val();

		var new_counter = parseInt(counter) + 1;
		html_string = '';

		html_string += '<tr id="guarantor_info_' + new_counter + '">';
		html_string += '<td>';
		html_string += '<input type="hidden" id="guarantor_info_edit_' + new_counter + '" name="guarantor_info_edit_' + new_counter + '" value="0">';
		html_string += '<input type="hidden" id="guarantor_info_delete_' + new_counter + '" name="guarantor_info_delete_' + new_counter + '" value="0">';
		html_string += '<input type="hidden" id="same_address_permission_' + new_counter + '" name="same_address_permission_' + new_counter + '" value="">';
		html_string += '<input type="hidden" id="ac_no_' + new_counter + '" name="ac_no_' + new_counter + '" value="">';
		html_string += '<img src="<?= base_url() ?>images/delete-New.png" onclick="delete_row_guarantor(' + new_counter + ')" style="margin-top: 5px;cursor:pointer;">';
		html_string += '</td>';
		html_string += '<td><div id="guarantor_type_' + new_counter + '" name="guarantor_type_' + new_counter + '" style="padding-left: 3px;margin-left:5px" ></div></td>';
		html_string += '<td><input name="guarantor_name_' + new_counter + '" onblur="capitialize(\'guarantor_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="guarantor_name_' + new_counter + '" /></td>';
		html_string += '<td><input name="father_name_' + new_counter + '" onblur="capitialize(\'father_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="father_name_' + new_counter + '" /></td>';
		html_string += '<td><textarea name="present_address_' + new_counter + '" onblur="capitialize(\'present_address_' + new_counter + '\')" class="text-input-big" id="present_address_' + new_counter + '" style="height:40px !important;width:90%"></textarea></td>';
		html_string += '<td><textarea name="permanent_address_' + new_counter + '" onblur="capitialize(\'permanent_address_' + new_counter + '\')" class="text-input-big" id="permanent_address_' + new_counter + '" style="height:40px !important;width:90%"></textarea></td>';
		html_string += '<td><textarea name="business_address_' + new_counter + '" onblur="capitialize(\'business_address_' + new_counter + '\')" class="text-input-big" id="business_address_' + new_counter + '" style="height:40px !important;width:90%"></textarea></td>';
		html_string += '<td><div id="guar_sts_' + new_counter + '" name="guar_sts_' + new_counter + '" style="padding-left: 3px;margin-left:5px"></div></td>';
		html_string += '<td><div id="occ_sts_' + new_counter + '" name="occ_sts_' + new_counter + '" style="padding-left: 3px;margin-left:5px"></div></td>';
		html_string += '</tr>';

		jQuery('#guarantor_info_' + counter).after(html_string);

		jQuery('#guarantor_info_counter').val(new_counter);


		jQuery('#guarantor_type_' + new_counter).jqxComboBox({
			theme: theme,
			width: 100,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Type",
			source: guar_type,
			height: 25
		});
		jQuery('#guarantor_type_' + new_counter).focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});
		jQuery('#guar_sts_' + new_counter).jqxComboBox({
			theme: theme,
			width: 100,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Status",
			source: guar_sts,
			height: 25
		});
		jQuery('#guar_sts_' + new_counter).focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});
		jQuery('#occ_sts_' + new_counter).jqxComboBox({
			theme: theme,
			width: 140,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Occupation",
			source: occ_sts,
			height: 25
		});
		jQuery('#occ_sts_' + new_counter).focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});

	}

	function delete_row_guarantor(row_id) {
		jQuery('#guarantor_info_' + row_id).hide();
		jQuery('#guarantor_info_delete_' + row_id).val(1);
	}

	function owner_validation() {
		//Senction Letter Validation

		//Doc File Validation
		var item = jQuery("#sec_sts").jqxComboBox('getSelectedItem');
		//for loan owner validation
		if (item.value == 1) {
			var total_row = jQuery('#cma_document_counter').val();
			for (i = 1; i <= total_row; i++) {
				var field = jQuery('#data_field_name_' + i).val();
				if (add_edit == 'add') {
					if (jQuery("#hidden_" + field + "_select").val() == '0' && jQuery("#hidden_" + field + "_mandatory").val() == '1') {
						alert(jQuery('#data_field_full_name_' + i).val() + ' Needed');
						return false;
					}
				} else {
					if (jQuery("#hidden_" + field + "_select").val() == '0' && jQuery("#file_delete_value_" + field).val() == '1' && jQuery("#hidden_" + field + "_mandatory").val() == '1') {
						alert(jQuery('#data_field_full_name_' + i).val() + ' Needed');
						return false;
					} else if (jQuery("#hidden_" + field + "_select").val() == '0' && jQuery("#hidden_" + field + "_id").val() == '' && jQuery("#hidden_" + field + "_mandatory").val() == '1') {
						alert(jQuery('#data_field_full_name_' + i).val() + ' Needed');
						return false;
					}
				}

			}
			/*for (i=1;i<=total_row;i++) 
			 {
				var field=jQuery('#data_field_name_'+i).val();
				
					if (jQuery("#hidden_"+field+"_select").val()=='0' && jQuery("#hidden_"+field+"_mandatory").val()=='1') 
				 	{
				 		alert(jQuery('#data_field_full_name_'+i).val()+' Needed');
				 		return false;
				 	}
				
			 	
			 }*/
		}

		var counter = 0;

		var total_row = jQuery('#guarantor_info_counter').val();

		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		//for loan owner validation
		var borrower_check = 0;
		if (item.value == 'Investment') {
			for (i = 1; i <= total_row; i++) {
				if (jQuery('#guarantor_info_delete_' + i).val() == 0) {
					var item = jQuery("#guarantor_type_" + i).jqxComboBox('getSelectedItem');
					var item2 = jQuery("#guar_sts_" + i).jqxComboBox('getSelectedItem');
					var item3 = jQuery("#occ_sts_" + i).jqxComboBox('getSelectedItem');
					//alert(item.value);
					if (!item) {
						alert('Guarantor Type Required');
						//jQuery('#guarantor_type_'+i).focus();
						jQuery('#guarantor_type_' + i + ' input').focus();
						return false;
					} else {
						if (item.value == 'M') {
							borrower_check = 1;
						}
					}
					if (jQuery.trim(jQuery('#guarantor_name_' + i).val()) == '') {
						alert('Guarantor Name Required');
						jQuery('#guarantor_name_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#father_name_' + i).val()) == '') {
						alert('Father Name Required');
						jQuery('#father_name_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#present_address_' + i).val()) == '') {
						alert('Present Address Required');
						jQuery('#present_address_' + i).focus();
						return false;
					}
					// if (jQuery.trim(jQuery('#present_address_' + i).val()) == jQuery.trim(jQuery('#permanent_address_' + i).val()) && jQuery("#same_address_permission_" + i).val() == '') {
					// 	return show_confrimation_pop_up('Continue', i);
					// }
					if (!item2) {
						alert('Guarantor Sts Required');
						jQuery('#guar_sts_' + i + ' input').focus();
						return false;
					}
					if (!item3) {
						alert('Guarantor Occupation  Required');
						jQuery('#occ_sts_' + i + ' input').focus();
						return false;
					}
				}
			}
			if (borrower_check == 0) {
				alert('Borrower Needed');
				return false;
			};
		}
		//For Card owner validation
		else {
			for (i = 1; i <= total_row; i++) {
				if (jQuery('#guarantor_info_delete_' + i).val() == 0) {
					var item = jQuery("#guarantor_type_" + i).jqxComboBox('getSelectedItem');
					if (!item) {
						alert('Guarantor Type Required');
						//jQuery('#guarantor_type_'+i).focus();
						jQuery('#guarantor_type_' + i + ' input').focus();
						return false;
					} else {
						if (item.value == 'M') {
							borrower_check = 1;
						}
					}
					if (jQuery.trim(jQuery('#guarantor_name_' + i).val()) == '') {
						alert('Guarantor Name Required');
						jQuery('#guarantor_name_' + i).focus();
						return false;
					}
					// if(jQuery.trim(jQuery('#present_address_'+i).val())=='')
					// {
					// 	alert('Present Address Required');
					// 	jQuery('#present_address_'+i).focus();
					// 	return false;
					// }
				}
			}
			if (borrower_check == 0) {
				alert('Borrower Needed');
				return false;
			};
		}

		return true;
	}

	function show_confrimation_pop_up(operation, index) {
		jQuery("#message").html(operation);
		jQuery("#index").val(index);
		jQuery("#button_tag").html('OK');
		$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
		$('sendToCheckerMessageDialogCancel').style.display = 'inline';
		$('loadingReturn').style.display = 'none';
		sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {
			position: 'fixed',
			modal: true,
			width: 470,
			close: true,
			id: 'sendToCheckerMessageDialog'
		});
		sendToCheckerMessageDialog.show();
	}

	function give_permission() {
		sendToCheckerMessageDialog.hide();
		var index = jQuery("#index").val();
		jQuery("#same_address_permission_" + index).val('');
		jQuery('#permanent_address_' + index).focus();
		return false;
	}

	function close_window() {
		sendToCheckerMessageDialog.hide();
		var index = jQuery("#index").val();
		jQuery("#same_address_permission_" + index).val('');
		jQuery('#permanent_address_' + index).focus();
		return false;
	}

	function close_window2() {
		sendToCheckerMessageDialog2.hide();
		return false;
	}

	function check_duplicate_ara_case() {
		// var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
		// if(item!=null)
		// {
		// 	if(item.value==2 && jQuery("#pre_req_type").val()==2 && jQuery("#pre_block_sts").val()==1)
		// 	{
		//     $('sendToCheckerMessageDialogCancel2').style.display = 'inline';
		//     sendToCheckerMessageDialog2 = new EOL.dialog($('sendToCheckerMessageDialogContent2'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog2' });
		//     sendToCheckerMessageDialog2.show();
		//     return false;
		// 	}
		// }
		return true;
	}

	function change_brunch() {
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');

		if (item.value == 'Investment') {
			var arr = '<?= loan_ac_count() ?>';
			arr = arr.split(',');
			if (jQuery.inArray(String(jQuery("#loan_ac").val().length), arr) != -1) {
				var c_no = jQuery("#loan_ac").val().slice(0, 3);
				var cif = jQuery("#loan_ac").val().slice(3, 6);
				jQuery("#branch_sol").jqxComboBox('selectItem', c_no);
				jQuery("#cif").val(cif);
			}
		}

	}

	function file_delete(id) {
		if (confirm('Are you sure to Delete previous file?')) {
			jQuery("#file_preview_" + id).hide();
			jQuery("#file_delete_" + id).hide();
			jQuery("#file_delete_value_" + id).val(1);
		}
	}

	function dateCheck() {
		var row_number = jQuery("#hidden_dis_date").val();
		if (row_number == '') {
			return true;
		}
		var date1 = jQuery("#disbursement_date_" + row_number).val();
		if (date1 == '' || date1 == undefined) {
			return true;
		}
		var dis_date = '04/30/2017';
		var str_subsdt = date1.split("/")
		var subsdt = str_subsdt[1] + "/" + str_subsdt[0] + "/" + str_subsdt[2];
		var subdt = new Date(subsdt);

		var disbursement_date = new Date(dis_date);
		if (Date.parse(subdt) > Date.parse(disbursement_date)) {
			return false;
		} else {
			return true;
		}

	}

	function CustomerPickList(module_name = null, data_field_name = null) {

		newwindow = window.open("<?= base_url() ?>index.php/home/ajaxFileUpload/" + module_name + '/' + data_field_name, "Upload", "width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340");
		if (window.focus) {
			newwindow.focus()
		}
		return false;
	}

	function s_mask(str, textbox) {
		var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
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
					jQuery("#s_hidden_loan_ac").val(str);
				} else //For single value enter
				{
					//For New value
					var orginal_loan_ac = jQuery("#s_hidden_loan_ac").val();
					if (orginal_loan_ac.length < str.length) {
						var index = str.length - 1;
						var new_val = str.slice(index);
						orginal_loan_ac += new_val;
						//alert(orginal_loan_ac);
						jQuery("#s_hidden_loan_ac").val(orginal_loan_ac);
					}
					//For delete key
					else {
						var len = str.length;
						var new_val = orginal_loan_ac.slice(0, len);
						jQuery("#s_hidden_loan_ac").val(new_val);
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
						if (letter_Count < 6 || jQuery("#s_hidden_loan_ac").val().length != 16) {
							textbox.value = '';
							jQuery("#s_hidden_loan_ac").val('');
							alert('Wrong way to input Card No please try again');
						}
					}
				}
			}
		}

	}

	function s_change_caption() {
		if (jQuery("#s_proposed_type").val() == '') {
			document.getElementById("s_account").disabled = true;
			jQuery("#s_l_or_c_no").html('Investment A/C or Card');
		} else {
			document.getElementById("s_account").disabled = false;
			var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
			if (item.value == 'Investment') {
				jQuery("#s_l_or_c_no").html('Investment A/C ');
			} else if (item.value == 'Card') {
				jQuery("#s_l_or_c_no").html('Card');
			}
		}

	}

	function mask(str, textbox) {
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

	function change_caption() {
		if (jQuery("#proposed_type").val() == '') {
			document.getElementById("loan_ac").disabled = true;
			jQuery("#l_or_c_no").html('Investment A/C or Card');
			jQuery("#l_or_c_name").html('Investment A/C Name or Name on Card');
		} else {
			document.getElementById("loan_ac").disabled = false;
			var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
			if (item.value == 'Investment') {
				jQuery("#l_or_c_no").html('Investment A/C ');
				jQuery("#l_or_c_name").html('Investment A/C Name');
			} else if (item.value == 'Card') {
				jQuery("#l_or_c_no").html('Card');
				jQuery("#l_or_c_name").html('Name on Card');
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
		clear_form();
		var csrfName = jQuery('.txt_csrfname').attr('name');
		var csrfHash = jQuery('.txt_csrfname').val();
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?= base_url() ?>cma_process/get_edit_info",
			data: {
				[csrfName]: csrfHash,
				id: val,
				proposed_type: proposed_type
			},
			datatype: "json",
			async: false,
			success: function(response) {
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);

				if (json.Message == 'ok') {
					var row = json.result;
					jQuery('#jqxTabs').jqxTabs('select', 0);
					jQuery('#filing_area').show();
					jQuery('#search_area').hide();
					jQuery('#add_edit').val('edit');
					jQuery('#in_req_button').val('Update');
					jQuery('#edit_row').val(row.id);

					jQuery('#card_iss_date').val('');
					jQuery('#card_exp_date').val('');
					jQuery('#outstanding_bl_dt').val('');
					jQuery('#card_limit').val('');
					jQuery('#outstanding_bl').val('');
					jQuery('#hidden_dis_date').val('');
					jQuery('#hidden_customer_id').val('');
					jQuery('#pre_req_type').val('');
					jQuery('#pre_block_sts').val('');

					if (row.sub_type == 3) {
						jQuery("#spfm").show();
						jQuery("#spouse_name").val(row.spouse_name);
						jQuery("#mother_name").val(row.mother_name);
					} else {
						jQuery("#spfm").hide();
					}


					jQuery("#req_type").jqxComboBox('val', row.req_type);
					jQuery("#proposed_type").jqxComboBox('val', row.proposed_type);
					jQuery("#loan_ac").val(row.loan_ac);
					jQuery("#cif").val(row.cif);
					jQuery("#proposed_type").jqxComboBox({
						disabled: true
					});
					document.getElementById("loan_ac").disabled = true;
					document.getElementById("cif").disabled = true;
					document.getElementById("load_button").disabled = true;
					jQuery("#ac_name").val(row.ac_name);
					jQuery("#hidden_loan_ac").val(row.org_loan_ac);
					jQuery("#branch_sol").jqxComboBox('val', row.branch_sol);
					jQuery("#sub_type").jqxComboBox('val', row.sub_type);
					jQuery("#loan_segment").jqxComboBox('val', row.loan_segment);
					jQuery("#pre_case_sts").jqxComboBox('val', row.pre_case_sts);
					jQuery("#pre_case_type").jqxComboBox('val', row.pre_case_type);
					jQuery("#disposal_sts").jqxComboBox('val', row.disposal_sts);
					jQuery("#zone").jqxComboBox('val', row.zone);
					change_dropdown('zone');
					jQuery("#district").jqxComboBox('val', row.district);
					jQuery("#sec_sts").jqxComboBox('val', row.sec_sts);
					jQuery("#pre_auc_sts").jqxComboBox('val', row.pre_auc_sts);
					jQuery("#busi_sts").jqxComboBox('val', row.busi_sts);
					jQuery("#borr_sts").jqxComboBox('val', row.borr_sts);
					jQuery("#case_logic").jqxComboBox('val', row.case_logic);

					jQuery("#current_address").val(row.current_address);
					jQuery("#brrower_name").val(row.brrower_name);
					jQuery("#mobile_no").val(row.mobile_no);
					jQuery("#chq_expiry_date").val(row.chq_expiry_date_format);
					jQuery("#last_payment_date").val(row.last_payment_date_format);
					jQuery("#last_payment_amount").val(row.last_payment_amount);
					jQuery("#disposal_remarks").val(row.disposal_remarks);
					jQuery("#judgement_summery").val(row.judgement_summery);
					jQuery("#call_up_serv_dt").val(row.call_up_serv_dt_format);
					jQuery("#loan_sanction_dt").val(row.loan_sanction_dt_format);
					jQuery("#pre_case_fill_dt").val(row.pre_case_fill_dt_format);
					jQuery("#current_dpd").val(row.current_dpd);
					jQuery("#more_acc_number").val(row.more_acc_number);
					jQuery("#chq_sts").val(row.chq_sts);
					jQuery("#remarks").val(row.remarks);

					var call_up_file = row.call_up_file;
					var remarks_file = row.remarks_file;
					var senction_letter = row.senction_letter;
					var html = '';
					html += '<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'call_up_file\')"/>';
					html += '<input type="hidden" id="hidden_call_up_file_select" name="hidden_call_up_file_select" value="0">';
					if (call_up_file != '' && call_up_file != null) {
						html += '<span id="hidden_call_up_file"><img id="file_preview_call_up_file" onclick="popup(\'<?= base_url() ?>cma_file/call_up_file/' + call_up_file + '\')" style="cursor:pointer;text-align:center;padding-left:5px;" src="<?= base_url() ?>old_assets/images/print-preview.png"></span>';
						html += '<input type="hidden" id="hidden_call_up_file_value" name="hidden_call_up_file_value" value="' + call_up_file + '">';
						html += '<img id="file_delete_call_up_file" onclick="file_delete(\'call_up_file\')" src="<?= base_url() ?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
						html += '<input type="hidden" id="file_delete_value_call_up_file" name="file_delete_value_call_up_file" value="0">';

					} else {
						html += '<span id="hidden_call_up_file">';
					}
					html += '<span id="hidden_call_up_file">';
					jQuery('#call_up_file').html(html);

					var html = '';
					html += '<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'remarks_file\')"/>';
					html += '<input type="hidden" id="hidden_remarks_file_select" name="hidden_remarks_file_select" value="0">';
					if (remarks_file != '' && remarks_file != null) {
						html += '<span id="hidden_remarks_file"><img id="file_preview_remarks_file" onclick="popup(\'<?= base_url() ?>cma_file/remarks_file/' + remarks_file + '\')" style="cursor:pointer;text-align:center;padding-left:5px;" src="<?= base_url() ?>old_assets/images/print-preview.png"></span>';
						html += '<input type="hidden" id="hidden_remarks_file_value" name="hidden_remarks_file_value" value="' + remarks_file + '">';
						html += '<img id="file_delete_remarks_file" onclick="file_delete(\'remarks_file\')" src="<?= base_url() ?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
						html += '<input type="hidden" id="file_delete_value_remarks_file" name="file_delete_value_remarks_file" value="0">';

					} else {
						html += '<span id="hidden_remarks_file">';
					}
					html += '<span id="hidden_remarks_file">';
					jQuery('#remarks_file').html(html);

					var html = '';
					html += '<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'senction_letter\')"/>';
					html += '<input type="hidden" id="hidden_senction_letter_select" name="hidden_senction_letter_select" value="0">';
					if (senction_letter != '' && senction_letter != null) {
						html += '<span id="hidden_senction_letter"><img id="file_preview_senction_letter" onclick="popup(\'<?= base_url() ?>cma_file/senction_letter/' + senction_letter + '\')" style="cursor:pointer;text-align:center;padding-left:5px;" src="<?= base_url() ?>old_assets/images/print-preview.png"></span>';
						html += '<input type="hidden" id="hidden_senction_letter_value" name="hidden_senction_letter_value" value="' + senction_letter + '">';
						html += '<img id="file_delete_senction_letter" onclick="file_delete(\'senction_letter\')" src="<?= base_url() ?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
						html += '<input type="hidden" id="file_delete_value_senction_letter" name="file_delete_value_senction_letter" value="0">';
						jQuery('#senction_letter').html(html);
					} else {
						html += '<span id="hidden_senction_letter">';
					}
					html += '<span id="hidden_senction_letter">';
					jQuery('#senction_letter').html(html);


					// guarantor Info

					if (json.cma_guarantor === undefined || json.cma_guarantor.length == 0) {
						jQuery("#guarantor_row").hide();
						jQuery('#guarantor_info_counter').val('0');
					} else {
						//jQuery("#guarantor_row").show();
						//For Guarantor Data
						var html_string = '';
						var new_counter = 0;
						jQuery.each(json.cma_guarantor, function(key, obj) {
							new_counter++;
							html_string = '';
							html_string += '<tr id="guarantor_info_' + new_counter + '">';
							html_string += '<td>';
							html_string += '<input type="hidden" id="guarantor_info_edit_' + new_counter + '" name="guarantor_info_edit_' + new_counter + '" value="' + obj.id + '">';
							html_string += '<input type="hidden" id="guarantor_info_delete_' + new_counter + '" name="guarantor_info_delete_' + new_counter + '" value="0">';
							html_string += '<input type="hidden" id="same_address_permission_' + new_counter + '" name="same_address_permission_' + new_counter + '" value="">';
							html_string += '<input type="hidden" id="ac_no_' + new_counter + '" name="ac_no_' + new_counter + '" value="">';
							if (new_counter > 1) {
								html_string += '<img src="<?= base_url() ?>images/delete-New.png" onclick="delete_row_guarantor(' + new_counter + ')" style="margin-top: 5px;cursor:pointer;">';
							}
							html_string += '</td>';
							html_string += '<td><div id="guarantor_type_' + new_counter + '" name="guarantor_type_' + new_counter + '" style="padding-left: 3px;margin-left:5px" ></div></td>';
							html_string += '<td><input name="guarantor_name_' + new_counter + '" onblur="capitialize(\'guarantor_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="guarantor_name_' + new_counter + '" value="' + obj.guarantor_name + '"/></td>';
							html_string += '<td><input name="father_name_' + new_counter + '" onblur="capitialize(\'father_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="father_name_' + new_counter + '" value="' + obj.father_name + '"/></td>';
							html_string += '<td><textarea name="present_address_' + new_counter + '" onblur="capitialize(\'present_address_' + new_counter + '\')" class="text-input-big" id="present_address_' + new_counter + '" style="height:40px !important;width:90%">' + obj.present_address + '</textarea></td>';
							html_string += '<td><textarea name="permanent_address_' + new_counter + '" onblur="capitialize(\'permanent_address_' + new_counter + '\')" class="text-input-big" id="permanent_address_' + new_counter + '" style="height:40px !important;width:90%">' + obj.permanent_address + '</textarea></td>';
							html_string += '<td><textarea name="business_address_' + new_counter + '" onblur="capitialize(\'business_address_' + new_counter + '\')" class="text-input-big" id="business_address_' + new_counter + '" style="height:40px !important;width:90%">' + obj.business_address + '</textarea></td>';
							html_string += '<td><div id="guar_sts_' + new_counter + '" name="guar_sts_' + new_counter + '" style="padding-left: 3px;margin-left:5px"></div></td>';
							html_string += '<td><div id="occ_sts_' + new_counter + '" name="occ_sts_' + new_counter + '" style="padding-left: 3px;margin-left:5px"></div></td>';
							html_string += '</tr>';
							var counter = new_counter - 1;
							if (new_counter > 1) {
								jQuery('#guarantor_info_' + counter).after(html_string);
							} else {
								jQuery('#guarantor_info_body').html(html_string);
							}

							jQuery('#guarantor_type_' + new_counter).jqxComboBox({
								theme: theme,
								width: 100,
								autoOpen: false,
								autoDropDownHeight: false,
								promptText: "Type",
								source: guar_type,
								height: 25
							});
							jQuery('#guarantor_type_' + new_counter).focusout(function() {
								commbobox_check(jQuery(this).attr('id'));
							});
							jQuery('#guar_sts_' + new_counter).jqxComboBox({
								theme: theme,
								width: 100,
								autoOpen: false,
								autoDropDownHeight: false,
								promptText: "Status",
								source: guar_sts,
								height: 25
							});
							jQuery('#guar_sts_' + new_counter).focusout(function() {
								commbobox_check(jQuery(this).attr('id'));
							});
							jQuery('#occ_sts_' + new_counter).jqxComboBox({
								theme: theme,
								width: 140,
								autoOpen: false,
								autoDropDownHeight: false,
								promptText: "Occupation",
								source: occ_sts,
								height: 25
							});
							jQuery('#occ_sts_' + new_counter).focusout(function() {
								commbobox_check(jQuery(this).attr('id'));
							});
							jQuery('#guarantor_type_' + new_counter).jqxComboBox('val', obj.guarantor_type);
							jQuery('#guar_sts_' + new_counter).jqxComboBox('val', obj.guar_sts);
							jQuery('#occ_sts_' + new_counter).jqxComboBox('val', obj.occ_sts);
						});
						jQuery('#guarantor_info_counter').val(new_counter);
					}

					//console.log(json.doc_files);
					//For Cma Doc File
					cma_document_div('edit', json.doc_files);


					if (json.facility_info === undefined || json.facility_info.length == 0) {
						jQuery("#loan_facility_row").hide();
						jQuery("#card_row_for_facility").hide();
					} else {
						//For Facility 
						if (row.proposed_type == 'Investment') {
							jQuery("#loan_facility_row").show();
							jQuery('#loan_facility_info_body').html('');
							var new_counter = 0;
							var loan_ac = jQuery('#loan_ac').val();
							jQuery.each(json.facility_info, function(key, obj) {
								var html_string = '';
								new_counter++;
								html_string += '<tr id="facility_info_' + new_counter + '">';
								html_string += '<td>';
								if (loan_ac == obj.ac_number) //Checking the main loan acoount
								{
									html_string += '<input type="hidden" id="base_facility_' + new_counter + '" name="base_facility_' + new_counter + '" value="1">';
								} else {
									html_string += '<input type="hidden" id="base_facility_' + new_counter + '" name="base_facility_' + new_counter + '" value="0">';
								}
								html_string += '<input type="hidden" id="facility_info_edit_' + new_counter + '" name="facility_info_edit_' + new_counter + '" value="' + obj.id + '">';
								html_string += '<input type="hidden" id="facility_info_delete_' + new_counter + '" name="facility_info_delete_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="csms_new_' + new_counter + '" name="csms_new_' + new_counter + '" value="' + obj.csms_new + '">';
								html_string += '<input type="hidden" id="due_installments_' + new_counter + '" name="due_installments_' + new_counter + '" value="' + obj.due_installments + '">';
								//checked="checked"
								html_string += '<input type="checkbox" checked="checked" name="chkBoxSelect' + new_counter + '"  id="chkBoxSelect' + new_counter + '" onClick="CheckChanged_2(this,' + new_counter + ')" value="chk"/>';
								html_string += '</td>';
								html_string += '<td style="text-align:center"><input name="facility_type_' + new_counter + '" type="hidden" class="" style="width:90%" id="facility_type_' + new_counter + '" value="' + obj.facility_type + '"/>' + obj.facility_type + '</td>';
								html_string += '<td style="text-align:center"><input name="ac_number_' + new_counter + '" type="hidden" class="" style="width:90%" id="ac_number_' + new_counter + '" value="' + obj.ac_number + '"/>' + obj.ac_number + '</td>';
								html_string += '<td style="text-align:center"><input name="ac_name_' + new_counter + '" type="hidden" class="" style="width:90%" id="ac_name_' + new_counter + '" value="' + obj.ac_name + '"/>' + obj.ac_name + '</td>';
								html_string += '<td style="text-align:center"><input name="sch_desc_' + new_counter + '" type="hidden" class="" style="width:90%" id="sch_desc_' + new_counter + '" value="' + obj.sch_desc + '"/>' + obj.sch_desc + '</td>';
								html_string += '<td style="text-align:center"><input name="int_rate_' + new_counter + '" type="text" class="" style="width:90%" id="int_rate_' + new_counter + '" value="' + obj.int_rate + '"/></td>';
								html_string += '<td style="text-align:center"><input name="disbursement_date_' + new_counter + '" type="text" class="" style="width:90%" id="disbursement_date_' + new_counter + '" value="' + obj.disbursement_date_format + '" /></td>';
								html_string += '<td style="text-align:center"><input name="disbursed_amount_' + new_counter + '" type="text" class="" style="width:90%" id="disbursed_amount_' + new_counter + '" value="' + obj.disbursed_amount + '"/></td>';
								html_string += '<td style="text-align:center"><input name="expire_date_' + new_counter + '" type="text" class="" style="width:90%" id="expire_date_' + new_counter + '" value="' + obj.expire_date_format + '" /></td>';
								//html_string += '<td style="text-align:center"><input name="emi_amt_'+new_counter+'" type="text" class="" style="width:90%" id="emi_amt_'+new_counter+'" value="'+obj.emi_amt+'" /></td>';
								//html_string += '<td style="text-align:center"><input name="parrear_'+new_counter+'" type="text" class="" style="width:90%" id="parrear_'+new_counter+'" value="'+obj.parrear+'" /></td>';
								//html_string += '<td style="text-align:center"><input name="ate_'+new_counter+'" type="text" class="" style="width:90%" id="ate_'+new_counter+'" value="'+obj.ate+'" /></td>';
								//html_string += '<td style="text-align:center"><input name="total_cr_'+new_counter+'" type="text" class="" style="width:90%" id="total_cr_'+new_counter+'" value="'+obj.total_cr+'" /></td>';
								html_string += '<td><input name="loan_tenor_' + new_counter + '" type="text" class="" style="width:90%" id="loan_tenor_' + new_counter + '" value="' + obj.loan_tenor + '" /></td>';
								html_string += '<td><input name="payble_' + new_counter + '" type="text" class="" style="width:90%" id="payble_' + new_counter + '" value="' + obj.payble + '"/></td>';
								html_string += '<td><input name="repayment_' + new_counter + '" type="text" class="" style="width:90%" id="repayment_' + new_counter + '" value="' + obj.repayment + '"/></td>';
								html_string += '<td><input name="outstanding_bl_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_' + new_counter + '" value="' + obj.outstanding_bl + '"/></td>';
								html_string += '<td><input name="outstanding_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_dt_' + new_counter + '" value="' + obj.outstanding_bl_dt_format + '"/></td>';
								html_string += '<td><input name="overdue_bl_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_' + new_counter + '" value="' + obj.overdue_bl + '"/></td>';
								html_string += '<td><input name="overdue_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_dt_' + new_counter + '" value="' + obj.overdue_bl_dt_format + '"/></td>';
								html_string += '<td><input name="call_up_dt_' + new_counter + '" type="text" class="" style="width:90%" id="call_up_dt_' + new_counter + '" value="' + obj.call_up_dt_format + '"/></td>';
								html_string += '<td style="text-align:center"><input name="write_off_dt_' + new_counter + '" type="text" class="" style="width:90%" id="write_off_dt_' + new_counter + '" value="' + obj.write_off_dt_format + '" /></td>';
								html_string += '<td style="text-align:center"><input name="write_off_amount_' + new_counter + '" type="text" class="" style="width:90%" id="write_off_amount_' + new_counter + '" value="' + obj.write_off_amount + '"/></td>';
								html_string += '<td style="text-align:center"><input name="recovery_after_Wf_' + new_counter + '" type="text" class="" style="width:90%" id="recovery_after_Wf_' + new_counter + '" value="' + obj.recovery_after_Wf + '"/></td>';
								html_string += '<td style="text-align:center"><div id="cl_bb_' + new_counter + '" name="cl_bb_' + new_counter + '" style="padding-left: 3px;"></div></td>';
								html_string += '<td style="text-align:center"><div id="cl_bbl_' + new_counter + '" name="cl_bbl_' + new_counter + '" style="padding-left: 3px;"></div></td>';
								html_string += '</tr>';
								var counter = new_counter - 1;
								if (new_counter == 1) {
									jQuery('#loan_facility_info_body').html(html_string);
									counter++;
								} else {
									jQuery('#facility_info_' + counter).after(html_string);
									counter++;
								}
								jQuery('#cl_bb_' + new_counter).jqxComboBox({
									theme: theme,
									width: 60,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "CL",
									source: cl,
									height: 25
								});
								jQuery('#cl_bbl_' + new_counter).jqxComboBox({
									theme: theme,
									width: 60,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "CL",
									source: cl,
									height: 25
								});
								jQuery('#cl_bb_' + new_counter + ',#cl_bbl_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#cl_bb_' + new_counter).jqxComboBox('val', obj.cl_bb);
								jQuery('#cl_bbl_' + new_counter).jqxComboBox('val', obj.cl_bbl);
								datePicker('disbursement_date_' + new_counter);
								datePicker('expire_date_' + new_counter);
								datePicker('write_off_dt_' + new_counter);
								datePicker('outstanding_bl_dt_' + new_counter);
								datePicker('overdue_bl_dt_' + new_counter);
								datePicker('call_up_dt_' + new_counter);
								html_string = '';
							});
							jQuery('#facility_info_counter').val(new_counter);
							jQuery("#card_facility_row").hide();
							jQuery("#add_facility_row").hide();
							jQuery("#loan_facility_row").show();
						} else {
							jQuery("#card_row_for_facility").show();
							var html = '';
							jQuery.each(json.facility_info, function(key, obj) {
								html += '<tr>';
								html += '<td style="text-align:center">' + obj.card_type + '</td>';
								html += '<td style="text-align:center">' + obj.card_no + '</td>';
								html += '<td style="text-align:center">' + obj.card_name + '</td>';
								html += '<td style="text-align:center">' + obj.card_issue_dt + '</td>';
								html += '<td style="text-align:center">' + obj.card_exp_dt + '</td>';
								html += '<td style="text-align:center">' + obj.card_limit + '</td>';
								html += '<td style="text-align:center">' + obj.outstanding_bl + '</td>';
								html += '<td style="text-align:center">' + obj.outstanding_bl_dt + '</td>';
								if (obj.card_type == 'Basic') {
									html += '<td style="text-align:center">' + row.cl_bb_card + '</td>';
									html += '<td style="text-align:center">' + row.cl_bbl_card + '</td>';
								} else {
									html += '<td style="text-align:center"></td>';
									html += '<td style="text-align:center"></td>';
								}
								html += '</tr>';
							});
							html += '<tr>';
							html += '<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding :</td>';
							html += '<td style="font-weight: bold;text-align:center">' + row.outstanding_bl + '</td>';
							html += '</tr>';
							jQuery('#card_row_for_facility_body').html(html);
							jQuery("#card_row_for_facility").show();
							jQuery("#loan_facility_row").hide();
						}
					}

					/*jQuery("#cma_doc_div").hide();
					jQuery("#card_row_for_facility").hide();
					jQuery("#loan_facility_row").hide();

					jQuery("#card_row_for_facility_body").html('');
					jQuery("#loan_facility_info_body").html('');

					jQuery("#card_facility_info_counter").val(0);
					jQuery("#facility_info_counter").val(0);
					jQuery("#guarantor_info_counter").val(1);

					jQuery("#guarantor_info_delete_1").val(0);
					jQuery("#guarantor_info_edit_1").val(0);
					jQuery("#same_address_permission_1").val('');
					jQuery("#guarantor_type_1").jqxComboBox('clearSelection');
					jQuery("#guarantor_type_1").val('');
					jQuery("#guarantor_name_1").val('');
					jQuery("#father_name_1").val('');
					jQuery("#present_address_1").val('');
					jQuery("#permanent_address_1").val('');
					jQuery("#business_address_1").val('');
					jQuery("#guar_sts_1").jqxComboBox('clearSelection');
					jQuery("#guar_sts_1").val('');
					jQuery("#occ_sts_1").jqxComboBox('clearSelection');
					jQuery("#occ_sts_1").val('');*/

				}
			}
		});

	}

	function cma_document_div(add_edit, data = null) {
		var cma_document_html = '';
		<?php $cot = 1;
		foreach ($cma_document as $key) : ?>
			cma_document_html += '<tr>';
			cma_document_html += '<td style="font-weight: bold;text-align:left"><?= $key->name ?>';
			<?php if ($key->mandatory == 1) : ?>
				cma_document_html += '<span style="color:red">*</span>';
			<?php endif ?>
			cma_document_html += '</td>';
			cma_document_html += '<td>';
			if (add_edit == 'edit') {
				if (data.length > 0) {
					jQuery.each(data, function(key, obj) {
						if (obj.data_field_name == '<?= $key->data_field_name ?>' && obj.file_name != '') //If have file
						{
							cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_id" name="hidden_<?= $key->data_field_name ?>_id" value="' + obj.id + '" />';
							cma_document_html += '&nbsp; &nbsp; &nbsp; &nbsp;';
							cma_document_html += '<span id="hidden_<?= $key->data_field_name ?>"><img id="file_preview_<?= $key->data_field_name ?>" onclick="popup(\'<?= base_url() ?>cnc_file/document_file/' + obj.file_name + '\')" style=" cursor:pointer;text-align:center" src="<?= base_url() ?>old_assets/images/print-preview.png"></span>';
							cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_value" name="hidden_<?= $key->data_field_name ?>_value" value="' + obj.file_name + '">';
							cma_document_html += '<img id="file_delete_<?= $key->data_field_name ?>" onclick="file_delete(\'<?= $key->data_field_name ?>\')" src="<?= base_url() ?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
							cma_document_html += '<input type="hidden" id="file_delete_value_<?= $key->data_field_name ?>" name="file_delete_value_<?= $key->data_field_name ?>" value="0">';
							cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_check" name="hidden_<?= $key->data_field_name ?>_check" value="' + obj.file_name + '" />';
							cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_mandatory" name="hidden_<?= $key->data_field_name ?>_mandatory" value="<?= $key->mandatory ?>" />';
						}
						if (obj.data_field_name == '<?= $key->data_field_name ?>' && obj.file_name == '') //If There is no file
						{
							cma_document_html += '<span id="hidden_<?= $key->data_field_name ?>"></span>';
							cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_id" name="hidden_<?= $key->data_field_name ?>_id" value="' + obj.id + '" />';
							cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_check" name="hidden_<?= $key->data_field_name ?>_check" value="" />';
							cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_mandatory" name="hidden_<?= $key->data_field_name ?>_mandatory" value="<?= $key->mandatory ?>" />';
						}
					});
				} else {
					cma_document_html += '<span id="hidden_<?= $key->data_field_name ?>"></span>';
					cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_id" name="hidden_<?= $key->data_field_name ?>_id" value="" />';
					cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_check" name="hidden_<?= $key->data_field_name ?>_check" value="" />';
					cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_mandatory" name="hidden_<?= $key->data_field_name ?>_mandatory" value="<?= $key->mandatory ?>" />';
				}
			} else {
				cma_document_html += '<span id="hidden_<?= $key->data_field_name ?>"></span>';
				cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_id" name="hidden_<?= $key->data_field_name ?>_id" value="" />';
				cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_check" name="hidden_<?= $key->data_field_name ?>_check" value="" />';
				cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_mandatory" name="hidden_<?= $key->data_field_name ?>_mandatory" value="<?= $key->mandatory ?>" />';
			}
			cma_document_html += '<img style="cursor:pointer" src="<?= base_url() ?>images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'<?= $key->data_field_name ?>\')"/>';
			cma_document_html += '<input type="hidden" id="hidden_<?= $key->data_field_name ?>_select" name="hidden_<?= $key->data_field_name ?>_select" value="0">';
			cma_document_html += '<input type="hidden" id="data_field_name_<?= $cot; ?>" value="<?= $key->data_field_name ?>" name="data_field_name_<?= $cot; ?>">';
			cma_document_html += '<input type="hidden" id="data_field_full_name_<?= $cot; ?>" value="<?= $key->name ?>" name="data_field_full_name_<?= $cot; ?>">';
			cma_document_html += '</td>';
			cma_document_html += '</tr>';
		<?php $cot++;
		endforeach ?>
		cma_document_html += '<input type="hidden" id="cma_document_counter" value="<?= $cot - 1 ?>" name="cma_document_counter">';
		jQuery("#cma_doc_body").html(cma_document_html);
	}


	function details(id, operation, indx, district = null, zone = null) {

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
				district: district,
				zone: zone
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

	function search_pending() {
		var loan_ac = jQuery('#s_account').val();
		var s_proposed_type = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
		var s_s_cif_number = jQuery('#s_cif_number').val();

		if (s_s_cif_number == '' && loan_ac == '') {
			alert('Please fill search field!!!');
		} else {
			jQuery("#grid_loading").show();
			//jQuery("#load").hide();
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			var postdata = jQuery('#form').serialize();
			jQuery.ajax({
				type: "POST",
				cache: false,
				async: false,
				url: "<?= base_url() ?>cma_process/search_pending_data/",
				data: postdata,
				datatype: "html",
				success: function(response) {
					jQuery("#grid_loading").hide();
					var data = response.split("####");
					jQuery('.txt_csrfname').val(data[0]);

					jQuery("#searchTable").show();
					jQuery('#searchTable').html(data[1]);

					jQuery("#preview_next").show();

				}
			});
		}

	}
	// Only One Checkbox Select At a time
	function onlyOne(checkbox) {
		//var id = document.getElementsByName('suit_id').value;
		//console.log(checkbox.value)
		var checkboxes = document.getElementsByName('check_id')
		checkboxes.forEach((item) => {
			//console.log(item)
			if (item !== checkbox) item.checked = false
		})
	}

	function load_case(id = null) {
		var val;
		var required = false;
		if (id != null) {
			required = true;
			val = id;
		} else {
			var checkboxes = document.getElementsByName('check_id');

			checkboxes.forEach((item) => {
				if (item.checked == true) {
					val = item.value;
					required = true;
					//console.log(item.value) 
				}

			});
		}
		if (required == false) {
			alert('Please Select a Case Number!');
			return false;
		}
		//clear_form_cdo();
		var csrfName = jQuery('.txt_csrfname').attr('name');
		var csrfHash = jQuery('.txt_csrfname').val();
		jQuery.ajax({
			type: "POST",
			cache: false,
			async:false,
			url: "<?= base_url() ?>cma_process/load_pending_data",
			data: {
				[csrfName]: csrfHash,
				id: val
			},
			datatype: "json",
			//async:false,
			success: function(response) {
				//console.log(response);
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				var rows = json.row_info;
				//console.log(rows);
				if (rows != null) {
					jQuery('#search_area').hide();
					jQuery('#filing_area').show();
					jQuery('#proposed_type').jqxComboBox('val', rows.ac_type);
					if (rows.ac_type == 'Card') {
						jQuery('#hidden_loan_ac').val(rows.org_loan_ac);
					}
					jQuery('#loan_ac').val(rows.investment_ac);
					jQuery('#cif').val(rows.cif_no);
					jQuery("#proposed_type").jqxComboBox({
						disabled: true
					});
					//document.getElementById("loan_ac").readonly = true;
					jQuery('#pending_id').val(rows.id);
					call_api();
				} else {
					window.location.replace("<?php echo base_url('cma_process/view/' . $menu_group . '/' . $menu_cat . '/' . $menu_link . '/running'); ?>");
				}



			}
		});
	}

	function add_more_facility() {
		var new_counter = jQuery('#facility_info_counter').val();
		if (new_counter == 0) {
			jQuery('#loan_facility_info_body').html('');
		}
		new_counter++;
		var html_string = '';

		html_string += '<tr id="facility_info_' + new_counter + '">';
		html_string += '<td>';

		html_string += '<input type="hidden" id="base_facility_' + new_counter + '" name="base_facility_' + new_counter + '" value="0">';

		html_string += '<input type="hidden" id="facility_info_edit_' + new_counter + '" name="facility_info_edit_' + new_counter + '" value="0">';
		html_string += '<input type="hidden" id="facility_info_delete_' + new_counter + '" name="facility_info_delete_' + new_counter + '" value="1">';
		html_string += '<input type="hidden" id="csms_new_' + new_counter + '" name="csms_new_' + new_counter + '" value="0">';
		html_string += '<input type="hidden" id="due_installments_' + new_counter + '" name="due_installments_' + new_counter + '" value="">';
		//checked="checked"
		html_string += '<input type="checkbox" name="chkBoxSelect' + new_counter + '"  id="chkBoxSelect' + new_counter + '" onClick="CheckChanged_2(this,' + new_counter + ')" value="chk"/>';
		html_string += '</td>';
		html_string += '<td style="text-align:center"><input name="facility_type_' + new_counter + '" type="text" class="" style="width:90%" id="facility_type_' + new_counter + '" value=""/></td>';
		html_string += '<td style="text-align:center"><input name="ac_number_' + new_counter + '" type="text" class="" style="width:90%" id="ac_number_' + new_counter + '" value=""/></td>';
		html_string += '<td style="text-align:center"><input name="ac_name_' + new_counter + '" type="text" class="" style="width:90%" id="ac_name_' + new_counter + '" value=""/></td>';
		html_string += '<td style="text-align:center"><input name="sch_desc_' + new_counter + '" type="text" class="" style="width:90%" id="sch_desc_' + new_counter + '" value=""/></td>';
		html_string += '<td style="text-align:center"><input name="int_rate_' + new_counter + '" type="text" class="" style="width:90%" id="int_rate_' + new_counter + '" value=""/></td>';
		html_string += '<td style="text-align:center"><input name="disbursement_date_' + new_counter + '" type="text" class="" style="width:90%" id="disbursement_date_' + new_counter + '" value="" /></td>';
		html_string += '<td style="text-align:center"><input name="disbursed_amount_' + new_counter + '" type="text" class="" style="width:90%" id="disbursed_amount_' + new_counter + '" value=""/></td>';
		html_string += '<td style="text-align:center"><input name="expire_date_' + new_counter + '" type="text" class="" style="width:90%" id="expire_date_' + new_counter + '" value="" /></td>';
		html_string += '<td><input name="loan_tenor_' + new_counter + '" type="text" class="" style="width:90%" id="loan_tenor_' + new_counter + '" value="" /></td>';
		html_string += '<td><input name="payble_' + new_counter + '" type="text" class="" style="width:90%" id="payble_' + new_counter + '" /></td>';
		html_string += '<td><input name="repayment_' + new_counter + '" type="text" class="" style="width:90%" id="repayment_' + new_counter + '" /></td>';
		html_string += '<td><input name="outstanding_bl_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_' + new_counter + '" value=""/></td>';
		html_string += '<td><input name="outstanding_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_dt_' + new_counter + '" value=""/></td>';
		html_string += '<td><input name="overdue_bl_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_' + new_counter + '" value=""/></td>';
		html_string += '<td><input name="overdue_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_dt_' + new_counter + '" /></td>';
		html_string += '<td><input name="call_up_dt_' + new_counter + '" type="text" class="" style="width:90%" id="call_up_dt_' + new_counter + '" /></td>';
		html_string += '<td style="text-align:center"><input name="write_off_dt_' + new_counter + '" type="text" class="" style="width:90%" id="write_off_dt_' + new_counter + '" value="" /></td>';
		html_string += '<td style="text-align:center"><input name="write_off_amount_' + new_counter + '" type="text" class="" style="width:90%" id="write_off_amount_' + new_counter + '" value=""/></td>';
		html_string += '<td style="text-align:center"><input name="recovery_after_Wf_' + new_counter + '" type="text" class="" style="width:90%" id="recovery_after_Wf_' + new_counter + '" value=""/></td>';
		html_string += '<td style="text-align:center"><div id="cl_bb_' + new_counter + '" name="cl_bb_' + new_counter + '" style="padding-left: 3px;"></div></td>';
		html_string += '<td style="text-align:center"><div id="cl_bbl_' + new_counter + '" name="cl_bbl_' + new_counter + '" style="padding-left: 3px;"></div></td>';
		html_string += '</tr>';

		if (new_counter == 1) {
			jQuery('#loan_facility_info_body').html(html_string);
		} else {
			var counter = new_counter - 1;
			jQuery('#facility_info_' + counter).after(html_string);
		}


		//jQuery('#facility_type_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, promptText: "Facility", source: facility_name, height: 25});
		//jQuery('#facility_type_'+new_counter).jqxComboBox('val',facility_type);
		// jQuery('#facility_type_'+new_counter).jqxComboBox({ disabled: true });

		jQuery('#cl_bb_' + new_counter).jqxComboBox({
			theme: theme,
			width: 60,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "CL",
			source: cl,
			height: 25
		});
		jQuery('#cl_bbl_' + new_counter).jqxComboBox({
			theme: theme,
			width: 60,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "CL",
			source: cl,
			height: 25
		});
		jQuery('#cl_bb_' + new_counter + ',#cl_bbl_' + new_counter).focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});
		datePicker('disbursement_date_' + new_counter);
		datePicker('expire_date_' + new_counter);
		datePicker('write_off_dt_' + new_counter);
		datePicker('outstanding_bl_dt_' + new_counter);
		datePicker('overdue_bl_dt_' + new_counter);
		datePicker('call_up_dt_' + new_counter);


		jQuery('#facility_info_counter').val(new_counter);
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
								<li style="margin-left: 30px;">Form</li>
								<li>Data Grid</li>
							</ul>
							<!---==== First Tab Start ==========----->
							<div style="overflow: hidden;">
								<div style="padding: 10px;" id="case_form" class="">
									<div id="back_area" style="display: none;text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
										<input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #EE2F44;margin-top:10px" />
									</div>

									<div id="form1" style="_display:none;">
										<div id="search_area" style="display:none">
											<form method="POST" name="form" id="form" style="margin:0px;">
												<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
												<input type="hidden" id="s_hidden_loan_ac" value="" name="s_hidden_loan_ac">
												<div style="padding: 0px;width:100%;height:50px; font-family: Calibri;font-size: 14px">
													<table id="deal_body" style="display:block;_width:70%">
														<tr>
															<td><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
															<td>
																<div id="s_proposed_type" name="s_proposed_type"></div>
															</td>
															<td style="width: 150px;text-align: right;"><strong><span id="s_l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
															<td><input name="s_account" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="s_account" value="" onKeyUp="javascript:return s_mask(this.value,this);" />
															</td>
															<td><strong>CID No.&nbsp;&nbsp;</strong> </td>
															<td><input name="s_cif_number" type="text" class="" style="width:150px" id="s_cif_number" /></td>
															<td><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_pending()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
															</td>
														</tr>
													</table>
												</div>
												<div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>
												<div id="searchTable"></div>
												<div id="preview_next" class="wrapper" style="display:none;padding-bottom:30px;">
													</br>
													<input type="button" class="buttondelete" id="load" value="Next" onclick="load_case()">
												</div>
											</form>
										</div>
										<div id="filing_area">
											<form class="form" name="cma_form" id="cma_form" method="post" action="" enctype="multipart/form-data">
												<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
												<input type="hidden" id="add_edit" value="add" name="add_edit">
												<input type="hidden" id="edit_row" value="" name="edit_row">
												<input type="hidden" id="pending_id" value="" name="pending_id">
												<input type="hidden" id="operation" value="" name="operation">
												<input name="life_cycle" type="hidden" id="life_cycle" value="" class="text-input" />
												<input name="more_acc_available" type="hidden" id="more_acc_available" value="" class="text-input" />
												<input type="hidden" id="pre_cma_id" value="" name="pre_cma_id">
												<input name="sl_no_edit" type="hidden" id="sl_no_edit" value="" class="text-input" />
												<input type="hidden" id="card_iss_date" value="" name="card_iss_date">
												<input type="hidden" id="card_exp_date" value="" name="card_exp_date">
												<input type="hidden" id="outstanding_bl_dt" value="" name="outstanding_bl_dt">
												<input type="hidden" id="card_limit" value="" name="card_limit">
												<input type="hidden" id="outstanding_bl" value="" name="outstanding_bl">
												<input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
												<input type="hidden" id="hidden_dis_date" value="" name="hidden_dis_date">
												<input type="hidden" id="hidden_customer_id" value="" name="hidden_customer_id">
												<input type="hidden" id="pre_req_type" value="" name="pre_req_type">
												<input type="hidden" id="pre_block_sts" value="" name="pre_block_sts">
												<table style="width: 100%;" id="tab1Table">
													<tbody>
														<tr>
															<td width="50%">
																<table style="width: 100%;">
																	<tr>
																		<td width="40%" style="font-weight: bold;">Requisition Type<span style="color:red">*</span></td>
																		<td width="60%">
																			<div id="req_type" name="req_type" style="padding-left: 3px" tabindex="1"></div>
																		</td>

																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Proposed Type<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="proposed_type" name="proposed_type" style="padding-left: 3px" tabindex="2"></div>
																		</td>

																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;"><span id="l_or_c_no"></span> No.<span style="color:red">*</span> </td>
																		<td width="60%">
																			<input name="loan_ac" tabindex="3" type="text" class="" size="16" style="width:195px" id="loan_ac" value="<?= isset($result->loan_ac) ? $result->loan_ac : '' ?>" onKeyUp="javascript:return mask(this.value,this);" />
																			<input type="button" value="Load" id="load_button" class="" disabled style="width:50px !important;height:25px" onclick="validate_api_call()" />
																		</td>
																	</tr>
																	<tr id="customer_id_row" style="display: none;">
																		<td width="40%" style="font-weight: bold;">Customer ID</td>
																		<td width="60%"><strong><span id="show_customer_id"></span></strong></td>

																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">CID</td>
																		<td width="60%"><input name="cif" type="text" maxlength="8" size="8" tabindex="4" class="" style="width:250px" id="cif" value="" /></td>

																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;"><span id="l_or_c_name"></span><span style="color:red">*</span> </td>
																		<td width="60%"><input name="ac_name" tabindex="6" type="text" class="" style="width:250px" id="ac_name" value="" /></td>
																	</tr>
																	<tr id="borrower_name_div">
																		<td width="40%" style="font-weight: bold;">Borrower's Name<span style="color:red">*</span></td>
																		<td width="60%"><input name="brrower_name" tabindex="7" onblur="capitialize('brrower_name')" type="text" class="" style="width:250px" id="brrower_name" value="" /></td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Business Type</td>
																		<td width="60%">
																			<div id="sub_type" name="sub_type" style="padding-left: 3px" tabindex="8"></div>
																			<div style="background-color:#eaeaea;padding:10px;width:233px;display:none" id="spfm">
																				Spouse Name<br /><input name="spouse_name" onblur="capitialize('spouse_name')" tabindex="9" type="text" class="" style="width:225px" id="spouse_name" value="" /><br />
																				Mother Name<br /><input name="mother_name" onblur="capitialize('mother_name')" tabindex="10" type="text" class="" style="width:225px" id="mother_name" value="" />
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Investment Segment (Portfolio)<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="loan_segment" name="loan_segment" style="padding-left: 3px" tabindex="11"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Current/updated Address</td>
																		<td width="60%"><textarea name="current_address" tabindex="12" class="text-input-big" id="current_address" style="height:40px !important;width:250px" onblur="capitialize('current_address')"></textarea></td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Previous CMA Approval Date</td>
																		<td width="60%">
																			<label id="pre_cma_app_dt_l">

																			</label>
																			<input type="hidden" tabindex="14" name="pre_cma_app_dt" placeholder="dd/mm/yyyy" style="width:225px;margin-left:4px" id="pre_cma_app_dt" value="">
																			<script type="text/javascript" charset="utf-8">
																				datePicker("pre_cma_app_dt");
																			</script>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Previous CMA Approval Type</td>
																		<td width="60%">
																			<label id="pre_cma_app">

																			</label>
																			<input name="pre_cma_app_type" tabindex="13" type="hidden" class="" style="width:250px" id="pre_cma_app_type" value="" />
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Previous Case Type</td>
																		<td width="60%">
																			<div id="pre_case_type" tabindex="16" name="pre_case_type" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Previous Case Status</td>
																		<td width="60%">
																			<div id="pre_case_sts" tabindex="15" name="pre_case_sts" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Disposal Status</td>
																		<td width="60%">
																			<div id="disposal_sts" tabindex="17" name="disposal_sts" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Customer Contact Number</td>
																		<td width="60%"><input name="mobile_no" tabindex="18" maxlength="11" size="11" type="text" class="" style="width:250px" id="mobile_no" value="" /></td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Cheque Expiry Date</td>
																		<td><input type="text" name="chq_expiry_date" tabindex="19" placeholder="dd/mm/yyyy" style="width:250px;" id="chq_expiry_date" value="">
																			<script type="text/javascript" charset="utf-8">
																				datePicker("chq_expiry_date");
																			</script>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Last Payment Date</td>
																		<td><input type="text" name="last_payment_date" tabindex="20" placeholder="dd/mm/yyyy" style="width:250px;" id="last_payment_date" value="">
																			<script type="text/javascript" charset="utf-8">
																				datePicker("last_payment_date");
																			</script>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Last Payment Amount</td>
																		<td width="60%"><input name="last_payment_amount" tabindex="21" type="text" class="" style="width:250px" id="last_payment_amount" value="" /></td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Disposal remarks</td>
																		<td width="60%"><textarea name="disposal_remarks" tabindex="22" class="text-input-big" id="disposal_remarks" style="height:40px !important;width:250px"></textarea></td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Judgment Summary</td>
																		<td width="60%"><textarea name="judgement_summery" tabindex="23" class="text-input-big" id="judgement_summery" style="height:40px !important;width:250px"></textarea></td>
																	</tr>
																</table>
															</td>

															<td width="50%" style="display:contents;">
																<table style="width: 100%;">
																	<tr>
																		<td width="40%" style="font-weight: bold;">Call-Back Serving Date</td>
																		<td><input type="text" name="call_up_serv_dt" tabindex="24" placeholder="dd/mm/yyyy" style="width:250px;" id="call_up_serv_dt" value="">
																			<script type="text/javascript" charset="utf-8">
																				datePicker("call_up_serv_dt");
																			</script>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Investment Sanction Date</td>
																		<td><input type="text" name="loan_sanction_dt" tabindex="25" placeholder="dd/mm/yyyy" style="width:250px;" id="loan_sanction_dt" value="">
																			<script type="text/javascript" charset="utf-8">
																				datePicker("loan_sanction_dt");
																			</script>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Previous Case Filing Date</td>
																		<td><input type="text" name="pre_case_fill_dt" tabindex="26" placeholder="dd/mm/yyyy" style="width:250px;" id="pre_case_fill_dt" value="">
																			<script type="text/javascript" charset="utf-8">
																				datePicker("pre_case_fill_dt");
																			</script>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Call-Back File</td>
																		<td>
																			<span id="call_up_file">
																				<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList('cma','call_up_file')" />
																				<input type="hidden" id="hidden_call_up_file_select" name="hidden_call_up_file_select" value="0">

																				<span id="hidden_call_up_file"></span>
																			</span>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Zone<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="zone" tabindex="27" name="zone" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">District<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="district" tabindex="29" name="district" style="padding-left: 3px"></div>
																		</td>
																	</tr>

																	<tr>
																		<td width="40%" style="font-weight: bold;">Branch (Code)<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="branch_sol" name="branch_sol" style="padding-left: 3px" tabindex="5"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Security Status<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="sec_sts" tabindex="33" name="sec_sts" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<tr id="auction_div">
																		<td width="40%" style="font-weight: bold;">Previous Auction Status</td>
																		<td width="60%">
																			<div id="pre_auc_sts" tabindex="34" name="pre_auc_sts" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Business Status<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="busi_sts" tabindex="35" name="busi_sts" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Borrower Status<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="borr_sts" tabindex="36" name="borr_sts" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<!-- <tr>
																	<td width="40%" style="font-weight: bold;">Interest Rate  (As per Sanction)<span style="color:red">*</span> </td>
																	<td width="60%" ><input name="int_rate" tabindex="37" type="text" class="" style="width:250px" id="int_rate" value="<?= isset($result->int_rate) ? $result->int_rate : '' ?>"/></td>
																</tr>	 -->
																	<tr>
																		<td width="40%" style="font-weight: bold;">Sanction Letter<span style="color:green">*</span></td>
																		<td width="60%">
																			<span id="remarks_file">
																				<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList('cma','senction_letter')" />
																				<input type="hidden" id="hidden_senction_letter_select" name="hidden_senction_letter_select" value="0">
																				<span id="hidden_senction_letter"></span>
																			</span>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Current DPD<span style="color:red">*</span> </td>
																		<td width="60%"><input name="current_dpd" tabindex="38" type="text" class="" style="width:250px" id="current_dpd" value="" /></td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Logic for ARA Case<span style="color:red">*</span> </td>
																		<td width="60%">
																			<div id="case_logic" tabindex="39" name="case_logic" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<!-- <tr>
																	<td width="40%" style="font-weight: bold;">Recovery AM<span style="color:red">*</span> </td>
																	<td width="60%" ><div id="recovery_am" tabindex="37" name="recovery_am" style="padding-left: 3px"></div></td>
																</tr> -->
																	<tr>
																		<td width="40%" style="font-weight: bold;">More Account Available</td>
																		<td width="60%"><input name="more_acc_number" tabindex="41" style="width:250px" type="text" class="" id="more_acc_number" value="<?= isset($result->more_acc_number) ? $result->more_acc_number : '' ?>" /><br /><span style="color:green;" class="login-text">(Comma Separated)</span></td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Cheque Status</td>
																		<td width="60%">
																			<div id="chq_sts" tabindex="42" name="chq_sts" style="padding-left: 3px"></div>
																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Remarks <span style="color:green">(Required For Re-Initiate)</span></td>
																		<td width="60%">
																			<textarea name="remarks" class="text-input-big" tabindex="43" id="remarks" style="height:40px !important;width:250px"><?= isset($result->remarks) ? $result->remarks : '' ?></textarea>

																		</td>
																	</tr>
																	<tr>
																		<td width="40%" style="font-weight: bold;">Remarks File</td>
																		<td width="60%">
																			<span id='senction_letter'>
																				<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList('cma','remarks_file')" />
																				<input type="hidden" id="hidden_remarks_file_select" name="hidden_remarks_file_select" value="0">
																				<span id="hidden_remarks_file"></span>
																			</span>

																		</td>
																	</tr>
																</table>
															</td>

														</tr>
														<tr style="display:none" id="cma_doc_div">
															<td colspan="2">
																<div style="background-color:#eaeaea;padding:10px;margin:0 0px;">
																	<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Required Document for Secured CMA</span>
																	<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px">
																		<thead>
																			<tr>
																				<td style="font-weight: bold;text-align:left">Document Name</td>
																				<td style="font-weight: bold;text-align:left">File</td>
																			</tr>
																		</thead>
																		<tbody id="cma_doc_body">
																			<?php $cot = 1;
																			foreach ($cma_document as $key) : ?>
																				<tr>
																					<td style="font-weight: bold;text-align:left"><?= $key->name ?><?php if ($key->mandatory == 1) {
																																						echo '<span style="color:red">*</span>';
																																					} ?></td>
																					<td>

																						<span id="hidden_<?= $key->data_field_name ?>"></span>
																						<input type="hidden" id="hidden_<?= $key->data_field_name ?>_id" name="hidden_<?= $key->data_field_name ?>_id" value="" />
																						<input type="hidden" id="hidden_<?= $key->data_field_name ?>_check" name="hidden_<?= $key->data_field_name ?>_check" value="" />
																						<input type="hidden" id="hidden_<?= $key->data_field_name ?>_mandatory" name="hidden_<?= $key->data_field_name ?>_mandatory" value="<?= $key->mandatory ?>" />

																						<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList('cma','<?= $key->data_field_name ?>')" />
																						<input type="hidden" id="hidden_<?= $key->data_field_name ?>_select" name="hidden_<?= $key->data_field_name ?>_select" value="0">
																						<input type="hidden" id="data_field_name_<?= $cot; ?>" value="<?= $key->data_field_name ?>" name="data_field_name_<?= $cot; ?>">
																						<input type="hidden" id="data_field_full_name_<?= $cot; ?>" value="<?= $key->name ?>" name="data_field_full_name_<?= $cot; ?>">
																					</td>
																				</tr>
																			<?php $cot++;
																			endforeach ?>
																			<input type="hidden" id="cma_document_counter" value="<?= $cot - 1 ?>" name="cma_document_counter">
																		</tbody>
																	</table>
																</div>
															</td>
														</tr>

														<tr>
															<td colspan="2">
																<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;width:99%;padding-top:20px;overflow: scroll;">
																	<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag"></span>
																	<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px">
																		<thead>
																			<input type="hidden" name="guarantor_info_counter" id="guarantor_info_counter" value="1">
																			<tr>
																				<td width="2%" style="font-weight: bold;text-align:center">D</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Type<span style="color:red">*</span></td>
																				<td width="13%" style="font-weight: bold;text-align:center">Name<span style="color:red">*</span></td>
																				<td width="12%" style="font-weight: bold;text-align:center">Father's Name<span style="color:red">*</span></td>
																				<td width="15%" style="font-weight: bold;text-align:center">Present Address<span style="color:red">*</span></td>
																				<td width="15%" style="font-weight: bold;text-align:center">Permanent Address<!-- <span style="color:red">*</span> --></td>
																				<td width="15%" style="font-weight: bold;text-align:center">Business Address</td>
																				<td width="10%" style="font-weight: bold;text-align:center">Status<span style="color:red">*</span></td>
																				<td width="13%" style="font-weight: bold;text-align:center">Occupation<span style="color:red">*</span></td>
																			</tr>
																		</thead>
																		<tbody id="guarantor_info_body">
																			<tr id="guarantor_info_1">
																				<td></td>
																				<td>
																					<input type="hidden" id="guarantor_info_delete_1" name="guarantor_info_delete_1" value="0">
																					<input type="hidden" id="guarantor_info_edit_1" name="guarantor_info_edit_1" value="0">
																					<input type="hidden" id="same_address_permission_1" name="same_address_permission_1" value="">
																					<div id="guarantor_type_1" name="guarantor_type_1" style="padding-left: 3px;margin-left:5px"></div>
																				</td>
																				<td><input name="guarantor_name_1" onblur="capitialize('guarantor_name_1')" type="text" class="" style="width:90%" id="guarantor_name_1" /></td>
																				<td><input name="father_name_1" onblur="capitialize('father_name_1')" type="text" class="" style="width:90%" id="father_name_1" /></td>
																				<td><textarea name="present_address_1" onblur="capitialize('present_address_1')" class="text-input-big" id="present_address_1" style="height:40px !important;width:90%"></textarea></td>
																				<td><textarea name="permanent_address_1" onblur="capitialize('permanent_address_1')" class="text-input-big" id="permanent_address_1" style="height:40px !important;width:90%"></textarea></td>
																				<td><textarea name="business_address_1" onblur="capitialize('business_address_1')" class="text-input-big" id="business_address_1" style="height:40px !important;width:90%"></textarea></td>
																				<td>
																					<div id="guar_sts_1" name="guar_sts_1" style="padding-left: 3px;margin-left:5px"></div>
																				</td>
																				<td>
																					<div id="occ_sts_1" name="occ_sts_1" style="padding-left: 3px;margin-left:5px"></div>
																				</td>
																			</tr>
																		</tbody>
																		<tfoot>
																			<tr id="add_guarantor_row">
																				<td colspan="9" style="text-align: right">
																					Add More <input tabindex="" type="button" title="Add More" onClick="add_more_owner()" class="addmore"><br>
																				</td>
																			</tr>
																		</tfoot>
																	</table>
																</div>
															</td>

														</tr>
														<tr id="loan_facility_row" style="display:none">
															<td colspan="2">
																<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;width:1040px;padding-top:20px;overflow: scroll;">
																	<!-- <div style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;"> -->
																	<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
																	<table border="1" id="gurantor_table" style="border-color:#c0c0c0;margin:20px">
																		<thead>
																			<tr>
																				<td width="2%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" style="display:none" /></td>
																				<td width="2%" style="font-weight: bold;text-align:center">Faci lity Type</td>
																				<td width="5%" style="font-weight: bold;text-align:center">A/C Number</td>
																				<td width="5%" style="font-weight: bold;text-align:center">A/C Name</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Sch Desc.</td>
																				<td width="3%" style="font-weight: bold;text-align:center">Profit Rate<span style="color:red">*</span></td>
																				<td width="5%" style="font-weight: bold;text-align:center">Disbur sement Date<span style="color:red">*</span></td>
																				<td width="5%" style="font-weight: bold;text-align:center">Disbur sed Amount<span style="color:red">*</span></td>
																				<td width="5%" style="font-weight: bold;text-align:center">Expire Date<span style="color:red">*</span></td>
																				<td width="5%" style="font-weight: bold;text-align:center">Tenor<span style="color:red">*</span></td>
																				<td width="5%" style="font-weight: bold;text-align:center">Payable</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Repa yment</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Outst anding Balance<span style="color:red">*</span></td>
																				<td width="5%" style="font-weight: bold;text-align:center">Outst anding Balance Date<span style="color:red">*</span></td>
																				<td width="5%" style="font-weight: bold;text-align:center">Overdue Balance</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Overdue BL Date</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Call-Back Date</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Written -off Date</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Written -off Amt(A)</td>
																				<td width="5%" style="font-weight: bold;text-align:center">Recovery After Written-off(B)</td>
																				<td width="5%" style="font-weight: bold;text-align:center">CL(BB)<span style="color:red">*</span></td>
																				<td width="5%" style="font-weight: bold;text-align:center">CL(AIBL)<span style="color:red">*</span></td>

																			</tr>
																		</thead>
																		<tbody id="loan_facility_info_body" style="overflow:auto; height:auto;">

																		</tbody>
																		<input type="hidden" name="facility_info_counter" id="facility_info_counter" value="0">
																		<tfoot>
																			<tr id="add_facility_row">
																				<td colspan="22" style="text-align: right">
																					Add More <input tabindex="" type="button" title="Add More" onClick="add_more_facility()" class="addmore"><br>
																				</td>
																			</tr>
																		</tfoot>
																	</table>
																</div>
															</td>

														</tr>
														<tr id="card_row_for_facility" style="display:none">
															<td colspan="2">
																<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;width:1040px;overflow: scroll;">
																	<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
																	<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px">
																		<thead>
																			<tr>
																				<td width="10%" style="font-weight: bold;text-align:center">Card Type</td>
																				<td width="15%" style="font-weight: bold;text-align:center">Card No</td>
																				<td width="15%" style="font-weight: bold;text-align:center">Card Holder Name</td>
																				<td width="12%" style="font-weight: bold;text-align:center">Card Issue Date</td>
																				<td width="12%" style="font-weight: bold;text-align:center">Card Exp Date</td>
																				<td width="12%" style="font-weight: bold;text-align:center">Card Limit</td>
																				<td width="12%" style="font-weight: bold;text-align:center">Outstanding Balance</td>
																				<td width="12%" style="font-weight: bold;text-align:center">Outstanding BL DT</td>
																				<td width="12%" style="font-weight: bold;text-align:center">CL BB<span style="color:red">*</span></td>
																				<td width="12%" style="font-weight: bold;text-align:center">CL BBL<span style="color:red">*</span></td>
																			</tr>
																		</thead>
																		<tbody id="card_row_for_facility_body">

																		</tbody>
																		<input type="hidden" name="card_facility_info_counter" id="card_facility_info_counter" value="0">
																		<!-- <tfoot>
										                    				<tr id="add_facility_row">
										                    					<td colspan="10" style="text-align: right">
										                    						Add More <input tabindex="" type="button" title="Add More" onClick="card_facility_counter()" class="addmore"><br>
										                    					</td>
										                    				</tr>
										                    			</tfoot> -->
																	</table>
																</div>
															</td>

														</tr>
														<tr>
															<td colspan="2" style="text-align: center;">
																<br />
																<input type="button" value="Initiate Request" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="in_req_button" /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
																<br /><br /><br />
															</td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!---==== Second Tab Start ==========----->
							<div style="overflow: hidden;_overflow-y: scroll;">
								<div style="display:block; min-height:340px; height:auto">
									<form method="POST" name="form" id="form" style="margin:0px;">
										<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
										<input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
										<div style="padding: 0.5%;width:98%;height:60px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
											<table id="deal_body" style="display:block;width:100%">
												<tr>
													<td style="text-align:right;width:5%"><strong>Zone&nbsp;&nbsp;</strong> </td>
													<td style="width:15%">
														<div style="padding-left:1.8%" id="g_zone" name="g_zone"></div>
													</td>
													<td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
													<td style="width:15%">
														<div style="padding-left:1.8%" id="g_district" name="g_district"></div>
													</td>
													<td style="text-align:right;width:5%"><strong>Rec Date&nbsp;&nbsp;</strong> </td>
													<td style="width:15%"><input id="g_rec_dt_from" name="g_rec_dt_from" style="width:40%" />
														<script type="text/javascript">
															datePicker("g_rec_dt_from");
														</script>
														<strong>To</strong> <input id="g_rec_dt_to" name="g_rec_dt_to" style="width:40%" />
														<script type="text/javascript">
															datePicker("g_rec_dt_to");
														</script>
													</td>
													<td style="text-align:right;width:5%"><strong>Status&nbsp;&nbsp;</strong> </td>
													<td style="width:15%">
														<div style="padding-left:1.8%" id="g_status" name="g_status"></div>
													</td>
													<td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px;height:25px" />
													</td>
												</tr>
												<tr>
													<td style="text-align:right;width:5%"><strong>InI. Date&nbsp;&nbsp;</strong> </td>
													<td style="width:15%"><input id="g_e_dt_from" name="g_e_dt_from" style="width:40%" />
														<script type="text/javascript">
															datePicker("g_e_dt_from");
														</script>
														<strong>To</strong> <input id="g_e_dt_to" name="g_e_dt_to" style="width:40%" />
														<script type="text/javascript">
															datePicker("g_e_dt_to");
														</script>
													</td>
													<td style="text-align:right;width:5%"><strong>APP. Date&nbsp;&nbsp;</strong> </td>
													<td style="width:15%"><input id="g_v_dt_from" name="g_v_dt_from" style="width:40%" />
														<script type="text/javascript">
															datePicker("g_v_dt_from");
														</script>
														<strong>To</strong> <input id="g_v_dt_to" name="g_v_dt_to" style="width:40%" />
														<script type="text/javascript">
															datePicker("g_v_dt_to");
														</script>
													</td>
													<td style="text-align:right;width:5%"><strong>Protfolio&nbsp;&nbsp;</strong> </td>
													<td style="width:15%">
														<div style="padding-left:1.8%" id="g_loan_segment" name="g_loan_segment"></div>
													</td>
													<td style="text-align:right;width:5%"><strong>CL AIBL&nbsp;&nbsp;</strong> </td>
													<td style="width:15%">
														<div style="padding-left:1.8%;float:left" id="g_cl_bbl" name="g_cl_bbl"></div>
														<div style="padding-left:1.8%;float:left" id="g_outst_range" name="g_outst_range"></div>
													</td>
												</tr>
											</table>
										</div>
										<div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>
										<div id="jqxgrid" style="margin-top:5px;width:100%;min-height:320px;height:auto;"></div>


										<div style="float:left;padding-top: 5px;">
											<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

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
<div id="details" style="display: none;">
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
<div id="r_history" style="display: none;">
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
<div id="sendToCheckerMessageDialogContent" style="display:none;">
	<form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform" style="margin-top:0px;">
		<input type="hidden" name="index" id="index" value="">
		<input type="hidden" name="permission" id="permission" value="">
		<div class="hd">
			<h2 class="conf" style="margin-top:0px;color:#330707">(Without remove duplicate address cannot initiate CMA (Remove Permanent Address)/ ডুপ্লিকেট ঠিকানা অপসারণ না করলে CMA শুরু করা যাবে না (Remove Permanent Address).</h2>
		</div>
		<a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="give_permission()"><span id="button_tag"></span></a>
		<a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a>
		<span id="loadingReturn" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
	</form>
</div>
<div id="sendToCheckerMessageDialogContent2" style="display:none;">
	<form method="POST" name="sendToCheckerMessageform2" id="sendToCheckerMessageform2" style="margin-top:0px;">
		<div class="hd">
			<h2 class="conf" style="margin-top:0px;color:#330707">Duplicate (ARA-2003). Unable to Create Request. Please Contact with Head offiice.</h2>
		</div>
		<a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogCancel2" onclick="close_window2()"><span>Cancel</span></a>
	</form>
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