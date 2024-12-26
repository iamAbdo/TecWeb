<?php

// Inclure la connexion à la base de données
include './includes/base.php';  // Assurez-vous que le chemin est correct

// Démarrer la session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire et les assainir
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Préparer la requête SQL pour insérer les données dans la table `messages`
    $sql = "INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)";
    
    // Utiliser une requête préparée pour éviter les injections SQL
    if ($stmt = $conn->prepare($sql)) {
        // Lier les paramètres à la requête préparée
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Message de succès
            header("Location: contact.html?success=message_sent");
            exit;
        } 

        // Fermer la requête préparée
        $stmt->close();
    } else {
        // Message d'erreur si la requête échoue
        echo "<script>alert('Error: Unable to prepare statement.');</script>";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
