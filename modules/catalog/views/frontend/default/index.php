<?php
/* @var $this yii\web\View */
/* @var $news app\modules\news\models\News[] */
/* @var $id integer */
?>
<section class="news">
    <div class="wrap-content">
        <div class="page-content__top">
            <h1 class="page-content__title">Новости и акции</h1>
        </div>
        <div class="news__column">
            <?php foreach ($news as $item): ?>
                <div class="news__item<?= $item->id == $id ? ' active' : ''; ?>">
                    <div class="news__date"><?= Yii::$app->formatter->asDate($item->created, 'medium'); ?></div>
                    <div class="news__flex-wrapper">
                        <?php if($item->additional_image):?>
                        <div class="news__image">
                            <img src="<?=$item->additional_image;?>" alt="<?= $item->name; ?>">
                        </div>
                        <?php endif;?>
                        <div class="news__main">
                            <div class="news__title"><?= $item->title; ?></div>
                            <div class="news__text">
                                <?= $item->description; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
$script = <<< JS
    var destination = $('.news__item.active').offset().top - 20;
    jQuery("html:not(:animated),body:not(:animated)").animate({
      scrollTop: destination
    }, 800);
JS;

$this->registerJs($script, yii\web\View::POS_READY);