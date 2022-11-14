<div class="py-4 card border-0">
    <form action="" class=" row g-2 justify-content-center mx-4 ">
       <div class="col-md-2">
        <select name="categoty" id="" class="form-select form-select-sm">
            <option value="*">All</option>
            @foreach (\App\Models\Category::get() as $category)
                <option value="{{$category->name}}">
                    {{$category->name}}
                </option>
            @endforeach
        </select>
       </div>
       <div class="col-md-4 d-flex">
        <input type="search" class="form-control form-control-sm" placeholder="Search Product here">
        <button class="btn btn-primary mx-2 btn-sm">Search</button>
       </div>
    </form>
</div>
