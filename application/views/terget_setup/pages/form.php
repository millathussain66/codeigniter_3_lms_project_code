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
</style>




<!-- ui here -->
<div style=" width:100%;">
    <div class="formHeader"><?= ucfirst($add_edit); ?> Terget Setup<span id="errorBox"></span></div>
    <form action="<?= base_url('terget_setup/add_edit'); ?>" method="POST" id="terget_setup_form">


        <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />




        <input type="hidden" name="terget_id" value="<?= $id; ?>">
        <table>
            <tr>
                <td style="padding: 5px;"><strong>Select Year</strong></td>
                <td>
                    <div id="yearDiv" name="year"></div>

                </td>
            </tr>
        </table>

    </form>

    <div style="padding:8px 10px 5px 5px;">
        <div id="search_area">
            <form method="POST" name="form" id="terget_search_form" style="margin:0px;display:none;">

                <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">

                <input type="hidden" id="edit_id" value="<?= $id; ?>" name="edit_id">


                


                <div style="padding-top:8px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                    <table id="deal_body" style="display:block;width:100%">
                        <tr>
                            <td style="text-align:left;"><strong>Req Type&nbsp;&nbsp;</strong> </td>
                            <td style="padding-right:20px;">
                                <div style="padding-left:1.8%" id="req_type" name="req_type"></div>
                            </td>
                            <td style="text-align:left; "><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                            <td style="padding-right:20px;">
                                <div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div>
                            </td>
                            <td style="text-align:left;"><strong>Investment A/C No.</strong></td>
                            <td style="padding-right:20px;"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:120px" id="loan_ac" /></td>
                            <td style="text-align:left;"><strong>Case No.</strong></td>
                            <td style="padding-right:20px;"><input name="case_number" tabindex="" type="text" id="case_number" /></td>

                            <td style="text-align:right;"><input type='button' class="buttonStyle" id='btnSearch' value='Search' style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="text-align:center;margin-top:20px;"><span id="grid_loading" style="display:none"> <img src="<?= base_url() ?>images/ajax-loader.gif" align="bottom"></span></div>
                <div id="searchTable"></div>
                <div style="width:100%;text-align:center;">
                    <br>
                    <input style='display:none;background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' type="button" value="Submit" id="submitTergetSetup" />
                    <span id="send_loading" style="display: none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>


                </div>
            </form>
        </div>
    </div>

</div>

<script>
    //jqxCombobox setting up
    var theme = 'classic';
    var years = [{
            value: "1",
            label: "2023"
        },
        {
            value: "2",
            label: "2024"
        },
        {
            value: "3",
            label: "2025"
        },
        {
            value: "4",
            label: "2026"
        },
        {
            value: "5",
            label: "2027"
        }
    ]

    jQuery("#yearDiv").jqxComboBox({
        theme: theme,
        autoOpen: false,
        autoDropDownHeight: false,
        promptText: "Select Year",
        source: years,
        width: 250,
        height: 25,
        selectedIndex: 0
    });

    var proposed_type = ["Investment", "Card"];
    jQuery("#proposed_type").jqxComboBox({
        theme: theme,
        width: 120,
        autoOpen: false,
        autoDropDownHeight: false,
        promptText: "Proposed Type",
        source: proposed_type,
        height: 25,
        selectedIndex: 0
    });

    var req_type_array = [<?php $i = 1;
                            foreach ($req_type as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];

    jQuery("#req_type").jqxComboBox({
        theme: theme,
        autoOpen: false,
        autoDropDownHeight: false,
        dropDownHeight: 100,
        promptText: "Type Of Case",
        source: req_type_array,
        width: 150,
        height: 30
    });

    //clear combobox if valid dropdown data not inserted
    jQuery("#yearDiv,#req_type,#proposed_type").focusout(function() {
        commbobox_check(jQuery(this).attr('id'));
    });

    jQuery('#yearDiv').on('change', function(event) {
        if (jQuery("#yearDiv").jqxComboBox('getSelectedItem')) {
            jQuery("#terget_search_form").show();
        } else {

            jQuery("#terget_search_form").hide();
        }
        jQuery("#submitTergetSetup").hide();
        jQuery('#searchTable').empty();
    });

    if (jQuery("#yearDiv").jqxComboBox('getSelectedItem')) {
        jQuery("#terget_search_form").show();
    }

    //getting data on Search button clicked
    jQuery("#btnSearch").click(function() {

        var case_number = jQuery('#case_number').val();
        var proposed_type = jQuery("#proposed_type").val();
        var req_type_id = jQuery('#req_type').val();
        var loan_ac = jQuery('#loan_ac').val();

        searchSUit(case_number, proposed_type, req_type_id, loan_ac);
        
        // if (loan_ac != '' || case_number != '') {
        //     searchSUit(case_number, proposed_type, req_type_id, loan_ac);
        // } else {
        //     alert("Enter Searched data first");
        // }


    });

    function searchSUit(case_number = null, proposed_type = null, req_type_id = null, loan_ac = null) {

        jQuery('#searchTable').empty();
        jQuery("#grid_loading").show();
        jQuery("#btnSearch").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: "<?= base_url() ?>terget_setup/search_suit/",
            data: {
                [csrfName]: csrfHash,
                case_number: case_number,
                proposed_type: proposed_type,
                req_type: req_type_id,
                loan_ac: loan_ac,
            },
            datatype: "html",
            success: function(response) {
                var data = JSON.parse(response)
                jQuery('.txt_csrfname').val(data.csrf);
                jQuery("#grid_loading").hide();
                jQuery("#btnSearch").show();

                if (data.rows) {
                    jQuery("#submitTergetSetup").show();
                    setTable(data.rows);
                }


            }
        });

    }

    var checkBoxList = [];

    function setTable(rows) {

        var html = "<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;'><tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td><td style='width:15%;border:1px solid #a0a0a0'><strong>Case Type</strong></td><td style='width:20%;border:1px solid #a0a0a0'><strong>Investment AC</strong></td><td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td><td style='width:10%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>";
        for (var i = 0; i < rows.length; i++) {

            html += "<tr>"
            html += "<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' id='checkboxId_" + rows[i]['id'] + "' name='checkboxId_" + rows[i]['id'] + "'  value='" + rows[i]['id'] + "' /></td>";
            html += "<td style='border:1px solid #a0a0a0'>" + rows[i]['req_type'] + "";
            html += "<input type='hidden' id='id_" + i + "' value='" + rows[i]['id'] + "' /></td>";
            html += "<td style='border:1px solid #a0a0a0'>" + rows[i]['loan_ac'] + "</td>";
            html += "<td style='border:1px solid #a0a0a0'>" + rows[i]['ac_name'] + "</td>";
            html += "<td style='border:1px solid #a0a0a0'>" + rows[i]['case_number'] + "</td>";
            html += "</tr>";

        }
        html += "</table>";

        jQuery('#searchTable').append(html);

        //reason below code is here.is that html appends then there must be method calling
        jQuery('input[type="checkbox"]').change(function() {

            if (jQuery(this).is(':checked')) {
                checkBoxList.push(jQuery(this).val());
            } else {
                splice(checkBoxList, jQuery(this).val());
            }

        });


        //on edit
        if ('<?= $add_edit; ?>' == "edit") {
            var chckList = <?= isset($result->suit_file_ids) ? json_encode($result->suit_file_ids) : 0; ?>;
            if (chckList != 0) {
                chckList = JSON.parse(chckList);
                for (var i = 0; i < chckList.length; i++) {

                    checkBoxList.push(chckList[i]);
                    var chckboxId = "#checkboxId_" + chckList[i];
                    jQuery(chckboxId).prop("checked", true);

                }
            }

        }


    }


    function splice(arr, val) {
        for (var i = arr.length; i--;) {
            if (arr[i] === val) {
                arr.splice(i, 1);
            }
        }
    }


    jQuery("#submitTergetSetup").click(function() {

        if (checkBoxList.length > 0) {
            call_ajax_submit();
        } else {
            alert("Please Select at least one item");
        }
    });

    function call_ajax_submit() {


        jQuery("#submitTergetSetup").hide();
        jQuery("#send_loading").show();

        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();


        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?= base_url() ?>Terget_setup/add_edit",
            data: {
                [csrfName]: csrfHash,
                checkBoxList: JSON.stringify(checkBoxList),
                year: jQuery("#yearDiv").jqxComboBox('getSelectedItem').label,
                action_type: '<?= $add_edit; ?>',
                id: '<?= isset($id) ? $id : ""; ?>'

            },
            datatype: "json",
            async: true,
            success: function(response) {

                jQuery("#submitTergetSetup").show();
                jQuery("#send_loading").hide();

                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json.csrf_token);

                if (json.status != 200) {
                    alert("Operation Failed, Reason: " + json.message);
                } else {

                    window.parent.jQuery("#error").show();
                    window.parent.jQuery("#error").fadeOut(11500);
                    window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + json.message);
                    window.top.EOL.messageBoard.close();
                    window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                    window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                }


            }
        });


    };

    //edit action below here
    if ('<?= $add_edit; ?>' == "edit") {
        jQuery("#yearDiv").jqxComboBox('val', '<?= isset($result->year) ? $result->year : ''; ?>');

        



        jQuery("#yearDiv,#proposed_type,#req_type").jqxComboBox({
            disabled: true
        });
        jQuery("#btnSearch").attr("disabled", true);
        jQuery.when(function() {
            console.log("when");
        }).then(function() {
            console.log("then");
        });
        searchSUit();

    }
</script>