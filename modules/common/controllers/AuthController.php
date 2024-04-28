<?php

namespace app\modules\common\controllers;

use app\modules\common\models\Account;
use Yii;
use yii\helpers\Url;

class AuthController extends BaseController
{
    public function init()
    {
        parent::init();
        $session = Yii::$app->session;
        $accountInfo = $session->get(Account::LOGIN_KEY);
        // 判断登录
        if (empty($accountInfo)) {
            $callback = Yii::$app->request->getAbsoluteUrl();
            $url = Url::to(['/home/home/login', 'system' => 'basic', 'callback' => $callback]);
            $url = Yii::$app->params['site']['system']['domain'] . $url;
            Yii::$app->getResponse()->redirect($url)->send();
            exit(0);
        }
        // 定义常量 USER_ID  IS_ADMIN 超管权限
        $isAdmin = ($accountInfo['accountId'] == 1);
        define('IS_ADMIN', $isAdmin);
        define('USER_ID', $accountInfo['accountId']);
        define('USERNAME', $accountInfo['username']);
        //设置语言包
        Yii::$app->language = !empty($session->get('language')) ? $session->get('language') : 'zh-CN';
        // 判断用户权限
        $route = Yii::$app->requestedRoute;
        empty($route) && $route = Yii::$app->defaultRoute;
        //不需要权限的操作
        $publicAction = [
            'home/home/login',
        ];
        if (!IS_ADMIN && !in_array($route, $publicAction)) {
            $url = Yii::$app->id . '/' . Yii::$app->requestedRoute;
            $url = strtoupper($url);
            $session = Yii::$app->session;
            $auth = $session->get('auth');
            if (!in_array($url, $auth)) {
                $ret = $this->_error('您没有权限访问该操作!', '无权限');
                echo $ret;
                die;
            }
        }
        $this->accountInfo = $accountInfo;
    }
}