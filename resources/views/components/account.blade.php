@props(['user', 'signature' => true])
<table class="table table-sm table-bordered table-striped">
    <tr>
        <th>ID No.  </th>
        <td>{{$user->number}}</td>
    </tr>
    <tr>
        <th>Name  </th>
        <td>{{$user->name}}</td>
    </tr>
    @student
    <tr>
        <th>
            Program of study
        </th>
        <td>{{$user->course}}</td>
    </tr>
    @endstudent
    @if ($user->isFaculty())
    <tr>
        <th>
            Cluster
        </th>
        <td>
            {{$user->cluster ?? '---'}}
        </td>
    </tr>
    <tr>
        <th>
            Relevant Degree
        </th>
        <td>
            {{$user->relevant_deg ?? '---'}}
        </td>
    </tr>
    <tr>
        <th>
            Research Specialization
        </th>
        <td>
            {{$user->research_spec ?? '---'}}
        </td>
    </tr>
    <tr>
        <th>
            Schedule Type
        </th>
        <td>
            {{$user->schedule_type ?? '---'}}
        </td>
    </tr>
    @endif
    @if ($signature)
    <tr>
        <th>Signature</th>
        <td>
            <img src="/storage/{{$user->signature  }}" alt=""  style="width:60px;" />
        </td>
    </tr>
    @endif
    @if ($user->isStudent())
    <tr>
        <th>Skills</th>
        <td>
            {{$user->skills ? implode(', ', $user->skills ?? []): 'N/a'}}
        </td>
    </tr>
    @endif
</table>
