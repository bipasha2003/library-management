<div>
    <a href="{{route('book_issue.edit',['book_issue' => $row->id])}}" class="btn btn-warning btn-sm border" >Edit</a>
    <a href="{{route('book_issue.return',['id' => $row->id])}}" class="btn btn-success btn-sm border" >Return</a>
    <form method="POST"  action="{{route('book_issue.destroy',['book_issue' => $row->id])}}" class=" deleteForm" style="display: inline-block;" >
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger btn-sm border">Delete</button>
    </form>
</div>