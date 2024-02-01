<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
            h1 {
                height: 50px;
                text-align: center;
                margin: 0;
                padding: 10px 10px;
                border: 1px solid black;

            }
        </style>
    </head>
    <body>
        <h1>Budget and Expense Tracking webpage: Using procedural programming{P.H.P}</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($transactions)): ?>
                    <?php foreach($transactions as $transaction): ?>
                        <tr>
                            <td><?= dateformat($transaction['date']) ?></td>
                            <td><?= $transaction['checkNumber'] ?></td>
                            <td><?= $transaction['description'] ?></td>
                            <td>
                                <?php if ($transaction['amount'] < 0): ?>
                                    <span style="color: red;">
                                        <?= dollarformat($transaction['amount']) ?>
                                    </span>
                                <?php elseif ($transaction['amount'] > 0): ?>
                                    <span style="color: green;">
                                        <?= dollarformat($transaction['amount']) ?>
                                    </span>
                                <?php else: ?>
                                    <?= dollarformat($transaction['amount']) ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?= dollarformat($totals['totalIncome']) ?? 0 ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?= dollarformat($totals['totalExpense']) ?? 0 ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= dollarformat($totals['netTotal']) ?? 0 ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
