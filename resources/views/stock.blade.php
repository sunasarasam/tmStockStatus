<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check Stock Price</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-4" style="background-color: #f2f2f2; border-radius: 10px; padding: 25px; margin: 0 auto;">
                <h4 class="text-center">{{ 'Wellcome  ' . \Session::get('userName') }}</h4>
                <div class="mb-3">
                    <input type="text" class="form-control" id="stockName" placeholder="Enter Stock Name i.g AMZN">
                </div>
                <button type="button" class="btn btn-primary" id="getStockPrice">Get Price</button>
                <a href="logout" class="btn btn-danger" id="logout" style="float: right;">Logout</a>
                <hr>
                <p id="symbol"></p>
                <p id="high"></p>
                <p id="low"></p>
                <p id="price"></p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#getStockPrice').on('click', function() {
            var stockName = $('#stockName').val();

            $.ajax({
                url: "{{ url('getStockPrice') }}",
                data: {
                    'stockName': stockName
                },
                type: 'GET',
                dataType: 'json',
                success: function(result) {
                    var storeSymbol = result.data.symbol.replace(/^"|"$/g, '');
                    $('#symbol').html('Stock Symbol is <b>' + storeSymbol + '</b>');

                    var storeHigh = result.data.high.replace(/^"|"$/g, '');
                    $('#high').html('Stock High is <b>' + storeHigh + '</b>');

                    var storeLow = result.data.low.replace(/^"|"$/g, '');
                    $('#low').html('Stock Low is <b>' + storeLow + '</b>');

                    var storePrice = result.data.price.replace(/^"|"$/g, '');
                    $('#price').html('Stock Price is <b>' + storePrice + '</b>');
                }
            });
        })
    </script>
</body>

</html>