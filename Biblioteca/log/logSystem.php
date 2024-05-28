<?php
$logFile = 'log\error.log';

if (!file_exists($logFile)) {
    if (!touch($logFile)) {
        error_log("Impossibile creare il file di log degli errori: $logFile", 0);
        die("Errore interno del server. Si prega di riprovare più tardi.");
    }
}
ini_set('log_errors', 'On');
ini_set('error_log', $logFile);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);
?>