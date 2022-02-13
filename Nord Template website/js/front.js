$(document).ready(function() {
    $(".language").click(function() {
        $(".languages-back-shadow").fadeIn(400);
    });
    $(".languages-back-shadow").click(function() {
        $(this).fadeOut(400);
    });

    $(".category .plus i").on("click", function() {
        $(this).toggleClass('fa-minus fa-plus');
        $(this).parent().next().fadeToggle(600);

    });

    // Cart
    $(".cart .close").click(function() {
        $(".cart-back").fadeOut(400);
    });

    $(".fa-shopping-cart").click(function() {
        $(".cart-back").fadeIn(400);
    })

    $(document).on("click", ".plus-icon", function() {
        let quantity = $(this).parent().parent().parent().find(".elements-number").text();
        let Price = $(this).parent().parent().parent().parent().find(".addd").text();
        let id = $(this).parent().parent().parent().parent().parent().find(".cart-element").attr("id");
        Pricenumber = parseInt(Price);
        quantitynumber = parseInt(quantity);
        quantitynumber += 1;
        totalValueNumber = (parseInt(Pricenumber) * quantitynumber);
        $(this).parent().parent().parent().find(".elements-number").text(quantitynumber);
        $(this).parent().parent().parent().parent().find(".elements-number").text(quantitynumber);
        $(this).parent().parent().parent().find(".quantity-price").text(totalValueNumber);
        $(".receipt-back #" + id).find(".reciept-element-number").text(quantitynumber);
        $(".receipt-back #" + id).find(".reciept-element-price").text(totalValueNumber);


    });
    $(document).on("click", ".minus-icon", function() {
        let quantity = $(this).parent().parent().parent().find(".elements-number").text();
        let Price = $(this).parent().parent().parent().parent().find(".addd").text();
        let id = $(this).parent().parent().parent().parent().parent().find(".cart-element").attr("id");
        Pricenumber = parseInt(Price);
        quantitynumber = parseInt(quantity);
        quantitynumber -= 1;
        totalValueNumber = (parseInt(Pricenumber) * quantitynumber);
        $(this).parent().parent().parent().find(".elements-number").text(quantitynumber);
        $(this).parent().parent().parent().parent().find(".elements-number").text(quantitynumber);
        $(this).parent().parent().parent().find(".quantity-price").text(totalValueNumber);
        $(".receipt-back #" + id).find(".reciept-element-number").text(quantitynumber);
        $(".receipt-back #" + id).find(".reciept-element-price").text(totalValueNumber);
    });




    // Add To Cart
    $(".element-plus i").click(function() {
        let elementName = $(this).parent().parent().find(".element-name").text();
        let elementPrice = $(this).parent().parent().find(".element-element-price").text();

        let id = $(this).parent().parent().parent().parent().find(".category-element").attr("id");


        $(".cart .container").append('<div  class="row">\
        <div id="' + id + '" class="cart-element">\
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">\
            <h1 class="add-element-name">' + elementName + '</h1><br>\
            <span class="elements-number added-number">1</span><h2>x <span class="addd add-element-price">' + elementPrice + '</span> din</h2>\
            <h3>Ukupono:</h3>\
        </div>\
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">\
            <div class="numbers"><span><i class="minus-icon fa fa-minus fa-lg" aria-hidden="true"></i> </span> <span class="elements-number">1</span>\
            <span class="plus-icon-span"><i class="plus-icon fa fa-plus fa-lg" aria-hidden="true"></i> </span>\
            </div>\
            <h3><span class="add-element-price quantity-price">' + elementPrice + '</span> din</h3>\
        </div>\
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">\
        <div class="trash">\
        <i class="fa fa-trash fa-lg" aria-hidden="true"></i>\
        </div>\
        </div>\
        </div>\
        </div>');

        $(".receipt-elements").append('<div class="row">\
        <div  id="' + id + '"  class="receippt-element">\
        <span class="receipt-element-name">' + elementName + '</span> <span><i class="close3 fa fa-times"\
                aria-hidden="true"></i></span> <span class="reciept-element-quantity"><span\
                class="reciept-element-number">1</span> kom</span>\
        <h3 class="reciept-element-price">' + elementPrice + '</h3>\
        </div>\
    </div>');


        $(".red-circle").fadeIn(200).delay(200).fadeOut(200).css("left", "5%");
        $(".fa-shopping-cart").css("position", "relative").animate({
            left: "-=5%",
        }, 200).animate({
            left: "+=5%",
        }, 200);





    });

    $(document).on("click", ".add-to-cart .btn", function() {
        let elementName = $(this).parent().parent().find(".cat1").text();
        let elementPrice = $(this).parent().parent().find(".cat-element-price").text();
        let quant = $(this).parent().parent().find(".elements-number").text();
        let id = $(this).parent().parent().parent().parent().find(".category-element").attr("id");


        $(".cart .container").append('<div  class="row">\
        <div id="' + id + '" class="cart-element">\
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">\
            <h1 class="add-element-name">' + elementName + '</h1><br>\
            <span class="elements-number added-number">' + parseInt(quant) + '</span><h2>x <span class="addd add-element-price">' + parseInt(elementPrice) + '</span> din</h2>\
            <h3>Ukupono:</h3>\
        </div>\
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">\
            <div class="numbers"><span><i class="minus-icon fa fa-minus fa-lg" aria-hidden="true"></i> </span> <span class="elements-number">' + parseInt(quant) + '</span>\
            <span class="plus-icon-span"><i class="plus-icon fa fa-plus fa-lg" aria-hidden="true"></i> </span>\
            </div>\
            <h3><span class="add-element-price quantity-price">' + parseInt(elementPrice) * parseInt(quant) + '</span> din</h3>\
        </div>\
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">\
        <div class="trash">\
        <i class="fa fa-trash fa-lg" aria-hidden="true"></i>\
        </div>\
        </div>\
        </div>\
        </div>');

        $(".receipt-elements").append('<div class="row">\
        <div  id="' + id + '"  class="receippt-element">\
        <span class="receipt-element-name">' + elementName + '</span> <span><i class="close3 fa fa-times"\
                aria-hidden="true"></i></span> <span class="reciept-element-quantity"><span\
                class="reciept-element-number">' + parseInt(quant) + '</span> kom</span>\
        <h3 class="reciept-element-price">' + parseInt(elementPrice) * parseInt(quant) + '</h3>\
        </div>\
    </div>');




    });
    $(document).on("click", ".element-minus i", function() {
        let elementName = $(this).parent().parent().find(".element-name").text();
        let elementPrice = $(this).parent().parent().find(".element-element-price").text();
        let id = $(this).parent().parent().parent().parent().find(".category-element").attr("id");
        let elementtoremove = $(".cart #" + id).parent();
        let elementtoremoveres = $(".receipt #" + id).parent();

        elementtoremove.remove();
        elementtoremoveres.remove();



    });
    $(document).on("click", ".fa-trash", function() {
        let id = $(this).parent().parent().parent().parent().find(".cart-element").attr("id");
        $(".receipt #" + id).parent().remove();
        $(this).parent().parent().parent().parent().remove();

    });

    // Added Elements




    $(".element-name").click(function() {
        let elementName = $(this).parent().parent().find(".element-name").text();
        let elementPrice = $(this).parent().parent().find(".element-element-price").text();
        let id = $(this).parent().parent().parent().parent().find(".row").attr("id");

        $(".element").append('<div id"' + id + '" class="row">\
        <div class="head-element">\
            <h1 class="cat-element-name cat1">' + elementName + '</h1>\
            <i class="close2 fa fa-times" aria-hidden="true"></i>\
        </div>\
    </div>\
    <div class="description2">\
        <h2 class="cat-element-name" >' + elementName + '</h2>\
        <h3>Cena <span class="cat-element-price">' + elementPrice + '</span> din</h3>\
        <p>Food contains the nutrition that people and animals need to be healthy. The consumption of food is normally enjoyable to humans. It contains protein, fat, carbohydrates, vitamins, water and minerals. Liquids used for energy and nutrition are often called "drinks"\
        </p>\
    </div>\
    <div class="quantity">\
        <h2>Quantity</h2>\
        <div class="add-quantity">\
        <span><i class="minus-icon fa fa-minus fa-lg" aria-hidden="true"></i> </span> <span class="elements-number">1</span>\
        <span class="plus-icon-span"><i class="plus-icon fa fa-plus fa-lg" aria-hidden="true"></i> </span>\
        </div>\
    </div>\
    <div class="add-to-cart">\
        <a class="btn btn-success">Add To Cart</a>\
    </div>')

        $(".element-back").fadeIn(400);


    });

    $(document).on("click", ".close2", function() {
        $(this).parent().parent().parent().find(".quantity").remove();
        $(this).parent().parent().parent().find(".add-to-cart").remove();
        $(this).parent().parent().parent().find(".description2").remove();
        $(this).parent().parent().parent().find(".row").remove();

        $(".element-back").fadeOut(500);

    });


    // Reciept Section
    $(".receipt-header i").click(function() {
        $(".receipt-back").fadeOut(400);

    });

    $(".footer-cart .btn").click(function() {

        $(".cart-back").fadeOut(400);
        $(".receipt-back").fadeIn(400);


    })

    $(document).on("click", ".close3", function() {
        let id = $(this).parent().parent().parent().find(".receippt-element").attr("id");
        console.log(id);
        $(".cart #" + id).parent().remove();
        $(this).parent().parent().parent().remove();
    });








});