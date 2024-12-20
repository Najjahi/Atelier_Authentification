<?php
// Nom d'utilisateur et mot de passe corrects
$valid_username = 'admin';
$valid_password = 'secret';
$role = $valid_credentials[$username]['role'];
$valid_credentials = [
    'admin' => ['password' => 'secret', 'role' => 'admin'],
    'user'  => ['password' => 'utilisateur', 'role' => 'user']
];


// Vérifier si l'utilisateur a envoyé des identifiants
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    // Envoyer un header HTTP pour demander les informations
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Vous devez entrer un nom d\'utilisateur et un mot de passe pour accéder à cette page.';
    exit;
}

// Vérifier les identifiants envoyés
if ($_SERVER['PHP_AUTH_USER'] !== $valid_username || $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
    // Si les identifiants sont incorrects
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    exit;
}

// Affichage selon le rôle
if ($role === 'admin') {
    echo 'Bienvenue, administrateur ! Vous avez un accès complet à cette page.';
    }
 ?>   
<body>
    <h1>Bienvenue sur la page protégée</h1>
    <p>Ceci est une page protégée par une authentification simple via le header HTTP</p>
    <p>C'est le serveur qui vous demande un nom d'utilisateur et un mot de passe via le header WWW-Authenticate</p>
    <p>Aucun système de session ou cookie n'est utilisé pour cet atelier</p>
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?></p>
</body>
    // Vous pouvez afficher un contenu spécifique à l'admin ici
    <?php
        
    
} elseif ($role === 'user') {
    echo 'Bienvenue, utilisateur ! Vous avez un accès limité à cette page.';
    // Vous pouvez afficher un contenu spécifique à l'utilisateur ici
} else {
    echo 'Rôle inconnu. Veuillez contacter l\'administrateur.';
}
?>
// Si les identifiants sont corrects

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <h1>Bienvenue sur la page protégée</h1>
    <p>Ceci est une page protégée par une authentification simple via le header HTTP</p>
    <p>C'est le serveur qui vous demande un nom d'utilisateur et un mot de passe via le header WWW-Authenticate</p>
    <p>Aucun système de session ou cookie n'est utilisé pour cet atelier</p>
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?></p>
</body>
</html>
