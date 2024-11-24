<div>
    @foreach($row->bookIssueHasCopies as $books)
    <span class="badge bg-danger text-white border shadow-sm" >{{$books->book_copy_id}} </span>
    @endforeach
</div>