<?php

use app\modules\admin\components\FormHelper;
use app\modules\partner\models\Partner;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\partner\models\Partner */
/* @var $seo app\modules\seo\models\Seo */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="panel box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Основная информация</h3>
                            </div>
                            <div class="box-body">

                                <?= $form->field($model, 'active')->checkbox() ?>

                                <?= FormHelper::fieldImage($form, $model) ?>

                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                                <?= $form->field($model, 'annotation')->textarea(['rows' => 6]) ?>

                                <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
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
    </div>
<?php ActiveForm::end(); ?>