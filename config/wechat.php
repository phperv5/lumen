<?php

return [
    /*
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug' => true,

    /*
     * 使用 Laravel 的缓存系统
     */
    'use_laravel_cache' => true,

    /*
     * 账号基本信息，请从微信公众平台/开放平台获取
     */
//    'app_id'  => env('WECHAT_APPID', 'wx26336b337827bb57'),         // AppID wx26336b337827bb57
//    'secret'  => env('WECHAT_SECRET', '40a27081d4fbd2b546e465435f4c04bd'),     // AppSecret
    'app_id' => env('WECHAT_APPID', 'wx93c5c4c068f1a644'),         // AppID wx26336b337827bb57
    'secret' => env('WECHAT_SECRET', '85b038347b38c71040d3ff6dd9db126a'),     // AppSecret
    'token' => env('WECHAT_TOKEN', 'your-token'),          // Token
    'aes_key' => env('WECHAT_AES_KEY', ''),                    // EncodingAESKey

    /*
     * 日志配置
     *
     * level: 日志级别，可选为：
     *                 debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => env('WECHAT_LOG_LEVEL', 'debug'),
        'file' => env('WECHAT_LOG_FILE', storage_path('logs/wechat.log')),
    ],



    /*
     * 微信支付 1455051302
     */
    'payment' => [
         'merchant_id'        => env('WECHAT_PAYMENT_MERCHANT_ID', '1455051302'),
         'key'                => env('WECHAT_PAYMENT_KEY', '241D887916ea494f031fd1553f40df74'),
         'cert_path'          => env('WECHAT_PAYMENT_CERT_PATH', storage_path('cert/apiclient_cert.pem')), // XXX: 绝对路径！！！！
         'key_path'           => env('WECHAT_PAYMENT_KEY_PATH', storage_path('cert/apiclient_key.pem')),      // XXX: 绝对路径！！！！
        // 'device_info'     => env('WECHAT_PAYMENT_DEVICE_INFO', ''),
        // 'sub_app_id'      => env('WECHAT_PAYMENT_SUB_APP_ID', ''),
        // 'sub_merchant_id' => env('WECHAT_PAYMENT_SUB_MERCHANT_ID', ''),
        // ...
    ],

    'guzzle' => [
        'timeout' => 10.0, // 超时时间（秒）
        'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
    ],
];
