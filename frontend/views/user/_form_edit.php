<?php
//echo '<pre>';print_r($model);die;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row well">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading center" style="font-size: 18px; font-weight: 700;">Edit User Details</div>
            <div class="product-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="row" style="font-size: 18px;">
                    <div class="col-sm-12 col-xs-12">
                        <!--**************************--->
                        <div class="col-sm-12" style="margin-top: 8px;">
                            <div class="col-sm-6"> 
                                <label class="control-label" for="company">Company</label>
                                <select class="form-control he" name="company">
                                    <option  value="">-Select-</option>
                                    <?php
                                    if (!empty($company)) {
                                        foreach ($company as $val1) {
                                            ?>

                                    <option  <?php if ($model['company_id'] == $val1['id']) { ?> selected="true" <?php } ?> value="<?= $val1['id'] ?>"><?= ucwords($val1['company_name']) ?></option>

                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6"> 
                                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                            </div>

                        </div>

                        <div class="col-sm-12" style="margin-top: 8px;">
                            <div class="col-sm-6"> 
                                <?= $form->field($model, 'user_type')->dropDownList(['superadmin' => 'Super Admin', 'admin' => 'Admin', 'write' => 'Write', 'read' => 'Read',], ['class' => 'form-control he', 'prompt' => 'Select...']) ?>
                            </div>
                            <div class="col-sm-6"> 
                                <?= $form->field($model, 'mobile')->textInput() ?>
                            </div>
                        </div>

                        <div class="col-sm-12" style="margin-top: 8px;">
                            <div class="col-sm-6"> 
                                <?= $form->field($model, 'status')->dropDownList(['active' => 'Active', 'block' => 'Block', 'deleted' => 'Deleted'], ['class' => 'form-control he', 'prompt' => 'Select...']) ?>
                            </div>
                            
                             <div class="col-sm-6"> 
                                 <label>Password</label>
                                 <input type="password" class="form-control he" minlength="6" maxlength="15" name="password_hash" />
                            </div>
                        </div>

                        <div class="col-sm-12" style="margin-top: 2%;">

                            <!--**************************--->
                            <div class="form-group center" >
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6" style="margin-bottom: 25px; margin-top: 20px;">
                                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                    </div>




                </div>
                <?php ActiveForm::end(); ?>

            </div>
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