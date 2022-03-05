@props(['students' => []])
<div class="mt-4">
    <x-table-container>
        <x-section-title>
            My Students.
        </x-section-title>
        <x-table>
            <thead>
                <tr>
                    <th>
                        Student #
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Phone
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $item)
                    <tr>
                        <td>
                            {{$item->student->student_number}}
                        </td>
                        <td>
                            {{$item->student->name}}
                        </td>
                        <td>
                            {{$item->student->email}}
                        </td>
                        <td>
                            {{$item->student->phone}}
                        </td>
                        <td>
                            <a href="{{route('student.room')}}?student={{$item->student_id}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-table-container>
</div>
