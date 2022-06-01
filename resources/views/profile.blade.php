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
                <div class="text-center uppercase font-bold mt-4 mb-2">
                    Memorandum of Agreement (MOA)
                </div>
                <div class="text-center">
                    <a href="{{auth()->user()->getMoa()}}" download class="btn btn-sm btn-primary">DOWNLOAD</a>
                </div>
            </div>
        </div>
    </x-content>
</x-layout>
