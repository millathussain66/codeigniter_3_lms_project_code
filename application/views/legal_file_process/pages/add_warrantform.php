<script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>
<style>
    .slider_heading {
        padding: 3px !important;
        background-color: rgb(0, 114, 188) !important;
        background-image: linear-gradient(141deg, #436e05 0%, #00c40ccc 51%, #1c6e05 75%) !important;
        border: solid transparent;
    }

    .container {
        width: 94%;
        /* Set the width of the container */
        margin: 0 auto;
        /* Center the container horizontally */
        padding: 20px;
        /* Add some padding inside the container */
        background-color: #f0f0f0;
        /* Set a background color */
        border: 1px solid #ccc;
        /* Add a border around the container */
        border-radius: 5px;
        /* Add rounded corners */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Add a subtle box shadow */
        margin-top: 1rem;
    }

    /* Reset default table styles */
    .form-table {
        border-collapse: collapse;
        width: 100%;
    }

    .form-table td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    /* Style labels */
    .form-table label {
        font-weight: bold;
    }

    /* Style input fields */
    .form-table input[type="text"],
    .form-table input[type="email"],
    .form-table textarea {
        width: 100%;
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        /* Ensure padding doesn't affect the width */
    }

    /* Style submit button */
    .form-table button[type="submit"] {
        padding: 8px 16px;
        background-color: #4caf50;
    }

    .save_button {
        /* Define your styles here */
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 5px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 10px;
    }
</style>



<script type="text/javascript">
    var csrf_token = '';
    var theme = getDemoTheme();

    jQuery(document).ready(function() {
        jQuery("#certificate_receipt_date2").val('<?= $row->certificate_receipt_date2 != '00/00/0000' ? $row->certificate_receipt_date2 : '' ?>');
    });

    function call_ajax_submit() {
        var postData = jQuery('#form').serialize();
        jQuery.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: '<?= base_url() ?>index.php/legal_file_process/add_edit_action2',
            data: postData,
            datatype: "json",
            success: function(response) {
                var json = jQuery.parseJSON(response);
                window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if (json.Message != 'OK') {
                    alert(json.Message);
                    window.top.EOL.messageBoard.close();
                } else {
                    window.parent.jQuery("#error").show();
                    window.parent.jQuery("#error").fadeOut(11500);
                    window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Update');
                    window.top.EOL.messageBoard.close();
                }
            }
        });
    }
    function CustomerPickList(module_name = null, data_field_name = null) {
        if (jQuery("#add_edit").val() == 'edit') {
            if (jQuery("#file_delete_value_" + data_field_name).val() == 0) {
                alert('Please Delete Previous file for new upload');
                return false;
            }
        }
        newwindow = window.open("<?= base_url() ?>index.php/home/ajaxFileUpload/" + module_name + '/' + data_field_name, "Upload", "width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340");
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }
    function delete_row_generate(row_id) {
        jQuery('#generate_info_' + row_id).hide();
        jQuery('#generate_info_delete_' + row_id).val(1);
    }

    function file_delete(id) {
        if (confirm('Are you sure to Delete previous file?')) {
            jQuery("#file_preview_" + id).hide();
            jQuery("#file_delete_" + id).hide();
            jQuery("#file_delete_value_" + id).val(1);
        }
    }
</script>

<body>
    <div class="slider_heading" style="height:30px;font-size:22px;padding:5px 0 0 10px;color:white">
        <strong>Add Warrant Form</strong>
    </div>
    <div class="container">
        <form name="form" id="form" class="form" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input type="hidden" name="add_edit" id="add_edit" value="<?php echo (count($row_generate) != 0) ? 'edit' : 'add'; ?>">
            <input type="hidden" name="edit_row" id="edit_row" value="<?= $id ?>">
            <table class="form-table">
                <tr>
                    <td style="width: 40rem;"><label for="customer_name">Customer/Institution/Company Name:</label></td>
                    <td><strong><?= $row->ac_name ?></strong></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="proprietor_info2">Name of Defendant/Proprietor:</label></td>
                    <td><textarea id="proprietor_info2" name="proprietor_info2"><?= $row->proprietor_info2 ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="customer_info2">Mobile number or phone number of the accused/his father/his mother/his wife/next of kin:</label></td>
                    <td><textarea id="customer_info2" name="customer_info2"><?= $row->customer_info2 ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="customer_info_details2">Names of father and mother of accused:</label></td>
                    <td><textarea id="customer_info_details2" name="customer_info_details2"><?= $row->customer_info_details2 ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="lawyer_info2">Names and addresses of the accused's spouse and children (if applicable):</label></td>
                    <td><textarea id="lawyer_info2" name="lawyer_info2"><?= htmlspecialchars($row->lawyer_info2) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="decree_info2">Names and addresses of the defendant's siblings (if applicable):</label></td>
                    <td><textarea id="decree_info2" name="decree_info2"><?= htmlspecialchars($row->decree_info2) ?></textarea></td>
                </tr>

                <tr>
                    <td style="width: 40rem;"><label for="defendant_current_address">Defendant's current address:</label></td>
                    <td><textarea id="defendant_current_address" name="defendant_current_address"><?= htmlspecialchars($row->defendant_current_address) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="permanent_address_oftheaccused">Permanent address of the accused:</label></td>
                    <td><textarea id="permanent_address_oftheaccused" name="permanent_address_oftheaccused"><?= htmlspecialchars($row->permanent_address_oftheaccused) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="dusiness_address_of_defendant">Business address of defendant:</label></td>
                    <td><textarea id="dusiness_address_of_defendant" name="dusiness_address_of_defendant"><?= htmlspecialchars($row->dusiness_address_of_defendant) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="adjustment_info2">Defendant's Current Location (Probable):</label></td>
                    <td><textarea id="adjustment_info2" name="adjustment_info2"><?= htmlspecialchars($row->adjustment_info2) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="certificate_receipt_date2">Number and date of money issue case:</label></td>
                    <td>
                        <input style="width:250px" name="certificate_receipt_date2" id="certificate_receipt_date2" type="text" class="text-input" placeholder="dd/mm/yyyy">
                        <script type="text/javascript">
                            datePicker("certificate_receipt_date2");
                        </script>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="suit_value_judgment2">Details of Suit Value and Judgment of Arthazari Cases:</label></td>
                    <td><textarea id="suit_value_judgment2" name="suit_value_judgment2"><?= htmlspecialchars($row->suit_value_judgment2) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="ni_act_cases2">N.I. Act case numbers and dates:</label></td>
                    <td><textarea id="ni_act_cases2" name="ni_act_cases2"><?= htmlspecialchars($row->ni_act_cases2) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="bank_liability_suit_value">Amount of bank liability and total suit value of the case:</label></td>
                    <td><textarea id="bank_liability_suit_value" name="bank_liability_suit_value"><?= htmlspecialchars($row->bank_liability_suit_value) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="judgment_details2">Details of judgment in the case:</label></td>
                    <td><textarea id="judgment_details2" name="judgment_details2"><?= htmlspecialchars($row->judgment_details2) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="warrant_of_arrest_date2">Date of warrant of arrest issued by judicial court:</label></td>
                    <td><textarea id="warrant_of_arrest_date2" name="warrant_of_arrest_date2"><?= htmlspecialchars($row->warrant_of_arrest_date2) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="arrest_warrant_status2">Latest status of arrest warrant issued by court:</label></td>
                    <td><textarea id="arrest_warrant_status2" name="arrest_warrant_status2"><?= htmlspecialchars($row->arrest_warrant_status2) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="action_after_arrest_warrant2">Details of the action taken by the branch after receipt of the warrant of arrest and the rationale for not being able to arrest the accused:</label></td>
                    <td><textarea id="action_after_arrest_warrant2" name="action_after_arrest_warrant2"><?= htmlspecialchars($row->action_after_arrest_warrant2) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="return_without_arrest">Date of return without issue of warrant of arrest and details whether re-issued or not:</label></td>
                    <td><textarea id="return_without_arrest" name="return_without_arrest"><?= htmlspecialchars($row->return_without_arrest) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="latest_action_statement">Statement of the Branch on the latest action and action taken regarding the arrest of the accused:</label></td>
                    <td><textarea id="latest_action_statement" name="latest_action_statement"><?= htmlspecialchars($row->latest_action_statement) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="special_remarks">Special Remarks (if any):</label></td>
                    <td><textarea id="special_remarks" name="special_remarks"><?= htmlspecialchars($row->special_remarks) ?></textarea></td>
                </tr>
                <tr>
                    <td style="width: 40rem;"><label for="actions_suggestions">Actions and suggestions taken by WEC, LAD at Head Office:</label></td>
                    <td><textarea id="actions_suggestions" name="actions_suggestions"><?= htmlspecialchars($row->actions_suggestions) ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"> <button type="button" onclick="call_ajax_submit();" class="save_button">Save</button> </td>
                </tr>
            </table>
        </form>
    </div>
</body>









