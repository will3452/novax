<x-layout>


    <div class="md:flex md:w-screen relative bg-blue-900 justify-center" >
        <div class="w-screen md:w-1/2 h-screen bg-blue-900 p-10">
            <form method="POST" action="{{ route('register') }}" autocomplete="false">
                @csrf
                <p class="text-blue-100 font-thin">
                    Instant Aid, Anytime, Anywhere: Your
                    Lifesaving Web Application
                </p>
                <h1 class="my-4 font-bold text-4xl text-blue-100">SIGN UP</h1>
                <input id="phone" type="phone" class="w-full p-4 rounded mb-4 bg-blue-100 block placeholder-blue-500  @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter your Mobile No." required autofocus>

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                <input id="name"  type="text" class=" w-full p-4 rounded mb-4 bg-blue-100 block placeholder-blue-500 @error('name') is-invalid @enderror" name="name" placeholder="Enter your name." value="{{ old('name') }}" required  autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="email" placeholder="Enter your Email." type="email" class=" w-full p-4 rounded mb-4 bg-blue-100 block placeholder-blue-500 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" placeholder="Enter your Password." type="password" class="w-full p-4 rounded mb-4 bg-blue-100 block placeholder-blue-500 @error('password') is-invalid @enderror" name="password" required >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="password-confirm" type="password" class="w-full p-4 rounded mb-4 bg-blue-100 block placeholder-blue-500" name="password_confirmation" required placeholder="Confirm Password" >

                <div class="flex justify-between">
                    <button type="submit" class=" px-4 p-2 bg-blue-600  rounded text-white uppercase font-bold hover:bg-blue-800">
                        {{ __('Register') }}
            </button>

            <a href="/login" class=" px-4 p-2 bg-blue-950  rounded text-white uppercase font-bold hover:bg-blue-800">
                        {{ __('Already have an account.') }}
            </a>
                </div>
            </form>
        </div>

        <a class="block absolute bottom-5 right-5 text-white font-bold underline hover:text-xl" href="/">BACK TO HOME</a>
    </div>
</x-layout>
