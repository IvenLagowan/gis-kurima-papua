// Navbar Transparent to White when scrolling
$(window).scroll(function () {
    var offset = $(window).scrollTop();
    // console.log(offset);
    $('.navbar').toggleClass('white', offset > 50);
});

$(function () {
    $('[data-toggle="popover"]').popover()
})

