<?php 
declare(strict_types=1);


$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;


define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILE_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require APP_PATH . 'app.php';
require APP_PATH .  'formatting.php';


$files = get_transaction_files(FILE_PATH);

$transactions = [];
foreach($files as $file){
    $transactions = array_merge($transactions, get_transaction_csv($file));
}

$totals = calculate_totals($transactions);
//this will display the transction in a html table format created in transaction.php
require VIEWS_PATH . 'transaction.php';


?>