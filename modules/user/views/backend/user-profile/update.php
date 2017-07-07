<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $profile app\modules\user\models\UserProfile */

$this->title = 'Редактировать пользователя ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Польователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</section>
<div class="content">
    <?= $this->render('_form', [
        'model' => $model,
        'profile' => $profile,
    ]) ?>
</div>

