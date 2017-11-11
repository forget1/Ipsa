$(function() {
	var app = new Vue({
		el: '#app',
		data: {
			// @todo change to 
			isChoosen: false,
			chooseNumber: 0,
		},
		computed: {
			imgs: function() {
				var imgs = [
					'url(./img/upload/2.jpg)',
					'url(./img/upload/3.jpg)',
					'url(./img/upload/4.jpg)',
					'url(./img/upload/5.jpg)',
					'url(./img/upload/1.jpg)'
				];
				return imgs;
			}
		},
		mounted: function() {
			this.enableSwiper();
		},
		methods: {
			choose: function() {
				// this.chooseNumber = num;
				var num = parseInt($('.swiper-slide-active').data('swiper-slide-index'));
				this.chooseNumber = num + 1;
				console.log('number', num);
			},
			goGenerate: function() {
				var that = this;
				if (!this.chooseNumber) return alert('请先选择一个');
				this.isChoosen = true;

				Vue.nextTick(function() {
					that.enableFullpage();
					that.enableSlide($('.generate'), that.imgs);
					console.log('number', that.chooseNumber);
				});					
			},
			enableSwiper: function() {
				var swiper = new Swiper('.swiper-container', {
					direction: 'horizontal',
					loop: true,
					observer:true, 
					observeParents:true,
					initialSlide: 1,
					effect: 'coverflow',
					coverflow: {
						rotate: 0,
						stretch: 20,
						depth: 150,
						modifier: 1,
						slideShadows : true
					},
					centeredSlides: true,
					slidesPerView: 1,
				});
			},
			enableFullpage: function() {
				$('#fullpage').fullpage({
					scrollingSpeed: 1100,
					verticalCentered: false
				});
			},
			enableSlide: function(ele, imgs) {
				var i = 0;
				setInterval(function() {
					i = (i < 4) ? (i + 1) : 0;
					ele.css('background-image', imgs[i]);
				}, 3000);
			}
		}
	})
});