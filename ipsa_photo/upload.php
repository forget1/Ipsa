<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Slide</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/upload.css">
</head>
<body>
<div class="container">
	<form id="img_upload">
		<input type='hidden' name='MAX_FILE_SIZE' value='8388608' /> 
		<h3 class="title">IPSA</h3>
		<div class="general">
			<label for="name">输入姓名</label>
			<input type="text" maxlength="50" id="name" value="">
		</div>
		
		<div class="sub">
			<label for="img_1">照片一</label>
			<input type="file" name="img_1" id="img_1">
			<img class="sub_img img_show_1" src="" alt="" >
		</div>
		<div class="sub">
			<label for="img_2">照片二</label>
			<input type="file" name="img_2" id="img_2">
			<img class="sub_img img_show_2" src="" alt="">
		</div>
		<div class="sub">
			<label for="img_3">照片三</label>
			<input type="file" name="img_3" id="img_3">	
			<img class="sub_img img_show_3" src="" alt="">
		</div>
		
		<input class="submit" type="submit" value="上传图片" name="submit">
	</form>
	<div class="qrcode">
		<h4 class="cb_name"></h4>
		<h6 class="cb_city"></h6>
		<div class="sub_qrcode sub_qrcode_1">
			
		</div>

	</div>
	<div class="tip tip_upload">
		已上传!
	</div>
</div>
</body>
<script src="js/lib/jquery-1.11.1.min.js"></script>
<script src="js/lib/axios.min.js"></script>
<script src="js/lib/jquery.qrcode.min.js"></script>
<script src="js/upload.js"></script>
</html>