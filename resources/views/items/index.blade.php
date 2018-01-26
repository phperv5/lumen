@extends('layout.pay_merge')
@section('content')
<style>
    body {
        background: rgb(244, 244, 244)
    }
</style>
<div class="content content-margin">
    <div>
        <div style="width: 50px;margin: 0 auto;padding:30px 0;">
            <img src="/images/logo.png" style="width:50px;"/>
        </div>
    </div>
    <div class="content-padded" style="padding: 0px;">
        <p style="padding: 0 10px"><span style="color:#333;font-size: 14px;">
                <span style="">
                 将您的社交类型二维码与商品类型二维码合并为一个社交化电商二维码，使您的人脉与商品从传播到转化到购买一气呵成
            </span>
        </p>
    </div>
    <div class="blank20"></div>
    <div class="merge-form" id="merge-page">
        <input type="hidden" name="wechat_url" id="wechat_url" value=""/>
        <input type="hidden" name="alipay_url" id="alipay_url" value=""/>
        <input type="hidden" name="qq_url" id="qq_url" value=""/>
        <input type="hidden" name="weibo_url" id="weibo_url" value=""/>
        <input type="hidden" name="tmall_url" id="tmall_url" value=""/>
        <input type="hidden" name="taobao_url" id="taobao_url" value=""/>
        <div class="up-qrcode-warp">
            <div class="deals-tit-msg"><span>请根据自身需要，上传任意两个码即可合并</span></div>
            <div class="deals-tit">社交类型二维码</div>
            <div class="additem magin10" id="wechat">
                <div class="plist-wechat item-left"></div>
                <div class="plist"><span class="wechat-msg">微信好友码/公众号码</span></div>
                <div class="plus item-right" ></div>
            </div>
            <div class="additem magin10" id="alipay">
                <div class="plist-alipay item-left"></div>
                <div class="plist"><span class="alipay-msg">支付宝好友码/支付宝群码</span></div>
                <div class="plus item-right" ></div>
            </div>
            <div class="additem magin10" id="qq">
                <div class="plist-qq item-left"></div>
                <div class="plist"><span class="qq-msg">QQ好友码/QQ群码</span></div>
                <div class="plus item-right" ></div>
            </div>
            <div class="additem magin10"  id="weibo">
                <div class="plist-weibo item-left"></div>
                <div class="plist"><span class="weibo-msg">微博好友码/微博群码</span></div>
                <div class="plus item-right"></div>
            </div>
        </div>
        <div class="up-qrcode-warp">
            <div class="deals-tit">商品二维码</span></div>
            <div class="additem magin10" id="tmall">
                <div class="plist-tmall item-left"></div>
                <div class="plist"><span class="tmall-msg">天猫店铺码/商品码</span></div>
                <div class="plus item-right"></div>
            </div>
            <div class="additem magin10"  id="taobao">
                <div class="plist-taobao item-left"></div>
                <div class="plist"><span class="taobao-msg">淘宝店铺码/商品码</span></div>
                <div class="plus item-right"></div>
            </div>
        </div>

        <div class="content-padded" style="padding: 0px;width: 80%;margin: 0 auto;">
            <div class="mdl-textfield is-invalid">
                <input class="mdl-textfield__input j-login-item" id="merchant_name" type="text" data-validate="pwd1"
                       autocorrect="off" autocapitalize="off" name="merchant_name" value=""
                       placeholder="选填，输入合并后的备注(15个字以内)">
            </div>
            </p>
        </div>
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

        $('#wechat').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('wechat') > -1 || u.indexOf('weixin') > -1) {
                    $('#wechat_url').val(ourl);
                    $('.wechat-msg').html('上传成功').addClass('msg-success');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'wechat';
                } else {
                    weui.alert('您扫的不是微信二维码。');
                }
            });
        });

        $('#alipay').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('qr.alipay.com') > -1) {
                    $('#alipay_url').val(ourl);
                    $('.alipay-msg').html('上传成功').addClass('msg-success');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'wechat';
                } else {
                    weui.alert('您扫的不是支付宝二维码。');
                }
            });
        });

        $('#qq').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('qq') > -1) {  // 支付宝支付
                    $('#qq_url').val(ourl);
                    $('.qq-msg').html('上传成功').addClass('msg-success');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'qq';
                } else {
                    weui.alert('您扫的不是qq二维码。');
                }
            });
        });
        $('#weibo').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (true) {  // 支付宝支付
                    $('#weibo_url').val(ourl);
                    $('.weibo-msg').html('上传成功').addClass('msg-success');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'weibo';
                } else {
                    weui.alert('您扫的不是微博二维码。');
                }
            });
        });
        $('#tmall').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('tb') > -1) {  // 支付宝支付
                    $('#tmall_url').val(ourl);
                    $('.tmall-msg').html('上传成功').addClass('msg-success');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'tmall';
                } else {
                    weui.alert('您扫的不是天猫二维码。');
                }
            });
        });
        $('#taobao').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('tb')>-1) {  // 支付宝支付
                    $('#taobao_url').val(ourl);
                    $('.taobao-msg').html('上传成功').addClass('msg-success');
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'taobao';
                } else {
                    weui.alert('您扫的不是淘宝二维码。');
                }
            });
        });

        $('#js_registBtn').bind('click', function () {
            var wechat_url = $('#wechat_url').val();
            var alipay_url = $('#alipay_url').val();
            var qq_url = $('#qq_url').val();
            var weibo_url = $('#weibo_url').val();
            var tmall_url = $('#tmall_url').val();
            var taobao_url = $('#taobao_url').val();
            var merchant_name = $.trim($('#merchant_name').val());
            $.ajax({
                type: "post",
                url: "{{route('itemGenerateQrCode')}}",
                dataType: 'json',
                data: {
                    wechat_url: wechat_url,
                    alipay_url: alipay_url,
                    qq_url: qq_url,
                    weibo_url: weibo_url,
                    tmall_url: tmall_url,
                    taobao_url: taobao_url,
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