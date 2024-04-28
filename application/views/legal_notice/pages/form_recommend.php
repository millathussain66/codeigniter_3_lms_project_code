<style type="text/css">
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
</style>
<script type="text/javascript">
	var csrf_token = '';
	jQuery(document).ready(function() {
		jQuery("#r_history").jqxWindow({
			theme: theme,
			width: '100%',
			height: '90%',
			resizable: false,
			isModal: true,
			autoOpen: false,
			cancelButton: jQuery("#r_ok")
		});
		var theme = getDemoTheme();
		jQuery('#sendButton').jqxButton({
			template: "success",
			width: 120,
			height: 40,
			theme: theme
		});
		jQuery('#decline_button').jqxButton({
			template: "danger",
			width: 120,
			height: 40,
			theme: theme
		});
		jQuery('#sendToMakerButton').jqxButton({
			template: "warning",
			width: 120,
			height: 40,
			theme: theme
		});

	});

	function delete_action(type) {
		var message = '';
		if (type == 'recommend') {
			jQuery("#reason_messge_body").hide();
			jQuery("#type").val(type);
			jQuery("#message").html('Recommend');
			jQuery("#button_tag").html('Send');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Recommended');
		}
		if (type == 'return') {
			jQuery("#reason_messge_body").show();
			jQuery("#type").val(type);
			jQuery("#message").html('Return');
			jQuery("#button_tag").html('Return');
			jQuery("#reason_messagae").html('Return');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Returned');
		}
		if (type == 'reject') {
			jQuery("#reason_messge_body").show();
			jQuery("#type").val(type);
			jQuery("#message").html('Decline');
			jQuery("#button_tag").html('Decline');
			jQuery("#reason_messagae").html('Decline');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Rejected');
		}

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

	function close_window() {
		sendToCheckerMessageDialog.hide();
	}

	function call_ajax_submit() {
		if (jQuery('#reason').val() == '' && jQuery('#type').val() != 'recommend') {
			alert('The reason field is required!');
			jQuery('#reason').focus();
			return false;
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = $('sendToCheckerMessageform').toQueryString() + "&" + csrfName + "=" + csrfHash;
		$('sendToCheckerMessageDialogConfirm').style.display = 'none';
		$('sendToCheckerMessageDialogCancel').style.display = 'none';
		$('loadingReturn').style.display = 'inline';
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?= base_url() ?>index.php/legal_notice/delete_action/',
			data: postData,
			datatype: "json",
			success: function(response) {
				///console.log(response);
				var json = jQuery.parseJSON(response);
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				jQuery('.txt_csrfname').val(json.csrf_token);
				if (json.Message != 'OK') {
					alert(json.Message);
					//window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					window.top.EOL.messageBoard.close();
				} else {

					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + jQuery("#success_message").val());
					//window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');										
					window.top.EOL.messageBoard.close();
				}
			}
		});

	}

	function r_history(id) {
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?= base_url() ?>legal_notice/r_history",
			data: {
				[csrfName]: csrfHash,
				id: id
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

	function popup(url) {
		var winl = (screen.width - 900) / 2;
		var wint = 40;
		newwindow = window.open(url, 'name', 'height=600, width=900,top=' + wint + ', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left=' + winl);
		if (window.focus) {
			newwindow.focus()
		}
		return false;
	}
</script>

<style>
	.custtable table {
		color: #333;
		font-family: Helvetica, Arial, sans-serif;
		width: 640px;
		border-collapse:
			collapse;
		border-spacing: 0;
		margin-top: 15px;
		table-layout: fixed;
	}

	.custtable td,
	.custtable th {
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
		word-wrap: break-word
	}

	.custtable th {
		background: #DFDFDF;
		font-weight: bold;
		padding-left: 5px;
		padding-right: 5px;
		text-align: left;
	}

	table.preview_table2 td,
	table.preview_table2 th {
		border: 1px solid #c7c7c7;
		word-wrap: break-word;
		padding: 5px;
	}

	.custtable td {
		background: #FAFAFA;
		padding-left: 5px;
		padding-right: 5px;
		text-align: left;
		word-wrap: break-word
	}

	.custtable tr:nth-child(even) td {
		background: #F1F1F1;
	}

	.custtable tr:nth-child(odd) td {
		background: #FEFEFE;
	}

	.custtable tr:hover {
		background: #666;
		color: #000;
	}

	#gurantor_table {
		border-collapse: collapse;
	}

	#gurantor_table td {
		border: 1px solid rgba(0, 0, 0, .20);
	}
</style>

<body style="font-family:calibri">
	<div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
		Recommend Reminder Notice
	</div>

	<div id="username_error_show" style="color:#FF0000; font-weight:bold; text-align:center"></div>
	<div align="left">
		<form class="form" id="form" name="form" method="post" action="#" enctype="multipart/form-data">
			<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<table class="custtable" border="0" style="margin-left:10px;margin-top:10px;width:99%; font-size:15px;border-collapse:collapse">
				<tr>
					<td style="width:12%"><strong>SL No.</strong></td>
					<td style="width:30%"><?= $result->sl_no; ?></td>
					<td style="width:12%"><strong>Current/Updated Address</strong></td>
					<td style="width:30%"><?= $result->current_address; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Proposed Type</strong></td>
					<td style="width:30%"><?= $result->proposed_type; ?></td>
					<td style="width:12%"><strong>Zone</strong></td>
					<td style="width:30%"><?= $result->zone_name; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong><? if ($result->proposed_type == 'Investment') {
														echo "Investment A/C No.";
													} else {
														echo "Card No.";
													} ?></strong></td>
					<td style="width:30%"><?= $result->loan_ac; ?></td>
					<td style="width:12%"><strong>Branch Code</strong></td>
					<td style="width:30%"><?= $result->branch_sol; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>CID </strong></td>
					<td style="width:30%"><?= $result->cif; ?></td>
					<td style="width:12%"><strong>District</strong></td>
					<td style="width:30%"><?= $result->district_name; ?></td>
				</tr>
				<tr>

				</tr>
				<tr>
					<td style="width:12%"><strong><? if ($result->proposed_type == 'Investment') {
														echo "Investment A/C Name.";
													} else {
														echo "Name on Card";
													} ?></strong></td>
					<td style="width:30%"><?= $result->ac_name; ?></td>
					<td style="width:12%"><strong>More A/C No. </strong></td>
					<td style="width:30%"><?= $result->more_acc_number; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Subject Type</strong></td>
					<td style="width:30%"><?= $result->subject_name; ?></td>
					<td style="width:12%"><strong>Remarks </strong></td>
					<td style="width:30%"><?= $result->remarks; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Spouse Name</strong></td>
					<td style="width:30%"><? if ($result->sub_type == 3 && $result->spouse_name != '') {
												echo $result->spouse_name;
											} else {
												echo "N/A";
											} ?></td>
					<td style="width:12%"><strong>Initiate By</strong></td>
					<td style="width:30%"><?= $result->e_by; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Mother Name</strong></td>
					<td style="width:30%"><? if ($result->sub_type == 3) {
												echo $result->mother_name;
											} else {
												echo "N/A";
											} ?></td>
					<td style="width:12%"><strong>Initiate Date Time</strong></td>
					<td style="width:30%"><?= $result->e_dt; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Investment Segment (Portfolio) </strong></td>
					<td style="width:30%"><?= $result->loan_segment; ?></td>
					<td style="width:12%"><strong>STC By</strong></td>
					<td style="width:30%"><?= $result->stc_by; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Call up Date</strong></td>
					<td style="width:30%"><?= $result->call_up_dt; ?></td>
					<td style="width:12%"><strong>STC Date TIme</strong></td>
					<td style="width:30%"><?= $result->stc_dt; ?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Call Up File</strong></td>
					<td style="width:30%">
						<?php if ($result->call_up_file != '') : ?>
							<img id="file_preview" onclick="popup('<?= base_url() ?>legal_notice_file/call_up_file/<?= $result->call_up_file ?>')" style=" cursor:pointer;text-align:center" height="18" src="<?= base_url() ?>old_assets/images/print-preview.png">
						<?php endif ?>
					</td>
					<td style="width:12%"><strong>Return/Decline Message</strong></td>
					<td style="width:30%">
						<?php if ($result->return_reason_rm != null) : ?>
							<a href="#" style="color:black" onclick="return r_history(<?= $result->id; ?>)"><span><?= $result->return_reason_rm; ?></span></a>
						<?php endif ?>
					</td>
				</tr>
				<?php if (!empty($pre_ln_data)) : ?>
					<tr>
						<td style="width:12%"><strong>Pre LN By</strong></td>
						<td style="width:30%"><?= $pre_ln_data->pre_ln_by; ?></td>
						<td style="width:12%"><strong>Pre LN File</strong></td>
						<td style="width:30%"><a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?= base_url() ?>index.php/legal_notice_ho/download_pdf/<?= $pre_ln_data->id; ?>/<?= $pre_ln_data->proposed_type; ?>" target="_blank">&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="<?= base_url(); ?>images/pdf_icon.gif"></a></td>
					</tr>
				<?php endif ?>
				<?php if (!empty($legal_notice_guarantor)) : ?>
					<tr>
						<td colspan="4">
							</br>
							<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
								<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;"><?php if ($result->proposed_type == 'Investment') {
																													echo "Borrower/Guarantor/Company Director/Owner";
																												} else {
																													echo "Borrower/Reference";
																												} ?></span>
								<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px">
									<tbody>
										<input type="hidden" name="guarantor_info_counter" id="guarantor_info_counter" value="1">
										<tr>
											<td width="10%" style="font-weight: bold;text-align:center">Type</td>
											<td width="10%" style="font-weight: bold;text-align:left">Name</td>
											<td width="10%" style="font-weight: bold;text-align:left">Father Name</td>
											<td width="15%" style="font-weight: bold;text-align:left">Present Address</td>
											<td width="15%" style="font-weight: bold;text-align:left">Permanent Address</td>
											<td width="15%" style="font-weight: bold;text-align:left">Business Address</td>
											<td width="10%" style="font-weight: bold;text-align:center">Status</td>
											<td width="15%" style="font-weight: bold;text-align:center">Occupation</td>
										</tr>
										<?php foreach ($legal_notice_guarantor as $key) : ?>
											<tr>
												<td style="text-align:center"><?= $key->type_name ?></td>
												<td style="text-align:left"><?= $key->guarantor_name ?></td>
												<td style="text-align:left"><?= $key->father_name ?></td>
												<td style="text-align:left"><?= $key->present_address ?></td>
												<td style="text-align:left"><?= $key->permanent_address ?></td>
												<td style="text-align:left"><?= $key->business_address ?></td>
												<td style="text-align:center"><?= $key->guar_sts_name ?></td>
												<td style="text-align:center"><?= $key->occ_sts_name ?></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</td>
					</tr>
				<?php endif ?>
				<?php if ($proposed_type == 1) : ?>
					<?php if (!empty($facility_info)) : ?>
						<tr>
							<td colspan="4" style="background: white;">
								<br />
								<div style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
									<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
									<table border="1" id="gurantor_table" style="border-color:#c0c0c0;width:127%;margin:20px">
										<thead>
											<tr>
												<td width="5%" style="font-weight: bold;text-align:center">Faci lity Type</td>
												<td width="5%" style="font-weight: bold;text-align:center">A/C Number</td>
												<td width="5%" style="font-weight: bold;text-align:center">A/C Name</td>
												<td width="5%" style="font-weight: bold;text-align:center">Sch Desc.</td>
												<td width="5%" style="font-weight: bold;text-align:center">Disbursement Date</td>
												<td width="7%" style="font-weight: bold;text-align:center">Disbursed Amount</td>
												<td width="7%" style="font-weight: bold;text-align:center">Expire Date</td>
												<td width="7%" style="font-weight: bold;text-align:center">Due install ments</td>
												<td width="7%" style="font-weight: bold;text-align:center">Payable</td>
												<td width="7%" style="font-weight: bold;text-align:center">Repayment</td>
												<td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance</td>
												<td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance Date</td>
												<td width="7%" style="font-weight: bold;text-align:center">Overdue Balance</td>
												<td width="7%" style="font-weight: bold;text-align:center">Overdue BL Date</td>
												<td width="7%" style="font-weight: bold;text-align:center">Call -up Date</td>
												<td width="7%" style="font-weight: bold;text-align:center">CL(BB)</td>
												<td width="7%" style="font-weight: bold;text-align:center">CL(AIBL)</td>
											</tr>
										</thead>
										<tbody id="loan_facility_info_body">
											<?php foreach ($facility_info as $key) : ?>
												<tr>
													<td style="text-align:center"><?= $key->facility_type ?></td>
													<td style="text-align:center"><?= $key->ac_number ?></td>
													<td style="text-align:center"><?= $key->ac_name ?></td>
													<td style="text-align:center"><?= $key->sch_desc ?></td>
													<td style="text-align:center"><?= $key->disbursement_date ?></td>
													<td style="text-align:center"><?= $key->disbursed_amount ?></td>
													<td style="text-align:center"><?= $key->expire_date ?></td>
													<td style="text-align:center"><?= $key->due_installments ?></td>
													<td style="text-align:center"><?= $key->payble ?></td>
													<td style="text-align:center"><?= $key->repayment ?></td>
													<td style="text-align:center"><?= $key->outstanding_bl ?></td>
													<td style="text-align:center"><?= $key->outstanding_bl_dt ?></td>
													<td style="text-align:center"><?= $key->overdue_bl ?></td>
													<td style="text-align:center"><?= $key->overdue_bl_dt ?></td>
													<td style="text-align:center"><?= $key->call_up_dt ?></td>
													<td style="text-align:center"><?= $key->cl_bb ?></td>
													<td style="text-align:center"><?= $key->cl_bbl ?></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					<?php endif ?>
				<?php else : ?>
					<?php if (!empty($facility_info)) : ?>
						<tr>
							<td colspan="4" style="background: white;">
								<br />
								<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
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
											</tr>
										</thead>
										<tbody id="loan_facility_info_body">
											<?php foreach ($facility_info as $key) : ?>
												<tr>
													<td style="text-align:center"><?= $key->card_type ?></td>
													<td style="text-align:center"><?= $key->card_no ?></td>
													<td style="text-align:center"><?= $key->card_name ?></td>
													<td style="text-align:center"><?= isset($key->card_issue_dt) ? date_format(date_create($key->card_issue_dt), "d/m/Y") : '' ?></td>
													<td style="text-align:center"><?= isset($key->card_exp_dt) ? date_format(date_create($key->card_exp_dt), "d/m/Y") : '' ?></td>
													<td style="text-align:center"><?= $key->card_limit ?></td>
													<td style="text-align:center"><?= $key->outstanding_bl ?></td>
													<td style="text-align:center"><?= isset($key->outstanding_bl_dt) ? date_format(date_create($key->outstanding_bl_dt), "d/m/Y") : '' ?></td>
												</tr>
											<?php endforeach ?>
											<tr>
												<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding :</td>
												<td style="font-weight: bold;text-align:center"><?= isset($result->outstanding_bl) ? $result->outstanding_bl : '' ?></td>
												<td style="font-weight: bold;text-align:center"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					<?php endif ?>
				<?php endif ?>
			</table>
			<table align="center" style="font-size:15px !important;margin-bottom:20px !important" border="0" cellspacing="0" cellpadding="2">
				<tr align="center">
					<td style="border:0px; vertical-align:top;">
						<br />
						&nbsp;&nbsp;&nbsp;
						<input type="button" value="Recommend" id="sendButton" onclick="delete_action('recommend')" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
						<input type="button" value="Decline" id="decline_button" onclick="delete_action('reject')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
						<input type="button" value="Return" id="sendToMakerButton" onclick="delete_action('return')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" /> <span id="loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span><br />
						<br /><br />
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div id="sendToCheckerMessageDialogContent" style="display:none;">
		<div class="hd">
			<h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2>
		</div>
		<form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform" style="margin-top:0px;">
			<input name="type" id="type" value="" type="hidden">
			<input name="success_message" id="success_message" value="" type="hidden">
			<input type="hidden" id="deleteEventId" name="deleteEventId" value="<?= $result->id; ?>" />
			<div class="bd">
				<div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
				<div class="instrText" style="margin-bottom: 20px"></div>
				<div class="instrText" style="margin-bottom: 20px" id="reason_messge_body">
					<span id="reason_messagae"></span> Reason <span style="color: red;">*</span> <br><textarea name="reason" id="reason" cols="50"></textarea><br><br>
					<!-- Notify By:&nbsp;&nbsp; -->
					<!-- <label>
              		<input type="checkbox" name="email_notification" id="email_notification" value=""> Email
              	</label> -->
				</div>
			</div>
			<a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a>
			<a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a>
			<span id="loadingReturn" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
		</form>
	</div>
	<div id="r_history" style="visibility:hidden;">
		<div style="padding-left: 17px"><strong>Return/Reject History</strong></div>
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
				<tfoot>
					<tr>
						<td colspan="5" align="center"><input type="button" class="button1" id="r_ok" value="Close" /></td>
					</tr>
				</tfoot>
			</table>
			<br>
		</div>
	</div>