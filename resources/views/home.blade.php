@extends('layouts.app')

@section('content')
    <div style="display:flex; flex-wrap: wrap;">
   <booking-card></booking-card>
    <dashboard-card
    style="margin-right:1em; width: 300px;background-image: linear-gradient(to bottom, #673DE6 , #673CE5);color:white; border: none;border-radius: 1em;"
    icon="history"
    label="History"
    >
        <a-button type="ghost" block>
            View History
        </a-button>
    </dashboard-card>
    <dashboard-card
    style="margin-right:1em; width: 300px;background-image: linear-gradient(to bottom, #FF1D00 , #FF6700);color:white; border: none;border-radius: 1em;"
    icon="environment"
    label="Map"
    >
        <a-button type="ghost" block>
            View Location
        </a-button>
    </dashboard-card>
    </div>
    <a-row :gutter="16" style="margin-top:1em">
        <a-col :md="10" :xs="24">
            <dashboard-calendar></dashboard-calendar>
        </a-col>
        <a-col :md="14" :xs="24">
            <dashboard-notices></dashboard-notices>
        </a-col>
    </a-row>
@endsection
