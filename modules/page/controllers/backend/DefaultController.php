<?php

namespace app\modules\page\controllers\backend;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\modules\seo\models\Seo;
use app\modules\page\models\Page;
use app\modules\file\models\File;


/**
 * DefaultController implements the CRUD actions for Page model.
 */
class DefaultController extends Controller
{

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $pageTree = Page::getPageTree();
        $defaultSeo = Seo::findOne(1);
        if($defaultSeo->load(Yii::$app->request->post())){
            if($defaultSeo->save()){
                Yii::$app->getSession()->setFlash('success', 'Метатеги успешно сохранены.');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Не удалось сохранить метатеги.');
            }
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'pageTree' => $pageTree,
            'defaultSeo' => $defaultSeo
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $model = new Page;
        $seo = new Seo;

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
     * Updates an existing Page model.
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
            if($model->seo) {
                $model->seo->delete();
            }
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Save models Page and Seo
     * @param Page $model
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
                $model->saveImage();
                return true;
            }
        }
        return false;
    }
}
