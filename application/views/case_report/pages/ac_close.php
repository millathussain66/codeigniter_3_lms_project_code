<?php $this->load->view('css');$crore=10000000 ?>
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

<?php if ($report_select=='case_report/vintage_analysis'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var branch = [<? $i=1; foreach($branch as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var next_step = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
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
        jQuery("#next_step").jqxComboBox({theme: theme, promptText: "Select Next Step", source: next_step, width: '98%', height: 25});
        jQuery("#disposal_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#disposal_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});

        jQuery('#district,#zone,#branch,#filed_type,#case_sts,#nature_suit,#next_step,#disposal_year,#disposal_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#branch").jqxComboBox('val','<?=$branch_select?>');
        jQuery("#filed_type").jqxComboBox('val','<?=$filed_type_select?>');
        jQuery("#case_sts").jqxComboBox('val','<?=$case_sts_select?>');
        jQuery("#nature_suit").jqxComboBox('val','<?=$nature_suit_select?>');
        jQuery("#next_step").jqxComboBox('val','<?=$next_step_select?>');
        jQuery("#disposal_year").jqxComboBox('val','<?=$year?>');
        jQuery("#disposal_month").jqxComboBox('val','<?=$month?>');
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
                                <td style="text-align:right;width:8%;"><strong> Case Status: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:13%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search"  type="submit">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;"><strong>Next Step:</strong> </td>
                                <td><div style="padding-left:1.8%" id="next_step" name="next_step"></div></td>
                                <td style="text-align:right;"><strong>district:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;"><strong>Zone:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;"><strong> Disposal Year: </strong></td>
                                <td><div style="padding-left:1.8%" id="disposal_year" name="disposal_year"></div></td>
                                <td style="text-align:right;"> <strong>Disposal Entry Month: </strong></td>
                                <td><div style="padding-left:1.8%" id="disposal_month" name="disposal_month"></div></td>
                                <td >
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
                            <td style="text-align:left;font-weight:bold" colspan="4">Year Wise Case Filing</td>
                            <td style="text-align:right;font-weight:bold" colspan="4"></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <?php
                            $current_year = $year;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($year_wise)): ?>
                            <?php 
                            $total=0;
                            foreach ($year_wise as $key): ?>
                                <?php   
                                $total+=$key->grand_total;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->nature_name?></td>
                                    <?php 
                                    $current_year = $year;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                        $name = 'count_'.$j;
                                        ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                    <?php } ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
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
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="4">Disposal (Filing Year Wise)</td>
                            <td style="text-align:right;font-weight:bold" colspan="4">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <?php   
                                $current_year = $year;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    ${'total_' . $j} = 0;
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$j.'</td>';
                                }
                             ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($disposal_summery)): ?>
                            <?php $grand_total=0; foreach ($disposal_summery as $key):
                             ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->nature_name?></td>
                                <?php $current_year = $year;$row_total = 0;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    $name = 'count_'.$j;
                                    ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    $row_total+=$key->$name;
                                ?> 
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                 <?php } ?>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$row_total?></td>
                                
                                    <? $grand_total=$grand_total+$row_total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php   
                                        $current_year = $year;
                                        for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $j}.'</td>';
                                        }
                                     ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="4">Disposal Stages (Filing Year Wise)</td>
                            <td style="text-align:right;font-weight:bold" colspan="4">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal Stages</td>
                            <?php   
                                $current_year = $year;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    ${'total_' . $j} = 0;
                                    ${'gtotal_' . $j} = 0;
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$j.'</td>';
                                }
                             ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($dispose_stage)): ?>
                            <?php $grand_total=0; $req_type = 0;$head="";$body="";
                            foreach ($dispose_stage as $k=> $key){
                             ?>
                                <?php
                                if($k==0){$req_type=$key->req_type;}
                                if($key->req_type != $req_type ){
                                    
                                    
                                    $head .='<tr style="border:1px solid black;color:black;background:#B4C6E7">
                                   <td style="border:1px solid black;color:black;text-align: left;">'.$dispose_stage[$k-1]->nature_name.'</td>';
                                   $current_year = $year;$row_total = 0;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) {
                                        $name = 'count_'.$j;
                                        //${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                        $row_total+=${'total_' . $j};
                                        $head .='<td style="border:1px solid black;color:black;text-align: center;">'.${'total_' . $j}.'</td>';
                                        ${'gtotal_' . $j} += ${'total_' . $j};
                                        ${'total_' . $j}=0;
                                    }
                                    $head .='<td style="border:1px solid black;color:black;text-align: center;">'.$row_total.'</td></tr>';
                                    echo $head.$body;
                                    $req_type = $key->req_type;$head="";$body="";
                                    
                                }
                                $body.='<tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: right;">'.$key->stage_name.'</td>';
                                 $current_year = $year;$row_total = 0;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    $name = 'count_'.$j;
                                    ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    $row_total+=$key->$name;
                               
                                $body.='<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                 } 
                                $body.='<td style="border:1px solid black;color:black;text-align: center;">'.$row_total.'</td>';
                                
                                    $grand_total=$grand_total+$row_total; 
                                $body.='</tr>';
                             } 
                             $head ='<tr style="border:1px solid black;color:black;background:#B4C6E7">
                                   <td style="border:1px solid black;color:black;text-align: left;">'.$dispose_stage[count($dispose_stage)-1]->nature_name.'</td>';
                                   $current_year =$year;$row_total=0;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) {
                                        $name = 'count_'.$j;
                                        //${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                        $row_total+=${'total_' . $j};
                                        $head .='<td style="border:1px solid black;color:black;text-align: center;">'.${'total_' . $j}.'</td>';
                                        ${'gtotal_' . $j} += ${'total_' . $j};
                                        
                                    }
                                    $head .='<td style="border:1px solid black;color:black;text-align: center;">'.$row_total.'</td></tr>';
                                echo $head.$body;

                             ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php   
                                        $current_year = $year;
                                        for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'gtotal_' . $j}.'</td>';
                                        }
                                     ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total?></td>
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
<?php if ($report_select=='case_report/closed_accounts'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
         var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var branch = [<? $i=1; foreach($branch as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var next_step = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
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
        jQuery("#next_step").jqxComboBox({theme: theme, promptText: "Select Next Step", source: next_step, width: '98%', height: 25});
        jQuery('#district,#zone,#branch,#filed_type,#case_sts,#nature_suit,#next_step').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#branch").jqxComboBox('val','<?=$branch_select?>');
        jQuery("#filed_type").jqxComboBox('val','<?=$filed_type_select?>');
        jQuery("#case_sts").jqxComboBox('val','<?=$case_sts_select?>');
        jQuery("#nature_suit").jqxComboBox('val','<?=$nature_suit_select?>');
        jQuery("#next_step").jqxComboBox('val','<?=$next_step_select?>');
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
                                <td style="text-align:right;width:8%;"><strong> Case Status: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:13%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search"  type="submit">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;"><strong>Next Step:</strong> </td>
                                <td><div style="padding-left:1.8%" id="next_step" name="next_step"></div></td>
                                <td style="text-align:right;"><strong>district:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;"><strong>Zone:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;"></td>
                                <td></td>
                                <td style="text-align:right;"> </td>
                                <td></td>
                                <td >
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
                <td style="width:40%">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="3">Summary on Closed Accounts</td>
                            <td style="text-align:right;font-weight:bold" colspan="3">Figure in Crore</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Case Status</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Number</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">In '%'</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Suit Value</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">In '%'</td>
                        </tr>
                        <?php if (!empty($close_acc)): ?>
                            <?php 
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;">Disposal</td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$close_acc->disposal?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($close_acc->disposalamt,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"></td>
                                </tr>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;">Ongoing</td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$close_acc->ongoing?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($close_acc->ongoingamt,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"></td>
                                </tr>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$close_acc->total;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($close_acc->total_amt,2);?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
                <td style="width:10%">
                    &nbsp;
                </td>
                <td style="width:10%">
                    &nbsp;
                </td>
                <td style="width:40%">
                    
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="14"><span style="float:left">Disposal Summary on Closed Accounts</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Year</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($dispos_close_acc)): ?>
                            <?php $grand_total=0; foreach ($dispos_close_acc as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->years?></td>
                                        <?php 
                                            for ($i=1; $i <=12 ; $i++) { 
                                                $month = 'count_'.$i;
                                                ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                                echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                            }
                                         ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total?></td>
                                    <? $grand_total=$grand_total+$key->total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php 
                                        for ($i=1; $i <=12 ; $i++) { 
                                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $i}.'</td>';
                                        }
                                    ?>
                                    <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <?php   
                                $grid_columns = array(
                                    "Expired avobe 2 years" =>"365-730",
                                    "Expired avobe 1-2 years" =>"180-365",
                                    "Expired avobe 6 Month-1 years" =>"90-180",
                                    "Expired within 3 months" =>"0-90"
                                );
                                $total_col = count($grid_columns)+7;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Ongoing Summary on Closed Accounts</span><span style="float:right">Figure In Crore</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Employee ID</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Present Dealing Officer </td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Ongoing Cases</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal during <?=date('Y')?> (A/C Closed)</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing Cases (A/C Closed)</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">In '%' of Ongoing Cases (A/C Closed)</td>
                            <?php if (!empty($grid_columns)): ?>
                                <?php foreach ($grid_columns as $key => $value): ?>
                                    <?php 
                                        ${'total_' . $value}=0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key.'</td>';
                                     ?>
                                <?php endforeach ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Next Date Available</td>
                            <?php endif ?>
                             
                        </tr>
                        <?php $tot_ongoing=$tot_dispos=$tot_ac_close=$tot_inter=$tot_next=0; if (!empty($ongoing_close_acc)): ?>
                            <?php  foreach ($ongoing_close_acc as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_id?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_name?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->dispos_ac_close?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ac_close?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"></td>
                                        <?php if (!empty($grid_columns)): ?>
                                            <?php foreach ($grid_columns as $key2 => $value): ?>
                                                <?php 
                                                    $name = 'count_'.$value;
                                                    ${'total_' . $value}=${'total_' . $value}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->next_date_available?></td>
                                    <? 
                                    $tot_ongoing=$tot_ongoing+$key->ongoing_cases;
                                    $tot_dispos=$tot_dispos+$key->dispos_ac_close;
                                    $tot_ac_close=$tot_ac_close+$key->ac_close;
                                    $tot_next=$tot_next+$key->next_date_available;
                                    ?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$tot_ongoing?></td>
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$tot_dispos?></td>
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$tot_ac_close?></td>
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                    <?php if (!empty($grid_columns)): ?>
                                        <?php foreach ($grid_columns as $key2 => $value): ?>
                                            <?php 
                                                echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $value}.'</td>';
                                             ?>
                                        <?php endforeach ?>
                                        
                                    <?php endif ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$tot_next?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <?php     
                                $grid_columns = array(
                                    "Expired avobe 2 years" =>"365-730",
                                    "Expired avobe 1-2 years" =>"180-365",
                                    "Expired avobe 6 Month-1 years" =>"90-180",
                                    "Expired within 3 months" =>"0-90"
                                );
                                $total_col = count($grid_columns)+3;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Ongoing Steps on Closed Accounts</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing Status</td>
                            <?php if (!empty($grid_columns)): ?>
                                <?php foreach ($grid_columns as $key => $value): ?>
                                    <?php 
                                        ${'total_' . $value}=0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key.'</td>';
                                     ?>
                                <?php endforeach ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Next Date Available</td>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($ongoing_step_close)): ?>
                            <?php $grand_total=0; foreach ($ongoing_step_close as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_sts?></td>
                                        <?php if (!empty($grid_columns)): ?>
                                            <?php foreach ($grid_columns as $key2 => $value): ?>
                                                <?php 
                                                    $name = 'count_'.$value;
                                                    ${'total_' . $value}=${'total_' . $value}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->next_date_available?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total?></td>
                                    <? $grand_total=$grand_total+$key->total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($grid_columns)): ?>
                                        <?php foreach ($grid_columns as $key2 => $value): ?>
                                            <?php 
                                                echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $value}.'</td>';
                                             ?>
                                        <?php endforeach ?>
                                        
                                    <?php endif ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total?></td>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                          <td style="text-align:left;font-weight:bold" colspan="11"><span style="float:left">Next Week Ongoing Cases (Closed A/C)</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature of Suit </td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Date</td>
                            
                            <?php $stop_date = date('y-m-d');
                                for($i=1;$i<8;$i++){
                                    $stop_date = date('d-M-y', strtotime($stop_date . ' +1 day'));
                                ?>
                                <?php 
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$stop_date.'</td>';
                                 ?>
                            <?php } ?>
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                            
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing Cases</td>
                            
                            <?php $stop_date = date('y-m-d');
                                for($i=1;$i<8;$i++){
                                    ${'total_' . $i}=0;
                                    $stop_date = date('l', strtotime($stop_date . ' +1 day'));
                                ?>
                                <?php 
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$stop_date.'</td>';
                                 ?>
                            <?php } ?>
                            
                        </tr>
                        <?php if (!empty($nature_week)): ?>
                            <?php $grand_total=0;$next_total=0; foreach ($nature_week as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_type?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                            <?php $stop_date = date('y-m-d');
                                                    for($i=1;$i<8;$i++){ ?>
                                                <?php 
                                                    $name = 'day'.$i;
                                                    ${'total_' . $i}=${'total_' . $i}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php } ?>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total?></td>
                                    <? $grand_total=$grand_total+$key->ongoing_cases;$next_total=$next_total+$key->total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total?></td>
                                <?php $stop_date = date('y-m-d');
                                        for($i=1;$i<8;$i++){ ?>
                                    <?php 
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $i}.'</td>';
                                     ?>
                                <?php } ?>
                                <?php   
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$next_total.'</td>';
                                 ?>
                                        
                                     
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
<?php if ($report_select=='case_report/lawyer_performance'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var branch = [<? $i=1; foreach($branch as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var next_step = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
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
        jQuery("#next_step").jqxComboBox({theme: theme, promptText: "Select Next Step", source: next_step, width: '98%', height: 25});
        jQuery("#disposal_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#disposal_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});

        jQuery('#district,#zone,#branch,#filed_type,#case_sts,#nature_suit,#next_step,#disposal_year,#disposal_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#branch").jqxComboBox('val','<?=$branch_select?>');
        jQuery("#filed_type").jqxComboBox('val','<?=$filed_type_select?>');
        jQuery("#case_sts").jqxComboBox('val','<?=$case_sts_select?>');
        jQuery("#nature_suit").jqxComboBox('val','<?=$nature_suit_select?>');
        jQuery("#next_step").jqxComboBox('val','<?=$next_step_select?>');
        jQuery("#disposal_year").jqxComboBox('val','<?=$year?>');
        jQuery("#disposal_month").jqxComboBox('val','<?=$month?>');
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
                                <td style="text-align:right;width:8%;"><strong> Prev Step: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:13%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search"  type="submit">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;"><strong>Next Step:</strong> </td>
                                <td><div style="padding-left:1.8%" id="next_step" name="next_step"></div></td>
                                <td style="text-align:right;"><strong>district:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;"><strong>Zone:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;"><strong> Disposal Year: </strong></td>
                                <td><div style="padding-left:1.8%" id="disposal_year" name="disposal_year"></div></td>
                                <td style="text-align:right;"> <strong>Disposal Entry Month: </strong></td>
                                <td><div style="padding-left:1.8%" id="disposal_month" name="disposal_month"></div></td>
                                <td >
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
                            <td style="text-align:left;font-weight:bold" colspan="3">Year Wise Case Disposal</td>
                            <td style="text-align:right;font-weight:bold" colspan="4"></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Lawyer's Name</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Current Performance</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Overall Performance</td>
                            <?php
                            $current_year = $year;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                        </tr>
                        <?php if (!empty($law_sum)): ?>
                            <?php 
                            $total_ongoing=0;
                            $total_disposal=0;
                            $current_performance = 0;
                            $overall_performance = 0;
                            $total_current = 0;
                            $total_overall = 0;
                            foreach ($law_sum as $key): ?>
                                <?php   
                                $total_ongoing=$total_ongoing+$key->ongoing_cases;
                                $total_disposal=$total_disposal+$key->disposal;
                                $current_performance = 0;
                                $current_performance = ($key->disposal_current_year>0)?($key->disposal_current_year/($key->ongoing_cases+$key->disposal_current_year)):0;
                                $overall_performance = ($key->disposal>0)?($key->disposal/($key->ongoing_cases+$key->disposal)):0;
                                $total_current = $total_current+$current_performance;
                                $total_overall = $total_overall+$overall_performance;
                                ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->law_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($current_performance,2).'%'?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($overall_performance,2).'%'?></td>
                                    <?php 
                                    $current_year = $year;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                        $name = 'ddd_'.$j;
                                        ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5"  style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_ongoing?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_disposal?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_current,2).'%'?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_overall,2).'%'?></td>
                                <?php
                                $current_year = $year;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    
                                ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=${'total_' . $j}?></td>
                                <?php  } ?>
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
<?php if ($report_select=='case_report/vintage_law_firms'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var branch = [<? $i=1; foreach($branch as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var next_step = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
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
        jQuery("#next_step").jqxComboBox({theme: theme, promptText: "Select Next Step", source: next_step, width: '98%', height: 25});
        jQuery("#filing_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#entry_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});

        jQuery('#district,#zone,#branch,#filed_type,#case_sts,#nature_suit,#next_step,#filing_year,#entry_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#branch").jqxComboBox('val','<?=$branch_select?>');
        jQuery("#filed_type").jqxComboBox('val','<?=$filed_type_select?>');
        jQuery("#case_sts").jqxComboBox('val','<?=$case_sts_select?>');
        jQuery("#nature_suit").jqxComboBox('val','<?=$nature_suit_select?>');
        jQuery("#next_step").jqxComboBox('val','<?=$next_step_select?>');
        jQuery("#filing_year").jqxComboBox('val','<?=$year?>');
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
                                <td style="text-align:right;width:8%"><strong>Branch:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="branch" name="branch"></div></td>
                                <td style="text-align:right;width:7%"><strong>Filed Type:</strong> </td>
                                <td style="width:11%"><div style="padding-left:1.8%" id="filed_type" name="filed_type"></div></td>
                                <td style="text-align:right;width:8%;"><strong> Prev Step: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:13%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search"  type="submit">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;"><strong>Next Step:</strong> </td>
                                <td><div style="padding-left:1.8%" id="next_step" name="next_step"></div></td>
                                <td style="text-align:right;"><strong>district:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;"><strong>Zone:</strong> </td>
                                <td ><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;"><strong> Filling Year: </strong></td>
                                <td><div style="padding-left:1.8%" id="filing_year" name="filing_year"></div></td>
                                <td style="text-align:right;"> <strong>Case Entry Month: </strong></td>
                                <td><div style="padding-left:1.8%" id="entry_month" name="entry_month"></div></td>
                                <td >
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
                            <td style="text-align:left;font-weight:bold" colspan="3">Year Wise Case Filing</td>
                            <td style="text-align:right;font-weight:bold" colspan="4"></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Lawyer's Name</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                            
                            <?php
                            $current_year = $year;
                            for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                ${'total_' . $j} = 0;
                            ?>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$j?></td>
                            <?php  } ?>
                        </tr>
                        <?php if (!empty($law_sum)): ?>
                            <?php 
                            $total_ongoing=0;
                            $total_disposal=0;
                            foreach ($law_sum as $key): ?>
                                <?php   
                                $total_ongoing=$total_ongoing+$key->ongoing_cases;
                                $total_disposal=$total_disposal+$key->disposal;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->law_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal?></td>
                                    <?php 
                                    $current_year = $year;
                                    for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                        $name = 'ddd_'.$j;
                                        ${'total_' . $j} = ${'total_' . $j}+$key->$name;
                                    
                                    ?>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->$name?></td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_ongoing?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_disposal?></td>
                                <?php
                                $current_year = $year;
                                for ($j=$current_year; $j >=$current_year-5 ; $j--) { //for Year loop
                                    
                                ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=${'total_' . $j}?></td>
                                <?php  } ?>
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
<?php if ($report_select=='case_report/branch'): ?>
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
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select Zone", source: zone, width: '98%', height: 25});
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
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search"  type="submit">
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
                            <td style="text-align:left;font-weight:bold" colspan="5">Branch Wise Case Filing</td>
                            <td style="text-align:left;font-weight:bold" colspan="5"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Name Of Branch</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Cases</td>
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
                        <?php if (!empty($branch_sum)): ?>
                            <?php 
                            $total_ongoing1=0;
                            $total_ongoing2=0;
                            $total_ongoing3=0;
                            $total_disposal1=0;
                            $total_disposal2=0;
                            $total_disposal3=0;
                            $grand_total1=0;
                            $grand_total2=0;
                            $grand_total3=0;
                            foreach ($branch_sum as $key): ?>
                                <?php   
                                $total_ongoing1=$total_ongoing1+$key->ongoing_cases;
                                $total_ongoing2=$total_ongoing2+$key->ongoing_case_claim_amount;
                                $total_ongoing3=$total_ongoing3+$key->ongoing_recovery;
                                $total_disposal1=$total_disposal1+$key->disposal;
                                $total_disposal2=$total_disposal2+$key->disposal_case_claim_amount;
                                $total_disposal3=$total_disposal3+$key->disposal_recovery;
                                $grand_total1=$grand_total1+$key->total_cases;
                                $grand_total2=$grand_total2+$key->total_suit_value;
                                $grand_total3=$grand_total3+$key->total_recovery;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->branch_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->ongoing_case_claim_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->ongoing_recovery/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->disposal_case_claim_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->disposal_recovery/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_suit_value/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_recovery/$crore,2)?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_ongoing1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_ongoing2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_ongoing3/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_disposal1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_disposal2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_disposal3/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($grand_total2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($grand_total3/$crore,2)?></td>
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
<?php if ($report_select=='case_report/district'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var filed_type = [<? $i=1; foreach($filed_type as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var nature_suit = [<? $i=1; foreach($nature_suit as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var year = [<? $i=1; for($y=1990;$y<=date('Y');$y++){  if($i!=1){echo ',';} echo '{value:"'.$y.'", label:"'.$y.'"}';$i++;}?>];
        var months = [{value:"01", label:"January"},{value:"02", label:"February"},{value:"03", label:"March"},{value:"04", label:"April"},{value:"05", label:"May"},{value:"06", label:"June"},{value:"07", label:"July"},{value:"08", label:"August"},{value:"09", label:"September"},{value:"10", label:"October"},{value:"11", label:"November"},{value:"12", label:"December"}];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});
        jQuery("#filed_type").jqxComboBox({theme: theme, promptText: "Select Filed Type", source: filed_type, width: '98%', height: 25});
        jQuery("#case_sts").jqxComboBox({theme: theme, promptText: "Select Case Status", source: case_sts, width: '98%', height: 25});
        jQuery("#nature_suit").jqxComboBox({theme: theme, promptText: "Select Nature Suit", source: nature_suit, width: '98%', height: 25});
        jQuery("#filing_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#disposal_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#entry_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});
        jQuery("#disposal_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});

        jQuery('#disposal_year,#disposal_month,#district,#zone,#filed_type,#case_sts,#nature_suit,#filing_year,#entry_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#district").jqxComboBox('val','<?=$district_select?>');
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
                                <td style="text-align:right;width:8%"><strong>Distrcit:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;width:7%"><strong>Filed Type:</strong> </td>
                                <td style="width:11%"><div style="padding-left:1.8%" id="filed_type" name="filed_type"></div></td>
                                <td style="text-align:right;width:8%;"><strong> Disposal Step: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:10%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search"  type="submit">
                                </td>
                            </tr>
                            <tr>
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
                            <td style="text-align:left;font-weight:bold" colspan="5">District Wise Case Filing</td>
                            <td style="text-align:left;font-weight:bold" colspan="5"><button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Name Of District</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Cases</td>
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
                        <?php if (!empty($district_sum)): ?>
                            <?php 
                            $total_ongoing1=0;
                            $total_ongoing2=0;
                            $total_ongoing3=0;
                            $total_disposal1=0;
                            $total_disposal2=0;
                            $total_disposal3=0;
                            $grand_total1=0;
                            $grand_total2=0;
                            $grand_total3=0;
                            foreach ($district_sum as $key): ?>
                                <?php   
                                $total_ongoing1=$total_ongoing1+$key->ongoing_cases;
                                $total_ongoing2=$total_ongoing2+$key->ongoing_case_claim_amount;
                                $total_ongoing3=$total_ongoing3+$key->ongoing_recovery;
                                $total_disposal1=$total_disposal1+$key->disposal;
                                $total_disposal2=$total_disposal2+$key->disposal_case_claim_amount;
                                $total_disposal3=$total_disposal3+$key->disposal_recovery;
                                $grand_total1=$grand_total1+$key->total_cases;
                                $grand_total2=$grand_total2+$key->total_suit_value;
                                $grand_total3=$grand_total3+$key->total_recovery;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->district_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->ongoing_case_claim_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->ongoing_recovery/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->disposal_case_claim_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->disposal_recovery/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_suit_value/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_recovery/$crore,2)?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_ongoing1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_ongoing2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_ongoing3/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_disposal1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_disposal2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_disposal3/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($grand_total2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($grand_total3/$crore,2)?></td>
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
<?php if ($report_select=='case_report/court_location_wise_summary'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var court_location = [<? $i=1; foreach($court_location as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var case_sts = [<? $i=1; foreach($case_sts as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var filed_type = [<? $i=1; foreach($filed_type as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var nature_suit = [<? $i=1; foreach($nature_suit as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var year = [<? $i=1; for($y=1990;$y<=date('Y');$y++){  if($i!=1){echo ',';} echo '{value:"'.$y.'", label:"'.$y.'"}';$i++;}?>];
        var months = [{value:"01", label:"January"},{value:"02", label:"February"},{value:"03", label:"March"},{value:"04", label:"April"},{value:"05", label:"May"},{value:"06", label:"June"},{value:"07", label:"July"},{value:"08", label:"August"},{value:"09", label:"September"},{value:"10", label:"October"},{value:"11", label:"November"},{value:"12", label:"December"}];
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select District", source: district, width: '98%', height: 25});
        jQuery("#filed_type").jqxComboBox({theme: theme, promptText: "Select Filed Type", source: filed_type, width: '98%', height: 25});
        jQuery("#case_sts").jqxComboBox({theme: theme, promptText: "Select Case Status", source: case_sts, width: '98%', height: 25});
        jQuery("#nature_suit").jqxComboBox({theme: theme, promptText: "Select Nature Suit", source: nature_suit, width: '98%', height: 25});
        jQuery("#filing_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#disposal_year").jqxComboBox({theme: theme, promptText: "Select Years", source: year, width: '98%', height: 25});
        jQuery("#entry_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});
        jQuery("#disposal_month").jqxComboBox({theme: theme, promptText: "Select Months", source: months, width: '98%', height: 25});

        jQuery('#disposal_year,#disposal_month,#zone,#district,#filed_type,#case_sts,#nature_suit,#filing_year,#entry_month').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        jQuery("#district").jqxComboBox('val','<?=$district_select?>');
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
                                <td style="text-align:right;width:8%"><strong>Court:</strong> </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;width:7%"><strong>Filed Type:</strong> </td>
                                <td style="width:11%"><div style="padding-left:1.8%" id="filed_type" name="filed_type"></div></td>
                                <td style="text-align:right;width:8%;"><strong> Disposal Step: </strong></td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="case_sts" name="case_sts"></div></td>
                                <td style="text-align:right;width:10%"> &nbsp;&nbsp; <strong>Nature of Suit: </strong> &nbsp;&nbsp; </td>
                                <td style="width:10%"><div style="padding-left:1.8%" id="nature_suit" name="nature_suit"></div></td>
                                <td style="width:5%"><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search"  type="submit">
                                </td>
                            </tr>
                            <tr>
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
                            <td style="text-align:left;font-weight:bold" colspan="4">Court Location Wise Case Filing</td>
                            <td style="text-align:right;font-weight:bold" colspan="4"></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">District</td>
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Name Of Court</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" colspan="3" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total Cases</td>
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
                        <?php if (!empty($district_sum)): ?>
                            <?php 
                            $total_ongoing1=0;
                            $total_ongoing2=0;
                            $total_ongoing3=0;
                            $total_disposal1=0;
                            $total_disposal2=0;
                            $total_disposal3=0;
                            $grand_total1=0;
                            $grand_total2=0;
                            $grand_total3=0;
                            foreach ($district_sum as $key): ?>
                                <?php   
                                $total_ongoing1=$total_ongoing1+$key->ongoing_cases;
                                $total_ongoing2=$total_ongoing2+$key->ongoing_case_claim_amount;
                                $total_ongoing3=$total_ongoing3+0;
                                $total_disposal1=$total_disposal1+$key->disposal;
                                $total_disposal2=$total_disposal2+$key->disposal_case_claim_amount;
                                $total_disposal3=$total_disposal3+0;
                                $grand_total1=$grand_total1+$key->total_cases;
                                $grand_total2=$grand_total2+$key->total_suit_value;
                                $grand_total3=$grand_total3+0;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->district_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->court_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->ongoing_case_claim_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->disposal_case_claim_amount/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_cases?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->total_suit_value/$crore,2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_ongoing1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_ongoing2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_ongoing3/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$total_disposal1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_disposal2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_disposal3/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total1?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($grand_total2/$crore,2)?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($grand_total3/$crore,2)?></td>
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




