<?php $this->load->view('css');$crore=10000000; ?>
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

</script>
<style type="text/css">
    th{border-color: #ccc;}
</style>

<?php if ($report_select=='case_report/protfolio_summery'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:10%"><strong>Report Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="width:40%">
                                    &nbsp;
                                </td>
                                <!-- <td ><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" onclick="get_search_data();" type="button">
                                </td> -->
                            </tr>
                        </table>
                  </div>
                  <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>

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
                            <td style="text-align:left;font-weight:bold" colspan="3">Protfolio Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Case Status</td>
                            <?php   
                                $current_year = date('Y');
                                $from_year = $current_year-3;
                                for ($i=$current_year; $i >=$from_year ; $i--) { 
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$i.'</td>';
                                }
                             ?>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php foreach ($summery_result as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->type?></td>
                                    <?php   
                                        $current_year = date('Y');
                                        $from_year = $current_year-3;
                                        for ($i=$current_year; $i >=$from_year ; $i--) { 
                                            $field_name = 'count_'.$i;
                                            $field_name2 = 'disposal_till_'.$i;
                                            if($key->type=='Ongoing')
                                            {
                                                echo '<td style="border:1px solid black;color:black;text-align: center;">'.($key->$field_name-$key->$field_name2).'</td>';
                                            }
                                            else
                                            {
                                                echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$field_name.'</td>';
                                            }
                                            
                                        }
                                     ?>
                                </tr>
                            <?php endforeach ?>
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
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="3">Protfolio Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">Figure in Crore</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Case Status</td>
                            <?php   
                                $current_year = date('Y');
                                $from_year = $current_year-3;
                                for ($i=$current_year; $i >=$from_year ; $i--) { 
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$i.'</td>';
                                }
                             ?>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php foreach ($summery_result as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->type?></td>
                                    <?php   
                                        $current_year = date('Y');
                                        $from_year = $current_year-3;
                                        for ($i=$current_year; $i >=$from_year ; $i--) { 
                                            $field_name = 'amount_'.$i;
                                            $field_name2 = 'disposal_till_amount_'.$i;
                                            if($key->type=='Ongoing')
                                            {
                                                echo '<td style="border:1px solid black;color:black;text-align: center;">'.round((($key->$field_name-$key->$field_name2)/10000000),2).'</td>';
                                            }
                                            else
                                            {
                                                echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$field_name/10000000),2).'</td>';
                                            }
                                            
                                        }
                                     ?>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="12">Disposal Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
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
                        <?php if (!empty($disposal_summery)): ?>
                            <?php $grand_total=0; foreach ($disposal_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->year?></td>
                                        <?php   
                                            
                                            for ($i=1; $i <=12 ; $i++) { 
                                                $month = 'count_'.$i;
                                                ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                                echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                            }
                                         ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                        <? $grand_total=$grand_total+$key->grand_total;?>
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
                            <td style="text-align:left;font-weight:bold" colspan="12">Disposal Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">Figure in Crore</td>
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
                        <?php if (!empty($disposal_summery)): ?>
                            <?php $grand_total=0; foreach ($disposal_summery as $key): ?>
                             <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->year?></td>
                                <?php   
                                    for ($i=1; $i <=12 ; $i++) { 
                                        $month = 'amount_'.$i;
                                        ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$month/10000000),2).'</td>';
                                    }
                                 ?>
                                 <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->grand_amount/10000000),2)?></td>
                                <? $grand_total=$grand_total+$key->grand_amount;?>
                            </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php   
                                        for ($i=1; $i <=12 ; $i++) { 
                                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $i}/10000000),2).'</td>';
                                        }
                                     ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="12">New Filling Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
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
                        <?php if (!empty($new_filling_summery)): ?>
                            <?php $grand_total=0; foreach ($new_filling_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->year?></td>
                                        <?php   
                                            for ($i=1; $i <=12 ; $i++) { 
                                                $month = 'count_'.$i;
                                                ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                                echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                            }
                                         ?>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                        <? $grand_total=$grand_total+$key->grand_total;?>
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
                            <td style="text-align:left;font-weight:bold" colspan="12">New Filling Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">Figure in Crore</td>
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
                        <?php if (!empty($new_filling_summery)): ?>
                            <?php $grand_total=0; foreach ($new_filling_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->year?></td>
                                    <?php   
                                        for ($i=1; $i <=12 ; $i++) { 
                                            $month = 'amount_'.$i;
                                            ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                            echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$month/10000000),2).'</td>';
                                        }
                                     ?>
                                     <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->grand_amount/10000000),2)?></td>
                                    <? $grand_total=$grand_total+$key->grand_amount;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php   
                                        for ($i=1; $i <=12 ; $i++) { 
                                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $i}/10000000),2).'</td>';
                                        }
                                     ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
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
<?php endif ?>
<?php if ($report_select=='case_report/case_wise_summery'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});

        jQuery('#district,#zone').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:10%"><strong>Report Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="text-align:right;width:10%"><strong>district&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;width:5%"><strong>zone&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;width:10%;"><strong> Date From: </strong></td>
                                <td><input name="date_from" type="text" class="" id="date_from" value="<?=$date_from?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker ("date_from");</script></td>
                                <td style="width:5%"> &nbsp;&nbsp; <strong>To: </strong> &nbsp;&nbsp; </td>
                                <td><input name="date_to" type="text" class="" id="date_to" value="<?=$date_to?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker("date_to");</script></td>
                                <td ><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" onclick="get_search_data();" type="submit">
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
                            <td style="text-align:left;font-weight:bold" colspan="3">Protfolio Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">New Filling</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php 
                            $new_filling_total=0;
                            $disposal_total=0;
                            $ongoing_total=0;
                            foreach ($summery_result as $key): ?>
                                <?php   
                                    $new_filling_total=$new_filling_total+$key->new_filling;
                                    $disposal_total=$disposal_total+$key->disposal;
                                    $ongoing_total=$ongoing_total+$key->ongoing;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_type?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->new_filling?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$new_filling_total;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$disposal_total;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$ongoing_total;?></td>
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
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="3">Protfolio Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">Figure in Crore</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">New Filling</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php
                                $new_filling_total=0;
                                $disposal_total=0;
                                $ongoing_total=0;
                             foreach ($summery_result as $key): ?>
                                <?php   
                                    $new_filling_total=$new_filling_total+$key->new_filling_amount;
                                    $disposal_total=$disposal_total+$key->disposal_amount;
                                    $ongoing_total=$ongoing_total+$key->ongoing_amount;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_type?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->new_filling_amount/10000000),2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->disposal_amount/10000000),2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->ongoing_amount/10000000),2)?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($new_filling_total/10000000),2);?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($disposal_total/10000000),2);?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($ongoing_total/10000000),2);?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="12">New Filling</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($new_filling_summery)): ?>
                            <?php $grand_total=0; foreach ($new_filling_summery as $key):
                             ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_type?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->jan_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->fab_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->mar_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->apr_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->may_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->jun_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->jul_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->aug_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->sep_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->oct_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->nov_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->dec_case?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_case?></td>
                                    <? $grand_total=$grand_total+$key->total_case;?>
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
                            <td style="text-align:left;font-weight:bold" colspan="12">New Filling</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">Figure in Crore</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($new_filling_summery)): ?>
                            <?php $grand_total=0; foreach ($new_filling_summery as $key): ?>
                             <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_type?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->jan_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->fab_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->mar_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->apr_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->may_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->jun_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->jul_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->aug_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->sep_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->oct_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->nov_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->dec_amt/10000000,2)?></td>
                                 <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->total_amt/10000000),2)?></td>
                                <? $grand_total=$grand_total+$key->total_amt;?>
                            </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php   
                                        for ($i=1; $i <=12 ; $i++) { 
                                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $i}/10000000),2).'</td>';
                                        }
                                     ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="12">Disposal Summer</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($disposal_summery)): ?>
                            <?php $grand_total=0; foreach ($disposal_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_type?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->jan_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->fab_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->mar_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->apr_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->may_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->jun_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->jul_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->aug_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->sep_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->oct_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->nov_case?></td>
                                        <td style="border:1px solid black;color:black;text-align: center;"><?=$key->dec_case?></td>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->total_case?></td>
                                        <? $grand_total=$grand_total+$key->total_case;?>
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
                            <td style="text-align:left;font-weight:bold" colspan="12">Disposal Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">Figure in Crore</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($disposal_summery)): ?>
                            <?php $grand_total=0; foreach ($disposal_summery as $key): ?>
                             <tr style="border:1px solid black;color:black">
                                <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_type?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->jan_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->fab_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->mar_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->apr_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->may_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->jun_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->jul_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->aug_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->sep_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->oct_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->nov_amt/10000000,2)?></td>
                                <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($key->dec_amt/10000000,2)?></td>
                                 <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->total_amt/10000000),2)?></td>
                                <? $grand_total=$grand_total+$key->total_amt;?>
                            </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php   
                                        for ($i=1; $i <=12 ; $i++) { 
                                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $i}/10000000),2).'</td>';
                                        }
                                     ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
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
<?php if ($report_select=='case_report/segment_wise_summery'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});

        jQuery('#district,#zone').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:10%"><strong>Report Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="text-align:right;width:10%"><strong>district&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;width:5%"><strong>zone&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;width:10%;"><strong> Date From: </strong></td>
                                <td><input name="date_from" type="text" class="" id="date_from" value="<?=$date_from?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker ("date_from");</script></td>
                                <td style="width:5%"> &nbsp;&nbsp; <strong>To: </strong> &nbsp;&nbsp; </td>
                                <td><input name="date_to" type="text" class="" id="date_to" value="<?=$date_to?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker("date_to");</script></td>
                                <td ><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" onclick="get_search_data();" type="submit">
                                <!-- <td ><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" onclick="get_search_data();" type="button">
                                </td> -->
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
                            <td style="text-align:left;font-weight:bold" colspan="3">Protfolio Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Type of segment</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">New Filling</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php 
                            $new_filling_total=0;
                            $disposal_total=0;
                            $ongoing_total=0;
                            foreach ($summery_result as $key): ?>
                                <?php   
                                    $new_filling_total=$new_filling_total+$key->new_filling;
                                    $disposal_total=$disposal_total+$key->disposal;
                                    $ongoing_total=$ongoing_total+$key->ongoing;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->segment_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->new_filling?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$new_filling_total;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$disposal_total;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$ongoing_total;?></td>
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
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="3">Protfolio Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">Figure in Crore</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Type of Segment</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">New Filling</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php
                                $new_filling_total=0;
                                $disposal_total=0;
                                $ongoing_total=0;
                             foreach ($summery_result as $key): ?>
                                <?php   
                                    $new_filling_total=$new_filling_total+$key->new_filling_amount;
                                    $disposal_total=$disposal_total+$key->disposal_amount;
                                    $ongoing_total=$ongoing_total+$key->ongoing_amount;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->segment_name?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->new_filling_amount/10000000),2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->disposal_amount/10000000),2)?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->ongoing_amount/10000000),2)?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($new_filling_total/10000000),2);?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($disposal_total/10000000),2);?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($ongoing_total/10000000),2);?></td>
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
                                $total_col = count($req_type)+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Ongoing Cases</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Type of Segment</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($ongoing_summery)): ?>
                            <?php $grand_total=0; foreach ($ongoing_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->segment_name?></td>
                                        <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'count_'.$key2->id;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                    <? $grand_total=$grand_total+$key->grand_total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $key2->id}.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
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
                                $total_col = count($req_type)+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Ongoing Cases</span><span style="float:right">Figure In Crore</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Type of Segment</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($ongoing_summery)): ?>
                            <?php $grand_total=0; foreach ($ongoing_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->segment_name?></td>
                                        <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'amount_'.$key2->id;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$name/10000000),2).'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->grand_amount/10000000),2)?></td>
                                    <? $grand_total=$grand_total+$key->grand_amount;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $key2->id}/10000000),2).'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
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
                                $total_col = count($req_type)+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">New Filling</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Type of Segment</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($new_filling_summery)): ?>
                            <?php $grand_total=0; foreach ($new_filling_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->segment_name?></td>
                                        <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'count_'.$key2->id;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                    <? $grand_total=$grand_total+$key->grand_total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $key2->id}.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
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
                                $total_col = count($req_type)+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">New Filling</span><span style="float:right">Figure In Crore</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Type of Segment</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($new_filling_summery)): ?>
                            <?php $grand_total=0; foreach ($new_filling_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->segment_name?></td>
                                        <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'amount_'.$key2->id;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$name/10000000),2).'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->grand_amount/10000000),2)?></td>
                                    <? $grand_total=$grand_total+$key->grand_amount;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $key2->id}/10000000),2).'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
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
                                $total_col = count($req_type)+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Dispoasal Summery</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Type of Segment</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($disposal_summery)): ?>
                            <?php $grand_total=0; foreach ($disposal_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->segment_name?></td>
                                        <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'count_'.$key2->id;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                    <? $grand_total=$grand_total+$key->grand_total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $key2->id}.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
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
                                $total_col = count($req_type)+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Disposal Summery</span><span style="float:right">Figure In Crore</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Type of Segment</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($disposal_summery)): ?>
                            <?php $grand_total=0; foreach ($disposal_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->segment_name?></td>
                                        <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'amount_'.$key2->id;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$name/10000000),2).'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->grand_amount/10000000),2)?></td>
                                    <? $grand_total=$grand_total+$key->grand_amount;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $key2->id}/10000000),2).'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
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
<?php if ($report_select=='case_report/officer_wise_summery'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});

        jQuery('#district,#zone').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:10%"><strong>Report Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="text-align:right;width:10%"><strong>district&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;width:5%"><strong>zone&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;width:10%;"><strong> Date From: </strong></td>
                                <td><input name="date_from" type="text" class="" id="date_from" value="<?=$date_from?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker ("date_from");</script></td>
                                <td style="width:5%"> &nbsp;&nbsp; <strong>To: </strong> &nbsp;&nbsp; </td>
                                <td><input name="date_to" type="text" class="" id="date_to" value="<?=$date_to?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker("date_to");</script></td>
                                <td ><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" onclick="get_search_data();" type="submit">
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
                <td style="width:100%">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="8">Protfolio Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Employee ID</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Present Deal Officer</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">New Filling</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Filling '%'</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal(Newly Filed)</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal Performance[Against PF]</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Overall Disposal Performance</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Overall Performance(New Filing & Disposal)</td>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php 
                            $new_filling_total=0;
                            $disposal_total_overall=0;
                            $disposal_total_new=0;
                            $ongoing_total=0;
                            $filing_parcent=0;
                            $total_filing_parcent=0;
                            $disposal_parcent=0;
                            $total_disposal_parcent=0;
                            $overall_disposal_performance=0;
                            $total_overall_disposal_performance=0;
                            $overall_performance=0;
                            $total_overall_performance=0;
                            foreach ($summery_result as $key): ?>
                                <?php   
                                    $new_filling_total=$new_filling_total+$key->new_filling;
                                    $disposal_total_overall=$disposal_total_overall+$key->disposal_overall;
                                    $disposal_total_new=$disposal_total_new+$key->disposal_new_filling;
                                    $ongoing_total=$ongoing_total+$key->ongoing;
                                    $filing_parcent = ($key->new_filling/(($key->ongoing+$key->disposal_overall)-$key->new_filling));
                                    $disposal_parcent = (($key->disposal_overall-$key->disposal_new_filling)/(($key->ongoing+$key->disposal_overall)-$key->new_filling));
                                    $overall_disposal_performance = ($key->disposal_overall/(($key->ongoing+$key->disposal_overall+$key->disposal_new_filling)-$key->new_filling));
                                    $overall_performance = ($filing_parcent+$overall_disposal_performance);
                                    $total_filing_parcent=$total_filing_parcent+$filing_parcent;
                                    $total_disposal_parcent=$total_disposal_parcent+$disposal_parcent;
                                    $total_overall_disposal_performance=$total_overall_disposal_performance+$overall_performance;
                                    $total_overall_performance=$total_overall_performance+$overall_performance;
                                 ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_id?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_deal_officer?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->new_filling?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($filing_parcent,2).'%'?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal_overall?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->disposal_new_filling?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($disposal_parcent,2).'%'?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($overall_disposal_performance,2).'%'?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=number_format($overall_performance,2).'%'?></td>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="2">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$new_filling_total;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_filing_parcent,2).'%'?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$disposal_total_overall;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$disposal_total_new;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$ongoing_total;?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_disposal_parcent,2).'%'?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_overall_disposal_performance,2).'%'?></td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=number_format($total_overall_performance,2).'%'?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="12">Disposal Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Employee ID</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Present Deal Officer</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                        </tr>
                        <?php if (!empty($disposal_summery_month_wise)): ?>
                            <?php 
                            foreach ($disposal_summery_month_wise as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_id?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_deal_officer?></td>
                                    <?php 
                                    for ($i=1; $i <=12 ; $i++) { 
                                        $month = 'count_'.$i;
                                        ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                    }
                                 ?>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                <?php
                                for ($i=1; $i <=12 ; $i++) {  //for Year loop
                                    
                                ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=${'total_' . $i}?></td>
                                <?php  } ?>
                            </tr>
                        <?php endif ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%">
                    <table style="width:100%">
                        <tr>
                            <td style="text-align:left;font-weight:bold" colspan="12">New Filing Summery</td>
                            <td style="text-align:right;font-weight:bold" colspan="2">No. of Cases</td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Employee ID</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Present Deal Officer</td>
                            <?php   
                                for ($i=1; $i <=12 ; $i++) { 
                                    ${'total_' . $i} = 0;
                                    $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                }
                             ?>
                        </tr>
                        <?php if (!empty($new_filing_month_wise)): ?>
                            <?php 
                            foreach ($new_filing_month_wise as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_id?></td>
                                    <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_deal_officer?></td>
                                    <?php 
                                    for ($i=1; $i <=12 ; $i++) { 
                                        $month = 'count_'.$i;
                                        ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                    }
                                 ?>
                                </tr>
                            <?php endforeach ?>
                            <!-- for show the total row -->
                            <tr style="border:1px solid black;color:black">
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                                <?php
                                for ($i=1; $i <=12 ; $i++) {  //for Year loop
                                    
                                ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=${'total_' . $i}?></td>
                                <?php  } ?>
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
                                $total_col = count($req_type)+3;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Ongoing Summery</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Employee ID</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Present Dealing Officer</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($ongoing_summery)): ?>
                            <?php $grand_total=0; foreach ($ongoing_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_id?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_deal_officer?></td>
                                        <?php $total=0; if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'count_'.$key2->id;
                                                    $total=$total+$key->$name;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$total?></td>
                                    <? $grand_total=$grand_total+$total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="2">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $key2->id}.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
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
                                $total_col = count($req_type)+3;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">New Filing Summery</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Employee ID</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Present Dealing Officer</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($new_filling_summery)): ?>
                            <?php $grand_total=0; foreach ($new_filling_summery as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_id?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_deal_officer?></td>
                                        <?php $total=0; if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'count_'.$key2->id;
                                                    $total=$total+$key->$name;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$total?></td>
                                    <? $grand_total=$grand_total+$total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;" colspan="2">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $key2->id}.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
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
<?php if ($report_select=='case_report/disposal_summery'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});

        jQuery('#district,#zone').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:10%"><strong>Report Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="text-align:right;width:10%"><strong>district&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;width:5%"><strong>zone&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;width:10%;"><strong> Date From: </strong></td>
                                <td><input name="date_from" type="text" class="" id="date_from" value="<?=$date_from?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker ("date_from");</script></td>
                                <td style="width:5%"> &nbsp;&nbsp; <strong>To: </strong> &nbsp;&nbsp; </td>
                                <td><input name="date_to" type="text" class="" id="date_to" value="<?=$date_to?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker("date_to");</script></td>
                                <td ><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search"  type="submit">
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
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                            <?php   
                                $total_col = count($req_type)+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Disposal Summery(overall)</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal Stages</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php $grand_total=0; foreach ($summery_result as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_status?></td>
                                        <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'count_'.$key2->id;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                    <? $grand_total=$grand_total+$key->grand_total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $key2->id}.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
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
                                $total_col = count($req_type)+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Disposal Summery(overall)</span><span style="float:right">Figure In Crore</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal Stages</td>
                            <?php if (!empty($req_type)): ?>
                                <?php foreach ($req_type as $key): ?>
                                    <?php 
                                        ${'total_' . $key->id} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key->name.'</td>';
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php $grand_total=0; foreach ($summery_result as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_status?></td>
                                        <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    $name = 'amount_'.$key2->id;
                                                    ${'total_' . $key2->id}=${'total_' . $key2->id}+$key->$name;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$name/10000000),2).'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->grand_amount/10000000),2)?></td>
                                    <? $grand_total=$grand_total+$key->grand_amount;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($req_type)): ?>
                                            <?php foreach ($req_type as $key2): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $key2->id}/10000000),2).'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
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
                                $total_col = 11+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Disposal Summery(overall)</span><span style="float:right">Number Of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal Stages</td>
                            
                                <?php 
                                    $current_year = date('Y');
                                    $from_year = $current_year-10;
                                    for ($i=$from_year; $i <=$current_year ; $i++) {
                                        ${'total_' . $i} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$i.'</td>';
                                    }
                                    
                                 ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($summery_result_year_wise)): ?>
                            <?php $grand_total=0; foreach ($summery_result_year_wise as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_status?></td>
                                                <?php 
                                                    $current_year = date('Y');
                                                    $from_year = $current_year-10;
                                                    for ($i=$from_year; $i <=$current_year ; $i++) {
                                                        $name = 'count_'.$i;
                                                        ${'total_' . $i}=${'total_' . $i}+$key->$name;//for every month total count
                                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$name.'</td>';
                                                    }
                                                    
                                                 ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                    <? $grand_total=$grand_total+$key->grand_total;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    
                                        <?php 
                                            $current_year = date('Y');
                                            $from_year = $current_year-10;
                                            for ($i=$from_year; $i <=$current_year ; $i++) {
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
                                $total_col = 11+2;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Disposal Summery(overall)</span><span style="float:right">Figure In Crore</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal Stages</td>
                            
                                <?php 
                                    $current_year = date('Y');
                                    $from_year = $current_year-10;
                                    for ($i=$from_year; $i <=$current_year ; $i++) {
                                        ${'total_' . $i} = 0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$i.'</td>';
                                    }
                                    
                                 ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($summery_result_year_wise)): ?>
                            <?php $grand_total=0; foreach ($summery_result_year_wise as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_status?></td>
                                                <?php 
                                                    $current_year = date('Y');
                                                    $from_year = $current_year-10;
                                                    for ($i=$from_year; $i <=$current_year ; $i++) {
                                                        $name = 'amount_'.$i;
                                                        ${'total_' . $i}=${'total_' . $i}+$key->$name;//for every month total count
                                                        echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$name/10000000),2).'</td>';
                                                    }
                                                    
                                                 ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->grand_amount/10000000),2)?></td>
                                    <? $grand_total=$grand_total+$key->grand_amount;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    
                                        <?php 
                                            $current_year = date('Y');
                                            $from_year = $current_year-10;
                                            for ($i=$from_year; $i <=$current_year ; $i++) {
                                                echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $i}/10000000),2).'</td>';
                                            }
                                            
                                         ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
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
                                $total_col = 14;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Disposal Summery(<?=date('Y')?>)</span><span style="float:right">Number Of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal Stages</td>
                            
                                <?php   
                                    for ($i=1; $i <=12 ; $i++) { 
                                        ${'total_' . $i} = 0;
                                        $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                    }
                                 ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($summery_result_month_wise)): ?>
                            <?php $grand_total=0; foreach ($summery_result_month_wise as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_status?></td>
                                            <?php   
                                                for ($i=1; $i <=12 ; $i++) { 
                                                    $month = 'count_'.$i;
                                                    ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.$key->$month.'</td>';
                                                }
                                             ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->grand_total?></td>
                                    <? $grand_total=$grand_total+$key->grand_total;?>
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
                                $total_col = 14;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Disposal Summery(<?=date('Y')?>)</span><span style="float:right">Figure In Crore</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Disposal Stages</td>
                            
                                <?php   
                                    for ($i=1; $i <=12 ; $i++) { 
                                        ${'total_' . $i} = 0;
                                        $month = date('F', mktime(0,0,0,$i, 1, date('Y')));
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$month.'</td>';
                                    }
                                 ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        </tr>
                        <?php if (!empty($summery_result_month_wise)): ?>
                            <?php $grand_total=0; foreach ($summery_result_month_wise as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_status?></td>
                                            <?php   
                                                for ($i=1; $i <=12 ; $i++) { 
                                                    $month = 'amount_'.$i;
                                                    ${'total_' . $i}=${'total_' . $i}+$key->$month;//for every month total count
                                                    echo '<td style="border:1px solid black;color:black;text-align: center;">'.round(($key->$month/10000000),2).'</td>';
                                                }
                                             ?>
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=round(($key->grand_amount/10000000),2)?></td>
                                    <? $grand_total=$grand_total+$key->grand_amount;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    
                                    <?php   
                                        for ($i=1; $i <=12 ; $i++) { 
                                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.round((${'total_' . $i}/10000000),2).'</td>';
                                        }
                                     ?>
                                     <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=round(($grand_total/10000000),2)?></td>
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
<?php if ($report_select=='case_report/case_update_summery'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});

        jQuery('#district,#zone').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
    });
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                   <div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:10%"><strong>Report Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="text-align:right;width:10%"><strong>district&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                                <td style="text-align:right;width:5%"><strong>zone&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="zone" name="zone"></div></td>
                                <td style="text-align:right;width:10%;"><strong> Date From: </strong></td>
                                <td><input name="date_from" type="text" class="" id="date_from" value="<?=$date_from?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker ("date_from");</script></td>
                                <td style="width:5%"> &nbsp;&nbsp; <strong>To: </strong> &nbsp;&nbsp; </td>
                                <td><input name="date_to" type="text" class="" id="date_to" value="<?=$date_to?>" style="width:100px" placeholder="dd/mm/yyyy" /><script>datePicker("date_to");</script></td>
                                <td ><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" onclick="get_search_data();" type="submit">
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
                                $total_col = count($grid_columns)+4;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Case Update Summery</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Employee ID</td>
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Present Dealing Officer </td>
                            <?php if (!empty($grid_columns)): ?>
                                <?php foreach ($grid_columns as $key => $value): ?>
                                    <?php 
                                        ${'total_' . $value}=0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key.'</td>';
                                     ?>
                                <?php endforeach ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Next Date Available</td>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing Cases</td>
                        </tr>
                        <?php if (!empty($summery_officer_result)): ?>
                            <?php $grand_total=0;$next_total=0; foreach ($summery_officer_result as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_id?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_name?></td>
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
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <? $grand_total=$grand_total+$key->ongoing_cases;$next_total=$next_total+$key->next_date_available;?>
                                </tr>
                            <?php endforeach ?>
                            <!-- FOR SHOW THE TOTAL ROW -->
                            <tr style="border:1px solid black;color:black">
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                                    <?php if (!empty($grid_columns)): ?>
                                            <?php foreach ($grid_columns as $key2 => $value): ?>
                                                <?php 
                                                    echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $value}.'</td>';
                                                 ?>
                                            <?php endforeach ?>
                                            <?php   
                                                echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$next_total.'</td>';
                                             ?>
                                        <?php endif ?>
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
                                $total_col = count($grid_columns)+3;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Case Update Summery</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Nature Of Suit</td>
                            <?php if (!empty($grid_columns)): ?>
                                <?php foreach ($grid_columns as $key => $value): ?>
                                    <?php 
                                        ${'total_' . $value}=0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key.'</td>';
                                     ?>
                                <?php endforeach ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Next Date Available</td>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing Cases</td>
                        </tr>
                        <?php if (!empty($summery_result)): ?>
                            <?php $grand_total=0;$next_total=0; foreach ($summery_result as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_type?></td>
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
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <? $grand_total=$grand_total+$key->ongoing_cases;$next_total=$next_total+$key->next_date_available;?>
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
                                            <?php   
                                                echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$next_total.'</td>';
                                             ?>
                                        <?php endif ?>
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
                                $total_col = count($grid_columns)+3;
                             ?>
                            <td style="text-align:left;font-weight:bold" colspan="<?=$total_col;?>"><span style="float:left">Case Update Summery(Next Steps)</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Case Step</td>
                            <?php if (!empty($grid_columns)): ?>
                                <?php foreach ($grid_columns as $key => $value): ?>
                                    <?php 
                                        ${'total_' . $value}=0;
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$key.'</td>';
                                     ?>
                                <?php endforeach ?>
                                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Next Date Available</td>
                            <?php endif ?>
                             <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Ongoing Cases</td>
                        </tr>
                        <?php if (!empty($summery_result_next_step_wise)): ?>
                            <?php $grand_total=0;$next_total=0; foreach ($summery_result_next_step_wise as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_status?></td>
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
                                         <td style="border:1px solid black;color:black;text-align: center;"><?=$key->ongoing_cases?></td>
                                    <? $grand_total=$grand_total+$key->ongoing_cases;$next_total=$next_total+$key->next_date_available;?>
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
                                            <?php   
                                                echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$next_total.'</td>';
                                             ?>
                                        <?php endif ?>
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
                          <td style="text-align:left;font-weight:bold" colspan="11"><span style="float:left">Next Week Pending Cases</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Employee ID</td>
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Present Dealing Officer </td>
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
                        <?php if (!empty($summery_officer_week_result)): ?>
                            <?php $grand_total=0;$next_total=0; foreach ($summery_officer_week_result as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_id?></td>
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->user_name?></td>
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
                               <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"></td>
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
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                          <td style="text-align:left;font-weight:bold" colspan="11"><span style="float:left">Next Week Pending Cases</span><span style="float:right">No. of Cases</span></td>
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
                        <?php if (!empty($summery_nature_week_result)): ?>
                            <?php $grand_total=0;$next_total=0; foreach ($summery_nature_week_result as $key): ?>
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
            <tr>
                <td style="width:100%" colspan="4">
                    <table style="width:100%">
                        <tr>
                          <td style="text-align:left;font-weight:bold" colspan="11"><span style="float:left">Next Week Pending Cases</span><span style="float:right">No. of Cases</span></td>
                        </tr>
                        <tr style="border:1px solid black;color:black">
                            <td bgcolor="#5B9BD5" rowspan="2" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Case Status</td>
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
                        <?php if (!empty($summery_step_week_result)): ?>
                            <?php $grand_total=0;$next_total=0; foreach ($summery_step_week_result as $key): ?>
                                <tr style="border:1px solid black;color:black">
                                   <td style="border:1px solid black;color:black;text-align: center;"><?=$key->case_status?></td>
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
<?php if ($report_select=='case_report/case_activity_report'): ?>
    <script type="text/javascript">
    jQuery().ready(function() {
        var theme = 'classic';

        var cdo = [<? $i=1; foreach($cdo as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->user_id.')"}';$i++;}?>];
        var nature = [<? $i=1; foreach($nature as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var segment = [<? $i=1; foreach($segment as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        var zone = [<? $i=1; foreach($zone as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#cdo").jqxComboBox({theme: theme, promptText: "Dealing Officer", source: cdo, width: '98%', height: 25});
        jQuery("#nature").jqxComboBox({theme: theme, promptText: "Nature of Suit", source: nature, width: '98%', height: 25});
        jQuery("#segment").jqxComboBox({theme: theme, promptText: "Select Segment", source: segment, width: '98%', height: 25});
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '98%', height: 25});
        jQuery("#zone").jqxComboBox({theme: theme, promptText: "Select zone", source: zone, width: '98%', height: 25});
        
        jQuery('#cdo,#nature,#segment,#district,#zone').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#cdo").jqxComboBox('val','<?=$cdo_select?>');
        jQuery("#nature").jqxComboBox('val','<?=$nature_select?>');
        jQuery("#segment").jqxComboBox('val','<?=$segment_select?>');
        jQuery("#district").jqxComboBox('val','<?=$dist_select?>');
        jQuery("#zone").jqxComboBox('val','<?=$zone_select?>');
        
    });
   
    </script>
    <div id="container" style="">
        <div id="body"  >
            <div  style="display:block; height:auto">
                <form method="POST" name="form" id="report_search"  style="margin:0px;" action="">
                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                   <div style="padding: 0.5%;width:98%;height:60px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:10%"><strong>Report Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:20%"><div style="padding-left:1.8%" id="report_list" name="report_list"></div></td>
                                <td style="width:10%">Dealling Officer: </td>
                                <td style="width:20%"><div id="cdo" name="cdo"></div></td>
                                <td style="width:10%">Nature of Suit: </td>
                                <td style="width:20%"><div id="nature" name="nature"></div></td>
                                
                                
                                <td ><input name="search_btn" id="search_btn" class="crmbutton small create"  value="Search" type="submit">
                                </td>
                            </tr>
                            <tr>
                                <td style="width:10%">Type of Segment: </td>
                                <td style="width:20%"><div id="segment" name="segment"></div></td>
                                <td style="width:10%">district: </td>
                                <td style="width:20%"><div id="district" name="district"></div></td>
                                <td style="width:10%">Zone: </td>
                                <td style="width:20%"><div id="zone" name="zone"></div></td>
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
    <div id="search_details" style="border:1px solid #ddd;overflow-x: scroll;">
        <table style="width:100%">
            
            <tr style="border:1px solid black;color:black">
                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Stages <br>Previous/ Next</td>
                    <?php if (!empty($next_step)){ 
                        foreach ($next_step as $key => $value){ ?>
                        <?php 
                            ${'total_' . $key}=0;
                            echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.$value->case_status.'</td>';
                        
                         ?>
                        
                    <?php }
                    } ?>
                <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Grand Total</td>
            </tr>
            <?php if (!empty($prv_step)): ?>
                <?php $grand_total=0;$next_total=0; foreach ($prv_step as $key=>$val): ?>
                    <tr style="border:1px solid black;color:black">
                       <td style="border:1px solid black;color:black;text-align: center;"><?=$val->case_status?></td>
                            <?php 
                                if (!empty($next_step)): ?>
                                <?php foreach ($next_step as $key2 => $value): ?>
                                    <?php 
                                        $bg_color='';
                                        if($val->case_sts_prev_dt==$value->case_sts_next_dt){ // Highlignt next and previous step
                                            $bg_color = 'background:#203764;color:#fff;';
                                        }
                                        $name = 'step_'.$key2;
                                        if($val->$name>0){
                                        ${'total_' . $key2}=${'total_' . $key2}+$val->$name;//for every column total
                                        echo '<td style="border:1px solid black;color:black;text-align: center;'.$bg_color.'">'.$val->$name.'</td>';
                                        }else{
                                           echo '<td style="border:1px solid black;color:black;text-align: center;"></td>'; 
                                        }
                                     ?>
                                <?php endforeach ?>
                            <?php endif ?>
                            <td style="border:1px solid black;color:black;text-align: center;"><?=$val->total?></td>
                        <? $grand_total=$grand_total+$val->total;?>
                    </tr>
                <?php endforeach ?>
                <!-- FOR SHOW THE TOTAL ROW -->
                <tr style="border:1px solid black;color:black">
                   <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">Total</td>
                        <?php if (!empty($next_step)): 
                                foreach ($next_step as $key => $value): ?>
                                    <?php 
                                        echo '<td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;">'.${'total_' . $key}.'</td>';
                                       
                                     ?>
                                <?php endforeach ?>
                                
                            <?php endif ?>
                         <td bgcolor="#5B9BD5" style="border:1px solid black;color:black;font-weight:bold;text-align: center;"><?=$grand_total?></td>
                </tr>
            <?php endif ?>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
<?php endif ?>




