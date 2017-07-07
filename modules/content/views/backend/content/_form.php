<?php

use app\modules\admin\components\FormHelper;
use app\modules\content\models\ContentField;
use app\modules\content\models\ContentType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\content\models\Content */
/* @var $form yii\widgets\ActiveForm */
/* @var $values app\modules\content\models\ContentValue[] */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel box box-primary">
            <div class="box-header">
                <h3 class="box-title">Основаная информация</h3>
            </div>
            <div class="box-body">

                <?= $form->field($model, 'active')->checkbox() ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?php //echo $form->field($model, 'content_type_id')->dropDownList(ContentType::find()->select(['name','id'])->indexBy('id')->column(),['prompt' => 'Выберите тип контента']) ?>

                <?php if (!empty($values)): ?>
                    <?php foreach ($values as $value) : ?>
                        <?php if ($value->field->type == ContentField::TYPE_INTEGER): ?>
                            <?= $form->field($value, '[' . $value->field->id . ']value')->label($value->field->name); ?>
                        <?php elseif ($value->field->type == ContentField::TYPE_STRING): ?>
                            <?= $form->field($value, '[' . $value->field->id . ']value')->label($value->field->name); ?>
                        <?php elseif ($value->field->type == ContentField::TYPE_CHECKBOX): ?>
                            <?= $form->field($value, '[' . $value->field->id . ']value')->checkbox(['label' => $value->field->name]); ?>
                        <?php elseif ($value->field->type == ContentField::TYPE_TEXT): ?>
                            <?= $form->field($value, '[' . $value->field->id . ']value')->textarea(); ?>
                        <?php elseif ($value->field->type == ContentField::TYPE_IMAGE): ?>
                            <?php if (!$model->isNewRecord && $value->value): ?>
                                <?= Html::label($value->field->name) ?><br>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <?= Html::img($value->image->src, ['width' => '100%']) ?>
                                        <?= Html::a('<i class="fa fa-times"></i>', ['delete-image', 'id' => $model->id, 'file_id' => $value->image->id], [
                                            'class' => 'delete-image pull-right',
                                            'title' => 'Удалить',
                                            'data' => ['confirm' => 'Вы уверены, что хотите удалить изображение?', 'method' => 'post',],
                                        ]) ?>
                                    </div>
                                </div>
                                <?= $form->field($value, '[' . $value->field->id . ']imageFile')->fileInput()->label('Заменить изображение') ?>
                            <?php else: ?>
                                <?= $form->field($value, '[' . $value->field->id . ']imageFile')->fileInput()->label($value->field->name) ?>
                            <?php endif ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?= $form->field($model, 'position')->textInput() ?>

                <?php // echo $form->field($model, 'created')->textInput() ?>

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
