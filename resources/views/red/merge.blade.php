<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title>码上合并</title>
    <meta name="keywords" content="码上合并"/>
    <meta name="description" content="码上合并"/>

    <link href="/css/paycode_wap/style.css?v=201701104" rel="stylesheet">
    <script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-weui/lib/weui.min.js"></script>
    <script src="/css/paycode_wap/js/common.js?v=20170115"></script>
<body>
<style>

</style>
<div class="page-group">
    <div class="page">
        <div class="content">
            <div class="page-group">
                <div class="content">
                    <div>
                        <div style="width: 50px;margin: 0 auto;padding:30px 0;">
                            <img src="/images/logo.png" style="width:50px;"/>
                        </div>
                    </div>
                    <div class="content-padded" style="padding: 5px;">
                        <p style="padding: 0 10px">
                                   <span style="color:#333;font-size: 14px;">将您的支付宝红包码生成短链接，微信QQ打开均可自动领红包，请在下方相册中上传或直接扫描您的红包码<br>
                        <p style='padding-top:20px;font-size:16px;'>
                            点击体验
                            <a href='https://tinyurl.com/y7tpxdgd' target='_blank'>https://tinyurl.com/y7tpxdgd</a>
                        </p>
                        <p>已支持安卓微信,安卓qq，苹果qq，加入qq群一起探讨 575563404</p>
                        </span>
                        </p>
                    </div>

                    <div class="merge-form" id="merge-page">

                        <input type="hidden" name="alipay_decode" id="alipay_decode" value=""/>

                        <div style='margin:0 auto;width:300px;overflow:hidden'>

                            <div class="content-padded" style="padding: 0px;margin: 0 auto;">
                                <div class="mdl-textfield is-invalid" style='padding-top:25px;'>
                                    <input class="mdl-textfield__input j-login-item" id="url" type="text"
                                           data-validate="pwd1" autocorrect="off" autocapitalize="off" name="url"
                                           value="" placeholder="必填，支付宝红包地址">
                                    <button id='shang_alipay'>or点击扫描红包码</button>
                                </div>

                                <div class="mdl-textfield is-invalid" style='padding-top:25px;'>
                                    <input class="mdl-textfield__input j-login-item" id="zhikouling" type="text"
                                           data-validate="pwd1" autocorrect="off" autocapitalize="off" name="zhikouling"
                                           value="" placeholder="选填，红包码吱口令">
                                </div>
                            </div>

                            <div class="template-wrap">
                                <h3 style="margin-top: 10px;font-size: 14px;">广告中间页模板</h3>
                                <div class="">
                                    <div style="width: 46%;float: left;margin: 10px 5px;">
                                        <a href="javascript:;" data="aliPay" class="select_btn active after">
                                            <img src="/images/video/01.jpg">
                                        </a>
                                        <p><input type="radio" name="template" value="01">前任三</p>
                                    </div>
                                    <div style="width: 46%;float: left;margin: 10px 5px;">
                                        <a href="javascript:;" data="aliPay" class="select_btn">
                                            <img src="/images/video/02.jpg">
                                        </a>
                                        <p><input type="radio" name="template" value="02">小猪佩奇</p>
                                    </div>
                                    {{--<div style="width: 46%;;float: left;margin: 10px 5px;">--}}
                                        {{--<a href="javascript:;" data="aliPay" class="select_btn">--}}
                                            {{--<img src="/images/video/01.jpg">--}}
                                        {{--</a>--}}
                                        {{--<p><input type="radio" name="template" value="03"></p>--}}
                                    {{--</div>--}}
                                    {{--<div style="width: 46%;float: left;margin: 10px 5px;">--}}
                                        {{--<a href="javascript:;" data="aliPay" class="select_btn">--}}
                                            {{--<img src="/images/video/01.jpg">--}}
                                        {{--</a>--}}
                                        {{--<p><input type="radio" name="template" value="04"></p>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>

                        <div class="blank30"></div>
                        <div class="blank30"></div>
                        <div class="blank20"></div>
                        <div class="fm-submit-wrap">
                            <a type="button" class="fm-submit magin-btn" id="js_registBtn"><span></span><span
                                        class="hebing">马上合并</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>

<script>
    var WxConfig = {!!wechatApi()->config(['scanQRCode'], false)!!};
    wx.config(WxConfig);
    wx.ready(function () {
        $('#shang_alipay').on('click', function () {
            scanQRCode(function (u, ourl) {
                if (u.indexOf('qr.alipay.com') > -1) {
                    $('#url').val(ourl);
                    weui.topTips('扫码成功', {
                        className: 'custom-success'
                    });
                    return 'tenpay';
                } else {
                    weui.alert('您扫的不是红包码。');
                }
            });
        });

        $('#js_registBtn').bind('click', function () {
        var qq = $('#qq').val();
        var url = $('#url').val();
        var title = $('#title').val();
        var zhikouling = $('#zhikouling').val();
        var content = $('#content').val();
        var template = $('[name="template"]').val();
        _hebing = $(this).find('.hebing');
        _hebing.html('玩命合并中...');
        $.ajax({
            type: "post",
            url: "{{route('redGenerateQrCode')}}",
            dataType: 'json',
            data: {
                qq: qq,
                url: url,
                title: title,
                zhikouling: zhikouling,
                content: content,
                template: template,
            },
            success: function (res) {
                _hebing.html('马上合并')
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
    })
</script>

