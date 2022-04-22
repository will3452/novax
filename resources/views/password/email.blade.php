<x-new-layout>
    <div class="d-flex justify-content-center align-items-center" style="width:100vw !important;height:100vh !important;">
        <div class="col-md-4 col-12">
            <div class="d-flex justify-content-center">
                <img src="/logo.png" alt="logo" style="width:150px; height:150px;">
            </div>
            <h4 class="text-center">Online Examination System</h4>
            <form action="{{route('password.send.link')}}" class="card flex-shrink-0 w-full  shadow-2xl bg-base-200" method="POST">
                @csrf
                <div class="card-body">
                  <x-input label="Email" name="email"/>
                  <button class="btn btn-primary"  type="submit">Send Password Reset Link</button>
                </div>
            </form>
        </div>
    </div>
</x-new-layout>
