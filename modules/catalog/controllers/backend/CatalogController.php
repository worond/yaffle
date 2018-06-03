<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\catalog\models\CatalogImage;
use app\modules\file\models\File;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\seo\models\Seo;
use app\modules\catalog\models\Catalog;
use app\modules\catalog\models\backend\CatalogSearch;

/**
 *
 * CatalogController implements the CRUD actions for Catalog model.
 */
class CatalogController extends Controller
{

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new CatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Creates a new catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $model = new Catalog();
        $seo = new Seo;
        $image = new CatalogImage();

        if ($model->load($post) && $seo->load($post)) {
            if ($this->saveModels($model, $seo, $image)) {
                if ($post['btn-save'] == 'stay') {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'image' => $image,
            'seo' => $seo,
        ]);
    }

    /**
     * Updates an existing catalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $post = Yii::$app->request->post();
        $model = $this->findModel($id);
        if (!$seo = Seo::findOne($model->seo_id)) {
            $seo = new Seo();
        }
        $image = new CatalogImage();

        if ($model->load($post) && $seo->load($post)) {
            if ($this->saveModels($model, $seo, $image)) {
                if ($post['btn-save'] == 'stay') {
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'image' => $image,
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
            if($model->image) {
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
     * @return catalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = catalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Save models catalog and Seo
     * @param catalog $model
     * @param Seo $seo
     * @param CatalogImage $image
     * @return bool
     */
    protected function saveModels(&$model, &$seo, &$image)
    {
        if ($model->validate() && $seo->validate()) {
            if (!empty($seo->title) || !empty($seo->description) || !empty($seo->keywords)) {
                $seo->save();
                $model->seo_id = $seo->id;
            }
            if ($model->save()) {
                $model->saveImage(File::PATH_PRODUCT);
                $model->saveManyImages($image, $model->id);
                return true;
            }
        }
        return false;
    }

}
