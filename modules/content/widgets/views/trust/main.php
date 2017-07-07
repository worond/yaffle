<?php
/** @var $model \app\modules\content\models\Content */
use yii\helpers\Url;
?>
<div class="icon-block__icon" style="background-image: url(<?=Url::home()?><?= isset($model->contentValues[5]) ? $model->contentValues[5]->imageFile->fullName : ''; ?>);"></div>
