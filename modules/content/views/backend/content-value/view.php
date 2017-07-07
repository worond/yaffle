<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\content\models\ContentValue */

$this->title = $model->content_id;
$this->params['breadcrumbs'][] = ['label' => 'Content Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-value-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->content_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->content_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'content_id',
            'field_id',
            'value',
        ],
    ]) ?>

</div>
