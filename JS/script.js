// Thanh search
let searchForm = document.querySelector('.search-form');
let searchBtn = document.querySelector('#search-btn');
if (searchBtn) {
    searchBtn.onclick = () => {
        searchForm.classList.toggle('active');
        shoppingCart.classList.remove('active');
        navbar.classList.remove('active');
        profile.classList.remove('active');
    }
}

// Nút shoppingCart
let shoppingCart = document.querySelector('.shopping-cart');
let cartBtn = document.querySelector('#cart-btn');
if (cartBtn) {
    cartBtn.onclick = () => {
        shoppingCart.classList.toggle('active');
        searchForm.classList.remove('active');
        navbar.classList.remove('active');
        profile.classList.remove('active');
    }
}

// Navbar
let navbar = document.querySelector('.navbar');
let menuBtn = document.querySelector('#menu-btn');
if (menuBtn) {
    menuBtn.onclick = () => {
        navbar.classList.toggle('active');
        searchForm.classList.remove('active');
        shoppingCart.classList.remove('active');
        profile.classList.remove('active');
    }
}

// Thẻ user
let profile = document.querySelector('.header .profile');
let userBtn = document.querySelector('#user-btn');
if (userBtn) {
    userBtn.onclick = () => {
        profile.classList.toggle('active');
        navbar.classList.remove('active');
        searchForm.classList.remove('active');
        shoppingCart.classList.remove('active');
    }
}

// Thẻ admin
let profile_admin = document.querySelector('.header .profile_admin');
let adminBtn = document.querySelector('#admin-btn');
if (adminBtn) {
    adminBtn.onclick = () => {
        profile_admin.classList.toggle('active'); // This should be profile_admin instead of profile
        navbar.classList.remove('active');
        searchForm.classList.remove('active');
    }
}

window.onscroll = () => {
    if (searchForm) searchForm.classList.remove('active');
    if (shoppingCart) shoppingCart.classList.remove('active');
    if (navbar) navbar.classList.remove('active');
    if (profile) profile.classList.remove('active');
    if (profile_admin) profile_admin.classList.remove('active');
}


var swiper = new Swiper(".product-slider", {
    loop:true,
    spaceBetween: 20,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    centeredSlides: true,
    breakpoints: {
    0: {
    slidesPerView: 1,
    },
    768: {
    slidesPerView: 2,
    },
    1020: {
    slidesPerView: 3,
    },
    },
});

var swiper = new Swiper(".review-slider", {
    loop:true,
    spaceBetween: 20,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    centeredSlides: true,
    breakpoints: {
    0: {
    slidesPerView: 1,
    },
    768: {
    slidesPerView: 2,
    },
    1020: {
    slidesPerView: 3,
    },
    },
});
