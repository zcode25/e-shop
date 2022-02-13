<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/eshop.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .jumbotron {
            background-color: #009486;
            color: white;
        }

        .tombol {
            background-color: white;
            color: #009486;
            border: none;
        }

        .tombol:hover {
            background-color: white !important;
            color: #009486 !important;
            border: none !important;
        }

        .tombol2:hover {
            color: white;
            background-color: #009486;
        }

        hr {
            background-color: white;
            opacity: .5;
        }

        .card:hover {
            color: white;
            background-color: #009486;
        }

        .footer {
            background-color: black;
            color: white;
            margin-top: 100px;
        }
    </style>

    <title>Electronic Shop</title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-4">e-shop</h1>
            <p class="lead mt-3">Membuat bisnis kamu dapat berjalan dengan efektif dan efisien.</p>
            <hr>
            <p class="lead mt-3">
                <a class="btn btn-primary tombol mr-1" href="pendaftaran.php">Daftar Sekarang</a>
                <a class="btn btn-outline-light tombol2 ml-1" href="login.php">Login</a>
            </p>
        </div>
    </div>

    <div class="info">
        <div class="container">
            <div class="row text-center d-flex justify-content-center">
                <div class="col-md-6 mt-5">
                    <h3>Tentang</h3>
                    <p class="mt-3">e-shop adalah sebuah aplikasi berbasis web yang dapat membantu kelola binis kamu secara terkomputerisasi, sehingga bisnis kamu dapat berjalan dengan efektif dan efisien.</p>
                </div>
            </div>
            <div class="row text-center d-flex justify-content-center">
                <div class="col-md-6 mt-5">
                    <h3>Kontak</h3>
                    <div class="row">
                        <div class="col">
                            <div class="card mt-3" style="cursor: pointer" onclick="window.location = 'mailto:adamzein345@gmail.com'">
                                <div class="card-body">
                                    <h5 class="card-title">Email</h5>
                                    <p class="card-text">adamzein345@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mt-3" style="cursor: pointer" onclick="window.location = 'https://www.instagram.com/azein25/';">
                                <div class="card-body">
                                    <h5 class="card-title">Instagram</h5>
                                    <p class="card-text">@azein25</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer p-5">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <p>Develop by</p>
                    <h4>ZCODE | Adam Zein</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>