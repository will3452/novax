<x-layout>
    <div class="w-screen bg-blue-900">
        
    <div class="relative w-screen md:w-1/2 p-10 bg-blue-900 h-screen mx-auto">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex items-center ">
                <img src="/alarm.png" class="w-20"alt="">
                <h1 class="font-bold text-white text-4xl mx-4 font-mono">Police Emerge!</h1>
            </div>
            <h1 class="my-4 font-bold text-4xl mt-10 text-white">LOGIN</h1>
                 
                    <input id="email" type="email" class="w-full p-4 rounded mb-4 bg-white block placeholder-blue-500  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email." required autofocus>
    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
    
                    <input id="password" type="password" class="w-full p-4 rounded mb-4 bg-white block placeholder-blue-500 @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password." >
    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <div class="mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                        <label class="font-bold text-blue-500 underline" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                        </div>
    
                    <div class="flex justify-between">
                        <button type="submit" class=" px-4 p-2 bg-blue-600  rounded text-white uppercase font-bold hover:bg-blue-800">
                            {{ __('Login') }}
                        </button>
                        <a href="/register" class=" px-4 p-2 bg-blue-950  rounded text-white uppercase font-bold hover:bg-blue-800">
                                    {{ __('Create new account') }}
                        </a>
                    </div>
    
                    @if (Route::has('password.request'))
                        <a class="text-blue-500 font-bold block mt-4 underline" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
        </form>
    </div>
    <a class="block absolute bottom-5 right-5 text-white font-bold underline hover:text-xl" href="/">BACK TO HOME</a>
    
    </div>
</x-layout>