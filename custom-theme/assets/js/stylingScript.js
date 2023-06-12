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

	
	/* FILTER EMPTY BUTTONS */

	allButtons = document.querySelectorAll('body.logged-in a.wp-block-button__link');
	allButtons.forEach(button => {
		if(!button.href){
			button.classList.add('emptyButton');
		}
	});

	let emptyButtonStyles = `.wp-block-button__link.emptyButton{ background-color: rgba(255, 0, 0, 0.493) !important; }`;
	let styleSheet = document.createElement("style")
	styleSheet.innerText = emptyButtonStyles
	document.head.appendChild(styleSheet)

	
	
});



let styles = `

    .odd-element.visible{
        animation: moveRight 0.5s ease-in;;
    }
    .even-element.visible{
        animation: moveLeft 0.5s ease-in;
    }

}`;

let styleSheet = document.createElement("style")
styleSheet.innerText = styles
document.head.appendChild(styleSheet)
