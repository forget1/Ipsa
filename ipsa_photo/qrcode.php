<?php 
header('Content-Type: text/plain; charset=utf-8');
require_once './include.php';

// if (isset($_GET['id'])) {
// 	$id = $_GET['id'];
// } else {
// 	$id = 1;
// }

// if (isset($_GET['city'])) {
// 	$city = $_GET['city'];
// } else {
// 	$city = 'shanghai';
// }
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/qrcode.css">
	<link rel="stylesheet" type="text/css" href="css/lib/swiper.min.css">
</head>
<body>
	<div class="container">

		<div class="qrcode_info">
			<img src="img/border.png" class="border_img">
			<img src="" class="people">
			<div class="code"></div>
			<p style="margin-top:38.5%;font-size:18px;">扫描上方二维码，获得IPSA光彩时刻专属H5</p>
		</div>
		<div class="swiper-container" style="padding-top:5%;top:14%;">
			<div class="swiper-wrapper" style="height:580px;">
				
			</div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	</div>
	<div class="logo"></div>
</body>
<script src="js/lib/jquery-1.11.1.min.js"></script>
<script src="js/lib/axios.min.js"></script>
<script src="js/lib/swiper.min.js"></script>
<script src="js/lib/jquery.qrcode.min.js"></script>
<script src="js/lib/vue.js"></script>
<script src="js/qrcode.js"></script>
<script type="text/javascript">
	$(function() {
		// document.oncontextmenu=new Function("event.returnValue=false;");
		// document.onselectstart=new Function("event.returnValue=false;");
		polling_all();
	})

	var obj = {
		'stamp': 0  
	};
	var swiper;
	function swiperInit() {
		swiper = new Swiper('.swiper-container', {
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			slidesPerView: 4,
			spaceBetween: 0,
			slidesPerColumn: 2,
			slidesPerColumnFill: 'row',
			onInit: function () {
				toggleQrCode();
			}
		});
	}
	
	function polling_all() {
		axios.get('qrcodeController.php', {
			params: {
				flag: 0 // get all data
			}
		}).then(function(res) {
			var datalist = res.data;
			if (res.data) {
				console.log(datalist.length);
				if(datalist.length == 0) {
					$('body').css('background-image', 'url(img/3.jpeg)');
					$('.logo').hide();
					$('.swiper-container').hide();
				} else {
					$('body').css('background-image', 'url(img/1.jpg)');
					$('.logo').show();
					$('.swiper-container').show();
					$.each(datalist, function(i, item) {
						var html = '';
						html += '<div class="swiper-slide" data-id="'+ item.stamp +'"><div class="wrap_code" style="background-image:url(upload/' + item.stamp + '_1.jpg)"></div></div>';
						$('.swiper-wrapper').append(html);
						
						if(i == datalist.length - 1) {
							console.log(1);
							obj.stamp = item.stamp;
							console.log(obj.stamp);
						}
					})
				}
				swiperInit();

				setInterval(function() {
					polling();
				}, 2500);
			}	
		});
	}

	function createQRCode(time) {
		console.log("time", time);
		var url_1 = 'http://www.shmachinist.com/ipsa_h5_blank/index.php?id=' + time;
		$(".code").empty().qrcode(url_1);
	}

	function polling() {
		axios.get('qrcodeController.php', {
			params: {
				flag: 1 // get last data
			}
		}).then(function(res) {
			if (res.data && res.data.id) {
				var stamp = res.data.stamp;
				var id = res.data.id;
				// var number = res.data.id;
				var name = res.data.name;
				if(parseInt(obj.stamp) !== parseInt(stamp)) {
					obj.stamp = stamp;
					console.log(swiper);
					var html = '';
					// html += '<div class="swiper-slide"  data-id="'+ stamp +'" onclick="toggleQrCode();"><div class="wrap_code" style="background-image:url(upload/' + stamp + '_1.jpg)"></div></div>';
					html += '<div class="swiper-slide"  data-id="'+ stamp +'"><div class="wrap_code" style="background-image:url(upload/' + stamp + '_1.jpg)"></div></div>';
					$('body').css('background-image', 'url(img/1.jpg)');
					$('.logo').show();
					$('.swiper-container').show();
					swiper.prependSlide(html);
					
					console.log('初めまして！');
				}
			}
			
		})
	}
	function toggleQrCode() {
		// $('.swiper-slide').on('click', function(event) {
		$('.swiper-container').on('click', '.swiper-slide', function(event) {
			event.preventDefault();
			var id = ($(this).data("id"));
			$('.qrcode_info').fadeToggle(500);
			$('.people').attr('src', 'upload/'+id+'_1.jpg');
			createQRCode(id);
		});
		$('.qrcode_info').on('click', function() {
			$(this).fadeOut(500);
		})
	}
	
</script>
</html>



