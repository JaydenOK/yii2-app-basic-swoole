<?php

namespace app\modules\common\core;

/**
 * 错误码
 * Class Api
 */
class Api
{
    const SUCCESS = 200;

    const PARAM_ERROR = 401;
    const PARAM_MISSING = 402;
    const PARAM_CAN_NOT_EMPTY = 403;
    const RECORD_NOT_EXISTS = 404;
    const OPERATE_FAIL = 405;

    const SYSTEM_EXCEPTION = 500;
    const SYSTEM_BUSY = 501;
}