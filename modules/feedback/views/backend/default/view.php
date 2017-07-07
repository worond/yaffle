<?php

use app\modules\admin\components\FormHelper;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\Feedback */

$this->title = 'Заявка №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
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
            <div class="btn-group pull-right">
                <?= FormHelper::buttonControl($model) ?>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'viewed',
                                'value' => function ($data) {
                                    return $data->active ? 'Да' : 'Нет';
                                }
                            ],
                            //'user_id',
                            //'image_id',
                            'name',
                            'phone',
                            'email:email',
                            'subject',
                            'message:ntext',
                            //'answer:ntext',
                            'created_at',

                            'url:url',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>