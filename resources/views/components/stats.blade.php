<div class="stats bg-primary text-primary-content">

    <div class="stat">
        <div class="stat-title">Date Today</div>
        <div class="stat-value">{{now()->format('F d, Y')}}</div>
    </div>

    <div class="stat">
      <div class="stat-title">Images</div>
      <div class="stat-value">{{auth()->user()->images()->count()}}</div>
      <div class="stat-actions">
        <a href="{{route('gallery')}}" class="btn btn-sm">view all</a>
      </div>
    </div>

    <div class="stat">
      <div class="stat-title">Applications</div>
      <div class="stat-value">5</div>
      <div class="stat-actions">
        <a href="/applications" class="btn btn-sm">View All</a>
      </div>
    </div>

  </div>
