<?php

use app\modules\seo\models\Seo;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $pageTree [] */
/* @var $defaultSeo Seo */

$this->title .= 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</section>
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <?= Html::a('Добавить страницу', ['create'], ['class' => 'btn btn-success pull-left']) ?>
                </div>
                <div class="box-body">
                    <div class="panel-group" role="tablist">
                        <ul class="tree-view">
                            <?= $this->render('_tree', [
                                'pageTree' => $pageTree,
                            ]) ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Дефолтные метатеги</h3>
                </div>
                <div class="box-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($defaultSeo, 'title'); ?>

                    <?= $form->field($defaultSeo, 'description'); ?>

                    <?= $form->field($defaultSeo, 'keywords'); ?>

                    <?php if(Yii::$app->session->hasFlash('error')):?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Ошибка!</h4>
                            <?= Yii::$app->session->getFlash('error');?>
                        </div>
                    <?php endif;?>

                    <?php if(Yii::$app->session->hasFlash('success')):?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Успешно!</h4>
                        <?= Yii::$app->session->getFlash('success');?>
                    </div>
                    <?php endif;?>

                    <div class="box-tools pull-right">
                        <div class="btn-group">
                            <?= Html::submitButton('<i class="fa fa-save"></i> Сохранить', ['class' => 'btn btn-sm bg-purple']); ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

