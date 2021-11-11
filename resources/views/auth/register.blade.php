<x-auth>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="POST" action="/register">
                            @csrf
                            <div class="form-group">
                                <input value="{{old('name')}}" required type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="Name">
                                @error('name')
                                <div class="text-center">
                                    <span class="text-xs text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input value="{{old('email')}}" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" name="email" required>
                                @error('email')
                                <div class="text-center">
                                    <span class="text-xs text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                        @error('password')
                                        <div class="text-center">
                                            <span class="text-xs text-danger">
                                                {{$message}}
                                            </span>
                                        </div>
                                        @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <div class="text-center">
                            <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth>
