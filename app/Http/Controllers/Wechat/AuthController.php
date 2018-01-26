<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\WechatUser;
use Auth;
use App\Models\AppPay;
use App\Models\User;
use EasyWeChat\Foundation\Application;
use WeChat;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        if (!isset($request->state)) return false;
        $paramsArr = $this->parseParams($request->state);
        if (empty($paramsArr)) return false;
        $config = config('wechat');
        $app = new Application($config);
        $oauth = $app->oauth;
        $user = $oauth->user();
        $openid = $user->id;


        //获取openid
        if (isset($paramsArr['type']) && strtolower($paramsArr['type']) == 'zhima') {
            $url = isset($paramsArr['redirect_url']) ? $paramsArr['redirect_url'] : '';
            if (!empty($openid)) {
                $url = $url . 'openid=' . $openid;
            }
            return redirect($url);
        }

        //授权获取信息
        if (isset($paramsArr['type']) && strtolower($paramsArr['type']) == 'zhima_userinfo') {
            $url = isset($paramsArr['redirect_url']) ? $paramsArr['redirect_url'] : '';
            $openid = isset($openid) ? $openid : '';
            $imgurl = isset($user->original['headimgurl']) ? $user->original['headimgurl'] : '';
            $nickname = isset($user->original['nickname']) ? $user->original['nickname'] : '';
            $params = http_build_query(compact('openid', 'imgurl', 'nickname'));
            if (!empty($openid)) {
                $url = $url . $params;
            }

            return redirect($url);
        }
    }


    public function parseParams($state)
    {
        $arr = [];
        $state = base64_decode($state);
        $stateArr = explode('|', $state);
        foreach ($stateArr as $v) {
            $v = explode('=', $v, 2);
            $arr[$v[0]] = $v[1];
        }
        return $arr;
    }
}

?>