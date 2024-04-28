<?php

namespace app\modules\common\models;

use yii\db\ActiveRecord;

class OmsDbModel extends ActiveRecord
{
    /**
     * @return object|\yii\db\Connection|null
     * @throws \yii\base\InvalidConfigException
     */
    public static function getDb()
    {
        return \Yii::$app->get('oms');
    }
}