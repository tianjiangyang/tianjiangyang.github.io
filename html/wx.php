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
        html,body, .app{
            width:100%;
            height:100%;
        }
        .app{
            width:100%;
            height:100%;
            /* overflow:auto; */
            box-sizing: border-box;
        }
        #boxImg{
            width:90%;
            height:70%;
            margin:10px auto;
            box-shadow: 0 0 10px red;
            border-radius: 6px;
            box-sizing: border-box;
        }
        #imgbtn,#scan ,.box{
            width:80%;
            margin:20px auto;
            height:50px;
            box-shadow: 0 0 10px #ddd;
            background: brown;
            color:#fff;
            font-size: 28px;
            text-align: center;
            line-height: 50px;
        }
        p{
            width:90%;
            height:40%;
            font-size: 24px;
            text-align: center;
            color:yellowgreen;
            margin:10px auto;
            box-shadow: 0 0 10px #ddd;
        }

        .map{
            width:98%;
            height:800px;
            margin:10px auto;
            border:2px solid darkblue;
            
        }
    </style>
</head>
<body>
    <h1>微信JS-SDK混合开发  微信公众号页面  </h1>
    <div id="boxImg"></div>
    <div id="imgbtn" >点击拍照</div>
    <div id="scan" >扫描二维码</div>
    <div id="start" class="box" >开始录音</div>
    <div id="stop" class="box" >停止录音</div>
    <div id="play" class="box">播放录音</div>  
    <div id="stopplay" class="box">停止播放</div>  
    <p id="geolocation">获取地理定位中....</p>
    <div id="bmap" class="map">打开百度地图中...</div>
    <div id="amap" class="map">打开高德地图中...</div>
    
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
        'updateAppMessageShareData',
        "updateTimelineShareData"
    ]
  });

  wx.ready(function () {

    //   获取网络状态 
    wx.getNetworkType({
        success: function (res) {
            var networkType = res.networkType; // 返回网络类型2g，3g，4g，wifi
            alert(networkType)
        }
    });

    // 二维码扫一扫
    document.getElementById("scan").onclick = function(){
        alert("start scan ");
        wx.scanQRCode({
            needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
            scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
            success: function (res) {
                var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                alert(result);

                window.location.href = result;
            }
        });
    }

    // 拍照  图像无法显示 
    document.getElementById("imgbtn").onclick = function(){
        alert("start photo ");
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                alert("photo success");
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                // wx.getLocalImgData({
                //     localId: localIds, // 图片的localID
                //     success: function (res) {
                //         var localData = res.localData; // localData是图片的base64数据，可以用img标签显示
                //         alert(localData);
                //         var boxImg  =  document.getElementById("boxImg") ;
                //         boxImg.style.backgroundImage = "url("+localData+")";
                //         boxImg.style.backgroundSize = "cover";
                //     }
                // });
                wx.previewImage({
                    current: localIds, // 当前显示图片的http链接
                    urls: [] // 需要预览的图片http链接列表
                });
            }
        });
    }

    // 录音接口

    // 录音 接口
    var localId = null;
    // 开始录音 
    $("#start").on("click",function(){
            alert("开始录音");
            wx.startRecord();
    });
    
    // 停止录音
    $("#stop").on("click",function(){
            alert("停止录音");
            wx.stopRecord({
                success: function (res) {
                    localId = res.localId;
                }
            });
    });
    
    // 播放录音
    $("#play").on("click",function(){
            alert("播放录音");
            wx.playVoice({
                localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
            });		
    })
    // 停止播放
    $("#stopplay").on("click",function(){
            alert("停止播放");
            wx.stopVoice({
                localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
            });		
    })

    // 获取地理位置
    wx.getLocation({
        type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
        success: function (res) {
            var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
            var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
            var speed = res.speed; // 速度，以米/每秒计
            var accuracy = res.accuracy; // 位置精度
            setTimeout(()=>{
                $("#geolocation").html(`经度 longitude : ${longitude} <br> 
                    纬度 latitude : ${latitude} <br>
                    速度 speed : ${speed} <br> ` )
            },1000);
						
            setTimeout(()=>{
                openWMap(longitude,latitude)
                openBMap(longitude,latitude)
                openAMap(longitude,latitude)
                 
            },2000)
        }
    });


    function openWMap(longitude,latitude){
        wx.openLocation({
            latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
            longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
            name: '千锋教育', // 位置名
            address: '金融港B18', // 地址详情说明
            scale: 16, // 地图缩放级别,整形值,范围从1~28。默认为最大
            infoUrl: 'http://toto88.applinzi.com/html/wx.php' // 在查看位置界面底部显示的超链接,可点击跳转
        });
    }

        // 打开百度地图
        function openBMap(longitude,latitude){
      		var map = new BMap.Map('bmap');
      		var point = new BMap.Point(longitude,latitude);
      		
      		map.centerAndZoom(point,16);
      		var icon = new BMap.Icon("http://lbsyun.baidu.com/jsdemo/img/fox.gif",new BMap.Size(300,150));
    		var marker = new BMap.Marker(point,{icon});
    		map.addOverlay(marker);
    		marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
      	}
          
        //   打开高德地图 
      	function openAMap(longitude,latitude){
      		var map = new AMap.Map("amap",{
    			 zoom: 15,
    			 resizeEnable: true,
    			 center: [longitude,latitude],
    			 viewMode:'3D'//使用3D视图
    		})
    		
    		var marker = new AMap.Marker({
			    icon: "https://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
			    position: [longitude,latitude]
			});
			map.add(marker);
        }

        // 自定义“分享给朋友”及“分享到QQ”按钮的分享内容
        wx.updateAppMessageShareData({ 
            title: 'wh1906 2周之内全部就业 冲鸭!', // 分享标题
            desc: '面试要自信冷静大方,思考如何说话 ', // 分享描述
            link: 'https://toto88.applinzi.com/html/wx.php', // 分享链接
            imgUrl: 'https://zuozhaoxi.com/base/img/2.jpg', // 分享图标
            success: function () {
            // 用户确认分享后执行的回调函数
                    alert("谢谢自定义分享到QQ/朋友")
            },
            cancel: function () {
            // 用户取消分享后执行的回调函数
                    alert("你取消了分享")
            }
        })
        
        // 自定义“分享到朋友圈”及“分享到QQ空间”按钮的分享内容
        wx.updateTimelineShareData({ 
            title: '1906/ six  & 我本将心照明月,奈何明月照沟渠', // 分享标题
            link: 'https://toto88.applinzi.com/html/wx.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'https://zuozhaoxi.com/base/img/3.jpg', // 分享图标
            success: function () {
                // 设置成功
                alert("谢谢自定义分享到朋友圈")
            }
        })

          // 分享到朋友圈  qq空间
    	// wx.onMenuShareTimeline({
        //     title: 'wh1902-天道酬勤-fighting', // 分享标题
        //     link: 'http://xixi88.applinzi.com/html/wx.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        //     imgUrl: 'https://zuozhaoxi.com/base/img/1.jpg', // 分享图标
        //     success: function () {
        //             // 用户点击了分享后执行的回调函数
        //             alert("谢谢分享到朋友圈")
        //         },
        //         cancel(){
        //             alert("你取消了分享")
        //         }
        // });
        
        // 分享到朋友  废弃
        // wx.onMenuShareAppMessage({
        //     title: 'wh1902-daydayup', // 分享标题
        //     desc: '人均1W+', // 分享描述
        //     link: 'http://daydayup.applinzi.com/sdk/wx.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        //     imgUrl: 'https://zuozhaoxi.com/base/img/2.jpg', // 分享图标
        //     type: '', // 分享类型,music、video或link，不填默认为link
        //     dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        //     success: function () {
        //     // 用户点击了分享后执行的回调函数
        //         alert("谢谢分享到朋友")
        //     },
        //     cancel(){
        //         alert("你取消了分享")
        //     }
        //     });
            
        // 分享到 qq 废弃
        // wx.onMenuShareQQ({
        //     title: '1902  two weeks get offer all', // 分享标题
        //     desc: '面试要自信冷静大方 ', // 分享描述
        //     link: 'http://daydayup.applinzi.com/sdk/wx.php', // 分享链接
        //     imgUrl: 'https://zuozhaoxi.com/base/img/3.jpg', // 分享图标
        //     success: function () {
        //     // 用户确认分享后执行的回调函数
        //             alert("谢谢分享到QQ")
        //     },
        //     cancel: function () {
        //     // 用户取消分享后执行的回调函数
        //             alert("你取消了分享")
        //     }
        // });
        // 分享到qq 空间  废弃
        // wx.onMenuShareQZone({
        //     title: '精神愉悦和满足', // 分享标题
        //     desc: '我本将心照明月,奈何明月照沟渠', // 分享描述
        //     link: 'http://daydayup.applinzi.com/sdk/wx.php', // 分享链接
        //     imgUrl: 'https://zuozhaoxi.com/base/img/4.jpg', // 分享图标
        //     success: function () {
        //     // 用户确认分享后执行的回调函数
        //         alert("谢谢分享到QQ空间")
        //     },
        //     cancel: function () {
        //     // 用户取消分享后执行的回调函数
        //         alert("你取消了分享")
        //     }
        // });
  });

  wx.error(function(res){
 
    alert(res);
  })
</script>
</html>
