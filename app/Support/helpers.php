<?php
use Intervention\Image\ImageManagerStatic as Image;

function wechatApi()
{
    $config = config('wechat');
    //使用配置初始化一个项目实例
    $app = new \EasyWeChat\Foundation\Application($config);
    $js = $app->js;
    return $js;
}

function getItemQrHostUrl($access_key)
{
    return env('QR_HOST_URL') . 'item/' . $access_key;
}

function getRedQrHostUrl($access_key)
{
    return 'http://qr.gaoyigao.cn/red/' . $access_key;
}

function createShortUrl($url)
{
    $url = 'http://api.t.sina.com.cn/short_url/shorten.json?source=3271760578&url_long=' . $url;
    try {
        $result = file_get_contents($url);
        $result = json_decode($result, true);
        return isset($result[0]['url_short']) ? $result[0]['url_short'] : '';
    } catch (\Exception $e) {
        return false;
    }
}


function createTinyUrl($url)
{
    try {
        $url = urlencode($url);
        $url = "https://tinyurl.com/create.php?source=indexpage&url=" . $url . "&submit=Make+TinyURL%21&alias=";
        $result = file_get_contents($url);
        $preg = "/<div class=\"indent\"><b>(.*)?<\/b>/i";
        preg_match($preg, $result, $arr);
        return isset($arr[1]) ? $arr[1] : '';
    } catch (\Exception $e) {
        return '';
    }
}


function generateWechatCodeWithBg($filePath, $logoPath, $bgPath, $h_width, $format = 'png')
{
    $logo = Image::make($logoPath);
    $bg = Image::make($bgPath);
    $logo->resize($h_width, $h_width);
    $bg->insert($logo, 'top-left', (600 - $h_width) / 2, 290);
    file_put_contents($filePath, (string)$bg->encode($format));
    return $filePath;
}

function generateMergeCodeWithBg($filePath, $logoPath, $bgPath, $h_width, $format = 'png')
{
    list($width, $height) = getimagesize($bgPath);
    $logo = Image::make($logoPath);
    $bg = Image::make($bgPath);
    $logo->resize($h_width, $h_width);
    $top = ceil(($width - $h_width) / 2);
    $bg->insert($logo, 'top-left', $top, 250);
    file_put_contents($filePath, (string)$bg->encode($format));
    return $filePath;
}

function generateMergeWechatTranferWithBg($filePath, $logoPath, $bgPath, $h_width, $format = 'png')
{
    list($width, $height) = getimagesize($bgPath);
    $logo = Image::make($logoPath);
    $bg = Image::make($bgPath);
    $logo->resize($h_width, $h_width);
    $top = ceil(($width - $h_width) / 2);
    $bg->insert($logo, 'top-left', $top, 210);
    file_put_contents($filePath, (string)$bg->encode($format));
    return $filePath;
}


function createBitlyUrl($url)
{
    try {
        $c_url = "http://kks.me/create.php?m=index&a=urlCreate";
        $data['url'] = $url;
        $data['type'] = 6;
        $res = curlSend($c_url, $data);
        $urlArr = json_decode($res);
        return isset($urlArr->list) ? $urlArr->list : '';
    } catch (\Exception $e) {
        return '';
    }
}


function curlSend($url, $data = null, $method = 'POST')
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    if ($method == 'POST') {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    $res = curl_exec($curl);
    $flag = curl_errno($curl) ? curl_errno($curl) : $res;
    curl_close($curl);
    return $flag;
}

function generateTemplateCodeWithBg($filePath, $logoPath, $bgPath, $h_width, $top, $left, $format = 'png')
{
    $logo = Image::make($logoPath);
    $bg = Image::make($bgPath);
    $logo->resize($h_width, $h_width);

    $bg->insert($logo, 'top-left', $top, $left);
    file_put_contents($filePath, (string)$bg->encode($format));
    return $filePath;

}

