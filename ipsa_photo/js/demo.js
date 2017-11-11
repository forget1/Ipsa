var imgs = [
	'url(./img/upload/2.jpg)',
	'url(./img/upload/3.jpg)',
	'url(./img/upload/4.jpg)',
	'url(./img/upload/5.jpg)',
	'url(./img/upload/1.jpg)'
];

// var swiper = new Swiper('.swiper-container', {
// 	direction: 'horizontal',
// 	loop: true,
// 	observer:true, 
// 	observeParents:true,
// 	initialSlide: 1
// });

// enableSlide($('.sub_1 .bg_move'), imgs);
// enableSlide($('.sub_2 .bg_move'), imgs);
// enableSlide($('.sub_3 .bg_move'), imgs);

// function enableSlide(ele, imgs) {
// 	var i = 0;
// 	setInterval(function() {
// 		i = (i < 4) ? (i + 1) : 0;
// 		ele.css('background-image', imgs[i]);
// 	}, 2000);
// }

// reset
// $('.logo').css({'top': '80%', 'opacity': '0'});
// $('.text').css({'top': '80%', 'opacity': '0'});
$('.sub_1 .bg_move').css({'background-image': 'url(./img/cut1/bg.png)'});

// $('.cut3_img').css({'opacity': '0'});
// $('.cut3_left').css({'left': '-10%'});
// $('.cut3_right').css({'right': '-10%'})


cut1().then(function() {
	return cut2();
}).then(function() {
	return cut3();
}).then(function() {
	return cut4();
}).then(function() {
	return cut5();
}).then(function() {
	return cut6();
}).then(function() {
	return cut7();
}).then(function() {
	return cut8();
}).then(function() {
	return cut9();
}).then(function() {
	return cut10();
});



function cut1() {
	return new Promise(function(resolve, reject) {
		move('.logo').set('top','50%').set('opacity', 1).ease('in-out').duration('1.2s').end(function() {
			move('.sub_1 .bg_move').set('background-image', 'url(./img/cut2/back.png)').delay('1s').end();
			move('.logo').set('opacity', 0).set('top','80%').duration('0s').delay('1s').end(function() {
				resolve();
			});
		});
	});
}

function cut2() {
	return new Promise(function(resolve, reject) {
		move('.cut2_text').set('top','50%').set('opacity', 1).delay('1s').ease('in-out').duration('1.2s').end(function() {
			// move('.sub_1 .bg_move').set('background-image', 'url(./img/cut3/bg.png)').delay('1s').end();
			move('.cut2_text').set('opacity', 0).set('top', '80%').delay('1s').end(function() {
				setTimeout(function() {
					resolve();
				}, 500);
			});
		});
	
	});
}

function cut3() {
	return new Promise(function(resolve, reject) {
		move('.cut3_img').set('opacity', 1).end();
		move('.cut3_right').set('opacity', 1).set('left', '5%').end();
		move('.cut3_left').set('opacity', 1).set('right', '5%').delay('0.5s').end(function() {
			setTimeout(function() {
				move('.cut3_img').set('opacity', '0').delay('0.5s').end();
				move('.cut3_left').set('opacity', '0').set('right', '30%').delay('0.5s').end();
				move('.cut3_right').set('opacity', '0').set('left', '30%').delay('0.5s').end(function() {	
					resolve();
				});
			}, 1200);
			
		});
	});
}

function cut4() {
	return new Promise(function(resolve, reject) {
		move('.cut4_text').set('top','50%').set('opacity', 1).ease('in-out').duration('1.2s').end(function() {
			move('.cut4_text').set('opacity', 0).set('top', '80%').delay('1s').end(function() {
				setTimeout(function() {
					resolve();
				}, 500);
			});
		});
	});
}

function cut5() {
	return new Promise(function(resolve, reject) {
		move('.cut5_img').set('opacity', 1).end();
		move('.cut5_right').set('opacity', 1).set('right', '10%').end();
		move('.cut5_left').set('opacity', 1).set('left', '10%').delay('0.5s').end(function() {
			setTimeout(function(){
				move('.cut5_img').set('opacity', '0').delay('0.5s').end();
				move('.cut5_left').set('opacity', '0').set('left', '-10%').delay('0.5s').end();
				move('.cut5_right').set('opacity', '0').set('right', '-10%').delay('0.5s').end(function() {
					resolve();
				});
			}, 1200);
			
		});
	});
}

function cut6() {
	return new Promise(function(resolve, reject) {
		move('.cut6_text').set('top','50%').set('opacity', 1).ease('in-out').duration('1.2s').end(function() {
			move('.cut6_text').set('opacity', 0).set('top', '80%').delay('1s').end(function() {
				setTimeout(function() {
					resolve();
				}, 500);
			});
		});
	});
}


function cut7() {
	return new Promise(function(resolve, reject) {
		move('.cut7_img').set('opacity', 1).end();
		move('.cut7_right').set('opacity', 1).set('right', '10%').end();
		move('.cut7_left').set('opacity', 1).set('left', '10%').delay('0.5s').end(function() {
			setTimeout(function() {
				move('.cut7_img').set('opacity', '0').delay('0.5s').end();
				move('.cut7_left').set('opacity', '0').set('left', '-10%').delay('0.5s').end();
				move('.cut7_right').set('opacity', '0').set('right', '-10%').delay('0.5s').end(function() {
					resolve();
				});
			}, 1200);
		});
	});
}

function cut8() {
	return new Promise(function(resolve, reject) {
		move('.cut8_text').set('top','50%').set('opacity', 1).ease('in-out').duration('1.2s').end(function() {
			move('.cut8_text').set('opacity', 0).set('top', '80%').delay('1s').end(function() {
				setTimeout(function() {
					resolve();
				}, 500);
			});
		});
	});
}

function cut9() {
	return new Promise(function(resolve, reject) {
		move('.cut9_img').set('opacity', 1).end();
		move('.cut9_right').set('opacity', 1).set('left', '5%').end();
		move('.cut9_left').set('opacity', 1).set('right', '5%').delay('0.5s').end(function() {
			setTimeout(function() {
				move('.cut9_img').set('opacity', '0').delay('0.5s').end();
				move('.cut9_left').set('opacity', '0').set('right', '30%').delay('0.5s').end();
				move('.cut9_right').set('opacity', '0').set('left', '30%').delay('0.5s').end(function() {
					resolve();
				});
			}, 1200);
		});
	});
}

function cut10() {
	return new Promise(function(resolve, reject) {
		move('.sub_1 .bg_move').set('background-image', 'url(./img/cut10/bg.png)').delay('0.5s').end(function() {
			move('.cut10_bottle').set('opacity', '1').end(function() {
				move('.cut10_nine').set('opacity', '1').set('top','8%').delay('0.2s').end();
				move('.cut10_lu').set('opacity', '1').set('top','13%').delay('0.4s').end();
				move('.cut10_love').set('opacity', '1').set('top','18%').delay('0.6s').end();
			});
			
		});
	});
}









