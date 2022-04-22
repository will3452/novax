@props(['title' => '', 'icon' => 'subject', 'value' => '0'])
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">{{$icon}}</i>
        </div>
        <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">{{$title}}</p>
            <h4 class="mb-0">{{$value}}</h4>
        </div>
        </div>
    </div>
</div>
