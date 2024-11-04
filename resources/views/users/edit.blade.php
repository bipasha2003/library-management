<x-app-layout>
    <x-core.page-header :header="$header" :breadcrums="$breadcrums" />

    <div class="container">   
        @if (Session::has('message'))
            <div class="alert alert-primary">
                <small>
                    {{ session()->get('message') }}
                </small>
            </div>
        @endif  

        <form id="userUpdateForm" method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
            @csrf
            @method('PUT')              
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault01">Name</label>
                    <input type="text" class="form-control"id="name" name="name" value="{{ $user->name }}">   
                    @error('name')
                        <small class="text-danger p-1">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="{{ $user->age }}">
                    @error('age')
                        <small class="text-danger p-1">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="validationDefaultUsername">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend2" value="{{ $user->email }}" disabled>
                        @error('email')
                            <small class="text-danger p-1">{{ $message }}</small>
                        @enderror  
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}">
                    @error('address')
                        <small class="text-danger p-1">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="validationDefault04">Contact</label>
                    <input type="text" class="form-control" name="contact" id="contact" value="{{ $user->contact }}" disabled>
                    @error('contact')
                        <small class="text-danger p-1">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            <div class="container pl-3 pb-3 ">
                <button class="btn btn-primary btn-block ml-3 " type="submit">Submit</button>

            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#userUpdateForm").on("submit",function(e){
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
                                required: "Address required"
                               
                            },
                            contact: {
                                required: "Contact required",
                                minlength: "Contact shouldn't be less then 10"
                               
                            }
                        }
                    })

                    $.ajax({
                      url:'{{route("users.update",["user"=> $user->id])}}',
                      method: "PUT",
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
