<x-layout>
    <x-container>
        <x-header>
            Report Issue
        </x-header>
        <div class="flex my-4 justify-center p-2">
            <form action="/report-issue" enctype="multipart/form-data" method="POST" class="w-full md:w-2/3">
                @csrf
                <div class="mb-4">
                    <label class="block" for="">Subject (topic/features)</label>
                    <input type="text" name="subject" required class="input input-bordered w-full">
                </div>
                <div class="mb-4">
                    <label class="block" for="">Details</label>
                    <textarea name="details" id="" cols="30" rows="10" placeholder="Aa" required class="textarea  textarea-bordered w-full"></textarea>
                </div>
                <div class="mb-4">
                    <label for="" class="block">Attachment</label>
                    <input type="file" name="attachment">
                    <div>
                        <span class="text-xs">
                            Maximum of 2mb only.
                        </span>
                    </div>
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
        <x-text-bold>
            List of Submitted Issue.
        </x-text-bold>
        <x-table-container>
            <x-table>
                <thead>
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Subject
                        </th>
                        <th>
                            Details
                        </th>
                        <th>
                            Attachment
                        </th>
                        <th>
                            Resolution.
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($issues as $i)
                    <tr>
                        <td>
                            {{$i->created_at->format('M d, Y H:i A')}}
                        </td>
                        <td>
                            {{$i->subject}}
                        </td>
                        <td>
                            {{$i->details}}
                        </td>
                        <td>
                            @if (! is_null($i->attachment))
                                <a class="underline" targe="_blank" href="/storage/{{$i->actual_file}}">view</a>
                            @else
                                No Attachment.
                            @endif
                        </td>
                        <td>
                            {{$i->note ?? 'N/a'}}
                        </td>
                        <td>
                            {{$i->status}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </x-table>
        </x-table-container>
    </x-container>
</x-layout>
