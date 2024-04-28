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

<?php if ($report_select=='case_report/summary_filing_instraction'): ?>
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
                            <td style="text-align:left;font-weight:bold" colspan="3">Case Filing Instructions</td>
                            <td style="text-align:left;font-weight:bold" colspan="5"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Particulars</td>
                            <?php
                            $current_year = $year;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result)): ?>
                            <tr>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number of Instructions</td>
                            <?php 
                                $total=0;
                                $current_year = $year;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    $name = 'count_request_'.$j;
                                    ${'total_' . $j} = ${'total_' . $j}+$result[0]->$name;
                                
                                ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$result[0]->$name?></td>
                            <?php } ?>
                            <td style="border:1px solid black;color:black;text-align: center;"><?=$result[0]->grand_total_request?></td>
                            </tr>
                            <tr>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number of Case Filed</td>
                            <?php 
                                $total=0;
                                $current_year = $year;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    $name = 'count_request_'.$j;
                                    ${'total_' . $j} = ${'total_' . $j}+$result[1]->$name;
                                
                                ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$result[1]->$name?></td>
                            <?php } ?>
                            <td style="border:1px solid black;color:black;text-align: center;"><?=$result[1]->grand_total_request?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>
            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="8">Case Filing Instructions</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature of Case</td>
                            <?php
                            $current_year = $year;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result2)): ?>
                            <?php foreach ($result2 as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->request_type?></td>
                                <?php 
                                    $total=0;
                                    $current_year = $year;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                        $name = 'count_suit_'.$j;
                                        ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                <?php } ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total_suit?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>
            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="8">Number of Case Filed</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature of Case</td>
                            <?php
                            $current_year = $year;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result3)): ?>
                            <?php foreach ($result3 as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->request_type?></td>
                                <?php 
                                    $total=0;
                                    $current_year = $year;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                        $name = 'count_suit_'.$j;
                                        ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                <?php } ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total_suit?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>

            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="8">Case Filing Instructions</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature of Case</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result4)): ?>
                            <?php foreach ($result4 as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->request_type?></td>
                                <?php 
                                    for ($i=1; $i <=12 ; $i++) { 
                                        $month = 'count_'.$i;
                                        ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                    }
                                 ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total_suit?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>

            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="8">Number of Case Filed</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature of Case</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result5)): ?>
                            <?php foreach ($result5 as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->request_type?></td>
                                <?php 
                                    for ($i=1; $i <=12 ; $i++) { 
                                        $month = 'count_'.$i;
                                        ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                    }
                                 ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total_suit?></td>
                            </tr>
                            <?php endforeach ?>
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

<?php if ($report_select=='case_report/law_wise_legal_notice'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var year = [<? $i=1; for($y=1990;$y<=date('Y');$y++){  if($i!=1){echo ',';} echo '{value:"'.$y.'", label:"'.$y.'"}';$i++;}?>];
        var months = [{value:"01", label:"January"},{value:"02", label:"February"},{value:"03", label:"March"},{value:"04", label:"April"},{value:"05", label:"May"},{value:"06", label:"June"},{value:"07", label:"July"},{value:"08", label:"August"},{value:"09", label:"September"},{value:"10", label:"October"},{value:"11", label:"November"},{value:"12", label:"December"}];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});
        jQuery("#ln_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#entry_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});
        jQuery('#ln_year,#district,#zone,#entry_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#ln_year").jqxComboBox('val','<?=$year?>');
        jQuery("#entry_month").jqxComboBox('val','<?=$month?>');
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
                                <td style="text-align:right;width:8%"><strong>district:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;width:8%"><strong>Zone:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;width:8%"><strong>Notice Serving Year: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="ln_year" name="ln_year"></div></td>
                                <td style="text-align:right;width:8%"> <strong>Notice Serving Month: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="entry_month" name="entry_month"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" type="submit">
                                </td>
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
                            <td style="text-align:left;font-weight:bold" colspan="3">Legal Notice</td>
                            <td style="text-align:left;font-weight:bold" colspan="5"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Law Firm/Chamber</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Lawyers' Name</td>
                            <?php
                            $current_year = $year;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result)): ?>
                            <?php foreach ($result as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->law_chamber?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->lawyer_name?></td>
                                <?php 
                                    $total=0;
                                    $current_year = $year;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                        $name = 'count_'.$j;
                                        ${'total_' . $j} = ${'total_' . $j}+$result[0]->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                <?php } ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>

            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="3">Legal Notice</td>
                            <td style="text-align:left;font-weight:bold" colspan="5"></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Law Firm/Chamber</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Lawyers' Name</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result2)): ?>
                            <?php foreach ($result2 as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->law_chamber?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->lawyer_name?></td>
                                <?php 
                                    for ($i=1; $i <=12 ; $i++) { 
                                        $month = 'count_'.$i;
                                        ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                    }
                                 ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>

            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="3">Legal Notice</td>
                            <td style="text-align:left;font-weight:bold" colspan="5"></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Law Firm/Chamber</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Lawyers' Name</td>
                            <?php foreach ($ln_type as $key): ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->name?></td>
                            <?php endforeach ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result3)): ?>
                            <?php foreach ($result3 as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->law_chamber?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->lawyer_name?></td>
                                <?php 
                                    $total=0;
                                    foreach ($ln_type as $key2) { //for Year loop
                                        $name = 'count_'.$key2->id;
                                        ${'total_' . $key2->id} = ${'total_' . $key2->id}+$key->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                <?php } ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                </tr>
                            <?php endforeach ?>
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

<?php if ($report_select=='case_report/summary_next_step'): ?>
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
                            <td style="text-align:left;font-weight:bold">Case Filing</td>
                            <td style="text-align:left;font-weight:bold" colspan="7"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Next Steps (Ongoing Cases)</td>
                            <?php
                            $current_year = $year;
                            $total=0;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result)): ?>
                            <?php foreach ($result as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->next_sts?></td>
                                <?php 
                                    $total=$total+$key->grand_total_suit;
                                    $current_year = $year;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                        $name = 'count_'.$j;
                                        ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                <?php } ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total_suit?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <?php
                                $current_year = $year;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    
                                ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=${'total_' . $j}?></td>
                                <?php  } ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total?></td>
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

<?php if ($report_select=='case_report/summary_recovery'): ?>
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
                            <td style="text-align:center;font-weight:bold" colspan="8"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Particulars</td>
                            <?php
                            $current_year = $year;
                            $total=0;
                            $grand_total = 0;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result)): ?>
                            <?php foreach ($result as $key): ?>
                                <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->type?></td>
                                <?php 
                                    $total=0;
                                    $current_year = $year;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                        $name = 'amount_'.$j;
                                        $total=$total+$key->$name;
                                        ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                <?php } $grand_total = $grand_total+$total;?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$total?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <?php
                                $current_year = $year;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    
                                ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=${'total_' . $j}?></td>
                                <?php  } ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
                
            </tr>
            <tr>
                <td style="width:40%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="8">Recovery</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Particulars</td>
                            <?php   
                                $total=0;
                                $grand_total=0;
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($result2)): ?>
                            <?php foreach ($result2 as $key): ?>
                                <tr>
                                    <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$key->type?></td>
                                    <?php 
                                        $total=0;
                                        for ($i=1; $i <=12 ; $i++) { 
                                            $month = 'amount_'.$i;
                                            ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                            $total = $total+$key->$month;
                                            echo '<td style="border:1px solid black;color:black;text-align: center;">'.number_format($key->$month,2).'</td>';
                                        }
                                        $grand_total = $grand_total+$total;
                                     ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($total,2)?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <?php 
                                    $total=0;
                                    for ($i=1; $i <=12 ; $i++) { 
                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.number_format(${'total_' . $i},2).'</td>';
                                    }
                                 ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($grand_total,2)?></td>
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




