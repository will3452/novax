<x-layout>
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1>Hello {{auth()->user()->name}}!</h1>
            <div>
                System Date: {{now()->format('m/d/Y')}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                Account Details
                            </div>
                            <div>
                                <a href="/user-edit" class="btn btn-secondary btn-sm">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-striped">
                            <tr>
                                <th>ID No.  </th>
                                <td>{{auth()->user()->number}}</td>
                            </tr>
                            <tr>
                                <th>Name  </th>
                                <td>{{auth()->user()->name}}</td>
                            </tr>
                            @student
                            <tr>
                                <th>
                                    Program of study
                                </th>
                                <td>{{auth()->user()->course}}</td>
                            </tr>
                            @endstudent
                            @if (auth()->user()->isFaculty())
                            <tr>
                                <th>
                                    Cluster
                                </th>
                                <td>
                                    {{auth()->user()->cluster ?? '---'}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Relevant Degree
                                </th>
                                <td>
                                    {{auth()->user()->relevant_deg ?? '---'}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Research Specialization
                                </th>
                                <td>
                                    {{auth()->user()->research_spec ?? '---'}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Schedule Type
                                </th>
                                <td>
                                    {{auth()->user()->schedule_type ?? '---'}}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th>Signature</th>
                                <td>
                                    <img src="/storage/{{auth()->user()->signature  }}" alt=""  style="width:60px;" //>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><rect width="96" height="96" x="96" y="112" fill="none" rx="16" ry="16"/><path fill="currentColor" d="M468 112h-52v304a32 32 0 0 0 32 32a32 32 0 0 0 32-32V124a12 12 0 0 0-12-12"/><path fill="currentColor" d="M431.15 477.75A64.11 64.11 0 0 1 384 416V44a12 12 0 0 0-12-12H44a12 12 0 0 0-12 12v380a56 56 0 0 0 56 56h342.85a1.14 1.14 0 0 0 .3-2.25M96 208v-96h96v96Zm224 192H96v-32h224Zm0-64H96v-32h224Zm0-64H96v-32h224Zm0-64h-96v-32h96Zm0-64h-96v-32h96Z"/></svg> News & Announcements</div>
                    <div class="card-body">
                        @forelse (\App\Models\Announcement::get() as $item)
                            <div class="card mb-2">
                                <div class="card-header">
                                    {{$item->subject}}
                                </div>
                                <div class="card-body">
                                    {{$item->body}}
                                </div>
                            </div>
                        @empty
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    No Announcement
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
