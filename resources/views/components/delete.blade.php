@props(['model', 'id'])
<form action="{{route('destroy', ['model' => $model, 'id' => $id])}}" method="POST">
    @csrf @method('DELETE')
    {{$slot}}

    <button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delete</button>
</form>
