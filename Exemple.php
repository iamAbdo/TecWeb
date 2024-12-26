<?php
include './includes/base.php';

$etudiant = $conn->query("SELECT * FROM students");

// verifier si il ya des etudiants
if ($etudiant->num_rows > 0) {
    // boucler les etudiants
    while ($row = $etudiant->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "No students found.";
}
?>