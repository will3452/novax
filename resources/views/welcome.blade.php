<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{env('APP_NAME')}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <style>
        .bg-primary, .btn-primary {
            background: #990012 !important;
        }
        .text-primary {
            color: #990012 !important;
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0" >{{env('APP_NAME')}}</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="/" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#pro" class="nav-item nav-link">Products</a>
                        <a href="#fb" class="nav-item nav-link">Feedback</a>
                    </div>

                </div>
            </nav>

            <div class="container-xxl py-5 bg-primary hero-header mb-5">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5 py-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="text-white mb-4 animated zoomIn">Welcome to {{env('APP_NAME')}}</h1>
                            <p class="text-white pb-3 animated zoomIn"></p>
                            <a href="#about" class="btn btn-light py-sm-3 px-sm-5 rounded-pill me-3 animated slideInLeft">ABOUT US</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-start">
                            <img class="img-fluid" style="border-radius: 50%; "  src="img/undraw_Services_re_hu5n.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->




        <!-- About Start -->
        <div class="container-xxl py-5" id="about">
            <div class="container px-lg-5">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="section-title position-relative mb-4 pb-2">
                            <h6 class="position-relative text-primary ps-4" >About Us</h6>

                        </div>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet</p>


                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="img/about.jpg">
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <div  id="pro" class="mx-4">
            <div class="card ">
                <div class="card-header">
                    LIST OF PRODUCTS
                </div>
               <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\Product::get() as $item)
                            <tr>
                                <td>
                                    {{$item->name}}
                                </td>
                                <td>
                                    {{$item->category}}
                                </td>
                                <td>
                                    {{$item->price}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               </div>
            </div>
        </div>





        <!-- Testimonial Start -->
        <div class="container-xxl bg-primary testimonial py-5 my-5 wow fadeInUp"
        id="fb" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="owl-carousel testimonial-carousel">
                    @foreach (\App\Models\Feedback::get() as $item)
                    <div class="testimonial-item bg-transparent border rounded text-white p-4">
                        <i class="fa fa-quote-left fa-2x mb-3"></i>
                        <p>{{$item->message}}</p>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h6 class="text-white mb-1">{{$item->name}}</h6>
                                <small>{{$item->profession}}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container py-5  ">
            <h1>Write a feedback</h1>
            <form action="/fb" method="POST">
                <div x-data="{star:0, }" class="mb-4">
                    <input type="hidden" name="star" x-model="star">
                    <img x-bind:src="star <= 0 ? '/icons/empty.svg': 'icons/filled.svg'" alt="" x-on:click="star = 1" style="width:50px;cursor:pointer;">
                    <img x-bind:src="star <= 1 ? '/icons/empty.svg': 'icons/filled.svg'" alt="" x-on:click="star = 2" style="width:50px;cursor:pointer;">
                    <img x-bind:src="star <= 2 ? '/icons/empty.svg': 'icons/filled.svg'" alt="" x-on:click="star = 3" style="width:50px;cursor:pointer;">
                    <img x-bind:src="star <= 3 ? '/icons/empty.svg': 'icons/filled.svg'" alt="" x-on:click="star = 4" style="width:50px;cursor:pointer;">
                    <img x-bind:src="star <= 4 ? '/icons/empty.svg': 'icons/filled.svg'" alt="" x-on:click="star = 5" style="width:50px;cursor:pointer;">
                </div>
                @csrf
                <input type="text" required placeholder="Your Name" name="name" class="form-control">
                <div class="my-2">
                    <input type="text" required placeholder="Your Profession" name="profession" class="form-control">
                </div>
                <textarea class="form-control" name="message" id="" cols="30" rows="10" placeholder="Your Feedback message" required ></textarea>
                <button class="btn btn-primary mt-2">SUBMIT</button>
            </form>
        </div>
        <!-- Testimonial End -->




        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- JavaScript Libraries -->

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
