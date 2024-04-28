<?php
/**
 * 后台主界面
 */

namespace app\modules\index\controllers;

use app\modules\common\controllers\AuthController;
use yii\web\Controller;

class IndexController extends AuthController
{
    //默认方法
    public $defaultAction = 'index';

    public function actions()
    {

    }

    /**
     * 后台主界面
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    //默认后台首页内容
    public function actionIndexDefault()
    {
        return $this->render('indexDefault');
    }

    //test1
    public function actionHomepage1()
    {
        return $this->render('homepage1');
    }

    //test2
    public function actionHomepage2()
    {
        return $this->render('homepage2');
    }
}