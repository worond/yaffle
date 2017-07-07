<?php

/* @var $this yii\web\View */
/* @var $searchModel app\modules\news\models\backend\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\admin\components\GridHelper;
use app\modules\news\models\NewsCategory;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title .= 'Новости';
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
                            /*[
                                'attribute' => 'category_id',
                                'filter' => NewsCategory::getList(),
                                'value' => 'category.name',
                            ],*/
                            'name',
                            'annotation',
                            'created:date',
                            GridHelper::columnActive(),
                            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

