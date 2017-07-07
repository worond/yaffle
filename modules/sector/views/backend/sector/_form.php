<?php

use app\modules\admin\components\FormHelper;
use app\modules\sector\models\SectorCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\sector\models\Sector */
/* @var $form yii\widgets\ActiveForm */
/* @var $seo app\modules\seo\models\Seo */
/* @var $image app\modules\sector\models\SectorImage */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Основная информация</h3>
                        </div>
                        <div class="box-body">

                            <?= $form->field($model, 'active')->checkbox() ?>

                            <?= $form->field($model, 'category_id')->dropDownList(SectorCategory::getList(), ['prompt' => 'Выберите раздел']) ?>

                            <?= FormHelper::fieldImage($form, $model) ?>

                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'title_menu')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'ckeditor-custom']) ?>

                            <?= $form->field($model, 'annotation')->textarea(['rows' => 6]) ?>

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
                                <?php foreach ($model->files as $file): ?>
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Техническая информация</h3>
                        </div>
                        <div class="box-body">

                            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                            <?= FormHelper::fieldImage($form, $model, 'iconFile', 'icon_id', 'icon') ?>

                            <?= FormHelper::fieldImage($form, $model, 'thumbnailFile', 'thumbnail_id', 'thumbnail') ?>

                            <?= $form->field($model, 'external_link')->textInput(['maxlength' => true]) ?>

                            <?= FormHelper::fieldDate($form, $model, 'created') ?>

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
    </div>
<?php ActiveForm::end(); ?>