<?php

use app\modules\admin\components\FormHelper;
use app\modules\catalog\models\CatalogCategory;
use app\modules\catalog\models\CatalogPropertyType;
use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $image app\modules\catalog\models\CatalogImage */
/* @var $uploadFile app\modules\catalog\models\CatalogFile */
/* @var $catalogProperty app\modules\catalog\models\CatalogProperty */
/* @var $model app\modules\catalog\models\Catalog */
/* @var $seo app\modules\seo\models\Seo */

?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="panel box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Основная информация</h3>
                </div>
                <div class="box-body">

                    <?= $form->field($model, 'active')->checkbox(['labelOptions' => ['style' => 'padding-left:10px;'],]); ?>

                    <?= $form->field($model, 'category_id')->dropDownList(CatalogCategory::getTree()); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= FormHelper::fieldImage($form, $model); ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'ckeditor-custom']) ?>

                    <?= $form->field($model, 'annotation')->textarea(['rows' => 6]) ?>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Техническая информация</h3>
                </div>
                <div class="box-body">

                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'created_at')->widget(DatePicker::classname(), [
                        'dateFormat' => 'dd.MM.yyyy HH:mm',
                        'options' => ['class' => 'form-control', 'disabled' => true],
                    ]) ?>

                    <?= $form->field($model, 'updated_at')->widget(DatePicker::classname(), [
                        'dateFormat' => 'dd.MM.yyyy HH:mm',
                        'options' => ['class' => 'form-control', 'disabled' => true],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="panel box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Характеристики</h3>
                </div>
                <div class="box-body">

                    <?= $form->field($model, 'article')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'viscosity_grade')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'packaging')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                    <?php if ($properties = $model->dropDownLists): ?>
                        <?php foreach ($properties as $type_id => $property): ?>
                            <?= $form->field($property, '['.$type_id.']value')
                                ->dropDownList($property['values'], ['prompt' => 'Выберите значение...'])
                                ->label($property['label']); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Изображения</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="display: block;">
                    <div class="row">
                        <?php foreach ($model->images as $file): ?>
                            <div class="form-group col-xs-2">
                                <?= Html::img($file->src, ['width' => '100%']) ?>
                                <?= Html::a('<i class="fa fa-times"></i>', ['/admin/file/default/delete', 'id' => $file->id, 'redirect' => Url::current()], [
                                    'class' => 'delete-image pull-right',
                                    'title' => 'Удалить',
                                    'data' => ['confirm' => 'Вы уверены, что хотите удалить изображение?', 'method' => 'post',],
                                ]) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?= $form->field($image, 'imageFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Добавить изображение'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Файлы</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="display: block;">
                    <div class="row">
                        <?php foreach ($model->files as $file): ?>
                            <div class="col-xs-10">
                                <?= Html::a($file->title, [$file->src], [
                                    'class' => 'no',
                                    'download' => 'download'
                                ]) ?>
                            </div>
                            <div class="col-xs-2">
                                <?= Html::a('<i class="fa fa-times"></i>', ['/admin/file/default/delete', 'id' => $file->id, 'redirect' => Url::current()], [
                                    'class' => 'pull-right',
                                    'title' => 'Удалить',
                                    'data' => ['confirm' => 'Вы уверены, что хотите удалить файл?', 'method' => 'post',],
                                ]) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?= $form->field($uploadFile, 'uploadFile[]')->fileInput(['multiple' => true])->label('Добавить файл'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
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
        <div class="col-md-12">
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
</div>
<?php ActiveForm::end(); ?>

