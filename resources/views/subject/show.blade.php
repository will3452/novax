<x-layout>
    <x-container>
        <x-header>
            {{$subject->name}}
        </x-header>
        @if (auth()->id() !== $userId)
            <div class="pl-4 my-4">
                Student Name: {{\App\Models\User::find($userId)->name}}
            </div>
        @endif
        <div class="flex flex-wrap">
            <div class="md:w-1/2 w-full">
                <x-step-container>
                    @foreach ($subject->modules as $item)
                        <x-step :active="$item->isNotLocked($userId, $loop, $subject->modules)">
                            <x-module-container :active="$item->isNotLocked($userId, $loop, $subject->modules)">
                                <x-section-title>{{$item->name}}</x-section-title>
                                <x-module-materials-container>
                                    @foreach ($item->materials as $material)
                                        <x-module-data-item
                                        :model="$material"
                                        :takeable="$material->isTakeable($userId)"
                                        :active="$material->isNotLocked($userId, $loop, $item->materials)" :action="$material->recordLink($userId)">
                                            {{$material->name}}
                                        </x-module-data-item>
                                    @endforeach
                                </x-module-materials-container>
                                <x-module-activities-container>
                                    @foreach ($item->activities as $activity)
                                        <x-module-data-item proceed-text="{{$activity->category === \App\Models\Activity::CATEGORY_PROJECT ? 'Details' : 'Take Now'}}"
                                        :model="$activity"
                                        :takeable="$activity->isTakeable($userId)"
                                        :score="$activity->getScore($userId)"
                                        :active="$activity->isNotLocked($userId, $loop, $item->activities)"
                                        :action="$activity->recordLink($userId, $loop->last ?$item->id:0)">
                                            {{$activity->name}} <span class="text-xs font-bold">( {{$activity->category}} )</span>
                                        </x-module-data-item>
                                    @endforeach
                                </x-module-activities-container>
                            </x-module-container>
                        </x-step>
                    @endforeach
                </x-step-container>
            </div>
            @if (\App\Models\User::find($userId)->type !== \App\Models\User::TYPE_TEACHER)
            <div class="md:w-1/2 w-full flex justify-center hidden md:block">
                <div class="radial-progress bg-primary text-success" style="--value:{{$subject->getProgress($userId)}};--size:12rem">{{number_format($subject->getProgress($userId), 2)}}%</div>
            </div>
            @endif
        </div>
    </x-container>
</x-layout>

{{--
<x-step>
    <x-module-container active="true">
        <x-section-title>Module title</x-section-title>
        <x-module-materials-container>
            <x-module-data-item>
                Material one
            </x-module-data-item>
        </x-module-materials-container>
        <x-module-activities-container>
            <x-module-data-item>
                Activity One
            </x-module-data-item>
        </x-module-activities-container>
    </x-module-container>
</x-step> --}}
