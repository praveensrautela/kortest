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
<div class="col-sm-12"></div>
<div class="col-sm-12"></div>
<div class="widget-box wid90" id="tid" style="margin-top: 4%;" >

    <div class="widget-body">
        <div class="widget-main no-padding">
            <div class="user"> 

                <div class="pull-right tableTools-container"></div>
                <div class="tblback"></div>
                <table id="dynamic-table" class="table table-striped table-bordered display nowrap" style="width:100%;" >

                    <thead>
                        <tr>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'ID'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Name'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Email'); ?> </th>
                            <th style="text-align: center;"> <?= \Yii::t('invest_quick', 'Mobile No'); ?>. </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Date of joining'); ?> </th>
                            <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Account Type'); ?> </th>
                             <th style="text-align: center;"><?= \Yii::t('invest_quick', 'Action'); ?> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($userdata)) {
                            foreach ($userdata as $val) {
                                ?>
                                <tr>
                                    <td style="text-align: center;">
        <?= !empty($val['id']) ? $val['id'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
        <?= !empty($val['name']) ? $val['name'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
        <?= !empty($val['email']) ? $val['email'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
        <?= !empty($val['mobile']) ? $val['mobile'] : ''; ?>
                                    </td>
                                     
                                    
                                    <td style="text-align: center;">
        <?= !empty($val['created_at']) ? $val['created_at'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
        <?= !empty($val['account_type']) ? $val['account_type'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $utility = new Utility();
                                        $memberID = $utility->encryptionFormatforcookie($val['id']);
                                        ?>
                                        <a class='btn-floating btn-small red' onClick="setuser('<?= $memberID ?>')" title='View user profile'><i class="large fa fa-eye"></i></a>
                                         <a class='btn-floating btn-small red'  style="float: right; color: red" href="<?= BASE_URL ?>userdata/update?id= <?= $val['id'] ?>" title='Edit'><i  style=" color: red" class="large fa fa-edit"></i></a>

                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>

                            <tr><td style="text-align: center" colspan="8"><?= \Yii::t('invest_quick', 'No Records Found'); ?></td></tr>
<?php } ?>


                    </tbody>
                </table>


            </div>
        </div>
    </div>
    <br> <br>
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
    @media only screen and (max-width: 768px) { .dataTables_filter label {margin-right: auto;} }
</style>

<script>
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
                        location.href = JS_BASE_URL + 'dashboard';
                    }
                }
            });
        }
    }
</script>