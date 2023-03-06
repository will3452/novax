<x-auth>
    <h3 class="text-center">Barangay Health Information System</h3>
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Please Sign In</h3>
        </div>
        <div class="panel-body">
            <form role="form" method="POST" action="{{route('login')}}">
                @csrf
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <img src="{{captcha_src()}}" alt="" style="display:block; margin-bottom:1em;">
                    <input type="text" name="captcha" required class="form-control" style="margin-bottom:1em;" placeholder="Enter captcha here">

                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-success btn-block">Login</button>
                </fieldset>
            </form>
        </div>
    </div>
</x-auth>
