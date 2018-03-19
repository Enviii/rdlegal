@extends('layout')

@section('custom-css')
    <link href="{{ asset('css/summary.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="container">
    	<div id="filters" class="row">
    		<div class="col-12 text-center">
    			<button id="year_btn" type="button" class="btn btn-primary">Year</button>
    			<button id="quarter_btn" type="button" class="btn btn-info">Quarter</button>
    			<button id="month_btn" type="button" class="btn btn-success">Month</button>
    			<button id="week_btn" type="button" class="btn btn-dark">Week</button>
    		</div>
    	</div>
    	<div id="year_data" class="row">
    		<div class="col-12">
    			<h3>Sum by Year</h3>
    			<table class="table table-bordered table-sm table-striped">
    				<thead>
    					<tr>
    						<th>Quantity (Sum)</th>
    						<th>Transaction Amount (Sum)</th>
    						<th>Year</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach ($summary['year'] as $key => $value)
    					<tr>
    						<td>{{ number_format($value->quantity_sum) }}</td>
    						<td>{{ $value->transaction_amount_sum < 0 ? "-$" . number_format(abs($value->transaction_amount_sum)) : "$" . number_format($value->transaction_amount_sum) }}</td>
    						<td>{{ $value->year }}</td>
    					</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    	<div id="quarter_data" class="row">
    		<div class="col-12">
    			<h3>Sum by Quarter</h3>
    			<table class="table table-bordered table-sm table-striped">
    				<thead>
    					<tr>
    						<th>Quantity (Sum)</th>
    						<th>Transaction Amount (Sum)</th>
    						<th>Quarter</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach ($summary['quarter'] as $key => $value)
    					<tr>
    						<td>{{ number_format($value->quantity_sum) }}</td>
    						<td>{{ $value->transaction_amount_sum < 0 ? "-$" . number_format(abs($value->transaction_amount_sum)) : "$" . number_format($value->transaction_amount_sum) }}</td>
    						<td>Q{{ $value->quarter }} {{ $value->year }}</td>
    					</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    	<div id="month_data" class="row">
    		<div class="col-12">
    			<h3>Sum by Month</h3>
    			<table class="table table-bordered table-sm table-striped">
    				<thead>
    					<tr>
    						<th>Quantity (Sum)</th>
    						<th>Transaction Amount (Sum)</th>
    						<th>Date</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach ($summary['month'] as $key => $value)
    					<tr>
    						<td>{{ number_format($value->quantity_sum) }}</td>
    						<td>{{ $value->transaction_amount_sum < 0 ? "-$" . number_format(abs($value->transaction_amount_sum)) : "$" . number_format($value->transaction_amount_sum) }}</td>
    						<td>{{ date('M Y', strtotime($value->year . "-" . $value->month . "-1")) }}</td>
    					</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    	<div id="week_data" class="row">
    		<div class="col-12">
    			<h3>Sum by Week</h3>
    			<table class="table table-bordered table-sm table-striped">
    				<thead>
    					<tr>
    						<th>Quantity (Sum)</th>
    						<th>Transaction Amount (Sum)</th>
    						<th>Week #</th>
    						<th>Year</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach ($summary['week'] as $key => $value)
    					<tr>
    						<td>{{ number_format($value->quantity_sum) }}</td>
    						<td>{{ $value->transaction_amount_sum < 0 ? "-$" . number_format(abs($value->transaction_amount_sum)) : "$" . number_format($value->transaction_amount_sum) }}</td>
    						<td>{{ $value->week }}</td>
    						<td>{{ $value->year }}</td>
    					</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>

    @endsection

    @section('custom-js')
        <script src="{{ asset('js/summary.js') }}"></script>
    @endsection
