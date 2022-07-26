window.addEventListener('load', () => {

	/* LAZY LOADING ANIMATIE */

	if ( window ) {
 
		let targets = document.querySelectorAll('.wp-block-columns');

		for (let i = 0; i < targets.length; i++){

			if (i % 2 == 0) {
				targets[i].classList.add('even-element');
			}

			else {
				targets[i].classList.add('odd-element');
			}

		}


		function handleIntersection(entries) {

			entries.map((entry) => {

				if (entry.isIntersecting) {

					entry.target.classList.add('visible');

				} 

			});

		}

		const observer = new IntersectionObserver(handleIntersection);

		targets.forEach(target =>
			observer.observe(target)
		);
	
	}
});



let styles = `

    .odd-element.visible{
        animation: moveRight 0.5s ease-in;;
    }
    .even-element.visible{
        animation: moveLeft 0.5s ease-in;
    }

    @keyframes moveLeft {
        from {
            transform: translatex(-100px);
            opacity: 0;
        } to {
            transform: translatex(0px);
            opacity: 1;  
        }
    }
    @keyframes moveRight {
        from {
            transform: translatex(100px);
            opacity: 0; 
        } to {
            transform: translatex(0px);
            opacity: 1;  
        }
}`;

let styleSheet = document.createElement("style")
styleSheet.innerText = styles
document.head.appendChild(styleSheet)