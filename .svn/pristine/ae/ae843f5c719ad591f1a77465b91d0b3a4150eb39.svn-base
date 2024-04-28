<script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>
<style>
    table,
    td {
        padding: 5px;
        margin: 0px;
        border-spacing: 0px;
        border-collapse: collapse;
    }

    .buttondelete {
        background-color: white;
        color: black;
        border: 2px solid #f44336;
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

    .buttondelete:hover {
        background-color: #f44336;
        color: white;
    }

    .buttonSend {
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

    .buttonSend:hover {
        background-color: #008CBA;
        color: white;
    }

    .navigationTitle {
        -webkit-border-top-right-radius: 4px;
        -webkit-border-top-left-radius: 4px;
        -moz-border-top-right-radius: 4px;
        -moz-border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        font-family: Verdana, Arial, sans-serif;
        font-style: normal;
        text-shadow: 0 1px 1px #FFFFFF;
        font-size: 12px;
        text-align: left;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.02)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background-color: #fdfdfd;
        color: #3F3F3F;
        border-bottom: 5px solid #00a2e8;
        border-top: 1px solid #e9e9e9;
        padding: 12px 5px 13px 14px;
        _margin-top: 28px;
    }

    .navigationTitle img {
        margin-right: 3px !important;
        margin-top: 1px;
    }

    .navigationTitle a:link {
        font-size: 12px;
        color: #3F3F3F;
        text-decoration: none;
    }

    .navigationTitle a:visited {
        font-size: 12px;
        color: #3F3F3F;
        text-decoration: none;
    }

    .navigationTitle a:hover {
        font-size: 12px;
        text-decoration: none;
        color: #3F3F3F;
    }




    .navigationItem {
        font-family: Verdana, Arial, sans-serif;
        font-style: normal;
        text-align: left;
        vertical-align: middle;
        color: #3F3F3F;
        font-size: 12px;
        font-weight: bold;
        text-shadow: 0 1px 0 #FFFFFF;
    }

    .navigationItem a:link {
        font-size: 12px;
        margin-left: 5px;
        color: #444444;
        text-decoration: none;
    }

    .navigationItem a:visited {
        font-size: 12px;
        margin-left: 3px;
        color: #444444;
        text-decoration: none;
    }

    .navigationItem a:hover {
        font-size: 12px;
        text-decoration: underline;
        border-top-color: #ccc;
        border-left-color: #ccc;
        color: #2e2e2e;
    }

    .navigationItem-expanded {
        font-family: Verdana, Arial, sans-serif;
        font-style: normal;
        font-size: 12px;
        font-weight: bold;
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

    .buttonsendtochecker:hover {
        background-color: #008CBA;
        color: white;
    }

    .navigationItemContent,
    .navigationItemContentParent {
        border: 0px;
        text-align: left;
        vertical-align: middle;
        padding: 9px 3px 9px 25px;
        list-style: none;
        border-bottom: 1px solid #e9e9e9;
        -moz-transition: all 0.3s ease-in-out, color 0.1s ease 0s;
        -webkit-transition: all 0.3s ease-in-out, color 0.1s ease 0s;
        transition: all 0.3s ease-in-out, color 0.1s ease 0s;
        color: #3F3F3F;
        background: #fff;
    }

    .navigationItemContent:last-child {
        border-bottom: none;
    }

    .navigationItemContent:hover,
    .navigationItemContentParent:hover,
    .navigationItemContentParent:hover,
    .navigationItemContentParent:hover {
        cursor: pointer;
        padding-left: 28px !important;
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.02)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background-color: #fdfdfd;
        color: #00a2e8;
        text-shadow: none;
    }

    .navigationItemContentParent:hover,
    .navigationItemContentParent:hover {
        padding-left: 22px !important;
    }

    .navigationItemContentParentExpanded:hover,
    .navigationItemContentParentExpanded:hover {
        padding-left: 18px !important;
    }

    .navigationItemContent a:link,
    .navigationItemContentParent a:link {
        font-family: Verdana, Arial, sans-serif;
        font-style: normal;
        font-size: 12px;
        font-weight: normal;
        margin-left: auto;
        color: inherit;
        margin-right: auto;
        margin-top: 2px;
        margin-bottom: 0px;
        text-decoration: none;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -ms-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .navigationItemContent a:visited,
    .navigationItemContentParent a:visited {
        font-size: 12px;
        margin-left: 3px;
        color: inherit;
        text-decoration: none;
    }

    .navigationItemContent a:hover,
    .navigationItemContentParent a:hover {
        font-size: 12px;
        color: inherit;
    }

    .navigationItemContentParent {
        padding: 9px 3px 9px 18px;
    }

    .navigationItemContentParent img {
        position: relative;
        left: -7px;
        cursor: pointer;
    }

    .navigationItemContentParentExpanded {
        padding: 9px 3px 9px 14px;
    }

    .navigationItemContentParentExpanded img {
        left: -4px;
        top: -2px;
    }

    .navigationContent {
        padding-top: 0px;
        padding-left: 0px;
        padding-right: 0px;
        padding-bottom: 0px;
        margin: 0px;
    }

    .content {
        margin-right: 10px;
        _height: 950px;
        _max-height: 950px;
        padding: 10px;
        position: relative;
        padding-top: 3px;
        width: 100%;
    }

    .jqx-widget-jqxtabs {
        border: none;
    }

    .jqx-widget-header-jqxtabs {
        border: none;
        background: transparent;
    }

    .jqx-tabs-title-jqxtabs {
        color: #3F3F3F;
        font-weight: 300 !important;
        border: none;
        border-bottom: 5px solid transparent;
    }

    .jqx-tabs-title-selected-top-jqxtabs {
        color: #3F3F3F;
        border: none;
        background: transparent;
        border-bottom: 5px solid #00a2e8;
        -webkit-transition: color 0.3s ease 0s;
        -moz-transition: color 0.3s ease 0s;
        -ms-transition: color 0.3s ease 0s;
        -o-transition: color 0.3s ease 0s;
        transition: color 0.3s ease 0s;
    }

    .jqx-tabs-title-selected-top-jqxtabs:hover {
        color: #00a2e8;
    }

    .jqx-tabs-title-hover-top-jqxtabs {
        background: none;
        color: #00a2e8;
        border-color: transparent;
        -webkit-transition: color 0.3s ease 0s;
        -moz-transition: color 0.3s ease 0s;
        -ms-transition: color 0.3s ease 0s;
        -o-transition: color 0.3s ease 0s;
        transition: color 0.3s ease 0s;
        border-bottom: 5px solid transparent;
    }

    .jqx-tabs-title-hover-top-jqxtabs {
        color: #00a2e8;
    }

    .navigation {
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        top: 0px;
        max-width: 200px;
        width: 200px;
        min-width: 200px;
        top: 380px;
        outline: none;
        background: transparent;
        display: block;
        border: 1px solid #e9e9e9;
        border-top: none;
        border-bottom: none;
        height: 100%;
        -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        padding: 0px;
        border-color: transparent;
        border-color: rgba(233, 233, 233, 1);
        background: transparent;
        background: rgba(255, 255, 255, 1);
        background: transparent\9;
        *background: transparent;
        *border-color: transparent;
    }

    .demoContainer {
        width: 916px;
        top: 0px;
        left: 0px;
        padding: 8px;
        min-height: 1160px;
        vertical-align: top;
        margin-left: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
        margin-right: 0px;
        display: block;
        background: #fff;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        border: 1px solid #e9e9e9;
        -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
    }

    .welcomeContent {
        font-size: 13px;
        font-family: Verdana;
        text-align: left;
        padding: 0px;
        margin: 20px;
        color: #3F3F3F;
    }

    .megamenu-ul li {
        margin: 5px;
        list-style: none;
    }

    .megamenu-ul li a:link {
        text-decoration: none;
    }

    .megamenu-ul li a:hover {
        text-decoration: underline;
    }

    .topNavigation {
        padding-top: 0px !important;
        margin-bottom: 10px;
        margin-left: auto;
        margin-right: auto;
        width: 1160px;
    }

    .topNavigation {
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.02)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background-color: #fdfdfd;
    }

    .topNavigation-item,
    .demoLink {
        font-family: Verdana, Arial, sans-serif;
        font-style: normal;
        text-align: left;
        vertical-align: middle;
        margin-left: 10px;
        margin-right: 10px;
        font-size: 12px;
        padding: 12px 10px 12px 5px;
        text-shadow: 0 1px 0 #FFFFFF;
    }

    .topNavigation-item a,
    .demoLink {
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -ms-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        color: #3F3F3F;
        text-decoration: none;
        float: left;
        margin-left: 4px;
    }

    .topNavigation-item a:hover,
    .demoLink:hover {
        color: #00a2e8;
        text-shadow: none;
    }

    .demoLink {
        float: none;
        margin: 0px;
        padding: 0px;
    }

    .topNavigation-item img {}


    .table-rc-all {
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        border-radius: 6px;
    }

    .navigationBar {
        margin: 0px auto;
        list-style: none;
        width: 1150px;
    }

    .navigationBar li {
        float: left;
        margin-right: 35px;
        display: list-item;
    }

    .widgetsNavigation {
        min-height: 268px;
    }

    .navigationBarActive-overlay {
        display: block;
        border-color: #cccccc transparent;
        border-style: solid;
        border-width: 0 7px 7px;
        margin: -7px 0 0 -7px;
        width: 0;
        position: relative;
        height: 0;
    }

    .navigationBarActive {
        display: block;
        border-color: #ffffff transparent;
        border-style: solid;
        border-width: 0 7px 7px;
        margin: -6px 0 0 -7px;
        width: 0;
        position: relative;
        height: 0;
    }

    .navigationBar a {
        font-family: Verdana, Arial, sans-serif;
        display: block;
        text-decoration: none;
        font-size: 14px;
        line-height: 40px;
        color: #000;
        text-shadow: 1px 1px 0 #fff;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -ms-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .navigationBar a:hover {
        color: #00a2e8;
        text-shadow: none;
    }

    .navTableHeader {
        font-family: Verdana, Arial, sans-serif;
        display: block;
        font-size: 11px;
        color: #4e4e4e;
        text-shadow: 1px 1px 0 #FFF;
        margin-left: 15px;
        padding-left: 1px;
        padding-top: 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid #eeeeee;
    }

    .navigationHeader {
        height: 40px;
        padding-top: 10px;
        background: #f3f5f7;
    }

    .navigationContainer {
        min-width: 960px;
        top: 0px;
        left: 0px;
        vertical-align: top;
        border-top: 1px solid #CCCCCC;
        border-bottom: 1px solid #CCCCCC;
        margin-left: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
        margin-right: 0px;
        display: block;
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.02)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background-color: #fdfdfd;
        -moz-box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0, 0, 0, 0.05);
        -webkit-box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0, 0, 0, 0.05);
        box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0, 0, 0, 0.05);
        border-bottom: 1px solid #ccc;
    }

    .navigatorInnerContainer {
        margin: 0px auto;
        width: 100%;
        max-height: 1050px;
        padding: 0px;
        border: 0px solid transparent;
    }

    .jqxDemoContainer {
        margin: 0px auto;
        width: 1160px;
        position: relative;
        margin-top: 5px;
    }



    .bottom {
        border-top: 1px solid #686868;
        width: 1150px;
        height: 100%;
        margin: 0 auto;
        color: #777777;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        line-height: 16px;
        width: 100%;
        background: #1c1e24;
        overflow: hidden;
        padding-bottom: 5px;
    }

    .top {
        overflow: hidden;
        min-height: 60px;
        width: 1150px;
        height: 100%;
        margin: 0 auto;
        color: #777777;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        line-height: 16px;
        width: 100%;
    }

    . .navigatorOuterTable {
        margin: 0 auto;
        table-layout: fixed;
        width: 100%;
        min-height: 100%;
        height: auto;
        height: 100%;
        border-collapse: collapse;
    }

    .navigatorOuterTable td:first-child {
        margin: 0px;
        border: none;
        padding: 0px;
    }

    .demoTabs {
        display: none;
    }

    .contentTable {
        table-layout: fixed;
        border-collapse: collapse;
        margin: 0px;
        padding: 0px;
    }

    .navigatorInnerTable,
    .navigatorTable {
        width: 100%;
        table-layout: fixed;
        margin: 0px;
        border-collapse: collapse;
        padding: 0px;
        border: none;
    }

    #loading-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        display: none;
        align-items: center;
        background-color: #000;
        z-index: 999;
        opacity: 0.5;
    }

    .loading-icon {
        position: absolute;
        border-top: 2px solid #fff;
        border-right: 2px solid #fff;
        border-bottom: 2px solid #fff;
        border-left: 2px solid #767676;
        border-radius: 25px;
        width: 25px;
        height: 25px;
        margin: 0 auto;
        position: absolute;
        left: 50%;
        margin-left: -20px;
        top: 50%;
        margin-top: -20px;
        z-index: 4;
        -webkit-animation: spin 1s linear infinite;
        -moz-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
    }

    @-moz-keyframes spin {
        100% {
            -moz-transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    #active {
        background-color: #e7e7e7 !important;
    }

    .back_image {
        background-image: url(<?= base_url() ?>images/login_images/back_1.jpg);
        background-repeat: no-repeat;
        background-color: transparent;
        background-size: auto;
        _background-size: 1108px 763px;
        background-position: -18px 89%;
    }

    #search_area {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }

    #back_area {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }

    #grid_search:hover {
        background: #29cdff !important;
    }

    #back:hover {
        background: #29cdff !important;
    }
</style>

<div>

    <table style="width:100%;">
        <tr>
            <td style="width:13%;padding-top:5px;padding-left:5px;position:fixed;">
                <!---- Left Side Menu Start ------>
                <?php $this->load->view('bill_approve_ho/pages/left_side_nav'); ?>
                <!-- --====== Left Side Menu End==========--- -->
            </td>
            <td style="width:87%;">

                <div id="jqxGrid2">

                </div>
                <div style="float:left;padding-top: 5px;">
                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                        <? if (VERIFY == 1) { ?>
                            <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" href="<?= base_url() ?>bill_approve_ho/bulk_operation/apv/lawyer_bill" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;" value="BULK APV" id="sendButton" /></a>
                            <? } ?>&nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>V = </strong> Verify,&nbsp;
                            <strong>P = </strong> Preview&nbsp;
                    </div> <br />
                </div>



            </td>
        </tr>

    </table>
</div>

<div id="details" style="display: none;">
    <div style=""><strong><span id="r_heading"></span></strong></div>
    <div style="" id="details_table">
        <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?= base_url() ?>bill_ho/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                    <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                        <tr id="attachment_row">
                            <td>Attachment (If Any):</td>
                            <td>
                                <span id="file_for_finance"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                    <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                        <tr id="verify_return_row" style="display:none">
                            <td>Reason<span style="color: red;">*</span></td>
                            <td>
                                <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="buttonSend" id="approve" value="Approve">
                                <input type="button" class="buttondelete" id="verify_return" value="Return" />
                                <input type="button" class="buttondelete" id="verify_reject" value="Reject" />
                                <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                <span id="verify_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                    <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                        <tr id="attachment_row_finance" style="display:none">
                            <td align="left">Attachment (If Any):</td>
                            <td align="left">
                                <span id="file_from_finance"></span>
                            </td>
                        </tr>
                        <tr id="return_row" style="display:none">
                            <td>Return Reason<span style="color: red;">*</span></td>
                            <td>
                                <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="buttondelete" id="reject" value="Return" />
                                <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- grid data starts -->
<script>
    var theme = getDemoTheme();
    // Jqx tab second tab function start    Grid Show
    var initGrid2 = function() {

        var source = {
            datatype: "json",
            datafields: [{
                    name: 'id',
                    type: 'int'
                },
                {
                    name: 'e_by_id',
                    type: 'int'
                },
                {
                    name: 'sts',
                    type: 'int'
                },
                {
                    name: 'bill_type',
                    type: 'int'
                },
                {
                    name: 'status',
                    type: 'string'
                },
                {
                    name: 'lawyer_name',
                    type: 'string'
                },
                {
                    name: 'zone_name',
                    type: 'string'
                },
                {
                    name: 'district_name',
                    type: 'string'
                },
                {
                    name: 'bill_amount',
                    type: 'string'
                },
                {
                    name: 'discount_amount',
                    type: 'string'
                },
                {
                    name: 'invoice_amount',
                    type: 'string'
                },
                {
                    name: 'sl_no',
                    type: 'string'
                },
                {
                    name: 'dispatch_no',
                    type: 'string'
                },
                {
                    name: 'e_by',
                    type: 'string'
                },
                {
                    name: 'e_dt',
                    type: 'string'
                },
                {
                    name: 'v_by',
                    type: 'string'
                },
                {
                    name: 'v_dt',
                    type: 'string'
                },
                {
                    name: 'bill_months',
                    type: 'string'
                }

            ],
            addrow: function(rowid, rowdata, position, commit) {
                commit(true);
            },
            deleterow: function(rowid, commit) {
                commit(true);
            },
            updaterow: function(rowid, newdata, commit) {
                commit(true);
            },
            url: '<?= base_url() ?>bill_approve_ho/lawyer_grid',
            cache: false,
            filter: function() {
                // update the grid and send a request to the server.
                jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
            },
            sort: function() {
                // update the grid and send a request to the server.
                jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
            },
            root: 'Rows',
            beforeprocessing: function(data) {
                if (data != null) {
                    //alert(data[0].TotalRows)
                    source.totalrecords = data[0].TotalRows;
                    if (data[0].TotalRows > 0) {
                        jQuery('#xl_btn').show();
                    } else {
                        jQuery('#xl_btn').hide();
                    }
                }
            }

        };

        var dataadapter = new jQuery.jqx.dataAdapter(source, {
            loadError: function(xhr, status, error) {
                alert(error);
            },
            formatData: function(data) {
                var legal_zone = jQuery.trim(jQuery('input[name=legal_zone_grid]').val());
                var legal_district = jQuery.trim(jQuery('#legal_district_grid').val());
                var lawyer = jQuery.trim(jQuery('#lawyer_grid').val());
                var status = jQuery.trim(jQuery('#status_grid').val());
                var from_date = jQuery.trim(jQuery('#from_date').val());
                var to_date = jQuery.trim(jQuery('#to_date').val());
                jQuery.extend(data, {
                    legal_zone: legal_zone,
                    legal_district: legal_district,
                    lawyer_grid: lawyer,
                    from_date: from_date,
                    to_date: to_date,
                    status_grid: status
                });
                return data;
            }
        });
        var columnCheckBox = null;
        var updatingCheckState = false;
        // initialize jqxGrid. Disable the built-in selection.
        var celledit = function(row, datafield, columntype) {
            var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
            if (checked == false) {
                return false;
            };
        };
        var win_h = jQuery(window).height() - 220;
        jQuery("#jqxGrid2").jqxGrid({
            width: '99%',
            height: win_h,
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
            rendergridrows: function(obj) {
                return obj.data;
            },
            columns: [{
                    text: 'Id',
                    datafield: 'id',
                    hidden: true,
                    editable: false,
                    width: '4%'
                },
                <? if (EDIT == 1) { ?> {

                        text: 'E',
                        datafield: 'edit',
                        editable: false,
                        align: 'center',
                        sortable: false,
                        menu: false,
                        width: 35,
                        cellsrenderer: function(row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            //court fee edit
                            //
                            if ((<?= $this->session->userdata['ast_user']['user_id'] ?> == dataRecord.e_by_id || <?= $this->session->userdata['ast_user']['user_system_admin_sts'] ?> == '2') && (dataRecord.sts == 25 || dataRecord.sts == 27 || dataRecord.sts == 29)) {
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit(' + dataRecord.id + ',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
                            } else {
                                return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }
                        }
                    },
                <? } ?>

                <? if (VERIFY == 1) { ?> {
                        text: 'V',
                        datafield: 'verify',
                        editable: false,
                        align: 'center',
                        sortable: false,
                        menu: false,
                        width: 35,
                        cellsrenderer: function(row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if (dataRecord.sts != 29) {
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',' + editrow + ',\'verify\')" ><img align="center" src="<?= base_url() ?>images/drag.png"></div>';
                            } else if (dataRecord.sts == 29) {
                                return '<div style=" margin-top: 7px;text-align:center">V</div>';
                            }
                        }
                    },
                <? } ?>

                <? if (VERIFYFINANCE == 1) { ?> {
                        text: 'VF',
                        datafield: 'verifyfinance',
                        editable: false,
                        align: 'center',
                        sortable: false,
                        menu: false,
                        width: 35,
                        cellsrenderer: function(row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if (dataRecord.sts == 70) {
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',' + editrow + ',\'verifyfinance\')" ><img align="center" src="<?= base_url() ?>images/drag.png"></div>';
                            } else {
                                return '<div style=" margin-top: 7px;text-align:center"></div>';
                            }
                        }
                    },
                <? } ?> {
                    text: 'P',
                    menu: false,
                    datafield: 'Preview',
                    align: 'center',
                    editable: false,
                    sortable: false,
                    width: '2%',
                    cellsrenderer: function(row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',' + editrow + ',\'details\')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

                    }
                },
                <? if (VIEWMEMO == 1) { ?> {
                        text: 'BM',
                        menu: false,
                        datafield: 'Download',
                        align: 'center',
                        editable: false,
                        sortable: false,
                        width: '3%',
                        cellsrenderer: function(row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if (dataRecord.sts == 29 || dataRecord.sts == 70) {
                                //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?= base_url() ?>index.php/bill_ho/download_court_fee_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?= base_url() ?>images/icon_xls.gif"></a></div>';
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?= base_url() ?>index.php/bill_ho/download_court_fee_memo/' + dataRecord.id + '\')" align="center" src="<?= base_url() ?>images/icon_xls.gif"></div>';
                            }

                        }
                    },
                    {
                        text: 'PDF',
                        menu: false,
                        datafield: 'PDF',
                        align: 'center',
                        editable: false,
                        sortable: false,
                        width: '3%',
                        cellsrenderer: function(row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if (dataRecord.sts == 29 || dataRecord.sts == 70) {
                                //return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><a href="<?= base_url() ?>index.php/bill_ho/download_pdf_court_fee/'+dataRecord.id+'" target="_blank"><img align="center" src="<?= base_url() ?>images/pdf_icon.gif"></a></div>';
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?= base_url() ?>index.php/bill_ho/download_pdf_court_fee/' + dataRecord.id + '\')" align="center" src="<?= base_url() ?>images/pdf_icon.gif"></div>';
                            }
                        }
                    },
                <? } ?> {
                    text: 'Status',
                    datafield: 'status',
                    editable: false,
                    width: '25%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Lawyer Name',
                    datafield: 'lawyer_name',
                    editable: false,
                    width: '25%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Bill Amount',
                    datafield: 'bill_amount',
                    editable: false,
                    width: '12%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Discount Amount',
                    datafield: 'discount_amount',
                    editable: false,
                    width: '12%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Invoice Amount',
                    datafield: 'invoice_amount',
                    editable: false,
                    width: '12%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Bill Months',
                    datafield: 'bill_months',
                    editable: false,
                    width: '20%',
                    align: 'left',
                    cellsalign: 'left'
                },
                // {
                //     text: 'zone Name',
                //     datafield: 'zone_name',
                //     editable: false,
                //     width: '10%',
                //     align: 'left',
                //     cellsalign: 'left'
                // },
                // {
                //     text: 'District Name',
                //     datafield: 'district_name',
                //     editable: false,
                //     width: '10%',
                //     align: 'left',
                //     cellsalign: 'left'
                // },
                {
                    text: 'SL No.',
                    datafield: 'sl_no',
                    editable: false,
                    align: 'left',
                    cellsalign: 'center',
                    sortable: true,
                    menu: true,
                    width: '11%',
                    cellsrenderer: function(row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history(' + dataRecord.id + ',\'life_cycle\',' + dataRecord.bill_type + ')"><span>' + dataRecord.sl_no + '</span></a></div>';

                    }
                },
                {
                    text: 'Despatch No.',
                    datafield: 'dispatch_no',
                    editable: false,
                    width: '17%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Create By',
                    datafield: 'e_by',
                    editable: false,
                    width: '18%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Create Date',
                    datafield: 'e_dt',
                    editable: false,
                    width: '18%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Verify By',
                    datafield: 'v_by',
                    editable: false,
                    width: '18%',
                    align: 'left',
                    cellsalign: 'left'
                },
                {
                    text: 'Verify Date',
                    datafield: 'v_dt',
                    editable: false,
                    width: '18%',
                    align: 'left',
                    cellsalign: 'left'
                }

            ],

        });

    }
    initGrid2();
    //

    jQuery("#details").jqxWindow({
        theme: theme,
        maxWidth: '100%',
        maxHeight: '100%',
        width: 1200,
        height: 600,
        resizable: false,
        isModal: true,
        autoOpen: false,
        cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel")
    });

    function details(id, editrow, operation) {

        jQuery("#return_reason").val('');
        jQuery("#return_reason_verify").val('');
        jQuery("#return_row").hide();
        jQuery("#attachment_row_finance").hide();
        jQuery("#verify_return_row").hide();
        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
        if (operation == 'sendtochecker') {
            jQuery("#r_heading").html('Send To Checker');
            jQuery("#deleteEventId").val('');
            jQuery("#delete_row").hide();
            jQuery("#preview").hide();
            jQuery("#checker_row").show();
            jQuery("#type").val('sendtochecker');
            jQuery("#sendtochecker").val('Send');
            jQuery("#verifyid").val(dataRecord['id']);
            jQuery("#finance_row").hide();
            jQuery("#attachment_row").hide();
            jQuery("#verify_row").hide();
        } else if (operation == 'verify') {
            jQuery("#r_heading").html('Verify');
            jQuery("#deleteEventId").val('');
            jQuery("#delete_row").hide();
            jQuery("#preview").hide();
            jQuery("#checker_row").hide();
            jQuery("#verify_row").show();
            jQuery("#type").val('verify');
            jQuery("#verifyid").val(dataRecord['id']);
            jQuery("#attachment_row").hide();
            jQuery("#finance_row").hide();
        } else {
            jQuery("#deleteEventId").val('');
            jQuery("#verifyid").val('');
            jQuery("#delete_row").hide();
            jQuery("#checker_row").hide();
            jQuery("#preview").show();
            jQuery("#r_heading").html('Preview');
            jQuery("#attachment_row").hide();
            jQuery("#finance_row").hide();
            jQuery("#verify_row").hide();
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: "<?= base_url() ?>bill_ho/lawyer_bill_details",
            data: {
                [csrfName]: csrfHash,
                id: id
            },
            datatype: "json",
            success: function(response) {

                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json.csrf_token);
                if (json.str) {
                    var html = '';
                    html += '<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_for_finance\')"/>';
                    html += '<input type="hidden" id="hidden_file_for_finance_select" name="hidden_file_for_finance_select" value="0">';
                    html += '<span id="hidden_file_for_finance">';
                    jQuery('#file_for_finance').html(html);

                    var html = '';
                    html += '<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_from_finance\')"/>';
                    html += '<input type="hidden" id="hidden_file_from_finance_select" name="hidden_file_from_finance_select" value="0">';
                    html += '<span id="hidden_file_from_finance">';
                    jQuery('#file_from_finance').html(html);

                    document.getElementById("details").style.visibility = 'visible';
                    jQuery("#details_body").html(json['str']);
                    jQuery("#details").jqxWindow('open');
                } else {
                    alert("Something went wrong, please refresh the page.")
                }

            }
        });

        document.getElementById("details").style.visibility = 'visible';
        jQuery("#details").jqxWindow('open');
    }

    jQuery("#approve").click(function() {
        jQuery('#type').val('verify');
        jQuery("#verify_return_row").hide();
        jQuery("#verify_return").hide();
        jQuery("#approve").hide();
        jQuery("#verify_reject").hide();
        jQuery("#verify_cancel").hide();
        jQuery("#verify_loading").show();




        call_ajax_approve();

    });

    function call_ajax_approve() {

        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash


        var vId = jQuery("#verifyid").val();
        var type = jQuery('#type').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?= base_url() ?>bill_approve_ho/delete_action/",
            data: {
                [csrfName]: csrfHash,
                verifyid: vId,
                type: type
            },
            datatype: "json",
            async: false,
            success: function(response) {

                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);

                jQuery("#details").jqxWindow('close');
                if (json.Message == "OK") {
                    var msg = 'Saved';
                }

                jQuery("#error").show();
                jQuery("#error").fadeOut(11500);
                jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + msg);

                jQuery("#jqxGrid2").jqxGrid('updatebounddata');

            }
        });
    }
    //
</script>
<!-- grid data ends -->