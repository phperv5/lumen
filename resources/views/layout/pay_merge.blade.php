<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title>码上合并</title>
    <meta name="keywords" content="码上合并"/>
    <meta name="description" content="码上合并"/>
    <!--<link href="/js/jquery-weui/lib/weui.min.css?v=0" rel="stylesheet">-->
    <link href="/css/paycode_wap/style.css?v=2017011061" rel="stylesheet">
    <!--<link href="/js/dist/css/light7.css" rel="stylesheet">-->
    <script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-weui/lib/weui.min.js"></script>
    <script src="/css/paycode_wap/js/common.js?v=20170115"></script>
    <!--    <script src="/js/dist/js/light7.min.js"></script>-->
    @yield('css')
</head>
<body>
<div class="page-group">
    <div class="page">
        <div class="content">
            <div class="page-group">
                @yield('content')
            </div>
        </div>
    </div>

</div>
</body>
</html>
@yield('script')
