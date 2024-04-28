<div id="container" style="">
    <div id="body">

        <div class="form">
            <div class="formHeader" style="background-color:#185891;">Approval List Edit</div>
        </div>

        <div style="width:96%;margin: auto;paddding: 10px;">
            <form class="form" name="doc_file_upload_form" id="doc_file_upload_form" method="post" action="<?= base_url() ?>index.php/recovery_af_fill/add_edit_action/<?= $add_edit ?>/<?= $id ?>" enctype="multipart/form-data">

                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                <input type="hidden" id="add_edit" value="<?= $add_edit ?>" name="add_edit">
                <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">

                <table style="width:50%" id="tab1Table">
                    <tbody>
                        <tr>
                            <td colspan="2">


                                <table style="width: 100%;">




                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Investment A/C Number.<span style="color:red">*</span> </td>
                                        <td width="30%"><input type="text" style="width:248px" id="card_no" name="card_no" value="<?= isset($result->investment_ac_type) ? $result->investment_ac_type : '' ?> " onKeyUp="javascript:return mask(this.value,this);"></td>
                                    </tr>




                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Account Name:<span style="color:red">*</span> </td>
                                        <td width="30%"><input type="text" style="width:248px" id="case_number" name="case_number" value="<?= isset($result->cif_no) ? $result->cif_no : '' ?>"></td>

                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">CID No:<span style="color:red">*</span> </td>
                                        <td width="30%"><input type="text" style="width:248px" id="account" name="account" value="<?= isset($result->account_name) ? $result->account_name : '' ?>"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div style="text-align:left;  margin-left: 320px;">
                    <input type="button" value="Save" id="in_req_button" class="" /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                </div>

            </form>
        </div>

    </div>
</div>