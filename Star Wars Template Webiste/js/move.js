const hamburger = document.querySelector('.header .nav-bar .nav-list .hamburger');
const mobile_menu = document.querySelector('.header .nav-bar .nav-list ul');
const header = document.querySelector('.header.container');
const Scrolltp = document.querySelector("#scrolltb");

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    mobile_menu.classList.toggle('active');
});

document.addEventListener('scroll',()=>{
    var scroll_position = window.scrollY;
    if(scroll_position > 250){
        header.style.backgroundcolor = "black";
    }else{
        header.style.backgroundcolor ="transparent";
    }
});


//Scroll to top


scrolltb.addEventListener('click' , function(){
    window.scrollTo({
        top:0,
        left:0,
        behavior:"smooth",
});
});

window.addEventListener('scroll', function(){
    
    if(window.scrollY>=700){
        Scrolltp.style.opacity = 1;
    }
    else{
        Scrolltp.style.opacity = 0;
        
    }
    
});

