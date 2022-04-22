<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

    </div>
    <ul class="navbar-nav  justify-content-end">

      <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </a>
      </li>
      {{-- <li class="nav-item px-3 d-flex align-items-center">
        <a href="/announcement" class="nav-link text-body p-0">
          <i class="fa fa-bell fixed-plugin-button-nav cursor-pointer"></i>
        </a>
      </li> --}}
      <li class="nav-item pe-2 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" data-bs-toggle="modal" data-bs-target="#logout">
          <img src="{{auth()->user()->getPicture()}}" alt="" style="width:30px;height:30px; object-cover:fit; border-radius:50%; border:1px solid #aaa;margin-right:10px;">
          <span class="d-sm-inline d-none">{{auth()->user()->name}}</span>
        </a>
        <div class="modal fade" tabindex="-1" role="dialog" id="logout" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-body">
                    <a href="/logout" class="btn btn-primary">Logout</a>
                </div>
            </div>
       </div>
      </li>
    </ul>
  </div>
