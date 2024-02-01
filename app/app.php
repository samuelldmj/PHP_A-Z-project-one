<?php     
declare(strict_types=1);

//this function read files from the directory

function get_transaction_files(string $dir_path):array{

        //the files will be stored
        $files = [];
        foreach(scandir($dir_path) as $file){
        //directory are skipped
        if(is_dir($file)){
            continue;
        }
        //if it is a file, it is added here
        $files[] = $dir_path . $file;
}
  return $files;

}

//This function read the csv file and extract transactions

function get_transaction_csv(string $filename, ?callable $transaction_handler = null):array{
    //if the file does not exist, i want to trigger a manual error
    if(!file_exists($filename)){
        trigger_error("File " . $filename . "does not exist", E_USER_ERROR);
    }

    $file = fopen($filename, 'r');
    $transactions = [];
    fgetcsv($file);
    while(($transaction = fgetcsv($file)) != false){
        if($transaction_handler != null)
        {
        $transaction = $transaction_handler($transaction);
    }
        $transactions[] = extract_transaction($transaction);
    }
    return $transactions;
}

function extract_transaction(array $transaction_row): array{
    [$date, $checkNumber, $description, $amount] = $transaction_row;
    //removing the chracters from the figures here
    $amount = (float) str_replace([',', '$'], '', $amount);

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description, 
        'amount' => $amount,
    ];
}

function calculate_totals(array $transactions):array{
    $totals = ['totalIncome' => 0, 'totalExpense' => 0, 'netTotal' => 0 ];
    foreach($transactions as $transaction){
        $totals['netTotal'] += $transaction['amount'];
    $transaction['amount'] >= 0 ? $totals['totalIncome'] += $transaction['amount'] : $totals['totalExpense'] += $transaction['amount'];
    }
    return $totals;
}




?>