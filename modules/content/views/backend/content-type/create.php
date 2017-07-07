<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $model app\modules\content\models\ContentType */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Тип контента', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
    ]) ?>
</div>
