document.addEventListener('DOMContentLoaded', () => {
    eventListeners()
    darkMode()
})


function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu')

    mobileMenu.addEventListener('click', navegacionResponsive)
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion') 
    /*
    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar')
    } else {
        navegacion.classList.add('mostrar')
    }
    */
   // Una forma más sencilla -> toggle
   navegacion.classList.toggle('mostrar')
}

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)')

    const configurar = () => {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode')
        } else {
            document.body.classList.remove('dark-mode')
        }
    }

    configurar()

    prefiereDarkMode.addEventListener('change', configurar)

    const botonDark = document.querySelector('.icon-dark-mode')
    botonDark.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode')
    })
}