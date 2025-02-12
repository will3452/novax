@props(['title'])
<div class="card mt-2">
    <div class="card-header">
        Actions
    </div>
    <div class="card-body">
        <div class="d-flex gap-3 flex-column ">
            <a href="{{route('form', ['form' => 'acceptance', 'model' => $title->group])}}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><g fill="currentColor"><path d="M32.707 22.707a1 1 0 0 0-1.414-1.414L24 28.586l-3.293-3.293a1 1 0 0 0-1.414 1.414L24 31.414z"/><path fill-rule="evenodd" d="M38 15v21a3 3 0 0 1-3 3H17a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3h11zm-10 1a1 1 0 0 1-1-1V7H17a1 1 0 0 0-1 1v28a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V16zm1-7.172L34.172 14H29z" clip-rule="evenodd"/><path d="M12 11v27a3 3 0 0 0 3 3h19v2H15a5 5 0 0 1-5-5V11z"/></g></svg>
                Acceptance Form
            </a>
            <a href="{{route('form', ['form' => 'revision', 'model' => $title->group])}}" class="btn btn-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 16.2l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5H5zM5 5v14z"/></svg>
                Requirements for Revision Form
            </a>
            <a class="btn btn-success" href="{{route('titles.set.verdict', $title->id)}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M.5 13.29H8m-1 0v-2.5H1.5v2.5"/><rect width="7.07" height="4.24" x="3.96" y="2.17" rx="1" transform="rotate(-45 7.499 4.294)"/><path d="m9 5.79l4.5 4.5"/></g></svg>
                Set Verdict
            </a>
        </div>
    </div>
</div>
