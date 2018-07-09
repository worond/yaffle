<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $image app\modules\catalog\models\CatalogImage */
/* @var $catalogProperty app\modules\catalog\models\CatalogProperty */
/* @var $model app\modules\catalog\models\Catalog */
/* @var $seo app\modules\seo\models\Seo */

$this->title = 'Товар: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
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
        'image' => $image,
        'catalogProperty' => $catalogProperty,
        'seo' => $seo,
    ]) ?>
</div>
