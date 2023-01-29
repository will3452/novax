@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endpush
    <div class="container">

    <h1>Topics</h1>
        <table id="example">
            <thead>
                <tr>
                    <th>
                        Topic
                    </th>
                    <th>
                        Descriptions
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topics as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->description}}
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="botmanChatWidget.say('faculty:{{$item->name}}'); botmanChatWidget.open()">Ask the bot</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
