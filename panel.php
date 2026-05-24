<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$nombre_usuario = $_SESSION['usuario_nombre'];
// Rescatamos el servicio asignado de la sesión de forma limpia
$servicio_usuario = isset($_SESSION['usuario_servicio']) ? $_SESSION['usuario_servicio'] : 'Fibra 300Mb Hogar';

// =========================================================================
// LÓGICA DE ASIGNACIÓN DE PRECIO COHERENTE SEGÚN LAS OFERTAS DE TU CAPTURA
// =========================================================================
switch ($servicio_usuario) {
    case 'Fibra 300Mb Hogar':
        $precio = "24.90€";
        break;
    case 'Pack Gaming Algeciras':
        $precio = "34.95€";
        break;
    case 'Internet + TV Family':
        $precio = "39.90€";
        break;
    case 'Fibra Puerto Simétrica':
        $precio = "45.00€";
        break;
    case 'Cámaras Puerto 24h':
        $precio = "29.95€";
        break;
    case 'Mantenimiento IT Pro':
        $precio = "59.90€";
        break;
    default:
        $precio = "24.90€"; // Precio base por si acaso
        break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Cliente - Infonet Algeciras</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
        }

        /* Cabecera del Panel */
        header {
            background-color: #0056b3;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        header h1 {
            font-size: 24px;
        }

        header .user-info {
            font-size: 16px;
            font-weight: bold;
        }

        /* Contenedor Principal */
        main {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Mensaje de Bienvenida */
        .welcome-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            border-left: 5px solid #28a745;
        }

        .welcome-box h2 {
            color: #0056b3;
            margin-bottom: 10px;
        }

        /* Rejilla de Tarjetas (Dashboard) */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 2px solid #f4f6f9;
            padding-bottom: 10px;
        }

        .card p {
            font-size: 15px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        /* Estados y Badges */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-success { background-color: #d4edda; color: #155724; }
        .badge-info { background-color: #d1ecf1; color: #0c5460; }

        /* Lista de facturas simuladas */
        .invoice-list {
            list-style: none;
        }

        .invoice-list li {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
            font-size: 14px;
        }

        .invoice-list li a {
            color: #0056b3;
            text-decoration: none;
            font-weight: bold;
        }

        /* Botón de Cerrar Sesión */
        .logout-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s ease;
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.2);
        }

        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <!-- Cabecera superior -->
    <header>
        <h1>Infonet Algeciras</h1>
        <div class="user-info">👤 Cliente: <?php echo htmlspecialchars($nombre_usuario); ?></div>
    </header>

    <!-- Contenido del panel -->
    <main>
        
        <!-- Caja de bienvenida dinámica -->
        <div class="welcome-box">
            <h2>¡Bienvenido/a a tu Área Privada, <?php echo htmlspecialchars($nombre_usuario); ?>! 👋</h2>
            <p>Desde aquí puedes gestionar tus servicios contratados, revisar tus últimas facturas y comprobar el estado de soporte técnico de tu línea.</p>
        </div>

        <!-- Secciones de Utilidades -->
        <div class="dashboard-grid">
            
            <!-- Tarjeta 1: Servicios Dinámicos -->
            <div class="card">
                <h3>📦 Mis Servicios</h3>
                <p><strong>Plan:</strong> <?php echo htmlspecialchars($servicio_usuario); ?></p>
                <p><strong>Estado del servicio:</strong> <span class="badge badge-success">Activo</span></p>
                <p style="font-size: 13px; color: #999; margin-top: 10px;">Permanencia hasta: Diciembre 2026</p>
            </div>

            <!-- Tarjeta 2: Facturas (Ahora dinámicas usando la variable $precio) -->
            <div class="card">
                <h3>📄 Últimas Facturas</h3>
                <ul class="invoice-list">
                    <li><span>Mayo 2026 - <?php echo $precio; ?></span> <a href="#">PDF 📥</a></li>
                    <li><span>Abril 2026 - <?php echo $precio; ?></span> <a href="#">PDF 📥</a></li>
                    <li><span>Marzo 2026 - <?php echo $precio; ?></span> <a href="#">PDF 📥</a></li>
                </ul>
            </div>

            <!-- Tarjeta 3: Estado e Incidencias -->
            <div class="card">
                <h3>🚀 Estado de la Red</h3>
                <p>Central de Algeciras operando con total normalidad.</p>
                <p><strong>Latencia media:</strong> 12ms</p>
                <p><strong>Soporte Técnico:</strong> <span class="badge badge-info">Sin incidencias</span></p>
            </div>

        </div>

        <!-- Zona del botón de desconexión -->
        <div class="logout-container">
            <a href="logout.php" class="btn-logout">Cerrar Sesión Segura</a>
        </div>

    </main>

</body>
</html>