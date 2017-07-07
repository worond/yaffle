<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\user\models\backend\forms\PasswordResetForm;
use app\modules\user\models\backend\forms\LoginForm;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->goHome();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Resets password.
     * @return mixed
     */
    public function actionResetPassword()
    {
        $model = new PasswordResetForm();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('modules/user/messages', 'The new password was saved.'));
        }

        return $this->render('resetPassword', ['model' => $model]);
    }

}
