<?php

namespace app\modules\user\controllers;

use yii\web\Controller;

class UserController extends Controller
{
    public function actions()
    {

    }

    //http://basic.cc/user/user/info
    public function actionInfo()
    {
        return 'user info';
    }

}