<?php
declare(strict_types=1);

function dollarformat(float $amount): string{

    $lessthanZero = $amount < 0;
    return ($lessthanZero ? '-' : ' ') . '$' . number_format(abs($amount), 2);

}

function dateformat(string $date): string{
    return date('M j, Y', strtotime($date));
}



?>