<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$con = Yii::$app->controller->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="keywords" content="PMS, AIF" />
    <link rel="shortcut icon" href="<?= BASE_URL; ?>static/images/favicon.ico" />
    <title>Welcome To Projectname</title>
    <?php $this->head() ?>
    <?php include(dirname(__FILE__) . "/../common/allcssjs.php"); ?>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <?php $this->beginBody() ?>

        <?= $content ?>


        <?php $this->endBody() ?>
    </div>
</body>
</html>
<?php $this->endPage() ?>