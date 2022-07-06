<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        :root {
            --primary: #092e47;
            --secondary: #98c83b;
        }
        .bg-primary {
            background: var(--primary) !important;
        }
        .bg-secondary {
            background: var(--secondary) !important;
        }
        .text-secondary {
            color: var(--secondary) !important;
        }
        .text-2xl {
            font-size: 480%;
        }
        .bg-gray {
            background: #eee;
        }
        .rounded-none {
            border-radius: 0px !important;
        }
    </style>

</head>
<body>

    <nav class="navbar bg-white">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="/img/logo.png" alt="" style="width:100px;">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">NUTRISERVE</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

        <div class="bg-primary row text-white p-5 align-items-center">
            <div class="col-12 col-md-6 my-5">
                <h3 class="text-secondary">
                    Health is a bond between you and your body.
                </h3>
                <h1 class="text-2xl">
                    NutriServe
                </h1>
                <h4>A food management that helps clients to have a proper weight and healthy body.</h4>
                <div class="d-flex mt-3">
                    <a href="/register" class="btn btn-dark m-2 bg-secondary btn-lg">Register</a>
                    <a href="/login" class="btn btn-dark m-2 btn-lg">Login</a>
                </div>
            </div>
            <div class="col-12 col-md-6 my-5">
                <img src="/img/nutrition-banner-03.png" class="w-100" alt="">
            </div>
          </div>

      <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <img src="/img/fruits.jpg" alt="" class="w-100">
            </div>
            <div class="col-md-6 col-12">
                <h3>
                    Diet Plan and Proper Exercise
                </h3>
                <p>
                    Diet Plan and Proper Exercise will help the client to have a healthy lifestyle and diet plan and proper exercise also will help the client to have a proper and balanced weight and it is also one of the ways to prevent a client from becoming malnourished and overweight and help the client to reduce the risk of having diseases like high blood, cholesterol, diabetes. These are the most common diseases of people and why people are often overweight and have weak bodies who do not have a proper diet and proper exercise to prevent this Nutriserve has a diet plan and proper exercise to guide and teach to the client to have a healthy and happy lifestyle.
                </p>
            </div>
        </div>
      </div>
      <div class="bg-gray p-5">
        <h1 class="text-center">What We Need For Good Health?</h1>
        <div class="row g-5  py-5">
            <div class="col-md-3">
                <div class="card rounded-none">
                    <img src="/img/coaching.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                            <h4>Nutrition Coaching</h4>
                            <p>
                                Work with Corporate Groups
                            </p>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-none">
                    <img src="/img/lose weight.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                            <h4>Lose Weight</h4>
                            <p>Plan your meals</p>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-none">
                    <img src="/img/sport.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                            <h4>Sports Nutrition</h4>
                            <p>Sports Nutrition</p>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-none">
                    <img src="/img/service-04.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                            <h4>
                                Balance Body Mind
                            </h4>
                            <p>
                                Eat a nutritious and balanced diet
                            </p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <footer class="bg-primary text-white p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="mb-4">Contact</h5>
                    <p>info@nutriserve.site</p>
                    <p>09952250571</p>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <img src="/img/Nutri-1-150x150.png" alt="">
                </div>
                <div class="col-md-4 text-right">
                    <h5 class="mb-4">Address</h5>
                    <p>Tarlac State University</p>
                    <p>Romulo Blvd Tarlac City, Tarlac</p>
                </div>
            </div>
            <div class="text-sm text-center">
                <small>Copyright © 2022 NutriServe</small>
            </div>
        </div>
      </footer>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
