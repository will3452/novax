@props(['model'=> null, 'action' => '#', 'active' => false, 'proceedText'=>'view', 'takeable' => true, 'score' => null])
<li class="pl-4 @if (! $active) text-gray-400 @endif">
    {{$slot}}
    @teacher
        @if (! request()->has('student'))
            <a href="/view-records/{{\App\Helpers\Model::getModel($model)}}/{{$model->id}}" class="ml-5 btn btn-xs btn-primary">View Record(s)</a>
        @elseif (! is_null($score))
            <span class="text-xs font-bold"> - score:{{$score}}</span>
        @else
                @activity($model)
                    <span class="text-xs text-red-600"> - No Grade.</span>
                @else
                    <span class="text-xs text-red-600"> - Opened.</span>
                @endactivity


        @endif
    @else

    @if ($active)
        @if ($takeable)
            @student
                @if (! $model->isExpired() && ! is_null($score))
                    <a href="{{$action}}" class="ml-5 btn btn-xs btn-primary">{{$proceedText}}</a>
                @else
                    @activity($model)
                        @project($model)
                            <a href="{{$action}}" class="ml-5 btn btn-xs btn-primary">{{$proceedText}}</a>
                            @else
                                @if (! $model->isExpired() &&  is_null($score))
                                    <a href="{{$action}}" class="ml-5 btn btn-xs btn-primary">{{$proceedText}}</a>
                                @else
                                    <span class="text-red-600 text-xs">
                                        Time is over
                                    </span>
                                @endif
                        @endproject
                    @else
                    <a href="{{$action}}" class="ml-5 btn btn-xs btn-primary">{{$proceedText}}</a>
                    @endactivity
                @endif
            @else
               @activity($model)
               <span class="text-red-600">
                    - No Grade.
                @else
                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </span>
               @endactivity
            @endstudent
        @else
            @activity($model)
                @if (! is_null($score))
                    <span class="text-xs font-bold"> - score:{{$score}}</span>
                @else
                    <span class="text-xs text-red-600"> - No Grade.</span>
                @endif
            @else
                @if (! is_null($score))
                    <span class="text-xs font-bold"> - score:{{$score}}</span>
                @else
                    <span class="text-xs text-red-600"> - Opened</span>
                @endif
            @endactivity
        @endif
    @endif
    @endteacher
</li>
