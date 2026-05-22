// VARIABLE GLOBAL PARA GUARDAR LA OFERTA SELECCIONADA EN EL MODAL
let datosOfertas = [];
let ofertaSeleccionada = "Ninguno";

// 1. CARGA DE DATOS
async function cargarInfonet() {
    try {
        const res = await fetch('ofertas.json');
        datosOfertas = await res.json();
        dibujarTarjetas(datosOfertas);
    } catch (e) {
        console.error("Error al cargar ofertas.json:", e);
    }
}

// 2. DIBUJAR TARJETAS CON ANIMACIÓN
function dibujarTarjetas(lista) {
    const main = document.getElementById('contenedor-ofertas');
    if (!main) return;
    main.innerHTML = '';

    lista.forEach((o, index) => { 
        const card = document.createElement('div');
        card.className = 'card';
        card.style.animationDelay = `${index * 0.1}s`; 

        card.innerHTML = `
            <span class="categoria-tag">${o.categoria}</span>
            <h3>${o.titulo}</h3>
            <p>${o.descripcion}</p>
            <p class="precio">${o.precio}€</p>
            <button style="width:100%" onclick="abrirModal(${JSON.stringify(o).replace(/"/g, '&quot;')})">
                Solicitar Información
            </button>
        `;
        main.appendChild(card);
    });
}

// 3. FILTROS
function filtrarOfertas(cat) {
    if (cat === 'Todos') {
        dibujarTarjetas(datosOfertas);
    } else {
        const filtradas = datosOfertas.filter(o => o.categoria === cat);
        dibujarTarjetas(filtradas);
    }
}

// 4. MODAL (ABRIR, CERRAR Y AUTORELLENAR)
function abrirModal(oferta) {
    const modal = document.getElementById('miModal');
    const detalle = document.getElementById('detalle-oferta');
    if (!modal || !detalle) return;

    // Guardamos el título de la oferta elegida en la variable global
    ofertaSeleccionada = oferta.titulo;

    detalle.innerHTML = `
        <h2 style="color:#0056b3; margin-bottom:15px;">${oferta.titulo}</h2>
        <p style="margin-bottom:10px;"><strong>Categoría:</strong> ${oferta.categoria}</p>
        <p style="line-height:1.6;">${oferta.descripcion_larga || oferta.descripcion}</p>
        <p class="precio" style="font-size:2rem; color:#ff8000; margin-top:20px;">${oferta.precio}€</p>
    `;
    modal.style.display = "block";
}

function cerrarModal() {
    const modal = document.getElementById("miModal");
    if (modal) modal.style.display = "none";
}

function autoRellenarDesdeModal() {
    // 1. Cerramos el modal de forma limpia
    cerrarModal();
    
    // 2. Bajamos suavemente al formulario de contacto
    const seccionContacto = document.getElementById('contacto');
    if (seccionContacto) {
        seccionContacto.scrollIntoView({ behavior: 'smooth' });
    }    
    
    // 3. Pasamos el nombre de la oferta al input oculto por detrás
    const inputOculto = document.getElementById('servicio');
    if (inputOculto) {
        inputOculto.value = ofertaSeleccionada;
    }

    // 4. Cambiamos visualmente el texto del botón verde para que mole más
    const btnEnviar = document.getElementById('btn-enviar');
    if (btnEnviar) {
        btnEnviar.innerText = `Solicitar: ${ofertaSeleccionada}`;
    }
}

// 5. RECOMENDADOR PANEL AZUL
function recomendar(tipo) {
    let mensaje = "";
    const cuadro = document.getElementById('resultado-recomendacion') || document.getElementById('resultado-recommendacion');

    if (tipo === 'gaming') {
        mensaje = "🚀 Te recomendamos: **Pack Gaming Algeciras**. Ideal para latencia mínima y streaming en 4K.";
    } else if (tipo === 'hogar') {
        mensaje = "🏠 Te recomendamos: **Fibra 300Mb Hogar** o **Internet + TV Family** si buscas entretenimiento.";
    } else if (tipo === 'empresa') {
        mensaje = "⚓ Te recomendamos: **Fibra Puerto Simétrica** y el plan **Mantenimiento IT Pro** para la seguridad de tu negocio.";
    }

    if (cuadro) {
        cuadro.innerHTML = mensaje;
        
        // Estilos dinámicos idénticos a los de tu captura
        cuadro.style.color = "white"; 
        cuadro.style.marginTop = "20px"; 
        cuadro.style.padding = "15px"; 
        cuadro.style.backgroundColor = "rgba(255, 255, 255, 0.1)"; 
        cuadro.style.borderRadius = "10px"; 
        cuadro.style.fontWeight = "bold"; 
        cuadro.style.textAlign = "center"; 
    }
}

// 6. BARRA DE PROGRESO DE SCROLL
window.onscroll = function() {
    const posicionActual = window.pageYOffset || document.documentElement.scrollTop;
    const alturaTotal = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const progreso = (posicionActual / alturaTotal) * 100;
    const barra = document.getElementById("barra-progreso");
    if (barra) {
        barra.style.width = progreso + "%";
    }
};

// 7. LOADER ANTES DE ENTRAR
function quitarLoader() {
    const loader = document.getElementById("loader");
    if (loader) {
        loader.style.opacity = "0";
        setTimeout(() => {
            loader.style.display = "none";
        }, 500);
    }
}

// EVENTOS GLOBALES E INICIALES
window.addEventListener("load", quitarLoader);
setTimeout(quitarLoader, 2000); // Seguro de vida de 2 segundos

window.onclick = function(event) {
    const modal = document.getElementById('miModal');
    if (event.target == modal) cerrarModal();
};

// 8. ENVÍO DE FORMULARIO MEJORADO CON CAJA VISTOSA
const form = document.getElementById('formulario-contacto');
if (form) {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); 
        
        const nombreUsuario = document.getElementById('nombre').value;
        const servicioElegido = document.getElementById('servicio').value;
        const aviso = document.getElementById('mensaje-exito');
        
        if (aviso) {
            // Si el usuario seleccionó una tarifa desde el modal
            if (servicioElegido && servicioElegido !== "Ninguno") {
                aviso.innerHTML = `¡Gracias ${nombreUsuario}! Tu solicitud para <strong>${servicioElegido}</strong> ha sido enviada correctamente. En breve contactaremos contigo.`;
            } else {
                aviso.innerHTML = `¡Gracias ${nombreUsuario}! Tu mensaje ha sido enviado correctamente.`;
            }
            
            // Maquetación dinámica y profesional para el mensaje de éxito (Fondo verde suave)
            aviso.style.display = 'block';
            aviso.style.backgroundColor = '#d4edda';
            aviso.style.color = '#155724';
            aviso.style.padding = '15px';
            aviso.style.borderRadius = '8px';
            aviso.style.border = '1px solid #c3e6cb';
            aviso.style.marginTop = '15px';
        }
        
        // Reseteamos el formulario completo y devolvemos el botón a su texto por defecto
        this.reset();
        const btnEnviar = document.getElementById('btn-enviar');
        if (btnEnviar) btnEnviar.innerText = 'Enviar solicitud';
        
        // Reseteamos la variable de oferta seleccionada por seguridad
        ofertaSeleccionada = "Ninguno";
    });
}

// LANZAR CARGA DE DATOS AL EMPEZAR
cargarInfonet();