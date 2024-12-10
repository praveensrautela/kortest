<?php

use common\models\Utility;

$utility = new Utility();
?>

<?php //include(dirname(__FILE__) . "/../common/sidebar.php");  ?>
<!-- page specific plugin scripts -->
<link rel="stylesheet" media="all" type="text/css" href="<?= STATIC_URL; ?>css/responsive.dataTables.min.css?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"/>
<script src="<?= STATIC_URL; ?>js/Searchingjquery.dataTables.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/SearchingdataTables.responsive.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/dataTables.tableTools.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/dataTables.colVis.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>

<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'fixed')
    } catch (e) {
    }
</script> 


<?php
$action = Yii::$app->controller->action->id;
//echo $action;die;

$con = Yii::$app->controller->id;
//echo $action."======".$con; exit;
//    echo $this->params['page_header_info']['action']; exit;
//if ($action == "explor") {
    ?>
    
<?php //} ?>

<?PHP
$action = '';
if (!empty($this->params['page_header_info']['action'])) {
    $action = $this->params['page_header_info']['action'];
    //echo $action;die;
}

$name = '';

if (!empty($this->params['user_info']['name'])) {
    $name = $this->params['user_info']['name'];
}
if ($action == "usersysadmin") {
    ?>
    <script src="<?= STATIC_URL; ?>js/usersysreportadmin.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "executiondetails") {
    ?>
    <script src="<?= STATIC_URL; ?>js/usersysreportadmindetails.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "pagereferrer") {
    ?>
    <script src="<?= STATIC_URL; ?>js/adminpageref.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "whitelabel") {
    ?>
    <script src="<?= STATIC_URL; ?>js/whitelabel.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "sipplus") {
    ?>
    <script src="<?= STATIC_URL; ?>js/sipplus.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "saraldetail") {
    ?>
    <script src="<?= STATIC_URL; ?>js/saraltxn.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "siplumpsum") {
    ?>
    <script src="<?= STATIC_URL; ?>js/siplumsum.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "execution") {
    ?>
    <script src="<?= STATIC_URL; ?>js/execution.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "lumpsumexecution") {
    ?>
    <script src="<?= STATIC_URL; ?>js/lumpsumexecution.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php
}
if ($action == "sipplusauto") {
    ?>
    <script src="<?= STATIC_URL; ?>js/sipplus.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }
if ($action == "sipsystematic") {
    ?>
    <script src="<?= STATIC_URL; ?>js/sipsytematic.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }
if ($action == "executionautoinc") {
    ?>
    <script src="<?= STATIC_URL; ?>js/executionsipauto.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }
if ($action == "systematicexecution") {
    ?>
    <script src="<?= STATIC_URL; ?>js/systematicexecution.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }
if ($action == "userlist") {
    ?>
    <script src="<?= STATIC_URL; ?>js/listing.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }
if ($action == "insightscorecommimpact") {
    ?>
    <script src="<?= STATIC_URL; ?>js/insightscorecommimpact.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }
if ($action == "communicationlog") {
    ?>
    <script src="<?= STATIC_URL; ?>js/commlog.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } if ($action == "taxstatement") { ?>
    <script src="<?= STATIC_URL; ?>js/textstatement.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }
if ($action == "wrongdataentry") {
    ?>
    <script src="<?= STATIC_URL; ?>js/wrongdata.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } if ($action == "duplicatedataentry") { ?>
    <script src="<?= STATIC_URL; ?>js/duplicatedata.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }if ($action == "wrongclosingunit") { ?>
    <script src="<?= STATIC_URL; ?>js/wrongclosingunit.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } if ($action == "advisoryplan") { ?>
    <script src="<?= STATIC_URL; ?>js/advisoryplan.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } if ($action == "advisormap") { ?>
    <script src="<?= STATIC_URL; ?>js/advisormap.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } if ($action == "planexpiry") { ?>
    <script src="<?= STATIC_URL; ?>js/planexpiry.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }if ($action == "planpayment") { ?>
    <script src="<?= STATIC_URL; ?>js/planpayment.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }if ($action == "systransdetail") { ?>
    <script src="<?= STATIC_URL; ?>js/systransadmin.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php }if ($action == "membercommdetails") { ?>
    <script src="<?= STATIC_URL; ?>js/adminmemdetails.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>
<?php if ($action == "sifiplus") { ?>
    <script src="<?= STATIC_URL; ?>js/sifiplus.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>
<?php if ($action == "sifisystemetic") { ?>
    <script src="<?= STATIC_URL; ?>js/sifistemetic.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>
<?php if ($action == "sifilumpsum") { ?>
    <script src="<?= STATIC_URL; ?>js/sifilumpsum.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } if ($action == "Group") { ?>
    <script src="<?= STATIC_URL; ?>js/group.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>
<?php if ($action == "wealthsimpleadmin") { ?>
    <script src="<?= STATIC_URL; ?>js/wealthsimpleadmin.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>
<?php if ($action == "wealthaction") { ?>
    <script src="<?= STATIC_URL; ?>js/wealthaction.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
                    <?php } ?>
<?php if ($action == "wealthactionredeem") { ?>
    <script src="<?= STATIC_URL; ?>js/wealthactionredeem.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>
<?php if ($action == "wealthrebalance") { ?>
    <script src="<?= STATIC_URL; ?>js/wealthrebalancing.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>

<?php if ($action == "explor") {  ?>
    <script src="<?= STATIC_URL; ?>js/explorjs.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>
<?php if ($action == "emailtemplate") { ?>
    <div class="widget-header">
        <div class="row">
            <div class="col-sm-9">
                <h1><?php echo \Yii::t('invest_quick', $this->params['page_header_info']['name']) ?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
    <?php echo \Yii::t('invest_quick', $this->params['page_header_info']['sub_name']) ?>
                    </small>
                </h1></div></div>
    </div>

    <script src="<?= STATIC_URL; ?>js/emailtemplate.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } else if ($action == "contactustemplate") { ?>
    <div class="widget-header">
        <div class="row">
            <div class="col-sm-9">
                <h1><?php echo \Yii::t('invest_quick', $this->params['page_header_info']['name']) ?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
    <?php echo \Yii::t('invest_quick', $this->params['page_header_info']['sub_name']) ?>
                    </small>
                </h1></div></div>
    </div>
    <script src="<?= STATIC_URL; ?>js/contactustemplate.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<?php } ?>

