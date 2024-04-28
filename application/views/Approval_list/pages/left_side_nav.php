<!---- Left Side Menu Start ------>
<style>
    .active {
        background: #93CDDD !important;
        font-weight: bold;
    }

    .navigationItemContent {
        padding-top: 0px !important;
        padding-bottom: 0px !important;

    }

    .navigationItemContent a {
        display: block;
        height: 25px;
        padding: 5px;
    }

    .navigationItemContent:hover {}

    .navigationItemContent:active {
        background: #93CDDD !important;
    }
</style>
<div id='navigationTitle' class='navigationTitle'>
    <div style='float: left; ' class="widget-icon jqx-navigationbar-icon"></div>
    <a>Approval List status</a>
</div>
<div class='navigationItem'>
    <ul class='navigationContent'>
        <li class='navigationItemContent <?php if ($submenu == 'pending' || $submenu == null) {
                                                echo 'active';
                                            } ?>'><a href="<?php echo base_url('approval_list/view/' . $menu_group . '/' . $menu_cat . '/' . $menu_link . '/'); ?>pending">Pending</a></li>
        <li class='navigationItemContent <?php if ($submenu == 'running') {
                                                echo 'active';
                                            } ?>'><a href="<?php echo base_url('approval_list/view/' . $menu_group . '/' . $menu_cat . '/' . $menu_link . '/'); ?>running">Running</a></li>

    </ul>
</div>
<!----====== Left Side Menu End==========----->