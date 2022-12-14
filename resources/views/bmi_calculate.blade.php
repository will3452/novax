<x-layout>
    @push('head')
        <script src="//unpkg.com/alpinejs" defer></script>
    @endpush
    <div class="w-11/12 mx-auto my-4">
        <h1 class="text-center text-2xl uppercase mb-4">
            BMI Calculator
        </h1>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        <div class="flex justify-center mt-4">
            <div action="" class="md:w-1/2 w-full p-4 rounded bg-white"
                x-data="
                    {
                        result:0,
                        weight:0,
                        height:0,
                        remarks:'---',
                        calculate() {
                            let result = (this.weight / (this.height * this.height)).toFixed(2);
                            this.result = `${result} kg/m2`;

                            if (result < 18.5) {
                                this.remarks = 'Underweight';
                            } else if (result >= 18.5 && result <= 24.9) {
                                this.remarks = 'Normal Weight';
                            } else if (result >= 25.0 && result <= 29.9) {
                                this.remarks = 'Pre-Obesity';
                            } else if (result >= 30.0 && result <= 34.9) {
                                this.remarks = 'Obesity class I';
                            } else if (result >= 35.0 && result <= 39.9) {
                                this.remarks = 'Obesity class II';
                            } else if (result >= 40) {
                                this.remarks = 'Obesity class III';
                            }
                        }
                    }
                "
            >
            <div class="text-right">
                <a target="_blank" href="/bmi-table">View BMI table</a>
            </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Weight (kg)</div>
                    </div>
                    <input type="number" x-model="weight" required class="input input-bordered w-full">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">Height (m)</div>
                    </div>
                    <input type="number" x-model="height" required class="input input-bordered w-full">
                </div>
                <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            BMI result:
                        </div>
                    </div>
                    <input type="text" readonly class="input input-bordered w-full" x-model="result">
                </div>
                {{-- <div class="form-control">
                    <div class="label">
                        <div class="label-text">
                            Nutritional Status:
                        </div>
                    </div>
                    <input type="text" readonly class="input input-bordered w-full" x-model="remarks">
                </div> --}}
                <div class="my-4">
                    <button type="button" x-on:click="calculate()" class="btn btn-primary">
                        Calculate
                    </button>
                    @auth
                        <form action="/bmi" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="kg" x-model="weight">
                            <input type="hidden" name="m" x-model="height">
                            <input type="hidden" name="remarks" x-model="remarks">
                            <button class="btn">Record</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
        @auth
            <div class="overflow-x-auto bg-white p-2 rounded mt-4">
                <h1>
                    Record(s)
                </h1>
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Height (m)
                            </th>
                            <th>
                                Weight (kg)
                            </th>
                            <th>
                                BMI
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (auth()->user()->bmis()->latest()->get() as $item)
                        <tr>
                            <td>
                                {{$item->created_at->format('m/d/y')}}
                            </td>
                            <td>
                                {{$item->m}}
                            </td>
                            <td>
                                {{$item->kg}}
                            </td>
                            <td>
                                {{number_format(($item->kg/($item->m * $item->m)), 2)}}
                            </td>
                            <td>
                                {{$item->remarks}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endauth
    </div>
</x-layout>
