<?php

use app\modules\user\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\rbac\Assignment;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $profile app\modules\user\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Профиль</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="display: block;">

                    <?php if (!isset($model->id)): ?>

                        <?= $form->field($model, 'username')->textInput() ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                    <?php else: ?>

                        <?php Pjax::begin(['enablePushState' => false]) ?>
                        <div style="width:100%;text-align: right">
                            <?= Yii::$app->session->getFlash('message'); ?>
                            &nbsp;&nbsp;
                            <a href="<?= Url::to(['reset-password', 'id' => $model->id]) ?>" class="btn btn-primary">
                                Сбросить пароль и выслать новый на e-mail
                            </a>
                        </div>
                        <?php Pjax::end() ?>

                        <?= $form->field($model, 'username')->textInput(['readonly' => true]) ?>

                    <?php endif; ?>

                    <?= $form->field($profile, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['email']) ?>

                    <?= $form->field($profile, 'phone')->textInput(['maxlength' => true]) ?>

                    <?php //echo $form->field($profile, 'discount')->textInput() ?>

                    <?= $form->field($model, 'status')->dropDownList(User::getStatusesArray(), ['prompt' => 'Выберите статус']) ?>

                    <?= $form->field($model, 'roles')->checkboxList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')) ?>

                    <div class="form-group">
                        <?php if (!isset($model->id)): ?>
                            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                        <?php else: ?>
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>