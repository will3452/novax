<x-layout>
    <div class="relative h-screen">
        <div class="flex justify-between h-full" style="background:url('Background.png'); background-position:center;">
            <div class="w-1/2 flex items-center justify-center flex-col p-4 md:p-10 text-white">
                <h1 class="w-full text-left font-bold text-9xl">
                    {{config('app.name', 'APP NAME')}}
                </h1>
                <p class="w-full text-left text-4xl">
                    {{nova_get_setting('introduction', 'lorem ipsum dolor set')}}
                </p>
            </div>
           <div class="w-1/3 flex items-center">
                <form class="card-body card bg-white m-4" action="/login" method="POST">
                    @csrf
                    <h1 class="text-2xl font-bold">Login</h1>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Email</span>
                    </label>
                    <input type="text" autofocus placeholder="[Input Email Address]" requried name="email" class="input input-bordered">
                </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Password</span>
                    </label>
                    <input type="password" placeholder="[Input Password]" required name="password" class="input input-bordered">
                    <label class="label">
                    <a href="/admin/password/reset" class="label-text-alt link link-hover">Forgot password?</a>
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary">Login</button>
                </div>
                </form>
           </div>
        </div>
    </div>
</x-layout>
