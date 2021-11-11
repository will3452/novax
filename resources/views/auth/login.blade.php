<x-auth>
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" action="{{route('login')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input value="{{old('email')}}"type="email" name="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address...">
                                        @error('email')
                                            <div class="text-center">
                                                <span class="text-danger text-xs">
                                                    {{$message}}
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input value="{{old('password')}}"type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" name="password" placeholder="Password">
                                            @error('password')
                                                <div class="text-center">
                                                    <span class="text-danger text-xs">
                                                        {{$message}}
                                                    </span>
                                                </div>
                                            @enderror
                                    </div>
                                    <button  class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <div class="mt-4">
                                    <div class="text-center">
                                        <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{route('register')}}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-auth>
