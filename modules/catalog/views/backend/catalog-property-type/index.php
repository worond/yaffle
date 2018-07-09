<?php

use app\modules\catalog\models\CatalogPropertyValue;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\backend\CatalogPropertyTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title .= 'Свойства';
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
                            'name',
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
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update} {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-th-list"></span>',
                                            CatalogPropertyValue::INDEX . $model->id,
                                            ['title' => 'Значения']
                                        );

                                    }
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

