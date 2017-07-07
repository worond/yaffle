<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\content\models\ContentValue */

$this->title = 'Create Content Value';
$this->params['breadcrumbs'][] = ['label' => 'Content Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
