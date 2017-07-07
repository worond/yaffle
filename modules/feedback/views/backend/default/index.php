<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\feedback\models\backend\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
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
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            'id',
                            //'user_id',
                            //'image_id',
                            'name',
                            'phone',
                            //'email:email',
                            'subject',
                            'message:ntext',
                            // 'answer:ntext',
                            'created_at',
                            // 'active',
                            'url:url',

                            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>