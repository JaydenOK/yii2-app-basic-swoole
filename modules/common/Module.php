<?php
/**
 * 公共模块
 */

namespace app\modules\common;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        //\Yii::configure($this, require __DIR__ . '/config.php');
    }
}