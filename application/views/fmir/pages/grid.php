<style type="text/css">
	.letter_no:hover {
		text-decoration: underline;
	}

	.fmirLifeCycle tr th {
		color: red;
	}

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

	.buttonclose,
	#assignToBTN,
	#completeBTN {
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

	.assignTable {
		margin: auto;
	}

	.assignTable tr td {

		border: none !important;

	}

	.detailsLoadingDiv {
		width: 13%;
		margin: auto;
	}


	#assignToBTN:hover {
		background-color: blue;
		color: white;
	}

	#completeBTN:hover {
		background-color: green;
		color: white;
	}
</style>



<div class="container">

	<!-- grid div below here -->
	<div id="jqxgrid">

	</div>

	<!-- grid footer information -->
	<div style="float:left;padding-top: 5px;padding-left:5px;">
		<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
			<? if (ADD == 1) { ?>
				<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" href="<?= base_url() ?>fmir/form/add" title="">

					<input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px" value="Add" id="sendButton" /></a>


			<? } ?> &nbsp;&nbsp;&nbsp;&nbsp;
			<strong>D = </strong> Delete,&nbsp;
			<strong>E = </strong> Edit,&nbsp;
			<strong>P = </strong> Preview,&nbsp;
			<strong>STH = </strong> Send To Head Office, &nbsp;
			<strong>A = </strong> Assign, &nbsp;
			<strong>COM = </strong> Complete, &nbsp;
			<strong>SL = </strong> Serial No&nbsp;


		</div> <br />
	</div>
	<!-- detail section here -->


	<!-- Detailse -->

	<div id="details" style="display: none;">
		<div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>

		<form method="POST" name="delete_convence" id="delete_convence" style="margin:0px;">

			<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
			<input name="verifyid" id="verifyid" value="" type="hidden">
			<input name="type" id="type" value="" type="hidden">

			<input name="type_id_get" id="type_id_get" value="" type="hidden">


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
			<div id="delay_row" style="text-align:center;margin-bottom:30px;width:100%; margin-top:15px">
				<strong style="vertical-align:top">Delay Reason<span style="color: red;">*</span></strong>
				<textarea name="delay_reason" id="delay_reason" style="width:250px;"></textarea>
				</br></br>

				<input type="button" class="buttondelete" id="delayBTN" value="Deley" />

				<input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
				<span id="delay_loading" style="display:none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
			</div>
			<div id="complete_row" style="text-align:center;margin-bottom:30px;width:100%; margin-top:15px">
				<strong style="vertical-align:top">Remarks<span style="color: red;">*</span></strong>
				<textarea name="complete_remarks" id="complete_remarks" style="width:250px;"></textarea>
				</br></br>

				<input type="button" class="" id="completeBTN" value="Complete" />

				<input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
				<span id="complete_loading" style="display:none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
			</div>

			<div id="assignToRow" style="text-align:center;margin-bottom:30px;width:100%; margin-top:15px">




				<table class="assignTable">
					<tr>
						<td style="padding-top:10px;"><strong style="vertical-align:top;">Assign To<span style="color: red;">*</span></strong></td>
						<td>
							<div id="assigned_user" name="assigned_user" style="padding-left: 3px;margin:auto;margin-top:10px;"></div>
						</td>
					</tr>
				</table>


				</br></br>

				<input type="button" class="" id="assignToBTN" value="Assign" />

				<input type="button" class="buttonclose" id="sendtochecker_btn_del" onclick="close()" value="Cancel">
				<span id="assign_loading" style="display:none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
			</div>



			<br>

			<!-- STR -->
			<div id="sendtochecker_row" style="text-align:center;margin-bottom:30px;width:100%;">
				<br>
				<input type="button" name="sth" class="buttonsendtochecker" id="sendtochecker_btn" value="Send to Head Office">
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



</div>

<script>
	//var theme = 'energyblue';

	//declearing source of the grid 
	var theme = 'classic';
	var source = {
		datatype: "json",
		datafields: [

			{
				name: 'id',
				type: 'int'
			},
			{
				name: 'sl_no',
				type: 'string'
			},
			{
				name: 'branch_name',
				type: 'string'
			},
			{
				name: 'client_name',
				type: 'string'
			},
			{
				name: 'subject',
				type: 'string'
			},
			{
				name: 'letter_no',
				type: 'string'
			},
			{
				name: 'letter_date',
				type: 'string'
			},
			{
				name: 'inward_no',
				type: 'string'
			},
			{
				name: 'inward_date',
				type: 'string'
			},

			{
				name: 'user_name',
				type: 'string'
			},

			{
				name: 'i_date',
				type: 'string'
			},
			{
				name: 'l_date',
				type: 'string'
			},
			{
				name: "v_sts",
				type: "int"
			},
			{
				name: "sth_date",
				type: "string"
			},
			{
				name: "assigned_dt",
				type: "string"
			}, {
				name: "complete_dt",
				type: "string"
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
		url: '<?= base_url() . "fmir/grid"; ?>',
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

	var notStsList = [110, 111, 112, 113];
	//grid setting below here
	var win_h = jQuery(window).height() - 190;
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
						if (notStsList.includes(dataRecord.v_sts) == false) {
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
						if (notStsList.includes(dataRecord.v_sts) == false) {
							return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit(' + dataRecord.id + ',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';

						}
					}
				},
			<?php } ?>

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


			<? if (STH == 1) { ?> {
					text: 'STH',
					datafield: 'sendtochecker',
					editable: false,
					align: 'center',
					sortable: false,
					menu: false,
					width: 50,
					cellsrenderer: function(row) {
						editrow = row;
						var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						if (notStsList.includes(dataRecord.v_sts) == false) {
							return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'sth\',' + editrow + ',' + dataRecord.sts + ');" ><img align="center" src="<?= base_url() ?>images/forward.png"></div>';
						}
					}
				},
			<? } ?>
			<? if (ASSIGN == 1) { ?> {
					text: 'A',
					datafield: 'assign',
					editable: false,
					align: 'center',
					sortable: false,
					menu: false,
					width: 32,
					cellsrenderer: function(row) {
						editrow = row;
						var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						if ((dataRecord.v_sts == 110 || dataRecord.v_sts == 111 || dataRecord.v_sts == 113) && <?= $this->session->userdata['ast_user']['user_work_group_id'] ?> == 3) {
							return '<div  style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'assign\',' + editrow + ',' + dataRecord.sts + ');" ><img align="center" src="<?= base_url() ?>images/assign.jpg"></div>';
						}
					}
				},
			<? } ?>
			<? if (COMPLETE == 1) { ?> {
					text: 'COM',
					datafield: 'completed',
					editable: false,
					align: 'center',
					sortable: false,
					menu: false,
					width: '5%',
					cellsrenderer: function(row) {
						editrow = row;
						var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						if ((dataRecord.v_sts == 111 || dataRecord.v_sts == 113) && <?= $this->session->userdata['ast_user']['user_work_group_id'] ?> == 2) {
							return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'complete\',' + editrow + ',' + dataRecord.sts + ');" ><img align="center" src="<?= base_url() ?>images/confirm.png"></div>';
						}
					}
				},
				{
					text: 'Delay',
					datafield: 'Delay',
					editable: false,
					align: 'center',
					sortable: false,
					menu: false,
					width: '5%',
					cellsrenderer: function(row) {
						editrow = row;
						var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);

						if ((dataRecord.v_sts == 111 || dataRecord.v_sts == 113) && <?= $this->session->userdata['ast_user']['user_work_group_id'] ?> == 2) {
							return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'delay\',' + editrow + ',' + dataRecord.sts + ');" ><img align="center" src="<?= base_url() ?>images/editor.png"></div>';
						}
					}
				},
			<? } ?> {
				text: 'SL',
				datafield: 'sl_no',
				editable: false,
				width: '4%'
			},
			{
				text: 'Status',
				datafield: 'status',
				editable: false,
				align: 'left',
				sortable: false,
				menu: false,
				width: 85,
				cellsrenderer: function(row) {
					editrow = row;
					var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
					if (dataRecord.v_sts == 0) {
						return '<div style="text-align:left;margin-top: 5px;padding-left:4px;"  >Added</div>';
					} else if (dataRecord.v_sts == 110) {
						return '<div style="text-align:left;margin-top: 5px;padding-left:4px;"  >Sent to HO</div>';
					} else if (dataRecord.v_sts == 111) {
						return '<div style="text-align:left;margin-top: 5px;padding-left:4px;"  >Assigned</div>';
					} else if (dataRecord.v_sts == 112) {
						return '<div style="text-align:left;margin-top: 5px;padding-left:4px;"  >Completed</div>';
					} else if (dataRecord.v_sts == 113) {
						//delayed fmir .showed assigned 
						return '<div style="text-align:left;margin-top: 5px;padding-left:4px;"  >Assigned</div>';
					} else if (dataRecord.v_sts == 35) {
						return '<div style="text-align:left;margin-top: 5px;padding-left:4px;"  >Updated</div>';
					}
				}
			},
			{
				text: 'Letter No',
				datafield: 'letter_no',
				editable: false,
				width: '10%',
				align: 'left',
				cellsrenderer: function(row) {
					editrow = row;
					var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
					return '<div class="letter_no" style="text-align:left;margin-top: 5px; margin-left:5px; cursor:pointer" onclick="details(' + dataRecord.id + ',\'history\',' + editrow + ',' + dataRecord.sts + ');" >' + dataRecord.letter_no + '</div>';

				}
			},
			{
				text: 'Assigned To',
				datafield: 'user_name',
				editable: false,
				width: '17%',
				align: 'left',
			},
			{
				text: 'Disposal Date',
				datafield: 'sth_date',
				editable: false,
				width: '10%',
				align: 'left',

			},
			{
				text: 'Duration',
				datafield: 'durationDate',
				editable: false,
				width: '10%',
				align: 'left',
				sortable: false,
				menu: false,
				cellsrenderer: function(row) {
					editrow = row;
					var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
					if (dataRecord.complete_dt) {
						var difTime = calculateTime(dataRecord.complete_dt, dataRecord.assigned_dt);
						return '<div style="text-align:left;margin-top: 5px;padding-left:4px; "  >' + difTime + '</div>';

					}
				}
			},




			{
				text: 'Brach Name',
				datafield: 'branch_name',
				editable: false,
				width: '18%',
				align: 'left',
			},

			{
				text: 'Client Name',
				datafield: 'client_name',
				editable: false,
				width: '13%',
				align: 'left',
			},

			{
				text: 'Subject',
				datafield: 'subject',
				editable: false,
				width: '20%',
				align: 'left',
			},



			{
				text: 'Letter Date',
				datafield: 'l_date',
				editable: false,
				width: '13%',
				align: 'left',
			},
			{
				text: 'Inward No',
				datafield: 'inward_no',
				editable: false,
				width: '10%',
				align: 'left',
			},

			{
				text: 'Inward Date',
				datafield: 'i_date',
				editable: false,
				width: '13%',
				align: 'left',
			}



		],
	});

	//details module below here
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

	//setting up user dropdown
	var users = [<?php $i = 1;
					foreach ($users as $row) {
						if ($i != 1) {
							echo ',';
						}
						echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
						$i++;
					} ?>];

	jQuery("#assigned_user").jqxComboBox({
		theme: theme,
		autoOpen: false,
		autoDropDownHeight: false,
		promptText: "Select user",
		source: users,
		width: 250,
		height: 25
	});

	//clear combobox if valid dropdown data not inserted
	jQuery("#assigned_user").focusout(function() {
		commbobox_check(jQuery(this).attr('id'));
	});

	//setting up assigned user dropdown value


	function details(id, operation) {

		clear_form();
		jQuery("#previewtable").empty();
		var type = null;


		jQuery('#previewtable').prepend('<div class="detailsLoadingDiv"><br><img id="theImg"  src="' + baseurl + 'images/ajax-loader.gif" /><br></div>')


		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery("#previewtable").show();
		jQuery("#extend_loading").hide();

		jQuery("#delay_row").hide();
		jQuery("#complete_row").hide();

		if (operation == 'details') {
			jQuery("#extend_reason").hide();
			jQuery("#delete_row").hide();
			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").hide();
			jQuery("#header_title").html('FMIR Details');
			jQuery("#close_btn_row").show();
			jQuery("#assignToRow").hide();
		}
		if (operation == 'history') {
			jQuery("#extend_reason").hide();
			jQuery("#delete_row").hide();
			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").hide();
			jQuery("#header_title").html('FMIR Details');
			jQuery("#close_btn_row").show();
			jQuery("#assignToRow").hide();

			type = "history";
		}
		if (operation == 'delete') {

			jQuery("#header_title").html('Delete');
			jQuery("#extend_reason").hide();
			jQuery("#delete_row").show();
			jQuery("#assignToRow").hide();

			jQuery("#delete_button").show();
			jQuery("#deletecancel").show();
			jQuery("#delete_loading").hide();


			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").hide();

			jQuery("#close_btn_row").hide();



		} else if (operation == 'sth') {

			jQuery("#delete_row").hide();
			jQuery("#sendtochecker_row").show();
			jQuery("#verify_row").hide();
			jQuery("#close_btn_row").hide();
			jQuery("#extend_reason").hide();
			jQuery("#assignToRow").hide();


			jQuery("#sendtochecker_btn").show();
			jQuery("#sendtochecker_btn_del").show();
			jQuery("#sendtochecker_loding").hide();
			jQuery("#header_title").html('Send To Head Office');


		} else if (operation == 'assign') {

			jQuery("#delete_row").hide();
			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").hide();
			jQuery("#close_btn_row").hide();
			jQuery("#extend_reason").hide();



			jQuery("#assignToRow").show();
			jQuery("#assignToBTN").show();
			jQuery("#sendtochecker_btn_del").show();
			jQuery("#assign_loading").hide();
			jQuery("#header_title").html('Assign');

		} else if (operation == 'delay') {

			jQuery("#delete_row").hide();
			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").hide();
			jQuery("#close_btn_row").hide();
			jQuery("#extend_reason").hide();
			jQuery("#assignToRow").hide();
			jQuery("#complete_row").hide();


			jQuery("#delay_row").show();
			jQuery("#delayBTN").show();
			jQuery("#delay_loading").hide();
			jQuery("#header_title").html('Send To Chacker');

		} else if (operation == 'complete') {

			jQuery("#delete_row").hide();
			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").hide();
			jQuery("#close_btn_row").hide();
			jQuery("#extend_reason").hide();
			jQuery("#assignToRow").hide();
			jQuery("#complete_row").hide();
			jQuery("#delay_row").hide();

			jQuery("#complete_row").show();
			jQuery("#complete_loading").hide();
			jQuery("#header_title").html('Send To Chacker');

		}

		jQuery("#details").jqxWindow('open');
		var csrfName = jQuery('.txt_csrfname').attr('name');
		var csrfHash = jQuery('.txt_csrfname').val();


		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?= base_url() ?>fmir/details",
			data: {
				[csrfName]: csrfHash,
				id: id,
				type: type
			},
			datatype: "json",
			success: function(response) {
				jQuery("#previewtable").empty();
				var response = JSON.parse(response);
				jQuery('.txt_csrfname').val(response.csrf_token);
				jQuery('#previewtable').html(response.html);
				jQuery("#prev_date").val(response.prev_date);

			}

		});
		document.getElementById("details").style.display = 'block';
		jQuery("#details").jqxWindow('open');

	}
	//

	function edit(id) {
		EOL.messageBoard.open('<?= base_url() ?>fmir/form/edit/' + id, (jQuery(window).width() - 80), jQuery(window).height(), 'yes');
		return false;
	}
	// clearing form below here
	function clear_form() {
		jQuery("#comments").val('');
		jQuery("#delay_reason").val('');
		jQuery("#complete_remarks").val('');
	}

	//delete action below here

	//delete rules
	var rules1 = [ //Rules for delete
		{
			input: '#comments',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (input.val() == '') {
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

	var assignRules = [ //Rules for delete
		{
			input: '#assigned_user',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (input.val() == '') {
					jQuery("#assigned_user").focus();
					return false;
				}
				return true;


			}
		},

	];
	var delayRules = [ //Rules for delete
		{
			input: '#delay_reason',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {

				if (input.val() == '') {
					jQuery("#delay_reason").focus();
					return false;
				} else {
					return true;
				}
			}
		},

		{
			input: '#delay_reason',
			message: 'more than 250 characters',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				if (input.val() != '') {
					if (input.val().length > 250) {
						jQuery("#delay_reason").focus();
						return false;
					}
				}
				return true;

			}
		},
	];
	var completeRules = [ //Rules for delete
		{
			input: '#complete_remarks',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {

				if (input.val() == '') {
					jQuery("#complete_remarks").focus();
					return false;
				} else {
					return true;
				}
			}
		},

		{
			input: '#complete_remarks',
			message: 'more than 250 characters',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				if (input.val() != '') {
					if (input.val().length > 250) {
						jQuery("#complete_remarks").focus();
						return false;
					}
				}
				return true;

			}
		},
	];




	//onClick delete button
	jQuery("#delete_button").click(function() {
		jQuery('#delete_convence').jqxValidator({
			rules: rules1,
			theme: theme
		});
		var validationResult = function(isValid) {
			if (isValid) {
				jQuery("#delete_button").hide();
				jQuery("#buttonclose").hide();
				jQuery("#delete_loading").show();
				call_ajax_submit_delete();
				clear_form();
			}
		}
		jQuery('#delete_convence').jqxValidator('validate', validationResult);

	});

	//onClick assign button
	jQuery("#assignToBTN").click(function() {
		jQuery('#delete_convence').jqxValidator({
			rules: assignRules,
			theme: theme
		});
		var validationResult = function(isValid) {
			if (isValid) {
				jQuery("#assignToBTN").hide();
				jQuery(".buttonclose").hide();
				jQuery("#assign_loading").show();
				call_ajax_submit_delete();
				clear_form();
			}
		}
		jQuery('#delete_convence').jqxValidator('validate', validationResult);

	});

	//onClick Deleay button
	jQuery("#delayBTN").click(function() {

		jQuery('#delete_convence').jqxValidator({
			rules: delayRules,
			theme: theme
		});
		var validationResultDelay = function(isValid) {

			if (isValid) {
				jQuery("#delayBTN").hide();
				jQuery("#delay_loading").show();
				call_ajax_submit_delete();
				clear_form();
			}
		}
		jQuery('#delete_convence').jqxValidator('validate', validationResultDelay);

	});

	//onClick Deleay button
	jQuery("#completeBTN").click(function() {

		jQuery('#delete_convence').jqxValidator({
			rules: completeRules,
			theme: theme
		});
		var validationResultDelay = function(isValid) {

			if (isValid) {
				jQuery("#completeBTN").hide();
				jQuery("#complete_loading").show();
				call_ajax_submit_delete();
				clear_form();
			}
		}
		jQuery('#delete_convence').jqxValidator('validate', validationResultDelay);

	});

	//onclick sent to checker button
	jQuery("#sendtochecker_btn").click(function() {

		jQuery("#sendtochecker_btn").hide();
		jQuery("#sendtochecker_loding").show();
		call_ajax_submit_delete();

	});

	function call_ajax_submit_delete() {

		jQuery(".buttonclose").hide();
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#delete_convence').serialize() + "&" + csrfName + "=" + csrfHash;


		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?= base_url() ?>fmir/delete_action/',
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



				}

			}

		});
	}

	function calculateTime(end, start) {

		var time = "";
		const diff = Date.parse(end) - Date.parse(start);
		var tmp = Math.floor(diff / 1000 / 60 / 60 / 24);
		if (tmp == 0) {
			time = 1 + " Day";
		} else {
			time = tmp + " Days";
		}

		//calculates in hours
		// else {
		// 	var tmp = Math.floor(diff / 1000 / 60 / 60);
		// 	time = tmp + " Hour";
		// 	if (tmp == 0) {
		// 		time = "";
		// 	}
		// }
		return time;
	}
</script>