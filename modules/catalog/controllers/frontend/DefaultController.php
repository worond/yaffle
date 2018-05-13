<?php

namespace app\modules\catalog\controllers\frontend;

use yii\web\Controller;
use app\modules\catalog\models\Catalog;

/**
 *
 * DefaultController implements the CRUD actions for Catalog model.
 */
class DefaultController extends Controller
{
    public function actionIndex($id = false)
    {
        $catalog = Catalog::find()->where(['active' => 1])->orderBy(['created_at'=>SORT_DESC])->all();
        return $this->render('index', ['catalog' => $catalog, 'id' => $id]);

    }
}