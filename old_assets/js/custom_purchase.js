$().ready(function() {
    
	$("#view_sp_sale_show").click( function() {
		var baseURLll=$("#baseURLll").val();
		var orrrd=$("#orrrd_").val();
		
		var aPosition=$("#reg_No_for_show").val().indexOf("/");
		if (aPosition>0){
			customer_id_array=$("#reg_No_for_show").val().split("/");
			var i;
			var customer_id="";
			for (i=0;i<customer_id_array.length;i++){
				if (customer_id==""){
					customer_id=customer_id_array[i];
				}
				else{
					customer_id += "::::" + customer_id_array[i];
				}
			}
		}
		else {
			customer_id=$("#reg_No_for_show").val();
		}
		//var reg_No_for_show=$.trim($("#reg_No_for_show").val());
		if(customer_id.length==0 || customer_id==''){
			$("#Conform_msg").empty();			
			$("#Conform_msg").append('<span style="color:red;"><img src="'+baseURLll+'images/unchecked.gif" height="12px" width="12px" alt="MSG" />&nbsp;Please Enter Registration Number/Script No./Name');
			$("#reg_No_for_show").focus();
		}else{
			window.location.href = baseURLll+"index.php/purchase_sp/search_view_show/"+orrrd+"/"+customer_id+"/";
		}
	});
	
	$("#view_sp_reinvest_show ").click( function() {
		var baseURLll=$("#baseURLll").val();
		var orrrd=$("#orrrd_").val();
		var aPosition=$("#reg_No_for_show").val().indexOf("/");
		if (aPosition>0){
			customer_id_array=$("#reg_No_for_show").val().split("/");
			var i;
			var customer_id="";
			for (i=0;i<customer_id_array.length;i++){
				if (customer_id==""){
					customer_id=customer_id_array[i];
				}
				else{
					customer_id += "::::" + customer_id_array[i];
				}
			}
		}
		else {
			customer_id=$("#reg_No_for_show").val();
		}		
		//var reg_No_for_show=$.trim($("#reg_No_for_show").val());
		if(customer_id.length==0 || customer_id==''){
		$("#Conform_msg").empty();			
		$("#Conform_msg").append('<span style="color:red;"><img src="'+baseURLll+'images/unchecked.gif" height="12px" width="12px" alt="MSG" />&nbsp;Please Enter Registration Number/Script No./Name');
		$("#reg_No_for_show").focus();
		}else{
		window.location.href = baseURLll+"index.php/purchase_sp/reinvest_show_view/"+orrrd+"/"+customer_id+"/";
		}
	});
	$("#Set_WEDB_Interest").click( function() {
		var baseURLll=$("#baseURLll").val();
		var orrrd=$("#orrrd_").val();
		var aPosition=$("#reg_No_for_show").val().indexOf("/");
		if (aPosition>0){
			customer_id_array=$("#reg_No_for_show").val().split("/");
			var i;
			var customer_id="";
			for (i=0;i<customer_id_array.length;i++){
				if (customer_id==""){
					customer_id=customer_id_array[i];
				}
				else{
					customer_id += "::::" + customer_id_array[i];
				}
			}
		}
		else {
			customer_id=$("#reg_No_for_show").val();
		}
		
		//var reg_No_for_show=$.trim($("#reg_No_for_show").val());
		if(customer_id.length==0 || customer_id==''){
		$("#Conform_msg").empty();			
		$("#Conform_msg").append('<span style="color:red;"><img src="'+baseURLll+'images/unchecked.gif" height="12px" width="12px" alt="MSG" />&nbsp;Please Enter Registration Number/Script No./Name');
		$("#reg_No_for_show").focus();
		}else{
		window.location.href = baseURLll+"index.php/purchase_sp/set_wedb_interest_show/"+orrrd+"/"+customer_id+"/";
		}
	});
	
	$("#pic_sig_update_show").click( function() {
		var baseURLll=$("#baseURLll").val();
		var orrrd=$("#orrrd_").val();
		
		var aPosition=$("#reg_No_for_show").val().indexOf("/");
		if (aPosition>0){
			customer_id_array=$("#reg_No_for_show").val().split("/");
			var i;
			var customer_id="";
			for (i=0;i<customer_id_array.length;i++){
				if (customer_id==""){
					customer_id=customer_id_array[i];
				}
				else{
					customer_id += "::::" + customer_id_array[i];
				}
			}
		}
		else {
			customer_id=$("#reg_No_for_show").val();
		}
		//var reg_No_for_show=$.trim($("#reg_No_for_show").val());
		if(customer_id.length==0 || customer_id==''){
			$("#Conform_msg").empty();			
		$("#Conform_msg").append('<span style="color:red;"><img src="'+baseURLll+'images/unchecked.gif" height="12px" width="12px" alt="MSG" />&nbsp;Please Enter Registration Number/Name');
		$("#reg_No_for_show").focus();
		}else{
		window.location.href = baseURLll+"index.php/purchase_sp/pic_sig_update_view1/"+orrrd+"/"+customer_id+"/";
		}
	});
	
	
	
	

});


function slt_sp_cat_editchange(){
	$("#slt_sp_cat_edit_frm").submit();
}

function sale_validatiiion (){
		var baseURLll=$("#baseURLll").val();	
		var form_v= document.forms.userf;
		var m_n=get_radio_value(form_v.elements.maturity_s);
		var p_n=get_radio_value(form_v.elements.payment_type);
		var ct_n=get_radio_value(form_v.elements.single_j);
		
		
		
		if($("#sltSptype").val()==0){ 					
			alert('Please select SP type');
			$('#tabs').tabs('select', 0);	
			$("#sltSptype").focus();
			return false;
		}
		
		else if( $("#CustomerId").val()==0  || $("#CustomerId").val()==''){ 					
			alert('Please enter Customer Id');
			$('#tabs').tabs('select', 0);	
			$("#CustomerId").focus();
			return false;
		}

		else if( $("#CustomerId").val().length!=customer_id_length){ 					
			alert('Customer Id should be '+customer_id_length+' digit');
			$('#tabs').tabs('select', 0);	
			$("#CustomerId").focus();
			return false;
		}
		
		else if($('#ac_radio2').is(':checked') && $("#account_no").val()==''){ 
			alert('Please Enter Account No');
			$('#tabs').tabs('select', 0);	
			$("#account_no").focus();
			return false;
		}		
		else if($('#ac_radio2').is(':checked') && $("#account_no").val().length!=account_no_length){ 
			alert('Account No should be '+account_no_length+' digit');
			$('#tabs').tabs('select', 0);	
			$("#account_no").focus();
			return false;
		}		
		else if($("#perDate").val()==''){ 
			alert('Please enter sale date');
			$('#tabs').tabs('select', 0);	
			$("#perDate").focus();
			return false;
		}
		
		else if(isDate($("#perDate").val())==false) {
				alert('Please enter valid sale date');
				$('#tabs').tabs('select', 0);	
				$("#perDate").focus();
				$("#perDate").select();
				return false;					
		}
		
		else if($("#Branch").val()==0){ 
			alert('Please select branch');
			$('#tabs').tabs('select', 0);	
			$("#Branch").focus();
			return false;
		}	
		else if($("#c1_name").val()==''){ 
			alert('Please enter name');
			$('#tabs').tabs('select', 0);	
			$("#c1_name").focus();
			return false;
		}		
		
		if($("#c1_birth_date").val()=='' && ct_n!=2){ 
			alert('Please enter birth date');
			$('#tabs').tabs('select', 0);	
			$("#c1_birth_date").focus();
			return false;
		}
		
		if($("#c1_birth_date").val()!=''){
			if (isDate($("#c1_birth_date").val())==false) {
				alert('Please enter valid birth date');
				$('#tabs').tabs('select', 0);	
				$("#c1_birth_date").focus();
				$("#c1_birth_date").select();
				return false;
			}			
		}
		if($("#c1_birth_date").val()!=''){
			if(birth_DATE_CHEK($("#c1_birth_date").val(), $("#Current_Daate").val(), 1)>=0){  
					alert('Birth date should not be advance date');
					$('#tabs').tabs('select', 0);	
					$("#c1_birth_date").focus();
					return false;
			}
		}
		
		if($("#c1_per_address").val()==''){ 
			alert('Please enter permanent address');
			$('#tabs').tabs('select', 0);	
			$("#c1_per_address").focus();
			return false;
		}
		else if($("#c1_present_add").val()==''){ 
			alert('Please enter present address');
			$('#tabs').tabs('select', 0);	
			$("#c1_present_add").focus();
			return false;
		}		
		
		// End WEDB			
		if($("#NationalID1").val()=='' && $("#c1_PassportNo").val()=='' && $("#BirthCeritificate1").val()==''){ 
				alert('Please Enter NID or Passport or Birth Certificate');
				$('#tabs').tabs('select', 0);	
				$("#NationalID1").focus();
				return false;
		}
		
		// start for pensioner
		if($("#is_like_c_particulars").val()==3){ 
				if($("#c1_PRName").val()==''){ 
				alert('Please Enter Pensioner Representative Name');
				$('#tabs').tabs('select', 0);	
				$("#c1_PRName").focus();
				return false;
				}
				
				if($("#c1_PRBirthDate").val()==''){ 
				alert('Please Enter Pensioner Representative Birth Date');
				$('#tabs').tabs('select', 0);	
				$("#c1_PRBirthDate").focus();
				return false;
				}
				
				if($("#c1_PRBirthDate").val()!=''){
					if (isDate($("#c1_PRBirthDate").val())==false) {
						$("#c1_PRBirthDate").focus();
						$("#c1_PRBirthDate").select();
						return false;
					}
				}				
				if(birth_DATE_CHEK($("#c1_PRBirthDate").val(), $("#Current_Daate").val(), 1)>=0){  
				alert('Pensioner Representative Birth Date should not be advance date');
				$('#tabs').tabs('select', 0);	
				$("#c1_PRBirthDate").focus();
				return false;
				}				
				else if($("#c1_designation").val()==''){ 
				alert('Please Enter Designation');
				$('#tabs').tabs('select', 0);	
				$("#c1_designation").focus();
				return false;
				}
				else if($("#c1_officeName").val()==''){ 
				alert('Please Enter Office Name');
				$('#tabs').tabs('select', 0);	
				$("#c1_officeName").focus();
				return false;
				}
				else if($("#c1_office_add").val()==''){ 
				alert('Please Enter Office Address');
				$('#tabs').tabs('select', 0);	
				$("#c1_office_add").focus();
				return false;
				}
				
				if($("#c1_joinDate").val()==''){ 
				alert('Please Enter Joining Date');
				$('#tabs').tabs('select', 0);	
				$("#c1_joinDate").focus();
				return false;
				}
				
				if($("#c1_joinDate").val()!=''){
					if (isDate($("#c1_joinDate").val())==false) {
						$("#c1_joinDate").focus();
						$("#c1_joinDate").select();
						return false;
					}			
				}
				if(birth_DATE_CHEK($("#c1_joinDate").val(), $("#Current_Daate").val(), 1)>=0){  
					alert('Joining Date should not be advance date');
					$('#tabs').tabs('select', 0);	
					$("#c1_joinDate").focus();
					return false;
				}
				else if($("#c1_reteirDate").val()==''){ 
				alert('Please Enter Retirement Date');
				$('#tabs').tabs('select', 0);	
				$("#c1_reteirDate").focus();
				return false;
				}
				
				if($("#c1_reteirDate").val()!=''){
					if (isDate($("#c1_reteirDate").val())==false) {
						$("#c1_reteirDate").focus();
						$("#c1_reteirDate").select();
						return false;
					}			
				}
				if(birth_DATE_CHEK($("#c1_reteirDate").val(), $("#Current_Daate").val(), 1)>0){  
					alert('Retirement Date should not be advance date');
					$('#tabs').tabs('select', 0);	
					$("#c1_reteirDate").focus();
					return false;
				}
				if(birth_DATE_CHEK($("#c1_joinDate").val(), $("#c1_reteirDate").val(), 1)==0){  
					alert('Joining Date & Retirement Date should not be same');
					$('#tabs').tabs('select', 0);	
					$("#c1_joinDate").focus();
					return false;
				}
				if(birth_DATE_CHEK($("#c1_joinDate").val(), $("#c1_reteirDate").val(), 1)>0){  
					alert('Retirement Date should never be smaller than the Joining Date');
					$('#tabs').tabs('select', 0);	
					$("#c1_reteirDate").focus();
					return false;
				}
				
				if($("#c1_penRecDate").val()==''){ 
				alert('Please Enter Pension Receive Date');
				$('#tabs').tabs('select', 0);	
				$("#c1_penRecDate").focus();
				return false;
				}
				
				if($("#c1_penRecDate").val()!=''){
					if (isDate($("#c1_penRecDate").val())==false) {
						$("#c1_penRecDate").focus();
						$("#c1_penRecDate").select();
						return false;
					}			
				}
				
				if(birth_DATE_CHEK($("#c1_penRecDate").val(), $("#Current_Daate").val(), 1)>0){  
					alert('Pension Receive Date should not be advance date');
					$('#tabs').tabs('select', 0);	
					$("#c1_penRecDate").focus();
					return false;
				}
		
				else if($("#c1_gratuity").val()==''){ 
				alert('Please Enter Gratuity');
				$('#tabs').tabs('select', 0);	
				$("#c1_gratuity").focus();
				return false;
				}
				
				else if($("#c1_providentFund").val()==''){ 
				alert('Please Enter Provident Fund');
				$('#tabs').tabs('select', 0);	
				$("#c1_providentFund").focus();
				return false;
				}
				
		}
		// End penssioner		
		// start for WEDB
		if($("#is_like_c_particulars").val()==4){ 
				if($("#c1_ForeignAddress").val()==''){ 
				alert('Please Enter Foreign Address');
				$('#tabs').tabs('select', 0);	
				$("#c1_ForeignAddress").focus();
				return false;
				}
				
				else if($("#c1_FCBankName").val()==''){ 
				alert('Please Enter FCBank Name');
				$('#tabs').tabs('select', 0);	
				$("#c1_FCBankName").focus();
				return false;
				}
				
				else if($("#c1_FCBankAC").val()==''){ 
				alert('Please Enter FCBank Account Number');
				$('#tabs').tabs('select', 0);	
				$("#c1_FCBankAC").focus();
				return false;
				}
				
				else if($("#c1_ForeignCompName").val()==''){ 
				alert('Please Enter Foreign Company Name');
				$('#tabs').tabs('select', 0);	
				$("#c1_ForeignCompName").focus();
				return false;
				}
				
				else if($("#c1_ForeignCompAddress").val()==''){ 
				alert('Please Enter Foreign Company Address');
				$('#tabs').tabs('select', 0);	
				$("#c1_ForeignCompAddress").focus();
				return false;
				}
				
				else if($("#c1_PassportNo").val()==''){ 
				alert('Please Enter Passport Number');
				$('#tabs').tabs('select', 0);	
				$("#c1_PassportNo").focus();
				return false;
				}				
								
				else if($("#c1_PassportIssueDate").val()==''){ 
				alert('Please Enter Passport Issue Date');
				$('#tabs').tabs('select', 0);	
				$("#c1_PassportIssueDate").focus();
				return false;
				}
				
				if($("#c1_PassportIssueDate").val()!=''){
					if (isDate($("#c1_PassportIssueDate").val())==false) {
						$("#c1_PassportIssueDate").focus();
						$("#c1_PassportIssueDate").select();
						return false;
					}			
				}
				
				if(birth_DATE_CHEK($("#c1_PassportIssueDate").val(), $("#Current_Daate").val(), 1)>0){  
				alert('Passport issue date should not be advance date');
				$('#tabs').tabs('select', 0);	
				$("#c1_PassportIssueDate").focus();
				return false;
				}
				
				else if($("#c1_PassportIssueFrom").val()==''){ 
				alert('Please Enter Passport Issue From');
				$('#tabs').tabs('select', 0);	
				$("#c1_PassportIssueFrom").focus();
				return false;
				}		
		}	
		
		
		// for join
		if(ct_n==1 && $("#is_like_c_particulars").val()==1){
			if($("#c_name2").val()==''){ 
			alert('Please enter name');
			$('#tabs').tabs('select', 0);	
			$("#c_name2").focus();
			return false;
			}
			
			else if($("#c_birth_date2").val()=='' && ct_n!=2){ 
			alert('Please enter birth date');
			$('#tabs').tabs('select', 0);	
			$("#c_birth_date2").focus();
			return false;
			}
			
			if($("#c_birth_date2").val()!=''){
				if (isDate($("#c_birth_date2").val())==false) {
					$("#c_birth_date2").focus();
					$("#c_birth_date2").select();
					return false;
				}			
			}
			if($("#c_birth_date2").val()!=''){
			if(birth_DATE_CHEK($("#c_birth_date2").val(), $("#Current_Daate").val(), 1)>=0){  
				alert('Birth date should not be advance date');
				$('#tabs').tabs('select', 0);	
				$("#c_birth_date2").focus();
				return false;
			}
			}
			if($("#c_per_address2").val()==''){ 
			alert('Please enter permanent address');
			$('#tabs').tabs('select', 0);	
			$("#c_per_address2").focus();
			return false;
			}
			else if($("#c_present_add2").val()==''){ 
			alert('Please enter present address');
			$('#tabs').tabs('select', 0);	
			$("#c_present_add2").focus();
			return false;
			}
			else if($("#NationalID2").val()=='' && $("#PassportNumber2").val()=='' && $("#BirthCeritificate2").val()==''){ 
				alert('Please Enter NID or Passport or Birth Certificate');
				$('#tabs').tabs('select', 0);	
				$("#NationalID2").focus();
				return false;
			}
		}	
		
		////// Particulars  1 ###############
		////// Maturity ###############  2		
		
	
	
		if(m_n=='No'){				
			if($("#on_behalf_name").val()==''){ 
			alert('Please enter On behalf of Premature Name');
			$('#tabs').tabs('select', 1);	
			$("#on_behalf_name").focus();
			return false;
			}
			else if($("#on_behalf_relation").val()==''){ 
			alert('Please enter On behalf of Premature Relation');
			$('#tabs').tabs('select', 1);	
			$("#on_behalf_relation").focus();
			return false;
			}
			else if($("#on_behalf_per_add").val()==''){ 
			alert('Please enter On behalf of Premature Permanent Address');
			$('#tabs').tabs('select', 1);	
			$("#on_behalf_per_add").focus();
			return false;
			}
			else if($("#on_behalf_pre_add").val()==''){ 
			alert('Please enter On behalf of Premature Present Address');
			$('#tabs').tabs('select', 1);	
			$("#on_behalf_pre_add").focus();
			return false;
			}
			 			
		}		
		////// Maturity  2  ############### 		
		////// Payment ###############  3
		var amount_sale=0;
		if(p_n=='Cash'){
			amount_sale=$.trim($("#CashAmount").val());					
			if($.trim($("#CashAmount").val())=='' || $.trim($("#CashAmount").val())==0 || $.trim($("#CashAmount").val())=='0.00'){ 
			alert('Please enter Cash Amount');
			$('#tabs').tabs('select', 2);	
			$("#CashAmount").focus();
			return false;
			}			
		}
		if(p_n=='Cheque'){	
			amount_sale=$.trim($("#cheq_amount").val());					
			if($("#cheq_no").val()==''){ 
			alert('Please enter Cheque No.');
			$('#tabs').tabs('select', 2);	
			$("#cheq_no").focus();
			return false;
			}
			else if($.trim($("#cheq_amount").val())=='' || $.trim($("#cheq_amount").val())==0 || $.trim($("#cheq_amount").val())=='0.00'){ 
			alert('Please enter Cheque Amount');
			$('#tabs').tabs('select', 2);	
			$("#cheq_amount").focus();
			return false;
			}
			else if($("#cheq_date").val()==''){ 
			alert('Please enter Cheque Date');
			$('#tabs').tabs('select', 2);	
			$("#cheq_date").focus();
			return false;
			}
			if (isDate($("#cheq_date").val())==false) {
			$("#cheq_date").focus();
			$("#cheq_date").select();
			return false;
			}
			if(birth_DATE_CHEK($("#cheq_date").val(), $("#Current_Daate").val(), 1)<0){  
				alert('Cheque Issue date should not be back date');
				$('#tabs').tabs('select', 2);	
				$("#cheq_date").focus();
				return false;
			}
		
			else if($("#cheq_bank").val()==''){ 
			alert('Please enter Cheque bank name');
			$('#tabs').tabs('select', 2);	
			$("#cheq_bank").focus();
			return false;
			}			
		}
		if(p_n=='AC'){	
			amount_sale=$.trim($("#ACT_amount").val());			
			var ac_no_13=$.trim($("#ACNo").val());
			var sol_id_3=$.trim($("#sol_id").val());
			var sltSptype=$.trim($("#sltSptype").val());
			var AccRate=$.trim($("#AccRate").val());
			var ACurrency=$.trim($("#ACurrency").val());
			var ACurrencyHidden=$.trim($("#ACurrencyHidden").val());
			var payable_gl_curr=$.trim($("#payable_gl_curr").val());
			
			var Reinvst_status=$("#Reinvst_status").val(); // 1means reinvest	
			
			
			
			
			if(ac_no_13=='' || ac_no_13==0 || ac_no_13=='0.00'){ 
				alert('Please enter AC No.');
				$('#tabs').tabs('select', 0);	
				$("#ac_radio2").attr('checked', 'checked');
				$('#account_no_tbl').show();
				$("#account_no").focus();
				return false;
			}
			if(ac_no_13.length!=account_no_length){ 
				alert('AC No. should be '+account_no_length+' digits');
				$('#tabs').tabs('select', 0);		
				$("#ac_radio2").attr('checked', 'checked');
				$('#account_no_tbl').show();
				$("#account_no").focus();
				return false;
			}
			if(sol_id_3=='' || sol_id_3==0){ 
				alert('Please enter SOL ID');
				$('#tabs').tabs('select', 2);	
				$("#sol_id").focus();
				return false;
			}
			
			if(sol_id_3.length!=sol_id_length){ 
				alert('SOL ID should be '+sol_id_length+' digits');
				$('#tabs').tabs('select', 2);	
				$("#sol_id").focus();
				return false;
			}
			if($.trim($("#ACT_amount").val())=='' || $.trim($("#ACT_amount").val())==0 || $.trim($("#ACT_amount").val())=='0.00'){ 
				alert('Please enter Transfer amount');
				$('#tabs').tabs('select', 2);	
				$("#ACT_amount").focus();
				return false;
			}

			if(ACurrency=='0' && Reinvst_status==0){ 
				alert('Please enter Currency');
				$('#tabs').tabs('select', 2);	
				$("#ACurrency").focus();
				return false;
			}

			if(ACurrencyHidden!='' &&  ACurrency!=ACurrencyHidden && Reinvst_status==0){ 
				alert('Account Currency missmatch');
				$('#tabs').tabs('select', 2);	
				$("#ACurrency").focus();
				return false;
			}
			if(ACurrencyHidden!='' && ACurrencyHidden!=payable_gl_curr && (AccRate=="" || parseFloat(AccRate)<=0) && Reinvst_status==0){ 
				alert('Please enter valid Rate');
				$('#tabs').tabs('select', 2);	
				$("#AccRate").focus();
				return false;
			}
			if(ACurrencyHidden!='' && ACurrencyHidden==payable_gl_curr && AccRate!="" && Reinvst_status==0){ 
				alert('Rate should be empty');
				$('#tabs').tabs('select', 2);	
				$("#AccRate").focus();
				return false;
			}
			
			
		}
		var allowed_amount =  parseFloat($("#MaximumAmountSingle").val());
		var total_amount = parseFloat($("#customerUtilizeAmount").val())+parseFloat(amount_sale);
		if(ct_n==0 && $("#SingleLimitCheck").val()=='1' && total_amount>allowed_amount){
			alert('Amount should be less than BB proposed limit');
			$('#tabs').tabs('select', 2);	
			$("#ACT_amount").focus();
			return false;
		}
		////// Payment   3  ###############
		
		////// Nominee ###############  4
		if((ct_n==0) && $("#is_like_c_particulars").val()!=4){
		var frm = document.userf;
		var pic=0;var sig=0;
		var nominated_per=0; var nominated_amt=0;
		var nominees = [];
		var j=0;
		for(i=0;i< frm.length;i++)   								
	   	{		  
		  e=frm.elements[i];				 
		  if (e.type=='text' && e.value=='' && e.name.indexOf('nominee_name') != -1) 
		  {
			alert('Please enter nominee name');					
			$('#tabs').tabs('select', 3);	
			e.focus();					 		
			return (false);			
		  }		 
		  else if (e.type=='text' && e.value=='' && e.name.indexOf('nominee_relation') != -1) 
		  {
			alert('Please enter nominee relation');					
			$('#tabs').tabs('select', 3);	
			e.focus();					 		
			return (false);			
		  }
		 else if (e.type=='text' && e.value=='' && e.name.indexOf('nominee_per_add') != -1) 
		  {
			alert('Please enter permanent address');					
			$('#tabs').tabs('select', 3);	
			e.focus();					 		
			return (false);			
		  }
		 else if (e.type=='text' && e.value=='' && e.name.indexOf('nominee_pre_add') != -1) 
		  {
			alert('Please enter present address');					
			$('#tabs').tabs('select', 3);	
			e.focus();					 		
			return (false);			
		  }		  
		 
		  if (e.type=='text' && e.value!='' && e.name=='NominatedAmount[]') 
		  {	
				nominated_per+=parseInt(e.value);
			
		  }
		  if (e.type=='text' && e.value!='' && e.name=='NominatedAmountScripts[]') 
		  {
				nominated_amt+=parseInt(e.value);
				
		  }
		  if (e.type=='text' && e.value!='' && e.name.indexOf('nominee_name') != -1) 
		  {
		  	/*if(nominees.indexOf(e.value)!=-1 ){		  		
				alert('Duplicate nominee name');					
				$('#tabs').tabs('select', 3);	
				e.focus();					 		
				return false;	
		  	}*/
		  	var matchString = e.value.toLowerCase();
			var rslt = 0;
			$.each(nominees, function(index, value) { 
			  if (rslt==0 && value.toLowerCase() === matchString) {
			    rslt = 1;
			  }
			});
		  	if(rslt){		  		
				alert('Duplicate nominee name');					
				$('#tabs').tabs('select', 3);	
				e.focus();					 		
				return false;	
		  	}

			nominees[j] = e.value;
			j++;
		  }
	  	}

		/*if(parseInt(nominated_per)>0 && parseInt(nominated_amt)>0)
		{
			
				alert('Please enter either nominated amount or Percentage (%)');					
				$('#tabs').tabs('select', 3);	
				e.focus();					 		
				return (false);	
		}*/
		if(parseInt(nominated_per)>0 && parseInt(nominated_per)!=100)
		{
			
				alert('Percentage (%) amount should be 100 %');					
				$('#tabs').tabs('select', 3);	
				e.focus();					 		
				return (false);	
		}
		if(parseInt(nominated_amt)>0 && parseInt(nominated_amt)!=parseInt(amount_sale))
		{
			
				alert('Nominated amount should be equal to '+amount_sale);					
				$('#tabs').tabs('select', 3);	
				e.focus();					 		
				return (false);	
		}
		
		
	}
		
		
		////// Nominee  4  ############### 		

		////// Issue Register and denominator ############### 5  
		
		var frm = document.userf;
		var previous_den=0;
		for(i=0;i< frm.length;i++)   								
	   	{				  
		  e=frm.elements[i];				 
		  if (e.value==0 && e.name.indexOf('sltspDenon') != -1) 
		  {
			alert('Please select denomination');					
			$('#tabs').tabs('select',4);	
			e.focus();					 		
			return (false);			
		  }	
		  else if (e.type=='text' && (e.value=='' || e.value==0) && e.name.indexOf('Quantity_apply') != -1) 
		  {
			alert('Please enter denomination quantity');					
			$('#tabs').tabs('select',4);	
			e.focus();					 		
			return (false);			
		  }
		  else if (e.type=='textarea' && (e.value=='' || e.value==0) && e.name.indexOf('input_sp_nos') != -1) 
		  {
			alert('Please enter script No.');					
			$('#tabs').tabs('select',4);	
			e.focus();					 		
			return (false);			
		  }
		 else if (e.type=='hidden' && e.value!=0 && e.name.indexOf('hidival') != -1) 
		  {		previous_den=e.value;
		  		//alert(previous_den);
				var frm_d = document.userf;
				for(i2=0;i2< frm_d.length;i2++){
					e2=frm_d.elements[i2];
					if ((e2.type=='hidden' && e2.value!=0 && e2.name.indexOf('hidival') != -1) && i!=i2)
					{
						if(previous_den==e2.value){
							alert('Denomination should not be same');					
							$('#tabs').tabs('select',4);									 		
							return (false);	
						}//else{ continue;}
					}
				}
		  }
		  else{ continue;}
	  	}
		
		if($("#is_like_c_particulars").val()==3){
			var frm = document.userf;
			for(i=0;i< frm.length;i++)   								
			{				  
			  e=frm.elements[i];
			  if (e.type=='text' && (e.value=='' || e.value==0) && e.name.indexOf('pensionerTtitle') != -1)
			  {
				alert('Pelease enter pensioner prefix title!');					
					$('#tabs').tabs('select',4);	
					e.focus();
					return (false);	  
			  }
			  if (e.type=='text' && (e.value=='' || e.value==0) && e.name.indexOf('pensionerFrom') != -1)
			  {
				alert('Pelease enter pensioner token from range value!');					
					$('#tabs').tabs('select',4);		
					e.focus();
					return (false);	
					
			  }
			  if (e.type=='text' && (e.value=='' || e.value==0) && e.name.indexOf('pensionerTo') != -1)
			  {
				alert('Pelease enter pensioner token to range value!!');					
					$('#tabs').tabs('select',4);	
					e.focus();
					return (false);	  
			  }			  
			}
		}
		
		
		
		
		if(p_n=='Cash'){			
			if(parseInt(document.getElementById("CashAmount").value)!=parseInt(document.getElementById("hidi_total_qty").value)){
				alert('Cash amount should be the same to the invested amount');				
				$('#tabs').tabs('select', 2);	
				document.getElementById("CashAmount").focus();
				return false;
			}
			else if(parseInt(document.getElementById("CashAmount").value)>parseInt(document.getElementById("hidi_total_qty").value)){
				alert('Cash amount should not be greater than sale amount');				
				$('#tabs').tabs('select', 2);	
				document.getElementById("CashAmount").focus();
				return false;
			}			
		}
		else if(p_n=='Cheque'){			
			if(parseInt(document.getElementById("cheq_amount").value)!=parseInt(document.getElementById("hidi_total_qty").value)){
				alert('Cheque amount should be the same to the invested amount');				
				$('#tabs').tabs('select', 2);	
				document.getElementById("cheq_amount").focus();
				return false;
			}
			else if(parseInt(document.getElementById("cheq_amount").value)>parseInt(document.getElementById("hidi_total_qty").value)){
				alert('Cheque amount should not be greater than sale amount');				
				$('#tabs').tabs('select', 2);		
				document.getElementById("cheq_amount").focus();
				return false;
			}			
		}
		else if(p_n=='AC'){				
			if(parseInt(document.getElementById("ACT_amount").value)!=parseInt(document.getElementById("hidi_total_qty").value)){
				alert('Face Value should be the same to the invested amount');				
				$('#tabs').tabs('select', 2);	
				document.getElementById("ACT_amount").focus();
				return false;
			}
			else if(parseInt(document.getElementById("ACT_amount").value)>parseInt(document.getElementById("hidi_total_qty").value)){
				alert('Face Value should not be greater than sale amount');				
				$('#tabs').tabs('select', 2);		
				document.getElementById("ACT_amount").focus();
				return false;
			}			
			
						
		}
		////// Customer Limt   && check amount ###############
		
		$CAT_Idd=$("#sltSptype").val();
		if($("#c1_birth_date").val()!='' && isDate($("#c1_birth_date").val())==true){ 			
				$current_Date=$("#Current_Daate").val().split("/");
				$compare_date=$("#c1_birth_date").val().split("/");
				var d1=new Date($compare_date[2],$compare_date[1],$compare_date[0]); //Y, m, d
				var d2=new Date($current_Date[2],$current_Date[1],$current_Date[0]);
				var milli=d2-d1;
				var milliPerYear=1000*60*60*24*365.26;
				var yearsApart=milli/milliPerYear;
				
				if(ct_n==1){				
					$compare_date=$("#c_birth_date2").val().split("/");
					var d1=new Date($compare_date[2],$compare_date[1],$compare_date[0]); //Y, m, d
					var d2=new Date($current_Date[2],$current_Date[1],$current_Date[0]);
					var milli=d2-d1;
					var milliPerYear=1000*60*60*24*365.26;
					var yearsApart2=milli/milliPerYear;
				}
				
				if($("#PreMatureAllowed").val()==0 && yearsApart<18){
					alert('Birth day should not be less than 18 years old.');
					$('#tabs').tabs('select', 0);	
					$("#c1_birth_date").focus();
					return false;
				}
				else if( m_n=='Yes'){
					
					//if(ct_n==1 || ct_n==0){
						if(yearsApart<18){					
						alert('Birth day should not be less than 18 years old.');
						$('#tabs').tabs('select', 0);	
						$("#c1_birth_date").focus();
						return false;
						}
					//}
					
						
				}
		}
		
		// Re-Invest Amount should be Same As Previous Amount
		if($("#Re_invest_limitation_Amount").val()!=0){ 
		
			if(parseInt($("#Re_invest_limitation_Amount").val())!=parseInt($("#hidi_total_qty").val())){
				if($("#Reinvst_status").val()==0){
					alert('Sale amount should be the same to the requisition amount');
				}else{
					alert('Re-invest amount should be the same to the previous invested amount');
				}
			$('#tabs').tabs('select',4);				
			return false;
			}
		}
		if($("#sltIssue_Officer").val()==0){ 
		alert('Please enter Issue Officer');
		$('#tabs').tabs('select',4);	
		$("#sltIssue_Officer").focus();
		return false;
		}
	return true;	
}


function ShowSingle_joint(){	
	var m = document.getElementById("hid_radio_single_j").value;
	var form = document.forms.userf;
	var n=get_radio_value(form.elements.single_j);	
	if(n==1 && m==1){			
		$("#join").toggle("slide", {}, 500);	
		document.getElementById("hiden_radio_span_single_j").innerHTML='<input  id="hid_radio_single_j" type="hidden" value="2" />';			
	}
	else if(n==1 && m==2){			
		$("#join").show();			
	}
	else if(n==0 && m==2){
		document.getElementById("hiden_radio_span_single_j").innerHTML='<input  id="hid_radio_single_j" type="hidden" value="1" />';		
		$("#join").toggle("slide", {}, 500);				
	}
	else if(n==2 && m==2){
		document.getElementById("hiden_radio_span_single_j").innerHTML='<input  id="hid_radio_single_j" type="hidden" value="1" />';		
		$("#join").toggle("slide", {}, 500);				
	}	
	if(n==0 || n==2){
		$('#operate_by_joint_label').hide();
		$('.span_email_and').hide();
		$('.span_email_or').hide();
		$('.mobile_email_joint').hide();
	} else {
		$('#operate_by_joint_label').show();
		$('.span_email_or').show();
		$('.mobile_email_joint').show();
	}
	if(n==2){
		$('#dob').hide();
		$('.signatory_row').show();
	} else {
		$('#dob').show();
		$('.signatory_row').hide();
	}	
					
	$("#operateby1").attr('checked','checked');	
} 
function show_maturity(){	
	var m = document.getElementById("hid_radio_maturity").value;
	var form = document.forms.userf;
	var n=get_radio_value(form.elements.maturity_s);
	if(n=='No' && m==1){			
		$("#maturity").toggle("slide", {}, 1000);	
		document.getElementById("hi_radio_span_maturity").innerHTML='<input  id="hid_radio_maturity" type="hidden" value="2" />';			
	}
	else if(n=='No' && m==2){			
		$("#maturity").show();			
	}
	else if(n=='Yes' && m==2){
		document.getElementById("hi_radio_span_maturity").innerHTML='<input  id="hid_radio_maturity" type="hidden" value="1" />';
		$("#maturity").toggle("slide", {}, 1000);				
	}
} 
function show_cheque(){	
	var a = document.getElementById("hid_radio_cheq").value;
	var form = document.forms.userf;
	var n=get_radio_value(form.elements.payment_type);
	
	if(n=='Cheque' && a==1){			
		$("#Cheque").toggle("slide", {}, 1000);	
		document.getElementById("hi_radio_span").innerHTML='<input  id="hid_radio_cheq" type="hidden" value="2" />';
		$("#CashAmountdiv").hide();
		$("#AC_transfer").hide();
	}
	else if(n=='Cheque' && a==2){			
		$("#Cheque").show();
		$("#CashAmountdiv").hide();
		$("#AC_transfer").hide();
	}
	else if(n=='Cash' && a==1){
		document.getElementById("hi_radio_span").innerHTML='<input  id="hid_radio_cheq" type="hidden" value="2" />';
		$("#CashAmountdiv").toggle("slide", {}, 1000);	
		$("#Cheque").hide();
		$("#AC_transfer").hide();
	}
	else if(n=='Cash' && a==2){
		$("#CashAmountdiv").show();
		$("#Cheque").hide();
		$("#AC_transfer").hide();
	}
	else if(n=='AC' && a==1){
		document.getElementById("hi_radio_span").innerHTML='<input  id="hid_radio_cheq" type="hidden" value="2" />';
		$("#AC_transfer").toggle("slide", {}, 1000);	
		$("#Cheque").hide();
		$("#CashAmountdiv").hide();
	}
	else if(n=='AC' && a==2){
		$("#AC_transfer").show();
		$("#Cheque").hide();
		$("#CashAmountdiv").hide();
	}
}
function get_radio_value(flds) {
 var i = 0;
  var len = flds.length;
  
  while (i < len) {
    if (flds[i].checked) {
      return flds[i].value;
    }
    i++;
  }  
  return "";
}
