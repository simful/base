<?php

namespace App\Lib;

use App\Http\Requests;
use DB;

class IncomeStatement
{
    static function getBalance($account_group_id)
    {
        $items = "SELECT account_groups.id, accounts.name,
            IF (account_groups.position = 'Debit', SUM(debit) - SUM(credit), SUM(credit) - SUM(debit)) as amount
            FROM transaction_details
            JOIN accounts ON transaction_details.account_id = accounts.id
            JOIN account_groups ON accounts.account_group_id = account_groups.id
            JOIN transactions ON transaction_details.transaction_id = transactions.id
            WHERE transactions.created_at BETWEEN :startDate AND :endDate
            AND accounts.account_group_id = :group
            GROUP BY transaction_details.account_id
            ORDER BY accounts.id";

        return DB::connection('tenant')
            ->select($items, [ 'startDate' => Report::startDate(), 'endDate' => Report::endDate(), 'group' => $account_group_id ]);
    }

    static function getBalanceSum($account_group_id)
    {
        $items = "SELECT IF (account_groups.position = 'Debit', SUM(debit) - SUM(credit), SUM(credit) - SUM(debit)) as amount
            FROM transaction_details
            JOIN accounts ON transaction_details.account_id = accounts.id
            JOIN account_groups ON accounts.account_group_id = account_groups.id
            JOIN transactions ON transaction_details.transaction_id = transactions.id
            WHERE transactions.created_at BETWEEN :startDate AND :endDate
            AND accounts.account_group_id = :group
            ORDER BY accounts.id";

        return DB::connection('tenant')
            ->select($items, [ 'startDate' => Report::startDate(), 'endDate' => Report::endDate(), 'group' => $account_group_id ])[0]
            ->amount;
    }

    static function get()
    {
        // penjualan: ambil dari account group penjualan.
        $revenue = static::getBalance(7);
        $cgs = static::getBalance(8);
        $expenses = static::getBalance(9);

        $totals['revenue'] = static::getBalanceSum(7);
        $totals['cgs'] = static::getBalanceSum(8);
        $totals['expenses'] = static::getBalanceSum(9);
        $totals['gross'] = $totals['revenue'] - $totals['cgs'];
        $totals['net'] =  $totals['gross'] - $totals['expenses'];

        return compact('revenue', 'cgs', 'expenses', 'periods', 'totals');
    }
}
