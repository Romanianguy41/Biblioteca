<?php
include 'inc_connessione.php';
include 'log/logSystem.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["emailUtente"];
    $password = $_POST["passwordUtente"];
    $passwordHash = hash('sha512', $password);

    
    if ($connection->connect_error) {
        error_log("Connection failed: " . $connection->connect_error);
        die("Errore interno del server. Si prega di riprovare più tardi.");
    }


    $stmt = $connection->prepare("SELECT idUtente, pass FROM utenti WHERE email = ?");
    if (!$stmt) {
        error_log("Prepare failed: (" . $connection->errno . ") " . $connection->error);
        die("Errore interno del server. Si prega di riprovare più tardi.");
    }


    if (!$stmt->bind_param("s", $email)) {
        error_log("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
        die("Errore interno del server. Si prega di riprovare più tardi.");
    }


    if (!$stmt->execute()) {
        error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        die("Errore interno del server. Si prega di riprovare più tardi.");
    }

    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id_utente, $db_password);
        $stmt->fetch();
        

        if ($passwordHash === $db_password) {
            $_SESSION['emailUtente'] = $email;
            $_SESSION['idUtente'] = $id_utente;

            header("Location: index.php"); 
            exit();
        } else {
            $error = "Email o password errati.";
        }
    } else {
        $error = "Email o password errati.";
    }

    $stmt->close();

    
    header("Location: login.php?error=" . urlencode($error));
    exit();
}
?>
