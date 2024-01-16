<div class="col-lg-12">
    <div class="sidebar-item categories">
      <div class="sidebar-heading">
        <h2>Destination Categories</h2>
      </div>
      <div class="content">
        <ul>
          @foreach (\App\Models\Category::get() as $item)
              <li><a href="#">- {{$item->category}}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>