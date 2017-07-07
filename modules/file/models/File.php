<?php

namespace app\modules\file\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $path
 * @property string $ext
 * @property integer $size
 * @property integer $width
 * @property integer $height
 * @property string $alt
 * @property integer $created_at
 *
 * @property string $fullName
 * @property mixed $realPath
 * @property string $src
 */
class File extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $file;

    const PATH_IMAGE = 0;
    const PATH_PRODUCT = 1;
    const PATH_BRAND = 2;
    const PATH_CATEGORY = 3;
    const PATH_FILE = 4;
    const PATH_NEWS = 5;
    const PATH_OTHER = 6;

    public static function getPathsArray()
    {
        return [
            self::PATH_IMAGE => 'upload/image/',
            self::PATH_PRODUCT => 'upload/product/',
            self::PATH_BRAND => 'upload/brand/',
            self::PATH_CATEGORY => 'upload/category/',
            self::PATH_FILE => 'upload/file/',
            self::PATH_NEWS => 'upload/news/',
            self::PATH_OTHER => 'upload/other/',
        ];
    }

    public function getRealPath()
    {
        return ArrayHelper::getValue(self::getPathsArray(), $this->path);
    }

    public function getFullName()
    {
        return ArrayHelper::getValue(self::getPathsArray(), $this->path) . $this->name;
    }

    public function getSrc()
    {
        return '/' . ArrayHelper::getValue(self::getPathsArray(), $this->path) . $this->name;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['size', 'width', 'height', 'path','created_at'], 'integer'],
            [['name', 'ext', 'alt'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'path' => 'Path',
            'ext' => 'Ext',
            'size' => 'Size',
            'width' => 'Width',
            'height' => 'Height',
            'alt' => 'Alt',
            'created' => 'Created',
        ];
    }

    public function deleteFile()
    {
        $file = $this->fullName;
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function beforeDelete()
    {
        $this->deleteFile();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        $this->created_at = mktime();
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
