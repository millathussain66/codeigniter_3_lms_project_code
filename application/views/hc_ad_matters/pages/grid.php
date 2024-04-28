
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

    var case_year = [<?php for($i=date('Y');$i>2000;$i--){echo $i.',';}?>];
    var court_type = ['CNC','SAMD','Subordinate'];
    
    var nature_suit = [<? $i=1; foreach($nature_suit as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var branch_sol = [<? $i=1; foreach($branch_sol as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'('.$row->code.')"}'; $i++;}?>];
    var court = [<? $i=1; foreach($court as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    
    var dealing_officer = [<? $i=1; foreach($dealing_officer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var hc_case_status = [<? $i=1; foreach($hc_case_status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    var request_type = [<? $i=1; foreach($request_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    var zone = [<? $i=1; foreach($zone as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    
    var step = [<? //$i=1; foreach($step as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    var case_category = [];
    var case_type = [];
    var hc_division = [<? $i=1; foreach($hc_division as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

	var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var hc_activites = [<? $i=1; foreach($hc_activites as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var expense_activities = [];
    var expense_type = [<? $i=1; foreach($expenses_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    var related_with = [<? $i=1; foreach($related_with as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    var id_type = [<? //$i=1; foreach($id_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'",field_length:"'.$row->field_length.'", label:"'.$row->name.'"}'; $i++;}?>];
    var proposed_type =['Investment','Card'];

    var rule ='';
    jQuery(document).ready(function () {
        jQuery("#expense_type_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: expense_type, width: 180, height: 25});
        jQuery("#district_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 200, height: 25});
        jQuery("#activities_name_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight:150, promptText: "Select Activities", source: hc_activites, width: 200, height: 25});


        jQuery("#s_proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 150, height: 25});

        jQuery("#case_year").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Year", source: case_year, width: 80, height: 25});
        jQuery("#s_case_year").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Year", source: case_year, width: 80, height: 25});
        
        jQuery("#request_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select File By/Against", source: request_type, width: 250, height: 25});

        jQuery("#hc_division").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select HCD/AD Division", source: hc_division, width: 250, height: 25});
        jQuery("#case_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: case_type, width: 250, height: 25});
        jQuery("#case_category").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Category", source: case_category, width: 250, height: 25});

        //jQuery("#hl_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select HOL", source: hl_user, width: 250, height: 25});
        
        jQuery("#nature_suit").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Nuture Suit", source: nature_suit, width: 250, height: 25});
        jQuery("#present_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Present Status", source: hc_case_status, width: 250, height: 25});
        jQuery("#branch_name_code").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Branch", source: branch_sol, width: 250, height: 25});
        
        jQuery("#lawyer_name_pre").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Dealing Lawyer's Name ", source: lawyer, width: 250, height: 25});
       
        jQuery("#zone").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Zone", source: zone, width: 250, height: 25});
        jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 250, height: 25});
        
        
        jQuery("#related_with").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Related With", source: related_with, width: 250, height: 25});
        
        jQuery('#s_proposed_type,#case_type,#request_type,#nature_suit,#branch_name_code,#lawyer_name_pre,#zone,#hc_division,#case_year,#s_case_year,#district,#case_category,#related_with,#present_status').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        

        s_change_caption();
        jQuery('#s_proposed_type').bind('change', function (event) {
            jQuery("#s_account").val('');
            jQuery("#s_hidden_loan_ac").val('');
            s_change_caption();       
        });

        jQuery('#case_year').jqxComboBox('val','<?php echo date('Y'); ?>');
        var html = '';
        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload-file.png" alt="upload" title="Upload" onclick="CustomerPickList(\'legal\',\'req_scan_file\')"/>';
        html+='<input type="hidden" id="hidden_req_scan_file_select" name="hidden_req_scan_file_select" value="0">';
        html+='<span id="hidden_req_scan_file">';
        jQuery('#req_scan_file').html(html);

        var html = '';
        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'bill_copy_1\')"/>';
        html+='<input type="hidden" id="hidden_bill_copy_1_select" name="hidden_bill_copy_1_select" value="0">';
        html+='<span id="hidden_bill_copy_1">';
        jQuery('#bill_copy_1').html(html);

        // Add edit form validation

        

        var id_rules = [];
       
        jQuery('#cdo_form').jqxValidator({
            focus: true,
            rules: [
            { input: '#request_type', message: 'required!', action: 'keyup,blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#request_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='request_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                }, 
                { input: '#case_type', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#case_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='case_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                },{ input: '#case_category', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#case_category").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='case_category']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                },
            /*{ input: '#id_type', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                }, */
            { input: '#hc_division', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                if(jQuery("#hc_division").val()!='')
                {   
                    var item = jQuery("#hc_division").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='hc_division']").val(item.value);}
                    return true;
                }
                else
                {
                    jQuery("#hc_division").focus();
                    return false;
                }
                }
            }, 
           
            { input: '#branch_name_code', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#branch_name_code").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='branch_name_code']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                }, 
                
                { input: '#nature_suit', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#nature_suit").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='nature_suit']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                }, 
                { input: '#present_status', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#present_status").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='present_status']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                }, 
                /*
                { input: '#court_name', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#court_name").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='court_name']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                },*/
                /*{ input: '#law_chamber_pre', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#law_chamber_pre").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='law_chamber_pre']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                },*/
                { input: '#lawyer_name_pre', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#lawyer_name_pre").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='lawyer_name_pre']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                },
                
                { input: '#zone', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#zone").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='zone']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                },
                /*{ input: '#prv_step', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#prv_step").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='prv_step']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                }, */
                
                   
                { input: '#case_filing_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                        if (input.val()!='') {
                            return true;
                        }
                        else {
                            return false;
                        }
                    } 
                },
                { input: '#case_filing_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#engage_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                         if (input.val()!='') {
                            return true;
                        }
                        else {
                            return false;
                        }
                    } 
                }, 
                 { input: '#engage_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                /*{ input: '#old_case_number', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#old_case_number").val()=='')
                    {
                            jQuery("#old_case_number").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                },*/
                { input: '#case_number', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#case_number").val()=='')
                    {
                            jQuery("#case_number").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                },
                
                { input: '#case_year', message: 'required', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        var item = jQuery("#case_year").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='case_year']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        //jQuery("#portfolio input").focus();
                        return false;
                    }

                } },
                { input: '#petitioner', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#petitioner").val()=='')
                    {
                            jQuery("#petitioner").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                },
                { input: '#account_name', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#account_name").val()=='')
                    {
                            jQuery("#account_name").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                },
                { input: '#accused_name', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#accused_name").val()=='')
                    {
                            jQuery("#accused_name").focus();
                            return false;
                        }
                        else
                        {
                            return true;
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
                    { name: 'remarks', type: 'string'},
                    { name: 'e_by', type: 'string'},
                    { name: 'e_dt', type: 'string'},
                    { name: 'status', type: 'string'},
                    { name: 'sts', type: 'int'},
                    { name: 'lawyer_name', type: 'int'},
                    { name: 'v_sts', type: 'sts'},
                    { name: 'filling_date', type: 'string'},
                    { name: 'case_number', type: 'string'},
                    { name: 'case_year', type: 'string'},
                    { name: 'hc_division_name', type: 'string'},
                    { name: 'case_category_name', type: 'string'},
                    { name: 'hc_type_name', type: 'string'},
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
                url: '<?=base_url()?>hc_ad_matters/grid',
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
                    var case_number = jQuery.trim(jQuery('#g_case_number').val());
                    var case_year = jQuery.trim(jQuery('#g_case_year').val());
                    var date_from = jQuery.trim(jQuery('#date_from').val());
                    var date_to = jQuery.trim(jQuery('#date_to').val());
                    
                    jQuery.extend(data, {
                            case_year : case_year,
                            case_number : case_number,
                            date_from : date_from,
                            date_to : date_to,
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
                filterable: false,
                sortable: false,
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
                    { text: 'sts', datafield: 'sts',hidden:true },
                    { text: 'lawyer_name', datafield: 'lawyer_name',hidden:true },
                    <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
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
                        if(dataRecord.v_sts == 35 || dataRecord.v_sts == 39 || dataRecord.v_sts == 90){
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="cdo_edit_add('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                        }
                        else if(<?=ANYTIMEEDIT?>==1 && dataRecord.v_sts == 38)
                        {
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="cdo_edit_add('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                        }
                        else
                        {
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
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
                    { text: 'STC', menu: false, datafield: 'sendtochecker', align:'center', editable: false, sortable: false, width: '5%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        if(dataRecord.v_sts == 35 || dataRecord.v_sts == 39 || dataRecord.v_sts == 90){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                        }else if(dataRecord.v_sts == 37){
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">S</div>';
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
                        if(dataRecord.v_sts == 37){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
                        }else if(dataRecord.v_sts == 38){
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">V</div>';
                        }
                        else
                        {
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }
                        }
                    },
                    <?php } ?>

                    { text: 'Status', datafield: 'status',editable: false, width: '20%'},
                    { text: 'Division Name', datafield: 'hc_division_name',editable: false, width: '15%'},
                    { text: 'Case Category', datafield: 'case_category_name',editable: false, width: '15%'},
                    { text: 'Case Type', datafield: 'hc_type_name',editable: false, width: '10%'},
                    { text: 'Rule Number', datafield: 'case_number',editable: false, width: '13%'},
                    { text: 'Year', datafield: 'case_year',editable: false, width: '13%'},
                    { text: 'Filling Date', datafield: 'filling_date',editable: false, width: '13%'},
                    { text: 'Remarks', datafield: 'remarks',editable: false, width: '20%'},
                    { text: 'Entry By', datafield: 'e_by',editable: false, width: '20%'},
                    { text: 'Entry DateTime', datafield: 'e_dt',editable: false, width: '20%'},
                    
                ],
                        
            });
               
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verifycancel,#checkercancel,#sendtohococancel,#assigntocdocancel,#cdosendtohococancel,#approvecancel,#recommendcancel") });
            jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#h_ok") });
            jQuery('#details').on('close', function (event) {
                jQuery('#delete_convence').jqxValidator('hide');
                
            });
            jQuery("#case_load").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#load_close") });
            jQuery("#all_case_details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#case_close") });
           
        }
        
        // jqx tab init
        var initWidgets = function (tab) {
            switch (tab) {
                case 0:
                    break;
                case 1:
                    initGrid2();
                    break;
            }
        }
        //document.getElementById("jqxTabs").style.minHeight = "280px";
        jQuery('#jqxTabs').jqxTabs({ width: '99%', initTabContent: initWidgets });
        
        jQuery('#jqxTabs').bind('selected', function (event) {

            if(event.args.item==0){
                clear_form();
                jQuery('#form1').show();
                jQuery('#form2').hide();
                //clear_form_cdo();
                //jQuery('#jqxTabs').jqxTabs('disableAt', 1);
            }
            if(event.args.item==1){
                <?php if(ADD!=1 && EDIT!=1 ){?>
                    jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                <?php  } ?>
            }
            jQuery('#cdo_form').jqxValidator('hide');

            //clear_form();
        });
        <?php if(ADD!=1 && EDIT!=1 ){?>
        jQuery('#jqxTabs').jqxTabs('disableAt', 0);
        jQuery('#jqxTabs').jqxTabs('select', 1);
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
        var checker_rule = [
                /*{ input: '#hl_user', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#hl_user").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='hl_user']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                    }
                }, */ 
                ];
        
        var verify_rule = [
            { input: '#law_chamber_verify', message: 'required!', action: 'blur,change', rule: function(input,commit){
                if(input.val() != '')
                    {
                        var item = jQuery("#law_chamber_verify").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='law_chamber_verify']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        //jQuery("#portfolio input").focus();
                        return false;
                    }
                }
            }, 
            { input: '#lawyer_verify', message: 'required!', action: 'blur,change', rule: function(input,commit){
                if(input.val() != '')
                    {
                        var item = jQuery("#lawyer_verify").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='lawyer_verify']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        //jQuery("#portfolio input").focus();
                        return false;
                    }
                }
            },  
        ];
        // Add Form Submit CDO Edit
        jQuery("#in_cdo_button").click( function() {
            var validationResult = function (isValid) {
                if (isValid && validate(id_rules)==true) {
                    jQuery("#in_cdo_button").hide();
                    jQuery("#in_cdo_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    cdoedit_ajax_submit();
                }
            }
            jQuery('#cdo_form').jqxValidator('validate', validationResult);        
        });

        jQuery("#in_upcdo_button").click( function() {
            var validationResult = function (isValid) {
                if (isValid && validate(id_rules)==true) {
                    jQuery("#in_upcdo_button").hide();
                    jQuery("#in_upcdo_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    cdoedit_ajax_submit(); 
                }
            }
            jQuery('#cdo_form').jqxValidator('validate', validationResult);        
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
        /*jQuery("#verify_button").click(function () {
            rule = verify_rule;
            jQuery('#delete_convence').jqxValidator({
                rules: rule
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    jQuery("#verify_button").hide();
                    jQuery("#verifycancel").hide();
                    jQuery("#verify_loading").show();
                    delete_submit();
                }
            }
            jQuery('#delete_convence').jqxValidator('validate', validationResult);
         });*/
        jQuery("#verify_button").click(function () {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_button").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_row").show();
                jQuery("#verify_loading").show();
                delete_submit();
            
        });
        
        jQuery("#verify_reject").click(function () {
            jQuery("#verify_return_row").show();
            jQuery('#type').val('verify_reject');
            if(jQuery("#return_reason_verify").val()=='')
            {
               alert('Please Give Decline Reason');
                jQuery("#return_reason_verify").focus();
                return false; 
            }
            else
            {
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            }
        });
        jQuery("#verify_return").click(function () {
            jQuery("#verify_return_row").show();
            jQuery('#type').val('verify_return');
            if(jQuery("#return_reason_verify").val()=='')
            {
               alert('Please Give Correction Reason');
                jQuery("#return_reason_verify").focus();
                return false; 
            }
            else
            {
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_loading").show();
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
function s_mask(str,textbox){
    var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
    if (item!=null)
    {
        if (item.value=='Card') 
        {
            if (!str.includes("*") && str.length==16)//For one time value paste
            {
                var length=str.length;
                var first_6= str.slice(0, 6);
                var mid='******';
                var last_6=str.slice(12, 16);
                var final_str=first_6+mid+last_6;
                textbox.value = final_str
                jQuery("#s_hidden_loan_ac").val(str);
            }
            else//For single value enter
            {
                //For New value
                var orginal_loan_ac=jQuery("#s_hidden_loan_ac").val();
                if (orginal_loan_ac.length<str.length) 
                {
                    var index = str.length-1;
                    var new_val=str.slice(index);
                    orginal_loan_ac+=new_val;
                    //alert(orginal_loan_ac);
                    jQuery("#s_hidden_loan_ac").val(orginal_loan_ac);
                }
                //For delete key
                else{
                    var len=str.length;
                    var new_val=orginal_loan_ac.slice(0,len);
                    jQuery("#s_hidden_loan_ac").val(new_val);
                }
                //For First 6 key
                if (str.length<=6)
                {
                    textbox.value = str
                }
                //for the last 4 key
                else if(str.length>=13)
                {
                    textbox.value = str
                }
                //For the middle 4 key
                else{
                    var length=str.length;
                    var first_6= str.slice(0, 6);
                    var mid=(str.length-6);
                    var final_str=first_6;
                    for (var i = 1; i <= mid; i++) {
                        final_str+='*';
                    }
                    textbox.value = final_str
                }

                if(str.length==16)//wrong input check
                {
                    var letter_Count = 0;
                    var letter = '*';
                     for (var position = 0; position < str.length; position++) 
                     {
                        if (str.charAt(position) == letter) 
                        {
                           letter_Count += 1;
                        }
                      }
                      if (letter_Count<6 || jQuery("#s_hidden_loan_ac").val().length!=16) 
                      {
                        textbox.value = '';
                        jQuery("#s_hidden_loan_ac").val('');
                        alert('Wrong way to input Card No please try again');
                      }
                }
            }
        }
    }
    
}
function s_change_caption(){   
    if (jQuery("#s_proposed_type").val()=='') 
    {
        document.getElementById("s_account").disabled = true;
        jQuery("#s_l_or_c_no").html('Investment A/C or Card');
    }
    else
    {
        document.getElementById("s_account").disabled = false;
        var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
        if (item.value=='Investment') {
            jQuery("#s_l_or_c_no").html('Investment A/C ');
        }
        else if(item.value=='Card'){
            jQuery("#s_l_or_c_no").html('Card');
        }
    }
    
}

function validate(val){
    //console.log(val.length)
    jQuery('#idbody').jqxValidator({
        rules:val
    });
    var d=true;
    if(val.length>0){
        d=false;
    }
    var validationResult = function(isValid){
        if(isValid){
            d= true;
        }
    }
    jQuery('#idbody').jqxValidator('validate', validationResult); 
    
    return d;
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
        
        if(operation=='case_district'){
            var thana = [];
            jQuery.each(json['row_info'],function(key,obj){
                thana.push({ value: obj.id, label: obj.name });
            });
            jQuery("#thana").jqxComboBox({theme: theme,autoOpen: false, autoDropDownHeight: false, promptText: "Select Thana", source: thana, width: 250, height: 25});
            //For edit action
            if (edit!=null) 
            {
                jQuery("#thana").jqxComboBox('val', '<?=(isset($result->thana) && $result->thana!=0)?$result->thana:''?>');
            }
            /*var court_name = [];
            jQuery.each(json['court_info'],function(key,obj){
                court_name.push({ value: obj.id, label: obj.name });
            });
            jQuery("#court_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court_name, width: 250, height: 25});

            //For edit action
            if (edit!=null) 
            {
                jQuery("#court_name").jqxComboBox('val', '<?=(isset($result->court_name) && $result->court_name!=0)?$result->court_name:''?>');
            }*/
        }
        if(operation=='hc_division'){
            var case_category = [];
            jQuery.each(json['row_info'],function(key,obj){
                case_category.push({ value: obj.id, label: obj.name });
            });
            jQuery("#case_category").jqxComboBox({theme: theme,autoOpen: false, autoDropDownHeight: false, promptText: "Select Case Category", source: case_category, width: 250, height: 25});
            //For edit action
            if (edit!=null) 
            {
                jQuery("#case_category").jqxComboBox('val', '<?=(isset($result->case_category) && $result->case_category!=0)?$result->case_category:''?>');
            }
        }
        if(operation=='case_category'){
            var case_type = [];
            jQuery.each(json['row_info'],function(key,obj){
                case_type.push({ value: obj.id, label: obj.name });
            });
            jQuery("#case_type").jqxComboBox({theme: theme,autoOpen: false, autoDropDownHeight: false, promptText: "Select Case Type", source: case_type, width: 250, height: 25});
            //For edit action
            if (edit!=null) 
            {
                jQuery("#case_type").jqxComboBox('val', '<?=(isset($result->case_type) && $result->case_type!=0)?$result->case_type:''?>');
            }
        }


        /*if(operation=='law_chamber_pre'){
            var lawyer_name_pre = [];
            jQuery.each(json['row_info'],function(key,obj){
                lawyer_name_pre.push({ value: obj.id, label: obj.name });
            });
            jQuery("#lawyer_name_pre").jqxComboBox({theme: theme,autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer_name_pre, width: 250, height: 25});
            //For edit action
            if (edit!=null) 
            {
                jQuery("#lawyer_name_pre").jqxComboBox('val', '<?=(isset($result->lawyer_name) && $result->lawyer_name!=0)?$result->lawyer_name:''?>');
            }
        }
        if(operation=='law_chamber'){
            var lawyer_name = [];
            jQuery.each(json['row_info'],function(key,obj){
                lawyer_name.push({ value: obj.id, label: obj.name });
            });
            jQuery("#lawyer_rec").jqxComboBox({theme: theme,autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer_name, width: 250, height: 25});
            //For edit action
            
        }
        if(operation=='law_chamber_verify'){
            var lawyer_name = [];
            jQuery.each(json['row_info'],function(key,obj){
                lawyer_name.push({ value: obj.id, label: obj.name });
            });
            jQuery("#lawyer_verify").jqxComboBox({theme: theme,autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer_name, width: 250, height: 25});
            //For edit action
            
        }*/
       
    },
    error:   function(model, xhr, options){
        alert('failed');
    },
    });

    return false;
}


function reload()
{
    var html = '';
    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload-file.png" alt="upload" title="Upload" onclick="CustomerPickList(\'legal\',\'req_scan_file\')"/>';
    html+='<input type="hidden" id="hidden_req_scan_file_select" name="hidden_req_scan_file_select" value="0">';
    html+='<span id="hidden_req_scan_file">';
    jQuery('#req_scan_file').html(html);
    jQuery('#error_message').html('');
    jQuery('#load_data').html('');
    jQuery('#load_data').hide();
    jQuery('#back_area').hide();
    jQuery('#req_scan_file_row').show();
    jQuery('#xl_row').show();
    jQuery('#add_button').hide();
    jQuery('#load_excel').show();
    jQuery('#department_row').show();
    jQuery("#load_btn").show();
    jQuery('#in_loading').hide();
    jQuery('#error_message').show();
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
        url: '<?=base_url()?>hc_ad_matters/delete_action/',
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
                    //jQuery("#verify_return").show();
                    //jQuery("#verify_reject").show();
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    //jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if ($('type').value=='verify_reject') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                    
                }else if ($('type').value=='verify_return') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
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
                    jQuery("#SendTocheckercancel").show();
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
                    //jQuery("#verify_return").show();
                    //jQuery("#verify_reject").show();
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    //jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                }else if ($('type').value=='verify_reject') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify_return') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
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
                    jQuery("#SendTocheckercancel").show();
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
function cdoedit_ajax_submit(){
    
    var postdata = jQuery('#cdo_form').serialize();
    var add_edit = jQuery("#add_edit_cdo").val();
    var edit_row = jQuery("#edit_row_cdo").val();
    
    //console.log(postdata);
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_ad_matters/cdo_edit_action",
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
                    jQuery("#in_upcdo_loading").hide();
                    jQuery("#in_upcdo_button").show();
                    jQuery('#jqxTabs').jqxTabs('select', 1);
                    
                }else{
                    jQuery("#in_cdo_button").show();
                    jQuery("#in_cdo_loading").hide();
                }
                var err = json.Message.split(" ");
                if(err[1]!='out'){jQuery("#"+err[1]).focus();}
                alert(json.Message);
                
                return false;
            }
            var msg='';
            if(add_edit=='edit'){
                msg='Updated';
            }else{
                msg="Saved";
            }
            clear_form_cdo();
            jQuery("#error").show();
            jQuery("#error").fadeOut(11500);
            jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
            if(add_edit=='edit'){
                jQuery("#in_upcdo_loading").hide();
                jQuery("#in_upcdo_button").show();
                jQuery('#jqxTabs').jqxTabs('select', 1);
            }else{
                jQuery("#in_cdo_button").show();
                jQuery("#in_cdo_loading").hide();
            }
            jQuery('#jqxTabs').jqxTabs('select', 1);
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
        }
    });
}

function cdo_edit_add(id,editrow){
    clear_form_cdo();
    jQuery('#jqxTabs').jqxTabs('enableAt', 0);
    jQuery('#jqxTabs').jqxTabs('select', 0);
    jQuery("#form1").show();
    jQuery("#form2").hide();
        jQuery('#search_area').hide();
        jQuery('#filing_area').show();
        //jQuery('#search_row').hide();
        //jQuery('#old_case_number').attr('readonly',true);
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>hc_ad_matters/get_cdo_edit_info",
            data : {[csrfName]: csrfHash,id:id},
            datatype: "json",
            async:false,
            success: function(response){
                //console.log(response);
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var rows = json.row_info;
                var expense = json.expense;
                //console.log(rows);
                jQuery('#old_case_number').val(rows.previous_case_no);
                jQuery('#cb_number').val(rows.cb_number);
                jQuery('#account_number').val(rows.account_number);
                jQuery('#account_name').val(rows.account_name);
                jQuery('#accused_name').val(rows.accused_name);
                //jQuery('#withdrawn_date').val(rows.withdrawn_date);
                jQuery('#cdo_remarks').val(rows.remarks_by_cdo);
                jQuery('#related_case').val(rows.related_case);
                jQuery('#suit_details').val(rows.suit_details);
                jQuery('#case_filing_date').val(rows.case_filing_date);
                jQuery('#engage_date').val(rows.engage_date);
                jQuery('#case_number').val(rows.case_number);
                jQuery('#case_year').val(rows.case_year);
                jQuery('#suit_value').val(rows.suit_value);
                jQuery('#petitioner').val(rows.petitioner);
                jQuery('#court_name').val(rows.court_name);
                jQuery('#next_date').val(rows.next_hearing_date);
                //jQuery('#name_news_paper').val(rows.name_news_paper);
                jQuery('#judgment_detail').val(rows.judgment_detail);
                jQuery('#judgment_date').val(rows.date_judgment);
                //jQuery('#next_hearing_date').val(rows.next_hearing_date);
                jQuery('#related_with').jqxComboBox('clearSelection');
                jQuery('#related_with').jqxComboBox('val',rows.related_with!=0?rows.related_with:'');
                jQuery('#district').jqxComboBox('clearSelection');
                jQuery('#district').jqxComboBox('val',rows.district!=0?rows.district:'');
                jQuery('#request_type').jqxComboBox('clearSelection');
                jQuery('#request_type').jqxComboBox('val',rows.request_type!=0?rows.request_type:'');
                

                jQuery('#hc_division').jqxComboBox('clearSelection');
                jQuery('#hc_division').jqxComboBox('val',rows.hc_division);
                change_dropdown('hc_division',rows.hc_division);
                jQuery('#case_category').jqxComboBox('clearSelection');
                jQuery('#case_category').jqxComboBox('val',rows.case_category!=0?rows.case_category:'');
                change_dropdown('case_category',rows.case_category);
                jQuery('#case_type').jqxComboBox('clearSelection');
                jQuery('#case_type').jqxComboBox('val',rows.case_type!=0?rows.case_type:'');

                
                jQuery('#branch_name_code').jqxComboBox('clearSelection');
                jQuery('#branch_name_code').jqxComboBox('val',rows.branch_name_code!=0?rows.branch_name_code:'');
                jQuery('#nature_suit').jqxComboBox('clearSelection');
                jQuery('#nature_suit').jqxComboBox('val',rows.nature_suit!=0?rows.nature_suit:'');
                //jQuery('#court_name').jqxComboBox('clearSelection');
                //jQuery('#court_name').jqxComboBox('val',rows.court_name!=0?rows.court_name:'');
                /*jQuery('#law_chamber_pre').jqxComboBox('clearSelection');
                jQuery('#law_chamber_pre').jqxComboBox('val',rows.law_chamber!=0?rows.law_chamber:'');
                change_dropdown('law_chamber_pre',rows.law_chamber);*/
                jQuery('#lawyer_name_pre').jqxComboBox('clearSelection');
                jQuery('#lawyer_name_pre').jqxComboBox('val',rows.lawyer_name!=0?rows.lawyer_name:'');
                jQuery('#present_status').jqxComboBox('clearSelection');
                jQuery('#present_status').jqxComboBox('val',rows.prv_step!=0?rows.prv_step:'');
                jQuery('#zone').jqxComboBox('clearSelection');
                jQuery('#zone').jqxComboBox('val',rows.zone!=0?rows.zone:'');

               
            }
        });
        
        jQuery('#add_edit_cdo').val('edit');
        jQuery("#cdo_add_row").hide();
        jQuery("#cdo_update_row").show();
        
    
    jQuery('#edit_row_cdo').val(id);
}
function clear_form_cdo(){

    jQuery('#cdo_add_row').hide();
    jQuery('#reload_search').hide();
    jQuery('#search_area').show();
    jQuery('#filing_area').hide();
    jQuery('#searchTable').html('');
    jQuery('#preview_next').hide();

    jQuery('#search_row').show();
    jQuery('#old_case_number').attr('readonly',false);

    jQuery('#hc_division').jqxComboBox('clearSelection');
    jQuery("input[name='hc_division']").val('');
    jQuery('#request_type').jqxComboBox('clearSelection');
    jQuery("input[name='request_type']").val('');
    jQuery('#case_category').jqxComboBox('clearSelection');
    jQuery("input[name='case_category']").val('');
    jQuery('#case_type').jqxComboBox('clearSelection');
    jQuery("input[name='case_type']").val('');
    //jQuery('#dealing_lawyer_hc').jqxComboBox('clearSelection');
    //jQuery("input[name='dealing_lawyer_hc']").val('');
    // jQuery('#hc_case_status').jqxComboBox('clearSelection');
    // jQuery("input[name='hc_case_status']").val('');
   
    //jQuery('#prv_step').jqxComboBox('clearSelection');
    //jQuery("input[name='prv_step']").val('');
    //jQuery('#next_step').jqxComboBox('clearSelection');
    //jQuery("input[name='next_step']").val('');
    jQuery('#branch_name_code').jqxComboBox('clearSelection');
    jQuery("input[name='branch_name_code']").val('');
    jQuery('#nature_suit').jqxComboBox('clearSelection');
    jQuery("input[name='nature_suit']").val('');
    //jQuery('#court_name').jqxComboBox('clearSelection');
    //jQuery("input[name='court_name']").val('');
    //jQuery('#law_chamber_pre').jqxComboBox('clearSelection');
    //jQuery("input[name='law_chamber_pre']").val('');
    jQuery('#lawyer_name_pre').jqxComboBox('clearSelection');
    jQuery("input[name='lawyer_name_pre']").val('');
    jQuery('#zone').jqxComboBox('clearSelection');
    jQuery("input[name='zone']").val('');
    jQuery('#related_with').jqxComboBox('clearSelection');
    jQuery("input[name='related_with']").val('');
    
    jQuery('#others_cd_name').val('');
    jQuery('#petitioner').val('');
    jQuery('#cb_number').val('');
    jQuery('#old_case_number').val('');
    jQuery('#previous_suit_id').val('');
    jQuery('#account_number').val('');
    jQuery('#account_name').val('');
    jQuery('#accused_name').val('');
    //jQuery('#withdrawn_date').val('');
    jQuery('#cdo_remarks').val('');
    jQuery('#related_case').val('');
    jQuery('#suit_details').val('');
    jQuery('#case_filing_date').val('');
    jQuery('#case_number').val('');
    jQuery('#suit_value').val('');
    jQuery('#judgment_detail').val('');
    //jQuery('#next_hearing_date').val('');
    //jQuery('#id_type').jqxDropDownList('clearSelection');
}


// Only One Checkbox Select At a time

function load_case(){
    
    var checkboxes = document.getElementsByName('check_id');
    var val;var required = false;
    checkboxes.forEach((item) => {
        if(item.checked==true){
            val=item.value;
            required = true;
           //console.log(item.value) 
        }
        
    });
    if(required==false){
        alert('Please Select a Case Number!');
        return false;
    }
    clear_form_cdo();
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_ad_matters/load_case",
        data : {[csrfName]: csrfHash,case_no:val},
        datatype: "json",
        async:false,
        success: function(response){
            //console.log(response);

            jQuery('#search_area').hide();
            jQuery('#filing_area').show();
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            //console.log(rows);

            jQuery('#dealing_lawyer_lw').html(rows.lawyer_name);
            jQuery('#previous_suit_id').val(rows.id);
            jQuery('#old_case_number').val(rows.case_number);
            jQuery('#old_case_number').attr('readonly',true);
            jQuery('#cdo_add_row').show();
            jQuery('#search_row').hide();
            jQuery('#reload_search').show();

                jQuery('#nature_suit').jqxComboBox('clearSelection');
                jQuery('#nature_suit').jqxComboBox('val',rows.case_name!=0?rows.case_name:'');
                jQuery('#cb_number').val(rows.cif);
                jQuery('#account_number').val(rows.loan_ac);
                jQuery('#account_name').val(rows.ac_name);
                jQuery('#old_case_number').val(rows.case_number);
                jQuery('#suit_value').val(rows.case_claim_amount);
                jQuery('#zone').jqxComboBox('clearSelection');
                jQuery('#zone').jqxComboBox('val',rows.zone!=0?rows.zone:'');
               
                jQuery('#branch_name_code').jqxComboBox('clearSelection');
                jQuery('#branch_name_code').jqxComboBox('val',rows.branch_id!=0?rows.branch_id:'');
                jQuery('#request_type').jqxComboBox('clearSelection');
                jQuery('#request_type').jqxComboBox('val',rows.case_category!=0?rows.case_category:'');
                jQuery('#judgment_detail').val(rows.judgement_details);
                jQuery('#judgment_date').val(rows.judgement_date);
                var arigin = rows.case_number;
                jQuery('#related_case').val(arigin);
                jQuery('#suit_details').val(rows.case_number);
            
           

            jQuery("#case_load").jqxWindow('close');
        }
    });
}

function clear_form(){
    //jQuery('#received_by').jqxComboBox('clearSelection');
    //jQuery("input[name='received_by']").val('');

    jQuery('#search_area').show();
    jQuery('#filing_area').hide();

    jQuery("#request_name").val('');
    jQuery("#received_date").val('');
    jQuery("#remarks").val('');
    jQuery("#add_edit").val('add');
    var html = '';
    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload-file.png" alt="upload" title="Upload" onclick="CustomerPickList(\'legal\',\'req_scan_file\')"/>';
    html+='<input type="hidden" id="hidden_req_scan_file_select" name="hidden_req_scan_file_select" value="0">';
    html+='<span id="hidden_req_scan_file">';
    jQuery('#req_scan_file').html(html);
    jQuery('#error_message').html('');
    jQuery('#add_button').show();
    jQuery("#up_button").hide();
    jQuery('#in_loading').hide();
    jQuery('#error_message').show();   

    // expense
    jQuery("#expense_counter").val(1);
    jQuery('#expense_type_1').jqxComboBox('clearSelection');
    jQuery('#expense_type_1').jqxComboBox('val','');
    jQuery('#district_1').jqxComboBox('clearSelection');
    jQuery('#district_1').jqxComboBox('val','');
    jQuery('#vendor_id_1').jqxComboBox('clearSelection');
    jQuery('#vendor_id_1').jqxComboBox('val','');
    jQuery('#activities_name_1').jqxComboBox('clearSelection');
    jQuery('#activities_name_1').jqxComboBox('val','');
    jQuery('#activities_date_1').val('');
    jQuery('#amount_1').val('');
    jQuery('#remarks_1').val('');
    jQuery('#expense_edit_1').val('');
    jQuery("#vendor_name_1").val('');

    jQuery.ajax({
        type: "GET",
        cache: false,
        async:false,
        url: "<?=base_url()?>hc_ad_matters/temp_file",
        datatype: "html",
        success: function(response){ 
            if(response=='success'){
                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'bill_copy_1\')"/>';
                html+='<input type="hidden" id="hidden_bill_copy_1_select" name="hidden_bill_copy_1_select" value="0">';
                html+='<span id="hidden_bill_copy_1">';
                jQuery('#bill_copy_1').html(html);
            }
        }
    });
    var node = document.getElementById('expense_body');
    for(let i=1;i<node.childElementCount;i++){
        node.removeChild(node.children[i]);
    }
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
    jQuery("#r_heading").html('HC & AD Matters Details');

    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_ad_matters/get_details",
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
        url: "<?=base_url()?>hc_ad_matters/r_history",
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
function load_new(){
    clear_form();
    clear_form_cdo();
    jQuery('#add_edit_cdo').val('add');
    jQuery("#cdo_add_row").show();
    jQuery("#cdo_update_row").hide();
    jQuery('#search_area').hide();
    jQuery('#filing_area').show();
}

function search_case(){
    var loan_ac = jQuery('#s_account').val();
    var s_proposed_type = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
    var case_number = jQuery('#s_case_number').val();
    var s_case_year = jQuery("#s_case_year").jqxComboBox('getSelectedItem');
    
    if( s_case_year==null && case_number=='' && loan_ac=='')
    {
        alert('Please fill search field!!!');
    }
    else
    {
        jQuery("#grid_loading").show();
        //jQuery("#load").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postdata = jQuery('#form').serialize();
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>hc_ad_matters/search_by_case/",
            data : postdata,
            datatype: "html",
            success: function(response){                
                jQuery("#grid_loading").hide();
                var data = response.split("####");
                jQuery('.txt_csrfname').val(data[0]);
                
                jQuery("#searchTable").show();
                jQuery('#searchTable').html(data[1]);

                jQuery("#preview_next").show();

            }
        });
    }

}


//   Expense

function add_more_expense(){
    var theme = getDemoTheme();
    var counter = jQuery('#expense_counter').val();
    var cma_district = jQuery('#cma_district').val();
    var req_type = jQuery('#req_type').val();
    var new_counter = parseInt(counter) + 1;
    html_string = '';

        html_string += '<tr id="expense_'+new_counter+'">';
        html_string += '<td>';
        html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
        html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
        html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
        html_string += '</td>';
        html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="change_vendor(\'expense_type_'+new_counter+'\','+new_counter+')"></div></td>';
        html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data('+new_counter+')"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%" id="vendor_name_'+new_counter+'" /></td>';
        html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="get_expense_amount(\'activities_name_'+new_counter+'\','+new_counter+')"></div></td>';
        html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:90%;" id="activities_date_'+new_counter+'" value="" ></td>';
        html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
        html_string += '<td><span id="bill_copy_'+new_counter+'"></span></td>';
        html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
        html_string += '</tr>';

    jQuery('#expense_' + counter).after(html_string);
    jQuery('#expense_counter').val(new_counter);
    
    jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, height: 25});
    jQuery('#expense_type_'+new_counter).focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
    });
    jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, dropDownHeight:150, promptText: "Select Activity", source: hc_activites, height: 25});
    jQuery('#activities_name_'+new_counter).focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
    });
    jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
    jQuery('#district_'+new_counter).focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
    });
    datePicker('activities_date_'+new_counter);
    var stringhtml = '';
    stringhtml+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'bill_copy_'+new_counter+'\')"/>';
    stringhtml+='<input type="hidden" id="hidden_bill_copy_'+new_counter+'_select" name="hidden_bill_copy_'+new_counter+'_select" value="0">';
    stringhtml+='<span id="hidden_bill_copy_'+new_counter+'">';
    jQuery('#bill_copy_'+new_counter+'').html(stringhtml);

    
}
function change_vendor(id,counter)
{
    var theme = getDemoTheme();
    var item = jQuery("#"+id).jqxComboBox('getSelectedItem');
    jQuery("#district_"+counter).jqxComboBox('clearSelection');
    jQuery("#district_"+counter).val('');
    jQuery("#district_"+counter).hide();

    var req_type = jQuery("#req_type").val();
    if (item!=null)
    {
        if (item.value==1)
        {
            jQuery("#vendor_id_"+counter).show();
            jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 200, height: 25});
            document.getElementById('vendor_name_'+counter).style.display = 'none';
            jQuery("#vendor_name_"+counter).val('');
            jQuery('#vendor_id_'+counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            //get_expense_activities(item.value,counter,req_type);
            select_lawyer(counter);
        }else if(item.value==4)
        {
            jQuery("#vendor_id_"+counter).show();
            jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 200, height: 25});
            document.getElementById('vendor_name_'+counter).style.display = 'none';
            jQuery("#vendor_name_"+counter).val('');
            jQuery('#vendor_id_'+counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            //get_expense_activities(item.value,counter,req_type);
            select_lawyer(counter);
        }else if(item.value==2)
        {
            jQuery("#vendor_id_"+counter).show();
            jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 200, height: 25});
            document.getElementById('vendor_name_'+counter).style.display = 'none';
            jQuery("#vendor_name_"+counter).val('');
            jQuery('#vendor_id_'+counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            //get_expense_activities(item.value,counter,req_type);
            un_select_lawyer(counter);
        }else if(item.value==3)
        {
            jQuery("#vendor_id_"+counter).show();
            jQuery("#district_"+counter).show();
            jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 200, height: 25});
            document.getElementById('vendor_name_'+counter).style.display = 'none';
            jQuery("#vendor_name_"+counter).val('');
            jQuery('#vendor_id_'+counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            //get_expense_activities(item.value,counter,req_type);
            un_select_lawyer(counter);
        }
        else if(item.value==5)
        {
            jQuery("#vendor_id_"+counter).show();
            jQuery("#district_"+counter).show();
            jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 200, height: 25});
            document.getElementById('vendor_name_'+counter).style.display = 'none';
            jQuery("#vendor_name_"+counter).val('');
            jQuery('#vendor_id_'+counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            //get_expense_activities(item.value,counter,req_type);
            un_select_lawyer(counter);
        }
        else{
            jQuery("#vendor_id_"+counter).hide();
            jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
            jQuery("#vendor_id_"+counter).val('');
            document.getElementById('vendor_name_'+counter).style.display = 'block';
            //get_expense_activities(item.value,counter,req_type);
            un_select_lawyer(counter);
        }
        
    }else{
        jQuery("#vendor_id_"+counter).hide();
        jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
        jQuery("#vendor_id_"+counter).val('');
        document.getElementById('vendor_name_'+counter).style.display = 'block'
    }
}
function select_lawyer(new_counter)
{
    jQuery("#vendor_id_"+new_counter).jqxComboBox('val', '<?=(isset($cma_data->lawyer) && $cma_data->lawyer!='')?$cma_data->lawyer:''?>');
    //jQuery('#vendor_id_'+new_counter).jqxComboBox({ disabled: true });
}
function un_select_lawyer(new_counter)
{
    jQuery('#vendor_id_'+new_counter).jqxComboBox({ disabled: false });
}
function expense_validation()
{
    var counter = jQuery('#expense_counter').val();
    for (i=1;i<=counter;i++) 
    {
        if(jQuery('#expense_delete_'+i).val()==0) 
        {
            var item = jQuery("#expense_type_"+i).jqxComboBox('getSelectedItem');
            var act = jQuery("#activities_name_"+i).jqxComboBox('getSelectedItem');
            if (!item)
            {
                alert('Vendor Type Required');
                jQuery('#expense_type_'+i+' input').focus();
                return false;
            }
            else
            {
                if (item.value==1 || item.value==2 || item.value==3 || item.value==4 || item.value==5)
                {
                    var item2 = jQuery("#vendor_id_"+i).jqxComboBox('getSelectedItem');
                    if (!item2)
                    {
                        alert('Vendor Required');
                        jQuery('#vendor_id_'+i+' input').focus();
                        return false;
                    }
                }
                else
                {
                    if(jQuery.trim(jQuery('#vendor_name_'+i).val())=='')
                    {
                        alert('Vendor Name Required');
                        jQuery('#vendor_name_'+i).focus();
                        return false;
                    }
                }
                
            }
            if (!act)
            {
                alert('Activities Name Required');
                jQuery('#activities_name_'+i+' input').focus();
                return false;
            }
            if(jQuery.trim(jQuery('#activities_date_'+i).val())=='')
            {
                alert('Activities Date Required');
                jQuery('#activities_date_'+i).focus();
                return false;
            }
            if(jQuery.trim(jQuery('#activities_date_'+i).val())!='')
            {
                if(!validate_date(jQuery('#activities_date_'+i).val()))
                {
                    alert('Activities Date Invalid');
                    jQuery('#activities_date_'+i).focus();
                    return false;
                }
            }
            if(jQuery.trim(jQuery('#amount_'+i).val())=='')
            {
                alert('Amount Required');
                jQuery('#amount_'+i).focus();
                return false;
            }
            if(jQuery.trim(jQuery('#amount_'+i).val())!='')
            {
                if(!checknumber_alphabatic('amount_'+i))
                {
                    alert('Amount Only Numeric');
                    jQuery('#amount_'+i).focus();
                    return false;
                }
            }
            
        }
    }
    return true;
}
function delete_row_expense (row_id) {
    jQuery('#expense_' + row_id).hide();
    jQuery('#expense_delete_' + row_id).val(1);
}
function get_expense_amount(act_id,counter) 
{
    var theme = getDemoTheme();
    //var cma_district = jQuery('#cma_district').val();
    //var req_type = jQuery('#req_type').val();
    var item2 = jQuery("#expense_type_"+counter).jqxComboBox('getSelectedItem');
    
    var item = jQuery("#"+act_id).jqxComboBox('getSelectedItem');
    if(item2!=null && item2.value==1)
    {
        if (item!=null)
        {
            var act_id = item.value;
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?=base_url()?>index.php/hc_matter/get_expense_amount',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,act_id:act_id},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var str='';
                if(json.row_info['amount']>0){
                    jQuery('#amount_'+counter).val(json.row_info['amount']);
                }else{
                    jQuery('#amount_'+counter).val(0);
                }
                },
                error:   function(model, xhr, options){
                    alert('failed');
                },
                });
        }
    }
    else
    {
        jQuery('#amount_'+counter).val('');
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
                            <li style="margin-left: 30px;">Form</li>
                            <li>Data Grid</li>
                        </ul>
                        <!---==== First Tab Start ==========----->
                        <div style="overflow: hidden;" >
                           
                           <div style="padding: 10px;" id="case_form" class="">
                            <div id="back_area" style="display: none;text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                <input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #EE2F44;margin-top:10px" />
                            </div>
                            
                            <div id="form1" style="_display:none;">
                                <div id="search_area" >
                                    <form method="POST" name="form" id="form"  style="margin:0px;">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="s_hidden_loan_ac" value="" name="s_hidden_loan_ac">
                                       <div style="padding: 0px;width:100%;height:50px; font-family: Calibri;font-size: 14px">
                                            <table id="deal_body" style="display:block;_width:70%">
                                                <tr>
                                                    <td><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                    <td><div id="s_proposed_type" name="s_proposed_type"></div></td>
                                                    <td style="width: 100px;"><strong><span id="s_l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
                                                    <td><input name="s_account" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="s_account" value="" onKeyUp="javascript:return s_mask(this.value,this);"/>
                                                    <td ><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                                    <td ><input type="text" id="s_case_number" name="s_case_number" placeholder="Case Number" style="width:95%" /></td>
                                                    <td><strong>Case Year&nbsp;&nbsp;</strong> </td>
                                                    <td><div id="s_case_year" name="s_case_year"></div></td>
                                                    <td><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_case()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />

                                                    </td>
                                                    <td><button type='button' class='newbuttonStyle' style='background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 2px solid #4329ff;' onclick='load_new()'>New</button></td>
                                                </tr>
                                            </table>
                                      </div>
                                      <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                                      <div id="searchTable"></div>
                                      <div id="preview_next" class="wrapper" style="display:none;padding-bottom:30px;">
                                            </br>
                                            <input type="button" class="buttondelete" id="load" value="Next" onclick="load_case()">
                                       </div>
                                    </form>
                                </div>
                                <div id="filing_area" style="display:none;">
                                <form class="form" name="cdo_form" id="cdo_form" method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <input type="hidden" id="add_edit_cdo" value="add" name="add_edit_cdo">
                                    <input type="hidden" id="edit_row_cdo" value="" name="edit_row_cdo">
                                    <input type="hidden" id="previous_suit_id" value="" name="previous_suit_id">
                                    <input type="hidden" id="old_case_number" value="" name="old_case_number">
                                    <table style="width: 100%;margin-bottom:10px;"> 
                                        <tr>
                                            <td width="50%">
                                                <table>
                                                    
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Customer ID</td>
                                                        <td width="30%" style=""><input name="cb_number" type="text" class="" style="width:250px" id="cb_number" value="" placeholder="Customer ID" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Account Number</td>
                                                        <td width="30%" style=""><input name="account_number" type="text" class="" style="width:250px" id="account_number" value="" placeholder="Account Number" /></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Name of Petitioner<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><input name="petitioner" type="text" class="" style="width:250px" id="petitioner" value="" placeholder="Name of Petitioner" /></td> 
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Name of Customer<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><input name="account_name" type="text" class="" style="width:250px" id="account_name" value="" placeholder="Name of Account" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Name of the Pespondent/Opposite party<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><input name="accused_name" type="text" class="" style="width:250px" id="accused_name" value="" placeholder="Name of the Pespondent/Opposite party" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Branch Name & BR. Code<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="branch_name_code" name="branch_name_code" ></div></td> 
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Case Filing Date<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><input name="case_filing_date" type="text" class="" id="case_filing_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("case_filing_date");</script></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Case Number<span style="color:red">*</span></td>
                                                        <td width="30%" style="">
                                                            <input name="case_number" type="text" tabindex="1" class="" style="width:145px;float:left" id="case_number" placeholder="case number" value="" /><input  readonly type="text" tabindex="" class="" style="width:10px;float:left" value="/" /><div name="case_year"  tabindex="2" id="case_year" />
                                                            <!-- <input name="case_number" type="text" class="" style="width:250px" id="case_number" value="" placeholder="Case Number" /> -->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">HCD/AD Division<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="hc_division" onchange="change_dropdown('hc_division')" name="hc_division"></div></td>
                                                    </tr>
                                                    <tr>
                                                         <td width="20%" style="font-weight: bold;">Case Category<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="case_category" onchange="change_dropdown('case_category')" name="case_category"></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Case Type<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="case_type" name="case_type"></div></td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Present Status<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="present_status" name="present_status"></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Case File By/Against <span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="request_type" name="request_type"></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">District as per BR Name</td>
                                                        <td width="30%" style=""><div id="district" name="district"></div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                         <td width="20%" style="font-weight: bold;">Suit Value</td>
                                                        <td width="30%" style=""><input name="suit_value" type="text" class="" style="width:250px" id="suit_value" value="" placeholder="Suit Value" /></td>  
                                                    </tr>
                                                    
                                                </table>
                                            </td>
                                            <td width="50%">
                                                <table>
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Suit Details</td>
                                                        <td width="30%" style=""><textarea name="suit_details" type="text" class="" style="width:250px" id="suit_details" value="" placeholder="Suit Details" ></textarea></td>                            
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Related With</td>
                                                        <td width="30%" style=""><div id="related_with" name="related_with"></div></td>                             
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Related Case (Arising Out Of) </td>
                                                        <td width="30%" style=""><input name="related_case" type="text" class="" style="width:250px" id="related_case" value="" placeholder="Related Case (Arising Out Of)" /></td>
                                                    </tr>
                                                    <!-- <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Dealing Law Firm/ Chamber (Present) <span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="law_chamber_pre" onchange="change_dropdown('law_chamber_pre')" name="law_chamber_pre"></div></td>
                                                    </tr> -->
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Dealing Lawyer's Name (Present) <span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="lawyer_name_pre" name="lawyer_name_pre"></div></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-weight: bold;">Lawyer engage Date<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><input name="engage_date" type="text" class="" id="engage_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("engage_date");</script></td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Zone as per BR Name<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div name="zone" id="zone"></div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Judgment/Decree Detail</td>
                                                        <td width="30%" style=""><input name="judgment_detail" type="text" id="judgment_detail" style="width:250px" placeholder="Judgment/Decree Detail" /></td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Judgment/Decree Date</td>
                                                        <td width="30%" style=""><input name="judgment_date" type="text" class="" id="judgment_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("judgment_date");</script></td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Name of the Court</td>
                                                        <td width="30%" style=""><input name="court_name" type="text" class="" style="width:250px" id="court_name" value="" placeholder="Name of the Court" /></td>
                                                    </tr>
                                                    <tr>
                                                       
                                                        <td width="20%" style="font-weight: bold;">Dealing Lawyer (Lower Court)</td>
                                                        <td width="30%" style=""><span id="dealing_lawyer_lw" name="dealing_lawyer_lw"></span></td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Nature of Suit<span style="color:red">*</span></td>
                                                        <td width="30%" style=""><div id="nature_suit" name="nature_suit"></div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Next Date</td>
                                                        <td width="30%" style=""><input name="next_date" type="text" class="" id="next_date" value="" style="width:250px" placeholder="dd/mm/yyyy" /><script>datePicker ("next_date");</script></td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td width="20%" style="font-weight: bold;">Remarks</td>
                                                        <td width="30%" style=""><input name="cdo_remarks" type="text" class="" style="width:250px" id="cdo_remarks" value="" placeholder="Remarks" /></td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td colspan="2" width="50%" style="font-weight: bold;">
                                                            <table style="width:100%;" id="idbody">
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        
                                        
                                        <tr><td colspan="2"><br></td></tr>
                                        <tr><td colspan="2">
                                            <table style="width: 100%;" border="1" id="table">
                                                
                                                <thead>
                                                <tr style="background-color: #d9f0ff;">
                                                    <td colspan="7"><b>Expenses</b> <input type="checkbox" name="add_expense" id="add_expense" checked="" value="1"></td>
                                                </tr>
                                                <input type="hidden" name="expense_counter" id="expense_counter" value="1">
                                                <input type="hidden" name="req_type" id="req_type" value="">
                                                <input type="hidden" name="cma_district" id="cma_district" value="">
                                                 <input type="hidden" name="batch_no" id="batch_no" value="">
                                                <tr>
                                                    <td width="4%" style="font-weight: bold;text-align:center">D</td>
                                                    <td width="18%" style="font-weight: bold;text-align:center">Expense Type<span style="color:red">*</span></td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Vendor Name<span style="color:red">*</span></td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Activities Name<span style="color:red">*</span></td>
                                                    <td width="10%" style="font-weight: bold;text-align:center">Activities Date<span style="color:red">*</span></td>
                                                    <td width="10%" style="font-weight: bold;text-align:center">Total Amount<span style="color:red">*</span></td>
                                                    <td width="5%" style="font-weight: bold;text-align:center">File Upload</td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
                                                </tr>
                                                </thead>
                                                <tbody id="expense_body">
                                                    <tr id="expense_1">
                                                            <td></td>
                                                            <td>
                                                                <input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">
                                                                <input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">
                                                                <div id="expense_type_1" name="expense_type_1" style="padding-left: 3px;margin-left:5px" onchange="change_vendor('expense_type_1',1)"></div>
                                                            </td>
                                                            <td width="200">
                                                                <div id="district_1" name="district_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data(1)"></div>
                                                                <div id="vendor_id_1" name="vendor_id_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%"></div>
                                                                <input name="vendor_name_1" type="text" class="" style="width:202px" id="vendor_name_1" />
                                                            </td>
                                                            <td><div id="activities_name_1" name="activities_name_1" style="padding-left: 3px;margin-left:5px;width:90%" onchange="get_expense_amount('activities_name_1',1)"></div></td>
                                                            <td><input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:90%;" id="activities_date_1" value="" ><script type="text/javascript" charset="utf-8">datePicker ("activities_date_1");</script></td>
                                                            <td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>
                                                            <td><span id="bill_copy_1"></span></td>
                                                            <td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr id="add_guarantor_row">
                                                        <td colspan="9" style="text-align: right">
                                                            Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td></tr>
                                        
                                        <tr id="cdo_add_row">
                                            <td colspan="2" style="padding-bottom: 40px;" align="center">
                                                <br/>
                                                <input type="button" value="Save" class="btnAsh"  id="in_cdo_button"/> 
                                                <span id="in_cdo_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                <br/><br/><br/>
                                            </td>
                                        </tr>
                                        
                                        <tr id="cdo_update_row" style="display: none; ">
                                            <td colspan="2" align="center" style="padding-bottom: 40px;">
                                                <input type="button" value="Update" class="btnAsh"  id="in_upcdo_button"/>
                                                <span id="in_upcdo_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                
                                            </td>
                                        </tr>
                                        <tr><td colspan="4"><br><br></td></tr>
                                    </table>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!---==== Second Tab Start ==========----->
                        <div style="overflow: hidden;_overflow-y: scroll;">
                            <div style="padding: 0.5%;width:99%;height:35px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;width:100%">
                                        <tr>
                                            <td style="text-align:right;width:8%"><strong>Case No&nbsp;&nbsp;</strong> </td>
                                            <td style="width:8%"><input type="text" name="g_case_number" id="g_case_number" style=""></td>
                                            <td style="text-align:right;width:5%"><strong>Year&nbsp;&nbsp;</strong> </td>
                                            <td style="width:8%"><input type="text" name="g_case_year" id="g_case_year" style="width: 100%;"></td>
                                            <td style="text-align:right;width:8%"><strong>Date From&nbsp;&nbsp;</strong> </td>
                                            <td style="width:30%"><input id="date_from" name="date_from" style="width:40%" /><script type="text/javascript">datePicker("date_from");</script>
                                            <strong>To</strong> <input id="date_to" name="date_to" style="width:40%" /><script type="text/javascript" >datePicker("date_to");</script>
                                            </td>
                                            
                                            <td  style="text-align:right;width:5%;padding-right: 5px;"><input type='button' class="searchbutton" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
                                            </td>
                                        </tr>
                                    </table>
                                   
                              </div>
                            <div style="border:none;" id="jqxGrid2"></div>
                            <div style="float:left;padding-top: 5px;margin-left: 5px;margin-bottom: 20px;">
                            <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#330707">
                            
                                <?php if(EDIT==1){ ?>
                                <strong>E = </strong> Edit,&nbsp;
                                <?php } ?>
                                <? if(DELETE==1){?>
                                <strong>D = </strong> Delete,&nbsp;
                                <?php } ?>
                                <strong>P = </strong> Preview,&nbsp;
                                <?php if(SENDTOCHECKER==1){ ?>
                                <strong>STC = </strong> Send to Checker,&nbsp;
                                <?php } ?>
                                <?php if(VERIFY==1){ ?>
                                <strong>V = </strong> Verify&nbsp;
                                <?php } ?>
                               
                            </div>
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
            <br>
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
                    <td style="text-align: left;"><input type="checkbox" name="email_holhoco" id="email_holhoco" value="email"> Email</td>
                </tr> -->
                <tr>
                    <td colspan="2">
                    <input type="button" class="buttonSend" id="checker_button" value="Send to Checker">
                    <input type="button" class="buttonclose" id="checkercancel" onclick="close()" value="Cancel">
                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                    </td>
                </tr>
            </table>
            
        </div>


        <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
            <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                <table style="margin-left: 300px;margin-top: 0px;">
                    <tr id="verify_return_row" style="display:none">
                        <td>Reason<span style="color: red;">*</span></td>
                        <td>
                            <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="buttonSend" id="verify_button" value="Verify">
                           <!--  <input type="button" class="buttondelete" id="verify_return" value="Send for Correction"/>
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

<div id="case_load" style="display:none;">
    <div style=""><strong>Case List</strong></div>
    <div style="" id="details_table">
        <form class="form" name="case_search" id="case_search" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
        
        <div id="case_list_table"></div>
        <div id="preview_load" class="wrapper">
            </br>
            <input type="button" class="buttondelete" id="load" value="Load" onclick="load_case()">
            <input type="button" align="center" class="buttonclose" id="load_close" value="Close" />
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
            </br></br><input type="button" align="center" class="button1" id="h_ok" value="Close" />
        </div>
    </div>
</div>

<div id="all_case_details" style="display:none;">
    <div style=""><strong><span id="case_header"></span></strong></div>
    <div style="" id="details_table">
        
        <div id="preview_div"></div>
        <div id="preview_button" class="wrapper">
            </br></br><input type="button" align="center" class="buttonclose" id="case_close" value="Close" />
        </div>
       
    </div>
</div>