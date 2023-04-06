@extends('layouts.app')

@section('content')
    <div class="container">
       <div>
            <h1>Latest feeds</h1>
            <div class="d-flex align-items-center" style="justify-content: space-between" >
                <a href="{{route('nf.create')}}">Write new post</a>
                <form action="">
                    <input type="search" value="{{request()->keyword}}" name="keyword" placeholder="Search" style="max-width: 300px;" class="form-control-sm form-control">
                </form>
            </div>
       </div>
       @forelse ($posts as $post)
        <div class="card mt-4">
            <div class="card-header d-flex align-items-center" style="justify-content: space-between">
                <div class="d-flex">
                    <div class="avatar">
                        {{auth()->user()->name[0]}}
                    </div>
                    <div class="mx-2" style="line-height: 0.5">
                        <h5>
                            {{$post->user->name}}
                        </h5>
                        <small>
                            {{ $post->created_at->diffForHumans()}}
                        </small>
                    </div>
                </div>
                <div class="badge bg-primary">
                    {{ $post->category }}
                </div>
            </div>
            <div class="card-body">
                <div class=" alert alert-secondary">
                    <h4>{{$post->title}}</h4>
                    {{ $post->content }}
                </div>
                <the-comments post-id="{{$post->id}}" user-id="{{auth()->id()}}"></the-comments>
            </div>
    </div>
        @empty
        <div class="alert alert-warning">
            No data found.
        </div>
       @endforelse
    </div>

@endsection
