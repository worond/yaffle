<?php

use app\modules\menu\models\Menu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $parameters app\modules\parameter\models\Parameter[] */


$this->title = 'Общие настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</section>
<div class="content">
    <div class="box">
        <?php if (YII_DEBUG === true): ?>
            <div class="box-header with-border">
                <?= Html::a('Добавить параметр', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        <?php endif; ?>
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal'
            ],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-8">{input}{hint}</div><div class="col-sm-10">{error}</div>',
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
            ],
        ]); ?>
        <div class="box-body">
            <?php foreach ($parameters as $parameter): ?>
                <?php if ($parameter->type == 0): ?>
                    <?= $form->field($parameter, '[' . $parameter->id . ']data')->textInput(['maxlength' => true])->label($parameter->name) ?>
                <?php elseif ($parameter->type == 1): ?>
                    <?= $form->field($parameter, '[' . $parameter->id . ']data')->textarea(['maxlength' => true])->label($parameter->name) ?>
                <?php elseif ($parameter->type == 2): ?>
                    <?= $form->field($parameter, '[' . $parameter->id . ']data')->checkbox()->label($parameter->name) ?>
                <?php elseif ($parameter->type == 3): ?>
                    <?= $form->field($parameter, '[' . $parameter->id . ']file')->fileInput(['require' => true])->label($parameter->name)
                        ->hint(Html::a($parameter->data, [$parameter->data], ['class' => 'btn btn-sm bg-purple', 'target' => '_blank'])); ?>
                <?php endif; ?>


            <?php endforeach; ?>
        </div>
        <div class="box-body">
            <div class="box-tools pull-right">
                <div class="btn-group">
                    <?= Html::submitButton('<i class="fa fa-save"></i> Сохранить', ['class' => 'btn btn-sm bg-purple']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
