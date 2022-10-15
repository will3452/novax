<x-layout>
    <div style="background:url('/todo.jpg');background-size:cover;height:100vh;overflow-y:auto;">
        <h1 class="text-center text-2xl uppercase mb-4 pt-4">
            Todo List
        </h1>
        <div class="my-4 flex justify-center" >
            <label for="my-modal" class="btn modal-button">Add new todo</label>
            <input type="checkbox" id="my-modal" class="modal-toggle">
            <div class="modal">
            <div class="modal-box">
                <form action="/todos" method="POST">
                    @csrf
                    <div>
                        <div class="label">
                            <div class="label-text">
                                Description
                            </div>
                        </div>
                        <textarea class="textarea textarea-bordered w-full" name="description" required></textarea>
                    </div>
                    <div class="my-4">
                        <button class="btn btn-primary" type="submit">
                            Add todo
                        </button>
                    </div>
                </form>
                <div class="modal-action">
                <label for="my-modal" class="btn">Cancel</label>
                </div>
            </div>
            </div>
        </div>
        <div class="rounded p-4 w-full md:w-1/2 mx-auto">
            <div class="text-2xl font-bold">
                Pending
            </div>
            <div>
                <ul class="m-2">
                    @forelse ($pending as $i)
                        <li class="flex justify-between p-2">
                            <span>
                                {{$i->description}}
                            </span>
                            <form action="/todo-complete/{{$i->id}}" method="POST">
                                @csrf
                                <button class="btn-sm btn btn-primary">
                                    Mark as Done
                                </button>
                            </form>
                        </li>
                    @empty
                        <div>
                            ---
                        </div>
                    @endforelse
                </ul>
            </div>
            <div class="text-2xl font-bold">
                Completed
            </div>
            <div>
                <ul class="m-2">
                    @forelse ($done as $i)
                        <li class="flex justify-between p-2">
                            <span>
                                {{$i->description}}
                            </span>
                            <div>
                                {{$i->updated_at->format('m/d/y h:i a')}}
                            </div>
                        </li>
                    @empty
                        <div>
                            ---
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-layout>
