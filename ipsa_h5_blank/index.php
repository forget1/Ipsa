<?php
    error_reporting(0);
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
        $id = 0;
    }
    if(isset($_GET["from"])) {
        $from = $_GET["from"];
    } else {
        $from = 0;
    }

    require_once "jssdk.php";
    $jssdk = new JSSDK("wx792feaaab3e6b588", "33e93e1e056dd10b56147b20c0e36d4e");

    $signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- <link rel="stylesheet" href="css/swiper.min.css"> -->
    <link rel="stylesheet" href="css/jquery.fullpage.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css?id=sajhsakjh">
    <title>IPSA</title>
</head>
<body>


<div id="app" class="app">
    <div class="loading" id="loading"><img src="img/loading.gif" alt=""></div>

    <div class="logo"></div>
    <div class="fullpage" id="fullpage">
        <div class="section">
            <div class="slide slide_0">
                <div class="photo_wrapper">
                    <img :class="{cannot_save: from != 0}" src="http://www.shmachinist.com/ipsa_photo/upload/<?php echo $id; ?>_1.jpg" alt="">
                    <!-- <img :class="{cannot_save: from != 0}" src="img/0.jpeg?id=kjahdkjah" alt=""> -->
                </div>
                <div class="product product_0"></div>
            </div>
            <div class="slide slide_1">
                <div class="photo_wrapper">
                    <img :class="{cannot_save: from != 0}" src="http://www.shmachinist.com/ipsa_photo/upload/<?php echo $id; ?>_2.jpg" alt="">
                    <!-- <img :class="{cannot_save: from != 0}" src="img/1.jpeg?id=kjahdkjah" alt=""> -->
                </div>
                <div class="product product_1"></div>
            </div>
            <div class="slide slide_2">
                <div class="photo_wrapper">
                    <img :class="{cannot_save: from != 0}" src="http://www.shmachinist.com/ipsa_photo/upload/<?php echo $id; ?>_3.jpg" alt="">
                    <!-- <img :class="{cannot_save: from != 0}" src="img/2.jpeg?id=kjahdkjah" alt=""> -->
                </div>
                <div class="product product_2"></div>
            </div>
        </div>
    </div>
    <!-- <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide swiper-slide_0">
                <div class="photo_wrapper">
                    <img :class="{cannot_save: from != 0}" src="http://www.shmachinist.com/ipsa_photo/upload/<?php echo $id; ?>_1.jpg" alt="">
                </div>
                <div class="product product_0"></div>
            </div>
            <div class="swiper-slide swiper-slide_1">
                <div class="photo_wrapper">
                    <img :class="{cannot_save: from != 0}" src="http://www.shmachinist.com/ipsa_photo/upload/<?php echo $id; ?>_2.jpg" alt="">
                </div>
                <div class="product product_1"></div>

            </div>
            <div class="swiper-slide swiper-slide_2">
                <div class="photo_wrapper">
                    <img :class="{cannot_save: from != 0}" src="http://www.shmachinist.com/ipsa_photo/upload/<?php echo $id; ?>_3.jpg" alt="">
                </div>
                <div class="product product_2"></div>
            </div>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div> -->
    <div class="btn_wrapper">
        <div v-if="from == 0" class="btn btn_0" @click="show_info(0)">保存照片</div>
        <div v-if="from == 0" class="btn" @click="show_info(1)">分享我的IPSA光影时刻</div>
        <div v-if="from != 0" class="btn" @click="show_info(1)">分享TA的IPSA光影时刻</div>
    </div>


    <transition name="fade">
        <div v-show="info_show" class="info" id="info" @click="hide_info">
            <p class="save_info" v-if="flag==0">长按图片，保存照片到手机</p>
            <div class="share_info" v-else></div>
        </div>
    </transition>


</div>

<script src="js/vue.js"></script>
<script src="js/jquery-1.12.4.min.js"></script>
<!-- <script src="js/swiper.min.js"></script> -->
<script src="js/jquery.fullpage.min.js"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    var from = <?php echo $from; ?>;
</script>
<script src="js/index.js?i=dsjajsdsjdnj"></script>
<script type="text/javascript">
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            'onMenuShareAppMessage','onMenuShareTimeline'
        ]
    });

    wx.ready(function() {
        // wxshare();
        wx.onMenuShareTimeline({
            title: "定格我的IPSA光影时刻",
            desc: "独一无二的自然光彩，你也想拥有吗？",
            link: "http://www.shmachinist.com/ipsa_h5_blank/?id=<?php echo $id; ?>",
            imgUrl: 'http://www.shmachinist.com/ipsa_h5_blank/img/test.png',
            // link: "http://www.shmachinist.com/ipsa_h5_blank/",
            // imgUrl: 'http://www.shmachinist.com/ipsa_h5_blank/img/0.jpeg?id=saassd',


            success: function () {
                record("share to timeline");
            },
            cancel: function () {
            }

        });
        // \u5206\u4eab\u7ed9\u670b\u53cb
        wx.onMenuShareAppMessage({
            title: "定格我的IPSA光影时刻",
            desc: "独一无二的自然光彩，你也想拥有吗？",
            link: "http://www.shmachinist.com/ipsa_h5_blank/?id=<?php echo $id; ?>",
            imgUrl: 'http://www.shmachinist.com/ipsa_h5_blank/img/test.png',
            // link: "http://www.shmachinist.com/ipsa_h5_blank/",
            // imgUrl: 'http://www.shmachinist.com/ipsa_h5_blank/img/0.jpeg?id=sasdwad',
            success: function () {
                record("share to single");

            },
            cancel: function () {
            }
        });
    });
</script>


</body>
</html>
