<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <span class="ms-1 font-weight-bold text-white">Online Examination System</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="{{route('home')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        @admin
            <li class="nav-item">
                <a class="nav-link text-white " href="{{route('admin.user.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">people</i>
                    </div>
                    <span class="nav-link-text ms-1">Users Management</span>
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link text-white " href="/exams">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">list_alt</i>
                    </div>
                    <span class="nav-link-text ms-1">Exams</span>
                </a>
            </li>
        @endadmin
        <li class="nav-item">
            <a class="nav-link text-white " href="/account">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">account_circle</i>
                </div>
                <span class="nav-link-text ms-1">Account</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="/announcement">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Announcement</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
