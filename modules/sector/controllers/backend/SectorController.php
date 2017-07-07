<?php

namespace app\modules\sector\controllers\backend;

use app\modules\seo\models\Seo;
use app\modules\file\models\File;
use app\modules\sector\models\Sector;
use app\modules\sector\models\SectorImage;
use app\modules\sector\models\backend\SectorSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * SectorController implements the CRUD actions for Sector model.
 */
class SectorController extends Controller
{
    /**
     * Lists all Sector models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SectorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sector model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $model = new Sector();
        $seo = new Seo();
        $image = new SectorImage();

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
            'seo' => $seo,
            'image' => $image,
        ]);
    }

    /**
     * Updates an existing Sector model.
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
        $image = new SectorImage();

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
            'seo' => $seo,
            'image' => $image,
        ]);
    }

    /**
     * Deletes an existing Sector model.
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
            if ($model->icon) {
                $model->icon->delete();
            }
            if ($model->thumbnail) {
                $model->thumbnail->delete();
            }
            if ($model->seo) {
                $model->seo->delete();
            }
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sector::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Save models Sector and Seo
     * @param Sector $model
     * @param Seo $seo
     * @param SectorImage $image
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
                $model->saveImage();
                $model->saveImage(File::PATH_IMAGE, null, null, true, 'iconFile', 'icon_id');
                $model->saveImage(File::PATH_IMAGE, null, null, true, 'thumbnailFile', 'thumbnail_id');
                $model->saveManyImages($image, $model->id);
                return true;
            }
        }
        return false;
    }
}