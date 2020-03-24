<?php

use Ramsey\Uuid\Uuid;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use App\Models\Merchant;
use App\Models\Project;

/**
 * 数组转json字符串(非json串)
 * @param $array
 * @return mixed
 */
function arrayValuesToJsonString($array)
{
    foreach ($array as $key => $val) {
        $array[$key] = (string)$val;
    }
    return $array;
}

/**
 * 解析异常信息
 * @param Exception $e
 * @return array
 */
function getExceptionMainInfo(Exception $e)
{
    return [
        "Code"    => $e->getCode(),
        "Message" => $e->getMessage(),
        "File"    => $e->getFile(),
        "Line"    => $e->getLine(),
    ];
}

/**
 * 记录日志
 * @param $logName
 * @return \Monolog\Logger
 */
function customerLoggerHandle($logName)
{
    $logName = $logName . "-" . exec('whoami');
    $log = new Logger($logName);
    $logFilePath = storage_path('logs') . "/" . $logName . ".log";
    $log->pushHandler(new RotatingFileHandler($logFilePath, 0, Logger::DEBUG));

    return $log;
}


/**
 * 金额 分转元
 * @param $fen
 * @return string
 */
function exchangeToYuan($fen)
{
    if ($fen == 0) {
        return 0;
    }
    return number_format($fen / 100, 2, ".", "");
}

/**
 * 金额 元转分
 * @param $yuan
 * @return string
 */
function exchangeToFen($yuan)
{
    if ($yuan == 0) {
        return 0;
    }
    return number_format($yuan * 100, 0, '.', '');
}

/**
 * 通用签名方法
 * @param array $data 签名数据
 * @param string $signKey 签名KEY
 * @return mixed
 */
function signServiceRequestData(array $data, string $signKey)
{
    unset($data['sign']);
    ksort($data);
    $sign = md5(customBuildQuery($data) . $signKey);

    return $sign;
}

/**
 * 签名字符串拼接
 * @param array $data
 * @return string
 */
function customBuildQuery(array $data)
{
    unset($data['sign']);
    ksort($data);
    $list = [];
    foreach ($data as $key => $value) {
        if (!is_null($value)) {
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            } elseif (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $list[] = $key . "=" . $value;
        }
    }

    customerLoggerHandle("sign")->debug("sign", [join("&", $list)]);

    return join("&", $list);
}

/**
 * @return string
 * @throws Exception
 */
function generateNewUuid()
{
    return Uuid::uuid4()->toString();
}


function getAppUserUuid()
{
    $userUuid = auth('api')->user()->getAuthIdentifier();
    return $userUuid;
}


function getRaiseSaleIndex($nowPrice, $topPrice)
{
    return 1000 + (($nowPrice / $topPrice) * 1000);
}

//本项目中商户的公司名称
 function getMerchantName($id)
{
    $merchantModel = Merchant::whereId($id)->first();
    return $merchantModel->company;
}

//本项目的相名称
function getProjectName($id)
{
    $merchantModel = Project::whereId($id)->first();
    return $merchantModel->project_name;
}

function getAliOssUrl()
{
    return 'http://yandu2019.oss-cn-beijing.aliyuncs.com/';
}

/**
 * 把字符串变成固定长度
 *
 * @param     $str
 * @param     $length
 * @param     $padString
 * @param int $padType
 * @return bool|string
 */
function fixStrLength($str, $length, $padString = '0', $padType = STR_PAD_LEFT)
{
    if (strlen($str) > $length) {
        return substr($str, strlen($str) - $length);
    } elseif (strlen($str) < $length) {
        return str_pad($str, $length, $padString, $padType);
    }

    return $str;
}