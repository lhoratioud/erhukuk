
const observer = new PerformanceObserver((list) => {
  list.getEntries().forEach((entry) => {
    console.log(entry);
  });
});

observer.observe({ type: "longtask", buffered: true });



function sanitize() {
    const boxes = document.getElementsByClassName('boxContent');
    const entries = document.getElementsByClassName('entryContent');
    const serviceBoxes = document.getElementsByClassName('sanitize');

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

    for (var i = 0; i < serviceBoxes.length; i++) {
        c = serviceBoxes[i].textContent;
        d = c.replace(/\s*\<.*?\>\s*/g, '');
        serviceBoxes[i].textContent = d.replace(regex, '');
        serviceBoxes[i].textContent = serviceBoxes[i].textContent.replace(/&(uuml|Uuml|ouml|Ouml|Ccedil|rsquo|acirc|ccedil);/g, m => chars[m]);
        c = serviceBoxes[i].textContent;
        c = c.slice(0, c.length - 5);
        c = c.concat("...");
        serviceBoxes[i].textContent = c;
    }
}





const imgPaths = [
    ['pic1'],
    ['pic2'],
    ['pic3'],
    ['pic4']];


var radios = new Array();


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
        //if (y == true) 
        //{
        //    secondImg[0].src = "images/Index/menuIconCloseBlack.png";
        //}
        //else
        //{
        //    firstImg[0].src = "images/Index/menuIconCloseWhite.png";
        //}
        document.body.style.overflowY = "hidden";
        document.body.style.position = 'fixed';
        document.body.style.position = '';
        document.body.style.top = '';
    } 
    else if (x.classList.contains("passive")) 
    {
        x.classList.remove("passive"); 
        x.classList.add("active");
        //firstImg[0].src = "images/Index/menuIconWhite.png";
        //if (y == true) 
        //{
        //    secondImg[0].src = "images/Index/menuIconBlack.png"; 
        //}
        //else 
        //{
        //    firstImg[0].src = "images/Index/menuIconWhite.png";
        //}
        document.body.style.overflowY = "auto";
        document.body.style.position = '';
        document.body.style.top = '';
    }
    else 
    {
        x.classList.add("passive");
        //if (y == true) 
        //{
        //    secondImg[0].src = "images/Index/menuIconCloseBlack.png";
        //}
        //else
        //{
        //    firstImg[0].src = "images/Index/menuIconCloseWhite.png";
        //}
        document.body.style.overflowY = "hidden";
        document.body.style.position = 'fixed';
        document.body.style.position = '';
        document.body.style.top = '';
    }
}
		
function swapImg(isMobile) {


    var old = currImg;

    if(currImg < 3) {
        currImg++;
    }
    else if(currImg == 3) {
        currImg = 0;
    }
    
    if(isMobile)
    {
        radios[currImg].checked = true;
        setTimeout('swapImg(1)', 10100);
    }
    else
    {
        fadeIn(imgObj);
        setTimeout(() => {
              fadeOut(imgObj);
            /*if(currImg < 3) { 	radios[currImg+1].checked = true;	}
        else if(currImg == 3) { 	radios[0].checked = true;	} */
        }, 9000);
        radios[currImg].checked = true;
        setTimeout(`imgObj.classList.remove(imgPaths[${old}])`, 10100);
        setTimeout('imgObj.classList.add(imgPaths[currImg])', 10100);
        setTimeout('swapImg(0)', 10100);
    }
}
	



function load() {
	radios[0] = document.getElementById("slide1");
	radios[1] = document.getElementById("slide2");
	radios[2] = document.getElementById("slide3");
	radios[3] = document.getElementById("slide4");
    var width = window.innerWidth
    || document.documentElement.clientWidth
    || document.body.clientWidth;

    var height = window.innerHeight
    || document.documentElement.clientHeight
    || document.body.clientHeight;
	
    imgObj = document.getElementById("imgSwap");

    imgObj2 = document.getElementById('serviceAreasImage');



    setTimeout(() => {
        if(!(height < 500 || width < 1000))
        {
            imgObj.classList.add(imgPaths[0]);
            imgObj2.src ='images/Index/ist06.jpg';
            swapImg(0);
        }
        else
        {
            swapImg(1);
        }
    }, 50);
	
}

    

function fadeIn(el) {
	var BG = document.getElementById("imgSwap");
    el.style.opacity = 0;
    BG.style.transform= "scale(1)";
    var count = 1;
    var tick = function () {
        el.style.opacity = +el.style.opacity + 0.006;
        count += 0.00003;
        BG.style.transform = "scale(" + count + ")";
        if (+el.style.opacity < 1) {
            (window.requestAnimationFrame && requestAnimationFrame(tick)) || (setTimeout(tick, 16))
        }
        else if (count < 1.6) {
            (window.requestAnimationFrame && requestAnimationFrame(tock)) || setTimeout(tock, 16)
        }
    };
    var tock = function() {
        count += 0.00003;
        BG.style.transform = "scale(" + count + ")";
        if (count < 1.6) {
            (window.requestAnimationFrame && requestAnimationFrame(tock)) || setTimeout(tock, 16)
        }
    }
    tick();
    tock();
}



/*

$(document).ready(function() {
    $(window).scroll( function(){
        $('.animatedFadeInUp').each( function(i){
             
            var bottom_of_element = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
             
            if( (bottom_of_window + 100) > bottom_of_element ){
                $(this).addClass('fadeInUp');
            }
             
        });
    });
  
  });

*/
    










function fadeOut(el) {
	var BG = document.getElementById("imgSwap");
    el.style.opacity = 1;
    var tick = function() {
        el.style.opacity = +el.style.opacity - 0.0082;
        if (+el.style.opacity > 0) {
            (window.requestAnimationFrame && requestAnimationFrame(tick)) || (setTimeout(tick, 16))
        }
    }
    tick();
}





function e() { 
    var $nav1 = $("#mynav1");
    var $nav2 = $("#mynav2");
var menuPics = document.getElementsByClassName("menuIcon");
var menus = document.getElementsByClassName("UC_upperMenu");
    "use strict";
    if (document.body.scrollTop >= 120 || document.documentElement.scrollTop >= 120 ) {

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
    load();
    var $nav1 = $("#mynav1");
    var $nav2 = $("#mynav2");
var menuPics = document.getElementsByClassName("menuIcon");
var menus = document.getElementsByClassName("UC_upperMenu");
$(document).scroll(function () { 
    "use strict";
    if (document.body.scrollTop >= 120 || document.documentElement.scrollTop >= 120 ) {

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



	
