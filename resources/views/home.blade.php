@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Account Setting
                </div>
                <div class="card-body">
                    <form action="/change-password" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" value="{{auth()->user()->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" value="{{auth()->user()->email}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button class=" mt-2 btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body text-center">
                        <h2>Topics</h2>
                        <a class="btn btn-primary btn-sm" href="/topics">
                            View
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body text-center">
                        <h2>Faculties</h2>
                        <a class="btn btn-primary btn-sm" href="/faculties">
                            View
                        </a>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card card-body text-center">
                        <h2>Conversations</h2>
                        <a class="btn btn-primary btn-sm" href="/conversations">
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
