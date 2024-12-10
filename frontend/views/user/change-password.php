<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row well">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading center" style="font-size: 18px; font-weight: 700;">Enter New Password..!</div>
            <p class="text-center text-danger"><?= !empty($msg) ? $msg : '' ?></p>
            <div class="product-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="row" style="font-size: 18px;">
                    <!--**************************--->
                    <div class="col-sm-12" style="margin-top: 8px;">
                        <div class="col-sm-6">  
                            <label>New Password</label>
                            <input type="password" name="password" minlength="6" maxlength="16" class="form-control he" required="" />
                        </div>
                        <div class="col-sm-6"> 
                            <label>Confirm Password</label> 
                            <input type="password" name="connpassword" minlength="6" maxlength="16" class="form-control he" required="" />
                        </div>
                        <div class="col-sm-12 text-center" style="margin-top: 4%;">  
                            <input type="submit" name="submit" class="btn btn-primary" />
                             <br><br><br>
                        </div>
                       
                    </div>

                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>

<style>
    .well {
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
        background-color: #ffffff;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
    }
    .note-editor.note-frame .note-editing-area .note-editable {
        color: #676a6c;
        padding: 15px;
        border: solid 2px #f5f5f5;
        height: 200px;
    }
    .he{
        height:34px !important;
    }
</style>