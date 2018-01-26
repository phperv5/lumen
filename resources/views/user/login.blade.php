@extends('layout.pay_merge')

<link rel="stylesheet" href="/css/paycode_wap/login.css"/>

@section('content')
    <div class="register">
        <div class="content">
            <div class="point" style="text-align: center;font-size: 16px;">
                <span>登录</span>
            </div>
            <div class="form">
                <div class="message">
                    <input type="text" placeholder="输入手机号"  id="user_name" name="user_name" value="" />
                    <input type="password" placeholder="请输密码"  id="password" name="password" value="" />
                </div>
                <button class="submit" id="js_registBtn">登录</button>
            </divform>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#js_registBtn').bind('click', function () {
            var user_name = $('#user_name').val();
            var password = $('#password').val();
            $.ajax({
                type: "post",
                url: "{{route('login')}}",
                dataType: 'json',
                data: {
                    user_name: user_name,
                    password: password,
                },
                success: function (res) {
                    if (res.res == 0) {
                        location.href = res.data.redirect_url;
                    } else {
                        weui.alert(res.msg)
                    }
                },
                error: function (err) {
                    weui.alert('发生错误，请联系管理员');
                }
            });
        });
    </script>
@endsection