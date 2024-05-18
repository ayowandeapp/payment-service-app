<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Payment Integration </title>
</head>

<body>
    <div class="container-fluid">
        <!-- Image and text -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="" width="30" height="30" class="d-inline-block align-top" alt="">
                Payment Portal
            </a>
        </nav>

        <br>

        <div class="row justify-content-center">
            <div class="col-md-6">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Success Message -->
                @if (session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
                @endif
                <form method="post" action="/payment">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputAmount">Enter Amount</label>
                        <input type="number" class="form-control" id="exampleInputAmount" aria-describedby="help" placeholder="Enter amount" name="amount" required min="0">
                        <small id="help" class="form-text text-muted">Kindly insert an amount.</small>
                        <div class="invalid-feedback">
                            Please enter a valid amount.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>

        <br>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/" method="get" id="filterForm">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Filter</label>
                        <select class="form-control" id="periodChange" name="period">
                            <option value="daily" @if($period=='daily' ) selected @endif>Daily</option>
                            <option value="monthly" @if($period=='monthly' ) selected @endif>Monthly</option>
                            <option value="yearly" @if($period=='yearly' ) selected @endif>Yearly</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Platform</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $transaction->payment_platform }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->transaction_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <script>
        // Get the select element
        var selectElement = document.getElementById('periodChange');

        // Add event listener for the change event
        selectElement.addEventListener('change', function() {
            // Get the form element
            var formElement = document.getElementById('filterForm');

            // Submit the form
            formElement.submit();
        });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</body>

</html>