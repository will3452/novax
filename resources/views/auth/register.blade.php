<x-layout>


    <div class="md:flex md:w-screen relative" >
        <div class="w-screen md:w-1/2 p-10 bg-red-100">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="flex items-center ">
                    <img src="/alarm.png" class="w-20"alt="">
                    <h1 class="font-bold text-4xl mx-4 font-mono">Police Emerge!</h1>
                </div>
                <h1 class="my-4 font-bold text-4xl mt-10 text-gray-800">LOGIN</h1>
                        <input id="email" type="email" class="w-full p-4 rounded mb-4 bg-white block placeholder-red-500  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email." required autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="password" type="password" class="w-full p-4 rounded mb-4 bg-white block placeholder-red-500 @error('password') is-invalid @enderror" name="password" required >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <div class="mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="font-bold text-red-500 underline" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                            </div>

                        <button type="submit" class=" px-4 p-2 bg-red-600  rounded text-white uppercase font-bold hover:bg-red-800">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-red-500 font-bold block mt-4 underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
            </form>
        </div>
        <div class="w-screen md:w-1/2 h-screen bg-red-500 p-10">
            <form method="POST" action="{{ route('register') }}" autocomplete="false">
                @csrf
                <p class="text-red-100 font-thin">
                    Instant Aid, Anytime, Anywhere: Your
                    Lifesaving Web Application
                </p>
                <h1 class="my-4 font-bold text-4xl text-red-100">SIGN UP</h1>
                <input id="name"  type="text" class=" w-full p-4 rounded mb-4 bg-red-100 block placeholder-red-500 @error('name') is-invalid @enderror" name="name" placeholder="Enter your name." value="{{ old('name') }}" required  autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="email" placeholder="Enter your Email." type="email" class=" w-full p-4 rounded mb-4 bg-red-100 block placeholder-red-500 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" placeholder="Enter your Password." type="password" class="w-full p-4 rounded mb-4 bg-red-100 block placeholder-red-500 @error('password') is-invalid @enderror" name="password" required >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="password-confirm" type="password" class="w-full p-4 rounded mb-4 bg-red-100 block placeholder-red-500" name="password_confirmation" required placeholder="Confirm Password" >

                <button type="submit" class=" px-4 p-2 bg-green-600  rounded text-white uppercase font-bold hover:bg-green-800">
                            {{ __('Register') }}
                </button>
            </form>
        </div>

        <a class="block absolute bottom-5 right-5 text-white font-bold underline hover:text-xl" href="/">BACK TO HOME</a>
    </div>
</x-layout>
