<?php

use app\modules\admin\components\FormHelper;
use app\modules\catalog\models\CatalogPropertyValue;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\catalog\models\CatalogPropertyValue */
/* @var $seo app\modules\seo\models\Seo */

$type_id = Yii::$app->request->get('CatalogPropertyValueSearch')['type_id'];
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel box box-primary">
            <div class="box-body">

                <?= $form->field($model, 'on_filter')->checkbox(['labelOptions' => ['style' => 'padding-left:10px;'],]); ?>

                <?= $form->field($model, 'type_id')->hiddenInput(['value' => $type_id])->label(false); ?>

                <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

                <div class="box-tools pull-right">
                    <div class="btn-group">
                        <?= Html::submitButton('<i class="fa fa-save"></i> Сохранить', ['class' => 'btn btn-sm bg-purple', 'name' => 'btn-save', 'value' => 'return']) .
                        Html::submitButton('<i class="fa fa-edit"></i> Применить', ['class' => 'btn btn-sm bg-purple', 'name' => 'btn-save', 'value' => 'stay']) .
                        Html::a('<i class="fa fa-arrow-left"></i> Отменить', [CatalogPropertyValue::INDEX . $type_id], ['class' => 'btn btn-sm bg-purple']); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

