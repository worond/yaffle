<?php

namespace app\modules\content\controllers\backend;

use app\modules\content\models\ContentType;
use app\modules\content\models\ContentValue;
use app\modules\file\models\File;
use Yii;
use app\modules\content\models\Content;
use app\modules\content\models\backend\ContentSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentController extends Controller
{
    /**
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex()
    {
        $title = null;
        $searchModel = new ContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->request->get('content_type_id'));
        $model = ContentType::find()->where(['id' => Yii::$app->request->get('content_type_id')])->one();
        if(isset($model))
        $title = $model->name;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title
        ]);
    }

    /**
     * Displays a single Content model.
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
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Content();
        $content_type_id = Yii::$app->request->get('content_type_id');
        /** @var ContentType $content_type */
        $content_type = ContentType::find()->where(['id' => $content_type_id])->one();
        $post = Yii::$app->request->post();

        if ($content_type) {
            $model->content_type_id = $content_type->id;
            $values = $model->initValues();

            if ($model->load($post) && $model->save() && Model::loadMultiple($values, $post)) {
                $model->processValues($values);
                if ($post['btn-save'] == 'stay') {
                    return $this->redirect(['update', 'id' => $model->id, 'content_type_id' => $model->content_type_id]);
                } else {
                    return $this->redirect(['index', 'content_type_id' => $model->content_type_id]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'values' => $values,
                ]);
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Тип контента не найден.');
            return $this->redirect('index');
        }
    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $values = $model->initValues();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save() && Model::loadMultiple($values, $post)) {
            //die('<pre>'.var_export($_FILES.'</pre>');
            //die('<pre>'.var_export($values,1).'</pre>');
            $model->processValues($values);
            if ($post['btn-save'] == 'stay') {
                return $this->redirect(['update', 'id' => $model->id, 'content_type_id' => $model->content_type_id]);
            } else {
                return $this->redirect(['index', 'content_type_id' => $model->content_type_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'values' => $values,
            ]);
        }
    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id, $file_id)
    {
        $file = File::find()->where(['id' => $file_id])->one();
        $file->delete();

        $model = ContentValue::find()->where(['content_id'=>$id,'value'=>$file_id])->one();
        $model->delete();

        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
