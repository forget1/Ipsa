/**
 * Created by lmf on 2017/10/30.
 */
let fullpage;
let mySwiper;
new Vue({
    el: "#app",
    data: {
        flag: 0,
        info_show: false,
        from: from
    },
    created: function () {

    },
    mounted: function () {
        setTimeout(function () {
            $("#loading").fadeOut(1000);
        }, 2000);

        fullpage = $("#fullpage").fullpage({
            loopHorizontal: false
            // continuousHorizontal: true

        });
        // mySwiper = new Swiper('.swiper-container', {
        //     loop: true,
        //     centeredSlides: true,
        //     loopedSlides: 3,
        //     prevButton:'.swiper-button-prev',
        //     nextButton:'.swiper-button-next',
        //     onSlideChangeStart: function(){
        //         record("slide photos.");
        //     }
        // });

        // $("#info").on("click, tou", function (e) {
        //     e.preventDefault();
        //     e.stopPropagation();
        // })

    },
    methods: {
        show_info: function (index) {
            this.info_show = true;
            this.flag = index;
            // mySwiper.lockSwipes();
            // mySwiper.disableTouchControl()
        },
        hide_info: function () {
            this.info_show = false;
            // mySwiper.unlockSwipes();
            // mySwiper.enableTouchControl()

        }
    }
});


function record(mes) {
    $.ajax({
        url: "controller/ipsaController.php",
        type: "POST",
        data: {
            record: mes
        },
        success: function () {
            // console.log(mes);
        }
    });
}

function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone","SymbianOS", "Windows Phone","iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            triEvent = "touchend";
            return;
        }
    }
    triEvent = "click";
}
