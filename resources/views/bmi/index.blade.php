@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">BMI CALCULATOR</h1>

    <div class="card card-body"
    x-data="{
        submitLoading: false,
        loading: false,
        h: 0,
        w: 0,
        result:'--',
        remarks: '--',
        getRemarks() {
            if (this.result >= 25.0) {
                this.remarks = 'overweight'
            } else if (this.result >= 18.5 && this.result <= 24.9) {
                this.remarks = 'normal';
            } else {
                this.remarks = 'underweight'
            }
        },
        submit() {
            if (! this.validate()) {
                return
            }

            this.submitLoading = true
            document.getElementById('form').submit()
        },
        validate() {
            if ( this.h == 0 || this.w == 0) {
                alert('please input valid fields');
                return false
            }

            return true
        },
        calculate () {
            try {
                this.loading = true
                if (! this.validate()) {
                    return
                }
                this.result = ((this.w /  (this.h * this.h)) * 10000).toFixed(2)
                this.getRemarks()
            } catch(err) {
                console.log(err)
            } finally {
                this.loading = false
            }
        }
        }"
        >
        <div class="d-flex align-items-end">
            <div class="mx-2">
                <label for="">Weight in kg <span class="text-danger">*</span>: </label>
                <input type="text" x-model="w" class="form-control">
            </div>
            <div class="mx-2">
                <label for="">Height in cm <span class="text-danger">*</span>: </label>
                <input type="text" x-model="h" class="form-control">
            </div>
            <div class="mx-2">
                <button class="btn btn-primary" x-on:click="calculate">
                    <div class="spinner-border spinner-grow-sm" role="status" x-show="loading">
                    </div>
                    Calculate
                </button>
            </div>
            <div class="mx-2">
                <label for="">Result : </label>
                <input type="text" x-model="result" class="form-control" readonly>
            </div>
            <div class="mx-2">
                <label for="">Remarks : </label>
                <input type="text" class="form-control" x-model="remarks" readonly>
            </div>
            <div class="mx-2">
                <form action="{{route('bmi')}}" method="POST" id="form">
                    @csrf
                    <input type="hidden" name="weight" required x-bind:value="w">
                    <input type="hidden" name="height" required x-bind:value="h">
                    <input type="hidden" name="result" required x-bind:value="result">
                    <input type="hidden" name="remarks" required x-bind:value="remarks">
                </form>
                <button class="btn btn-success" x-on:click="submit()">
                    <div class="spinner-border spinner-grow-sm" role="status" x-show="submitLoading">
                    </div>
                    Save Result
                </button>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Your BMI Records:
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Weight
                        </th>
                        <th>
                            Height
                        </th>
                        <th>
                            Result
                        </th>
                        <th>
                            Remarks
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (auth()->user()->bmis()->latest()->take(5)->get() as $item)
                        <tr>
                            <td>
                                {{$item->created_at}}
                            </td>
                            <td>
                                {{$item->weight}} kg
                            </td>
                            <td>
                                {{$item->height}} cm
                            </td>
                            <td>
                                {{$item->result}}
                            </td>
                            <td>
                                {{$item->remarks}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
