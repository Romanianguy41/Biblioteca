<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza errori</title>
</head>
<body>
    <h1>Contenuto del file di log degli errori</h1>
    <div>
    <form method="post">
        <button type="submit" name="clear_log">Svuota il file di log</button>
    </form>
        <?php
        // Percorso del file di log degli errori (percorso relativo)
        $logFile = 'error.log';

        // Funzione per cancellare il contenuto del file di log
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_log'])) {
            file_put_contents($logFile, '');
        }

        // Controlla se il file di log esiste
        if (file_exists($logFile)) {
            // Leggi il contenuto del file di log
            $logContent = file_get_contents($logFile);

            // Stampa il contenuto del file di log
            echo nl2br(htmlspecialchars($logContent));
        } else {
            echo "Il file di log degli errori non esiste.";
        }
        ?>
    </div>
   
</body>
</html>
