<?php
// echo '<pre>';
//print_r($userlist);
//die;
?>
<link rel="stylesheet" media="all" type="text/css" href="<?= STATIC_URL; ?>css/responsive.dataTables.min.css?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"/>
<script src="<?= STATIC_URL; ?>js/datatablejs/Searchingjquery.dataTables.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/datatablejs/SearchingdataTables.responsive.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/datatablejs/dataTables.tableTools.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/datatablejs/dataTables.colVis.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/datatablejs/userlist.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'fixed')
    } catch (e) {
    }
</script> 
<?php

use common\models\Utility;
?>

<div class="row " style="margin-bottom: 4%;">  
    <div class="col-sm-4  ab">
        <span>All User Details</span>
    </div>
    <div class="col-sm-5"></div>
    <div class="col-sm-3"  style="margin-top:4%;" >
        <a class="btn btn-block  btn-primary btn-rounded" href="<?= BASE_URL ?>user-create">Add New User</a>
    </div>
</div>
<div class="col-sm-12"></div>
<div class="row border-bottom white-bg dashboard-header" style="margin-bottom: 10%;">
    <div class="wrapper wrapper-content switch-header">
        <div class="row" >
            <div class="col-xs-12"> 
                <div class="pull-right tableTools-container"></div>
                <div class="tblback"></div>
                <table id="dynamic-table" class="table table-striped table-bordered display nowrap" style="width:100%;" >
                    <thead>
                        <tr>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Sno'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Company Name'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'User Name'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'User Type'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Mobile No.'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Created On'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Status'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Action'); ?> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($userlist)) {
                            $i = 1;
                            foreach ($userlist as $val) {
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?= $i ?>
                                    </td>
                                    <td style="text-align: center;">

                                        <?= !empty($val['company_name']) ? ucwords($val['company_name']) : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= !empty($val['username']) ? ucwords($val['username']) : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= !empty($val['user_type']) ? ucwords($val['user_type']) : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= !empty($val['mobile']) ? $val['mobile'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= !empty($val['created_at']) ? date('y-d-m', strtotime($val['created_at'])) : ''; ?>
                                    </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if (!empty($val['status'])) {
                                            if ($val['status'] == 'deleted') {
                                                ?>
                                                <a class="btn btn-success btn-rounded" href="#">Deleted</a>
                                            <?php }if ($val['status'] == 'active') { ?>
                                                <a class="btn btn-warning btn-rounded" href="#">Active</a>
                                            <?php }if ($val['status'] == 'block') { ?>
                                                <a class="btn btn-danger btn-rounded" href="#">Block</a>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                         <a class='btn-floating btn-small red' onClick="setuser('<?= $val['id'] ?>')" title='View user profile'><button type="button" class="btn btn-danger"><i class="large fa fa-eye"></i></button></a>
                                        <a href="<?= BASE_URL ?>user/update?id= <?= $val['id'] ?>" title='Edit'><button type="button" class="btn btn-success">Edit</button></a>
                                    <a href="<?= BASE_URL ?>user/delete?id= <?= $val['id'] ?>" title='delete' style="float:right;"><i class="fa fa-trash fa-2x" style="color:red"></i></a>
                                    
                                    
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr><td style="text-align: center" colspan="9"><?= \Yii::t('invest_quick', 'No Records Found'); ?></td></tr>
<?php } ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
    <br> <br> <br> <br>
</div>

<style>

    .tableTools-container {
        margin-bottom: 8px;
        margin-bottom: -4%;
    }
    .current {
        background-color: #428bca;
        color: white;
        border: 1px solid #428bca;
    }
    .blockquote1 {
        padding: 5px 20px;
        margin: 0px 0 -3px;
        font-size: 17px;
        border-left: 5px solid #f3f3f4;
    }
    .colorblue {
        color: #29abe2 !important;
    }

</style>
<style>
    .btn-default-new {
        color: #fff;
        background: #163850;
        border: 1.5px solid #163850;
    }
    .btn-default-new:hover { 
        color: #fff;
    }
    .btn-default-new:focus { 
        color: #fff;
    }

    @media 
    only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

        .a{
            text-align: right;
        }
        .b{
            text-align: right;
        }
        .searchtop{margin:0 0 0 80px;}
        input[type=search] {width:20% !important;}
        #ui-id-8 { display: block;}
        .ui-tooltip-content{ display:block;}
        .unitBlanace { display: none;}
        .netInvestment { display: none;}

        .dataTables_wrapper label {
            display: inline-block;
            font-size: 14px; width:100%;
            padding-top: 13px;
        }
        .dataTables_filter {
            text-align: right;
            margin-right: 0px;
            margin: -10px 0% 0 0px; width:100%;
        }
        #dynamic-table_filter {
            width: 100%;
        }
        input[type=search] {
            width: 20%;
        }
        #dynamic-table_length {
            background-color: #DCDCDC;
            height: 60px;
            margin-top: 49px;
        }
    }
    #dataTables_filter input[type=search] {width:95%;}
    .btn-bold{margin-top:0px !important;}
    .searchtop{margin:0 0 0 80px;}
    .col-xs-6 {width: 44%;}
    @media only screen and (max-width: 320px)
    {
        input[type=search] {width:20% !important;}
        #ui-id-8 { display: block;}
        .ui-tooltip-content{ display:block;}
        .unitBlanace { display: none;}
        .netInvestment { display: none;}

        .dataTables_wrapper label {
            display: inline-block;
            font-size: 14px; width:100%;
            padding-top: 13px;
        }
        .dataTables_filter {
            text-align: right;
            margin-right: 0px;
            margin: -10px 0% 0 0px; width:100%;
        }
        #dynamic-table_filter {
            width: 100%;
        }
        input[type=search] {
            width: 100%;
        }

        #dynamic-table_length {
            background-color: #DCDCDC;
            height: 62px;
            margin-top: 49px;
        }

    }

    div.container { max-width: 1200px }
    .unitBlanace { display: none;}
    .netInvestment { display: none;}
    #dynamic-table_length{background-color: #DCDCDC; height: 62px; width: 100%;}
    .dataTables_wrapper label {
        display: inline-block;
        font-size: 14px;
        padding-top: 13px;
    }
    .hidden {
        display: none;
    }
    .dataTables_filter {
        text-align: right;
        margin-right: 200px;
    }


    .ColVis_Button 
    {
        display: none;
    }
    .dataTables_filter label {
        margin-right: -58px;
    }

    .dataTables_paginate .paginate_button {
        color: black;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        float: left;
    }
    #dynamic-table_paginate{
        float: right;
        margin-top: 2%;
    }
    #dynamic-table_filter {
        width: 77%;
    }
    @media only screen and (max-width: 768px) { .dataTables_filter label {margin-right: auto;} }
</style>
<script>
    var JS_BASE_URL = '<?= BASE_URL ?>';
    function setuser(id) {
        if (id != '')
        {
            var stuff = {'id': id};
            $.ajax({
                type: 'post',
                data: stuff,
                url: JS_BASE_URL + 'setuser-enrypted',
                success: function (result) {
                    if (result == false) {
                        return false;
                    } else {
                        location.href = JS_BASE_URL + 'setting';
                    }
                }
            });
        }
    }
</script>