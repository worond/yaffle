<?php

namespace app\modules\user\controllers\backend;

use app\modules\user\models\backend\forms\SignupForm;
use app\modules\user\models\backend\UserSearch;
use app\modules\user\models\User;
use app\modules\user\models\UserProfile;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserProfileController extends Controller
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = new SignupForm();
        $profile = new UserProfile();
        $post = Yii::$app->request->post();


        if ($user->load($post) && $profile->load($post)) {
            if ($user = $user->signup()) {
                if (!empty($post['User']['roles'])) {
                    $user->setRoles($post['User']['roles']);
                }
                $profile->user_id = $user->id;
                if ($profile->save()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $user, 'profile' => $profile
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $profile = $this->findProfile($id);
        $post = Yii::$app->request->post();

        if (!isset($profile)) $profile = new Profile();

        if ($model->load($post) && $profile->load($post)) {
            $profile->user_id = $model->id;
            $profile->save();
            $model->save();
        }

        return $this->render('update', [
            'model' => $model, 'profile' => $profile
        ]);
    }

    public function actionResetPassword($id)
    {
        $model = $this->findModel($id);
        if ($this->Send($model)) {
            Yii::$app->session->setFlash('message', "Новый пароль выслан на указанный e-mail");
        } else {
            Yii::$app->session->setFlash('message', "Ошибка");
        }
        return $this->redirect(['update', 'id' => $id]);
    }

    public function Send(User $model)
    {
        if (isset($model)) {
            $password = Yii::$app->getSecurity()->generateRandomString(8);
            $message =
                '<h3>Новый пароль!</h3>' .
                '<table>' .
                '<tr><td>Логин:</td ><td >' . $model->username . '</td ></tr >' .
                '<tr><td>Пароль:</td ><td >' . $password . '</td ></tr>' .
                '</table >';

            $result = Yii::$app->mailer->compose()
                ->setTo($model->email)
                ->setSubject('Новый пароль')
                ->setHtmlBody($message)
                ->send();

            if ($result) {
                $model->setPassword($password);
                $model->save();

                return true;
            }
        }

        return false;
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }
    }

    protected function findProfile($id)
    {
        if (($model = UserProfile::find()->where(['user_id' => $id])->one()) === null) {
            $model = new UserProfile();
        }
        return $model;
    }
}
