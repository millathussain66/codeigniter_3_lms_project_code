<style type="text/css">
    #details {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
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

    #button_center {
        text-align: center;
    }
</style>
<script language="javascript" type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
    });
</script>
<style type="text/css">
    th {
        border-color: #ccc;
    }
</style>


<? if ($option == 'upload_recovery') { ?>




    <script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>
    <script type="text/javascript">
        function fileValidation(name) {
            //alert(name);
            var fileInput = document.getElementById(name);
            var filePath = fileInput.value;
            var allowedExtensions = /(\.xlsx)$/i;
            var fileSize = document.getElementById(name).files[0].size;
            if (!allowedExtensions.exec(filePath)) {
                alert('Only xls file is allowed');
                fileInput.value = '';
                return false;
            }
            return true;
        }

        function delete_action_data(type) {
            var message = '';
            if (type == 'save_recovery') {
                jQuery("#type").val(type);
                jQuery("#message").html('Save');
                jQuery("#button_tag").html('Save');
                jQuery("#success_message").val('Saved');
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
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = $('result_form').toQueryString() + "&" + csrfName + "=" + csrfHash;
            $('sendToCheckerMessageDialogConfirm').style.display = 'none';
            $('sendToCheckerMessageDialogCancel').style.display = 'none';
            $('loadingReturn').style.display = 'inline';
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?= base_url() ?>index.php/Approval_list/delete_action_data/',
                data: postData,
                datatype: "json",
                success: function(response) {
                    ///console.log(response);
                    var json = jQuery.parseJSON(response);

                    console.log(json.str);



                    window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if (json.Message != 'OK') {
                        alert(json.Message);
                    } else {
                        jQuery('#result_table').html('');
                        jQuery("#select_tag").show();
                        jQuery("#recovery_file").show();
                        jQuery("#save_button").hide();
                        jQuery("#load_button").show();
                        sendToCheckerMessageDialog.hide();
                        $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                        $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                        $('loadingReturn').style.display = 'none';
                        jQuery("#save").hide();
                        jQuery("#error").show();
                        jQuery("#error").fadeOut(11500);
                        jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + jQuery("#success_message").val());
                    }
                }
            });

        }



        function validation_form() {
            var theme = getDemoTheme();
            rules = [

                {
                    input: '#apv_date',
                    message: 'Invalid',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (!input.val()) {
                            return true;
                        }
                        if (validate_date(input.val())) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                },

                {
                    input: '#apv_date',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#apv_date").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='apv_date']").val(item.value);
                            }
                            return true;
                        } else {
                            if (jQuery("#new_next_date").val() != '') {
                                jQuery("#apv_date input").focus();
                                return false;
                            }
                            return true;
                        }
                    }
                },


                {
                    input: '#apv_ref_no',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#apv_ref_no").val() == '') {
                            jQuery("#apv_ref_no").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },
            ];
            jQuery('#result_form').jqxValidator({
                rules: rules,
                theme: theme
            });
            var validationResult = function(isValid) {
                if (isValid) {
                    submit_toInsert();
                } else {
                    return false;
                }
            }
            jQuery('#result_form').jqxValidator('validate', validationResult);
        }

        function submit_toInsert() {


            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash

            var postData = $('result_form').toQueryString() + "&" + csrfName + "=" + csrfHash;


            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?= base_url() ?>index.php/Approval_list/add_edit_action/',
                data: postData,
                datatype: "json",
                success: function(response) {
                    ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if (json.Message != 'OK') {
                        alert(json.Message);
                    } else {

                        jQuery("#save_button").hide();
                        jQuery("#send_loading").show();


                        window.parent.jQuery("#error").show();
                        window.parent.jQuery("#error").fadeOut(11500);
                        window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp; Data Save Successfully');
                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                        // sendToCheckerMessageDialog.hide();
                        // jQuery("#error").show();
                        // jQuery("#error").fadeOut(11500);
                        // jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+jQuery("#success_message").val());
                    }
                }
            });

        }
    </script>
    <div id="container" style="">
        <div id="body">

            <div class="form">
                <div class="formHeader" style="background-color:#185891;">Approval List</div>
            </div>


            <div style="display:block; height:auto ; margin-top:1rem;margin-left: 10px;">

                <form method="POST" name="form" id="form" style="margin:0px;" action="<?= base_url() ?>Approval_list/recovery_upload" enctype="multipart/form-data">
                    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <div style="padding: 0.5%;width:98%;height:55px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%;margin-top:-2px">
                            <tr>

                                <td style="text-align:left;width:1%">
                                    <strong id="select_tag">Select File : </strong><input type="file" name="recovery_file" id="recovery_file" onchange="fileValidation('recovery_file')">



                                    <input type="button" value="Load" id="load_button" class="buttonsendtochecker" />

                                    <input type="button" value="Save" class="" id="save_button" onclick="delete_action('save_recovery')" class="buttonclose" style="width:70px !important;height:40px;display:none" />
                                    <span id="recovery_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                </td>


                                <td style="text-align:left;width:3%">
                                    <strong>Download Templete File : </strong> <a id="inXLadfc" style="margin-left:10px;text-align:center;cursor:pointer;" href="<?= base_url() ?>Approval_list/Recovery_Data_Templete" target="_blank"><img align="center" src="<?= base_url() ?>images/downloading_updates-26.png"></a>
                                </td>


                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <form class="form" id="result_form" name="result_form" method="post" action="" enctype="">
        <input name="type" id="type" value="" type="hidden">
        <span id="result_table"></span>
    </form>



    <div id="sendToCheckerMessageDialogContent" style="display:none;">
        <div class="hd">
            <h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2>
        </div>
        <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform" style="margin-top:0px;">
            <input name="success_message" id="success_message" value="" type="hidden">
            <div class="bd">
                <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
                <div class="instrText" style="margin-bottom: 20px"></div>
            </div>
            <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a>
            <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a>
            <span id="loadingReturn" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
        </form>
    </div>
    <script type="text/javascript">
        var options = {
            complete: function(response) {

                jQuery("#recovery_file").val('');
                var json = jQuery.parseJSON(response.responseText);

                jQuery('.txt_csrfname').val(json.csrf_token);
                if (json.Message != 'OK') {
                    jQuery("#load_button").show();
                    jQuery("#recovery_loading").hide();
                    alert('Something Went Wrong Please Try Again');
                    return false;
                } else {
                    jQuery("#load_button").show();
                    jQuery("#recovery_loading").hide();


                    jQuery('#result_table').html(json.str);


                    if (jQuery("#total_number_of_error").val() == "0") {
                        jQuery("#save_button").show();
                    } else {
                        jQuery("#save_button").hide();
                    }
                }

            }
        };
        jQuery("#form").ajaxForm(options);
        jQuery("#load_button").click(function() {
            if (jQuery("#recovery_file").val() == '') {
                alert('Please Select A file');
                return false;
            } else {
                jQuery("#load_button").hide();
                jQuery("#recovery_loading").show();
                jQuery("#form").submit();
            }
        });
    </script>

<?php } else {
} ?>