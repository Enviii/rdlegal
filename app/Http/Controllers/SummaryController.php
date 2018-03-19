<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //year
        $summary_year = \DB::select("SELECT SUM(quantity) AS quantity_sum, SUM(transaction_amount) AS transaction_amount_sum, YEAR (transaction_date) AS year
                                    FROM sales_data
                                    GROUP BY YEAR (transaction_date)"
                        );

        //quarter
        $summary_quarter = \DB::select("SELECT SUM(quantity) AS quantity_sum, SUM(transaction_amount) AS transaction_amount_sum, YEAR (transaction_date) AS year, QUARTER (transaction_date) AS quarter
                                    FROM sales_data
                                    GROUP BY YEAR (transaction_date), QUARTER (transaction_date)"
                        );

        //month
        $summary_month = \DB::select("SELECT SUM(quantity) AS quantity_sum, SUM(transaction_amount) AS transaction_amount_sum, YEAR (transaction_date) AS year, MONTH (transaction_date) AS month
                                    FROM sales_data
                                    GROUP BY YEAR (transaction_date), MONTH (transaction_date)"
                        );
        //week
        $summary_week = \DB::select("SELECT SUM(quantity) AS quantity_sum, SUM(transaction_amount) AS transaction_amount_sum, YEAR (transaction_date) AS year, WEEK (transaction_date) AS week
                                    FROM sales_data
                                    GROUP BY YEAR (transaction_date), WEEK (transaction_date)"
                        );

        $summary = array();
        $summary['year'] = $summary_year;
        $summary['quarter'] = $summary_quarter;
        $summary['month'] = $summary_month;
        $summary['week'] = $summary_week;

        return view('summary')->with('summary', $summary);
    }

}
