<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AdminCustomAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/source';
    public $publishOptions = [
        'forceCopy' => true
    ];

    public $css = [
        'css/admin.css',
    ];

    public $js = [
        'js/admin.js',
    ];

}
