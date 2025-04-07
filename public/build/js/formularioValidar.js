const alertas = document.querySelector('.alertas');
const exito = document.querySelector('.exito');
const error = document.querySelector('.error');


document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    origen();
    destino();
    seleccionarFechaHora();
}

//Origen
function origen(){
    // Input nombre
    const inputOrigen = document.querySelector('#origen');
    // Event input
    inputOrigen.addEventListener('input', function(e){
        // Validar nombre
        let origen = e.target.value;
        origen = validarOrigen(origen);
        // True
        if(origen){
            let resultado = e.target.value;
            resultado = resultado.trim();
        }else{
            // False
            e.target.value = "";
            // Error
            mostrarAlerta('error', 'El campo Origen debe contener solo letras');
        }
    })
}
// Funcion validar nombre
function validarOrigen(origen){
    // Expresión regular que permite validar solo letras, espacios y tíldes
    let regex = /^[a-zA-Z\ áéíóúÁÉÍÓÚñÑ\s]*$/; 
    origen = regex.test(origen); 
    if (origen) { 
        return true;
    }
}

//Destino
function destino(){
    // Input nombre
    const inputDestino = document.querySelector('#destino');
    // Event input
    inputDestino.addEventListener('input', function(e){
        // Validar nombre
        let destino = e.target.value;
        destino = validarDestino(destino);
        // True
        if(destino){
            let resultado = e.target.value;
            resultado = resultado.trim();
        }else{
            // False
            e.target.value = "";
            // Error
            mostrarAlerta('error', 'El campo Destino debe contener solo letras');
        }
    })
}
// Funcion validar nombre
function validarDestino(destino){
    // Expresión regular que permite validar solo letras, espacios y tíldes
    let regex = /^[a-zA-Z\ áéíóúÁÉÍÓÚñÑ\s]*$/; 
    destino = regex.test(destino); 
    if (destino) { 
        return true;
    }
}

// Fecha
function seleccionarFechaHora(){
    // Input fecha
    const inputFecha = document.querySelector('#fecha');
    // Input hora
    const inputHora = document.querySelector('#hora');
     // Hora actual
     let date = new Date();
     let hora = date.getHours();
     let minutos = date.getMinutes();
     let dia = date.getDate();
     let mes = date.getMonth() + 1;
     let anio = date.getFullYear();
     if(dia < 10) {dia = "0"+ dia};
     if(mes < 10) {mes = "0"+ mes};
     if(hora < 10) {hora = "0" + hora};
     let fechaActual = anio+"-"+mes+"-"+dia;
     let horaActual = hora+":"+minutos;
     
    // Valor min fecha
    inputFecha.setAttribute('min', fechaActual);
   
    inputFecha.addEventListener('change', function(e){
        inputFechaIntroducida = e.target.value;
        inputHora.value = "";
            inputHora.addEventListener('change', function(e){
                if(inputFechaIntroducida === fechaActual){
                let nuevaHora = e.target.value;
                    if(nuevaHora < horaActual){
                        e.target.value = "";
                        inputFecha.value = "";
                        mostrarAlerta('error', 'Fecha y hora incorrecta.');
                    }
            }
        })
    })
}



// Alerta
function mostrarAlerta(tipo, mensaje, desaparece=true){
    // Previene que se genere más de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    }
    // Scripting alerta
    const divAlerta = document.createElement('DIV');
    divAlerta.textContent = mensaje;
    divAlerta.className = `alerta ${tipo}`;
    alertas.appendChild(divAlerta);

    // Eliminar la alerta
    if(desaparece){
        setTimeout(() => {
            divAlerta.remove();
        }, 3000);
    }
}

