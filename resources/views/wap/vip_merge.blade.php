@extends('layout.pay_merge')
@section('content')
<div class="content">
    <div class="blank20"></div>
    <div class="blank30"></div>
    <div class="merge-form" id="merge-page">
        <input type="hidden" name="shang_alipay_decode" id="shang_alipay_decode" value=""/>
        <input type="hidden" name="alipay_decode" id="alipay_decode" value=""/>
        <input type="hidden" name="wechat_decode" id="wechat_decode" value=""/>
        <div class="up-qrcode-warp">
            <div class="up-qrcode-list">
                <div class="up-qrcode fl">
                    <div class="up-box" id="shang_alipay">
                        <span class="tips up-hongbao-tips"></span>
                    </div>
                </div>

                <div class="up-qrcode fr">
                    <div class="up-box" id="up-weixin">
                        <span class="tips up-weixin-tips"></span>
                    </div>
                </div>

                <div class="up-qrcode fl">
                    <div class="up-box" id="up-alipay">
                        <span class="tips up-alipay-tips"></span>
                    </div>
                </div>

            </div>
        </div>

        <div class="content-padded" style="padding: 0px;width: 75%;margin: 0 auto;">
            <div class="mdl-textfield is-invalid">
                <input  class="mdl-textfield__input j-login-item" id="merchant_name" type="text" data-validate="pwd1" autocorrect="off" autocapitalize="off"  name="merchant_name" value="" placeholder="选填，输入收款备注文字(15个字以内)">
            </div>
            </p>
        </div>
        <div class="blank30"></div>
        <div class="blank30"></div>
        <div class="blank30"></div>
        <div class="fm-submit-wrap">
            <a type="button" class="fm-submit magin-btn" id="js_registBtn"><span></span>马上合并</a>
        </div>
    </div>

</div>
@endsection
@section('script')
<script>
    var WxConfig = {!!wechatApi()->config(['scanQRCode'], false)!!};
    wx.config(WxConfig);
    wx.ready(function () {

        $('#shang_alipay').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('qr.alipay.com') > -1) {
                    $('#shang_alipay_decode').val(ourl);
                    $('#shang_alipay .up-hongbao-tips').addClass('saoma');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'tenpay';
                } else {
                    weui.alert('您扫的不是红包码。');
                }
            });
        });

        $('#up-alipay').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('QR.ALIPAY.COM') > -1 || u.indexOf('qr.alipay.com') > -1) {  // 支付宝支付
                    $('#alipay_decode').val(ourl);
                    $('#up-alipay .up-alipay-tips').addClass('saoma');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'alipay';
                } else {
                    weui.alert('您扫的不是支付宝收款码。');
                }
            });
        });

        $('#up-weixin').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('tenpay') > -1 || u.indexOf('qq.com') > -1 || u.indexOf('url.cn') > -1 || u.indexOf('wxp://') > -1) {  // 微信支付
                    $('#wechat_decode').val(ourl);
                    $('#up-weixin .up-weixin-tips').addClass('saoma');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'tenpay';
                } else {
                    weui.alert('您扫的不是微信收款码。');
                }
            });
        });

        $('#js_registBtn').bind('click', function () {
            var shang_ali_pay_url = $('#shang_alipay_decode').val();
            var ali_pay_url = $('#alipay_decode').val();
            var wechat_url = $('#wechat_decode').val();
            var merchant_name = $.trim($('#merchant_name').val());
            $.ajax({
                type: "post",
                url: "{{route('generateVipQrCode')}}",
                dataType: 'json',
                data: {
                    shang_ali_pay_url: shang_ali_pay_url,
                    ali_pay_url: ali_pay_url,
                    wechat_url: wechat_url,
                    merchant_name: merchant_name,
                },
                success: function (res) {
                    if (res.res == 0) {
                        location.href = res.data.nextUrl;
                    } else {
                        weui.alert(res.msg)
                    }
                },
                error: function (err) {
                    weui.alert('发生错误，请联系管理员');
                }
            });
        })
    });
</script>
@endsection