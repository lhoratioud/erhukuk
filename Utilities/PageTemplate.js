
function sanitize() {
    const boxes = document.getElementsByClassName('boxContent');
    const entries = document.getElementsByClassName('entryContent');

    let regex = /&(nbsp|amp|quot|lt|gt);/g;

    const chars = {
        '&uuml;': 'ü',
        '&Uuml;': 'Ü',
        '&ouml;': 'ö',
        '&Ouml;': 'Ö',
        '&Ccedil;': 'Ü',
        '&rsquo;': '\'',
        '&acirc;': 'â',
        '&ccedil;': 'ç'
    };
      

    var d;
    var c;


    for (var i = 0; i < boxes.length; i++) {
        c = boxes[i].textContent;
        d = c.replace(/\s*\<.*?\>\s*/g, '');
        boxes[i].textContent = d.replace(regex, '');
        boxes[i].textContent = boxes[i].textContent.replace(/&(uuml|Uuml|ouml|Ouml|Ccedil|rsquo|acirc|ccedil);/g, m => chars[m]);
        c = boxes[i].textContent;
        c = c.slice(0, c.length - 3);
        c = c.concat("...");
        boxes[i].textContent = c;
    }

    for (var i = 0; i < entries.length; i++) {
        c = entries[i].textContent;
        d = c.replace(/\s*\<.*?\>\s*/g, '');
        entries[i].textContent = d.replace(regex, '');
        entries[i].textContent = entries[i].textContent.replace(/&(uuml|Uuml|ouml|Ouml|Ccedil|rsquo|acirc|ccedil);/g, m => chars[m]);
        c = entries[i].textContent;
        c = c.slice(0, c.length - 3);
        c = c.concat("...");
        entries[i].textContent = c;
    }
}



var currImg = 0;

function tabtoggle() {

    var firstImg = document.getElementsByClassName("menuI1");
    var secondImg = document.getElementsByClassName("menuI2");
    var y = false;
    var x = document.getElementById("tabmenu");

    if (document.body.scrollTop >= 180 || document.documentElement.scrollTop >= 180 )
        y = true;


    if (x.classList.contains("active")) 
    {
        x.classList.remove("active");
        x.classList.add("passive");
        if (y == true) 
        {
            secondImg[0].src = "images/Index/menuIconCloseBlack.png";
        }
        else
        {
            firstImg[0].src = "images/Index/menuIconCloseWhite.png";
        }
        document.body.style.overflowY = "hidden";
        document.body.style.position = 'fixed';
        document.body.style.position = '';
        document.body.style.top = '';
    } 
    else if (x.classList.contains("passive")) 
    {
        x.classList.remove("passive"); 
        x.classList.add("active");
        firstImg[0].src = "images/Index/menuIconWhite.png";
        if (y == true) 
        {
            secondImg[0].src = "images/Index/menuIconBlack.png"; 
        }
        else 
        {
            firstImg[0].src = "images/Index/menuIconWhite.png";
        }
        document.body.style.overflowY = "auto";
        document.body.style.position = '';
        document.body.style.top = '';
    }
    else 
    {
        x.classList.add("passive");
        if (y == true) 
        {
            secondImg[0].src = "images/Index/menuIconCloseBlack.png";
        }
        else
        {
            firstImg[0].src = "images/Index/menuIconCloseWhite.png";
        }
        document.body.style.overflowY = "hidden";
        document.body.style.position = 'fixed';
        document.body.style.position = '';
        document.body.style.top = '';
    }
}
		

function removeQuotes () {

    var content = document.getElementById("content").textContent;
    document.getElementById("content").textContent = content.replace('"', '');
    document.getElementById("content").style.background = 'green';
}




$(document).ready(function() {
    $(window).scroll( function(){
        $('.animatedFadeInUp').each( function(i){
             
            var bottom_of_element = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
             
            if( (bottom_of_window + 800) > bottom_of_element ){
                $(this).addClass('fadeInUp');
            }
             
        });
    });
  
});


function scrollDown() {
    $('html,body').animate({
        scrollTop: $(".ekibBaslangic").offset().top},
        'slow');
};

    
    



function e() { 
    var $nav1 = $("#mynav1");
    var $nav2 = $("#mynav2");
var menuPics = document.getElementsByClassName("menuIcon");
var menus = document.getElementsByClassName("UC_upperMenu");
    "use strict";
    if (document.body.scrollTop >= 100 || document.documentElement.scrollTop >= 100 ) {

        document.getElementById("menuI").src = "images/Index/menuIconBlack.png";


        for(var i=0; i < menuPics.length ; i++) 
        {
           menuPics.item(i).src = "/images/Index/menuIconBlack.png";
        }

        $nav1.hide();
        $nav2.show();


    } 
    else {


        for(var i=0; i < menuPics.length ; i++) 
        {
           menuPics.item(i).src = "/images/Index/menuIconWhite.png";
        }

        $nav2.hide();
        $nav1.show();

    }
}





$(document).ready(function() {
    var $nav1 = $("#mynav1");
    var $nav2 = $("#mynav2");
var menuPics = document.getElementsByClassName("menuIcon");
var menus = document.getElementsByClassName("UC_upperMenu");
$(document).scroll(function () { 
    "use strict";
    if (document.body.scrollTop >= 100 || document.documentElement.scrollTop >= 100 ) {

        document.getElementById("menuI").src = "images/Index/menuIconBlack.png";


        for(var i=0; i < menuPics.length ; i++) 
        {
           menuPics.item(i).src = "/images/Index/menuIconBlack.png";
        }

        $nav1.hide();
        $nav2.show();


    } 
    else {


        for(var i=0; i < menuPics.length ; i++) 
        {
           menuPics.item(i).src = "/images/Index/menuIconWhite.png";
        }

        $nav2.hide();
        $nav1.show();

    }
});
e();});	



	
