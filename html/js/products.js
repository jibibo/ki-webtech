function    showProducts() {
    let windowHeight = $(window).height();
    $(".products .product-list-item").each(function(){
        let thisPos = $(this).offset().top;

        let topOfWindow = $(window).scrollTop();
        if (topOfWindow + windowHeight - 200 > thisPos ) {
            $(this).addClass("fadeIn");
        }
    });
}

// if the image in the window of browser when the page is loaded, show that image
$(document).ready(function(){
    showProducts();
});

// if the image in the window of browser when scrolling the page, show that image
$(window).scroll(function() {
    showProducts();
});