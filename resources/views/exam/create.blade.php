<x-new-layout>
    <h4>Create new exam</h4>
    <form action="/exams" method="POST" class="card-body">
        @csrf
        <div class="my-2">
            <div class="label">
                <div class="label-text">Checking mode</div>
            </div>
            <select name="is_manual_checking" id="" class="form-control border p-2">
                <option value="0">Auto Check</option>
                <option value="1">Manual Check</option>
            </select>
        </div>
        <x-input name="name" label="Title" type="text"/>
        <x-input name="description" label="Description"/>
        <x-date name="opened_at" label="Date to open" type="date"/>
        <x-input name="time_limit" label="Time constraint (in minutes)" type="number"/>
        <x-select name="strand" label="Choose Strand">
            @foreach (\App\Models\User::STRAND as $s)
                <option value="{{$s}}">{{$s}}</option>
            @endforeach
        </x-select>
        <x-select name="level" label="Choose Leven">
            @foreach (\App\Models\User::LEVEL as $s)
                    <option value="{{$s}}">{{$s}}</option>
                @endforeach
        </x-select>
        <div class="form-control my-2" x-data="{
            hasCode:false,
            toggle() {
                this.hasCode = !this.hasCode;
            },
        }">
            <div class="d-flex align-items-center">
                <div>
                    <input type="checkbox" x-on:click="toggle" class=" d-block mr-2">
                </div>
                <div style="margin-left: 10px">
                    Check if you want to secured with code.
                </div>
            </div>
            <template x-if="hasCode">
                <div>
                    <label for="">Code</label>
                    <div>
                        <input type="text" name="code" required >
                    </div>
                </div>
            </template>
        </div>
        <button class="btn btn-primary mt-2">
            Create Now
        </button>
    </form>
</x-new-layout>
