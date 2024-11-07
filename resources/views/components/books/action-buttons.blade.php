<div>
    <a href="{{route('books.edit',['book' => $row->id])}}" class="btn btn-warning btn-sm border" >Edit</a>
    <form method="POST"  action="{{route('books.destroy',['book' => $row->id])}}" class=" deleteForm" style="display: inline-block;" >
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger btn-sm border">Delete</button>
    </form>
    <a href="" class="btn btn-success btn-sm border" >Add new copies</a>
    <a href="" class="btn btn-danger btn-sm border" >Delete old copies</a>
</div>