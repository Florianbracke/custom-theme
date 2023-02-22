window.addEventListener('load', () => {

    let mobileButton = document.querySelector('.menu-toggle');
    let mobileHeader = document.querySelector('header .menu-container-mobile');
	let body = document.querySelector('body');

    mobileButton.addEventListener('click', () => {
		mobileButton.classList.toggle('active-mobile-header');
        mobileHeader.classList.toggle('active-mobile-header');
		body.classList.toggle('active-mobile-header');
    })
})
