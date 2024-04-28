<?php

namespace app\modules\common\core;

class Language
{
    protected $lang = 'cn';

    public static function getMessage($code)
    {
        //$language = Config::get('language');
        $lang = 'cn';
        $message = include(APP_ROOT . DS . 'modules' . DS . 'common' . DS . 'core' . DS . 'languages' . DS . $lang . '.php');
        return $message[$code] ?? '';
    }
}