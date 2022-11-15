<div class="py-4 card border-0" style="background:#98c83b ">
    <form action="" class=" row g-2 justify-content-center mx-4 ">
       <div class="col-md-2">
        <select name="category" id="" class="form-select form-select-sm">
            <option value="*" {{request()->category == '*' ? 'selected' : ''}} >All</option>
            @foreach (\App\Models\Category::get() as $category)
                <option value="{{$category->id}}" {{request()->category == $category->id ? 'selected' : ''}}>
                    {{$category->name}}
                </option>
            @endforeach
        </select>
       </div>
       <div class="col-md-4 d-flex">
        <input type="search" name="keyword" class="form-control form-control-sm" value="{{request()->keyword }}" placeholder="Search Product here">
        <button class="btn btn-primary mx-2 btn-sm">Search</button>
       </div>
    </form>
</div>
