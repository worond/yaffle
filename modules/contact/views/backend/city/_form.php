<?php

use app\modules\admin\components\FormHelper;
use app\modules\contact\models\City;
use app\modules\contact\models\Region;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?=  $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_id')->dropDownList(Region::getList()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'coordinates')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'external_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <div class="form-group">
        <div class="btn-group pull-right">

            <?= FormHelper::buttonSave(); ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>