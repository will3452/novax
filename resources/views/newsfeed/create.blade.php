@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-plus-square-o"></i>
            <span class="mx-2">New Post</span>
        </div>
        <div class="card-body">
            <form action="{{route('nf.post')}}" method="POST">
                @csrf
                <div class="form-group mt-2">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group mt-2">
                    <label for="">Category</label>
                    <input type="text" class="form-control" name="category" required>
                </div>
                <div class="form-group mt-2">
                    <label for="">Content</label>
                    <textarea class="form-control" name="content" id="content"></textarea>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
