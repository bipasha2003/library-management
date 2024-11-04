<x-app-layout>
    <x-core.page-header :header=$header :breadcrums=$breadcrums  />
 <div class="container">   
 @if (Session::has('message'))
                    <div class="alert alert-primary">
                        <small>
                            {{ session()->get('message') }}
                        </small>
                    </div>
                @endif  
 <form method="POST" id="userCreateForm" action="{{ route('users.store') }}" enctype="multipart/form-data" class="form p-3" > 
 @csrf              
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>   
      @error('name')
          <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror</div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Age</label>
      <input type="text" class="form-control" name="age" id="age"  value="{{ old('age') }}" required>
      @error('age')
        <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Email</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend2">@</span>
        </div>
        <input type="text" class="form-control" name="email"  id="email" aria-describedby="inputGroupPrepend2" value="{{ old('email') }}" required>
        @error('email')
          <small for="" class="text-danger p-1">{{ $message }}</small>
        @enderror  
    </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault03">Address</label>
      <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}"  required>
      @error('address')
         <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault04">Contact</label>
      <input type="text" class="form-control" name="contact" id="contact" value="{{ old('contact') }}" required>
      @error('contact')
        <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror
       
    </div>
  </div>
</div>  
  <div class="container pl-3 pb-3 ">
  <button class="btn btn-primary btn-block ml-3 " type="submit">Submit</button>

  </div>
</form>
<script>
        $(document).ready(function() {
            $("#userCreateForm").on("submit",function(e){
                 e.preventDefault();
                 $(this).validate({
                        rules: {
                            name: {
                               required:true,
                                minlength: 3
                            },
                            age: {
                                minlength: 2
                            },
                            email: {
                                email: true
                            },
                            address: {
                                required: true
                            },
                            contact: {
                                required: true,
                                minlength: 10
                            }

                        
                        },
                        messages: {
                            name: {
                                minlength: "Name should be at least three letters"
                            },
                            age: {
                
                                minlength: "Description should be at least two letters"
                            },
                            email: {
                                required: "Enter Proper Email "
                            },
                            address: {
                                required: "Address required",
                               
                            },
                            contact: {
                                required: "Contact required",
                                minlength: "Contact shouldn't be less then 10"
                               
                            }
                        }
                    })

                    $.ajax({
                      url: $(this).prop("action"),
                      method: "POST",
                      data: {
                        _token: $("input[name='_token']").val(),
                        name: $("#name").val(),
                        age: $("#age").val(),
                        email: $("#email").val(),
                        address: $("#address").val(),
                        contact: $("#contact").val()

                      },
                      success: function(data){
                        alert(data.message)
                      },
                      error: function (request, status, error) {
                               
                               let errors = request.responseJSON

                               if(request.status == 400)
                               {
                                let errorInputs = Object.keys(errors.data)
                                errorInputs.forEach(elem => {$("#"+elem).closest("div").find("small").remove();$("#"+elem).after(`<small class="text-danger" >${errors.data[elem][0]}</small>`)})
                               }

                               if(request.status == 500)
                               {
                                alert(request.responseJSON.message)
                               }
                             
                            }
                    })


                   
                   
                });
            })
    </script>

</x-app-layout>