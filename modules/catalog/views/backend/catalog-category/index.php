<?php

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\backend\CatalogCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\admin\components\GridHelper;
use app\modules\catalog\models\CatalogCategory;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title .= 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</section>
<div class="content">
    <div class="box">
        <div class="box-header with-border">
            <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success pull-left']) ?>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            'id',
                            GridHelper::columnImage(),
                            'name',
                            [
                                'attribute' => 'parent_id',
                                'filter' => CatalogCategory::getTree(),
                                'value' => 'parent.name',
                            ],
                            [
                                'attribute' => 'position',
                                'filter' => false,
                            ],
                            GridHelper::columnActive(),
                            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

