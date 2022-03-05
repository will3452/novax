@props(['subjects', 'userId'=>null])
<x-table-container>
    <x-section-title>
        List of subjects.
    </x-section-title>
    <x-table>
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Code
                </th>
                <th>
                    # of Modules
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $item)
            <tr>
                <td>
                    {{$item->name}}
                </td>
                <td>
                    {{$item->code}}
                </td>
                <td>
                    {{$item->modules()->count()}}
                </td>
                <td>
                    @if ($userId !== auth()->id() && ! is_null($userId))
                        <a href="/subjects/{{$item->id}}?student={{$userId}}" class="btn btn-primary btn-sm">View</a>
                    @else
                        <a href="/subjects/{{$item->id}}" class="btn btn-primary btn-sm">View</a>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </x-table>
</x-table-container>
