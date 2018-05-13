<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\catalog\models\CatalogCategory;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\seo\models\Seo;
use app\modules\file\models\File;
use app\modules\catalog\models\backend\CatalogCategorySearch;

/**
 *
 * CatalogCategoryController implements the CRUD actions for catalog model.
 */
class CatalogCategoryController extends Controller
{

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Creates a new CatalogCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CatalogCategory();
        $seo = new Seo;
        $post = Yii::$app->request->post();

        if ($model->load($post) && $seo->load($post)) {
            if ($this->saveModels($model, $seo)) {
                if ($post['btn-save'] == 'stay') {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo,
        ]);
    }

    /**
     * Updates an existing CatalogCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!$seo = Seo::findOne($model->seo_id)) {
            $seo = new Seo();
        }
        $post = Yii::$app->request->post();

        if ($model->load($post) && $seo->load($post)) {
            if ($this->saveModels($model, $seo)) {
                if ($post['btn-save'] == 'stay') {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'seo' => $seo,
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
            if ($model->image) {
                $model->image->delete();
            }
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatalogCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Save models catalog and Seo
     * @param CatalogCategory $model
     * @param Seo $seo
     * @return bool
     */
    protected function saveModels(&$model, &$seo)
    {
        if ($model->validate() && $seo->validate()) {
            if (!empty($seo->title) || !empty($seo->description) || !empty($seo->keywords)) {
                $seo->save();
                $model->seo_id = $seo->id;
            }
            if ($model->save()) {
                $model->saveImage(File::PATH_CATEGORY);
                return true;
            }
        }
        return false;
    }

}
