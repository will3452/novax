@extends('layouts.app')

@section('content')
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<div class="container">
    <div class="my-4">
        <div action="" method="" x-data="{
            i:null,
            al:[],
            async save() {
                try {
                    let payload = {allergies:[]}
                     JSON.parse(this.al).forEach( e => payload.allergies.push(e.value))
                    await window.axios.post('/allergy', payload)
                        .then(data=>alert('record has been saved!'))
                        .catch(err=>alert('something went wrong!'))
                } catch (err) {
                    await window.axios.post('/allergy', {allergies:[]})
                        .then(data=>alert('record has been saved!'))
                        .catch(err=>alert('something went wrong!'))
                }
            },
            init () {
                i = document.querySelector('#tagify')
                new Tagify (i, {whitelist: [
                    @foreach(\App\Models\AllergyData::get() as $item)
                    `{{$item->name}}`,
                    @endforeach
                ], enforceWhitelist: true,});
                this.al = `@foreach(auth()->user()->allergies()->get()->pluck('name') as $item) {{$item}} @if(! $loop->last) , @endif @endforeach`
                i.addEventListener('change', (e) => {
                    this.al = e.target.value
                    console.log(this.al)
                })
            }
        }">
            I'm allergic to these:
            <div class="d-flex">
                <input name="allergy" x-model="al" type="text" id="tagify" class="form-control">
                <button class="btn btn-primary mx-2" id="save" x-on:click="save">save</button>
            </div>
        </div>
    </div>
    <div class="justify-content-center row">
        <x-d-card href="{{route('meal')}}">
            <img class="dashboard-icon" src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/000000/external-meals-new-normal-flaticons-lineal-color-flat-icons-2.png"/>
            <div class="text-center">
                Meals
            </div>
        </x-d-card>
        <x-d-card href="{{route('exercises')}}">
            <img class="dashboard-icon" src="https://img.icons8.com/bubbles/100/000000/exercise.png"/>
            <div class="text-center">
                Exercises
            </div>
        </x-d-card>
        <x-d-card href="{{route('progress')}}">
            <img class="dashboard-icon" src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/000000/external-progress-achievements-flaticons-lineal-color-flat-icons-2.png"/>
            <div class="text-center">
                Progress
            </div>
        </x-d-card>
        <x-d-card href="{{route('bmi')}}">
            <img class="dashboard-icon" src="https://img.icons8.com/office/80/000000/estimate.png"/>
            <div class="text-center">
                Calculator
            </div>
        </x-d-card>
    </div>
</div>
@endsection
