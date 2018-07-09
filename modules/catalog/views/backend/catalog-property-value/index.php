<?php

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalog\models\backend\CatalogPropertyValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\admin\components\GridHelper;
use app\modules\catalog\models\CatalogCategory;
use app\modules\catalog\models\CatalogPropertyValue;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title .= 'Значения';
$this->params['breadcrumbs'][] = ['label' => 'Свойства', 'url' => ['/admin/catalog/catalog-property-type/index']];
$this->params['breadcrumbs'][] = $this->title;
$type_id = Yii::$app->request->get('CatalogPropertyValueSearch')['type_id'];

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
            <?= Html::a(
                'Добавить',
                [CatalogPropertyValue::CREATE . $type_id],
                ['class' => 'btn btn-success pull-left']
            ) ?>
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
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model) use ($type_id) {
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-pencil"></span>',
                                            CatalogPropertyValue::UPDATE . $type_id . '&id=' . $model->id,
                                            ['title' => 'Редактировать']
                                        );
                                    },
                                    'delete' => function ($url, $model) use ($type_id) {
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-trash"></span>',
                                            ['delete', 'id' => $model->id, 'type_id' => $model->type_id],
                                            [
                                                'title' => 'Удалить',
                                                'data' => [
                                                    'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                                    'method' => 'post',
                                                ]
                                            ]
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

