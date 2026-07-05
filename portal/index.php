<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPP ScoreCard Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body{
            font-family:'Poppins',sans-serif;
            background: linear-gradient(135deg,#0f172a,#1e3a8a);
            min-height:100vh;
        }

        .hero{
            padding-top:70px;
            padding-bottom:50px;
            text-align:center;
            color:white;
        }

        .hero h1{
            font-weight:700;
            font-size:48px;
        }

        .hero p{
            color:#d1d5db;
            font-size:18px;
        }

        .erp-card{
            border:none;
            border-radius:18px;
            overflow:hidden;
            transition:.35s;
            box-shadow:0 15px 40px rgba(0,0,0,.15);
        }

        .erp-card:hover{
            transform:translateY(-8px);
            box-shadow:0 20px 45px rgba(0,0,0,.25);
        }

        .card-header{
            border:none;
            padding:30px;
            color:white;
        }

        .danone{
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
        }

        .other{
            background:linear-gradient(135deg,#059669,#047857);
        }

        .icon-box{
            width:80px;
            height:80px;
            border-radius:50%;
            background:rgba(255,255,255,.15);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:40px;
            margin:auto;
            margin-bottom:20px;
        }

        .card-body{
            padding:35px;
        }

        .btn-login{
            border-radius:50px;
            padding:12px 35px;
            font-weight:600;
        }

        .footer{
            text-align:center;
            color:#d1d5db;
            margin-top:40px;
            font-size:14px;
        }

        .logo{
            width:70px;
            height:70px;
            border-radius:20px;
            background:white;
            color:#2563eb;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:36px;
            margin:auto;
            margin-bottom:20px;
            box-shadow:0 10px 25px rgba(0,0,0,.15);
        }

        .glass{
            background:rgba(255,255,255,.08);
            backdrop-filter:blur(10px);
            border-radius:25px;
            padding:30px;
        }
    </style>

</head>

<body>

<div class="container">

    <div class="hero">

        <div class="logo">
            <i class="bi bi-bar-chart-fill"></i>
        </div>

        <h1>SPP ScoreCard Portal</h1>

        <p>
            Supplier Performance Portal<br>
            Select your customer to continue.
        </p>

    </div>

    <div class="glass">

        <div class="row g-4 justify-content-center">

            <!-- Danone -->
            <div class="col-lg-5">

                <div class="card erp-card">

                    <div class="card-header danone text-center">

                        <div class="icon-box">
                            <i class="bi bi-building"></i>
                        </div>

                        <h3 class="mb-0">
                            DANONE
                        </h3>

                    </div>

                    <div class="card-body text-center">

                        <p class="text-muted">
                            Access Supplier Performance ScoreCard for Danone.
                        </p>

                        <a href="https://danone.satriapirantiperkasa.com"
                            class="btn btn-primary btn-login">

                            <i class="bi bi-box-arrow-in-right"></i>
                            Login

                        </a>

                    </div>

                </div>

            </div>

            <!-- Other Customer -->
            <div class="col-lg-5">

                <div class="card erp-card">

                    <div class="card-header other text-center">

                        <div class="icon-box">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <h3 class="mb-0">
                            OTHER CUSTOMERS
                        </h3>

                    </div>

                    <div class="card-body text-center">

                        <p class="text-muted">
                            Access Supplier Performance ScoreCard for all customers.
                        </p>

                        <a href="https://allsite.satriapirantiperkasa.com"
                            class="btn btn-success btn-login">

                            <i class="bi bi-box-arrow-in-right"></i>
                            Login

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="footer mt-5 pb-4">

        © 2026 Satria Piranti Perkasa<br>
        Supplier Performance Portal

    </div>

</div>

</body>

</html>