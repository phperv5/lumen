@extends('layout.pay_merge')
@section('content')
    <div class="content">
        <div>
            <div style="width: 50px;margin: 0 auto;padding:30px 0;">
                <img src="/images/logo.png" style="width:50px;"/>
            </div>
        </div>

        <div class="content-padded" style="padding: 0px;">
            <p style="padding: 0 10px">
                <span style="color:#333;font-size: 14px;"><span style="">将支付宝收款码或口碑商家码与红包码合并，自动领取双份奖励，顾客得利，您也得利</span>（支付宝红包码活动将持续到2018-3-31号）</span>
            </p>
        </div>
        <div class="blank10"></div>

        <div class="merge-form" id="merge-page">
            <input type="hidden" name="shang_alipay_decode" id="shang_alipay_decode" value=""/>
            <input type="hidden" name="alipay_decode" id="alipay_decode" value=""/>
            <input type="hidden" name="wechat_decode" id="wechat_decode" value=""/>
            <div class="up-qrcode-warp">
                <div class="up-qrcode-list">

                    <div class="up-qrcode fl">
                        <a href="" class="help-link">微信收款码在哪里？</a>
                        <div class="up-box" id="up-weixin">
                            <span class="tips up-weixin-tips"></span>
                        </div>

                    </div>


                    <div class="up-qrcode fr">
                        <a href="{{route('alipayInfo')}}" class="help-link">支付宝收款码在哪里？</a>
                        <div class="up-box" id="up-alipay">
                            <span class="tips up-alipay-tips"></span>
                        </div>
                    </div>


                <div class="up-qrcode fl">
                    <a href="{{route('redInfo')}}" class="help-link">红包码在哪里？</a>
                    <div class="up-box" id="shang_alipay">
                        <span class="tips up-hongbao-tips"></span>
                    </div>
                </div>

            </div>

            <div class="content-padded" style="padding: 0px;width: 75%;margin: 0 auto;">
                <div class="mdl-textfield is-invalid">
                    <input class="mdl-textfield__input j-login-item" id="merchant_name" type="text" data-validate="pwd1"
                           autocorrect="off" autocapitalize="off" name="merchant_name" value=""
                           placeholder="选填，输入收款备注文字(15个字以内)">
                </div>
                </p>

            </div>

            <div style="overflow: hidden;padding: 6px;">
                <h2 style="font-size: 16px;color: #333;text-align: center;padding: 5px 0px;">收款模板</h2>
                @foreach($templates as $template)
                    <div class="theme" data-theme="{{$template->template_id}}">
                        <div class="theme_item" style="margin:0 5px;padding:5px 0px;box-shadow: 0 4px 8px 0 rgba(7,17,27,.1);">
                            <a href="javascript:" class="theme_pic">
                                <img src="{{$template->templateDir}}"/>
                            </a>
                            <div class="theme_name">{{$template->name}}</div>
                        </div>
                        <div class="theme_item-warp" @if($template->template_id !='01')style="display: none" @else style="display: block"  @endif></div>
                    </div>
                @endforeach

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

            template_id = '01';
            $('.theme').bind('click', function(){
                template_id = $(this).attr('data-theme');
                $('.theme_item-warp').hide();
                $(this).find('.theme_item-warp').show();
            });

            $('#js_registBtn').bind('click', function () {
                var shang_ali_pay_url = $('#shang_alipay_decode').val();
                var ali_pay_url = $('#alipay_decode').val();
                var wechat_url = $('#wechat_decode').val();
                var merchant_name = $.trim($('#merchant_name').val());
                $.ajax({
                    type: "post",
                    url: "{{route('generateQrCode')}}",
                    dataType: 'json',
                    data: {
                        shang_ali_pay_url: shang_ali_pay_url,
                        ali_pay_url: ali_pay_url,
                        wechat_url: wechat_url,
                        merchant_name: merchant_name,
                        template_id:template_id,
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