<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\content\models\ContentValue */

$this->title = 'Update Content Value: ' . $model->content_id;
$this->params['breadcrumbs'][] = ['label' => 'Content Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->content_id, 'url' => ['view', 'id' => $model->content_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
