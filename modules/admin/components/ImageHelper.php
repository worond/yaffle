<?php

namespace app\modules\admin\components;

use app\modules\file\models\File;
use Exception;
use Imagine\Image\Box;
use Yii;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\web\UploadedFile;

trait ImageHelper
{
    public function saveImage($imagePath = File::PATH_IMAGE, $width = null, $height = null, $saveAnyway = false, $imageField = 'imageFile', $tableField = 'image_id')
    {
        /** @var ActiveRecord $this */
        $uploadedImage = UploadedFile::getInstance($this, $imageField);

        if ($uploadedImage) {
            $path = File::getPathsArray()[$imagePath];
            $imageName = $this::generateName($path, $uploadedImage->extension);
            $image = Image::getImagine()->open($uploadedImage->tempName);
            $sizeImage = $image->getSize();

            if (intval($width) <= $sizeImage->getWidth() && intval($height) <= $sizeImage->getHeight()) {
                if (intval($width) !== 0 && intval($height) !== 0) {
                    $newSize = new Box($width, $height);
                } elseif (intval($width) !== 0 && intval($height) === 0) {
                    $newSize = $sizeImage->widen($width);
                } elseif (intval($width) === 0 && intval($height) !== 0) {
                    $newSize = $sizeImage->heighten($height);
                } else {
                    $newSize = new Box($sizeImage->getWidth(), $sizeImage->getHeight());
                }
                $image->resize($newSize);
            } elseif (!$saveAnyway) {
                return 'Error: The image is smaller than the minimum resolution.';
            }
            try {
                $image->save($path . $imageName);
            } catch (Exception $e) {
                return 'Error: ' . $e->getMessage();
            }

            if ($this->$tableField) {
                $file = File::findOne($this->$tableField);
                $file->delete();
            }

            $file = new File();
            $file->name = $imageName;
            $file->path = $imagePath;
            $file->ext = $uploadedImage->extension;
            $file->size = $uploadedImage->size;
            $file->width = $image->getSize()->getWidth();
            $file->height = $image->getSize()->getHeight();
            if ($file->validate() && $file->save()) {
                $this->$tableField = $file->id;
                if ($this->save()) {
                    return true;
                }
            }

            return 'Error: The image saved, but not added to database.';
        }

        return false;
    }

    public function saveManyImages($model, $imagePath = File::PATH_IMAGE, $width = null, $height = null, $saveAnyway = false, $imageField = 'imageFile', $modelAttributes = false)
    {
        $className = get_class($model);

        $uploadedImages = UploadedFile::getInstances($model, $imageField);

        if (!empty($uploadedImages)) {
            foreach ($uploadedImages as $uploadedImage) {
                $path = File::getPathsArray()[$imagePath];
                $imageName = $this::generateName($path, $uploadedImage->extension);
                $image = Image::getImagine()->open($uploadedImage->tempName);
                $sizeImage = $image->getSize();

                if (intval($width) <= $sizeImage->getWidth() && intval($height) <= $sizeImage->getHeight()) {
                    if (intval($width) !== 0 && intval($height) !== 0) {
                        $newSize = new Box($width, $height);
                    } elseif (intval($width) !== 0 && intval($height) === 0) {
                        $newSize = $sizeImage->widen($width);
                    } elseif (intval($width) === 0 && intval($height) !== 0) {
                        $newSize = $sizeImage->heighten($height);
                    } else {
                        $newSize = new Box($sizeImage->getWidth(), $sizeImage->getHeight());
                    }
                    $image->resize($newSize);
                } elseif (!$saveAnyway) {
                    return 'Error: The image is smaller than the minimum resolution.';
                }

                try {
                    $image->save($path . $imageName);
                } catch (Exception $e) {
                    return 'Error: ' . $e->getMessage();
                }

                /** @var ActiveRecord $model */
                $model = new $className;
                $file = new File();

                $file->name = $imageName;
                $file->path = $imagePath;
                $file->ext = $uploadedImage->extension;
                $file->size = $uploadedImage->size;
                $file->width = $image->getSize()->getWidth();
                $file->height = $image->getSize()->getHeight();
                if ($file->validate() && $file->save()) {
                    if ($modelAttributes === false) {
                        $modelAttributes = array_keys($model->attributes);
                    }
                    $model->{$modelAttributes[0]} = $this->id;
                    $model->{$modelAttributes[1]} = $file->id;
                    if (!$model->save()) {
                        return 'Error: The image saved, but not added to database.';
                    }
                }
            }
            return true;
        }
        return false;
    }

    public function saveManyFiles($model, $filePath = File::PATH_FILE, $fileField = 'uploadFile', $modelAttributes = false)
    {
        $className = get_class($model);
        $uploadedFiles = UploadedFile::getInstances($model, $fileField);

        if (!empty($uploadedFiles)) {
            foreach ($uploadedFiles as $uploadedFile) {

                $path = File::getPathsArray()[$filePath];
                $fileName = $this::generateName($path, $uploadedFile->extension);

                try {
                    $uploadedFile->saveAs($path . $fileName);
                } catch (Exception $e) {
                    return 'Error: ' . $e->getMessage();
                }

                /** @var ActiveRecord $model */
                $model = new $className;
                $file = new File();

                $file->name = $fileName;
                $file->path = $filePath;
                $file->ext = $uploadedFile->extension;
                $file->size = $uploadedFile->size;
                $file->title = $uploadedFile->name;

                if ($file->validate() && $file->save()) {
                    if ($modelAttributes === false) {
                        $modelAttributes = array_keys($model->attributes);
                    }
                    $model->{$modelAttributes[0]} = $this->id;
                    $model->{$modelAttributes[1]} = $file->id;
                    if (!$model->save()) {
                        return 'Error: The file saved, but not added to database.';
                    }
                }
            }
            return true;
        }
        return false;
    }

    public function generateName($path, $extension)
    {
        $i = 0;
        $length = 24;
        do {
            $name = Yii::$app->security->generateRandomString($length) . '.' . $extension;
            if ($i++ % 10 === 0) $length++;
        } while (file_exists($path . $name));
        return $name;
    }
}
