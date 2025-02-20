<x-app-layout>
    <x-core.page-header :header=$header :breadcrums=$breadcrums  />
 <div class="container form-container">   
 @if (Session::has('message'))
                    <div class="alert alert-primary">
                        <small>
                            {{ session()->get('message') }}
                        </small>
                    </div>
                @endif  
 <form method="POST" id="bookEditForm" action="{{ route('books.update', ['book' => $book->id]) }}" enctype="multipart/form-data" class="form p-3" > 
 @csrf        
 @method('PUT')      
  <div class="form-row">
  <div class="col-md-4 mt-3 mb-3">
        <h6 class="text-secondary" >Basic details</h6>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{ $book->name }}" required>   
      @error('name')
          <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror</div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Author</label>
      <input type="text" class="form-control" name="author" id="author"  value="{{ $book->author }}" required>
      @error('author')
        <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Publisher</label>
      <div class="input-group">
        
        <input type="text" class="form-control" name="publisher"  id="publisher" aria-describedby="inputGroupPrepend2" value="{{ $book->publisher }}" required>
        @error('publisher')
          <small for="" class="text-danger p-1">{{ $message }}</small>
        @enderror  
    </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault03">Price</label>
      <input type="text" class="form-control" name="price" id="price" value="{{ $book->price }}"  required>
      @error('price')
         <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror
    </div>

  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault03">No Of Copies</label>
      <input type="text" class="form-control" name="no_copies" id="no_copies" value="{{ $book->bookHasCopies()->count()}}"  required disabled>
      @error('price')
         <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mt-3 mb-3">
        <h6 class="text-secondary" >Rent prices</h6>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03">Default Rent</label>
      <input type="text" class="form-control" name="default_borrow_price" id="default_borrow_price" value="{{ $book->default_borrow_price }}"  required>
      @error('price')
         <small for="" class="text-danger p-1">{{ $message }}</small>
      @enderror
    </div>
  </div>
  <div class="form-row rent-container" id="rent_container">

  @foreach($book->bookHasPrices as $key => $item)
  <div class="row rent_row">
    <div class="col-md-2">
        <label for="">No. of days(min)</label>
        <input type="number" class="form-control no_days" value="{{$item->no_of_days_minimum}}"  >
    </div>
    <div class="col-md-2">
        <label for="">Rent Amount(INR)</label>
        <input type="number" class="form-control rent_amount" value="{{$item->rate_per_day}}"  >
    </div>
    <div class="col-md-2 pt-1">
        @if($key == 0)
        <button class="btn btn-default btn-danger mt-4 add_row " type="button" >+</button>
        @else
        <button class="btn btn-default btn-danger mt-4 remove_row " type="button" >-</button>
        @endif
    </div>
  </div>
  @endforeach

  </div>
</div>  
  <div class="container pl-3 pb-3 ">
  <button class="btn btn-primary btn-block ml-3 " type="submit">Submit</button>

  </div>
</form>
<script>
        $(document).ready(function() {


            $(".form-container").on("click",".add_row",function(){
               let new_row =  $(this).closest(".rent_row").clone()
               $(new_row).find(".add_row").replaceWith(`<button class="btn btn-default btn-danger mt-4 remove_row " >-</button>`)
               $(this).closest(".rent-container").append(  new_row)
            })
            $(".form-container").on("click",".remove_row",function(){
                $(this).closest(".rent_row").remove();
            })

            $("#bookEditForm").on("submit",function(e){
                 e.preventDefault();
                 $(this).validate({
                        rules: {
                            name: {
                               required:true,
                                minlength: 3
                            },
                            author: {
                                required:true,
                                minlength: 3
                            },
                            publisher: {
                                required:true,
                                minlength: 3
                            },
                            price: {
                                required: true
                            }

                        
                        },
                        messages: {
                            name: {
                                minlength: "Name should be at least three letters"
                            },
                            author: {
                
                                minlength: "Name should be at least three letters"
                            },
                            publisher: {
                                minlength: "Name should be at least three letters"
                            },
                            price: {
                                required: "Price required",
                               
                            }
                                 }
                    })

                    $.ajax({
                      url: $(this).prop("action"),
                      method: "PUT",
                      data: {
                        _token: $("input[name='_token']").val(),
                        name: $("#name").val(),
                        author: $("#author").val(),
                        publisher: $("#publisher").val(),
                        price: $("#price").val(),
                        no_copies: $("#no_copies").val(),
                        default_borrow_price: $("#default_borrow_price").val(),
                        rent_prices: $(".rent_row").map((index,elem) => {
                            return {
                              no_of_days_minimum : $(elem).find("input.no_days").val(),
                              rate_per_day: $(elem).find("input.rent_amount").val()
                            }
                        }).get()

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