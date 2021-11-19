<x-layout>
    <div class="h-screen w-screen flex justify-center items-center bg-gray-100" x-data="{
        formsubmit(event){
            if(event.key == 'Enter') {
                return false;
            }
        }
    }">
        <div class="w-full md:w-1/3 shadow p-7 mx-auto rounded bg-white">
            <h1 class="font-bold text-xl uppercase">
                Register
            </h1>
            @if (session('success'))
            <div class="p-2 bg-green-300 rounded font-bold text-green-900">
                Register Successfully!
            </div>
            @endif
            <form action="/register" method="POST" x-on:keydown="formsubmit(event)">
                @csrf
                <div class="my-2">
                    <label for="" class="mb-2 block text-xs font-bold">Name</label>
                    <input type="text" name="name" required class="p-2 border-2  w-full rounded">
                </div>
                <div class="my-2">
                    <label for="" class="mb-2 block text-xs font-bold">Email</label>
                    <input type="email" name="email" required class="p-2 border-2  w-full rounded" value="{{request()->email}}" readonly>
                    @error('email')
                    <div class="text-xs font-bold uppercase text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="my-2">
                    <label for="" class="mb-2 block text-xs font-bold">OTP code (sent to your Email)</label>
                    <input type="text" name="otp" required class="p-2 border-2  w-full rounded">
                    @if (session()->has('otp'))
                    <div class="text-xs font-bold uppercase text-red-500">
                        {{session('otp')}}
                    </div>
                    @endif
                </div>
                <div x-data="{
                    level: 2,
                    updateLevel(){
                        let format = /[`!@#$%^&*()_+\-=\[\]{};':\\|,.<>\/?~]/;
                        let nu
                        let currentPassword = this.$refs.inputpassword.value;
                        this.level = 0;
                        if (currentPassword.length >= 6) {
                            this.level += 30;
                        }

                        if (format.test(currentPassword)) {
                            this.level += 40;
                        }

                        if (/\d/.test(currentPassword)) {
                            this.level += 30;
                        }
                    }
                }">
                    <div class="my-2" >
                        <label for="" class="mb-2 block text-xs font-bold">Password</label>
                        <div class="flex">
                            <input type="password" name="password" required class="p-2 border-2  border-r-0 w-full rounded" x-on:keyup="updateLevel()" x-ref="inputpassword">
                            <button class="border-2 border-l-0 rounded px-2" type="button" x-on:click="$refs.inputpassword.type = $refs.inputpassword.type  == 'text'? 'password' : 'text'; $refs.inputpassword.focus()">
                                <x-eye-icon></x-eye-icon>
                            </button>
                        </div>
                        <div class="h-1 bg-gray-200 rounded mt-2 overflow-hidden">
                            <div class="h-full bg-green-400" x-bind:style="{width:`${level}%`}">
                            </div>
                        </div>
                        @error('password')
                            <div class="text-xs font-bold uppercase text-red-500">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="" class="mb-2 block text-xs font-bold">Confirm Password</label>
                        <input type="password" name="password_confirmation" required class="p-2 border-2  w-full rounded">
                    </div>
                    <template x-if="level == 100">
                        <input class="p-2 bg-green-500 font-bold rounded uppercase text-white w-full" type="submit" value="Register"/>
                    </template>
                </div>

                <div class="text-center my-2">
                    Alreay have an account? <a href="/nova/login" class="text-green-400">click here to login</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
