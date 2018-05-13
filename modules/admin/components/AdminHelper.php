<?php

namespace app\modules\admin\components;

trait AdminHelper
{
    /**
     * @return array
     * @internal param $model
     */
    public static function getList()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }

    /**
     * @param integer|null $root
     * @param string $indent
     * @return array
     */
    public static function getTree($root = NULL, $indent = '')
    {
        $children_indent = $indent . "--";
        $tree = [];

        $models = self::find()->select(['name', 'id'])->where(['parent_id' => $root])->indexBy('id')->column();

        foreach ($models as $model_id => $model_name) {
            $tree[$model_id] = $indent . $model_name;
            $children = self::getTree($model_id, $children_indent);
            if (!empty($children)) {
                $tree += $children;
            }
        }

        return $tree;
    }
}
