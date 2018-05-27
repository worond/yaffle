<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\catalog\models\CatalogPropertyType;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\seo\models\Seo;
use app\modules\file\models\File;
use app\modules\catalog\models\backend\CatalogPropertyTypeSearch;

/**
 *
 * CatalogPropertyTypeController implements the CRUD actions for catalog model.
 */
class CatalogPropertyTypeController extends Controller
{

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogPropertyTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Creates a new CatalogPropertyType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CatalogPropertyType();
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->validate() && $model->save()) {
                if ($post['btn-save'] == 'stay') {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CatalogPropertyType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->validate() && $model->save()) {
                if ($post['btn-save'] == 'stay') {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($model = $this->findModel($id)) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogPropertyType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatalogPropertyType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
