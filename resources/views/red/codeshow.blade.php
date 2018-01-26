<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title>我的收款码</title>
    <link href="/css/paycode_wap/style.css?v=20170117" rel="stylesheet">
    <!--<link href="/js/dist/css/light7.css" rel="stylesheet">-->
    <script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-weui/lib/weui.min.js"></script>
    <!--<script src="/js/dist/js/light7.min.js"></script>-->
</head>

<body>
<div class="page-group">
    <div class="page">
        <div class="content">
            <div class="page-group">
                <div class="content">
                    <div style="text-align: center;font-size: 14px;">
                        <div style="padding-top:15px;">
                            <span>合并成功</span>
                        </div>
                        <div>
                            <p style="padding-left: 10px;color:#666;">别忘记长按保存到相册中使用哦</p>
                        </div>
                        <div >
                            {{--<p style='font-size:16px;padding-top:15px;display:none;;margin-top:100px' class='c_short2'>短网址1：<span class="short2"></span></p>--}}
                            <p style='font-size:16px;padding-top:15px;'>短网址：<span class="short">{{$app->short_url}}</span></p>

                            {{--<p><button id ='copy2'>复制1</button></p>--}}
                            {{--<div class="blank20"></div>--}}
                            <p><button id ='copy1'>复制</button></p>
                        </div>
                        <div class="blank25"></div>
                        <div class="fm-submit-wrap">
                            <a type="button" class="fm-submit magin-btn" href="{{$preUrl}}"><span></span>返回再合并</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://cdn.bootcss.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
    text1 = $('.short').text();
    var text2;


                $.ajax({
                type: "post",
                url: "{{route('restoreAndCreateShortUrl')}}",
                dataType: 'json',
                data: {
                    url: "{{$app->short_url}}",
                },
                success: function (res) {

                    if (res.res == 0) {
                        //$('.short2').text(res.data.shortUrl);
                        //$('.c_short2').show();
                        //text2 = res.data.shortUrl;
                    }
                   
                },
                error: function (err) {
                    weui.alert('发生错误，请联系管理员');
                }
            });

    var clipboard = new Clipboard('#copy1', {
        text: function() {
            return text1;
        }
    });
        var clipboard2 = new Clipboard('#copy2', {
        text: function() {
            return text2;
        }
    });

    clipboard.on('success', function(e) {
        weui.alert('复制成功')
    });
    clipboard2.on('success', function(e) {
        weui.alert('复制成功')
    });
</script>

