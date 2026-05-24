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

    ofertaSeleccionada = oferta.titulo;

    detalle.innerHTML = `
        <h2 style="color:#0056b3; margin-bottom:15px;">${oferta.titulo}</h2>
        <p style="margin-bottom:10px;"><strong>Categoría:</strong> ${oferta.categoria}</p>
        <p style="line-height:1.6;">${oferta.descripcion_larga || oferta.descripcion}</p>
        <p class="precio" style="font-size:2rem; color:#ff8000; margin-top:20px;">${oferta.precio}€</p>
    `;
    modal.style.display = "block";
}

// CERRAR MODAL
function cerrarModal() {
    const modal = document.getElementById("miModal");
    if (modal) modal.style.display = "none";
}

// AUTORELLENAR DESDE MODAL (CORREGIDO SEGÚN PASO 1)
function autoRellenarDesdeModal() {
    // 1. Obtenemos el texto o título del servicio que está visible dentro del modal
    const detalleModal = document.getElementById('detalle-oferta');
    if (!detalleModal) return;

    // Buscamos el elemento principal (un h2 o h3) dentro del modal que contiene el nombre del plan
    const tituloPlanElemento = detalleModal.querySelector('h2') || detalleModal.querySelector('h3') || detalleModal;
    const nombrePlan = tituloPlanElemento.innerText.trim();

    // 2. Buscamos el desplegable (select) del formulario de contacto en el index
    const selectServicio = document.getElementById('reg_servicio');
    
    if (selectServicio) {
        let encontrado = false;

        // Recorremos las opciones del select para ver cuál coincide o contiene parte del nombre del plan
        for (let i = 0; i < selectServicio.options.length; i++) {
            const opcionTexto = selectServicio.options[i].text.toLowerCase();
            const opcionValor = selectServicio.options[i].value.toLowerCase();
            
            if (opcionTexto.includes(nombrePlan.toLowerCase()) || opcionValor.includes(nombrePlan.toLowerCase())) {
                selectServicio.selectedIndex = i;
                encontrado = true;
                break;
            }
        }

        // Si no encuentra coincidencia exacta en el bucle, le asignamos la primera por defecto
        if (!encontrado) {
            selectServicio.value = selectServicio.options[0].value;
        }
    }

    // 3. Cerramos el modal para que el usuario vuelva a la pantalla principal
    cerrarModal();

    // 4. Llevamos al usuario suavemente hasta la sección de contacto para que revise y envíe
    const seccionContacto = document.getElementById('contacto');
    if (seccionContacto) {
        seccionContacto.scrollIntoView({ behavior: 'smooth' });
    }
}

// 5. RECOMENDADOR PANEL AZUL
function recomendar(tipo) {
    let mensaje = "";
    const cuadro = document.getElementById('resultado-recommendacion') || document.getElementById('resultado-recomendacion');

    if (tipo === 'gaming') {
        mensaje = "🚀 Te recomendamos: Pack Gaming Algeciras. Ideal para latencia mínima y streaming en 4K.";
    } else if (tipo === 'hogar') {
        mensaje = "🏠 Te recomendamos: Fibra 300Mb Hogar o Internet + TV Family si buscas entretenimiento.";
    } else if (tipo === 'empresa') {
        mensaje = "⚓ Te recomendamos: Fibra Puerto Simétrica y el plan Mantenimiento IT Pro para la seguridad de tu negocio.";
    }

    if (cuadro) {
        cuadro.innerHTML = mensaje;
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

window.addEventListener("load", quitarLoader);
setTimeout(quitarLoader, 2000);

window.onclick = function(event) {
    const modal = document.getElementById('miModal');
    if (event.target == modal) cerrarModal();
};

// 8. ENVÍO DE FORMULARIO REAL CON PHP Y CONEXIÓN A MYSQL (PRESUPUESTOS)
const form = document.getElementById('formulario-contacto');
if (form) {
    form.addEventListener('submit', async function(event) {
        event.preventDefault(); 
        
        // Buscamos los campos asegurándonos de usar los IDs correctos de tu HTML
        const inputNombre = document.getElementById('nombre') || document.querySelector('input[name="nombre"]');
        const selectServicio = document.getElementById('reg_servicio') || document.querySelector('select[name="servicio"]') || document.querySelector('select');
        const aviso = document.getElementById('mensaje-exito');
        const btnEnviar = document.getElementById('btn-enviar') || form.querySelector('button[type="submit"]') || form.querySelector('input[type="submit"]');
        
        const nombreUsuario = inputNombre ? inputNombre.value.trim() : "Usuario";
        const servicioElegido = selectServicio ? selectServicio.options[selectServicio.selectedIndex].text : "No especificado";
        
        if (btnEnviar) {
            btnEnviar.innerText = "Procesando...";
            btnEnviar.disabled = true;
        }

        // Captura automáticamente todos los campos con el atributo 'name' del formulario
        const formData = new FormData(this);
        
        try {
            const respuesta = await fetch('guardar.php', {
                method: 'POST',
                body: formData
            });
            
            // Verificamos si la respuesta es un JSON válido
            if (!respuesta.ok) {
                throw new Error(`Error en el servidor: Status ${respuesta.status}`);
            }

            const resultado = await respuesta.json();
            
            if (aviso) {
                aviso.style.display = 'block';
                aviso.style.padding = '15px';
                aviso.style.borderRadius = '8px';
                aviso.style.marginTop = '15px';

                if (resultado.status === 'success') {
                    aviso.innerHTML = `¡Gracias <strong>${nombreUsuario}</strong>! Tu solicitud para <strong>${servicioElegido}</strong> ha sido guardada en el sistema correctamente.`;
                    aviso.style.display = 'block';
                    aviso.style.padding = '15px';
                    aviso.style.borderRadius = '8px';
                    aviso.style.marginTop = '15px';
                    aviso.style.backgroundColor = '#d4edda';
                    aviso.style.color = '#155724';
                    aviso.style.border = '1px solid #c3e6cb';
                    this.reset(); // Vacía el formulario tras el éxito
                } else {
                    if (aviso) {
                        aviso.style.display = 'none';
                        aviso.innerHTML = '';
                    }
                }
            }
            
        } catch (error) {
            console.error("Error en la conexión Fetch:", error);
            if (aviso) {
                aviso.style.display = 'none';
                aviso.innerHTML = '';
            }
        } finally {
            if (btnEnviar) {
                // Restauramos el botón original independientemente de si fue bien o mal
                if (btnEnviar.tagName === 'INPUT') {
                    btnEnviar.value = 'Enviar solicitud';
                } else {
                    btnEnviar.innerHTML = 'Enviar solicitud';
                }
                btnEnviar.disabled = false;
            }
        }
    });
}

// 9. ENVÍO DE FORMULARIO DE ALTAS / REGISTRO DE USUARIOS (FIJADO PARA QUE NO SE CONGELE EL BOTÓN)
const formRegistro = document.getElementById('formulario-registro');
if (formRegistro) {
    formRegistro.addEventListener('submit', async function(event) {
        event.preventDefault();

        const avisoReg = document.getElementById('mensaje-registro');
        const btnReg = document.getElementById('btn-registrar');
        
        const pass = document.getElementById('reg_password').value;
        const passRepeat = document.getElementById('reg_password_repeat').value;

        // Si las contraseñas no coinciden, cancelamos y avisamos en consola
        if (pass !== passRepeat) {
            console.warn("Registro detenido: Las contraseñas no coinciden.");
            return; 
        }

        // Deshabilitamos el botón para evitar múltiples clics
        if (btnReg) {
            btnReg.innerText = "Creando cuenta...";
            btnReg.disabled = true;
        }

        const formData = new FormData(this);

        try {
            const respuesta = await fetch('registro.php', {
                method: 'POST',
                body: formData
            });

            // Si el archivo PHP está roto o da error 500
            if (!respuesta.ok) {
                throw new Error(`Código de error del servidor: ${respuesta.status}`);
            }

            const resultado = await respuesta.json();

            // SÓLO SI EL SERVIDOR SEÑALA ÉXITO, PINTAMOS LA CAJA VERDE
            if (resultado.status === 'success') {
                if (avisoReg) {
                    avisoReg.style.display = 'block';
                    avisoReg.style.padding = '15px';
                    avisoReg.style.borderRadius = '8px';
                    avisoReg.style.marginTop = '15px';
                    
                    avisoReg.innerHTML = `<strong>Éxito:</strong> ${resultado.message}`;
                    avisoReg.style.backgroundColor = '#d4edda';
                    avisoReg.style.color = '#155724';
                    avisoReg.style.border = '1px solid #c3e6cb';
                }
                this.reset(); // Vaciamos los campos de texto
            } else {
                // Si el PHP dice que falló (ej: "Email ya registrado"), lo sacamos por consola para que lo sepas
                console.warn("El backend rechazó el registro:", resultado.message);
            }

        } catch (error) {
            // Si el fetch falla o el JSON está mal formateado
            console.error("🚨 Error de comunicación en el registro:", error.message);
        } finally {
            // ¡IMPORTANTE! Esto se ejecuta SIEMPRE. Si falla o si va bien, el botón vuelve a la vida
            if (btnReg) {
                btnReg.innerText = 'Darme de Alta';
                btnReg.disabled = false;
            }
        }
    });
}
// ANIMACIÓN DE LOS CONTADORES NUMÉRICOS (Versión corregida)
function animarContadores() {
    const contadores = document.querySelectorAll('.numero-contador');
    
    contadores.forEach(contador => {
        // Forzamos a que empiece en 0 por si acaso
        contador.innerText = "0"; 
        
        const destino = parseInt(contador.getAttribute('data-target'), 10);
        let valorActual = 0;
        
        // Ajustamos los pasos para que la animación dure cerca de 1.5 segundos
        const pasos = 50; 
        const incremento = destino / pasos;
        let cuentaPaso = 0;

        const intervalo = setInterval(() => {
            cuentaPaso++;
            valorActual += incremento;

            if (cuentaPaso >= pasos) {
                // Fin de la animación: ponemos el valor real definitivo con sus símbolos
                clearInterval(intervalo);
                if (destino === 520) {
                    contador.innerText = "+520";
                } else if (destino === 99) {
                    contador.innerText = "99%";
                } else {
                    contador.innerText = destino;
                }
            } else {
                // Mostramos el número entero redondeado durante la subida
                contador.innerText = Math.floor(valorActual);
            }
        }, 30); // Se actualiza cada 30 milisegundos
    });
}

// ARRANQUE SEGURO: Ejecutar después de que el Loader desaparezca por completo
window.addEventListener('load', () => {
    // Le damos 1.5 segundos (1500ms) de margen para asegurar que el Spinner ya se ha quitado
    setTimeout(animarContadores, 1500);
});
// LANZAR CARGA DE DATOS AL EMPEZAR
cargarInfonet();