<?php

use app\modules\admin\components\FormHelper;
use app\modules\page\models\Page;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\page\models\Page */
/* @var $seo app\modules\seo\models\Seo */

?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel box box-primary">
            <div class="box-header">
                <h3 class="box-title">Основная информация</h3>
            </div>
            <div class="box-body">
                <?= $form->field($model, 'active')->checkbox([
                    'labelOptions' => ['style' => 'padding-left:10px;'],
                ]); ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= FormHelper::fieldImage($form, $model); ?>
                <?= $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'ckeditor-custom']) ?>
                <?= $form->field($model, 'annotation')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel box box-primary">
            <div class="box-header">
                <h3 class="box-title">Техническая информация</h3>
            </div>
            <div class="box-body">
                <?= $form->field($model, 'parent_id')->dropDownList(Page::getTree(), [
                    'prompt' => 'Корневая страница',
                    'options' => [
                        $model->id => ['disabled' => true]
                    ],
                ]); ?>
                <?= $form->field($model, 'action')->dropDownList(Page::getActions()); ?>
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'position')->textInput() ?>
                <?= $form->field($model, 'sitemap')->checkbox() ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel box box-primary">
            <div class="box-header">
                <h3 class="box-title">СЕО-атрибуты</h3>
            </div>
            <div class="box-body">
                <?= $form->field($seo, 'title'); ?>
                <?= $form->field($seo, 'description'); ?>
                <?= $form->field($seo, 'keywords'); ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel box box-widget">
            <div class="box-body">
                <div class="box-tools pull-right">
                    <div class="btn-group">
                        <?= FormHelper::buttonSave(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

