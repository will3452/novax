<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/assets/css/templatemo-stand-blog.css">
    <link rel="stylesheet" href="/assets/css/owl.css">
<!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <x-header></x-header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
      <div class="container-fluid">
        <div class="owl-banner owl-carousel">
          @foreach (\App\Models\Destination::inRandomOrder()->take(10)->get() as $item)
          <div class="item">
            <img src="/storage/{{$item->photographs()->first()->image}}" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>{{$item->category->category}}</span>
                </div>
                <a href="#details"><h4>{{$item->name}}</h4></a>
                <ul class="post-info">
                  <li><a href="#">{{$item->location}}</a></li>
                </ul>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->


    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                @forelse (\App\Models\Post::latest()->take(5)->get() as $item)
                <div class="col-lg-12">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="assets/images/blog-post-01.jpg" alt="">
                      </div>
                      <div class="down-content">
                        {{-- <span>Lifestyle</span> --}}
                        <a href="#details"><h4>{{$item->title}}</h4></a>
                        <ul class="post-info">
                          <li><a href="#">{{$item->user->name}}</a></li>
                          <li><a href="#">{{$item->created_at->diffForHumans()}}</a></li>
                        </ul>
                        <p>{{$item->excerpt}}</p>
                        <div class="post-options">
                          <div class="row">
                            <div class="col-6">
                              <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                @foreach ($item->tags as $item)
                                    <li><a href="#">{{$item->tag}}</a> </li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                    <h1>No post to show</h1>
                @endforelse
                <div class="col-lg-12">
                  <div class="main-button">
                    <a href="#">View All Posts</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <div class="col-lg-12">
                  <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="#">
                      <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                    </form>
                  </div>
                </div>
                <x-recent-post></x-recent-post>
                <x-destination-categories></x-destination-categories>
                <x-blog-tags></x-blog-tags>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <x-footer></x-footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>