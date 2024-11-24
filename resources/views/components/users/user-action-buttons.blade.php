<div>
<a href="{{route('users.edit',['user' => $row->id])}}" class="btn btn-warning btn-sm border" >Edit</a>
  <form method="POST"  action="{{route('users.destroy',['user' => $row->id])}}" class="form deleteForm" style="display: inline-block;" >
     @method('DELETE')
     @csrf
     <button type="submit" class="btn btn-danger btn-sm border">Delete</button>
  </form>
  <a href="" class="btn btn-success btn-sm border" >Show</a>
                                            
</div>