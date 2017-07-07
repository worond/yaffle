<?php

namespace app\modules\feedback\controllers\frontend;

use app\modules\feedback\models\Feedback;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $answer = 'Ваша заявка потерялась. Пожалуйста, пропробуйте снова.';
        $model = new Feedback();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            if ($model->phone || $model->email) {
                $message =
                    '<h3>' . $model->subject . '!</h3>' .
                    '<table>' .
                    '<tr><td>Имя:</td ><td >' . $model->name . '</td ></tr >' .
                    '<tr><td>Телефон:</td ><td >' . $model->phone . '</td ></tr>' .
                    '<tr><td>E-mail:</td ><td >' . $model->email . '</td ></tr>' .
                    '<tr><td>Сообщение:</td ><td >' . $model->message . '</td ></tr>' .
                    '</table >';

                $result = Yii::$app->mailer->compose()
                    ->setTo(Yii::$app->params['global']['email'])
                    ->setSubject($model->subject)
                    ->setHtmlBody($message)
                    ->send();
                if ($result) {
                    $answer = 'Ваша заявка отправлена. Наш менеджер всяжеться свами в ближайшее время.';
                }
            } else {
                $answer = 'Пожалуйста, заполните телефон или e-mail.';
            }
        }
        return $answer;
    }

}