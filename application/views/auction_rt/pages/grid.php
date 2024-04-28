<?php
$zone = $this->user_model->get_parameter_data('ref_zone', 'name', "data_status = '1'");
$district = array();
?>


<script type="text/javascript">
    jQuery().ready(function() {
        jQuery('#zone').bind('change', function(event) {
            change_dropdown('zone');
        });
        jQuery('#district').bind('change', function(event) {
            change_dropdown('district');
        });
        var zone = [{
            value: '0',
            label: 'All zone'
        }, <? $i = 1;
            foreach ($zone as $row) {
                if ($i != 1) {
                    echo ',';
                }
                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                $i++;
            } ?>];
        jQuery("#zone").jqxComboBox({
            theme: theme,
            promptText: "Select Zone",
            selectedIndex: 0,
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
        var status = [{
            value: '0',
            label: 'All Status'
        }, <? $i = 1;
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
            selectedIndex: 0,
            source: status,
            width: '97%',
            height: 21
        });

        var limit = [{
            value: '100',
            label: '100'
        }, {
            value: '200',
            label: '200'
        }, {
            value: '300',
            label: '300'
        }, {
            value: '400',
            label: '400'
        }, {
            value: '500',
            label: '500'
        }];
        jQuery("#limit").jqxComboBox({
            theme: theme,
            promptText: "Limit",
            selectedIndex: 0,
            source: limit,
            width: '97%',
            height: 21
        });

        <? if ($post_sts == '1') { ?>


            jQuery("#zone").jqxComboBox('val', '<?= (isset($zone_id)) ? $zone_id : '' ?>');

            jQuery("#district").jqxComboBox('val', '<?= (isset($district_id) && $district_id != 0) ? $district_id : '' ?>');
            jQuery("#status").jqxComboBox('val', '<?= (isset($status_id)) ? $status_id : '' ?>');

            jQuery("#limit").jqxComboBox('val', '<?= (isset($limit)) ? $limit : '' ?>');
        <? } ?>


        jQuery('#zone,#district,#status,#limit').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#report_list').bind('change', function() {
            var val = jQuery('#report_list').val();
            if (val == '0') {
                return false;
            }
            var url = "<?= base_url() ?>index.php/" + val + "/<?= $menu_group ?>/<?= $menu_cat ?>";
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });

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
                jQuery('.txt_csrfname').val(json.csrf_token);
                var str = '';
                var theme = getDemoTheme();
                if (operation=='zone') 
                    {
                        var district = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            district.push({ value: obj.id, label: obj.name });
                        });
                        jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: '97%', height: 21});
                        //For edit action
                        if (edit!=null) 
                        {
                            jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
                        }
                    }

            },
            error: function(model, xhr, options) {
                alert('failed');
            },
        });

        return false;
    }

    function popup(url) {

        var heightReduc = 100;
        var widthReduce = 140;

        var pwidth = screen.width - 140;
        var pheight = screen.height - 100;
        var wint = 140 / 2;
        var winl = 100 / 2;

        newwindow = window.open(url, 'name', "height=" + pheight + ", width=" + pwidth + ",top=" + wint + ", toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left=" + winl);
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }
</script>



<? if ($option == 'daily_report') { ?>
    <script language="javascript" type="text/javascript">
        jQuery().ready(function() {
            var FromDate = jQuery("#FromDate").val();
            var ToDate = jQuery("#ToDate").val();
            var FromDate = FromDate.replace(/\//g, '-');
            var ToDate = ToDate.replace(/\//g, '-');
            var zone_id = jQuery("#zone_id").val();
            var status_id = jQuery("#status_id").val();
            jQuery('#inXLadfc').attr('href', '<?= base_url() ?>index.php/auction_rt/mk_xl_daily_report/' + FromDate + '/' + ToDate + '/' + status_id + '/' + zone_id);
            jQuery("#daily_report_search").submit(function() {
                var FromDate = jQuery("#FromDate").val().trim();
                var ToDate = jQuery("#ToDate").val().trim();

                if (FromDate == '') {
                    alert('Please enter From Date');
                    jQuery("#FromDate").focus();
                    return false;
                }
                if (ToDate == '') {
                    alert('Please enter To Date');
                    jQuery("#ToDate").focus();
                    return false;
                }
            });
        });
    </script>
    <style type="text/css">
        th {
            border-color: #ccc;
        }
    </style>
    <div style="display:block; height:auto">
        <form method="POST" name="form" id="daily_report_search" style="margin:0px;" action="<?= base_url() ?>index.php/auction_rt/daily_report/<?= $menu_group ?>/<?= $menu_cat ?>">
            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div style="padding: 0.5%;width:98%;height:60px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                <table id="deal_body" style="display:block;width:100%">
                    <tr>

                        <td style="text-align:right;width:4%"><strong>Zone&nbsp;&nbsp;</strong> </td>
                        <td style="width:13%">
                            <div style="padding-left:1.8%" id="zone" name="zone_id"></div>
                        </td>
                        <td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
                        <td style="width:13%">
                            <div style="padding-left:1.8%" id="district" name="district"></div>
                        </td>

                        <td style="text-align:right;width:4%"><strong>Limit&nbsp;&nbsp;</strong> </td>
                        <td style="width:10%">
                            <div style="padding-left:1.8%" id="limit" name="limit"></div>
                        </td>
                        <td style="width:2%"></td>

                    </tr>
                </table>
                <?php $colarr = array('SL No.', 'Loan A/C No.', 'Loan A/C Name', 'Auction Team Remarks', 'Classifications', 'Paper Vendor', 'Paper Name', 'Paper Date', 'Auction Date', 'Auction Time', 'Auction Address', 'Paper Remarks', 'Legal Checker', 'Legal Ack by', 'Legal Ack Date', 'Lawyer', 'Legal Notice Serve Date', 'Legal Notice Expiry Date', 'Legal Response', 'Legal Response Date', 'Auction Remarks', 'Auction Complete', 'Auction Complete Date', 'Auction Status'); ?>
                <table id="deal_body" style="display:block;width:100%">
                    <tr>
                        <td style="text-align:right;width:5%"><strong>Status&nbsp;&nbsp;</strong> </td>
                        <td style="width:15%">
                            <div style="padding-left:1.8%" id="status" name="status_id"></div>
                        </td>
                        <td style="text-align:right;width:5%"><strong>Init. Date:&nbsp;&nbsp;</strong> </td>
                        <td style="width:15%"><input id="FromDate" name="FromDate" value="<?= $FromDate ?>" style="width:40%" />
                            <script type="text/javascript">
                                datePicker("FromDate");
                            </script>
                            <strong>To</strong> <input id="ToDate" name="ToDate" value="<?= $ToDate ?>" style="width:40%" />
                            <script type="text/javascript">
                                datePicker("ToDate");
                            </script>
                        </td>
                        <td style="width:5%">
                            <div style="padding-left:1.8%"><strong>Column&nbsp;&nbsp;</strong></div>
                        </td>
                        <td style="width:15%">
                            <div style="padding-left:1.8%">
                                <select id="col_xl" tabindex="16" name="col_xl[]" multiple="multiple" style="width:250px">
                                    <?php foreach ($colarr as $key => $val) { ?>
                                        <option <?php if (!empty($col_xl)) {
                                                    if (in_array($key, $col_xl)) {
                                                        echo 'selected';
                                                    }
                                                } else {
                                                    echo 'selected';
                                                } ?> value="<?= $key ?>"><?= $val ?></option>
                                    <?php } ?>

                                </select>
                                <script>
                                    jQuery('#col_xl').multipleSelect({
                                        placeholder: "Select Column for Excel Export"
                                    });
                                </script>
                            </div>
                        </td>
                        <td style="text-align:right;width:5%"><input name="post_sts" id="post_sts" class="crmbutton small create" value="Search Now" type="submit">
                        </td>
                        <td style="width:2%" valign="top">
                            <?php if (count($result) > 0 && !empty($col_xl)) { ?>
                                <button type="submit" formtarget="_blank" name="xlsts"><img width="20px" height="20px" align="center" src="<?= base_url() ?>images/icon_xls.gif"></button>
                                <!--a id="inXLadfc" style="text-align:center;cursor:pointer;" target="_blank" ><img width="20px" height="20px" align="center" src="<?= base_url() ?>images/icon_xls.gif"></a-->
                            <?php } ?>

                        </td>

                    </tr>
                </table>
            </div>
            <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>

        </form>
    </div>
    <!--form action="<?= base_url() ?>index.php/auction_rt/daily_report/<?= $menu_group ?>/<?= $menu_cat ?>" style="margin:auto; padding:0; clear:both" id="daily_report_search" method="post">
       <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <table  style="background-color:#CCC" align="center" border="0" cellpadding="1" cellspacing="2" width="98%">
            <tbody>
            <tr>
                <td align="left" nowrap="nowrap" width="25%"><strong>Report Type:</strong>
                    <?= form_dropdown('report_list', $report_list, $report_select, " id=\"report_list\" style=\"width:70%\" "); ?></td>
                
                <td  align="left"  width="30%">
                    <strong> Date :&nbsp;From</strong>
                    
                    <input class="text" name="FromDate" id="FromDate" value="<?= $FromDate ?>" type="text" size="15" />
                    <script type="text/javascript" charset="utf-8">datePicker ("FromDate");</script>

                    &nbsp;&nbsp;To

                    <input class="text" name="ToDate" id="ToDate" value="<?= $ToDate ?>" type="text" size="15" />
                    <script type="text/javascript" charset="utf-8">datePicker ("ToDate");</script>
                    
                </td>
                <td align="left"  width="20%">
                    <strong> zone :&nbsp;</strong> 
                    <select name="zone_id" id="zone_id" onchange="change_branch()">
                            <option value="0">All zone </option>
                        <?php foreach ($zone_data as $zone) { ?>
                            <option <?php echo ($zone->id == $zone_id) ? 'selected="selected"' : ''; ?> value="<?= $zone->id ?>"><?= $zone->name ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td align="left"  width="30%">
                    <strong> Status :&nbsp;</strong> 
                    <select name="status_id" id="status_id">
                            <option value="0">All Status </option>
                        <?php foreach ($status as $sts) { ?>
                            <option <?php echo ($sts->id == $status_id) ? 'selected="selected"' : ''; ?> value="<?= $sts->id ?>"><?= $sts->name ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td nowrap="nowrap" width="10%">
                     <input name="post_sts" id="post_sts" class="crmbutton small create"  value="Search Now" type="submit"></td>
                <td style="text-align: right; padding-right: 10px" valign="top">
                    <?php if (count($result) > 0) { ?>
                        <a id="inXLadfc" style="text-align:center;cursor:pointer;" target="_blank" ><img width="20px" height="20px" align="center" src="<?= base_url() ?>images/icon_xls.gif"></a>
                    <?php } ?>
                    
                </td>
            </tr>
        </tbody>
        </table>
    </form--><br />
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
        <tbody>
            <tr>
                <td width="100%" valign="top" <? if ($post_sts == 1) { ?> style="border:#837E6F 2px inset" <? } ?>>
                    <? if ($post_sts == 1) { ?>
                        <table style="font-size:10pt" width="100%" class="input_box" border="0" cellspacing="0" cellpadding="1" align="center">
                            <tr style="text-align:left; font-weight:bold; background-color: #B8E4F3; border-color: #ccc">
                                <th align="center">Sl</th>
                                <th align="left">Req.Type</th>
                                <th align="left">Proposed Type</th>
                                <th align="left">AC</th>
                                <th align="left">CID</th>
                                <th align="left">AC Name</th>
                                <th align="left">Zone</th>
                                <th align="left">District</th>
                                <th align="left">Status</th>
                                <th align="left">Remarks</th>
                            </tr>
                            <?php if (!empty($result)) : ?>
                                <?php foreach ($result as $key) : ?>
                                    <tr>
                                        <td align="center"><?= $key->sl_no; ?></td>
                                        <td align="left"><?= $key->req_type; ?></td>
                                        <td align="left"><?= $key->proposed_type; ?></td>
                                        <td align="left"><?= $key->loan_ac; ?></td>
                                        <td align="left"><?= $key->cif; ?></td>
                                        <td align="left"><?= $key->ac_name; ?></td>
                                        <td align="left"><?= $key->zone_name; ?></td>
                                        <td align="left"><?= $key->district_name; ?></td>
                                        <td align="left"><?= $key->auction_sts; ?></td>
                                        <td align="left"><?= $key->auction_remarks; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr style="vertical-align:top;">
                                    <td colspan="12" align="center" style="color: #AA0000">No result found !!</td>
                                </tr>
                            <?php endif ?>
                        </table><br /><br /><br />
                    <? } ?>
                </td>
            </tr>
        </tbody>
    </table>

<? } else { ?>

    <!--  <form action="<?= base_url() ?>index.php/other_report/view<?= $menu_group ?>/<?= $menu_cat ?>" style="margin:auto; padding:0; clear:both" id="report_form_search" method="post">
        <table  style="background-color:#CCC" align="center" border="0" cellpadding="1" cellspacing="2" width="98%">
            <tbody>
            <tr>
                <td align="left" nowrap="nowrap" width="30%"><strong>Report Type:</strong>
                    <?= form_dropdown('report_list', $report_list, $report_select, " id=\"report_list\" style=\"width:70%\" "); ?></td>
                <td width="70%">&nbsp;</td>
                
                
            </tr>
        </tbody>
        </table>
    </form><br/>
     -->

<? } ?>