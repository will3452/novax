<div class="py-4 artboard artboard-demo bg-opacity-0 bg-base-200 lg:hidden fixed bottom-0 w-screen">
    <ul class="menu shadow-lg bg-base-100 rounded-box horizontal">
        <li>
        @if (auth()->user()->canApplyJob())
        <a href="/jobs">
            <span class="material-icons">
                web
            </span>
        </a>
        @else
        <a href="#" >
            <label for="no-resume" class="material-icons">
                web
            </label>
        </a>
        @endif
        </li>
        <li>
        <a href="/dashboard">
            <span class="material-icons">
            dashboard
            </span>
        </a>
        </li>
        <li>
        <a href="/logout">
            @csrf
            <button class="material-icons">
                logout
            </button>
        </a>
        </li>
    </ul>
</div>
<input type="checkbox" id="no-resume" class="modal-toggle">
<div class="modal z-50">
<div class="modal-box z-50">
    <p>Please upload your resume, For you to apply Job.</p>
    <div class="modal-action">
    <label for="no-resume" class="btn" >Ok, I Will Upload.</label>
    </div>
</div>
</div>
