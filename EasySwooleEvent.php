<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;


use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Whoops\Runner;
use Whoops\Handler\PrettyPageHandler;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        date_default_timezone_set('Asia/Shanghai');
    }

    public static function mainServerCreate(EventRegister $register)
    {
        $socketConf = new \EasySwoole\Socket\Config();
        $socketConf->setType($socketConf::WEB_SOCKET);
        $socketConf->setParser();
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }

    public function frameInitialize(): void
    {
        // 可以进行更多设置，默认为以下设置
        $options = [
            'auto_conversion' => true,                    // 开启AJAX模式下自动转换为JSON输出
            'detailed'        => true,                    // 开启详细错误日志输出
            'information'     => '发生内部错误,请稍后再试'   // 不开启详细输出的情况下 输出的提示文本
        ];
        $whoops  = new Runner($options);
        // 注册异常事件处理
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }
}