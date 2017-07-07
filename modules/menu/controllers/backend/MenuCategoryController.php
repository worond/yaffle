<?php

namespace app\modules\menu\controllers\backend;

use app\modules\admin\components\AdminHelper;
use app\modules\file\models\File;
use app\modules\menu\models\MenuCategory;
use app\modules\menu\models\backend\MenuCategorySearch;
use Yii;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * MenuCategoryController implements the CRUD actions for MenuCategory model.
 */
class MenuCategoryController extends Controller
{
    /**
     * Lists all MenuCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuCategory model.
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
     * Creates a new MenuCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MenuCategory();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            $model->saveImage();
            if (isset($post['btn-save']) && $post['btn-save'] == 'stay') {
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MenuCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            $model->saveImage();
            if (isset($post['btn-save']) && $post['btn-save'] == 'stay') {
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MenuCategory model.
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
     * Finds the MenuCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}