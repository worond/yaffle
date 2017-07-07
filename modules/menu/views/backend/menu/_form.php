<?php

use app\modules\admin\components\FormHelper;
use app\modules\menu\models\Menu;
use app\modules\menu\models\MenuCategory;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\menu\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'category_id')->dropDownList(MenuCategory::getList()) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(Menu::getTree(),['prompt'=>'Корневая']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="btn-group pull-right">
            <?= FormHelper::buttonSave(); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
