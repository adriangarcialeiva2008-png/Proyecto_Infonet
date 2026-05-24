<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infonet Algeciras | Gestión de Ofertas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="barra-progreso-contenedor">
        <div id="barra-progreso"></div>
    </div>

    <div id="loader">
        <div class="spinner"></div>
        <p style="color: #0056b3; font-weight: bold; margin-top: 15px;">Cargando Infonet...</p>
    </div>

    <a href="https://wa.me/34670668533?text=Hola%20Infonet!%20Vengo%20de%20la%20web" class="whatsapp-float" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
    </a>

    <header>
        <img src="img/infonet logo.png" alt="Logo Infonet" class="logo-img">
        <h1>Infonet Algeciras</h1>
        <p>Soluciones Tecnológicas - Sector Puerto de Algeciras</p>
    </header>

    <nav id="filtros">
        <button onclick="filtrarOfertas('Todos')">Todas las ofertas</button>
        <button onclick="filtrarOfertas('Particulares')">Particulares</button>
        <button onclick="filtrarOfertas('Empresas')">Empresas</button>
    </nav>

    <main id="contenedor-ofertas"></main>

    <section id="recomendador" style="background: linear-gradient(135deg, #0056b3, #003d80); color: white; padding: 40px; text-align: center; border-radius: 15px; margin: 20px;">
        <h2>¿No sabes qué tarifa elegir? 💡</h2>
        <p>Selecciona tu perfil y te diremos cuál es tu mejor opción</p>
        <div style="margin-top: 20px;">
            <button class="btn-perfil" onclick="recomendar('gaming')">Soy Gamer / Streaming</button>
            <button class="btn-perfil" onclick="recomendar('hogar')">Uso doméstico / Teletrabajo</button>
            <button class="btn-perfil" onclick="recomendar('empresa')">Soy Empresa / Puerto</button>
        </div>
        <div id="resultado-recomendacion" style="margin-top: 30px; font-size: 1.2rem; font-weight: bold; min-height: 50px;"></div>
    </section>
<section id="valoraciones" style="max-width: 1000px; margin: 40px auto; padding: 20px;">
        <h2 style="color: #0056b3; text-align: center;">Lo que opinan nuestros clientes</h2>
        <p style="text-align: center; color: #555; margin-bottom: 30px; font-size: 1.1rem;">Descubre por qué confían en las soluciones de Infonet</p>
        
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <div style="background: white; border-radius: 10px; padding: 25px; width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); text-align: center; border-top: 4px solid #0056b3;">
                <div style="color: #FFD700; font-size: 24px; margin-bottom: 10px;">⭐⭐⭐⭐⭐</div>
                <p style="font-style: italic; color: #444; line-height: 1.5;">"Instalación de fibra rapidísima en el centro. Los 300Mb van volando para el teletrabajo. ¡Un acierto total!"</p>
                <h4 style="color: #0056b3; margin-top: 15px; margin-bottom: 5px;">— María G.</h4>
                <span style="font-size: 13px; color: #777; font-weight: bold;">Cliente Hogar</span>
            </div>

            <div style="background: white; border-radius: 10px; padding: 25px; width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); text-align: center; border-top: 4px solid #28a745;">
                <div style="color: #FFD700; font-size: 24px; margin-bottom: 10px;">⭐⭐⭐⭐⭐</div>
                <p style="font-style: italic; color: #444; line-height: 1.5;">"Tenemos el mantenimiento IT para nuestra oficina en el puerto y el servicio es impecable. Solucionan todo al momento."</p>
                <h4 style="color: #0056b3; margin-top: 15px; margin-bottom: 5px;">— Logística Sur S.L.</h4>
                <span style="font-size: 13px; color: #777; font-weight: bold;">Empresa Puerto</span>
            </div>

            <div style="background: white; border-radius: 10px; padding: 25px; width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); text-align: center; border-top: 4px solid #0056b3;">
                <div style="color: #FFD700; font-size: 24px; margin-bottom: 10px;">⭐⭐⭐⭐⭐</div>
                <p style="font-style: italic; color: #444; line-height: 1.5;">"El pack gaming es una pasada. Juego sin nada de lag y la atención es super cercana, nada de hablar con robots."</p>
                <h4 style="color: #0056b3; margin-top: 15px; margin-bottom: 5px;">— Carlos R.</h4>
                <span style="font-size: 13px; color: #777; font-weight: bold;">Pack Gaming</span>
            </div>
        </div>
    </section>
    <section id="estado-y-cifras" style="max-width: 1000px; margin: 40px auto; padding: 30px 20px; background: #f8f9fa; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        
        <div style="background: white; border-radius: 10px; padding: 15px 20px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 35px; border-left: 5px solid #28a745;">
            <div style="display: flex; align-items: center; gap: 15px;">
                <span class="punto-verde-parpadeante"></span>
                <div>
                    <h4 style="margin: 0; color: #333; font-size: 1.1rem;">Estado de la Red Infonet</h4>
                    <p style="margin: 3px 0 0 0; color: #666; font-size: 0.9rem;">Sistemas operativos y estables en la zona del Campo de Gibraltar.</p>
                </div>
            </div>
            <div style="font-weight: bold; color: #28a745; font-size: 0.9rem; background: #e8f5e9; padding: 6px 12px; border-radius: 20px;">
                Red 100% Online
            </div>
        </div>

        <style>
            .punto-verde-parpadeante {
                width: 12px;
                height: 12px;
                background-color: #28a745;
                border-radius: 50%;
                display: inline-block;
                animation: parpadeo 1.8s infinite ease-in-out;
            }
            @keyframes parpadeo {
                0% { transform: scale(0.9); opacity: 0.6; box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
                50% { transform: scale(1.1); opacity: 1; box-shadow: 0 0 0 8px rgba(40, 167, 69, 0); }
                100% { transform: scale(0.9); opacity: 0.6; box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
            }
        </style>

        <div style="display: flex; gap: 20px; justify-content: space-around; flex-wrap: wrap; text-align: center;">
            
            <div class="tarjeta-contador" style="width: 200px;">
                <span class="numero-contador" data-target="520" style="font-size: 2.5rem; font-weight: bold; color: #0056b3; display: block;">0</span>
                <p style="margin: 5px 0 0 0; color: #555; font-weight: 500; font-size: 0.95rem;">Empresas Conectadas</p>
            </div>

            <div class="tarjeta-contador" style="width: 200px;">
                <span class="numero-contador" data-target="99" style="font-size: 2.5rem; font-weight: bold; color: #0056b3; display: block;">0</span>
                <p style="margin: 5px 0 0 0; color: #555; font-weight: 500; font-size: 0.95rem;">% Disponibilidad Red</p>
            </div>

            <div class="tarjeta-contador" style="width: 200px;">
                <span class="numero-contador" data-target="15" style="font-size: 2.5rem; font-weight: bold; color: #0056b3; display: block;">0</span>
                <p style="margin: 5px 0 0 0; color: #555; font-weight: 500; font-size: 0.95rem;">Mins Respuesta Soporte</p>
            </div>

        </div>
    </section>
    <section id="contacto" style="max-width: 600px; margin: 40px auto; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        <h2 style="color: #0056b3; text-align: center;">Solicitar presupuesto personalizado</h2>
        
        <form id="formulario-contacto">
            <div class="grupo-input" style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre..." required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
            </div>
            
            <div class="grupo-input" style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Email de contacto</label>
                <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
            </div>

            <div class="grupo-input" style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold;">Tarira a contratar</label>
                <select name="servicio" id="reg_servicio" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box; background-color: white; font-size: 14px;">
                    <option value="Fibra 300Mb Hogar">Fibra 300Mb Hogar — 24.90€/mes</option>
                    <option value="Pack Gaming Algeciras">Pack Gaming Algeciras — 34.95€/mes</option>
                    <option value="Internet + TV Family">Internet + TV Family — 39.90€/mes</option>
                    <option value="Fibra Puerto Simétrica">Fibra Puerto Simétrica — 45.00€/mes</option>
                    <option value="Cámaras Puerto 24h">Cámaras Puerto 24h — 29.95€/mes</option>
                    <option value="Mantenimiento IT Pro">Mantenimiento IT Pro — 59.90€/mes</option>
                </select>
            </div>

            <div class="grupo-input" style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Mensaje u Observaciones (Opcional)</label>
                <textarea id="mensaje-usuario" name="mensaje" placeholder="Cuéntanos qué necesitas..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; height: 100px; resize: none;"></textarea>
            </div>
            
            <button type="submit" id="btn-enviar" style="width: 100%; background: #28a745; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; cursor: pointer;">Enviar solicitud</button>
        </form>
        
        <div id="mensaje-exito" style="display:none; margin-top: 15px; text-align: center; font-weight: bold; color: #28a745;"></div>
    </section>

    <section id="login-seccion" style="max-width: 600px; margin: 40px auto; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        <h2 style="color: #0056b3; text-align: center;">Acceso Clientes Infonet</h2>
        
        <form id="formulario-login" action="login.php" method="POST" style="margin-top: 15px;">
            <div class="grupo-input" style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Email de acceso</label>
                <input type="email" name="login_email" placeholder="ejemplo@correo.com" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;">
            </div>

            <div class="grupo-input" style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold;">Contraseña</label>
                <input type="password" name="login_password" placeholder="Introduce tu contraseña" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;">
            </div>
            
            <button type="submit" style="width: 100%; background: #28a745; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; cursor: pointer;">Iniciar Sesión</button>
        </form>
    </section>

    <section id="registro" style="max-width: 600px; margin: 40px auto; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        <h2 style="color: #0056b3; text-align: center;">Crear Cuenta de Cliente</h2>
        
        <form id="formulario-registro">
            <div class="grupo-input" style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Nombre completo</label>
                <input type="text" name="reg_nombre" placeholder="Tu nombre..." required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;">
            </div>
            
            <div class="grupo-input" style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Email de contacto</label>
                <input type="email" name="reg_email" placeholder="ejemplo@correo.com" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;">
            </div>

            <div class="grupo-input" style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Contraseña de acceso</label>
                <input type="password" id="reg_password" name="reg_password" placeholder="Crea una contraseña segura" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;">
            </div>

            <div class="grupo-input" style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Repite tu contraseña</label>
                <input type="password" id="reg_password_repeat" placeholder="Introduce la misma contraseña" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;">
            </div>
            
            <button type="submit" id="btn-registrar" style="width: 100%; background: #0056b3; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; cursor: pointer;">Darme de Alta</button>
        </form>
        
        <div id="mensaje-registro" style="display:none; margin-top: 15px; text-align: center; font-weight: bold; padding: 10px; border-radius: 8px;"></div>
    </section>

    <div class="mapa-contenedor">
        <h3>Nuestra ubicación en Algeciras</h3>
        <iframe src="https://www.google.com/maps?q=Algeciras,+España&z=12&output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <div style="text-align:center; margin-top:10px;">
            <a href="https://www.google.com/maps/search/?api=1&query=Av.+Virgen+de+la+Palma+2,+11203+Algeciras,+Cádiz,+España" target="_blank" rel="noopener" class="btn-ubicacion" style="display:inline-block; background:#0056b3; color:white; padding:10px 16px; border-radius:8px; text-decoration:none; font-weight:bold;">Abrir en Google Maps</a>
        </div>
    </div>

    <footer class="footer-completo">
        <div class="footer-container">
            <div class="footer-col">
                <img src="img/infonet logo.png" alt="Infonet Logo" class="footer-logo">
                <p>Soluciones en informática, redes y tecnología en Algeciras.</p>
            </div>
            <div class="footer-col">
                <h3>Horarios</h3>
                <p>Lunes a Viernes: 9:30h - 14:00h / 17:00h - 20:30h</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 Adrián García - Proyecto Infonet</p>
        </div>
    </footer>

    <div id="miModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">×</span>
            <div id="detalle-oferta"></div> 
            <button onclick="autoRellenarDesdeModal()" class="btn-enviar" style="margin-top:20px; width: 100%;">Confirmar Interés</button>
        </div>
    </div>

    <script src="script.js"></script>

</body>
</html>