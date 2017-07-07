<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\content\models\ContentType */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel box box-primary">
            <div class="box-header">
                <h3 class="box-title">Техническая информация</h3>
            </div>
            <div class="box-body">

                <?= $form->field($model, 'active')->checkbox() ?>

                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'position')->textInput() ?>

                <? //echo $form->field($model, 'created')->textInput() ?>

                <div class="box-tools pull-right">
                    <div class="btn-group">

                        <?= Html::submitButton('<i class="fa fa-save"></i> Сохранить', ['class' => 'btn btn-sm bg-purple', 'name' => 'btn-save', 'value' => 'return']) ?>
                        <?= Html::submitButton('<i class="fa fa-edit"></i> Применить', ['class' => 'btn btn-sm bg-purple', 'name' => 'btn-save', 'value' => 'stay']) ?>
                        <?= Html::a('<i class="fa fa-arrow-left"></i> Отменить', ['index'], ['class' => 'btn btn-sm bg-purple']) ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


