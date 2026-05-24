<?php
// Iniciar la sesión existente
session_start();

// Desvincular todas las variables de sesión
$_SESSION = array();

// Destruir la sesión por completo
session_destroy();

// Redirigir al cliente de vuelta a la página principal
header("Location: index.php");
exit();