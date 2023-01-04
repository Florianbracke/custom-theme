window.addEventListener('load', () => {

    let mobileButton = document.querySelector('div.menu-toggle');
    let mobileHeader = document.querySelector('header .menu-container-mobile');

    mobileButton.addEventListener('click', () => {

        mobileHeader.classList.toggle('active-mobile-header');

    })
})