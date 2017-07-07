<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\sector\models\Sector */
/* @var $seo app\modules\seo\models\Seo */
/* @var $image app\modules\sector\models\SectorImage */


$this->title = 'Добавить отрасль';
$this->params['breadcrumbs'][] = ['label' => 'Отрасли', 'url' => ['index']];
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
        'seo' => $seo,
        'image' => $image,
    ]) ?>
</div>