<?php
// Configuration du site
define('SITE_NAME', 'Achile Devine Foundation');
define('SITE_URL', 'http://localhost/votre-projet');
define('ADMIN_EMAIL', 'info@Achiledevinefoundation.org');

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'Achile_devine_foundation');

// Configuration email
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'votre-email@gmail.com');
define('SMTP_PASS', 'votre-mot-de-passe');
define('SMTP_FROM', 'noreply@Achiledevinefoundation.org');
define('SMTP_FROM_NAME', 'Achile Devine Foundation');

// Chemins
define('ROOT_PATH', dirname(__DIR__) . '/');
define('UPLOAD_PATH', ROOT_PATH . 'uploads/');
?>