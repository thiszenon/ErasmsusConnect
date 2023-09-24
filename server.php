

<?php
// Database CONFIGURATION
try {
    $dataBase = new PDO('mysql:host=localhost;dbname=erasmusconnect;charset=utf8', 'root', '');
} catch (Exception $error) {
    die("Erreur" . $error->getMessage()); // la fonction retourne le message d'erreur
}
?>