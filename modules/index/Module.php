<?php

namespace app\modules\index;

class Module extends \yii\base\Module
{
    //布局文件路径
    public $layoutPath = 'layouts';
    //布局文件名
    public $layout = 'layoutIndex';

    public function init()
    {
        parent::init();
        //\Yii::configure($this, require __DIR__ . '/config.php');
    }
}