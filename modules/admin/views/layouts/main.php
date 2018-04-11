<?php

/* @var $this \yii\web\View
 * @var $content string */

use app\modules\content\models\Content;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\widgets\Menu;
use app\modules\admin\assets\AdminAsset;
use app\modules\admin\assets\AdminCustomAsset;

AdminAsset::register($this);
AdminCustomAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><?= Yii::$app->params['applicationNameShort'] ?></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?= Yii::$app->params['applicationName'] ?></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?= Url::toRoute(['/admin/default/logout']); ?>" title="Выход"><i
                                  class="fa fa-sign-out"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- sidebar menu: : style can be found in sidebar.less -->

                <?= Menu::widget(
                    [
                        'options' => ['class' => 'sidebar-menu'],
                        'items' => [
                            [
                                'label' => 'Структура сайта', 'icon' => 'fa fa-share-alt', 'url' => '#',
                                'items' => [
                                    ['label' => 'Страницы', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/page/default/index']],
                                    ['label' => 'Пункты меню', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/menu/menu/index']],
                                    ['label' => 'Типы меню', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/menu/menu-category/index']],
                                ]
                            ],
                            [
                                'label' => 'Контент', 'icon' => 'fa fa-gg', 'url' => '#',
                                'items' => [
                                    ['label' => 'Слайдер', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/slider/slider/index']],
                                    ['label' => 'Услуги', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/service/service/index']],
                                    ['label' => 'Разделы услуг', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/service/service-category/index']],
                                ]
                            ],
                            [
                                'label' => 'Справочники', 'icon' => 'fa fa-cubes', 'url' => '#',
                                'items' => Content::getContentTypeMenu(),
                            ],
                            [
                                'label' => 'Новости', 'icon' => 'fa fa-newspaper-o', 'url' => ['/admin/news/default/index']
                            ],
                            [
                                'label' => 'Контакты', 'icon' => 'fa fa-bookmark', 'url' => ['/admin/contact/default/index'],
                            ],
                            [
                                'label' => 'Заявки', 'icon' => 'fa fa-edit', 'url' => ['/admin/feedback/default/index'],
                            ],
                            [
                                'label' => 'Пользователи', 'icon' => 'fa fa-users', 'url' => ['/admin/user/user-profile/index'],
                            ],
                            [
                                'label' => 'Настройки', 'icon' => 'fa fa-gear', 'url' => '#',
                                'items' => [
                                    ['label' => 'Общие настройки', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/parameter/default/index']],
                                    ['label' => 'Сменить пароль', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/default/reset-password']],
                                    ['label' => 'Типы контента', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/content/content-type/index']],
                                    ['label' => 'Поля контента', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/content/content-field/index']],
                                ]
                            ],
                        ],
                    ]); ?>

            </section>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">

            <?= $content; ?>

        </div>

        <footer class="main-footer">
            <strong><?= Yii::$app->params['applicationName'];?> <?= date('Y'); ?>.</strong>
        </footer>

        <div class="control-sidebar-bg"></div>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>