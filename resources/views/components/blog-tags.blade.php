<div class="col-lg-12">
    <div class="sidebar-item tags">
      <div class="sidebar-heading">
        <h2>Blog Tags</h2>
      </div>
      <div class="content">
        <ul>
          @foreach (\App\Models\Tag::latest()->get() as $item)
              <li><a href="#">{{$item->tag}}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>