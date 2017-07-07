<?php

namespace app\modules\news\controllers\backend;

use app\modules\file\models\File;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\seo\models\Seo;
use app\modules\news\models\News;
use app\modules\news\models\backend\NewsSearch;

/**
 *
 * DefaultController implements the CRUD actions for News model.
 */
class DefaultController extends Controller
{

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
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
     * Updates an existing News model.
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
            if($model->image) {
                $model->image->delete();
            }
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Save models News and Seo
     * @param News $model
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
                $model->saveImage(File::PATH_NEWS);
                return true;
            }
        }
        return false;
    }

}
