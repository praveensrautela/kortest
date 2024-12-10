<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" class="semi-dark color-header headercolor2">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="keywords" content="PMS, AIF" />
    <meta name="description" content="" />
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <title>Welcome To New Project</title>
    <?php $this->head() ?>
    <?php include(dirname(__FILE__) . "/../common/admincss.php"); ?>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <?php include(dirname(__FILE__) . "/../common/sidebar.php"); ?>
        <!--end sidebar wrapper -->
        <!--start header -->
        <?php include(dirname(__FILE__) . "/../common/navbar.php"); ?>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <?= $content; ?>
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © <?= date('Y') ?>. All right reserved.</p>
        </footer>
    </div>
    <?php include(dirname(__FILE__) . "/../common/adminjs.php"); ?>
</body>
</html>
<?php $this->endPage() ?>