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

<div class="container">
	<!-- grid div below here -->
	<div id="jqxgrid">

	</div>

	<!-- grid footer information -->
	<div style="float:left;padding-top: 5px;padding-left:5px;">
		<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
			<? if (ADD == 1) { ?>
				<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" href="<?= base_url() ?>terget_setup/form/add" title="">

					<input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px" value="Add" id="sendButton" /></a>


			<? } ?> &nbsp;&nbsp;&nbsp;&nbsp;
			<strong>D = </strong> Delete,&nbsp;
			<strong>E = </strong> Edit,&nbsp;
			<strong>P = </strong> Preview,&nbsp;
			<strong>STC = </strong> Send To Chacker, &nbsp;
			<strong>APV = </strong> Approve &nbsp;


		</div> <br />
	</div>
	<!-- detail section here -->



</div>



<script>
	//var theme = 'energyblue';

	//declearing source of the grid 
	var theme = 'classic';
	var source = {
		datatype: "json",
		datafields: [

			{
				name: 'year',
				type: 'string'
			},
			{
				name: 'status_name',
				type: 'string'
			},
			{
				name: "terget_id",
				type: 'int'
			},
			{
				name: "id",
				type: 'int'
			},
			{
				name: "v_sts",
				type: 'int'
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
		url: '<?= base_url() . "terget_setup/grid"; ?>',
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
						if (dataRecord.v_sts == 39 || dataRecord.v_sts == 35) {
							return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'delete\');" ><img align="center" src="<?= base_url() ?>images/delete-New.png"></div>';
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

						if (dataRecord.v_sts == 39 || dataRecord.v_sts == 35) {
							return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit(' + dataRecord.terget_id + ',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';

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


			<?php if (STC == 1) { ?> {
					text: 'STC',
					datafield: 'sendtochecker',
					editable: false,
					align: 'center',
					sortable: false,
					menu: false,
					width: 50,
					cellsrenderer: function(row) {
						editrow = row;
						var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						if (dataRecord.v_sts == 39 || dataRecord.v_sts == 35) {

							return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'sendtochecker\');" ><img align="center" src="<?= base_url() ?>images/forward.png"></div>';
						}
					}
				},
			<? } ?>

			{
				text: 'APV',
				datafield: 'approve',
				editable: false,
				align: 'center',
				sortable: false,
				menu: false,
				width: 50,
				cellsrenderer: function(row) {
					editrow = row;
					var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
					if (dataRecord.v_sts == 37) {

						return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'approve\');" ><img align="center" src="<?= base_url() ?>images/activate1.png"></div>';
					}
				}
			},


			{
				text: 'Status',
				datafield: 'status_name',
				editable: false,
				width: '10%',
				align: 'left',

			},
			{
				text: 'Year',
				datafield: 'year',
				editable: false,
				width: '10%',
				align: 'left',

			},



		],


	});

	jQuery(document).ready(function() {

		//details module below here
		jQuery("#details").jqxWindow({
			theme: theme,
			width: '75%',
			height: '90%',
			resizable: false,
			isModal: true,
			autoOpen: false,
			cancelButton: jQuery("#deletecancel,#sendtochecker_btn_del,#verify_btn_del,#codeOK")
		});
		jQuery('#details').on('close', function(event) {
			jQuery('#delete_convence').jqxValidator('hide');
		});

		var delete_rule = [{
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
		
		// Delete Ajax call
		jQuery("#delete_button").click(function() {
			rule = delete_rule;
			jQuery('#delete_convence').jqxValidator({
				rules: rule
			});
			var validationResult = function(isValid) {

				if (isValid) {
					jQuery("#delete_button").hide();
					jQuery("#deletecancel").hide();
					jQuery("#delete_loading").show();

					delete_submit();
				}
			}
			jQuery('#delete_convence').jqxValidator('validate', validationResult);
		});


		jQuery("#sendtochecker_btn").click(function() {
            jQuery("#sendtochecker_btn").hide();
            jQuery("#sendtochecker_btn_del").hide();
            jQuery("#sendtochecker_loding").show();
            delete_submit();
        });

		jQuery("#verify_btn").click(function() {
            jQuery("#verify_btn").hide();
            jQuery("#verify_btn_del").hide();
            jQuery("#verify_loding").show();
            delete_submit();
        });




	});

	function edit(val, indx) {

		console.log("Terget setup Id:" + val);
		jQuery("#jqxgrid").jqxGrid('clearselection');
		var href = "<?= base_url() ?>terget_setup/form/edit/" + val;
		EOL.messageBoard.open(href, (jQuery(window).width() - 70), jQuery(window).height(), 'yes');
		return false;
	}


	function details(id, operation) {



		jQuery("#previewtable").show();
		if (operation == 'delete') {
			jQuery("#deleteEventId").val(id);
			jQuery("#type").val(operation);

			jQuery("#header_title").html('Delete');
			jQuery("#delete_row").show();
			jQuery("#close_btn_row").hide();
			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").hide();
		}

		if (operation == 'details') {

			jQuery("#deleteEventId").val('');
			jQuery("#header_title").html('Details');
			jQuery("#preview").show();
			jQuery("#close_btn_row").show();
			jQuery("#delete_row").hide();
			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").hide();
		}

		if (operation == 'sendtochecker') {

			jQuery("#verifyid").val(id);
			jQuery("#type").val(operation);
			jQuery("#header_title").html('Send To Chacker');


			jQuery("#delete_row").hide();
			jQuery("#close_btn_row").hide();
			jQuery("#sendtochecker_row").show();
			jQuery("#verify_row").hide();


		}

		if (operation == 'approve') {
			jQuery("#verifyid").val(id);
			jQuery("#type").val(operation);
			jQuery("#header_title").html('approve');


			jQuery("#delete_row").hide();
			jQuery("#close_btn_row").hide();
			jQuery("#sendtochecker_row").hide();
			jQuery("#verify_row").show();

		}

		var csrfName = jQuery('.txt_csrfname').attr('name');
		var csrfHash = jQuery('.txt_csrfname').val();

		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?= base_url() ?>Terget_setup/get_details",
			data: {
				[csrfName]: csrfHash,
				id: id
			},
			datatype: "json",
			async: false,
			success: function(response) {


				var ds = response.split('####');
				jQuery('.txt_csrfname').val(ds[0]);
				jQuery('#previewtable').html(ds[1]);

			}
		});


		document.getElementById("details").style.display = 'block';
		jQuery("#details").jqxWindow('open');




	}

	// Delete Submit
	function delete_submit() {

		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#delete_convence').serialize() + "&" + csrfName + "=" + csrfHash;


		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?= base_url() ?>Terget_setup/delete_action/',
			data: postData,
			datatype: "json",
			success: function(response) {
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				if (json.Message != 'OK') {

					if ($('type').value == 'delete') {
						jQuery("#delete_button").show();
						jQuery("#deletecancel").show();
						jQuery("#delete_loading").hide();
						jQuery('#details').jqxWindow('close');
						alert(json.Message);
						return false;

					} else if ($('type').value == 'sendtochecker') {

						jQuery("#sendtochecker_btn").show();
						jQuery("#sendtochecker_btn_del").show();
						jQuery("#sendtochecker_loding").hide();

						jQuery('#details').jqxWindow('close');
						alert(json.Message);
						return false;

					} else if ($('type').value == 'approve') {

						jQuery("#verify_btn").show();
						jQuery("#verify_btn_del").show();
						jQuery("#verify_loding").hide();

						jQuery('#details').jqxWindow('close');
						alert(json.Message);
						return false;

					}

				} else {

					if ($('type').value == 'delete') {

						jQuery("#delete_button").show();
						jQuery("#deletecancel").show();
						jQuery("#delete_loading").hide();

					} else if ($('type').value == 'sendtochecker') {


						jQuery("#sendtochecker_btn").show();
						jQuery("#sendtochecker_btn_del").show();
						jQuery("#sendtochecker_loding").hide();



					} else if ($('type').value == 'approve') {

						jQuery("#verify_btn").show();
						jQuery("#verify_btn_del").show();
						jQuery("#verify_loding").hide();

					}

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
</script>


<!-- Detailse -->

<div id="details" style="display: none;">
	<div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>

	<form method="POST" name="delete_convence" id="delete_convence" style="margin:0px;">

		<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
		<input name="verifyid" id="verifyid" value="" type="hidden">
		<input name="type" id="type" value="" type="hidden">



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
			<span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
		</div>


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