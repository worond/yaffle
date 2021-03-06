<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\CatalogPropertyValue */

$this->title = 'Изменение значения: ' . $model->value;
$this->params['breadcrumbs'][] = ['label' => 'Свойства', 'url' => ['/admin/catalog/catalog-property-type/index']];
$this->params['breadcrumbs'][] = ['label' => $model->value, 'url' => ['view', 'id' => $model->id]];
?>
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</section>
<div class="content">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
