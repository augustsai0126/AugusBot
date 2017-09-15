<?php
/**
 * Created by PhpStorm.
 * User: augus
 * Date: 2017/9/15
 * Time: 下午11:03
 */

namespace App\Services;


class LineMsgService
{
    private $line_bot;

    public function __construct()
    {
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('lineBot.token'));
        $this->line_bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('lineBot.ChannelSecret')]);
    }

    /**
     * 發送line的文字訊息
     *
     * @param $user
     * @param $msg
     * @return bool
     */
    public function sendMsg($user, $msg)
    {
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($msg);
        $response = $this->line_bot->replyMessage($user, $textMessageBuilder);

        echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
        return true;
    }
}