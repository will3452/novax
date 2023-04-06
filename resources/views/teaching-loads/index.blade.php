@extends('layouts.app')

@section('content')
    <div class="container">
       <div>
            <h1>Teaching Loads</h1>
            <div class="d-flex align-items-center" style="justify-content: space-between" >
                <div class="fw-bold">
                    A.Y {{\App\Models\AcademicYear::active()->year}}
                </div>
                <form action="">
                    <input type="search" value="{{request()->keyword}}" name="keyword" placeholder="Search" style="max-width: 300px;" class="form-control-sm form-control">
                </form>
            </div>
       </div>

       <div class="row mt-4">
        @forelse (auth()->user()->teachingLoads()->with('subject')->get() as $item)
        <div class="col-md-4">
            <x-load-item :item="$item" :hasLink="true"></x-load-item>
        </div>
        @empty
            No data found.
        @endforelse
       </div>

@endsection
