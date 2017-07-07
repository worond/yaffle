<?php

use app\modules\admin\components\FormHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'viewed')->checkbox() ?>

    <?php //echo $form->field($model, 'user_id')->textInput() ?>

    <?php //echo FormHelper::fieldImage($form,$model) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

    <?php if ($model->isNewRecord): ?>
        <?= $form->field($model, 'created_at')->widget(DatePicker::classname(), [
            'dateFormat' => 'dd.MM.yyyy',
            'options' => ['class' => 'form-control'],
        ]) ?>
    <?php else: ?>
        <?= $form->field($model, 'created_at')->textInput(['maxlength' => true, 'disabled' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="btn-group pull-right">
            <?= FormHelper::buttonSave(); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>