$(function() {
	var tmpData = {
		id: 0
	};

	$('.sub input').on('change', function() {
		var that = $(this);
		var file = this.files[0];
		if(!/image\/\w+/.test(file.type)){ 
			alert("文件必须为图片，请重新选择！");
			return false; 
		} 
		var reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onload = function (e) {
			that.siblings('.sub_img').prop('src', this.result);
		}
	});

	$('body').on('click', '.submit', function(e) {
		e.preventDefault();
		var that = this;
		var data = new FormData();
		var name = $('#name').prop('value');

		if (!name.length) {
			alert('请输入姓名!');
			return false;
		}

		data.append('name', name);
		data.append('action', 'insert');

		var validImg = true;
		$('#img_upload input:file').each(function(index) {
			var file = this.files[0];
			data.append('img_' + parseInt(index + 1), file);
			if (!file || !/image\/\w+/.test(file.type)) {
				alert("文件必须为图片，请重新选择！");
				validImg = false;
				return false;
			}
		});

		if (validImg === false) {
			return false;
		}

		axios({
			method: 'post',
			url: 'uploadController.php',
			data: data,
			headers: {
		      'content-Type': 'multipart/form-data'
		    }
		}).then(function(dt) {
			console.log("dt", dt);
			var time = dt.data.stamp;
			tmpData.id = dt.data.id;
			createQRCode(time);
			clearFormData();
			$('.cb_name').html(dt.data.name);
			$('.tip.tip_upload').show().delay(1000).fadeOut();
		});

	});



	function createQRCode(time) {
		console.log("time", time);
		var url_1 = 'http://www.shmachinist.com/ipsa_h5_blank/index.php?id=' + time;
		$('.sub_qrcode_1').empty().qrcode(url_1);
	}

	function clearFormData() {
		$('#img_upload')[0].reset();
		$('.sub_img').each(function() {
			$(this).prop('src', '');
		});
	}

});
 