<?php
session_start();
include 'inc_connessione.php';
include 'log/logSystem.php';

function isCodiceFiscaleValid($cf) {
    return preg_match('/^[A-Z0-9]{16}$/', $cf);
}

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $cognome = trim($_POST["cognome"]);
    $dataNascita = trim($_POST["dataNascita"]);
    $codiceFiscale = trim($_POST["codiceFiscale"]);
    $email = trim($_POST["email"]);
    $numeroTelefono = trim($_POST["numeroTelefono"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);
    $privacyPolicy = isset($_POST["privacy_policy"]);

    if (empty($nome)) {
        $errors[] = "Nome obbligatorio";
    } elseif (ctype_space($nome)) {
        $errors[] = "Nome non valido";
    }

    if (empty($cognome)) {
        $errors[] = "Cognome obbligatorio";
    } elseif (ctype_space($cognome)) {
        $errors[] = "Cognome non valido";
    }

    if (empty($dataNascita)) {
        $errors[] = "Data di nascita obbligatoria";
    } elseif ($dataNascita > date("Y-m-d")) {
        $errors[] = "Data di nascita non valida";
    }

    if (empty($email)) {
        $errors[] = "Email obbligatoria";
    } else {
        $query = "SELECT * FROM utenti WHERE email = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "Esiste già un account con questa email";
        }
    }

    if (!empty($codiceFiscale) && !isCodiceFiscaleValid($codiceFiscale)) {
        $errors[] = "Codice Fiscale non è valido";
    }

    if (!empty($numeroTelefono) && !preg_match('/^\d+$/', $numeroTelefono)) {
        $errors[] = "Numero di telefono non valido";
    }

    if (empty($password)) {
        $errors[] = "Password obbligatoria";
    }

    if (empty($confirmPassword)) {
        $errors[] = "Password obbligatoria";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "La password e la conferma password non corrispondono";
    }

    if (!$privacyPolicy) {
        $errors[] = "Devi accettare la Privacy Policy per poter procedere";
    }

    if (empty($errors)) {
        $query = "INSERT INTO utenti (nome, cognome, dataNascita, codiceFiscale, numTelefono, email, pass)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $connection->prepare($query);

        $hashedPassword = hash('sha512', $password);

        $statement->bind_param("sssssss", $nome, $cognome, $dataNascita, $codiceFiscale, $numeroTelefono, $email, $hashedPassword);

        if ($statement->execute()) {
            $idUtente = $statement->insert_id;

            $_SESSION['idUtente'] = $idUtente;
            $_SESSION['emailUtente'] = $email;

            header("Location: index.php");
            exit();
        } else {
            
            error_log("Errore durante l'esecuzione della query: " . $connection->error);

            $errors[] = "Errore durante la registrazione. Riprova";
        }
    }

    if (!empty($errors)) {
        $errorQueryString = http_build_query(array('error' => implode("||", $errors), 'nome' => $nome, 'cognome' => $cognome, 'dataNascita' => $dataNascita, 'codiceFiscale' => $codiceFiscale, 'email' => $email, 'numeroTelefono' => $numeroTelefono, 'privacy_policy' => $privacyPolicy));

        header("Location: signin.php?" . $errorQueryString);
        exit();
    }
}
?>
