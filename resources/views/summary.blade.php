<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>RD Legal - Summary</title>

        <link rel="stylesheet" href="css/summary.css">
    </head>
    <body>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">RD Legal</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                  <li class="nav-item active">
                      <a class="nav-link" href="{{ action('SummaryController@index') }}">Summary <span class="sr-only"></span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ action('TransactionController@index') }}">Transactions</a>
                  </li>
              </ul>
          </div>
      </nav>

      <div class="container">
          <pre>
            <?php
                //print_r($summary)
            ?>
          </pre>

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
                                  <td>${{ number_format($value->transaction_amount_sum) }}</td>
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
                                  <td>${{ number_format($value->transaction_amount_sum) }}</td>
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
                                  <td>${{ number_format($value->transaction_amount_sum) }}</td>
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
                                  <td>${{ number_format($value->transaction_amount_sum) }}</td>
                                  <td>{{ $value->week }}</td>
                                  <td>{{ $value->year }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>

      </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function hideAll() {
                document.getElementById("year_data").style.display = "none";
                document.getElementById("month_data").style.display = "none";
                document.getElementById("quarter_data").style.display = "none";
                document.getElementById("week_data").style.display = "none";
            }

            $( document ).ready(function() {
                hideAll();
                $("#year_data").show();

                $( "#year_btn" ).click(function() {
                    hideAll();
                    $("#year_data").show();
                });

                $( "#month_btn" ).click(function() {
                    hideAll();
                    $("#month_data").toggle();
                });

                $( "#quarter_btn" ).click(function() {
                    hideAll();
                    $("#quarter_data").show();
                });

                $( "#week_btn" ).click(function() {
                    hideAll();
                    $("#week_data").show();
                });

            });

        </script>
    </body>
</html>
