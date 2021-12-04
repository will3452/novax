
<div class="w-full shadow stats">
    <div class="stat">
      <div class="stat-figure text-secondary">
        <span class="material-icons">
            signpost
        </span>
      </div>
      <div class="stat-title">Job Offers</div>
      <div class="stat-value">{{\App\Models\JobOffer::whereStatus(\App\Models\JobOffer::STATUS_OPEN)->count()}}</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-secondary">
            <span class="material-icons">
                description
            </span>
        </div>
        <div class="stat-title">Applications</div>
        <div class="stat-value">{{auth()->user()->applications()->whereStatus(\App\Models\JobApplication::STATUS_PENDING)->count()}}</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-secondary">
            <span class="material-icons">
                pending_actions
            </span>
        </div>
        <div class="stat-title">Pending</div>
        <div class="stat-value">{{auth()->user()->applications()->whereStatus(\App\Models\JobApplication::STATUS_PENDING)->count()}}</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-secondary">
            <span class="material-icons">
                question_answer
            </span>
        </div>
        <div class="stat-title">Interview</div>
        <div class="stat-value">{{auth()->user()->applications()->whereStatus(\App\Models\JobApplication::STATUS_PENDING)->count()}}</div>
    </div>
  </div>
