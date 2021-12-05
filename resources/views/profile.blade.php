<x-layout>
    <x-navbar></x-navbar>
    <x-content>
        <div class="flex justify-center p-4">
            <image-uploader image="{{$user->profile ? $user->profile->public_picture: '/user.png'}}" user="{{$user->id}}">@csrf</image-uploader>
        </div>
        <div class="w-full md:w-1/2 mx-auto">
            <about-updater userid="{{$user->id}}" about="{{$user->profile ? $user->profile->about : ''}}"></about-updater>
            <skills-adder userid="{{$user->id}}"></skills-adder>
        </div>
    </x-content>
</x-layout>
