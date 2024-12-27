<?php
// Démarrer la session
session_start();

// Vérifier si une session existe
if (session_status() === PHP_SESSION_ACTIVE) {
    // Supprimer toutes les variables de session
    $_SESSION = array();

    // Si vous souhaitez supprimer également le cookie de session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Détruire la session
    session_destroy();
}

// Rediriger l'utilisateur ou afficher un message
header("Location: index.php"); // Remplacez par la page vers laquelle vous souhaitez rediriger
exit;
?>
