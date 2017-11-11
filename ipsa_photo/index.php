<?php  
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = 11111;
}

// 微信分享
require_once "jssdk.php";
$jssdk = new JSSDK("wxd05810ecbff672d2", "202af872b771a9613e8a6f801d3bca4c");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/lib/jquery_fullpage.css">
	<link rel="stylesheet" type="text/css" href="css/lib/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div id="app">
		<div v-if="isChoosen === false" id="choose">
			<h1>choose</h1>
			<div class="swiper-container swiper-choose">
				<div class="swiper-wrapper" v-bind:class="'choose_' + parseInt(chooseNumber)" @click="choose">
					<div class="swiper-slide sub_1">
						<div class="bg_move">	
						</div>	
					</div>
					<div class="swiper-slide sub_2">
						<div class="bg_move">	
						</div>
					</div>
					<div class="swiper-slide sub_3">
						<div class="bg_move">
						</div>
					</div>
				</div>

			</div>
			<div class="action">
				<input type="button" @click="goGenerate" name="" class="go" value="GO">
			</div>
		</div>
		<div v-else id="fullpage">
			<div class="section">
				<h1>DEMO</h1>
				<div class="generate">
					
				</div>
			</div>
			<div class="section">
				<h1>2</h1>
			</div>
			<div class="section">
				<h1>3</h1>
			</div>
			<div class="section">
				<h1>4</h1>
			</div>
		</div>
	</div>
	
</body>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="js/lib/jquery-1.11.1.min.js"></script>
<script src="js/lib/jquery-fullpage.js"></script>
<script src="js/lib/axios.min.js"></script>
<script src="js/lib/swiper.min.js"></script>
<script src="js/lib/move.min.js"></script>
<script src="js/lib/vue.js"></script>
<script src="js/index.js"></script>
<script type="text/javascript">
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			// 所有要调用的 API 都要加到这个列表中
			'onMenuShareAppMessage','onMenuShareTimeline'
		]
	});

	function wxshare() {	
		// 分享到朋友圈
		// return new Promise(function(resolve, reject){
			wx.onMenuShareTimeline({
				title: 'test', 
				desc: 'test',
				link: '',
				imgUrl: 'http://www.shmachinist.com/capture/img/share.png',
				success: function () {
					// resolve();
					console.log('success');
				},
				cancel: function () {
					// reject();
					console.log('fail');
				}
			});
			// 分享给朋友
			wx.onMenuShareAppMessage({
				title: 'test',
				desc: 'test',
				link: '',
				imgUrl: 'http://www.shmachinist.com/capture/img/share.png',
				type: '',
				success: function () {
					// resolve();
					console.log('success');
				},
				cancel: function () {
					// reject();
					console.log('fail')
				}
			});
		// });	
	}

	wx.ready(function() {
		wxshare(); 	// from index.js
	});
</script>
</html>