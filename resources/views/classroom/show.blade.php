<x-app>
    <x-page-container>
        <!-- Page Heading -->
    <x-page-header>
        {{$room->name}}
    </x-page-header>
       <div class="card">
           <div class="card-header bg-primary text-white">
               Room Details
           </div>
           <div class="card-body">
               <div class="my-2">
                   Room Name: {{$room->name}}
               </div>
               <div class="my-2">
                   Room Adviser: {{$room->teacher->name}}
               </div>
               <div class="my-2">
                   Number of Subject : {{$room->subjects()->count()}}
                </div>
           </div>
       </div>
       <div class="mt-5">
        <x-page-header>
            Subjects
        </x-page-header>
       </div>
        <div class="row mt-2">
            @forelse  ($room->subjects as $subject)
            <div class="col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{$subject->description}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$subject->code}}</div>
                            </div>
                            <div class="col-auto">
                                <a href="/subjects/{{$subject->id}}" class="btn-white btn-sm btn" ><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card card-body text-center bg-light">
                No Subject found.
            </div>
            @endforelse
       </div>
    </x-page-container>
</x-app>
