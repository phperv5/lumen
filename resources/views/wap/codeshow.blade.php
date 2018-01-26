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
                        <div class="blank10"></div>
                        <div>
                            <p style="padding-left: 10px;color:#666;">别忘记长按保存到相册中使用哦</p>
                        </div>
                        <div class="blank05"></div>
                        <div>

                            <img src="/{{$app->qr_img_file}}" style="width:80%"/>
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
