@extends('layouts.app')

@section('content')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
        <div class="card mb-2">
            <div class="card-header">
                PREFERENCE
            </div>
            <div class="card-body">
                <form action="{{route('profiles.update.preferences', ['user' => auth()->id()])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="">Current Program</label>
                        <select name="program_id" id="" class="form-select">
                            @foreach ($programs as $program)
                                <option value="" disabled selected>--</option>
                                <option value="{{$program->id}}" {{ $program->id == auth()->user()->program_id ? 'selected': ''}}>
                                    {{$program->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="email">Turn Workout Reminder?</label>
                        <div>
                            <span>
                                <input type="radio" name="workout_reminder" value="1" {{ auth()->user()->workout_reminder == 1 ? 'checked':'' }}>
                                Yes
                            </span>
                            <span>
                                <input type="radio" name="workout_reminder" value="0"  {{ auth()->user()->workout_reminder == 0 ? 'checked':'' }}>
                                No
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-primary">SAVE CHANGES</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                ACCOUNT SETTING
            </div>
            <div class="card-body">
                <form action="{{route('profiles.update.account', ['user' => auth()->id()])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="email">Email</label>
                        <input type="email" disabled value="{{auth()->user()->email}}" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="email">Name</label>
                        <input type="text" disabled value="{{auth()->user()->name}}" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="email">Gender</label>
                        <input type="text" disabled value="{{auth()->user()->gender}}" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="email">Birthdate</label>
                        <input type="date" name="birthdate" value="{{auth()->user()->birthdate->format('Y-m-d')}}" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="email">Current password</label>
                        <input type="password"  name="currentPassword" value="" placeholder="********" class="form-control">
                        <small class="text-xs">
                            Leaving this field empty means there's no change.
                        </small>
                    </div>
                    <div class="mb-2">
                        <label for="email">New password</label>
                        <input type="password" name="newPassword"  value="" placeholder="********" class="form-control">
                    </div>
                    <button class="btn btn-primary">SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
@endsection
