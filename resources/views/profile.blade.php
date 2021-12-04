<x-layout>
    <x-navbar></x-navbar>
    <x-content>
        <div class="flex justify-center p-4">
            <image-uploader image="{{$user->profile ? $user->profile->public_picture: '/user.png'}}" user="{{$user->id}}">@csrf</image-uploader>
        </div>
        <div class="w-full md:w-1/2 mx-auto">
            <form action="/profile-save/{{$user->id}}" method="POST">
                @csrf
                <div class="form-control">
                    <div class="text-center uppercase font-bold mt-4 mb-2">
                        About me
                    </div>
                    <textarea name="about" class="textarea h-24 textarea-bordered textarea-primary" placeholder="Write About you here.">{{$user->profile ? $user->profile->about : ''}}</textarea>
                  </div>
                  <button class="btn btn-block mt-2">Save</button>
            </form>
        </div>
    </x-content>
</x-layout>
