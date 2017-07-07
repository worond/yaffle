<?php

namespace app\modules\parameter\controllers\backend;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\modules\file\models\File;
use app\modules\parameter\models\Parameter;

/**
 * DefaultController implements the CRUD actions for Parameter model.
 */
class DefaultController extends Controller
{

    /**
     * Lists all Parameter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $post = Yii::$app->request->post();

        if ($post) {
            foreach ($post['Parameter'] as $id => $value) {
                $model = $this->findModel($id);
                $model->load(['Parameter' => $value]);

                $uploadedFile = UploadedFile::getInstance($model, "[{$id}]file");
                if ($uploadedFile) {
                    $name = $uploadedFile->name; // . '.' . $uploadedFile->extension;
                    $path = File::getPathsArray()[File::PATH_FILE] . $name;
                    $uploadedFile->saveAs($path);
                    $model->data = '/' . $path;
                }

                $model->save();
                $models[] = $model;
            }
        }

        $models = Parameter::find()->orderBy('position ASC')->all();

        return $this->render('index', [
            'parameters' => $models,
        ]);
    }

    /**
     * Displays a single Parameter model.
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
     * Creates a new Parameter model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parameter();
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->save()) {
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
     * Updates an existing Parameter model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Deletes an existing Parameter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Parameter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parameter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parameter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
