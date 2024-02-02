

import Splide from "@splidejs/splide";
import '@splidejs/splide/css';

const spl = document.querySelector('.splide');

if (spl) {
    const splide = new Splide( '.splide',{
        type: 'loop',
        perPage: 1,
        // drag   : 'free',
        arrows: false,
        autoplay: 'play',
        interval: 5000,
        lazyLoad: true,
        // pagination: false
    } ).mount();
}


