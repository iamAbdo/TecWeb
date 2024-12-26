<?php

// Include the database connection and start session
include "./includes/base.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: sign_in.html?erreur=empty_fields");
        exit;
    }

    $stmt = $conn->prepare("SELECT id, name, email, password FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $name, $email_db, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email_db;
                header("Location: index.php");
                exit;
            } else {
                header("Location: sign_in.html?erreur=incorrect_password");
                exit;
            }
        } else {
            header("Location: sign_in.html?erreur=no_account_found");
            exit;
        }
    } else {
        header("Location: sign_in.html?erreur=database_error");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
