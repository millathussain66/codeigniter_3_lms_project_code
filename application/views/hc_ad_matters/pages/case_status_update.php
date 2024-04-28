<?php $this->load->view('hc_ad_matters/pages/css'); ?>
<style>
    .newbuttonStyle:hover{
        background-color: #4329ff!important;
        color: #fff!important;
    }
    
</style>

<script type="text/javascript">
    var theme = 'classic';
    var csrf_tokens='';

    var court = [<? $i=1; foreach($court as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var case_step = [<? $i=1; foreach($case_status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    //var vendor = [<? //$i=1; foreach($paper_vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var district = [<? //$i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var activites = [<? //$i=1; foreach($expenses_activities as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var expense_activities = [];
    var expense_type = [<? //$i=1; foreach($expenses_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var staff = [];
    var vendor = [];
    var case_category = [];
    var case_type = [];
    var hc_division = [<? $i=1; foreach($hc_division as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var case_year = [<?php for($i=date('Y');$i>2000;$i--){echo $i.',';}?>];

    var rule ='';
    jQuery(document).ready(function () {

        //jQuery("#court_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
        jQuery("#case_step").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Status", source: case_step, width: 250, height: 25});
        jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});

        jQuery("#hc_division").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Division", source: hc_division, width: 150, height: 25});
        jQuery("#case_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: case_type, width: 150, height: 25});
        jQuery("#case_category").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Category", source: case_category, width: 150, height: 25});
        jQuery("#case_year").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: " Year", source: case_year, width: 60, height: 25});
        

        jQuery('#case_step,#lawyer,#hc_division,#case_type,#case_category,#case_year').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        
        var html = '';
        html+='<img style="cursor:pointer"  src="<?=base_url()?>/images/upload-file.png" alt="upload" title="Upload" onclick="CustomerPickList(\'legal\',\'noc_file\')"/>';
        html+='<input type="hidden" id="hidden_noc_file_select" name="hidden_noc_file_select" value="0">';
        html+='<span id="hidden_noc_file">';
        jQuery('#noc_file').html(html);

        jQuery('#case_step').bind('change',function(){
            var item = jQuery('#case_step').jqxComboBox('getSelectedItem');
            if(item!=null){
                if(item.value==2){
                    jQuery('#entry_row').show();
                    jQuery('#from_row').hide();
                    jQuery('#to_row').hide();
                }else if(item.value==3){
                    jQuery('#entry_row').hide();
                    jQuery('#from_row').show();
                    jQuery('#to_row').show();
                }else{
                    jQuery('#entry_row').hide();
                    jQuery('#from_row').hide();
                    jQuery('#to_row').hide();
                }
            }
        });
        // Add edit form validation

        
        
        jQuery('#action_form').jqxValidator({
            focus: true,
            rules: [
                
                { input: '#case_step', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#case_step").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='case_step']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                }, 
                { input: '#from_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                        var item = jQuery("#case_step").jqxComboBox('getSelectedItem');
                        if(item!=null){
                            if(item.value==3){
                                if (input.val()!='') {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            }
                            
                        }
                        return true;
                        
                    } 
                },
                { input: '#from_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                        if (!input.val()) {
                            return true;
                            }
                            if(validate_date(input.val()))
                            {
                                return true;
                            }else {
                                return false;
                            }
                        } 
                }, 
                { input: '#to_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                        var item = jQuery("#case_step").jqxComboBox('getSelectedItem');
                        if(item!=null){
                            if(item.value==3){
                                if (input.val()!='') {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            }
                            
                        }
                        return true;
                        
                    } 
                },
                { input: '#to_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                        if (!input.val()) {
                            return true;
                            }
                            if(validate_date(input.val()))
                            {
                                return true;
                            }else {
                                return false;
                            }
                        } 
                }, 
                { input: '#entry_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                        var item = jQuery("#case_step").jqxComboBox('getSelectedItem');
                        if(item!=null){
                            if(item.value==2){
                                if (input.val()!='') {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            }
                            
                        }
                        return true;
                        
                    } 
                },
                { input: '#entry_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                        if (!input.val()) {
                            return true;
                            }
                            if(validateDate(input.val(),'advance'))
                            {
                                return true;
                            }else {
                                return false;
                            }
                        } 
                }, 
                { input: '#disposed_order_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                        if (input.val()!='') {
                            return true;
                        }
                        else {
                            return false;
                        }
                    } 
                },
                { input: '#disposed_order_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                        if (!input.val()) {
                            return true;
                        }
                        if(validateDate(input.val(),'advance'))
                        {
                            return true;
                        }else {
                            return false;
                        }
                    } 
                }, 
                
                { input: '#next_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                        if (!input.val()) {
                            return true;
                            }
                            if(validate_date(input.val()))
                            {
                                return true;
                            }else {
                                return false;
                            }
                        } 
                },
                
          
        ]
        });
        
        // Jqx tab second tab function start    Grid Show
        var initGrid2 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'final_remarks', type: 'int'},
                    { name: 'last_sts_up_id', type: 'int'},
                    { name: 'request_name', type: 'string'},
                    { name: 'serial_no', type: 'string'},
                    { name: 'received_date', type: 'string'},
                    { name: 'remarks', type: 'string'},
                    { name: 'request_file', type: 'string'},
                    { name: 'e_by', type: 'string'},
                    { name: 'e_dt', type: 'string'},
                    { name: 'status', type: 'string'},
                    { name: 'case_sts_name', type: 'string'},
                    { name: 'case_number', type: 'string'},
                    { name: 'case_year', type: 'string'},
                    { name: 'account_number', type: 'string'},
                    { name: 'account_name', type: 'string'},
                    { name: 'case_filing_date', type: 'string'},
                    { name: 'next_date', type: 'string'},
                    { name: 'sts', type: 'int'},       
                    { name: 'v_sts', type: 'sts'},        
                    { name: 'cdo_sts', type: 'sts'},        
                    { name: 'a_cdo', type: 'sts'},        
                    { name: 'cdo_life_cycle', type: 'sts'},        
                    { name: 'life_cycle', type: 'sts'},        
                    { name: 'up_v_sts', type: 'sts'},        
                    { name: 'up_stc', type: 'sts'},        
                    { name: 'up_verify', type: 'sts'},        
                    { name: 'up_status', type: 'sts'},   
                    { name: 'for_verify', type: 'int'},   
                    { name: 'sts_v_sts', type: 'int'},
                    { name: 'hc_division_name', type: 'string'},
                    { name: 'case_category_name', type: 'string'},
                    { name: 'nature_of_suit', type: 'string'},
                    { name: 'hc_type_name', type: 'string'},          
                    { name: 'account_number', type: 'string'},          
                    { name: 'account_name', type: 'string'},          
                    { name: 'branch_name', type: 'string'},          
                ],
                addrow: function (rowid, rowdata, position, commit) {
                  commit(true);
                },
                deleterow: function (rowid, commit) {
                    commit(true);
                },
                updaterow: function (rowid, newdata, commit) {
                    commit(true);
                },
                url: '<?=base_url()?>hc_ad_matters/sts_up_grid',
                cache: false,
                filter: function()
                {
                    // update the grid and send a request to the server.
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                },
                sort: function()
                {
                    // update the grid and send a request to the server.
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
                },
                root: 'Rows',
                beforeprocessing: function(data)
                {
                    if (data != null)
                    {
                        //alert(data[0].TotalRows)
                        source.totalrecords = data[0].TotalRows;
                    }
                }

            };

            var dataadapter = new jQuery.jqx.dataAdapter(source, {
                loadError: function(xhr, status, error){
                    alert(error);
                },
                formatData:function(data){
                    var hc_division = jQuery.trim(jQuery('#hc_division').val());
                    var case_number = jQuery.trim(jQuery('#case_number').val());
                    var case_category = jQuery.trim(jQuery('#case_category').val());
                    var case_type = jQuery.trim(jQuery('#case_type').val());
                    var case_year = jQuery.trim(jQuery('#case_year').val());
                    
                    jQuery.extend(data, {
                            hc_division : hc_division,
                            case_number : case_number,
                            case_category : case_category,
                            case_type : case_type,
                            case_year : case_year,
                    });
                    return data;
                }
            });
            var columnCheckBox = null;
            var updatingCheckState = false;
            // initialize jqxGrid. Disable the built-in selection.
            var celledit = function (row, datafield, columntype) {
                var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                if (checked == false) {
                  return false;
                };
            };
            var win_h=jQuery( window ).height()-280;
            jQuery("#jqxGrid2").jqxGrid({
                width:'100%',
                height:win_h,
                source: dataadapter,
                theme: theme,
                filterable: true,
                sortable: true,
                //autoheight: true,
                pageable: true,
                virtualmode: true,
                editable: true,
                enablehover: true,
                enablebrowserselection: true,
                selectionmode: 'none',
                rendergridrows: function(obj){
                    return obj.data;
                },
                columns: [

                    { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                    { text: 'v_sts', datafield: 'v_sts',hidden:true },
                    { text: 'cdo_sts', datafield: 'cdo_sts',hidden:true },
                    { text: 'sts', datafield: 'sts',hidden:true },
                    <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.up_v_sts == 1 ){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                    <?php } ?>
                    <?php if(EDIT==1){ ?>
                    { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        if(dataRecord.final_remarks == 2){
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }else{
                            
                        if(dataRecord.up_v_sts == 1 ){
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+',\'edit\')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                        }else if( dataRecord.up_v_sts == null || dataRecord.up_v_sts == '' || (dataRecord.up_verify>0 && dataRecord.up_v_sts == 0 && dataRecord.up_stc==0) ){
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+',\'add\')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                        }
                        else
                        {
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }
                        }
                    }
                    },
                    <?php } ?>
                    { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                          }
                    },
                    <?php if(SENDTOCHECKER==1){ ?>
                    { text: 'STC', menu: false, datafield: 'sendtochecker', align:'center', editable: false, sortable: false, width: '4%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        var user_group = '<?=$this->session->userdata['ast_user']['user_work_group_id']?>';
                        if(dataRecord.up_v_sts == 1 ){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                        }
                        else
                        {
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }
                        }
                    },
                    <?php } ?>
                    
                    <?php if(VERIFY==1){ ?>
                    { text: 'V', menu: false, datafield: 'verify', align:'center', editable: false, sortable: false, width: '6%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        var user_group = '<?=$this->session->userdata['ast_user']['user_work_group_id']?>';
                        if(dataRecord.up_stc == 1 ){// verify for cdo
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
                        }
                        else
                        {
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }
                        }
                    },
                    <?php } ?>
                    
                    { text: 'Status', datafield: 'up_status',editable: false, width: '20%'},
                    { text: 'AC Number', datafield: 'account_number',filterable:true,sortable:true,editable: false, width: '13%'},
                    { text: 'AC Name', datafield: 'account_name',filterable:true,sortable:true,editable: false, width: '25%'},
                    { text: 'Branch Name', datafield: 'branch_name',filterable:true,sortable:true,editable: false, width: '25%'},
                    { text: 'Case Step', datafield: 'case_sts_name',editable: false, width: '13%'},
                    { text: 'Division Name', datafield: 'hc_division_name',editable: false, width: '15%'},
                    { text: 'Case Category', datafield: 'case_category_name',editable: false, width: '15%'},
                    { text: 'Case Type', datafield: 'hc_type_name',editable: false, width: '10%'},
                    { text: 'Nature Of Suit', datafield: 'nature_of_suit',editable: false, width: '10%'},
                    { text: 'Case Number', datafield: 'case_number',editable: false, width: '13%'},
                    // { text: 'Case Year', datafield: 'case_year',editable: false, width: '8%'},
                    
                    { text: 'Case Filing Date', datafield: 'case_filing_date',editable: false, width: '13%'},
                    { text: 'Remarks', datafield: 'remarks',editable: false, width: '13%'},
                    { text: 'Entry By', datafield: 'e_by',editable: false, width: '13%'},
                    { text: 'Entry DateTime', datafield: 'e_dt',editable: false, width: '15%'},
                    
                ],
                        
            });
               
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#verifycancel,#checkercancel") });
            jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
            jQuery('#details').on('close', function (event) {
                jQuery('#delete_convence').jqxValidator('hide');
                
            });
           
        }
        
        // jqx tab init
        var initWidgets = function (tab) {
            switch (tab) {
                case 0:
                    initGrid2();
                    break;
                case 1:
                    
                    break;
            }
        }
        //document.getElementById("jqxTabs").style.minHeight = "280px";
        jQuery('#jqxTabs').jqxTabs({ width: '99%', initTabContent: initWidgets });
        
        jQuery('#jqxTabs').bind('selected', function (event) {

            if(event.args.item==0){
                clear_form();
                jQuery('#jqxTabs').jqxTabs('disableAt', 1);
            }
            jQuery('#action_form').jqxValidator('hide');
            //clear_form();
        });
        jQuery('#jqxTabs').jqxTabs('disableAt', 1);
        <?php if(EDIT!=1){?>
        jQuery('#jqxTabs').jqxTabs('disableAt', 1);
        jQuery('#jqxTabs').jqxTabs('select', 0);
        <?php  } ?>

        // Loand Excel
        var delete_rule = [
                    { input: '#comments', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#comments").val()=='')
                        {
                            jQuery("#comments").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                    },

                    { input: '#comments', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(input.val().length>250)
                            {
                                jQuery("#comments").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
                
                ];
        
        // Add Form Submit
        jQuery("#in_req_button").click( function() {
            var item = jQuery('#lawyer').jqxComboBox('getSelectedItem');
            if(item!=null){
                if (jQuery("#hidden_noc_file_select").val()==0) {
                    alert('Please Upload NOC Scan File');
                    return false;
                }
                
            }
            
            //var x=jQuery("#add_expense").is(":checked");
            var validationResult = function (isValid) {
                if (isValid) {
                    jQuery("#in_req_button").hide();
                    jQuery("#in_req_loading").show();
                    call_ajax_submit();
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);        
        });

        // Update Edit Form Submit
        jQuery("#in_up_button").click( function() {
            var item = jQuery('#lawyer').jqxComboBox('getSelectedItem');
            if(item!=null){
                if (jQuery("#hidden_noc_file_select").val()==0 && jQuery('#file_delete_value_noc_file').val()==1) {
                    alert('Please Upload NOC Scan File');
                    return false;
                }
                
            }
            //var x=jQuery("#add_expense").is(":checked");
            var validationResult = function (isValid) {
                if (isValid ) {
                    jQuery("#in_up_button").hide();
                    jQuery("#in_up_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
                    
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);        
        });
        // Delete Form Validation 
        
        // Delete Ajax call
        jQuery("#delete_button").click(function () {
            rule = delete_rule;
            jQuery('#delete_convence').jqxValidator({
                rules: rule
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    jQuery("#delete_button").hide();
                    jQuery("#deletecancel").hide();
                    jQuery("#delete_loading").show();
                    delete_submit();
                }
            }
            jQuery('#delete_convence').jqxValidator('validate', validationResult);
         });
       
        jQuery("#verify_button").click(function () {
                jQuery('#type').val('verify');
                jQuery("#verify_button").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            
        });
        jQuery("#approve_reject").click(function () {
            jQuery("#approve_return_row").show();
            jQuery('#type').val('approve_reject');
            var d = confirm('Please Give Hold Reason');
            alert(d);
            return false;
            if(jQuery("#return_reason_approve").val()=='')
            {
               alert('Please Give Hold Reason');
                jQuery("#return_reason_approve").focus();
                return false; 
            }
            else
            {
                jQuery("#approve_return_row").hide();
                jQuery("#approve_return").hide();
                jQuery("#approve_reject").hide();
                jQuery("#approvecancel").hide();
                jQuery("#approve_loading").show();
                delete_submit();
            }
        });
        jQuery("#approve_return").click(function () {
            jQuery("#approve_return_row").show();
            jQuery('#type').val('approve_return');
            if(jQuery("#return_reason_approve").val()=='')
            {
               alert('Please Give Correction Reason');
                jQuery("#return_reason_approve").focus();
                return false; 
            }
            else
            {
                jQuery("#approve_return_row").hide();
                jQuery("#approve_return").hide();
                jQuery("#approve_reject").hide();
                jQuery("#approvecancel").hide();
                jQuery("#approve_loading").show();
                delete_submit();
            }
        });
        jQuery("#checker_button").click(function () {
            
            jQuery("#checker_button").hide();
            jQuery("#checkercancel").hide();
            jQuery("#checker_loading").show();
            delete_submit();
            
        });

    });
var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
function clearCount() { count=0; maxrow = 0;displayrow= 0;}
function search_data(){
    jQuery("#jqxGrid2").jqxGrid('updatebounddata');
    return;
}
function call_ajax_submit(){
    
    var postdata = jQuery('#action_form').serialize();
    var add_edit = jQuery("#add_edit").val();
    var edit_row = jQuery("#edit_row").val();
    
    //console.log(postdata);
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_ad_matters/status_update_add_edit_action",
        data : postdata,
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            //console.log(json);
            //csrf_tokens=json.csrf_token;
            if(json.Message!='OK')
            {
                if(add_edit=='edit'){
                    jQuery("#in_up_loading").hide();
                    jQuery("#in_up_button").show();
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    
                }else{
                    jQuery("#in_req_button").show();
                    jQuery("#in_req_loading").hide();
                }
                var err = json.Message.split(" ");
                if(err[1]!='out'){jQuery("#"+err[1]).focus();}
                alert(json.Message);
                
                return false;
            }
            var msg='';
            if(edit_row>0){
                msg='Updated';
            }else{
                msg="Saved";
            }
            clear_form();
            jQuery("#error").show();
            jQuery("#error").fadeOut(11500);
            jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
            if(add_edit=='edit'){
                jQuery("#in_up_loading").hide();
                jQuery("#in_up_button").show();
                jQuery('#jqxTabs').jqxTabs('select', 0);
            }else{
                jQuery("#in_req_button").show();
                jQuery("#in_req_loading").hide();
            }
            jQuery('#jqxTabs').jqxTabs('select', 0);
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
        }
    });
}
function delete_submit(){
    var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
    var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
    var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
    //console.log(postData);
    //return false
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: '<?=base_url()?>hc_ad_matters/sts_udate_delete_action/',
        data : postData,
        datatype: "json",
        success: function(response){

            var json = jQuery.parseJSON(response);
            //console.log(json);
            jQuery('.txt_csrfname').val(json.csrf_token);
            if(json.Message!='OK')
            {                               
                if ($('type').value=='delete') 
                {
                    jQuery("#delete_button").show();
                    jQuery("#deletecancel").show();
                    jQuery("#delete_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if ($('type').value=='verify') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if($('type').value=='sendtochecker'){
                    jQuery("#checker_button").show();
                    jQuery("#checkercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else{
                    jQuery("#sendtochecker").show();
                    jQuery("#checker_button").show();
                    jQuery("#checker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }
                return false;
            }else{

                if ($('type').value=='delete') 
                {
                    jQuery("#delete_button").show();
                    jQuery("#deletecancel").show();
                    jQuery("#delete_loading").hide();
                }else if ($('type').value=='verify') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery('#details').jqxWindow('close');
                }else if ($('type').value=='sendtochecker') {

                    jQuery("#checker_button").show();
                    jQuery("#checkercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    
                }
                else
                {
                    jQuery("#sendtochecker").show();
                    jQuery("#checker_button").show();
                    jQuery("#checker_loading").hide();
                }
                var msz='';
                jQuery("#error").show();
                jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                jQuery('#details').jqxWindow('close');
                jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                
                        
            }
        }
    });
}
function edit(id,editrow,add_edit){
    clear_form();
    jQuery('#jqxTabs').jqxTabs('enableAt', 1);
    jQuery('#jqxTabs').jqxTabs('select', 1);
    if(add_edit=='add'){
        jQuery("#add_row").show();
        jQuery("#update_row").hide();
    }else{
        jQuery("#add_row").hide();
        jQuery("#update_row").show();
    }
    
    jQuery('#add_edit').val(add_edit);
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
   // console.log(dataRecord);
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_ad_matters/get_sts_update_edit_info",
        data : {[csrfName]: csrfHash,id:id},
        datatype: "json",
        async:false,
        success: function(response){
            
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            var expense = json.expense;
            //console.log(rows);
            jQuery("#account_name").html(rows.account_name);
            jQuery("#petitioner_name").html(rows.petitioner);
            jQuery("#prv_cdo").html(rows.prv_cdo);
            jQuery("#division").html(rows.case_division);
            jQuery("#p_case_category").html(rows.case_category_name);
            jQuery("#p_case_type").html(rows.case_type_name);
            jQuery("#prv_case_step").html(rows.prv_case_step);
            jQuery("#prv_remarks").html(rows.remarks_prv);
            jQuery("#prv_lawyer").html(rows.lawyer_name_prv);
            jQuery("#s_case_number").html(rows.case_number);
            jQuery("#pre_lawyer").val(rows.prv_lawyer);

            //jQuery('#court_name').jqxComboBox('clearSelection');
            //jQuery('#court_name').jqxComboBox('val',rows.court_name!=0?rows.court_name:'');
            //jQuery('#lawyer').jqxComboBox('clearSelection');
            //jQuery('#lawyer').jqxComboBox('val',rows.lawyer!=0?rows.lawyer:'');
            if(add_edit=='add'){
                jQuery('#case_step').jqxComboBox('clearSelection');
                jQuery("#remarks").val('');
                jQuery("#next_date").val('');
            }else{

                if(rows.lawyer!=rows.prv_lawyer){
                    var noc_file = rows.noc_file;
                    var html = '';
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload-file.png" alt="upload" title="Upload" onclick="CustomerPickList(\'legal\',\'noc_file\')"/>';
                    html+='<input type="hidden" id="hidden_noc_file_select" name="hidden_noc_file_select" value="0">';
                    if(noc_file!='' && noc_file!=null)
                    {
                        html +='<span id="hidden_noc_file"><img id="file_preview_req_scan_file" onclick="popup(\'<?=base_url()?>legal_unit/subordinate_case/noc_file/'+noc_file+'\')" style="cursor:pointer;text-align:center;padding-left:5px;" src="<?=base_url()?>images/file_preview.png"></span>';
                        html +='<input type="hidden" id="hidden_noc_file_value" name="hidden_noc_file_value" value="'+noc_file+'">';
                        html +='<img id="file_delete_noc_file" onclick="file_delete(\'noc_file\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                        html +='<input type="hidden" id="file_delete_value_noc_file" name="file_delete_value_noc_file" value="0">';
                    }
                    else
                    {
                        html+='<span id="hidden_noc_file">';
                    }
                    html+='<span id="hidden_noc_file">';
                    jQuery('#noc_file').html(html);
                }

                jQuery('#lawyer').jqxComboBox('clearSelection');
                jQuery('#lawyer').jqxComboBox('val',rows.lawyer!=0?rows.lawyer:'');

                jQuery('#case_step').jqxComboBox('clearSelection');
                jQuery('#case_step').jqxComboBox('val',rows.case_status!=0?rows.case_status:'');
                //jQuery("#case_sts_date").val(rows.case_date);
                //jQuery("#last_activites").val(rows.last_act);
                
                if(rows.case_status==2){
                    jQuery('#from_date').val('');
                    jQuery('#to_date').val('');
                    jQuery('#entry_row').show();
                    jQuery('#from_row').hide();
                    jQuery('#to_row').hide();
                    jQuery('#entry_date').val(rows.entry_date);

                }else if(rows.case_status==3){
                    jQuery('#entry_date').val('');
                    jQuery('#entry_row').hide();
                    jQuery('#from_row').show();
                    jQuery('#to_row').show();
                    jQuery('#from_date').val(rows.stay_from_date);
                    jQuery('#to_date').val(rows.stay_to_date);
                }else{
                    jQuery('#entry_date').val('');
                    jQuery('#from_date').val('');
                    jQuery('#to_date').val('');
                    jQuery('#entry_row').hide();
                    jQuery('#from_row').hide();
                    jQuery('#to_row').hide();
                    
                }
                
                jQuery("#remarks").val(rows.remarks);
                jQuery("#next_date").val(rows.next_date);
                jQuery("#disposed_order_date").val(rows.disposed_order_date);
            }
            
            jQuery('#edit_row').val(rows.id);
            jQuery('#sub_id').val(id);
        }
    });
    jQuery('#jqxTabs').jqxTabs('select', 1);
}
function clear_form(){
    //jQuery('#court_name').jqxComboBox('clearSelection');
    //jQuery("input[name='court_name']").val('');
    jQuery('#lawyer').jqxComboBox('clearSelection');
    jQuery("input[name='lawyer']").val('');
    jQuery('#case_step').jqxComboBox('clearSelection');
    jQuery("input[name='case_step']").val('');
    jQuery("#edit_row").val('');
    //jQuery("#case_sts_date").val('');
    //jQuery("#last_activites").val('');
    jQuery("#remarks").val('');
    jQuery("#disposed_order_date").val('');
    jQuery("#next_date").val('');
    jQuery("#entry_date").val('');
    jQuery("#to_date").val('');
    jQuery("#from_date").val('');
    jQuery("#add_edit").val('add');

    var html = '';
    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload-file.png" alt="upload" title="Upload" onclick="CustomerPickList(\'legal\',\'noc_file\')"/>';
    html+='<input type="hidden" id="hidden_noc_file_select" name="hidden_noc_file_select" value="0">';
    html+='<span id="hidden_noc_file">';
    jQuery('#noc_file').html(html);

    jQuery('#noc_file_row').hide();
    
    jQuery('#add_button').show();
    jQuery("#up_button").hide();
    jQuery('#in_loading').hide();
    jQuery('#error_message').show();     
}
function details (id,editrow,operation) {
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
    //console.log(dataRecord);
    if(operation=='delete'){
        jQuery("#deleteEventId").val(id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtocheker_row").hide();
        jQuery("#delete_row").show();
    }else if(operation=='verify'){

        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val(id);
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#delete_row").hide();
        jQuery("#sendtocheker_row").hide();
        jQuery("#verify_row").show();
    }else if(operation=='sendtochecker'){

        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val(id);
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtocheker_row").show();
    }else{
        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val('');
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtocheker_row").hide();
        jQuery("#preview").show();
    }
    
    //console.log(dataRecord);
    jQuery("#r_heading").html('HC & AD Matters Status Update Details');

    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_ad_matters/get_sts_update_details",
        data : {[csrfName]: csrfHash,id:id},
        datatype: "json",
        async:false,
        success: function(response){
            var ds=response.split('####');
            jQuery('.txt_csrfname').val(ds[1]);
            jQuery('#previewtable').html(ds[0]);
        }
    });
    
    document.getElementById("details").style.display='block';
    jQuery("#details").jqxWindow('open');
}
function r_history (id,life_cycle=null) {
    if (life_cycle=='life_cycle') 
    {
        jQuery("#h_heading").html('Life Cycle');
    }
    else
    {
        jQuery("#h_heading").html('Decline/Return Reason History');
    }
    var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
    var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_ad_matters/r_sts_history",
        data : {[csrfName]: csrfHash,id: id,life_cycle:life_cycle},
        datatype: "json",
        success: function(response){
        //alert(response);
            var json = jQuery.parseJSON(response);

            jQuery('.txt_csrfname').val(json.csrf_token);
                if(json['row_info'])
                {
                    document.getElementById("r_history").style.visibility='visible';
                    var html='';
                    jQuery.each(json['row_info'],function(key,obj){
                        html+='<tr>';
                            html+='<td align="left">'+obj.status_name+'</td>';
                            html+='<td align="left">'+obj.r_by+'</td>';
                            html+='<td align="center">'+obj.r_dt+'</td>';
                            html+='<td align="left">'+obj.activites+'</td>';
                            if (obj.reason!=null)
                            {
                                html+='<td align="center">'+obj.reason+'</td>';
                            }else{html+='<td align="center"></td>';}
                        html+='</tr>';
                    });
                    jQuery("#r_history_details").html(html);
                    jQuery("#r_history").jqxWindow('open');
                }
                else {
                    alert("Something went wrong, please refresh the page.")
                }

        }
    });
}
function change_dropdown(operation,edit=null){
    var id='';
    
    //check for add Region action
    if (edit==null) 
    {
        id = jQuery("#"+operation).jqxComboBox('getSelectedItem');
        if(id==null){
            return false;
        }else{
            id = id.value;
        }
    }
    else
    {
        id=edit;
    }
    var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
    var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
    jQuery.ajax({
    url: '<?php echo base_url(); ?>index.php/hc_ad_matters/get_dropdown_data',
    async:false,
    type: "post",
    data: { [csrfName]: csrfHash,id : id,operation:operation},
    datatype: "json",
    success: function(response){
        var json = jQuery.parseJSON(response);
        //console.log(json['row_info']);
        var  csrf_tokena = json.csrf_token;
        jQuery('.txt_csrfname').val(json.csrf_token);
        var str='';
        var theme = getDemoTheme();
        

        
        if(operation=='hc_division'){
            var division = [];
            jQuery.each(json['row_info'],function(key,obj){
                division.push({ value: obj.id, label: obj.name });
            });
            jQuery("#case_category").jqxComboBox({theme: theme,autoOpen: false, autoDropDownHeight: false, promptText: "Select Case Category", source: division, width: 150, height: 25});
            
        }
        if(operation=='case_category'){
            var category = [];
            jQuery.each(json['row_info'],function(key,obj){
                category.push({ value: obj.id, label: obj.name });
            });
            jQuery("#case_type").jqxComboBox({theme: theme,autoOpen: false, autoDropDownHeight: false, promptText: "Select Case Type", source: category, width: 150, height: 25});
            
        }
        
        
    },
    error:   function(model, xhr, options){
        alert('failed');
    },
    });

    return false;
}
function CustomerPickList(module_name=null,data_field_name=null) {
    if(jQuery("#add_edit").val()=='edit')
    {
        if (jQuery("#file_delete_value_"+data_field_name).val()==0) 
        {
            alert('Please Delete Previous file for new upload');
            return false;
        }
    } 
    newwindow=window.open("<?=base_url()?>index.php/home/ajaxFileUpload/"+module_name+'/'+data_field_name,"Upload","width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340"); 
    if (window.focus) {newwindow.focus()}
                    return false;   
}
function file_delete(id){
    if(confirm('Are you sure to Delete previous file?')){   
        jQuery("#file_preview_"+id).hide(); 
        jQuery("#file_delete_"+id).hide();  
        jQuery("#file_delete_value_"+id).val(1);    
    }
}
</script>
<span id="click" ></span>
<div id="container">
    <div id="body">
        <table class="">
            <tr id="widgetsNavigationTree">
                <td valign="top" align="left" class='navigation'>
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('hc_ad_matters/pages/left_side_nav'); ?>
                    <!-- --====== Left Side Menu End==========--- -->
                </td>
                <td valign="top" id="demos" class='rc-all content'>
                    <div id="preloader">
                      <div id="camera"></div>
                    </div>
                    <div id="">
                    <div id='jqxTabs'>
                        <ul>
                            <li style="margin-left: 30px;">Data Grid</li>
                            <li >Form</li>
                            
                        </ul>
                         <!---==== Second Tab Start ==========----->
                        <div style="overflow: hidden;_overflow-y: scroll;">
                            <form method="POST" name="form" id="form"  style="margin:0px;">
                               <div style="padding: 0.5%;width:99%;height:45px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;width:100%">
                                        <tr>
                                            <td style="text-align:right;width:8%"><strong>Division&nbsp;&nbsp;</strong> </td>
                                            <td style="width:12%"><div name="hc_division" onchange="change_dropdown('hc_division');" id="hc_division" ></div></td>
                                            <td style="text-align:right;width:10%"><strong>Case Category&nbsp;&nbsp;</strong> </td>
                                            <td style="width:12%"><div name="case_category" onchange="change_dropdown('case_category');" id="case_category" ></div></td>
                                            <td style="text-align:right;width:10%"><strong>Case Type&nbsp;&nbsp;</strong> </td>
                                            <td style="width:12%"><div name="case_type" id="case_type" ></div></td>
                                            <td style="text-align:right;width:10%"><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                            <td style="width:12%"><input type="text" name="case_number" id="case_number" style=""></td>
                                            <td style="text-align:right;width:8%"><strong>Year&nbsp;&nbsp;</strong> </td>
                                            <td style="width:12%"><div name="case_year" id="case_year" ></div></td>
                                            
                                            <td  style="text-align:right;width:5%;padding-right: 5px;"><input type='button' class="searchbutton" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
                                            </td>
                                        </tr>
                                    </table>
                              </div>
                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                            <div style="border:none;" id="jqxGrid2"></div>
                            </form>
                            <div style="float:left;padding-top: 5px;margin-left: 5px;margin-bottom: 20px;">
                            <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#330707">
                            
                                <strong>E = </strong> Edit,&nbsp;
                                <strong>D = </strong> Delete,&nbsp;
                                <strong>STC = </strong> Send to Checker,&nbsp;
                                <strong>V = </strong> Verify,&nbsp;
                                <strong>P = </strong> Preview&nbsp;
                               
                            </div>
                            </div>
                            
                        </div>
                        <!---==== First Tab Start ==========----->
                        <div style="overflow: hidden;" >
                           
                           <div style="padding: 10px;" id="case_form" class="">
                            <div id="back_area" style="display: none;text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                <input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #EE2F44;margin-top:10px" />
                            </div>
                                <form class="form" name="action_form" id="action_form" method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <input type="hidden" id="add_edit" value="add" name="add_edit">
                                    <input type="hidden" id="edit_row" value="" name="edit_row">
                                    <input type="hidden" id="sub_id" value="" name="sub_id">
                                    <input type="hidden" id="pre_lawyer" value="" name="pre_lawyer">
                                    <table style="width: 100%;">                         
                                        <tr>
                                            <td width="50%">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Account/ Defendant Name</td>
                                                        <td width="60%" style=""><span id="account_name"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Name of Petitioner</td>
                                                        <td width="60%" style=""><span id="petitioner_name"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Previous Lawyer</td>
                                                        <td width="60%" style=""><span id="prv_lawyer"></span></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Previous Bank Representative Name</td>
                                                        <td width="60%" style=""><span id="prv_cdo"></span></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Division</td>
                                                        <td width="60%" style=""><span id="division"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Case Category</td>
                                                        <td width="60%" style=""><span id="p_case_category"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Case Type</td>
                                                        <td width="60%" style=""><span id="p_case_type"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Case Number</td>
                                                        <td width="60%" style=""><span id="s_case_number"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Previous Case Step</td>
                                                        <td width="60%" style=""><span id="prv_case_step"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Previous Remarks</td>
                                                        <td width="60%" style=""><span id="prv_remarks"></span></td>
                                                        
                                                    </tr>
                                                    
                                                    
                                                </table>
                                            </td>
                                            <td width="50%">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">New Lawyer</td>
                                                        <td width="60%" style=""><div id="lawyer" name="lawyer"></div></td>
                                                    </tr>
                                                    <tr id="noc_file_row" style="display:none">
                                                        <td width="40%" style="font-weight: bold;">NOC File<span style="color:red">*</span></td>
                                                        <td width="60%" ><span id="noc_file"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Case Step <span style="color:red">*</span></td>
                                                        <td width="60%" style=""><div id="case_step" name="case_step"></div></td>
                                                    </tr>
                                                    <tr id="entry_row" style="display:none;">
                                                        <td width="40%" style="font-weight: bold;">Entry Date<span style="color:red">*</span></td>
                                                        <td width="60%" style=""><input name="entry_date" type="text" class="" id="entry_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("entry_date");</script></td>
                                                    </tr>
                                                    <tr id="dispose_row" >
                                                        <td width="40%" style="font-weight: bold;">Disposed/order Date<span style="color:red">*</span></td>
                                                        <td width="60%" style=""><input name="disposed_order_date" type="text" class="" id="disposed_order_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("disposed_order_date");</script></td>
                                                    </tr>
                                                    <tr id="from_row" style="display:none;">
                                                        <td width="40%" style="font-weight: bold;">From date<span style="color:red">*</span></td>
                                                        <td width="60%" style=""><input name="from_date" type="text" class="" id="from_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("from_date");</script></td>
                                                    </tr>
                                                    <tr id="to_row" style="display:none;">
                                                        <td width="40%" style="font-weight: bold;">To date<span style="color:red">*</span></td>
                                                        <td width="60%" style=""><input name="to_date" type="text" class="" id="to_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("to_date");</script></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Remarks</td>
                                                        <td width="60%" style=""><textarea id="remarks" name="remarks" style="width:250px;height:20px;" ></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">Next Date</td>
                                                        <td width="60%" style=""><input name="next_date" type="text" class="" id="next_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("next_date");</script></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40%" style="font-weight: bold;">BB Remarks</td>
                                                        <td width="60%" style=""><textarea id="bb_remarks" name="bb_remarks" style="width:250px;height:20px;" ></textarea></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="4"><br></td>
                                        </tr>
                                        
                                        <tr id="add_row">
                                            <td align="center" colspan="2" >
                                                <br/>
                                                <input type="button" value="Save" class="btnAsh"  id="in_req_button"/> 
                                                <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                <br/><br/><br/>
                                            </td>
                                        </tr>
                                        
                                        <tr id="update_row" style="display: none; ">
                                            <td align="center" colspan="2" style="padding-bottom: 40px;">
                                                <input type="button" value="Update" class="btnAsh"  id="in_up_button"/>
                                                <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            
                            </div>
                        </div>
                       
                    </div>
                    <div>
                </td>
            </tr>
        </table>
    </div>
</div>                    

<div id="details" style="display:none;">
    <div style=""><strong><span id="r_heading"></span></strong></div>
    <div style="" id="details_table">
        <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
        <input name="verifyid" id="verifyid" value="" type="hidden">
        <input name="type" id="type" value="" type="hidden">
        <input name="d_suit_id" id="d_suit_id" value="" type="hidden">
        <div id="previewtable"></div>
        <div id="preview" class="wrapper">
            </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
        </div>
        <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
            <textarea name="comments" id="comments" style="width:370px;"></textarea>
            
            <br><br>
            <input type="button" class="buttondelete" id="delete_button" value="Delete">
            <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
            <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div>

        
        <div id="sendtocheker_row" style="text-align:center;margin-bottom:30px;width:100%;">
            <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                <!-- <tr id="sendtochecker_return_row" >
                    <td>Head of Legal<span style="color: red;">*</span></td>
                    <td><div id="hl_user" name="hl_user"></div></td>
                </tr> -->
                <!-- <tr id="verify_return_row" >
                    <td style="text-align: right;">Remarks</td>
                    <td><input type="text" name="remarks" id="remarks" style="width: 250px;" placeholder="Remarks"></td>
                </tr> -->
                <!-- <tr id="sendtochecker_return_row" >
                    <td style="text-align: right;">Notify By</td>
                    <td style="text-align: left;"><input type="checkbox" name="email_notification" id="email_notification" value="email"> Email -->
                        <!-- <input type="checkbox" name="sms_notification" id="sms_notification" value="sms"> SMS -->
                    <!-- </td>
                </tr> -->
                <tr>
                    <td colspan="2">
                    <input type="button" class="buttonSend" id="checker_button" value="Send">
                    <input type="button" class="buttonclose" id="checkercancel" onclick="close()" value="Cancel">
                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                    </td>
                </tr>
            </table>
            
        </div>


        <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
            <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                <table style="margin-left: 300px;margin-top: 0px;">
                    <!-- <tr id="verify_return_row" style="display:none">
                        <td>Reason<span style="color: red;">*</span></td>
                        <td>
                            <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                        </td>
                    </tr> -->
                    <tr>
                        <td colspan="2">
                            <input type="button" class="buttonSend" id="verify_button" value="Verify">
                            <!-- <input type="button" class="buttondelete" id="verify_return" value="Send for Correction"/>
                            <input type="button" class="buttondelete" id="verify_reject" value="Decline"/> -->
                            <input type="button" class="buttonclose" id="verifycancel" onclick="close()" value="Cancel">
                            <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


        </form>
    </div>
</div>
<div id="r_history" style="visibility:hidden;">
    <div style=""><strong><span id="h_heading"></span></strong></div>
    <div style="" id="details_table">
        <table style="width: 100%;" class="preview_table2">
            <thead>
                <th width="20%" align="left"><strong>Status</strong></th>
                <th width="20%" align="left"><strong>User</strong></th>
                <td width="20%" align="center"><strong>Date and Time</strong></td>
                <td width="20%" align="left"><strong>Description</strong></td>
                <td width="20%" align="left"><strong>Reason</strong></td>
            </thead>
            <tbody id="r_history_details">
                
            </tbody>
        </table>
        <div class="wrapper">
            </br></br><input type="button" align="center" class="button1" id="r_ok" value="Close" />
        </div>
    </div>
</div>
