<x-app>
    <x-page-container>
        <!-- Page Heading -->
    <x-page-header>
        {{$room->name}}
    </x-page-header>
       <div class="card">
           <div class="card-header">
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

       <div class="card mt-2">
           <div class="card-header">
               Subjects
           </div>
           <div class="card-body">
               <table id="dataTable" class="table table-bordered">
                   <thead>
                        <tr>
                            <th>
                                Subject Description
                            </th>
                            <th>
                                Subject Code
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                   </thead>
                   <tbody>
                       @foreach ($room->subjects as $subject)
                       <tr>
                           <td>
                               {{$subject->description}}
                           </td>
                           <td>
                               {{$subject->code}}
                           </td>
                           <td>
                               <a class="btn btn-white">
                                   <i class="fa fa-eye"></i>
                               </a>
                           </td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
       </div>
    </x-page-container>
</x-app>
