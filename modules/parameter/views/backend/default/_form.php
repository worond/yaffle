<?php

use app\modules\parameter\models\Parameter;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\menu\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'type')->dropDownList(Parameter::PARAMETER_TYPES) ?>

    <?= $form->field($model, 'category_id')->dropDownList(Parameter::PARAMETER_CATEGORIES) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="btn-group pull-right">
            <?= Html::submitButton('<i class="fa fa-save"></i> Сохранить', ['class' => 'btn btn-sm bg-purple', 'name' => 'btn-save', 'value' => 'return']) ?>
            <?= Html::submitButton('<i class="fa fa-edit"></i> Применить', ['class' => 'btn btn-sm bg-purple', 'name' => 'btn-save', 'value' => 'stay']) ?>
            <?= Html::a('<i class="fa fa-arrow-left"></i> Отменить', ['index'], ['class' => 'btn btn-sm bg-purple']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
