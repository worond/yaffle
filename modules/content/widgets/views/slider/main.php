<?php
/** @var $model \app\modules\content\models\Content */

?>
<div class="main-slide"
     style="background-image: url(<?= isset($model->contentValues[2]) ? $model->contentValues[2]->imageFile->fullName : ''; ?>);"
     data-key="<?= $model->id; ?>">
    <div class="mobile-logo">
        <img class="mobile-logo__img" src="/img/svg/logo.svg" alt="<?= $model->contentValues[1]->value; ?>" width="111">
    </div>
    <p class="main-slide__text" data-text><?= $model->contentValues[1]->value; ?></p>
</div>