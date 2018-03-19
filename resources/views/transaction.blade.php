@extends('layout')

@section('custom-css')
    <link href="{{ asset('css/transaction.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
		<div class="container">
			<div id="filters" class="row">
				<div class="col-12">

                    <form method="post" action="{{ action('TransactionController@getNegativeTransaction') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    	<div class="form-group row">
                    		<label for="date_start" class="col-sm-2 col-form-label">Start Date</label>
                    		<div class="col-4">
                    			<input type="date" class="form-control" id="date_start" name="date_start" value="<?= isset($date_start) ? $date_start : '' ?>">
                    		</div>
                    	</div>
                    	<div class="form-group row">
                    		<label for="date_end" class="col-sm-2 col-form-label">End Date</label>
                    		<div class="col-4">
                    			<input type="date" class="form-control" id="date_end" name="date_end" value="<?= isset($date_end) ? $date_end : '' ?>">
                    		</div>
                    	</div>

                    	<div class="form-group row">
                    		<div class="col-sm-10">
                    			<button type="submit" class="btn btn-primary">Submit</button>
                    		</div>
                    	</div>
                    </form>

				</div>
			</div>

            <hr>

			<div id="transaction_data" class="row">
				<div class="col-12">
					<h3>Negative Transactions By Custom Date</h3>
					<table class="table table-bordered table-sm table-striped">
						<thead>
							<tr>
                                <th>Transaction ID</th>
                                <th>Customer ID</th>
                                <th>Quantity</th>
                                <th>Transaction Amount</th>
                                <th>Date</th>
							</tr>
						</thead>
						<tbody>
                            @foreach ($transactions as $key => $value)
                                <tr>
                                    <td>{{ $value->transaction_id }}</td>
                                    <td>{{ $value->customer_id }}</td>
                                    <td>{{ number_format($value->quantity) }}</td>
                                    <td>{{ $value->transaction_amount < 0 ? "-$" . number_format(abs($value->transaction_amount)) : "$" . number_format($value->transaction_amount) }}</td>
                                    <td>{{ $value->transaction_date }}</td>
    							</tr>
                            @endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

    @endsection

    @section('custom-js')
    @endsection
