<?php

use app\modules\admin\components\GridHelper;
use app\modules\content\models\Content;
use app\modules\content\models\ContentType;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\content\models\backend\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
$content_type_id = Yii::$app->request->get('content_type_id');
$null = null;
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
            <?= Html::a('Добавить', ['create', 'content_type_id' => $content_type_id], ['class' => 'btn btn-success pull-left']) ?>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            'position',
                            Content::gridColumn($content_type_id),
                            'name',
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
