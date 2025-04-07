const mobileMenuBtn = document.querySelector('.menu');
const barra = document.querySelector('.barra');
const textoHeader = document.querySelector('.contenido-header');

document.addEventListener('DOMContentLoaded', function() {
    mobileMenu();
});

function mobileMenu(){
    if(mobileMenuBtn){
        mobileMenuBtn.addEventListener('click', function(){
            barra.classList.toggle('mostrar');
            textoHeader.classList.toggle('ocultar');
        })
    }
}