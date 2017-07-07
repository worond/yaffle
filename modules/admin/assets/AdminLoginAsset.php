<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AdminLoginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';

    public $css = [
        'bootstrap/css/bootstrap.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'dist/css/AdminLTE.min.css',
        'plugins/iCheck/square/blue.css',
    ];
    public $js = [
        'plugins/jQuery/jquery-2.2.3.min.js',
        'bootstrap/js/bootstrap.min.js',
        'plugins/iCheck/icheck.min.js',
    ];

    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);

        $manager = $view->getAssetManager();
        $view->registerJsFile(
            $manager->getAssetUrl($this, '//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'),
            ['condition' => 'lte IE9', 'position' => View::POS_HEAD]
        );
        $view->registerJsFile(
            $manager->getAssetUrl($this, '//oss.maxcdn.com/respond/1.4.2/respond.min.js'),
            ['condition' => 'lte IE9', 'position' =>View::POS_HEAD]
        );

        $script = <<< JS
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
JS;
        $view->registerJs($script, View::POS_END);
    }
}
