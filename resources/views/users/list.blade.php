<x-app-layout>
   <x-core.page-header :header=$header :breadcrums=$breadcrums  />
    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                User List <a href="{{route('userss.create')}}" class="btn btn-primary btn-sm " >Create</a>
                            </div>
                            <div class="card-body border" >
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rows as $row)                          
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->age}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->contact}}</td>
                                            <td>{{$row->address}}</td>
                                            <td>
                                            <a href="{{route('users.edit',['user' => $row->id])}}" class="btn btn-warning btn-sm border" >Edit</a>
                                            <form method="POST"  action="{{route('users.destroy',['user' => $row->id])}}" class="form deleteForm" style="display: inline-block;" >
                                             @method('DELETE')
                                              @csrf
                                              <button type="submit" class="btn btn-danger btn-sm border">Delete</button>
                                            </form>
                                            <a href="" class="btn btn-success btn-sm border" >Show</a>
                                            </td>
                                        </tr>   
                                        @endforeach                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>

<script>
      $(document).ready(function() {
            $(".deleteForm").on("submit",function(e){
                    e.preventDefault();
                    if(confirm("Are you sure you want to delete?"))
                    $.ajax({
                      url: $(this).prop("action"),
                      method: "DELETE",
                      data: {
                        _token: $("input[name='_token']").val()

                      },
                      success: function(data){
                               alert(data.message)
                      },
                      error: function (request, status, error) {
                               
                               let errors = request.responseJSON

                               if(request.status == 400)
                               {
                                alert(request.responseJSON.message)
                               }

                               if(request.status == 500)
                               {
                                alert(request.responseJSON.message)
                               }
                             
                            }
                    })


                   
                })

                });


    
</script>                        
                        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
                        <script src="js/datatables-simple-demo.js"></script>


</x-app-layout>