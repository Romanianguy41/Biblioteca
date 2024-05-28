<!DOCTYPE html>
<html lang="it">
<head>
    <?php include 'inc_header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <form action="processaSignin.php" method="post" class="form">
            <h1>REGISTRAZIONE</h1>
            <div class="form-row">
                <input type="text" name="nome" placeholder="Nome*" value="<?php echo isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : ''; ?>" required>
                <input type="text" name="cognome" placeholder="Cognome*" value="<?php echo isset($_GET['cognome']) ? htmlspecialchars($_GET['cognome']) : ''; ?>" required>
            </div>
            <div class="form-row">
                <input type="text" id="dataNascita" name="dataNascita" placeholder="Data di nascita*" value="<?php echo isset($_GET['dataNascita']) ? htmlspecialchars($_GET['dataNascita']) : ''; ?>" required>
                <input type="text" name="codiceFiscale" placeholder="Codice Fiscale" value="<?php echo isset($_GET['codiceFiscale']) ? htmlspecialchars($_GET['codiceFiscale']) : ''; ?>">
            </div>
            <div class="form-row">
                <input type="email" name="email" placeholder="Email*" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" required>
                <input type="text" name="numeroTelefono" placeholder="Numero di telefono" value="<?php echo isset($_GET['numeroTelefono']) ? htmlspecialchars($_GET['numeroTelefono']) : ''; ?>">
            </div>
            <div class="form-row">
                <input type="password" id="PasswordRicercatori" placeholder="Password*" name="password" required>
                <input type="password" id="confirmPassword" placeholder="Conferma Password*" name="confirmPassword" required>
            </div>

            <div class="infos">
                <label class="checkbox-label">
                    <input type="checkbox" class="checkbox" name="privacy_policy" <?php echo isset($_GET['privacy_policy']) && $_GET['privacy_policy'] == '1' ? 'checked' : ''; ?>>
                    <p class="privacy">Dichiaro di aver letto la <a href="privacyPolicy.php">Privacy Policy</a> e di accettare i termini.</p>
                </label>
                <p>I campi contrassegnati con l'asterisco (*) sono obbligatori.</p>
                <div id="statusMessage" style="display: none;"></div>
            </div>

            <?php
            if (isset($_GET['error'])) {
                echo '<div class="error-message">' . htmlspecialchars(str_replace("||", ", ", $_GET['error'])) . '</div>';
            }
            ?>

            <div class="buttons">
                <button type="submit" name="register" class="submit-button">Registrati</button>
            </div>
            <p style="text-align: center; font-size:13px">Già registrato? <a href="login.php">Accedi</a>.</p>
        </form>
    </div>
</div>
<footer>
    <?php include 'inc_footer.php'; ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#dataNascita", {
        dateFormat: "d-m-Y"
    });
</script>
</body>
</html>
