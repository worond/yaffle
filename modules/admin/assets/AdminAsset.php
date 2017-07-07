<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AdminAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';

    public $css = [
        'bootstrap/css/bootstrap.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'dist/css/AdminLTE.min.css',
        'dist/css/skins/_all-skins.min.css',
        //'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    ];

    public $js = [
        'bootstrap/js/bootstrap.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/fastclick/fastclick.js',
        'plugins/ckeditor/ckeditor.js',
        'dist/js/app.min.js',
        'dist/js/demo.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'app\modules\admin\assets\AdminCustomAsset',
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
            ['condition' => 'lte IE9', 'position' => View::POS_HEAD]
        );

        $script = <<< JS
CKEDITOR.replaceAll(function(textarea,config) {
    if(textarea.className == "ckeditor-custom")
    {
        config.extraPlugins = 'image';
        
        config.toolbarGroups = [
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
            { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
            { name: 'links' },
            { name: 'insert' },
            { name: 'forms' },
            { name: 'tools' },
            { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
            { name: 'others' },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
            { name: 'styles' },
            { name: 'colors' }
        ];
        config.filebrowserUploadUrl = '/uploader/upload.php';
        config.filebrowserImageUploadUrl = '/uploader/upload.php?type=Images';
        
        //config.filebrowserUploadUrl = '/ckeditorFileUploadPrc.do?filekey=111';
        config.format_tags = 'p;div;h1;h2;h3;h4;pre';
        config.allowedContent = true;
        return true;
    } else {
        return false;
    }
    
});
CKEDITOR.dialog.add( 'uploadbutton', function( editor ) {
		return imageDialog( editor, 'uploadbutton' );
} );
JS;
        $view->registerJs($script, View::POS_END);
    }
}
