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

    #active {
        background: #93CDDD !important;
        font-weight: bold;
    }
</style>
<style type="text/css">
    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    /* td:nth-child(2) {
            padding-right: 20px;
        }​  */
    #ext {
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    .button6 {
        background-color: #555555;
        /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        ;
        border-radius: 12px;
    }

    .button1 {
        background-color: #555555;
        /* Green */
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        ;
        border-radius: 12px;
    }

    .button_delete {
        background-color: #00ffff;
        /* Green */
        border: none;
        color: white;
        padding: 5px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .button3 {
        background-color: #4CAF50;
        color: black;
    }

    table {
        border-collapse: collapse;
    }

    table#preview_table td {
        border: 1px solid #c7c7c7;
    }

    table.preview_table2 td,
    table.preview_table2 th {
        border: 1px solid #c7c7c7;
        word-wrap: break-word;
        padding: 5px;
    }

    .button4 {
        background-color: #00ffff;
        color: black;
    }

    .button3,
    .button4:hover {
        background-color: #f44336;
        color: white;
    }

    .center {
        margin: 0;
        position: absolute;
        top: 90%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    /* .center {
        margin: auto;
        width: 20%;
        padding: 10px;
        } */
    .text-input {
        height: 23px;
        width: 350px;
    }


    .required {
        vertical-align: baseline;
        color: red;
        font-size: 10px;
    }

    #details {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    b {
        font-size: 14px;
    }


    #details td,
    #details th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #details th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
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

    .buttonclose {
        background-color: white;
        color: black;
        border: 2px solid #555555;
        border-radius: 12px;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
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

    .buttonclose:hover {
        background-color: #555555;
        color: white;
    }

    .wrapper {
        text-align: center;
    }

    .button {
        position: absolute;
        top: 50%;
    }

    #gurantor_table {
        border-collapse: collapse;
    }

    #gurantor_table td {
        border: 1px solid rgba(0, 0, 0, .20);
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

    .jqx-tabs-header {
        border-color: #93CDDD !important;
        background: #93CDDD !important;
    }

    .addmore {
        background-image: url(<?= base_url() ?>images/addmore_grn.png);
        /*background-size: 20px 20px;*/
        background-repeat: no-repeat;
        border: 0;
        width: 18px;
        height: 18px;
        background-color: transparent;
        cursor: pointer;
    }
</style>


<script type="text/javascript">
    var theme = getDemoTheme();


    //block filed name first and field type will concat by ####
    var block_field_list = [

    ];
    //Some Global veriabale for expense

    var proposed_type = ["Investment", "Card"];
    var req_type_array = [<? $i = 1;
                            foreach ($req_type as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];

    var petition_submitted_sts = ['Yes', "No"];
    var approval_sts = ['Yes', "No"];

    // approval_sts



    jQuery(document).ready(function() {

        jQuery("#proposed_type").jqxComboBox({
            theme: theme,
            width: 100,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Proposed Type",
            source: proposed_type,
            height: 25
        });
        jQuery("#req_type").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            dropDownHeight: 100,
            promptText: "Type Of Case",
            source: req_type_array,
            width: 120,
            height: 30
        });

        jQuery("#petition_submitted_sts").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            dropDownHeight: 100,
            promptText: "Select",
            source: petition_submitted_sts,
            width: 250,
            height: 30
        });
        jQuery("#approval_sts").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            dropDownHeight: 100,
            promptText: "Select",
            source: approval_sts,
            width: 250,
            height: 30
        });




        jQuery("#petition_submitted_sts").on('change',function() {

            var item = jQuery("#petition_submitted_sts").jqxComboBox('getSelectedItem');
            if (item != null && item.value == "Yes") {

                jQuery("#receiver_name_row").show();
                jQuery("#receiver_number_row").show();
                jQuery("#approval_sts_row").show();
                jQuery("#collection_rent_amount_row").show();
                jQuery("#remarks_row").show();



                
            }else{
                jQuery("#receiver_name_row").hide();
                jQuery("#receiver_number_row").hide();
                jQuery("#approval_sts_row").hide();
                jQuery("#collection_rent_amount_row").hide();
                jQuery("#remarks_row").hide();

                // jQuery("#receiver_name").val('');
                // jQuery("#receiver_number").val('');
                // jQuery("#collection_rent_amount").val('');
                // jQuery("#remarks").val('');
                // jQuery("#approval_sts").jqxComboBox('val','');






            }

        });















        var theme = 'classic';

        //var theme = 'energyblue';
        jQuery('#proposed_type,#req_type').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

        jQuery("#proposed_type").jqxComboBox('val', 'Investment');

        change_caption();

        jQuery('#proposed_type').bind('change', function(event) {
            jQuery("#loan_ac").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();
        });

        jQuery("#sendtochecker").click(function() {
            jQuery("#sendtochecker").hide();
            jQuery("#SendTocheckercancel").hide();
            jQuery("#sendtochecker_loading").show();
            call_ajax_submit_delete();
        });



        jQuery("#verify").click(function() {
            jQuery("#return").hide();
            jQuery("#reject").hide();
            jQuery('#type').val('verify');
            jQuery("#verify").hide();
            jQuery("#Verifycancel").hide();
            jQuery("#verify_loading").show();
            call_ajax_submit_delete();
        });



        rules2 = [];
        rules3 = [{
                input: '#comments',
                message: 'required!',
                action: 'keyup, blur',
                rule: function(input, commit) {
                    if (jQuery("#comments").val() == '') {
                        jQuery("#comments").focus();
                        return false;
                    } else {
                        return true;
                    }
                }
            },

            {
                input: '#comments',
                message: 'more than 250 characters',
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (input.val() != '') {
                        if (input.val().length > 250) {
                            jQuery("#comments").focus();
                            return false;

                        }
                    }
                    return true;

                }
            },
        ];



        jQuery("#delete_button").click(function() {
            jQuery('#action_form').jqxValidator({
                rules: rules3,
                theme: theme
            });
            var validationResult = function(isValid) {
                if (isValid) {
                    jQuery("#delete_button").hide();
                    jQuery("#deletecancel").hide();
                    jQuery("#delete_loading").show();
                    call_ajax_submit_delete();
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);
        });



        var initGrid = function() {
            var source = {
                datatype: "json",
                datafields: [{
                        name: 'id',
                        type: 'int'
                    },
                    {
                        name: 'sts',
                        type: 'int'
                    },

                    {
                        name: 'status',
                        type: 'int'
                    },

                    {
                        name: 'petition_date',
                        type: 'string'

                    },
                    {
                        name: 'petition_submitted_sts',
                        type: 'string'

                    },
                    {
                        name: 'receiver_name',
                        type: 'string'

                    },
                    {
                        name: 'receiver_number',
                        type: 'string'
                    },
                    {
                        name: 'approval_sts',
                        type: 'string'

                    },
                    {
                        name: 'collection_rent_amount',
                        type: 'string'
                    },
                    {
                        name: 'remarks',
                        type: 'string'

                    },

                  
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
                url: '<?= base_url() ?>index.php/Receiver/grid',
                cache: false,
                filter: function() {
                    // update the grid and send a request to the server.
                    jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                },
                sort: function() {
                    // update the grid and send a request to the server.
                    jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                },
                root: 'Rows',
                beforeprocessing: function(data) {
                    if (data != null) {
                        //alert(data[0].TotalRows)
                        source.totalrecords = data[0].TotalRows;
                    }
                }

            };

            var dataadapter = new jQuery.jqx.dataAdapter(source, {
                loadError: function(xhr, status, error) {
                    alert(error);
                },
                formatData: function(data) {
                    var receiver_name_grid = jQuery.trim(jQuery('input[name=receiver_name_grid]').val());
                    var rent_amount_grid = jQuery.trim(jQuery('#rent_amount_grid').val());
       
                    jQuery.extend(data, {
                        receiver_name_grid: receiver_name_grid,
                        rent_amount_grid: rent_amount_grid,
                

                    });
                    return data;
                }
            });
            var columnCheckBox = null;
            var updatingCheckState = false;
            // initialize jqxGrid. Disable the built-in selection.
            var celledit = function(row, datafield, columntype) {
                var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                if (checked == false) {
                    return false;
                };
            };
            // set rows details.
            jQuery("#jqxgrid").bind('bindingcomplete', function(event) {
                if (event.target.id == "jqxgrid") {
                    jQuery("#jqxgrid").jqxGrid('beginupdate');
                    var datainformation = jQuery("#jqxgrid").jqxGrid('getdatainformation');
                    for (i = 0; i < datainformation.rowscount; i++) {
                        jQuery("#jqxgrid").jqxGrid('setrowdetails', i, "<div id='grid" + i + "' style='margin: 10px;'></div>", 200, true);
                    }
                    jQuery("#jqxgrid").jqxGrid('resumeupdate');
                }
            });
            var win_h = jQuery(window).height() - 310;
            jQuery("#jqxgrid").jqxGrid({
                width: '99%',
                height: win_h,
                source: dataadapter,
                theme: theme,
                filterable: true,
                sortable: true,
                pageable: true,
                virtualmode: true,
                editable: true,
                rowdetails: false,
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
                    <? if (DELETE == 1) { ?> {
                            text: 'D',
                            datafield: 'delete',
                            editable: false,
                            align: 'center',
                            sortable: false,
                            menu: false,
                            width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);

                                if (dataRecord.sts == 39 || dataRecord.sts == 35) {
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'delete\')" ><img align="center" src="<?= base_url() ?>images/delete-New.png"></div>';
                                } else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                        },
                    <? } ?>
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
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if (dataRecord.sts == 39 || dataRecord.sts == 35) {

                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit(' + dataRecord.id + ',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
                                }
                            }
                        },
                    <? } ?>

                    {
                        text: 'P',
                        menu: false,
                        datafield: 'Preview',
                        align: 'center',
                        editable: false,
                        sortable: false,
                        width: '2%',
                        cellsrenderer: function(row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                            return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

                        }
                    },

                    <? if (SENDTOCHECKER == 1) { ?> {
                            text: 'STC',
                            datafield: 'sendtochecker',
                            editable: false,
                            align: 'center',
                            sortable: false,
                            menu: false,
                            width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if (dataRecord.sts == 39 || dataRecord.sts == 35) {

                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'sendtochecker\',' + editrow + ')" ><img align="center" src="<?= base_url() ?>images/forward.png"></div>';
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
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if (dataRecord.sts == 37) {

                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'verify\',' + dataRecord.suit_file_id + ')" ><img align="center" src="<?= base_url() ?>images/activate1.png"></div>';
            
                              
                                }
                              
                            }
                        },

                    <? } ?>
       
                    {
                        text: 'Status',
                        datafield: 'status',
                        editable: false,
                        width: '17%',
                        align: 'left',
                        cellsalign: 'left'
                    },

                    {
                        text: 'Petition Date',
                        datafield: 'petition_date',
                        editable: false,
                        width: '15%',
                        align: 'left',
                        cellsalign: 'left'
                    },

                    {
                        text: 'Petition Submitted Status',
                        datafield: 'petition_submitted_sts',
                        editable: false,
                        width: '15%',
                        align: 'left',
                        cellsalign: 'left'
                    },
                    {
                        text: 'Receiver Name',
                        datafield: 'receiver_name',
                        editable: false,
                        width: '18%',
                        align: 'left',
                        cellsalign: 'left'
                    },
                    {
                        text: 'Receiver Number',
                        datafield: 'receiver_number',
                        editable: false,
                        width: '18%',
                        align: 'center',
                        cellsalign: 'center'
                    },
                    {
                        text: 'Approval Status',
                        datafield: 'approval_sts',
                        editable: false,
                        width: '18%',
                        align: 'left',
                        cellsalign: 'left'
                    },
                    {
                        text: 'Collection Rent Amount',
                        datafield: 'collection_rent_amount',
                        editable: false,
                        width: '18%',
                        align: 'center',
                        cellsalign: 'center'
                    },
                    {
                        text: 'Remarks',
                        datafield: 'remarks',
                        editable: false,
                        width: '18%',
                        align: 'center',
                        cellsalign: 'center'
                    },
                ],
            });
        };
        // Jqx tab second tab function start    Grid Show
        var initWidgets = function(tab) {
            switch (tab) {
                case 0:

                    break;
                case 1:
                    initGrid();
                    break;
            }
        }
        jQuery('#jqxTabs').jqxTabs({
            width: '99%',
            initTabContent: initWidgets
        });
        jQuery('#jqxTabs').bind('selected', function(event) {
            jQuery('#reciver_form').jqxValidator('hide');
            reload();
        });
        jQuery('#jqxTabs').jqxTabs('select', 0);
        <? if (ADD != 1 && EDIT != 1) { ?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
        <? } ?>
        //End check box update 
        jQuery("#details").jqxWindow({
            theme: theme,
            width: '75%',
            height: '90%',
            resizable: false,
            isModal: true,
            autoOpen: false,
            cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel,#Verifycancel,#nextdatecancel")
        });


        jQuery('#details').on('close', function(event) {
            jQuery('#action_form').jqxValidator('hide');
        });

    });

    function date_validation(date1, date2) {

        var str_subsdt = date1.split("/")
        var subsdt = str_subsdt[1] + "/" + str_subsdt[0] + "/" + str_subsdt[2];
        var subdt = new Date(subsdt);


        var str_subsdt2 = date2.split("/")
        var subsdt2 = str_subsdt2[1] + "/" + str_subsdt2[0] + "/" + str_subsdt2[2];
        var subdt2 = new Date(subsdt2);

        if (Date.parse(subdt) < Date.parse(subdt2)) {
            return false;
        }

        return true;
    }

    function validatenewDate(date1) {
        var now = new Date();
        now.setHours(0, 0, 0, 0);
        var str = jQuery('#case_dt').val();
        tmp1 = str.split("/")
        yDate = tmp1[1] + "/" + tmp1[0] + "/" + tmp1[2];
        var prev = new Date(yDate);
        var today = prev.valueOf();

        tmp = date1.split("/")
        xDate = tmp[1] + "/" + tmp[0] + "/" + tmp[2];
        var curent = new Date(xDate);
        refDate = curent.valueOf();

        if (today > refDate) {
            return false;
        }
        return true;
    }

    function call_ajax_submit_delete() {
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postData = jQuery('#action_form').serialize() + "&" + csrfName + "=" + csrfHash;
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: '<?= base_url() ?>index.php/Receiver/delete_action/',
            data: postData,
            datatype: "json",
            success: function(response) {
                ///console.log(response);
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if (jQuery("#type").val() == 'delete') {
                    jQuery("#delete_row").show();
                    jQuery("#delete_button").show();
                    jQuery("#deletecancel").show();
                    jQuery("#delete_loading").hide();
                }
                if (jQuery("#type").val() == 'sendtochecker') {
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#sendtochecker_loading").hide();
                    jQuery("#delete_loading").hide();
                }
           
                if (jQuery("#type").val() == 'verify') {
         
                    jQuery("#verify").show();
                    jQuery("#Verifycancel").show();
                    jQuery("#verify_loading").hide();
                }
                if (json.Message != 'OK') {
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                    return false;
                } else {
                    var row = {};
                    row["id"] = json['row_info'].id;
                    row["sl_no"] = json['row_info'].sl_no;
                    row["loan_ac"] = json['row_info'].loan_ac;
                    row["ac_name"] = json['row_info'].ac_name;

                    var msz = '';

                    jQuery("#jqxgrid").jqxGrid('updatebounddata');
                    jQuery("#error").show();
                    jQuery("#error").fadeIn(100, function() {
                        jQuery("#error").fadeOut(11500);
                    });
                    jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + $('type').value + msz);
                    jQuery('#details').jqxWindow('close');
                }
            }
        });

    }

    function details(id, operation, suit_file_id) {
        jQuery("#return_reason").val('');
        jQuery("#new_next_date").val('');
        jQuery("#return_row").hide();
        jQuery('#deleteEventId').val(id);
        jQuery('#type').val(operation);
        jQuery('#suit_file_id').val(suit_file_id);
        if (operation == 'details') {

            jQuery("#header_title").html('Request Details');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').show();
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
        } else if (operation == 'delete') {
            jQuery("#header_title").html('Delete Request');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').show();
            jQuery('#close_btn_row').hide();
            jQuery('#comments').val('');
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
        } else if (operation == 'sendtochecker') {
            jQuery("#header_title").html('Send To Checker');
            jQuery('#sendtochecker_row').show();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
        } else if (operation == 'verify') {
            jQuery("#header_title").html('Approve Changes');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').show();
            jQuery('#next_date_row').hide();
        }



        jQuery('#loading_preview').show();
        jQuery('#loading_p').show();
        jQuery('#details_table').hide();
        jQuery("#details").jqxWindow('open');
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?= base_url() ?>Receiver/details",
            data: {
                [csrfName]: csrfHash,
                id: id
            },
            datatype: "json",
            success: function(response) {
                //alert(response);
                var json = jQuery.parseJSON(response);


                jQuery('.txt_csrfname').val(json.csrf_token);
                if (json.str) {
                    document.getElementById("details").style.visibility = 'visible';
                    jQuery("#main_body").html(json['str']);
                    jQuery('#loading_preview').hide();
                    jQuery('#loading_p').hide();
                    jQuery('#details_table').show();
                    jQuery("#details").jqxWindow('open');
                } else {
                    alert("Something went wrong, please refresh the page.")
                }

            }
        });
    }

    function delete_action(type) {
        var message = '';
        if (type == 'save') {
            jQuery("#reason_message_body").hide();
            jQuery("#ad_type").val(type);
            jQuery("#message").html('Save');
            jQuery("#button_tag").html('Save');
            jQuery("#email_notification").val(type);
            jQuery("#success_message").val('Save');
        }
        $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
        $('sendToCheckerMessageDialogCancel').style.display = 'inline';
        $('loadingReturn').style.display = 'none';
        sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {
            position: 'fixed',
            modal: true,
            width: 470,
            close: true,
            id: 'sendToCheckerMessageDialog'
        });

        sendToCheckerMessageDialog.show();
    }

    function close_window() {
        sendToCheckerMessageDialog.hide();
    }

    function mask(str, textbox) {
        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
        if (item != null) {
            if (item.value == 'Card') {
                if (!str.includes("*") && str.length == 16) //For one time value paste
                {
                    var length = str.length;
                    var first_6 = str.slice(0, 6);
                    var mid = '******';
                    var last_6 = str.slice(12, 16);
                    var final_str = first_6 + mid + last_6;
                    textbox.value = final_str
                    jQuery("#hidden_loan_ac").val(str);
                } else //For single value enter
                {
                    //For New value
                    var orginal_loan_ac = jQuery("#hidden_loan_ac").val();
                    if (orginal_loan_ac.length < str.length) {
                        var index = str.length - 1;
                        var new_val = str.slice(index);
                        orginal_loan_ac += new_val;
                        //alert(orginal_loan_ac);
                        jQuery("#hidden_loan_ac").val(orginal_loan_ac);
                    }
                    //For delete key
                    else {
                        var len = str.length;
                        var new_val = orginal_loan_ac.slice(0, len);
                        jQuery("#hidden_loan_ac").val(new_val);
                    }
                    //For First 6 key
                    if (str.length <= 6) {
                        textbox.value = str
                    }
                    //for the last 4 key
                    else if (str.length >= 13) {
                        textbox.value = str
                    }
                    //For the middle 4 key
                    else {
                        var length = str.length;
                        var first_6 = str.slice(0, 6);
                        var mid = (str.length - 6);
                        var final_str = first_6;
                        for (var i = 1; i <= mid; i++) {
                            final_str += '*';
                        }
                        textbox.value = final_str
                    }

                    if (str.length == 16) //wrong input check
                    {
                        var letter_Count = 0;
                        var letter = '*';
                        for (var position = 0; position < str.length; position++) {
                            if (str.charAt(position) == letter) {
                                letter_Count += 1;
                            }
                        }
                        if (letter_Count < 6 || jQuery("#hidden_loan_ac").val().length != 16) {
                            textbox.value = '';
                            jQuery("#hidden_loan_ac").val('');
                            alert('Wrong way to input Card No please try again');
                        }
                    }
                }
            }
        }

    }

    function change_caption() {
        if (jQuery("#proposed_type").val() == '') {
            document.getElementById("loan_ac").disabled = true;
            jQuery("#l_or_c_no").html('Investment A/C or Card');
        } else {
            document.getElementById("loan_ac").disabled = false;
            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
            if (item.value == 'Investment') {
                jQuery("#l_or_c_no").html('Investment A/C ');
            } else if (item.value == 'Card') {
                jQuery("#l_or_c_no").html('Card');
            }
        }

    }

    function searchsuit() // customer search 
    {

        var loan_ac = jQuery('#loan_ac').val();
        var case_number = jQuery('#case_number').val();
        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
        var proposed_type = jQuery('#proposed_type').val();
        var case_number = jQuery('#case_number').val();
        var search_dt = jQuery('#search_dt').val();
        var req_type_id = jQuery('#req_type').val();
        var hidden_loan_ac = jQuery('#hidden_loan_ac').val();
        if (item == null && loan_ac != '') {
            alert('please select proposed type');
            jQuery("#proposed_type input").focus();
            return false;
        }
        if (loan_ac == '' && case_number == '' && search_dt == '') {
            alert('Please provide at least one search parameter!!!');
        } else {
            jQuery("#grid_loading").show();
            jQuery("#grid_search").hide();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: "<?= base_url() ?>index.php/Receiver/search_suit/",
                data: {
                    [csrfName]: csrfHash,
                    search_dt: search_dt,
                    case_number: case_number,
                    proposed_type: proposed_type,
                    req_type: req_type_id,
                    loan_ac: loan_ac,
                    case_number: case_number,
                    hidden_loan_ac: hidden_loan_ac
                },
                datatype: "html",
                success: function(response) {
                    var data = response.split("####");
                    jQuery('.txt_csrfname').val(data[1]);
                    jQuery("#grid_loading").hide();
                    jQuery("#grid_search").show();
                    jQuery('#searchTable').html(data[0]);

                }
            });
        }
    }

    function error() {
        alert('Please Select Suit');
    }

    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('suit_id')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }

    function date_formater(str) {
        //var str_1=str.split("T");
        if (str == '' || str == undefined) {
            return '';
        } else {
            var str_2 = str.split("-");
            var final_str = str_2[2] + '/' + str_2[1] + '/' + str_2[0];
            return final_str;
        }
    }

    function CheckChanged_2(checkAllBox, counter) {
        var ChkState = checkAllBox.checked;
        if (ChkState == true) {
            jQuery("#package_delete_" + counter).val(0);
        } else {
            jQuery("#package_delete_" + counter).val(1);
        }
    }

    function edit(id, index, ho_edit_sts = null) {
        var val = id;
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?= base_url() ?>Receiver/get_edit_info",
            data: {
                [csrfName]: csrfHash,
                id: val
            },
            datatype: "json",
            async: false,
            success: function(response) {


                var json = jQuery.parseJSON(response);



                jQuery('.txt_csrfname').val(json.csrf_token);

                if (json.Message == 'ok') {
         
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    jQuery('#add_edit').val('edit');
                    jQuery('#edit_id').val(json.id);

                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#status_form_div').show();

                    jQuery("#suit_file_id").val(json.result.suit_file_id);

                    jQuery("#petition_date").val(json.result.petition_date);
                    jQuery("#petition_submitted_sts").val(json.result.petition_submitted_sts);
                    jQuery("#receiver_name").val(json.result.receiver_name);
                    jQuery("#receiver_number").val(json.result.receiver_number);
                    jQuery("#approval_sts").val(json.result.approval_sts);
                    jQuery("#collection_rent_amount").val(json.result.collection_rent_amount);
                    jQuery("#remarks").val(json.result.remarks);
                } else {
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    alert("No Data Found");
                    jQuery('#add_edit').val('');
                }
            }
        });

    }


    function load_filing_info() {
        var checkboxes = document.getElementsByName('suit_id');
        var val;
        var required = false;
        checkboxes.forEach((item) => {
            if (item.checked == true) {
                val = item.value;
                required = true;
                //console.log(item.value) 
            }

        });
        if (required == false) {
            alert('Please Select a Loan Account!');
            return false;
        }
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?= base_url() ?>Receiver/get_add_info",
            data: {
                [csrfName]: csrfHash,
                id: val
            },
            datatype: "json",
            async: false,
            success: function(response) {
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if (json.Message == 'ok') {

                    jQuery('#add_edit').val('add');
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#status_form_div').show();
                    jQuery("#suit_file_id").val(json.id);

                    // jQuery("#present_lawyer_id").val(json.row_info.prest_lawyer_name);


                } else {
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    alert("No Data Found");
                    jQuery('#add_edit').val('');
                }
            }
        });

    }

    function search_data() {
        jQuery("#grid_search").hide();
        jQuery("#grid_loading").show();
        jQuery("#jqxgrid").jqxGrid('updatebounddata');
        jQuery("#grid_search").show();
        jQuery("#grid_loading").hide();
        return;

    }

    function clear_form() {

        unblock_fields_for_any_time_edit(block_field_list);

        jQuery("#petition_date").val('');
        jQuery("#receiver_name").val('');
        jQuery("#receiver_number").val('');
        jQuery("#remarks").val('');

        jQuery("#collection_rent_amount").val('');
        jQuery("#petition_submitted_sts").jqxComboBox('clearSelection');
        jQuery("#approval_sts").jqxComboBox('clearSelection');


                jQuery("#receiver_name_row").hide();
                jQuery("#receiver_number_row").hide();
                jQuery("#approval_sts_row").hide();
                jQuery("#collection_rent_amount_row").hide();
                jQuery("#remarks_row").hide();
            




    }

    function reload() {
        jQuery('#status_form_div').hide();
        jQuery('#search_area').show();
        jQuery('#searchTable').html('');
        jQuery("#edit_id").val('');
        clear_form();
        jQuery('#add_edit').val('');
        jQuery('#reciver_form').jqxValidator('hide');
    }
</script>
<div id="container">
    <div id="body">
        <table class="">
            <tr id="widgetsNavigationTree">
                <td valign="top" align="left" class='navigation'>
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('legal_file_process/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->

                </td>
                <td valign="top" id="demos" class='rc-all content'>
                    <div id="preloader">
                        <div id="loding"></div>
                    </div>
                    <div>
                        <div id='jqxTabs'>
                            <ul>

                                <li style="margin-left: 30px;">Form</li>
                                <li>Data Grid</li>
                            </ul>
                            <!---==== First Tab Start ==========----->
                            <div style="overflow: hidden;" class="back_image">
                                <div style="padding: 10px;">
                                    <div id="search_area">
                                        <form method="POST" name="form" id="form" style="margin:0px;">

                                            <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                            <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
                                            <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                                <table id="deal_body" style="display:block;width:100%">
                                                    <tr>
                                                        <td style="text-align:left;width:13%"><strong>Req Type&nbsp;&nbsp;</strong> </td>
                                                        <td style="width:10%">
                                                            <div style="padding-left:1.8%" id="req_type" name="req_type"></div>
                                                        </td>
                                                        <td style="text-align:left;width:12%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                        <td style="width:5%">
                                                            <div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div>
                                                        </td>
                                                        <td style="text-align:left;width:11%"><strong><span id="l_or_c_no"></span> No.</strong></td>
                                                        <td style="width:15%"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:120px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);" /></td>
                                                        <td style="text-align:left;width:10%"><strong>Case No.</strong></td>
                                                        <td style="width:10%"><input name="case_number" tabindex="" type="text" class="" maxlength="" size="" style="width:100px" id="case_number" value="" onKeyUp="" /></td>
                                                        <td style="text-align:left;width:10%"><strong>Case Date</strong></td>
                                                        <td style="width:10%"><input type="text" name="search_dt" tabindex="3" placeholder="dd/mm/yyyy" style="width:100px;" id="search_dt" value="">
                                                            <script type="text/javascript" charset="utf-8">
                                                                datePicker("search_dt");
                                                            </script>
                                                        </td>
                                                        <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="searchsuit()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>
                                            <div id="searchTable"></div>
                                        </form>
                                    </div>
                                    <div id="status_form_div" style="display:none">
                                        <div id="back_area" style="text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                            <input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;margin-top:10px" />
                                        </div>
                                        <div id="suit_form_area">

                                        <!-- reciver_form -->


                                            <form method="POST" name="reciver_form" id="reciver_form" style="margin:0px;" action="<?= base_url() ?>index.php/Receiver/add_edit" enctype="multipart/form-data">
                                                <input type="hidden" id="edit_after_verify_sts" value="0" name="edit_after_verify_sts">
                                                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <input type="hidden" name="pre_case_sts_sl" id="pre_case_sts_sl" value="0">
                                                <input type="hidden" name="suit_file_id" id="suit_file_id" value="">
                                                <input type="hidden" name="edit_id" id="edit_id" value="">
                                                <input type="hidden" id="add_edit" value="" name="add_edit" value="">
                                                <input type="hidden" id="next_dt_sts_value" value="" name="next_dt_sts_value" value="1">
                                                <input type="hidden" id="present_lawyer_id" value="" name="present_lawyer_id" value="">
                                                <table style="width:100%;margin-top:20px" id="tab1Table">
                                                    <tbody>
                                                        <tr>
                                                            <td width="40%">
                                                                <table style="width: 100%;">

                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;">Petition Date<span style="color:red">*</span> </td>
                                                                        <td width="60%"><input type="text" name="petition_date" tabindex="3" onchange="check_hiliday('petition_date'),set_expense_date('petition_date')" placeholder="dd/mm/yyyy" style="width:250px;" id="petition_date" value="">
                                                                            <script type="text/javascript" charset="utf-8">
                                                                                datePicker_without_advance("petition_date");
                                                                            </script>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;">Petition Submitted Status<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <div id="petition_submitted_sts" name="petition_submitted_sts" style="padding-left: 3px" tabindex="6"></div>
                                                                        </td>
                                                                    </tr>



                                                                    <tr id="receiver_name_row" style="display:none">
                                                                        <td width="40%" style="font-weight: bold;"> Receiver Name <span style="color:red">*</span></td>

                                                                        <td><input name="receiver_name"  type="text" style="width:250px" id="receiver_name" /></td>
                                                                    </tr>




                                                                    <tr id="receiver_number_row" style="display:none">
                                                                        <td width="40%" style="font-weight: bold;"> Receiver Number </span></td>
                                                                        <td><input name="receiver_number"  type="text"   style="width:250px" id="receiver_number" ></td>
                                                                    </tr>



                                                                    <tr id="approval_sts_row" style="display:none">
                                                                        <td width="40%" style="font-weight: bold;">Approval Status<span style="color:red">*</span></td>
                                                                        <td width="60%">
                                                                            <div id="approval_sts" name="approval_sts" style="padding-left: 3px" tabindex="5"></div>
                                                                        </td>
                                                                    </tr>




                                                                    <tr id="collection_rent_amount_row" style="display:none">
                                                                        <td width="40%" style="font-weight: bold;"> Collection / Rent Amount <span style="color:red">*</span></td>

                                                                        <td><input name="collection_rent_amount" type="text"  style="width:250px" id="collection_rent_amount"/></td>

                                                                    </tr>

                                                                    <tr id="remarks_row"  style="display:none">
                                                                        <td width="40%" style="font-weight: bold;">Remarks </td>
                                                                        <td width="60%"><textarea name="remarks" tabindex="8" class="text-input-big" id="remarks" style="height:40px !important;width:250px"></textarea></td>
                                                                    </tr>




                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="text-align: center;">
                                                                <br />
                                                                <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="sendButton" /> <span id="send_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                                                <br /><br /><br />
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!---==== Second Tab Start ==========----->
                            <div style="overflow: hidden;">
                                <div style="padding: 0.5%;width:98%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;width:100%">
                                        <tr>
                                            <td style="text-align:right;width:15%"><strong> Receiver Name &nbsp;</strong> </td>

                                            <td style="width:10%"><input name="receiver_name_grid"  style="width:150px" id="receiver_name_grid"/></td>


                                            <td style="text-align:right;width:9%"><strong>Collection Rent Amount &nbsp;&nbsp;</strong> </td>

                                            <td style="width:10%"><input name="rent_amount_grid" style="width:150px" id="rent_amount_grid"/></td>


                
                                            <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div style="border:none;" id="jqxgrid"></div>
                                <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

                    
                                            <strong>D = </strong>Delete Request,&nbsp;
                                            <strong>E = </strong>Edit Request,&nbsp;
                                            <strong>STC = </strong>Send To Checker,&nbsp;
                                            <strong>V = </strong>Verify,&nbsp;
                                            <strong>P = </strong>Preview,&nbsp;

                                    </div> <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<!-- Modal for product details -->
<div id="details" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
    <form method="POST" name="action_form" id="action_form" style="margin:0px;">
        <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
        <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
        <input name="type" id="type" value="" type="hidden">
        <input name="suit_file_id" id="suit_file_id" value="" type="hidden">
        <input name="cif" id="cif" value="" type="hidden">
        <input name="sec_sts" id="sec_sts" value="" type="hidden">
        <div id="loading_preview" style="text-align:center">
            <span id="loading_p" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
        </div>
        <div style="" id="details_table">
            &nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table','gurantor_table','facility_table','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />
            <span id="main_body"></span>
            <br>
            <div id="preview_table"></div>

            <div id="gurantor_table"></div>

            <div id="facility_table"></div>

            <div id="facility_card"></div>

            <div id="proposed_type_d"></div>

            <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                <input type="button" class="button6" id="codeOK" value="Close" />
            </div>
            <div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                    <input type="button" class="buttonsendtochecker" id="sendtochecker" value="Send" />
                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
                    <span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                </div>
            </div>
            <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                    <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                        <tr id="return_row" style="display:none">
                            <td>Return Reason<span style="color: red;">*</span></td>
                            <td>
                                <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="buttonsendtochecker" id="verify" value="Approve" />
                   
                                <input type="button" class="buttonclose" id="Verifycancel" onclick="close()" value="Cancel" />
                                <span id="verify_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="next_date_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                    <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                        <tr>
                            <td>Next Date<span style="color: red;">*</span></td>
                            <td>
                                <input type="text" name="new_next_date" placeholder="dd/mm/yyyy" style="width:250px;" id="new_next_date" value="">
                                <script type="text/javascript" charset="utf-8">
                                    datePicker("new_next_date");
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Next Date Case Status<span style="color: red;">*</span></td>
                            <td>
                                <div id="next_date_sts_grid" name="next_date_sts_grid" style="padding-left: 3px" tabindex="6"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="buttonsendtochecker" id="updatenextdate" value="Save" />
                                <input type="button" class="buttonclose" id="nextdatecancel" onclick="close()" value="Cancel" />
                                <span id="nextdate_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                <textarea name="comments" id="comments" style="width:370px;"></textarea>
                </br></br>
                <input type="button" class="buttondelete" id="delete_button" value="Delete" />
                <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
                <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </div>

        </div>
    </form>
</div>


<script type="text/javascript">
    var theme = getDemoTheme();
    rules = [

        {
                input: '#petition_date',
                message: 'required!',
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (jQuery("#petition_date").val() == '') {
                        return false;
                    } else {
                        return true;
                    }
                }
        },

        {
            input: '#petition_submitted_sts',
            message: 'required!',
            action: 'blur,change',
            rule: function(input) {
                if (input.val() != '') {
                    var item = jQuery("#petition_submitted_sts").jqxComboBox('getSelectedItem');
                    if (item != null) {
                        jQuery("input[name='petition_submitted_sts']").val(item.value);
                    }
                    return true;
                } else {
                    jQuery("#petition_submitted_sts input").focus();
                    return false;
                }
            }
        },

        {
                input: '#receiver_name',
                message: 'required!',
                action: 'keyup, blur, change',
                rule: function(input, commit) {

                    var item = jQuery("#petition_submitted_sts").jqxComboBox('getSelectedItem');
                    if (jQuery("#receiver_name").val() == '' && item!=null && item.value=="Yes") {
                        return false;
                    } else {
                        return true;
                    }
                }
        },

        {
                input: '#receiver_number',
                message: 'required!',
                action: 'keyup, blur, change',
                rule: function(input, commit) {

                    var item = jQuery("#petition_submitted_sts").jqxComboBox('getSelectedItem');
                    if (jQuery("#receiver_number").val() == '' && item!=null && item.value=="Yes") {
                        return false;
                    } else {
                        return true;
                    }
                }
        },
        {
                input: '#collection_rent_amount',
                message: 'required!',
                action: 'keyup, blur, change',
                rule: function(input, commit) {

                    var item = jQuery("#petition_submitted_sts").jqxComboBox('getSelectedItem');
                    if (jQuery("#collection_rent_amount").val() == '' && item!=null && item.value=="Yes") {
                        return false;
                    } else {
                        return true;
                    }
                }
        },


       {
            input: '#approval_sts',
            message: 'required!',
            action: 'blur,change',
            rule: function(input) {

                // var item = jQuery("#approval_sts").jqxComboBox('getSelectedItem');
                var item2 = jQuery("#petition_submitted_sts").jqxComboBox('getSelectedItem');
                var item = jQuery("#approval_sts").jqxComboBox('getSelectedItem');

            if (item==null && item2!=null && item2.value=="Yes") {
                  return false;
               }else{

                if (input.val() != '') {
                    var item = jQuery("#approval_sts").jqxComboBox('getSelectedItem');
                    if (item != null) {
                        jQuery("input[name='approval_sts']").val(item.value);
                    }
                    return true;
                } else {
                    jQuery("#approval_sts input").focus();
                    return false;
                }
                    return true;

               }
            }
        },


    ];
    var options = {
        complete: function(response) {
            var json = jQuery.parseJSON(response.responseText);
            window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
            jQuery('.txt_csrfname').val(json.csrf_token);
            if (json.Message != 'OK') {
                jQuery("#sendButton").show();
                jQuery("#send_loading").hide();
                alert(json.Message);
                return false;
            } else {
                jQuery("#sendButton").show();
                jQuery("#send_loading").hide();
                jQuery("#jqxgrid").jqxGrid('updatebounddata');
                jQuery("#msgArea").val('');
                jQuery("#error").show();
                jQuery("#error").fadeOut(11500);
                jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Saved');
                reload();
                jQuery('#jqxTabs').jqxTabs('select', 1);
            }

        }
    };


    jQuery("#reciver_form").ajaxForm(options);

    jQuery("#sendButton").click(function() {


        jQuery('#reciver_form').jqxValidator({
            rules: rules,
            theme: theme
        });



        var item= jQuery("#petition_submitted_sts").jqxComboBox('getSelectedItem');

        var validationResult = function(isValid) {
            if (isValid) {
                jQuery("#sendButton").hide();
                jQuery("#send_loading").show();
                jQuery("#reciver_form").submit();
            } else {
                return;
            }
        }
        jQuery('#reciver_form').jqxValidator('validate', validationResult);
    });
</script>