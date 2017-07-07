<?php

use app\modules\user\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\backend\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <section class="content-header">
        <h1><?= Html::encode($this->title) ?></h1>
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
                                ['class' => 'yii\grid\SerialColumn'],

                                'username',
                                [
                                    'attribute' => 'name',
                                    'value' => 'userProfile.name',
                                    'label' => 'Имя',
                                ],
                                [
                                    'attribute' => 'phone',
                                    'value' => 'userProfile.phone',
                                    'label' => 'Телефон',
                                ],
                                'email:email',
                                [
                                    'attribute' => 'role',
                                    'value' => function ($model) {
                                        foreach (Yii::$app->authManager->getRolesByUser($model->id) as $role) {
                                            $roles[] = $role->description;
                                        }
                                        if (!empty($roles)) {
                                            return implode(', ', $roles);
                                        }
                                        return false;
                                    },
                                    'filter' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'),
                                    'label' => 'Роль',
                                ],
                                [
                                    'attribute' => 'status',
                                    'filter' => User::getStatusesArray(),
                                    'value' => 'statusName',
                                ],

                                'created_at:date',
                                //'updated_at',

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{update} {delete}'
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
