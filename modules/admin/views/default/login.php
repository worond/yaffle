<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\LoginForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
?>
<div class="login-box">
  <div class="login-logo">
    <h1><?= Html::encode($this->title) ?></h1>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg"></p>
      <?php $form = ActiveForm::begin([
          'id' => 'login-form',
          'fieldConfig' => [
              'template' => "{input}{error}",
              'inputOptions' => ['class' => 'form-control'],
          ],
      ]); ?>
    <div class="form-group has-feedback">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true,]) ?>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <?= $form->field($model, 'password')->passwordInput() ?>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>
              <?= $form->field($model, 'rememberMe')->checkbox([
                  'template' => "{input} Запомнить меня",
              ]) ?>
          </label>
        </div>
      </div>
      <div class="col-xs-4">
          <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
      </div>
    </div>
      <?php ActiveForm::end(); ?>
  </div>
</div>