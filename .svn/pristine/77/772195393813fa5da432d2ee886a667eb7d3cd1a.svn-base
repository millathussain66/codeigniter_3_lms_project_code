<?php $this->load->view('css'); $crore=10000000;?>
<style type="text/css">
    #details {
     font-family: Arial, Helvetica, sans-serif;
     border-collapse: collapse;
     width: 100%;
   }
</style>
<script language="javascript" type="text/javascript">
jQuery().ready(function() {
    var theme = 'classic';
    var report_list = [<? $i=1; foreach($report_list as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->url_prefix.'", label:"'.$row->menu_link_name.'"}';$i++;}?>];
    
    jQuery("#report_list").jqxComboBox({theme: theme, promptText: "Select Report", source: report_list, width: '98%', height: 25});
    
    jQuery("#report_list").jqxComboBox('val','<?=$report_select?>');
    jQuery('#report_list').focusout(function() {
        commbobox_check(jQuery(this).attr('id'));
    });

    jQuery('#report_list').bind('change', function () {
        var val = jQuery('#report_list').val();
        if (val == '0' || val=='') {
            return false;
        }
        var url = "<?=base_url()?>"+val+"/<?=$menu_group?>/<?=$menu_cat?>/<?=$menu_link?>/<?=$sub_cat?>";
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
});
function xl_download(){
    var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
    var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
    var postData = jQuery('#report_search').serialize()+"&"+csrfName+"="+csrfHash;
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: '<?=base_url()?>index.php/case_report/mk_xl',
        data : postData,
        datatype: "json",
        success: function(data){
          ///console.log(response);
            var json = jQuery.parseJSON(data);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var a = jQuery("<a>");
            jQuery("body").append(a);
            a.attr("download","Case_Report.xls");
            a.attr("href",json.file);
            a[0].click();
            a.remove();
        }
    });

    
}
</script>
<style type="text/css">
    th{border-color: #ccc;}
</style>

<?php if ($report_select=='case_report/iss_report'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var branch = [<? $i=1; foreach($branch as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var filed_type = [<? $i=1; foreach($filed_type as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var nature_suit = [<? $i=1; foreach($nature_suit as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var year = [<? $i=1; for($y=1990;$y<=date('Y');$y++){  if($i!=1){echo ',';} echo '{value:"'.$y.'", label:"'.$y.'"}';$i++;}?>];
        var months = [{value:"01", label:"January"},{value:"02", label:"February"},{value:"03", label:"March"},{value:"04", label:"April"},{value:"05", label:"May"},{value:"06", label:"June"},{value:"07", label:"July"},{value:"08", label:"August"},{value:"09", label:"September"},{value:"10", label:"October"},{value:"11", label:"November"},{value:"12", label:"December"}];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});
        jQuery("#branch").jqxComboBox({theme: theme, promptText: "Select Branch", source: branch, width: '98%', height: 25});
        jQuery("#filed_type").jqxComboBox({theme: theme, promptText: "Select Filed Type", source: filed_type, width: '98%', height: 25});
        jQuery("#case_sts").jqxComboBox({theme: theme, promptText: "Select Case Status", source: case_sts, width: '98%', height: 25});
        jQuery("#nature_suit").jqxComboBox({theme: theme, promptText: "Select Nature Suit", source: nature_suit, width: '98%', height: 25});
        jQuery("#filing_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#disposal_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#entry_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});
        jQuery("#disposal_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});

        jQuery('#disposal_year,#disposal_month,#district,#zone,#branch,#filed_type,#case_sts,#nature_suit,#filing_year,#entry_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#branch").jqxComboBox('val','<?=$branch_select?>');
        jQuery("#filed_type").jqxComboBox('val','<?=$filed_type_select?>');
        jQuery("#case_sts").jqxComboBox('val','<?=$case_sts_select?>');
        jQuery("#nature_suit").jqxComboBox('val','<?=$nature_suit_select?>');
        jQuery("#filing_year").jqxComboBox('val','<?=$year?>');
        jQuery("#disposal_year").jqxComboBox('val','<?=$disposal_year?>');
        jQuery("#entry_month").jqxComboBox('val','<?=$month?>');
        jQuery("#disposal_month").jqxComboBox('val','<?=$disposal_month?>');
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:60px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:8%"><strong>Report Type:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="text-align:right;width:8%"><strong>Branch:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="branch" name="branch"></div></td>
                                <td style="text-align:right;width:7%"><strong>Filed Type:</strong> </td>
                                <td style="width:11%"><div style="padding-left:1.8%" id="filed_type" name="filed_type"></div></td>
                                <td style="text-align:right;width:8%;"><strong> Disposal Step: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:10%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" type="submit">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;"><strong>district:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;"><strong>Zone:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;"><strong> Filling Year: </strong></td>
                                <td><div style="padding-left:1.8%" id="filing_year" name="filing_year"></div></td>
                                <td style="text-align:right;"> <strong>Case Entry Month: </strong></td>
                                <td><div style="padding-left:1.8%" id="entry_month" name="entry_month"></div></td>
                                <td style="text-align:right;"><strong>Disposal Year:</strong> </td>
                                <td><div style="padding-left:1.8%" id="disposal_year" name="disposal_year"></div></td>
                                <td style="text-align:right;" colspan="2"><div style="padding-left:1.8%" id="disposal_month" name="disposal_month"></div></td>
                            </tr>
                        </table>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <style type="text/css">
        .report_table{
            table-layout: auto;
            border-collapse: collapse;
        }
        .report_table td,.report_table th{
            border: 1px solid #000;
            white-space: nowrap;
            padding: 5px;
        }
    </style>
    <div id="search_details" style="border:1px solid #ddd;">
        <table style="width:100%">
            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="5">ISS Report</td>
                            <td style="text-align:left;font-weight:bold" colspan="3"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Sol Code</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Branch Name</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing Cases (By Bank)</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Suit Value</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Recovery against Ongoing Cases for this accounting year up to the reporting month</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Expenses incurred by the branch against suit cases for this accounting year up to the reporting month</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number of Withdrawn Cases (By Bank) for this accounting year up to the reporting month</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total amount recovered by the branch against disposal cases for this accounting year up to the reporting month</td>
                        </tr>
                        <?php if (!empty($result)): ?>
                            <?php 
                            $total_suit=0;
                            $total_suit_value=0;
                            $total_recovery_ongoing=0;
                            $total_recovery_disposal=0;
                            $total_withdrawl=0;
                            foreach ($result as $key): ?>
                                <?php   
                                $total_suit+=$key->ongoing_cases;
                                $total_suit_value+=$key->ongoing_case_claim_amount;
                                $total_recovery_ongoing+=$key->ongoing_recovery;
                                $total_recovery_disposal+=$key->disposal_recovery;
                                $total_withdrawl+=$key->withdraw_cases;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->branch_sol?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->branch_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_case_claim_amount?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_recovery?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->withdraw_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal_recovery?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_suit?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_suit_value?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_recovery_ongoing?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_withdrawl?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_recovery_disposal?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
<?php endif ?>
<?php if ($report_select=='case_report/br_bb_report'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var branch = [<? $i=1; foreach($branch as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var filed_type = [<? $i=1; foreach($filed_type as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var nature_suit = [<? $i=1; foreach($nature_suit as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var year = [<? $i=1; for($y=1990;$y<=date('Y');$y++){  if($i!=1){echo ',';} echo '{value:"'.$y.'", label:"'.$y.'"}';$i++;}?>];
        var months = [{value:"01", label:"January"},{value:"02", label:"February"},{value:"03", label:"March"},{value:"04", label:"April"},{value:"05", label:"May"},{value:"06", label:"June"},{value:"07", label:"July"},{value:"08", label:"August"},{value:"09", label:"September"},{value:"10", label:"October"},{value:"11", label:"November"},{value:"12", label:"December"}];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});
        jQuery("#branch").jqxComboBox({theme: theme, promptText: "Select Branch", source: branch, width: '98%', height: 25});
        jQuery("#filed_type").jqxComboBox({theme: theme, promptText: "Select Filed Type", source: filed_type, width: '98%', height: 25});
        jQuery("#case_sts").jqxComboBox({theme: theme, promptText: "Select Case Status", source: case_sts, width: '98%', height: 25});
        jQuery("#nature_suit").jqxComboBox({theme: theme, promptText: "Select Nature Suit", source: nature_suit, width: '98%', height: 25});
        jQuery("#filing_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#disposal_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#entry_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});
        jQuery("#disposal_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});

        jQuery('#disposal_year,#disposal_month,#district,#zone,#branch,#filed_type,#case_sts,#nature_suit,#filing_year,#entry_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#branch").jqxComboBox('val','<?=$branch_select?>');
        jQuery("#filed_type").jqxComboBox('val','<?=$filed_type_select?>');
        jQuery("#case_sts").jqxComboBox('val','<?=$case_sts_select?>');
        jQuery("#nature_suit").jqxComboBox('val','<?=$nature_suit_select?>');
        jQuery("#filing_year").jqxComboBox('val','<?=$year?>');
        jQuery("#disposal_year").jqxComboBox('val','<?=$disposal_year?>');
        jQuery("#entry_month").jqxComboBox('val','<?=$month?>');
        jQuery("#disposal_month").jqxComboBox('val','<?=$disposal_month?>');
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:60px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:8%"><strong>Report Type:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="text-align:right;width:8%"><strong>Branch:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="branch" name="branch"></div></td>
                                <td style="text-align:right;width:7%"><strong>Filed Type:</strong> </td>
                                <td style="width:11%"><div style="padding-left:1.8%" id="filed_type" name="filed_type"></div></td>
                                <td style="text-align:right;width:8%;"><strong> Disposal Step: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:10%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" type="submit">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;"><strong>district:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;"><strong>Zone:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;"><strong> Filling Year: </strong></td>
                                <td><div style="padding-left:1.8%" id="filing_year" name="filing_year"></div></td>
                                <td style="text-align:right;"> <strong>Case Entry Month: </strong></td>
                                <td><div style="padding-left:1.8%" id="entry_month" name="entry_month"></div></td>
                                <td style="text-align:right;"><strong>Disposal Year:</strong> </td>
                                <td><div style="padding-left:1.8%" id="disposal_year" name="disposal_year"></div></td>
                                <td style="text-align:right;" colspan="2"><div style="padding-left:1.8%" id="disposal_month" name="disposal_month"></div></td>
                            </tr>
                        </table>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <style type="text/css">
        .report_table{
            table-layout: auto;
            border-collapse: collapse;
        }
        .report_table td,.report_table th{
            border: 1px solid #000;
            white-space: nowrap;
            padding: 5px;
        }
    </style>
    <div id="search_details" style="border:1px solid #ddd;">
        <table style="width:100%">
            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="5">BR4 BB Report</td>
                            <td style="text-align:left;font-weight:bold" colspan="3"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Serial No</td>
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature of Suit</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="3">Total Case Filed</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="3">Total Disposal Cases</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="3">Total Ongoing Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Suit Value</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Recovery</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Suit Value</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Recovery</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Suit Value</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Recovery</td>
                        </tr>
                        <?php if (!empty($result)): ?>
                            <?php 
                            $total1=0;
                            $total2=0;
                            $total3=0;
                            $total4=0;
                            $total5=0;
                            $total6=0;
                            $total7=0;
                            $total8=0;
                            $total_r=0;
                            $total_dr=0;
                            $total_or=0;
                            $sl=0;
                            foreach ($result as $key): ?>
                                <?php 
                                $sl++;  
                                $total1+=$key->total_filed;
                                $total2+=$key->total_filed_amount;
                                $total3+=$key->total_disposal;
                                $total4+=$key->total_disposal_amount;
                                $total_r+=$key->total_recovery;
                                $total6+=$key->total_ongoing;
                                $total7+=$key->total_ongoing_amount;
                                $total_dr+=$key->total_disposal_recovery;
                                $total_or+=$key->total_ongoing_recovery;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$sl?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->nature_of_suit?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_filed?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_filed_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_recovery/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_disposal?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_disposal_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_disposal_recovery/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_ongoing?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_ongoing_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_ongoing_recovery/$crore,2)?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_r/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total3?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total4/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_dr/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total6?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total7/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_or/$crore,2)?></td>
                            </tr>
                        <?php endif ?>
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="5">DBI22; TPSQ Report</td>
                            <td style="text-align:left;font-weight:bold" colspan="3"></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Serial No</td>
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature of Suit</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="3">For upto 5-Years</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="3">For more than 5-Years</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="3">Total Ongoing Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Suit Value</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Recovery</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Suit Value</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Recovery</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Suit Value</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Recovery</td>
                        </tr>
                        <?php if (!empty($result2)): ?>
                            <?php 
                            $total1=0;
                            $total2=0;
                            $total4=0;
                            $total5=0;
                            $total7=0;
                            $total8=0;
                            $total_rec1=0;
                            $total_rec2=0;
                            $total_rec3=0;
                            $sl=0;
                            foreach ($result2 as $key): ?>
                                <?php 
                                $sl++;  
                                $total1+=$key->upto_five_year;
                                $total2+=$key->upto_five_year_amount;
                                $total4+=$key->down_five_year;
                                $total5+=$key->down_five_year_amount;
                                $total7+=$key->total_ongoing;
                                $total8+=$key->total_ongoing_amount;
                                $total_rec1+=$key->down_five_year_recovery;
                                $total_rec2+=$key->upto_five_year_recovery;
                                $total_rec3+=$key->total_ongoing_recovery;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$sl?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->nature_of_suit?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->upto_five_year?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->upto_five_year_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->upto_five_year_recovery/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->down_five_year?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->down_five_year_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->down_five_year_recovery/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_ongoing?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_ongoing_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_ongoing_recovery/$crore,2)?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_rec2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total4?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total5/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_rec1/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total7?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total8/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_rec3/$crore,2)?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
<?php endif ?>

<?php if ($report_select=='case_report/financial_indicator'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var branch = [<? $i=1; foreach($branch as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var filed_type = [<? $i=1; foreach($filed_type as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var nature_suit = [<? $i=1; foreach($nature_suit as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var year = [<? $i=1; for($y=1990;$y<=date('Y');$y++){  if($i!=1){echo ',';} echo '{value:"'.$y.'", label:"'.$y.'"}';$i++;}?>];
        var months = [{value:"01", label:"January"},{value:"02", label:"February"},{value:"03", label:"March"},{value:"04", label:"April"},{value:"05", label:"May"},{value:"06", label:"June"},{value:"07", label:"July"},{value:"08", label:"August"},{value:"09", label:"September"},{value:"10", label:"October"},{value:"11", label:"November"},{value:"12", label:"December"}];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});
        jQuery("#branch").jqxComboBox({theme: theme, promptText: "Select Branch", source: branch, width: '98%', height: 25});
        jQuery("#filed_type").jqxComboBox({theme: theme, promptText: "Select Filed Type", source: filed_type, width: '98%', height: 25});
        jQuery("#case_sts").jqxComboBox({theme: theme, promptText: "Select Case Status", source: case_sts, width: '98%', height: 25});
        jQuery("#nature_suit").jqxComboBox({theme: theme, promptText: "Select Nature Suit", source: nature_suit, width: '98%', height: 25});
        jQuery("#filing_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#disposal_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#entry_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});
        jQuery("#disposal_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});

        jQuery('#disposal_year,#disposal_month,#district,#zone,#branch,#filed_type,#case_sts,#nature_suit,#filing_year,#entry_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#branch").jqxComboBox('val','<?=$branch_select?>');
        jQuery("#filed_type").jqxComboBox('val','<?=$filed_type_select?>');
        jQuery("#case_sts").jqxComboBox('val','<?=$case_sts_select?>');
        jQuery("#nature_suit").jqxComboBox('val','<?=$nature_suit_select?>');
        jQuery("#filing_year").jqxComboBox('val','<?=$year?>');
        jQuery("#disposal_year").jqxComboBox('val','<?=$disposal_year?>');
        jQuery("#entry_month").jqxComboBox('val','<?=$month?>');
        jQuery("#disposal_month").jqxComboBox('val','<?=$disposal_month?>');
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:60px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:8%"><strong>Report Type:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="text-align:right;width:8%"><strong>Branch:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="branch" name="branch"></div></td>
                                <td style="text-align:right;width:7%"><strong>Filed Type:</strong> </td>
                                <td style="width:11%"><div style="padding-left:1.8%" id="filed_type" name="filed_type"></div></td>
                                <td style="text-align:right;width:8%;"><strong> Disposal Step: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:10%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" type="submit">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;"><strong>district:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;"><strong>Zone:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;"><strong> Filling Year: </strong></td>
                                <td><div style="padding-left:1.8%" id="filing_year" name="filing_year"></div></td>
                                <td style="text-align:right;"> <strong>Case Entry Month: </strong></td>
                                <td><div style="padding-left:1.8%" id="entry_month" name="entry_month"></div></td>
                                <td style="text-align:right;"><strong>Disposal Year:</strong> </td>
                                <td><div style="padding-left:1.8%" id="disposal_year" name="disposal_year"></div></td>
                                <td style="text-align:right;" colspan="2"><div style="padding-left:1.8%" id="disposal_month" name="disposal_month"></div></td>
                            </tr>
                        </table>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <style type="text/css">
        .report_table{
            table-layout: auto;
            border-collapse: collapse;
        }
        .report_table td,.report_table th{
            border: 1px solid #000;
            white-space: nowrap;
            padding: 5px;
        }
    </style>
    <div id="search_details" style="border:1px solid #ddd;">
        <table style="width:100%">
            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="2">Major Financial Indicators</td>
                            <td style="text-align:left;font-weight:bold" colspan="2"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Major Indicators</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$column_name1?></td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" ><?=$column_name2?></td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" >Comments</td>
                        </tr>
                        <?php if (!empty($result)): ?>
                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">a) No. of Cases/Suits Ongoing for recovery of bad loans </td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$result->ongoing_suit_1?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$result->ongoing_suit_2?></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Artha Rin, Artha Jari Execution, Criminal Cases, Session, Bankruptcy court etc.</td>
                            </tr>
                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">b) Suit Value of Ongoing Cases</td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format(($result->total_suit_value1-$result->disposal_till_value_1)/100000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format(($result->total_suit_value2-$result->disposal_till_value_2)/100000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Suit value  (Lac)</td>
                            </tr>
                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">c) Recovery against Ongoing Cases</td>
                                <td style="border:1px solid black;color:black;text-align: center;"></td>
                                <td style="border:1px solid black;color:black;text-align: center;"></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Recovery  (figure in lac) against Ongoing Cases</td>
                            </tr>
                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">d) Number of Disposal Cases</td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$result->disposal_suit_1?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$result->disposal_suit_2?></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Suit Value  (figure in lac) against Withdrawn Suits</td>
                            </tr>

                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">e) Suit Value of Disposal Cases</td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($result->total_disposal_value1/100000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($result->total_disposal_value2/100000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Suit value  (Lac)</td>
                            </tr>

                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">f) Recovery against Disposal Cases</td>
                                <td style="border:1px solid black;color:black;text-align: center;"></td>
                                <td style="border:1px solid black;color:black;text-align: center;"></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Recovery  (figure in lac) against Ongoing Cases</td>
                            </tr>
                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">g) Number of Disposal Cases</td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$result->disposal_suit_1?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$result->disposal_suit_2?></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Artha Rin, Artha Jari Execution, Criminal Cases, Session, Bankruptcy court etc.</td>
                            </tr>
                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">h) Suit Value of Withdrawn Cases</td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($result->total_withdrawn_value1/100000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($result->total_withdrawn_value2/100000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Suit value  (Lac)</td>
                            </tr>
                            <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: left;">i) Recovery against Withdrawn Cases</td>
                                <td style="border:1px solid black;color:black;text-align: center;"></td>
                                <td style="border:1px solid black;color:black;text-align: center;"></td>
                                <td style="border:1px solid black;color:black;text-align: left;" >Recovery  (figure in lac) against Withdrawn Cases</td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
<?php endif ?>




