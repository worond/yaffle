<?php

namespace app\modules\news\controllers\frontend;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\news\models\News;
use app\modules\news\models\NewsSearch;

/**
 *
 * DefaultController implements the CRUD actions for News model.
 */
class DefaultController extends Controller
{
    public function actionIndex($id = false)
    {
        $news = News::find()->where(['active' => 1])->orderBy(['created'=>SORT_DESC])->all();
        return $this->render('index', ['news' => $news, 'id' => $id]);

    }
}