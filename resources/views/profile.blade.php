<x-layout>
    <x-navbar></x-navbar>
    <x-content>
        <div class="flex justify-center p-4">
            <image-uploader image="{{$user->profile ? $user->profile->public_picture: '/user.png'}}" user="{{$user->id}}">@csrf</image-uploader>
        </div>
        <div class="w-full md:w-1/2 mx-auto">
            <profile-form
                name="{{auth()->user()->name}}"
                email="{{auth()->user()->email}}"
                address="{{auth()->user()->address}}"
                school="{{auth()->user()->school}}"
                mobile-number="{{auth()->user()->mobile_number}}"
            ></profile-form>

            <about-updater userid="{{$user->id}}" about="{{$user->profile ? $user->profile->about : ''}}"></about-updater>
            <skills-adder userid="{{$user->id}}"></skills-adder>
            <div>
                <h1>
                    Memorandum of Agreement (MOA)
                </h1>
                <a href="{{auth()->user()->getMoa()}}" >View</a>
            </div>
        </div>
    </x-content>
</x-layout>
