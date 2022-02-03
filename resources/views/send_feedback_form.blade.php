<x-app>
    <x-page-container>
        @if (session()->has('success'))
            <div class="alert alert-success">
                Feedback has been sent!
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Send feedback
            </div>
        <div class="card-body">
                <form action="/send-feedback" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="">Write Feedback</label>
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
