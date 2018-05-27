<?php

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\backend\CatalogPropertyValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\admin\components\GridHelper;
use app\modules\catalog\models\CatalogCategory;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title .= 'Значения';
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
                            'value',
                            [
                                'attribute' => 'on_filter',
                                'format' => 'raw',
                                'filter' => ['1' => 'Да', '0' => 'Нет'],
                                'value' => function ($data) {
                                    if ($data->active) return '<i class="fa fa-check"></i>';
                                    else return '<i class="fa fa-times"></i>';
                                },
                            ],
                            /* GridHelper::columnActive(),*/
                            [
                                'attribute' => 'position',
                                'filter' => false,
                            ],
                            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

