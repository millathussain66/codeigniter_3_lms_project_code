<script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>


<body style="height:96%">
	<style type="text/css">
		.ms-parent {
			width: 320px !important;
		}

		.text-input-big {
			height: 23px !important;
		}

		#sendButton {
			width: 100px;
			height: 30px;
			font-weight: bold;
			font-family: arial;
			cursor: pointer
		}

		.formHeader {
			background-color: #185891;

			height: 40px;
			font-size: 30px;
			color: white;
			padding-left: 28px;
		}

		strong {
			font-weight: bold;
			color: black;
		}

		td {

			width: 350px;
		}

		col:nth-child(even) {
			background-color: red;
		}

		.text-input-big {

			width: 270px;
		}

		input[type=number],

		.clsdt {
			/* background: red; */
			border: 1px solid #DDDDDD;
			border-radius: 2px;
		}

		.tdSpan {
			background-color: red;
			width: 150px;
		}
	</style>

	<script type="text/javascript">
		var branch_sol = [<? $i = 1;
			foreach ($branch_sol as $row) {
				if ($i != 1) {
					echo ',';
				}
				echo '{value:"' . $row->code . '", label:"' . $row->name . ' (' . $row->code . ')"}';
				$i++;
			} ?>];
	jQuery(document).ready(function($) {
		var theme = 'classic';

		jQuery("#branch_name").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Branch Code",
			source: branch_sol,
			width: 270,
			height: 25
		});
		<? if ($add_edit == 'edit') { ?>
			jQuery("#branch_name").jqxComboBox('val', '<?= (isset($result->branch_name) && $result->branch_name != '') ? $result->branch_name : '' ?>');
		<? } ?>
	});	
		
	</script>
	<div style=" width:100%; margin:auto;">
		<div class="formHeader">FMIR<span id="errorBox"></span></div>
		<form action="<?= base_url('fmir/add'); ?>" method="POST" style=" width:50%;margin-top:-10px;" id="fmir_form">


			<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input type="hidden" name="fmir_id" value="<?= $id; ?>">
			<table class="register-table" border="0">

				<tr>
					<td width="10%"><strong>Branch Name</strong><span style="color:#FF0000">*</span></td>
					<td width="30%"><div id="branch_name" name="branch_name" style="padding-left: 3px" tabindex="5"></div></td>



				</tr>


				<tr>

					<td width="9%"><strong>Client Name</strong><span style="color:#FF0000">*</span> </td>
					<td width="28%"><input name="client_name" type="text" id="client_name" class="text-input-big" value="<?= (isset($result->client_name)) ? $result->client_name : ""; ?>" /></td>




				</tr>
				<tr>
					<td width="10%"><strong>Subject</strong><span style="color:#FF0000">*</span></td>
					<td width="30%">

						<textarea name="subject" id="subject" rows="5" style="width: 270px;"><?= (isset($result->subject)) ? $result->subject : ""; ?></textarea>
					</td>



				</tr>
				<tr>

					<td width="9%"><strong>Letter No</strong> <span style="color:#FF0000">*</span></td>
					<td width="28%">
						<input type="text" name="letter_no" id="letter_no" class="text-input-big" value="<?= (isset($result->letter_no)) ? $result->letter_no : ""; ?>" />

					</td>


				</tr>
				<tr>
					<td width="9%"><strong>Letter Date </strong> <span style="color:#FF0000">*</span></td>
					<td width="28%">
						<input id="letter_date" name="letter_date" class="text-input-big clsdt" placeholder="DD/MM/YY" value="<?= (isset($result->l_date)) ? $result->l_date : ""; ?>" />
						<script type="text/javascript">
							datePicker("letter_date");
						</script>

					</td>
				</tr>
				<tr>
					<td width="10%"><strong>Inward No</strong><span style="color:#FF0000">*</span></td>
					<td width="30%"><input name="inward_no" type="text" id="inward_no" class="text-input-big" value="<?= (isset($result->inward_no)) ? $result->inward_no : ""; ?>" /></td>

				</tr>
				<tr>
					<td width="9%"><strong>Inward Date </strong> <span style="color:#FF0000">*</span></td>
					<td width="28%">
						<input id="inward_date" name="inward_date" class="text-input-big clsdt" placeholder="DD/MM/YY" value="<?= (isset($result->inward_date)) ? $result->i_date : ""; ?>" />
						<script type="text/javascript">
							datePicker("inward_date");
						</script>

					</td>
				</tr>


			</table>
			<div colspan="2" style="text-align: center;">
				<br>
				<input type="button" value="Save" class="savebtn" id="saveBtnFmir" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;">
				<span id="send_loading" style="display: none;">Please wait... <img src="<?= base_url(); ?>images/loader.gif" align="bottom"></span>
				<br>
				<br>
				<br>
			</div>
		</form>
	</div>




	<script>
		//form rules
		var theme = getDemoTheme();
		rules = [
			{
				input: '#client_name',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (input.val() == '') {
						jQuery("#client_name").focus();
						return false;
					}
					return true;
				}
			},
			{
				input: '#letter_date',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {


					if (input.val() == '') {
						jQuery("#letter_date").focus();
						return false;
					}
					return true;


				}
			},
			{
				input: '#letter_date',
				message: 'Invalid date!',
				action: 'keyup, blur',
				rule: function(input, commit) {

					if (isValidDate(input.val())) {
						return true;
					} else {
						return false;
					}
				}
			},
			//
			{
				input: '#inward_no',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (input.val() == '') {
						jQuery("#inward_no").focus();
						return false;
					}
					return true;


				}
			},
			{
				input: '#letter_no',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (input.val() == '') {
						jQuery("#letter_no").focus();
						return false;
					}
					return true;


				}
			},
			{
				input: '#inward_date',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (input.val() == '') {
						jQuery("#inward_date").focus();
						return false;
					}
					return true;


				}
			},
			{
				input: '#branch_name',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#branch_name").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='branch_name']").val(item.value);
							return true;
						} else {
							jQuery("#branch_name input").focus();
							return false;
						}
					} else {
						jQuery("#branch_name input").focus();
						return false;
					}
				}
			},
			{
				input: '#inward_date',
				message: 'Invalid date!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (isValidDate(input.val())) {
						return true;
					} else {
						return false;
					}
				}
			},
			//

			{
				input: '#subject',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (input.val() == '') {
						jQuery("#subject").focus();
						return false;
					}
					return true;


				}
			},

		];

		//onClick submit button
		jQuery("#saveBtnFmir").click(function() {
			jQuery('#fmir_form').jqxValidator({
				rules: rules,
				theme: theme
			});
			var validationResult = function(isValid) {
				//if is valid is true then push the data
				if (isValid) {

					jQuery("#saveBtnFmir").hide();
					jQuery("#send_loading").show();
					sendData();
				}
			}
			jQuery('#fmir_form').jqxValidator('validate', validationResult);
		});

		function sendData() {

			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash

			var postData = jQuery('#fmir_form').serialize() + "&" + csrfName + "=" + csrfHash;
			jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?= base_url() ?>fmir/add_edit",
				data: postData,
				datatype: "json",
				beforeSend: function() {
					jQuery("#loading-overlay").show();
				},
				success: function(response) {
					jQuery("#saveBtnFmir").show();
					jQuery("#send_loading").hide();
					response = JSON.parse(response);

					if (response.status == 200) {
						window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
						jQuery("#msgArea").val(response.message);
						window.parent.jQuery("#error").show();
						window.parent.jQuery("#error").fadeOut(11500);
						window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + response.message);
						window.top.EOL.messageBoard.close();
					}
					window.parent.jQuery('.txt_csrfname').val(response.csrf_token);

				}
			});
		}

		//setting up combobox for previous data


		//validator
		function isValidDate(date) {
			var temp = date.split('/');
			var d = new Date(temp[1] + '/' + temp[0] + '/' + temp[2]);
			return (d && (d.getMonth() + 1) == temp[1] && d.getDate() == Number(temp[0]) && d.getFullYear() == Number(temp[2]));
		}
	</script>