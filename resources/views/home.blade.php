@extends('layouts.app')

@section('content')
    <a-alert message="Hello {{auth()->user()->name}} !" type="success" closable> </a-alert>
    <div style="display:flex; flex-wrap: wrap;justify-content:center;">
   @if (auth()->user()->type == \App\Models\User::TYPE_CLIENT)
    <booking-card user-id="{{auth()->id()}}" ></booking-card>
    <dashboard-card
    style="margin-right:1em; background-image: linear-gradient(to bottom, #673DE6 , #673CE5);color:white; border: none;border-radius: 1em;"
    icon="profile"
    label="schedules"
    >
        <a-button type="ghost" block onclick="window.location.href = '/schedules'">
            View Schedule
        </a-button>
    </dashboard-card>
    @else
    <dashboard-card
    style="margin-right:1em; background-image: linear-gradient(to bottom, #673DE6 , #673CE5);color:white; border: none;border-radius: 1em;"
    icon="qrcode"
    label="Scan"
    >
        <a-button type="ghost" block onclick="window.location.href = '/scan'">
            Scan tickets
        </a-button>
    </dashboard-card>
   @endif
    <dashboard-card
    style="margin-right:1em; background-image: linear-gradient(to bottom, #FF1D00 , #FF6700);color:white; border: none;border-radius: 1em;"
    icon="environment"
    label="Map"
    >
        <a-button type="ghost" block onclick="window.location.href = '/map'">
            View Location
        </a-button>
    </dashboard-card>
    </div>
    <a-row :gutter="16" style="margin-top:1em">
        <a-col :md="10" :xs="24">
            <a-card>
                <dashboard-calendar></dashboard-calendar>
            </a-card>
        </a-col>
        <a-col :md="14" :xs="24">
            <dashboard-notices></dashboard-notices>
        </a-col>
    </a-row>
@endsection
