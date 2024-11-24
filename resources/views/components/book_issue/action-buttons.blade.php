<div>
    <a href="{{route('book_Issue.edit',['book_Issue' => $row->id])}}" class="btn btn-warning btn-sm border" >Edit</a>
    <a href="" class="btn btn-success btn-sm border" >Return</a>
    <form method="POST"  action="{{route('book_Issue.destroy',['book_Issue' => $row->id])}}" class=" deleteForm" style="display: inline-block;" >
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger btn-sm border">Delete</button>
    </form>
</div>