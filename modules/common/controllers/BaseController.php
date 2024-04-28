<?php

namespace app\modules\common\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    //关闭csrf
    public $enableCsrfValidation = false;
    //登录账号信息
    public $accountInfo;

    public function init()
    {
        //yii2加入类变量 $request ， 在init函数中初始化，因此如果重写controller的init方法，必须执行 parent:init();
        parent::init();
        $request = Yii::$app->request;
        $cookie = $request->cookies;
        $sessionName = Yii::$app->components['session']['name'] ?? '';
        $session_id = $request->get('session_id');
        if ($cookie[$sessionName] != $session_id) {
            setcookie($sessionName, $session_id, null, '/');
        }
    }

    public function _error($message = '您的操作出现错误！', $name = '出错啦！')
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return ['status' => 0, 'info' => $message];
        } else {
            return $this->render('@common/views/error.php', ['name' => $name, 'message' => $message]);
        }
    }

    public function _success($message = '操作成功！', $name = '')
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return ['status' => 1, 'info' => $message];
        } else {
            // 注意，这个还没页面，还没用上
            return $this->render('@system/views/site/success.php', ['name' => $name, 'message' => $message]);
        }
    }


    //错误返回的信息
    public function error($data, $msg = '')
    {
        Yii::$app->response->format = 'json';
        return ['status' => 0, 'data' => $data, 'info' => $msg];
    }


    //成功返回的提示信息
    public function success($data, $msg = '')
    {
        Yii::$app->response->format = 'json';
        return ['status' => 1, 'data' => $data, 'info' => $msg];
    }

    /*
     * 导出csv表格
     * @param1 $fileName 下载csv文件名称
     * @param2 $head array 一维数组，表格标题
     * @param3 $data array 二维数组，表格数据内容
     * @param4 $itemBeforeCallback callback 回调函数，处理每行表格数据前执行 function($item){}  $item每行数据（$data的每行数据）
     */
    public function exportCsv($fileName, $head, $data, $itemBeforeCallback = null)
    {
        self::csvHeader($fileName);
        self::csvContent($head, $data, $itemBeforeCallback);
    }

    public static function csvHeader($fileName)
    {
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Type: application/vnd.ms-excel");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename={$fileName}.csv");
        header("Content-Transfer-Encoding: binary");
    }

    public static function csvContent($head, $data, $itemBeforeCallback = null, $return = false)
    {
        if ($return) {
            ob_start();
        }
        echo self::dealCsvRow($head);
        if (isset($data) && is_array($data)) {
            $headKeys = array_keys($head);
            if (is_numeric(implode('', $headKeys))) {
                $headKeys = null;
            }
            foreach ($data as $item) {
                echo self::dealCsvRow($item, $headKeys, $itemBeforeCallback);
            }
        }
        if ($return) {
            $content = ob_get_clean();
            return $content;
        }
    }

    /*
     * 按csv格式处理每行数据，主要转义和拼接字符串
     * @param1 $row 一维数组
     * @params2 $headKeys 一维数组,以此数组为键值组装新的行数据
     * @param3 $itemBeforeCallback callback 回调函数，处理数据前执行 function($row){}
     * return string 返回csv格式数据字符串
     */
    public static function dealCsvRow($row, $headKeys = null, $itemBeforeCallback = null)
    {
        if (is_callable($itemBeforeCallback)) {
            $row = call_user_func($itemBeforeCallback, $row);
        }
        if (isset($headKeys) && is_array($headKeys)) {
            $newRow = [];
            foreach ($headKeys as $headKey) {
                $newRow[] = isset($row[$headKey]) ? str_replace('"', '""', $row[$headKey]) : '';
            }
        } else {
            $newRow = array_map(function ($n) {
                return str_replace('"', '""', $n);
            }, $row);
        }
        return '"' . implode('","', $newRow) . '"' . "\n";
    }
}