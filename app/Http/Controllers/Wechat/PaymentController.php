<?php

namespace App\Http\Controllers\Wechat;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use App\Models\WechatOrder;
use App\Models\AppPay;

class PaymentController extends Controller
{
    const NOTIFY_URL = 'https://www.hotapp.cn/wechat/payment/';
    const TEST_NOTIFY_URL = 'http://test.hotapp.cn/wechat/payment/';
    const ORDER_CRYPT_SALT = 'hotapp-wechat-user-order'; //生成订单id 的混淆字串

    public function index()
    {
        $config = config('wechat');
        $app = new Application($config);
        $response = $app->payment->handleNotify(function ($notify, $successful) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = WechatOrder::where('out_trade_no', $notify->out_trade_no)->first();
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 检查订单是否已经更新过支付状态
            if ($order->paid_at) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 'paid';
            } else { // 用户支付失败
                $order->status = 'paid_fail';
            }
            $order->save(); // 保存订单
            //清空修改次数
            $user = User::where('_id',$order->user_id)->first();
            $user->setModifiedTimes();
//            if (!empty($order->app_id)) {
//                //(new AppPay)->edit(['_id' => $order->app_id], ['modified_times' => 0]);
//            }
            return true; // 返回处理完成
        });
        return $response;
    }

    public function submitOrder($product, $openid)
    {
        $config = config('wechat');
        $app = new Application($config);

        $product = $this->setProduct($product, $openid);
        $order = new Order($product);
        $payment = $app->payment;
        // 这里的order是上面一步得来的。 这个prepare()帮你计算了校验码，帮你获取了prepareId.省心。
        $result = $payment->prepare($order);
        $prepayId = null;
        if ($result->return_code == 'SUCCESS') {
            // 这个很重要。有了这个才能调用支付。
            $prepayId = $result->prepay_id;
        } else {
            return ['res' => 1, 'data' => $result];
        }
        $config = $payment->configForJSSDKPayment($prepayId); // 这个方法是取得js里支付所必须的参数用的。 没这个啥也做不了，除非你自己把js的参数生成一遍
        return ['res' => 0, 'data' => $config];
    }

    //设置订单
    protected function setProduct($data, $openid)
    {
        $out_trade_no = $this->createOrder($data);
        $product = [
            'trade_type' => 'JSAPI', // 微信公众号支付填JSAPI
            'body' => $data['body'],
            'detail' => $data['detail'],
            'out_trade_no' => $out_trade_no, // 这是自己ERP系统里的订单ID，不重复就行。
            'total_fee' => $data['total_fee'], // 金额，这里的8888分人民币。单位只能是分。
            'notify_url' => !env('APP_DEBUG')?self::NOTIFY_URL:self::TEST_NOTIFY_URL, // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid' => $openid,
        ];
        return $product;
    }

    protected function createOrder($data)
    {
        $client_req_time = time();
        $uid = Auth::id();
        $out_trade_no = 'wechat_' . substr(sha1(self::ORDER_CRYPT_SALT . $uid), 0, 10) . $client_req_time;
        $data = [
            'out_trade_no' => $out_trade_no,
            'body' => $data['body'],
            'detail' => $data['detail'],
            'total_fee' => $data['total_fee'],
            'user_id' => $uid,
            'app_id' => $data['app_id'],
        ];
        $order = WechatOrder::firstOrCreate($data);
        return $out_trade_no;
    }

}

?>