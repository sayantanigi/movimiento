$(function(){
  $('#showconfirmpass').click(function(){
    if($(this).hasClass('fa-eye-slash')){
      $(this).removeClass('fa-eye-slash');
      $(this).addClass('fa-eye');
      $('#confirmpassword').attr('type','text');
    }else{
       $(this).removeClass('fa-eye');
       $(this).addClass('fa-eye-slash');  
       $('#confirmpassword').attr('type','password');
      }
  });
  $('#showpass').click(function(){
    if($(this).hasClass('fa-eye-slash')){
      $(this).removeClass('fa-eye-slash');
      $(this).addClass('fa-eye');
      $('#password').attr('type','text');
    }else{
       $(this).removeClass('fa-eye');
       $(this).addClass('fa-eye-slash');  
       $('#password').attr('type','password');
      }
  });
});
$('#discover').owlCarousel({
    loop:false,
    margin:15,
    nav:true,
    dots:false,
    autoplay:true,
    navText:["<div class='nav-btn prev-slide'><i class='fas fa-chevron-left'></i></div>","<div class='nav-btn next-slide'><i class='fas fa-chevron-right'></i></div>"],
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$('#players').owlCarousel({
    loop:false,
    margin:15,
    nav:true,
    dots:false,
    autoplay:true,
    navText:["<div class='nav-btn prev-slide'><i class='fas fa-chevron-left'></i></div>","<div class='nav-btn next-slide'><i class='fas fa-chevron-right'></i></div>"],
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$('#scores').owlCarousel({
    loop:false,
    margin:15,
    nav:true,
    dots:false,
    autoplay:true,
    navText:["<div class='nav-btn prev-slide'><i class='fas fa-chevron-left'></i></div>","<div class='nav-btn next-slide'><i class='fas fa-chevron-right'></i></div>"],
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$('#topteam').owlCarousel({
    loop:false,
    margin:15,
    nav:true,
    dots:false,
    autoplay:true,
    navText:["<div class='nav-btn prev-slide'><i class='fas fa-chevron-left'></i></div>","<div class='nav-btn next-slide'><i class='fas fa-chevron-right'></i></div>"],
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$('#spocerSlide').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    autoplay:true,
    navText:["<div class='nav-btn prev-slide'><i class='fas fa-chevron-left'></i></div>","<div class='nav-btn next-slide'><i class='fas fa-chevron-right'></i></div>"],
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});


/*******/
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});