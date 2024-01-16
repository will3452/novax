<div class="col-lg-12">
    <div class="sidebar-item recent-posts">
      <div class="sidebar-heading">
        <h2>Recent Posts</h2>
      </div>
      <div class="content">
        <ul>
         @foreach (\App\Models\Post::latest()->take(5)->get() as $item)
          <li><a href="#">
              <h5>{{$item->title}}</h5>
              <span>{{$item->created_at->diffForHumans()}}</span>
          </a></li>
         @endforeach
        </ul>
      </div>
    </div>
  </div>