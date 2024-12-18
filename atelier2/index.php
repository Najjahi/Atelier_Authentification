<?php
// Démarrer une session utilisateur
// Démarrer une session utilisateur qui sera en mesure de pouvoir gérer les Cookies
session_start();

// Vérifier si l'utilisateur est déjà en possession d'un cookie valide (cookie authToken ayant le contenu 12345)
// Si l'utilisateur possède déjà ce cookie, il sera redirigé automatiquement vers la page home.php
// Dans le cas contraire il devra s'identifier.
if (isset($_COOKIE['authToken']) && $_COOKIE['authToken'] === 'secret') {
if (isset($_COOKIE['authToken']) && $_COOKIE['authToken'] === '12345') {
    header('Location: page_admin.php');
    exit();
}

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification simple du username et de son password.
    // Si ok alors on initialise le cookie sur le poste de l'utilisateur 
    if ($username === 'admin' && $password === 'secret') {
        setcookie('authToken', '12345', time() + 3600, '/', '', false, true); // Le Cookie est initialisé et valable pendant 1 heure (3600 secondes) 
        header('Location: page_admin.php'); // L'utilisateur est dirigé vers la page home.php
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
