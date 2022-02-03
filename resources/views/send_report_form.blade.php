<x-app>
    <x-page-container>
        @if (session()->has('success'))
            <div class="alert alert-success">
                Issue has been sent!
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Report an issue
            </div>
        <div class="card-body">
                <form action="/send-report" method="POST">
                @csrf
                    <div class="form-group">
                        <select name="type" id="" class="custom-select" requried>
                            @foreach (\App\Models\ReportType::get() as $type)
                                <option value="{{$type->name}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Description of issue</label>
                        <textarea name="message" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-page-container>
</x-app>
