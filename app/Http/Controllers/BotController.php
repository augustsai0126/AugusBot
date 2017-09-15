<?php
/**
 * Created by PhpStorm.
 * User: augus
 * Date: 2017/9/6
 * Time: 下午1:20
 */

namespace App\Http\Controllers;


use App\Services\LineMsgService;
use Illuminate\Http\Request;

class BotController extends Controller
{
    protected $lineMsgService;

    public function __construct(LineMsgService $lineMsgService)
    {
        $this->lineMsgService = $lineMsgService;
    }

    /**
     * 接收訊息，如果為文字訊息，回傳一樣的訊息
     *
     * @param Request $request
     * @return bool
     */
    public function getMsg(Request $request)
    {
        $line_msg = $request->input('events')[0];
        $msg_type = $line_msg['type'];

        if ($msg_type == 'message') {
            $line_user = $line_msg['replyToken'];
            $msg_content = $line_msg['message']['text'];
            $this->lineMsgService->sendMsg($line_user, $msg_content);
        }

        return true;
    }
}