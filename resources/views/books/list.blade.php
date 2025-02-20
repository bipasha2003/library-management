<x-app-layout>
   <x-core.page-header :header=$header :breadcrums=$breadcrums  />
    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Book List <a href="{{route('books.create')}}" class="btn btn-primary btn-sm text-right" > <i class="fa fa-plus-circle" ></i> Add new</a>
                            </div>
                            <div class="card-body border" >
                                <table id="bookList" class="table" data-url="{{route('get-books-api')}}" >
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Author</th>
                                            <th>Publisher</th>                                           
                                            <th>Price</th>
                                            <th>No. of Copies</th>
                                            <th>Default Rent Price</th>
                                            <th>Rent Price as Per Day</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                                      
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
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"  ></script>
<script src="js/datatables-simple-demo.js"></script>


</x-app-layout>