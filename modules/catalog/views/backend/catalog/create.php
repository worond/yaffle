<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Catalog */
/* @var $image app\modules\catalog\models\CatalogImage */
/* @var $uploadFile app\modules\catalog\models\CatalogFile */
/* @var $seo app\modules\seo\models\Seo */

$this->title = 'Добавить товар';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
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
        'image' => $image,
        'uploadFile' => $uploadFile,
        'seo' => $seo,
    ]) ?>
</div>

