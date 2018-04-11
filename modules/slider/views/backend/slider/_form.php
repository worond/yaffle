<?php

use app\modules\admin\components\FormHelper;
use app\modules\slider\models\Slider;
use app\modules\slider\models\SliderCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\slider\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Основная информация</h3>
                        </div>
                        <div class="box-body">

                            <?= $form->field($model, 'active')->checkbox() ?>

                            <?= $form->field($model, 'type')->dropDownList(Slider::getTypesList()) ?>

                            <?= FormHelper::fieldImage($form, $model) ?>

                            <?= FormHelper::fieldImage($form, $model, 'iconFile', 'icon_id', 'icon') ?>

                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
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
<?php ActiveForm::end(); ?>