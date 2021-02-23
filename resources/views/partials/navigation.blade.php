<!doctype html>
<html lang="ja">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
</head>
 
<body>
    <nav class="navbar navbar-expand-xl navbar-dark bg-info mt-3 mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav3" aria-controls="navbarNav3" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav3">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/home" data-toggle="tooltip" title="Home">
                        <img src="{{ asset('icon/home.svg') }}" />
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/order/list" data-toggle="tooltip" title="Order">
                        <img src="{{ asset('icon/order.svg') }}" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/customer/list" data-toggle="tooltip" title="Customer">
                        <img src="{{ asset('icon/customer.svg') }}" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/analytics" data-toggle="tooltip" title="Analytics">
                        <img src="{{ asset('icon/analytics.svg') }}" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout" data-toggle="tooltip" title="Logout">
                        <img src="{{ asset('icon/logout.svg') }}" />
                    </a>
                </li>
            </ul>
        </div>
    </nav>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
</body>
 
</html>