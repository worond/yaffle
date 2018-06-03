<?php

use app\modules\admin\components\FormHelper;
use app\modules\catalog\models\CatalogPropertyType;
use app\modules\news\models\NewsPropertyType;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\catalog\models\CatalogPropertyType */
/* @var $seo app\modules\seo\models\Seo */

?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel box box-primary">
            <div class="box-body">

                <?= $form->field($model, 'on_filter')->checkbox(['labelOptions' => ['style' => 'padding-left:10px;'],]); ?>

                <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

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
