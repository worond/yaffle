<?php

use app\modules\content\models\ContentField;
use app\modules\content\models\ContentType;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\content\models\backend\ContentFieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поля контента';
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
                            'position',
                            'id',
                            [
                              'attribute' => 'content_type_id',
                              'filter' => ContentType::find()->select(['name','id'])->indexBy('id')->column(),
                              'value' => 'contentType.name'
                            ],
                            'code',
                            'name',
                            [
                              'attribute'=>'type',
                              'filter' => ContentField::getTypesArray(),
                              'value' => 'typeName'
                            ],
                            [
                                'attribute' => 'active',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    if ($data->active) return '<i class="fa fa-check" aria-hidden="true"></i>';
                                    else return '<i class="fa fa-times" aria-hidden="true"></i>';
                                },
                            ],

                            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
