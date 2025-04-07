const btnPerfilM = document.querySelector('.menu-perfilm');
const btnPerfil = document.querySelector('.menu-perfil');
const menuPerfil = document.querySelector('.menu-usuario');
const tituloPagina = document.querySelector('.contenido-dashboard');


document.addEventListener('DOMContentLoaded', function() {
    menuPerfilUsuario();

});

function menuPerfilUsuario(){
    btnPerfil.addEventListener('click', function(){
    menuPerfil.classList.toggle('mostrar');
    tituloPagina.classList.toggle('separacion');
    })
    btnPerfilM.addEventListener('click', function(){
        menuPerfil.classList.toggle('mostrar');
    }) 
}

