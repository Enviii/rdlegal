<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = array();

        return view('transaction')->with('transactions', $transactions);
    }

    /**
     * Query by date for all negative transactions
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getNegativeTransaction(Request $request)
    {
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');

        $transactions = \DB::select("SELECT * FROM sales_data WHERE transaction_date BETWEEN ? AND ? AND transaction_amount < 0 ORDER BY  transaction_date", [$date_start, $date_end]);

        return view('transaction')
            ->with('transactions', $transactions)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end);
    }
}
