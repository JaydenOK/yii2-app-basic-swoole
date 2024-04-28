<?php

namespace app\modules\common\models;

class Account extends BasicDbModel
{

    const LOGIN_KEY = 'login.key';

    const IS_NOT_DELETE = 0;
    const IS_DELETE = 1;

    public static function tableName()
    {
        return '{{account}}';
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'phone' => '电话',
        ];
    }

    public function accountLogin($account, $password)
    {
        $acc = self::findOne(['account' => $account, 'isDelete' => self::IS_NOT_DELETE]);
        if (empty($acc)) {
            return null;
        }
        if (password_verify($password, $acc['password'])) {
            $accountInfo = [
                'accountId' => $acc['accountId'],
                'account' => $acc['account'],
                'username' => $acc['username'],
                'status' => $acc['status'],
                'createTime' => $acc['createTime'],
                'lastLoginTime' => date('Y-m-d H:i:s'),
            ];
            \Yii::$app->session->set(self::LOGIN_KEY, $accountInfo);
            return true;
        } else {
            return false;
        }
    }

    public function register($account, $password)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'account' => $account,
            'password' => $password,
        ];
        $account = (new self())->save();
        return $account;
    }
}