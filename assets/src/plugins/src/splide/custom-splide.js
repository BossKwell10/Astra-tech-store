// Basic




var splide = new Splide('.splide', {
    direction: 'rtl'
});
splide.mount();


// Multiple Slider
var splideMultiple = new Splide('.splide-multiple', {
    perPage: 3,
    rewind: true,
    direction: 'rtl'
});

splideMultiple.mount();


// Pagination

var splidePagiantion = new Splide('.splide-pagination', {
    direction: 'rtl'
});

splidePagiantion.on('pagination:mounted', function (data) {
    // data.items contains all dot items
    data.items.forEach(function (item) {
        item.button.textContent = String(item.page + 1);
        item.li.parentNode.classList.add('numberic-pagination')
    });
});

splidePagiantion.mount();

// Thumbnail

var main = new Splide('.splide-mainThubnail', {
    type: 'fade',
    heightRatio: 0.5,
    pagination: false,
    arrows: false,
    cover: true,
    direction: 'rtl',
    //   fixedWidth: 656,
    fixedHeight: 556,
});

// Thumbnail -> Slider

var thumbnails = new Splide('#thumbnail-slider', {
    rewind: true,
    fixedWidth: 104,
    fixedHeight: 58,
    isNavigation: true,
    gap: 10,
    focus: 'center',
    pagination: false,
    cover: true,
    direction: 'rtl',
    dragMinThreshold: {
        mouse: 4,
        touch: 10,
    },
    breakpoints: {
        640: {
            fixedWidth: 66,
            fixedHeight: 38,
        },
    },
});

main.sync(thumbnails);
main.mount();
thumbnails.mount();

const lightbox = GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
});