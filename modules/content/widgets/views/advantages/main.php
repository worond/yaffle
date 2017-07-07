<?php
/** @var $model \app\modules\content\models\Content */
use yii\helpers\Url;

?>
<div class="node-type-info__item" style="background-image: url(<?=Url::home()?><?= isset($model->contentValues[3]) ? $model->contentValues[3]->imageFile->fullName : ''; ?>);">
    <p class="node-type-info__item-text"><?= $model->contentValues[4]->value?></p>
</div>
