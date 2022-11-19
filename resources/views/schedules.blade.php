@extends('layouts.app')

@section('content')
    <a-card>
        <h1>Schedules</h1>
        <a-table :data-source="{{$bus}}" :columns="[{title: 'Bus', dataIndex: 'plate_number', key: 'bus'}, {title: 'Route', dataIndex: 'trips', key: 'trip'}, {title: 'Time', dataIndex: 'timex', key: 'time', },  {title: 'Capacity', dataIndex: 'capacity', key: 'cap'}]">
        </a-table>
    </a-card>
@endsection
