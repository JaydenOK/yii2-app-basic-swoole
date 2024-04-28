<?php

namespace app\modules\home;

class Module extends \yii\base\Module
{

    public $layout = false;

    public function init()
    {
        parent::init();
        //\Yii::configure($this, require __DIR__ . '/config.php');
    }
}