// 9 微信原生接口 ,识别二维码
function scanQRCode(cb) {
    // 9.1.2 扫描二维码并返回结果
    wx.scanQRCode({
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
            console.log(res)
            var u = res.resultStr;
            cb(u, res.resultStr);

        }
    });
}