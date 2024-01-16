<!-- Header -->
<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.html">
          <img src="/logo.png" alt="" style="width:75px; height:75px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-items">
              <a class="nav-link {{route('welcome') == url()->current() ? 'active': ''}}" href="/">Home
                <span class="sr-only">(current)</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link {{route('about') == url()->current() ? 'active': ''}}" href="/about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{route('destinations') == url()->current() ? 'active': ''}}" href="{{route('destinations')}}">Tourist Destinations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{route('blogs') == url()->current() ? 'active': ''}}" href="/blogs">Blogs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/contacts">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>