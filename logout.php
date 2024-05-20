<?php
require 'config/constants.php';
// destruye todas las sesiones y redirige al usuario a la página de inicio
session_destroy();
header('location: ' . ROOT_URL);
die();
