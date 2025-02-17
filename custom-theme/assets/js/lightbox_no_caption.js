window.addEventListener('load', () => {
    document.querySelectorAll('.wp-block-gallery:not(.lightbox-off)').forEach(gallery => {
        let lightboxImgs = gallery.querySelectorAll('img');
        let body = document.querySelector('body');

        lightboxImgs.forEach((img, index) => {
            img.addEventListener('click', function() {
                let currentSlide = index;
                body.classList.add('lightbox-active');

                // Lightbox container
                let lightbox = document.createElement('div');
                lightbox.classList.add('lightbox');
                document.body.appendChild(lightbox);

                // Lightbox image
                let lightboxImg = document.createElement('img');
                lightboxImg.src = img.src;
				lightboxImg.draggable = 'false';
                lightbox.appendChild(lightboxImg);

                // Navigation arrows
                let left = document.createElement('div');
                left.classList.add('left', 'arrow');
                body.appendChild(left);
                let right = document.createElement('div');
                right.classList.add('right', 'arrow');
                body.appendChild(right);

                function goToSlide(n) {
                    currentSlide = (n + lightboxImgs.length) % lightboxImgs.length;
                    lightboxImg.src = lightboxImgs[currentSlide].src;
                }

                left.addEventListener('click', () => goToSlide(currentSlide - 1));
                right.addEventListener('click', () => goToSlide(currentSlide + 1));
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') goToSlide(currentSlide - 1);
                    if (e.key === 'ArrowRight') goToSlide(currentSlide + 1);
                    if (e.key === 'Escape') closeLightbox();
                });

                function closeLightbox() {
                    lightbox.remove();
                    left.remove();
                    right.remove();
                    body.classList.remove('lightbox-active');
                }

                lightbox.addEventListener('click', closeLightbox);
            });
        });
    });
    
    let lightboxStyles = `
        body.lightbox-active{
            overflow: hidden;
        }
        .arrow{
            cursor: pointer;
            padding: 50px;
            z-index: 10000;
            position: fixed;
            top: 50%;
            left: 5%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.4s;
        }
        .arrow::before{
            content: '<';
            width: 30px;
            height: 30px;
            color: white;
            position: absolute;
            top: calc( 50% - 15px);
            left: calc( 50% - 15px);
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .arrow.right{
            right: 5%;
            left: unset;
        }
        .arrow.right::before{
            content: '>';
        }
        .lightbox{
            position: fixed;
            top: 0;
            z-index: 1000;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #000000eb;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .lightbox img{
            max-width: 100%;
			user-select: none;
            max-height: 100%;
        }
        @media screen and (max-width: 768px){
    
            .lightbox img{
                object-fit: cover;
                max-width: 100vw;
                max-height: 100vh;
            }
            .lightbox{
                align-items: center;
                padding: 20px;
                box-sizing: border-box;
            }
            .arrow{
                display: none;
            }
        }
    `;
    
    let styleSheetLightbox = document.createElement("style")
    styleSheetLightbox.innerText = lightboxStyles;
    document.head.appendChild(styleSheetLightbox);
        
})
