$(document).ready(function() {
    const happyClients = parseInt($('.landing-section .happy-client div  h4').text());
    const projectNumber = parseInt($('.projects-number').text());
    const emailNumber = parseInt($('.Email-number').text());
    const clientsNumber = parseInt($('.Clients-number').text());
    const cupsNumber = parseInt($('.Cups-number').text());

    var i = 1;
    var p = 1;
    var e = 1;
    var c = 1;
    var cu = 1;


    function myLoopI() {
        setTimeout(function() {
            $('.landing-section .happy-client div  h4').text(i);
            i++;
            if (i <= happyClients) {
                myLoopI();
            }
        }, 5)
    }

    myLoopI();

    function myLoopP() {
        setTimeout(function() {
            $('.projects-number').text(p);
            p++;
            if (p <= projectNumber) {
                myLoopP();
            }
        }, 5)
    }

    myLoopP();



    function myLoopE() {
        setTimeout(function() {
            $('.Email-number').text(e);
            e++;
            if (e <= emailNumber) {
                myLoopE();
            }
        }, 5)
    }

    myLoopE();






    function myLoopC() {
        setTimeout(function() {
            $('.Clients-number').text(c);
            c++;
            if (c <= clientsNumber) {
                myLoopC();
            }
        }, 5)
    }

    myLoopC();



    function myLoopCU() {
        setTimeout(function() {
            $('.Cups-number').text(cu);
            cu++;
            if (cu <= cupsNumber) {
                myLoopCU();
            }
        }, 5)
    }

    myLoopCU();


    $(".show-nav").click(function() {
        $("nav ul").css({
            right: 0
        })
    });
    $("nav .back").click(function() {
        $("nav ul").css({
            right: "-80%"
        })
    });

    $(".top-page").click(function() {
        $('html,body').scrollTop(0);
    });
});