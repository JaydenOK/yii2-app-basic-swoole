<?php

namespace app\modules\common\utils;

use app\core\lib\exception\Exception;
use app\core\lib\exception\InvalidValueException;
use app\modules\common\core\Language;

class ResponseUtil
{
    /**
     *
     * @param Exception $e
     * @return array
     */
    public static function getOutputArrayByException(Exception $e)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return static::getOutputArrayByCodeAndMessage($e->getCode(), $e->getMessage());
    }

    /**
     *
     * @param integer $code
     * @param string $message
     * @return array
     */
    public static function getOutputArrayByCodeAndMessage($code, $message)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'code' => $code,
            'message' => $message
        ];
    }

    /**
     * @param $code
     * @return array
     */
    public static function getOutputArrayByCode($code)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $message = \Yii::t('code/api', $code);
        return [
            'code' => $code,
            'message' => $message
        ];
    }

    /**
     * @param $code
     * @param $data
     * @return array
     */
    public static function getOutputArrayByCodeAndData($code, $data)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return array_merge(static::getOutputArrayByCode($code), ['data' => $data]);
    }

    /**
     * 自定义报错
     * @param $code
     * @param string $msg
     */
    public static function throwInvalidValueExceptionByCode($code, $msg = '')
    {
        $response = ResponseUtil::getOutputArrayByCode($code);
        $msg = empty($msg) ? $response['message'] : $msg;
        throw new InvalidValueException($msg, $response['code']);
    }
}