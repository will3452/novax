<div class="card">
    <div class="card-header">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M12 13q1.45 0 2.475-1.025T15.5 9.5t-1.025-2.475T12 6T9.525 7.025T8.5 9.5t1.025 2.475T12 13m-7 8q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14v-1.15q-1.35-1.325-3.137-2.087T12 15t-3.863.763T5 17.85z"/></svg> Profile
    </div>
    <div class="card-body">
        <form action="{{route('user.update')}}" method="POST" class="d-flex  flex-column gap-3" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="" class="form-label">
                    ID No.
                </label>
                <input type="text" name="number" class="form-control" value="{{auth()->user()->number}}"/>
            </div>
            @student
            <div class="form-group">
                <label for="" class="form-label">
                    Program of study
                </label>
                <input type="text" name="course" class="form-control" value="{{auth()->user()->course}}" />
            </div>
            @endstudent
            @if (auth()->user()->isFaculty())
                <div class="form-group">
                    <label for="" class="form-label">
                        Cluster
                    </label>
                    <input type="text" class="form-control" name="cluster" />
                </div>
                <div class="form-group">
                    <label for="" class="form-label">
                        Relevant Degree
                    </label>
                    <input type="text" class="form-control" name="relevant_deg" />
                </div>
                <div class="form-group">
                    <label for="" class="form-label">
                        Research Specialization
                    </label>
                    <input type="text" class="form-control" name="research_spec" />
                </div>
                <div class="form-group">
                    <label for="" class="form-label">
                        Schedule Type
                    </label>
                    <input type="text" class="form-control" name="schedule_type" />
                </div>
            @endif
            <div class="form-group">
                <label for="" class="form-label">Signature</label>
                <input type="file" class="form-control"  name="signature" required>
            </div>
            <button class="btn btn-primary">Update Account</button>
        </form>
    </div>
</div>
