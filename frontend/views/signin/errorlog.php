<?php

use yii\helpers\Html;
use yii\base\view;
?>
<div class="page-content noprint">
    <?php
    // include(dirname(__FILE__) . "/../common/errorpage.php");
    ?>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-2"></div>
        <div class="error-container col-xs-8">
            <div class="well">
                <h3 class="lighter smaller"> <span class="blue bigger-125">But we are working </span><i class="ace-icon fa fa-wrench icon-animated-wrench bigger-125">
                    </i><span class="blue bigger-125"> on it! </span></h3></br>
                <h5 class="smaller"> 
                    <?php  $curdatetime = date("Y-m-d H:i:s"); ?>
                    
                    
                    Date/Time : <?php echo $curdatetime; ?></h5>
                <h5 class="smaller"> Description : <?php echo $e->getMessage();  ?> </h5>

                <div class="space"></div>

                <div>
                    <h4 class="lighter smaller">If you repeatedly see this error page:</h4>
                    <ul class="list-unstyled spaced inline bigger-110 margin-15">
                        <li>
                            <i class="ace-icon fa fa-hand-o-right blue"></i>
                            Take the screen shot of this page or copy all text from this page
                        </li>                       
                        


                    </ul>
                </div>

                <hr />
                <div class="space"></div>

                <div class="center">
                    <a href="javascript:history.back()" class="btn btn-grey">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Go Back
                    </a>

                    <a href="<?= BASE_URL ?>dashboard" class="btn btn-primary">
                        <i class="ace-icon fa fa-tachometer"></i>
                        Go to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>
</div>