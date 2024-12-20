<?php
// Démarre la session
session_start();

// Vérifier si l'utilisateur est déjà connecté

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']=== true && $_SESSION['username']=== 'admin') {
    header('Location: page_admin.php'); // Si l'utilisateur s'est déjà connecté alors il sera automatiquement redirigé vers la page protected.php
    exit();
} else {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true  && $_SESSION['username']=== 'user') {
    header('Location: page_user.php'); // Si l'utilisateur s'est déjà connecté alors il sera automatiquement redirigé vers la page protected.php
    exit();
} 
// Gérer le formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification simple des identifiants (à améliorer avec une base de données)
    if ($username === 'admin' && $password === 'secret') {
        // Stocker les informations utilisateur dans la session
        $_SESSION['loggedin'] = true; // on cree une session loggedin et on la stock
        $_SESSION['username'] = $username; // on cree une session username et on la stock
       

        // Rediriger vers la page protégée
        header('Location: page_admin.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
    if ($username === 'user' && $password === 'password') {
        // Stocker les informations utilisateur dans la session
         $_SESSION['loggedin'] = true; // on cree une session loggedin et on la stock
        $_SESSION['username'] = $username; // on cree une session username et on la stock
       

        // Rediriger vers la page protégée
        header('Location: page_user.php');
        exit();
  
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
 }
    if (isset($_SESSION['visites'])) {   
    $_SESSION['visites']++;
} else {
   
    $_SESSION['visites'] = 1;
}

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Atelier authentification par Session</h1>
    <h3>La page <a href="page_admin.php">page_admin.php</a> de cet atelier 3 est inaccéssible tant que vous ne vous serez pas connecté avec le login 'admin' et mot de passe 'secret'</h3>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
