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
        //$date_range = $this->getCalendarDates();

        //year
        $summary_year = \DB::table('sales_data')
                       ->select(\DB::raw('SUM(quantity) AS quantity_sum, SUM(transaction_amount) AS transaction_amount_sum, YEAR (transaction_date) AS year'))
                       ->groupBy(\DB::raw('YEAR (transaction_date)'))
                       ->get();

        //quarter
        $summary_year = \DB::table('sales_data')
                      ->select(\DB::raw('SUM(quantity) AS quantity_sum, SUM(transaction_amount) AS transaction_amount_sum, YEAR (transaction_date) AS year, QUARTER (transaction_date) AS quarter'))
                      ->groupBy(\DB::raw('YEAR (transaction_date), QUARTER (transaction_date)'))
                      ->get();

        //month
        $summary_month = \DB::table('sales_data')
                        ->select(\DB::raw('SUM(quantity) AS quantity_sum, SUM(transaction_amount) AS transaction_amount_sum, YEAR (transaction_date) AS year, MONTH (transaction_date) AS month'))
                        ->groupBy(\DB::raw('YEAR (transaction_date), MONTH (transaction_date)'))
                        ->get();

        //week
        $summary_week = \DB::table('sales_data')
                       ->select(\DB::raw('SUM(quantity) AS quantity_sum, SUM(transaction_amount) AS transaction_amount_sum, YEAR (transaction_date) AS year, WEEK (transaction_date) AS week'))
                       ->groupBy(\DB::raw('YEAR (transaction_date), WEEK (transaction_date)'))
                       ->get();


        $summary = array();
        $summary['year'] = $summary_year;
        $summary['quarter'] = $summary_year;
        $summary['month'] = $summary_month;
        $summary['week'] = $summary_week;


        return view('summary')->with('summary', $summary);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCalendarDates() {
        $ranges = array();

        //last_week
        $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight", $previous_week);
        $end_week = strtotime("next saturday", $start_week);

        $ranges["Last Week"]["start"] = date("Y-m-d", $start_week);
        $ranges["Last Week"]["end"] = date("Y-m-d", $end_week);

        //this_week
        if (date("l") == "Sunday") {
            $ranges["This Week"]["start"] = date('Y-m-d');
        } else {
            $ranges["This Week"]["start"] = date('Y-m-d', strtotime("Last Sunday"));
        }
        $ranges["This Week"]["end"] = date('Y-m-d', strtotime("This Saturday"));

        //month
        $ranges["Month"]["start"] = date('Y-m-01');
        $ranges["Month"]["end"] = date('Y-m-t');

        //quarter
        $current_month = date('m');
        $current_year = date('Y');
        if ($current_month>=1 && $current_month<=3) {
            $ranges["Quarter"]["start"] = date('Y-m-d', strtotime('1-January-'.$current_year));
            $ranges["Quarter"]["end"] = date('Y-m-d', strtotime('1-April-'.$current_year));
        } elseif($current_month>=4 && $current_month<=6) {
            $ranges["Quarter"]["start"] = date('Y-m-d', strtotime('1-April-'.$current_year));
            $ranges["Quarter"]["end"] = date('Y-m-d', strtotime('1-July-'.$current_year));
        } elseif($current_month>=7 && $current_month<=9) {
            $ranges["Quarter"]["start"] = date('Y-m-d', strtotime('1-July-'.$current_year));
            $ranges["Quarter"]["end"] = date('Y-m-d', strtotime('1-October-'.$current_year));
        } elseif($current_month>=10 && $current_month<=12) {
            $ranges["Quarter"]["start"] = date('Y-m-d', strtotime('1-October-'.$current_year));
            $ranges["Quarter"]["end"] = date('Y-m-d', strtotime('1-January-'.$current_year));
        }

        //year
        $ranges["Year"]["start"] = date('Y-01-01');
        $ranges["Year"]["end"] = date('Y-12-31');

        return $ranges;
    }

}
