<?php

use app\modules\admin\components\FormHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?php //echo FormHelper::fieldImage($form, $model) ?>

    <?php //echo $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

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