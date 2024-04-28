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
        /* width: 100%; */
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


    var sell_deed = [<? $i = 1;
                        foreach ($sell_deed as $key => $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $key . '", label:"' . $row . '"}';
                            $i++;
                        } ?>];
    var possession_recovery_by = [<? $i = 1;
                                    foreach ($possession_recovery_by as $key => $row) {
                                        if ($i != 1) {
                                            echo ',';
                                        }
                                        echo '{value:"' . $key . '", label:"' . $row . '"}';
                                        $i++;
                                    } ?>];
    var possession_taken_by = [<? $i = 1;
                                foreach ($possession_taken_by as $key => $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $key . '", label:"' . $row . '"}';
                                    $i++;
                                } ?>];
    var mutation_status = [<? $i = 1;
                            foreach ($mutation_status as $key => $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $key . '", label:"' . $row . '"}';
                                $i++;
                            } ?>];
    var petition_status = [<? $i = 1;
                            foreach ($petition_status as $key => $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $key . '", label:"' . $row . '"}';
                                $i++;
                            } ?>];
    var mutation_process = [<? $i = 1;
                            foreach ($mutation_process as $key => $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $key . '", label:"' . $row . '"}';
                                $i++;
                            } ?>];

    var district = [<? $i = 1;
                    foreach ($district as $row) {
                        if ($i != 1) {
                            echo ',';
                        }
                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                        $i++;
                    } ?>];
    var req_type_array = [<? $i = 1;
                            foreach ($req_type as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
    var proposed_type = ["Investment", "Card"];


    var non_banker_asset = ['Yes', "No"];


    jQuery(document).ready(function() {

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

        jQuery("#proposed_type").jqxComboBox({
            theme: theme,
            width: 100,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Proposed Type",
            source: proposed_type,
            height: 25
        });

        jQuery("#non_banker_asset").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Non-Banker",
            source: non_banker_asset,
            width: 250,
            height: 25
        });

        jQuery("#sell_deed").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Sell Deed",
            source: sell_deed,
            width: 250,
            height: 25
        });
        jQuery("#possession_recovery_by").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Possession Recovery By",
            source: possession_recovery_by,
            width: 250,
            height: 25
        });
        jQuery("#possession_taken_by").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Possession Taken By",
            source: possession_taken_by,
            width: 250,
            height: 25
        });
        jQuery("#mutation_status").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Mutation Status",
            source: mutation_status,
            width: 250,
            height: 25
        });
        jQuery("#petition_status").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Petition Status",
            source: petition_status,
            width: 250,
            height: 25
        });
        jQuery("#mutation_process").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Mutation Process",
            source: mutation_process,
            width: 250,
            height: 25
        });

        jQuery("#district").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "District",
            source: district,
            width: 250,
            height: 25
        });





        jQuery('#sell_deed,#possession_recovery_by,#possession_taken_by,#mutation_status,#petition_status,#mutation_process,#district').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });


        jQuery("#proposed_type").jqxComboBox('val', 'Investment');


        change_caption();


        jQuery('#proposed_type').bind('change', function(event) {

            jQuery("#loan_ac").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();

        });






        jQuery('#non_banker_asset').bind('change', function(event) {
            var non_banker_asset_value = jQuery("#non_banker_asset").val();
            if (non_banker_asset_value == "Yes") {

                jQuery("#non_banker_asset_date_row").show();


            } else {
                jQuery("#non_banker_asset_date_row").hide();
            }
        });



        jQuery('#sell_deed').bind('change', function(event) {
            var sell_deed_value = jQuery("#sell_deed").val();
            if (sell_deed_value == 0) {

                jQuery("#sell_deed_no_row").show();


            } else {
                jQuery("#sell_deed_no_row").hide();
            }
        });

        jQuery('#possession_taken_by').bind('change', function(event) {
            var possession_taken_by_value = jQuery("#possession_taken_by").val();
            if (possession_taken_by_value == 0) {
                jQuery("#possession_taken_by_date_row").show();
            } else {
                jQuery("#possession_taken_by_date_row").hide();
            }
        });


        jQuery('#mutation_status').bind('change', function(event) {
            var mutation_status_value = jQuery("#mutation_status").val();
            if (mutation_status_value == 0) {

                jQuery("#mutation_status_number_rows").show();
                jQuery("#mutation_status_date_row").show();
                jQuery("#thana_row").show();
                jQuery("#district_row").show();
            } else {
                jQuery("#mutation_status_number_rows").hide();
                jQuery("#mutation_status_date_row").hide();
                jQuery("#thana_row").hide();
                jQuery("#district_row").hide();
            }
        });



        jQuery('#petition_status').bind('change', function(event) {
            var petition_status_value = jQuery("#petition_status").val();
            if (petition_status_value == 0) {

                jQuery("#petition_number_row").show();
                jQuery("#petition_date_row").show();

            } else {
                jQuery("#petition_number_row").hide();
                jQuery("#petition_date_row").hide();
            }
        });

        // for Districs =======================================



        jQuery('#thana').jqxComboBox({
            disabled: true
        });

        jQuery('#district').bind('change', function(event) {
            get_information_by_district();

            jQuery('#thana').jqxComboBox({
                disabled: false
            });


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




        jQuery("#updatenextdate").click(function() {
            jQuery('#action_form').jqxValidator({
                rules: rules4,
                theme: theme
            });

            var validationResult = function(isValid) {
                if (isValid) {
                    jQuery('#type').val('updatenextdate');
                    jQuery("#nextdatecancel").hide();
                    jQuery("#nextdate_loading").show();
                    call_ajax_submit_delete();
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);
        });


        jQuery("#approve_button").click(function() {

            jQuery("#approve_button").hide();
            jQuery("#apv_cancel").hide();
            jQuery("#apv_loading").show();
            call_ajax_submit_delete();


        });

        jQuery("#decline_button").click(function() {

            jQuery("#decline_button").hide();
            jQuery("#apv_cancel").hide();
            jQuery("#apv_loading").show();
            call_ajax_submit_delete();


        });


        jQuery("#decline_button").click(function() {

            jQuery('#type').val('decline_approval');

            jQuery("#decline_button").hide();
            jQuery("#apv_cancel").hide();
            jQuery("#apv_loading").show();
            call_ajax_submit_delete();
        });

















        rules4 = [{
                input: '#non_banker_asset',
                message: 'required!',
                action: 'blur,change',
                rule: function(input) {
                    if (input.val() != '') {
                        var item = jQuery("#non_banker_asset").jqxComboBox('getSelectedItem');
                        if (item != null) {
                            jQuery("input[name='non_banker_asset']").val(item.value);
                        }
                        return true;
                    } else {
                        jQuery("#non_banker_asset input").focus();
                        return false;
                    }
                }
            },



        ];

        rules2 = [


            {
                input: '#non_banker_asset',
                message: 'required!',
                action: 'blur,change',
                rule: function(input) {
                    if (input.val() != '') {
                        var item = jQuery("#non_banker_asset").jqxComboBox('getSelectedItem');
                        if (item != null) {
                            jQuery("input[name='non_banker_asset']").val(item.value);
                        }
                        return true;
                    } else {
                        jQuery("#non_banker_asset input").focus();
                        return false;
                    }
                }
            },


            {
                input: '#new_next_date',
                message: 'required!',
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (jQuery("#new_next_date").val() == '') {
                        return false;
                    } else {
                        return true;
                    }
                }
            },
            {
                input: '#new_next_date',
                message: 'Invalid',
                action: 'keyup, blur, change',
                rule: function(input, commit) {
                    if (!input.val()) {
                        return true;
                    }
                    if (validate_date(input.val())) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            {
                input: '#next_date_sts_grid',
                message: 'required!',
                action: 'blur,change',
                rule: function(input) {
                    if (input.val() != '') {
                        var item = jQuery("#next_date_sts_grid").jqxComboBox('getSelectedItem');
                        if (item != null) {
                            jQuery("input[name='next_date_sts_grid']").val(item.value);
                        }
                        return true;
                    } else {
                        jQuery("#next_date_sts_grid input").focus();
                        return false;
                    }
                }
            },
        ];
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
        jQuery("#updatenextdate").click(function() {
            jQuery('#action_form').jqxValidator({
                rules: rules2,
                theme: theme
            });
            var validationResult = function(isValid) {
                if (isValid) {
                    jQuery("#updatenextdate").hide();
                    jQuery("#nextdatecancel").hide();
                    jQuery("#nextdate_loading").show();
                    call_ajax_submit_delete();
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);
        });
        jQuery("#next_dt_sts").bind('change', function(event) {
            var checked = event.args.checked;
            if (checked == true) {
                jQuery("#next_dt_sts_value").val(1);

                jQuery("#next_sts_text").html('');
                jQuery("#next_sts_text").hide();
                jQuery("#not_available_sts_value").val(0);


            } else {
                jQuery("#not_available_sts_value").val(0);
                jQuery("#next_dt_sts_value").val(0);

                jQuery("#next_sts_text").html('<strong><?= $sys_config->next_dt_text ?></strong>');
                jQuery("#next_sts_text").show();
            }
        });

        jQuery('#lawyer').bind('change', function(event) {
            var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
            if (item != null) {
                jQuery("#noc_attachment_row").show();
                //set_expense_lawyer('lawyer');
            } else {
                jQuery("#noc_attachment_row").hide();
            }
        });
        jQuery('#case_sts').bind('change', function(event) {
            var item = jQuery("#case_sts").jqxComboBox('getSelectedItem');
            if (item != null) {
                if (item.value == 29) //For W/a
                {
                    jQuery("#optional_attachment_row").show();
                    jQuery("#attachment_name").html('W/A');
                    jQuery("#star").hide();
                } else if (item.value == 15) //For judgement
                {
                    jQuery("#optional_attachment_row").show();
                    jQuery("#attachment_name").html('Judgment');
                    jQuery("#star").show();
                } else if (item.value == 28) //For judgement
                {
                    jQuery("#optional_attachment_row").show();
                    jQuery("#attachment_name").html('Summon');
                    jQuery("#star").hide();
                } else {
                    //For Edit ACTION
                    if (jQuery("#add_edit").val() == 'edit') {
                        jQuery("#file_preview_optional_attachment").hide();
                        jQuery("#file_delete_optional_attachment").hide();
                        jQuery("#file_delete_value_optional_attachment").val(1);
                    }
                    jQuery("#optional_attachment_row").hide();
                }
                set_final_remarks(item.value, req_type);
                if (req_type == 2 && item.value == 15) //for ara judgement
                {
                    jQuery("#next_sts_row").hide();
                    jQuery("#next_remarks_row").hide();
                    jQuery("#next_date_purpose").jqxComboBox('clearSelection');
                    jQuery("input[name='next_date_purpose']").val('');
                    jQuery("#next_dt_remarks").val('');
                    jQuery("#next_dt_sts_value").val(1);
                }

            } else {
                jQuery("#optional_attachment_row").hide();
            }

        });

        jQuery('#final_remarks').bind('change', function(event) {
            var item = jQuery("#final_remarks").jqxComboBox('getSelectedItem');
            if (item != null && item.value == 2) {
                jQuery("#next_sts_row").hide();
                jQuery("#next_remarks_row").hide();
                jQuery("#next_date_purpose").jqxComboBox('clearSelection');
                jQuery("input[name='next_date_purpose']").val('');
                jQuery("#next_dt_remarks").val('');
                jQuery("#next_dt_sts_value").val(1);
            } else {
                jQuery("#next_sts_row").show();
                jQuery("#next_remarks_row").show();
            }
        });



        var initGrid = function() {
            var source = {
                datatype: "json",
                datafields: [{
                        name: 'id',
                        type: 'int'
                    },

                    {
                        name: 'status',
                        type: 'string'
                    },
                    {
                        name: 'sell_deed',
                        type: 'string'
                    },

                    {
                        name: 'sell_deed_no',
                        type: 'string'
                    },

                    {
                        name: 'possession_recovery_by',
                        type: 'string'
                    },
                    {
                        name: 'possession_taken_by',
                        type: 'string'
                    },
                    {
                        name: 'possession_taken_by_date',
                        type: 'string'
                    },
                    {
                        name: 'mutation_status',
                        type: 'string'
                    },
                    {
                        name: 'mutation_status_number',
                        type: 'string'
                    },
                    {
                        name: 'mutation_status_date',
                        type: 'string'
                    },
                    {
                        name: 'thana_name',
                        type: 'string'
                    },

                    {
                        name: 'district_name',
                        type: 'string'
                    },

                    {
                        name: 'district',
                        type: 'string'
                    },
                    {
                        name: 'petition_status',
                        type: 'string'
                    },
                    {
                        name: 'petition_number',
                        type: 'string'
                    },
                    {
                        name: 'petition_date',
                        type: 'string'
                    },
                    {
                        name: 'mutation_process',
                        type: 'string'
                    },
                    {
                        name: 'remarks',
                        type: 'string'
                    },

                    {
                        name: 'sell_deed_no',
                        type: 'string'
                    },
                    {
                        name: 'possession_taken_by_date',
                        type: 'string'
                    },

                    {
                        name: 'sts',
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
                url: '<?= base_url() ?>index.php/Property_own_by_bank/grid',
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

                    var sell_no_grid_search = jQuery.trim(jQuery('#sell_no_grid_search').val());
                    var mutation_number_gird_search = jQuery.trim(jQuery('#mutation_number_gird_search').val());
                    var petition_number_grid_search = jQuery.trim(jQuery('#petition_number_grid_search').val());

                    jQuery.extend(data, {
                        sell_no_grid_search: sell_no_grid_search,
                        mutation_number_gird_search: mutation_number_gird_search,
                        petition_number_grid_search: petition_number_grid_search

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
                width: '1318px',
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
                                } else {

                                }

                            }
                        },
                    <? } ?>
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
                                } else {
                                    // return '<div style="text-align:center;margin-top: 5px;  cursor:pointer">V</div>';
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
                                } else {

                                    // return '<div style="text-align:center;margin-top: 5px;  cursor:pointer">V</div>';
                                }
                            }
                        },
                    <? } ?>

                    <? if (UPDATENEXTDATE == 1) { ?> {
                            text: 'NBA',
                            datafield: 'updatenextdate',
                            editable: false,
                            align: 'center',
                            sortable: false,
                            menu: false,
                            width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if (dataRecord.sts == 38) {
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'updatenextdate\',' + dataRecord.suit_file_id + ')" ><img align="center" src="<?= base_url() ?>images/confirm.png"></div>';
                                }
                            }
                        },
                    <? } ?>


                    <? if (APPROVE == 1) { ?> {
                            text: 'APV',
                            datafield: 'approve',
                            editable: false,
                            align: 'center',
                            sortable: false,
                            menu: false,
                            width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if (dataRecord.sts == 104) {
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'approve\',' + dataRecord.suit_file_id + ')" ><img align="center" src="<?= base_url() ?>images/approved.png"></div>';
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
                    {
                        text: 'Status',
                        datafield: 'status',
                        editable: false,
                        width: '17%',
                        align: 'left',
                        cellsalign: 'left'
                    },

                    {
                        text: 'Sell Deed',
                        datafield: 'sell_deed',
                        editable: false,
                        width: '15%',
                        align: 'left',
                        cellsalign: 'left'
                    },

                    {
                        text: 'Sell No',
                        datafield: 'sell_deed_no',
                        editable: false,
                        width: '15%',
                        align: 'left',
                        cellsalign: 'left'
                    },

                    {
                        text: 'Possession Recovery By',
                        datafield: 'possession_recovery_by',
                        editable: false,
                        width: '15%',
                        align: 'left',
                        cellsalign: 'left'
                    },

                    {
                        text: 'Possession Taken By',
                        datafield: 'possession_taken_by',
                        editable: false,
                        width: '18%',
                        align: 'left',
                        cellsalign: 'left'
                    },

                    {
                        text: 'Possession Taken Date',
                        datafield: 'possession_taken_by_date',
                        editable: false,
                        width: '18%',
                        align: 'left',
                        cellsalign: 'left'
                    },





                    {
                        text: 'Mutation Status',
                        datafield: 'mutation_status',
                        editable: false,
                        width: '18%',
                        align: 'center',
                        cellsalign: 'center'
                    },


                    {
                        text: 'Mutation Number',
                        datafield: 'mutation_status_number',
                        editable: false,
                        width: '18%',
                        align: 'center',
                        cellsalign: 'center'
                    },

                    {
                        text: 'Mutation Date',
                        datafield: 'mutation_status_date',
                        editable: false,
                        width: '18%',
                        align: 'center',
                        cellsalign: 'center'
                    },

                    {
                        text: 'District Name',
                        datafield: 'district_name',
                        editable: false,
                        width: '18%',
                        align: 'center',
                        cellsalign: 'center'
                    },

                    {
                        text: 'Thana',
                        datafield: 'thana_name',
                        editable: false,
                        width: '18%',
                        align: 'center',
                        cellsalign: 'center'
                    },


                    {
                        text: 'Petition Status',
                        datafield: 'petition_status',
                        editable: false,
                        width: '18%',
                        align: 'left',
                        cellsalign: 'left'
                    },

                    {
                        text: 'Petition Number',
                        datafield: 'petition_number',
                        editable: false,
                        width: '18%',
                        align: 'left',
                        cellsalign: 'left'
                    },
                    {
                        text: 'Petition Date',
                        datafield: 'petition_date',
                        editable: false,
                        width: '18%',
                        align: 'left',
                        cellsalign: 'left'
                    },






                    {
                        text: 'Mutation Process',
                        datafield: 'mutation_process',
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
            width: '1318px',
            initTabContent: initWidgets
        });
        jQuery('#jqxTabs').bind('selected', function(event) {
            jQuery('#property_own_by_bank_form').jqxValidator('hide');
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
            cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel,#Verifycancel,#nextdatecancel,#apv_cancel")
        });
        jQuery("#r_history").jqxWindow({
            theme: theme,
            width: '100%',
            height: '90%',
            resizable: false,
            isModal: true,
            autoOpen: false,
            cancelButton: jQuery("#r_ok")
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

    function get_information_by_district() {
        var theme = getDemoTheme();

        var item = jQuery("#district").jqxComboBox('getSelectedItem');

        if (item != null) {
            var act_id = item.value;
        } else {
            var act_id = 0;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            url: '<?= base_url() ?>index.php/Property_own_by_bank/Get_thana__district/',
            async: false,
            type: "post",
            data: {
                [csrfName]: csrfHash,
                act_id: act_id
            },
            datatype: "json",
            success: function(response) {
                var json = jQuery.parseJSON(response);


                jQuery('.txt_csrfname').val(json.csrf_token);

                var thana_name_echo = [];
                jQuery.each(json['thana'], function(key, obj) {
                    thana_name_echo.push({
                        value: obj.id,
                        label: obj.name
                    });
                });

                jQuery("#thana").jqxComboBox({
                    theme: theme,
                    autoOpen: false,
                    autoDropDownHeight: false,
                    promptText: "Select Thana Name",
                    source: thana_name_echo,
                    width: 250,
                    height: 25
                });

                jQuery('#thana').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });



            },
        });
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
            url: '<?= base_url() ?>index.php/Property_own_by_bank/delete_action/',
            data: postData,
            datatype: "json",
            success: function(response) {
                ///console.log(response);
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if (jQuery("#type").val() == 'delete' || jQuery("#type").val() == 'ho_delete') {
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
                if (jQuery("#type").val() == 'updatenextdate') {
                    jQuery("#updatenextdate").show();
                    jQuery("#nextdatecancel").show();
                    jQuery("#nextdate_loading").hide();
                }
                if (jQuery("#type").val() == 'verify') {

                    jQuery("#verify").show();
                    jQuery("#Verifycancel").show();
                    jQuery("#verify_loading").hide();
                }

                if (jQuery("#type").val() == 'approve') {

                    jQuery("#apv_data_row").show();
                    jQuery("#approve_button").show();
                    jQuery("#decline_button").show();
                    jQuery("#apv_cancel").show();
                    jQuery("#apv_loading").hide();
                }

                if (jQuery("#type").val() == 'decline_approval') {

                    jQuery("#apv_data_row").show();
                    jQuery("#approve_button").show();
                    jQuery("#decline_button").show();
                    jQuery("#apv_cancel").show();
                    jQuery("#apv_loading").hide();

                    jQuery("#type").val('decline_approval');
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
            jQuery('#apv_data_row').hide();

        } else if (operation == 'delete') {
            jQuery("#header_title").html('Delete Request');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').show();
            jQuery('#close_btn_row').hide();
            jQuery('#comments').val('');
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
            jQuery('#apv_data_row').hide();

        } else if (operation == 'sendtochecker') {
            jQuery("#header_title").html('Send To Checker');
            jQuery('#sendtochecker_row').show();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
            jQuery('#apv_data_row').hide();

        } else if (operation == 'verify') {
            jQuery("#header_title").html('Approve Changes');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').show();
            jQuery('#next_date_row').hide();
            jQuery('#apv_data_row').hide();

        } else if (operation == 'updatenextdate') {
            jQuery("#header_title").html('Conversion a Non-Banker Asset');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').show();
            jQuery('#apv_data_row').hide();

        } else if (operation == 'approve') {

            jQuery("#header_title").html('Approve Non-Banker Asset');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
            jQuery('#apv_data_row').show();

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
            url: "<?= base_url() ?>Property_own_by_bank/details",
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
                url: "<?= base_url() ?>index.php/Property_own_by_bank/search_suit/",
                // data: {
                //     [csrfName]: csrfHash,
                //     search_loan_ac: search_loan_ac,
                //     search_cif: search_cif,
                //     search_auction_date: search_auction_date
                // },
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
            url: "<?= base_url() ?>Property_own_by_bank/get_edit_info",
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

                    if (json.result.petition_date > 0) {
                        jQuery('#petition_date').val('');

                    } else {
                        jQuery('#petition_date').val(json.result.petition_date);

                    }


                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    jQuery('#add_edit').val('edit');
                    jQuery('#edit_id').val(json.id);
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#status_form_div').show();

                    // jQuery('#security_info').html(json.security_info);


                    jQuery("#sell_deed").jqxComboBox('val', json.result.sell_deed);

                    jQuery('#sell_deed_no').val(json.result.sell_deed_no);
                    jQuery("#possession_recovery_by").jqxComboBox('val', json.result.possession_recovery_by);
                    jQuery('#possession_taken_by_date').val(json.result.possession_taken_by_date);
                    jQuery("#possession_taken_by").jqxComboBox('val', json.result.possession_taken_by);
                    jQuery("#mutation_status").jqxComboBox('val', json.result.mutation_status);
                    jQuery("#petition_status").jqxComboBox('val', json.result.petition_status);
                    jQuery("#mutation_process").jqxComboBox('val', json.result.mutation_process);
                    jQuery('#mutation_status_number').val(json.result.mutation_status_number);
                    jQuery('#mutation_status_date').val(json.result.mutation_status_date);


                    jQuery("#district").jqxComboBox('val', json.result.district);
                    jQuery('#petition_number').val(json.result.petition_number);
                    jQuery('#petition_date').val(json.result.petition_date);
                    jQuery('#remarks').val(json.result.remarks);





                    jQuery("#thana").jqxComboBox('val', json.result.thana);







                } else {
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    alert("No Data Found");
                    jQuery('#add_edit').val('');
                }
            }
        });

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
            url: "<?= base_url() ?>Property_own_by_bank/get_add_info",
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

                    // jQuery('#security_info').html(json.security_info);

                    var coma_id = jQuery('#cma_auction_id').val(json.id);
                    console.log(coma_id);


                } else {
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    alert("No Data Found");
                    jQuery('#add_edit').val('');
                }
            }
        });

    }

    function check_package() {
        var ele = document.querySelector('input[name="package_amount"]:checked').value;
        jQuery('#package_bill_amount').val('');
        if (ele == 'with_amount') {
            jQuery('#package_bill_amount').show();
            jQuery('#package_bill_amount').focus();
        } else {
            jQuery('#package_bill_amount').hide();
        }
    }

    function add_more_expense() {
        var theme = getDemoTheme();
        var counter = jQuery('#expense_counter').val();
        var new_counter = parseInt(counter) + 1;
        html_string = '';

        html_string += '<tr id="expense_' + new_counter + '">';
        html_string += '<td>';
        html_string += '<input type="hidden" id="expense_edit_' + new_counter + '" name="expense_edit_' + new_counter + '" value="0">';
        html_string += '<input type="hidden" id="expense_delete_' + new_counter + '" name="expense_delete_' + new_counter + '" value="0">';
        html_string += '<img src="<?= base_url() ?>images/delete-New.png" onclick="delete_row_expense(' + new_counter + ')" style="margin-top: 5px;cursor:pointer">';
        html_string += '</td>';
        html_string += '<td><div id="expense_type_' + new_counter + '" name="expense_type_' + new_counter + '" style="padding-left: 3px;margin-left:5px;" onchange="change_vendor(\'expense_type_' + new_counter + '\',' + new_counter + ')"></div></td>';
        html_string += '<td><div id="district_' + new_counter + '" name="district_' + new_counter + '" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data(' + new_counter + ')"></div><div id="vendor_id_' + new_counter + '" name="vendor_id_' + new_counter + '" style="padding-left: 3px;margin-left:5px;display:none" ></div><input name="vendor_name_' + new_counter + '" type="text" class="" style="width:98%" id="vendor_name_' + new_counter + '" /></td>';
        html_string += '<td><div id="activities_name_' + new_counter + '" name="activities_name_' + new_counter + '" style="padding-left: 3px;margin-left:5px;" onchange="get_expense_amount(\'activities_name_' + new_counter + '\',' + new_counter + ')"></div></td>';
        html_string += '<td><input type="text" name="activities_date_' + new_counter + '" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_' + new_counter + '" value="" ></td>';
        html_string += '<td><input type="text" readonly name="amount_' + new_counter + '" tabindex="" placeholder="" style="width:90%;" id="amount_' + new_counter + '" value="" ></td>';

        html_string += '<td><textarea name="remarks_' + new_counter + '" class="text-input-big" id="remarks_' + new_counter + '" style="height:40px !important;width:90%"></textarea></td>';
        html_string += '</tr>';

        jQuery('#expense_' + counter).after(html_string);
        jQuery('#expense_counter').val(new_counter);

        jQuery('#expense_type_' + new_counter).jqxComboBox({
            theme: theme,
            width: 180,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Vendor Type",
            source: expense_type,
            height: 25
        });
        jQuery('#expense_type_' + new_counter).focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#activities_name_' + new_counter).jqxComboBox({
            theme: theme,
            width: 180,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Activity",
            source: expense_activities,
            height: 25
        });


        jQuery('#activities_name_' + new_counter).focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#vendor_id_' + new_counter).jqxComboBox({
            theme: theme,
            width: 180,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Select Lawyer",
            source: lawyer,
            height: 25
        });
        jQuery('#vendor_id_' + new_counter).focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#vendor_id_" + new_counter).jqxComboBox('val', lawyer_id);
        jQuery('#expense_type_' + new_counter).jqxComboBox('val', 1);
        datePicker_without_advance('activities_date_' + new_counter);
        set_expense_date('case_dt', new_counter);
        //set_expense_lawyer('lawyer',new_counter);
        make_expense_amount_editable('expense_counter', loan_segment);
    }

    function search_data() {
        jQuery("#grid_search").hide();
        jQuery("#grid_loading").show();
        jQuery("#jqxgrid").jqxGrid('updatebounddata');
        jQuery("#grid_search").show();
        jQuery("#grid_loading").hide();
        return;

    }

    function get_expense_amount(act_id, counter) {
        var theme = getDemoTheme();
        var item2 = jQuery("#expense_type_" + counter).jqxComboBox('getSelectedItem');
        var item = jQuery("#" + act_id).jqxComboBox('getSelectedItem');
        if (item2 != null && item2.value == 1) {
            if (item != null) {
                var act_id = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    url: '<?= base_url() ?>index.php/Home/get_expense_amount',
                    async: false,
                    type: "post",
                    data: {
                        [csrfName]: csrfHash,
                        cma_district: cma_district,
                        act_id: act_id,
                        req_type: req_type
                    },
                    datatype: "json",
                    success: function(response) {
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str = '';
                        if (json.row_info['amount'] > 0) {
                            jQuery('#amount_' + counter).val(json.row_info['amount']);
                        } else {
                            jQuery('#amount_' + counter).val(0);
                        }
                        //when activities case withdraw by presenect case status should be case withdraw (mail request by prince 14-12-2022)
                        if ((req_type == 2 && act_id == 13) || (req_type != 2 && act_id == 12)) {
                            jQuery("#case_sts").jqxComboBox('val', 3);
                        } else {
                            var current_case_sts = jQuery("#case_sts").jqxComboBox('getSelectedItem');
                            if (current_case_sts != null && current_case_sts.value == 3) {
                                jQuery("#case_sts").jqxComboBox('clearSelection');
                                jQuery("input[name='case_sts']").val('');
                            }
                        }
                    },
                    error: function(model, xhr, options) {
                        alert('failed');
                    },
                });
            }
        } else {
            jQuery('#amount_' + counter).val('');
        }
    }

    function delete_row_expense(row_id) {
        jQuery('#expense_' + row_id).hide();
        jQuery('#expense_delete_' + row_id).val(1);
    }

    function change_vendor(id, counter) {
        var theme = getDemoTheme();
        var item = jQuery("#" + id).jqxComboBox('getSelectedItem');
        jQuery("#district_" + counter).jqxComboBox('clearSelection');
        jQuery("#district_" + counter).val('');
        jQuery("#district_" + counter).hide();
        if (item != null) {
            if (item.value == 1) {
                jQuery("#vendor_id_" + counter).show();
                document.getElementById('vendor_name_' + counter).style.display = 'none';
                jQuery("#vendor_name_" + counter).val('');
                jQuery('#vendor_id_' + counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });
            } else if (item.value == 4) {
                jQuery("#vendor_id_" + counter).show();
                document.getElementById('vendor_name_' + counter).style.display = 'none';
                jQuery("#vendor_name_" + counter).val('');
                jQuery('#vendor_id_' + counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });
            } else {
                jQuery("#vendor_id_" + counter).hide();
                jQuery("#vendor_id_" + counter).jqxComboBox('clearSelection');
                jQuery("#vendor_id_" + counter).val('');
                document.getElementById('vendor_name_' + counter).style.display = 'block';
            }

        } else {
            jQuery("#vendor_id_" + counter).hide();
            jQuery("#vendor_id_" + counter).jqxComboBox('clearSelection');
            jQuery("#vendor_id_" + counter).val('');
            document.getElementById('vendor_name_' + counter).style.display = 'block'
        }
    }

    function clear_form() {


        jQuery("#non_banker_asset").jqxComboBox('clearSelection');
        jQuery("#new_next_date").val('');



        jQuery("#search_dt").val('');
        jQuery("#case_number").val('');
        jQuery("#loan_ac").val('');

        jQuery("#req_type").jqxComboBox('clearSelection');

        // jQuery("#proposed_type").jqxComboBox('clearSelection');

        jQuery("#sell_deed").jqxComboBox('clearSelection');
        jQuery("#sell_deed").jqxComboBox('clearSelection');




        jQuery("#sell_deed_no").val('');
        jQuery("#possession_recovery_by").jqxComboBox('clearSelection');
        jQuery("#possession_taken_by").jqxComboBox('clearSelection');
        jQuery("#possession_taken_by_date").val('');
        jQuery("#petition_status").jqxComboBox('clearSelection');
        jQuery("#mutation_process").jqxComboBox('clearSelection');


        jQuery("#thana").jqxComboBox('clearSelection');
        jQuery("#district").jqxComboBox('clearSelection');


        jQuery("#mutation_status").jqxComboBox('clearSelection');
        jQuery("#mutation_status_date").val('');
        jQuery("#mutation_status_number").val('');


        jQuery("#petition_number").val('');
        jQuery("#petition_date").val('');
        jQuery("#remarks").val('');


        jQuery("#sell_no_grid_search").val('');
        jQuery("#mutation_number_gird_search").val('');
        jQuery("#petition_number_grid_search").val('');




    }

    function reload() {
        jQuery('#status_form_div').hide();
        jQuery('#search_area').show();
        jQuery('#searchTable').html('');
        jQuery("#edit_id").val('');
        clear_form();
        jQuery('#add_edit').val('');
        jQuery('#property_own_by_bank_form').jqxValidator('hide');
    }

    function expense_validation() {


    }

    function CustomerPickList(module_name = null, data_field_name = null) {
        if (jQuery("#add_edit").val() == 'edit') {
            if (jQuery("#file_delete_value_" + data_field_name).val() == 0) {
                alert('Please Delete Previous file for new upload');
                return false;
            }
        }
        newwindow = window.open("<?= base_url() ?>index.php/home/ajaxFileUpload/" + module_name + '/' + data_field_name, "Upload", "width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340");
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }

    function file_delete(id) {
        if (confirm('Are you sure to Delete previous file?')) {
            jQuery("#file_preview_" + id).hide();
            jQuery("#file_delete_" + id).hide();
            jQuery("#file_delete_value_" + id).val(1);
        }
    }
</script>
<div id="container">
    <div id="body">
        <table style="width: 100%;">
            <tr id="widgetsNavigationTree">

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
                                                        <td style="text-align:left;width:13%"><strong>Req Type</strong> </td>

                                                        <td style="width:10%">
                                                            <div id="req_type" name="req_type"></div>
                                                        </td>

                                                        <td style="text-align:left;width:12%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                        <td style="width:5%">
                                                            <div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div>
                                                        </td>
                                                        <td style="text-align:left;width:11%"><strong><span id="l_or_c_no"></span> No.</strong></td>
                                                        <td style="width:15%"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:120px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);" /></td>
                                                        <td style="text-align:left;width:10%"><strong>Case No.</strong></td>
                                                        <td style="width:10%"><input name="case_number" tabindex="" type="text" class="" maxlength="" size="" style="width:100px" id="case_number" value="" onKeyUp="" /></td>
                                                        <!-- 
                                                        <td style="text-align:left;width:10%"><strong>Case Date</strong></td>
                                                        <td style="width:10%"><input type="text" name="search_dt" tabindex="3" placeholder="dd/mm/yyyy" style="width:100px;" id="search_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker("search_dt");</script></td> -->


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

                                            <form method="POST" name="property_own_by_bank_form" id="property_own_by_bank_form" style="margin:0px;" action="<?= base_url() ?>index.php/Property_own_by_bank/add_edit" enctype="multipart/form-data">


                                                <input type="hidden" id="edit_after_verify_sts" value="0" name="edit_after_verify_sts">


                                                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />


                                                <input type="hidden" name="edit_id" id="edit_id" value="">
                                                <input type="hidden" id="add_edit" value="" name="add_edit">



                                                <input type="hidden" id="cma_auction_id" value="" name="cma_auction_id">


                                                <table style="width:100%;margin-top:20px;" id="tab1Table">
                                                    <tbody>
                                                        <tr>
                                                            <td width="50%">
                                                                <table style="width: 100%;" style="display:table">



                                                                    <tr id="sell_deed_row" style=" display: table-row;">
                                                                        <td width="40%" style="font-weight: bold; display: table-cell;">Sell Deed<span style="color:red">*</span> </td>
                                                                        <td width="60%" style="display: table-cell;">
                                                                            <div id="sell_deed" name="sell_deed" style="padding-left: 3px" tabindex="6"></div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="sell_deed_no_row" style="display: none;">
                                                                        <td width="40%" style="font-weight: bold;">Deed NO<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <input type="text" id="sell_deed_no" name="sell_deed_no" style="width: 250px;">
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;">Possession Recovery By <span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <div id="possession_recovery_by" name="possession_recovery_by" style="padding-left: 3px" tabindex="9"></div>
                                                                        </td>
                                                                    </tr>


                                                                    <tr id="possession_taken_by_row">
                                                                        <td width="40%" style="font-weight: bold;">Possession Taken By<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <div id="possession_taken_by" name="possession_taken_by" style="padding-left: 3px" tabindex="9"></div>
                                                                        </td>
                                                                    </tr>


                                                                    <tr id="possession_taken_by_date_row" style="display: none;">
                                                                        <td width="40%" style="font-weight: bold;">Date<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <input type="text" name="possession_taken_by_date" placeholder="dd/mm/yyyy" style="width:250px;" id="possession_taken_by_date" value="">
                                                                            <script type="text/javascript" charset="utf-8">
                                                                                datePicker("possession_taken_by_date");
                                                                            </script>
                                                                        </td>

                                                                    </tr>


                                                                    <tr id="mutation_status_row">
                                                                        <td width="40%" style="font-weight: bold;">Mutation Status<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <div id="mutation_status" name="mutation_status" style="padding-left: 3px" tabindex="9"></div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="mutation_status_number_rows" style="display:none;">
                                                                        <td width="40%" style="font-weight: bold;">Mutation Number<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <input type="text" id="mutation_status_number" name="mutation_status_number" style="width: 250px;">
                                                                        </td>
                                                                    </tr>


                                                                    <tr id="mutation_status_date_row" style="display: none;">
                                                                        <td width="40%" style="font-weight: bold;">Date<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <input type="text" name="mutation_status_date" placeholder="dd/mm/yyyy" style="width:250px;" id="mutation_status_date" value="">
                                                                            <script type="text/javascript" charset="utf-8">
                                                                                datePicker("mutation_status_date");
                                                                            </script>
                                                                        </td>

                                                                    </tr>

                                                                    <tr id="district_row" style="display:none">
                                                                        <td width="40%" style="font-weight: bold;">District<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <div type="text" id="district" name="district" style="width: 250px;"> </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="thana_row" style="display:none">
                                                                        <td width="40%" style="font-weight: bold;">Thana<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <div id="thana" name="thana" style="width: 250px;"></div>
                                                                        </td>
                                                                    </tr>



                                                                </table>
                                                            </td>

                                                            <td width="50%">
                                                                <table style="width: 70%;">

                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;">Petition Status<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <div id="petition_status" name="petition_status" style="padding-left: 3px" tabindex="9"></div>
                                                                        </td>
                                                                    </tr>


                                                                    <tr id="petition_number_row" style="display: none;">
                                                                        <td width="40%" style="font-weight: bold;">Petition Number<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <input type="text" id="petition_number" name="petition_number" style="width: 250px;">
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="petition_date_row" style="display: none;">
                                                                        <td width="40%" style="font-weight: bold;">Date<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <input type="text" name="petition_date" placeholder="dd/mm/yyyy" style="width:250px;" id="petition_date" value="">
                                                                            <script type="text/javascript" charset="utf-8">
                                                                                datePicker("petition_date");
                                                                            </script>
                                                                        </td>

                                                                    </tr>


                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;">Mutation Process<span style="color:red">*</span> </td>
                                                                        <td width="60%">
                                                                            <div id="mutation_process" name="mutation_process" style="padding-left: 3px" tabindex="5"></div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="next_remarks_row">
                                                                        <td width="40%" style="font-weight: bold;">Remarks</td>
                                                                        <td width="60%"><textarea name="remarks" tabindex="7" class="text-input-big" id="remarks" style="height:40px !important;width:250px"></textarea></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr id="package_row" style="">
                                                            <td colspan="2">
                                                                <div id="security_info" style="padding:10px;margin:0 0px;padding-top:20px;">

                                                                    <!-- <div id=""></div> -->

                                                                </div>
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
                                            <td width="11%" style="font-weight: bold;">Sell No</span> </td>
                                            <td width="10%">
                                                <input type="text" name="sell_no_grid_search" id="sell_no_grid_search">
                                            </td>

                                            <td width="11%" style="font-weight: bold;">Mutation Number</span> </td>
                                            <td width="10%">
                                                <input type="text" name="mutation_number_gird_search" id="mutation_number_gird_search">
                                            </td>


                                            <td width="11%" style="font-weight: bold;">Petition Number</span> </td>
                                            <td width="10%">
                                                <input type="text" name="petition_number_grid_search" id="petition_number_grid_search">
                                            </td>
                                            <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                            </td>

                                        </tr>
                                    </table>
                                </div>
                                <div style="border:none;" id="jqxgrid"></div>

                                <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

                                        <strong>D = </strong>Delete ,&nbsp;
                                        <strong>E = </strong>Edit ,&nbsp;
                                        <strong>P = </strong>Preview,&nbsp;
                                        <strong>STC = </strong>Send To Checker,&nbsp;
                                        <strong>V = </strong>Verify,&nbsp;
                                        <strong>NBA = </strong> Non-Banker Asset
                                        <strong>APV = </strong> Approve
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
                                <input type="button" class="buttonsendtochecker" id="verify" value="Verify" />
                                <!--                                 
                                <input type="button" class="buttondelete" id="reject" value="Reject" />
                                <input type="button" class="buttondelete" id="return" value="Return" /> -->
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
                            <td>Non-Banker Asset<span style="color: red;">*</span></td>
                            <td>
                                <div id="non_banker_asset" name="non_banker_asset" style="padding-left: 3px" tabindex="6"></div>
                            </td>
                        </tr>

                        <tr id="non_banker_asset_date_row" style="display: none;">
                            <td>Date<span style="color: red;">*</span></td>
                            <td>
                                <input type="text" name="new_next_date" placeholder="dd/mm/yyyy" style="width:250px;" id="new_next_date" value="">
                                <script type="text/javascript" charset="utf-8">
                                    datePicker("new_next_date");
                                </script>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">

                                <input type="button" class="buttonsendtochecker" id="updatenextdate" value="Confirm" />


                                <input type="button" class="buttonclose" id="nextdatecancel" onclick="close()" value="Cancel" />
                                <span id="nextdate_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


            <div id="apv_data_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                    <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                        <tr>
                            <td colspan="2">

                                <input type="button" class="buttonsendtochecker" id="approve_button" value="Appvrove" />
                                <input type="button" class="buttondelete" id="decline_button" value="Decline" />

                                <input type="button" class="buttonclose" id="apv_cancel" onclick="close()" value="Cancel" />


                                <span id="apv_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
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
<div id="r_history" style="visibility:hidden;">
    <div style=""><strong><span id="r_heading"></span></strong></div>
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
<div id="deleteMessageDialogContent" style="display:none">
    <div class="hd">
        <h2 class="conf">Are you sure you want to Acknowledge?</h2>
    </div>
    <form method="POST" name="deleteMessageform" id="deleteMessageform" style="margin:0px;">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input name="deleteEventId2" id="deleteEventId2" value="" type="hidden">
        <input name="typebulk" id="typebulk" value="bulk" type="hidden">
        <input name="cif2" id="cif2" value="" type="hidden">
        <input name="action" value="DeleteMessage" type="hidden">
        <div class="bd">
            <div class="inlineError" id="deleteMessageErrorMsg" style="display:none"></div>
            <div class="instrText" style="margin-bottom: 20px">
                This action is permanent.
            </div>
        </div>
        <a class="btn-small btn-small-normal" id="deleteMessageDialogConfirm"><span>Yes</span></a>
        <a class="btn-small btn-small-secondary" id="deleteMessageDialogCancel"><span>Cancel</span></a>
        <span id="loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
    </form>
</div>
<div id="sendToCheckerMessageDialogContent" style="display:none;">
    <div class="hd">
        <h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2>
    </div>
    <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform" style="margin:0px;">
        <input name="success_message" id="success_message" value="" type="hidden">
        <div class="bd">
            <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
            <div class="instrText" style="margin-bottom: 20px"></div>
            <div class="instrText" style="margin-bottom: 20px" id="reason_message_body">
                <span id="reason_message"></span>: <span style="color: red;">*</span> <br><textarea name="reason" id="reason" cols="50"></textarea><br><br>
                <!-- Notify By:&nbsp;&nbsp;
                <label>
                    <input type="checkbox" name="email_notification" id="email_notification" value=""> Email
                </label> -->
                &nbsp;&nbsp;&nbsp;
            </div>
        </div>
        <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_ad_submit()"><span id="button_tag"></span></a>
        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a>
        <span id="loadingReturn" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
    </form>
</div>
<script type="text/javascript">
    var theme = getDemoTheme();
    rules = [


        {
            input: '#sell_deed',
            message: 'required!',
            action: 'blur,change',
            rule: function(input) {
                if (input.val() != '') {
                    var item = jQuery("#sell_deed").jqxComboBox('getSelectedItem');
                    if (item != null) {
                        jQuery("input[name='sell_deed']").val(item.value);
                    }
                    return true;
                } else {
                    jQuery("#sell_deed input").focus();
                    return false;
                }
            }
        },

        {
            input: '#possession_recovery_by',
            message: 'required!',
            action: 'blur,change',
            rule: function(input) {
                if (input.val() != '') {
                    var item = jQuery("#possession_recovery_by").jqxComboBox('getSelectedItem');
                    if (item != null) {
                        jQuery("input[name='possession_recovery_by']").val(item.value);
                    }
                    return true;
                } else {
                    jQuery("#possession_recovery_by input").focus();
                    return false;
                }
            }
        },

        {
            input: '#possession_taken_by',
            message: 'required!',
            action: 'blur,change',
            rule: function(input) {
                if (input.val() != '') {
                    var item = jQuery("#possession_taken_by").jqxComboBox('getSelectedItem');
                    if (item != null) {
                        jQuery("input[name='possession_taken_by']").val(item.value);
                    }
                    return true;
                } else {
                    jQuery("#possession_taken_by input").focus();
                    return false;
                }
            }
        },

        {
            input: '#mutation_status',
            message: 'required!',
            action: 'blur,change',
            rule: function(input) {
                if (input.val() != '') {
                    var item = jQuery("#mutation_status").jqxComboBox('getSelectedItem');
                    if (item != null) {
                        jQuery("input[name='mutation_status']").val(item.value);
                    }
                    return true;
                } else {
                    jQuery("#mutation_status input").focus();
                    return false;
                }
            }
        },

        {
            input: '#petition_status',
            message: 'required!',
            action: 'blur,change',
            rule: function(input) {
                if (input.val() != '') {
                    var item = jQuery("#petition_status").jqxComboBox('getSelectedItem');
                    if (item != null) {
                        jQuery("input[name='petition_status']").val(item.value);
                    }
                    return true;
                } else {
                    jQuery("#petition_status input").focus();
                    return false;
                }
            }
        },

        {
            input: '#mutation_process',
            message: 'required!',
            action: 'blur,change',
            rule: function(input) {
                if (input.val() != '') {
                    var item = jQuery("#mutation_process").jqxComboBox('getSelectedItem');
                    if (item != null) {
                        jQuery("input[name='mutation_process']").val(item.value);
                    }
                    return true;
                } else {
                    jQuery("#mutation_process input").focus();
                    return false;
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

    jQuery("#property_own_by_bank_form").ajaxForm(options);


    jQuery("#sendButton").click(function() {
        jQuery('#property_own_by_bank_form').jqxValidator({
            rules: rules,
            theme: theme
        });






        var item1 = jQuery("#sell_deed").jqxComboBox('getSelectedItem');
        var item2 = jQuery("#possession_taken_by").jqxComboBox('getSelectedItem');
        var item3 = jQuery("#mutation_status").jqxComboBox('getSelectedItem');
        var item4 = jQuery("#petition_status").jqxComboBox('getSelectedItem');




        if (item1 != null && item1.value == 0) {


            if (jQuery("#sell_deed_no").val() == '') {
                alert("Deed NO is Required!");
                jQuery("#sell_deed_no").focus();
                return false;
            }


        }



        if (item2 != null && item2.value == 0) {

            if (jQuery("#possession_taken_by_date").val() == '') {
                alert("Possession Date is Required!");
                jQuery("#possession_taken_by_date").focus();
                return false;
            }


        }

        if (item3 != null && item3.value == 0) {


            if (jQuery("#mutation_status_number").val() == '') {
                alert("Mutation Status Number is Required!");
                jQuery("#mutation_status_number").focus();
                return false;
            }
            if (jQuery("#mutation_status_date").val() == '') {
                alert("Mutation Status Date is Required!");
                jQuery("#mutation_status_date").focus();
                return false;
            }

            if (jQuery("#district").val() == '') {
                alert("District  is Required!");
                jQuery("#district").focus();
                return false;
            }
            if (jQuery("#thana").val() == '') {

                alert("Thana  is Required!");
                jQuery("#thana").focus();
                return false;
            }

        }


        if (item4 != null && item4.value == 0) {


            if (jQuery("#petition_number").val() == '') {
                alert("Petition Number is Required!");
                jQuery("#petition_number").focus();
                return false;
            }


            if (jQuery("#petition_date").val() == '') {
                alert("Petition Date is Required!");
                jQuery("#petition_date").focus();
                return false;

            }

        }








        var validationResult = function(isValid) {
            if (isValid) {
                jQuery("#sendButton").hide();
                jQuery("#send_loading").show();
                jQuery("#property_own_by_bank_form").submit();
            } else {
                return;
            }
        }
        jQuery('#property_own_by_bank_form').jqxValidator('validate', validationResult);
    });
</script>