<?php

use app\modules\admin\components\FormHelper;
use app\modules\contact\models\City;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?=  $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= FormHelper::fieldImage($form, $model) ?>

    <?= $form->field($model, 'city_id')->dropDownList(City::getList()) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'managers')->textarea() ?>

    <?php //echo $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'coordinates')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'external_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'default')->checkbox() ?>

    <div class="form-group">
        <div class="btn-group pull-right">

            <?= FormHelper::buttonSave(); ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>