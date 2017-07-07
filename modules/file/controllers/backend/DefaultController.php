<?php

namespace app\modules\file\controllers\backend;

use Yii;
use yii\web\Controller;
use app\modules\file\models\File;

class DefaultController extends Controller
{
    public function actionUpload()
    {
        $path = false;
        $message = 'Ошибка загрузки файла.';
        if (is_uploaded_file($_FILES['upload']['tmp_name'])) {
            $extension = end(explode(".", $_FILES['upload']['name']));
            $imageName = Yii::$app->security->generateRandomString() . '.' . $extension;

            $file = new File();
            $file->name = $imageName;
            $file->path = File::PATH_IMAGE;
            $file->ext = $extension;
            $file->size = $_FILES['upload']["size"];

            if ($file->validate() && move_uploaded_file($_FILES['upload']['tmp_name'], $file->getRealPath() . $imageName)) {
                $file->save();
                $message = "Файл " . $_FILES['upload']['name'] . " загружен";
                $path = '/' . $file->getRealPath() . $imageName;
            }
        }
        $callback = $_REQUEST['CKEditorFuncNum'];
        return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("' . $callback . '", "' . $path . '", "' . $message . '" );</script>';
    }

    public function actionDelete($id, $redirect = null)
    {
        $model = File::findOne($id);
        $model->delete();

        if ($redirect) {
            return $this->redirect($redirect);
        }
        return $this->goHome();
    }

}