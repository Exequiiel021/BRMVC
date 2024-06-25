document.addEventListener('DOMContentLoaded', function(){

    eventListeners();

    darkmode();
})

/*MODO OSCURO*/
function darkmode(){
    /*tome automaticamente el modo oscuro de acuerdo a la configuracion del usuario*/

    const prefiereTemaClaro = window.matchMedia('(prefers-color-scheme: light)');
    if (prefiereTemaClaro.matches) {
        document.body.classList.remove('dark-mode');
    } else {
        document.body.classList.add('dark-mode');
    }

    prefiereTemaClaro.addEventListener('change', function () {
        if (prefiereTemaClaro.matches) {
            document.body.classList.remove('dark-mode');
        } else {
            document.body.classList.add('dark-mode');
        }
    });
    /*fin del automatico darkmode de acuerdo al sistema*/

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode')

    })
}

/*Menu HAMBURGUESA*/
function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach( input => input.addEventListener('click', mostrandoContacto)) //util para no crear multiples variables o ids, addEventListener solo funciona de una cosa a la vez, de esta manera lo haces con multiples
};

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    // if (navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar');
    // } else{
    //     navegacion.classList.add('mostrar');
    // }
    navegacion.classList.toggle('mostrar'); /*forma corta de agregar y quitar una clase*/
}


function mostrandoContacto(e){
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero Teléfono</label>
            <input type="tel" placeholder="Tu numero" id="telefono" name="contacto[telefono]">

            <p>Elija la fecha y la hora para ser contactado para la llamada</p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Correo" id="email" name="contacto[email]" require>

        `;
    }
    
}
