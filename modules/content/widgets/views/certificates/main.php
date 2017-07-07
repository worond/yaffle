!<?php
/** @var $model \app\modules\content\models\Content */
use yii\helpers\Url;

?>
<a class="show-gallery__item zoom-img" href="<?=Url::home()?><?= isset($model->contentValues[6]) ? $model->contentValues[6]->imageFile->fullName : ''; ?>">
    <img class="show-gallery__item-img"
         src="<?=Url::home()?><?= isset($model->contentValues[6]) ? $model->contentValues[6]->imageFile->fullName : ''; ?>"
         alt="">
</a>
