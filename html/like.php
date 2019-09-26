<?php
error_reporting(E_ALL||~E_NOTICE);
header('Content-type:text/html;charset=utf-8');
require_once "jssdk.php";
$jssdk = new JSSDK("wxbe2eec7ba1d02aff", "371befb928712e94d926435ee4a31495");
// $jssdk = new JSSDK("appID", "appsecret");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
  <title>微信-混合开发-JSSDK</title>
  <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.2&key=fa303445ccc2205a7beea9ec20d1fff4">
    </script>  
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=32f17d2ee72f43e31a28fe2bfe840b96"></script>
  <style>
        *{
            padding: 0;
            margin:0;
        }
        h1{
            text-align: center;
            background:orange;
        }
    </style>
</head>
<body>
   <h1>1. 配置域名 ( toto88.applinzi.com ) </h1>
   <h2>2. 引入 微信JS-SDK 文件</h2>
   <h3>3. wx.config 注入 权限验证配置 (最重要 )</h3>
   <h3>4. wx.ready 处理成功的回调 </h3>
   <h3>5. wx.error 处理失败的回调 </h3>

</body>
<script type="text/javascript" src="https://zuozhaoxi.com/base/js/jquery-1.10.1.min.js"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>	

<script>
  // 引入WX-JSSDK 文件   
  wx.config({
    debug: true,  // 上线就要  设置 false 
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'onVoicePlayEnd',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard',
        'updateAppMessageShareData'
    ]
  });

  wx.ready(function () {
      alert("可以使用微信 JS-SDK ")
  });

  wx.error(function(res){
 
    alert(res);
  })
</script>
</html>
