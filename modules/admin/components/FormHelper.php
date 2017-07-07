<?php

namespace app\modules\admin\components;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

trait FormHelper
{
    /**
     * @return string
     */
    public static function buttonSave()
    {
        return
            Html::submitButton('<i class="fa fa-save"></i> Сохранить', ['class' => 'btn btn-sm bg-purple', 'name' => 'btn-save', 'value' => 'return']) .
            Html::submitButton('<i class="fa fa-edit"></i> Применить', ['class' => 'btn btn-sm bg-purple', 'name' => 'btn-save', 'value' => 'stay']) .
            Html::a('<i class="fa fa-arrow-left"></i> Отменить', ['index'], ['class' => 'btn btn-sm bg-purple']);
    }

    /**
     * @param $model
     * @return string
     */
    public static function buttonControl(&$model)
    {
        return
            Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-sm bg-purple']) .
            Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-sm bg-purple',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) .
            Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> Назад', ['index'], ['class' => 'btn btn-sm bg-purple']);
    }

    /**
     * @param ActiveForm $form
     * @param $model
     * @param string $image
     * @param string $attribute
     * @param string $relation
     * @return string
     */
    public static function fieldImage($form, $model, $image = 'imageFile', $attribute = 'image_id', $relation = 'image')
    {
        if (!$model->isNewRecord && $model->$attribute) {
            $result = Html::label($model->getAttributeLabel($attribute)) . '<br>
                <div class="row">
                    <div class="col-xs-2">' .
                Html::img($model->$relation->src, ['width' => '100%']) .
                Html::a('<i class="fa fa-times"></i>', ['/admin/file/default/delete', 'id' => $model->$relation->id, 'redirect' => Url::current()], [
                    'class' => 'delete-image pull-right',
                    'title' => 'Удалить',
                    'data' => ['confirm' => 'Вы уверены, что хотите удалить изображение?', 'method' => 'post',],
                ]) . '
                    </div>
                </div>' .
                $form->field($model, $image)->fileInput()->label('Заменить изображение');
        } else {
            $result = $form->field($model, $image)->fileInput()->label($model->getAttributeLabel($attribute));
        }
        return $result;
    }

    /**
     * @param ActiveForm $form
     * @param $model
     * @param string $field
     * @param string $format
     * @return mixed
     */
    public static function fieldDate($form, $model, $field, $format = 'dd.MM.yyyy')
    {
        return $form->field($model, $field)->widget(DatePicker::classname(), [
            'dateFormat' => $format,
            'options' => ['class' => 'form-control'],
        ]);
    }
}
