
//TODO : show empty buttons in page editor

window.addEventListener('load', () =>{
    let allButtons = document.querySelectorAll('body.logged-in a.wp-block-button__link');

    allButtons.forEach(button => {
      if(!button.href){
        button.classList.add('emptyButton');
      }
    });

    let emptyButtonStyles = `.wp-block-button__link.emptyButton{ background-color: rgba(255, 0, 0, 0.493) !important; }`;
    let styleSheet = document.createElement("style");
    styleSheet.innerText = emptyButtonStyles;
    document.head.appendChild(styleSheet);
  })
