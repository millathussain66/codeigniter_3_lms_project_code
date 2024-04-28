<script language="javascript" type="text/javascript">
    var theme = getDemoTheme();

    var ac_type = ["Investment", "Card"];
    var acLength = <?php echo $acLength; ?>;
    jQuery(document).ready(function() {


        jQuery("#ac_type").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select A/C Type",
            source: ac_type,
            dropDownHeight: 80,
            width: '250px',
            height: 25
        });

        jQuery("#ac_type").jqxComboBox('val', '<?php echo $result->ac_type ?>');

        var isInvestment = '<?php echo $result->ac_type ?>';


        jQuery('#ac_type').bind('change', function(event) {
            var item = jQuery("#ac_type").jqxComboBox('getSelectedItem');
            isInvestment = item.value;
        });



        var rules2 = [

            {
                input: '#ac_type',
                message: 'required!',
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (jQuery("#ac_type").val() == '') {
                        jQuery("#ac_type").focus();
                        return false;
                    } else {
                        return true;
                    }
                }
            },


            {
                input: '#cif_no',
                message: 'required!',
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (jQuery("#cif_no").val() == '') {
                        jQuery("#cif_no").focus();
                        return false;
                    } else {
                        return true;
                    }
                }
            },


            {
                input: '#account_name',
                message: 'required!',
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (jQuery("#account_name").val() == '') {
                        jQuery("#account_name").focus();
                        return false;
                    } else {
                        return true;
                    }
                }
            },
            {
                input: '#investment_ac',
                message: 'Required',
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
                input: '#investment_ac',
                message: 'only numeric',
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (isInvestment == "Investment") {
                        if (input.val() != '') {
                            if (!checknumber_alphabaticwithstar('investment_ac')) {
                                jQuery("#investment_ac").focus();
                                return false;

                            }
                        }
                        return true;
                    } else {
                        return true;
                    }


                }
            }, {
                input: '#investment_ac',
                message: 'must be ' + acLength.join(" or ") + " Digits",
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (isInvestment == "Investment") {
                        if (input.val() != '') {

                            if (jQuery.inArray(String(input.val().length), acLength) != -1) {
                                return true;
                            } else {
                                return false;
                            }

                        }
                        return true;
                    } else {
                        return true;
                    }


                }
            }

        ];




        var theme = 'classic';


        jQuery("#in_req_button").click(function() {
            jQuery('#update_form_data').jqxValidator({
                rules: rules2,
                theme: theme
            });
            var validationResult = function(isValid) {
                if (isValid) {
                    jQuery("#in_up_button").hide();
                    jQuery("#in_req_loading").show();
                    update_data();
                }
            }

            jQuery('#update_form_data').jqxValidator('validate', validationResult);

        });


    });


    function update_data() {


        var id = jQuery("#edit_id").val();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postData = jQuery('#update_form_data').serialize() + "&" + csrfName + "=" + csrfHash;

        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?= base_url() ?>Approval_list/add_edit_action_indevisual",
            data: postData,
            datatype: "json",
            async: false,
            success: function(response) {
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);

                if (json.Message != 'OK') {

                    alert(json.Message);
                    return false

                }
                window.parent.jQuery("#error").show();
                window.parent.jQuery("#error").fadeOut(11500);
                window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Update');
                window.top.EOL.messageBoard.close();
                // window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');



            }
        });


    }



    function mask(str, textbox) {
        var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
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
                    jQuery("#hidden_loan_ac_grid").val(str);
                } else //For single value enter
                {
                    //For New value
                    var orginal_loan_ac = jQuery("#hidden_loan_ac_grid").val();
                    if (orginal_loan_ac.length < str.length) {
                        var index = str.length - 1;
                        var new_val = str.slice(index);
                        orginal_loan_ac += new_val;
                        //alert(orginal_loan_ac);
                        jQuery("#hidden_loan_ac_grid").val(orginal_loan_ac);
                    }
                    //For delete key
                    else {
                        var len = str.length;
                        var new_val = orginal_loan_ac.slice(0, len);
                        jQuery("#hidden_loan_ac_grid").val(new_val);
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
                        if (letter_Count < 6 || jQuery("#hidden_loan_ac_grid").val().length != 16) {
                            textbox.value = '';
                            jQuery("#hidden_loan_ac_grid").val('');
                            alert('Wrong way to input Card No please try again');
                        }
                    }
                }
            }
        }

    }
</script>

<div id="container" style="">
    <div id="body">

        <div class="form">
            <div class="formHeader" style="background-color:#185891;">Approval List Edit</div>
        </div>

        <div style="width:96%;margin: auto;paddding: 10px;">

            <form class="form" name="update_form_data" id="update_form_data" method="post" action="<?= base_url() ?>index.php/recovery_af_fill/add_edit_action/<?= $add_edit ?>/<?= $id ?>" enctype="multipart/form-data">

                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                <input type="hidden" id="add_edit" value="<?= $add_edit ?>" name="add_edit">
                <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">

                <input type="hidden" id="edit_id" value="<?= $result->id ?>" name="edit_id">

                <table style="width:50%" id="tab1Table">
                    <tbody>
                        <tr>
                            <td colspan="2">


                                <table style="width: 100%;">

                                    <tr>
                                        <td width="20%" style="font-weight: bold;"> A/C Type.<span style="color:red">*</span> </td>


                                        <td width="30%">

                                            <div id="ac_type" name="ac_type"></div>

                                        </td>


                                    </tr>

                                    <?php

                                    if ($result->ac_type == "Investment") {

                                        $decrypt_ac = str_replace(' ', '', $result->investment_ac);
                                    } else {
                                        $decrypt_ac = $this->Common_model->stringEncryption('decrypt', str_replace(' ', '', $result->org_loan_ac));
                                    }

                                    ?>

                                    <tr>
                                        <td width="20%" style="font-weight: bold;"> A/C Number.<span style="color:red">*</span> </td>
                                        <td width="30%"><input type="text" style="width:248px" id="investment_ac" name="investment_ac" value="<?= isset($decrypt_ac) ? $decrypt_ac : '' ?>"></td>
                                    </tr>



                                    <tr>
                                        <td width="20%" style="font-weight: bold;">CID No:<span style="color:red">*</span> </td>
                                        <td width="30%"><input type="text" style="width:248px" id="cif_no" name="cif_no" value="<?= isset($result->cif_no) ? $result->cif_no : '' ?>"></td>
                                    </tr>

                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Account Name:<span style="color:red">*</span> </td>
                                        <td width="30%"><input type="text" style="width:248px" id="account_name" name="account_name" value="<?= isset($result->account_name) ? $result->account_name : '' ?>"></td>

                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Expire Date: </td>
                                        <td width="30%"><input type="text" style="width:248px" id="case_file_expiry_date" name="case_file_expiry_date" value="<?php if (isset($result->case_file_expiry_date)) {
                                                                                                                                                                    echo  date('d/m/Y', strtotime($result->case_file_expiry_date));
                                                                                                                                                                } ?>
                                        "></td>
                                        <script type="text/javascript">
                                            datePicker("case_file_expiry_date");
                                        </script>
                                    </tr>





                                </table>
                            </td>
                        </tr>


                    </tbody>
                </table>


                <div style="text-align:left;  margin-left: 217px;">
                    <input type="button" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" value="Update" id="in_req_button" class="" /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                </div>

            </form>
        </div>

    </div>
</div>