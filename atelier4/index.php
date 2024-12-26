<?php

$validUsers = [
    'admin' => [
        'password' => 'secret',
        'role' => 'admin'
    ],
    'user' => [
        'password' => 'utilisateur',
        'role' => 'user'
    ]
];

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) { //Contient le nom d'utilisateur + mp envoyé par le navigateur lors de l'authentification HTTP Basic.
    header('WWW-Authenticate: Basic realm="Zone Protégée"'); // Demande au navigateur de présenter une boîte de dialogue d'authentification.
    header('HTTP/1.0 401 Unauthorized'); //Envoie une réponse HTTP indiquant que l'utilisateur n'est pas autorisé.
    echo 'Vous devez entrer un nom d\'utilisateur et un mot de passe pour accéder à cette page.';
    exit;
}

$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

if (!isset($validUsers[$username]) || $validUsers[$username]['password'] !== $password) {
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    exit;
}

$userRole = $validUsers[$username]['role'];

?>
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
    <?php if ($userRole === 'admin'): ?>
        <div>
            <h2>Section Administration</h2>
            <p>Cette section n'est visible que par les administrateurs.</p>
            <ul>
                <li>Gestion des utilisateurs</li>
                <li>Configuration système</li>
                <li>Rapports d'activité</li>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($userRole === 'user'): ?>
        <div>
            <h2>Section Utilisateur</h2>
            <p>Cette section est visible par les utilisateurs.</p>
            <ul>
                <li>Accès aux documents</li>
                <li>Modification du profil</li>
                <li>Historique des commandes</li>
            </ul>
        </div>
    <?php endif; ?>

    <a href="../index.html">Retour à l'accueil</a>
</body>
</html>
