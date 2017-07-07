<?php

use app\modules\admin\components\FormHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\menu\models\MenuCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= FormHelper::fieldImage($form, $model) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'position')->textInput() ?>

    <div class="form-group">
        <div class="btn-group pull-right">
            <?= FormHelper::buttonSave(); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>