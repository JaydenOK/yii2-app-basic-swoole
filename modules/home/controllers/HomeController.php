<?php

namespace app\modules\home\controllers;

use app\modules\common\controllers\BaseController;
use app\modules\common\core\Api;
use app\modules\common\models\Account;
use app\modules\common\utils\ResponseUtil;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\JsonResponseFormatter;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class HomeController extends BaseController
{
    /**
     * yii2文档：过滤器
     * 过滤器-过滤器本质上是一类特殊的 行为， 所以使用过滤器和 使用行为一样。 可以在控制器类中覆盖它的 behaviors() 方法来声明过滤器，
     * 控制器类的过滤器默认应用到该类的 所有 动作， 你可以配置 only 属性明确指定控制器应用到哪些动作。 在上述例子中，HttpCache 过滤器只应用到 index 和 view 动作。 也可以配置 except 属性 使一些动作不执行过滤器。
     * 除了控制器外，可在 模块或应用主体 中申明过滤器。 申明之后，过滤器会应用到所属该模块或应用主体的 所有 控制器动作， 除非像上述一样配置过滤器的 only 和 except 属性。
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                //yii2文档：过滤器
                'class' => AccessControl::className(),
                //行为过滤器只应用到 only指定的动作
                'only' => ['null'],
                'rules' => [
                    [
                        'actions' => ['login', 'logout'],
                        'allow' => true,    //允许认证用户
                        'roles' => ['@'],
                    ],
                    // 默认禁止其他用
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
        $accountInfo = \Yii::$app->session->get(Account::LOGIN_KEY);
        if (!empty($accountInfo)) {
            //已登录，重定向
            if (Yii::$app->request->get('callback')) {
                $url = Yii::$app->request->get('callback');
            } else {
                $url = Url::to(['/index/index/index']);
            }
            return Yii::$app->getResponse()->redirect($url);
        }
        if (YII::$app->request->isAjax) {
            //执行登录
            $account = YII::$app->request->post('account');
            $password = YII::$app->request->post('password');
            $verCode = YII::$app->request->post('vercode');
            if (empty($account) || empty($password)) {
                return ['code' => 301, 'message' => '参数错误'];
            }
            $accountModel = new Account();
            $accountInfo = $accountModel->accountLogin($account, $password);
            if (!empty($accountInfo)) {
                return ResponseUtil::getOutputArrayByCodeAndData(Api::SUCCESS, $accountInfo);
            }
            return ResponseUtil::getOutputArrayByCodeAndMessage(Api::OPERATE_FAIL, '登入失败');
        } else {
            return $this->render('login', ['system' => Yii::$app->request->get('system'), 'callback' => Yii::$app->request->get('callback')]);
        }
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->remove(Account::LOGIN_KEY);
        $request = Yii::$app->request;
        $url = Url::to(['home/home/login']);
        print_r($url);
        exit;
        $url = Yii::$app->params['site']['system']['domain'] . $url;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ResponseUtil::getOutputArrayByCodeAndMessage(Api::SUCCESS, '退出成功');
        } else {
            return Yii::$app->getResponse()->redirect($url);
        }
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
