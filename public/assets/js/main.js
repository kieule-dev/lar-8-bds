jQuery(function($){'use strict';$(window).on('scroll',function(){if($(this).scrollTop()>350){$('.navbar-area').addClass("is-sticky");}
else{$('.navbar-area').removeClass("is-sticky");}});jQuery('.mean-menu').meanmenu({meanScreenWidth:"1199"});$(".others-option-for-responsive .dot-menu").on("click",function(){$(".others-option-for-responsive .container .container").toggleClass("active");});$('.default-btn').on('mouseenter',function(e){var parentOffset=$(this).offset(),relX=e.pageX-parentOffset.left,relY=e.pageY-parentOffset.top;$(this).find('span').css({top:relY,left:relX})}).on('mouseout',function(e){var parentOffset=$(this).offset(),relX=e.pageX-parentOffset.left,relY=e.pageY-parentOffset.top;$(this).find('span').css({top:relY,left:relX})});$('.home-slides').owlCarousel({items:1,loop:true,nav:true,dots:false,smartSpeed:500,margin:30,autoHeight:true,animateOut:'fadeOut',animateIn:'fadeIn',autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],});$('.home-slides-two').owlCarousel({items:1,loop:true,nav:true,dots:true,smartSpeed:500,margin:30,autoHeight:true,animateOut:'fadeOut',animateIn:'fadeIn',autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],});$('.featured-slides').owlCarousel({loop:true,nav:true,dots:false,smartSpeed:500,margin:30,autoHeight:true,autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],responsive:{0:{items:1},768:{items:2},1200:{items:3}}});$('.case-study-slides').owlCarousel({loop:true,nav:true,dots:false,smartSpeed:500,margin:30,autoHeight:true,autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],responsive:{0:{items:1},768:{items:2},1200:{items:3}}});$('.testimonial-slides').owlCarousel({loop:true,nav:true,dots:false,smartSpeed:500,margin:30,autoHeight:true,items:1,autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],});$(".testimonial-slides").on("translate.owl.carousel",function(){$(".testimonial-item i").removeClass("animated fadeInUp").css("opacity","0");$(".testimonial-item p").removeClass("animated fadeInUp").css("opacity","0");$(".testimonial-item .info").removeClass("animated fadeInUp").css("opacity","0");$(".testimonial-image").removeClass("animated fadeInRight").css("opacity","0");});$(".testimonial-slides").on("translated.owl.carousel",function(){$(".testimonial-item i").addClass("animated fadeInUp").css("opacity","1");$(".testimonial-item p").addClass("animated fadeInUp").css("opacity","1");$(".testimonial-item .info").addClass("animated fadeInUp").css("opacity","1");$(".testimonial-image").addClass("animated fadeInRight").css("opacity","1");});$('.blog-slides').owlCarousel({loop:true,nav:false,autoHeight:true,dots:true,smartSpeed:500,margin:30,autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],responsive:{0:{items:1},768:{items:2},1200:{items:3}}});$('.blog-slides-two').owlCarousel({loop:true,items:1,nav:false,autoHeight:true,dots:true,smartSpeed:500,margin:30,autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],});$('.agents-slides').owlCarousel({loop:true,nav:true,dots:false,smartSpeed:500,margin:30,autoHeight:true,autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],responsive:{0:{items:1},768:{items:2},1200:{items:3}}});$('.customers-slides').owlCarousel({loop:true,nav:true,dots:false,autoHeight:true,smartSpeed:500,margin:20,autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],responsive:{0:{items:1},768:{items:2},1200:{items:4}}});$('.property-details-slides').owlCarousel({loop:true,nav:true,dots:false,smartSpeed:500,margin:20,autoHeight:true,autoplayHoverPause:true,autoplay:true,navText:["<i class='bx bx-left-arrow-alt'></i>","<i class='bx bx-right-arrow-alt'></i>"],responsive:{0:{items:1},768:{items:2},1200:{items:2}}});$('.top-properties-slides').owlCarousel({loop:true,nav:false,dots:true,items:1,autoHeight:true,smartSpeed:500,margin:20,autoplayHoverPause:true,autoplay:true,});$("#range-slider").slider({range:true,min:100,max:20000,values:[100,20000],slide:function(event,ui){$("#price-amount").val("$"+ui.values[0]+"-$"+ui.values[1]);}});$("#price-amount").val("$"+$("#range-slider").slider("values",0)+
" - $"+$("#range-slider").slider("values",1));$("#range-slider-2").slider({range:true,min:100,max:20000,values:[100,20000],slide:function(event,ui){$("#price-amount-2").val("$"+ui.values[0]+"-$"+ui.values[1]);}});$("#price-amount-2").val("$"+$("#range-slider-2").slider("values",0)+
" - $"+$("#range-slider-2").slider("values",1));$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');$('.tab ul.tabs li').on('click',function(g){var tab=$(this).closest('.tab'),index=$(this).closest('li').index();tab.find('ul.tabs > li').removeClass('current');$(this).closest('li').addClass('current');tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq('+index+')').slideUp();tab.find('.tab_content').find('div.tabs_item:eq('+index+')').slideDown();g.preventDefault();});$(".newsletter-form").validator().on("submit",function(event){if(event.isDefaultPrevented()){formErrorSub();submitMSGSub(false,"Please enter your email correctly.");}
else{event.preventDefault();}});function callbackFunction(resp){if(resp.result==="success"){formSuccessSub();}
else{formErrorSub();}}
function formSuccessSub(){$(".newsletter-form")[0].reset();submitMSGSub(true,"Thank you for subscribing!");setTimeout(function(){$("#validator-newsletter").addClass('hide');},4000)}
function formErrorSub(){$(".newsletter-form").addClass("animated shake");setTimeout(function(){$(".newsletter-form").removeClass("animated shake");},1000)}
function submitMSGSub(valid,msg){if(valid){var msgClasses="validation-success";}
else{var msgClasses="validation-danger";}
$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);}
$(".newsletter-form").ajaxChimp({url:"https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9",callback:callbackFunction});$('select').niceSelect();$('.odometer').appear(function(e){var odo=$(".odometer");odo.each(function(){var countNumber=$(this).attr("data-count");$(this).html(countNumber);});});$('.popup-youtube').magnificPopup({disableOn:320,type:'iframe',mainClass:'mfp-fade',removalDelay:160,preloader:false,fixedContentPos:false});function makeTimer(){var endTime=new Date("December 31, 2022 17:00:00 PDT");var endTime=(Date.parse(endTime))/1000;var now=new Date();var now=(Date.parse(now)/1000);var timeLeft=endTime-now;var days=Math.floor(timeLeft/86400);var hours=Math.floor((timeLeft-(days*86400))/3600);var minutes=Math.floor((timeLeft-(days*86400)-(hours*3600))/60);var seconds=Math.floor((timeLeft-(days*86400)-(hours*3600)-(minutes*60)));if(hours<"10"){hours="0"+hours;}
if(minutes<"10"){minutes="0"+minutes;}
if(seconds<"10"){seconds="0"+seconds;}
$("#days").html(days+"<span>Days</span>");$("#hours").html(hours+"<span>Hours</span>");$("#minutes").html(minutes+"<span>Minutes</span>");$("#seconds").html(seconds+"<span>Seconds</span>");}
setInterval(function(){makeTimer();},0);if($('.wow').length){var wow=new WOW({mobile:false});wow.init();}
$(window).on('scroll',function(){var scrolled=$(window).scrollTop();if(scrolled>600)$('.go-top').addClass('active');if(scrolled<600)$('.go-top').removeClass('active');});$('.go-top').on('click',function(){$("html, body").animate({scrollTop:"0"},500);});$(window).on('load',function(){$('.preloader').addClass('preloader-deactivate');});}(jQuery));


$("input[type='password'][data-eye]").each(function(i) {
    let $this = $(this);

    $this.wrap($("<div/>", {
        style: 'position:relative'
    }));
    $this.css({
        paddingRight: 60
    });
    $this.after($("<div/>", {
        html: 'Show',
        class: 'btn btn-primary btn-sm',
        id: 'passeye-toggle-'+i,
        style: 'position:absolute;right:10px;top:50%;transform:translate(0,-50%);padding: 2px 7px;font-size:12px;cursor:pointer;'
    }));
    $this.after($("<input/>", {
        type: 'hidden',
        id: 'passeye-' + i
    }));
    $this.on("keyup paste", function() {
        $("#passeye-"+i).val($(this).val());
    });
    $("#passeye-toggle-"+i).on("click", function() {
        if($this.hasClass("show")) {
            $this.attr('type', 'password');
            $this.removeClass("show");
            $(this).removeClass("btn-outline-primary");
        }else{
            $this.attr('type', 'text');
            $this.val($("#passeye-"+i).val());				
            $this.addClass("show");
            $(this).addClass("btn-outline-primary");
        }
    });
});