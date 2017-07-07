<?php

namespace app\modules\content\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Content]].
 *
 * @see Content
 */
class ContentQuery extends ActiveQuery
{
    public function withAttributes()
    {
        $this->with([
            'contentValues' => function ($query) {
                $query->joinWith('field')->indexBy('field_id');
            }
        ]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return Content[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Content|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
