<?php

use app\modules\admin\components\GridHelper;
use app\modules\contact\models\Region;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\contact\models\backend\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Регионы';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</section>
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <?= Html::a('Добавить регион', ['create'], ['class' => 'btn btn-success']) ?>
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
                            'position',
                            GridHelper::columnActive(),

                            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>